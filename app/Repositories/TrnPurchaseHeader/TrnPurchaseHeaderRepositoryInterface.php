<?php
namespace App\Repositories\TrnPurchaseHeader;

interface TrnPurchaseHeaderRepositoryInterface
{
	/* 全件 */
    public function getAll();

	/* 仕入チェックリストの情報取得 */
    public function getChecklist(array $params);

	/* 商品仕入日計表の情報取得 */
    public function getItemDailyList(array $params);
}
