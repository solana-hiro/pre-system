<?php

namespace App\Http\Requests\MtWarehouse;

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
            $rules = [
                'update' => 'nullable',
                'insert_warehouse_code.*' => 'required_with:insert_warehouse_name.*|
                     required_with:insert_warehouse_name_kana.*|
                     required_with:insert_warehouse_kind.*|
                     required_with:insert_analysis_warehouse_kbn.*|
                     required_with:insert_asset_stock_validity_kbn.*|
                     required_with:insert_del_kbn.*|
                     unique:mt_warehouses,warehouse_cd|nullable|max_digits:6',
                'insert_warehouse_name.*' => 'nullable|max:20',
                'insert_warehouse_name_kana.*' => 'nullable|max:10',
                'insert_warehouse_kind.*' => 'required_with:insert_warehouse_code.*|
                    required_with:insert_warehouse_name.*|
                    required_with:insert_warehouse_name_kana.*|
                    required_with:insert_analysis_warehouse_kbn.*|
                    required_with:insert_asset_stock_validity_kbn.*|
                    required_with:insert_del_kbn.*|
                    nullable|in:0,1,2',
                'insert_analysis_warehouse_kbn.*' => 'required_with:insert_warehouse_code.*|
                    required_with:insert_warehouse_name.*|
                    required_with:insert_warehouse_name_kana.*|
                    required_with:insert_warehouse_kind.*|
                    required_with:insert_asset_stock_validity_kbn.*|
                    required_with:insert_del_kbn.*|nullable|in:0,1',
                'insert_asset_stock_validity_kbn.*' => 'required_with:insert_warehouse_code.*|
                    required_with:insert_warehouse_name.*|
                    required_with:insert_warehouse_name_kana.*|
                    required_with:insert_warehouse_kind.*|
                    required_with:insert_analysis_warehouse_kbn.*|
                    required_with:insert_del_kbn.*|
                    nullable|in:0,1',
                'insert_del_kbn.*' => 'required_with:insert_warehouse_code.*|
                    required_with:insert_warehouse_name.*|
                    required_with:insert_warehouse_name_kana.*|
                    required_with:insert_warehouse_kind.*|
                    required_with:insert_analysis_warehouse_kbn.*|
                    required_with:insert_asset_stock_validity_kbn.*|
                    nullable|in:0,1',
                'update_warehouse_code.*' => 'nullable|max_digits:6',
                'update_warehouse_name.*' => 'nullable|max:20',
                'update_warehouse_name_kana.*' => 'nullable|max:10',
                'update_warehouse_kind.*' => 'nullable|in:0,1,2',
                'update_analysis_warehouse_kbn.*' => 'nullable|in:0,1',
                'update_asset_stock_validity_kbn.*' => 'nullable|in:0,1',
                'update_del_kbn.*' => 'nullable|in:0,1',
                'update_id.*' => 'nullable'
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'insert_warehouse_code.*' => __('validation.attributes.mt_warehouses.warehouse_cd'),
            'insert_warehouse_name.*' => __('validation.attributes.mt_warehouses.warehouse_name'),
            'insert_warehouse_name_kana.*' => __('validation.attributes.mt_warehouses.warehouse_name_kana'),
            'insert_warehouse_kind.*' => __('validation.attributes.mt_warehouses.warehouse_kind'),
            'insert_analysis_warehouse_kbn.*' => __('validation.attributes.mt_warehouses.analysis_warehouse_kbn'),
            'insert_asset_stock_validity_kbn.*' => __('validation.attributes.mt_warehouses.asset_stock_validity_kbn'),
            'insert_del_kbn.*' => __('validation.attributes.mt_warehouses.del_kbn'),
            'update_warehouse_code.*' => __('validation.attributes.mt_warehouses.warehouse_cd'),
            'update_warehouse_name.*' => __('validation.attributes.mt_warehouses.warehouse_name'),
            'update_warehouse_name_kana.*' => __('validation.attributes.mt_warehouses.warehouse_name_kana'),
            'update_warehouse_kind.*' => __('validation.attributes.mt_warehouses.warehouse_kind'),
            'update_analysis_warehouse_kbn.*' => __('validation.attributes.mt_warehouses.analysis_warehouse_kbn'),
            'update_asset_stock_validity_kbn.*' => __('validation.attributes.mt_warehouses.asset_stock_validity_kbn'),
            'update_del_kbn.*' => __('validation.attributes.mt_warehouses.del_kbn'),
        ];
    }
}
