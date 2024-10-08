<?php

namespace App\Http\Requests\MtBank;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class ExportRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->has('cancel')) {
            $rules = [
                'cancel' => 'nullable',
            ];
        }
        if ($this->has('excel')) {
            $rules = [
                'excel' => 'nullable',
                'code_start' => 'nullable|numeric',
                'code_end' => 'nullable|numeric|gte:code_start',
            ];
        }
        if ($this->has('preview')) {
            $rules = [
                'preview' => 'nullable',
                'code_start' => 'nullable|numeric',
                'code_end' => 'nullable|numeric|gte:code_start',
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'code_start' => __('validation.attributes.mt_banks.bank_cd_start'),
            'code_end' => __('validation.attributes.mt_banks.bank_cd_end'),
        ];
    }

    public function messages()
    {
        return [
            'code_end.gte' => __('validation.error_messages.range_is_incorrect'),
        ];
    }
}
