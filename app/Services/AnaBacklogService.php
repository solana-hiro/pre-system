<?php

namespace App\Services;

use App\Models\TrnOrderReceiveBreakdown;
use App\Repositories\Analyse\AnaBacklog\AnaBacklogRepository;
use \Illuminate\Support\Collection;

/**
 * 受注残 サービス
 */
class AnaBacklogService extends AnalyseServiceBase
{
    private AnaBacklogRepository $repository;
    private Collection $data;

    public function __construct()
    {
        $this->repository = new AnaBacklogRepository();
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
            $this->data->push($this->getSubTotal($itemClassCdItems));
        });
    }

    private function groupBy()
    {
        return $this->data->groupBy([
            'item_class_cd',
        ]);
    }

    private function getSubTotal($items)
    {
        $subTotal = new TrnOrderReceiveBreakdown();
        $subTotal->sub_total_flag = true;
        $subTotal->title = "【計】{$items->first()->item_class_cd}";
        $subTotal->item_class_cd = $items->first()->item_class_cd;
        $subTotal->other_part_number = $items->max('other_part_number');
        $subTotal->color_cd = $items->max('color_cd');
        $subTotal->size_cd = $items->max('size_cd');
        $subTotal->total_order_receive_quantity = $items->sum('total_order_receive_quantity');
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
        $total->total_order_receive_quantity = $subTotals->sum('total_order_receive_quantity');
        return $total;
    }

    private function sortByDefAndParams($params)
    {
        $sortElement = [
            ['item_class_cd', 'asc'],
            ['other_part_number', 'asc'],
            ['color_cd', 'desc'],
            ['size_cd', 'asc'],
            ['sub_total_flag', 'asc'],
        ];
        $sortElement = parent::sortByParams($sortElement, $params);
        $this->data = $this->data->sortBy($sortElement);
    }
}
