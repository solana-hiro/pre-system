<?php

namespace App\Http\Resources\MtColorPattern;

use Illuminate\Http\Resources\Json\JsonResource;

class MtColorPatternListResource extends JsonResource
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
            'id' => $this->id,
			'color_pattern_cd' => $this->color_pattern_cd,  //カラーパターンマスタ.カラーパターンコード
			'color_cd_1' => $this->color_cd_1,  //カラーマスタ.カラーコード
			'color_name_1' => $this->color_name_1,  //カラーマスタ.カラー名
			'color_cd_2' => $this->color_cd_2,  //カラーマスタ.カラーコード
			'color_name_2' => $this->color_name_2,  //カラーマスタ.カラー名
			'color_cd_3' => $this->color_cd_3,  //カラーマスタ.カラーコード
			'color_name_3' => $this->color_name_3,  //カラーマスタ.カラー名
			'color_cd_4' => $this->color_cd_4,  //カラーマスタ.カラーコード
			'color_name_4' => $this->color_name_4,  //カラーマスタ.カラー名
			'color_cd_5' => $this->color_cd_5,  //カラーマスタ.カラーコード
			'color_name_5' => $this->color_name_5,  //カラーマスタ.カラー名
			'color_cd_6' => $this->color_cd_6,  //カラーマスタ.カラーコード
			'color_name_6' => $this->color_name_6,  //カラーマスタ.カラー名
			'color_cd_7' => $this->color_cd_7,  //カラーマスタ.カラーコード
			'color_name_7' => $this->color_name_7,  //カラーマスタ.カラー名
			'color_cd_8' => $this->color_cd_8,  //カラーマスタ.カラーコード
			'color_name_8' => $this->color_name_8,  //カラーマスタ.カラー名
			'color_cd_9' => $this->color_cd_9,  //カラーマスタ.カラーコード
			'color_name_9' => $this->color_name_9,  //カラーマスタ.カラー名
			'color_cd_10' => $this->color_cd_10,  //カラーマスタ.カラーコード
			'color_name_10' => $this->color_name_10,  //カラーマスタ.カラー名
			'color_cd_11' => $this->color_cd_11,  //カラーマスタ.カラーコード
			'color_name_11' => $this->color_name_11,  //カラーマスタ.カラー名
			'color_cd_12' => $this->color_cd_12,  //カラーマスタ.カラーコード
			'color_name_12' => $this->color_name_12,  //カラーマスタ.カラー名
			'color_cd_13' => $this->color_cd_13,  //カラーマスタ.カラーコード
			'color_name_13' => $this->color_name_13,  //カラーマスタ.カラー名
			'color_cd_14' => $this->color_cd_14,  //カラーマスタ.カラーコード
			'color_name_14' => $this->color_name_14,  //カラーマスタ.カラー名
			'color_cd_15' => $this->color_cd_15,  //カラーマスタ.カラーコード
			'color_name_15' => $this->color_name_15,  //カラーマスタ.カラー名
			'color_cd_16' => $this->color_cd_16,  //カラーマスタ.カラーコード
			'color_name_16' => $this->color_name_16,  //カラーマスタ.カラー名
			'color_cd_17' => $this->color_cd_17,  //カラーマスタ.カラーコード
			'color_name_17' => $this->color_name_17,  //カラーマスタ.カラー名
			'color_cd_18' => $this->color_cd_18,  //カラーマスタ.カラーコード
			'color_name_18' => $this->color_name_18, //カラーマスタ.カラー名
			'color_cd_19' => $this->color_cd_19,  //カラーマスタ.カラーコード
			'color_name_19' => $this->color_name_19,  //カラーマスタ.カラー名
			'color_cd_20' => $this->color_cd_20,  //カラーマスタ.カラーコード
			'color_name_20' => $this->color_name_20,  //カラーマスタ.カラー名
        ];
    }
}

