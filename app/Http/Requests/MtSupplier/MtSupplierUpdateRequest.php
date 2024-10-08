<?php

namespace App\Http\Requests\MtSupplier;

use App\Repositories\MtPayDestination\MtPayDestinationRepository;
use App\Repositories\MtSlipKind\MtSlipKindRepository;
use App\Repositories\MtSupplier\MtSupplierRepository;
use App\Repositories\MtSupplierClass\MtSupplierClassRepository;
use App\Repositories\MtUser\MtUserRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

/**
 * リクエストパラメータ
 */
class MtSupplierUpdateRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = array();
        if ($this->has('cancel')) {
            $rules = [
                'cancel' => 'nullable',
            ];
        }
        if ($this->has('delete')) {
            $rules = [
                'delete' => 'nullable',
            ];
        }
        if ($this->has('update')) {
            $rules = [
                'supplier_cd' => 'required|digits:6',
                'user_cd' => 'required|digits:4',
                'pay_destination_cd' => 'required|digits:6',
                'supplier_name' => 'required|max:60',
                'supplier_name_kana' => 'nullable|max:10',
                'honorific_kbn' => 'required|in:1,2',
                'post_number' => 'nullable|between:6,8|regex:/^[0-9-]+$/',
                'address' => 'nullable|max:90',
                'tel' => 'nullable|max:15|regex:/^[0-9-]+$/',
                'fax' => 'nullable|max:15|regex:/^[0-9-]+$/',
                'representative_name' => 'nullable|max:30',
                'representative_mail' => 'nullable|max:256|email',
                'supplier_manager_name' => 'nullable|max:30',
                'supplier_manager_mail' => 'nullable',
                'mt_supplier_class1_cd' => 'required|max:6',
                'mt_supplier_class2_cd' => 'nullable',
                'mt_supplier_class3_cd' => 'nullable',
                'supplier_url' => 'nullable|max:2083',
                'sequentially_kbn' => 'required|in:0, 1',
                'closing_date' => 'required_if:sequentially_kbn,0',
                'closing_month' => 'required_if:sequentially_kbn,0',
                'pay_date' => 'required_if:sequentially_kbn,0',
                'data_decision_date_y' => 'nullable',
                'data_decision_date_m' => 'nullable',
                'data_decision_date_d' => 'nullable',
                'def_arrival_date_cd' => 'nullable|exists:def_arrival_dates:arrival_date_cd',
                'name_input_kbn' => 'required|in:0,1',
                'del_kbn' => 'required|in:0,1',
                'price_fraction_process' => 'required',
                'all_amount_fraction_process' => 'required',
                'mt_slip_kind_order_cd' => 'required',
                'tax_kbn' => 'required',
                'tax_calculation_standard' => 'required',
                'tax_fraction_process_1' => 'required',
                'tax_fraction_process_2' => 'required',
                'supplier_memo_1' => 'nullable:max:30',
                'supplier_memo_2' => 'nullable:max:30',
                'supplier_memo_3' => 'nullable:max:30',
                'supplier_expansion_1' => 'nullable:max:20',
                'supplier_expansion_2' => 'nullable:max:20',
                'supplier_expansion_3' => 'nullable:max:20',
                'supplier_expansion_4' => 'nullable:max:20',
                'supplier_expansion_5' => 'nullable:max:20',
                'update' => 'nullable',
                'update_id' => 'nullable',
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'supplier_cd' => __('validation.attributes.mt_suppliers.supplier_cd'),
            'user_cd' => __('validation.attributes.mt_suppliers.manager_cd'),
            'pay_destination_cd' => __('validation.attributes.mt_pay_destinations.pay_destination_cd'),
            'supplier_name' => __('validation.attributes.mt_suppliers.supplier_name'),
            'supplier_name_kana' => __('validation.attributes.mt_suppliers.supplier_name_kana'),
            'honorific_kbn' => __('validation.attributes.mt_suppliers.honorific_kbn'),
            'post_number' => __('validation.attributes.mt_suppliers.post_number'),
            'address' => __('validation.attributes.mt_suppliers.address'),
            'tel' => __('validation.attributes.mt_suppliers.tel'),
            'fax' => __('validation.attributes.mt_suppliers.fax'),
            'representative_name' => __('validation.attributes.mt_suppliers.representative_name'),
            'representative_mail' => __('validation.attributes.mt_suppliers.representative_mail'),
            'supplier_manager_mail' => __('validation.attributes.mt_suppliers.supplier_manager_mail'),
            'mt_supplier_class1_cd' => __('validation.attributes.mt_suppliers.mt_supplier_class1_cd'),
            'supplier_url' => __('validation.attributes.mt_suppliers.supplier_url'),
            'sequentially_kbn' => __('validation.attributes.mt_pay_destinations.sequentially_kbn'),
            'closing_date' => __('validation.attributes.mt_pay_destinations.closing_date'),
            'closing_month' => __('validation.attributes.mt_pay_destinations.closing_month'),
            'data_decision_date_y' => __('validation.attributes.mt_suppliers.data_decision_date'),
            'data_decision_date_m' => __('validation.attributes.mt_suppliers.data_decision_date'),
            'data_decision_date_d' => __('validation.attributes.mt_suppliers.data_decision_date'),
            'name_input_kbn' => __('validation.attributes.mt_suppliers.name_input_kbn'),
            'del_kbn' => __('validation.attributes.mt_suppliers.del_kbn'),
            'price_fraction_process' => __('validation.attributes.mt_pay_destinations.price_fraction_process'),
            'all_amount_fraction_process' => __('validation.attributes.mt_pay_destinations.all_amount_fraction_process'),
            'mt_slip_kind_order_cd' => __('validation.attributes.mt_suppliers.mt_slip_kind_order_cd'),
            'tax_kbn' => __('validation.attributes.mt_pay_destinations.tax_kbn'),
            'tax_calculation_standard' => __('validation.attributes.mt_pay_destinations.tax_calculation_standard'),
            'tax_fraction_process_1' => __('validation.attributes.mt_pay_destinations.tax_fraction_process_1'),
            'tax_fraction_process_2' => __('validation.attributes.mt_pay_destinations.tax_fraction_process_2'),
            'supplier_memo_1' => __('validation.attributes.mt_pay_destinations.supplier_memo_1'),
            'supplier_memo_2' => __('validation.attributes.mt_pay_destinations.supplier_memo_1'),
            'supplier_memo_3' => __('validation.attributes.mt_pay_destinations.supplier_memo_1'),
        ];
    }

    // validation.phpだとsequentially_kbnの値が0,1になるので別途定義する（やり方わからない）
    public function messages()
    {
        return [
            'closing_date' => '締日は随時区分が通常の場合必須です',
            'closing_month' => '締日(月)は随時区分が通常の場合必須です', // radioボタンなので実際は必要ない
            'pay_date' => '支払日は随時区分が通常の場合必須です',
        ];
    }

    // DB参照を伴うのでRuleクラスで個別に取得ではなくafterで取得し使いまわす
    // ※フォームのバリデーションなので本来はここではなくModelでやるべきだが、修正するなら後で
    public function after(): array
    {
        if (!request()->has('update')) return [];
        $nowSupplier = (new MtSupplierRepository())->getByCode(request());
        $newPayDestination = (new MtPayDestinationRepository())->getByCode(request());
        $supplierClassRepository = new MtSupplierClassRepository();
        return [
            function (Validator $validator) use ($nowSupplier, $newPayDestination) {
                if ($this->diffrentCode($nowSupplier, $newPayDestination)) {
                    $validator->errors()->add('code', __('validation.custom.mt_supplier.different_code'));
                } elseif ($this->squentially($newPayDestination)) {
                    $validator->errors()->add('sequentially_kbn', __('validation.custom.mt_supplier.squentially'));
                } elseif ($this->deletedSupplier($newPayDestination)) {
                    $validator->errors()->add('del_kbn', __('validation.custom.mt_supplier.deleted_supplier'));
                } elseif ($this->differentClosing($nowSupplier, $newPayDestination)) {
                    $validator->errors()->add('closing', __('validation.custom.mt_supplier.different_closing'));
                }
            },
            function (Validator $validator) use ($supplierClassRepository) {
                if ($this->notExistSupplierClass1($supplierClassRepository)) {
                    $validator->errors()->add('supplier_class', __('validation.custom.not_exist_supplier_class1'));
                }
            },
            function (Validator $validator) use ($supplierClassRepository) {
                if ($this->notExistSupplierClass2($supplierClassRepository)) {
                    $validator->errors()->add('supplier_class', __('validation.custom.not_exist_supplier_class2'));
                }
            },
            function (Validator $validator) use ($supplierClassRepository) {
                if ($this->notExistSupplierClass3($supplierClassRepository)) {
                    $validator->errors()->add('supplier_class', __('validation.custom.not_exist_supplier_class3'));
                }
            },
            function (Validator $validator) {
                if ($this->notExistUser()) {
                    $validator->errors()->add('user', __('validation.custom.mt_supplier.not_exist_user'));
                }
            },
            function (Validator $validator) {
                if ($this->notExistSlipKind()) {
                    $validator->errors()->add('slip_kind', __('validation.custom.not_exist_slip_kind'));
                }
            },
            function (Validator $validator) use ($nowSupplier, $newPayDestination) {
                if ($this->changePayDestination($nowSupplier, $newPayDestination)) {
                    $validator->errors()->add('pay_destination', __('validation.custom.mt_supplier.change_pay_destination'));
                    request()->merge(['pay_destination_cd' => $nowSupplier->pay_destination_cd]);
                }
            },
        ];
    }

    // 新規仕入先,新規支払先登録時にコード不一致
    private function diffrentCode($nowSupplier, $newPayDestination)
    {
        if ((is_null($nowSupplier)) && (is_null($newPayDestination))) return $this->isNotEqualCode();
        return false;
    }

    // 支払先が随時
    private function squentially($newPayDestination)
    {
        if (is_null($newPayDestination)) return false;
        return $this->isNotEqualCode() && $this->isSequentially($newPayDestination);
    }

    // 支払先に紐づく仕入先が論理削除済み
    private function deletedSupplier($newPayDestination)
    {
        if (is_null($newPayDestination)) return false;
        return $newPayDestination->del_kbn !== 0;
    }

    // 変更先の支払先締日が違う
    private function differentClosing($nowSupplier, $newPayDestination)
    {
        if (is_null($nowSupplier)) return false;
        if (is_null($newPayDestination)) return false;
        return $this->isDifferentClosingDate($nowSupplier, $newPayDestination)
            && $this->isDifferentClosingMonth($nowSupplier, $newPayDestination);
    }

    // 仕入先分類1が存在しない
    private function notExistSupplierClass1(MtSupplierClassRepository $supplierClassRepository)
    {
        if (is_null(request()->mt_supplier_class1_cd)) return false;
        return !($supplierClassRepository->isExist(request()->mt_supplier_class1_cd, 1));
    }

    // 仕入先分類2が存在しない
    private function notExistSupplierClass2(MtSupplierClassRepository $supplierClassRepository)
    {
        if (is_null(request()->mt_supplier_class2_cd)) return false;
        return !($supplierClassRepository->isExist(request()->mt_supplier_class2_cd, 2));
    }

    // 仕入先分類3が存在しない
    private function notExistSupplierClass3(MtSupplierClassRepository $supplierClassRepository)
    {
        if (is_null(request()->mt_supplier_class3_cd)) return false;
        return !($supplierClassRepository->isExist(request()->mt_supplier_class3_cd, 3));
    }

    // ユーザーが存在しない
    private function notExistUser()
    {
        if (is_null(request()->user_cd)) return false;
        $repository = new MtUserRepository();
        return !($repository->isExist(request()->user_cd));
    }

    // 伝票種別が存在しない
    private function notExistSlipKind()
    {
        if (is_null(request()->mt_slip_kind_order_cd)) return false;
        $repository = new MtSlipKindRepository();
        return !($repository->isExist(request()->mt_slip_kind_order_cd, '04'));
    }

    // 支払先を変更した
    private function changePayDestination($nowSupplier, $newPayDestination)
    {
        if (is_null($nowSupplier)) return false;
        return $newPayDestination?->id != $nowSupplier->mt_pay_destination_id;
    }

    private function isNotEqualCode()
    {
        return request()->pay_destination_cd !== request()->supplier_cd;
    }

    private function isSequentially($record)
    {
        return $record->sequentially_kbn === 1;
    }

    private function isDifferentClosingDate($nowSupplier, $newPayDestination)
    {
        return $nowSupplier->closing_date !== $newPayDestination->closing_date;
    }

    private function isDifferentClosingMonth($nowSupplier, $newPayDestination)
    {
        return $nowSupplier->closing_month !== $newPayDestination->closing_month;
    }
}
