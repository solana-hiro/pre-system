<?php

namespace App\Http\Requests\MtSizePattern;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class MtSizePatternUpdateRequest extends FormRequest
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
                'insert_size_pattern_code.*' => 'nullable|max_digits:4|unique:mt_size_patterns,size_pattern_cd',
                'insert_size_code1.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_size_code2.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_size_code3.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_size_code4.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_size_code5.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_size_code6.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_size_code7.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_size_code8.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_size_code9.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_size_code10.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_size_pattern_code.*' => 'nullable|max_digits:4',
                'update_size_code1.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_size_code2.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_size_code3.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_size_code4.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_size_code5.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_size_code6.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_size_code7.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_size_code8.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_size_code9.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_size_code10.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_id.*' => 'nullable'
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'insert_size_pattern_code.*' => __('validation.attributes.mt_size_patterns.size_pattern_cd'),
            'insert_size_code1.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'insert_size_code2.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'insert_size_code3.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'insert_size_code4.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'insert_size_code5.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'insert_size_code6.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'insert_size_code7.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'insert_size_code8.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'insert_size_code9.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'insert_size_code10.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'update_size_pattern_code.*' => __('validation.attributes.mt_size_patterns.size_pattern_cd'),
            'update_size_code1.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'update_size_code2.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'update_size_code3.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'update_size_code4.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'update_size_code5.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'update_size_code6.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'update_size_code7.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'update_size_code8.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'update_size_code9.*' => __('validation.attributes.mt_size_patterns.size_cd'),
            'update_size_code10.*' => __('validation.attributes.mt_size_patterns.size_cd'),
        ];
    }
}
