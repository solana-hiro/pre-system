<?php

namespace App\Repositories\MtCustomerOtherItemRate;

use App\Models\MtCustomerOtherItemRate;
use App\Models\MtCustomer;
use App\Models\MtCustomerClass;
use App\Models\MtItem;
use App\Consts\CommonConsts;
use App\Lib\DateUtil;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtCustomerOtherItemRateRepository implements MtCustomerOtherItemRateRepositoryInterface
{

    /**
     * 商品掛率情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtCustomerOtherItemRate::get();
        return $result;
    }

    /**
     * 商品掛率(一覧) 更新
     * @param $param
     * @return Object
     */
    public function update($params)
    {

        $result = array();
        try {
            DB::beginTransaction();
            $kbn = $params['kbn'];
            $customerId = $params['customer_id'];
            foreach ($params['items'] as $itemParams) {
                if ($this->isDelete($itemParams)) {
                    $this->deleteCustomerOtherItemRate($itemParams);
                    continue;
                };
                if ($this->isContinue($itemParams)) continue;

                $record = $this->loadRecord($customerId, $itemParams['mt_item_id']);
                is_null($record)
                    ? $this->createCustomerOtherItemRate($customerId, $itemParams)
                    : $this->updateCustomerOtherItemRate($kbn, $record, $itemParams);
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    private function isContinue($itemParams)
    {
        return is_null($itemParams['rate']);
    }

    private function isDelete($itemParams)
    {
        return !is_null($itemParams['mt_customer_other_item_rate_id'])
            && is_null($itemParams['item_cd']);
    }

    private function deleteCustomerOtherItemRate($itemParams)
    {
        MtCustomerOtherItemRate::destroy($itemParams['mt_customer_other_item_rate_id']);
    }

    private function loadRecord($customerId, $itemId)
    {
        $query = MtCustomerOtherItemRate::query();
        $query->where('mt_customer_id', $customerId);
        $query->where('mt_item_id', $itemId);
        return $query->first();
    }

    private function updateCustomerOtherItemRate($kbn, $record, $itemParams)
    {
        $kbn == 0
            ? $this->updateCustomerOtherItemRateForNew($record, $itemParams)
            : $this->updateCustomerOtherItemRateForFix($record, $itemParams);
    }

    private function createCustomerOtherItemRate($customerId, $itemParams)
    {
        $record = new MtCustomerOtherItemRate();
        $record->mt_customer_id = $customerId;
        $record->mt_item_id = $itemParams['mt_item_id'];
        $record = $this->setParams($record, $itemParams);
        $record->save();
    }

    private function updateCustomerOtherItemRateForNew($record, $itemParams)
    {
        $record->dataBackup();
        $record = $this->setParams($record, $itemParams);
        $record->save();
    }

    private function updateCustomerOtherItemRateForFix($record, $itemParams)
    {
        $record = $this->setParams($record, $itemParams);
        $record->save();
    }

    private function setParams($record, $itemParams)
    {
        $record->rate = $itemParams['rate'];
        $record->start_date = $this->paramsToDateTime($itemParams['start']);
        $record->end_date = $this->paramsToDateTime($itemParams['end']);
        $record->mt_user_last_update_id = Auth::user()->id;
        return $record;
    }

    private function paramsToDateTime($dateParams)
    {
        if (is_null($dateParams['year'])) return null;

        return DateUtil::paramToDateTime($dateParams['year'], $dateParams['month'], $dateParams['day']);
    }

    /**
     * 商品掛率情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($customerId)
    {
        $query = MtCustomerOtherItemRate::query();
        $query->where('mt_customer_id', $customerId);
        $query->with('mtItem');

        return $query->paginate(CommonConsts::PAGINATION_10);
    }

    public function existsItemRates($customerId)
    {
        $query = MtCustomerOtherItemRate::query();
        is_null($customerId)
            ? $query->whereNull('mt_customer_id')
            : $query->where('mt_customer_id', $customerId);

        return $query->exists();
    }

    /**
     * 商品掛率情報取得 ClassIdにて取得
     * @param $classId
     * @return Object
     */
    public function getByClassId($classId)
    {
        $classData = MtCustomerClass::where('id', $classId)->first();
        $classThingId = $classData['def_customer_class_thing_id'];
        if ($classThingId === 1) {
            $columnName = 'mt_customers.mt_customer_class1_id';
        } elseif ($classThingId === 2) {
            $columnName = 'mt_customers.mt_customer_class2_id';
        } elseif ($classThingId === 3) {
            $columnName = 'mt_customers.mt_customer_class3_id';
        }

        $result = MtCustomer::select(
            'mt_customers.id as customer_id',
            'mt_customers.customer_cd',
            'mt_customers.mt_customer_class1_id',
            'mt_customers.mt_customer_class2_id',
            'mt_customers.mt_customer_class3_id',
            'mt_customers.mt_billing_address_id',
            'mt_customers.customer_name',
            'mt_billing_addresses.tax_kbn',
            'mt_customers.price_rate',
        )
            ->leftJoin('mt_billing_addresses', 'mt_customers.mt_billing_address_id', 'mt_billing_addresses.id')
            ->where($columnName, $classId)
            ->orderBy('mt_customers.customer_cd')->paginate(CommonConsts::PAGINATION_20);
        return $result;
    }

    /**
     * 商品掛率リスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params)
    {
        $customerStartCode = ($params['customer_code_start']) ? str_pad($params['customer_code_start'], 6, 0, STR_PAD_LEFT) : '';
        $customerEndCode = ($params['customer_code_end']) ? str_pad($params['customer_code_end'], 6, 0, STR_PAD_LEFT) : '999999';
        $itemStartCode = ($params['item_code_start']) ? $params['item_code_start'] : '';
        $itemEndCode = ($params['item_code_end']) ? $params['item_code_end'] : 'ZZZZZZZZZ';
        $customerIds = MtCustomer::whereBetween('customer_cd', [$customerStartCode, $customerEndCode])->pluck('id');
        $itemIds = MtItem::whereBetween('item_cd', [$itemStartCode, $itemEndCode])->pluck('id');
        $result = MtCustomerOtherItemRate::select(
            'mt_customers.customer_cd as customer_cd',
            'mt_customers.customer_name as customer_name',
            'mt_items.item_cd as item_cd',
            'mt_items.item_name as item_name',
            'mt_customer_other_item_rates.rate as rate',
            'mt_customer_other_item_rates.start_date as start_date',
            'mt_customer_other_item_rates.end_date as end_date',
            'mt_customer_other_item_rates.old_rate as old_rate',
            'mt_customer_other_item_rates.old_start_date as old_start_date',
            'mt_customer_other_item_rates.old_end_date as old_end_date'
        )
            ->leftJoin("mt_customers", "mt_customer_other_item_rates.mt_customer_id", "mt_customers.id")
            ->leftJoin("mt_items", "mt_customer_other_item_rates.mt_item_id", "mt_items.id")
            ->whereIn("mt_customer_other_item_rates.mt_customer_id", $customerIds)
            ->whereIn("mt_customer_other_item_rates.mt_item_id", $itemIds)
            ->orderBy("mt_customer_other_item_rates.id")
            ->get();
        return $result;
    }

    /**
     * 商品掛率情報取得 ClassIdにて取得
     * @param $classId
     * @return Object
     */
    public function getCustomerCode($classId)
    {
        $customerClass = MtCustomerClass::getCodeById($classId);
        return $customerClass;
    }

    /**
     * 名称補完(customerId指定)
     * @param $id
     * @return Object
     */
    public function getInitData($id)
    {
        $result = MtCustomerOtherItemRate::select(
            'mt_customer_other_item_rates.*',
            'mt_customers.customer_cd',
            'mt_customers.customer_name',
            'mt_items.item_cd',
            'mt_items.item_name',
        )
            ->leftJoin('mt_customers', 'mt_customer_other_item_rates.mt_customer_id', 'mt_customers.id')
            ->leftJoin('mt_items', 'mt_customer_other_item_rates.mt_item_id', 'mt_items.id')
            ->where('mt_customer_id', $id)->orderBy('id')->paginate(CommonConsts::PAGINATION_20);
        return $result;
    }

    public function getByCode($customerCd, $itemCd)
    {
        $customer = MtCustomer::where('customer_cd', $customerCd)->first();
        $item = MtItem::query()->where('item_cd', $itemCd)->first();

        $query = MtCustomerOtherItemRate::query();
        is_null($customer)
            ? $query->whereNull('mt_customer_id')
            : $query->where('mt_customer_id', $customer->id);
        $query->where('mt_item_id', $item?->id);

        return [
            'item' => $item,
            'customerItemRate' => $query->get()->first(),
        ];
    }
}
