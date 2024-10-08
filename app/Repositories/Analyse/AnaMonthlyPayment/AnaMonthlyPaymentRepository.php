<?php

namespace App\Repositories\Analyse\AnaMonthlyPayment;

use App\Models\TrnPaymentDetail;
use App\Repositories\Analyse\AnalyseRepositoryBase;
use App\Repositories\Analyse\AnalyseRepositoryInterface;

class AnaMonthlyPaymentRepository extends AnalyseRepositoryBase implements AnalyseRepositoryInterface
{
    // 回収支払日1除く
    const DEF_SELECT = [
        'def_payment_kbns.payment_kbn_name',
        'def_payment_kbns.payment_kbn_cd',
        'mt_banks.bank_name',
        'mt_customers.customer_cd',
        'mt_customers.customer_name',
        'trn_payment_details.amount',
        'trn_payment_headers.payment_date',
        'trn_payment_details.memo1',
        'trn_payment_details.memo2',
        'trn_payment_headers.payment_number',
        'trn_payment_headers.collect_pay_date',
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
            ->leftJoin('def_payment_kbns', 'def_payment_kbns.id', '=', 'trn_payment_details.def_payment_kbn_id')
            ->leftJoin('mt_banks', 'mt_banks.id', '=', 'trn_payment_details.mt_bank_id')
            ->leftJoin('mt_customers', 'mt_customers.id', '=', 'trn_payment_headers.mt_customer_id');
        return $query;
    }

    private function filter($params, $query)
    {
        $query = parent::filterByValue($params, $query, 'def_payment_kbns', 'payment_kbn_cd');
        $query = parent::filterByValue($params, $query, 'mt_customers', 'customer_cd');
        $query = parent::filterByDate($params, $query, 'trn_payment_headers', 'payment_date');
        return $query;
    }
}
