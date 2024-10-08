<?php

namespace App\Http\Requests\MtDeliveryDestination;

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
        if ($this->has('transition')) {
            $rules = [
                'transition' => 'nullable',
            ];
        }
        if ($this->has('update')) {
            $rules = [
                'update' => 'nullable',
                'insert_code.*' => 'required_with:insert_name.*|required_with:insert_flg.*|nullable|max:6|unique:mt_delivery_destinations,delivery_destination_id',
                'insert_name.*' => 'required_with:insert_code.*|required_with:insert_flg.*|nullable|max:60',
                'insert_flg.*' => 'required_with:insert_code.*|required_with:insert_name.*|nullable|in:0,1',
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'insert_code.*' => __('validation.attributes.mt_delivery_destinations.delivery_destination_id'),
            'insert_name.*' => __('validation.attributes.mt_delivery_destinations.delivery_destination_name'),
            'insert_flg.*' => __('validation.attributes.mt_delivery_destinations.del_kbn_delivery_destination'),
        ];
    }
}
