<?php

namespace App\Http\Resources\TrnOrderReceiveHeader;

use Illuminate\Http\Resources\Json\JsonResource;

class ShippingInquiryListResource extends JsonResource
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
            'item_cd' => $this->,
            'item_name' => $this->,
            'color_cd' => $this->,
            'color_name' => $this->,
            'size_cd' => $this->,
            'size_name' => $this->,
            'deadline' => $this->,
            'item_cd' => $this->,
            'item_cd' => $this->,
            'item_cd' => $this->,
            'item_cd' => $this->,
            'item_cd' => $this->,
            'item_cd' => $this->,
            'item_cd' => $this->,
            'item_cd' => $this->,
            'item_cd' => $this->,
        ];
    }
}
