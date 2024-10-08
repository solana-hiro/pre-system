<?php

namespace App\Repositories\MtItem;

use App\Models\MtItem;
use App\Models\MtItemClass;
use App\Models\MtItemChangeHistory;
use App\Models\MtMemberSiteItem;
use App\Models\DefTaxRateKbn;
use App\Models\DefItemClassThing;
use App\Models\MtTaxRateSetting;
use App\Models\MtSupplier;
use App\Models\MtStockKeepingUnit;
use App\Models\MtColor;
use App\Models\MtSize;
use App\Models\MtSystem;
use App\Models\MtMemberSiteItemRecommendationManagement;
use App\Models\DefItemChangeHistoryThing;
use App\Consts\CommonConsts;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtItemRepository implements MtItemRepositoryInterface
{

    /**
     * 商品データの全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtItem::leftJoin('mt_member_site_items', 'mt_items.mt_member_site_item_id', 'mt_member_site_items.id')->paginate(CommonConsts::PAGINATION);
        // ->leftJoin('mt_stock_keeping_units', 'mt_items.id', 'mt_stock_keeping_units.mt_item_id')->paginate(CommonConsts::PAGINATION);
        $i = 0;
        foreach ($result as $re) {
            $result[$i]['mt_item_class1_cd'] = isset($re['mt_item_class1_id']) ? MtItemClass::getCodeById($re['mt_item_class1_id'])['item_class_cd'] : "";
            $result[$i]['mt_item_class2_cd'] = isset($re['mt_item_class2_id']) ? MtItemClass::getCodeById($re['mt_item_class2_id'])['item_class_cd'] : "";
            $result[$i]['mt_item_class3_cd'] = isset($re['mt_item_class3_id']) ? MtItemClass::getCodeById($re['mt_item_class3_id'])['item_class_cd'] : "";
            $result[$i]['mt_item_class4_cd'] = isset($re['mt_item_class4_id']) ? MtItemClass::getCodeById($re['mt_item_class4_id'])['item_class_cd'] : "";
            $result[$i]['mt_item_class5_cd'] = isset($re['mt_item_class5_id']) ? MtItemClass::getCodeById($re['mt_item_class5_id'])['item_class_cd'] : "";
            $result[$i]['mt_item_class6_cd'] = isset($re['mt_item_class6_id']) ? MtItemClass::getCodeById($re['mt_item_class6_id'])['item_class_cd'] : "";
            $result[$i]['mt_item_class7_cd'] = isset($re['mt_item_class7_id']) ? MtItemClass::getCodeById($re['mt_item_class7_id'])['item_class_cd'] : "";
            $i++;
        }
        return $result;
    }

    /**
     * 商品データの詳細取得
     * @param $id
     * @return Object
     */
    public function getDetailById($id)
    {
        $itemData = MtItem::select(
            'mt_items.id as id',
            'mt_items.item_cd as item_cd',
            'mt_items.other_part_number as other_part_number',
            'mt_items.item_name as item_name',
            'mt_items.item_name_kana as item_name_kana',
            'mt_items.unit as unit',
            'mt_items.mt_item_class5_id as mt_item_class5_id',
            'mt_items.mt_member_site_item_id as mt_member_site_item_id',
            'mt_items.mt_item_class1_id as mt_item_class1_id',
            'mic1.item_class_cd as item_class1_cd',
            'mic1.item_class_name as item_class1_name',
            'mt_items.mt_item_class2_id as mt_item_class2_id',
            'mic2.item_class_cd as item_class2_cd',
            'mic2.item_class_name as item_class2_name',
            'mt_items.mt_item_class3_id as mt_item_class3_id',
            'mic3.item_class_cd as item_class3_cd',
            'mic3.item_class_name as item_class3_name',
            'mt_items.mt_item_class4_id as mt_item_class4_id',
            'mic4.item_class_cd as item_class4_cd',
            'mic4.item_class_name as item_class4_name',
            'mt_items.mt_item_class5_id as mt_item_class5_id',
            'mic5.item_class_cd as item_class5_cd',
            'mic5.item_class_name as item_class5_name',
            'mt_items.mt_item_class6_id as mt_item_class6_id',
            'mic6.item_class_cd as item_class6_cd',
            'mic6.item_class_name as item_class6_name',
            'mt_items.mt_item_class7_id as mt_item_class7_id',
            'mic7.item_class_cd as item_class7_cd',
            'mic7.item_class_name as item_class7_name',
            'mt_items.mt_supplier_id as mt_supplier_id',
            'ms.supplier_cd as supplier_cd',
            'ms.supplier_name as supplier_name',
            'mt_items.item_kbn as item_kbn',
            'mt_items.stock_management_kbn as stock_management_kbn',
            'mt_items.non_tax_kbn as non_tax_kbn',
            'mt_items.def_tax_rate_kbns_id as def_tax_rate_kbns_id',
            'dtrk.tax_rate_kbn_cd as tax_rate_kbn_cd',
            'dtrk.tax_rate_kbn_name as tax_rate_kbn_name',
            'mt_items.retail_price_tax_out as retail_price_tax_out',
            'mt_items.retail_price_tax_in as retail_price_tax_in',
            'mt_items.reference_retail_tax_out as reference_retail_tax_out',
            'mt_items.reference_retail_tax_in as reference_retail_tax_in',
            'mt_items.purchase_price_tax_out as purchase_price_tax_out',
            'mt_items.purchase_price_tax_in as purchase_price_tax_in',
            'mt_items.cost_price as cost_price',
            'mt_items.profit_calculation_cost_price as profit_calculation_cost_price',
            'mt_items.name_input_kbn as name_input_kbn',
            'mt_items.del_kbn as del_kbn',
            'mt_items.ec_alignment_kbn as ec_alignment_kbn',
            'mt_items.japan_post_office as japan_post_office',
            'mmsi.id as ec_item_id',
            'mmsi.ec_item_cd as ec_item_cd',
            'mmsi.ec_item_name as ec_item_name',
            'mmsi.ranking as ranking',
            'mmsi.printed_products_flg as printed_products_flg',
        )
            ->leftJoin('mt_item_classes as mic1', 'mt_items.mt_item_class1_id', 'mic1.id')
            ->leftJoin('mt_item_classes as mic2', 'mt_items.mt_item_class2_id', 'mic2.id')
            ->leftJoin('mt_item_classes as mic3', 'mt_items.mt_item_class3_id', 'mic3.id')
            ->leftJoin('mt_item_classes as mic4', 'mt_items.mt_item_class4_id', 'mic4.id')
            ->leftJoin('mt_item_classes as mic5', 'mt_items.mt_item_class5_id', 'mic5.id')
            ->leftJoin('mt_item_classes as mic6', 'mt_items.mt_item_class6_id', 'mic6.id')
            ->leftJoin('mt_item_classes as mic7', 'mt_items.mt_item_class7_id', 'mic7.id')
            ->leftJoin('mt_suppliers as ms', 'mt_items.mt_supplier_id', 'ms.id')
            ->leftJoin('def_tax_rate_kbns as dtrk', 'mt_items.def_tax_rate_kbns_id', 'dtrk.id')
            ->leftJoin('mt_member_site_items as mmsi', 'mt_items.mt_member_site_item_id', 'mmsi.id')
            ->leftJoin('mt_stock_keeping_units as msku1', 'mt_items.id', 'msku1.mt_item_id')
            ->where('mt_items.id', $id)->first();

        $memberSiteItemData = MtMemberSiteItem::select(
            'mt_member_site_items.ec_item_cd as ec_item_cd',
            'mt_member_site_items.ec_item_name as ec_item_name',
            'mt_member_site_items.ranking as ranking',
            'mt_member_site_items.printed_products_flg as printed_products_flg',
            'mt_member_site_items.item_image_file_1 as item_image_file_1',
            'mt_member_site_items.item_image_file_2 as item_image_file_2',
            'mt_member_site_items.item_image_file_3 as item_image_file_3',
            'mt_member_site_items.item_image_file_4 as item_image_file_4',
            'mt_member_site_items.pdf_file_1 as pdf_file_1',
            'mt_member_site_items.pdf_file_2 as pdf_file_2',
            'mt_member_site_items.pdf_file_3 as pdf_file_3',
            'mt_member_site_items.pdf_file_4 as pdf_file_4',
            'mt_member_site_items.pdf_file_5 as pdf_file_5',
            'mt_member_site_items.item_banner_image_file_1 as item_banner_image_file_1',
            'mt_member_site_items.item_banner_image_file_2 as item_banner_image_file_2',
            'mt_member_site_items.item_banner_url_1 as item_banner_url_1',
            'mt_member_site_items.item_banner_url_2 as item_banner_url_2',
            'mt_member_site_items.item_memo_1 as item_memo_1',
            'mt_member_site_items.item_memo_2 as item_memo_2',
            'mt_member_site_items.item_memo_3 as item_memo_3',
            'mt_member_site_items.item_memo_4 as item_memo_4',
            'mt_member_site_items.item_memo_5 as item_memo_5',
        )
            ->where('mt_member_site_items.id', $itemData['mt_member_site_item_id'])->first();

        $recommendData = MtMemberSiteItemRecommendationManagement::select(
            'mt_member_site_item_recommendation_managements.id as id',
            'mmsi.id as ec_item_id',
            'mmsi.ec_item_cd as ec_item_cd',
            'mmsi.ec_item_name as ec_item_name',
            'mt_member_site_item_recommendation_managements.display_order as display_order',
        )
            ->leftJoin('mt_member_site_items as mmsi', 'mt_member_site_item_recommendation_managements.mt_member_site_item_id_recommendation', 'mmsi.id')
            ->where('mt_member_site_item_recommendation_managements.mt_member_site_item_id_base', $itemData['mt_member_site_item_id'])
            ->get();

        $colorSizeData = MtStockKeepingUnit::select(
            'mt_stock_keeping_units.mt_color_id as mt_color_id',
            'mt_colors.color_cd as color_cd',
            'mt_colors.color_name as color_name',
            'mt_stock_keeping_units.mt_size_id as mt_size_id',
            'mt_sizes.size_cd as size_cd',
            'mt_sizes.size_name as size_name',
            'mt_stock_keeping_units.jan_cd as jan_cd',
            'mt_stock_keeping_units.hidden_flg as hidden_flg'
        )
            ->leftJoin('mt_colors', 'mt_stock_keeping_units.mt_color_id', 'mt_colors.id')
            ->leftJoin('mt_sizes', 'mt_stock_keeping_units.mt_size_id', 'mt_sizes.id')
            ->where('mt_stock_keeping_units.mt_item_id', $itemData['id'])
            ->orderBy('mt_colors.color_cd')
            ->orderBy('mt_sizes.size_cd')
            ->get();

        $sizeList = [];
        $colorList = [];
        $hiddenFlagList = [];
        foreach ($colorSizeData as $key => $val) {
            if (!in_array($val["mt_size_id"], array_column($sizeList, 'size_id'))) {
                $newSize = [
                    "size_id" => $val["mt_size_id"],
                    "size_cd" => $val["size_cd"],
                    "size_name" => $val["size_name"],
                ];
                array_push($sizeList, $newSize);
            }

            if (!in_array($val["mt_color_id"], array_column($colorList, 'color_id'))) {
                $newColor = [
                    "color_id" => $val["mt_color_id"],
                    "color_cd" => $val["color_cd"],
                    "color_name" => $val["color_name"],
                ];
                array_push($colorList, $newColor);
            }

            $newHiddenFlag = [
                "color_id" => $val["mt_color_id"],
                "size_id" => $val["mt_size_id"],
                "hidden_flg" => $val["hidden_flg"],
            ];
            array_push($hiddenFlagList, $newHiddenFlag);
        }

        $currentDateTime = date('Y-m-d');
        if (isset($itemData['def_tax_rate_kbns_id'])) {
            $result['taxRate'] = MtTaxRateSetting::where('def_tax_rate_kbn_id', $itemData['def_tax_rate_kbns_id'])
                ->whereDate('application_start_date', '<=', $currentDateTime)
                ->orderBy('application_start_date', 'DESC')->first()->tax_rate;
        }
        $result['itemData'] = $itemData;
        $result['memberSiteItemData'] = $memberSiteItemData;
        $result['recommendData'] = $recommendData;
        $result['sizeData'] = $sizeList;
        $result['colorData'] = $colorList;
        $result['hiddenFlagData'] = $hiddenFlagList;
        return $result;
    }

    /**
     * 商品データの最小ID取得
     * @return Object
     */
    public function getMinCode()
    {
        $result = MtItem::min('item_cd');
        return $result;
    }

    /**
     * 商品データの最大ID取得
     * @return Object
     */
    public function getMaxCode()
    {
        $result = MtItem::max('item_cd');
        return $result;
    }

    /**
     * 商品データ　前頁
     * @param $id
     * @return Object
     */
    public function getPrevByCode($code)
    {
        if (isset($code)) {
            $result = MtItem::where('item_cd', '<', $code)->orderByDesc('item_cd')->first();
        } else {
            $result = MtItem::orderBy('item_cd')->first();
        }
        return $result;
    }

    /**
     * 商品データ　次頁
     * @param $id
     * @return Object
     */
    public function getNextByCode($code)
    {
        if (isset($code)) {
            $result = MtItem::where('item_cd', '>', $code)->orderBy('item_cd')->first();
        } else {
            $result = MtItem::orderBy('item_cd')->first();
        }
        return $result;
    }

    /**
     * 商品データのIDによる削除
     * @param $id
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $targetItem = MtItem::where('id', $id)->first();
            $item_id = $targetItem->id;
            $mt_member_site_item_id = $targetItem->mt_member_site_item_id;
            MtStockKeepingUnit::where('mt_item_id', $targetItem->id)->delete();
            mtItemChangeHistory::where('mt_item_id', $targetItem->id)->delete();
            $targetItem->delete();
            // メンバーサイト商品マスタの削除処理
            $membeSiteItemExists = mtMemberSiteItem::where('id', $mt_member_site_item_id)->exists();
            if ($membeSiteItemExists) {
                $membeSiteItem = mtMemberSiteItem::where('id', $mt_member_site_item_id)->first();
                $itemCheck =  MtItem::where('mt_member_site_item_id', $membeSiteItem->id)->where('id', '!=', $item_id)->exists();
                if (!$itemCheck) {
                    mtMemberSiteItemRecommendationManagement::where('mt_member_site_item_id_base', $membeSiteItem->id)->delete();
                    $membeSiteItem->delete();
                }
            }

            DB::commit();

            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            Log::info($e->getMessage());
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * EC商品データ関連の削除
     * @param $id
     * @return Object
     */
    public function deleteEc($id)
    {
        $result = MtMemberSiteItemRecommendationManagement::where('id', $id)->delete();
        return $result;
    }

    /**
     * 商品データの更新
     * @param $param
     * @param $fileParam
     * @return Object
     */
    public function update($param, $fileParam)
    {
        // 登録・更新: 商品マスタ, メンバーサイト商品マスタ, SKUマスタ, 商品変更履歴マスタ, メンバーサイト商品おすすめ管理マスタ
        // 削除: 商品マスタ, メンバーサイト商品マスタ, SKUマスタ, 商品変更履歴マスタ, メンバーサイト商品おすすめ管理マスタ
        //TODO: Requestクラスで制御
        $def_item_change_history_things = DefItemChangeHistoryThing::all();
        $result = array();
        try {
            DB::beginTransaction();

            $itemClassCd1 = MtItemClass::where('def_item_class_thing_id', '1')->where('item_class_cd', $param['item_class_cd_1'])->first();
            $itemClassCd2 = MtItemClass::where('def_item_class_thing_id', '2')->where('item_class_cd', $param['item_class_cd_2'])->first();
            $itemClassCd3 = MtItemClass::where('def_item_class_thing_id', '3')->where('item_class_cd', $param['item_class_cd_3'])->first();
            $itemClassCd4 = MtItemClass::where('def_item_class_thing_id', '4')->where('item_class_cd', $param['item_class_cd_4'])->first();
            $itemClassCd5 = MtItemClass::where('def_item_class_thing_id', '5')->where('item_class_cd', $param['item_class_cd_5'])->first();
            $itemClassCd6 = MtItemClass::where('def_item_class_thing_id', '6')->where('item_class_cd', $param['item_class_cd_6'])->first();
            $itemClassCd7 = MtItemClass::where('def_item_class_thing_id', '7')->where('item_class_cd', $param['item_class_cd_7'])->first();
            $supplierCd = MtSupplier::where('supplier_cd', $param['mt_supplier_cd'])->first();
            $taxRateCd = DefTaxRateKbn::where('tax_rate_kbn_cd', $param['def_tax_rate_kbns_cd'])->first();
            $isMtItem = MtItem::where('item_cd', $param['item_cd'])->exists();
            if ($isMtItem) {
                //更新
                $mtItem = MtItem::where('id', $param['hidden_detail_id'])->first();
                $mtItem->item_cd = $param['item_cd'];
                $mtItem->other_part_number = $param['other_part_number'];
                $mtItem->mt_item_class1_id = isset($itemClassCd1['id']) ? $itemClassCd1['id'] : null;
                $mtItem->mt_item_class2_id = isset($itemClassCd2['id']) ? $itemClassCd2['id'] : null;
                $mtItem->mt_item_class3_id = isset($itemClassCd3['id']) ? $itemClassCd3['id'] : null;
                $mtItem->mt_item_class4_id = isset($itemClassCd4['id']) ? $itemClassCd4['id'] : null;
                $mtItem->mt_item_class5_id = isset($itemClassCd5['id']) ? $itemClassCd5['id'] : null;
                $mtItem->mt_item_class6_id = isset($itemClassCd6['id']) ? $itemClassCd6['id'] : null;
                $mtItem->mt_item_class7_id = isset($itemClassCd7['id']) ? $itemClassCd7['id'] : null;
                $mtItem->mt_supplier_id = isset($supplierCd['id']) ? $supplierCd['id'] : '';
                $mtItem->item_name = $param['item_name'];
                $mtItem->other_part_number = $param['other_part_number'];
                $mtItem->item_name_kana = $param['item_name_kana'];
                $mtItem->unit = $param['unit'];
                $mtItem->item_kbn = $param['item_kbn'];
                $mtItem->non_tax_kbn = $param['non_tax_kbn'];
                $mtItem->def_tax_rate_kbns_id = $taxRateCd['id'];
                if (isset($param['retail_price_tax_out']) && '' != $param['retail_price_tax_out']) {
                    $mtItem->retail_price_tax_out = str_replace(',', '', $param['retail_price_tax_out']);
                } else {
                    $mtItem->retail_price_tax_out = null;
                }
                if (isset($param['retail_price_tax_in']) && '' != $param['retail_price_tax_in']) {
                    $mtItem->retail_price_tax_in = str_replace(',', '', $param['retail_price_tax_in']);
                } else {
                    $mtItem->retail_price_tax_in = null;
                }
                if (isset($param['reference_retail_tax_out']) && '' != $param['reference_retail_tax_out']) {
                    $mtItem->reference_retail_tax_out = str_replace(',', '', $param['reference_retail_tax_out']);
                } else {
                    $mtItem->reference_retail_tax_out = null;
                }
                if (isset($param['reference_retail_tax_in']) && '' != $param['reference_retail_tax_in']) {
                    $mtItem->reference_retail_tax_in = str_replace(',', '', $param['reference_retail_tax_in']);
                } else {
                    $mtItem->reference_retail_tax_in = null;
                }
                if (isset($param['purchase_price_tax_out']) && '' != $param['purchase_price_tax_out']) {
                    $mtItem->purchase_price_tax_out = str_replace(',', '', $param['purchase_price_tax_out']);
                } else {
                    $mtItem->purchase_price_tax_out = null;
                }
                if (isset($param['purchase_price_tax_in']) && '' != $param['purchase_price_tax_in']) {
                    $mtItem->purchase_price_tax_in = str_replace(',', '', $param['purchase_price_tax_in']);
                } else {
                    $mtItem->purchase_price_tax_in = null;
                }
                if (isset($param['cost_price']) && '' != $param['cost_price']) {
                    $mtItem->cost_price = str_replace(',', '', $param['cost_price']);
                } else {
                    $mtItem->cost_price = null;
                }
                if (isset($param['profit_calculation_cost_price']) && '' != $param['profit_calculation_cost_price']) {
                    $mtItem->profit_calculation_cost_price = str_replace(',', '', $param['profit_calculation_cost_price']);
                } else {
                    $mtItem->profit_calculation_cost_price = null;
                }
                $mtItem->name_input_kbn = $param['name_input_kbn'];
                $mtItem->del_kbn = $param['del_kbn'];
                $mtItem->ec_alignment_kbn = $param['ec_alignment_kbn'];
                $mtItem->japan_post_office = $param['japan_post_office'];
                $mtItem->mt_user_last_update_id = Auth::user()->id;

                // SKU
                $updateIds = [];
                $newColorCode = [];
                $newSiseCode = [];
                foreach ($param['input_color_code'] as $i => $color) {
                    if (!empty($color)) {
                        $mtColor = MtColor::where('color_cd', $color)->first();
                        if (empty($mtColor)) {
                            continue;
                        }
                        // 変更履歴用に新しいカラーコードの追加有無チェック
                        $mtStockKeepingUnitColorExists = MtStockKeepingUnit::where('mt_item_id', $mtItem['id'])->where('mt_color_id', $mtColor['id'])->exists();
                        if (!$mtStockKeepingUnitColorExists && !in_array($color, $newColorCode)) {
                            array_push($newColorCode, $color);
                        }

                        foreach ($param['input_size_code'] as $j => $size) {
                            if (!empty($size)) {
                                $mtSize = MtSize::where('size_cd', $size)->first();
                                if (empty($mtSize)) {
                                    continue;
                                }
                                // 変更履歴用に新しいサイズコードの追加有無チェック
                                $mtStockKeepingUnitSizeExists = MtStockKeepingUnit::where('mt_item_id', $mtItem['id'])->where('mt_size_id', $mtSize['id'])->exists();
                                if (!$mtStockKeepingUnitSizeExists && !in_array($size, $newSiseCode)) {
                                    array_push($newSiseCode, $size);
                                }
                                $mtStockKeepingUnitExists = MtStockKeepingUnit::where('mt_item_id', $mtItem['id'])->where('mt_color_id', $mtColor['id'])->where('mt_size_id', $mtSize['id'])->exists();
                                if ($mtStockKeepingUnitExists) {
                                    $mtStockKeepingUnit = MtStockKeepingUnit::where('mt_item_id', $mtItem['id'])->where('mt_color_id', $mtColor['id'])->where('mt_size_id', $mtSize['id'])->first();
                                } else {
                                    $mtStockKeepingUnit = new MtStockKeepingUnit();
                                    $mtStockKeepingUnit->mt_item_id = $mtItem['id'];
                                    $mtStockKeepingUnit->mt_color_id = $mtColor['id'];
                                    $mtStockKeepingUnit->mt_size_id = $mtSize['id'];
                                }

                                $mtStockKeepingUnit->hidden_flg = isset($param['hidden_flg'][$i . $j]) ? 1 : 0;
                                $mtStockKeepingUnit->mt_user_last_update_id = Auth::user()->id;
                                if (isset($param['register_jan_code']) && 1 == $param['register_jan_code'] && !$mtStockKeepingUnit->jan_cd && !$mtStockKeepingUnit->hidden_flg) {
                                    $nextJanCode = $this->getNextJanCode();
                                    $mtSystem = MtSystem::first();

                                    if ($nextJanCode > $mtSystem->end_jan_code) {
                                        $result['customMSG'] = "終了JANコードに到達しました。JANコードを追加してください。";
                                    } else {
                                        $digit = $this->calcJanCodeDigit($nextJanCode);
                                        $mtStockKeepingUnit->jan_cd = strval($nextJanCode) . strval($digit);
                                        $mtSystem->now_jan_code = $nextJanCode;
                                        $mtSystem->save();
                                    }
                                    if ($nextJanCode == $mtSystem->end_jan_code) {
                                        $result['customMSG'] = "終了JANコードに到達しました。JANコードを追加してください。";
                                    }
                                }
                                $originalMtStockKeepingUnits = $mtStockKeepingUnit->getOriginal();
                                $mtStockKeepingUnit->save();
                                $changeMtStockKeepingUnits = $mtStockKeepingUnit->getChanges();
                                // 商品変更履歴マスタ（商品マスタ項目の変更分）
                                $this->updateItemChangeHistory($mtItem['id'], $originalMtStockKeepingUnits, $changeMtStockKeepingUnits, $def_item_change_history_things);
                                array_push($updateIds, $mtStockKeepingUnit->id);
                            }
                        }
                    }
                }
                // input に含まれていないSKUは削除
                try {
                    MtStockKeepingUnit::where('mt_item_id', $mtItem['id'])->whereNotIn('id', $updateIds)->delete();
                } catch (\Exception $e) {
                    // report($e);
                    $result['customMSG'] .= "外部参照されているSKUは削除できません。";
                }
                //商品変更履歴マスタ 新規カラーコード
                foreach ($newColorCode as $colorCd) {
                    $mtItemChangeHistory = new MtItemChangeHistory();
                    $mtItemChangeHistory->mt_item_id = $mtItem['id'];
                    $mtItemChangeHistory->mt_user_id = Auth::user()->id;
                    $mtItemChangeHistory->change_datetime = Carbon::now();
                    $mtItemChangeHistory->def_item_change_history_thing_id = 28;
                    $mtItemChangeHistory->mt_user_last_update_id = Auth::user()->id;
                    $mtItemChangeHistory->change_before = "";
                    $mtItemChangeHistory->change_after = $colorCd;
                    $mtItemChangeHistory->save();
                }

                //商品変更履歴マスタ 新規サイズコード
                foreach ($newSiseCode as $sizeCd) {
                    $mtItemChangeHistory = new MtItemChangeHistory();
                    $mtItemChangeHistory->mt_item_id = $mtItem['id'];
                    $mtItemChangeHistory->mt_user_id = Auth::user()->id;
                    $mtItemChangeHistory->change_datetime = Carbon::now();
                    $mtItemChangeHistory->def_item_change_history_thing_id = 29;
                    $mtItemChangeHistory->mt_user_last_update_id = Auth::user()->id;
                    $mtItemChangeHistory->change_before = "";
                    $mtItemChangeHistory->change_after = $sizeCd;
                    $mtItemChangeHistory->save();
                }

                $originalMtItems = $mtItem->getOriginal();
                $MemberSiteItemIsNew = 1;
                if (!empty($param['ec_item_cd'])) {
                    $mtMemberSiteItem = MtMemberSiteItem::where('ec_item_cd', $param['ec_item_cd'])->exists();
                    if ($mtMemberSiteItem) {
                        $mtMemberSiteItem = MtMemberSiteItem::where('ec_item_cd', $param['ec_item_cd'])->first();
                        $MemberSiteItemIsNew = 0;
                    } else {
                        $mtMemberSiteItem = new MtMemberSiteItem();
                        $mtMemberSiteItem->ec_item_cd = $param['ec_item_cd'];
                    }

                    $mtMemberSiteItem->ec_item_name = $param['ec_item_name'];
                    $mtMemberSiteItem->ranking = $param['ranking'];
                    $mtMemberSiteItem->printed_products_flg = isset($param['printed_products_flg']) ? 1 : 0;
                    $mtMemberSiteItem->item_banner_url_1 = $param['item_banner_url_1'];
                    $mtMemberSiteItem->item_banner_url_2 = $param['item_banner_url_2'];
                    $mtMemberSiteItem->item_memo_1 = $param['item_memo_1'];
                    $mtMemberSiteItem->item_memo_2 = $param['item_memo_2'];
                    $mtMemberSiteItem->item_memo_3 = $param['item_memo_3'];
                    $mtMemberSiteItem->item_memo_4 = $param['item_memo_4'];
                    $mtMemberSiteItem->item_memo_5 = $param['item_memo_5'];
                    $mtMemberSiteItem->mt_user_last_update_id = Auth::user()->id;


                    //画像関連　更新(パスにIDが必要な為、別で更新する)$tableName . '/' . $keyId . '/' . $key;
                    $commonS3Path = "mt_member_site_items/" . $mtMemberSiteItem['id'] . '/';
                    for ($i = 1; $i < 5; $i++) {
                        $file = "item_image_file_{$i}";
                        $file_src = $file . "_src";
                        $path = $commonS3Path . "{$file}/";
                        if (isset($fileParam[$file])) {
                            $mtMemberSiteItem->$file = $path . $fileParam[$file]->getClientOriginalName();
                        } elseif (is_null($param[$file_src])) {
                            $mtMemberSiteItem->$file = null;
                        }
                    }
                    for ($i = 1; $i < 6; $i++) {
                        $file = "pdf_file_{$i}";
                        $file_src = $file . "_src";
                        $path = $commonS3Path . "{$file}/";
                        if (isset($fileParam[$file])) {
                            $mtMemberSiteItem->$file = $path . $fileParam[$file]->getClientOriginalName();
                        } elseif (is_null($param[$file_src])) {
                            $mtMemberSiteItem->$file = null;
                        }
                    }
                    for ($i = 1; $i < 3; $i++) {
                        $file = "item_banner_image_file_{$i}";
                        $file_src = $file . "_src";
                        $path = $commonS3Path . "{$file}/";
                        if (isset($fileParam[$file])) {
                            $mtMemberSiteItem->$file = $path . $fileParam[$file]->getClientOriginalName();
                        } elseif (is_null($param[$file_src])) {
                            $mtMemberSiteItem->$file = null;
                        }
                    }
                    $originalMtMemberSiteItems = $mtMemberSiteItem->getOriginal();
                    $mtMemberSiteItem->save();

                    $mtItem->mt_member_site_item_id = $mtMemberSiteItem['id'];
                    $mtItem->save();

                    //recommend_ec_item_cd, recommend_display_order
                    // 登録済みのデータを削除
                    MtMemberSiteItemRecommendationManagement::where('mt_member_site_item_id_base', $mtMemberSiteItem['id'])->delete();

                    if (isset($param['recommend_ec_item_cd'])) {
                        $i = 0;
                        foreach ($param['recommend_ec_item_cd'] as $pa) {
                            if (!empty($param['recommend_ec_item_cd'][$i])) {
                                $mtMemberSiteItemRecommendationManagement = MtMemberSiteItemRecommendationManagement::where('mt_member_site_item_id_base', $mtMemberSiteItem['id'])->where('mt_member_site_item_id_recommendation', $param['recommend_ec_item_id'][$i])->first();
                                if (empty($mtMemberSiteItemRecommendationManagement)) {
                                    $mtMemberSiteItemRecommendationManagement = new MtMemberSiteItemRecommendationManagement();
                                    $mtMemberSiteItemRecommendationManagement->mt_member_site_item_id_base = $mtMemberSiteItem['id'];
                                    $mtMemberSiteItemRecommendationManagement->mt_member_site_item_id_recommendation = $param['recommend_ec_item_id'][$i];
                                    $mtMemberSiteItemRecommendationManagement->display_order = $param['recommend_display_order'][$i];
                                    $mtMemberSiteItemRecommendationManagement->mt_user_last_update_id = Auth::user()->id;
                                    $mtMemberSiteItemRecommendationManagement->save();
                                } else {
                                    $mtMemberSiteItemRecommendationManagement->display_order = $param['recommend_display_order'][$i];
                                    $mtMemberSiteItemRecommendationManagement->mt_user_last_update_id = Auth::user()->id;
                                    $mtMemberSiteItemRecommendationManagement->save();
                                }
                                $i++;
                            }
                        }
                    }
                    $changeMtMemberSiteItems = $mtMemberSiteItem->getChanges();
                } else {
                    // // メンバーサイト商品マスタの削除処理
                    // $membeSiteItem = mtMemberSiteItem::where('id', $mtItem->mt_member_site_item_id)->exists();
                    // if ($membeSiteItem) {
                    //     // 他の商品がメンバーサイト商品マスタと紐づいていなければ、紐づけ解除時に削除
                    //     $itemCheck =  MtItem::where('mt_member_site_item_id', $membeSiteItem->id)->where('id', '!=', $targetItem->id)->exists();
                    //     if (!$itemCheck) {
                    //         mtMemberSiteItemRecommendationManagement::where('mt_member_site_item_id_base', $membeSiteItem->id)->delete();
                    //         $membeSiteItem->delete();
                    //     }
                    // }
                    $mtItem->mt_member_site_item_id = null;
                    $mtItem->save();
                }
                //商品変更履歴マスタ 更新時
                $changeMtItems = $mtItem->getChanges();

                // 商品変更履歴マスタ（商品マスタ項目の変更分）
                $this->updateItemChangeHistory($mtItem['id'], $originalMtItems, $changeMtItems, $def_item_change_history_things);
                // 商品変更履歴マスタ（メンバーサイト商品マスタ項目の変更分）
                if ($MemberSiteItemIsNew == 0) {
                    $this->updateItemChangeHistory($mtItem['id'], $originalMtMemberSiteItems, $changeMtMemberSiteItems, $def_item_change_history_things);
                }
            } else {
                //新規登録
                $mtItem = new MtItem();
                $mtItem->item_cd = $param['item_cd'];
                $mtItem->other_part_number = $param['other_part_number'];
                $mtItem->mt_item_class1_id = isset($itemClassCd1['id']) ? $itemClassCd1['id'] : null;
                $mtItem->mt_item_class2_id = isset($itemClassCd2['id']) ? $itemClassCd2['id'] : null;
                $mtItem->mt_item_class3_id = isset($itemClassCd3['id']) ? $itemClassCd3['id'] : null;
                $mtItem->mt_item_class4_id = isset($itemClassCd4['id']) ? $itemClassCd4['id'] : null;
                $mtItem->mt_item_class5_id = isset($itemClassCd5['id']) ? $itemClassCd5['id'] : null;
                $mtItem->mt_item_class6_id = isset($itemClassCd6['id']) ? $itemClassCd6['id'] : null;
                $mtItem->mt_item_class7_id = isset($itemClassCd7['id']) ? $itemClassCd7['id'] : null;
                $mtItem->mt_supplier_id = isset($supplierCd['id']) ? $supplierCd['id'] : '';
                $mtItem->item_name = $param['item_name'];
                $mtItem->other_part_number = $param['other_part_number'];
                $mtItem->item_name_kana = $param['item_name_kana'];
                $mtItem->unit = $param['unit'];
                $mtItem->item_kbn = $param['item_kbn'];
                $mtItem->non_tax_kbn = $param['non_tax_kbn'];
                $mtItem->def_tax_rate_kbns_id = $taxRateCd['id'];
                if (isset($param['retail_price_tax_out']) && '' != $param['retail_price_tax_out']) {
                    $mtItem->retail_price_tax_out = str_replace(',', '', $param['retail_price_tax_out']);
                } else {
                    $mtItem->retail_price_tax_out = null;
                }
                if (isset($param['retail_price_tax_in']) && '' != $param['retail_price_tax_in']) {
                    $mtItem->retail_price_tax_in = str_replace(',', '', $param['retail_price_tax_in']);
                } else {
                    $mtItem->retail_price_tax_in = null;
                }
                if (isset($param['reference_retail_tax_out']) && '' != $param['reference_retail_tax_out']) {
                    $mtItem->reference_retail_tax_out = str_replace(',', '', $param['reference_retail_tax_out']);
                } else {
                    $mtItem->reference_retail_tax_out = null;
                }
                if (isset($param['reference_retail_tax_in']) && '' != $param['reference_retail_tax_in']) {
                    $mtItem->reference_retail_tax_in = str_replace(',', '', $param['reference_retail_tax_in']);
                } else {
                    $mtItem->reference_retail_tax_in = null;
                }
                if (isset($param['purchase_price_tax_out']) && '' != $param['purchase_price_tax_out']) {
                    $mtItem->purchase_price_tax_out = str_replace(',', '', $param['purchase_price_tax_out']);
                } else {
                    $mtItem->purchase_price_tax_out = null;
                }
                if (isset($param['purchase_price_tax_in']) && '' != $param['purchase_price_tax_in']) {
                    $mtItem->purchase_price_tax_in = str_replace(',', '', $param['purchase_price_tax_in']);
                } else {
                    $mtItem->purchase_price_tax_in = null;
                }
                if (isset($param['cost_price']) && '' != $param['cost_price']) {
                    $mtItem->cost_price = str_replace(',', '', $param['cost_price']);
                } else {
                    $mtItem->cost_price = null;
                }
                if (isset($param['profit_calculation_cost_price']) && '' != $param['profit_calculation_cost_price']) {
                    $mtItem->profit_calculation_cost_price = str_replace(',', '', $param['profit_calculation_cost_price']);
                } else {
                    $mtItem->profit_calculation_cost_price = null;
                }
                $mtItem->name_input_kbn = $param['name_input_kbn'];
                $mtItem->del_kbn = $param['del_kbn'];
                $mtItem->ec_alignment_kbn = $param['ec_alignment_kbn'];
                $mtItem->japan_post_office = $param['japan_post_office'];
                $mtItem->mt_user_last_update_id = Auth::user()->id;
                $mtItem->save();
                // SKU
                foreach ($param['input_color_code'] as $i => $color) {

                    if (!empty($color)) {
                        $mtColor = MtColor::where('color_cd', $color)->first();
                        if (empty($mtColor)) {
                            continue;
                        }
                        foreach ($param['input_size_code'] as $j => $size) {
                            if (!empty($size)) {
                                $mtSize = MtSize::where('size_cd', $size)->first();
                                if (empty($mtSize)) {
                                    continue;
                                }
                                $mtStockKeepingUnit = new MtStockKeepingUnit();
                                $mtStockKeepingUnit->mt_item_id = $mtItem['id'];
                                $mtStockKeepingUnit->mt_color_id = $mtColor['id'];
                                $mtStockKeepingUnit->mt_size_id = $mtSize['id'];
                                $mtStockKeepingUnit->hidden_flg = isset($param['hidden_flg'][$i . $j]) ? 1 : 0;
                                $mtStockKeepingUnit->mt_user_last_update_id = Auth::user()->id;

                                if (isset($param['register_jan_code']) && 1 == $param['register_jan_code'] && !$mtStockKeepingUnit->jan_cd && !$mtStockKeepingUnit->hidden_flg) {
                                    $nextJanCode = $this->getNextJanCode();
                                    $mtSystem = MtSystem::first();
                                    if ($nextJanCode > $mtSystem->end_jan_code) {
                                        $result['customMSG'] = "終了JANコードに到達しました。JANコードを追加してください。";
                                    } else {
                                        $digit = $this->calcJanCodeDigit($nextJanCode);
                                        $mtStockKeepingUnit->jan_cd = strval($nextJanCode) . strval($digit);
                                        $mtSystem->now_jan_code = $nextJanCode;
                                        $mtSystem->save();
                                    }
                                    if ($nextJanCode == $mtSystem->end_jan_code) {
                                        $result['customMSG'] = "終了JANコードに到達しました。JANコードを追加してください。";
                                    }
                                }
                                $mtStockKeepingUnit->save();
                            }
                        }
                    }
                }
                $MemberSiteItemIsNew = 1;
                if (!empty($param['ec_item_cd'])) {
                    $mtMemberSiteItem = MtMemberSiteItem::where('ec_item_cd', $param['ec_item_cd'])->exists();
                    if ($mtMemberSiteItem) {
                        $MemberSiteItemIsNew = 0;
                        $mtMemberSiteItem = MtMemberSiteItem::where('ec_item_cd', $param['ec_item_cd'])->first();
                    } else {
                        $mtMemberSiteItem = new MtMemberSiteItem();
                        $mtMemberSiteItem->ec_item_cd = $param['ec_item_cd'];
                    }

                    $mtMemberSiteItem->ec_item_name = $param['ec_item_name'];
                    $mtMemberSiteItem->ranking = $param['ranking'];
                    $mtMemberSiteItem->printed_products_flg = isset($param['printed_products_flg']) ? 1 : 0;
                    $mtMemberSiteItem->item_banner_url_1 = $param['item_banner_url_1'];
                    $mtMemberSiteItem->item_banner_url_2 = $param['item_banner_url_2'];
                    $mtMemberSiteItem->item_memo_1 = $param['item_memo_1'];
                    $mtMemberSiteItem->item_memo_2 = $param['item_memo_2'];
                    $mtMemberSiteItem->item_memo_3 = $param['item_memo_3'];
                    $mtMemberSiteItem->item_memo_4 = $param['item_memo_4'];
                    $mtMemberSiteItem->item_memo_5 = $param['item_memo_5'];
                    $mtMemberSiteItem->mt_user_last_update_id = Auth::user()->id;
                    //画像関連　更新(パスにIDが必要な為、別で更新する)$tableName . '/' . $keyId . '/' . $key;
                    $commonS3Path = "mt_member_site_items/" . $mtMemberSiteItem['id'] . '/';
                    for ($i = 1; $i < 5; $i++) {
                        $file = "item_image_file_{$i}";
                        $file_src = $file . "_src";
                        $path = $commonS3Path . "{$file}/";
                        if (isset($fileParam[$file])) {
                            $mtMemberSiteItem->$file = $path . $fileParam[$file]->getClientOriginalName();
                        } elseif (is_null($param[$file_src])) {
                            $mtMemberSiteItem->$file = null;
                        }
                    }
                    for ($i = 1; $i < 6; $i++) {
                        $file = "pdf_file_{$i}";
                        $file_src = $file . "_src";
                        $path = $commonS3Path . "{$file}/";
                        if (isset($fileParam[$file])) {
                            $mtMemberSiteItem->$file = $path . $fileParam[$file]->getClientOriginalName();
                        } elseif (is_null($param[$file_src])) {
                            $mtMemberSiteItem->$file = null;
                        }
                    }
                    for ($i = 1; $i < 3; $i++) {
                        $file = "item_banner_image_file_{$i}";
                        $file_src = $file . "_src";
                        $path = $commonS3Path . "{$file}/";
                        if (isset($fileParam[$file])) {
                            $mtMemberSiteItem->$file = $path . $fileParam[$file]->getClientOriginalName();
                        } elseif (is_null($param[$file_src])) {
                            $mtMemberSiteItem->$file = null;
                        }
                    }
                    $originalMtMemberSiteItems = $mtMemberSiteItem->getOriginal();
                    $mtMemberSiteItem->save();
                    $mtItem->mt_member_site_item_id = $mtMemberSiteItem['id'];
                    $mtItem->save();

                    if ($MemberSiteItemIsNew == 0) {
                        $changeMtMemberSiteItems = $mtMemberSiteItem->getChanges();
                        // 商品変更履歴マスタ（メンバーサイト商品マスタ項目の変更分）
                        $this->updateItemChangeHistory($mtItem['id'], $originalMtMemberSiteItems, $changeMtMemberSiteItems, $def_item_change_history_things);
                    }
                    if (isset($param['recommend_ec_item_cd'])) {
                        $i = 0;
                        foreach ($param['recommend_ec_item_cd'] as $pa) {
                            if (!empty($param['recommend_ec_item_cd'][$i])) {
                                $mtMemberSiteItemRecommendationManagement = new MtMemberSiteItemRecommendationManagement();
                                $mtMemberSiteItemRecommendationManagement->mt_member_site_item_id_base = $mtMemberSiteItem['id'];
                                $mtMemberSiteItemRecommendationManagement->mt_member_site_item_id_recommendation = $param['recommend_ec_item_id'][$i];
                                $mtMemberSiteItemRecommendationManagement->display_order = $param['recommend_display_order'][$i];
                                $mtMemberSiteItemRecommendationManagement->mt_user_last_update_id = Auth::user()->id;
                                $mtMemberSiteItemRecommendationManagement->save();
                            }
                            $i++;
                        }
                    }
                }

                //商品変更履歴マスタ　新規登録
                $mtItemChangeHistory = new MtItemChangeHistory();
                $mtItemChangeHistory->mt_item_id = $mtItem['id'];
                $mtItemChangeHistory->mt_user_id = Auth::user()->id;
                $mtItemChangeHistory->change_datetime = Carbon::now();
                $mtItemChangeHistory->def_item_change_history_thing_id = 1;
                $mtItemChangeHistory->mt_user_last_update_id = Auth::user()->id;
                $mtItemChangeHistory->save();
            }

            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
            $result['mtItemId'] = $mtItem['id'];
            if (isset($mtMemberSiteItem)) $result['mtMemberSiteItemId'] = $mtMemberSiteItem['id'];
        } catch (Exception $e) {
            report($e);
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * 商品データの条件取得
     * @param $params
     * @return Object
     */
    public function get($params)
    {
        $includeDeleted = $params['include_deleted'] ?? false;

        $result = MtItem::select(
            'mt_items.id as id',
            'mt_items.*',
            'mt_member_site_items.*',
            'mic1.item_class_cd as mt_item_class1_cd',
            'mic2.item_class_cd as mt_item_class2_cd',
            'mic3.item_class_cd as mt_item_class3_cd',
            'mic4.item_class_cd as mt_item_class4_cd',
            'mic5.item_class_cd as mt_item_class5_cd',
            'mic6.item_class_cd as mt_item_class6_cd',
            'mic7.item_class_cd as mt_item_class7_cd',
        )
            ->leftJoin('mt_member_site_items', 'mt_items.mt_member_site_item_id', 'mt_member_site_items.id')
            ->leftJoin('mt_item_classes as mic1', 'mt_items.mt_item_class1_id', 'mic1.id')
            ->leftJoin('mt_item_classes as mic2', 'mt_items.mt_item_class2_id', 'mic2.id')
            ->leftJoin('mt_item_classes as mic3', 'mt_items.mt_item_class3_id', 'mic3.id')
            ->leftJoin('mt_item_classes as mic4', 'mt_items.mt_item_class4_id', 'mic4.id')
            ->leftJoin('mt_item_classes as mic5', 'mt_items.mt_item_class5_id', 'mic5.id')
            ->leftJoin('mt_item_classes as mic6', 'mt_items.mt_item_class6_id', 'mic6.id')
            ->leftJoin('mt_item_classes as mic7', 'mt_items.mt_item_class7_id', 'mic7.id')
            // 商品に紐づくSKUのうちjan_cd が最大のものだけをjoin
            ->leftJoin(
                DB::raw(
                    '(
                        SELECT mt_item_id, max(t1.jan_cd) as jan_cd
                        FROM mt_stock_keeping_units  as t1
                        Group by mt_item_id
                    )
                    AS mt_stock_keeping_units'
                ),
                "mt_items.id",
                "mt_stock_keeping_units.mt_item_id"
            )
            // ->leftJoin('mt_stock_keeping_units', 'mt_items.id', 'mt_stock_keeping_units.mt_item_id')
            ->when(isset($params['item_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mt_items.item_cd", '>=', $params['item_cd']);
                });
            })->when(isset($params['item_name']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mt_items.item_name", 'like', '%' . $params['item_name'] . '%');
                });
            })->when(isset($params['item_kbn']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mt_items.item_kbn", $params['item_kbn']);
                });
            })->when(isset($params['item_name_kana']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mt_items.item_name_kana", 'like', '%' . $params['item_name_kana'] . '%');
                });
            })->when(isset($params['other_part_number']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mt_items.other_part_number", 'like', '%' . $params['other_part_number'] . '%');
                });
            })->when(isset($params['jan']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mt_stock_keeping_units.jan_cd", '>=', $params['jan']);
                });
            })->when(isset($params['member_item_code']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mt_member_site_items.ec_item_cd", '>=', $params['member_item_code']);
                });
            })->when(isset($params['mt_item_class1_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mic1.item_class_cd", '>=', $params['mt_item_class1_cd']);
                });
            })->when(isset($params['mt_item_class2_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mic2.item_class_cd", '>=', $params['mt_item_class2_cd']);
                });
            })->when(isset($params['mt_item_class3_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mic3.item_class_cd", '>=', $params['mt_item_class3_cd']);
                });
            })->when(isset($params['mt_item_class4_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mic4.item_class_cd", '>=', $params['mt_item_class4_cd']);
                });
            })->when(isset($params['mt_item_class5_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mic5.item_class_cd", '>=', $params['mt_item_class5_cd']);
                });
            })->when(isset($params['mt_item_class6_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mic6.item_class_cd", '>=', $params['mt_item_class6_cd']);
                });
            })->when(isset($params['mt_item_class7_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mic7.item_class_cd", '>=', $params['mt_item_class7_cd']);
                });
            })->when($includeDeleted === false, fn($query) => $query->where("del_kbn", 0))
            ->orderBy("item_cd")->paginate(CommonConsts::PAGINATION);

        return $result;
    }

    /**
     * 商品データの情報取得
     * @param $param
     * @return Object
     */
    public function getItemData($param)
    {
        $result = MtItem::get();
        return $result;
    }

    /**
     * 商品マスタリスト(一覧) 出力
     * @param $param
     * @return Object
     */
    public function export($params)
    {
        // itemClass is null のデータも多く、Start,Endが無指定の場合はnull値も取得可能とする
        $itemClassCode1Start = ($params['item_class1_start']) ? $params['item_class1_start'] : '';
        $itemClassCode1End = ($params['item_class1_end']) ? $params['item_class1_end'] : 'ZZZZZZ';
        $itemClassCode2Start = ($params['item_class2_start']) ? $params['item_class2_start'] : '';
        $itemClassCode2End = ($params['item_class2_end']) ? $params['item_class2_end'] : 'ZZZZZZ';
        $itemClassCode3Start = ($params['item_class3_start']) ? $params['item_class3_start'] : '';
        $itemClassCode3End = ($params['item_class3_end']) ? $params['item_class3_end'] : 'ZZZZZZ';
        $itemClassCode4Start = ($params['item_class4_start']) ? $params['item_class4_start'] : '';
        $itemClassCode4End = ($params['item_class4_end']) ? $params['item_class4_end'] : 'ZZZZZZ';
        $itemClassCode5Start = ($params['item_class5_start']) ? $params['item_class5_start'] : '';
        $itemClassCode5End = ($params['item_class5_end']) ? $params['item_class5_end'] : 'ZZZZZZ';
        $itemClassCode6Start = ($params['item_class6_start']) ? $params['item_class6_start'] : '';
        $itemClassCode6End = ($params['item_class6_end']) ? $params['item_class6_end'] : 'ZZZZZZ';
        $itemClassCode7Start = ($params['item_class7_start']) ? $params['item_class7_start'] : '';
        $itemClassCode7End = ($params['item_class7_end']) ? $params['item_class7_end'] : 'ZZZZZZ';
        $itemCodeStart = ($params['item_cd_start']) ? $params['item_cd_start'] : '';
        $itemCodeEnd = ($params['item_cd_end']) ? $params['item_cd_end'] : 'ZZZZZZZZZ';
        $otherPartNumberStart = ($params['other_part_number_start']) ? $params['other_part_number_start'] : '';
        $otherPartNumberEnd = ($params['other_part_number_end']) ? $params['other_part_number_end'] : 'ZZZZZZZZZZZZZZZZZZZZ';
        $itemClassCode1Ids = MtItemClass::where('def_item_class_thing_id', '1')->where("item_class_cd", '>=', $itemClassCode1Start)->where("item_class_cd", '<=', $itemClassCode1End)->pluck('id');
        $itemClassCode2Ids = MtItemClass::where('def_item_class_thing_id', '2')->where("item_class_cd", '>=', $itemClassCode2Start)->where("item_class_cd", '<=', $itemClassCode2End)->pluck('id');
        $itemClassCode3Ids = MtItemClass::where('def_item_class_thing_id', '3')->where("item_class_cd", '>=', $itemClassCode3Start)->where("item_class_cd", '<=', $itemClassCode3End)->pluck('id');
        $itemClassCode4Ids = MtItemClass::where('def_item_class_thing_id', '4')->where("item_class_cd", '>=', $itemClassCode4Start)->where("item_class_cd", '<=', $itemClassCode4End)->pluck('id');
        $itemClassCode5Ids = MtItemClass::where('def_item_class_thing_id', '5')->where("item_class_cd", '>=', $itemClassCode5Start)->where("item_class_cd", '<=', $itemClassCode5End)->pluck('id');
        $itemClassCode6Ids = MtItemClass::where('def_item_class_thing_id', '6')->where("item_class_cd", '>=', $itemClassCode6Start)->where("item_class_cd", '<=', $itemClassCode6End)->pluck('id');
        $itemClassCode7Ids = MtItemClass::where('def_item_class_thing_id', '7')->where("item_class_cd", '>=', $itemClassCode7Start)->where("item_class_cd", '<=', $itemClassCode7End)->pluck('id');

        $result['defItemClassThing'] = DefItemClassThing::get();
        $result['defTaxRateKbn'] = DefTaxRateKbn::get();
        $result['mtColor'] = MtColor::get();
        $result['mtSize'] = MtSize::get();
        $query = MtItem::select(
            'mt_items.id as id',
            'mt_items.*',
            'mt_member_site_items.*',
            'mt_suppliers.supplier_cd',
            'mic1.item_class_cd as item_class_cd_1',
            'mic1.item_class_name as item_class_name_1',
            'mic2.item_class_cd as item_class_cd_2',
            'mic2.item_class_name as item_class_name_2',
            'mic3.item_class_cd as item_class_cd_3',
            'mic3.item_class_name as item_class_name_3',
            'mic4.item_class_cd as item_class_cd_4',
            'mic4.item_class_name as item_class_name_4',
            'mic5.item_class_cd as item_class_cd_5',
            'mic5.item_class_name as item_class_name_5',
            'mic6.item_class_cd as item_class_cd_6',
            'mic6.item_class_name as item_class_name_6',
            'mic7.item_class_cd as item_class_cd_7',
            'mic7.item_class_name as item_class_name_7',
            'mt_colors.sort_order',
            'def_tax_rate_kbns.tax_rate_kbn_cd as tax_rate_kbn_cd',
        )
            ->leftJoin('mt_member_site_items', 'mt_items.mt_member_site_item_id', 'mt_member_site_items.id')
            ->leftJoin('mt_suppliers', 'mt_items.mt_supplier_id', 'mt_suppliers.id')
            ->leftJoin('mt_item_classes as mic1', 'mt_items.mt_item_class1_id', 'mic1.id')
            ->leftJoin('mt_item_classes as mic2', 'mt_items.mt_item_class2_id', 'mic2.id')
            ->leftJoin('mt_item_classes as mic3', 'mt_items.mt_item_class3_id', 'mic3.id')
            ->leftJoin('mt_item_classes as mic4', 'mt_items.mt_item_class4_id', 'mic4.id')
            ->leftJoin('mt_item_classes as mic5', 'mt_items.mt_item_class5_id', 'mic5.id')
            ->leftJoin('mt_item_classes as mic6', 'mt_items.mt_item_class6_id', 'mic6.id')
            ->leftJoin('mt_item_classes as mic7', 'mt_items.mt_item_class7_id', 'mic7.id')
            ->leftJoin('mt_stock_keeping_units', 'mt_items.id', 'mt_stock_keeping_units.mt_item_id')
            ->leftJoin('mt_colors', 'mt_stock_keeping_units.mt_color_id', 'mt_colors.id')
            ->leftJoin('def_tax_rate_kbns', 'mt_items.def_tax_rate_kbns_id', 'def_tax_rate_kbns.id')
            ->where("mt_items.item_cd", '>=', $itemCodeStart)->where("mt_items.item_cd", '<=', $itemCodeEnd)
            ->distinct(['mt_items.id']);

        if ($params['other_part_number_start'] || $params['other_part_number_end']) {
            $query = $query->where("mt_items.other_part_number", '>=', $otherPartNumberStart)->where("mt_items.other_part_number", '<=', $otherPartNumberEnd);
        }
        if ($params['item_class1_start'] || $params['item_class1_end']) {
            $query = $query->whereIn('mt_items.mt_item_class1_id', $itemClassCode1Ids);
        }
        if ($params['item_class2_start'] || $params['item_class2_end']) {
            $query = $query->whereIn('mt_items.mt_item_class2_id', $itemClassCode2Ids);
        }
        if ($params['item_class3_start'] || $params['item_class3_end']) {
            $query = $query->whereIn('mt_items.mt_item_class3_id', $itemClassCode3Ids);
        }
        if ($params['item_class4_start'] || $params['item_class4_end']) {
            $query = $query->whereIn('mt_items.mt_item_class4_id', $itemClassCode4Ids);
        }
        if ($params['item_class5_start'] || $params['item_class5_end']) {
            $query = $query->whereIn('mt_items.mt_item_class5_id', $itemClassCode5Ids);
        }
        if ($params['item_class6_start'] || $params['item_class6_end']) {
            $query = $query->whereIn('mt_items.mt_item_class6_id', $itemClassCode6Ids);
        }
        if ($params['item_class7_start'] || $params['item_class7_end']) {
            $query = $query->whereIn('mt_items.mt_item_class7_id', $itemClassCode7Ids);
        }
        $datas['mtItem'] = $query->orderBy('item_cd')->orderBy('mt_colors.sort_order')->get();

        $dataArray = array();
        foreach ($datas['mtItem'] as $re) {
            $colors = MtStockKeepingUnit::distinct('mt_color_id')->select('mt_color_id')->where('mt_item_id', $re->id)->get();
            $colorDatas = array();
            foreach ($colors as $co) {
                $sizes = MtStockKeepingUnit::select('mt_size_id', 'jan_cd')->where('mt_item_id', $re->id)->where('mt_color_id', $co->mt_color_id)->get();
                $co['size'] = $sizes;
                $colorDatas[] = $co;
            }
            //array_push($colorDatas, $co);
            $re->colors = $colorDatas;
            array_push($dataArray, $re);
        }
        $result['mtItem'] = $dataArray;
        return $result;
    }

    /**
     * 商品マスタリスト取込原本(SKU) 出力
     * @param $param
     * @return Object
     */
    public function exportSku($params)
    {
        $itemClassCode1Start = ($params['item_class1_start']) ? $params['item_class1_start'] : '';
        $itemClassCode1End = ($params['item_class1_end']) ? $params['item_class1_end'] : 'ZZZZZZ';
        $itemClassCode2Start = ($params['item_class2_start']) ? $params['item_class2_start'] : '';
        $itemClassCode2End = ($params['item_class2_end']) ? $params['item_class2_end'] : 'ZZZZZZ';
        $itemClassCode3Start = ($params['item_class3_start']) ? $params['item_class3_start'] : '';
        $itemClassCode3End = ($params['item_class3_end']) ? $params['item_class3_end'] : 'ZZZZZZ';
        $itemClassCode4Start = ($params['item_class4_start']) ? $params['item_class4_start'] : '';
        $itemClassCode4End = ($params['item_class4_end']) ? $params['item_class4_end'] : 'ZZZZZZ';
        $itemClassCode5Start = ($params['item_class5_start']) ? $params['item_class5_start'] : '';
        $itemClassCode5End = ($params['item_class5_end']) ? $params['item_class5_end'] : 'ZZZZZZ';
        $itemClassCode6Start = ($params['item_class6_start']) ? $params['item_class6_start'] : '';
        $itemClassCode6End = ($params['item_class6_end']) ? $params['item_class6_end'] : 'ZZZZZZ';
        $itemClassCode7Start = ($params['item_class7_start']) ? $params['item_class7_start'] : '';
        $itemClassCode7End = ($params['item_class7_end']) ? $params['item_class7_end'] : 'ZZZZZZ';
        $itemCodeStart = ($params['item_cd_start']) ? $params['item_cd_start'] : '';
        $itemCodeEnd = ($params['item_cd_end']) ? $params['item_cd_end'] : 'ZZZZZZZZZ';
        $otherPartNumberStart = ($params['other_part_number_start']) ? $params['other_part_number_start'] : '';
        $otherPartNumberEnd = ($params['other_part_number_end']) ? $params['other_part_number_end'] : 'ZZZZZZZZZZZZZZZZZZZZ';

        $itemClassCode1Ids = MtItemClass::where('def_item_class_thing_id', '1')->where("item_class_cd", '>=', $itemClassCode1Start)->where("item_class_cd", '<=', $itemClassCode1End)->pluck('id');
        $itemClassCode2Ids = MtItemClass::where('def_item_class_thing_id', '2')->where("item_class_cd", '>=', $itemClassCode2Start)->where("item_class_cd", '<=', $itemClassCode2End)->pluck('id');
        $itemClassCode3Ids = MtItemClass::where('def_item_class_thing_id', '3')->where("item_class_cd", '>=', $itemClassCode3Start)->where("item_class_cd", '<=', $itemClassCode3End)->pluck('id');
        $itemClassCode4Ids = MtItemClass::where('def_item_class_thing_id', '4')->where("item_class_cd", '>=', $itemClassCode4Start)->where("item_class_cd", '<=', $itemClassCode4End)->pluck('id');
        $itemClassCode5Ids = MtItemClass::where('def_item_class_thing_id', '5')->where("item_class_cd", '>=', $itemClassCode5Start)->where("item_class_cd", '<=', $itemClassCode5End)->pluck('id');
        $itemClassCode6Ids = MtItemClass::where('def_item_class_thing_id', '6')->where("item_class_cd", '>=', $itemClassCode6Start)->where("item_class_cd", '<=', $itemClassCode6End)->pluck('id');
        $itemClassCode7Ids = MtItemClass::where('def_item_class_thing_id', '7')->where("item_class_cd", '>=', $itemClassCode7Start)->where("item_class_cd", '<=', $itemClassCode7End)->pluck('id');

        // $itemIds = MtItem::where("item_cd", '>=', $itemCodeStart)->where("item_cd", '<=', $itemCodeEnd)->pluck('id');

        $result['defItemClassThing'] = DefItemClassThing::get();
        $result['defTaxRateKbn'] = DefTaxRateKbn::get();
        $result['mtColor'] = MtColor::get();
        $result['mtSize'] = MtSize::get();
        $query = MtStockKeepingUnit::select(
            'mt_items.id as id',
            'mt_items.*',
            'mt_suppliers.supplier_cd',
            'mt_stock_keeping_units.mt_item_id',
            'mt_stock_keeping_units.mt_color_id',
            'mt_stock_keeping_units.mt_size_id',
            'mt_stock_keeping_units.jan_cd',
            'mt_stock_keeping_units.hidden_flg',
            'mt_colors.color_cd',
            'mt_colors.color_name',
            'mt_sizes.size_cd',
            'mt_sizes.size_name',
            'mt_member_site_items.*',
            'mic1.item_class_cd as item_class_cd_1',
            'mic1.item_class_name as item_class_name_1',
            'mic2.item_class_cd as item_class_cd_2',
            'mic2.item_class_name as item_class_name_2',
            'mic3.item_class_cd as item_class_cd_3',
            'mic3.item_class_name as item_class_name_3',
            'mic4.item_class_cd as item_class_cd_4',
            'mic4.item_class_name as item_class_name_4',
            'mic5.item_class_cd as item_class_cd_5',
            'mic5.item_class_name as item_class_name_5',
            'mic6.item_class_cd as item_class_cd_6',
            'mic6.item_class_name as item_class_name_6',
            'mic7.item_class_cd as item_class_cd_7',
            'mic7.item_class_name as item_class_name_7',
            'def_tax_rate_kbns.tax_rate_kbn_cd as tax_rate_kbn_cd',
        )
            ->leftJoin('mt_items', 'mt_stock_keeping_units.mt_item_id', 'mt_items.id')
            ->leftJoin('mt_suppliers', 'mt_items.mt_supplier_id', 'mt_suppliers.id')
            ->leftJoin('mt_member_site_items', 'mt_items.mt_member_site_item_id', 'mt_member_site_items.id')
            ->leftJoin('mt_item_classes as mic1', 'mt_items.mt_item_class1_id', 'mic1.id')
            ->leftJoin('mt_item_classes as mic2', 'mt_items.mt_item_class2_id', 'mic2.id')
            ->leftJoin('mt_item_classes as mic3', 'mt_items.mt_item_class3_id', 'mic3.id')
            ->leftJoin('mt_item_classes as mic4', 'mt_items.mt_item_class4_id', 'mic4.id')
            ->leftJoin('mt_item_classes as mic5', 'mt_items.mt_item_class5_id', 'mic5.id')
            ->leftJoin('mt_item_classes as mic6', 'mt_items.mt_item_class6_id', 'mic6.id')
            ->leftJoin('mt_item_classes as mic7', 'mt_items.mt_item_class7_id', 'mic7.id')
            ->leftJoin('mt_colors', 'mt_stock_keeping_units.mt_color_id', 'mt_colors.id')
            ->leftJoin('mt_sizes', 'mt_stock_keeping_units.mt_size_id', 'mt_sizes.id')
            ->leftJoin('def_tax_rate_kbns', 'mt_items.def_tax_rate_kbns_id', 'def_tax_rate_kbns.id');

        if ($params['item_cd_start'] || $params['item_cd_end']) {
            $query = $query->where("mt_items.item_cd", '>=', $itemCodeStart)->where("mt_items.item_cd", '<=', $itemCodeEnd);
        }
        if ($params['other_part_number_start'] || $params['other_part_number_end']) {
            $query = $query->where("mt_items.other_part_number", '>=', $otherPartNumberStart)->where("mt_items.other_part_number", '<=', $otherPartNumberEnd);
        }
        if ($params['item_class1_start'] || $params['item_class1_end']) {
            $query = $query->whereIn('mt_items.mt_item_class1_id', $itemClassCode1Ids);
        }
        if ($params['item_class2_start'] || $params['item_class2_end']) {
            $query = $query->whereIn('mt_items.mt_item_class2_id', $itemClassCode2Ids);
        }
        if ($params['item_class3_start'] || $params['item_class3_end']) {
            $query = $query->whereIn('mt_items.mt_item_class3_id', $itemClassCode3Ids);
        }
        if ($params['item_class4_start'] || $params['item_class4_end']) {
            $query = $query->whereIn('mt_items.mt_item_class4_id', $itemClassCode4Ids);
        }
        if ($params['item_class5_start'] || $params['item_class5_end']) {
            $query = $query->whereIn('mt_items.mt_item_class5_id', $itemClassCode5Ids);
        }
        if ($params['item_class6_start'] || $params['item_class6_end']) {
            $query = $query->whereIn('mt_items.mt_item_class6_id', $itemClassCode6Ids);
        }
        if ($params['item_class7_start'] || $params['item_class7_end']) {
            $query = $query->whereIn('mt_items.mt_item_class7_id', $itemClassCode7Ids);
        }
        $datas['mtItem'] = $query->orderBy('mt_items.item_cd')->orderBy('mt_colors.color_cd')->orderBy('mt_sizes.size_cd')->get();

        return $datas;
    }

    /**
     * 商品マスタリスト取込原本(品番) 出力
     * @param $param
     * @return Object
     */
    public function exportItemCd($params)
    {
        $itemClassCode1Start = ($params['item_class1_start']) ? $params['item_class1_start'] : '';
        $itemClassCode1End = ($params['item_class1_end']) ? $params['item_class1_end'] : 'ZZZZZZ';
        $itemClassCode2Start = ($params['item_class2_start']) ? $params['item_class2_start'] : '';
        $itemClassCode2End = ($params['item_class2_end']) ? $params['item_class2_end'] : 'ZZZZZZ';
        $itemClassCode3Start = ($params['item_class3_start']) ? $params['item_class3_start'] : '';
        $itemClassCode3End = ($params['item_class3_end']) ? $params['item_class3_end'] : 'ZZZZZZ';
        $itemClassCode4Start = ($params['item_class4_start']) ? $params['item_class4_start'] : '';
        $itemClassCode4End = ($params['item_class4_end']) ? $params['item_class4_end'] : 'ZZZZZZ';
        $itemClassCode5Start = ($params['item_class5_start']) ? $params['item_class5_start'] : '';
        $itemClassCode5End = ($params['item_class5_end']) ? $params['item_class5_end'] : 'ZZZZZZ';
        $itemClassCode6Start = ($params['item_class6_start']) ? $params['item_class6_start'] : '';
        $itemClassCode6End = ($params['item_class6_end']) ? $params['item_class6_end'] : 'ZZZZZZ';
        $itemClassCode7Start = ($params['item_class7_start']) ? $params['item_class7_start'] : '';
        $itemClassCode7End = ($params['item_class7_end']) ? $params['item_class7_end'] : 'ZZZZZZ';
        $itemCodeStart = ($params['item_cd_start']) ? $params['item_cd_start'] : '';
        $itemCodeEnd = ($params['item_cd_end']) ? $params['item_cd_end'] : 'ZZZZZZZZZ';
        $otherPartNumberStart = ($params['other_part_number_start']) ? $params['other_part_number_start'] : '';
        $otherPartNumberEnd = ($params['other_part_number_end']) ? $params['other_part_number_end'] : 'ZZZZZZZZZZZZZZZZZZZZ';

        $itemClassCode1Ids = MtItemClass::where('def_item_class_thing_id', '1')->where("item_class_cd", '>=', $itemClassCode1Start)->where("item_class_cd", '<=', $itemClassCode1End)->pluck('id');
        $itemClassCode2Ids = MtItemClass::where('def_item_class_thing_id', '2')->where("item_class_cd", '>=', $itemClassCode2Start)->where("item_class_cd", '<=', $itemClassCode2End)->pluck('id');
        $itemClassCode3Ids = MtItemClass::where('def_item_class_thing_id', '3')->where("item_class_cd", '>=', $itemClassCode3Start)->where("item_class_cd", '<=', $itemClassCode3End)->pluck('id');
        $itemClassCode4Ids = MtItemClass::where('def_item_class_thing_id', '4')->where("item_class_cd", '>=', $itemClassCode4Start)->where("item_class_cd", '<=', $itemClassCode4End)->pluck('id');
        $itemClassCode5Ids = MtItemClass::where('def_item_class_thing_id', '5')->where("item_class_cd", '>=', $itemClassCode5Start)->where("item_class_cd", '<=', $itemClassCode5End)->pluck('id');
        $itemClassCode6Ids = MtItemClass::where('def_item_class_thing_id', '6')->where("item_class_cd", '>=', $itemClassCode6Start)->where("item_class_cd", '<=', $itemClassCode6End)->pluck('id');
        $itemClassCode7Ids = MtItemClass::where('def_item_class_thing_id', '7')->where("item_class_cd", '>=', $itemClassCode7Start)->where("item_class_cd", '<=', $itemClassCode7End)->pluck('id');

        $result['defItemClassThing'] = DefItemClassThing::get();
        $result['defTaxRateKbn'] = DefTaxRateKbn::get();
        $result['mtColor'] = MtColor::get();
        $result['mtSize'] = MtSize::get();
        $query = MtItem::select(
            'mt_items.id as id',
            'mt_items.*',
            'mt_member_site_items.*',
            'mt_suppliers.supplier_cd',
            'mic1.item_class_cd as item_class_cd_1',
            'mic1.item_class_name as item_class_name_1',
            'mic2.item_class_cd as item_class_cd_2',
            'mic2.item_class_name as item_class_name_2',
            'mic3.item_class_cd as item_class_cd_3',
            'mic3.item_class_name as item_class_name_3',
            'mic4.item_class_cd as item_class_cd_4',
            'mic4.item_class_name as item_class_name_4',
            'mic5.item_class_cd as item_class_cd_5',
            'mic5.item_class_name as item_class_name_5',
            'mic6.item_class_cd as item_class_cd_6',
            'mic6.item_class_name as item_class_name_6',
            'mic7.item_class_cd as item_class_cd_7',
            'mic7.item_class_name as item_class_name_7',
            'def_tax_rate_kbns.tax_rate_kbn_cd as tax_rate_kbn_cd',
        )
            ->leftJoin('mt_member_site_items', 'mt_items.mt_member_site_item_id', 'mt_member_site_items.id')
            ->leftJoin('mt_suppliers', 'mt_items.mt_supplier_id', 'mt_suppliers.id')
            ->leftJoin('mt_item_classes as mic1', 'mt_items.mt_item_class1_id', 'mic1.id')
            ->leftJoin('mt_item_classes as mic2', 'mt_items.mt_item_class2_id', 'mic2.id')
            ->leftJoin('mt_item_classes as mic3', 'mt_items.mt_item_class3_id', 'mic3.id')
            ->leftJoin('mt_item_classes as mic4', 'mt_items.mt_item_class4_id', 'mic4.id')
            ->leftJoin('mt_item_classes as mic5', 'mt_items.mt_item_class5_id', 'mic5.id')
            ->leftJoin('mt_item_classes as mic6', 'mt_items.mt_item_class6_id', 'mic6.id')
            ->leftJoin('mt_item_classes as mic7', 'mt_items.mt_item_class7_id', 'mic7.id')
            ->leftJoin('def_tax_rate_kbns', 'mt_items.def_tax_rate_kbns_id', 'def_tax_rate_kbns.id');

        if ($params['item_cd_start'] || $params['item_cd_end']) {
            $query = $query->where("mt_items.item_cd", '>=', $itemCodeStart)->where("mt_items.item_cd", '<=', $itemCodeEnd);
        }
        if ($params['other_part_number_start'] || $params['other_part_number_end']) {
            $query = $query->where("mt_items.other_part_number", '>=', $otherPartNumberStart)
                ->where("mt_items.other_part_number", '<=', $otherPartNumberEnd);
        }
        if ($params['item_class1_start'] || $params['item_class1_end']) {
            $query = $query->whereIn('mt_items.mt_item_class1_id', $itemClassCode1Ids);
        }
        if ($params['item_class2_start'] || $params['item_class2_end']) {
            $query = $query->whereIn('mt_items.mt_item_class2_id', $itemClassCode2Ids);
        }
        if ($params['item_class3_start'] || $params['item_class3_end']) {
            $query = $query->whereIn('mt_items.mt_item_class3_id', $itemClassCode3Ids);
        }
        if ($params['item_class4_start'] || $params['item_class4_end']) {
            $query = $query->whereIn('mt_items.mt_item_class4_id', $itemClassCode4Ids);
        }
        if ($params['item_class5_start'] || $params['item_class5_end']) {
            $query = $query->whereIn('mt_items.mt_item_class5_id', $itemClassCode5Ids);
        }
        if ($params['item_class6_start'] || $params['item_class6_end']) {
            $query = $query->whereIn('mt_items.mt_item_class6_id', $itemClassCode6Ids);
        }
        if ($params['item_class7_start'] || $params['item_class7_end']) {
            $query = $query->whereIn('mt_items.mt_item_class7_id', $itemClassCode7Ids);
        }
        $datas['mtItem'] = $query->orderBy('item_cd')->get();
        $dataArray = array();
        foreach ($datas['mtItem'] as $re) {
            $colors = MtStockKeepingUnit::where('mt_item_id', $re->id)->pluck('mt_color_id');
            $sizes = MtStockKeepingUnit::where('mt_item_id', $re->id)->pluck('mt_size_id');
            $colorArray = $colors->unique()->values()->sort()->toArray();
            $re->colors = $colorArray;
            $sizeArray = $sizes->unique()->values()->sort()->toArray();
            $re->sizes = $sizeArray;
            array_push($dataArray, $re);
        }
        $result['mtItem'] = $dataArray;

        return $result;
    }

    /**
     * 商品リスト(分類別) 出力
     * @param $param
     * @return Object
     */
    public function exportByClass($param)
    {
        $startCode = '';
        $endCode = '';
        $itemStartCode = '';
        $itemEndCode = 'ZZZZZZZZZ';
        if ($param['item_class_id'] === '1') {
            $startCode = (isset($param['item_class_code1_start'])) ? $param['item_class_code1_start'] : '';
            $endCode = (isset($param['item_class_code1_end'])) ? $param['item_class_code1_end'] : 'ZZZZZZ';
        } elseif ($param['item_class_id'] === '2') {
            $startCode = (isset($param['item_class_code2_start'])) ? $param['item_class_code2_start'] : '';
            $endCode = (isset($param['item_class_code2_end'])) ? $param['item_class_code2_end'] : 'ZZZZZZ';
        } elseif ($param['item_class_id'] === '3') {
            $startCode = (isset($param['item_class_code3_start'])) ? $param['item_class_code3_start'] : '';
            $endCode = (isset($param['item_class_code3_end'])) ? $param['item_class_code3_end'] : 'ZZZZZZ';
        }
        $itemStartCode = (isset($param['item_code_start'])) ? $param['item_code_start'] : '';
        $itemEndCode = (isset($param['item_code_end'])) ? $param['item_code_end'] : 'ZZZZZZZZZ';

        $classIds = MtItemClass::where('def_item_class_thing_id', $param['item_class_id'])
            ->where("item_class_cd", '>=', $startCode)
            ->where("item_class_cd", '<=', $endCode)
            ->pluck('id');

        $query = "";

        if ($param['item_class_id'] === '1') {
            $query =  MtItem::leftJoin('mt_item_classes', 'mt_items.mt_item_class1_id', 'mt_item_classes.id');
            if ($param['item_class_code1_start'] || $param['item_class_code1_end']) {
                $query = $query->whereIn('mt_items.mt_item_class1_id', $classIds);
            }
        } elseif ($param['item_class_id'] === '2') {
            $query =  MtItem::leftJoin('mt_item_classes', 'mt_items.mt_item_class2_id', 'mt_item_classes.id');
            if ($param['item_class_code2_start'] || $param['item_class_code2_end']) {
                $query = $query->whereIn('mt_items.mt_item_class2_id', $classIds);
            }
        } elseif ($param['item_class_id'] === '3') {
            $query =  MtItem::leftJoin('mt_item_classes', 'mt_items.mt_item_class3_id', 'mt_item_classes.id');
            if ($param['item_class_code3_start'] || $param['item_class_code3_end']) {
                $query = $query->whereIn('mt_items.mt_item_class3_id', $classIds);
            }
        }

        $result = $query->where("item_cd", '>=', $itemStartCode)
            ->where("item_cd", '<=', $itemEndCode)
            ->orderBy('item_class_cd')->orderBy('item_cd')->get();

        return $result;
    }

    /**
     * 商品コード変更 更新
     * @param $param
     * @return Object
     */
    public function updateItemCode($params)
    {
        $changeKbn = $params['change_kbn'];
        $beforeItemCode = $params['before_item_code'];
        $beforeColorCode = $params['before_color_code'];
        $beforeSizeCode = $params['before_size_code'];
        $afterItemCode = $params['after_item_code'];
        $afterColorCode = $params['after_color_code'];
        $afterSizeCode = $params['after_size_code'];

        $result = array();
        try {
            DB::beginTransaction();
            if ($changeKbn === "1") {
                //商品コードのみ
                $mtItem = MtItem::where('item_cd', $beforeItemCode)->first();
                $mtItem->item_cd = $afterItemCode;
                $mtItem->mt_user_last_update_id = Auth::user()->id;
                $mtItem->save();

                $mItemChangeHistory = new MtItemChangeHistory();
                $mItemChangeHistory->mt_item_id = $mtItem->id;
                $mItemChangeHistory->mt_user_id = Auth::user()->id;
                $mItemChangeHistory->change_datetime = Carbon::now();
                $mItemChangeHistory->def_item_change_history_thing_id = "0003";
                $mItemChangeHistory->change_before = $beforeItemCode;
                $mItemChangeHistory->change_after = $afterItemCode;
                $mItemChangeHistory->mt_user_last_update_id  = Auth::user()->id;
                $mItemChangeHistory->save();
            } elseif ($changeKbn === "2") {
                //商品コード+カラーコード
                $itemId = MtItem::getIdByCode($beforeItemCode);
                $beforeColorId = MtColor::getIdByCode($beforeColorCode);
                $afterColorId = MtColor::getIdByCode($afterColorCode);
                $mtStockKeepingUnit = MtStockKeepingUnit::where('mt_item_id', $itemId['id'])->where('mt_color_id', $beforeColorId['id'])->get();
                foreach ($mtStockKeepingUnit as $data) {
                    $data->mt_color_id = $afterColorId['id'];
                    $data->save();
                }

                $mItemChangeHistory = new MtItemChangeHistory();
                $mItemChangeHistory->mt_item_id = $itemId['id'];
                $mItemChangeHistory->mt_user_id = Auth::user()->id;
                $mItemChangeHistory->change_datetime = Carbon::now();
                $mItemChangeHistory->def_item_change_history_thing_id = "0004";
                $mItemChangeHistory->change_before = $beforeColorCode;
                $mItemChangeHistory->change_after = $afterColorCode;
                $mItemChangeHistory->mt_user_last_update_id  = Auth::user()->id;
                $mItemChangeHistory->save();
            } elseif ($changeKbn === "3") {
                //商品コード+サイズコード
                $itemId = MtItem::getIdByCode($beforeItemCode);
                $beforeSizeId = MtSize::getIdByCode($beforeSizeCode);
                $afterSizeId = MtSize::getIdByCode($afterSizeCode);
                $mtStockKeepingUnit = MtStockKeepingUnit::where('mt_item_id', $itemId['id'])->where('mt_size_id', $beforeSizeId['id'])->get();
                foreach ($mtStockKeepingUnit as $data) {
                    $data->mt_size_id = $afterSizeId['id'];
                    $data->save();
                }

                $mItemChangeHistory = new MtItemChangeHistory();
                $mItemChangeHistory->mt_item_id = $itemId['id'];
                $mItemChangeHistory->mt_user_id = Auth::user()->id;
                $mItemChangeHistory->change_datetime = Carbon::now();
                $mItemChangeHistory->def_item_change_history_thing_id = "0041";
                $mItemChangeHistory->change_before = $beforeSizeCode;
                $mItemChangeHistory->change_after = $afterSizeCode;
                $mItemChangeHistory->mt_user_last_update_id  = Auth::user()->id;
                $mItemChangeHistory->save();
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
     * 商品リスト ファイルインポート登録
     * @param $params
     * @param $mode 0:新規/1:修正
     * @param $target 0:品番/1:SKU
     * @return Object
     */
    public function importUpdate($params, $mode, $target, $janMode)
    {
        $def_item_change_history_things = DefItemChangeHistoryThing::all();
        $result = array();
        try {
            DB::beginTransaction();
            // 商品マスタ, メンバーサイト商品マスタ, SKUマスタ, 商品変更履歴マスタ
            // 商品(target=0)の場合　新規・修正ともにあり
            if ($target === '0') {
                // 新規
                if ($mode === '0') {
                    foreach ($params as $param) {
                        foreach ($param as $rec) {
                            //商品マスタ　新規登録
                            $mtItemExists = MtItem::where('item_cd', $rec['商品コード'])->exists();
                            if ($mtItemExists) {
                                DB::rollback();
                                $result['status'] = CommonConsts::STATUS_ERROR;
                                $result['error'] = "商品コード{$rec['商品コード']}が既に登録されています。";
                                Log::info($result);
                                return $result;
                            }
                            //登録
                            $mtItem = new MtItem();
                            $mtItem->item_cd = $rec['商品コード'];
                            if (!empty($rec['仕入先コード'])) {
                                $supplier = MtSupplier::where('supplier_cd', $rec['仕入先コード'])->first();
                                $mtItem->mt_supplier_id = $supplier['id'];
                            }

                            if (isset($rec['商品名'])) $mtItem->item_name = $rec['商品名'];
                            if (isset($rec['他品番'])) $mtItem->other_part_number = $rec['他品番'];
                            if (isset($rec['名カナ'])) $mtItem->item_name_kana = $rec['名カナ'];
                            if (isset($rec['単位名'])) $mtItem->unit = $rec['単位名'];
                            if (!empty($rec['ブランド1コード'])) {
                                $mtItemClass1 = MtItemClass::where('def_item_class_thing_id', '1')->where('item_class_cd', $rec['ブランド1コード'])->first();
                                $mtItem->mt_item_class1_id = $mtItemClass1['id'];
                            }
                            if (!isset($rec['競技・カテゴリコード'])) {
                                $mtItemClass2 = MtItemClass::where('def_item_class_thing_id', '2')->where('item_class_cd', $rec['競技・カテゴリコード'])->first();
                                $mtItem->mt_item_class2_id = empty($mtItemClass2) ? null :  $mtItemClass2['id'];
                            }
                            if (!isset($rec['ジャンルコード'])) {
                                $mtItemClass3 = MtItemClass::where('def_item_class_thing_id', '3')->where('item_class_cd', $rec['ジャンルコード'])->first();
                                $mtItem->mt_item_class3_id = empty($mtItemClass3) ? null : $mtItemClass3['id'];
                            }
                            if (!empty($rec['販売開始年コード'])) {
                                $mtItemClass4 = MtItemClass::where('def_item_class_thing_id', '4')->where('item_class_cd', $rec['販売開始年コード'])->first();
                                $mtItem->mt_item_class4_id = empty($mtItemClass4) ? null : $mtItemClass4['id'];
                            }
                            if (!empty($rec['工場分類5コード'])) {
                                $mtItemClass5 = MtItemClass::where('def_item_class_thing_id', '5')->where('item_class_cd', $rec['工場分類5コード'])->first();
                                $mtItem->mt_item_class5_id = $mtItemClass5['id'];
                            }
                            if (!empty($rec['製品/工賃6コード'])) {
                                $mtItemClass6 = MtItemClass::where('def_item_class_thing_id', '6')->where('item_class_cd', $rec['製品/工賃6コード'])->first();
                                $mtItem->mt_item_class6_id = empty($mtItemClass6) ? null : $mtItemClass6['id'];
                            }
                            if (!empty($rec['資産在庫JAコード'])) {
                                $mtItemClass7 = MtItemClass::where('def_item_class_thing_id', '7')->where('item_class_cd', $rec['資産在庫JAコード'])->first();
                                $mtItem->mt_item_class7_id = empty($mtItemClass7) ? null : $mtItemClass7['id'];
                            }

                            if (!empty($rec['商品区分'])) $mtItem->item_kbn = $rec['商品区分'];
                            if (!empty($rec['在庫管理区分'])) $mtItem->stock_management_kbn = $rec['在庫管理区分'];
                            if (!empty($rec['非課税区分'])) $mtItem->non_tax_kbn = $rec['非課税区分'];
                            if (!empty($rec['税率区分'])) {
                                $defTaxRateKbn = DefTaxRateKbn::where('tax_rate_kbn_cd', $rec['税率区分'])->first();
                                if (!empty($defTaxRateKbn)) $mtItem->def_tax_rate_kbns_id = $defTaxRateKbn['id']; //税率区分定義ＩＤ
                            }
                            if (!empty($rec['税抜上代単価'])) $mtItem->retail_price_tax_out = $rec['税抜上代単価'];
                            if (!empty($rec['税込上代単価'])) $mtItem->retail_price_tax_in = $rec['税込上代単価'];
                            if (!empty($rec['税抜参考上代単価'])) $mtItem->reference_retail_tax_out = $rec['税抜参考上代単価'];
                            if (!empty($rec['税込参考上代単価'])) $mtItem->reference_retail_tax_in = $rec['税込参考上代単価'];
                            if (!empty($rec['税抜仕入単価'])) $mtItem->purchase_price_tax_out = $rec['税抜仕入単価'];
                            if (!empty($rec['税込仕入単価'])) $mtItem->purchase_price_tax_in = $rec['税込仕入単価'];
                            if (!empty($rec['原価単価'])) $mtItem->cost_price = $rec['原価単価'];
                            if (!empty($rec['粗利算出用原価単価'])) $mtItem->profit_calculation_cost_price = $rec['粗利算出用原価単価'];
                            if (!empty($rec['名称入力区分'])) $mtItem->name_input_kbn = $rec['名称入力区分'];
                            if (!empty($rec['削除区分'])) $mtItem->del_kbn = $rec['削除区分'];
                            if (!empty($rec['メンバーサイト連携区分'])) $mtItem->ec_alignment_kbn = $rec['メンバーサイト連携区分'];
                            $mtItem->mt_user_last_update_id = Auth::user()->id;
                            $mtItem->save();

                            //メンバーサイト商品マスタ 登録・更新
                            if (!empty($rec['メンバーサイト商品コード'])) {
                                $MemberSiteItemIsNew = 1;
                                $mtMemberSiteItemExists = MtMemberSiteItem::where('ec_item_cd', $rec['メンバーサイト商品コード'])->exists();
                                if ($mtMemberSiteItemExists) {
                                    $mtMemberSiteItem = MtMemberSiteItem::where('ec_item_cd', $rec['メンバーサイト商品コード'])->first();
                                    $MemberSiteItemIsNew = 0;
                                } else {
                                    $mtMemberSiteItem = new MtMemberSiteItem();
                                    $mtMemberSiteItem->ec_item_cd = $rec['メンバーサイト商品コード'];
                                }
                                $mtMemberSiteItem->ec_item_name = $rec['メンバーサイト商品名'];

                                if (!isset($rec['商品備考1'])) $mtMemberSiteItem->item_memo_1 = $rec['商品備考1'];
                                if (!isset($rec['商品備考2'])) $mtMemberSiteItem->item_memo_2 = $rec['商品備考2'];
                                if (!isset($rec['商品備考3'])) $mtMemberSiteItem->item_memo_3 = $rec['商品備考3'];
                                if (!isset($rec['商品備考4'])) $mtMemberSiteItem->item_memo_4 = $rec['商品備考4'];
                                if (!isset($rec['商品備考5'])) $mtMemberSiteItem->item_memo_5 = $rec['商品備考5'];
                                $mtMemberSiteItem->mt_user_last_update_id = Auth::user()->id;
                                $originalMtMemberSiteItems = $mtMemberSiteItem->getOriginal();
                                $mtMemberSiteItem->save();
                                if ($MemberSiteItemIsNew == 0) {
                                    $changeMtMemberSiteItems = $mtMemberSiteItem->getChanges();
                                    // 商品変更履歴マスタ（メンバーサイト商品マスタ項目の変更分）
                                    $this->updateItemChangeHistory($mtItem['id'], $originalMtMemberSiteItems, $changeMtMemberSiteItems, $def_item_change_history_things);
                                }
                                $mtItem->mt_member_site_item_id = $mtMemberSiteItem->id;
                                $mtItem->save();
                            }

                            //SKUマスタ 登録・更新
                            $colors = array();
                            $sizes = array();

                            if (!empty($rec['カラーコード1'])) {
                                $colors[] = $rec['カラーコード1'];
                            }
                            if (!empty($rec['カラーコード2'])) {
                                $colors[] = $rec['カラーコード2'];
                            }
                            if (!empty($rec['カラーコード3'])) {
                                $colors[] = $rec['カラーコード3'];
                            }
                            if (!empty($rec['カラーコード4'])) {
                                $colors[] = $rec['カラーコード4'];
                            }
                            if (!empty($rec['カラーコード5'])) {
                                $colors[] = $rec['カラーコード5'];
                            }
                            if (!empty($rec['カラーコード6'])) {
                                $colors[] = $rec['カラーコード6'];
                            }
                            if (!empty($rec['カラーコード7'])) {
                                $colors[] = $rec['カラーコード7'];
                            }
                            if (!empty($rec['カラーコード8'])) {
                                $colors[] = $rec['カラーコード8'];
                            }
                            if (!empty($rec['カラーコード9'])) {
                                $colors[] = $rec['カラーコード9'];
                            }
                            if (!empty($rec['カラーコード10'])) {
                                $colors[] = $rec['カラーコード10'];
                            }
                            if (!empty($rec['カラーコード11'])) {
                                $colors[] = $rec['カラーコード11'];
                            }
                            if (!empty($rec['カラーコード12'])) {
                                $colors[] = $rec['カラーコード12'];
                            }
                            if (!empty($rec['カラーコード13'])) {
                                $colors[] = $rec['カラーコード13'];
                            }
                            if (!empty($rec['カラーコード14'])) {
                                $colors[] = $rec['カラーコード14'];
                            }
                            if (!empty($rec['カラーコード15'])) {
                                $colors[] = $rec['カラーコード15'];
                            }
                            if (!empty($rec['カラーコード16'])) {
                                $colors[] = $rec['カラーコード16'];
                            }
                            if (!empty($rec['カラーコード17'])) {
                                $colors[] = $rec['カラーコード17'];
                            }
                            if (!empty($rec['カラーコード18'])) {
                                $colors[] = $rec['カラーコード18'];
                            }
                            if (!empty($rec['カラーコード19'])) {
                                $colors[] = $rec['カラーコード19'];
                            }
                            if (!empty($rec['カラーコード20'])) {
                                $colors[] = $rec['カラーコード20'];
                            }

                            if (!empty($rec['サイズコード1'])) {
                                $sizes[] = $rec['サイズコード1'];
                            }
                            if (!empty($rec['サイズコード2'])) {
                                $sizes[] = $rec['サイズコード2'];
                            }
                            if (!empty($rec['サイズコード3'])) {
                                $sizes[] = $rec['サイズコード3'];
                            }
                            if (!empty($rec['サイズコード4'])) {
                                $sizes[] = $rec['サイズコード4'];
                            }
                            if (!empty($rec['サイズコード5'])) {
                                $sizes[] = $rec['サイズコード5'];
                            }
                            if (!empty($rec['サイズコード6'])) {
                                $sizes[] = $rec['サイズコード6'];
                            }
                            if (!empty($rec['サイズコード7'])) {
                                $sizes[] = $rec['サイズコード7'];
                            }
                            if (!empty($rec['サイズコード8'])) {
                                $sizes[] = $rec['サイズコード8'];
                            }
                            if (!empty($rec['サイズコード9'])) {
                                $sizes[] = $rec['サイズコード9'];
                            }
                            if (!empty($rec['サイズコード10'])) {
                                $sizes[] = $rec['サイズコード10'];
                            }
                            foreach ($colors as $color) {
                                if (!empty($color)) {
                                    $mtColor = MtColor::where('color_cd', $color)->first();
                                    foreach ($sizes as $size) {
                                        if (!empty($size)) {
                                            $mtSize = MtSize::where('size_cd', $size)->first();
                                            if (empty($mtColor) || empty($mtSize)) {
                                                continue;
                                            }

                                            $mtStockKeepingUnitExists = MtStockKeepingUnit::where('mt_item_id', $mtItem['id'])->where('mt_color_id', $mtColor['id'])->where('mt_size_id', $mtSize['id'])->exists();
                                            if ($mtStockKeepingUnitExists) {
                                                $mtStockKeepingUnit = MtStockKeepingUnit::where('mt_item_id', $mtItem['id'])->where('mt_color_id', $mtColor['id'])->where('mt_size_id', $mtSize['id'])->first();
                                            } else {
                                                $mtStockKeepingUnit = new MtStockKeepingUnit();
                                                $mtStockKeepingUnit->mt_item_id = $mtItem['id'];
                                                $mtStockKeepingUnit->mt_color_id = $mtColor['id'];
                                                $mtStockKeepingUnit->mt_size_id = $mtSize['id'];
                                                $mtStockKeepingUnit->hidden_flg = 0;
                                                $mtStockKeepingUnit->mt_user_last_update_id = Auth::user()->id;
                                                $mtStockKeepingUnit->save();
                                            }
                                        }
                                    }
                                }
                            }

                            //商品変更履歴マスタ　新規登録
                            $mtItemChangeHistory = new MtItemChangeHistory();
                            $mtItemChangeHistory->mt_item_id = $mtItem['id'];
                            $mtItemChangeHistory->mt_user_id = Auth::user()->id;
                            $mtItemChangeHistory->change_datetime = Carbon::now();
                            $mtItemChangeHistory->def_item_change_history_thing_id = 1;
                            $mtItemChangeHistory->mt_user_last_update_id = Auth::user()->id;
                            $mtItemChangeHistory->save();
                        }
                    }
                    // 更新
                } elseif ($mode === '1') {
                    Log::info($params);
                    foreach ($params as $param) {
                        foreach ($param as $rec) {
                            //商品マスタ　更新
                            $mtItemExists = MtItem::where('item_cd', $rec['商品コード'])->exists();
                            if (!$mtItemExists) {
                                DB::rollback();
                                $result['status'] = CommonConsts::STATUS_ERROR;
                                $result['error'] = '商品コードが登録されていません。';
                                Log::info($result);
                                return $result;
                            }
                            $mtItem = MtItem::where('item_cd', $rec['商品コード'])->first();
                            //更新
                            $supplier = MtSupplier::where('supplier_cd', $rec['仕入先コード'])->first();
                            $mtItem->mt_supplier_id = $supplier['id'];
                            if (isset($rec['商品名'])) $mtItem->item_name = $rec['商品名'];
                            if (isset($rec['他品番'])) $mtItem->other_part_number = $rec['他品番'];
                            if (isset($rec['名カナ'])) $mtItem->item_name_kana = $rec['名カナ'];
                            if (isset($rec['単位名'])) $mtItem->unit = $rec['単位名'];
                            if (!empty($rec['ブランド1コード'])) {
                                $mtItemClass1 = MtItemClass::where('def_item_class_thing_id', '1')->where('item_class_cd', $rec['ブランド1コード'])->first();
                                $mtItem->mt_item_class1_id = $mtItemClass1['id'];
                            }
                            if (isset($rec['競技・カテゴリコード'])) {
                                if (empty($rec['競技・カテゴリコード'])) {
                                    $mtItem->mt_item_class2_id = null;
                                } else {
                                    $mtItemClass2 = MtItemClass::where('def_item_class_thing_id', '2')->where('item_class_cd', $rec['競技・カテゴリコード'])->first();
                                    $mtItem->mt_item_class2_id = empty($mtItemClass2) ? null : $mtItemClass2['id'];
                                }
                            }
                            if (isset($rec['ジャンルコード'])) {
                                if (empty($rec['ジャンルコード'])) {
                                    $mtItem->mt_item_class3_id = null;
                                } else {
                                    $mtItemClass3 = MtItemClass::where('def_item_class_thing_id', '3')->where('item_class_cd', $rec['ジャンルコード'])->first();
                                    $mtItem->mt_item_class3_id = empty($mtItemClass3) ? null : $mtItemClass3['id'];
                                }
                            }
                            if (isset($rec['販売開始年コード'])) {
                                if (empty($rec['販売開始年コード'])) {
                                    $mtItem->mt_item_class4_id = null;
                                } else {
                                    $mtItemClass4 = MtItemClass::where('def_item_class_thing_id', '4')->where('item_class_cd', $rec['販売開始年コード'])->first();
                                    $mtItem->mt_item_class4_id = empty($mtItemClass4) ? null : $mtItemClass4['id'];
                                }
                            }
                            if (isset($rec['工場分類5コード'])) {
                                if (empty($rec['工場分類5コード'])) {
                                    $mtItem->mt_item_class5_id = null;
                                } else {
                                    $mtItemClass5 = MtItemClass::where('def_item_class_thing_id', '5')->where('item_class_cd', $rec['工場分類5コード'])->first();
                                    $mtItem->mt_item_class5_id = $mtItemClass5['id'];
                                }
                            }
                            if (isset($rec['製品/工賃6コード'])) {
                                if (empty($rec['製品/工賃6コード'])) {
                                    $mtItem->mt_item_class6_id = null;
                                } else {
                                    $mtItemClass6 = MtItemClass::where('def_item_class_thing_id', '6')->where('item_class_cd', $rec['製品/工賃6コード'])->first();
                                    $mtItem->mt_item_class6_id = empty($mtItemClass6) ? null : $mtItemClass6['id'];
                                }
                            }
                            if (isset($rec['資産在庫JAコード'])) {
                                if (empty($rec['資産在庫JAコード'])) {
                                    $mtItem->mt_item_class7_id = null;
                                } else {
                                    $mtItemClass7 = MtItemClass::where('def_item_class_thing_id', '7')->where('item_class_cd', $rec['資産在庫JAコード'])->first();
                                    $mtItem->mt_item_class7_id = empty($mtItemClass7) ? null : $mtItemClass7['id'];
                                }
                            }

                            if (!empty($rec['商品区分'])) $mtItem->item_kbn = $rec['商品区分'];
                            if (!empty($rec['在庫管理区分'])) $mtItem->stock_management_kbn = $rec['在庫管理区分'];
                            if (!empty($rec['非課税区分'])) $mtItem->non_tax_kbn = $rec['非課税区分'];
                            if (!empty($rec['税率区分'])) {
                                $defTaxRateKbn = DefTaxRateKbn::where('tax_rate_kbn_cd', $rec['税率区分'])->first();
                                if (!empty($defTaxRateKbn)) $mtItem->def_tax_rate_kbns_id = $defTaxRateKbn['id']; //税率区分定義ＩＤ
                            }
                            if (!empty($rec['税抜上代単価'])) $mtItem->retail_price_tax_out = $rec['税抜上代単価'];
                            if (!empty($rec['税込上代単価'])) $mtItem->retail_price_tax_in = $rec['税込上代単価'];
                            if (!empty($rec['税抜参考上代単価'])) $mtItem->reference_retail_tax_out = $rec['税抜参考上代単価'];
                            if (!empty($rec['税込参考上代単価'])) $mtItem->reference_retail_tax_in = $rec['税込参考上代単価'];
                            if (!empty($rec['税抜仕入単価'])) $mtItem->purchase_price_tax_out = $rec['税抜仕入単価'];
                            if (!empty($rec['税込仕入単価'])) $mtItem->purchase_price_tax_in = $rec['税込仕入単価'];
                            if (!empty($rec['原価単価'])) $mtItem->cost_price = $rec['原価単価'];
                            if (!empty($rec['粗利算出用原価単価'])) $mtItem->profit_calculation_cost_price = $rec['粗利算出用原価単価'];
                            if (!empty($rec['名称入力区分'])) $mtItem->name_input_kbn = $rec['名称入力区分'];
                            if (!empty($rec['削除区分'])) $mtItem->del_kbn = $rec['削除区分'];
                            if (!empty($rec['メンバーサイト連携区分'])) $mtItem->ec_alignment_kbn = $rec['メンバーサイト連携区分'];
                            $mtItem->mt_user_last_update_id = Auth::user()->id;
                            $originalMtItems = $mtItem->getOriginal();
                            $mtItem->save();

                            //メンバーサイト商品マスタ 登録・更新
                            if (!empty($rec['メンバーサイト商品コード'])) {
                                $MemberSiteItemIsNew = 1;
                                $mtMemberSiteItemExists = MtMemberSiteItem::where('ec_item_cd', $rec['メンバーサイト商品コード'])->exists();
                                if ($mtMemberSiteItemExists) {
                                    $mtMemberSiteItem = MtMemberSiteItem::where('ec_item_cd', $rec['メンバーサイト商品コード'])->first();
                                    $MemberSiteItemIsNew = 0;
                                } else {
                                    $mtMemberSiteItem = new MtMemberSiteItem();
                                    $mtMemberSiteItem->ec_item_cd = $rec['メンバーサイト商品コード'];
                                }
                                $mtMemberSiteItem->ec_item_name = $rec['メンバーサイト商品名'];

                                if (!isset($rec['商品備考1'])) $mtMemberSiteItem->item_memo_1 = $rec['商品備考1'];
                                if (!isset($rec['商品備考2'])) $mtMemberSiteItem->item_memo_2 = $rec['商品備考2'];
                                if (!isset($rec['商品備考3'])) $mtMemberSiteItem->item_memo_3 = $rec['商品備考3'];
                                if (!isset($rec['商品備考4'])) $mtMemberSiteItem->item_memo_4 = $rec['商品備考4'];
                                if (!isset($rec['商品備考5'])) $mtMemberSiteItem->item_memo_5 = $rec['商品備考5'];
                                $mtMemberSiteItem->mt_user_last_update_id = Auth::user()->id;
                                $originalMtMemberSiteItems = $mtMemberSiteItem->getOriginal();
                                $mtMemberSiteItem->save();

                                $mtItem->mt_member_site_item_id = $mtMemberSiteItem->id;
                                $mtItem->save();
                            }
                            //SKUマスタ 登録・更新
                            $colors = array();
                            $sizes = array();

                            if (!empty($rec['カラーコード1'])) {
                                $colors[] = $rec['カラーコード1'];
                            }
                            if (!empty($rec['カラーコード2'])) {
                                $colors[] = $rec['カラーコード2'];
                            }
                            if (!empty($rec['カラーコード3'])) {
                                $colors[] = $rec['カラーコード3'];
                            }
                            if (!empty($rec['カラーコード4'])) {
                                $colors[] = $rec['カラーコード4'];
                            }
                            if (!empty($rec['カラーコード5'])) {
                                $colors[] = $rec['カラーコード5'];
                            }
                            if (!empty($rec['カラーコード6'])) {
                                $colors[] = $rec['カラーコード6'];
                            }
                            if (!empty($rec['カラーコード7'])) {
                                $colors[] = $rec['カラーコード7'];
                            }
                            if (!empty($rec['カラーコード8'])) {
                                $colors[] = $rec['カラーコード8'];
                            }
                            if (!empty($rec['カラーコード9'])) {
                                $colors[] = $rec['カラーコード9'];
                            }
                            if (!empty($rec['カラーコード10'])) {
                                $colors[] = $rec['カラーコード10'];
                            }
                            if (!empty($rec['カラーコード11'])) {
                                $colors[] = $rec['カラーコード11'];
                            }
                            if (!empty($rec['カラーコード12'])) {
                                $colors[] = $rec['カラーコード12'];
                            }
                            if (!empty($rec['カラーコード13'])) {
                                $colors[] = $rec['カラーコード13'];
                            }
                            if (!empty($rec['カラーコード14'])) {
                                $colors[] = $rec['カラーコード14'];
                            }
                            if (!empty($rec['カラーコード15'])) {
                                $colors[] = $rec['カラーコード15'];
                            }
                            if (!empty($rec['カラーコード16'])) {
                                $colors[] = $rec['カラーコード16'];
                            }
                            if (!empty($rec['カラーコード17'])) {
                                $colors[] = $rec['カラーコード17'];
                            }
                            if (!empty($rec['カラーコード18'])) {
                                $colors[] = $rec['カラーコード18'];
                            }
                            if (!empty($rec['カラーコード19'])) {
                                $colors[] = $rec['カラーコード19'];
                            }
                            if (!empty($rec['カラーコード20'])) {
                                $colors[] = $rec['カラーコード20'];
                            }

                            if (!empty($rec['サイズコード1'])) {
                                $sizes[] = $rec['サイズコード1'];
                            }
                            if (!empty($rec['サイズコード2'])) {
                                $sizes[] = $rec['サイズコード2'];
                            }
                            if (!empty($rec['サイズコード3'])) {
                                $sizes[] = $rec['サイズコード3'];
                            }
                            if (!empty($rec['サイズコード4'])) {
                                $sizes[] = $rec['サイズコード4'];
                            }
                            if (!empty($rec['サイズコード5'])) {
                                $sizes[] = $rec['サイズコード5'];
                            }
                            if (!empty($rec['サイズコード6'])) {
                                $sizes[] = $rec['サイズコード6'];
                            }
                            if (!empty($rec['サイズコード7'])) {
                                $sizes[] = $rec['サイズコード7'];
                            }
                            if (!empty($rec['サイズコード8'])) {
                                $sizes[] = $rec['サイズコード8'];
                            }
                            if (!empty($rec['サイズコード9'])) {
                                $sizes[] = $rec['サイズコード9'];
                            }
                            if (!empty($rec['サイズコード10'])) {
                                $sizes[] = $rec['サイズコード10'];
                            }

                            $updateIds = [];
                            $newColorCode = [];
                            $newSiseCode = [];

                            foreach ($colors as $color) {
                                if (!empty($color)) {
                                    $mtColor = MtColor::where('color_cd', $color)->first();
                                    if (empty($mtColor)) {
                                        continue;
                                    }
                                    // 変更履歴用に新しいぁラーコードの追加有無チェック
                                    $mtStockKeepingUnitColorExists = MtStockKeepingUnit::where('mt_item_id', $mtItem['id'])->where('mt_color_id', $mtColor['id'])->exists();
                                    if (!$mtStockKeepingUnitColorExists && !in_array($color, $newSiseCode)) {
                                        array_push($newColorCode, $color);
                                    }

                                    foreach ($sizes as $size) {
                                        if (!empty($size)) {
                                            $mtSize = MtSize::where('size_cd', $size)->first();

                                            // 変更履歴用に新しいサイズコードの追加有無チェック
                                            $mtStockKeepingUnitSizeExists = MtStockKeepingUnit::where('mt_item_id', $mtItem['id'])->where('mt_size_id', $mtSize['id'])->exists();
                                            if (!$mtStockKeepingUnitSizeExists && !in_array($size, $newSiseCode)) {
                                                array_push($newSiseCode, $size);
                                            }
                                            if (empty($mtSize)) {
                                                continue;
                                            }
                                            $mtStockKeepingUnitExists = MtStockKeepingUnit::where('mt_item_id', $mtItem['id'])->where('mt_color_id', $mtColor['id'])->where('mt_size_id', $mtSize['id'])->exists();
                                            if ($mtStockKeepingUnitExists) {
                                                $mtStockKeepingUnit = MtStockKeepingUnit::where('mt_item_id', $mtItem['id'])->where('mt_color_id', $mtColor['id'])->where('mt_size_id', $mtSize['id'])->first();
                                            } else {
                                                $mtStockKeepingUnit = new MtStockKeepingUnit();
                                                $mtStockKeepingUnit->mt_item_id = $mtItem['id'];
                                                $mtStockKeepingUnit->mt_color_id = $mtColor['id'];
                                                $mtStockKeepingUnit->mt_size_id = $mtSize['id'];
                                                $mtStockKeepingUnit->hidden_flg = 0;
                                                $mtStockKeepingUnit->mt_user_last_update_id = Auth::user()->id;
                                                $originalMtStockKeepingUnits = $mtStockKeepingUnit->getOriginal();
                                                $mtStockKeepingUnit->save();
                                                $changeMtStockKeepingUnits = $mtStockKeepingUnit->getChanges();
                                                // 商品変更履歴マスタ（商品マスタ項目の変更分）
                                                $this->updateItemChangeHistory($mtItem['id'], $originalMtStockKeepingUnits, $changeMtStockKeepingUnits, $def_item_change_history_things);
                                            }
                                            array_push($updateIds, $mtStockKeepingUnit->id);
                                        }
                                    }
                                }
                            }
                            // !!!!!!!!!!!!!1 既存SKUデータの削除は行わない
                            // // input に含まれていないSKUは削除
                            // try {
                            //     MtStockKeepingUnit::where('mt_item_id', $mtItem['id'])->whereNotIn('id', $updateIds)->delete();
                            // } catch (\Exception $e) {
                            //     report($e);
                            //     $result['error'] = "外部参照されているSKUは削除できません。";
                            // }
                            //商品変更履歴マスタ 新規カラーコード
                            foreach ($newColorCode as $colorCd) {
                                $mtItemChangeHistory = new MtItemChangeHistory();
                                $mtItemChangeHistory->mt_item_id = $mtItem['id'];
                                $mtItemChangeHistory->mt_user_id = Auth::user()->id;
                                $mtItemChangeHistory->change_datetime = Carbon::now();
                                $mtItemChangeHistory->def_item_change_history_thing_id = 28;
                                $mtItemChangeHistory->mt_user_last_update_id = Auth::user()->id;
                                $mtItemChangeHistory->change_before = "";
                                $mtItemChangeHistory->change_after = $colorCd;
                                $mtItemChangeHistory->save();
                            }

                            //商品変更履歴マスタ 新規サイズコード
                            foreach ($newSiseCode as $sizeCd) {
                                $mtItemChangeHistory = new MtItemChangeHistory();
                                $mtItemChangeHistory->mt_item_id = $mtItem['id'];
                                $mtItemChangeHistory->mt_user_id = Auth::user()->id;
                                $mtItemChangeHistory->change_datetime = Carbon::now();
                                $mtItemChangeHistory->def_item_change_history_thing_id = 29;
                                $mtItemChangeHistory->mt_user_last_update_id = Auth::user()->id;
                                $mtItemChangeHistory->change_before = "";
                                $mtItemChangeHistory->change_after = $sizeCd;
                                $mtItemChangeHistory->save();
                            }
                            //商品変更履歴マスタ 更新時
                            $changeMtItems = $mtItem->getChanges();
                            // 商品変更履歴マスタ（商品マスタ項目の変更分）
                            $this->updateItemChangeHistory($mtItem['id'], $originalMtItems, $changeMtItems, $def_item_change_history_things);
                            // 商品変更履歴マスタ（メンバーサイト商品マスタ項目の変更分）
                            if ($MemberSiteItemIsNew == 0) {
                                $changeMtMemberSiteItems = $mtMemberSiteItem->getChanges();
                                // 商品変更履歴マスタ（メンバーサイト商品マスタ項目の変更分）
                                $this->updateItemChangeHistory($mtItem['id'], $originalMtMemberSiteItems, $changeMtMemberSiteItems, $def_item_change_history_things);
                            }
                        }
                    }
                }

                // SKU(target=1)の場合 新規のみ
            } elseif ($target === '1') {
                // 新規
                // Log::info($params);
                if ($mode === '0') {
                    foreach ($params as $param) {
                        foreach ($param as $rec) {
                            //商品マスタ　新規登録
                            $mtItemExists = MtItem::where('item_cd', $rec['商品コード'])->exists();
                            if ($mtItemExists) {
                                // DB::rollback();
                                // $result['status'] = CommonConsts::STATUS_ERROR;
                                // $result['error'] = "商品コード{$rec['商品コード']}が既に登録されています。";
                                // Log::info($result);
                                // return $result;
                                $mtItem = MtItem::where('item_cd', $rec['商品コード'])->first();
                            } else {
                                $mtItem = new MtItem();
                                $mtItem->item_cd = $rec['商品コード'];
                            }

                            if (!empty($rec['仕入先コード'])) {
                                $supplier = MtSupplier::where('supplier_cd', $rec['仕入先コード'])->first();
                                $mtItem->mt_supplier_id = $supplier['id'];
                            }

                            if (isset($rec['商品名'])) $mtItem->item_name = $rec['商品名'];
                            if (isset($rec['他品番'])) $mtItem->other_part_number = $rec['他品番'];
                            if (isset($rec['名カナ'])) $mtItem->item_name_kana = $rec['名カナ'];
                            if (isset($rec['単位名'])) $mtItem->unit = $rec['単位名'];

                            if (!empty($rec['ブランド1コード'])) {
                                $mtItemClass1 = MtItemClass::where('def_item_class_thing_id', '1')->where('item_class_cd', $rec['ブランド1コード'])->first();
                                $mtItem->mt_item_class1_id = $mtItemClass1['id'];
                            }
                            if (isset($rec['競技・カテゴリコード'])) {
                                if (empty($rec['競技・カテゴリコード'])) {
                                    $mtItem->mt_item_class2_id = null;
                                } else {
                                    $mtItemClass2 = MtItemClass::where('def_item_class_thing_id', '2')->where('item_class_cd', $rec['競技・カテゴリコード'])->first();
                                    $mtItem->mt_item_class2_id = empty($mtItemClass2) ? null : $mtItemClass2['id'];
                                }
                            }
                            if (isset($rec['ジャンルコード'])) {
                                if (empty($rec['ジャンルコード'])) {
                                    $mtItem->mt_item_class3_id = null;
                                } else {
                                    $mtItemClass3 = MtItemClass::where('def_item_class_thing_id', '3')->where('item_class_cd', $rec['ジャンルコード'])->first();
                                    $mtItem->mt_item_class3_id = empty($mtItemClass3) ? null : $mtItemClass3['id'];
                                }
                            }
                            if (isset($rec['販売開始年コード'])) {
                                if (empty($rec['販売開始年コード'])) {
                                    $mtItem->mt_item_class4_id = null;
                                } else {
                                    $mtItemClass4 = MtItemClass::where('def_item_class_thing_id', '4')->where('item_class_cd', $rec['販売開始年コード'])->first();
                                    $mtItem->mt_item_class4_id = empty($mtItemClass4) ? null : $mtItemClass4['id'];
                                }
                            }
                            if (isset($rec['工場分類5コード'])) {
                                if (empty($rec['工場分類5コード'])) {
                                    $mtItem->mt_item_class5_id = null;
                                } else {
                                    $mtItemClass5 = MtItemClass::where('def_item_class_thing_id', '5')->where('item_class_cd', $rec['工場分類5コード'])->first();
                                    $mtItem->mt_item_class5_id = $mtItemClass5['id'];
                                }
                            }
                            if (isset($rec['製品/工賃6コード'])) {
                                if (empty($rec['製品/工賃6コード'])) {
                                    $mtItem->mt_item_class6_id = null;
                                } else {
                                    $mtItemClass6 = MtItemClass::where('def_item_class_thing_id', '6')->where('item_class_cd', $rec['製品/工賃6コード'])->first();
                                    $mtItem->mt_item_class6_id = empty($mtItemClass6) ? null : $mtItemClass6['id'];
                                }
                            }
                            if (isset($rec['資産在庫JAコード'])) {
                                if (empty($rec['資産在庫JAコード'])) {
                                    $mtItem->mt_item_class7_id = null;
                                } else {
                                    $mtItemClass7 = MtItemClass::where('def_item_class_thing_id', '7')->where('item_class_cd', $rec['資産在庫JAコード'])->first();
                                    $mtItem->mt_item_class7_id = empty($mtItemClass7) ? null : $mtItemClass7['id'];
                                }
                            }

                            if (!empty($rec['商品区分'])) $mtItem->item_kbn = $rec['商品区分'];
                            if (!empty($rec['在庫管理区分'])) $mtItem->stock_management_kbn = $rec['在庫管理区分'];
                            if (!empty($rec['非課税区分'])) $mtItem->non_tax_kbn = $rec['非課税区分'];
                            if (!empty($rec['税率区分'])) {
                                $defTaxRateKbn = DefTaxRateKbn::where('tax_rate_kbn_cd', $rec['税率区分'])->first();
                                if (!empty($defTaxRateKbn)) $mtItem->def_tax_rate_kbns_id = $defTaxRateKbn['id']; //税率区分定義ＩＤ
                            }
                            if (!empty($rec['税抜上代単価'])) $mtItem->retail_price_tax_out = $rec['税抜上代単価'];
                            if (!empty($rec['税込上代単価'])) $mtItem->retail_price_tax_in = $rec['税込上代単価'];
                            if (!empty($rec['税抜参考上代単価'])) $mtItem->reference_retail_tax_out = $rec['税抜参考上代単価'];
                            if (!empty($rec['税込参考上代単価'])) $mtItem->reference_retail_tax_in = $rec['税込参考上代単価'];
                            if (!empty($rec['税抜仕入単価'])) $mtItem->purchase_price_tax_out = $rec['税抜仕入単価'];
                            if (!empty($rec['税込仕入単価'])) $mtItem->purchase_price_tax_in = $rec['税込仕入単価'];
                            if (!empty($rec['原価単価'])) $mtItem->cost_price = $rec['原価単価'];
                            if (!empty($rec['粗利算出用原価単価'])) $mtItem->profit_calculation_cost_price = $rec['粗利算出用原価単価'];
                            if (!empty($rec['名称入力区分'])) $mtItem->name_input_kbn = $rec['名称入力区分'];
                            if (!empty($rec['削除区分'])) $mtItem->del_kbn = $rec['削除区分'];
                            if (!empty($rec['メンバーサイト連携区分'])) $mtItem->ec_alignment_kbn = $rec['メンバーサイト連携区分'];

                            $mtItem->mt_user_last_update_id = Auth::user()->id;
                            $mtItem->save();

                            //メンバーサイト商品マスタ 登録・更新
                            if (!empty($rec['メンバーサイト商品コード'])) {
                                $mtMemberSiteItemExists = MtMemberSiteItem::where('ec_item_cd', $rec['メンバーサイト商品コード'])->exists();
                                if ($mtMemberSiteItemExists) {
                                    $mtMemberSiteItem = MtMemberSiteItem::where('ec_item_cd', $rec['メンバーサイト商品コード'])->first();
                                } else {
                                    $mtMemberSiteItem = new MtMemberSiteItem();
                                    $mtMemberSiteItem->ec_item_cd = $rec['メンバーサイト商品コード'];
                                }
                                $mtMemberSiteItem->ec_item_name = $rec['メンバーサイト商品名'];

                                if (isset($rec['商品備考1'])) $mtMemberSiteItem->item_memo_1 = $rec['商品備考1'];
                                if (isset($rec['商品備考2'])) $mtMemberSiteItem->item_memo_2 = $rec['商品備考2'];
                                if (isset($rec['商品備考3'])) $mtMemberSiteItem->item_memo_3 = $rec['商品備考3'];
                                if (isset($rec['商品備考4'])) $mtMemberSiteItem->item_memo_4 = $rec['商品備考4'];
                                if (isset($rec['商品備考5'])) $mtMemberSiteItem->item_memo_5 = $rec['商品備考5'];
                                $mtMemberSiteItem->mt_user_last_update_id = Auth::user()->id;
                                $mtMemberSiteItem->save();
                                $mtItem->mt_member_site_item_id = $mtMemberSiteItem->id;
                                $mtItem->save();
                            }
                            $mtColor = MtColor::where('color_cd', $rec['カラーコード'])->first();
                            $mtSize = MtSize::where('size_cd', $rec['サイズコード'])->first();
                            $mtStockKeepingUnitExists = MtStockKeepingUnit::where('mt_item_id', $mtItem['id'])->where('mt_color_id', $mtColor['id'])->where('mt_size_id', $mtSize['id'])->exists();
                            if ($mtStockKeepingUnitExists) {
                                $mtStockKeepingUnit = MtStockKeepingUnit::where('mt_item_id', $mtItem['id'])->where('mt_color_id', $mtColor['id'])->where('mt_size_id', $mtSize['id'])->first();
                            } else {
                                $mtStockKeepingUnit = new MtStockKeepingUnit();
                                $mtStockKeepingUnit->mt_item_id = $mtItem['id'];
                                $mtStockKeepingUnit->mt_color_id = $mtColor['id'];
                                $mtStockKeepingUnit->mt_size_id = $mtSize['id'];
                            }
                            if ($janMode === '0') {  //空白設定
                                $mtStockKeepingUnit->jan_cd = null;
                            } elseif ($janMode === '1') {
                                // if (!empty($rec['JANコード'])) {
                                if (!empty(str_replace(["　", " "], "", $rec['JANコード']))) {
                                    $mtStockKeepingUnit->jan_cd = $rec['JANコード'];
                                } else { //採番
                                    $nextJanCode = $this->getNextJanCode();
                                    $mtSystem = MtSystem::first();
                                    if ($nextJanCode > $mtSystem->end_jan_code) {
                                        $result['customMSG'] = "終了JANコードに到達しました。JANコードを追加してください。";
                                    } else {
                                        $digit = $this->calcJanCodeDigit($nextJanCode);
                                        $mtStockKeepingUnit->jan_cd = strval($nextJanCode) . strval($digit);
                                        $mtSystem->now_jan_code = $nextJanCode;
                                        $mtSystem->save();
                                    }
                                    if ($nextJanCode == $mtSystem->end_jan_code) {
                                        $result['customMSG'] = "終了JANコードに到達しました。JANコードを追加してください。";
                                    }
                                }
                            }
                            $mtStockKeepingUnit->hidden_flg = 0;
                            $mtStockKeepingUnit->mt_user_last_update_id = Auth::user()->id;
                            $mtStockKeepingUnit->save();
                        }
                    }
                }
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
            Log::info("SUCCESS");
            Log::info($result);
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
            Log::info($result);
        }
        return $result;
    }

    /**
     * 商品 名称補完(code指定)
     * @param $code
     * @return Object
     */
    public function getByCode($code)
    {
        $result = MtItem::where('item_cd', $code)->first();
        return $result;
    }

    /**
     * 商品 名称補完(code指定)
     * @param $code
     * @return Object
     */
    public function getByCodeWithSKU($code)
    {
        $mtItem = MtItem::where('item_cd', $code)->first();

        $mtSKU = MtStockKeepingUnit::select(
            'mt_stock_keeping_units.mt_item_id as item_id',
            'mt_colors.id as color_id',
            'mt_colors.color_cd as color_cd',
            'mt_colors.color_name as color_name',
            'mt_sizes.id as size_id',
            'mt_sizes.size_cd as size_cd',
            'mt_sizes.size_name as size_name',
        )->leftJoin('mt_colors', 'mt_stock_keeping_units.mt_color_id', 'mt_colors.id')
            ->leftJoin('mt_sizes', 'mt_stock_keeping_units.mt_size_id', 'mt_sizes.id')
            ->where('mt_item_id', $mtItem['id'])->get();

        $mtColors = $mtSKU->pluck("color_name", "color_cd")->sort();
        $mtSizes = $mtSKU->pluck("size_name", "size_cd")->sort();
        $result['item'] = $mtItem;
        $result['colors'] = $mtColors;
        $result['sizes'] = $mtSizes;
        return $result;
    }

    // janコードのチェックディジット計算
    public function calcJanCodeDigit($num)
    {
        $arr = str_split($num);
        $odd = 0;
        $mod = 0;
        for ($i = 0; $i < count($arr); $i++) {
            if (($i + 1) % 2 == 0) {
                //偶数の総和
                $mod += intval($arr[$i]);
            } else {
                //奇数の総和
                $odd += intval($arr[$i]);
            }
        }
        //偶数の和を3倍+奇数の総和を加算して、下1桁の数字を10から引く
        $cd = 10 - intval(substr((string)($mod * 3) + $odd, -1));
        //10なら1の位は0なので、0を返す。
        return $cd === 10 ? 0 : $cd;
    }

    private function updateItemChangeHistory($mtItemId, $originalData, $changesData, $def_item_change_history_things)
    {
        foreach ($changesData as $key => $value) {
            // 更新履歴に残したくないキーはスキップ
            if (in_array($key, ['updated_at'], true)) {
                continue;
            }

            $thing_cd = $this->getItemChangeHistoryThingCd($key);
            if (null == $thing_cd) {
                continue;
            }
            $afterData = $this->getDataForHistory($key, $value);
            $beforeData =  $originalData[$key] ? $this->getDataForHistory($key, $originalData[$key]) : null;
            $mtItemChangeHistory = new MtItemChangeHistory();
            $mtItemChangeHistory->mt_item_id = $mtItemId;
            $mtItemChangeHistory->mt_user_id = Auth::user()->id;
            $mtItemChangeHistory->change_datetime = Carbon::now();
            $mtItemChangeHistory->def_item_change_history_thing_id = 1;
            $mtItemChangeHistory->mt_user_last_update_id = Auth::user()->id;
            $mtItemChangeHistory->def_item_change_history_thing_id = $def_item_change_history_things->where('thing_cd', $thing_cd)->first()->id;
            $mtItemChangeHistory->change_before = $beforeData;
            $mtItemChangeHistory->change_after = $afterData;
            $mtItemChangeHistory->save();
        }
    }

    /**
     * 商品変更履歴項目定義 項目コードを取得
     * @param $code
     * @return Object
     */
    private function getItemChangeHistoryThingCd($thing_name)
    {
        $item_change_history_thing_mapping = [
            // 商品マスタ用
            "item_cd" => "0003",
            "mt_supplier_id" => "0004",
            "item_name" => "0005",
            "other_part_number" => "0006",
            "item_name_kana" => "0007",
            "unit" => "0008",
            "mt_item_class5_id" => "0009",
            "mt_item_class6_id" => "0010",
            "mt_item_class7_id" => "0011",
            "item_kbn" => "0012",
            "stock_management_kbn" => "0013",
            "non_tax_kbn" => "0014",
            "def_tax_rate_kbns_id" => "0015",
            "retail_price_tax_out" => "0016",
            "retail_price_tax_in" => "0017",
            "reference_retail_tax_out" => "0018",
            "reference_retail_tax_in" => "0019",
            "purchase_price_tax_out" => "0020",
            "purchase_price_tax_in" => "0021",
            "cost_price" => "0022",
            "profit_calculation_cost_price" => "0023",
            "name_input_kbn" => "0024",
            "del_kbn" => "0025",
            "ec_alignment_kbn" => "0026",
            "japan_post_office" => "0027",
            "mt_member_site_item_id" => "0030",
            "mt_item_class1_id" => "0034",
            "mt_item_class2_id" => "0035",
            "mt_item_class3_id" => "0036",
            "mt_item_class4_id" => "0037",
            // メンバーサイト商品マスタ用
            "ec_item_name" => "0031",
            "ranking" => "0032",
            "printed_products_flg" => "0033",
            "item_image_file_1" => "0038",
            "item_image_file_2" => "0039",
            "item_image_file_3" => "0040",
            "item_image_file_4" => "0041",
            "pdf_file_1" => "0042",
            "pdf_file_2" => "0043",
            "pdf_file_3" => "0044",
            "pdf_file_4" => "0045",
            "pdf_file_5" => "0046",
            "item_banner_image_file_1" => "0047",
            "item_banner_image_file_2" => "0048",
            "item_memo_1" => "0049",
            "item_memo_2" => "0050",
            "item_memo_3" => "0051",
            "item_memo_4" => "0052",
            "item_memo_5" => "0053",
            // SKUマスタ用
            "mt_color_id" => "0028",
            "mt_size_id" => "0029",
        ];

        return isset($item_change_history_thing_mapping[$thing_name]) ? $item_change_history_thing_mapping[$thing_name] : null;
    }

    private function getDataForHistory($key, $value)
    {
        $result = null;
        switch ($key) {
            case "mt_supplier_id":
                if (MtSupplier::find($value)) {
                    $result = MtSupplier::find($value)->supplier_cd;
                } else {
                    return null;
                }
                break;
            case "mt_item_class1_id":
            case "mt_item_class2_id":
            case "mt_item_class3_id":
            case "mt_item_class4_id":
            case "mt_item_class5_id":
                if (MtItemClass::find($value)) {
                    $result = MtItemClass::find($value)->item_class_cd;
                } else {
                    return null;
                }
                break;
            case "mt_member_site_item_id":
                if (MtMemberSiteItem::find($value)) {
                    $result = MtMemberSiteItem::find($value)->ec_item_cd;
                } else {
                    return null;
                }
                break;
            case "mt_color_id":
                if (MtColor::find($value)) {
                    $result = MtColor::find($value)->color_name;
                } else {
                    return null;
                }
                break;
                break;
            case "mt_size_id":
                if (MtSize::find($value)) {
                    $result = MtSize::find($value)->size_name;
                } else {
                    return null;
                }
                break;
            default:
                $result = $value;
                break;
        }
        return $result;
    }

    /**
     * 使用できるJANコードを取得
     * @param $id
     * @return Object
     */
    public function getNextJanCode()
    {
        $mtSystem = MtSystem::first();
        $new_jan_code = intval($mtSystem->now_jan_code);

        $mtStockKeepingUnit = "";
        while (!is_null($mtStockKeepingUnit)) {
            $new_jan_code++;
            // 上12桁（チェックディジットを除く）が一致するSKUが存在するかチェック
            $mtStockKeepingUnit = MtStockKeepingUnit::where('jan_cd', 'like', $new_jan_code . '%')->first();
        }
        return $new_jan_code;
    }
}
