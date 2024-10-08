<?php
namespace App\Repositories\MtCustomerOtherItemClassRate;

interface MtCustomerOtherItemClassRateRepositoryInterface
{
    /**
     * 商品分類掛率情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * 商品分類掛率(一覧) 更新
     * @param $params
     * @return Object
     */
    public function update($params);

    /**
     * 商品分類掛率情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);

    /**
     * 商品分類掛率リスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params);

}
