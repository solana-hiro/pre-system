<?php
namespace App\Repositories\MtItemChangeHistory;

interface MtItemChangeHistoryRepositoryInterface
{
    /**
     * 商品履歴データの全件取得
     * @return Object
     */
     public function getAll();

    /**
     * 商品履歴データ  出力
     * @param array $param
     * @return Object
     */
    public function export(array $param);

    /**
     * 商品履歴データ  指定条件にて取得
     * @param array $param
     * @return Object
     */
    public function get(array $param);

}
