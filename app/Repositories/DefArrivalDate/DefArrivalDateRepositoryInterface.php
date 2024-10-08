<?php
namespace App\Repositories\DefArrivalDate;

interface DefArrivalDateRepositoryInterface
{
    /**
     * 着日定義情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * 着日定義情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);

}
