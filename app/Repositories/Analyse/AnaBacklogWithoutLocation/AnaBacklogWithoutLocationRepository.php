<?php

namespace App\Repositories\Analyse\AnaBacklogWithoutLocation;

use App\Models\TrnOrderReceiveBreakdown;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;

class AnaBacklogWithoutLocationRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
{
    const DEF_SELECT = [
        'trn_order_receive_breakdowns.jan_cd',
        'trn_order_receive_breakdowns.order_receive_quantity',
        'trn_order_receive_breakdowns.shelf_number_1',
        'mt_customers.customer_cd',
        'trn_order_receive_headers.bk_customer_name',
        'mt_items.item_cd',
        'mt_items.item_name',
        'mt_colors.color_cd',
        'mt_colors.color_name',
        'mt_sizes.size_cd',
        'mt_sizes.size_name',
        'trn_order_receive_details.picking_list_output_flg',
        'trn_order_receive_details.specify_deadline',
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
        $query = $this->filter($params, $query);
        $query = parent::orderByButton($params, $query);
        $query = $this->order($query);
        return $query;
    }

    private function query()
    {
        $query = TrnOrderReceiveBreakdown::select(...self::DEF_SELECT)
            // 受注
            ->leftJoin('trn_order_receive_details', 'trn_order_receive_details.id', '=', 'trn_order_receive_breakdowns.trn_order_receive_detail_id')
            ->leftJoin('trn_order_receive_headers', 'trn_order_receive_headers.id', '=', 'trn_order_receive_details.trn_order_receive_header_id')
            // 得意先
            ->leftJoin('mt_customers', 'mt_customers.id', '=', 'trn_order_receive_headers.mt_customer_id')
            // 商品
            ->leftJoin('mt_items', 'mt_items.id', '=', 'trn_order_receive_details.mt_item_id')
            // Color・Size
            ->leftJoin('mt_stock_keeping_units', 'mt_stock_keeping_units.id', '=', 'trn_order_receive_breakdowns.mt_stock_keeping_unit_id')
            ->leftJoin('mt_colors', 'mt_colors.id', '=', 'mt_stock_keeping_units.mt_color_id')
            ->leftJoin('mt_sizes', 'mt_sizes.id', '=', 'mt_stock_keeping_units.mt_size_id');
        return $query;
    }

    private function filter($params, $query)
    {
        $query = parent::filterByDate($params, $query, 'trn_order_receive_details', 'specify_deadline');
        $query = parent::filterByValue($params, $query, 'mt_items', 'item_cd');
        $query = parent::filterByValue($params, $query, 'trn_order_receive_details', 'picking_list_output_flg');
        return $query;
    }

    private function order($query)
    {
        $query
            ->orderBy('mt_items.item_cd', 'asc')
            ->orderBy('mt_colors.color_cd', 'asc')
            ->orderBy('mt_sizes.size_cd', 'asc')
            ->orderBy('trn_order_receive_details.specify_deadline', 'asc')
            ->orderBy('trn_order_receive_breakdowns.order_receive_quantity', 'asc');
        return $query;
    }
}
