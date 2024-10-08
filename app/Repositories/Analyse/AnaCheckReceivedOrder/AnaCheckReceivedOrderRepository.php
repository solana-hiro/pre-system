<?php

namespace App\Repositories\Analyse\AnaCheckReceivedOrder;

use App\Models\TrnOrderReceiveBreakdown;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;

class AnaCheckReceivedOrderRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
{
    const DEF_SELECT = [
        'trn_order_receive_headers.order_receive_number',
        'mt_customers.customer_cd',
        'mt_customers.customer_name',
        'mt_item_classes.item_class_name',
        'mt_items.other_part_number',
        'mt_colors.color_name',
        'mt_sizes.size_name',
        'trn_order_receive_breakdowns.order_receive_quantity',
        'trn_order_receive_details.order_receive_price', // 金額の計算用
        'mt_order_receive_sticky_notes.sticky_note_name',
        'trn_order_receive_headers.order_number',
        'trn_order_receive_headers.settlement_method',
        'trn_order_receive_details.specify_deadline', // ソート用
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
        $query = $this->filter($params, $query);
        // 小計/合計ありのためCollectionをソート
        // $query = parent::orderByButton($params, $query);
        // $query = $this->order($query);
        return $query;
    }

    private function query()
    {
        $query = TrnOrderReceiveBreakdown::select(...self::DEF_SELECT)
            // 受注情報
            ->leftJoin('trn_order_receive_details', 'trn_order_receive_details.id', '=', 'trn_order_receive_breakdowns.trn_order_receive_detail_id')
            ->leftJoin('trn_order_receive_headers', 'trn_order_receive_headers.id', '=', 'trn_order_receive_details.trn_order_receive_header_id')
            // 得意先
            ->leftJoin('mt_customers', 'mt_customers.id', '=', 'trn_order_receive_headers.mt_customer_id')
            // 商品
            ->leftJoin('mt_items', 'mt_items.id', '=', 'trn_order_receive_details.mt_item_id')
            // Color・Size
            ->leftJoin('mt_stock_keeping_units', 'mt_stock_keeping_units.id', '=', 'trn_order_receive_breakdowns.mt_stock_keeping_unit_id')
            ->leftJoin('mt_colors', 'mt_colors.id', '=', 'mt_stock_keeping_units.mt_color_id')
            ->leftJoin('mt_sizes', 'mt_sizes.id', '=', 'mt_stock_keeping_units.mt_size_id')
            // 付箋
            ->leftJoin('mt_order_receive_sticky_notes', 'mt_order_receive_sticky_notes.id', '=', 'trn_order_receive_details.mt_order_receive_sticky_note_id')
            // 商品分類2
            ->leftJoin('mt_member_site_items', 'mt_member_site_items.id', '=', 'mt_items.mt_member_site_item_id')
            ->leftJoin('mt_item_classes', 'mt_item_classes.id', '=', 'mt_member_site_items.mt_item_class2_id');
        return $query;
    }

    private function filter($params, $query)
    {
        $query = parent::filterByDate($params, $query, 'trn_order_receive_details', 'specify_deadline');
        $query = parent::filterByValue($params, $query, 'trn_order_receive_headers', 'order_number');
        $query = parent::filterByValue($params, $query, 'trn_order_receive_headers', 'ec_order_receive_number');
        return $query;
    }

    private function order($query)
    {
        $query
            ->orderBy('trn_order_receive_headers.order_receive_number', 'asc')
            ->orderBy('trn_order_receive_details.specify_deadline', 'asc');
        return $query;
    }
}
