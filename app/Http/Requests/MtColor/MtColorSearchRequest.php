<?php
namespace App\Http\Requests\MtColor;

use Illuminate\Foundation\Http\FormRequest;
/**
 * リクエストパラメータ
 */
class MtColorSearchRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'color_cd' => 'nullable',                            //カラーコード
            'color_name' => 'nullable',							//カラー名
        ];
    }

    public function attributes()
    {
        return [
            'color_cd' => __('validation.attributes.mt_color.color_cd'),
            'color_name' => __('validation.attributes.mt_color.color_name'),
        ];
    }
}
