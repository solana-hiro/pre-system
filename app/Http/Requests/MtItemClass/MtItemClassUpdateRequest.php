<?php

namespace App\Http\Requests\MtItemClass;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * リクエストパラメータ
 */
class MtItemClassUpdateRequest extends FormRequest
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
        if ($this->has('update') && "1" === $this->all()['item_class']) {
            $rules = [
                'update' => 'nullable',
                'item_class' => 'required',
                'insert_code.*' => [
                    'nullable',
                    'max:6',
                    Rule::unique('mt_item_classes', 'item_class_cd')->where(
                        function ($query) {
                            return $query->where('def_item_class_thing_id', $this->input('item_class'));
                        }
                    )
                ],
                'insert_name.*' => 'nullable|max:20',
                'update_item_class_code1.*' => 'required|max:6',
                'update_item_class_name1.*' => 'nullable|max:20',
                'update_id1.*' => 'nullable'
            ];
        }
        if ($this->has('update') && "2" === $this->all()['item_class']) {
            $rules = [
                'update' => 'nullable',
                'item_class' => 'required',
                'insert_code.*' => [
                    'nullable',
                    'max:6',
                    Rule::unique('mt_item_classes', 'item_class_cd')->where(
                        function ($query) {
                            return $query->where('def_item_class_thing_id', $this->input('item_class'));
                        }
                    )
                ],
                'insert_name.*' => 'nullable|max:20',
                'update_item_class_code2.*' => 'required|max:6',
                'update_item_class_name2.*' => 'nullable|max:20',
                'update_id2.*' => 'nullable'
            ];
        }
        if ($this->has('update') && "3" === $this->all()['item_class']) {
            $rules = [
                'update' => 'nullable',
                'item_class' => 'required',
                'insert_code.*' => [
                    'nullable',
                    'max:6',
                    Rule::unique('mt_item_classes', 'item_class_cd')->where(
                        function ($query) {
                            return $query->where('def_item_class_thing_id', $this->input('item_class'));
                        }
                    )
                ],
                'insert_name.*' => 'nullable|max:20',
                'update_item_class_code3.*' => 'required|max:6',
                'update_item_class_name3.*' => 'nullable|max:20',
                'update_id3.*' => 'nullable'
            ];
        }
        if ($this->has('update') && "4" === $this->all()['item_class']) {
            $rules = [
                'update' => 'nullable',
                'item_class' => 'required',
                'insert_code.*' => [
                    'nullable',
                    'max:6',
                    Rule::unique('mt_item_classes', 'item_class_cd')->where(
                        function ($query) {
                            return $query->where('def_item_class_thing_id', $this->input('item_class'));
                        }
                    )
                ],
                'insert_name.*' => 'nullable|max:20',
                'update_item_class_code4.*' => 'required|max:6',
                'update_item_class_name4.*' => 'nullable|max:20',
                'update_id4.*' => 'nullable'
            ];
        }
        if ($this->has('update') && "5" === $this->all()['item_class']) {
            $rules = [
                'update' => 'nullable',
                'item_class' => 'required',
                'insert_code.*' => [
                    'nullable',
                    'max:6',
                    Rule::unique('mt_item_classes', 'item_class_cd')->where(
                        function ($query) {
                            return $query->where('def_item_class_thing_id', $this->input('item_class'));
                        }
                    )
                ],
                'insert_name.*' => 'nullable|max:20',
                'update_item_class_code5.*' => 'required|max:6',
                'update_item_class_name5.*' => 'nullable|max:20',
                'update_id5.*' => 'nullable'
            ];
        }
        if ($this->has('update') && "6" === $this->all()['item_class']) {
            $rules = [
                'update' => 'nullable',
                'item_class' => 'required',
                'insert_code.*' => [
                    'nullable',
                    'max:6',
                    Rule::unique('mt_item_classes', 'item_class_cd')->where(
                        function ($query) {
                            return $query->where('def_item_class_thing_id', $this->input('item_class'));
                        }
                    )
                ],
                'insert_name.*' => 'nullable|max:20',
                'update_item_class_code6.*' => 'required|max:6',
                'update_item_class_name6.*' => 'nullable|max:20',
                'update_id6.*' => 'nullable'
            ];
        }
        if ($this->has('update') && "7" === $this->all()['item_class']) {
            $rules = [
                'update' => 'nullable',
                'item_class' => 'required',
                'insert_code.*' => [
                    'nullable',
                    'max:6',
                    Rule::unique('mt_item_classes', 'item_class_cd')->where(
                        function ($query) {
                            return $query->where('def_item_class_thing_id', $this->input('item_class'));
                        }
                    )
                ],
                'insert_name.*' => 'nullable|max:20',
                'update_item_class_code7.*' => 'required|max:6',
                'update_item_class_name7.*' => 'nullable|max:20',
                'update_id7.*' => 'nullable'
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'item_class' => __('validation.attributes.mt_item_classes.def_item_class_thing_id'),
            'insert_code.*' => __('validation.attributes.mt_item_classes.item_class_cd'),
            'insert_name.*' => __('validation.attributes.mt_item_classes.item_class_name'),
            'update_item_class_code1.*' => __('validation.attributes.mt_item_classes.item_class_cd'),
            'update_item_class_name1.*' => __('validation.attributes.mt_item_classes.item_class_name'),
            'update_item_class_code2.*' => __('validation.attributes.mt_item_classes.item_class_cd'),
            'update_item_class_name2.*' => __('validation.attributes.mt_item_classes.item_class_name'),
            'update_item_class_code3.*' => __('validation.attributes.mt_item_classes.item_class_cd'),
            'update_item_class_name3.*' => __('validation.attributes.mt_item_classes.item_class_name'),
            'update_item_class_code4.*' => __('validation.attributes.mt_item_classes.item_class_cd'),
            'update_item_class_name4.*' => __('validation.attributes.mt_item_classes.item_class_name'),
            'update_item_class_code5.*' => __('validation.attributes.mt_item_classes.item_class_cd'),
            'update_item_class_name5.*' => __('validation.attributes.mt_item_classes.item_class_name'),
            'update_item_class_code6.*' => __('validation.attributes.mt_item_classes.item_class_cd'),
            'update_item_class_name6.*' => __('validation.attributes.mt_item_classes.item_class_name'),
            'update_item_class_code7.*' => __('validation.attributes.mt_item_classes.item_class_cd'),
            'update_item_class_name7.*' => __('validation.attributes.mt_item_classes.item_class_name'),
        ];
    }
}
