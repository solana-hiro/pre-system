<?php
namespace App\Repositories\MtShippingCompany;

interface MtShippingCompanyRepositoryInterface
{
    /**
     * 運送会社情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * 運送会社情報 更新
     * @param $params
     * @return Object
     */
    public function update($params);

    /**
     * 運送会社情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);

    /**
     * 運送会社情報  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params);

}
