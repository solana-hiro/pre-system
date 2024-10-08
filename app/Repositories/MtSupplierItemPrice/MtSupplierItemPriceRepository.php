<?php

namespace App\Repositories\MtSupplierItemPrice;

use App\Models\MtSupplierItemPrice;
use App\Models\MtItem;
use App\Models\MtSupplier;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use App\Consts\CommonConsts;
use App\Lib\DateUtil;
use Exception;

class MtSupplierItemPriceRepository implements MtSupplierItemPriceRepositoryInterface
{

    /**
     * 仕入先商品単価情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtSupplierItemPrice::get();
        return $result;
    }

    /**
     * 仕入先商品単価情報取得 ID指定
     * @return Object
     */
    public function getInitData($id)
    {
        $result['mtSupplierItemPrice'] = MtSupplierItemPrice::select(
            'mt_supplier_item_prices.id as id',
            'mt_supplier_item_prices.*',
            'mt_items.*',
            'mt_suppliers.*',
            'mt_pay_destinations.*'
        )
            ->leftJoin('mt_items', 'mt_supplier_item_prices.mt_item_id', 'mt_items.id')
            ->leftJoin('mt_suppliers', 'mt_supplier_item_prices.mt_supplier_id', 'mt_suppliers.id')
            ->leftJoin('mt_pay_destinations', 'mt_suppliers.mt_pay_destination_id', 'mt_pay_destinations.id')
            ->where('mt_supplier_item_prices.mt_supplier_id', $id)
            ->orderBy('mt_suppliers.supplier_cd')->orderBy('mt_items.item_cd')->paginate(CommonConsts::PAGINATION_20);
        if ($result['mtSupplierItemPrice']->isEmpty()) {
            $result['mtSupplier'] = MtSupplier::leftJoin('mt_pay_destinations', 'mt_suppliers.mt_pay_destination_id', 'mt_pay_destinations.id')
                ->where('mt_suppliers.id', $id)->first();
        }
        return $result;
    }


    /**
     * 仕入先商品単価(一覧) 更新
     * @param $param
     * @return Object
     */
    public function update($params)
    {
        Log::debug($params);
        $result = array();
        try {
            DB::beginTransaction();
            $supplierId = $params['supplier_id'];
            foreach ($params['items'] as $itemParams) {
                if ($this->isAllNull($itemParams)) continue;
                if ($this->isDelete($itemParams)) {
                    $this->deleteSupplierItemPrice($itemParams);
                } else {
                    $this->createOrUpdate($supplierId, $itemParams);
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

    private function isAllNull($itemParams)
    {
        // バリデーションを通っているのでレコードIDと商品コードがNULL = 全てNULL
        return is_null($itemParams['supplier_item_price_id']) && is_null($itemParams['item_cd']);
    }

    private function isDelete($itemParams)
    {
        return !is_null($itemParams['supplier_item_price_id']) && is_null($itemParams['item_cd']);
    }

    private function deleteSupplierItemPrice($itemParams)
    {
        MtSupplierItemPrice::destroy($itemParams['supplier_item_price_id']);
    }

    private function createOrUpdate($supplierId, $itemParams)
    {
        $query = MtSupplierItemPrice::query();
        $query->where('mt_supplier_id', $supplierId);
        $query->where('mt_item_id', $itemParams['mt_item_id']);
        $record = $query->first();
        is_null($record)
            ? $this->createSupplierItemPrice($supplierId, $itemParams)
            : $this->updateSupplierItemPrice($record, $itemParams);
    }

    private function createSupplierItemPrice($supplierId, $itemParams)
    {
        $record = new MtSupplierItemPrice();
        $record->mt_supplier_id = $supplierId;
        $record->set_date = DateUtil::paramToDateTime($itemParams['year'], $itemParams['month'], $itemParams['day']);
        $record->fill($itemParams);
        $record->mt_user_last_update_id = Auth::user()->id;
        $record->save();
    }

    private function updateSupplierItemPrice($record, $itemParams)
    {
        $record->set_date = DateUtil::paramToDateTime($itemParams['year'], $itemParams['month'], $itemParams['day']);
        $record->fill($itemParams);
        $record->mt_user_last_update_id = Auth::user()->id;
        $record->save();
    }

    /**
     * 仕入先商品単価情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($supplierId)
    {
        $query = MtSupplierItemPrice::query();
        $query->where('mt_supplier_id', $supplierId);
        $query->with('mtItem');

        return $query->paginate(CommonConsts::PAGINATION_20);
    }

    public function existsItemPrices($supplierId)
    {
        $query = MtSupplierItemPrice::query();
        $query->where('mt_supplier_id', $supplierId);

        return $query->exists();
    }

    /**
     * 仕入先商品単価リスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params)
    {
        $itemStartCode = ($params['item_code_start']) ? $params['item_code_start'] : '';
        $itemEndCode = ($params['item_code_end']) ? $params['item_code_end'] : 'ZZZZZZZZZ';
        $supplierStartCode = ($params['supplier_code_start']) ? str_pad($params['supplier_code_start'], 6, 0, STR_PAD_LEFT) : '';
        $supplierEndCode = ($params['supplier_code_end']) ? str_pad($params['supplier_code_end'], 6, 0, STR_PAD_LEFT) : 'ZZZZZZ';
        $itemIds = MtItem::whereBetween('item_cd', [$itemStartCode, $itemEndCode])->pluck('id');
        $supplierIds = MtSupplier::whereBetween('supplier_cd', [$supplierStartCode, $supplierEndCode])->pluck('id');
        $result = MtSupplierItemPrice::select(
            'mt_supplier_item_prices.id as id',
            'mt_suppliers.supplier_cd as supplier_cd',
            'mt_suppliers.supplier_name as supplier_name',
            'mt_pay_destinations.tax_kbn',
            'mt_items.item_cd as item_cd',
            'mt_items.item_name as item_name',
            'mt_supplier_item_prices.set_date as set_date',
            'mt_supplier_item_prices.price as price'
        )
            ->leftJoin("mt_suppliers", "mt_supplier_item_prices.mt_supplier_id", "mt_suppliers.id")
            ->leftJoin("mt_items", "mt_supplier_item_prices.mt_item_id", "mt_items.id")
            ->leftJoin("mt_pay_destinations", "mt_suppliers.mt_pay_destination_id", "mt_pay_destinations.id")
            ->whereIn("mt_supplier_item_prices.mt_supplier_id", $supplierIds)
            ->whereIn("mt_supplier_item_prices.mt_item_id", $itemIds)
            ->orderBy("mt_supplier_item_prices.id")
            ->get();
        return $result;
    }

    public function getByCode($supplierCd, $itemCd)
    {
        $supplier = MtSupplier::where('supplier_cd', $supplierCd)->first();
        $item = MtItem::where('item_cd', $itemCd)->first();

        $query = MtSupplierItemPrice::query();
        $query->where('mt_supplier_id', $supplier?->id);
        $query->where('mt_item_id', $item?->id);

        return [
            'item' => $item,
            'supplierItemPrice' => $query->get()->first(),
        ];
    }
}
