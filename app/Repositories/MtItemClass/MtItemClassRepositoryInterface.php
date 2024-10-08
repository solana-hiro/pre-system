<?php
namespace App\Repositories\MtItemClass;

interface MtItemClassRepositoryInterface
{
    /**
     * 商品分類データの全件取得
     * @return Object
     */
     public function getAll();

    /**
     * 商品分類マスタ(一覧) 更新
     * @param array $params
     * @return Object
     */
    public function update(array $params);

    /**
     * 商品分類データの情報取得
     * @param array $params
     * @return Object
     */
    public function getItemClassData(array $params);

    /**
     * 商品分類リスト(一覧) 出力
     * @param array $params
     * @return Object
     */
    public function export(array $params);

    /**
     * ジャンルの全件取得
     * @return Object
     */
    public function getAllGenre();

    /**
     * ブランド1の全件取得
     * @return Object
     */
    public function getAllBrand1();

    /**
     * カテゴリの全件取得
     * @return Object
     */
    public function getAllCategory();

    /**
     * ジャンルの取得(条件)
     * @param $params
     * @return Object
     */
    public function getGenre($params);

    /**
     * ブランド1の取得(条件)
     * @param $params
     * @return Object
     */
    public function getBrand1($params);

    /**
     * 競技・カテゴリの取得(条件)
     * @param $params
     * @return Object
     */
    public function getCategory($params);

}
