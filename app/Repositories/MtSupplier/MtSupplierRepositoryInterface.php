<?php
namespace App\Repositories\MtSupplier;

interface MtSupplierRepositoryInterface
{
    /**
     * 仕入先マスタ 全件取得
     * @param $id
     * @return Object
     */
    public function getAll();

    /**
     * 仕入先マスタ 更新
     * @param $params
     * @return Object
     */
    public function update(array $params);

    /**
     * 仕入先リスト(一覧) 出力情報取得
     * @param $params
     * @return Object
     */
    public function export(array $params);
}
