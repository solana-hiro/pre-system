<?php
namespace App\Http\Requests\DefPsKbn;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class SearchRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'ps_kbn_cd' => 'nullable',							//PS区分
        ];
    }

    public function attributes()
    {
        return [
            'ps_kbn_cd' => __('validation.attributes.def_ps_kbn.ps_kbn_cd'),
        ];
    }
}
