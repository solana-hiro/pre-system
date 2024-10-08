<?php

namespace App\Services;

use App\Repositories\TrnInOutHeader\TrnInOutHeaderRepository;
use Illuminate\Support\Facades\Log;

/**
 * 入出庫ヘッダ関連 サービスクラス
 */
class TrnInOutHeaderService
{

    /**
     * @var trnPayHeaderRepository
     */
    private TrnInOutHeaderRepository $trnInOutHeaderRepository;

    /**
     * @param TrnInOutHeaderRepository $trnInOutHeaderRepository
     */
    public function __construct()
    {
        $this->trnInOutHeaderRepository = new TrnInOutHeaderRepository();
    }

    /** 入出庫データの更新
     *
     * @return Object
     */
    public function updateInOutData($params)
    {
        $data = $this->trnInOutHeaderRepository->updateInOutData($params);
        return $data;
    }

    /** 次項
     *
     * @return Object
     */
    public function getPrevByCode($params)
    {

        $data = $this->trnInOutHeaderRepository->getPrevByCode($params);
        return $data;
    }

    /** 前項
     *
     * @return Object
     */
    public function getNextByCode($params)
    {

        $data = $this->trnInOutHeaderRepository->getNextByCode($params);
        return $data;
    }
    /** 削除
     *
     * @return Object
     */
    public function deleteByCode($params)
    {

        $data = $this->trnInOutHeaderRepository->deleteByCode($params);
        return $data;
    }

    /** コード補完(Itemcode指定)
     * @param $code
     * @return $rows
     */
    public function codeAutoComplete($code)
    {
        $datas = $this->trnInOutHeaderRepository->getByCode($code);
        return $datas;
    }

    /** 入出庫チェックリストの情報取得(Excel)
     *
     * @return $rows
     */
    public function getInoutChecklist($params)
    {
        $datas = $this->trnInOutHeaderRepository->getInoutChecklist($params);
        return $datas;
    }

    /** 商品別倉庫別在庫一覧表の情報取得(Excel)
     *
     * @return $rows
     */
    public function getWarehouseList($params)
    {
        $datas = $this->trnInOutHeaderRepository->getWarehouseList($params);
        return $datas;
    }

    /** 在庫データ書出しの情報取得(Excel)
     *
     * @return $rows
     */
    public function getDataOutput($params)
    {
        $datas = $this->trnInOutHeaderRepository->getDataOutput($params);
        return $datas;
    }

    /** 入出庫ヘッダー  条件取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->trnInOutHeaderRepository->get($params);
        return $datas;
    }

    /** 在庫一覧表の情報取得(Excel)
     *
     * @return $rows
     */
    public function getList($params)
    {
        $datas = $this->trnInOutHeaderRepository->getList($params);
        return $datas;
    }

    /** 入出庫データの更新(ファイル入力)
     *
     * @return $rows
     */
    public function updateInOutDataImport($params)
    {
        $datas = $this->trnInOutHeaderRepository->updateInOutDataImport($params);
        // プレビュー表示
        return $datas;
    }

    /** 入出庫データの情報取得(プレビュー)
     *
     * @return $rows
     */
    public function exportPreviewInOutDataImport($params)
    {
        $datas = $this->trnInOutHeaderRepository->getInOutDataImport($params);
        // プレビュー表示
        return $datas;
    }

}
