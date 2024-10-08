<?php

namespace App\Http\Resources\MtLocation;

use Illuminate\Http\Resources\Json\JsonResource;

class MtLocationListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
			'warehouse_cd' => $this->mt_warehouses.warehouse_cd,  //倉庫マスタ.倉庫コード
			'warehouse_name' => $this->mt_warehouses.warehouse_name,  //倉庫マスタ.倉庫名
			'jan_cd' => $this->mt_stock_keeping_units.jan_cd,  //SKUマスタ.ＪＡＮコード
			'item_cd' => $this->mt_items.item_cd,  //商品マスタ.商品コード
			'item_name' => $this->mt_items.item_name,  //商品マスタ.商品名
			'color_cd' => $this->mt_colors.color_cd,  //カラーマスタ.カラーコード
			'color_name' => $this->mt_colors.color_name,  //カラーマスタ.カラー名
			'size_cd' => $this->mt_sizes.size_cd,  //サイズマスタ.サイズコード
			'size_name' => $this->mt_sizes.size_name,  //サイズマスタ.サイズ名
			'shelf_number_1' => $this->mt_locations.shelf_number_1,  //ロケーションマスタ.棚番１
			'shelf_number_2' => $this->mt_locations.shelf_number_2,  //ロケーションマスタ.棚番２
			'rank' => $this->mt_locations.rank,  //ロケーションマスタ.ランク
        ];
    }
}

