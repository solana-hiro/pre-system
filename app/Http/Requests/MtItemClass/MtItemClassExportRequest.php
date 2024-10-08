<?php

namespace App\Http\Requests\MtItemClass;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class MtItemClassExportRequest extends FormRequest
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
                'code1_start' => 'nullable',                  //対象商品分類コード範囲 START
                'code1_end' => 'nullable',                 //対象商品分類コード範囲 END
                'code2_start' => 'nullable',               //対象商品分類コード範囲 START
                'code2_end' => 'nullable',                 //対象商品分類コード範囲 END
                'code3_start' => 'nullable',               //対象商品分類コード範囲 START
                'code3_end' => 'nullable',                  //対象商品分類コード範囲 END
                'code4_start' => 'nullable',               //対象商品分類コード範囲 START
                'code4_end' => 'nullable',                  //対象商品分類コード範囲 END
                'code5_start' => 'nullable',               //対象商品分類コード範囲 START
                'code5_end' => 'nullable',                  //対象商品分類コード範囲 END
                'code6_start' => 'nullable',               //対象商品分類コード範囲 START
                'code6_end' => 'nullable',                  //対象商品分類コード範囲 END
                'code7_start' => 'nullable',               //対象商品分類コード範囲 START
                'code7_end' => 'nullable',                  //対象商品分類コード範囲 END
                'item_class_id' => 'required',              //対象商品分類ID
            ];
        }
        if ($this->has('preview')) {
            $rules = [
                'preview' => 'nullable',                                 //Preview出力
                'code1_start' => 'nullable',                            //対象商品分類コード範囲 START
                'code1_end' => 'nullable',                              //対象商品分類コード範囲 END
                'code2_start' => 'nullable',                            //対象商品分類コード範囲 START
                'code2_end' => 'nullable',                              //対象商品分類コード範囲 END
                'code3_start' => 'nullable',                            //対象商品分類コード範囲 START
                'code3_end' => 'nullable',                              //対象商品分類コード範囲 END
                'code4_start' => 'nullable',               //対象商品分類コード範囲 START
                'code4_end' => 'nullable',                  //対象商品分類コード範囲 END
                'code5_start' => 'nullable',               //対象商品分類コード範囲 START
                'code5_end' => 'nullable',                  //対象商品分類コード範囲 END
                'code6_start' => 'nullable',               //対象商品分類コード範囲 START
                'code6_end' => 'nullable',                  //対象商品分類コード範囲 END
                'code7_start' => 'nullable',               //対象商品分類コード範囲 START
                'code7_end' => 'nullable',                  //対象商品分類コード範囲 END
                'item_class_id' => 'required',                //対象商品分類ID
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code1_start'] && "1" === $this->all()['item_class_id']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'code1_start' => 'nullable',                    //対象商品分類コード範囲 START
                'code1_end' => 'nullable|gte:code1_start',      //対象商品分類コード範囲 END
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code2_start'] && "2" === $this->all()['item_class_id']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'code2_start' => 'nullable',                    //対象商品分類コード範囲 START
                'code2_end' => 'nullable|gte:code2_start',      //対象商品分類コード範囲 END
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code3_start'] && "3" === $this->all()['item_class_id']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'code3_start' => 'nullable',                    //対象商品分類コード範囲 START
                'code3_end' => 'nullable|gte:code3_start',     //対象商品分類コード範囲 END
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code4_start'] && "4" === $this->all()['item_class_id']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'code4_start' => 'nullable',                    //対象商品分類コード範囲 START
                'code4_end' => 'nullable|gte:code4_start',     //対象商品分類コード範囲 END
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code5_start'] && "5" === $this->all()['item_class_id']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'code5_start' => 'nullable',                    //対象商品分類コード範囲 START
                'code5_end' => 'nullable|gte:code5_start',     //対象商品分類コード範囲 END
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code6_start'] && "6" === $this->all()['item_class_id']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'code6_start' => 'nullable',                    //対象商品分類コード範囲 START
                'code6_end' => 'nullable|gte:code6_start',     //対象商品分類コード範囲 END
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code7_start'] && "7" === $this->all()['item_class_id']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'code7_start' => 'nullable',                    //対象商品分類コード範囲 START
                'code7_end' => 'nullable|gte:code7_start',     //対象商品分類コード範囲 END
            ];
        }
        if ($this->has('preview') && null !== $this->all()['code1_start'] && "1" === $this->all()['item_class_id']) {
            $rules = [
                'preview' => 'nullable',                                //Preview出力
                'code1_start' => 'nullable',                    //対象商品分類コード範囲 START
                'code1_end' => 'nullable|gte:code1_start',      //対象商品分類コード範囲 END
            ];
        }
        if ($this->has('preview') && null !== $this->all()['code2_start'] && "2" === $this->all()['item_class_id']) {
            $rules = [
                'preview' => 'nullable',                                //Preview出力
                'code2_start' => 'nullable',                    //対象商品分類コード範囲 START
                'code2_end' => 'nullable|gte:code2_start',      //対象商品分類コード範囲 END
            ];
        }
        if ($this->has('preview') && null !== $this->all()['code3_start'] && "3" === $this->all()['item_class_id']) {
            $rules = [
                'preview' => 'nullable',                                //Preview出力
                'code3_start' => 'nullable',                    //対象商品分類コード範囲 START
                'code3_end' => 'nullable|gte:code3_start',      //対象商品分類コード範囲 END
            ];
        }
        if ($this->has('preview') && null !== $this->all()['code4_start'] && "4" === $this->all()['item_class_id']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'code4_start' => 'nullable',                    //対象商品分類コード範囲 START
                'code4_end' => 'nullable|gte:code4_start',     //対象商品分類コード範囲 END
            ];
        }
        if ($this->has('preview') && null !== $this->all()['code5_start'] && "5" === $this->all()['item_class_id']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'code5_start' => 'nullable',                    //対象商品分類コード範囲 START
                'code5_end' => 'nullable|gte:code5_start',     //対象商品分類コード範囲 END
            ];
        }
        if ($this->has('preview') && null !== $this->all()['code6_start'] && "6" === $this->all()['item_class_id']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'code6_start' => 'nullable',                    //対象商品分類コード範囲 START
                'code6_end' => 'nullable|gte:code6_start',      //対象商品分類コード範囲 END
            ];
        }
        if ($this->has('preview') && null !== $this->all()['code7_start'] && "7" === $this->all()['item_class_id']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'code7_start' => 'nullable',                    //対象商品分類コード範囲 START
                'code7_end' => 'nullable|gte:code7_start',      //対象商品分類コード範囲 END
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'item_class_thing_id' => __('validation.attributes.mt_item_classes.item_class_thing_id'),
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
        ];
    }
}
