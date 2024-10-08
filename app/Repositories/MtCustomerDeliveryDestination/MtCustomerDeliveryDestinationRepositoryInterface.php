<?php
namespace App\Repositories\MtCustomerDeliveryDestination;

interface MtCustomerDeliveryDestinationRepositoryInterface
{
    /**
     * 得意先別納品先マスタ情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * 得意先別納品先マスタ情報取得 IDにより取得
     * @param $id
     * @return Object
     */
    public function getById($id);

}
