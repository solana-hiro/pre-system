<?php

namespace App\Services;

use App\Repositories\MtShippingCompany\MtShippingCompanyRepository;
use App\Http\Resources\MtShippingCompany\MtShippingCompanyListResource;
use Illuminate\Support\Facades\Log;

/**
 * 運送会社関連 サービスクラス
 */
class MtShippingCompanyService
{

    /**
     * @var mtShippingCompanyRepository
     */
    private MtShippingCompanyRepository $mtShippingCompanyRepository;

    /**
     * @param MtShippingCompanyRepository $mtShippingCompanyRepository
     */
    public function __construct()
    {
        $this->mtShippingCompanyRepository = new MtShippingCompanyRepository();
    }

    /** 運送会社  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtShippingCompanyRepository->getAll();
        return $datas;
    }

    /** 運送会社  初期データ取得
     *
     * @return $rows
     */
    public function getInitData()
    {
        $datas = $this->mtShippingCompanyRepository->getInitData();
        return $datas;
    }

    /** 運送会社マスタ（一覧）  削除
     * @param $id
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtShippingCompanyRepository->delete($id);
        return $datas;
    }

    /** 運送会社マスタ（一覧）  更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtShippingCompanyRepository->update($params);
        return $datas;
    }

    /** 運送会社リスト(一覧)  出力情報を取得
     * @param $params
     * @return $rows
     */
    public function export($params)
    {
        $result = $this->mtShippingCompanyRepository->export($params);
        $datas = MtShippingCompanyListResource::collection($result);
        return $datas;
    }

    /** 運送会社  指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtShippingCompanyRepository->get($params);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->mtShippingCompanyRepository->getByCode($params);
        return $datas;
    }
}
