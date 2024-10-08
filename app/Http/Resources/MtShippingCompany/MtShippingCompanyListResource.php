<?php

namespace App\Http\Resources\MtShippingCompany;

use Illuminate\Http\Resources\Json\JsonResource;

class MtShippingCompanyListResource extends JsonResource
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
			'shipping_company_cd' => $this->mt_shipping_companies.shipping_company_cd,  //運送会社マスタ.運送会社コード
			'shipping_company_name' => $this->mt_shipping_companies.shipping_company_name,  //運送会社マスタ.運送会社名
			'mt_slip_kind7_id' => $this->mt_slip_kinds.mt_slip_kind7_id,  //伝票種別マスタ.伝票種別コード
			'mt_slip_kind17_id' => $this->mt_slip_kinds.mt_slip_kind17_id,  //伝票種別マスタ.伝票種別コード
        ];
    }
}

