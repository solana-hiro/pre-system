<?php
namespace App\Repositories\MtSystem;

interface MtSystemRepositoryInterface
{
    /**
     * システム情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * システム情報 更新
     * @param $params
     * @return Object
     */
    public function update($params);

    /**
     * システム情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function getInitData();

}
