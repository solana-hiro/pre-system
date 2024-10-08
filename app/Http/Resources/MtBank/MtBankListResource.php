<?php

namespace App\Http\Resources\MtBank;

use Illuminate\Http\Resources\Json\JsonResource;

class MtBankListResource extends JsonResource
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
			'bank_cd' => $this->mt_banks.bank_cd,  //銀行マスタ.銀行コード
			'bank_name' => $this->mt_banks.bank_name,  //銀行マスタ.銀行名
        ];
    }
}

