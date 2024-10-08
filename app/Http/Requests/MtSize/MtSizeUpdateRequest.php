<?php

namespace App\Http\Requests\MtSize;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class MtSizeUpdateRequest extends FormRequest
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
                'insert_size_code.*' => 'required_with:insert_size_name.*|
                    required_with:insert_sort_order.*|
                    nullable|max:5|unique:mt_sizes,size_cd',
                'insert_size_name.*' => 'nullable|max:10',
                'insert_sort_order.*' => 'required_with:insert_size_code.*|
                    required_with:insert_size_name.*|
                    nullable|numeric',
                'update_size_code.*' => 'required|max:5',
                'update_size_name.*' => 'nullable|max:10',
                'update_sort_order.*' => 'required|numeric',
                'update_id.*' => 'nullable'
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'insert_size_code.*' => __('validation.attributes.mt_sizes.size_cd'),
            'insert_size_name.*' => __('validation.attributes.mt_sizes.size_name'),
            'insert_sort_order.*' => __('validation.attributes.mt_sizes.sort_order'),
            'update_size_code.*' => __('validation.attributes.mt_sizes.size_cd'),
            'update_size_name.*' => __('validation.attributes.mt_sizes.size_name'),
            'update_sort_order.*' => __('validation.attributes.mt_sizes.sort_order'),
        ];
    }
}
