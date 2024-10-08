<?php

namespace App\Services;

use App\Models\TrnPaymentDetail;
use App\Repositories\Analyse\AnaMonthlyPayment\AnaMonthlyPaymentRepository;

/**
 * 入金集計表（月次） サービス
 */
class AnaMonthlyPaymentService extends AnalyseServiceBase
{
    private AnaMonthlyPaymentRepository $repository;
    private $data;

    public function __construct()
    {
        $this->repository = new AnaMonthlyPaymentRepository();
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
        $groupItems->each(function ($paymentKbnCdItems) {
            $paymentKbnCdItems->each(function ($paymentKbnNameItems) {
                $paymentKbnNameItems->each(function ($bankNameItems) {
                    $this->data->push($this->getSubTotal($bankNameItems));
                });
            });
        });
    }

    private function groupBy()
    {
        return $this->data->groupBy([
            'payment_kbn_cd',
            'payment_kbn_name',
            'bank_name',
        ]);
    }

    private function getSubTotal($items)
    {
        $subTotal = new TrnPaymentDetail();
        $subTotal->sub_total_flag = true;
        $subTotal->title = "【計】{$items->first()->payment_kbn_cd} {$items->first()->bank_name}";
        $subTotal->payment_kbn_cd = $items->first()->payment_kbn_cd;
        $subTotal->payment_kbn_name = $items->first()->payment_kbn_name;
        $subTotal->bank_name = $items->first()->bank_name;
        $subTotal->payment_number = $items->max('payment_number');
        $subTotal->amount = $items->sum('amount');
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
        $total->payment_kbn_cd = $subTotals->last()->payment_kbn_cd;
        $total->payment_kbn_name = $subTotals->last()->payment_kbn_name;
        $total->bank_name = $subTotals->last()->bank_name;
        $total->payment_number = $subTotals->max()->payment_number;
        $total->amount = $subTotals->sum('amount');
        return $total;
    }

    private function sortByDefAndParams($params)
    {
        $sortElement = [
            ['payment_kbn_cd', 'asc'],
            ['payment_kbn_name', 'asc'],
            ['bank_name', 'desc'],
            ['payment_number', 'asc'],
            ['sub_total_flag', 'asc'],
        ];
        $sortElement = parent::sortByParams($sortElement, $params);
        $this->data = $this->data->sortBy($sortElement);
    }
}
