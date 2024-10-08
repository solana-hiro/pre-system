<?php

namespace App\Http\Resources\MtWarehouse;

use Illuminate\Http\Resources\Json\JsonResource;

class MtWarehouseListResource extends JsonResource
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
			'warehouse_name_kana' => $this->mt_warehouses.warehouse_name_kana,  //倉庫マスタ.倉庫名カナ
			'warehouse_kind' => $this->mt_warehouses.warehouse_kind,  //倉庫マスタ.倉庫種別
			'analysis_warehouse_kbn' => $this->mt_warehouses.analysis_warehouse_kbn,  //倉庫マスタ.分析用各倉庫区分
			'asset_stock_validity_kbn' => $this->mt_warehouses.asset_stock_validity_kbn,  //倉庫マスタ.資産在庫有効区分
			'del_kbn' => $this->mt_warehouses.del_kbn,  //倉庫マスタ.削除区分
        ];
    }
}

