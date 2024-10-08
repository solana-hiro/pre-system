<?php
namespace App\Repositories\MtHoliday;

use App\Models\MtHoliday;
use App\Consts\CommonConsts;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtHolidayRepository implements MtHolidayRepositoryInterface
{

    /**
     * 休日情報取得 全件取得
     * @return Object
     */
    public function getAll() {
		$result = MtHoliday::get();
		return $result;
    }

    /**
     * 休日情報取得 初期データ取得
     * @return Object
     */
    public function getInitData()
    {
        $result = MtHoliday::get();
        return $result;
    }

    /**
     * 休日情報取得 更新
     * @param $param
     * @return Object
     */
    public function update($params) {
        $result = array();
        try {
            DB::beginTransaction();
            //比較　入力値とDB登録値
            if (!$params['update'] && !$params['delete_list']) {
                $result['status'] = CommonConsts::STATUS_SUCCESS;
                return $result;
            }
            // 新規追加
            if($params['update']) {
                $str = explode(",", $params['update']);
                foreach ($str as $param) {
                    $mtHoliday = MtHoliday::where('set_date', $param)->first();
                    //変更の有無を確認
                    if (
                        isset($mtHoliday)
                    ) {
                        continue; //変更がない場合、更新を行わない
                    }
                    $mtHoliday = new MtHoliday();
                    $mtHoliday->set_date = new Carbon($param);
                    $mtHoliday->mt_user_last_update_id = Auth::user()->id;
                    $mtHoliday->save();
                }
            }
            // 既存休日の削除
            if ($params['delete_list']) {
                $str = explode(",", $params['delete_list']);
                foreach ($str as $param) {
                    $mtHoliday = MtHoliday::where('set_date', $param)->delete();
                }
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }
}
