<?php

namespace App\Repositories\Analyse\AnaPaymentByCustomer;

use App\Models\TrnPaymentDetail;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;

class AnaPaymentByCustomerRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
{
    const DEF_SELECT = [
        'mt_customers.customer_cd',
        'mt_customers.customer_name',
        'trn_payment_headers.payment_date',
        'trn_payment_details.amount',
        'def_payment_kbns.payment_kbn_name',
        'trn_payment_details.memo1',
        'trn_payment_details.memo2',
        'mt_banks.bank_name',
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
        $query = TrnPaymentDetail::select(...self::DEF_SELECT)
            ->leftJoin('trn_payment_headers', 'trn_payment_headers.id', '=', 'trn_payment_details.trn_payment_header_id')
            ->leftJoin('mt_customers', 'mt_customers.id', '=', 'trn_payment_headers.mt_customer_id')
            ->leftJoin('def_payment_kbns', 'def_payment_kbns.id', '=', 'trn_payment_details.def_payment_kbn_id')
            ->leftJoin('mt_banks', 'mt_banks.id', '=', 'trn_payment_details.mt_bank_id')
            ->leftJoin('mt_users', 'mt_users.id', '=', 'trn_payment_details.mt_user_last_update_id');
        return $query;
    }

    private function filter($params, $query)
    {
        $query = parent::filterByValue($params, $query, 'mt_customers', 'customer_cd');
        $query = parent::filterByDate($params, $query, 'trn_payment_headers', 'payment_date');
        return $query;
    }
}
