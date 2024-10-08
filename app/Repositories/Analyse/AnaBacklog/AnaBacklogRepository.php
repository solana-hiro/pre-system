<?php

namespace App\Repositories\Analyse\AnaBacklog;

use App\Models\TrnOrderReceiveBreakdown;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AnaBacklogRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
{
    const DEF_SELECT = [
        'mt_item_classes.item_class_cd',
        'mt_item_classes.item_class_name',
        'mt_items.item_cd',
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
        // 小計/合計があるためSQLではなく取得後にソートするのでorderは不要
        // $query = parent::orderByButton($params, $query);
        // $query = $this->order($query);
        return $query;
    }

    private function query()
    {
        $select = [...self::DEF_SELECT, ...$this->sumSql()];
        $query = TrnOrderReceiveBreakdown::select(...$select)
            // 受注
            ->leftJoin('trn_order_receive_details', 'trn_order_receive_details.id', '=', 'trn_order_receive_breakdowns.trn_order_receive_detail_id')
            ->leftJoin('trn_order_receive_headers', 'trn_order_receive_headers.id', '=', 'trn_order_receive_details.trn_order_receive_header_id')
            // 商品
            ->leftJoin('mt_items', 'mt_items.id', '=', 'trn_order_receive_details.mt_item_id')
            // 商品分類1
            ->leftJoin('mt_member_site_items', 'mt_member_site_items.id', '=', 'mt_items.mt_member_site_item_id')
            ->leftJoin('mt_item_classes', 'mt_item_classes.id', '=', 'mt_member_site_items.mt_item_class1_id')
            // Color・Size
            ->leftJoin('mt_stock_keeping_units', 'mt_stock_keeping_units.id', '=', 'trn_order_receive_breakdowns.mt_stock_keeping_unit_id')
            ->leftJoin('mt_colors', 'mt_colors.id', '=', 'mt_stock_keeping_units.mt_color_id')
            ->leftJoin('mt_sizes', 'mt_sizes.id', '=', 'mt_stock_keeping_units.mt_size_id')
            // 倉庫
            ->leftJoin('mt_warehouses', 'mt_warehouses.id', '=', 'trn_order_receive_headers.mt_warehouse_id');
        return $query;
    }

    private function sumSql()
    {
        return [
            DB::raw('sum(trn_order_receive_breakdowns.order_receive_quantity) as total_order_receive_quantity'),
        ];
    }

    private function group($query)
    {
        return $query = $query->groupBy(...self::DEF_SELECT);
    }

    private function filter($params, $query)
    {
        $query = parent::filterByDate($params, $query, 'trn_order_receive_details', 'specify_deadline');
        $query = parent::filterByValue($params, $query, 'mt_warehouses', 'warehouse_cd');
        return $query;
    }
}
