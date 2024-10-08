<?php

namespace App\Http\Resources\MtItemClass;

use Illuminate\Http\Resources\Json\JsonResource;

class MtItemClassListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [
            'item_class_cd' => $this->resource->item_class_cd,  //商品分類マスタ.id
            'def_item_class_thing_id' => $this->resource->item_class_cd,  //商品分類マスタ.商品分類項目定義ＩＤ
            'item_class_cd' => $this->resource->item_class_cd,  //商品分類マスタ.商品分類コード
			'item_class_name' => $this->resource->item_class_name,  //商品分類マスタ.商品分類名
			'ec_display_flg' => $this->resource->ec_display_flg === 0 ? "非表示" : "表示",  //商品分類マスタ.商品分類名
        ];
    }
}

