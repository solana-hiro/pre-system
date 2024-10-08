<?php

namespace App\Services;

use App\Repositories\MtSupplierItemPrice\MtSupplierItemPriceRepository;
use App\Http\Resources\MtSupplierItemPrice\MtSupplierItemPriceResource;
use App\Lib\CodeUtil;
use Illuminate\Support\Facades\Log;

/**
 * 仕入先商品単価関連 サービスクラス
 */
class MtSupplierItemPriceService
{

    /**
     * @var MtSupplierItemPriceRepository
     */
    private MtSupplierItemPriceRepository $mtSupplierItemPriceRepository;

    /**
     * @param MtSupplierItemPriceRepository $mtSupplierItemPriceRepository
     */
    public function __construct()
    {
        $this->mtSupplierItemPriceRepository = new MtSupplierItemPriceRepository();
    }

    /** 仕入先商品単価  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtSupplierItemPriceRepository->getAll();
        return $datas;
    }

    /** 仕入先商品単価  全件取得(ID指定)
     * @param $id
     * @return $rows
     */
    public function getInitData($id)
    {
        $datas = $this->mtSupplierItemPriceRepository->getInitData($id);
        return $datas;
    }

    /** 仕入先商品単価  更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtSupplierItemPriceRepository->update($params);
        return $datas;
    }

    /** 仕入先商品単価  出力情報を取得
     * @param $params
     * @return $rows
     */
    public function export($params)
    {
        $result = $this->mtSupplierItemPriceRepository->export($params);
        $datas = MtSupplierItemPriceResource::collection($result);
        return $datas;
    }

    /** 仕入先商品単価  指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $supplierId = $params['supplier_id'];

        $datas = $this->mtSupplierItemPriceRepository->get($supplierId);
        return $datas;
    }

    public function existsItemPrices($params)
    {
        $supplierId = $params['supplier_id'];

        $flag = $this->mtSupplierItemPriceRepository->existsItemPrices($supplierId);
        return $flag;
    }

    public function codeAutoComplete($params)
    {
        $supplierCd = $params['supplier_cd'] ? CodeUtil::pad($params['supplier_cd'], 6) : null;
        $itemCd = $params['item_cd'];

        $datas = $this->mtSupplierItemPriceRepository->getByCode($supplierCd, $itemCd);
        return $datas;
    }
}
