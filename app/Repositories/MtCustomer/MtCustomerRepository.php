<?php

namespace App\Repositories\MtCustomer;

use App\Models\MtCustomer;
use App\Models\MtBillingAddress;
use App\Models\MtManager;
use App\Models\MtCustomerManager;
use App\Models\MtItemClass;
use App\Models\MtWarehouse;
use App\Models\MtRoot;
use App\Models\MtSlipKind;
use App\Models\DefArrivalDate;
use App\Models\DefDistrictClass;
use App\Models\DefPioneerYear;
use App\Models\MtCustomerClass;
use App\Consts\CommonConsts;
use App\Models\MtUser;
use App\Http\Requests\MtDeliveryDestination\MtCustomerDetailRequest;
use App\Lib\CodeUtil;
use App\Mail\UserRegistrationMail;
use App\Models\Favorite;
use App\Models\MtCart;
use App\Models\PasswordToken;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;

class MtCustomerRepository implements MtCustomerRepositoryInterface
{

    /**
     * 得意先マスタ 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtCustomer::leftJoin('mt_billing_addresses', 'mt_customers.mt_billing_address_id', 'mt_billing_addresses.id')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 得意先マスタ 条件取得
     * @param $params
     * @return Object
     */
    public function get($params)
    {
        $code = $params['customer_cd'] ? CodeUtil::pad($params['customer_cd'], 6) : null;
        $name = $params['customer_name'] ?? null;
        $kana = $params['customer_name_kana'] ?? null;
        $tel = $params['tel'] ?? null;
        $includeDeleted = $params['include_deleted'] ?? false;

        $query = MtCustomer::query();
        $query->leftJoin('mt_billing_addresses', 'mt_customers.mt_billing_address_id', 'mt_billing_addresses.id');
        $query->when($includeDeleted === false, fn($query) => $query->where("del_kbn", 0));
        $query->when($code, fn($query) => $query->where("customer_cd", '>=', $code));
        $query->when($name, fn($query) => $query->where("customer_name", 'like', "%$name%"));
        $query->when($kana, fn($query) => $query->where("customer_name_kana", 'like', "%$kana%"));
        $query->when($tel, fn($query) => $query->where("tel", 'like', "%$tel%"));
        $query->orderBy('customer_cd');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * 得意先マスタ詳細 取得(id指定)
     * @param $id
     * @return Object
     */
    public function getDetailById($id)
    {
        // mt_customers, mt_billing_addresses, mt_managers, mt_customer_managers
        $result['MtCustomer'] = MtCustomer::select(
            'mt_customers.*',
            'mt_billing_addresses.billing_address_cd',
            'mt_billing_addresses.sequentially_kbn',
            'mt_billing_addresses.closing_date_1',
            'mt_billing_addresses.closing_date_2',
            'mt_billing_addresses.closing_date_3',
            'mt_billing_addresses.collect_month_1',
            'mt_billing_addresses.collect_month_2',
            'mt_billing_addresses.collect_month_3',
            'mt_billing_addresses.collect_date_1',
            'mt_billing_addresses.collect_date_2',
            'mt_billing_addresses.collect_date_3',
            'mt_billing_addresses.credit_limit_amount',
            'mt_billing_addresses.price_fraction_process',
            'mt_billing_addresses.all_amount_fraction_process',
            'mt_billing_addresses.tax_kbn',
            'mt_billing_addresses.tax_calculation_standard',
            'mt_billing_addresses.tax_fraction_process_yen',
            'mt_billing_addresses.tax_fraction_process',
            'mt_billing_addresses.invoice_mailing_flg',
            'mt_billing_addresses.invoice_kind_flg',
            'mt_billing_addresses.sale_decision_print_paper_flg',
            'mt_order_receive_sticky_notes.id as sticky_note_id',
            'mt_order_receive_sticky_notes.def_sticky_note_kind_id',
            'mt_order_receive_sticky_notes.branch_number',
            'mt_order_receive_sticky_notes.sticky_note_color',
            'mt_order_receive_sticky_notes.sticky_note_name',
            'def_district_classes.district_class_cd',
            'def_district_classes.district_class_name',
            'def_pioneer_years.pioneer_year_cd',
            'def_pioneer_years.pioneer_year_name',
            'mc1.def_customer_class_thing_id as def_customer_class_thing_id_mc1',
            'mc1.customer_class_cd as customer_class_cd_mc1',
            'mc1.customer_class_name as customer_class_name_mc1',
            'mc2.def_customer_class_thing_id as def_customer_class_thing_id_mc2',
            'mc2.customer_class_cd as customer_class_cd_mc2',
            'mc2.customer_class_name as customer_class_name_mc2',
            'mc3.def_customer_class_thing_id as def_customer_class_thing_id_mc3',
            'mc3.customer_class_cd as customer_class_cd_mc3',
            'mc3.customer_class_name as customer_class_name_mc3',
            'mt_users.user_cd',
            'mt_users.user_name',
            'mt_warehouses.warehouse_cd',
            'mt_warehouses.warehouse_name',
            'mt_roots.root_cd',
            'mt_roots.root_name',
            'mt_slip_kinds.def_slip_kind_kbn_id',
            'mt_slip_kinds.slip_kind_cd',
            'mt_slip_kinds.slip_kind_name',
            'def_arrival_dates.arrival_date_cd',
            'def_arrival_dates.arrival_date_name',
            'mt_item_classes.item_class_cd',
            'mt_item_classes.item_class_name'
        )->leftJoin('mt_billing_addresses', 'mt_customers.mt_billing_address_id', 'mt_billing_addresses.id')
            ->leftJoin('mt_order_receive_sticky_notes', 'mt_customers.mt_order_receive_sticky_note_id', 'mt_order_receive_sticky_notes.id')
            ->leftJoin('def_district_classes', 'mt_customers.def_district_class_id', 'def_district_classes.id')
            ->leftJoin('def_pioneer_years', 'mt_customers.def_pioneer_year_id', 'def_pioneer_years.id')
            ->leftJoin('mt_customer_classes as mc1', 'mt_customers.mt_customer_class1_id', 'mc1.id')
            ->leftJoin('mt_customer_classes as mc2', 'mt_customers.mt_customer_class2_id', 'mc2.id')
            ->leftJoin('mt_customer_classes as mc3', 'mt_customers.mt_customer_class3_id', 'mc3.id')
            ->leftJoin('mt_users', 'mt_customers.mt_user_id', 'mt_users.id')
            ->leftJoin('mt_warehouses', 'mt_customers.mt_warehouse_order_receive_id', 'mt_warehouses.id')
            ->leftJoin('mt_roots', 'mt_customers.mt_root_id', 'mt_roots.id')
            ->leftJoin('mt_slip_kinds', 'mt_customers.mt_slip_kind_sale_id', 'mt_slip_kinds.id')
            ->leftJoin('def_arrival_dates', 'mt_customers.def_arrival_date_id', 'def_arrival_dates.id')
            ->leftJoin('mt_item_classes', 'mt_item_classes.id', 'mt_customers.mt_item_class_shipping_companie_id')
            ->where('mt_customers.id', $id)->first();

        $result['MtManager'] = MtCustomerManager::select(
            // 'mt_customer_managers.*',
            'mt_managers.id',
            'mt_managers.manager_cd',
            'mt_managers.manager_name',
            'mt_managers.manager_mail',
            'mt_managers.ec_login_id',
            'mt_managers.ec_login_password',
            'mt_managers.ec_password_issue_mail_last_send_datetime',
            'mt_managers.validity_flg',
            'mt_managers.display_order',
            'mt_managers.memo',
            'mt_managers.ec_password_reset_mail_last_send_datetime'
        )->leftJoin('mt_managers', 'mt_customer_managers.mt_manager_id', 'mt_managers.id')
            ->where('mt_customer_managers.mt_customer_id', $id)->get();

        $collect_month_1_txt = "";
        $collect_month_2_txt = "";
        $collect_month_3_txt = "";
        if ($result['MtCustomer']->collect_month_1 >= 3) {
            $collect_month_1_txt = $result['MtCustomer']->collect_month_1;
            $result['MtCustomer']->collect_month_1_txt = $collect_month_1_txt;
        }
        if ($result['MtCustomer']->collect_month_2 >= 3) {
            $collect_month_2_txt = $result['MtCustomer']->collect_month_2;
            $result['MtCustomer']->collect_month_2_txt = $collect_month_2_txt;
        }
        if ($result['MtCustomer']->collect_month_3 >= 3) {
            $collect_month_3_txt = $result['MtCustomer']->collect_month_3;
            $result['MtCustomer']->collect_month_3_txt = $collect_month_3_txt;
        }
        return $result;
    }

    /**
     * 得意先マスタ 取得(id指定)
     * @param $id
     * @return Object
     */
    public function getById($id)
    {
        $query = MtCustomer::query();
        return $query->find($id);
    }

    /**
     * 得意先の最小ID取得
     * @return Object
     */
    public function getMinCode()
    {
        $result = MtCustomer::min('customer_cd');
        return $result;
    }

    /**
     * 得意先の最大ID取得
     * @return Object
     */
    public function getMaxCode()
    {
        $result = MtCustomer::max('customer_cd');
        return $result;
    }

    /**
     * 前頁
     * @param $id
     * @return Object
     */
    public function getPrevByCode($code)
    {
        if (isset($code)) {
            $result = MtCustomer::where('customer_cd', '<', $code)->orderByDesc('customer_cd')->first();
        } else {
            $result = MtCustomer::orderBy('customer_cd')->first();
        }
        return $result;
    }

    /**
     * 次頁
     * @param $id
     * @return Object
     */
    public function getNextByCode($code)
    {
        if (isset($code)) {
            $result = MtCustomer::where('customer_cd', '>', $code)->orderBy('customer_cd')->first();
        } else {
            $result = MtCustomer::orderBy('customer_cd')->first();
        }
        return $result;
    }

    /**
     * 得意先のIDによる削除
     * @param $id
     * @return Object
     */
    public function delete($id)
    {
        $targetCustomer = MtCustomer::where('id', $id);
        $deleteManagerIds = MtCustomerManager::where('mt_customer_id', $targetCustomer->id)->pluck('mt_manager_id')->toArray();

        MtCustomerManager::where('mt_customer_id', $targetCustomer->id)->delete();
        Favorite::whereIn('mt_manager_id', $deleteManagerIds)->delete();
        MtCart::whereIn('mt_manager_id', $deleteManagerIds)->delete();
        PasswordToken::whereIn('mt_manager_id', $deleteManagerIds)->delete();
        MtManager::destroy($deleteManagerIds);
        $result = $targetCustomer->delete();
        MtBillingAddress::where('billing_address_cd', $targetCustomer->customer_cd)->delete();
        return $result;
    }

    /**
     * 得意先マスタ 更新
     * @param $id
     * @param $params
     * @return Object
     */
    public function update($id, $params)
    {
        $update_columns = [
            'id' => $id,
            'customer_name' => $params['customer_name'],
            'representative_name' => $params['representative_name'],
        ];
        return MtCustomer::update($update_columns, ['id']);
    }

    /**
     * 得意先マスタ 残高取得
     * @param $id
     * @return Object
     */
    public function getBalance($id)
    {
        $result = MtCustomer::where('id', $id)->first();
        return $result;
    }

    /**
     * 得意先マスタ 残高更新 実装不要
     * @param $id
     * @param $params
     * @return Object
     */
    /*
    public function updateBalance($id, $params) {
        $update_columns = [
            'id' => $id,
            'customer_name' => $params['customer_name'],
            'representative_name' => $params['representative_name'],
        ];
        $result = MtCustomer::update($update_columns,['id']);
		return $result;
    }
    */

    /**
     * 得意先リスト 一覧取得
     * @param $params
     * @return Object
     */
    public function export($params)
    {
        $startCode = ($params['code_start']) ? str_pad($params['code_start'], 6, 0, STR_PAD_LEFT) : '';
        $endCode = ($params['code_end']) ? str_pad($params['code_end'], 6, 0, STR_PAD_LEFT) : 'ZZZZZZ';
        $customerIds = MtCustomer::whereBetween('customer_cd', [$startCode, $endCode])->pluck('id');
        $result = MtCustomer::select(
            'mt_customers.id as id',
            'mt_customers.customer_cd as customer_cd',
            'mt_customers.customer_name as customer_name',
            'mt_customers.customer_name_kana as customer_name_kana',
            'mt_billing_addresses.billing_address_cd as billing_address_cd',
            'mc1.customer_name as customer_name2',
            'mt_order_receive_sticky_notes.sticky_note_name as sticky_note_name',
            'mt_customers.payment_kbn as payment_kbn',
            'mt_users.user_cd as user_cd',
            'mt_users.user_name as user_name',
            'mt_customers.honorific_kbn as honorific_kbn',
            'mt_customers.post_number as post_number',
            'mt_customers.address as address',
            'mt_customers.tel as tel',
            'mt_customers.fax as fax',
            'mt_customers.representative_name as representative_name',
            'mt_customers.representative_mail as representative_mail',
            'mt_managers.manager_cd as manager_cd',
            'mt_managers.manager_name as manager_name',
            'mt_managers.manager_mail as manager_mail',
            'mt_managers.ec_login_id as ec_login_id',
            'mt_customers.price_rate as price_rate',
            'mt_billing_addresses.credit_limit_amount as credit_limit_amount',
            'mt_customers.credit_limit_amount_check_flg as credit_limit_amount_check_flg',
            'mcc1.customer_class_cd as customer_class_cd1',
            'mcc1.customer_class_name as customer_class_name1',
            'mcc2.customer_class_cd as customer_class_cd2',
            'mcc2.customer_class_name as customer_class_name2',
            'mcc3.customer_class_cd as customer_class_cd3',
            'mcc3.customer_class_name as customer_class_name3',
            'def_district_classes.district_class_cd as district_class_cd',
            'def_district_classes.district_class_name as district_class_name',
            'def_pioneer_years.pioneer_year_cd as pioneer_year_cd',
            'def_pioneer_years.pioneer_year_name as pioneer_year_name',
            'mt_billing_addresses.sequentially_kbn as sequentially_kbn',
            'mt_billing_addresses.closing_date_1 as closing_date_1',
            'mt_billing_addresses.collect_month_1 as collect_month_1',
            'mt_billing_addresses.collect_date_1 as collect_date_1',
            'mt_billing_addresses.closing_date_2 as closing_date_2',
            'mt_billing_addresses.collect_month_2 as collect_month_2',
            'mt_billing_addresses.collect_date_2 as collect_date_2',
            'mt_billing_addresses.closing_date_3 as closing_date_3',
            'mt_billing_addresses.collect_month_3 as collect_month_3',
            'mt_billing_addresses.collect_date_3 as collect_date_3',
            'mt_customers.invoice_notification_mail_1 as invoice_notification_mail_1',
            'mt_customers.invoice_notification_mail_2 as invoice_notification_mail_2',
            'mt_customers.payment_guidance_mail as payment_guidance_mail',
            'mt_customers.payment_guidance_send_flg as payment_guidance_send_flg',
            'mt_customers.customer_url as customer_url',
            'mt_customers.name_input_kbn as name_input_kbn',
            'mt_customers.del_kbn as del_kbn',
            'mt_billing_addresses.price_fraction_process as price_fraction_process',
            'mt_billing_addresses.all_amount_fraction_process as all_amount_fraction_process',
            'mt_billing_addresses.tax_kbn as tax_kbn',
            'mt_customers.tax_fare_rate_application as tax_fare_rate_application',
            'mt_billing_addresses.tax_calculation_standard as tax_calculation_standard',
            'mt_billing_addresses.tax_fraction_process_yen as tax_fraction_process_yen',
            'mt_billing_addresses.tax_fraction_process as tax_fraction_process',
            'mt_customers.delivery_price as delivery_price',
            'mt_warehouses.warehouse_cd as warehouse_cd',
            'mt_warehouses.warehouse_name as warehouse_name',
            'mt_roots.root_cd as root_cd',
            'mt_roots.root_name as root_name',
            'mt_roots.root_cd as root_cd',
            'mt_roots.root_name as root_name',
            'mt_item_classes.item_class_cd as item_class_cd',
            'mt_item_classes.item_class_name as item_class_name',
            'def_arrival_dates.arrival_date_cd as arrival_date_cd',
            'def_arrival_dates.arrival_date_name as arrival_date_name',
            'mt_slip_kinds.slip_kind_cd as slip_kind_cd',
            'mt_slip_kinds.slip_kind_name as slip_kind_name',
            'mt_slip_kinds.slip_kind_cd as slip_kind_cd',
            'mt_billing_addresses.invoice_kind_flg as invoice_kind_flg',
            'mt_customers.direct_delivery_slip_mailing_flg as direct_delivery_slip_mailing_flg',
            'mt_billing_addresses.invoice_mailing_flg as invoice_mailing_flg',
            'mt_billing_addresses.sale_decision_print_paper_flg as sale_decision_print_paper_flg',
            'mt_customers.customer_memo_1 as customer_memo_1',
            'mt_customers.customer_memo_2 as customer_memo_2',
            'mt_customers.customer_memo_3 as customer_memo_3',
            'mt_customers.customer_expansion_1 as customer_expansion_1',
            'mt_customers.customer_expansion_2 as customer_expansion_2',
            'mt_customers.customer_expansion_3 as customer_expansion_3',
            'mt_customers.customer_expansion_4 as customer_expansion_4',
            'mt_customers.customer_expansion_5 as customer_expansion_5',
        )
            ->leftJoin("mt_billing_addresses", "mt_customers.mt_billing_address_id", "mt_billing_addresses.id")
            ->leftJoin("mt_customers as mc1", "mt_billing_addresses.billing_address_cd", "mc1.customer_cd")
            ->leftJoin(
                DB::raw(
                    '(
                        SELECT t1.mt_customer_id, min(t1.mt_manager_id) as mt_manager_id
                        FROM mt_customer_managers  as t1
                        JOIN mt_managers as t2 ON t1.mt_manager_id = t2.id
                        JOIN (
                            SELECT mt_customer_id, min(display_order) as min_order
                            FROM mt_customer_managers
                            JOIN mt_managers ON mt_customer_managers.mt_manager_id = mt_managers.id
                            WHERE validity_flg = 1
                            Group by mt_customer_id ) as tmp
                        ON t1.mt_customer_id = tmp.mt_customer_id AND t2.display_order = tmp.min_order
                        Group by mt_customer_id
                    )
                    AS mt_customer_managers'
                ),
                "mt_customer_managers.mt_customer_id",
                "mt_customers.id"
            )
            ->leftJoin("def_arrival_dates", "mt_customers.def_arrival_date_id", "def_arrival_dates.id")
            ->leftJoin("def_district_classes", "mt_customers.def_district_class_id", "def_district_classes.id")
            ->leftJoin("def_pioneer_years", "mt_customers.def_pioneer_year_id", "def_pioneer_years.id")
            ->leftJoin("mt_customer_classes as mcc1", "mt_customers.mt_customer_class1_id", "mcc1.id")
            ->leftJoin("mt_customer_classes as mcc2", "mt_customers.mt_customer_class2_id", "mcc2.id")
            ->leftJoin("mt_customer_classes as mcc3", "mt_customers.mt_customer_class3_id", "mcc3.id")
            ->leftJoin("mt_item_classes", "mt_customers.mt_item_class_shipping_companie_id", "mt_item_classes.id")
            ->leftJoin("mt_managers", "mt_customer_managers.mt_manager_id", "mt_managers.id")
            ->leftJoin("mt_order_receive_sticky_notes", "mt_customers.mt_order_receive_sticky_note_id", "mt_order_receive_sticky_notes.id")
            ->leftJoin("mt_roots", "mt_customers.mt_root_id", "mt_roots.id")
            ->leftJoin("mt_slip_kinds", "mt_customers.mt_slip_kind_sale_id", "mt_slip_kinds.id")
            ->leftJoin("mt_users", "mt_customers.mt_user_id", "mt_users.id")
            ->leftJoin("mt_warehouses", "mt_customers.mt_warehouse_order_receive_id", "mt_warehouses.id")
            ->whereIn("mt_customers.id", $customerIds)
            ->orderBy("mt_customers.customer_cd")
            ->get();

        return $result;
    }

