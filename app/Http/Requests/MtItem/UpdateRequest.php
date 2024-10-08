<?php

namespace App\Http\Requests\MtItem;

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
                // 商品マスタ
                'item_cd' => 'required|max:9',
                'mt_supplier_cd' => 'required|digits:6|exists:mt_suppliers,supplier_cd',
                'item_name' => 'required|max:40',
                'other_part_number' => 'nullable||max:20',
                'item_name_kana' => 'nullable||max:10',
                'unit' => 'nullable||max:4',
                'item_class_cd_1' => 'required|exists:mt_item_classes,item_class_cd,def_item_class_thing_id,1',
                'item_class_cd_2' => 'nullable|exists:mt_item_classes,item_class_cd,def_item_class_thing_id,2',
                'item_class_cd_3' => 'nullable|exists:mt_item_classes,item_class_cd,def_item_class_thing_id,3',
                'item_class_cd_4' => 'nullable|exists:mt_item_classes,item_class_cd,def_item_class_thing_id,4',
                'item_class_cd_5' => 'nullable|exists:mt_item_classes,item_class_cd,def_item_class_thing_id,5',
                'item_class_cd_6' => 'nullable|exists:mt_item_classes,item_class_cd,def_item_class_thing_id,6',
                'item_class_cd_7' => 'nullable|exists:mt_item_classes,item_class_cd,def_item_class_thing_id,7',
                'item_kbn' => 'required|in:0, 1, 2, 4, 6',
                'stock_management_kbn' => 'required|in:0, 1',
                'non_tax_kbn' => 'required|in:0, 1',
                'def_tax_rate_kbns_cd' => 'required|exists:def_tax_rate_kbns,tax_rate_kbn_cd',
                'retail_price_tax_out' => 'nullable|regex:/^[0-9,]+$/',
                'retail_price_tax_in' => 'nullable|regex:/^[0-9,]+$/',
                'reference_retail_tax_out' => 'nullable|regex:/^[0-9,]+$/',
                'reference_retail_tax_in' => 'nullable|regex:/^[0-9,]+$/',
                'purchase_price_tax_out' => 'nullable|regex:/^[0-9,.]+$/',
                'purchase_price_tax_in' => 'nullable|regex:/^[0-9,.]+$/',
                'cost_price' => 'nullable|regex:/^[0-9,.]+$/',
                'profit_calculation_cost_price' => 'nullable|regex:/^[0-9,.]+$/',
                'name_input_kbn' => 'required|in:0, 1',
                'del_kbn' => 'required|in:0, 1',
                'ec_alignment_kbn' => 'required|in:0, 1, 2',
                'ec_item_cd' => 'nullable|exists:mt_member_site_items,ec_item_cd',
                'japan_post_office' => 'required|in:0, 1, 2',
                // メンバーサイト商品マスタ
                'ec_item_cd' => 'required_with:ec_item_name,ranking|max:20',
                'ec_item_name' => 'required_with:ec_item_cd|max:30',
                'ranking' => 'nullable|max:3',
                'printed_products_flg' => 'nullable|in:0, 1', // null なら0で登録する
                // メンバーサイト商品おすすめ管理マスタ
                'recommend_ec_item_cd.*' => 'required_with:recommend_display_order.*|nullable|exists:mt_member_site_items,ec_item_cd',
                'recommend_display_order.*' => 'required_with:recommend_ec_item_cd.*|max:3',
                // 共通
                'update' => 'nullable',
                'update_id' => 'nullable',
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'item_cd' => __('validation.attributes.mt_items.item_cd'),
            'mt_supplier_cd' => __('validation.attributes.mt_items.mt_supplier_id'),
            'item_name' => __('validation.attributes.mt_items.item_name'),
            'other_part_number' => __('validation.attributes.mt_items.other_part_number'),
            'item_name_kana' => __('validation.attributes.mt_items.item_name_kana'),
            'unit' => __('validation.attributes.mt_items.unit'),
            'item_class_cd_1' => __('validation.attributes.mt_items.mt_item_class1_id'),
            'item_class_cd_2' => __('validation.attributes.mt_items.mt_item_class2_id'),
            'item_class_cd_3' => __('validation.attributes.mt_items.mt_item_class3_id'),
            'item_class_cd_4' => __('validation.attributes.mt_items.mt_item_class4_id'),
            'item_class_cd_5' => __('validation.attributes.mt_items.mt_item_class5_id'),
            'item_class_cd_6' => __('validation.attributes.mt_items.mt_item_class6_id'),
            'item_class_cd_7' => __('validation.attributes.mt_items.mt_item_class7_id'),
            'item_kbn' => __('validation.attributes.mt_items.item_kbn'),
            'stock_management_kbn' => __('validation.attributes.mt_items.stock_management_kbn'),
            'non_tax_kbn' => __('validation.attributes.mt_items.non_tax_kbn'),
            'def_tax_rate_kbns_cd' => __('validation.attributes.mt_items.def_tax_rate_kbns_cd'),
            'retail_price_tax_out' => __('validation.attributes.mt_items.retail_price_tax_out'),
            'retail_price_tax_in' => __('validation.attributes.mt_items.retail_price_tax_in'),
            'reference_retail_tax_out' => __('validation.attributes.mt_items.reference_retail_tax_out'),
            'reference_retail_tax_in' => __('validation.attributes.mt_items.reference_retail_tax_in'),
            'purchase_price_tax_out' => __('validation.attributes.mt_items.purchase_price_tax_out'),
            'purchase_price_tax_in' => __('validation.attributes.mt_items.purchase_price_tax_in'),
            'cost_price' => __('validation.attributes.mt_items.cost_price'),
            'profit_calculation_cost_price' => __('validation.attributes.mt_items.profit_calculation_cost_price'),
            'name_input_kbn' => __('validation.attributes.mt_items.name_input_kbn'),
            'del_kbn' => __('validation.attributes.mt_items.del_kbn'),
            'ec_alignment_kbn' => __('validation.attributes.mt_items.ec_alignment_kbn'),
            'ec_item_cd' => __('validation.attributes.mt_items.ec_item_cd'),
            'japan_post_office' => __('validation.attributes.mt_items.japan_post_office'),
            // メンバーサイト商品マスタ
            'ec_item_cd' => __('validation.attributes.mt_member_site_items.ec_item_cd'),
            'ec_item_name' => __('validation.attributes.mt_member_site_items.ec_item_name'),
            'ranking' => __('validation.attributes.mt_member_site_items.ranking'),
            'printed_products_flg' => __('validation.attributes.mt_member_site_items.printed_products_flg'),
            // メンバーサイト商品おすすめ管理マスタ
            'recommend_ec_item_cd.*' => __('validation.attributes.mt_member_site_item_recommendation_managements.mt_member_site_item_id_recommendation'),
            'recommend_display_order.*' => __('validation.attributes.mt_member_site_item_recommendation_managements.display_order'),
            // 共通
            'update' => __('validation.attributes.mt_items.item_cd'),
            'update_id' => __('validation.attributes.mt_items.item_cd'),
        ];
    }
}
