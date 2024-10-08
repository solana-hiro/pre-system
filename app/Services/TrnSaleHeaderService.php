<?php

namespace App\Services;

use App\Repositories\TrnSaleHeader\TrnSaleHeaderRepository;
use Illuminate\Support\Facades\Log;

/**
 * 売上ヘッダ関連 サービスクラス
 */
class TrnSaleHeaderService
{

    /**
     * @var trnOrderReceiveHeaderRepository
     */
    private TrnSaleHeaderRepository $trnSaleHeaderRepository;

    /**
     * @param TrnSaleHeaderRepository $trnSaleHeaderRepository
     */
    public function __construct()
    {
        $this->trnSaleHeaderRepository = new TrnSaleHeaderRepository();
    }

    /** 売上ヘッダ  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->trnSaleHeader->getAll();
        return $datas;
    }

    /** 売上確定の情報取得
     *
     * @return $rows
     */
    public function getSaleDecision($params)
    {
        $datas = $this->trnSaleHeaderRepository->getSaleDecision($params);
        return $datas;
    }

    /** 売上確定の更新
     *
     * @return $rows
     */
    public function updateSaleDecision($params)
    {
        $datas = $this->trnSaleHeaderRepository->updateSaleDecision($params);
        return $datas;
    }

    /** 売上確定の一括反映
     *
     * @return $rows
     */
    public function executeSaleDecision($params)
    {
        $datas = $this->trnSaleHeaderRepository->executeSaleDecision($params);
        return $datas;
    }

    /** 売上チェックリストの情報取得
     *
     * @return $rows
     */
    public function exportChecklist($params)
    {
        $datas = $this->trnSaleHeaderRepository->exportChecklist($params);
        return $datas;
    }

    /** 売上伝票一括発行　プレビュー
     *
     * @return $rows
     */
    public function exportSlipList($params)
    {
        $datas = $this->trnSaleHeaderRepository->exportSlipList($params);
        //TODO:DB更新
        return $datas;
    }

    /** 売上データの更新(ファイル入力)
     *
     * @return $rows
     */
    public function updateSalesDataImport($params)
    {
        $datas = $this->trnSaleHeaderRepository->updateSalesDataImport($params);
        // プレビュー表示
        return $datas;
    }

    /** 売上データの情報取得(プレビュー)
     *
     * @return $rows
     */
    public function exportPreviewSalesDataImport($params)
    {
        $datas = $this->trnSaleHeaderRepository->exportSalesDataImport($params);
        // プレビュー表示
        return $datas;
    }

}
?>
