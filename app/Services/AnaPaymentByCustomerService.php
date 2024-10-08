<?php

namespace App\Services;

use App\Models\TrnPaymentDetail;
use App\Repositories\Analyse\AnaPaymentByCustomer\AnaPaymentByCustomerRepository;

/**
 * 入金明細表（得意先別） サービス
 */
class AnaPaymentByCustomerService extends AnalyseServiceBase
{
    private AnaPaymentByCustomerRepository $repository;
    private $data;

    public function __construct()
    {
        $this->repository = new AnaPaymentByCustomerRepository();
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
        $subTotal = new TrnPaymentDetail();
        $subTotal->sub_total_flag = true;
        $subTotal->title = "【計】{$items->first()->customer_cd}";
        $subTotal->customer_cd = $items->first()->customer_cd;
        $subTotal->customer_name = $items->max('customer_name');
        $subTotal->payment_date = $items->max('payment_date');
        $subTotal->amount = $items->sum('amount');
        $subTotal->payment_kbn_name = $items->max('payment_kbn_name');
        $subTotal->memo1 = $items->max('memo1');
        $subTotal->memo2 = $items->max('memo2');
        $subTotal->bank_name = $items->max('bank_name');
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
        $total = new TrnPaymentDetail();
        $total->total_flag = true;
        $total->sub_total_flag = true;
        $total->title = "合計";
        $total->amount = $subTotals->sum('amount');
        return $total;
    }

    private function sortByDefAndParams($params)
    {
        $sortElement = [
            ['customer_cd', 'asc'],
            ['payment_date', 'asc'],
            ['sub_total_flag', 'asc'],
        ];
        $sortElement = parent::sortByParams($sortElement, $params);
        $this->data = $this->data->sortBy($sortElement);
    }
}
