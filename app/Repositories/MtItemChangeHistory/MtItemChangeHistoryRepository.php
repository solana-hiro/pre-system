<?php

namespace App\Repositories\MtItemChangeHistory;

use App\Models\MtItemChangeHistory;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class MtItemChangeHistoryRepository implements MtItemChangeHistoryRepositoryInterface
{

    /**
     * 商品履歴データの全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtItemChangeHistory::get();
        return $result;
    }

    /**
     * 商品履歴データ(一覧) 出力
     * @param $param
     * @return Object
     */
    public function export($params)
    {
        $startCode = ($params['item_code_start']) ? $params['item_code_start'] : '';
        $endCode = ($params['item_code_end']) ? $params['item_code_end'] : 'ZZZZZZZZZ';
        $startDate = date('Y-m-d H:i:s', strtotime($params['date_year_start'] . '-' . $params['date_month_start'] . '-' . $params['date_day_start'] . ' 00:00:00'));
        $endDate = date('Y-m-d H:i:s', strtotime($params['date_year_end'] . '-' . $params['date_month_end'] . '-' . $params['date_day_end'] . ' 23:59:59'));
        $startUserId = ($params['updated_user_id_start']) ? str_pad($params['updated_user_id_start'], 4, 0, STR_PAD_LEFT) : '';
        $endUserId = ($params['updated_user_id_end']) ? str_pad($params['updated_user_id_end'], 4, 0, STR_PAD_LEFT) : 'ZZZZ';
        $detail = $params['update_detail'];
        $result = MtItemChangeHistory::leftJoin("mt_items", "mt_item_change_histories.mt_item_id", "mt_items.id")
            ->leftJoin("mt_users", "mt_item_change_histories.mt_user_id", "mt_users.id")
            ->leftJoin("def_item_change_history_things", "mt_item_change_histories.def_item_change_history_thing_id", "def_item_change_history_things.id")
            ->whereBetween("mt_items.item_cd", [$startCode, $endCode])
            ->whereBetween("mt_item_change_histories.change_datetime", [$startDate, $endDate])
            ->whereBetween("mt_users.user_cd", [$startUserId, $endUserId])
            ->when(($detail), function ($query) use ($detail) {
                return $query->where(function ($query) use ($detail) {
                    return $query->where("def_item_change_history_things.thing_name", 'like', '%' . $detail . '%');
                });
            })
            ->orderBy("mt_item_change_histories.id")
            ->get();
        return $result;
    }

    /**
     * 商品履歴データ  指定条件にて取得
     * @param $param
     * @return Object
     */
    public function get($param)
    {
        $result = MtItemChangeHistory::get();
        return $result;
    }
}
