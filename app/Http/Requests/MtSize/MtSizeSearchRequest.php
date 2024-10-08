<?php
namespace App\Http\Requests\MtSize;

use Illuminate\Foundation\Http\FormRequest;
/**
 * リクエストパラメータ
 */
class MtSizeSearchRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'size_cd' => 'nullable',							//サイズコード
            'size_name' => 'nullable',							//サイズ名
        ];
    }

    public function attributes()
    {
        return [
            'size_cd' => __('validation.attributes.mt_size.size_cd'),
            'size_name' => __('validation.attributes.mt_size.size_name'),
        ];
    }
}
