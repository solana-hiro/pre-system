<?php
namespace App\Repositories\DefPioneerYear;

interface DefPioneerYearRepositoryInterface
{
    /**
     * 開拓年分類情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * 開拓年分類情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);

}
