<?php
namespace App\Repositories\TrnPaymentHeader;

interface TrnPaymentHeaderRepositoryInterface
{
	/* 全件 */
    public function getAll();

	/* 入金チェックリストの情報取得 */
    public function exportCheckList(array $params);

	/* 受取手形一覧表の情報取得 */
    public function exportBillReceipt(array $params);

	/* 売掛残高一覧表の情報取得 */
    public function exportList(array $params);

	/* 得意先元帳の情報取得 */
    public function exportCustomerLedger(array $params);

    /* 未回収残一覧の情報取得 */
    public function exportCollectBalanceList(array $params);
}
