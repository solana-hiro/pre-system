<?php

namespace App\Http\Requests\MtRoot;

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
    public function rules()
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
                'insert_root_code.*' => 'nullable|required_with:insert_sort.*,insert_root_name.*|max:4|unique:mt_roots,root_cd',
                'insert_root_name.*' => 'nullable|required_with:insert_root_code.*,insert_sort.*|max:20',
                'insert_sort.*' => 'nullable|required_with:insert_root_code.*,insert_root_name.*|numeric|max_digits:3',
                'update_root_code.*' => 'required|max:4',
                'update_root_name.*' => 'nullable|max:20',
                'update_sort.*' => 'nullable|numeric|max_digits:3',
                'update_id.*' => 'nullable'
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'insert_root_code.*' => __('validation.attributes.mt_roots.root_cd'),
            'insert_root_name.*' => __('validation.attributes.mt_roots.root_name'),
            'insert_sort.*' => __('validation.attributes.mt_roots.sort'),
            'update_root_code.*' => __('validation.attributes.mt_roots.root_cd'),
            'update_root_name.*' => __('validation.attributes.mt_roots.root_name'),
            'update_sort.*' => __('validation.attributes.mt_roots.sort'),
        ];
    }
}
