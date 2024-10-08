<?php

namespace App\Services;

use App\Repositories\MtCustomerClass\MtCustomerClassRepository;
use App\Http\Resources\MtCustomerClass\MtCustomerClassListResource;
use Illuminate\Support\Facades\Log;

/**
 * 得意先分類マスタ関連 サービスクラス
 */
class MtCustomerClassService
{

    /**
     * @var MtCustomerClassRepository
     */
    private MtCustomerClassRepository $mtCustomerClassRepository;

    /**
     * @param MtCustomerClassRepository $mtCustomerClassRepository
     */
    public function __construct()
    {
        $this->mtCustomerClassRepository = new MtCustomerClassRepository();
    }

    /** 得意先分類  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtCustomerClassRepository->getAll();
        return $datas;
    }

    /** 得意先分類  初期データ取得
     *
     * @return $rows
     */
    public function getInitData()
    {
        $datas = $this->mtCustomerClassRepository->getInitData();
        return $datas;
    }

    /** 得意先分類  更新
     *
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtCustomerClassRepository->update($params);
        return $datas;
    }

    /** 得意先分類  削除
     *
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtCustomerClassRepository->delete($id);
        return $datas;
    }

    /** 得意先分類  ファイル出力
     *
     * @return $rows
     */
    public function export($params)
    {
        $datas = $this->mtCustomerClassRepository->export($params);
        $result = MtCustomerClassListResource::collection($datas);
        return $result;
    }

    /** ランク3検索 全件取得
     * @return $rows
     */
    public function getAllRank3()
    {
        $datas = $this->mtCustomerClassRepository->getAllRank3();
        return $datas;
    }

    /** ランク3検索(条件指定)
     * @param $params
     * @return $rows
     */
    public function getRank3($params)
    {
        $datas = $this->mtCustomerClassRepository->getRank3($params);
        return $datas;
    }
    /** 業種・特徴2検索 全件取得
     * @return $rows
     */
    public function getAllIndustry()
    {
        $datas = $this->mtCustomerClassRepository->getAllIndustry();
        return $datas;
    }

    /** 業種・特徴2検索(条件指定)
     * @param $params
     * @return $rows
     */
    public function getIndustry($params)
    {
        $datas = $this->mtCustomerClassRepository->getIndustry($params);
        return $datas;
    }

    /** 販売パターン１検索 全件取得
     * @return $rows
     */
    public function getAllSalesPattern()
    {
        $datas = $this->mtCustomerClassRepository->getAllSalesPattern();
        return $datas;
    }

    /** 販売パターン１検索(条件指定)
     * @param $params
     * @return $rows
     */
    public function getSalesPattern($params)
    {
        $datas = $this->mtCustomerClassRepository->getSalesPattern($params);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $code, $def_customer_class_thing_id
     * @return $rows
     */
    public function codeAutoComplete($code, $def_customer_class_thing_id)
    {
        $datas = $this->mtCustomerClassRepository->getByCode($code, $def_customer_class_thing_id);
        return $datas;
    }

}
