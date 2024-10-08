<?php
namespace App\Repositories\MtDeliveryDestination;

interface MtDeliveryDestinationRepositoryInterface
{
    /**
     * 納品先マスタ 取得(id指定)
     * @param $id
     * @return Object
     */
    public function get($id);

    /**
     * 納品先マスタ 更新
     * @param $params
     * @return Object
     */
    public function update(array $params);

    /**
     * 納品先リスト(一覧) 出力情報取得
     * @param $params
     * @return Object
     */
    public function export(array $params);
}
