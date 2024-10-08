<?php

namespace App\Services;

use App\Repositories\TrnDemandHeader\TrnDemandHeaderRepository;
use Illuminate\Support\Facades\Log;

/**
 * 請求ヘッダ関連 サービスクラス
 */
class TrnDemandHeaderService
{

    /**
     * @var trnDemandHeaderRepository
     */
    private TrnDemandHeaderRepository $trnDemandHeaderRepository;

    /**
     * @param TrnDemandHeaderRepository $trnDemandHeaderRepository
     */
    public function __construct()
    {
        $this->trnDemandHeaderRepository = new TrnDemandHeaderRepository();
    }

    /** 請求ヘッダ  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->trnDemandHeaderRepository->getAll();
        return $datas;
    }

    /** 請求データ確定の解除
     *
     * @return $rows
     */
    public function removeDataDecision($params)
    {
        $datas = $this->trnDemandHeaderRepository->removeDataDecision($params);
        return $datas;
    }

    /** 請求データ確定の更新
     *
     * @return $rows
     */
    public function updateDataDecision($params)
    {
        $datas = $this->trnDemandHeaderRepository->updateDataDecision($params);
        return $datas;
    }

    /** 請求一覧表の情報取得
     *
     * @return $rows
     */
    public function exportInvoiceList($params)
    {
        $datas = $this->trnDemandHeaderRepository->exportInvoiceList($params);
        return $datas;
    }

    /** 請求履歴問合せ 前頁の情報取得
     *
     * @return $rows
     */
    public function backHistoryInquiry($params)
    {
        $datas = $this->trnDemandHeaderRepository->backHistoryInquiry($params);
        return $datas;
    }

    /** 請求履歴問合せ 次頁の情報取得
     *
     * @return $rows
     */
    public function nextHistoryInquiry($params)
    {
        $datas = $this->trnDemandHeaderRepository->nextHistoryInquiry($params);
        return $datas;
    }

    /** 請求履歴問合せの情報取得
     *
     * @return $rows
     */
    public function executeHistoryInquiry($params)
    {
        $datas = $this->trnDemandHeaderRepository->executeHistoryInquiry($params);
        return $datas;
    }

    /** 請求残高問合せ  前頁の情報取得
     *
     * @return $rows
     */
    public function backBalanceInquiry($params)
    {
        $datas = $this->trnDemandHeaderRepository->backBalanceInquiry($params);
        return $datas;
    }

    /** 請求残高問合せ　次頁の情報取得
     *
     * @return $rows
     */
    public function nextBalanceInquiry($params)
    {
        $datas = $this->trnDemandHeaderRepository->nextBalanceInquiry($params);
        return $datas;
    }

    /** 請求残高問合せの情報取得
     *
     * @return $rows
     */
    public function exportBalanceInquiry($params)
    {
        $datas = $this->trnDemandHeaderRepository->exportBalanceInquiry($params);
        return $datas;
    }

    /** 請求時消費税一括計算の削除
     *
     * @return $rows
     */
    public function deleteTaxCalculate($params)
    {
        $datas = $this->trnDemandHeaderRepository->deleteTaxCalculate($params);
        return $datas;
    }

    /** 請求時消費税一括計算の更新
     *
     * @return $rows
     */
    public function updateTaxCalculate($params)
    {
        $datas = $this->trnDemandHeaderRepository->updateTaxCalculate($params);
        return $datas;
    }

    /** 請求書発行の情報取得
     *
     * @return $rows
     */
    public function exportInvoiceIssue($params)
    {
        $datas = $this->trnDemandHeaderRepository->exportInvoiceIssue($params);
        return $datas;
    }

    /** 請求締日変更処理
     *
     * @return $rows
     */
    public function updateClosingDateChange($params)
    {
        $datas = $this->trnDemandHeaderRepository->updateClosingDateChange($params);
        return $datas;
    }

    /** 請求随時締処理
     *
     * @return $rows
     */
    public function updateSequentiallyClosing($params)
    {
        $datas = $this->trnDemandHeaderRepository->updateSequentiallyClosing($params);
        return $datas;
    }

    /** 請求随時締解除処理
     *
     * @return $rows
     */
    public function updateSequentiallyClosingRemove($params)
    {
        $datas = $this->trnDemandHeaderRepository->updateSequentiallyClosingRemove($params);
        return $datas;
    }

}
