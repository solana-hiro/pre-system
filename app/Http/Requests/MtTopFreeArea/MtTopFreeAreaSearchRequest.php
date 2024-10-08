<?php
namespace App\Http\Requests\MtTopFreeArea;

use Illuminate\Foundation\Http\FormRequest;
/**
 * リクエストパラメータ
 */
class MtTopFreeAreaSearchRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'area_cd' => 'nullable',			//領域コード
            'area_title' => 'nullable',			//領域タイトル
        ];
    }

    public function attributes()
    {
        return [
            'area_cd' => __('validation.attributes.mt_top_free_search.area_cd'),
            'area_title' => __('validation.attributes.mt_top_free_search.area_title'),
        ];
    }
}
