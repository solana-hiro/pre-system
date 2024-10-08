<?php

namespace App\Http\Resources\TrnOrderReceiveHeader;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class AccountantInquiryListResource extends JsonResource
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
            'order_receive_date' => $this->order_receive_date,
            'specify_deadline' => $this->specify_deadline,
            'order_receive_number' => $this->order_receive_number,
            'settlement_method' => $this->settlement_method === 1 ? 'クレジット決済' : '',
            'customer_cd' => $this->customer_cd,
            'customer_name' => $this->customer_name,
            'item_cd' => $this->item_cd,
            'item_name' => $this->item_name,
            'color_cd' => $this->color_cd,
            'color_name' => $this->color_cd,
            'size_cd' => $this->size_cd,
            'size_name' => $this->size_name,
            'trn_order_receive_details_order_receive_quantity' => $this->trn_sale_breakdowns_order_receive_quantity,
            'order_receive_price' => $this->order_receive_price,
            'sum' => ($this->trn_sale_breakdowns_order_receive_quantity * $this->order_receive_price),
            'quantity' => ($this->trn_sale_breakdowns_order_receive_quantity - $this->trn_order_receive_breakdowns_order_receive_quantity),
            'balance' => ($this->trn_sale_breakdowns_order_receive_quantity - $this->trn_order_receive_breakdowns_order_receive_quantity) * $this->order_receive_price,
            'order_number' => $this->order_number,
            'order_receive_finish_flg' => $this->order_receive_finish_flg === 0 ? '未完' : '完了',
            'delivery_destination_id' => $this->delivery_destination_id,
            'delivery_destination_name' => $this->delivery_destination_name,
        ];
    }
}
