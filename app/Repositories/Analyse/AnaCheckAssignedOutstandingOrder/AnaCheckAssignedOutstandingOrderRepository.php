<?php

namespace App\Repositories\Analyse\AnaCheckAssignedOutstandingOrder;

use App\Models\TrnOrderDetail;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AnaCheckAssignedOutstandingOrderRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
{
    const DEF_SELECT = [
        'trn_order_headers.order_number',
        'trn_order_headers.specify_deadline',
        'mt_items.item_cd',
        'mt_items.item_name',
        'mt_colors.color_cd',
        'mt_colors.color_name',
        'mt_sizes.size_cd',
        'mt_sizes.size_name',
        // 割当済み発注数
        'trn_order_details.order_finish_flg',
    ];

    public function search($params)
    {
        $data = $this
            ->common($params)
            ->get();
        return $data;
    }

    public function csv($params)
    {
        $query = $this
            ->common($params);
        return $query;
    }

    private function common($params)
    {
        $query = $this->query();
        $query = $this->group($query);
        $query = $this->filter($params, $query);
        $query = parent::orderByButton($params, $query);
        $query = $this->order($query);
        return $query;
    }

    private function query()
    {
        $select = [...self::DEF_SELECT, ...$this->sumSql()];
        $query = TrnOrderDetail::select(...$select)
            // 発注
            ->leftJoin('trn_order_headers', 'trn_order_headers.id', '=', 'trn_order_details.trn_order_header_id')
            ->leftJoin('trn_shipment_details', 'trn_shipment_details.trn_order_detail_id', '=', 'trn_order_details.id')
            ->leftJoin('trn_shipment_breakdowns', 'trn_shipment_breakdowns.trn_shipment_detail_id', '=', 'trn_shipment_details.id')
            // 商品
            ->leftJoin('mt_items', 'mt_items.id', '=', 'trn_order_details.mt_item_id')
            // Color・Size
            ->leftJoin('mt_stock_keeping_units', 'mt_stock_keeping_units.id', '=', 'trn_shipment_breakdowns.mt_stock_keeping_unit_id')
            ->leftJoin('mt_colors', 'mt_colors.id', '=', 'mt_stock_keeping_units.mt_color_id')
            ->leftJoin('mt_sizes', 'mt_sizes.id', '=', 'mt_stock_keeping_units.mt_size_id');
        return $query;
    }

    private function sumSql()
    {
        return [
            DB::raw('sum(trn_shipment_breakdowns.order_quantity) as total_order_quantity'),
        ];
    }

    private function group($query)
    {
        return $query = $query->groupBy(...self::DEF_SELECT);
    }

    private function filter($params, $query)
    {
        $query = parent::filterByDate($params, $query, 'trn_order_headers', 'specify_deadline');
        $query = parent::filterByValue($params, $query, 'mt_items', 'item_cd');
        $query = parent::filterByValue($params, $query, 'trn_order_details', 'order_finish_flg');
        return $query;
    }

    private function order($query)
    {
        $query
            ->orderBy('mt_items.item_cd', 'asc')
            ->orderBy('mt_colors.color_cd', 'asc')
            ->orderBy('mt_sizes.size_cd', 'asc')
            ->orderBy('trn_order_headers.specify_deadline', 'asc');
        return $query;
    }
}
