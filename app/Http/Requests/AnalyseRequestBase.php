<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnalyseRequestBase extends FormRequest
{
    protected function createRules($validations, $request)
    {
        $rules = array();
        if ($request->has('cancel')) return $rules;
        foreach ($validations as $validation) {
            if ($validation['type'] === 'date') {
                $rules["{$validation['name']}_filter_first_year"] = [Rule::requiredIf($this->requiredFirst($request, "{$validation['name']}_filter_condition"))];
                $rules["{$validation['name']}_filter_second_year"] = [Rule::requiredIf($this->requiredSecond($request, "{$validation['name']}_filter_condition"))];
            } else {
                $rules["{$validation['name']}_filter_first"] = [Rule::requiredIf($this->requiredFirst($request, "{$validation['name']}_filter_condition"))];
                $rules["{$validation['name']}_filter_second"] = [Rule::requiredIf($this->requiredSecond($request, "{$validation['name']}_filter_condition"))];
            }
        }
        return $rules;
    }

    protected function createAttributes($validations)
    {
        $attributes = array();
        foreach ($validations as $validation) {
            if ($validation['type'] === 'date') {
                $attributes["{$validation['name']}_filter_first_year"] = __("validation.attributes.analyse.name.{$validation['name']}") . '：' . __('validation.attributes.analyse.side.left');
                $attributes["{$validation['name']}_filter_second_year"] = __("validation.attributes.analyse.name.{$validation['name']}") . '：' . __('validation.attributes.analyse.side.right');
            } else {
                $attributes["{$validation['name']}_filter_first"] = __("validation.attributes.analyse.name.{$validation['name']}") . '：' . __('validation.attributes.analyse.side.left');
                $attributes["{$validation['name']}_filter_second"] = __("validation.attributes.analyse.name.{$validation['name']}") . '：' . __('validation.attributes.analyse.side.right');
            }
        }
        return $attributes;
    }

    protected function createMessages($validations)
    {
        $attributes = array();
        foreach ($validations as $validation) {
            if ($validation['type'] === 'date') {
                $attributes["{$validation['name']}_filter_first_year"] = __('validation.analyse.required');
                $attributes["{$validation['name']}_filter_second_year"] = __('validation.analyse.required');
            } else {
                $attributes["{$validation['name']}_filter_first"] = __('validation.analyse.required');
                $attributes["{$validation['name']}_filter_second"] = __('validation.analyse.required');
            }
        }
        return $attributes;
    }

    protected function requiredFirst($request, $id)
    {
        if (!$request->has($id)) return false;
        return $request->input($id) !== 'none' ? true : false;
    }

    protected function requiredSecond($request, $id)
    {
        if (!$request->has($id)) return false;
        return $request->input($id) === 'between' ? true : false;
    }
}
