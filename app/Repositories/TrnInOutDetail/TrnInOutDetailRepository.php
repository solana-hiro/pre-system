<?php

namespace App\Repositories\TrnInOutDetail;

use App\Models\TrnInOutDetail;
use Illuminate\Support\Facades\Auth;

class TrnInOutDetailRepository
{

    /**
     * 商品データの条件取得
     * @param $params, $trn_in_out_header_id, $index
     * @return Object
     */
    function updateInOutData($params, $trn_in_out_header_id, $index)
    {
        $data = [
            'id' => $params['detail_id'],
            'in_out_detail_cd' => str_pad($index, 2, '0', STR_PAD_LEFT),
            'trn_in_out_header_id' => $trn_in_out_header_id,
            'mt_item_id' => $params['item_id'],
            'retail_price_tax_out' => $params['retail_price_tax_out'] ?? 0,
            'memo' => $params['memo'] ?? '',
            'mt_user_last_update_id' => Auth::user()->id,
            'item_name' => $params['item_name'] ?? null,
            'order_line_no' => $index,
        ];

        return TrnInOutDetail::updateOrCreate(['id' => $data['id']], $data);
    }

    /**
     * 明細データの削除
     * @param $id
     * @return Boolean
     */
    function deleteInOutData($trn_in_out_detail_id) {
        return TrnInOutDetail::where('id', $trn_in_out_detail_id)->delete();
    }
}
