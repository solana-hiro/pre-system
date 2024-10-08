<?php

namespace App\Repositories\MtLocation;

use App\Models\MtLocation;
use App\Models\MtWarehouse;
use App\Models\MtStockKeepingUnit;
use App\Models\MtItem;
use App\Models\MtColor;
use App\Models\MtSize;
use App\Consts\CommonConsts;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtLocationRepository implements MtLocationRepositoryInterface
{

    /**
     * ロケーション情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtLocation::get();
        return $result;
    }

    /**
     * ロケーション情報取得 初期データ取得
     * @return Object
     */
    public function getInitData($mtWarehouseId)
    {
        $result = MtLocation::select(
            'mt_locations.id as mt_location_id',
            'mt_locations.mt_stock_keeping_unit_id as mt_stock_keeping_unit_id',
            'mt_locations.*',
            'mt_items.*',
            'mt_colors.*',
            'mt_sizes.*',
            'mt_warehouses.*',
        )
            ->leftJoin('mt_stock_keeping_units', 'mt_locations.mt_stock_keeping_unit_id', 'mt_stock_keeping_units.id')
            ->leftJoin('mt_items', 'mt_stock_keeping_units.mt_item_id', 'mt_items.id')
            ->leftJoin('mt_colors', 'mt_stock_keeping_units.mt_color_id', 'mt_colors.id')
            ->leftJoin('mt_sizes', 'mt_stock_keeping_units.mt_size_id', 'mt_sizes.id')
            ->leftJoin('mt_warehouses', 'mt_locations.mt_warehouse_id', 'mt_warehouses.id')
            ->where('mt_warehouse_id', $mtWarehouseId)->paginate(CommonConsts::PAGINATION_20);
        return $result;
    }

    /**
     * ロケーション(一覧) 更新
     * @param $param
     * @return Object
     */
    public function update($params)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $warehouseId = $params['warehouse_id'];
            foreach ($params['location'] as $locationParams) {
                if ($this->isDelete($locationParams)) {
                    $this->deleteLocation($locationParams);
                } else {
                    $this->isExistLocation($locationParams)
                        ? $this->updateLocation($locationParams)
                        : $this->createLocation($locationParams, $warehouseId);
                }
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    private function isDelete($locationParams)
    {
        return is_null($locationParams['shelf_number_1']);
    }

    private function deleteLocation($locationParams)
    {
        if (is_null($locationParams['mt_location_id'])) return;

        MtLocation::destroy($locationParams['mt_location_id']);
    }

    private function isExistLocation($locationParams)
    {
        return !is_null($locationParams['mt_location_id']);
    }

    private function updateLocation($locationParams)
    {
        $record = MtLocation::find($locationParams['mt_location_id']);
        $record->fill($locationParams);
        $record->mt_user_last_update_id = Auth::user()->id;
        $record->save();
    }

    private function createLocation($locationParamas, $warehouseId)
    {
        $record = new MtLocation();
        $record->mt_warehouse_id = $warehouseId;
        $record->fill($locationParamas);
        $record->mt_user_last_update_id = Auth::user()->id;
        $record->save();
    }

    /**
     * 最小ID取得　code無しの為id順
     * @return Object
     */
    /*
    public function getMinId()
    {
        $result = MtLocation::min('id');
        return $result;
    }
        */

    /**
     * 最大ID取得　code無しの為id順
     * @return Object
     */
    /*
    public function getMaxId()
    {
        $result = MtLocation::max('id');
        return $result;
    }]*/

    /**
     * 前頁　　code無しの為id順
     * @param $id
     * @return Object
     */
    /*
    public function getPrevById($id)
    {
        if (isset($id)) {
            $result = MtLocation::where('id', $id)->first();
        }
        return $result;
    }
        */

    /**
     * 次頁 code無しの為id順
     * @param $id
     * @return Object
     */
    /*
    public function getNextById($id)
    {
        if (isset($id)) {
            $result = MtLocation::where('id', '>', $id)->orderBy('id')->first();
        } else {
            $result = MtLocation::orderBy('id')->first();
        }
        return $result;
    }
        */

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
            $result = MtLocation::leftJoin('mt_warehouses', 'mt_locations.mt_warehouse_id', 'mt_warehouses.id')->where('warehouse_cd', '<', $code['warehouse_cd'])->orderByDesc('warehouse_cd')->first();
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
            $result = MtLocation::leftJoin('mt_warehouses', 'mt_locations.mt_warehouse_id', 'mt_warehouses.id')->where('warehouse_cd', '>', $code['warehouse_cd'])->orderBy('warehouse_cd')->first();
        } else {
            $result =  MtLocation::leftJoin('mt_warehouses', 'mt_locations.mt_warehouse_id', 'mt_warehouses.id')->orderBy('warehouse_cd')->first();
        }
        return $result;
    }


    /**
     * ロケーション情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params)
    {
        $result = MtLocation::get();
        return $result;
    }

    /**
     * ロケーション情報取得 倉庫指定で取得
     * @param String
     * @return Object
     */
    public function getByWarehouseId($id)
    {
        $result = MtLocation::query()
            ->joinSkuDetail()
            ->where('mt_warehouse_id', $id)
            ->paginate(CommonConsts::PAGINATION_20);
        return $result;
    }

    /**
     * ロケーションリスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params)
    {
        $warehouseCode = str_pad($params['warehouse_code'], 6, 0, STR_PAD_LEFT);
        $itemCodeStart = ($params['item_code_start']) ? $params['item_code_start'] : '';
        $itemCodeEnd = ($params['item_code_end']) ? $params['item_code_end'] : 'ZZZZZZZZZ';
        $colorCodeStart = ($params['color_code_start']) ? $params['color_code_start'] : '';
        $colorCodeEnd = ($params['color_code_end']) ? $params['color_code_end'] : 'ZZZZZ';
        $sizeCodeStart = ($params['size_code_start']) ? $params['size_code_start'] : '';
        $sizeCodeEnd = ($params['size_code_end']) ? $params['size_code_end'] : 'ZZZZZ';
        /*
        $shelfNumberCode1Start = ($params['shelf_number_code1_start']) ? $params['shelf_number_code1_start'] : '';
        $shelfNumberCode1End= ($params['shelf_number_code1_end']) ? $params['shelf_number_code1_end'] : 'ZZZZZZZZZZ';
        $shelfNumberCode2Start = ($params['shelf_number_code2_start']) ? $params['shelf_number_code2_start'] : '';
        $shelfNumberCode2End = ($params['shelf_number_code2_end']) ? $params['shelf_number_code2_end'] : 'ZZZZZZZZZZ';
        */
        $result = MtLocation::leftJoin("mt_warehouses", "mt_locations.mt_warehouse_id", "mt_warehouses.id")
            ->leftJoin("mt_stock_keeping_units", "mt_locations.mt_stock_keeping_unit_id", "mt_stock_keeping_units.id")
            ->leftJoin("mt_items", "mt_stock_keeping_units.mt_item_id", "mt_items.id")
            ->leftJoin("mt_colors", "mt_stock_keeping_units.mt_color_id", "mt_colors.id")
            ->leftJoin("mt_sizes", "mt_stock_keeping_units.mt_size_id", "mt_sizes.id")
            ->where('mt_warehouses.warehouse_cd', $warehouseCode)
            ->whereBetween("mt_items.item_cd", [$itemCodeStart, $itemCodeEnd])
            ->whereBetween("mt_colors.color_cd", [$colorCodeStart, $colorCodeEnd])
            ->whereBetween("mt_sizes.size_cd", [$sizeCodeStart, $sizeCodeEnd])
            ->when(isset($params['shelf_number_code1_start']) && !empty($params['shelf_number_code1_start']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mt_locations.shelf_number_1", '>=', $params['shelf_number_code1_start']);
                });
            })->when(isset($params['shelf_number_code1_end']) && !empty($params['shelf_number_code1_end']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mt_locations.shelf_number_1", '<=', $params['shelf_number_code1_end']);
                });
            })->when(isset($params['shelf_number_code2_start']) && !empty($params['shelf_number_code2_start']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mt_locations.shelf_number_2", '>=', $params['shelf_number_code2_start']);
                });
            })->when(isset($params['shelf_number_code2_end']) && !empty($params['shelf_number_code2_end']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mt_locations.shelf_number_2", '<=', $params['shelf_number_code2_end']);
                });
            })
            ->orderBy("mt_locations.id")
            ->get();
        return $result;
    }

    /**
     * ロケーション ファイルインポート登録
     * @param $params
     * @return Object
     */
    public function importUpdate($params)
    {
        $result = array();
        try {
            DB::beginTransaction();
            //ロケーションマスタへ登録
            foreach ($params as $param) {
                foreach ($param as $rec) {
                    $mtWarehouse = MtWarehouse::where('warehouse_cd', $rec['倉庫コード'])->first();
                    if (empty($mtWarehouse)) {
                        DB::rollback();
                        $result['status'] = CommonConsts::STATUS_ERROR;
                        $result['error'] = '倉庫コードがマスタに存在しません';
                        Log::info($result);
                        return $result;
                    }
                    $mtStockKeepingUnit = MtStockKeepingUnit::where('jan_cd', $rec['JANコード'])->first();
                    if (empty($mtWarehouse)) {
                        DB::rollback();
                        $result['status'] = CommonConsts::STATUS_ERROR;
                        $result['error'] = 'JANコードがマスタに存在しません';
                        Log::info($result);
                        return $result;
                    }

                    //ロケーションマスタ
                    $mtLocationExists = MtLocation::where('mt_warehouse_id', $mtWarehouse['id'])->where('mt_stock_keeping_unit_id', $mtStockKeepingUnit['id'])->exists();
                    if ($mtLocationExists) {
                        //更新
                        $mtLocation = MtLocation::where('mt_warehouse_id', $mtWarehouse['id'])->where('mt_stock_keeping_unit_id', $mtStockKeepingUnit['id'])->first();
                    } else {
                        //新規登録
                        $mtLocation = new MtLocation();
                        $mtLocation->mt_warehouse_id = $mtWarehouse['id'];
                        $mtLocation->mt_stock_keeping_unit_id = $mtStockKeepingUnit['id'];
                    }
                    $mtLocation->shelf_number_1 = $rec['棚番1'];
                    $mtLocation->shelf_number_2 = $rec['棚番2'];
                    $mtLocation->mt_user_last_update_id = Auth::user()->id;
                    $mtLocation->save();
                }
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
            Log::info($result);
        }
        return $result;
    }

    /**
     * ロケーション 名称補完(code指定)
     * @param $code, $def_customer_class_thing_id
     * @return Object
     */
    public function getByCode($code)
    {
        $result = MtLocation::where('location_cd', $code)->first();
        return $result;
    }
}
