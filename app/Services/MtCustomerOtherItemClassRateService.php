<?php

namespace App\Services;

use App\Repositories\MtCustomerOtherItemClassRate\MtCustomerOtherItemClassRateRepository;
use App\Http\Resources\MtCustomerOtherItemClassRate\MtCustomerOtherItemClassRateListResource;
use App\Lib\CodeUtil;
use Illuminate\Support\Facades\Log;

/**
 * 得意先掛率分類関連 サービスクラス
 */
class MtCustomerOtherItemClassRateService
{

    /**
     * @var mtCustomerOtherItemClassRateRepository
     */
    private MtCustomerOtherItemClassRateRepository $mtCustomerOtherItemClassRateRepository;

    /**
     * @param MtCustomerOtherItemClassRateRepository $mtCustomerOtherItemClassRateRepository
     */
    public function __construct()
    {
        $this->mtCustomerOtherItemClassRateRepository = new MtCustomerOtherItemClassRateRepository();
    }

    /** 得意先掛率分類  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtCustomerOtherItemClassRateRepository->getAll();
        return $datas;
    }

    /** 得意先掛率分類  更新
     * @param $params
     * @return $rows
     */
    public function getInitData($id)
    {
        $datas = $this->mtCustomerOtherItemClassRateRepository->getInitData($id);
        return $datas;
    }

    /** 得意先掛率分類  更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtCustomerOtherItemClassRateRepository->update($params);
        return $datas;
    }

    /** 得意先掛率分類  出力情報を取得
     * @param $params
     * @return $rows
     */
    public function export($params)
    {
        $result = $this->mtCustomerOtherItemClassRateRepository->export($params);
        $datas = MtCustomerOtherItemClassRateListResource::collection($result);
        return $datas;
    }

    /** 売価情報  更新
     * @param $params
     * @return $rows
     */
    public function updateSellingPrice($params)
    {
        $datas = $this->mtCustomerOtherItemClassRateRepository->updateSellingPrice($params);
        return $datas;
    }

    /** 売価情報  出力情報を取得
     * @param $params
     * @return $rows
     */
    public function exportSellingPrice($params)
    {
        $datas = $this->mtCustomerOtherItemClassRateRepository->exportSellingPrice($params);
        return $datas;
    }

    /** 商品分類掛率  指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        // $params['customer_id'] = 0 で呼び出される場合があるので 0 は null に変換する
        $customerId = $params['customer_id'] == 0 ? null : $params['customer_id'];

        $datas = $this->mtCustomerOtherItemClassRateRepository->get($customerId);
        return $datas;
    }

    public function existsItemClassRates($params)
    {
        $customerId = $params['customer_id'];

        $flag = $this->mtCustomerOtherItemClassRateRepository->existsItemClassRates($customerId);
        return $flag;
    }

    public function codeAutoComplete($params)
    {
        $customerCd = $params['customer_cd'] ? CodeUtil::pad($params['customer_cd'], 6) : null;
        $itemClassCd = $params['item_class_cd'];

        $datas = $this->mtCustomerOtherItemClassRateRepository->getByCode($customerCd, $itemClassCd);
        return $datas;
    }
}
