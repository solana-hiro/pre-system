<?php

namespace App\Repositories\Analyse\AnaCheckShipping;

use App\Models\TrnOrderReceiveDetail;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;

class AnaCheckShippingRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
{
    const DEF_SELECT = [
        'trn_order_receive_headers.order_receive_number',
        'mt_customers.customer_cd',
        'trn_order_receive_headers.bk_customer_name',
        'mt_delivery_destinations.delivery_destination_id',
        'trn_order_receive_headers.bk_delivery_destination_name',
        'picking_users.user_cd as picking_user_cd',
        'picking_users.user_name as picking_user_name',
        'last_picking_users.user_cd as last_picking_user_cd',
        'last_picking_users.user_name as last_picking_user_name',
        'inspection_users.user_cd as inspection_user_cd',
        'inspection_users.user_name as inspection_user_name',
        'trn_sale_headers.delivery_slip_return_slip_output_flg',
        'mt_roots.root_cd',
        'mt_roots.root_name',
        'mt_order_receive_sticky_notes.sticky_note_name',
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
        $query = TrnOrderReceiveDetail::select(...self::DEF_SELECT)
            // 受注
            ->leftJoin('trn_order_receive_headers', 'trn_order_receive_headers.id', '=', 'trn_order_receive_details.trn_order_receive_header_id')
            // 得意先
            ->leftJoin('mt_customers', 'mt_customers.id', '=', 'trn_order_receive_headers.mt_customer_id')
            // 納品先
            ->leftJoin('mt_delivery_destinations', 'mt_delivery_destinations.id', '=', 'trn_order_receive_headers.mt_delivery_destination_id')
            // 付箋
            ->leftJoin('mt_order_receive_sticky_notes', 'mt_order_receive_sticky_notes.id', '=', 'trn_order_receive_details.mt_order_receive_sticky_note_id')
            // 売上
            ->leftJoin('trn_sale_headers', 'trn_sale_headers.trn_order_receive_header_id', '=', 'trn_order_receive_headers.id')
            // ルート
            ->leftJoin('mt_roots', 'mt_roots.id', '=', 'trn_order_receive_headers.mt_root_id')
            // 出荷検品
            ->leftJoin('trn_shipping_inspection_headers', function ($join) {
                $join
                    ->on('trn_shipping_inspection_headers.trn_order_receive_header_id', '=', 'trn_order_receive_details.trn_order_receive_header_id')
                    ->on('trn_shipping_inspection_headers.specify_deadline', '=', 'trn_order_receive_details.specify_deadline');
            })
            // 各種ユーザ
            ->leftJoin('mt_users as picking_users', 'picking_users.id', '=', 'trn_shipping_inspection_headers.mt_user_picking_manager_id')
            ->leftJoin('mt_users as last_picking_users', 'last_picking_users.id', '=', 'trn_shipping_inspection_headers.mt_user_last_picking_manager_id')
            ->leftJoin('mt_users as inspection_users', 'inspection_users.id', '=', 'trn_shipping_inspection_headers.mt_user_inspection_manager_id');
        return $query;
    }

    private function filter($params, $query)
    {
        $query = parent::filterByDate($params, $query, 'trn_order_receive_details', 'specify_deadline');
        $query = parent::filterByValue($params, $query, 'mt_roots', 'root_cd');
        return $query;
    }

    private function order($query)
    {
        $query
            ->orderBy('mt_customers.customer_cd', 'asc')
            ->orderBy('mt_delivery_destinations.delivery_destination_id', 'asc');
        return $query;
    }
}
