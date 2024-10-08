<?php

namespace App\Repositories\Analyse\AnaOutstandingOrder;

use App\Models\TrnOrderDetail;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AnaOutstandingOrderRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
{
    const DEF_SELECT = [
        'mt_item_classes.item_class_cd',
        'mt_item_classes.item_class_name',
        'mt_items.other_part_number',
        'mt_colors.color_cd',
        'mt_colors.color_name',
        'mt_sizes.size_cd',
        'mt_sizes.size_name',
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
        $data = $this
            ->common($params)
            ->get();
        return $data;
    }

    private function common($params)
    {
        $query = $this->query();
        $query = $this->group($query);
        $query = $this->filter($params, $query);
        // $query = parent::orderByButton($params, $query);
        // $query = $this->order($query);
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
            // 仕入先
            ->leftJoin('mt_suppliers', 'mt_suppliers.id', '=', 'trn_order_headers.mt_supplier_id')
            // 商品
            ->leftJoin('mt_items', 'mt_items.id', '=', 'trn_order_details.mt_item_id')
            // 商品分類1
            ->leftJoin('mt_member_site_items', 'mt_member_site_items.id', '=', 'mt_items.mt_member_site_item_id')
            ->leftJoin('mt_item_classes', 'mt_item_classes.id', '=', 'mt_member_site_items.mt_item_class1_id')
            // Color・Size
            ->leftJoin('mt_stock_keeping_units', 'mt_stock_keeping_units.id', '=', 'trn_shipment_breakdowns.mt_stock_keeping_unit_id')
            ->leftJoin('mt_colors', 'mt_colors.id', '=', 'mt_stock_keeping_units.mt_color_id')
            ->leftJoin('mt_sizes', 'mt_sizes.id', '=', 'mt_stock_keeping_units.mt_size_id');
        return $query;
    }

    private function sumSql()
    {
        return [
            DB::raw('sum(trn_shipment_breakdowns.order_quantity) as order_quantity'),
            DB::raw('max(trn_order_headers.order_date) as order_date'),
            DB::raw('max(trn_order_headers.specify_deadline) as specify_deadline'),
            DB::raw('max(trn_order_details.order_finish_flg) as order_finish_flg'),
            DB::raw('max(trn_order_details.memo) as memo'),
            DB::raw('max(mt_suppliers.supplier_cd) as supplier_cd'),
        ];
    }

    private function group($query)
    {
        return $query = $query->groupBy(...self::DEF_SELECT);
    }

    private function filter($params, $query)
    {
        $query = parent::filterByDate($params, $query, 'trn_order_headers', 'order_date');
        $query = parent::filterByDate($params, $query, 'trn_order_headers', 'specify_deadline');
        $query = parent::filterByValue($params, $query, 'trn_order_details', 'order_finish_flg');
        $query = parent::filterByValue($params, $query, 'trn_order_details', 'memo');
        $query = parent::filterByValue($params, $query, 'mt_suppliers', 'supplier_cd');
        return $query;
    }

    // private function order($query)
    // {
    //     $query->orderBy('trn_order_headers.specify_deadline', 'asc');
    //     return $query;
    // }
}
