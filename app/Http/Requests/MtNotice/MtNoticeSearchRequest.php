<?php
namespace App\Http\Requests\MtNotice;

use Illuminate\Foundation\Http\FormRequest;
/**
 * リクエストパラメータ
 */
class MtNoticeSearchRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'notice_cd' => 'nullable',							//お知らせコード
            'title' => 'nullable',								//タイトル
        ];
    }

    public function attributes()
    {
        return [
            'notice_cd' => __('validation.attributes.mt_notice.notice_cd'),
            'title' => __('validation.attributes.mt_notice.title'),
        ];
    }
}
