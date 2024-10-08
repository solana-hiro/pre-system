<?php

namespace App\Http\Requests\MtDeliveryDestination;

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
    public function rules(): array
    {
        if ($this->has('cancel')) {
            $rules = [
                'cancel' => 'nullable',
                'code_start' => 'nullable',         //納品先コード範囲 開始
                'code_end' => 'nullable',            //納品先コード範囲 終了
            ];
        }
        if ($this->has('excel')) {
            $rules = [
                'excel' => 'nullable',
                'code_start' => 'nullable|numeric',  //納品先コード範囲 開始
                'code_end' => 'nullable|numeric',    //納品先コード範囲 終了
            ];
        }
        if ($this->has('preview')) {
            $rules = [
                'preview' => 'nullable',
                'code_start' => 'nullable|numeric',  //納品先コード範囲 開始
                'code_end' => 'nullable|numeric',    //納品先コード範囲 終了
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code_start'] && null !== $this->all()['code_end']) {
            $rules = [
                'excel' => 'nullable',
                'code_start' => 'nullable|numeric',  //納品先コード範囲 開始
                'code_end' => 'nullable|numeric|gte:code_start',    //納品先コード範囲 終了
            ];
        }
        if ($this->has('preview') && null !== $this->all()['code_start'] && null !== $this->all()['code_end']) {
            $rules = [
                'excel' => 'nullable',
                'code_start' => 'nullable|numeric',  //納品先コード範囲 開始
                'code_end' => 'nullable|numeric|gte:code_end',    //納品先コード範囲 終了
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'code_start' => __('validation.attributes.mt_delivery_destinations.delivery_destination_id'),
            'code_end' => __('validation.attributes.mt_delivery_destinations.delivery_destination_id'),
        ];
	}

    public function messages()
    {
        return [
            'code_end.gte' => __('validation.error_messages.range_is_incorrect'),
        ];
    }
}
