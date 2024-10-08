<?php
namespace App\Repositories\TrnOrderHeader;

interface TrnOrderHeaderRepositoryInterface
{
	/* 全件 */
    public function getAll();

	/* 発注伝票一括発行の情報取得 */
    public function getSlipIssue(array $params);

	/* 発注チェックリストの情報取得 */
    public function getChecklist(array $params);

	/* 発注残一覧表(仕入先別納期別)の情報取得 */
    public function getOrderBalanceListSupplier(array $params);

	/* 発注チェックリストの情報取得 */
    public function getOrderBalanceListItem(array $params);

}
