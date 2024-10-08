<?php

namespace App\Services;

use App\Repositories\TrnOrderReceiveHeader\TrnOrderReceiveHeaderRepository;
use App\Repositories\MtWarehouse\MtWarehouseRepository;

use App\Http\Resources\TrnOrderReceiveHeader\ShippingInquiryListResource;
use App\Http\Resources\TrnOrderReceiveHeader\AccountantInquiryListResource;
use Illuminate\Support\Facades\Log;

/**
 * 受注ヘッダ関連 サービスクラス
 */
class TrnOrderReceiveHeaderService
{

    /**
     * @var trnOrderReceiveHeaderRepository
     */
    private TrnOrderReceiveHeaderRepository $trnOrderReceiveHeaderRepository;

    /**
     * @param TrnOrderReceiveHeaderRepository $trnOrderReceiveHeaderRepository
     */
    public function __construct()
    {
        $this->trnOrderReceiveHeaderRepository = new TrnOrderReceiveHeaderRepository();
    }

    /** 受注ヘッダ  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->trnOrderReceiveHeaderRepository->getAll();
        return $datas;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function get($params)
    {
        $datas = $this->trnOrderReceiveHeaderRepository->get($params);
        return $datas;
    }

    /** 受注問合せ  取得
     *
     * @return $rows
     */
    public function getAccountantInquiry($params)
    {
        $datas = $this->trnOrderReceiveHeaderRepository->getAccountantInquiry($params);
        $result = new AccountantInquiryListResource($datas);
        return $datas;
    }

    /** 入出荷予定問合せ  取得
     *
     * @return $rows
     */
    public function getShippingInquiry($params)
    {
        $datas = $this->trnOrderReceiveHeaderRepository->getShippingInquiry($params);
        return $datas;
    }

    /** 入出荷予定問合せ ファイル出力
     *
     * @return $rows
     */
    public function exportShippingInquiry($params)
    {
        $result = $this->trnOrderReceiveHeaderRepository->getShippingInquiry($params);
        //$result = ShippingInquiryListResource::collection($datas);
		return $result;
    }

    public function getAccountantDefaultData()
    {
        return $this->trnOrderReceiveHeaderRepository->getAccountantDefaultData();
    }

    public function createTrnOrderReceiveHeader($params)
    {
        $oldHeader = $this->trnOrderReceiveHeaderRepository->getByReceiveNumber($params['order_receive_number']);

        if ($oldHeader) {
            return false;
        }

        $mt_warehouse = MtWarehouseRepository::getByCode(['warehouse_cd' => $params['mt_warehouse_id']]);

        $trnOrderReceiveHeaderParams = [
            'order_receive_number' => $params['order_receive_number'],
            'order_date' => $params['order_date_year'] . '-' . $params['order_date_month'] . '-' . $params['order_date_day'],
            'user_cd' => $params['user_cd'],
            'ec_order_receive_number' => $params['ec_order_receive_number'],
            'mt_order_receive_sticky_note_id' => $params['mt_order_receive_sticky_note_id'],
            'mt_customer_id' => $params['mt_customer_id'],
            'mt_manager_id' => isset($params['mt_manager_id']) ? $params['mt_manager_id'] : null,
            'mt_delivery_destination_id' => isset($params['mt_delivery_destination_id']) ? $params['mt_delivery_destination_id'] : null,
            'order_number' => $params['order_number'],
            'mt_warehouse_id' => $mt_warehouse->id,
            'payment_kbn' => isset($params['payment_kbn']) ? $params['payment_kbn'] : null,
            'payment_guidance_kbn' => isset($params['payment_guidance_kbn']) ? $params['payment_guidance_kbn'] : 0,
            'payment_guidance_flg' => isset($params['payment_guidance_flg']) ? $params['payment_guidance_flg'] : 0,
            'shortage_guidance_flg' => isset($params['shortage_guidance_flg']) ? $params['shortage_guidance_flg'] : 0,
            'shipping_guidance_flg' => isset($params['shipping_guidance_flg']) ? $params['shipping_guidance_flg'] : 0,
            'keep_guidance_target_flg' => isset($params['keep_guidance_target_flg']) ? $params['keep_guidance_target_flg'] : 0,
            'keep_guidance_flg' => isset($params['keep_guidance_flg']) ? $params['keep_guidance_flg'] : 0,
            'keep_guidance_expiration_flg' => isset($params['keep_guidance_expiration_flg']) ? $params['keep_guidance_expiration_flg'] : 0,
            'process_kbn' => isset($params['process_kbn']) ? $params['process_kbn'] : 0,
            'slip_memo' => $params['slip_memo'],
            'customer_order_number' => $params['customer_order_number'],
            'separate_mail' => $params['separate_mail'],
            'shipping_document_description_need_column' => $params['shipping_document_description_need_column'],
            'business_memo' => $params['business_memo'],
            'mt_user_last_update_id' => $params['user_cd'],
            'customer_name' => $params['customer_name'],
            'customer_name_input_kbn' => $params['name_input_kbn'],
            'delivery_destination_name_input_kbn' => $params['delivery_destination_name_input_kbn'],
        ];

        $trnOrderReceiveHeader = $this->trnOrderReceiveHeaderRepository->createTrnOrderReceiveHeader($trnOrderReceiveHeaderParams);
        return $trnOrderReceiveHeader;
    }

    public function searchOrderReceiveList($params)
    {
        $datas = $this->trnOrderReceiveHeaderRepository->searchOrderReceiveList($params);
        return $datas;
    }

    public function updateAccountantList($params)
    {
        $this->trnOrderReceiveHeaderRepository->updateAccountantList($params);
    }
}
