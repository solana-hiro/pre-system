<?php
namespace App\Http\Requests\MtItem;

use Illuminate\Foundation\Http\FormRequest;
/**
 * リクエストパラメータ
 */
class MtItemByClassExportRequest extends FormRequest
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
        if ($this->has('cancel')) {
            $rules = [
                'cancel' => 'nullable',                                  //キャンセル
            ];
        }
        if ($this->has('excel')) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'item_class_code1_start' => 'nullable|numeric',                  //対象商品分類コード範囲 START
                'item_class_code1_end' => 'nullable|numeric',                 //対象商品分類コード範囲 END
                'item_class_code2_start' => 'nullable|numeric',               //対象商品分類コード範囲 START
                'item_class_code2_end' => 'nullable|numeric',                 //対象商品分類コード範囲 END
                'item_class_code3_start' => 'nullable|numeric',               //対象商品分類コード範囲 START
                'item_class_code3_end' => 'nullable|numeric',                  //対象商品分類コード範囲 END
                'item_class_id' => 'required',                              //対象商品分類ID
                'item_code_start' => 'nullable|numeric',               //対象商品コード範囲 START
                'item_code_end' => 'nullable|numeric',                  //対象商品コード範囲 END
            ];
        }
        if ($this->has('preview')) {
            $rules = [
                'preview' => 'nullable',                                 //Preview出力
                'item_class_code1_start' => 'nullable|numeric',                  //対象商品分類コード範囲 START
                'item_class_code1_end' => 'nullable|numeric',                 //対象商品分類コード範囲 END
                'item_class_code2_start' => 'nullable|numeric',               //対象商品分類コード範囲 START
                'item_class_code2_end' => 'nullable|numeric',                 //対象商品分類コード範囲 END
                'item_class_code3_start' => 'nullable|numeric',               //対象商品分類コード範囲 START
                'item_class_code3_end' => 'nullable|numeric',                  //対象商品分類コード範囲 END
                'item_class_id' => 'required',                              //対象商品分類ID
                'item_code_start' => 'nullable|numeric',               //対象商品コード範囲 START
                'item_code_end' => 'nullable|numeric',                  //対象商品コード範囲 END
            ];
        }
        if ($this->has('excel') && null !== $this->all()['item_class_code1_start'] && "1" === $this->all()['item_class_id']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'item_class_code1_start' => 'nullable|numeric',                    //対象商品分類コード範囲 START
                'item_class_code1_end' => 'nullable|numeric|gte:item_class_code1_start',      //対象商品分類コード範囲 END
                'item_code_end' => 'nullable|numeric|gte:item_code_start',      //対象商品コード範囲 END
            ];
        }
        if ($this->has('excel') && null !== $this->all()['item_class_code2_start'] && "2" === $this->all()['item_class_id']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'item_class_code2_start' => 'nullable|numeric',                    //対象商品分類コード範囲 START
                'item_class_code2_end' => 'nullable|numeric|gte:item_class_code2_start',      //対象商品分類コード範囲 END
                'item_code_end' => 'nullable|numeric|gte:item_code_start',      //対象商品コード範囲 END
            ];
        }
        if ($this->has('excel') && null !== $this->all()['item_class_code3_start'] && "3" === $this->all()['item_class_id']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'item_class_code3_start' => 'nullable|numeric',                    //対象商品分類コード範囲 START
                'item_class_code3_end' => 'nullable|numeric|gte:item_class_code3_start',      //対象商品分類コード範囲 END
                'item_code_end' => 'nullable|numeric|gte:item_code_start',      //対象商品コード範囲 END
            ];
        }
        if ($this->has('preview') && null !== $this->all()['item_class_code1_start'] && "1" === $this->all()['item_class_id']) {
            $rules = [
                'preview' => 'nullable',                                //Preview出力
                'item_class_code1_start' => 'nullable|numeric',                    //対象商品分類コード範囲 START
                'item_class_code1_end' => 'nullable|numeric|gte:item_class_code1_start',      //対象商品分類コード範囲 END
                'item_code_end' => 'nullable|numeric|gte:item_code_start',      //対象商品コード範囲 END
            ];
        }
        if ($this->has('preview') && null !== $this->all()['item_class_code2_start'] && "2" === $this->all()['item_class_id']) {
            $rules = [
                'preview' => 'nullable',                                //Preview出力
                'item_class_code2_start' => 'nullable|numeric',                    //対象商品分類コード範囲 START
                'item_class_code2_end' => 'nullable|numeric|gte:item_class_code2_start',      //対象商品分類コード範囲 END
                'item_code_end' => 'nullable|numeric|gte:item_code_start',      //対象商品コード範囲 END
            ];
        }
        if ($this->has('preview') && null !== $this->all()['item_class_code3_start'] && "3" === $this->all()['item_class_id']) {
            $rules = [
                'preview' => 'nullable',                                //Preview出力
                'item_class_code3_start' => 'nullable|numeric',                    //対象商品分類コード範囲 START
                'item_class_code3_end' => 'nullable|numeric|gte:item_class_code3_start',      //対象商品分類コード範囲 END
                'item_code_end' => 'nullable|numeric|gte:item_code_start',      //対象商品コード範囲 END
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'item_class_id' => __('validation.attributes.mt_item_classes.def_item_class_thing_id'),
            'item_class_code1_start' => __('validation.attributes.mt_item_classes.item_class_code1_start'),
            'item_class_code1_end' => __('validation.attributes.mt_item_classes.item_class_code1_end'),
            'item_class_code2_start' => __('validation.attributes.mt_item_classes.item_class_code2_start'),
            'item_class_code2_end' => __('validation.attributes.mt_item_classes.item_class_code2_end'),
            'item_class_code3_start' => __('validation.attributes.mt_item_classes.item_class_code3_start'),
            'item_class_code3_end' => __('validation.attributes.mt_item_classes.item_class_code3_end'),
            'item_code_start' => __('validation.attributes.mt_item_classes.item_code_start'),
            'item_code_end' => __('validation.attributes.mt_item_classes.item_code_end'),
        ];
    }

    public function messages()
    {
        return [
            'item_class_code1_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'item_class_code2_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'item_class_code3_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'item_code_end.gte' => __('validation.error_messages.range_is_incorrect'),
        ];
    }
}
