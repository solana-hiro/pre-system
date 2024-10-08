<?php
namespace App\Http\Requests\MtCatalog;

use Illuminate\Foundation\Http\FormRequest;
/**
 * リクエストパラメータ
 */
class MtCatalogSearchRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'catalog_cd' => 'nullable',							//カタログコード
            'catalog_name' => 'nullable',						//カタログ名
        ];
    }

    public function attributes()
    {
        return [
            'catalog_cd' => __('validation.attributes.mt_catalog.catalog_cd'),
            'catalog_name' => __('validation.attributes.mt_catalog.catalog_name'),
        ];
    }
}
