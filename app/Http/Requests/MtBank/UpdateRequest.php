<?php

namespace App\Http\Requests\MtBank;

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
                'insert_bank_code.*' => 'nullable|digits:4|unique:mt_banks,bank_cd',
                'insert_bank_name.*' => 'nullable|max:20',
                'update_bank_code.*' => 'nullable|digits:4',
                'update_bank_name.*' => 'nullable|max:20',
                'update_id.*' => 'nullable'
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'insert_bank_code.*' => __('validation.attributes.mt_banks.bank_cd'),
            'insert_bank_name.*' => __('validation.attributes.mt_banks.bank_name'),
            'insert_bank_code.*' => __('validation.attributes.mt_banks.bank_cd'),
            'update_bank_name.*' => __('validation.attributes.mt_banks.bank_name'),
        ];
    }
}
