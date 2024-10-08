<?php
namespace App\Repositories\MtPayDestination;

interface MtPayDestinationRepositoryInterface
{
    /**
     * 支払先情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * 支払先情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);

}
