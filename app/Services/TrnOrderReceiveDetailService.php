<?php

namespace App\Services;

use App\Repositories\TrnOrderReceiveHeader\TrnOrderReceiveHeaderRepository;
use App\Repositories\TrnOrderReceiveDetail\TrnOrderReceiveDetailRepository;
use App\Repositories\MtBillingAddress\MtBillingAddressRepository;
use App\Repositories\MtCustomer\MtCustomerRepository;
use App\Repositories\MtCustomerDeliveryDestination\MtCustomerDeliveryDestinationRepository;
use App\Http\Resources\TrnOrderReceiveHeader\ShippingInquiryListResource;
use App\Http\Resources\TrnOrderReceiveHeader\AccountantInquiryListResource;
use Illuminate\Support\Facades\Log;

/**
 * 受注明細関連 サービスクラス
 */
class TrnOrderReceiveDetailService
{
    /**
     * @var trnOrderReceiveDetailRepository
     */
    private TrnOrderReceiveDetailRepository $trnOrderReceiveDetailRepository;

    /**
     * @param TrnOrderReceiveDetailRepository $trnOrderReceiveDetailRepository
     */
    public function __construct()
    {
        $this->trnOrderReceiveDetailRepository = new TrnOrderReceiveDetailRepository();
    }

    public function exportPaymentGuidance($params)
    {
        $data = $this->trnOrderReceiveDetailRepository->exportPaymentGuidanceExcel($params);
        return $data;
    }

    public function createTrnOrderReceiveDetail($params, $header_id)
    {
        $details = $params['details'];
        foreach ($details as $detail) {
          $this->trnOrderReceiveDetailRepository->create($detail, $header_id, $params);
        }
        return true;
    }

    public function checkProcessKbnWithOutOfStock($params)
    {
        $details = $params['details'];
        // shortage_flgが1の場合、process_kbnが0なのかをチェックしてエラーメッセージを出す
        foreach ($details as $detail) {
            if ($detail['shortage_flg'] == 1 && $params['process_kbn'] == 0) {
                return '欠品があるため、処理区分"なし"では登録できません。';
            }
        }
        return false;
    }

    public function checkSpecifyDeadline($params)
    {
        $details = $params['details'];
        foreach ($details as $detail) {
            if ($detail['specify_deadline_none_flg'] == 1 && $params['process_kbn'] == 2) {
                return '指定納期が、予定なしが存在するため、"揃出"は指定できません';
            }
            if ($detail['specify_deadline_none_flg'] == 0 && $detail['specify_deadline'] == null && $params['process_kbn'] == 2) {
                return '指定納期が、予定なしが存在するため、"揃出"は指定できません';
            }
        }
        return false;
    }

    public function checkOrderReceiveAmount($params)
    {
        $details = $params['details'];
        foreach ($details as $detail) {
            if (!isset($detail['order_receive_amount']) || $detail['order_receive_amount'] == null) {
                return '受注金額未設定では登録できません';
            }
        }
        return false;
    }

    public function checkCreditLimit($params)
    {
        $mt_customer = (new MtCustomerRepository())->getById($params['mt_customer_id']);
        $order_receive_amount = intval($params['amount_total']);
        $credit_limit_amount_check_flg = $mt_customer->credit_limit_amount_check_flg;
        if ($credit_limit_amount_check_flg == 1) {
            $mt_billing_address = (new MtBillingAddressRepository())->getById($mt_customer->mt_billing_address_id);
            $credit_amount = intval($mt_billing_address->credit_amount);
            $credit_limit_amount = intval($mt_billing_address->credit_limit_amount);
            if ($credit_amount + $order_receive_amount > $credit_limit_amount) {
                $formatted_credit_limit_amount = number_format($credit_limit_amount);
                return "与信限度額￥".$formatted_credit_limit_amount."を超過しています。登録しますか？";
            }
        }

        return false;
    }

    public function checkCommission($params)
    {
        $mt_customer_delivery_destination = (new MtCustomerDeliveryDestinationRepository())->getCustomerDeliveryDestination($params['mt_customer_id'], $params['mt_delivery_destination_id']);
        if ($mt_customer_delivery_destination == null) {
            return false;
        }
        $direct_delivery_commission_demand_flg = $mt_customer_delivery_destination->direct_delivery_commission_demand_flg;
        if ($direct_delivery_commission_demand_flg == 1) {
            return '手数料明細を自動生成しますか？';
        }
        return false;
    }
}
