<?php
namespace App\Http\Requests\MtColorPattern;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class MtColorPatternSearchRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'color_pattern_cd' => 'nullable | numeric',							//カラーパターンコード
        ];
    }

    public function attributes()
    {
        return [
            'color_pattern_cd' => __('validation.attributes.mt_color_pattern.color_pattern_cd'),
        ];
    }
}
