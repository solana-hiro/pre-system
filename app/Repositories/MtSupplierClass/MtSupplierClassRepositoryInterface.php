<?php
namespace App\Repositories\MtSupplierClass;

interface MtSupplierClassRepositoryInterface
{
    /**
     * 仕入先分類マスタ 全件取得
     * @return Object
     */
    public function getAll();

    /**
     * 仕入先分類マスタ 更新
     * @param $params
     * @return Object
     */
    public function update(array $params);

    /**
     * 仕入先分類リスト(一覧) 出力情報取得
     * @param $params
     * @return Object
     */
    public function export(array $params);
}
