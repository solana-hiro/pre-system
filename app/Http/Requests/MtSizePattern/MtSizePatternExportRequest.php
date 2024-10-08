<?php
namespace App\Http\Requests\MtSizePattern;

use Illuminate\Foundation\Http\FormRequest;
/**
 * リクエストパラメータ
 */
class MtSizePatternExportRequest extends FormRequest
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
                'code_start' => 'nullable',         //サイズパターンコード範囲 開始
                'code_end' => 'nullable',            //サイズパターンコード範囲 終了
            ];
        }
        if ($this->has('excel')) {
            $rules = [
                'excel' => 'nullable',
                'code_start' => 'nullable|numeric',  //サイズパターンコード範囲 開始
                'code_end' => 'nullable|numeric',    //サイズパターンコード範囲 終了
            ];
        }
        if ($this->has('preview')) {
            $rules = [
                'preview' => 'nullable',
                'code_start' => 'nullable|numeric',  //サイズパターンコード範囲 開始
                'code_end' => 'nullable|numeric',    //サイズパターンコード範囲 終了
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code_start'] && null !== $this->all()['code_end']) {
            $rules = [
                'excel' => 'nullable',
                'code_start' => 'nullable|numeric',  //サイズパターンコード範囲 開始
                'code_end' => 'nullable|numeric|gte:code_start',    //サイズパターンコード範囲 終了
            ];
        }
        if ($this->has('preview') && null !== $this->all()['code_start'] && null !== $this->all()['code_end']) {
            $rules = [
                'preview' => 'nullable',
                'code_start' => 'nullable|numeric',  //サイズパターンコード範囲 開始
                'code_end' => 'nullable|numeric|gte:code_start',    //サイズパターンコード範囲 終了
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'code_start' => __('validation.attributes.mt_size_patterns.size_pattern_cd_start'),
            'code_end' => __('validation.attributes.mt_size_patterns.size_pattern_cd_end'),
        ];
    }

    public function messages()
    {
        return [
            'code_end.gte' => __('validation.error_messages.range_is_incorrect'),
        ];
    }
}
