<?php

namespace App\Repositories\Analyse\AnaReturnAfterPayment;

use App\Models\TrnSaleHeader;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;

class AnaReturnAfterPaymentRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
{
    const DEF_SELECT = [
        'mt_customers.customer_cd',
        'trn_sale_headers.bk_customer_name',
        'trn_sale_headers.sale_date',
        'trn_sale_headers.id',
        'trn_sale_headers.all_total',
        'trn_sale_headers.slip_memo',
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
        // 小計/合計があるためSQLではなく取得後にソートするのでorderは不要
        // $query = parent::orderByButton($params, $query);
        // $query = $this->order($query);
        return $query;
    }

    private function query()
    {
        $query = TrnSaleHeader::select(...self::DEF_SELECT)
            ->leftJoin('mt_customers', 'mt_customers.id', '=', 'trn_sale_headers.mt_customer_id')
            ->leftJoin('mt_users', 'mt_users.id', '=', 'trn_sale_headers.mt_user_input_id');
        return $query;
    }

    private function filter($params, $query)
    {
        $query = parent::filterByValue($params, $query, 'mt_customers', 'customer_cd');
        $query = parent::filterByDate($params, $query, 'trn_sale_headers', 'sale_date');
        $query = parent::filterByValue($params, $query, 'trn_sale_headers', 'sale_return_kbn');
        $query = parent::filterByValue($params, $query, 'trn_sale_headers', 'payment_kbn');
        return $query;
    }
}
