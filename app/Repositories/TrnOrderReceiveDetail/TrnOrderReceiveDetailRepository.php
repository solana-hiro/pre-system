<?php
namespace App\Repositories\TrnOrderReceiveDetail;

use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use App\Models\TrnOrderReceiveHeader;
use App\Models\TrnOrderReceiveDetail;
use App\Models\MtItem;
use App\Models\TrnOrderHeader;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class TrnOrderReceiveDetailRepository implements TrnOrderReceiveDetailRepositoryInterface
{
    /**
     * @param $params
     * @return \Illuminate\Database\Eloquent\Builder[]|Collection
     */
    public function exportPaymentGuidanceExcel($params)
    {
        $specify_deadline_from = $params['specify_deadline_from'];
        $specify_deadline_to = $params['specify_deadline_to'];

        $query = TrnOrderReceiveDetail::query();
        $query->when($specify_deadline_from, function ($query, $specify_deadline_from) {
            return $query->where('specify_deadline', '>=', $specify_deadline_from);
        });
        $query->when($specify_deadline_to, function ($query, $specify_deadline_to) {
            return $query->where('specify_deadline', '<=', $specify_deadline_to);
        });

        return $query->get();
    }

    public function create($params, $header_id, $parent_params)
    {
        $mt_item_id = null;
        $unit = null;
        if (isset($params['item_cd'])) {
            $mt_item = MtItem::where('item_cd', $params['item_cd'])->first();
            if ($mt_item) {
                $mt_item_id = $mt_item->id;
                $unit = $mt_item->unit;
            }
        }
        $mt_user_last_update_id = Auth::id();
        TrnOrderReceiveDetail::create([
            'trn_order_receive_header_id' => $header_id,
            'order_line_no' => $params['order_line_no'],
            'order_receive_detail_cd' => $params['order_receive_detail_cd'],
            'mt_item_id' => $mt_item_id,
            'item_name' => $params['item_name'],
            'retail_price' => $params['retail_price'],
            'order_receive_quantity' => $params['order_receive_quantity'],
            'unit' => $unit,
            'price_rate' => $params['price_rate'],
            'cost_price' => $params['cost_price'],
            'order_receive_price' => $params['order_receive_price'],
            'cost_amount' => $params['cost_amount'],
            'order_receive_amount' => $params['order_receive_amount'],
            'specify_deadline_none_flg' => $params['specify_deadline_none_flg'],
            'specify_deadline' => $params['specify_deadline'],
            'memo_1' => $params['memo_1'],
            'memo_2' => $params['memo_2'],
            'order_receive_finish_flg' => $params['order_receive_finish_flg'],
            'shortage_flg' => $params['shortage_flg'],
            'remaining_flg' => $params['remaining_flg'],
            'payment_finish_flg' => $params['payment_finish_flg'],
            'mt_user_last_update_id' => $mt_user_last_update_id,
            'mt_order_receive_sticky_note_id' => $parent_params['mt_order_receive_sticky_note_id'],
            'item_name_input_kbn' => $parent_params['name_input_kbn'],
            'def_shipping_status_kbn_id' => 1
        ]);
    }
}
