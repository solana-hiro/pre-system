<?php

namespace App\Repositories\Analyse\AnaSearchRecivedOrder;

use App\Models\TrnOrderReceiveBreakdown;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;

class AnaSearchRecivedOrderRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
{
    const DEF_SELECT = [
        'mt_customers.customer_cd',
        'trn_order_receive_headers.order_receive_number',
        'trn_order_receive_headers.order_receive_date',
        'trn_order_receive_details.specify_deadline',
        'mt_customers.customer_name',
        'mt_delivery_destinations.delivery_destination_id',
        'trn_order_receive_headers.bk_delivery_destination_name',
        'trn_order_receive_headers.process_kbn',
        'trn_order_receive_details.order_line_no',
        'trn_order_receive_details.item_name',
        'mt_colors.color_cd',
        'mt_colors.color_name',
        'mt_sizes.size_name',
        'trn_order_receive_breakdowns.order_receive_quantity',
        'trn_sale_breakdowns.order_receive_quantity as sale_quantity',
        'trn_order_receive_details.memo_2',
        'mt_order_receive_sticky_notes.sticky_note_name',
        'trn_order_receive_headers.slip_memo',
        'trn_order_receive_headers.order_number',
        'mt_users.user_name',
        'trn_order_receive_details.order_receive_finish_flg',
        'trn_order_receive_details.picking_list_output_flg',
        'trn_order_receive_headers.ec_order_receive_number',
        'trn_order_receive_headers.keep_guidance_expiration_flg',
        'mt_customer_classes.customer_class_cd',
        'mt_customer_classes.customer_class_name',
        'trn_order_receive_headers.postage',
        'trn_order_receive_headers.settlement_method',
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
            // 得意先・得意先区分
            ->leftJoin('mt_customers', 'mt_customers.id', '=', 'trn_order_receive_headers.mt_customer_id')
            ->leftJoin('mt_customer_classes', 'mt_customer_classes.id', '=', 'trn_order_receive_headers.mt_customer_class_id')
            // 納品先
            ->leftJoin('mt_delivery_destinations', 'mt_delivery_destinations.id', '=', 'trn_order_receive_headers.mt_delivery_destination_id')
            // 商品
            ->leftJoin('mt_items', 'mt_items.id', '=', 'trn_order_receive_details.mt_item_id')
            // Color・Size
            ->leftJoin('mt_stock_keeping_units', 'mt_stock_keeping_units.id', '=', 'trn_order_receive_breakdowns.mt_stock_keeping_unit_id')
            ->leftJoin('mt_colors', 'mt_colors.id', '=', 'mt_stock_keeping_units.mt_color_id')
            ->leftJoin('mt_sizes', 'mt_sizes.id', '=', 'mt_stock_keeping_units.mt_size_id')
            // 付箋
            ->leftJoin('mt_order_receive_sticky_notes', 'mt_order_receive_sticky_notes.id', '=', 'trn_order_receive_details.mt_order_receive_sticky_note_id')
            // 売上
            ->leftJoin('trn_sale_details', 'trn_sale_details.trn_order_receive_detail_id', '=', 'trn_order_receive_details.id')
            ->leftJoin('trn_sale_breakdowns', function ($join) {
                $join
                    ->on('trn_sale_breakdowns.trn_sale_detail_id', '=', 'trn_sale_details.id')
                    ->on('trn_sale_breakdowns.mt_stock_keeping_unit_id', '=', 'trn_order_receive_breakdowns.mt_stock_keeping_unit_id');
            })
            // 入力者
            ->leftJoin('mt_users', 'mt_users.id', '=', 'trn_order_receive_headers.mt_user_input_id');
        return $query;
    }

    private function filter($params, $query)
    {
        $query = parent::filterByValue($params, $query, 'mt_customers', 'customer_cd');
        $query = parent::filterByValue($params, $query, 'trn_order_receive_headers', 'order_receive_number');
        $query = parent::filterByDate($params, $query, 'trn_order_receive_headers', 'order_receive_date');
        $query = parent::filterByDate($params, $query, 'trn_order_receive_details', 'specify_deadline');
        $query = parent::filterByValue($params, $query, 'mt_delivery_destinations', 'delivery_destination_id');
        $query = parent::filterByValue($params, $query, 'mt_items', 'other_part_number');
        $query = parent::filterByValue($params, $query, 'mt_colors', 'color_cd');
        $query = parent::filterByValue($params, $query, 'mt_sizes', 'size_name');
        $query = parent::filterByValue($params, $query, 'trn_order_receive_headers', 'slip_memo');
        $query = parent::filterByValue($params, $query, 'trn_order_receive_headers', 'order_number');
        $query = parent::filterByValue($params, $query, 'trn_order_receive_details', 'order_receive_finish_flg');
        $query = parent::filterByValue($params, $query, 'trn_order_receive_headers', 'ec_order_receive_number');
        $query = parent::filterByValue($params, $query, 'trn_order_receive_headers', 'keep_guidance_expiration_flg');
        $query = parent::filterByValue($params, $query, 'mt_customer_classes', 'customer_class_cd');
        $query = parent::filterByValue($params, $query, 'trn_order_receive_headers', 'settlement_method');
        return $query;
    }

    private function order($query)
    {
        $query
            ->orderBy('trn_order_receive_headers.order_receive_number', 'asc')
            ->orderBy('trn_order_receive_headers.order_receive_date', 'asc')
            ->orderBy('trn_order_receive_details.specify_deadline', 'asc')
            ->orderBy('trn_order_receive_details.order_line_no', 'asc')
            ->orderBy('mt_colors.color_cd', 'asc')
            ->orderBy('mt_sizes.size_cd', 'asc');
        return $query;
    }
}
