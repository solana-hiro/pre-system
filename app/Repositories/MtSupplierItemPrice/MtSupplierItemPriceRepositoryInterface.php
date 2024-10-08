<?php
namespace App\Repositories\MtSupplierItemPrice;

interface MtSupplierItemPriceRepositoryInterface
{
    /**
     * 仕入先商品単価情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * 仕入先商品単価(一覧) 更新
     * @param $params
     * @return Object
     */
    public function update($params);

    /**
     * 仕入先商品単価情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);

    /**
     * 仕入先商品単価リスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params);

}
