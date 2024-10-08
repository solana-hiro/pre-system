<?php

namespace App\Http\Requests\MtCustomerClass;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * リクエストパラメータ
 */
class MtCustomerClassUpdateRequest extends FormRequest
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
        if ($this->has('update') && "1" === $this->all()['def_customer_class_thing_id']) {
            $rules = [
                'update' => 'nullable',
                'def_customer_class_thing_id' => 'required',
                'insert_class_code.*' => [
                    'nullable',
                    'max:6',
                    Rule::unique('mt_customer_classes', 'customer_class_cd')->where(
                        function ($query) {
                            return $query->where('def_customer_class_thing_id', $this->input('def_customer_class_thing_id'));
                        }
                    )
                ],
                'insert_class_name.*' => 'nullable|max:20',
                'update_class_code1.*' => 'required|max:6',
                'update_class_name1.*' => 'nullable|max:20',
                'update_id1.*' => 'nullable'
            ];
        }
        if ($this->has('update') && "2" === $this->all()['def_customer_class_thing_id']) {
            $rules = [
                'update' => 'nullable',
                'def_customer_class_thing_id' => 'required',
                'insert_class_code.*' => [
                    'nullable',
                    'max:6',
                    Rule::unique('mt_customer_classes', 'customer_class_cd')->where(
                        function ($query) {
                            return $query->where('def_customer_class_thing_id', $this->input('def_customer_class_thing_id'));
                        }
                    )
                ],
                'insert_class_name.*' => 'nullable|max:20',
                'update_class_code2.*' => 'required|max:6',
                'update_class_name2.*' => 'nullable|max:20',
                'update_id2.*' => 'nullable'
            ];
        }
        if ($this->has('update') && "3" === $this->all()['def_customer_class_thing_id']) {
            $rules = [
                'update' => 'nullable',
                'def_customer_class_thing_id' => 'required',
                'insert_class_code.*' => [
                    'nullable',
                    'max:6',
                    Rule::unique('mt_customer_classes', 'customer_class_cd')->where(
                        function ($query) {
                            return $query->where('def_customer_class_thing_id', $this->input('def_customer_class_thing_id'));
                        }
                    )
                ],
                'insert_class_name.*' => 'nullable|max:20',
                'update_class_code3.*' => 'required|max:6',
                'update_class_name3.*' => 'nullable|max:20',
                'update_id3.*' => 'nullable'
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'def_customer_class_thing_id' => __('validation.attributes.mt_customer_classes.def_customer_class_thing_id'),
            'insert_class_code.*' => __('validation.attributes.mt_customer_classes.customer_class_cd'),
            'insert_class_name.*' => __('validation.attributes.mt_customer_classes.customer_class_name'),
            'update_class_code1.*' => __('validation.attributes.mt_customer_classes.customer_class_cd'),
            'update_class_name1.*' => __('validation.attributes.mt_customer_classes.customer_class_name'),
            'update_class_code2.*' => __('validation.attributes.mt_customer_classes.customer_class_cd'),
            'update_class_name2.*' => __('validation.attributes.mt_customer_classes.customer_class_name'),
            'update_class_code3.*' => __('validation.attributes.mt_customer_classes.customer_class_cd'),
            'update_class_name3.*' => __('validation.attributes.mt_customer_classes.customer_class_name'),
        ];
    }
}
