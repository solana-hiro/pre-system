<?php

namespace App\Http\Requests\MtColor;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class MtColorUpdateRequest extends FormRequest
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
                'insert_color_code.*' => 'required_with:insert_color_name.*|
                    required_with:insert_html_color_code.*|
                    required_with:insert_sort_order.*|
                    nullable|max:5|unique:mt_colors,color_cd',
                'insert_color_name.*' => 'nullable|max:10',
                'insert_html_color_code.*' => 'nullable|max:7',
                'insert_sort_order.*' => 'required_with:insert_color_name.*|
                    required_with:insert_html_color_code.*|
                    required_with:insert_color_code.*|
                    nullable|numeric|max_digits:3',
                'update_color_code.*' => 'required|max:5',
                'update_color_name.*' => 'nullable|max:10',
                'update_html_color_code.*' => 'nullable|max:7',
                'update_sort_order.*' => 'required|numeric|max_digits:3',
                'update_id.*' => 'nullable'
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'insert_color_code.*' => __('validation.attributes.mt_colors.color_cd'),
            'insert_color_name.*' => __('validation.attributes.mt_colors.color_name'),
            'insert_class_name.*' => __('validation.attributes.mt_colors.html_color_cd'),
            'insert_html_color_code.*' => __('validation.attributes.mt_colors.html_color_cd'),
            'insert_sort_order.*' => __('validation.attributes.mt_colors.sort_order'),
            'update_color_code.*' => __('validation.attributes.mt_colors.color_cd'),
            'update_color_name.*' => __('validation.attributes.mt_colors.color_name'),
            'update_class_name.*' => __('validation.attributes.mt_colors.html_color_cd'),
            'update_html_color_code.*' => __('validation.attributes.mt_colors.sort_order'),
            'update_sort_order.*' => __('validation.attributes.mt_colors.sort_order'),
        ];
    }
}
