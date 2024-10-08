<?php
namespace App\Repositories\TrnSaleHeader;

interface TrnSaleHeaderRepositoryInterface
{
	/* 全件 */
    public function getAll();

	/* 売上確定の情報取得 */
    public function getSaleDecision(array $params);

	/* 売上確定の更新 */
    public function updateSaleDecision(array $params);

	/* 売上確定の一括反映 */
    public function executeSaleDecision(array $params);

	/* 売上チェックリストの情報取得 */
    public function exportChecklist(array $params);

	/* 売上伝票一括発行の情報取得 */
    public function exportSliplist(array $params);

	/* 売上データの更新 */
    public function updateSalesDataImport(array $params);

	/* 売上データの情報取得 */
    public function getSalesDataImport(array $params);

}
