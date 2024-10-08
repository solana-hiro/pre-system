<?php

namespace App\Services;

use App\Repositories\MtSize\MtSizeRepository;
use App\Repositories\MtItem\MtItemRepository;
use App\Repositories\MtStockKeepingUnit\MtStockKeepingUnitRepository;
use App\Http\Resources\MtSize\MtSizeListResource;
use Illuminate\Support\Facades\Log;

/**
 * サイズ関連 サービスクラス
 */
class MtSizeService
{

    /**
     * @var MtSizeRepository
     */
    private MtSizeRepository $mtSizeRepository;

    /**
     * @var MtItemRepository
     */
    private MtItemRepository $mtItemRepository;

    /**
     * @var MtStockKeepingUnitRepository
     */
    private MtStockKeepingUnitRepository $mtStockKeepingUnitRepository;

    /**
     * @param MtSizeRepository $mtSizeRepository
     */
    public function __construct()
    {
        $this->mtSizeRepository = new MtSizeRepository();
        $this->mtItemRepository = new MtItemRepository();
        $this->mtStockKeepingUnitRepository = new MtStockKeepingUnitRepository();
    }

    /** サイズ 全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtSizeRepository->getAll();
        return $datas;
    }

    /** サイズ 削除
     * @param $id
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtSizeRepository->delete($id);
        return $datas;
    }

    /** サイズ 初期データ取得
     *
     * @return $rows
     */
    public function getInitData()
    {
        $datas = $this->mtSizeRepository->getInitData();
        return $datas;
    }

    /** サイズマスタ（一覧）  更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtSizeRepository->update($params);
        return $datas;
    }

    /** サイズリスト(一覧)  出力情報を取得
     * @param $params
     * @return $rows
     */
    public function export($params)
    {
        $datas = $this->mtSizeRepository->export($params);
        return $datas;
    }

    /** サイズ  指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $result = $this->mtSizeRepository->get($params);
        return $result;
    }

    /** コード補完(code指定)
     * @param $code
     * @return $rows
     */
    public function codeAutoComplete($code)
    {
        $datas = $this->mtSizeRepository->getByCode($code);
        return $datas;
    }

    public function getSizes($item_code){
        $mt_item = $this->mtItemRepository->getByCode($item_code);
        $mt_stock_keeping_units = $this->mtStockKeepingUnitRepository->getDataByItemId($mt_item->id);
        // $mt_stock_keeping_units(collection)の中でmt_size_idだけを配列として取得(重複を除く)
        $mt_size_ids = $mt_stock_keeping_units->pluck('mt_size_id')->unique()->toArray();
        $mt_sizes = $this->mtSizeRepository->getByIds($mt_size_ids);
        return $mt_sizes;
    }
}
