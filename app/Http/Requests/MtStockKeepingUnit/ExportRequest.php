<?php

namespace App\Http\Requests\MtStockKeepingUnit;

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
    public function rules(): array
    {
        if ($this->has('cancel')) {
            $rules = [
                'cancel' => 'nullable',                                  //キャンセル
            ];
        }
        if ($this->has('excel')) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'item_class' => 'required',
                'output_kbn' => 'required',
                'code1_start' => 'nullable',
                'code1_end' => 'nullable',
                'code2_start' => 'nullable',
                'code2_end' => 'nullable',
                'code3_start' => 'nullable',
                'code3_end' => 'nullable',
                'code4_start' => 'nullable',
                'code4_end' => 'nullable',
                'code5_start' => 'nullable',
                'code5_end' => 'nullable',
                'code6_start' => 'nullable',
                'code6_end' => 'nullable',
                'code7_start' => 'nullable',
                'code7_end' => 'nullable',
                'item_cd_start' => 'nullable',
                'item_cd_end' => 'nullable',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable',
                'jan_code_start' => 'nullable|numeric',
                'jan_code_end' => 'nullable|numeric',
            ];
        }
        if ($this->has('preview')) {
            $rules = [
                'preview' => 'nullable',
                'item_class' => 'required',
                'output_kbn' => 'required',
                'code1_start' => 'nullable',
                'code1_end' => 'nullable',
                'code2_start' => 'nullable',
                'code2_end' => 'nullable',
                'code3_start' => 'nullable',
                'code3_end' => 'nullable',
                'code4_start' => 'nullable',
                'code4_end' => 'nullable',
                'code5_start' => 'nullable',
                'code5_end' => 'nullable',
                'code6_start' => 'nullable',
                'code6_end' => 'nullable',
                'code7_start' => 'nullable',
                'code7_end' => 'nullable',
                'item_cd_start' => 'nullable',
                'item_cd_end' => 'nullable',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable',
                'jan_code_start' => 'nullable|numeric',
                'jan_code_end' => 'nullable|numeric',
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code1_start'] && "1" === $this->all()['item_class']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'item_class' => 'required',
                'output_kbn' => 'required',
                'code1_start' => 'nullable',
                'code1_end' => 'nullable|gte:code1_start',
                'item_cd_start' => 'nullable',
                'item_cd_end' => 'nullable',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable',
                'jan_code_start' => 'nullable|numeric',
                'jan_code_end' => 'nullable|numeric',
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code2_start'] && "2" === $this->all()['item_class']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'item_class' => 'required',
                'output_kbn' => 'required',
                'code2_start' => 'nullable',
                'code2_end' => 'nullable|gte:code2_start',
                'item_cd_start' => 'nullable',
                'item_cd_end' => 'nullable',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable',
                'jan_code_start' => 'nullable|numeric',
                'jan_code_end' => 'nullable|numeric',
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code3_start'] && "3" === $this->all()['item_class']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'item_class' => 'required',
                'output_kbn' => 'required',
                'code3_start' => 'nullable',
                'code3_end' => 'nullable|gte:code3_start',
                'item_cd_start' => 'nullable',
                'item_cd_end' => 'nullable',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable',
                'jan_code_start' => 'nullable|numeric',
                'jan_code_end' => 'nullable|numeric',
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code4_start'] && "4" === $this->all()['item_class']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'item_class' => 'required',
                'output_kbn' => 'required',
                'code4_start' => 'nullable',
                'code4_end' => 'nullable|gte:code4_start',
                'item_cd_start' => 'nullable',
                'item_cd_end' => 'nullable',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable',
                'jan_code_start' => 'nullable|numeric',
                'jan_code_end' => 'nullable|numeric',
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code5_start'] && "5" === $this->all()['item_class']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'item_class' => 'required',
                'output_kbn' => 'required',
                'code5_start' => 'nullable',
                'code5_end' => 'nullable|gte:code5_start',
                'item_cd_start' => 'nullable',
                'item_cd_end' => 'nullable',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable',
                'jan_code_start' => 'nullable|numeric',
                'jan_code_end' => 'nullable|numeric',
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code6_start'] && "6" === $this->all()['item_class']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'item_class' => 'required',
                'output_kbn' => 'required',
                'code6_start' => 'nullable',
                'code6_end' => 'nullable|gte:code6_start',
                'item_cd_start' => 'nullable',
                'item_cd_end' => 'nullable',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable',
                'jan_code_start' => 'nullable|numeric',
                'jan_code_end' => 'nullable|numeric',
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code7_start'] && "7" === $this->all()['item_class']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'item_class' => 'required',
                'output_kbn' => 'required',
                'code7_start' => 'nullable',
                'code7_end' => 'nullable|gte:code7_start',
                'item_cd_start' => 'nullable',
                'item_cd_end' => 'nullable',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable',
                'jan_code_start' => 'nullable|numeric',
                'jan_code_end' => 'nullable|numeric',
            ];
        }
        //Preview
        if ($this->has('excel') && null !== $this->all()['code1_start'] && "1" === $this->all()['item_class']) {
            $rules = [
                'preview' => 'nullable',
                'item_class' => 'required',
                'output_kbn' => 'required',
                'code1_start' => 'nullable',
                'code1_end' => 'nullable|gte:code1_start',
                'item_cd_start' => 'nullable',
                'item_cd_end' => 'nullable',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable',
                'jan_code_start' => 'nullable|numeric',
                'jan_code_end' => 'nullable|numeric',
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code2_start'] && "2" === $this->all()['item_class']) {
            $rules = [
                'preview' => 'nullable',
                'item_class' => 'required',
                'output_kbn' => 'required',
                'code2_start' => 'nullable',
                'code2_end' => 'nullable|gte:code2_start',
                'item_cd_start' => 'nullable',
                'item_cd_end' => 'nullable',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable',
                'jan_code_start' => 'nullable|numeric',
                'jan_code_end' => 'nullable|numeric',
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code3_start'] && "3" === $this->all()['item_class']) {
            $rules = [
                'preview' => 'nullable',
                'item_class' => 'required',
                'output_kbn' => 'required',
                'code3_start' => 'nullable',
                'code3_end' => 'nullable|gte:code3_start',
                'item_cd_start' => 'nullable',
                'item_cd_end' => 'nullable',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable',
                'jan_code_start' => 'nullable|numeric',
                'jan_code_end' => 'nullable|numeric',
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code4_start'] && "4" === $this->all()['item_class']) {
            $rules = [
                'preview' => 'nullable',
                'item_class' => 'required',
                'output_kbn' => 'required',
                'code4_start' => 'nullable',
                'code4_end' => 'nullable|gte:code4_start',
                'item_cd_start' => 'nullable',
                'item_cd_end' => 'nullable',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable',
                'jan_code_start' => 'nullable|numeric',
                'jan_code_end' => 'nullable|numeric',
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code5_start'] && "5" === $this->all()['item_class']) {
            $rules = [
                'preview' => 'nullable',
                'item_class' => 'required',
                'output_kbn' => 'required',
                'code5_start' => 'nullable',
                'code5_end' => 'nullable|gte:code5_start',
                'item_cd_start' => 'nullable',
                'item_cd_end' => 'nullable',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable',
                'jan_code_start' => 'nullable|numeric',
                'jan_code_end' => 'nullable|numeric',
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code6_start'] && "6" === $this->all()['item_class']) {
            $rules = [
                'preview' => 'nullable',
                'item_class' => 'required',
                'output_kbn' => 'required',
                'code6_start' => 'nullable',
                'code6_end' => 'nullable|gte:code6_start',
                'item_cd_start' => 'nullable',
                'item_cd_end' => 'nullable',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable',
                'jan_code_start' => 'nullable|numeric',
                'jan_code_end' => 'nullable|numeric',
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code7_start'] && "7" === $this->all()['item_class']) {
            $rules = [
                'preview' => 'nullable',
                'item_class' => 'required',
                'output_kbn' => 'required',
                'code7_start' => 'nullable',
                'code7_end' => 'nullable|gte:code7_start',
                'item_cd_start' => 'nullable',
                'item_cd_end' => 'nullable',
                'color_code_start' => 'nullable',
                'color_code_end' => 'nullable',
                'size_code_start' => 'nullable',
                'size_code_end' => 'nullable',
                'jan_code_start' => 'nullable|numeric',
                'jan_code_end' => 'nullable|numeric',
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'item_class' => __('validation.attributes.mt_item_classes.def_item_class_thing_id'),
            'output_kbn' => __('validation.attributes.mt_item_classes.output_kbn'),
            'code1_start' => __('validation.attributes.mt_item_classes.item_class_code1_start'),
            'code1_end' => __('validation.attributes.mt_item_classes.item_class_code1_end'),
            'code2_start' => __('validation.attributes.mt_item_classes.item_class_code2_start'),
            'code2_end' => __('validation.attributes.mt_item_classes.item_class_code2_end'),
            'code3_start' => __('validation.attributes.mt_item_classes.item_class_code3_start'),
            'code3_end' => __('validation.attributes.mt_item_classes.item_class_code3_end'),
            'code4_start' => __('validation.attributes.mt_item_classes.item_class_code4_start'),
            'code4_end' => __('validation.attributes.mt_item_classes.item_class_code4_end'),
            'code5_start' => __('validation.attributes.mt_item_classes.item_class_code5_start'),
            'code5_end' => __('validation.attributes.mt_item_classes.item_class_code5_end'),
            'code6_start' => __('validation.attributes.mt_item_classes.item_class_code6_start'),
            'code6_end' => __('validation.attributes.mt_item_classes.item_class_code6_end'),
            'code7_start' => __('validation.attributes.mt_item_classes.item_class_code7_start'),
            'code7_end' => __('validation.attributes.mt_item_classes.item_class_code7_end'),
            'item_cd_start' => __('validation.attributes.mt_item_classes.item_code_start'),
            'item_cd_end' => __('validation.attributes.mt_item_classes.item_code_end'),
            'color_code_start' => __('validation.attributes.mt_colors.color_cd_start'),
            'color_code_end' => __('validation.attributes.mt_colors.color_cd_end'),
            'size_code_start' => __('validation.attributes.mt_sizes.size_cd_start'),
            'size_code_end' => __('validation.attributes.mt_sizes.size_cd_end'),
            'jan_code_start' => __('validation.attributes.mt_stock_keeping_units.jan_cd_start'),
            'jan_code_end' => __('validation.attributes.mt_stock_keeping_units.jan_cd_end'),
        ];
    }

    public function messages()
    {
        return [
            'code1_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'code2_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'code3_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'code4_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'code5_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'code6_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'code7_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'item_cd_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'color_code_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'size_code_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'jan_code_end.gte' => __('validation.error_messages.range_is_incorrect'),
        ];
    }
}
