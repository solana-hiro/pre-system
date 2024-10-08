<?php
namespace App\Repositories\MtBillingAddress;

interface MtBillingAddressRepositoryInterface
{
    /**
     * 請求先情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * 請求先情報 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);
}
