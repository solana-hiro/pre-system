<?php
namespace App\Repositories\TrnDemandHeader;

use App\Models\TrnDemandHeader;
use App\Models\MtBillingAddress;
use App\Models\TrnSaleHeader;
use App\Models\TrnSaleDetail;
use App\Models\TrnPaymentHeader;
use App\Models\TrnPaymentDetail;
use App\Models\MtCustomer;
use App\Models\MtTaxRateSetting;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Consts\CommonConsts;
use Exception;

class TrnDemandHeaderRepository implements TrnDemandHeaderRepositoryInterface
{

    /**
     * 全件取得
     * @return Object
     */
    public function getAll() {
		$result = TrnDemandHeader::get();
		return $result;
    }

    /**
     * 請求確定の解除
     * @param array $params
     * @return Object
     */
     public function removeDataDecision($params) {
        $result = array();
        $ymd = str_pad($params['year'], 4, 0, STR_PAD_LEFT). str_pad($params['month'], 2, 0, STR_PAD_LEFT).str_pad($params['day'], 2, 0, STR_PAD_LEFT);
        //請求ヘッダ更新
        try {
            DB::beginTransaction();
            $mtBillingAddressIds = MtBillingAddress::whereBetween('billing_address_cd', [$params['code_start'], $params['code_end']])->pluck('id');
            $trnDemandHeaders = TrnDemandHeader::where('demand_closing_date', '<=', $ymd)->whereIn('mt_billing_address_id', $mtBillingAddressIds)->get();
            foreach($trnDemandHeaders as $data) {
                $data->demand_decision_flg = 0; //未確定
                $data->mt_user_last_update_id = Auth::user()->id;
                $data->save();
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
     }

    /**
     * 請求確定の更新
     * @param array $params
     * @return Object
     */
     public function updateDataDecision($params) {
        $result = array();
        $ymd = str_pad($params['year'], 4, 0, STR_PAD_LEFT) . str_pad($params['month'], 2, 0, STR_PAD_LEFT) . str_pad($params['day'], 2, 0, STR_PAD_LEFT);
        //請求ヘッダ更新
        try {
            DB::beginTransaction();

            $mtBillingAddressIds = MtBillingAddress::whereBetween('billing_address_cd', [$params['code_start'], $params['code_end']])->pluck('id');
            $trnDemandHeaders = TrnDemandHeader::where('demand_closing_date', '<=', $ymd)->whereIn('mt_billing_address_id', $mtBillingAddressIds)->get();
            foreach ($trnDemandHeaders as $data) {
                $data->demand_decision_flg = 1; //確定
                $data->mt_user_last_update_id = Auth::user()->id;
                $result[] = $data->save();
            }
            //得意先マスタ更新
            $mtBillingAddressIds = MtBillingAddress::whereBetween('billing_address_cd', [$params['code_start'], $params['code_end']])->pluck('id');
            $mtCustomers = MtCustomer::where('data_decision_date', '<=', $ymd)->whereIn('mt_billing_address_id', $mtBillingAddressIds)->get();
            foreach ($mtCustomers as $data) {
                $data->data_decision_date = 1; //確定
                $data->mt_user_last_update_id = Auth::user()->id;
                $result[] = $data->save();
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
     }

    /**
     * 請求一覧表の情報取得
     * @param array $params
     * @return Object
     */
     public function exportInvoiceList($params) {
     	$result = TrnDemandHeader::get();
        return $result;
     }
    /**
     * 請求履歴問合せ　前頁の情報取得
     * @param array $params
     * @return Object
     */
    public function backHistoryInquiry($params)
    {
        $result = TrnDemandHeader::get();
        return $result;
    }

    /**
     * 請求履歴問合せ　次頁の情報取得
     * @param array $params
     * @return Object
     */
    public function nextHistoryInquiry($params)
    {
        $result = TrnDemandHeader::get();
        return $result;
    }

    /**
     * 請求履歴問合せの情報取得
     * @param array $params
     * @return Object
     */
     public function executeHistoryInquiry($params) {
     	$result = TrnDemandHeader::get();
        return $result;
     }

    /**
     * 請求残高問合せ 前頁の情報取得
     * @param array $params
     * @return Object
     */
    public function backBalanceInquiry($params)
    {
        $result = TrnDemandHeader::get();
        return $result;
    }

    /**
     * 請求残高問合せ 次頁の情報取得
     * @param array $params
     * @return Object
     */
    public function nextBalanceInquiry($params)
    {
        $result = TrnDemandHeader::get();
        return $result;
    }

    /**
     * 請求残高問合せの情報取得
     * @param array $params
     * @return Object
     */
     public function exportBalanceInquiry($params) {
     	$result = TrnDemandHeader::get();
        return $result;
     }

    /**
     * 請求時消費税一括計算の削除
     * @param array $params
     * @return Object
     */
     public function deleteTaxCalculate($params) {
        $result = array();
        $ymd = str_pad($params['year'], 4, 0, STR_PAD_LEFT) . str_pad($params['month'], 2, 0, STR_PAD_LEFT) . str_pad($params['day'], 2, 0, STR_PAD_LEFT);
        //請求ヘッダ更新
        try {
            DB::beginTransaction();

            $mtBillingAddressIds = MtBillingAddress::whereBetween('billing_address_cd', [$params['code_start'], $params['code_end']])->pluck('id');
            $trnDemandHeaders = TrnDemandHeader::select(
                    'trn_demand_headers.*',
                )
                ->leftJoin('mt_billing_addresses', 'trn_demand_headers.mt_billing_address_id', 'mt_billing_addresses.id')
                ->where('demand_closing_date', '<=', $ymd)->whereIn('mt_billing_address_id', $mtBillingAddressIds)
                ->where('mt_billing_addresses.tax_calculation_standard', 3)
                ->get();
            foreach ($trnDemandHeaders as $data) {
                $data->now_tax_amount = 0;
                $data->mt_user_last_update_id = Auth::user()->id;
                $data->save();
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
     }

    /**
     * 請求時消費税一括計算の更新
     * @param array $params
     * @return Object
     */
     public function updateTaxCalculate($params) {
        $result = array();
        $ymd = str_pad($params['year'], 4, 0, STR_PAD_LEFT) . str_pad($params['month'], 2, 0, STR_PAD_LEFT) . str_pad($params['day'], 2, 0, STR_PAD_LEFT);
        //請求ヘッダ更新
        try {
            DB::beginTransaction();

            $mtBillingAddressIds = MtBillingAddress::whereBetween('billing_address_cd', [$params['code_start'], $params['code_end']])->pluck('id');
            $trnDemandHeaders = TrnDemandHeader::select(
                'trn_demand_headers.*',
            )
                ->leftJoin('mt_billing_addresses', 'trn_demand_headers.mt_billing_address_id', 'mt_billing_addresses.id')
                ->where('demand_closing_date', '<=', $ymd)->whereIn('mt_billing_address_id', $mtBillingAddressIds)
                ->where('mt_billing_addresses.tax_calculation_standard', 3)
                ->get();
            foreach ($trnDemandHeaders as $data) {
                $saleHeaderSum = TrnSaleHeader::selectRaw('SUM(amount_total) as sum_amount_total')
                    ->where('trn_demand_header_id', $data['id'])
                    ->groupBy('trn_demand_header_id')->get();
                $data->now_sale_amount = $saleHeaderSum;
                $taxRate = MtTaxRateSetting::where('def_tax_rate_kbn_id', 2)->orderByDesc('application_start_date')->first();
                $data->now_tax_amount = $saleHeaderSum * $taxRate['tax_rate'] * 0.01;
                $data->mt_user_last_update_id = Auth::user()->id;
                $data->save();
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
     }

    /**
     * 請求書発行の情報取得
     * @param array $params
     * @return Object
     */
     public function exportInvoiceIssue($params) {
     	$result = TrnDemandHeader::get();
        // テーブル更新
        return $result;
     }

    /**
     * 請求締日変更処理
     * @param array $params
     * @return Object
     */
    public function updateClosingDateChange($params)
    {
        //請求先マスタ, 売上ヘッダ, 入金ヘッダ
        $result = array();
        $ymd = str_pad($params['year'], 4, 0, STR_PAD_LEFT) . str_pad($params['month'], 2, 0, STR_PAD_LEFT) . str_pad($params['day'], 2, 0, STR_PAD_LEFT);
        //請求ヘッダ更新
        try {
            DB::beginTransaction();
            $mtBillingAddress = MtBillingAddress::where('billing_address_cd', $params['billing_address_code'])->first();
            if(empty($mtBillingAddress)) {
                DB::rollback();
                $result['status'] = CommonConsts::STATUS_ERROR;
                $result['error'] = '更新対象の請求先コードが存在しません。';
                return $result;
            } elseif($mtBillingAddress['sequentially_kbn'] === 1) {
                //随時締区分
                DB::rollback();
                $result['status'] = CommonConsts::STATUS_ERROR;
                $result['error'] = '対象の請求先コードは随時締です。';
                return $result;
            }
            $mtBillingAddress->closing_date_1 = ($params['closing_date_1'] >= 1 && $params['closing_date_1'] <= 27) ? $params['closing_date_1'] : '99';
            $mtBillingAddress->closing_date_2 = ($params['closing_date_2'] >= 1 && $params['closing_date_2'] <= 27) ? $params['closing_date_2'] : '99';
            $mtBillingAddress->closing_date_3 = ($params['closing_date_3'] >= 1 && $params['closing_date_3'] <= 27) ? $params['closing_date_3'] : '99';
            $mtBillingAddress->collect_month_1 = ($params['collect_month_1'] >= 0 && $params['collect_month_1'] <= 2) ? $params['collect_month_1'] : $params['collect_month_1_txt'];
            $mtBillingAddress->collect_month_2 = ($params['collect_month_2'] >= 0 && $params['collect_month_2'] <= 2) ? $params['collect_month_2'] : $params['collect_month_2_txt'];
            $mtBillingAddress->collect_month_3 = ($params['collect_month_3'] >= 0 && $params['collect_month_3'] <= 2) ? $params['collect_month_3'] : $params['collect_month_3_txt'];
            $mtBillingAddress->collect_date_1 = ($params['collect_date_1'] >= 1 && $params['collect_date_1'] <= 27) ? $params['collect_date_1'] : '99';
            $mtBillingAddress->collect_date_2 = ($params['collect_date_2'] >= 1 && $params['collect_date_2'] <= 27) ? $params['collect_date_2'] : '99';
            $mtBillingAddress->collect_date_3 = ($params['collect_date_3'] >= 1 && $params['collect_date_3'] <= 27) ? $params['collect_date_3'] : '99';

            $mtBillingAddress->mt_user_last_update_id = Auth::user()->id;
            $mtBillingAddress->save();

            //関連得意先コードの取得
            $customer = MtCustomer::where('mt_billing_address_id', $mtBillingAddress['id'])->first();

            //対象の請求先マスタに紐づく得意先の売上ヘッダで、かつ売上ヘッダ.請求ヘッダIDが空白(まだ請求処理をしていない）の売上ヘッダが存在する場合
            $trnSaleHeader = TrnSaleHeader::where('mt_customer_id', $customer['id'])
                ->whereNull('trn_demand_header_id')->get();
            foreach($trnSaleHeader as $data) {
                $day1 = ($params['closing_date_1'] >= 1 && $params['closing_date_1'] <= 27) ? $params['closing_date_1'] : '99';
                $data->billing_address_closing_date = Carbon::now()->format('Ym'). $day1;
                $day2 = ($params['collect_date_1'] >= 1 && $params['collect_date_1'] <= 27) ? $params['collect_date_1'] : '99';
                $settlementDate = null;
                if(Carbon::now()->format('md') <  $params['collect_month_1']. $day2) {
                    $settlementDate = Carbon::now()->format('Y') . $params['collect_month_1'] . $day2;
                } else {
                    $settlementDate = Carbon::now()->addYear()->format('Y') . $params['collect_month_1'] . $day2;
                }
                $data->settlement_date = $settlementDate;
                $data->mt_user_last_update_id = Auth::user()->id;
                $data->save();
            }

            //対象の請求先マスタに紐づく得意先の入金ヘッダで、かつ入金ヘッダ.請求ヘッダIDが空白(まだ請求処理をしていない）の入金ヘッダが存在する場合
            $trnPaymentHeader = TrnPaymentHeader::where('mt_customer_id', $customer['id'])
                ->whereNull('trn_demand_header_id')->get();
            foreach ($trnPaymentHeader as $data) {
                $day1 = ($params['closing_date_1'] >= 1 && $params['closing_date_1'] <= 27) ? $params['closing_date_1'] : '99';
                $data->billing_address_closing_date = Carbon::now()->format('Ym') . $day1;
                $day2 = ($params['collect_date_1'] >= 1 && $params['collect_date_1'] <= 27) ? $params['collect_date_1'] : '99';
                $settlementDate = null;
                if (Carbon::now()->format('md') <  $params['collect_month_1'] . $day2) {
                    $settlementDate = Carbon::now()->format('Y') . $params['collect_month_1'] . $day2;
                } else {
                    $settlementDate = Carbon::now()->addYear()->format('Y') . $params['collect_month_1'] . $day2;
                }
                $data->settlement_date = $settlementDate;
                $data->mt_user_last_update_id = Auth::user()->id;
                $data->save();
            }

            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
            $result['mtBillingAddressId'] = $mtBillingAddress['id'];
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * 請求随時締処理
     * @param array $params
     * @return Object
     */
    public function updateSequentiallyClosing($params)
    {
        //請求ヘッダ, 売上ヘッダ, 入金ヘッダ
        $result = array();
        //請求ヘッダ更新
        try {
            DB::beginTransaction();
            $mtBillingAddress = MtBillingAddress::select(
                'mt_billing_addresses.*',
                'mt_customers.id as customer_id',
                'mt_customers.customer_name as customer_name',
                'mt_customers.post_number as post_number',
                'mt_customers.address as address',
                'mt_customers.tel as tel',
                'mt_customers.fax as fax',
            )
            ->leftJoin('mt_customers', 'mt_billing_addresses.id', 'mt_customers.mt_billing_address_id')
            ->where('billing_address_cd', $params['billing_address_code'])->first();

            if (empty($mtBillingAddress)) {
                DB::rollback();
                $result['status'] = CommonConsts::STATUS_ERROR;
                $result['error'] = '更新対象の請求先コードが存在しません。';
                return $result;
            } elseif ($mtBillingAddress['sequentially_kbn'] === 0) {
                //随時締区分
                DB::rollback();
                $result['status'] = CommonConsts::STATUS_ERROR;
                $result['error'] = '対象の請求先コードは随時締以外です。';
                return $result;
            }
            //関連得意先コードの取得
            $customer = MtCustomer::where('mt_billing_address_id', $mtBillingAddress['id'])->first();

            // 処理
            $trnDemandHeader = new TrnDemandHeader();
            $maxNo = TrnDemandHeader::max('demand_number');
            $trnDemandHeader->demand_number = $maxNo + 1;
            $trnDemandHeader->mt_billing_address_id = $mtBillingAddress['id'];
            $trnDemandHeader->demand_closing_date = str_pad($params['closing_year'], 4, 0, STR_PAD_LEFT) . str_pad($params['closing_month'], 2, 0, STR_PAD_LEFT) . str_pad($params['closing_day'], 2, 0, STR_PAD_LEFT);
            $trnDemandHeaderLatest = TrnDemandHeader::where('mt_billing_address_id', $mtBillingAddress['id'])->orderByDesc('updated_at')->first();
            if(empty($trnDemandHeaderLatest)) {
                $trnDemandHeader->before_demand_amount = 0;
            } else {
                $trnDemandHeader->before_demand_amount = $trnDemandHeaderLatest['now_demand_amount'];
            }
            // 請求対象の入金ヘッダの入金区分「相殺」「値引」の合算
            $trnPaymentHeaderIds = TrnPaymentHeader::where('mt_customer_id', $customer['id'])->whereNull('trn_demand_header_id')->pluck('id');
            $trnPaymentDetail = TrnPaymentDetail::whereIn('trn_payment_header_id', $trnPaymentHeaderIds)->get();
            $rec1 = $trnPaymentDetail->whereIn('def_payment_kbn_id', [5, 6])->sum('amount');
            $trnDemandHeader->offset_discount_amount = $rec1;
            // 請求対象の売上明細の売上区分定義「売上」「運賃」「他」の「売上金額」合算
            $trnSaleHeaderIds = TrnSaleHeader::where('mt_customer_id', $customer['id'])->whereNull('trn_demand_header_id')->pluck('id');
            $trnSaleDetail = TrnSaleDetail::whereIn('trn_sale_header_id', $trnSaleHeaderIds)->get();
            $rec2 = $trnSaleDetail->whereIn('def_sale_kbn_id', [1, 4, 5])->sum('sale_amount');
            $trnDemandHeader->now_sale_amount = $rec2;
            // 請求対象の売上明細の売上区分定義「売上」「運賃」の「消費税金額」- 請求対象の売上明細の売上区分定義「返品」「値引」の「消費税金額」の合算
            $tax1 = $trnSaleDetail->whereIn('def_sale_kbn_id', [1, 4])->sum('sale_tax');
            $tax2 = $trnSaleDetail->whereIn('def_sale_kbn_id', [2, 3])->sum('sale_tax');
            $trnDemandHeader->now_tax_amount = $tax1 - $tax2;
            // (前回の請求ヘッダの「今回請求金額」- 前回の請求ヘッダの「今回入金額」) +((「今回売上額」- (「返品額」+「値引額」)) +「今回消費税額」-「今回入金額」)を設定
            if(empty($trnDemandHeaderLatest)) {
                $rec4 = 0;
            } else {
                $rec4 = ($trnDemandHeaderLatest['now_demand_amount'] - $trnDemandHeaderLatest['now_payment_amount']) + (($trnDemandHeaderLatest['now_sale_amount'] - ($trnDemandHeaderLatest['return_amount'] + $trnDemandHeaderLatest['now_tax_amount'])) + $trnDemandHeaderLatest['now_payment_amount'] - $trnDemandHeaderLatest['discount_amount']);
            }
            $trnDemandHeader->now_demand_amount = $rec4;
            // 請求対象の売上明細の売上区分定義「返品」の「売上金額」合算
            $rec5 = $trnSaleDetail->where('def_sale_kbn_id', 2)->sum('sale_amount');
            $trnDemandHeader->return_amount = $rec5;
            // 請求対象の売上明細の売上区分定義「値引」の「売上金額」合算
            $rec6 = $trnSaleDetail->where('def_sale_kbn_id', 3)->sum('sale_amount');
            $trnDemandHeader->discount_amount = $rec6;
            // 請求対象の入金ヘッダの入金区分「現金」「小切手」「振込」「手形」「手数料」「その他」の合算
            $rec7 = $trnPaymentDetail->whereIn('def_payment_kbn_id', [1,2,3,4,7,8])->sum('amount');
            $trnDemandHeader->now_payment_amount = $rec7;
            $trnDemandHeader->now_payment_date = str_pad($params['collect_year'], 4, 0, STR_PAD_LEFT) . str_pad($params['collect_month'], 2, 0, STR_PAD_LEFT) . str_pad($params['collect_day'], 2, 0, STR_PAD_LEFT);
            // 請求対象の入金明細の入金区分定義「現金」「小切手」「振込」の合算
            $rec8 = $trnPaymentDetail->whereIn('def_payment_kbn_id', [1, 2, 3])->sum('amount');
            $trnDemandHeader->cash_tran = $rec8;
            // 請求対象の入金明細の入金区分定義「手形」の合算
            $rec9 = $trnPaymentDetail->where('def_payment_kbn_id', 4)->sum('amount');
            $trnDemandHeader->bill = $rec9;
            // 請求対象の入金明細の入金区分定義「手数料」「その他」の合算
            $rec10 = $trnPaymentDetail->whereIn('def_payment_kbn_id', [7, 8])->sum('amount');
            $trnDemandHeader->commission_another = $rec10;
            // 請求対象の売上ヘッダの数を設定
            $trnDemandHeader->sale_slip_sheet_number = count($trnSaleHeaderIds);
            // 請求対象の入金ヘッダの数を設定
            $trnDemandHeader->trn_payment_sheet_number = count($trnPaymentHeaderIds);
            // 請求対象の売上ヘッダの「現金区分」が「0:現金」の伝票の「総計」の合算
            $trnDemandHeader->credit_payment_amount = $rec10;
            $trnDemandHeader->mt_user_last_update_id = Auth::user()->id;
            $trnDemandHeader->save();

            //関連得意先コードの取得
            $customer = MtCustomer::where('mt_billing_address_id', $mtBillingAddress['id'])->first();

            //得意先に紐づく売上ヘッダの更新
            //trn_sale_headers.trn_demand_header_id
            $trnSaleHeader = TrnSaleHeader::where('mt_customer_id', $customer['id'])->whereNull('trn_demand_header_id')->get();
            foreach($trnSaleHeader as $data) {
                $data->trn_demand_header_id = $trnDemandHeader['id'];
                $data->mt_user_last_update_id = Auth::user()->id;
                $data->save();
            }

            //得意先に紐づく入金ヘッダの更新
            //trn_payment_headers.trn_demand_header_id
            $trnPaymentHeader = TrnPaymentHeader::where('mt_customer_id', $customer['id'])->whereNull('trn_demand_header_id')->get();
            foreach ($trnPaymentHeader as $data) {
                $data->trn_demand_header_id = $trnDemandHeader['id'];
                $data->mt_user_last_update_id = Auth::user()->id;
                $data->save();
            }

            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
            $result['mtBillingAddressId'] = $mtBillingAddress['customer_id'];
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * 請求随時締解除処理
     * @param array $params
     * @return Object
     */
    public function updateSequentiallyClosingRemove($params)
    {
        //請求ヘッダ, 売上ヘッダ, 入金ヘッダ
        $result = array();
        //請求ヘッダ更新
        try {
            DB::beginTransaction();
            $mtBillingAddress = MtBillingAddress::select(
                'mt_billing_addresses.*',
                'mt_customers.id as customer_id',
                'mt_customers.customer_name as customer_name',
                'mt_customers.post_number as post_number',
                'mt_customers.address as address',
                'mt_customers.tel as tel',
                'mt_customers.fax as fax',
            )
            ->leftJoin('mt_customers', 'mt_billing_addresses.id', 'mt_customers.mt_billing_address_id')
            ->where('billing_address_cd', $params['billing_address_code'])->first();

            if (empty($mtBillingAddress)) {
                DB::rollback();
                $result['status'] = CommonConsts::STATUS_ERROR;
                $result['error'] = '更新対象の請求先コードが存在しません。';
                return $result;
            } elseif ($mtBillingAddress['sequentially_kbn'] === 0) {
                //随時締区分
                DB::rollback();
                $result['status'] = CommonConsts::STATUS_ERROR;
                $result['error'] = '対象の請求先コードは随時締以外です。';
                return $result;
            }
            //最新の請求ヘッダ>請求締日
            $trnDemandHeader = TrnDemandHeader::where('mt_billing_address_id', $mtBillingAddress['id'])->orderByDesc('updated_at')->first();
            $ymd = empty($trnDemandHeader) ? '' : $trnDemandHeader['demand_closing_date'];
            //請求ヘッダの削除 物理削除
            $trnDemandHeaderIds = TrnDemandHeader::where('mt_billing_address_id', $mtBillingAddress['id'])->where('demand_closing_date', $ymd)->pluck('id');
            TrnDemandHeader::where('mt_billing_address_id', $mtBillingAddress['id'])->where('demand_closing_date', $ymd)->delete();

            //関連得意先コードの取得
            $customer = MtCustomer::where('mt_billing_address_id', $mtBillingAddress['id'])->first();

            //得意先に紐づく売上ヘッダの更新　物理削除
            //trn_sale_headers.trn_demand_header_id
            TrnSaleHeader::where('mt_customer_id', $customer['id'])->whereIn('trn_demand_header_id', $trnDemandHeaderIds)->delete();

            //得意先に紐づく入金ヘッダの更新  値クリア
            //trn_payment_headers.trn_demand_header_id
            $trnPaymentHeader = TrnPaymentHeader::where('mt_customer_id', $customer['id'])->whereIn('trn_demand_header_id', $trnDemandHeaderIds)->get();
            foreach ($trnPaymentHeader as $data) {
                $data->trn_demand_header_id = null;
                $data->mt_user_last_update_id = Auth::user()->id;
                $data->save();
            }

            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
            $result['mtBillingAddressId'] = $mtBillingAddress['id'];
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

}
