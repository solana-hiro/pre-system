<?php
namespace App\Http\Requests\MtNotice;

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
                'noticecd' => 'required|digits:4',
                'noticetitle' => 'required|max:100',
                'news_kind' => 'required',
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
                'rich_text_contents' => 'nullable|max:3000',
                'sub_tab_item' => 'nullable',
                'update' => 'nullable'
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'noticecd' => __('validation.attributes.mt_notices.noticecd'),
            'noticetitle' => __('validation.attributes.mt_notices.noticetitle'),
            'news_kind' => __('validation.attributes.mt_notices.news_kind'),
            'content_type' => __('validation.attributes.mt_notices.content_type'),
            'content' => __('validation.attributes.mt_notices.content'),
            'rich_text_contents' => __('validation.attributes.mt_notices.rich_text_contents'),
            'display_flg' => __('validation.attributes.mt_notices.display_flg'),
            'display_sort_order' => __('validation.attributes.mt_notices.display_sort_order'),
        ];
    }
}
