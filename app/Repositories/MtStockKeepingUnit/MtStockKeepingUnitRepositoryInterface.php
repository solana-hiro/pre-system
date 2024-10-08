<?php
namespace App\Repositories\MtStockKeepingUnit;

interface MtStockKeepingUnitRepositoryInterface
{
    /**
     * SKUマスタ 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * SKUマスタ 更新
     * @param $params
     * @return Object
     */
    public function update(array $params);

    /**
     * SKUリスト(一覧) 出力情報取得
     * @param $params
     * @return Object
     */
    public function export(array $params);
}
