<?php

namespace App\Repositories\Analyse\AnaCheckReturn;

use App\Models\TrnSaleBreakdown;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AnaCheckReturnRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
{
    const DEF_SELECT = [
        'trn_sale_headers.sale_date',
        'trn_sale_headers.sale_return_kbn',
        'def_sale_kbns.sale_kbn_cd',
        'trn_sale_headers.sale_number',
        'mt_warehouses.warehouse_name',
        'trn_sale_headers.slip_memo',
        'mt_customers.customer_cd',
        'trn_sale_headers.bk_customer_name',
        'mt_delivery_destinations.delivery_destination_id',
        'trn_sale_headers.bk_delivery_destination_name',
        'mt_items.other_part_number',
        'mt_items.item_cd',
        'trn_sale_details.item_name',
        'mt_colors.color_cd',
        'mt_colors.color_name',
        'mt_sizes.size_cd',
        'mt_sizes.size_name',
        'trn_sale_breakdowns.order_receive_quantity as sale_quantity',
        'trn_sale_details.sale_price', // 売上金額計算用
        'trn_sale_details.retail_price', // 上代金額計算用
        'mt_users.user_name',
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
        $query = $this->filter($params, $query);
        $query = parent::orderByButton($params, $query);
        $query = $this->order($query);
        return $query;
    }

    private function query()
    {
        $select = [...self::DEF_SELECT, ...$this->sumSql()];
        $query = TrnSaleBreakdown::select(...$select)
            // 売上
            ->leftJoin('trn_sale_details', 'trn_sale_details.id', '=', 'trn_sale_breakdowns.trn_sale_detail_id')
            ->leftJoin('trn_sale_headers', 'trn_sale_headers.id', '=', 'trn_sale_details.trn_sale_header_id')
            ->leftJoin('def_sale_kbns', 'def_sale_kbns.id', '=', 'trn_sale_details.def_sale_kbn_id')
            // 得意先
            ->leftJoin('mt_customers', 'mt_customers.id', '=', 'trn_sale_headers.mt_customer_id')
            // 納品先
            ->leftJoin('mt_delivery_destinations', 'mt_delivery_destinations.id', '=', 'trn_sale_headers.mt_delivery_destination_id')
            // 商品
            ->leftJoin('mt_items', 'mt_items.id', '=', 'trn_sale_details.mt_item_id')
            // Color・Size
            ->leftJoin('mt_stock_keeping_units', 'mt_stock_keeping_units.id', '=', 'trn_sale_breakdowns.mt_stock_keeping_unit_id')
            ->leftJoin('mt_colors', 'mt_colors.id', '=', 'mt_stock_keeping_units.mt_color_id')
            ->leftJoin('mt_sizes', 'mt_sizes.id', '=', 'mt_stock_keeping_units.mt_size_id')
            // 倉庫
            ->leftJoin('mt_warehouses', 'mt_warehouses.id', '=', 'trn_sale_headers.mt_warehouse_id')
            // 入力者
            ->leftJoin('mt_users', 'mt_users.id', '=', 'trn_sale_headers.mt_user_input_id');
        return $query;
    }

    private function sumSql()
    {
        return [
            DB::raw('trn_sale_breakdowns.order_receive_quantity * trn_sale_details.sale_price as sale_amount'),
            DB::raw('trn_sale_breakdowns.order_receive_quantity * trn_sale_details.retail_price as retail_amount'),
        ];
    }

    private function filter($params, $query)
    {
        $query = parent::filterByDate($params, $query, 'trn_sale_headers', 'sale_date');
        $query = parent::filterByValue($params, $query, 'def_sale_kbns', 'sale_kbn_cd');
        $query = parent::filterByValue($params, $query, 'trn_sale_headers', 'sale_number');
        $query = parent::filterByValue($params, $query, 'mt_warehouses', 'warehouse_name');
        $query = parent::filterByValue($params, $query, 'trn_sale_headers', 'slip_memo');
        $query = parent::filterByValue($params, $query, 'mt_customers', 'customer_cd');
        $query = parent::filterByValue($params, $query, 'mt_items', 'other_part_number');
        $query = parent::filterByValue($params, $query, 'mt_items', 'item_cd');
        $query = parent::filterByValue($params, $query, 'trn_sale_details', 'item_name');
        return $query;
    }

    private function order($query)
    {
        $query
            ->orderBy('trn_sale_headers.sale_date', 'asc');
        return $query;
    }
}
