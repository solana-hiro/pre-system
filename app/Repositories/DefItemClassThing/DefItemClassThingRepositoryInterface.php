<?php
namespace App\Repositories\DefItemClassThing;

interface DefItemClassThingRepositoryInterface
{
    /**
     *商品分類項目定義情報取得 全件取得
     * @return Object
     */
    public function getAll();

    /**
     *商品分類項目定義情報取得 ID指定
     * @param int
     * @return Object
     */
    public function getById($id);
}