    /**
     * 得意先リスト ファイルインポート登録
     * おそらくユーザーIDと担当者IDのところにバグがある
     * @param $params
     * @return Object
     */
    public function importUpdate($params)
    {
        $result = array();
        try {
            DB::beginTransaction();
            //得意先マスタ, 請求先マスタ, 担当者マスタ, 得意先別担当者マスタへ登録
            foreach ($params as $param) {
                foreach ($param as $rec) {
                    //請求先登録　更新のみ
                    // ↑新規登録の場合は同じコードの請求先も新規作成するケースが多いので更新のみは誤り
                    $billingAddressCd = str_pad($rec['請求先コード'], 6, 0, STR_PAD_LEFT);
                    $mtBillingAddressExists = MtBillingAddress::where('billing_address_cd', $billingAddressCd)->exists();
                    if ($mtBillingAddressExists) {
                        //更新
                        $mtBillingAddress = MtBillingAddress::where('billing_address_cd', $billingAddressCd)->first();
                    } else {
                        //新規登録
                        $mtBillingAddress = new MtBillingAddress();
                        $mtBillingAddress->billing_address_cd = $rec['請求先コード'];
                        // DB::rollback();
                        // $result['status'] = CommonConsts::STATUS_ERROR;
                        // $result['error'] = "存在しない請求先コードです。";
                        // Log::info($result);
                        // return $result;
                    }
                    if (isset($rec['与信限度額'])) $mtBillingAddress->credit_limit_amount = $rec['与信限度額'];
                    if (!empty($rec['請求書郵送要不要'])) $mtBillingAddress->invoice_mailing_flg = $rec['請求書郵送要不要'];
                    if (!empty($rec['請求書種別'])) $mtBillingAddress->invoice_kind_flg = $rec['請求書種別'];
                    if (!empty($rec['売上確定時印刷用紙'])) $mtBillingAddress->sale_decision_print_paper_flg = $rec['売上確定時印刷用紙'];
                    $mtBillingAddress->mt_user_last_update_id = Auth::user()->id;
                    $mtBillingAddress->save();

                    //担当者  更新のみ
                    if (!empty($rec['得意先担当者コード'])) {
                        $managerCd = str_pad($rec['得意先担当者コード'], 4, 0, STR_PAD_LEFT);
                        $mtManagerExists = MtManager::where('manager_cd', $managerCd)->exists();
                        if ($mtManagerExists) {
                            //更新
                            $mtManager = MtManager::where('manager_cd', $managerCd)->first();
                            if (isset($rec['得意先担当者名'])) $mtManager->manager_name = $rec['得意先担当者名'];
                            if (isset($rec['得意先担当者E-Mail'])) $mtManager->manager_mail = $rec['得意先担当者E-Mail'];
                            // $mtManager->register_datetime = Carbon::now();
                            $mtManager->mt_user_last_update_id = Auth::user()->id;
                            $mtManager->save();
                        } else {
                            DB::rollback();
                            $result['status'] = CommonConsts::STATUS_ERROR;
                            $result['error'] = "存在しない担当者コードです。";
                            Log::info($result);
                            return $result;
                        }
                    }
                    //得意先登録
                    $customerCd = str_pad($rec['得意先コード'], 6, 0, STR_PAD_LEFT);
                    $mtCustomerExists = MtCustomer::where('customer_cd', $customerCd)->exists();
                    if ($mtCustomerExists) {
                        //更新
                        $mtCustomer = MtCustomer::where('customer_cd', $customerCd)->first();
                    } else {
                        //新規登録
                        $mtCustomer = new MtCustomer();
                        $mtCustomer->customer_cd = $customerCd;
                        $mtCustomer->mt_user_register_id = Auth::user()->id;
                    }
                    $mtCustomer->mt_billing_address_id = $mtBillingAddress['id'];
                    if (isset($rec['付箋(特記事項)'])) $mtCustomer->mt_order_receive_sticky_note_id = $rec['付箋(特記事項)'];
                    if (isset($rec['得意先名'])) $mtCustomer->customer_name = $rec['得意先名'];
                    if (isset($rec['名カナ'])) $mtCustomer->customer_name_kana = $rec['名カナ'];
                    if (!empty($rec['敬称区分'])) $mtCustomer->honorific_kbn = $rec['敬称区分'];
                    if (isset($rec['郵便番号'])) $mtCustomer->post_number = $rec['郵便番号'];
                    if (isset($rec['住所'])) $mtCustomer->address = $rec['住所'];
                    if (isset($rec['TEL'])) $mtCustomer->tel = $rec['TEL'];
                    if (isset($rec['FAX'])) $mtCustomer->fax = $rec['FAX'];
                    if (!empty($rec['直送納品書郵送要不要'])) $mtCustomer->direct_delivery_slip_mailing_flg = $rec['直送納品書郵送要不要'];
                    if (!empty($rec['入金区分'])) $mtCustomer->payment_kbn = $rec['入金区分'];
                    if (!empty($rec['販売パターン1コード'])) {
                        $code = MtCustomerClass::where('customer_class_cd', $rec['販売パターン1コード'])->where('def_customer_class_thing_id', 1)->first();
                        $mtCustomer->mt_customer_class1_id = $code['id'];
                    }

                    if (isset($rec['地区分類コード'])) {
                        if (empty($rec['地区分類コード'])) {
                            $mtCustomer->def_district_class_id = null;
                        } else {
                            $code = DefDistrictClass::where('district_class_cd', $rec['地区分類コード'])->first();
                            $mtCustomer->def_district_class_id = $code['id'];
                        }
                    }
                    if (isset($rec['開拓年分類コード'])) {
                        if (empty($rec['開拓年分類コード'])) {
                            $mtCustomer->def_pioneer_year_id = null;
                        } else {
                            $code = DefPioneerYear::where('pioneer_year_cd', $rec['開拓年分類コード'])->first();
                            $mtCustomer->def_pioneer_year_id = $code['id'];
                        }
                    }
                    if (isset($rec['業種・特徴2コード'])) {
                        if (empty($rec['業種・特徴2コード'])) {
                            $mtCustomer->mt_customer_class2_id = null;
                        } else {
                            $code = MtCustomerClass::where('customer_class_cd', $rec['業種・特徴2コード'])->where('def_customer_class_thing_id', 2)->first();
                            $mtCustomer->mt_customer_class2_id = $code['id'];
                        }
                    }
                    if (isset($rec['ランク3コード'])) {
                        if (empty($rec['ランク3コード'])) {
                            $mtCustomer->mt_customer_class3_id = null;
                        } else {
                            $code = MtCustomerClass::where('customer_class_cd', $rec['ランク3コード'])->where('def_customer_class_thing_id', 3)->first();
                            $mtCustomer->mt_customer_class3_id = $code['id'];
                        }
                    }

                    if (isset($rec['代表者名'])) $mtCustomer->representative_name = $rec['代表者名'];
                    if (isset($rec['代表者E-Mail'])) $mtCustomer->representative_mail = $rec['代表者E-Mail'];
                    if (isset($rec['請求書通知用E-Mail1'])) $mtCustomer->invoice_notification_mail_1 = $rec['請求書通知用E-Mail1'];
                    if (isset($rec['郵便番請求書通知用E-Mail2号'])) $mtCustomer->invoice_notification_mail_2 = $rec['請求書通知用E-Mail2'];
                    if (isset($rec['入金案内用E-Mail'])) $mtCustomer->payment_guidance_mail = $rec['入金案内用E-Mail'];
                    if (!empty($rec['入金案内送信要不要'])) $mtCustomer->payment_guidance_send_flg = $rec['入金案内送信要不要'];
                    if (isset($rec['得意先URL'])) $mtCustomer->customer_url = $rec['得意先URL'];
                    if (isset($rec['館内配送料'])) $mtCustomer->delivery_price = $rec['館内配送料'];
                    if (!empty($rec['単価掛率'])) $mtCustomer->price_rate = $rec['単価掛率'];
                    if (!empty($rec['担当者コード'])) {
                        $userCd = str_pad($rec['担当者コード'], 4, 0, STR_PAD_LEFT);
                        $user = MtUser::where('user_cd', $userCd)->first();
                        $mtCustomer->mt_user_id = $user->id;  //ユーザマスタID
                    }
                    if (!empty($rec['与信限度額チェック'])) $mtCustomer->credit_limit_amount_check_flg = $rec['与信限度額チェック'];
                    if (!empty($rec['名称入力区分'])) $mtCustomer->name_input_kbn = $rec['名称入力区分'];
                    if (!empty($rec['削除区分'])) $mtCustomer->del_kbn = $rec['削除区分'];
                    if (!empty($rec['消費税運賃掛率適用'])) $mtCustomer->tax_fare_rate_application = $rec['消費税運賃掛率適用'];
                    if (!empty($rec['受注倉庫コード'])) {
                        $warehouseCd = str_pad($rec['受注倉庫コード'], 6, 0, STR_PAD_LEFT);
                        $code = MtWarehouse::where('warehouse_cd', $warehouseCd)->first();
                        $mtCustomer->mt_warehouse_order_receive_id = $code['id'];
                    }
                    if (!empty($rec['ルートコード'])) {
                        $rootCd = str_pad($rec['ルートコード'], 4, 0, STR_PAD_LEFT);
                        $code = MtRoot::where('root_cd', $rootCd)->first();
                        $mtCustomer->mt_root_id = $code['id'];
                    }
                    //運送会社コード
                    if (!empty($rec['運送会社コード'])) {
                        $code = MtItemClass::where('item_class_cd', $rec['運送会社コード'])->where('def_item_class_thing_id', 1)->first();
                        $mtCustomer->mt_item_class_shipping_companie_id = $code['id'];
                    }
                    // 売上伝票種別コード
                    if (!empty($rec['売上伝票種別コード'])) {
                        $code = MtSlipKind::where('slip_kind_cd', $rec['売上伝票種別コード'])->where('def_slip_kind_kbn_id', 2)->first();
                        $mtCustomer->mt_slip_kind_sale_id = $code['id'];
                    }
                    //得意先着日コード
                    if (!empty($rec['得意先着日コード'])) {
                        $code = DefArrivalDate::where('arrival_date_cd', $rec['得意先着日コード'])->first();
                        $mtCustomer->def_arrival_date_id = $code['id'];
                    }
                    if (isset($rec['得意先備考1'])) $mtCustomer->customer_memo_1 = $rec['得意先備考1'];
                    if (isset($rec['得意先備考2'])) $mtCustomer->customer_memo_2 = $rec['得意先備考2'];
                    if (isset($rec['得意先備考3'])) $mtCustomer->customer_memo_3 = $rec['得意先備考3'];
                    if (isset($rec['得意先拡張1'])) $mtCustomer->customer_expansion_1 = $rec['得意先拡張1'];
                    if (isset($rec['得意先拡張2'])) $mtCustomer->customer_expansion_2 = $rec['得意先拡張2'];
                    if (isset($rec['得意先拡張3'])) $mtCustomer->customer_expansion_3 = $rec['得意先拡張3'];
                    if (isset($rec['得意先拡張4'])) $mtCustomer->customer_expansion_4 = $rec['得意先拡張4'];
                    if (isset($rec['得意先拡張5'])) $mtCustomer->customer_expansion_5 = $rec['得意先拡張5'];
                    $mtCustomer->mt_user_last_update_id = Auth::user()->id;
                    $mtCustomer->save();

                    //得意先別担当者マスタ
                    if (!empty($mtManager)) {
                        $mtCustomerManagerExists = MtCustomerManager::where('mt_customer_id', $mtCustomer['id'])->where('mt_manager_id', $mtManager['id'])->exists();
                        if ($mtCustomerManagerExists) {
                            //更新
                            $mtCustomerManager = MtCustomerManager::where('mt_customer_id', $mtCustomer['id'])->where('mt_manager_id', $mtManager['id'])->first();
                            $mtCustomerManager->mt_user_last_update_id = Auth::user()->id;
                            $mtCustomerManager->save();
                        } else {
                            //新規登録
                            $mtCustomerManager = new MtCustomerManager();
                            $mtCustomerManager->mt_customer_id = $mtCustomer['id'];
                            $mtCustomerManager->mt_manager_id = $mtManager['id'];
                            $mtCustomerManager->mt_user_last_update_id = Auth::user()->id;
                            $mtCustomerManager->save();
                        }
                    }
                }
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
            Log::info($result);
        }
        return $result;
    }

    /**
     * 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['customer_cd'] ? CodeUtil::pad($params['customer_cd'], 6) : null;

        $query = MtCustomer::query();
        $query->where('customer_cd', $code);

        if (isset($params['with_sticky_note'])) {
            $query->with('mtOrderReceiveStickyNote');
        }
        if (isset($params['with_customer_manager'])) {
            $query->with('mtCustomerManagers');
        }
        if (isset($params['with_billing_address'])) {
            $query->with('mtBillingAddress');
        }

        return $query->first();
    }

    /**
     * 得意先マスタ詳細 更新
     * @param $params
     * @return Object
     */
    public function updateDetail($param)
    {
        //得意先マスタ, 請求先マスタ,
        $result = array();
        try {
            DB::beginTransaction();
            //請求先マスタ
            $mtBillingAddressExists = MtBillingAddress::where('billing_address_cd', $param['mt_billing_address_cd'])->exists();
            if ($mtBillingAddressExists) {
                //更新
                $mtBillingAddress = MtBillingAddress::where('billing_address_cd', $param['mt_billing_address_cd'])->first();
            } else {
                //新規登録
                $mtBillingAddress = new MtBillingAddress();
                $mtBillingAddress->billing_address_cd = $param['mt_billing_address_cd'];
            }
            $mtBillingAddress->sequentially_kbn = $param['sequentially_kbn'];
            if (isset($param['closing_date_1'])) $mtBillingAddress->closing_date_1 = $param['closing_date_1'];
            if (isset($param['closing_date_2'])) {
                $mtBillingAddress->closing_date_2 = $param['closing_date_2'];
            } else {
                $mtBillingAddress->closing_date_2 = null;
            }
            if (isset($param['closing_date_3'])) {
                $mtBillingAddress->closing_date_3 = $param['closing_date_3'];
            } else {
                $mtBillingAddress->closing_date_3 = null;
            }

            if (isset($param['collect_month_1'])) {
                if ($param['collect_month_1'] == 3 && !empty($param['collect_month_1_txt'])) {
                    $mtBillingAddress->collect_month_1 = $param['collect_month_1_txt'];
                } else {
                    $mtBillingAddress->collect_month_1  = $param['collect_month_1'];
                }
            }
            if (isset($param['closing_date_2']) && isset($param['collect_month_2'])) {
                if ($param['collect_month_2'] == 3 && !empty($param['collect_month_2_txt'])) {
                    $mtBillingAddress->collect_month_2 = $param['collect_month_2_txt'];
                } else {
                    $mtBillingAddress->collect_month_2  = $param['collect_month_2'];
                }
            } else {
                $mtBillingAddress->collect_month_2 = null;
            }
            if (isset($param['closing_date_3']) && isset($param['collect_month_3'])) {
                if ($param['collect_month_3'] == 3 && !empty($param['collect_month_3_txt'])) {
                    $mtBillingAddress->collect_month_3 = $param['collect_month_3_txt'];
                } else {
                    $mtBillingAddress->collect_month_3  = $param['collect_month_3'];
                }
            } else {
                $mtBillingAddress->collect_month_3 = null;
            }
            if (isset($param['collect_date_1'])) $mtBillingAddress->collect_date_1  = $param['collect_date_1'];
            if (isset($param['collect_date_2'])) {
                $mtBillingAddress->collect_date_2 = $param['collect_date_2'];
            } else {
                $mtBillingAddress->collect_date_2 = null;
            }
            if (isset($param['collect_date_3'])) {
                $mtBillingAddress->collect_date_3 = $param['collect_date_3'];
            } else {
                $mtBillingAddress->collect_date_3 = null;
            }
            if (isset($param['credit_limit_amount']) && '' != $param['credit_limit_amount']) {
                $mtBillingAddress->credit_limit_amount = str_replace(',', '', $param['credit_limit_amount']);
            } else {
                $mtBillingAddress->credit_limit_amount = null;
            }
            $mtBillingAddress->price_fraction_process  = $param['price_fraction_process'];
            $mtBillingAddress->all_amount_fraction_process  = $param['all_amount_fraction_process'];
            $mtBillingAddress->tax_kbn  = $param['tax_kbn'];
            $mtBillingAddress->tax_calculation_standard  = $param['tax_calculation_standard'];
            $mtBillingAddress->tax_fraction_process_yen  = $param['tax_fraction_process_yen'];
            $mtBillingAddress->tax_fraction_process  = $param['tax_fraction_process'];
            $mtBillingAddress->invoice_mailing_flg  = $param['invoice_mailing_flg'];
            $mtBillingAddress->invoice_kind_flg  = $param['invoice_kind_flg'];
            $mtBillingAddress->sale_decision_print_paper_flg  = $param['sale_decision_print_paper_flg'];
            $mtBillingAddress->mt_user_last_update_id = Auth::user()->id;
            $mtBillingAddress->save();

            //得意先マスタ
            $mtCustomerExists = MtCustomer::where('customer_cd', $param['customer_cd'])->exists();

            if ($mtCustomerExists) {
                //更新
                $mtCustomer = MtCustomer::where('customer_cd', $param['customer_cd'])->first();

                // エラーチェック
                try {
                    // 元々請求先の締日と更新後の請求先の締日が異なるかどうかはここでチェックする
                    $originalBillingAddress = MtBillingAddress::where('id', $mtCustomer->mt_billing_address_id)->first();
                    if (!empty($originalBillingAddress) && $originalBillingAddress->id != $mtBillingAddress->id) {
                        if (
                            $originalBillingAddress->closing_date_1 != $mtBillingAddress->closing_date_1
                            || $originalBillingAddress->closing_date_2 != $mtBillingAddress->closing_date_2
                            || $originalBillingAddress->closing_date_3 != $mtBillingAddress->closing_date_3
                        ) {
                            throw new Exception('締日の異なる得意先を指定することはできません');
                        }
                    }
                } catch (\Exception $e) {
                    Log::info($e->getMessage());
                    DB::rollback();
                    $result['status'] = CommonConsts::STATUS_ERROR;
                    $result['customError'] = $e->getMessage();
                    return $result;
                }
            } else {
                //新規登録
                $mtCustomer = new MtCustomer();
                $mtCustomer->customer_cd = $param['customer_cd'];
                $mtCustomer->mt_user_register_id = Auth::user()->id;
            }
            $mtCustomer->mt_billing_address_id = $mtBillingAddress['id'];
            $mtCustomer->mt_order_receive_sticky_note_id = $param['hidden_order_receive_sticky_note'];
            $mtCustomer->customer_name = $param['customer_name'];
            $mtCustomer->customer_name_kana = $param['customer_name_kana'];
            $mtCustomer->honorific_kbn = $param['honorific_kbn'];
            $mtCustomer->post_number = $param['post_number'];
            $mtCustomer->address = $param['address'];
            $mtCustomer->tel = $param['tel'];
            $mtCustomer->fax = $param['fax'];
            $mtCustomer->direct_delivery_slip_mailing_flg = $param['direct_delivery_slip_mailing_flg'];
            //def_district_class_cd 地区分類定義ID
            $defDistrictClass = DefDistrictClass::where('district_class_cd', $param['def_district_class_cd'])->first();
            $mtCustomer->def_district_class_id = empty($defDistrictClass) ? null : $defDistrictClass['id'];
            // def_pioneer_year_cd 開拓年分類定義ＩＤ
            $defPioneerYear = DefPioneerYear::where('pioneer_year_cd', $param['def_pioneer_year_cd'])->first();
            $mtCustomer->def_pioneer_year_id = empty($defPioneerYear) ? null : $defPioneerYear['id'];
            // customer_class_cd1
            $customerClass1 = MtCustomerClass::where('def_customer_class_thing_id', 1)->where('customer_class_cd', $param['customer_class_cd1'])->first();
            $mtCustomer->mt_customer_class1_id = empty($customerClass1) ? null : $customerClass1['id'];
            $customerClass2 = MtCustomerClass::where('def_customer_class_thing_id', 2)->where('customer_class_cd', $param['customer_class_cd2'])->first();
            $mtCustomer->mt_customer_class2_id = empty($customerClass2) ? null : $customerClass2['id'];
            $customerClass3 = MtCustomerClass::where('def_customer_class_thing_id', 3)->where('customer_class_cd', $param['customer_class_cd3'])->first();
            $mtCustomer->mt_customer_class3_id = empty($customerClass3) ? null : $customerClass3['id'];

            $mtCustomer->representative_name = $param['representative_name'];
            $mtCustomer->representative_mail = $param['representative_mail'];
            $mtCustomer->invoice_notification_mail_1 = $param['invoice_notification_mail_1'];
            $mtCustomer->invoice_notification_mail_2 = $param['invoice_notification_mail_2'];
            $mtCustomer->payment_guidance_mail = $param['payment_guidance_mail'];
            $mtCustomer->payment_guidance_send_flg = $param['payment_guidance_send_flg'];
            $mtCustomer->customer_url = $param['customer_url'];
            if (isset($param['delivery_price']) && '' != $param['delivery_price']) {
                $mtCustomer->delivery_price = str_replace(',', '', $param['delivery_price']);
            } else {
                $mtCustomer->delivery_price = null;
            }
            $mtCustomer->price_rate = $param['price_rate'];
            $mtManager = MtUser::where('user_cd', $param['manager_cd'])->first();
            $mtCustomer->mt_user_id = empty($mtManager) ? null : $mtManager['id'];
            if (isset($param['credit_limit_amount_check_flg'])) $mtCustomer->credit_limit_amount_check_flg = $param['credit_limit_amount_check_flg'];
            $mtCustomer->name_input_kbn = $param['name_input_kbn'];
            $mtCustomer->del_kbn = $param['del_kbn'];
            $mtCustomer->tax_fare_rate_application = $param['tax_fare_rate_application'];
            $mtWarehouse = MtWarehouse::where('warehouse_cd', $param['warehouse_cd'])->first();
            $mtCustomer->mt_warehouse_order_receive_id = empty($mtWarehouse) ? null : $mtWarehouse['id'];
            $mtCustomer->payment_kbn = $param['payment_kbn'];
            $mtRoot = MtRoot::where('root_cd', $param['root_cd'])->first();
            $mtCustomer->mt_root_id = $mtRoot['id'];
            $mtItemClass = MtItemClass::where('def_item_class_thing_id', 1)->where('item_class_cd', $param['shipping_companie_cd'])->first();
            $mtCustomer->mt_item_class_shipping_companie_id = empty($mtItemClass) ? null : $mtItemClass['id'];
            $mtSlipKind = MtSlipKind::where('def_slip_kind_kbn_id', 2)->where('slip_kind_cd', $param['slip_kind_sale'])->first();
            $mtCustomer->mt_slip_kind_sale_id = empty($mtSlipKind) ? null : $mtSlipKind['id'];
            $arrivalDate = DefArrivalDate::where('arrival_date_cd', $param['arrival_date'])->first();
            $mtCustomer->def_arrival_date_id = empty($arrivalDate) ? null : $arrivalDate['id'];
            $mtCustomer->customer_memo_1 = $param['customer_memo_1'];
            $mtCustomer->customer_memo_2 = $param['customer_memo_2'];
            $mtCustomer->customer_memo_3 = $param['customer_memo_3'];
            $mtCustomer->customer_expansion_1 = $param['customer_expansion_1'];
            $mtCustomer->customer_expansion_2 = $param['customer_expansion_2'];
            $mtCustomer->customer_expansion_3 = $param['customer_expansion_3'];
            $mtCustomer->customer_expansion_4 = $param['customer_expansion_4'];
            $mtCustomer->customer_expansion_5 = $param['customer_expansion_5'];
            $mtCustomer->mt_user_last_update_id = Auth::user()->id;
            $mtCustomer->save();

            //担当者登録・更新
            //mt_managers
            //mt_customer_managers
            $originalManagerId = MtCustomerManager::where('mt_customer_id', $mtCustomer->id)->pluck('mt_manager_id');
            $originalManagerCd = MtManager::whereIn('id', $originalManagerId)->pluck('manager_cd')->toArray();

            if (isset($param['customer_manager_cd'])) {
                foreach ($param['customer_manager_cd'] as $index => $customer_manager_cd) {
                    if (
                        $param['customer_manager_name'][$index] == null ||
                        $param['customer_manager_mail'][$index] == null ||
                        $param['ec_login_id'][$index] == null ||
                        $param['change_password_flg'][$index] == '1' && $param['ec_login_password'][$index] == null ||
                        $param['validity_flg'][$index] == null ||
                        $param['display_order'][$index] == null
                    ) {
                        continue;
                    }
                    $mtManagerExists = MtManager::where('manager_cd', $customer_manager_cd)->exists();

                    if ($mtManagerExists) {
                        //更新
                        $mtManager = MtManager::where('manager_cd', $customer_manager_cd)->first();
                    } else {
                        //新規登録
                        $mtManager = new MtManager();
                        $lastMtManager = MtManager::orderBy('manager_cd', 'desc')->first();
                        $manager_cd = intval($lastMtManager->manager_cd) + 1;
                        $mtManager->manager_cd = $manager_cd;
                    }
                    $mtManager->manager_name =  $param['customer_manager_name'][$index];
                    $mtManager->manager_mail =  $param['customer_manager_mail'][$index];
                    $mtManager->ec_login_id =  $param['ec_login_id'][$index];
                    if ($param['change_password_flg'][$index] == 1) {
                        $mtManager->ec_login_password =  Hash::make($param['ec_login_password'][$index]);
                    }
                    $mtManager->validity_flg =  $param['validity_flg'][$index];
                    $mtManager->display_order =  $param['display_order'][$index];
                    $mtManager->memo =  $param['customer_memo'][$index];
                    $mtManager->mt_user_last_update_id = Auth::user()->id;
                    $mtManager->save();

                    $mtCustomerManagerExists = MtCustomerManager::where('mt_customer_id', $mtCustomer->id)->where('mt_manager_id',  $mtManager->id)->exists();
                    if ($mtCustomerManagerExists) {
                        //更新
                        $mtCustomerManager = MtCustomerManager::where('mt_customer_id', $mtCustomer->id)->where('mt_manager_id',  $mtManager->id)->first();
                    } else {
                        //新規登録
                        $mtCustomerManager = new MtCustomerManager();
                        $mtCustomerManager->mt_customer_id = $mtCustomer->id;
                        $mtCustomerManager->mt_manager_id = $mtManager->id;
                    }

                    $mtCustomerManager->mt_user_last_update_id = Auth::user()->id;
                    $mtCustomerManager->save();
                }
            }

            $deleteManagerCd = array_diff($originalManagerCd, $param['customer_manager_cd'] ? $param['customer_manager_cd'] : []);
            $deleteManagerIds =  MtManager::whereIn('manager_cd', $deleteManagerCd)->pluck('id');

            if (!empty($deleteManagerIds)) {
                MtCustomerManager::where('mt_customer_id', $mtCustomer->id)->whereIn('mt_manager_id', $deleteManagerIds)->delete();
                Favorite::whereIn('mt_manager_id', $deleteManagerIds)->delete();
                MtCart::whereIn('mt_manager_id', $deleteManagerIds)->delete();
                PasswordToken::whereIn('mt_manager_id', $deleteManagerIds)->delete();
                MtManager::destroy($deleteManagerIds);
            }

            DB::commit();

            foreach ($param['ec_login_id'] as $index => $ec_login_id) {
                if ($param['send_password_flg'][$index] == '1') {
                    // TODO メール送信処理
                    $mtManager = MtManager::where('ec_login_id', $ec_login_id)->first();
                    $raw_password = $param['ec_login_password'][$index];
                    if (is_null($mtManager) || is_null($raw_password)) {
                        continue;
                    }
                    $mail_address = $mtManager->manager_mail;
                    $mail_result = Mail::to($mail_address)->cc(env('MAIL_CC_ADDRESS'))->send(new UserRegistrationMail($mtManager, $raw_password));
                    $mtManager->ec_password_issue_mail_last_send_datetime = date("Y/m/d H:i:s");
                    $mtCustomerManager->save();
                }
            }
            $result['status'] = CommonConsts::STATUS_SUCCESS;
            $result['mtBillingAddressId'] = $mtBillingAddress['id'];
            $result['mtCustomerId'] = $mtCustomer['id'];
            $result['mtBillingAddressId'] = $mtBillingAddress['id'];
            $result['mtCustomerId'] = $mtCustomer['id'];
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * 得意先マスタを削除
     * @param $id
     * @return Object
     */
    public function deleteDetail($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            // 得意先(mt_customers), 請求先(mt_billing_addresses), 担当者(mt_managers), 得意先別担当者(mt_customer_managers)
            $targetCustomer = MtCustomer::where('id', $id)->first();


            $deleteManagerIds = MtCustomerManager::where('mt_customer_id', $targetCustomer->id)->pluck('mt_manager_id');
            MtCustomerManager::where('mt_customer_id', $targetCustomer->id)->delete();
            Favorite::whereIn('mt_manager_id', $deleteManagerIds)->delete();
            MtCart::whereIn('mt_manager_id', $deleteManagerIds)->delete();
            PasswordToken::whereIn('mt_manager_id', $deleteManagerIds)->delete();
            MtManager::destroy($deleteManagerIds);
            MtCustomer::where('id', $id)->delete();
            // 削除する請求先は得意先マスタが参照している請求先ではなく、得意先コードと同じ請求先コードをもつ請求先
            MtBillingAddress::where('billing_address_cd', $targetCustomer->customer_cd)->delete();
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            Log::info($e->getMessage());
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }
}
