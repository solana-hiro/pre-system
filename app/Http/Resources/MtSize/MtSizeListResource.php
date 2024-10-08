<?php

namespace App\Http\Resources\MtSize;

use Illuminate\Http\Resources\Json\JsonResource;

class MtSizeListResource extends JsonResource
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
			'size_cd' => $this->mt_sizes.size_cd,  //サイズマスタ.サイズコード
			'size_name' => $this->mt_sizes.size_name,  //サイズマスタ.サイズ名
			'sort_order' => $this->mt_sizes.sort_order,  //サイズマスタ.並び順
        ];
    }
}

