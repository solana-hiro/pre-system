<?php

namespace App\Http\Requests\MtTopFreeArea;

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
        if ($this->has('prev')) {
            $rules = [
                'prev' => 'nullable',
            ];
        }
        if ($this->has('next')) {
            $rules = [
                'next' => 'nullable',
            ];
        }
        if ($this->has('delete')) {
            $rules = [
                'delete' => 'nullable',
            ];
        }
        if ($this->has('redirect')) {
            $rules = [
                'redirect' => 'nullable',
            ];
        }
        if ($this->has('update')) {
            $rules = [
                'input_area_cd' => 'required|digits:4',
                'input_area_title' => 'required|max:100',
                'setting_position' => 'required',
                'content_type' => 'required',
                'content' => 'nullable|max:3000',
                'release_start_datetime_year' => 'nullable',
                'release_start_datetime_month' => 'nullable',
                'release_start_datetime_day' => 'nullable',
                'release_end_datetime_year' => 'nullable',
                'release_end_datetime_month' => 'nullable',
                'release_end_datetime_day' => 'nullable',
                'display_flg' => 'required',
                'display_sort_order' => 'required|max_digits:3|gte:1',
                'hidden_detail_id' => 'nullable',
                'publication_destination_flg' => 'nullable',
                'class1_type' => 'nullable',
                'class2_type' => 'nullable',
                'class3_type' => 'nullable',
                'rich_text_contents' => 'nullable|max:3000',
                'update' => 'nullable'
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'input_area_cd' => __('validation.attributes.mt_top_free_areas.area_cd'),
            'input_area_title' => __('validation.attributes.mt_top_free_areas.area_title'),
            'setting_position' => __('validation.attributes.mt_top_free_areas.news_kind'),
            'content_type' => __('validation.attributes.mt_top_free_areas.content_type'),
            'content' => __('validation.attributes.mt_top_free_areas.content'),
            'rich_text_contents' => __('validation.attributes.mt_top_free_areas.rich_text_contents'),
            'display_flg' => __('validation.attributes.mt_top_free_areas.display_flg'),
            'display_sort_order' => __('validation.attributes.mt_top_free_areas.display_sort_order'),
        ];
    }

}
