<?php
namespace App\Repositories\MtTaxRateSetting;

interface MtTaxRateSettingRepositoryInterface
{
    /**
     * 税率設定情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * 税率設定情報取得(一覧) 更新
     * @param $params
     * @return Object
     */
    public function update($params);

    /**
     * 税率設定情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params);

}
