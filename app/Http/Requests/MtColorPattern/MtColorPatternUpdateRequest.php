<?php

namespace App\Http\Requests\MtColorPattern;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class MtColorPatternUpdateRequest extends FormRequest
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
                'insert_color_pattern_code.*' => 'nullable|max_digits:4|unique:mt_color_patterns,color_pattern_cd',
                'insert_color_code1.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code2.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code3.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code4.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code5.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code6.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code7.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code8.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code9.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code10.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code11.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code12.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code13.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code14.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code15.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code16.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code17.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code18.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code19.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'insert_color_code20.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_pattern_code.*' => 'nullable|max_digits:4',
                'update_color_code1.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code2.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code3.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code4.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code5.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code6.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code7.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code8.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code9.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code10.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code11.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code12.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code13.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code14.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code15.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code16.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code17.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code18.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code19.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_color_code20.*' => 'nullable|regex:/^[0-9a-zA-Z]+$/|max:5',
                'update_id.*' => 'nullable'
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'insert_color_pattern_code.*' => __('validation.attributes.mt_color_patterns.color_pattern_cd'),
            'insert_color_code1.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code2.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code3.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code4.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code5.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code6.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code7.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code8.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code9.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code10.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code11.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code12.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code13.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code14.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code15.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code16.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code17.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code18.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code19.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'insert_color_code20.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_pattern_code.*' => __('validation.attributes.mt_color_patterns.color_pattern_cd'),
            'update_color_code1.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code2.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code3.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code4.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code5.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code6.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code7.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code8.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code9.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code10.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code11.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code12.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code13.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code14.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code15.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code16.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code17.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code18.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code19.*' => __('validation.attributes.mt_color_patterns.color_cd'),
            'update_color_code20.*' => __('validation.attributes.mt_color_patterns.color_cd'),
        ];
    }
}
