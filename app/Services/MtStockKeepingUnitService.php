<?php

namespace App\Services;

use App\Repositories\MtStockKeepingUnit\MtStockKeepingUnitRepository;
use Illuminate\Support\Facades\Log;

/**
 * SKUマスタ関連 サービスクラス
 */
class MtStockKeepingUnitService
{

    /**
     * @var MtStockKeepingUnitRepository
     */
    private MtStockKeepingUnitRepository $mtStockKeepingUnitRepository;

    /**
     * @param MtStockKeepingUnitRepository $mtStockKeepingUnitRepository
     */
    public function __construct()
    {
        $this->mtStockKeepingUnitRepository = new MtStockKeepingUnitRepository();
    }

    /** SKUマスタ 全件取得
     *
     * @return $rows
     */
    public function get()
    {
        $datas = $this->mtStockKeepingUnitRepository->getAll();
        return $datas;
    }

    /** SKUマスタ 商品IDによる取得
     * @param $id
     * @return $rows
     */
    public function getById($mtItemId)
    {
        $datas = $this->mtStockKeepingUnitRepository->getById($mtItemId);
        return $datas;
    }

    /** SKUマスタ JANコードによる取得
     * @param $id
     * @return $rows
     */
    public function getByJanCode($itemCd, $janCd)
    {
        $datas = $this->mtStockKeepingUnitRepository->getByJanCode($itemCd, $janCd);
        return $datas;
    }

    /** SKUマスタ 更新
     *
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtStockKeepingUnitRepository->update($params);
        return $datas;
    }

    /** SKUマスタ ファイル出力対象の取得
     *
     * @return $result
     */
    public function export($params)
    {
        $datas = $this->mtStockKeepingUnitRepository->export($params);
        //$result = MtCustomerListResource::collection($datas);
        return $datas;
    }

    /** コード補完(Itemcode指定)
     * @param $code
     * @return $rows
     */
    public function codeAutoComplete($code)
    {
        $datas = $this->mtStockKeepingUnitRepository->getByCode($code);
        return $datas;
    }

    /**
     * 商品のロケーション情報
     * @param Array $params
     * @return Collection
     */
    public function loadByWarehouseAndItem($params)
    {
        $warehouseId = $params['warehouse_id'];
        $itemId = $params['item_id'];
        $records = $this->mtStockKeepingUnitRepository->loadByWarehouseAndItem($warehouseId, $itemId);
        return $records;
    }
}
