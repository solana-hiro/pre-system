<?php

namespace App\Repositories\MtTaxRateSetting;

use App\Models\MtTaxRateSetting;
use App\Models\DefTaxRateKbn;
use App\Consts\CommonConsts;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtTaxRateSettingRepository implements MtTaxRateSettingRepositoryInterface
{

    /**
     * 税率区分定義情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtTaxRateSetting::paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 税率区分定義情報　初期データ取得
     * @return Object
     */
    public function getInitData()
    {
        $initCode = DefTaxRateKbn::where('tax_rate_kbn_cd', 1)->first();
        $result = MtTaxRateSetting::select('mt_tax_rate_settings.*', 'def_tax_rate_kbns.id as id_def_tax_rate_kbns', 'def_tax_rate_kbns.tax_rate_kbn_cd as tax_rate_kbn_cd', 'def_tax_rate_kbns.tax_rate_kbn_name')
            ->leftJoin('def_tax_rate_kbns', 'mt_tax_rate_settings.def_tax_rate_kbn_id', 'def_tax_rate_kbns.id')
            ->where('def_tax_rate_kbn_id', $initCode['id'])
            ->orderBy('tax_rate_kbn_cd')
            ->paginate(CommonConsts::PAGINATION_10);
        return $result;
    }

    /**
     * 税率区分定義情報　初期データ取得(ID指定)
     * @return Object
     */
    public function getInitDataById($code)
    {
        $initCode = DefTaxRateKbn::where('tax_rate_kbn_cd', $code)->first();
        $result = MtTaxRateSetting::select('mt_tax_rate_settings.*', 'def_tax_rate_kbns.id as id_def_tax_rate_kbns', 'def_tax_rate_kbns.tax_rate_kbn_cd as tax_rate_kbn_cd', 'def_tax_rate_kbns.tax_rate_kbn_name')
            ->leftJoin('def_tax_rate_kbns', 'mt_tax_rate_settings.def_tax_rate_kbn_id', 'def_tax_rate_kbns.id')
            ->where('def_tax_rate_kbn_id', $initCode['id'])
            ->orderBy('tax_rate_kbn_cd')
            ->paginate(CommonConsts::PAGINATION_10);
        return $result;
    }


    /**
     * 税率区分定義情報　マスタデータ取得
     * @return Object
     */
    public function getDefTaxRateKbns()
    {
        $result = DefTaxRateKbn::orderBy('tax_rate_kbn_cd')->get();
        return $result;
    }

    /**
     * 税率区分定義情報　削除
     * @param $id
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $result['data'] = MtTaxRateSetting::where('id', $id)->delete();
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * 税率区分定義更新
     * @param $params
     * @return Object
     */
    public function update($params)
    {
        $result = array();
        //try {
        DB::beginTransaction();
        $j = 0;
        foreach ($params['update_tax_rate'] as $param) {
            if (!empty($params['update_tax_rate'][$j])) {
                $taxRateKbnId = DefTaxRateKbn::where('tax_rate_kbn_cd', $params['tax_kbn_cd'])->first();
                $mtTaxRateSetting = MtTaxRateSetting::where('id', $params['update_id'][$j])->where('def_tax_rate_kbn_id', $taxRateKbnId['id'])->first();

                //変更の有無を確認
                $ymd = $params['update_release_start_datetime_year'][$j] . '-' . $params['update_release_start_datetime_month'][$j] . '-' . $params['update_release_start_datetime_day'][$j];
                if (
                    ($mtTaxRateSetting) &&
                    $mtTaxRateSetting['def_tax_rate_kbn_id'] === $taxRateKbnId['id'] &&
                    $mtTaxRateSetting['update_tax_rate'] === $params['update_tax_rate'][$j] &&
                    $mtTaxRateSetting['application_start_date'] === $ymd
                ) {
                    $j++;
                    continue; //変更がない場合、更新を行わない
                }
                if (
                    !($mtTaxRateSetting)
                ) {
                    $j++;
                    continue; //変更がない場合、更新を行わない
                }
                $mtTaxRateSetting->def_tax_rate_kbn_id = $taxRateKbnId['id'];
                $mtTaxRateSetting->application_start_date = $ymd;
                $mtTaxRateSetting->tax_rate = $params['update_tax_rate'][$j];
                $mtTaxRateSetting->mt_user_last_update_id = Auth::user()->id;
                $mtTaxRateSetting->save();
            }
            $j++;
        }

        //新規登録
        $i = 0;
        foreach ($params as $param) {
            if (!empty($params['insert_tax_rate'][$i])) {
                $taxRateKbnId = DefTaxRateKbn::where('tax_rate_kbn_cd', $params['tax_kbn_cd'])->first();
                $ymd = $params['insert_release_start_datetime_year'][$i] . '-' . $params['insert_release_start_datetime_month'][$i] . '-' . $params['insert_release_start_datetime_day'][$i];
                $mtTaxRateSetting = new MtTaxRateSetting();
                $mtTaxRateSetting->def_tax_rate_kbn_id = $taxRateKbnId['id'];
                $mtTaxRateSetting->application_start_date = $ymd;
                $mtTaxRateSetting->tax_rate = $params['insert_tax_rate'][$i];
                $mtTaxRateSetting->mt_user_last_update_id = Auth::user()->id;
                $mtTaxRateSetting->save();
            }
            $i++;
        }
        DB::commit();
        $result['status'] = CommonConsts::STATUS_SUCCESS;
        /*
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
            dd($e->getMessage());
        }
        */
        return $result;
    }

    /**
     * 税率区分定義 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params)
    {
        $datas = MtTaxRateSetting::when(isset($params['def_tax_rate_kbn_id']), function ($query) use ($params) {
            return $query->where(function ($query) use ($params) {
                return $query->where("def_tax_rate_kbn_id", '>=', $params['def_tax_rate_kbn_id']);
            });
        })->when(isset($params['def_tax_rate_kbn_id']), function ($query) use ($params) {
            return $query->where(function ($query) use ($params) {
                return $query->where("def_tax_rate_kbn_id", 'like', '%' . $params['def_tax_rate_kbn_id'] . '%');
            });
        })->orderBy('sort')->paginate(CommonConsts::PAGINATION);
        return $datas;
    }

    /**
     * コード 名称補完(code指定)
     * @param $code
     * @return Object
     */
    public function getByCode($code)
    {
        $defTaxRateKbnId = DefTaxRateKbn::where('tax_rate_kbn_cd', $code)->first();
        $result = null;
        if (isset($defTaxRateKbnId['id'])) {
            $result = MtTaxRateSetting::where('def_tax_rate_kbn_id', $defTaxRateKbnId['id'])->get();
        }
        return $result;
    }
}
