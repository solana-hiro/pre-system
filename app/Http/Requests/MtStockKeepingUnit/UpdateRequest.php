<?php

namespace App\Http\Requests\MtStockKeepingUnit;

use App\Models\MtSystem;
use App\Models\MtItem;
use App\Models\MtStockKeepingUnit;
use App\Repositories\MtItem\MtItemRepository;
use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class UpdateRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
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

            /**
             * JANコードチェック
             *   $attribute: 検証中の属性名
             *   $value    : 検証中の属性の値
             *   $fail     : 失敗時に呼び出すメソッド?
             **/
            $checkJan = function ($attribute, $value, $fail) {
                $error_msg1 = '開始JANコードから終了JANコードの値の範囲を超えています';
                $error_msg2 = 'JANコードが重複しています';
                $input_data = $this->all();
                // 範囲チェック
                $mtSystem = MtSystem::first();
                $janStart = $mtSystem->start_jan_code;
                $janEnd = $mtSystem->end_jan_code;
                $janCd = substr($value, 0, 12);
                $janCheckDigit = substr($value, -1);
                if ($janCd < $janStart || $janCd > $janEnd) {
                    $fail($error_msg1);
                }

                // 重複チェック
                $mtItem = MtItem::where('item_cd', $input_data['item_code'])->first();
                // 他の商品コードに紐づく同一janCdはないか
                // 同一商品内のチェックはdistinctで実施
                $mtStockKeepingUnitExists = MtStockKeepingUnit::whereNot('mt_item_id',  $mtItem['id'])->where('jan_cd', $value)->exists();
                if ($mtStockKeepingUnitExists) {
                    $fail($error_msg2);
                }

                // チェックディジットのチェック
                $itemRepository = new MtItemRepository;
                $checkDigit = $itemRepository->calcJanCodeDigit($janCd);
                if ($checkDigit != $janCheckDigit) {
                    $error_msg3 = 'チェックディジットが不正です' . '（入力値）' . $value . '（正しい値）' . $janCd . $checkDigit;
                    $fail($error_msg3);
                }
            };

            $rules = [
                'update' => 'nullable',
                'item_code' => 'required|exists:mt_items,item_cd',
                'jan_code.*' => ['nullable', 'numeric', 'digits:13', 'distinct', $checkJan],
                'hidden_item_id.*' => 'nullable',
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'item_code' => __('validation.attributes.mt_items.item_cd'),
            'jan_code.*' => __('validation.attributes.mt_stock_keeping_units.jan_cd'),
        ];
    }

    public function messages()
    {
        return [
            'jan_code.digits' => __('validation.error_messages.digits_is_incorrect'),
        ];
    }
}
