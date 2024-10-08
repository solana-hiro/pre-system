<?php

namespace App\Repositories\Analyse\AnaCheckShippingDocumentNumber;

use App\Consts\CommonConsts;
use App\Models\TrnSaleHeader;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;

class AnaCheckShippingDocumentNumberRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
{
    const DEF_SELECT = [
        'trn_sale_headers.sale_number',
        'trn_shippings.shipping_document_numbers',
        'trn_sale_headers.sale_date',
        'mt_customers.customer_cd',
        'trn_sale_headers.bk_customer_name',
        'mt_delivery_destinations.delivery_destination_id',
        'trn_sale_headers.bk_delivery_destination_name',
        'mt_shipping_companies.shipping_company_cd',
        'mt_shipping_companies.shipping_company_name',
        'trn_sale_headers.slip_memo',
    ];

    public function search($params)
    {
        $data = $this
            ->common($params)
            ->paginate(CommonConsts::ANALSE_PAGINATION)
            ->withQueryString();
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
        $query = TrnSaleHeader::select(...self::DEF_SELECT)
            // 出荷情報
            ->leftJoin('trn_shippings', function ($join) {
                $join
                    ->on('trn_shippings.specify_deadline', '=', 'trn_sale_headers.sale_date')
                    ->on('trn_shippings.trn_order_receive_header_id', '=', 'trn_sale_headers.trn_order_receive_header_id');
            })
            // 得意先
            ->leftJoin('mt_customers', 'mt_customers.id', '=', 'trn_sale_headers.mt_customer_id')
            // 納品先
            ->leftJoin('mt_delivery_destinations', 'mt_delivery_destinations.id', '=', 'trn_sale_headers.mt_delivery_destination_id')
            // 運送会社
            ->leftJoin('mt_shipping_companies', 'mt_shipping_companies.id', '=', 'trn_shippings.mt_shipping_company_id');
        return $query;
    }

    private function filter($params, $query)
    {
        $query = parent::filterByDate($params, $query, 'trn_sale_headers', 'sale_date');
        return $query;
    }

    private function order($query)
    {
        $query
            ->orderBy('trn_sale_headers.sale_number', 'asc')
            ->orderBy('mt_customers.customer_cd', 'asc')
            ->orderBy('mt_delivery_destinations.delivery_destination_id', 'asc');
        return $query;
    }
}
