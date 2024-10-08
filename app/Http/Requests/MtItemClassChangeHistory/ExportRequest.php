<?php
namespace App\Http\Requests\MtItemClassChangeHistory;

use Illuminate\Foundation\Http\FormRequest;
/**
 * リクエストパラメータ
 */
class ExportRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cancel' => 'nullable',
            'excel' => 'nullable',
            'item_code_start' => 'nullable|numeric',
            'item_code_end' => 'nullable|numeric|gte:item_code_start',
            'date_year_start' => 'nullable|numeric',
            'date_month_start' => 'nullable|numeric',
            'date_day_start' => 'nullable|numeric',
            'date_year_end' => 'nullable|numeric',
            'date_month_end' => 'nullable|numeric',
            'date_day_end' => 'nullable|numeric',
            'updated_user_id_start' => 'nullable|numeric',
            'updated_user_id_end' => 'nullable|numeric|gte:updated_user_id_start',
            'update_detail' => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'item_code_start' => __('validation.attributes.mt_item_change_histories.item_code_start'),
            'item_code_end' => __('validation.attributes.mt_item_change_histories.item_code_end'),
            'date_year_start' => __('validation.attributes.mt_item_change_histories.change_datetime'),
            'date_month_start' => __('validation.attributes.mt_item_change_histories.change_datetime'),
            'date_day_start' => __('validation.attributes.mt_item_change_histories.change_datetime'),
            'date_year_end' => __('validation.attributes.mt_item_change_histories.change_datetime'),
            'date_month_end' => __('validation.attributes.mt_item_change_histories.change_datetime'),
            'date_day_end' => __('validation.attributes.mt_item_change_histories.change_datetime'),
            'updated_user_id_start' => __('validation.attributes.mt_item_change_histories.updated_user_id_start'),
            'updated_user_id_end' => __('validation.attributes.mt_item_change_histories.updated_user_id_end'),

        ];
    }

    public function messages()
    {
        return [
            'item_code_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'updated_user_id_end.gte' => __('validation.error_messages.range_is_incorrect'),
        ];
    }
}
