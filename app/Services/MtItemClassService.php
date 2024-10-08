<?php

namespace App\Services;

use App\Repositories\MtItemClass\MtItemClassRepository;
use App\Http\Resources\MtItemClass\MtItemClassListResource;
use Illuminate\Support\Facades\Log;

/**
 * 商品分類マスタ関連 サービスクラス
 */
class MtItemClassService
{

    /**
     * @var mtItemClassRepository
     */
    private MtItemClassRepository $mtItemClassRepository;

    /**
     * @param MtItemClassRepository $mtItemClassRepository
     */
    public function __construct()
    {
        $this->mtItemClassRepository = new MtItemClassRepository();
    }

    /** 商品分類マスタ  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtItemClassRepository->getAll();
        return $datas;
    }

    /** 商品分類マスタ  削除
     * @param $id
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtItemClassRepository->delete($id);
        return $datas;
    }

    /**
     * 商品分類マスタリスト(一覧) 出力
     * @param $service
     * @return Object
     */
    public function export($param)
    {
        $result = $this->mtItemClassRepository->export($param);
        $datas = MtItemClassListResource::collection($result);
        return $datas;
    }

    /** 商品分類マスタ（一覧）  更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtItemClassRepository->update($params);
        return $datas;
    }

    /** 商品データの情報取得
     *
     * @return $rows
     */
    public function getItemData($params)
    {
        $datas = $this->mtItemClassRepository->getItemClassData($params);
        return $datas;
    }

    /** ジャンル検索
     * @return $rows
     */
    public function getAllGenre()
    {
        $datas = $this->mtItemClassRepository->getAllGenre();
        return $datas;
    }

    /** ブランド1検索
     * @return $rows
     */
    public function getAllBrand1()
    {
        $datas = $this->mtItemClassRepository->getAllBrand1();
        return $datas;
    }

    /** 競技・カテゴリ検索
     * @return $rows
     */
    public function getAllCategory()
    {
        $datas = $this->mtItemClassRepository->getAllCategory();
        return $datas;
    }

    /** 販売開始年検索
     * @return $rows
     */
    public function getAllItemClassThing4()
    {
        $datas = $this->mtItemClassRepository->getAllItemClassThing4();
        return $datas;
    }

    /** 工場分類5検索
     * @return $rows
     */
    public function getAllItemClassThing5()
    {
        $datas = $this->mtItemClassRepository->getAllItemClassThing5();
        return $datas;
    }

    /** 製品/工賃6検索
     * @return $rows
     */
    public function getAllItemClassThing6()
    {
        $datas = $this->mtItemClassRepository->getAllItemClassThing6();
        return $datas;
    }

    /** 資産在庫JA検索
     * @return $rows
     */
    public function getAllItemClassThing7()
    {
        $datas = $this->mtItemClassRepository->getAllItemClassThing7();
        return $datas;
    }

    /** ジャンル検索(条件指定)
     * @param params
     * @return $rows
     */
    public function getGenre($params)
    {
        $datas = $this->mtItemClassRepository->getGenre($params);
        return $datas;
    }

    /** ブランド1検索(条件指定)
     * @param params
     * @return $rows
     */
    public function getBrand1($params)
    {
        $datas = $this->mtItemClassRepository->getBrand1($params);
        return $datas;
    }

    /** 競技・カテゴリ検索(条件指定)
     * @param params
     * @return $rows
     */
    public function getCategory($params)
    {
        $datas = $this->mtItemClassRepository->getCategory($params);
        return $datas;
    }

    /** 販売開始年検索(条件指定)
     * @return $rows
     */
    public function getItemClassThing4($params)
    {
        $datas = $this->mtItemClassRepository->getItemClassThing4($params);
        return $datas;
    }

    /** 工場分類5検索(条件指定)
     * @return $rows
     */
    public function getItemClassThing5($params)
    {
        $datas = $this->mtItemClassRepository->getItemClassThing5($params);
        return $datas;
    }

    /** 製品/工賃6検索(条件指定)
     * @return $rows
     */
    public function getItemClassThing6($params)
    {
        $datas = $this->mtItemClassRepository->getItemClassThing6($params);
        return $datas;
    }

    /** 資産在庫JA検索(条件指定)
     * @return $rows
     */
    public function getItemClassThing7($params)
    {
        $datas = $this->mtItemClassRepository->getItemClassThing7($params);
        return $datas;
    }

    /** 初期データ取得(コード:1)
     * @return $rows
     */
    public function getInitData1()
    {
        $datas = $this->mtItemClassRepository->getInitData1();
        return $datas;
    }

    /** 初期データ取得(コード:2)
     * @return $rows
     */
    public function getInitData2()
    {
        $datas = $this->mtItemClassRepository->getInitData2();
        return $datas;
    }

    /** 初期データ取得(コード:3)
     * @return $rows
     */
    public function getInitData3()
    {
        $datas = $this->mtItemClassRepository->getInitData3();
        return $datas;
    }

    /** 初期データ取得(コード:4)
     * @return $rows
     */
    public function getInitData4()
    {
        $datas = $this->mtItemClassRepository->getInitData4();
        return $datas;
    }

    /** 初期データ取得(コード:5)
     * @return $rows
     */
    public function getInitData5()
    {
        $datas = $this->mtItemClassRepository->getInitData5();
        return $datas;
    }

    /** 初期データ取得(コード:6)
     * @return $rows
     */
    public function getInitData6()
    {
        $datas = $this->mtItemClassRepository->getInitData6();
        return $datas;
    }

    /** 初期データ取得(コード:7)
     * @return $rows
     */
    public function getInitData7()
    {
        $datas = $this->mtItemClassRepository->getInitData7();
        return $datas;
    }

    /** コード補完(code指定)
     * @param $code, $def_item_class_thing_id
     * @return $rows
     */
    public function codeAutoComplete($code, $def_item_class_thing_id)
    {
        $datas = $this->mtItemClassRepository->getByCode($code, $def_item_class_thing_id);
        return $datas;
    }
}
?>
