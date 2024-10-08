<?php
namespace App\Repositories\MtWarehouse;

interface MtWarehouseRepositoryInterface
{
    /**
     * 倉庫情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * 倉庫マスタ(一覧) 更新
     * @param $params
     * @return Object
     */
    public function update($params);

    /**
     * 倉庫情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);

    /**
     * 倉庫リスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params);

}
