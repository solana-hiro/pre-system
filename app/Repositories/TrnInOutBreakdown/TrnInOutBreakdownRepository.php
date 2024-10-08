<?php

namespace App\Repositories\TrnInOutBreakdown;

use App\Models\TrnInOutBreakdown;

class TrnInOutBreakdownRepository
{

    /**
     * 商品データの条件取得
     * @param $params
     * @return Object
     */
    public function getByDetailId($params)
    {
        $result = TrnInOutBreakdown::where('trn_in_out_detail_id', $params['trn_in_out_detail_id'])->with(['mtStockKeepingUnit'])->get();
        return $result;
    }
    /**
     * 商品データの条件取得
     * @param $params, $trn_in_out_detail_id
     * @return Object
     */
    function updateInOutData($params, $trn_in_out_detail_id)
    {
        $breakdowns = array_filter((array)$params, function ($param) {
            $breakdown = (array)$param;
            return isset($breakdown['id']) || $breakdown['order_in_out_quantity'] != '';
        });
        foreach ($breakdowns as $param) {
            $param = (array) $param;
            if (isset($param['id']) && $param['order_in_out_quantity'] == '') {
                TrnInOutBreakdown::where('id', $param['id'])->delete();
            } else if (!isset($param['id'])) {
                TrnInOutBreakdown::create([
                    'trn_in_out_detail_id' => $trn_in_out_detail_id,
                    'mt_stock_keeping_unit_id' => $param['mt_stock_keeping_unit_id'],
                    'order_in_out_quantity' => $param['order_in_out_quantity'],
                    'mt_user_last_update_id' => \Auth::user()->id,
                ]);
            } else {
                TrnInOutBreakdown::where('id', $param['id'])->update([
                    'order_in_out_quantity' => $param['order_in_out_quantity'],
                    'mt_user_last_update_id' => \Auth::user()->id,
                ]);
            }
        }
    }

    /**
     * 商品データの条件取得
     * @param $params
     * @return Object
     */
    public function deleteInOutData($trn_in_out_detail_id)
    {
        $result = TrnInOutBreakdown::where('trn_in_out_detail_id', $trn_in_out_detail_id)->delete();
        return $result;
    }
}
