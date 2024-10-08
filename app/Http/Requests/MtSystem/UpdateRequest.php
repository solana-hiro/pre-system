<?php

namespace App\Http\Requests\MtSystem;

use App\Rules\ExistWarehouse;
use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'warehouse_cd' => [new ExistWarehouse],
        ];
    }

    public function attributes()
    {
        return [
            'warehouse_cd' => __('validation.custom.attribute.warehouse_cd'),
        ];
    }

    public function messages()
    {
        return [
            'warehouse_cd' => __('validation.custom.is_not_exist'),
        ];
    }
}
