<?php

namespace App\Services;

use App\Repositories\MtColor\MtColorRepository;
use App\Repositories\MtItem\MtItemRepository;
use App\Repositories\MtStockKeepingUnit\MtStockKeepingUnitRepository;
use App\Http\Resources\MtColor\MtColorListResource;
use Illuminate\Support\Facades\Log;

/**
 * カラー関連 サービスクラス
 */
class MtColorService
{

    /**
     * @var MtColorRepository
     */
    private MtColorRepository $mtColorRepository;

    /**
     * @var MtItemRepository
     */
    private MtItemRepository $mtItemRepository;

    /**
     * @var MtStockKeepingUnitRepository
     */
    private MtStockKeepingUnitRepository $mtStockKeepingUnitRepository;

    /**
     * @param MtColorRepository $mtColorRepository
     */
    public function __construct()
    {
        $this->mtColorRepository = new MtColorRepository();
        $this->mtItemRepository = new MtItemRepository();
        $this->mtStockKeepingUnitRepository = new MtStockKeepingUnitRepository();
    }

    /** カラー  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtColorRepository->getAll();
        return $datas;
    }

    /** カラー  初期データ取得
     *
     * @return $rows
     */
    public function getInitData()
    {
        $datas = $this->mtColorRepository->getInitData();
        return $datas;
    }

    /** カラーマスタ（一覧）  更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtColorRepository->update($params);
        return $datas;
    }

    /** カラーマスタ（一覧）  削除(ID指定)
     * @param $id
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtColorRepository->delete($id);
        return $datas;
    }

    /** カラーリスト(一覧)  出力情報を取得
     * @param $params
     * @return $rows
     */
    public function export($params)
    {
        $result = $this->mtColorRepository->export($params);
        $datas = MtColorListResource::collection($result);
        return $datas;
    }

    /** カラー  指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtColorRepository->get($params);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $code
     * @return $rows
     */
    public function codeAutoComplete($code)
    {
        $datas = $this->mtColorRepository->getByCode($code);
        return $datas;
    }

    public function getColors($item_code){
        $mt_item = $this->mtItemRepository->getByCode($item_code);
        $mt_stock_keeping_units = $this->mtStockKeepingUnitRepository->getDataByItemId($mt_item->id);
        // $mt_stock_keeping_units(collection)の中でmt_color_idだけを配列として取得(重複を除く)
        $mt_color_ids = $mt_stock_keeping_units->pluck('mt_color_id')->unique()->toArray();
        $mt_colors = $this->mtColorRepository->getByIds($mt_color_ids);
        return $mt_colors;
    }
}
