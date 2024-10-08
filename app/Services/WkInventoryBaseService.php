<?php

namespace App\Services;

use App\Repositories\WkInventoryBase\WkInventoryBaseRepository;
use Illuminate\Support\Facades\Log;

/**
 * 棚卸ベースワーク関連 サービスクラス
 */
class WkInventoryBaseService
{

    /**
     * @var wkInventoryBaseRepository
     */
    private WkInventoryBaseRepository $wkInventoryBaseRepository;

    /**
     * @param WkInventoryBaseRepository $wkInventoryBaseRepository
     */
    public function __construct()
    {
        $this->wkInventoryBaseRepository = new WkInventoryBaseRepository();
    }

    /** 棚卸チェックリストの情報取得(Excel/プレビュー)
     *
     * @return $rows
     */
    public function getChecklist($params)
    {
        $datas = $this->wkInventoryBaseRepository->getChecklist($params);
        return $datas;
    }

    /** 棚卸原票の情報取得(Excel)
     *
     * @return $rows
     */
    public function getSlip($params)
    {
        $datas = $this->wkInventoryBaseRepository->getSlip($params);
        return $datas;
    }

    /** 棚卸差異表の情報取得(Excel)
     *
     * @return $rows
     */
    public function getDifferenceList($params)
    {
        $datas = $this->wkInventoryBaseRepository->getDifferenceList($params);
        return $datas;
    }

    /** 棚卸更新処理
     *
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->wkInventoryBaseRepository->update($params);
        return $datas;
    }

    /** 棚卸開始処理
     *
     * @return $rows
     */
    public function updateStart($params)
    {
        $datas = $this->wkInventoryBaseRepository->updateStart($params);
        return $datas;
    }

    /** 棚卸終了処理
     *
     * @return $rows
     */
    public function updateEnd($params)
    {
        $datas = $this->wkInventoryBaseRepository->updateEnd($params);
        return $datas;
    }

    /** 資産在庫表の情報取得(EXCEL)
     *
     * @return $rows
     */
    public function getAssetStockList($params)
    {
        $datas = $this->wkInventoryBaseRepository->getAssetStockList($params);
        return $datas;
    }

    /** 今回棚卸日付取得(開始中)
     *
     * @return $rows
     */
    public function getNowInventoryDateNow()
    {
        $datas = $this->wkInventoryBaseRepository->getNowInventoryDateNow();
        return $datas;
    }

    /** 今回棚卸日付取得(終了)
     *
     * @return $rows
     */
    public function getNowInventoryDateEnd()
    {
        $datas = $this->wkInventoryBaseRepository->getNowInventoryDateEnd();
        return $datas;
    }

    /** 棚卸Excelインポートファイルのバリデーションチェック
     *
     * @return $result
     */
    public function checkImportFormat($params)
    {
        //TODOフォーマットチェック
        $result = null;
        return $result;
    }

    /** 棚卸ExcelインポートファイルのDB更新
     *
     * @return $result
     */
    public function importUpdate($params)
    {
        $result = $this->wkInventoryBaseRepository->importUpdate($params);
        return $result;
    }

}
