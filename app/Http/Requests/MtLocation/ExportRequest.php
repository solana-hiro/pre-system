<?php
namespace App\Http\Requests\MtLocation;

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
            ];
        }
        if ($this->has('excel')) {
            $rules = [
                'excel' => 'nullable',
                'warehouse_code' => 'required',
                'item_code_start' => 'nullable',
                'item_code_end' => 'nullable|gte:item_code_start',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable|gte:color_code_start',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable|gte:size_code_start',
                'shelf_number_code1_start' => 'nullable|max:10',
                'shelf_number_code1_end' => 'nullable|max:10',
                'shelf_number_code2_start' => 'nullable|max:10',
                'shelf_number_code2_end' => 'nullable|max:10',
            ];
        }
        if ($this->has('preview')) {
            $rules = [
                'preview' => 'nullable',
                'warehouse_code' => 'required',
                'item_code_start' => 'nullable',
                'item_code_end' => 'nullable|gte:item_code_start',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable|gte:color_code_start',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable|gte:size_code_start',
                'shelf_number_code1_start' => 'nullable|max:10',
                'shelf_number_code1_end' => 'nullable|max:10',
                'shelf_number_code2_start' => 'nullable|max:10',
                'shelf_number_code2_end' => 'nullable|max:10',
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'warehouse_code' => __('validation.attributes.mt_warehouses.warehouse_cd'),
            'item_code_start' => __('validation.attributes.mt_items.item_cd_start'),
            'item_code_end' => __('validation.attributes.mt_items.item_cd_end'),
            'color_code_start' => __('validation.attributes.mt_colors.color_cd_start'),
            'color_code_end' => __('validation.attributes.mt_colors.color_cd_end'),
            'size_code_start' => __('validation.attributes.mt_sizes.size_cd_start'),
            'size_code_end' => __('validation.attributes.mt_sizes.size_cd_end'),
            'shelf_number_code1_start' => __('validation.attributes.mt_locations.shelf_number_1_start'),
            'shelf_number_code1_end' => __('validation.attributes.mt_locations.shelf_number_1_end'),
            'shelf_number_code2_start' => __('validation.attributes.mt_locations.shelf_number_2_start'),
            'shelf_number_code2_end' => __('validation.attributes.mt_locations.shelf_number_2_end'),
        ];
    }

    public function messages()
    {
        return [
            'item_code_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'color_code_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'size_code_end.gte' => __('validation.error_messages.range_is_incorrect'),
        ];
    }
}
