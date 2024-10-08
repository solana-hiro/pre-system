<?php

namespace App\Http\Resources\MtCustomer;

use Illuminate\Http\Resources\Json\JsonResource;

class MtCustomerListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'customer_cd' => $this->mt_customers . customer_cd,  //得意先マスタ.得意先コード
            'customer_name' => $this->mt_customers . customer_name,  //得意先マスタ.得意先名
            'customer_name_kana' => $this->mt_customers . customer_name_kana,  //得意先マスタ.得意先名カナ
            'billing_address_cd' => $this->mt_billing_addresses . billing_address_cd,  //請求先マスタ.請求先コード
            'customer_cd' => $this->mt_customers . customer_cd,  //得意先マスタ.得意先名
            'sticky_note_name' => $this->mt_order_receive_sticky_notes . sticky_note_name,  //受注付箋マスタ.付箋名
            'payment_kbn' => $this->mt_customers . payment_kbn,  //得意先マスタ.入金区分
            'user_cd' => $this->mt_users . user_cd,  //ユーザマスタ.ユーザコード
            'user_name' => $this->mt_users . user_name,  //ユーザマスタ.ユーザ名
            'honorific_kbn' => $this->mt_customers . honorific_kbn,  //得意先マスタ.敬称区分
            'post_number' => $this->mt_customers . post_number,  //得意先マスタ.郵便番号
            'address' => $this->mt_customers . address,  //得意先マスタ.住所
            'tel' => $this->mt_customers . tel,  //得意先マスタ.ＴＥＬ
            'fax' => $this->mt_customers . fax,  //得意先マスタ.ＦＡＸ
            'representative_name' => $this->mt_customers . representative_name,  //得意先マスタ.代表者名
            'representative_mail' => $this->mt_customers . representative_mail,  //得意先マスタ.代表者メール
            'manager_name' => $this->mt_managers . manager_name,  //担当者マスタ.担当者名
            'manager_mail' => $this->mt_managers . manager_mail,  //担当者マスタ.担当者メールアドレス
            'ec_login_id' => $this->mt_managers . ec_login_id,  //担当者マスタ.ＥＣログインＩＤ
            'price_rate' => $this->mt_customers . price_rate,  //得意先マスタ.単価掛率
            'credit_limit_amount' => $this->mt_billing_addresses . credit_limit_amount,  //請求先マスタ.与信限度額
            'credit_limit_amount_check_flg' => $this->mt_customers . credit_limit_amount_check_flg,  //得意先マスタ.与信限度額チェックフラグ
            'customer_class_cd' => $this->mcc1 . customer_class_cd,  //得意先分類マスタ.得意先分類コード
            'customer_class_name' => $this->mcc1 . customer_class_name,  //得意先分類マスタ.得意先分類名
            'customer_class_cd' => $this->mcc2 . customer_class_cd,  //得意先分類マスタ.得意先分類コード
            'customer_class_name' => $this->mcc2 . customer_class_name,  //得意先分類マスタ.得意先分類名
            'customer_class_cd' => $this->mcc3 . customer_class_cd,  //得意先分類マスタ.得意先分類コード
            'customer_class_name' => $this->mcc3 . customer_class_name,  //得意先分類マスタ.得意先分類名
            'district_class_cd' => $this->def_district_classes . district_class_cd,  //地区分類定義.地区分類コード
            'district_class_name' => $this->def_district_classes . district_class_name,  //地区分類定義.地区分類名
            'pioneer_year_cd' => $this->def_pioneer_years . pioneer_year_cd,  //開拓年分類定義.開拓年分類コード
            'pioneer_year_name' => $this->def_pioneer_years . pioneer_year_name,  //開拓年分類定義.開拓年分類名
            'sequentially_kbn' => $this->mt_billing_addresses . sequentially_kbn,  //請求先マスタ.随時区分
            'closing_date_1' => $this->mt_billing_addresses . closing_date_1,  //請求先マスタ.締日１
            'collect_month_1' => $this->mt_billing_addresses . collect_month_1,  //請求先マスタ.回収月１
            'collect_date_1' => $this->mt_billing_addresses . collect_date_1,  //請求先マスタ.回収日１
            'closing_date_2' => $this->mt_billing_addresses . closing_date_2,  //請求先マスタ.締日２
            'collect_month_2' => $this->mt_billing_addresses . collect_month_2,  //請求先マスタ.回収月２
            'collect_date_2' => $this->mt_billing_addresses . collect_date_2,  //請求先マスタ.回収日２
            'closing_date_3' => $this->mt_billing_addresses . closing_date_3,  //請求先マスタ.締日３
            'collect_month_3' => $this->mt_billing_addresses . collect_month_3,  //請求先マスタ.回収月３
            'collect_date_3' => $this->mt_billing_addresses . collect_date_3,  //請求先マスタ.回収日３
            'invoice_notification_mail_1' => $this->mt_customers . invoice_notification_mail_1,  //得意先マスタ.請求書通知用メールアドレス１
            'invoice_notification_mail_2' => $this->mt_customers . invoice_notification_mail_2,  //得意先マスタ.請求書通知用メールアドレス２
            'payment_guidance_mail' => $this->mt_customers . payment_guidance_mail,  //得意先マスタ.入金案内用メールアドレス
            'payment_guidance_send_flg' => $this->mt_customers . payment_guidance_send_flg,  //得意先マスタ.入金案内送信要不要フラグ
            'customer_url' => $this->mt_customers . customer_url,  //得意先マスタ.得意先ＵＲＬ
            'name_input_kbn' => $this->mt_customers . name_input_kbn,  //得意先マスタ.名称入力区分
            'del_kbn' => $this->mt_customers . del_kbn,  //得意先マスタ.削除区分
            'price_fraction_process' => $this->mt_billing_addresses . price_fraction_process,  //請求先マスタ.単価端数処理
            'all_amount_fraction_process' => $this->mt_billing_addresses . all_amount_fraction_process,  //請求先マスタ.全額端数処理
            'なし' => $this->mt_customers . なし,  //得意先マスタ.消費税：税区分
            'tax_fare_rate_application' => $this->mt_customers . tax_fare_rate_application,  //得意先マスタ.消費税：運賃掛率適用
            'tax_calculation_standard' => $this->mt_billing_addresses . tax_calculation_standard,  //請求先マスタ.消費税：算出基準
            'tax_fraction_process_yen' => $this->mt_billing_addresses . tax_fraction_process_yen,  //請求先マスタ.消費税：端数処理（円）
            'tax_fraction_process' => $this->mt_billing_addresses . tax_fraction_process,  //請求先マスタ.消費税：端数処理
            'delivery_price' => $this->mt_customers . delivery_price,  //得意先マスタ.館内配送料
            'warehouse_cd' => $this->mt_warehouses . warehouse_cd,  //倉庫マスタ.倉庫コード
            'warehouse_name' => $this->mt_warehouses . warehouse_name,  //倉庫マスタ.倉庫名
            'root_cd' => $this->mt_roots . root_cd,  //ルートマスタ.ルートコード
            'root_name' => $this->mt_roots . root_name,  //ルートマスタ.ルート名
            'item_class_cd' => $this->mt_item_classes . item_class_cd,  //商品分類マスタ.商品分類コード
            'item_class_name' => $this->mt_item_classes . item_class_name,  //商品分類マスタ.商品分類名
            'arrival_date_cd' => $this->def_arrival_dates . arrival_date_cd,  //着日定義.着日コード
            'arrival_date_name' => $this->def_arrival_dates . arrival_date_name,  //着日定義.着日名
            'slip_kind_cd' => $this->mt_slip_kinds . slip_kind_cd,  //伝票種別マスタ.伝票種別コード
            'slip_kind_name' => $this->mt_slip_kinds . slip_kind_name,  //伝票種別マスタ.伝票種別名
            'invoice_kind_flg' => $this->mt_billing_addresses . invoice_kind_flg,  //請求先マスタ.請求書種別フラグ
            'direct_delivery_slip_mailing_flg' => $this->mt_customers . direct_delivery_slip_mailing_flg,  //得意先マスタ.直送納品書郵送要不要フラグ
            'invoice_mailing_flg' => $this->mt_billing_addresses . invoice_mailing_flg,  //請求先マスタ.請求書郵送要不要フラグ
            'sale_decision_print_paper_flg' => $this->mt_billing_addresses . sale_decision_print_paper_flg,  //請求先マスタ.売上確定時印刷用紙フラグ
            'customer_memo_1' => $this->mt_customers . customer_memo_1,  //得意先マスタ.得意先備考１
            'customer_memo_2' => $this->mt_customers . customer_memo_2,  //得意先マスタ.得意先備考２
            'customer_memo_3' => $this->mt_customers . customer_memo_3,  //得意先マスタ.得意先備考３
            'customer_expansion_1' => $this->mt_customers . customer_expansion_1,  //得意先マスタ.得意先拡張１
            'customer_expansion_2' => $this->mt_customers . customer_expansion_2,  //得意先マスタ.得意先拡張２
            'customer_expansion_3' => $this->mt_customers . customer_expansion_3,  //得意先マスタ.得意先拡張３
            'customer_expansion_4' => $this->mt_customers . customer_expansion_4,  //得意先マスタ.得意先拡張４
            'customer_expansion_5' => $this->mt_customers . customer_expansion_5,  //得意先マスタ.得意先拡張５
        ];
    }
}
