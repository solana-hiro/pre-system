<?php
namespace App\Http\Requests\MtSizePattern;

use Illuminate\Foundation\Http\FormRequest;
/**
 * リクエストパラメータ
 */
class MtSizePatternSearchRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'size_pattern_cd' => 'nullable | numeric',							//サイズパターンコード
        ];
    }

    public function attributes()
    {
        return [
            'size_pattern_cd' => __('validation.attributes.mt_size_pattern.size_pattern_cd'),
        ];
    }
}
