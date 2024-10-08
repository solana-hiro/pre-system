<?php
namespace App\Repositories\TrnPayHeader;

interface TrnPayHeaderRepositoryInterface
{
	/* 全件 */
    public function getAll();

	/* 支払時消費税一括計算　更新 */
    public function updateTaxCalculate(array $params);

	/* 支払データ確定処理　削除 */
    public function deleteDataDecision(array $params);

	/* 支払データ確定処理　更新 */
    public function updateDataDecision(array $params);

	/* 支払一覧表の情報取得 */
    public function getPaymentList(array $params);

	/* 支払明細書の情報取得 */
    public function getPaymentIssue(array $params);

	/* 買掛残高一覧表の情報取得 */
    public function getList(array $params);

	/* 仕入先元帳の情報取得 */
    public function getSupplierLedger(array $params);
}
