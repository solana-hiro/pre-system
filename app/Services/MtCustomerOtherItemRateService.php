<?php

namespace App\Services;

use App\Repositories\MtCustomerOtherItemRate\MtCustomerOtherItemRateRepository;
use App\Http\Resources\MtCustomerOtherItemRate\MtCustomerOtherItemRateListResource;
use App\Lib\CodeUtil;
use Illuminate\Support\Facades\Log;

/**
 * 得意先掛率関連 サービスクラス
 */
class MtCustomerOtherItemRateService
{

    /**
     * @var mtCustomerOtherItemRateRepository
     */
    private MtCustomerOtherItemRateRepository $mtCustomerOtherItemRateRepository;

    /**
     * @param MtCustomerOtherItemRateRepository $mtCustomerOtherItemRateRepository
     */
    public function __construct()
    {
        $this->mtCustomerOtherItemRateRepository = new MtCustomerOtherItemRateRepository();
    }

    /** 得意先掛率  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtCustomerOtherItemRateRepository->getAll();
        return $datas;
    }

    /** 得意先掛率  更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtCustomerOtherItemRateRepository->update($params);
        return $datas;
    }

    /** 得意先掛率  更新
     * @param $params
     * @return $rows
     */
    public function getInitData($id)
    {
        $datas = $this->mtCustomerOtherItemRateRepository->getInitData($id);
        return $datas;
    }

    /** 得意先掛率  出力情報を取得
     * @param $params
     * @return object
     */
    public function export($params)
    {
        $result = $this->mtCustomerOtherItemRateRepository->export($params);
        $datas = MtCustomerOtherItemRateListResource::collection($result);
        return $datas;
    }

    /** 得意先掛率  指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        // $params['customer_id'] = 0 で呼び出される場合があるので 0 は null に変換する
        $customerId = $params['customer_id'] == 0 ? null : $params['customer_id'];

        $datas = $this->mtCustomerOtherItemRateRepository->get($customerId);
        return $datas;
    }

    public function existsItemRates($params)
    {
        $customerId = $params['customer_id'];

        $flag = $this->mtCustomerOtherItemRateRepository->existsItemRates($customerId);
        return $flag;
    }

    public function codeAutoComplete($params)
    {
        $customerCd = $params['customer_cd'] ? CodeUtil::pad($params['customer_cd'], 6) : null;
        $itemCd = $params['item_cd'];

        $datas = $this->mtCustomerOtherItemRateRepository->getByCode($customerCd, $itemCd);
        return $datas;
    }
}
