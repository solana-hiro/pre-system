<?php
namespace App\Repositories\TrnPaymentHeader;

use App\Models\TrnPaymentHeader;
use App\Models\TrnPaymentDetail;
use App\Models\MtBillingAddress;
use App\Models\TrnDemandHeader;
use App\Models\TrnSaleHeader;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class TrnPaymentHeaderRepository implements TrnPaymentHeaderRepositoryInterface
{

    /**
     * 全件取得
     * @return Object
     */
    public function getAll() {
		$result = TrnPaymentHeader::get();
		return $result;
    }

    /**
     * 入金チェックリストの情報取得
     * @param array $params
     * @return Object
     */
     public function exportCheckList(array $params) {
     	$result = TrnPaymentHeader::get();
        return $result;
     }

    /**
     * 受取手形一覧表の情報取得
     * @param array $params
     * @return Object
     */
     public function exportBillReceipt(array $params) {
        /*
        （入金ヘッダ.入金日　＞= 絞込み条件の「対象年月」）が対象。
        対象年月は末尾として検索すること。
        例）202404と指定されたら、20240430までの入金ヘッダが対象
        */
        $targetDate = Carbon::create($params['year'], $params['month'], 1)->lastOfMonth();

     	$result = TrnPaymentDetail::select(
            'trn_payment_details.*',
            'trn_payment_headers.payment_number',
            'trn_payment_headers.payment_date',
            'mt_banks.bank_cd',
            'mt_banks.bank_name',
            'mt_customers.customer_cd',
            'mt_customers.customer_name',
        )->leftJoin('trn_payment_headers', 'trn_payment_details.trn_payment_header_id', 'trn_payment_headers.id')
            ->leftJoin('mt_banks', 'trn_payment_details.mt_bank_id', 'mt_banks.id')
            ->leftJoin('mt_customers', 'trn_payment_headers.mt_customer_id', 'mt_customers.id')
            ->where('trn_payment_headers.payment_date', '>=', $targetDate)
            ->where('trn_payment_details.def_payment_kbn_id', 4)
            ->orderBy('bill_deadline')->get();
        return $result;
     }

    /**
     * 売掛残高一覧表の情報取得
     * @param array $params
     * @return Object
     */
     public function exportList(array $params) {
        $startDate = $params['year_start'].'-' . $params['month_start'] . '-'. $params['day_start'];
        $endDate = $params['year_end'] . '-' . $params['month_end'] . '-' . $params['day_end'];
        $result = MtBillingAddress::select(
            'mt_billing_addresses.*',
            'mt_customers.customer_cd',
            'mt_customers.customer_name',
        )->leftJoin('mt_customers', 'mt_billing_addresses.id', 'mt_customers.mt_billing_address_id')
        ->whereBetween('mt_billing_addresses.billing_address_cd', [$params['code_start'], $params['code_end']])
        ->get();
        $i = 0;
        foreach($result as $re) {
            //請求先IDから請求ヘッダを取得⇒入金ヘッダ・売上ヘッダ
            $prevDate = Carbon::create($params['year_start'], $params['month_start'], $params['day_start'])->subDay();
            $lastDate = Carbon::create($params['year_end'], $params['month_end'], $params['day_end'])->subDay();
            $prevTrnDemandHeader = TrnDemandHeader::where('mt_billing_address_id', $re->id)->where('demand_closing_date', '<=', $prevDate)->orderByDesc('demand_closing_date')->first();
            $lastTrnDemandHeader = TrnDemandHeader::where('mt_billing_address_id', $re->id)->where('demand_closing_date', '<=', $lastDate)->orderByDesc('demand_closing_date')->first();
            $trnDemandHeader = TrnDemandHeader::where('mt_billing_address_id', $re->id)->whereBetween('demand_closing_date', [$startDate, $endDate])->get();
            $trnPaymentHeader = TrnPaymentHeader::whereBetween('payment_date', [$startDate, $endDate])->get();  //入金ヘッダ
            $trnSaleHeader = TrnSaleHeader::whereBetween('sale_date', [$startDate, $endDate])->get();  //売上ヘッダ

            $result[$i]['col1'] = empty($prevTrnDemandHeader) ? null : $prevTrnDemandHeader['before_demand_amount']; //前月残高;
            $result[$i]['col2'] = $trnDemandHeader->sum('now_sale_amount', 'credit_payment_amount');  //総売上額;
            $result[$i]['col3'] = $trnDemandHeader->sum('return_amount'); //返品額;
            $result[$i]['col4'] = $trnDemandHeader->sum('discount_amount'); //値引額;
            $result[$i]['col5'] = $trnDemandHeader->sum('now_sale_amount', 'credit_payment_amount') - ($trnDemandHeader->sum('return_amount') + $trnDemandHeader->sum('discount_amount')); //純売上額;
            $result[$i]['col6'] = $trnDemandHeader->sum('now_tax_amount'); //消費税;
            $result[$i]['col7'] = $trnDemandHeader->sum('cash_tran'); //現金振込額;
            $result[$i]['col8'] = $trnDemandHeader->sum('bill'); //手形額;
            $result[$i]['col9'] = $trnDemandHeader->sum('offset_discount_amount'); //相殺値引額;
            $result[$i]['col10'] = $trnDemandHeader->sum('commission_another'); //手数料他;
            $result[$i]['col11'] =  $trnDemandHeader->sum('now_payment_amount', 'credit_payment_amount'); //入金額;
            $result[$i]['col12'] =  empty($lastTrnDemandHeader) ? null : $lastTrnDemandHeader['now_demand_amount']; //当月残高;
        }
        return $result;
     }

    /**
     * 得意先元帳の情報取得
     * @param array $params
     * @return Object
     */
     public function exportCustomerLedger(array $params) {
        //商品別 output_kbn = 1
        /*
        'startCode' => $param['billing_address_code_start'],
        'endCode' => $param['billing_address_code_end'],
        'startDate' => $param['calendar1-year'] . '年' . $param['calendar1-month'] . '月' . $param['calendar1-date'] . '日',
        'endDate' => $param['calendar2-year'] . '年' . $param['calendar2-month'] . '月' . $param['calendar2-date'] . '日',
        */
        //請求ヘッダーから売上ヘッダーと入金ヘッダーを取得
        $result = null;
        if($params['output_kbn'] === '1') {
            //請求ヘッダ-売上ヘッダ
            $trnSaleHeader1 = TrnDemandHeader::select(
                'trn_demand_headers.*',
                'mt_billing_addresses.billing_address_cd',
                'mc1.customer_cd',
                'mc1.customer_name',
                'mc2.customer_cd',
                'mc2.customer_name',
            )->leftJoin('mt_billing_addresses', 'trn_demand_headers.mt_billing_address_id', 'mt_billing_addresses.id')
            ->leftJoin('mt_customers as mc1', 'mt_billing_addresses.id', 'mc1.mt_billing_address_id')
            ->leftJoin('trn_sale_headers', 'trn_demand_headers.id', 'trn_sale_headers.trn_demand_header_id')
            ->leftJoin('mt_customers as mc2', 'trn_demand_headers.mt_customer_id', 'mc2.id')
            ->get();



            //請求ヘッダ-入金ヘッダ

        } elseif($params['output_kbn'] === '2') {
            //$trnSaleHeader = TrnPaymentHeader::
        }




        //カラー別 output_kbn = 2
        return $result;
     }

    /**
     * 未回収残一覧の情報取得
     * @param array $params
     * @return Object
     */
    public function exportCollectBalanceList(array $params)
    {
        // $param['year'], manager_code_start, billing_address_code_start
        $startDate = Carbon::create($params['year'], $params['month'], 1)->firstOfMonth();
        $endDate = Carbon::create($params['year'], $params['month'], 1)->lastOfMonth();
        $result = TrnDemandHeader::select(
            'mt_billing_addresses.id as billing_address_id',
            'mt_billing_addresses.billing_address_cd',
            'mt_customers.customer_cd',
            'mt_customers.customer_name',
            'mt_users.user_cd',
            'mt_users.user_name',
        )->leftJoin('mt_billing_addresses', 'trn_demand_headers.mt_billing_address_id', 'mt_billing_addresses.id')
            ->leftJoin('mt_customers', 'mt_billing_addresses.id', 'mt_customers.mt_billing_address_id')
            ->leftJoin('mt_users', 'mt_customers.mt_user_id', 'mt_users.id')
        //->whereBetween('mt_users.user_cd', [$params['manager_code_start'], $params['manager_code_end']])
        ->whereBetween('mt_billing_addresses.billing_address_cd', [$params['billing_address_code_start'], $params['billing_address_code_end']])
        ->get()
        ;
        $result = $result->unique('billing_address_id');

        $i = 0;
        foreach($result as $re) {
            //3ヵ月前
            $start = $startDate->parse('-3 month')->firstOfMonth();
            $end = $endDate->parse('-3 month')->lastOfMonth();
            $rec1 = TrnDemandHeader::where('mt_billing_address_id', $re['billing_address_id'])->whereBetween('demand_closing_date', [$start, $end])->sum('now_uncollected_amount');
            $result[$i]['col1'] =  $rec1;  //3ヵ月前
            $start = $startDate->parse('-2 month')->firstOfMonth();
            $end = $endDate->parse('-2 month')->lastOfMonth();
            $rec2 = TrnDemandHeader::where('mt_billing_address_id', $re['billing_address_id'])->whereBetween('demand_closing_date', [$start, $end])->sum('now_uncollected_amount');
            $result[$i]['col2'] =  $rec2;         //2ヵ月前
            $start = $startDate->parse('-1 month')->firstOfMonth();
            $end = $endDate->parse('-1 month')->lastOfMonth();
            $rec3 = TrnDemandHeader::where('mt_billing_address_id', $re['billing_address_id'])->whereBetween('demand_closing_date', [$start, $end])->sum('now_uncollected_amount');
            $result[$i]['col3'] = $rec3;          //1ヵ月前
            $rec4 = TrnDemandHeader::where('mt_billing_address_id', $re['billing_address_id'])->whereBetween('demand_closing_date', [$startDate, $endDate])->sum('now_uncollected_amount');
            $result[$i]['col4'] =  $rec4;   //当月
            $rec4 = TrnDemandHeader::where('mt_billing_address_id', $re['billing_address_id'])->orderByDesc('demand_closing_date')->first();
            $result[$i]['col5'] =  $rec4['now_uncollected_amount'];        //未回収
            $i++;
        }
        return $result;
    }
}
