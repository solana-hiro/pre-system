<?php

namespace App\Http\Requests\TrnSaleHeader;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class SlipListRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cancel' => 'nullable',					//キャンセルボタン
            'preview' => 'nullable',                //プレビューボタン
            'login_id' => 'nullable',               //ログインID
            'order_kbn' => 'nullable',              //発行区分
            'warehouse_code_start' => '',           //出庫倉庫コード　開始
            'warehouse_code_end' => '',             //出庫倉庫コード　終了
            'update_year_start' => '',              //売上更新日付　開始年
            'update_month_start' => '',             //売上更新日付　開始月
            'update_day_start' => '',               //売上更新日付　開始日
            'update_year_end' => '',                //売上更新日付　開始年
            'update_month_end' => '',               //売上更新日付　開始月
            'update_day_end' => '',                 //売上更新日付　開始日
            'slip_year_start' => '',                //売上伝票日付　開始年
            'slip_month_start' => '',               //売上伝票日付　開始月
            'slip_day_start' => '',                 //売上伝票日付　開始日
            'slip_year_end' => '',                  //売上伝票日付　開始年
            'slip_month_end' => '',                 //売上伝票日付　開始月
            'slip_day_end' => '',                   //売上伝票日付　開始日
            'slip_no_start' => '',  //伝票No.範囲 開始
            'slip_no_end' => '',  //伝票No.範囲 終了
            'customer_code_start' => '',  //得意先コード範囲  開始
            'customer_code_end' => '',  //得意先コード範囲　終了
        ];
    }

    public function attributes()
    {
        return [
            //'customer_class_thing_name' => __('validation.attributes.mt_customer_class.customer_class_thing_name'),
            //'code_start' => __('validation.attributes.mt_customer_class.code_start'),
            //'code_end' => __('validation.attributes.mt_customer_class.code_end'),
        ];
	}
}
