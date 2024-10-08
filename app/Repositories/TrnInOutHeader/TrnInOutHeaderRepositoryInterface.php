<?php
namespace App\Repositories\TrnInOutHeader;

interface TrnInOutHeaderRepositoryInterface
{
	/* 全件 */
    public function getAll();

	/* 入出庫チェックリストの情報取得 */
    public function getInoutChecklist(array $params);

	/* 商品別倉庫別在庫一覧表の情報取得 */
    public function getWarehouseList(array $params);

	/* 在庫データ書出しの情報取得(Excel) */
    public function getDataOutput(array $params);

	/* 在庫一覧表の情報取得(Excel) */
    public function getList(array $params);

	/* 入出庫データの更新 */
    public function updateInOutDataImport(array $params);

	/* 入出庫データの情報取得 */
    public function getInOutDataImport(array $params);

}
