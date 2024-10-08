<?php

namespace App\Repositories\Analyse\AnaSearchSale;

use App\Models\TrnSaleBreakdown;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;

class AnaSearchSaleRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
{
    const DEF_SELECT = [
        'mt_customers.customer_cd',
        'trn_sale_headers.sale_date',
        'trn_order_receive_headers.order_receive_number',
        'trn_sale_headers.sale_number',
        'trn_sale_headers.bk_customer_name',
        'mt_delivery_destinations.delivery_destination_id',
        'trn_sale_headers.bk_delivery_destination_name',
        'trn_sale_details.item_name',
        'mt_colors.color_cd',
        'mt_colors.color_name',
        'mt_sizes.size_name',
        'trn_sale_breakdowns.order_receive_quantity as sale_quantity',
        'trn_sale_details.sale_price',
        'trn_sale_headers.slip_memo',
        'mt_shipping_companies.shipping_company_name',
        'trn_shippings.shipping_document_numbers',
        'trn_shippings.piece_number',
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
        $query = TrnSaleBreakdown::select(...self::DEF_SELECT)
            // 売上
            ->leftJoin('trn_sale_details', 'trn_sale_details.id', '=', 'trn_sale_breakdowns.trn_sale_detail_id')
            ->leftJoin('trn_sale_headers', 'trn_sale_headers.id', '=', 'trn_sale_details.trn_sale_header_id')
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
            // 受注
            ->leftJoin('trn_order_receive_headers', 'trn_order_receive_headers.id', '=', 'trn_sale_headers.trn_order_receive_header_id')
            // 出荷
            ->leftJoin('trn_shippings', function ($join) {
                $join
                    ->on('trn_shippings.specify_deadline', '=', 'trn_sale_headers.sale_date')
                    ->on('trn_shippings.trn_order_receive_header_id', '=', 'trn_sale_headers.trn_order_receive_header_id');
            })
            // 運送
            ->leftJoin('mt_shipping_companies', 'mt_shipping_companies.id', '=', 'trn_shippings.mt_shipping_company_id');
        return $query;
    }

    private function filter($params, $query)
    {
        $query = parent::filterByValue($params, $query, 'mt_customers', 'customer_cd');
        $query = parent::filterByDate($params, $query, 'trn_sale_headers', 'sale_date');
        $query = parent::filterByValue($params, $query, 'trn_order_receive_headers', 'order_receive_number');
        $query = parent::filterByValue($params, $query, 'trn_sale_headers', 'sale_number');
        $query = parent::filterByValue($params, $query, 'mt_delivery_destinations', 'delivery_destination_id');
        $query = parent::filterByValue($params, $query, 'mt_items', 'other_part_number');
        $query = parent::filterByValue($params, $query, 'trn_sale_headers', 'slip_memo');
        $query = parent::filterByValue($params, $query, 'trn_shippings', 'shipping_document_numbers');
        return $query;
    }

    private function order($query)
    {
        $query
            ->orderBy('trn_sale_headers.sale_date', 'asc')
            ->orderBy('trn_order_receive_headers.order_receive_number', 'asc')
            ->orderBy('trn_sale_headers.sale_number', 'asc')
            ->orderBy('mt_customers.customer_cd', 'asc')
            ->orderBy('mt_delivery_destinations.delivery_destination_id', 'asc')
            ->orderBy('mt_items.item_name', 'asc')
            ->orderBy('mt_colors.color_cd', 'asc')
            ->orderBy('mt_sizes.size_cd', 'asc');
        return $query;
    }
}
