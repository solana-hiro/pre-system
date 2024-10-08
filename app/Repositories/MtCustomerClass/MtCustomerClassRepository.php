<?php

namespace App\Repositories\MtCustomerClass;

use App\Models\MtCustomerClass;
use App\Consts\CommonConsts;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtCustomerClassRepository implements MtCustomerClassRepositoryInterface
{

    /**
     * 得意先分類マスタを全件取得
     *
     * @return Object
     */
    public function getAll()
    {
        $result = MtCustomerClass::get();
        return $result;
    }

    /**
     * 得意先分類マスタ 初期データ取得
     *
     * @return Object
     */
    public function getInitData()
    {
        $result = MtCustomerClass::orderBy('customer_class_cd')->get();
        return $result;
    }

    /**
     * 得意先分類マスタを更新
     * @param $params
     * @return Object
     */
    public function update($params)
    {
        $result = array();
        try {
            DB::beginTransaction();
            // 更新
            $j = 0;
            if ($params['def_customer_class_thing_id'] === "1") {
                foreach ($params['update_class_code1'] as $param) {
                    if (!empty($params['update_class_code1'][$j])) {
                        $mtCustomerClass = MtCustomerClass::where('id', $params['update_id1'][$j])->first();
                        //変更の有無を確認
                        if (
                            isset($mtCustomerClass) && $mtCustomerClass['def_customer_class_thing_id'] === $params['def_customer_class_thing_id'] &&
                            $mtCustomerClass['customer_class_cd'] === $params['update_class_code1'][$j] &&
                            $mtCustomerClass['customer_class_name'] === $params['update_class_name1'][$j]
                        ) {
                            $j++;
                            continue; //変更がない場合、更新を行わない
                        }
                        $mtCustomerClass->def_customer_class_thing_id = $params['def_customer_class_thing_id'];
                        $mtCustomerClass->customer_class_cd = $params['update_class_code1'][$j];
                        $mtCustomerClass->customer_class_name = $params['update_class_name1'][$j];
                        $mtCustomerClass->mt_user_last_update_id = Auth::user()->id;
                        $mtCustomerClass->save();
                    }
                    $j++;
                }
            } elseif ($params['def_customer_class_thing_id'] === "2") {
                foreach ($params['update_class_code2'] as $param) {
                    if (!empty($params['update_class_code2'][$j])) {
                        $mtCustomerClass = MtCustomerClass::where('id', $params['update_id2'][$j])->first();
                        //変更の有無を確認
                        if (
                            isset($mtCustomerClass) && $mtCustomerClass['def_customer_class_thing_id'] === $params['def_customer_class_thing_id'] &&
                            $mtCustomerClass['customer_class_cd2'] === $params['update_class_code2'][$j] &&
                            $mtCustomerClass['customer_class_name2'] === $params['update_class_name2'][$j]
                        ) {
                            $j++;
                            continue; //変更がない場合、更新を行わない
                        }
                        $mtCustomerClass->def_customer_class_thing_id = $params['def_customer_class_thing_id'];
                        $mtCustomerClass->customer_class_cd = $params['update_class_code2'][$j];
                        $mtCustomerClass->customer_class_name = $params['update_class_name2'][$j];
                        $mtCustomerClass->mt_user_last_update_id = Auth::user()->id;
                        $mtCustomerClass->save();
                    }
                    $j++;
                }
            } elseif ($params['def_customer_class_thing_id'] === "3") {
                foreach ($params['update_class_code3'] as $param) {
                    if (!empty($params['update_class_code3'][$j])) {
                        $mtCustomerClass = MtCustomerClass::where('id', $params['update_id3'][$j])->first();
                        //変更の有無を確認
                        if (
                            isset($mtCustomerClass) && $mtCustomerClass['def_customer_class_thing_id'] === $params['def_customer_class_thing_id'] &&
                            $mtCustomerClass['customer_class_cd3'] === $params['update_class_code3'][$j] &&
                            $mtCustomerClass['customer_class_name3'] === $params['update_class_name3'][$j]
                        ) {
                            $j++;
                            continue; //変更がない場合、更新を行わない
                        }
                        $mtCustomerClass->def_customer_class_thing_id = $params['def_customer_class_thing_id'];
                        $mtCustomerClass->customer_class_cd = $params['update_class_code3'][$j];
                        $mtCustomerClass->customer_class_name = $params['update_class_name3'][$j];
                        $mtCustomerClass->mt_user_last_update_id = Auth::user()->id;
                        $mtCustomerClass->save();
                    }
                    $j++;
                }
            }

            //新規登録
            $i = 0;
            foreach ($params as $param) {
                if (!empty($params['insert_class_code'][$i])) {
                    $mtCustomerClass = new MtCustomerClass();
                    $mtCustomerClass->def_customer_class_thing_id = $params['def_customer_class_thing_id'];
                    $mtCustomerClass->customer_class_cd = $params['insert_class_code'][$i];
                    $mtCustomerClass->customer_class_name = $params['insert_class_name'][$i];
                    $mtCustomerClass->mt_user_last_update_id = Auth::user()->id;
                    $mtCustomerClass->save();
                }
                $i++;
            }
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
     * 得意先分類マスタを削除
     * @param $id
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $result['data'] = MtCustomerClass::where('id', $id)->delete();
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
     * 得意先分類マスタを条件に合わせて取得
     * @params
     * @return Object
     */
    public function export($params)
    {
        $startCode = '';
        $endCode = 'ZZZZZZ';
        if ($params['customer_class_thing_id'] === '1') {
            $startCode = (isset($params['code1_start'])) ? $params['code1_start'] : '';
            $endCode = (isset($params['code1_end'])) ? $params['code1_end'] : 'ZZZZZZ';
        } elseif ($params['customer_class_thing_id'] === '2') {
            $startCode = (isset($params['code2_start'])) ? $params['code2_start'] : '';
            $endCode = (isset($params['code2_end'])) ? $params['code2_end'] : 'ZZZZZZ';
        } elseif ($params['customer_class_thing_id'] === '3') {
            $startCode = (isset($params['code3_start'])) ? $params['code3_start'] : '';
            $endCode = (isset($params['code3_end'])) ? $params['code3_end'] : 'ZZZZZZ';
        }
        $result = MtCustomerClass::where('def_customer_class_thing_id', $params['customer_class_thing_id'])
            ->whereBetween('customer_class_cd', [$startCode, $endCode])
            ->orderBy('customer_class_cd')->get();
        return $result;
    }

    /**
     * ランク3の全件取得
     * @return Object
     */
    public function getAllRank3()
    {
        $result = MtCustomerClass::where('def_customer_class_thing_id', 3)->orderBy('customer_class_cd')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * ランク3の取得(条件)
     * @param $params
     * @return Object
     */
    public function getRank3($params)
    {
        $datas = MtCustomerClass::where('def_customer_class_thing_id', 3)
            ->when(isset($params['customer_class_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("customer_class_cd", '>=', $params['customer_class_cd']);
                });
            })->when(isset($params['customer_class_name']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("customer_class_name", 'like', '%' . $params['customer_class_name'] . '%');
                });
            })->orderBy('customer_class_cd')->paginate(CommonConsts::PAGINATION);
        return $datas;
    }

    /**
     * 業種・特徴2の全件取得
     * @return Object
     */
    public function getAllIndustry()
    {
        $result = MtCustomerClass::where('def_customer_class_thing_id', 2)->orderBy('customer_class_cd')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 業種・特徴2の取得(条件)
     * @param $params
     * @return Object
     */
    public function getIndustry($params)
    {
        $datas = MtCustomerClass::where('def_customer_class_thing_id', 2)
            ->when(isset($params['customer_class_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("customer_class_cd", '>=', $params['customer_class_cd']);
                });
            })->when(isset($params['customer_class_name']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("customer_class_name", 'like', '%' . $params['customer_class_name'] . '%');
                });
            })->orderBy('customer_class_cd')->paginate(CommonConsts::PAGINATION);
        return $datas;
    }

    /**
     * 販売パターン１の全件取得
     * @return Object
     */
    public function getAllSalesPattern()
    {
        $result = MtCustomerClass::where('def_customer_class_thing_id', 1)->orderBy('customer_class_cd')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 販売パターン１の取得(条件)
     * @param $params
     * @return Object
     */
    public function getSalesPattern($params)
    {
        $datas = MtCustomerClass::where('def_customer_class_thing_id', 1)
            ->when(isset($params['customer_class_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("customer_class_cd", '>=', $params['customer_class_cd']);
                });
            })->when(isset($params['customer_class_name']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("customer_class_name", 'like', '%' . $params['customer_class_name'] . '%');
                });
            })->orderBy('customer_class_cd')->paginate(CommonConsts::PAGINATION);
        return $datas;
    }

    /**
     * 得意先分類 名称補完(code指定)
     * @param $code, $def_customer_class_thing_id
     * @return Object
     */
    public function getByCode($code, $def_customer_class_thing_id)
    {
        $result = MtCustomerClass::where('def_customer_class_thing_id', $def_customer_class_thing_id)->where('customer_class_cd', $code)->first();
        return $result;
    }
}
