<?php

namespace App\Repositories\MtBillingAddress;

use App\Models\MtBillingAddress;
use App\Models\MtCustomer;
use App\Models\TrnDemandHeader;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class MtBillingAddressRepository implements MtBillingAddressRepositoryInterface
{

    /**
     * 請求先情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtCustomer::leftJoin('mt_billing_addresses', 'mt_customers.mt_billing_address_id', 'mt_billing_addresses.id')
            ->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 請求先情報 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params)
    {
        $code = $params['customer_cd'] ? CodeUtil::pad($params['customer_cd'], 6) : null;
        $name = $params['customer_name'] ?? null;
        $kana = $params['customer_name_kana'] ?? null;
        $tel = $params['tel'] ?? null;

        // 請求先の名称などは請求先コード＝得意先コードとなる得意先マスタの情報を取得する
        // 得意先マスタの請求先マスタIDに紐づく請求先は別の店舗の請求先を設定することがあるため、正しくないケースがある。
        $query = MtBillingAddress::query();
        $query->leftJoin('mt_customers', 'mt_customers.customer_cd', 'mt_billing_addresses.billing_address_cd');
        $query->where("del_kbn", 0);
        $query->when($code, fn($query) => $query->where("customer_cd", '>=', $code));
        $query->when($name, fn($query) => $query->where("customer_name", 'like', "%$name%"));
        $query->when($kana, fn($query) => $query->where("customer_name_kana", 'like', "%$kana%"));
        $query->when($tel, fn($query) => $query->where("tel", 'like', "%$tel%"));
        $query->orderBy('billing_address_cd');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * 請求先情報取得 初期情報取得
     * @return Object
     */
    public function getInitData($id)
    {
        $result = MtBillingAddress::select(
            'mt_billing_addresses.*',
            'mt_customers.customer_name as customer_name',
            'mt_customers.post_number as post_number',
            'mt_customers.address as address',
            'mt_customers.tel as tel',
            'mt_customers.fax as fax',
        )
            ->leftJoin('mt_customers', 'mt_billing_addresses.id', 'mt_customers.mt_billing_address_id')
            ->where('mt_customers.id', $id)->first();
        return $result;
    }

    /**
     * 請求先情報取得 初期情報取得(随時締)
     * @return Object
     */
    public function getSequentiallyInitData($id)
    {
        $result = MtBillingAddress::select(
            'mt_billing_addresses.*',
            'mt_customers.customer_name as customer_name',
            'mt_customers.post_number as post_number',
            'mt_customers.address as address',
            'mt_customers.tel as tel',
            'mt_customers.fax as fax',
        )
            ->leftJoin('mt_customers', 'mt_billing_addresses.id', 'mt_customers.mt_billing_address_id')
            ->where('mt_customers.id', $id)->first();
        //最新の請求ヘッダ>請求締日
        $trnDemandHeader = TrnDemandHeader::where('mt_billing_address_id', $result['id'])->orderByDesc('updated_at')->first();
        $result['demand_closing_date'] = empty($trnDemandHeader) ? '' : $trnDemandHeader['demand_closing_date'];
        return $result;
    }

    /**
     * 請求先情報取得 初期情報取得(解除)
     * @return Object
     */
    public function getClosingInitData($id)
    {
        $result = MtBillingAddress::select(
            'mt_billing_addresses.*',
            'mt_customers.customer_name as customer_name',
            'mt_customers.post_number as post_number',
            'mt_customers.address as address',
            'mt_customers.tel as tel',
            'mt_customers.fax as fax',
        )
            ->leftJoin('mt_customers', 'mt_billing_addresses.id', 'mt_customers.mt_billing_address_id')
            ->where('mt_customers.id', $id)->first();
        //最新の請求ヘッダ>請求締日, 1こ前
        $trnDemandHeader = TrnDemandHeader::where('mt_billing_address_id', $result['id'])->orderByDesc('updated_at')->first();
        $result['demand_closing_date'] = empty($trnDemandHeader) ? null : $trnDemandHeader['demand_closing_date'];
        if (empty($trnDemandHeader)) {
            $result['demand_closing_date_before'] = null;
        } else {
            $trnDemandHeaderBefore = TrnDemandHeader::where('mt_billing_address_id', $result['id'])->whereNot('id', $trnDemandHeader['id'])->orderByDesc('updated_at')->first();
            $result['demand_closing_date_before'] = empty($trnDemandHeaderBefore) ? null : $trnDemandHeaderBefore['demand_closing_date'];
        }
        return $result;
    }

    /**
     * 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['billing_address_cd'] ? CodeUtil::pad($params['billing_address_cd'], 6) : null;

        // 請求先コードと得意先コードが一致する得意先マスタデータを取得（エラーチェック用）
        $result = MtBillingAddress::leftJoin('mt_customers', 'mt_customers.customer_cd', 'mt_billing_addresses.billing_address_cd')->where('billing_address_cd', $code)->first();
        return $result;
    }

    public function getById($id)
    {
        return MtBillingAddress::find($id);
    }
}
