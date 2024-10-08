<?php
namespace App\Repositories\DefDistrictClass;

interface DefDistrictClassRepositoryInterface
{
    /**
     * 地区分類定義情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * 地区分類定義情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);

}
