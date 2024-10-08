<?php

namespace App\Repositories\MtStockKeepingUnit;

use App\Models\MtStockKeepingUnit;
use App\Models\MtColor;
use App\Models\MtSize;
use App\Models\MtItem;
use App\Consts\CommonConsts;
use App\Models\MtLocation;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtStockKeepingUnitRepository implements MtStockKeepingUnitRepositoryInterface
{

    /**
     * SKUマスタ 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtStockKeepingUnit::get();
        return $result;
    }

    /**
     * SKUマスタ 商品IDによる取得
     * @param $mtItemId
     * @return Object
     */
    public function getById($mtItemId)
    {
        $mtStockKeepingUnit =
            MtStockKeepingUnit::leftJoin('mt_items', 'mt_stock_keeping_units.mt_item_id', 'mt_items.id')
            ->select(['mt_stock_keeping_units.*', 'mt_items.item_cd', 'mt_items.item_name'])
            ->where('mt_item_id', $mtItemId)
            ->get();

        $itemColors = $mtStockKeepingUnit->where('hidden_flg', 0)->pluck('mt_color_id')->unique();
        $itemSizes = $mtStockKeepingUnit->where('hidden_flg', 0)->pluck('mt_size_id')->unique();
        $result['mtColor'] = MtColor::whereIn('id', $itemColors)->orderBy('color_cd')->get();
        $result['mtSize'] = MtSize::whereIn('id', $itemSizes)->orderBy('size_cd')->get();

        $result['mtStockKeepingUnit'] = $mtStockKeepingUnit->whereIn('color_id', $itemColors)->whereIn('size_id', $itemSizes);

        $result['mtStockKeepingUnit'] =
            MtStockKeepingUnit::leftJoin('mt_items', 'mt_stock_keeping_units.mt_item_id', 'mt_items.id')
            ->select(['mt_stock_keeping_units.*', 'mt_items.item_cd', 'mt_items.item_name'])
            ->where('mt_item_id', $mtItemId)
            ->whereIn('mt_color_id', $itemColors)
            ->whereIn('mt_size_id', $itemSizes)
            ->orderBy('mt_color_id')
            ->orderBy('mt_size_id')
            ->get();

        return $result;
    }

    /**
     * SKUマスタ 更新（JANコード登録マスタから）
     * @param $params
     * @return Object
     */
    public function update($params)
    {
        $result = array();
        try {
            DB::beginTransaction();
            // 更新
            $j = 0;
            foreach ($params['hidden_item_id'] as $param) {
                if (!empty($param)) {
                    $mtStockKeepingUnit = MtStockKeepingUnit::where('id', $param)->first();
                    //変更の有無を確認
                    if (
                        isset($mtStockKeepingUnit) &&
                        $mtStockKeepingUnit['jan_cd'] === $params['jan_code'][$j]
                    ) {
                        $j++;
                        continue; //変更がない場合、更新を行わない
                    }
                    $mtStockKeepingUnit->jan_cd = $params['jan_code'][$j];
                    $mtStockKeepingUnit->mt_user_last_update_id = Auth::user()->id;
                    $mtStockKeepingUnit->save();
                }
                $j++;
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
            $result['item_id'] = $mtStockKeepingUnit->mt_item_id;
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * SKUリスト(一覧) 出力情報取得
     * @param $params
     * @return Object
     */
    public function export($params)
    {
        $startCode = '';
        $endCode = 'ZZZZZZ';
        if ($params['item_class'] === '1') {
            $startCode = (isset($params['code1_start'])) ? $params['code1_start'] : '';
            $endCode = (isset($params['code1_end'])) ? $params['code1_end'] : 'ZZZZZZ';
        } else if ($params['item_class'] === '2') {
            $startCode = (isset($params['code2_start'])) ? $params['code2_start'] : '';
            $endCode = (isset($params['code2_end'])) ? $params['code2_end'] : 'ZZZZZZ';
        } else if ($params['item_class'] === '3') {
            $startCode = (isset($params['code3_start'])) ? $params['code3_start'] : '';
            $endCode = (isset($params['code3_end'])) ? $params['code3_end'] : 'ZZZZZZ';
        } else if ($params['item_class'] === '4') {
            $startCode = (isset($params['code4_start'])) ? $params['code4_start'] : '';
            $endCode = (isset($params['code4_end'])) ? $params['code4_end'] : 'ZZZZZZ';
        } else if ($params['item_class'] === '5') {
            $startCode = (isset($params['code5_start'])) ? $params['code5_start'] : '';
            $endCode = (isset($params['code5_end'])) ? $params['code5_end'] : 'ZZZZZZ';
        } else if ($params['item_class'] === '6') {
            $startCode = (isset($params['code6_start'])) ? $params['code6_start'] : '';
            $endCode = (isset($params['code6_end'])) ? $params['code6_end'] : 'ZZZZZZ';
        } else if ($params['item_class'] === '7') {
            $startCode = (isset($params['code7_start'])) ? $params['code7_start'] : '';
            $endCode = (isset($params['code7_end'])) ? $params['code7_end'] : 'ZZZZZZ';
        }
        $itemCdStart = (isset($params['item_cd_start'])) ? $params['item_cd_start'] : '';
        $itemCdEnd = (isset($params['item_cd_end'])) ? $params['item_cd_end'] : 'ZZZZZZZZZ';
        $colorCdStart = (isset($params['color_code_start'])) ? $params['color_code_start'] : '';
        $colorCdEnd = (isset($params['color_code_end'])) ? $params['color_code_end'] : 'ZZZZZ';
        $sizeCdStart = (isset($params['size_code_start'])) ? $params['size_code_start'] : '';
        $sizeCdEnd = (isset($params['size_code_end'])) ? $params['size_code_end'] : 'ZZZZZ';
        $janCdStart = (isset($params['jan_code_start'])) ? $params['jan_code_start'] : '';
        $janCdEnd = (isset($params['jan_code_end'])) ? $params['jan_code_end'] : 'ZZZZZZZZZZZZZ';

        $query = MtStockKeepingUnit::query();
        $query->select($this->selectExport());
        $query->leftJoin('mt_items', 'mt_stock_keeping_units.mt_item_id', 'mt_items.id');
        $query->leftJoin('mt_colors', 'mt_stock_keeping_units.mt_color_id', 'mt_colors.id');
        $query->leftJoin('mt_sizes', 'mt_stock_keeping_units.mt_size_id', 'mt_sizes.id');
        $query->leftJoin('mt_member_site_items', 'mt_items.mt_member_site_item_id', 'mt_member_site_items.id');
        $query->leftJoin('mt_item_classes as mic1', 'mt_items.mt_item_class1_id', 'mic1.id');
        $query->leftJoin('mt_item_classes as mic2', 'mt_items.mt_item_class2_id', 'mic2.id');
        $query->leftJoin('mt_item_classes as mic3', 'mt_items.mt_item_class3_id', 'mic3.id');
        $query->leftJoin('mt_item_classes as mic4', 'mt_items.mt_item_class4_id', 'mic4.id');
        $query->leftJoin('mt_item_classes as mic5', 'mt_items.mt_item_class5_id', 'mic5.id');
        $query->leftJoin('mt_item_classes as mic6', 'mt_items.mt_item_class6_id', 'mic6.id');
        $query->leftJoin('mt_item_classes as mic7', 'mt_items.mt_item_class7_id', 'mic7.id');
        $query->whereBetween('mt_colors.color_cd', [$colorCdStart, $colorCdEnd]);
        $query->whereBetween('mt_sizes.size_cd', [$sizeCdStart, $sizeCdEnd]);
        $query->whereBetween('mt_items.item_cd', [$itemCdStart, $itemCdEnd]);
        $query->where('mt_stock_keeping_units.hidden_flg', 0);
        $query->when($params['output_kbn'] === '0', fn($query) => $query->whereBetween('mt_stock_keeping_units.jan_cd', [$janCdStart, $janCdEnd]));
        $query->when($params['output_kbn'] === '1', fn($query) => $query->whereNull('mt_stock_keeping_units.jan_cd')->orWhere('mt_stock_keeping_units.jan_cd', ''));
        $query->when($params['item_class'] === '1', fn($query) => $query->whereBetween('mic1.item_class_cd', [$startCode, $endCode]));
        $query->when($params['item_class'] === '2', fn($query) => $query->whereBetween('mic2.item_class_cd', [$startCode, $endCode]));
        $query->when($params['item_class'] === '3', fn($query) => $query->whereBetween('mic3.item_class_cd', [$startCode, $endCode]));
        $query->when($params['item_class'] === '4', fn($query) => $query->whereBetween('mic4.item_class_cd', [$startCode, $endCode]));
        $query->when($params['item_class'] === '5', fn($query) => $query->whereBetween('mic5.item_class_cd', [$startCode, $endCode]));
        $query->when($params['item_class'] === '6', fn($query) => $query->whereBetween('mic6.item_class_cd', [$startCode, $endCode]));
        $query->when($params['item_class'] === '7', fn($query) => $query->whereBetween('mic7.item_class_cd', [$startCode, $endCode]));
        $query->when($params['item_class'] === '1', fn($query) => $query->orderBy('mic1.item_class_cd'));
        $query->when($params['item_class'] === '2', fn($query) => $query->orderBy('mic2.item_class_cd'));
        $query->when($params['item_class'] === '3', fn($query) => $query->orderBy('mic3.item_class_cd'));
        $query->when($params['item_class'] === '4', fn($query) => $query->orderBy('mic4.item_class_cd'));
        $query->when($params['item_class'] === '5', fn($query) => $query->orderBy('mic5.item_class_cd'));
        $query->when($params['item_class'] === '6', fn($query) => $query->orderBy('mic6.item_class_cd'));
        $query->when($params['item_class'] === '7', fn($query) => $query->orderBy('mic7.item_class_cd'));
        $query->orderBy('mt_items.item_cd');
        $query->orderBy('mt_colors.color_cd');
        $query->orderBy('mt_sizes.size_cd');

        return $query->get();
    }

    private function selectExport()
    {
        return [
            'mic1.item_class_cd as item_class1_cd',
            'mic1.item_class_name as item_class1_name',
            'mic2.item_class_cd as item_class2_cd',
            'mic2.item_class_name as item_class2_name',
            'mic3.item_class_cd as item_class3_cd',
            'mic3.item_class_name as item_class3_name',
            'mic4.item_class_cd as item_class4_cd',
            'mic4.item_class_name as item_class4_name',
            'mic5.item_class_cd as item_class5_cd',
            'mic5.item_class_name as item_class5_name',
            'mic6.item_class_cd as item_class6_cd',
            'mic6.item_class_name as item_class6_name',
            'mic7.item_class_cd as item_class7_cd',
            'mic7.item_class_name as item_class7_name',
            'item_cd',
            'item_name',
            'color_cd',
            'color_name',
            'size_cd',
            'size_name',
            'jan_cd',
            'retail_price_tax_out',
            'retail_price_tax_in',
            'hidden_flg',
        ];
    }

    /**
     * 名称補完(code指定)
     * @param $code
     * @return Object
     */
    public function getByCode($code)
    {
        $mtItemId = MtItem::where('item_cd', $code)->first();
        if (!$mtItemId) {
            return $mtItemId;
        }
        $result = MtStockKeepingUnit::where('mt_item_id', $mtItemId['id'])->first();
        return $result;
    }

    /**異なる商品コードに重複するjanコードが含まれるかチェック
     * @param $jan_code
     * @return Object
     */
    public function getByJanCode($item_cd, $jan_cd)
    {
        $mtItem = MtItem::where('item_cd', $item_cd)->first();
        $result = MtStockKeepingUnit::where('jan_cd', $jan_cd)->whereNot('mt_item_id', $mtItem['id'])->first();
        return $result;
    }
    /**
     * 商品のロケーション情報
     *
     * 商品のSKU一覧を取得する
     * ロケーションが設定されている場合はその情報も併せて取得する
     * ロケーションが設定されていない場合はロケーション情報なしとして扱う
     * @param string | int $warehouseId
     * @param string | int $itemId
     * @return Collection
     */
    public function loadByWarehouseAndItem($warehouseId, $itemId)
    {
        // SKU検索（MtLocations検索用にまず商品が持つSKUID一覧取得用クエリを一旦用意）
        $query = MtStockKeepingUnit::query();
        $query->where('mt_item_id', $itemId);

        // MtLocationsを倉庫とSKUで絞込み
        $subQuery = MtLocation::query();
        $subQuery->where('mt_warehouse_id', $warehouseId);
        $subQuery->whereIn('mt_stock_keeping_unit_id', $query->get()->pluck('id'));

        // SKU検索の続き
        $query->joinColorAndSize();
        $query->leftJoinSub($subQuery, 'locations', function ($join) {
            $join->on('locations.mt_stock_keeping_unit_id', 'mt_stock_keeping_units.id');
        }); // 倉庫とSKUで絞ったMtLocationsを LEFT JOIN
        $query->select($this->selectWarehouseAndItem());
        $query->orderBy('color_cd');
        $query->orderBy('size_cd');
        return $query->get();
    }

    private function selectWarehouseAndItem()
    {
        return [
            'mt_stock_keeping_units.id',
            'mt_colors.color_cd',
            'mt_colors.color_name',
            'mt_sizes.size_cd',
            'mt_sizes.size_name',
            'locations.id as location_id',
            'locations.shelf_number_1',
            'locations.shelf_number_2',
            'locations.rank',
        ];
    }

    public function getDataByItemId($item_id)
    {
        return MtStockKeepingUnit::where('mt_item_id', $item_id)->get();
    }

    public function getDataByItemColorSize($item_id, $color_id, $size_id)
    {
            return MtStockKeepingUnit::where('mt_item_id', $item_id)
            ->where('mt_color_id', $color_id)
            ->where('mt_size_id', $size_id)
            ->first();
    }
}
