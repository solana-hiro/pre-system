<?php

namespace App\Repositories\Analyse\AnaCheckOutstandingOrderAndBacklog;

use App\Models\MtEndOfMonthStockLogs;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AnaCheckOutstandingOrderAndBacklogRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
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
        $query = $this
            ->common($params)
            ->get();
        return $query;
    }

    private function common($params)
    {
        $query = $this->query();
        $query = $this->group($query);
        $query = $this->filter($params, $query);
        // 小計/合計ありのためCollectionをソート
        // $query = parent::orderByButton($params, $query);
        // $query = $this->order($query);
        return $query;
    }

    private function query()
    {
        $select = [...self::DEF_SELECT, ...$this->sumSql()];
        $query = MtEndOfMonthStockLogs::select(...$select)
            // 商品・Color・Size
            ->leftJoin('mt_stock_keeping_units', 'mt_stock_keeping_units.id', '=', 'mt_end_of_month_stock_logs.mt_stock_keeping_unit_id')
            ->leftJoin('mt_items', 'mt_items.id', '=', 'mt_stock_keeping_units.mt_item_id')
            ->leftJoin('mt_colors', 'mt_colors.id', '=', 'mt_stock_keeping_units.mt_color_id')
            ->leftJoin('mt_sizes', 'mt_sizes.id', '=', 'mt_stock_keeping_units.mt_size_id')
            // 商品分類1
            ->leftJoin('mt_member_site_items', 'mt_member_site_items.id', '=', 'mt_items.mt_member_site_item_id')
            ->leftJoin('mt_item_classes', 'mt_item_classes.id', '=', 'mt_member_site_items.mt_item_class1_id')
            // 倉庫
            ->leftJoin('mt_warehouses', 'mt_warehouses.id', '=', 'mt_end_of_month_stock_logs.mt_warehouse_id');
        return $query;
    }

    private function filter($params, $query)
    {
        $query = parent::filterByValue($params, $query, 'mt_item_classes', 'item_class_cd');
        $query = parent::filterByValue($params, $query, 'mt_items', 'other_part_number');
        $query = parent::filterByValue($params, $query, 'mt_colors', 'color_cd');
        $query = parent::filterByValue($params, $query, 'mt_sizes', 'size_cd');
        $query = parent::filterByValue($params, $query, 'mt_warehouses', 'warehouse_cd');
        return $query;
    }

    private function sumSql()
    {
        return [
            DB::raw('sum(mt_end_of_month_stock_logs.now_stock_quantity) as now_stock_quantity'),
            DB::raw('sum(mt_end_of_month_stock_logs.remaining_order_receive_quantity) as remaining_order_receive_quantity'),
            DB::raw('sum(mt_end_of_month_stock_logs.now_stock_quantity - mt_end_of_month_stock_logs.remaining_order_receive_quantity) as effective_stock_quantity'),
            DB::raw('sum(mt_end_of_month_stock_logs.remaining_order_warehousing_quantity) as remaining_order_warehousing_quantity'),
            DB::raw('sum(mt_end_of_month_stock_logs.now_stock_quantity - mt_end_of_month_stock_logs.remaining_order_receive_quantity + mt_end_of_month_stock_logs.remaining_order_warehousing_quantity) as restock_quantity'),
            // 出荷指示残数量
        ];
    }

    private function group($query)
    {
        return $query = $query->groupBy(...self::DEF_SELECT);
    }

    private function order($query)
    {
        $query
            ->orderBy('trn_order_receive_headers.now_stock_quantity', 'asc')
            ->orderBy('trn_order_receive_details.specify_deadline', 'asc');
        return $query;
    }
}
