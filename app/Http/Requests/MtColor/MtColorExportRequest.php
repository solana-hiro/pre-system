<?php
namespace App\Http\Requests\MtColor;

use Illuminate\Foundation\Http\FormRequest;
/**
 * リクエストパラメータ
 */
class MtColorExportRequest extends FormRequest
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
                'code_start' => 'nullable',         //カラーコード範囲 開始
                'code_end' => 'nullable',	        //カラーコード範囲 終了
            ];
        }
        if ($this->has('excel')) {
            $rules = [
                'excel' => 'nullable',
                'code_start' => 'nullable',  //カラーコード範囲 開始
                'code_end' => 'nullable',    //カラーコード範囲 終了
            ];
        }
        if ($this->has('preview')) {
            $rules = [
                'preview' => 'nullable',
                'code_start' => 'nullable',  //カラーコード範囲 開始
                'code_end' => 'nullable',    //カラーコード範囲 終了
            ];
        }
        if($this->has('excel') && null !== $this->all()['code_start'] && null !== $this->all()['code_end']) {
            $rules = [
                'excel' => 'nullable',
                'code_start' => 'nullable',  //カラーコード範囲 開始
                'code_end' => 'nullable|gte:code_start',    //カラーコード範囲 終了
            ];
        }
        if ($this->has('preview') && null !== $this->all()['code_start'] && null !== $this->all()['code_end']) {
            $rules = [
                'preview' => 'nullable',
                'code_start' => 'nullable',  //カラーコード範囲 開始
                'code_end' => 'nullable|gte:code_start',    //カラーコード範囲 終了
            ];
        }
        return $rules;

    }

    public function attributes()
    {
        return [
            'code_start' => __('validation.attributes.mt_colors.color_cd_start'),
            'code_end' => __('validation.attributes.mt_colors.color_cd_end'),
        ];
    }

    public function messages()
    {
        return [
            'code_end.gte' => __('validation.error_messages.range_is_incorrect'),
        ];
    }
}
