<?php

namespace App\Services;

use App\Models\TrnOrderReceiveBreakdown;
use App\Repositories\Analyse\AnaSearchLargeReceivedOrder\AnaSearchLargeReceivedOrderRepository;

/**
 * 大口検索用 サービス
 */
class AnaSearchLargeReceivedOrderService extends AnalyseServiceBase
{
    private AnaSearchLargeReceivedOrderRepository $repository;
    private $data;

    public function __construct()
    {
        $this->repository = new AnaSearchLargeReceivedOrderRepository();
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
        $groupItems->each(function ($specifyDeadLineItems) {
            $specifyDeadLineItems->each(function ($orderReceiveNoItems) {
                $this->data->push($this->getSubTotal($orderReceiveNoItems));
            });
        });
    }

    private function groupBy()
    {
        return $this->data->groupBy([
            'specify_deadline',
            'order_receive_number',
        ]);
    }

    private function getSubTotal($items)
    {
        $subTotal = new TrnOrderReceiveBreakdown();
        $subTotal->sub_total_flag = true;
        $subTotal->title = "【計】{$items->first()->specify_deadline} {$items->first()->order_receive_number}";
        $subTotal->customer_cd = $items->max('customer_cd');
        $subTotal->specify_deadline = $items->max('specify_deadline');
        $subTotal->order_receive_number = $items->max('order_receive_number');
        $subTotal->order_receive_quantity = $items->sum('order_receive_quantity');
        $subTotal->order_receive_amount = $items->sum('order_receive_amount');
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
        $total = new TrnOrderReceiveBreakdown();
        $total->total_flag = true;
        $total->sub_total_flag = true;
        $total->title = "合計";
        $total->order_receive_quantity = $subTotals->sum('order_receive_quantity');
        $total->order_receive_amount = $subTotals->sum('order_receive_amount');
        return $total;
    }

    private function sortByDefAndParams($params)
    {
        $sortElement = [
            ['customer_cd', 'asc'],
            ['specify_deadline', 'asc'],
            ['order_receive_number', 'asc'],
            ['sub_total_flag', 'asc'],
        ];
        $sortElement = parent::sortByParams($sortElement, $params);
        $this->data = $this->data->sortBy($sortElement);
    }
}
