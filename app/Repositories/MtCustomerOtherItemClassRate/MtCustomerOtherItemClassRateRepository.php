<?php

namespace App\Repositories\MtCustomerOtherItemClassRate;

use App\Models\MtCustomerOtherItemClassRate;
use App\Models\MtCustomer;
use App\Models\MtItemClass;
use App\Consts\CommonConsts;
use App\Lib\DateUtil;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtCustomerOtherItemClassRateRepository implements MtCustomerOtherItemClassRateRepositoryInterface
{

    /**
     * 商品分類掛率情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtCustomerOtherItemClassRate::get();
        return $result;
    }

    /**
     * 商品分類掛率(一覧) 更新
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
            foreach ($params['item_classes'] as $itemClassParams) {
                if ($this->isDelete($itemClassParams)) {
                    $this->deleteCustomerOtherItemClassRate($itemClassParams);
                    continue;
                }
                if ($this->isContinue($itemClassParams)) continue;

                $record = $this->loadRecord($customerId, $itemClassParams['mt_item_class_id']);
                is_null($record)
                    ? $this->createCustomerOtherItemClassRate($customerId, $itemClassParams)
                    : $this->updateCustomerOtherItemClassRate($kbn, $record, $itemClassParams);
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

    private function isContinue($itemClassParams)
    {
        // Rateが空の場合は何もせずスキップ
        return is_null($itemClassParams['rate']);
    }

    private function isDelete($itemClassParams)
    {
        return !is_null($itemClassParams['mt_customer_other_item_class_rate_id'])
            && is_null($itemClassParams['item_class_cd']);
    }

    private function deleteCustomerOtherItemClassRate($itemClassParams)
    {
        MtCustomerOtherItemClassRate::destroy($itemClassParams['mt_customer_other_item_class_rate_id']);
    }

    private function loadRecord($customerId, $itemClassId)
    {
        $query = MtCustomerOtherItemClassRate::query();
        $query->where('mt_customer_id', $customerId);
        $query->where('mt_item_class_id', $itemClassId);
        return $query->first();
    }

    private function updateCustomerOtherItemClassRate($kbn, $record, $itemClassParams)
    {
        $kbn == 0
            ? $this->updateCustomerOtherItemClassRateForNew($record, $itemClassParams)
            : $this->updateCustomerOtherItemClassRateForFix($record, $itemClassParams);
    }

    private function createCustomerOtherItemClassRate($customerId, $itemClassParams)
    {
        $record = new MtCustomerOtherItemClassRate();
        $record->mt_customer_id = $customerId;
        $record->mt_item_class_id = $itemClassParams['mt_item_class_id'];
        $record = $this->setParams($record, $itemClassParams);
        $record->save();
    }

    private function updateCustomerOtherItemClassRateForNew($record, $itemClassParams)
    {
        $record->dataBackup();
        $record = $this->setParams($record, $itemClassParams);
        $record->save();
    }

    private function updateCustomerOtherItemClassRateForFix($record, $itemClassParams)
    {
        $record = $this->setParams($record, $itemClassParams);
        $record->save();
    }

    private function setParams($record, $itemClassParams)
    {
        $record->rate = $itemClassParams['rate'];
        $record->start_date = $this->paramsToDateTime($itemClassParams['start']);
        $record->end_date = $this->paramsToDateTime($itemClassParams['end']);
        $record->mt_user_last_update_id = Auth::user()->id;
        return $record;
    }

    private function paramsToDateTime($dateParams)
    {
        if (is_null($dateParams['year'])) return null;

        return DateUtil::paramToDateTime($dateParams['year'], $dateParams['month'], $dateParams['day']);
    }

    /**
     * 商品分類掛率情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($customerId)
    {
        $query = MtCustomerOtherItemClassRate::query();
        $query->where('mt_customer_id', $customerId);
        $query->with('mtItemClass');

        return $query->paginate(CommonConsts::PAGINATION_10);
    }

    public function existsItemClassRates($customerId)
    {
        $query = MtCustomerOtherItemClassRate::query();
        is_null($customerId)
            ? $query->whereNull('mt_customer_id')
            : $query->where('mt_customer_id', $customerId);

        return $query->exists();
    }

    /**
     * 商品分類掛率リスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params)
    {
        $customerStartCode = ($params['customer_code_start']) ? str_pad($params['customer_code_start'], 6, 0, STR_PAD_LEFT) : '';
        $customerEndCode = ($params['customer_code_end']) ? str_pad($params['customer_code_end'], 6, 0, STR_PAD_LEFT) : 'ZZZZZZ';
        $brandStartCode = ($params['brand_code_start']) ? $params['brand_code_start'] : '';
        $brandEndCode = ($params['brand_code_end']) ? $params['brand_code_end'] : 'ZZZZZZ';
        $customerIds = MtCustomer::whereBetween('customer_cd', [$customerStartCode, $customerEndCode])->pluck('id');
        $brandIds = MtItemClass::where('def_item_class_thing_id', 1)->whereBetween('item_class_cd', [$brandStartCode, $brandEndCode])->pluck('id');
        $result = MtCustomerOtherItemClassRate::select(
            'mt_customers.customer_cd as customer_cd',
            'mt_customers.customer_name as customer_name',
            'mt_item_classes.item_class_cd as item_class_cd',
            'mt_item_classes.item_class_name as item_class_name',
            'mt_customer_other_item_class_rates.rate as rate',
            'mt_customer_other_item_class_rates.start_date as start_date',
            'mt_customer_other_item_class_rates.end_date as end_date',
            'mt_customer_other_item_class_rates.old_rate as old_rate',
            'mt_customer_other_item_class_rates.old_start_date as old_start_date',
            'mt_customer_other_item_class_rates.old_end_date as old_end_date',
        )
            ->leftJoin("mt_customers", "mt_customer_other_item_class_rates.mt_customer_id", "mt_customers.id")
            ->leftJoin("mt_item_classes", "mt_customer_other_item_class_rates.mt_item_class_id", "mt_item_classes.id")
            ->when($params['customer_code_start'], function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("mt_customers.customer_cd", '>=', $params['customer_code_start']);
                });
            })->when($params['customer_code_end'], function ($query) use ($customerEndCode) {
                return $query->where(function ($query) use ($customerEndCode) {
                    return $query->where("mt_customers.customer_cd", '<=', $customerEndCode);
                });
            })->whereIn("mt_customer_other_item_class_rates.mt_item_class_id", $brandIds)
            ->where("mt_item_classes.def_item_class_thing_id", 1)
            ->orderBy("mt_customers.customer_cd")
            ->orderBy('mt_item_classes.item_class_cd')
            ->get();
        return $result;
    }

    /**
     * 売価情報(一覧) 更新
     * @param $param
     * @return Object
     */
    public function updateSellingPrice($params)
    {
        //$result = MtCustomerOtherItemClassRate::get();
        //return $result;
    }

    /**
     * 売価情報リスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function exportSellingPrice($params)
    {
        //$result = MtCustomerOtherItemClassRate::get();
        //return $result;
    }

    /**
     * 名称補完(customerId指定)
     * @param $id
     * @return Object
     */
    public function getInitData($id)
    {
        $result = MtCustomerOtherItemClassRate::select(
            'mt_customer_other_item_class_rates.*',
            'mt_customers.customer_cd',
            'mt_customers.customer_name',
            'mt_item_classes.item_class_cd',
            'mt_item_classes.item_class_name',
        )
            ->leftJoin('mt_customers', 'mt_customer_other_item_class_rates.mt_customer_id', 'mt_customers.id')
            ->leftJoin('mt_item_classes', 'mt_customer_other_item_class_rates.mt_item_class_id', 'mt_item_classes.id')
            ->where('mt_customer_id', $id)->orderBy('id')->paginate(CommonConsts::PAGINATION_20);
        return $result;
    }

    public function getByCode($customerCd, $itemClassCd)
    {
        $customer = MtCustomer::where('customer_cd', $customerCd)->first();
        $itemClass = MtItemClass::query()->where([['item_class_cd', $itemClassCd], ['def_item_class_thing_id', 1]])->first();

        $query = MtCustomerOtherItemClassRate::query();
        is_null($customer)
            ? $query->whereNull('mt_customer_id')
            : $query->where('mt_customer_id', $customer->id);
        $query->where('mt_item_class_id', $itemClass?->id);

        return [
            'itemClass' => $itemClass,
            'customerItemClassRate' => $query->get()->first(),
        ];
    }
}
