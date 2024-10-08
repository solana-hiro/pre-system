<?php
namespace App\Repositories\MtHoliday;

interface MtHolidayRepositoryInterface
{
    /**
     * 休日情報 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * 休日情報 更新
     * @param $params
     * @return Object
     */
    public function update($params);

    /**
     * 休日情報 初期データの取得
     * @param Array
     * @return Object
     */
    public function getInitData();

}
