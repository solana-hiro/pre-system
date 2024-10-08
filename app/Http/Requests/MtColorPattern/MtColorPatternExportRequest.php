<?php
namespace App\Http\Requests\MtColorPattern;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class MtColorPatternExportRequest extends FormRequest
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
                'code_start' => 'nullable',         //カラーパターンコード範囲 開始
                'code_end' => 'nullable',	        //カラーパターンコード範囲 終了
            ];
        }
        if ($this->has('excel')) {
            $rules = [
                'excel' => 'nullable',
                'code_start' => 'nullable|numeric',  //カラーパターンコード範囲 開始
                'code_end' => 'nullable|numeric',    //カラーパターンコード範囲 終了
            ];
        }
        if ($this->has('preview')) {
            $rules = [
                'preview' => 'nullable',
                'code_start' => 'nullable|numeric',  //カラーパターンコード範囲 開始
                'code_end' => 'nullable|numeric',    //カラーパターンコード範囲 終了
            ];
        }
        if($this->has('excel') && null !== $this->all()['code_start'] && null !== $this->all()['code_end']) {
            $rules = [
                'excel' => 'nullable',
                'code_start' => 'nullable|numeric',  //カラーパターンコード範囲 開始
                'code_end' => 'nullable|numeric|gte:code_start',    //カラーパターンコード範囲 終了
            ];
        }
        if ($this->has('preview') && null !== $this->all()['code_start'] && null !== $this->all()['code_end']) {
            $rules = [
                'preview' => 'nullable',
                'code_start' => 'nullable|numeric',  //カラーパターンコード範囲 開始
                'code_end' => 'nullable|numeric|gte:code_start',    //カラーパターンコード範囲 終了
            ];
        }
        return $rules;

    }

    public function attributes()
    {
        return [
            'code_start' => __('validation.attributes.mt_color_patterns.color_pattern_cd_start'),
            'code_end' => __('validation.attributes.mt_color_patterns.color_pattern_cd_end'),
        ];
    }

    public function messages()
    {
        return [
            'code_end.gte' => __('validation.error_messages.range_is_incorrect'),
        ];
    }
}
