<?php

namespace App\Http\Requests\MtItem;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\MtStockKeepingUnit;
use App\Models\MtItem;
use App\Models\MtColor;
use App\Models\MtSize;

/**
 * リクエストパラメータ
 */
class ItemCodeUpdateRequest extends FormRequest
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
        if ($this->has('update')) {
            /**
             * 検証用の関数
             *   $attribute: 検証中の属性名
             *   $value    : 検証中の属性の値
             *   $fail     : 失敗時に呼び出すメソッド?
             **/
            $checkColorUniq = function ($attribute, $value, $fail) {
                $input_data = $this->all();
                if (2 == $input_data['change_kbn']) {
                    $error_msg = '商品マスタ内に重複するカラーコードが存在するため、更新できません';
                    $mtItem = MtItem::where('item_cd', $input_data['before_item_code'])->first();
                    $mtColor = MtColor::where('color_cd', $input_data['after_color_code'])->first();
                    if (!empty($mtItem) && !empty($mtColor)) {
                        $mtStockKeepingUnitExists = MtStockKeepingUnit::where('mt_item_id', $mtItem->id)->where('mt_color_id', $mtColor->id)->exists();
                        if ($mtStockKeepingUnitExists) {
                            $fail($error_msg);
                        }
                    }
                }
            };
            $checkSizeUniq = function ($attribute, $value, $fail) {
                $input_data = $this->all();
                if (3 == $input_data['change_kbn']) {
                    $error_msg = '商品マスタ内に重複するサイズコードが存在するため、更新できません';
                    $mtItem = MtItem::where('item_cd', $input_data['before_item_code'])->first();
                    $mtSize = MtSize::where('size_cd', $input_data['after_size_code'])->first();
                    if (!empty($mtItem) && !empty($mtSize)) {
                        $mtStockKeepingUnitExists = MtStockKeepingUnit::where('mt_item_id', $mtItem->id)->where('mt_size_id', $mtSize->id)->exists();
                        if ($mtStockKeepingUnitExists) {
                            $fail($error_msg);
                        }
                    }
                }
            };


            $rules = [
                'update' => 'nullable',
                'change_kbn' => 'required',
                'before_item_code' => 'required|max:9|exists:mt_items,item_cd',
                'before_color_code' => 'nullable|required_if:change_kbn,2|max:5|exists:mt_colors,color_cd',
                'before_size_code' => 'nullable|required_if:change_kbn,3|max:5|exists:mt_sizes,size_cd',
                'after_item_code' => 'nullable|required_if:change_kbn,1|max:9|unique:mt_items,item_cd',
                'after_color_code' => ['nullable', 'required_if:change_kbn,2', 'max:5', 'exists:mt_colors,color_cd', $checkColorUniq],
                'after_size_code' =>  ['nullable', 'required_if:change_kbn,3', 'max:5', 'exists:mt_sizes,size_cd', $checkSizeUniq],
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'change_kbn' => '変更区分',
            'before_item_code' => '変更前商品コード',
            'before_color_code' => '変更前カラーコード',
            'before_size_code' => '変更前サイズコード',
            'after_item_code' => '変更後商品コード',
            'after_color_code' => '変更後カラーコード',
            'after_size_code' => '変更後サイズコード',
        ];
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages()
    {
        return [
            'before_color_code.required_if' => ':attributeは必須項目です。',
            'before_size_code.required_if' => ':attributeは必須項目です。',
            'after_item_code.required_if' => ':attributeは必須項目です。',
            'after_color_code.required_if' => ':attributeは必須項目です。',
            'after_color_code.required_if' => ':attributeは必須項目です。',
            'after_size_code.required_if' => ':attributeは必須項目です。',
        ];
    }
}
