<?php

namespace App\Http\Requests\MtShippingCompany;

use App\Rules\ExistSlipKindForShippingLabel;
use App\Rules\ExistSlipKindForTag;
use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class UpdateRequest extends FormRequest
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
                'update' => 'nullable',
                'insert_shipping_company_code.*' => [
                    'required_with:insert_shipping_company_name.*',
                    'required_with:insert_slip_kind7.*',
                    'required_with:insert_slip_kind17.*',
                    'nullable',
                    'digits:4',
                    'unique:mt_shipping_companies,shipping_company_cd',
                ],
                'insert_shipping_company_name.*' => [
                    'required_with:insert_shipping_company_code.*',
                    'required_with:insert_slip_kind7.*',
                    'required_with:insert_slip_kind17.*',
                    'nullable',
                    'max:20',
                ],
                'insert_slip_kind7.*' => [
                    'required_with:insert_shipping_company_code.*',
                    'required_with:insert_shipping_company_name.*',
                    'required_with:insert_slip_kind17.*',
                    'nullable',
                    new ExistSlipKindForShippingLabel,
                ],
                'insert_slip_kind17.*' => [
                    'nullable',
                    new ExistSlipKindForTag,
                ],
                'update_shipping_company_code.*' => [
                    'required_with:update_shipping_company_name.*',
                    'required_with:update_slip_kind7.*',
                    'required_with:update_slip_kind17.*',
                    'nullable',
                    'digits:4',
                ],
                'update_shipping_company_name.*' => [
                    'required_with:update_shipping_company_code.*',
                    'required_with:update_slip_kind7.*',
                    'required_with:update_slip_kind17.*',
                    'nullable',
                    'max:20',
                ],
                'update_slip_kind7.*' => [
                    'required_with:update_shipping_company_code.*',
                    'required_with:update_shipping_company_name.*',
                    'required_with:update_slip_kind17.*',
                    'nullable',
                    new ExistSlipKindForShippingLabel,
                ],
                'update_slip_kind17.*' => [
                    'nullable',
                    new ExistSlipKindForTag,
                ],
                'update_id.*' => 'nullable'
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'insert_shipping_company_code.*' => __('validation.attributes.mt_shipping_companies.shipping_company_cd'),
            'insert_shipping_company_name.*' => __('validation.attributes.mt_shipping_companies.shipping_company_name'),
            'insert_slip_kind7.*' => __('validation.attributes.mt_shipping_companies.mt_slip_kind7_id'),
            'insert_slip_kind17.*' => __('validation.attributes.mt_shipping_companies.mt_slip_kind17_id'),
            'update_shipping_company_code.*' => __('validation.attributes.mt_shipping_companies.shipping_company_cd'),
            'update_shipping_company_name.*' => __('validation.attributes.mt_shipping_companies.shipping_company_name'),
            'update_slip_kind7.*' => __('validation.attributes.mt_shipping_companies.mt_slip_kind7_id'),
            'update_slip_kind17.*' => __('validation.attributes.mt_shipping_companies.mt_slip_kind17_id'),
        ];
    }
}
