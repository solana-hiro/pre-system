<?php

namespace App\Services;

use App\Models\TrnOrderReceiveBreakdown;
use App\Repositories\Analyse\AnaCheckOutstandingOrderAndBacklog\AnaCheckOutstandingOrderAndBacklogRepository;

/**
 * 受注確認 サービス
 */
class AnaCheckOutstandingOrderAndBacklogService extends AnalyseServiceBase
{
    private AnaCheckOutstandingOrderAndBacklogRepository $repository;
    private $data;

    public function __construct()
    {
        $this->repository = new AnaCheckOutstandingOrderAndBacklogRepository();
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
        $groupItems->each(function ($itemClassCdItems) {
            $itemClassCdItems->each(function ($orderPartNumberItems) {
                $this->data->push($this->getSubTotal($orderPartNumberItems));
            });
        });
    }

    private function groupBy()
    {
        return $this->data->groupBy([
            'item_class_cd',
            'other_part_number',
        ]);
    }

    private function getSubTotal($items)
    {
        $subTotal = new TrnOrderReceiveBreakdown();
        $subTotal->sub_total_flag = true;
        $subTotal->title = "【計】{$items->first()->item_class_cd} {$items->first()->item_class_name} {$items->first()->other_part_number}";
        $subTotal->item_class_cd = $items->max('item_class_cd');
        $subTotal->other_part_number = $items->max('other_part_number');
        $subTotal->color_cd = $items->max('color_cd');
        $subTotal->size_cd = $items->max('size_cd');
        $subTotal->now_stock_quantity = $items->sum('now_stock_quantity');
        $subTotal->remaining_order_receive_quantity = $items->sum('remaining_order_receive_quantity');
        $subTotal->effective_stock_quantity = $items->sum('effective_stock_quantity');
        $subTotal->remaining_order_warehousing_quantity = $items->sum('remaining_order_warehousing_quantity');
        $subTotal->restock_quantity = $items->sum('restock_quantity');
        // 出荷指示残数量
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
        $total->now_stock_quantity = $subTotals->sum('now_stock_quantity');
        $total->remaining_order_receive_quantity = $subTotals->sum('remaining_order_receive_quantity');
        $total->effective_stock_quantity = $subTotals->sum('effective_stock_quantity');
        $total->remaining_order_warehousing_quantity = $subTotals->sum('remaining_order_warehousing_quantity');
        $total->restock_quantity = $subTotals->sum('restock_quantity');
        // 出荷指示残数量
        return $total;
    }

    private function sortByDefAndParams($params)
    {
        $sortElement = [
            ['item_class_cd', 'asc'],
            ['other_part_number', 'asc'],
            ['color_cd', 'asc'],
            ['size_cd', 'asc'],
            ['sub_total_flag', 'asc'],
        ];
        $sortElement = parent::sortByParams($sortElement, $params);
        $this->data = $this->data->sortBy($sortElement);
    }
}
