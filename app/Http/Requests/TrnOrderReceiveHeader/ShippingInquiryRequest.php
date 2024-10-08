<?php

namespace App\Http\Requests\TrnOrderReceiveHeader;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

/**
 * リクエストパラメータ
 */
class ShippingInquiryRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $start_date_time = ($this->filled(['start_date_y', 'start_date_m', 'start_date_d'])) ? $this->start_date_y . "-" . $this->start_date_m . "-" . $this->start_date_d : '';
        $this->merge([
            'start_date_time' => $start_date_time
        ]);
        $end_date_time = ($this->filled(['end_date_y', 'end_date_m', 'end_date_d'])) ? $this->end_date_y . "-" . $this->end_date_m . "-" . $this->end_date_d : '';
        $this->merge([
            'end_date_time' => $end_date_time
        ]);
    }

    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        /*
        return [
            'excel' => 'nullable',					//EXCEL出力ボタン
            'search' => 'nullable',					//実行するボタン
            'target' => 'required',					//出力対象
            'start_date_y' => 'nullable',			//対象日付　開始年
            'start_date_m' => 'nullable',			//対象日付　開始月
            'start_date_d' => 'nullable',			//対象日付　開始日
            'end_date_y' => 'nullable',				//対象日付　終了年
            'end_date_y' => 'nullable',				//対象日付　終了月
            'end_date_y' => 'nullable',				//対象日付　終了日
            'start_item_code' => 'nullable|max:9',	//商品コード　範囲最小
            'end_item_code' => 'nullable|max:9',	//商品コード　範囲最大
            'start_color_code' => 'nullable|max:5',	//カラーコード　範囲最小
            'end_color_code' => 'nullable|max:5',	//カラーコード　範囲最大
            'start_warehouse_code' => 'nullable|max:6',	//倉庫コード　範囲最小
            'end_warehouse_code' => 'nullable|max:6',	//倉庫コード　範囲最大
            'start_size_code' => 'nullable|max:5',	//サイズコード　範囲最小
            'end_size_code' => 'nullable|max:5',	//サイズコード　範囲最大
        ];
        */

        $rules = array();
        if ($this->has('cancel')) {
            $rules = [
                'cancel' => 'nullable',
            ];
        } elseif($this->has('excel') || $this->has('preview') || $this->has('search')) {
            $rules = [
                'execute' => 'nullable',
                'preview' => 'nullable',
                'target' => 'required',
                'end_date_time' => "nullable|after_or_equal:start_date_time",
                'start_item_code' => 'nullable',
                'end_item_code' => 'nullable|gte:start_item_code',
                'start_color_code' => 'nullable',
                'end_color_code' => 'nullable|gte:start_color_code',
                'start_size_code' => 'nullable',
                'end_size_code' => 'nullable|digits:5|gte:start_size_code',
                'start_warehouse_code' => 'nullable|digits:6',
                'end_warehouse_cd' => 'nullable|digits:6|gte:start_warehouse_code',
            ];
        }
        return $rules;

    }

    public function attributes()
    {
        return [
            'start_item_code' => __('validation.attributes.mt_items.item_cd'),
            'end_item_code' => __('validation.attributes.mt_items.item_cd'),
            'start_color_code' => __('validation.attributes.mt_colors.color_cd'),
            'end_color_code' => __('validation.attributes.mt_colors.color_cd'),
            'start_warehouse_code' => __('validation.attributes.mt_warehouses.warehouse_cd'),
            'end_warehouse_code' => __('validation.attributes.mt_warehouses.warehouse_cd'),
            'start_size_code' => __('validation.attributes.mt_sizes.size_cd'),
            'end_size_code' => __('validation.attributes.mt_sizes.size_cd'),
        ];
	}

    public function messages()
    {
        return [
            'end_item_code.gte' => __('validation.error_messages.range_is_incorrect'),
            'end_color_code.gte' => __('validation.error_messages.range_is_incorrect'),
            'end_warehouse_code.gte' => __('validation.error_messages.range_is_incorrect'),
            'end_size_code.gte' => __('validation.error_messages.range_is_incorrect'),
            "end_date_time.gte" => __('validation.error_messages.range_is_incorrect'),
        ];
    }
}
