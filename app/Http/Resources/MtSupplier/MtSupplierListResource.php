<?php

namespace App\Http\Resources\MtSupplier;

use Illuminate\Http\Resources\Json\JsonResource;

class MtSupplierListResource extends JsonResource
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
            'supplier_cd' => $this->mt_suppliers.supplier_cd,  //仕入先マスタ.仕入先コード
            'supplier_name' => $this->mt_suppliers.supplier_name,  //仕入先マスタ.仕入先名
            'supplier_name_kana' => $this->mt_suppliers.supplier_name_kana,  //仕入先マスタ.仕入先名カナ
            'pay_destination_cd' => $this->mt_pay_destinations.pay_destination_cd,  //支払先マスタ.支払先コード
            'supplier_name' => $this->mt_suppliers.supplier_name,  //仕入先マスタ.仕入先名
            'user_cd' => $this->mt_users.user_cd,  //ユーザマスタ.ユーザコード
            'user_name' => $this->mt_users.user_name,  //ユーザマスタ.ユーザ名
            'honorific_kbn' => $this->mt_suppliers.honorific_kbn,  //仕入先マスタ.敬称区分
            'post_number' => $this->mt_suppliers.post_number,  //仕入先マスタ.郵便番号
            'address' => $this->mt_suppliers.address,  //仕入先マスタ.住所
            'tel' => $this->mt_suppliers.tel,  //仕入先マスタ.ＴＥＬ
            'fax' => $this->mt_suppliers.fax,  //仕入先マスタ.ＦＡＸ
            'representative_name' => $this->mt_suppliers.representative_name,  //仕入先マスタ.代表者名
            'representative_mail' => $this->mt_suppliers.representative_mail,  //仕入先マスタ.代表者メール
            'supplier_manager_name' => $this->mt_suppliers.supplier_manager_name,  //仕入先マスタ.仕入先担当者名
            'supplier_manager_mail' => $this->mt_suppliers.supplier_manager_mail,  //仕入先マスタ.仕入先担当者メール
            'supplier_class_cd' => $this->msc1.supplier_class_cd,  //仕入先分類マスタ.仕入先分類コード
            'supplier_class_name' => $this->msc1.supplier_class_name,  //仕入先分類マスタ.仕入先分類名
            'supplier_class_cd' => $this->msc2.supplier_class_cd,  //仕入先分類マスタ.仕入先分類コード
            'supplier_class_name' => $this->msc2.supplier_class_name,  //仕入先分類マスタ.仕入先分類名
            'supplier_class_cd' => $this->msc3.supplier_class_cd,  //仕入先分類マスタ.仕入先分類コード
            'supplier_class_name' => $this->msc3.supplier_class_name,  //仕入先分類マスタ.仕入先分類名
            'sequentially_kbn' => $this->mt_pay_destinations.sequentially_kbn,  //支払先マスタ.随時区分
            'closing_date' => $this->mt_pay_destinations.closing_date,  //支払先マスタ.締日
            'closing_month' => $this->mt_pay_destinations.closing_month,  //支払先マスタ.締月
            'pay_date' => $this->mt_pay_destinations.pay_date,  //支払先マスタ.支払日
            'supplier_url' => $this->mt_suppliers.supplier_url,  //仕入先マスタ.仕入先ＵＲＬ
            'name_input_kbn' => $this->mt_suppliers.name_input_kbn,  //仕入先マスタ.名称入力区分
            'del_kbn' => $this->mt_suppliers.del_kbn,  //仕入先マスタ.削除区分
            'price_fraction_process' => $this->mt_pay_destinations.price_fraction_process,  //支払先マスタ.単価端数処理
            'all_amount_fraction_process' => $this->mt_pay_destinations.all_amount_fraction_process,  //支払先マスタ.全額端数処理
            'tax_kbn' => $this->mt_pay_destinations.tax_kbn,  //支払先マスタ.消費税：税区分
            'tax_calculation_standard' => $this->mt_pay_destinations.tax_calculation_standard,  //支払先マスタ.消費税：算出基準
            'tax_fraction_process_1' => $this->mt_pay_destinations.tax_fraction_process_1,  //支払先マスタ.消費税：端数処理（円）
            'tax_fraction_process_2' => $this->mt_pay_destinations.tax_fraction_process_2,  //支払先マスタ.消費税：端数処理
            'slip_kind_cd' => $this->mt_slip_kinds.slip_kind_cd,  //伝票種別マスタ.伝票種別コード
            'slip_kind_name' => $this->mt_slip_kinds.slip_kind_name,  //伝票種別マスタ.伝票種別名
            'supplier_memo_1' => $this->mt_suppliers.supplier_memo_1,  //仕入先マスタ.仕入先備考１
            'supplier_memo_2' => $this->mt_suppliers.supplier_memo_2,  //仕入先マスタ.仕入先備考２
            'supplier_memo_3' => $this->mt_suppliers.supplier_memo_3,  //仕入先マスタ.仕入先備考３
            'supplier_expansion_1' => $this->mt_suppliers.supplier_expansion_1,  //仕入先マスタ.仕入先拡張１
            'supplier_expansion_2' => $this->mt_suppliers.supplier_expansion_2,  //仕入先マスタ.仕入先拡張２
            'supplier_expansion_3' => $this->mt_suppliers.supplier_expansion_3,  //仕入先マスタ.仕入先拡張３
            'supplier_expansion_4' => $this->mt_suppliers.supplier_expansion_4,  //仕入先マスタ.仕入先拡張４
            'supplier_expansion_5' => $this->mt_suppliers.supplier_expansion_5,  //仕入先マスタ.仕入先拡張５
        ];
    }
}
