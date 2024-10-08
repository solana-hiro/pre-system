<?php

namespace App\Http\Resources\MtCustomerClass;

use Illuminate\Http\Resources\Json\JsonResource;

class MtCustomerClassListResource extends JsonResource
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
            "customer_cd" => $this->customer_class_cd,   //得意先分類マスタ.得意先分類コード
            "customer_name" => $this->customer_class_name,  //得意先分類マスタ.得意先分類名
        ];
    }
}
