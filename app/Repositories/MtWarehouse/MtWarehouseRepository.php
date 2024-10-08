<?php

namespace App\Repositories\MtWarehouse;

use App\Models\MtWarehouse;
use App\Models\MtLocation;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtWarehouseRepository implements MtWarehouseRepositoryInterface
{

    /**
     * 倉庫情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtWarehouse::orderBy('warehouse_cd')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 倉庫情報取得 削除
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $result['data'] = MtWarehouse::where('id', $id)->delete();
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * 倉庫情報取得 更新
     * @param $param
     * @return Object
     */
    public function update($params)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $j = 0;
            foreach ($params['update_id'] as $param) {
                if (!empty($params['update_warehouse_code'][$j])) {
                    $mtWarehouse = new MtWarehouse();
                    $mtWarehouse = MtWarehouse::where('id', $param)->first();
                    //変更の有無を確認
                    if (
                        isset($mtWarehouse) &&
                        $mtWarehouse['warehouse_cd'] === str_pad($params['update_warehouse_code'][$j], 6, 0, STR_PAD_LEFT) &&
                        $mtWarehouse['warehouse_name'] === $params['update_warehouse_name'][$j] &&
                        $mtWarehouse['warehouse_name_kana'] === $params['update_warehouse_name_kana'][$j] &&
                        $mtWarehouse['warehouse_kind'] === $params['update_warehouse_kind'][$j] &&
                        $mtWarehouse['analysis_warehouse_kbn'] === $params['update_analysis_warehouse_kbn'][$j] &&
                        $mtWarehouse['asset_stock_validity_kbn'] === $params['update_asset_stock_validity_kbn'][$j] &&
                        $mtWarehouse['del_kbn'] === $params['update_del_kbn'][$j]
                    ) {
                        $j++;
                        continue; //変更がない場合、更新を行わない
                    }
                    $mtWarehouse->warehouse_cd = str_pad($params['update_warehouse_code'][$j], 6, 0, STR_PAD_LEFT);
                    $mtWarehouse->warehouse_name = $params['update_warehouse_name'][$j];
                    $mtWarehouse->warehouse_name_kana = $params['update_warehouse_name_kana'][$j];
                    $mtWarehouse->warehouse_kind = $params['update_warehouse_kind'][$j];
                    $mtWarehouse->analysis_warehouse_kbn = $params['update_analysis_warehouse_kbn'][$j];
                    $mtWarehouse->asset_stock_validity_kbn = $params['update_asset_stock_validity_kbn'][$j];
                    $mtWarehouse->del_kbn = $params['update_del_kbn'][$j];
                    $mtWarehouse->mt_user_last_update_id = Auth::user()->id;
                    $mtWarehouse->save();
                }
                $j++;
            }

            //新規登録
            $i = 0;
            foreach ($params as $param) {
                if (!empty($params['insert_warehouse_code'][$i])) {
                    $mtWarehouse = new MtWarehouse();
                    $mtWarehouse->warehouse_cd = str_pad($params['insert_warehouse_code'][$i], 6, 0, STR_PAD_LEFT);
                    $mtWarehouse->warehouse_name = $params['insert_warehouse_name'][$i];
                    $mtWarehouse->warehouse_name_kana = $params['insert_warehouse_name_kana'][$i];
                    $mtWarehouse->warehouse_kind = $params['insert_warehouse_kind'][$i];
                    $mtWarehouse->analysis_warehouse_kbn = $params['insert_analysis_warehouse_kbn'][$i];
                    $mtWarehouse->asset_stock_validity_kbn = $params['insert_asset_stock_validity_kbn'][$i];
                    $mtWarehouse->del_kbn = $params['insert_del_kbn'][$i];
                    $mtWarehouse->mt_user_last_update_id = Auth::user()->id;
                    $mtWarehouse->save();
                }
                $i++;
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

    /**
     * 初期値取得(ID=1のCode取得)
     * @return Object
     */
    public function getInitCode()
    {
        $result = MtWarehouse::where('id', 1)->first();
        return $result;
    }

    /**
     * 倉庫情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params)
    {
        $code = $params['warehouse_cd'] ? CodeUtil::pad($params['warehouse_cd'], 4) : null;
        $name = $params['warehouse_name_kana'] ?? null;

        $query = MtWarehouse::query();
        $query->when($code, fn($query) => $query->where("warehouse_cd", '>=', $code));
        $query->when($name, fn($query) => $query->where("warehouse_name_kana", 'like', "%$name%"));
        $query->orderBy('warehouse_cd');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * 倉庫リスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params)
    {
        $startCode = ($params['code_start']) ? str_pad($params['code_start'], 6, 0, STR_PAD_LEFT) : '';
        $endCode = ($params['code_end']) ? str_pad($params['code_end'], 6, 0, STR_PAD_LEFT) : 'ZZZZZZ';
        $result = MtWarehouse::whereBetween("warehouse_cd", [$startCode, $endCode])
            ->orderBy("warehouse_cd")
            ->get();
        return $result;
    }

    /**
     * 倉庫　初期データ取得
     * @param $params
     * @return Object
     */
    public function getInitData()
    {
        $result = MtWarehouse::orderBy('warehouse_cd')->get();
        return $result;
    }

    /**
     * 倉庫 存在確認(code指定)
     * @param $code
     * @return Object
     */
    public function isExist($code)
    {
        $result = MtWarehouse::where('warehouse_cd', $code)->exists();
        return $result;
    }

    /**
     * 倉庫 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['warehouse_cd'] ? CodeUtil::pad($params['warehouse_cd'], 6) : null;

        $query = MtWarehouse::query();
        $query->where('warehouse_cd', $code);

        return $query->first();
    }

    /**
     * 倉庫　最小ID取得
     * @return Object
     */
    public function getMinId()
    {
        $code = MtLocation::leftJoin('mt_warehouses', 'mt_locations.mt_warehouse_id', 'mt_warehouses.id')->min('warehouse_cd');
        $result = MtWarehouse::where('warehouse_cd', $code)->first();
        return $result['warehouse_cd'];
    }

    /**
     * 倉庫　最大ID取得
     * @return Object
     */
    public function getMaxId()
    {
        $code = MtLocation::leftJoin('mt_warehouses', 'mt_locations.mt_warehouse_id', 'mt_warehouses.id')->max('warehouse_cd');
        $result = MtWarehouse::where('warehouse_cd', $code)->first();
        return $result['warehouse_cd'];
    }

    /**
     * 前頁
     * @param $id
     * @return Object
     */
    public function getPrevById($id)
    {
        if (isset($id)) {
            $code = MtWarehouse::where('id', $id)->first();
            $result = MtLocation::leftJoin('mt_warehouses', 'mt_locations.mt_warehouse_id', 'mt_warehouses.id')::where('warehouse_cd', '<', $code['warehouse_cd'])->orderByDesc('warehouse_cd')->first();
        }
        return $result;
    }

    /**
     * 次頁
     * @param $id
     * @return Object
     */
    public function getNextById($id)
    {
        if (isset($id)) {
            $code = MtWarehouse::where('id', $id)->first();
            $result = MtLocation::leftJoin('mt_warehouses', 'mt_locations.mt_warehouse_id', 'mt_warehouses.id')::where('warehouse_cd', '>', $code['warehouse_cd'])->orderBy('warehouse_cd')->first();
        } else {
            $result =  MtLocation::leftJoin('mt_warehouses', 'mt_locations.mt_warehouse_id', 'mt_warehouses.id')::orderBy('warehouse_cd')->first();
        }
        return $result;
    }
}
