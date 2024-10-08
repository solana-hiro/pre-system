<?php

namespace App\Repositories\Analyse\AnaSearchLargeReceivedOrder;

use App\Models\TrnOrderReceiveBreakdown;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AnaSearchLargeReceivedOrderRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
{
    const DEF_SELECT = [
        'trn_order_receive_details.specify_deadline',
        'trn_order_receive_headers.order_receive_number',
        'mt_customers.customer_cd',
        'trn_order_receive_headers.bk_customer_name',
        'mt_delivery_destinations.delivery_destination_id',
        'trn_order_receive_headers.bk_delivery_destination_name',
        'trn_order_receive_details.item_name',
        'mt_colors.color_cd',
        'mt_colors.color_name',
        'mt_sizes.size_name',
        'trn_order_receive_breakdowns.order_receive_quantity',
        'trn_order_receive_headers.slip_memo',
        'mt_order_receive_sticky_notes.sticky_note_name',
        'trn_order_receive_headers.order_number',
        'mt_order_receive_sticky_notes.branch_number',
        'def_sticky_note_kinds.sticky_note_kind_cd',
        'mt_roots.root_cd',
        'mt_roots.root_name',
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
            // 得意先
            ->leftJoin('mt_customers', 'mt_customers.id', '=', 'trn_order_receive_headers.mt_customer_id')
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
            ->leftJoin('def_sticky_note_kinds', 'def_sticky_note_kinds.id', '=', 'mt_order_receive_sticky_notes.def_sticky_note_kind_id')
            // ルート
            ->leftJoin('mt_roots', 'mt_roots.id', '=', 'trn_order_receive_headers.mt_root_id');
        return $query;
    }

    private function sumSql()
    {
        return [
            DB::raw('trn_order_receive_breakdowns.order_receive_quantity * trn_order_receive_details.order_receive_price as order_receive_amount'),
        ];
    }

    private function filter($params, $query)
    {
        $query = parent::filterByDate($params, $query, 'trn_order_receive_details', 'specify_deadline');
        $query = parent::filterByValue($params, $query, 'trn_order_receive_headers', 'slip_memo');
        $query = parent::filterByValue($params, $query, 'mt_roots', 'root_cd');
        return $query;
    }
}
