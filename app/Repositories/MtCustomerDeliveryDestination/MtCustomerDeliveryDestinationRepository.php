<?php

namespace App\Repositories\MtCustomerDeliveryDestination;

use App\Models\MtCustomerDeliveryDestination;
use App\Models\MtCustomer;
use App\Models\MtDeliveryDestination;
use App\Models\Numbering;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class MtCustomerDeliveryDestinationRepository implements MtCustomerDeliveryDestinationRepositoryInterface
{

    /**
     * 得意先別納品先マスタ 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtCustomerDeliveryDestination::get();
        return $result;
    }

    /**
     * 得意先別納品先マスタ ID指定
     * @param $id
     * @return Object
     */
    public function getById($id)
    {
        $result = MtCustomerDeliveryDestination::where('id', $id)->get();
        return $result;
    }

    /**
     * 使用できる納品先コードを取得
     * @param $id
     * @return Object
     */
    public function getNextDeliveryDestinationId()
    {
        $numbering = Numbering::first();
        $delivery_destination_id = intval($numbering->now_delivery_destination_id);

        $deliveryDestination = "";
        while (!is_null($deliveryDestination)) {
            $delivery_destination_id++;
            $deliveryDestination = MtDeliveryDestination::where('delivery_destination_id', str_pad($delivery_destination_id, 6, 0, STR_PAD_LEFT))->first();
        }
        return str_pad($delivery_destination_id, 6, 0, STR_PAD_LEFT);
    }

    public function getCustomerDeliveryDestination($customer_id, $delivery_destination_id)
    {
        $result = MtCustomerDeliveryDestination::where('mt_customer_id', $customer_id)->where('mt_delivery_destination_id', $delivery_destination_id)->first();
        return $result;
    }

    /**
     * 名称補完(code指定)
     * @param $code
     * @return Object
     */
    public function getByCode($customerCode, $deliveryDestinationCode)
    {
        $minId = MtDeliveryDestination::orderBy('delivery_destination_id')->first();
        $maxId = MtDeliveryDestination::orderByDesc('delivery_destination_id')->first();
        $result['minCode'] = $minId['delivery_destination_id'];
        $result['maxCode'] = $maxId['delivery_destination_id'];

        // 得意先マスタコードのみの場合
        if (!empty($customerCode) && empty($deliveryDestinationCode)) {
            $customer = MtCustomer::where('customer_cd', $customerCode)->first();
            if (empty($customer)) {
                $result['customer'] = null;
                $result['data'] = null;
                $result['flg'] = null;
                $result['delivery_destination'] = null;
                return $result;
            } else {
                $result['customer'] = $customer;
                $result['data'] = null;
                $result['flg'] = null;
                $result['delivery_destination'] = null;
                return $result;
            }
        }
        // 納品先マスタコードのみの場合
        if (empty($customerCode) && !empty($deliveryDestinationCode)) {
            $deliveryDestination = MtDeliveryDestination::where('delivery_destination_id', $deliveryDestinationCode)->first();
            if (empty($deliveryDestination)) {
                $result['customer'] = null;
                $result['data'] = null;
                $result['flg'] = null;
                $result['delivery_destination'] = null;
                $result['new_delivery_destination_code'] = $this->getNextDeliveryDestinationId();
                return $result;
            } else {
                $result['customer'] = null;
                $result['data'] = null;
                $result['flg'] = null;
                $result['delivery_destination'] = $deliveryDestination;
                $result['data'] =
                    MtCustomerDeliveryDestination::select(
                        'mt_customer_delivery_destinations.*',
                        'def_arrival_dates.arrival_date_cd',
                        'def_arrival_dates.arrival_date_name',
                        'mt_roots.root_cd',
                        'mt_roots.root_name',
                        'mt_item_classes.item_class_cd',
                        'mt_item_classes.item_class_name',
                    )->leftJoin('def_arrival_dates', 'mt_customer_delivery_destinations.def_arrival_date_id', 'def_arrival_dates.id')
                    ->leftJoin('mt_roots', 'mt_customer_delivery_destinations.mt_root_id', 'mt_roots.id')
                    ->leftJoin('mt_item_classes', 'mt_customer_delivery_destinations.mt_item_class_shipping_companie_id', 'mt_item_classes.id')
                    ->where('mt_delivery_destination_id', $deliveryDestination['id'])
                    ->orderBy('updated_at')->first();
                return $result;
            }
        }
        // 得意先マスタコード、納品先マスタコードのどちらも入力されている場合
        if (!empty($customerCode) && !empty($deliveryDestinationCode)) {
            $customer = MtCustomer::where('customer_cd', $customerCode)->first();
            $deliveryDestination = MtDeliveryDestination::where('delivery_destination_id', $deliveryDestinationCode)->first();

            if (empty($customer) && empty($deliveryDestination)) {
                $result['customer'] = null;
                $result['data'] = null;
                $result['flg'] = null;
                $result['delivery_destination'] = null;
                $result['new_delivery_destination_code'] = $this->getNextDeliveryDestinationId();

                return $result;
            }
            if (!empty($customer) && empty($deliveryDestination)) {
                $result['customer'] = $customer;
                $result['data'] = null;
                $result['flg'] = null;
                $result['delivery_destination'] = null;
                $result['new_delivery_destination_code'] = $this->getNextDeliveryDestinationId();
                return $result;
            }
            if (empty($customer) && !empty($deliveryDestination)) {
                $result['customer'] = null;
                $result['data'] = null;
                $result['flg'] = null;
                $result['delivery_destination'] = $deliveryDestination;
                return $result;
            }

            $result['customer'] = $customer;
            $result['delivery_destination'] = $deliveryDestination;
            $result['data'] = MtCustomerDeliveryDestination::select(
                'mt_customer_delivery_destinations.*',
                'def_arrival_dates.arrival_date_cd',
                'def_arrival_dates.arrival_date_name',
                'mt_roots.root_cd',
                'mt_roots.root_name',
                'mt_item_classes.item_class_cd',
                'mt_item_classes.item_class_name',
            )->leftJoin('def_arrival_dates', 'mt_customer_delivery_destinations.def_arrival_date_id', 'def_arrival_dates.id')
                ->leftJoin('mt_roots', 'mt_customer_delivery_destinations.mt_root_id', 'mt_roots.id')
                ->leftJoin('mt_item_classes', 'mt_customer_delivery_destinations.mt_item_class_shipping_companie_id', 'mt_item_classes.id')
                ->where('mt_customer_id', $customer['id'])->where('mt_delivery_destination_id', $deliveryDestination['id'])->first();

            if (empty($result['data'])) {
                $result['data'] =
                    MtCustomerDeliveryDestination::select(
                        'mt_customer_delivery_destinations.*',
                        'def_arrival_dates.arrival_date_cd',
                        'def_arrival_dates.arrival_date_name',
                        'mt_roots.root_cd',
                        'mt_roots.root_name',
                        'mt_item_classes.item_class_cd',
                        'mt_item_classes.item_class_name',
                    )->leftJoin('def_arrival_dates', 'mt_customer_delivery_destinations.def_arrival_date_id', 'def_arrival_dates.id')
                    ->leftJoin('mt_roots', 'mt_customer_delivery_destinations.mt_root_id', 'mt_roots.id')
                    ->leftJoin('mt_item_classes', 'mt_customer_delivery_destinations.mt_item_class_shipping_companie_id', 'mt_item_classes.id')
                    ->where('mt_delivery_destination_id', $deliveryDestination['id'])
                    ->orderBy('updated_at')->first();
                $result['flg'] = 0;
            } else {
                $result['flg'] = 1;
            }
            return $result;
        }
    }
}
