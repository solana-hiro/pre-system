<?php
namespace App\Repositories\TrnDemandHeader;

interface TrnDemandHeaderRepositoryInterface
{
	/* 全件 */
    public function getAll();

	/* 請求確定の解除 */
    public function removeDataDecision(array $params);

	/* 請求確定の更新 */
    public function updateDataDecision(array $params);

	/* 請求一覧表の情報取得 */
    public function exportInvoiceList(array $params);

    /* 請求履歴問合せ 前頁の情報取得 */
    public function backHistoryInquiry(array $params);

    /* 請求履歴問合せ 次頁の情報取得 */
    public function nextHistoryInquiry(array $params);

	/* 請求履歴問合せの情報取得 */
    public function executeHistoryInquiry(array $params);

    /* 請求残高問合せ 前頁の情報取得 */
    public function backBalanceInquiry(array $params);

    /* 請求残高問合せ 次頁の情報取得 */
    public function nextBalanceInquiry(array $params);

	/* 請求残高問合せの情報取得 */
    public function exportBalanceInquiry(array $params);

	/* 請求時消費税一括計算の削除 */
    public function deleteTaxCalculate(array $params);

	/* 請求時消費税一括計算の更新 */
    public function updateTaxCalculate(array $params);

	/* 請求書発行の情報取得 */
    public function exportInvoiceIssue(array $params);

    /**
     * 請求締日変更処理
     * @param array $params
     * @return Object
     */
    public function updateClosingDateChange(array $params);

    /**
     * 請求随時締処理
     * @param array $params
     * @return Object
     */
    public function updateSequentiallyClosing(array $params);

    /**
     * 請求随時締解除処理
     * @param array $params
     * @return Object
     */
    public function updateSequentiallyClosingRemove(array $params);

}
