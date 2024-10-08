<?php

namespace App\Services;

use App\Models\TrnOrderReceiveBreakdown;
use App\Repositories\Analyse\AnaCheckReceivedOrder\AnaCheckReceivedOrderRepository;

/**
 * 受注確認 サービス
 */
class AnaCheckReceivedOrderService extends AnalyseServiceBase
{
    private AnaCheckReceivedOrderRepository $repository;
    private $data;

    public function __construct()
    {
        $this->repository = new AnaCheckReceivedOrderRepository();
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
        $groupItems->each(function ($orderReceiveNumberItems) {
            $this->data->push($this->getSubTotal($orderReceiveNumberItems));
        });
    }

    private function groupBy()
    {
        return $this->data->groupBy([
            'order_receive_number',
        ]);
    }

    private function getSubTotal($items)
    {
        $subTotal = new TrnOrderReceiveBreakdown();
        $subTotal->sub_total_flag = true;
        $subTotal->title = "【計】{$items->first()->order_receive_number}";
        $subTotal->order_number = $items->max('order_number');
        $subTotal->specify_deadline = $items->max('specify_deadline');
        $subTotal->order_receive_quantity = $items->sum('order_receive_quantity');
        $subTotal->amount = $this->getAmount($items);
        return $subTotal;
    }

    private function getAmount($items)
    {
        $amounts = $items->map(function ($item) {
            return $item->order_receive_quantity * $item->order_receive_price;
        });
        return $amounts->sum();
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
        $total->amount = $subTotals->sum('amount');
        return $total;
    }

    private function sortByDefAndParams($params)
    {
        $sortElement = [
            ['order_number', 'asc'],
            ['specify_deadline', 'asc'],
            ['sub_total_flag', 'asc'],
        ];
        $sortElement = parent::sortByParams($sortElement, $params);
        $this->data = $this->data->sortBy($sortElement);
    }
}
