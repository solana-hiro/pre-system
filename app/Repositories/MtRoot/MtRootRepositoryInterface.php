<?php
namespace App\Repositories\MtRoot;

interface MtRootRepositoryInterface
{
    /**
     * ルート情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * ルートマスタ(一覧) 更新
     * @param $params
     * @return Object
     */
    public function update($params);

    /**
     * ルート情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);

}
