<?php
namespace App\Repositories\MtBank;

interface MtBankRepositoryInterface
{
    /**
     * 銀行情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * 銀行情報 更新
     * @param $params
     * @return Object
     */
    public function update($params);

    /**
     * 銀行情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);

    /**
     * 銀行情報  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params);

}
