<?php
namespace App\Repositories\MtItem;

interface MtItemRepositoryInterface
{
    /**
     * 商品データの全件取得
     * @param array $params
     * @return Object
     */
     public function getAll();

    /**
     * 商品データの情報取得
     * @param array $params
     * @return Object
     */
    public function getItemData(array $param);

    /**
     * 商品マスタリスト(一覧) 出力
     * @param $service
     * @return Object
     */
    public function export($param);

    /**
     * 商品マスタリスト(分類別) 出力
     * @param $service
     * @return Object
     */
    public function exportByClass($param);

    /**
     * 商品コード変更 更新
     * @param $param
     * @return Object
     */
    public function updateItemCode($param);

}
