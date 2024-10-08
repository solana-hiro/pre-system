<?php

namespace App\Http\Resources\MtSizePattern;

use Illuminate\Http\Resources\Json\JsonResource;

class MtSizePatternListResource extends JsonResource
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
            'id' => $this->id,  //id
			'size_pattern_cd' => $this->size_pattern_cd,  //サイズパターンマスタ.サイズパターンコード
			'size_cd_1' => $this->size_cd_1,  //サイズマスタ.サイズコード
			'size_name_1' => $this->size_name_1,  //サイズマスタ.サイズ名
			'size_cd_2' => $this->size_cd_2,  //サイズマスタ.サイズコード
			'size_name_2' => $this->size_name_2,  //サイズマスタ.サイズ名
			'size_cd_3' => $this->size_cd_3,  //サイズマスタ.サイズコード
			'size_name_3' => $this->size_name_3,  //サイズマスタ.サイズ名
			'size_cd_4' => $this->size_cd_4,  //サイズマスタ.サイズコード
			'size_name_4' => $this->size_name_4,  //サイズマスタ.サイズ名
			'size_cd_5' => $this->size_cd_5,  //サイズマスタ.サイズコード
			'size_name_5' => $this->size_name_5,  //サイズマスタ.サイズ名
			'size_cd_6' => $this->size_cd_6,  //サイズマスタ.サイズコード
			'size_name_6' => $this->size_name_6,  //サイズマスタ.サイズ名
			'size_cd_7' => $this->size_cd_7,  //サイズマスタ.サイズコード
			'size_name_7' => $this->size_name_7,  //サイズマスタ.サイズ名
			'size_cd_8' => $this->size_cd_8,  //サイズマスタ.サイズコード
			'size_name_8' => $this->size_name_8,  //サイズマスタ.サイズ名
			'size_cd_9' => $this->size_cd_9,  //サイズマスタ.サイズコード
			'size_name_9' => $this->size_name_9,  //サイズマスタ.サイズ名
			'size_cd_10' => $this->size_cd_10,  //サイズマスタ.サイズコード
			'size_name_10' => $this->size_name_10,  //サイズマスタ.サイズ名
        ];
    }
}

