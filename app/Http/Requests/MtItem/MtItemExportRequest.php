<?php
namespace App\Http\Requests\MtItem;

use Illuminate\Foundation\Http\FormRequest;
/**
 * リクエストパラメータ
 */
class MtItemExportRequest extends FormRequest
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
            'sku' => 'nullable',						//プレビュー
            'item_cd' => 'nullable',					//商品コード
            'excel' => 'nullable',                        //EXCEL
            'item_class1_start' => 'nullable',                        //
            'item_class1_end' => 'nullable',                        //
            'item_class2_start' => 'nullable',                        //
            'item_class2_end' => 'nullable',                        //
            'item_class3_start' => 'nullable',                        //
            'item_class3_end' => 'nullable',                        //
            'item_class4_start' => 'nullable',                        //
            'item_class4_end' => 'nullable',                        //
            'item_class5_start' => 'nullable',                        //
            'item_class5_end' => 'nullable',                        //
            'item_class6_start' => 'nullable',                        //
            'item_class6_end' => 'nullable',                        //
            'item_class7_start' => 'nullable',                        //
            'item_class7_end' => 'nullable',                        //
            'item_cd_start' => 'nullable',                        //
            'item_cd_end' => 'nullable',                        //
            'other_part_number_start' => 'nullable',                        //
            'other_part_number_end' => 'nullable',                        //
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
