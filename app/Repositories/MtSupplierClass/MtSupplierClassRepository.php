<?php

namespace App\Repositories\MtSupplierClass;

use App\Models\MtSupplierClass;
use App\Consts\CommonConsts;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtSupplierClassRepository implements MtSupplierClassRepositoryInterface
{

    /**
     * 仕入先分類マスタ 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtSupplierClass::orderBy('supplier_class_cd')->get();
        return $result;
    }

    /**
     * 仕入先分類マスタ 初期データ取得
     * @return Object
     */
    public function getInitData()
    {
        $result = MtSupplierClass::orderBy('supplier_class_cd')->get();
        return $result;
    }

    /**
     * 仕入先分類マスタ1 全件取得
     * @return Object
     */
    public function getAllClass1()
    {
        $result = MtSupplierClass::where('def_supplier_class_thing_id', 1)->orderBy('supplier_class_cd')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 仕入先分類マスタ2 全件取得
     * @return Object
     */
    public function getAllClass2()
    {
        $result = MtSupplierClass::where('def_supplier_class_thing_id', 2)->orderBy('supplier_class_cd')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 仕入先分類マスタ3 全件取得
     * @return Object
     */
    public function getAllClass3()
    {
        $result = MtSupplierClass::where('def_supplier_class_thing_id', 3)->orderBy('supplier_class_cd')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 仕入先分類マスタ1 条件取得
     * @param $params
     * @return Object
     */
    public function getClass1($params)
    {
        $datas = MtSupplierClass::where('def_supplier_class_thing_id', 1)
            ->when(isset($params['supplier_class_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("supplier_class_cd", '>=', $params['supplier_class_cd']);
                });
            })->when(isset($params['supplier_class_name']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("supplier_class_name", 'like', '%' . $params['supplier_class_name'] . '%');
                });
            })->orderBy('supplier_class_cd')
            ->paginate(CommonConsts::PAGINATION);
        return $datas;
    }

    /**
     * 仕入先分類マスタ2 条件取得
     * @param $params
     * @return Object
     */
    public function getClass2($params)
    {

        $datas = MtSupplierClass::where('def_supplier_class_thing_id', 2)
            ->when(isset($params['supplier_class_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("supplier_class_cd", '>=', $params['supplier_class_cd']);
                });
            })->when(isset($params['supplier_class_name']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("supplier_class_name", 'like', '%' . $params['supplier_class_name'] . '%');
                });
            })->orderBy('supplier_class_cd')
            ->paginate(CommonConsts::PAGINATION);
        return $datas;
    }

    /**
     * 仕入先分類マスタ3 条件取得
     * @param $params
     * @return Object
     */
    public function getClass3($params)
    {
        $datas = MtSupplierClass::where('def_supplier_class_thing_id', 3)
            ->when(isset($params['supplier_class_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("supplier_class_cd", '>=', $params['supplier_class_cd']);
                });
            })->when(isset($params['supplier_class_name']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("supplier_class_name", 'like', '%' . $params['supplier_class_name'] . '%');
                });
            })->orderBy('supplier_class_cd')
            ->paginate(CommonConsts::PAGINATION);
        return $datas;
    }

    /**
     * 仕入先分類マスタ 更新
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
            if ($params['def_supplier_class_thing_id'] === "1" && isset($params['update_class_code1'])) {
                foreach ($params['update_class_code1'] as $param) {
                    if (!empty($params['update_class_code1'][$j])) {
                        $mtSupplierClass = MtSupplierClass::where('id', $params['update_id1'][$j])->first();
                        //変更の有無を確認
                        if (
                            isset($mtSupplierClass) && $mtSupplierClass['def_supplier_class_thing_id'] === $params['def_supplier_class_thing_id'] &&
                            $mtSupplierClass['supplier_class_cd'] === $params['update_class_code1'][$j] &&
                            $mtSupplierClass['supplier_class_name'] === $params['update_class_name1'][$j]
                        ) {
                            $j++;
                            continue; //変更がない場合、更新を行わない
                        }
                        $mtSupplierClass->def_supplier_class_thing_id = $params['def_supplier_class_thing_id'];
                        $mtSupplierClass->supplier_class_cd = $params['update_class_code1'][$j];
                        $mtSupplierClass->supplier_class_name = $params['update_class_name1'][$j];
                        $mtSupplierClass->mt_user_last_update_id = Auth::user()->id;
                        $mtSupplierClass->save();
                    }
                    $j++;
                }
            } elseif ($params['def_supplier_class_thing_id'] === "2" && isset($params['update_class_code2'])) {
                foreach ($params['update_class_code2'] as $param) {
                    if (!empty($params['update_class_code2'][$j])) {
                        $mtSupplierClass = MtSupplierClass::where('id', $params['update_id2'][$j])->first();
                        //変更の有無を確認
                        if (
                            isset($mtSupplierClass) && $mtSupplierClass['def_supplier_class_thing_id'] === $params['def_supplier_class_thing_id'] &&
                            $mtSupplierClass['supplier_class_cd'] === $params['update_class_code2'][$j] &&
                            $mtSupplierClass['supplier_class_name'] === $params['update_class_name2'][$j]
                        ) {
                            $j++;
                            continue; //変更がない場合、更新を行わない
                        }
                        $mtSupplierClass->def_supplier_class_thing_id = $params['def_supplier_class_thing_id'];
                        $mtSupplierClass->supplier_class_cd = $params['update_class_code2'][$j];
                        $mtSupplierClass->supplier_class_name = $params['update_class_name2'][$j];
                        $mtSupplierClass->mt_user_last_update_id = Auth::user()->id;
                        $mtSupplierClass->save();
                    }
                    $j++;
                }
            } elseif ($params['def_supplier_class_thing_id'] === "3" && isset($params['update_class_code3'])) {
                foreach ($params['update_class_code3'] as $param) {
                    if (!empty($params['update_class_code3'][$j])) {
                        $mtSupplierClass = MtSupplierClass::where('id', $params['update_id3'][$j])->first();
                        //変更の有無を確認
                        if (
                            isset($mtSupplierClass) && $mtSupplierClass['def_supplier_class_thing_id'] === $params['def_supplier_class_thing_id'] &&
                            $mtSupplierClass['supplier_class_cd'] === $params['update_class_code3'][$j] &&
                            $mtSupplierClass['supplier_class_name'] === $params['update_class_name3'][$j]
                        ) {
                            $j++;
                            continue; //変更がない場合、更新を行わない
                        }
                        $mtSupplierClass->def_supplier_class_thing_id = $params['def_supplier_class_thing_id'];
                        $mtSupplierClass->supplier_class_cd = $params['update_class_code3'][$j];
                        $mtSupplierClass->supplier_class_name = $params['update_class_name3'][$j];
                        $mtSupplierClass->mt_user_last_update_id = Auth::user()->id;
                        $mtSupplierClass->save();
                    }
                    $j++;
                }
            }

            //新規登録
            $i = 0;
            foreach ($params as $param) {
                if (!empty($params['insert_class_code'][$i])) {
                    $mtSupplierClass = new MtSupplierClass();
                    $mtSupplierClass->def_supplier_class_thing_id = $params['def_supplier_class_thing_id'];
                    $mtSupplierClass->supplier_class_cd = $params['insert_class_code'][$i];
                    $mtSupplierClass->supplier_class_name = $params['insert_class_name'][$i];
                    $mtSupplierClass->mt_user_last_update_id = Auth::user()->id;
                    $mtSupplierClass->save();
                }
                $i++;
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
            Log::info($result['error']);
        }
        return $result;
    }

    /**
     * 仕入先分類マスタ 削除
     * @param $id
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $result['data'] = MtSupplierClass::where('id', $id)->delete();
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
     * 仕入先分類リスト(一覧) 出力情報取得
     * @param $params
     * @return Object
     */
    public function export($params)
    {
        $startCode = '';
        $endCode = 'ZZZZZZ';
        if ($params['supplier_class_thing_id'] === '1') {
            $startCode = (isset($params['code1_start'])) ? $params['code1_start'] : '';
            $endCode = (isset($params['code1_end'])) ? $params['code1_end'] : 'ZZZZZZ';
        } elseif ($params['supplier_class_thing_id'] === '2') {
            $startCode = (isset($params['code2_start'])) ? $params['code2_start'] : '';
            $endCode = (isset($params['code2_end'])) ? $params['code2_end'] : 'ZZZZZZ';
        } elseif ($params['supplier_class_thing_id'] === '3') {
            $startCode = (isset($params['code3_start'])) ? $params['code3_start'] : '';
            $endCode = (isset($params['code3_end'])) ? $params['code3_end'] : 'ZZZZZZ';
        }
        $result = MtSupplierClass::where('def_supplier_class_thing_id', $params['supplier_class_thing_id'])
            ->whereBetween("supplier_class_cd", [$startCode, $endCode])
            ->orderBy("supplier_class_cd")
            ->get();
        return $result;
    }

    /**
     * 仕入先分類 存在確認(code指定)
     * @param $code, $def_supplier_class_thing_id
     * @return Object
     */
    public function isExist($code, $def_supplier_class_thing_id)
    {
        $result = MtSupplierClass::where('def_supplier_class_thing_id', $def_supplier_class_thing_id)->where('supplier_class_cd', $code)->exists();
        return $result;
    }

    /**
     * 仕入先分類 名称補完(code指定)
     * @param $code, $def_supplier_class_thing_id
     * @return Object
     */
    public function getByCode($code, $def_supplier_class_thing_id)
    {
        $result = MtSupplierClass::where('def_supplier_class_thing_id', $def_supplier_class_thing_id)->where('supplier_class_cd', $code)->first();
        return $result;
    }
}
