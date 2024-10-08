<?php
namespace App\Http\Requests\MtCustomerOtherItemClassRate;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class sellingPriceUpdateRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cancel' => 'nullable',						//キャンセル
            'back' => 'nullable',						//前頁
            'next' => 'nullable',						//次頁
            'update' => 'nullable',						//更新
        ];
    }

    public function attributes()
    {
        return [
            //'color_cd' => __('validation.attributes.mt_color.color_cd'),
            //'color_name' => __('validation.attributes.mt_color.color_name'),
        ];
    }
}
