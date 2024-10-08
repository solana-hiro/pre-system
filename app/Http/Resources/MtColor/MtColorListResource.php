<?php

namespace App\Http\Resources\MtColor;

use Illuminate\Http\Resources\Json\JsonResource;

class MtColorListResource extends JsonResource
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
			'color_cd' => $this->mt_colors.color_cd,  //カラーマスタ.カラーコード
			'color_name' => $this->mt_colors.color_name,  //カラーマスタ.カラー名
			'html_color_cd' => $this->mt_colors.html_color_cd,  //カラーマスタ.HTMLカラーコード
			'sort_order' => $this->mt_colors.sort_order,  //カラーマスタ.並び順
        ];
    }
}

