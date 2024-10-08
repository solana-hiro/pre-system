<?php
namespace App\Repositories\MtLocation;

interface MtLocationRepositoryInterface
{
    /**
     * ロケーション情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * ロケーションマスタ(一覧) 更新
     * @param $params
     * @return Object
     */
    public function update($params);

    /**
     * ロケーション情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);

    /**
     * ロケーションリスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params);

}
