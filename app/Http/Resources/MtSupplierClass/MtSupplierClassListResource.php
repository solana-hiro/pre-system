<?php

namespace App\Http\Resources\MtSupplierClass;

use Illuminate\Http\Resources\Json\JsonResource;

class MtSupplierClassListResource extends JsonResource
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
            "supplier_class_cd" => $this->supplier_class_cd,   //仕入先分類マスタ.仕入先分類コード
            "supplier_class_name" => $this->supplier_class_name,  //仕入先分類マスタ.仕入先分類名
        ];
    }
}
