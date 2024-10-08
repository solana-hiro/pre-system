<?php
namespace App\Http\Requests\MtCustomerClass;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class MtCustomerClassExportRequest extends FormRequest
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
                'cancel' => 'nullable',								  //キャンセル
            ];
        }
        if ($this->has('excel')) {
            $rules = [
                'excel' => 'nullable',								  //Excel出力
                'code1_start' => 'nullable',			      //対象得意先分類コード範囲 START
                'code1_end' => 'nullable',                    //対象得意先分類コード範囲 END
                'code2_start' => 'nullable',                  //対象得意先分類コード範囲 START
                'code2_end' => 'nullable',                    //対象得意先分類コード範囲 END
                'code3_start' => 'nullable',                   //対象得意先分類コード範囲 START
                'code3_end' => 'nullable',				  //対象得意先分類コード範囲 END
                'customer_class_thing_id' => 'required',			  //対象得意先分類ID
            ];
        }
        if ($this->has('preview')) {
            $rules = [
                'preview' => 'nullable',                                 //Preview出力
                'code1_start' => 'nullable',                            //対象得意先分類コード範囲 START
                'code1_end' => 'nullable',                              //対象得意先分類コード範囲 END
                'code2_start' => 'nullable',                            //対象得意先分類コード範囲 START
                'code2_end' => 'nullable',                              //対象得意先分類コード範囲 END
                'code3_start' => 'nullable',                            //対象得意先分類コード範囲 START
                'code3_end' => 'nullable',                              //対象得意先分類コード範囲 END
                'customer_class_thing_id' => 'required',                //対象得意先分類ID
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code1_start'] && "1" === $this->all()['customer_class_thing_id']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'code1_start' => 'nullable',                    //対象得意先分類コード範囲 START
                'code1_end' => 'nullable|gte:code1_start',      //対象得意先分類コード範囲 END
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code2_start'] && "2" === $this->all()['customer_class_thing_id']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'code2_start' => 'nullable',                    //対象得意先分類コード範囲 START
                'code2_end' => 'nullable|gte:code2_start',      //対象得意先分類コード範囲 END
            ];
        }
        if ($this->has('excel') && null !== $this->all()['code3_start'] && "3" === $this->all()['customer_class_thing_id']) {
            $rules = [
                'excel' => 'nullable',                                  //Excel出力
                'code3_start' => 'nullable',                    //対象得意先分類コード範囲 START
                'code3_end' => 'nullable|gte:code3_start',     //対象得意先分類コード範囲 END
            ];
        }
        if ($this->has('preview') && null !== $this->all()['code1_start'] && "1" === $this->all()['customer_class_thing_id']) {
            $rules = [
                'preview' => 'nullable',                                //Preview出力
                'code1_start' => 'nullable',                    //対象得意先分類コード範囲 START
                'code1_end' => 'nullable|gte:code1_start',      //対象得意先分類コード範囲 END
            ];
        }
        if ($this->has('preview') && null !== $this->all()['code2_start'] && "2" === $this->all()['customer_class_thing_id']) {
            $rules = [
                'preview' => 'nullable',                                //Preview出力
                'code2_start' => 'nullable',                    //対象得意先分類コード範囲 START
                'code2_end' => 'nullable|gte:code2_start',      //対象得意先分類コード範囲 END
            ];
        }
        if ($this->has('preview') && null !== $this->all()['code3_start'] && "3" === $this->all()['customer_class_thing_id']) {
            $rules = [
                'preview' => 'nullable',                                //Preview出力
                'code3_start' => 'nullable',                    //対象得意先分類コード範囲 START
                'code3_end' => 'nullable|gte:code3_start',      //対象得意先分類コード範囲 END
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'customer_class_thing_id' => __('validation.attributes.mt_customer_classes.customer_class_thing_id'),
            'code1_start' => __('validation.attributes.mt_customer_classes.customer_class_cd_start'),
            'code1_end' => __('validation.attributes.mt_customer_classes.customer_class_cd_end'),
            'code2_start' => __('validation.attributes.mt_customer_classes.customer_class_cd_start'),
            'code2_end' => __('validation.attributes.mt_customer_classes.customer_class_cd_end'),
            'code3_start' => __('validation.attributes.mt_customer_classes.customer_class_cd_start'),
            'code3_end' => __('validation.attributes.mt_customer_classes.customer_class_cd_end'),
        ];
    }

    public function messages()
    {
        return [
            'code1_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'code2_end.gte' => __('validation.error_messages.range_is_incorrect'),
            'code3_end.gte' => __('validation.error_messages.range_is_incorrect'),
        ];
    }
}
