<?php

namespace App\Http\Requests\MtCatalog;

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
                'catalogcode' => 'required|digits:4',
                'catalogtitle' => 'required|max:100',
                'content_type' => 'required',
                'release_start_datetime_year' => 'nullable',
                'release_start_datetime_month' => 'nullable',
                'release_start_datetime_day' => 'nullable',
                'release_end_datetime_year' => 'nullable',
                'release_end_datetime_month' => 'nullable',
                'release_end_datetime_day' => 'nullable',
                'display_flg' => 'required',
                'display_sort_order' => 'required|max_digits:3|gte:1',
                'image_file_src' => 'required',
                'hidden_detail_id' => 'nullable',
                'update' => 'nullable',
                'content' => $this->all()['content_type'] === '0' ? 'required|max:3000' : 'nullable',
                'rich_text_contents' => $this->all()['content_type'] === '1' ? 'required|max:3000' : 'nullable',
            ];
        }
        return $rules;
    }
    public function attributes()
    {
        return [
            'catalogcode' => __('validation.attributes.mt_catalogs.catalog_cd'),
            'catalogtitle' => __('validation.attributes.mt_catalogs.catalog_name'),
            'content_type' => __('validation.attributes.mt_catalogs.catalog_explanation_type'),
            'content' => __('validation.attributes.mt_catalogs.catalog_explanation'),
            'rich_text_contents' => __('validation.attributes.mt_catalogs.catalog_explanation'),
            'display_flg' => __('validation.attributes.mt_catalogs.display_flg'),
            'display_sort_order' => __('validation.attributes.mt_catalogs.display_sort_order'),
            'image_file_src' => __('validation.attributes.mt_catalogs.image_file')
        ];
    }
}
