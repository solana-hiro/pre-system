<?php

namespace App\Services;

use App\Models\TrnSaleHeader;
use App\Repositories\Analyse\AnaReturnAfterPayment\AnaReturnAfterPaymentRepository;

/**
 * 入金後返品チェックリスト サービス
 */
class AnaReturnAfterPaymentService extends AnalyseServiceBase
{
    private AnaReturnAfterPaymentRepository $repository;
    private $data;

    public function __construct()
    {
        $this->repository = new AnaReturnAfterPaymentRepository();
    }

    public function search($params)
    {
        $this->data = $this->repository->search($params);
        $this->common($params);
        return $this->data;
    }

    public function csv($params)
    {
        $this->data = $this->repository->csv($params);
        $this->common($params);
        return $this->data;
    }

    private function common($params)
    {
        if (parent::isContainSortParam($params)) {
            $this->sortByDefAndParams($params);
        } else {
            // 合計行を最後にするため小計行を追加→小計行含めてソート→合計行追加の順番
            $this->appendSubTotal();
            $this->sortByDefAndParams($params);
            $this->appendTotal();
        }
    }

    private function appendSubTotal()
    {
        $groupItems = $this->groupBy();
        $groupItems->each(function ($customerCdItems) {
            $this->data->push($this->getSubTotal($customerCdItems));
        });
    }

    private function groupBy()
    {
        return $this->data->groupBy([
            'customer_cd',
        ]);
    }

    private function getSubTotal($items)
    {
        $subTotal = new TrnSaleHeader();
        $subTotal->sub_total_flag = true;
        $subTotal->title = "【計】{$items->first()->customer_cd}";
        $subTotal->customer_cd = $items->first()->customer_cd;
        $subTotal->bk_customer_name = $items->max('bk_customer_name');
        $subTotal->sale_date = $items->max('sale_date');
        $subTotal->id = $items->max('id');
        $subTotal->all_total = $items->sum('all_total');
        $subTotal->slip_memo = $items->max('slip_memo');
        $subTotal->user_name = $items->max('user_name');
        return $subTotal;
    }

    private function appendTotal()
    {
        $subTotals = $this->data->filter(function ($value) {
            return $value->sub_total_flag == true;
        });
        if ($subTotals->count() !== 0) $this->data->push($this->getTotal($subTotals));
    }

    private function getTotal($subTotals)
    {
        $total = new TrnSaleHeader();
        $total->total_flag = true;
        $total->sub_total_flag = true;
        $total->title = "合計";
        $total->customer_cd = $subTotals->last()->customer_cd;
        $total->bk_customer_name = $subTotals->last()->bk_customer_name;
        $total->sale_date = $subTotals->last()->sale_date;
        $total->id = $subTotals->last()->id;
        $total->all_total = $subTotals->sum('all_total');
        $total->slip_memo = $subTotals->last()->slip_memo;
        $total->user_name = $subTotals->last()->user_name;
        return $total;
    }

    private function sortByDefAndParams($params)
    {
        $sortElement = [
            ['customer_cd', 'asc'],
            ['sub_total_flag', 'asc'],
        ];
        $sortElement = parent::sortByParams($sortElement, $params);
        $this->data = $this->data->sortBy($sortElement);
    }
}
