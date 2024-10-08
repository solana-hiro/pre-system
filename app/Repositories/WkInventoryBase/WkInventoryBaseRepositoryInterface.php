<?php
namespace App\Repositories\WkInventoryBase;

interface WkInventoryBaseRepositoryInterface
{
	/* 全件 */
    public function getAll();

	/* 棚卸チェックリストの情報取得 */
    public function getChecklist(array $params);

	/* 棚卸原票の情報取得 */
    public function getSlip(array $params);

	/* 棚卸差異表の情報取得 */
    public function getDifferenceList(array $params);

	/* 棚卸更新処理 */
    public function update(array $params);

	/* 棚卸開始処理 */
    public function updateStart(array $params);

	/* 棚卸終了処理 */
    public function updateEnd(array $params);

	/* 資産在庫表の情報取得 */
    public function getAssetStockList(array $params);

}
