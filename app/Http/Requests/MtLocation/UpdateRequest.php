<?php

namespace App\Http\Requests\MtLocation;

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
                'warehouse_cd' => 'required',
                'item_cd' => 'required',
                'location.*.shelf_number_1' => [
                    'nullable',
                    'required_with:location.*.shelf_number_2',
                    'required_with:location.*.rank',
                    'max:10',
                ],
                'location.*.shelf_number_2' => 'nullable|max:10',
                'location.*.rank' => 'nullable|max:2',
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'warehouse_cd' => __('validation.attributes.mt_warehouses.warehouse_cd'),
            'item_cd' => __('validation.attributes.mt_items.item_cd'),
            'location.*.shelf_number_1' => __('validation.attributes.mt_locations.shelf_number_1'),
            'location.*.shelf_number_2' => __('validation.attributes.mt_locations.shelf_number_2'),
            'location.*.rank' => __('validation.attributes.mt_locations.rank'),
        ];
    }
}
