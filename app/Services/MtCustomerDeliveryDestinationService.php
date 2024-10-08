<?php

namespace App\Services;

use App\Repositories\MtCustomerDeliveryDestination\MtCustomerDeliveryDestinationRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Consts\CommonConsts;
/**
 * 得意先納品先マスタ関連 サービスクラス
 */
class MtCustomerDeliveryDestinationService
{

    /**
     * @var MtCustomerDeliveryDestinationRepository
     */
    private MtCustomerDeliveryDestinationRepository $MtCustomerDeliveryDestinationRepository;

    /**
     * @param MtCustomerDeliveryDestinationRepository $MtCustomerDeliveryDestinationRepository
     */
    public function __construct()
    {
        $this->MtCustomerDeliveryDestinationRepository = new MtCustomerDeliveryDestinationRepository();
    }

    /** 納品先  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        //$datas = $this->MtCustomerDeliveryDestinationRepository->getAll();
        //return $datas;
    }

    /** 納品先  初期データ取得
     *
     * @return $rows
     */
    public function getInitData()
    {
        //$datas = $this->MtCustomerDeliveryDestinationRepository->getInitData();
        //return $datas;
    }

    /** コード補完(code指定)
     * @param $code
     * @return $rows
     */
    public function codeAutoComplete($customerCode, $deliveryDestinationCode)
    {
        $datas = $this->MtCustomerDeliveryDestinationRepository->getByCode($customerCode, $deliveryDestinationCode);
        return $datas;
    }
}
