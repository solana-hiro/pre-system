<?php
namespace App\Repositories\WkInventoryBase;

use App\Models\WkInventoryBase;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class WkInventoryBaseRepository implements WkInventoryBaseRepositoryInterface
{

    /**
     * 全件取得
     * @return Object
     */
    public function getAll() {
		$result = WkInventoryBase::get();
		return $result;
    }

    /**
     * 棚卸チェックリストの情報取得
     * @param array $params
     * @return Object
     */
     public function getChecklist(array $params) {
        //商品コード順orJANコード順
     	$result = WkInventoryBase::get();
        return $result;
     }

    /**
     * 棚卸原票の情報取得
     * @param array $params
     * @return Object
     */
     public function getSlip(array $params) {
     	$result = WkInventoryBase::get();
        return $result;
     }

    /**
     * 棚卸差異表の情報取得
     * @param array $params
     * @return Object
     */
     public function getDifferenceList(array $params) {
     	$result = WkInventoryBase::get();
        return $result;
     }

    /**
     * 棚卸更新処理
     * @param array $params
     * @return Object
     */
     public function update(array $params) {
     	$result = WkInventoryBase::get();
        // DB更新
        return $result;
     }

    /**
     * 棚卸開始処理
     * @param array $params
     * @return Object
     */
     public function updateStart(array $params) {
        $wkInventoryBase = WkInventoryBase::where('inventory_status_flg', 0)->get();
        $result = null;
        foreach ($wkInventoryBase as $rec) {
            $rec->now_inventory_date = str_pad($params['year'], 4, 0, STR_PAD_LEFT). str_pad($params['month'], 2, 0, STR_PAD_LEFT). str_pad($params['day'], 2, 0, STR_PAD_LEFT);
            $rec->inventory_status_flg = 0;
            $rec->mt_user_last_update_id = Auth::user()->id;
            $result[] = $rec->save();
        }
        return $result;
        return $result;
     }

    /**
     * 棚卸終了処理
     * @param array $params
     * @return Object
     */
     public function updateEnd(array $params) {
        $wkInventoryBase = WkInventoryBase::where('inventory_status_flg', 0)->get();
        $result = null;
        foreach($wkInventoryBase as $rec) {
            $rec->inventory_status_flg = 1;
            $rec->mt_user_last_update_id = Auth::user()->id;
            $result[] = $rec->save();
        }
        return $result;
     }

    /**
     * 資産在庫表の情報取得
     * @param array $params
     * @return Object
     */
     public function getAssetStockList(array $params) {
     	$result = WkInventoryBase::get();
        return $result;
     }

    /** 今回棚卸日付取得(開始中)
     *
     * @return $rows
     */
    public function getNowInventoryDateNow()
    {
        $datas = WkInventoryBase::where('inventory_status_flg', 0)->first();
        return $datas;
    }

    /** 今回棚卸日付取得(終了)
     *
     * @return $rows
     */
    public function getNowInventoryDateEnd()
    {
        $datas = WkInventoryBase::where('inventory_status_flg', 1)->first();
        return $datas;
    }

    /**
     * 得意先リスト ファイルインポート登録
     * @param $params
     * @return Object
     */
    public function importUpdate($params)
    {
        //TODO更新
    }
}
