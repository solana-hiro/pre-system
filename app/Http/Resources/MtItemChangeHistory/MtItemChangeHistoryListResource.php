<?php

namespace App\Http\Resources\MtItemChangeHistory;

use Illuminate\Http\Resources\Json\JsonResource;

class MtItemChangeHistoryListResource extends JsonResource
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
			'item_cd' => $this->mt_items.item_cd,  //商品マスタ.商品コード
			'item_name' => $this->mt_items.item_name,  //商品マスタ.商品名
			'change_datetime' => $this->mt_item_change_histories.change_datetime,  //商品変更履歴マスタ.変更日時
			'user_cd' => $this->mt_users.user_cd,  //ユーザマスタ.ユーザコード
			'thing_name' => $this->def_item_change_history_things.thing_name,  //商品変更履歴項目定義ID.項目名
			'change_before' => $this->mt_item_change_histories.change_before,  //商品変更履歴マスタ.変更前
			'change_after' => $this->mt_item_change_histories.change_after,  //商品変更履歴マスタ.変更後
        ];
    }
}

