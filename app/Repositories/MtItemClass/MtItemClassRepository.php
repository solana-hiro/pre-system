<?php

namespace App\Repositories\MtItemClass;

use App\Models\MtItemClass;
use App\Consts\CommonConsts;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtItemClassRepository implements MtItemClassRepositoryInterface
{

    /**
     * 商品分類データの全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtItemClass::get();
        return $result;
    }

    /**
     * 商品分類データの削除(ID指定)
     * @param $id
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $result['data'] = MtItemClass::where('id', $id)->delete();
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
     * ジャンルの全件取得
     * @return Object
     */
    public function getAllGenre()
    {
        $result = MtItemClass::where('def_item_class_thing_id', 3)->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * ブランド1の全件取得
     * @return Object
     */
    public function getAllBrand1()
    {
        $result = MtItemClass::where('def_item_class_thing_id', 1)->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * カテゴリの全件取得
     * @return Object
     */
    public function getAllCategory()
    {
        $result = MtItemClass::where('def_item_class_thing_id', 2)->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 販売開始年の全件取得
     * @return Object
     */
    public function getAllItemClassThing4()
    {
        $result = MtItemClass::where('def_item_class_thing_id', 4)->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 工場分類5の全件取得
     * @return Object
     */
    public function getAllItemClassThing5()
    {
        $result = MtItemClass::where('def_item_class_thing_id', 5)->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 製品/工賃6の全件取得
     * @return Object
     */
    public function getAllItemClassThing6()
    {
        $result = MtItemClass::where('def_item_class_thing_id', 6)->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 資産在庫JAの全件取得
     * @return Object
     */
    public function getAllItemClassThing7()
    {
        $result = MtItemClass::where('def_item_class_thing_id', 7)->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * ブランド1の初期データ取得
     * @return Object
     */
    public function getInitData1()
    {
        $result = MtItemClass::where('def_item_class_thing_id', 1)->get();
        return $result;
    }

    /**
     * 競技・スポーツの初期データ取得
     * @return Object
     */
    public function getInitData2()
    {
        $result = MtItemClass::where('def_item_class_thing_id', 2)->get();
        return $result;
    }

    /**
     * ジャンルの初期データ取得
     * @return Object
     */
    public function getInitData3()
    {
        $result = MtItemClass::where('def_item_class_thing_id', 3)->get();
        return $result;
    }

    /**
     * 販売開始年の初期データ取得
     * @return Object
     */
    public function getInitData4()
    {
        $result = MtItemClass::where('def_item_class_thing_id', 4)->get();
        return $result;
    }

    /**
     * 工場分類5の初期データ取得
     * @return Object
     */
    public function getInitData5()
    {
        $result = MtItemClass::where('def_item_class_thing_id', 5)->get();
        return $result;
    }

    /**
     * 製品/工賃6の初期データ取得
     * @return Object
     */
    public function getInitData6()
    {
        $result = MtItemClass::where('def_item_class_thing_id', 6)->get();
        return $result;
    }

    /**
     * 資産在庫JAの初期データ取得
     * @return Object
     */
    public function getInitData7()
    {
        $result = MtItemClass::where('def_item_class_thing_id', 7)->get();
        return $result;
    }

    /**
     * ジャンルの取得(条件)
     * @param $params
     * @return Object
     */
    public function getGenre($params)
    {
        $datas = MtItemClass::where('def_item_class_thing_id', 3)
            ->when(isset($params['item_class_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("item_class_cd", '>=', $params['item_class_cd']);
                });
            })->when(isset($params['item_class_name']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("item_class_name", 'like', '%' . $params['item_class_name'] . '%');
                });
            })->paginate(CommonConsts::PAGINATION);
        return $datas;
    }

    /**
     * ブランド1の取得(条件)
     * @param $params
     * @return Object
     */
    public function getBrand1($params)
    {
        $datas = MtItemClass::where('def_item_class_thing_id', 1)
            ->when(isset($params['item_class_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("item_class_cd", '>=', $params['item_class_cd']);
                });
            })->when(isset($params['item_class_name']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("item_class_name", 'like', '%' . $params['item_class_name'] . '%');
                });
            })->paginate(CommonConsts::PAGINATION);
        return $datas;
    }

    /**
     * 競技・カテゴリの取得(条件)
     * @param $params
     * @return Object
     */
    public function getCategory($params)
    {
        $datas = MtItemClass::where('def_item_class_thing_id', 2)
            ->when(isset($params['item_class_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("item_class_cd", '>=', $params['item_class_cd']);
                });
            })->when(isset($params['item_class_name']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("item_class_name", 'like', '%' . $params['item_class_name'] . '%');
                });
            })->paginate(CommonConsts::PAGINATION);
        return $datas;
    }

    /**
     *  販売開始年の取得(条件)
     * @param $params
     * @return Object
     */
    public function getItemClassThing4($params)
    {
        $datas = MtItemClass::where('def_item_class_thing_id', 4)
            ->when(isset($params['item_class_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("item_class_cd", '>=', $params['item_class_cd']);
                });
            })->when(isset($params['item_class_name']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("item_class_name", 'like', '%' . $params['item_class_name'] . '%');
                });
            })->paginate(CommonConsts::PAGINATION);
        return $datas;
    }

    /**
     *  工場分類5の取得(条件)
     * @param $params
     * @return Object
     */
    public function getItemClassThing5($params)
    {
        $datas = MtItemClass::where('def_item_class_thing_id', 5)
            ->when(isset($params['item_class_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("item_class_cd", '>=', $params['item_class_cd']);
                });
            })->when(isset($params['item_class_name']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("item_class_name", 'like', '%' . $params['item_class_name'] . '%');
                });
            })->paginate(CommonConsts::PAGINATION);
        return $datas;
    }

    /**
     *  製品/工賃6の取得(条件)
     * @param $params
     * @return Object
     */
    public function getItemClassThing6($params)
    {
        $datas = MtItemClass::where('def_item_class_thing_id', 6)
            ->when(isset($params['item_class_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("item_class_cd", '>=', $params['item_class_cd']);
                });
            })->when(isset($params['item_class_name']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("item_class_name", 'like', '%' . $params['item_class_name'] . '%');
                });
            })->paginate(CommonConsts::PAGINATION);
        return $datas;
    }

    /**
     *  資産在庫JAの取得(条件)
     * @param $params
     * @return Object
     */
    public function getItemClassThing7($params)
    {
        $datas = MtItemClass::where('def_item_class_thing_id', 7)
            ->when(isset($params['item_class_cd']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("item_class_cd", '>=', $params['item_class_cd']);
                });
            })->when(isset($params['item_class_name']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("item_class_name", 'like', '%' . $params['item_class_name'] . '%');
                });
            })->paginate(CommonConsts::PAGINATION);
        return $datas;
    }
    /**
     * 商品分類マスタ(一覧) 更新
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
            if ($params['item_class'] === "1") {
                foreach ($params['update_item_class_code1'] as $param) {
                    if (!empty($params['update_item_class_code1'][$j])) {
                        $mtItemClass = MtItemClass::where('id', $params['update_id1'][$j])->first();
                        //変更の有無を確認
                        //フラグ $params['update_ec_display_flg1']
                        if (isset($params['update_ec_display_flg1'])) {
                            $paramFlg = in_array($mtItemClass['id'], $params['update_ec_display_flg1']) ? 1 : 0;
                        } else {
                            $paramFlg = 0;
                        }
                        if (
                            isset($mtItemClass) && $mtItemClass['def_item_class_thing_id'] === $params['item_class'] &&
                            $mtItemClass['item_class_cd'] === $params['update_item_class_code1'][$j] &&
                            $mtItemClass['item_class_name'] === $params['update_item_class_name1'][$j] &&
                            $mtItemClass['ec_display_flg'] === $paramFlg
                        ) {
                            $j++;
                            continue; //変更がない場合、更新を行わない
                        }
                        $mtItemClass->def_item_class_thing_id = $params['item_class'];
                        $mtItemClass->item_class_cd = $params['update_item_class_code1'][$j];
                        $mtItemClass->item_class_name = $params['update_item_class_name1'][$j];
                        $mtItemClass->ec_display_flg = $paramFlg;
                        $mtItemClass->mt_user_last_update_id = Auth::user()->id;
                        $mtItemClass->save();
                    }
                    $j++;
                }
            } elseif ($params['item_class'] === "2") {
                foreach ($params['update_item_class_code2'] as $param) {
                    if (!empty($params['update_item_class_code2'][$j])) {
                        $mtItemClass = MtItemClass::where('id', $params['update_id2'][$j])->first();
                        //変更の有無を確認
                        //フラグ $params['update_ec_display_flg1']
                        if (isset($params['update_ec_display_flg2'])) {
                            $paramFlg = in_array($mtItemClass['id'], $params['update_ec_display_flg2']) ? 1 : 0;
                        } else {
                            $paramFlg = 0;
                        }
                        if (
                            isset($mtItemClass) && $mtItemClass['def_item_class_thing_id'] === $params['item_class'] &&
                            $mtItemClass['item_class_cd'] === $params['update_item_class_code2'][$j] &&
                            $mtItemClass['item_class_name'] === $params['update_item_class_name2'][$j] &&
                            $mtItemClass['ec_display_flg'] === $paramFlg
                        ) {
                            $j++;
                            continue; //変更がない場合、更新を行わない
                        }
                        $mtItemClass->def_item_class_thing_id = $params['item_class'];
                        $mtItemClass->item_class_cd = $params['update_item_class_code2'][$j];
                        $mtItemClass->item_class_name = $params['update_item_class_name2'][$j];
                        $mtItemClass->ec_display_flg = $paramFlg;
                        $mtItemClass->mt_user_last_update_id = Auth::user()->id;
                        $mtItemClass->save();
                    }
                    $j++;
                }
            } elseif ($params['item_class'] === "3") {
                foreach ($params['update_item_class_code3'] as $param) {
                    if (!empty($params['update_item_class_code3'][$j])) {
                        $mtItemClass = MtItemClass::where('id', $params['update_id3'][$j])->first();
                        //変更の有無を確認
                        //フラグ $params['update_ec_display_flg1']
                        if (isset($params['update_ec_display_flg3'])) {
                            $paramFlg = in_array($mtItemClass['id'], $params['update_ec_display_flg3']) ? 1 : 0;
                        } else {
                            $paramFlg = 0;
                        }
                        if (
                            isset($mtItemClass) && $mtItemClass['def_item_class_thing_id'] === $params['item_class'] &&
                            $mtItemClass['item_class_cd'] === $params['update_item_class_code3'][$j] &&
                            $mtItemClass['item_class_name'] === $params['update_item_class_name3'][$j] &&
                            $mtItemClass['ec_display_flg'] === $paramFlg
                        ) {
                            $j++;
                            continue; //変更がない場合、更新を行わない
                        }
                        $mtItemClass->def_item_class_thing_id = $params['item_class'];
                        $mtItemClass->item_class_cd = $params['update_item_class_code3'][$j];
                        $mtItemClass->item_class_name = $params['update_item_class_name3'][$j];
                        $mtItemClass->ec_display_flg = $paramFlg;
                        $mtItemClass->mt_user_last_update_id = Auth::user()->id;
                        $mtItemClass->save();
                    }
                    $j++;
                }
            } elseif ($params['item_class'] === "4") {
                foreach ($params['update_item_class_code4'] as $param) {
                    if (!empty($params['update_item_class_code4'][$j])) {
                        $mtItemClass = MtItemClass::where('id', $params['update_id4'][$j])->first();
                        //変更の有無を確認
                        //フラグ $params['update_ec_display_flg1']
                        if (isset($params['update_ec_display_flg4'])) {
                            $paramFlg = in_array($mtItemClass['id'], $params['update_ec_display_flg4']) ? 1 : 0;
                        } else {
                            $paramFlg = 0;
                        }
                        if (
                            isset($mtItemClass) && $mtItemClass['def_item_class_thing_id'] === $params['item_class'] &&
                            $mtItemClass['item_class_cd'] === $params['update_item_class_code4'][$j] &&
                            $mtItemClass['item_class_name'] === $params['update_item_class_name4'][$j] &&
                            $mtItemClass['ec_display_flg'] === $paramFlg
                        ) {
                            $j++;
                            continue; //変更がない場合、更新を行わない
                        }
                        $mtItemClass->def_item_class_thing_id = $params['item_class'];
                        $mtItemClass->item_class_cd = $params['update_item_class_code4'][$j];
                        $mtItemClass->item_class_name = $params['update_item_class_name4'][$j];
                        $mtItemClass->ec_display_flg = $paramFlg;
                        $mtItemClass->mt_user_last_update_id = Auth::user()->id;
                        $mtItemClass->save();
                    }
                    $j++;
                }
            } elseif ($params['item_class'] === "5") {
                foreach ($params['update_item_class_code5'] as $param) {
                    if (!empty($params['update_item_class_code5'][$j])) {
                        $mtItemClass = MtItemClass::where('id', $params['update_id5'][$j])->first();
                        //変更の有無を確認
                        //フラグ $params['update_ec_display_flg1']
                        if (isset($params['update_ec_display_flg5'])) {
                            $paramFlg = in_array($mtItemClass['id'], $params['update_ec_display_flg5']) ? 1 : 0;
                        } else {
                            $paramFlg = 0;
                        }
                        if (
                            isset($mtItemClass) && $mtItemClass['def_item_class_thing_id'] === $params['item_class'] &&
                            $mtItemClass['item_class_cd'] === $params['update_item_class_code5'][$j] &&
                            $mtItemClass['item_class_name'] === $params['update_item_class_name5'][$j] &&
                            $mtItemClass['ec_display_flg'] === $paramFlg
                        ) {
                            $j++;
                            continue; //変更がない場合、更新を行わない
                        }
                        $mtItemClass->def_item_class_thing_id = $params['item_class'];
                        $mtItemClass->item_class_cd = $params['update_item_class_code5'][$j];
                        $mtItemClass->item_class_name = $params['update_item_class_name5'][$j];
                        $mtItemClass->ec_display_flg = $paramFlg;
                        $mtItemClass->mt_user_last_update_id = Auth::user()->id;
                        $mtItemClass->save();
                    }
                    $j++;
                }
            } elseif ($params['item_class'] === "6") {
                foreach ($params['update_item_class_code6'] as $param) {
                    if (!empty($params['update_item_class_code6'][$j])) {
                        $mtItemClass = MtItemClass::where('id', $params['update_id6'][$j])->first();
                        //変更の有無を確認
                        //フラグ $params['update_ec_display_flg1']
                        if (isset($params['update_ec_display_flg6'])) {
                            $paramFlg = in_array($mtItemClass['id'], $params['update_ec_display_flg6']) ? 1 : 0;
                        } else {
                            $paramFlg = 0;
                        }
                        if (
                            isset($mtItemClass) && $mtItemClass['def_item_class_thing_id'] === $params['item_class'] &&
                            $mtItemClass['item_class_cd'] === $params['update_item_class_code6'][$j] &&
                            $mtItemClass['item_class_name'] === $params['update_item_class_name6'][$j] &&
                            $mtItemClass['ec_display_flg'] === $paramFlg
                        ) {
                            $j++;
                            continue; //変更がない場合、更新を行わない
                        }
                        $mtItemClass->def_item_class_thing_id = $params['item_class'];
                        $mtItemClass->item_class_cd = $params['update_item_class_code6'][$j];
                        $mtItemClass->item_class_name = $params['update_item_class_name6'][$j];
                        $mtItemClass->ec_display_flg = $paramFlg;
                        $mtItemClass->mt_user_last_update_id = Auth::user()->id;
                        $mtItemClass->save();
                    }
                    $j++;
                }
            } elseif ($params['item_class'] === "7") {
                foreach ($params['update_item_class_code7'] as $param) {
                    if (!empty($params['update_item_class_code7'][$j])) {
                        $mtItemClass = MtItemClass::where('id', $params['update_id7'][$j])->first();
                        //変更の有無を確認
                        //フラグ $params['update_ec_display_flg1']
                        if (isset($params['update_ec_display_flg7'])) {
                            $paramFlg = in_array($mtItemClass['id'], $params['update_ec_display_flg7']) ? 1 : 0;
                        } else {
                            $paramFlg = 0;
                        }
                        if (
                            isset($mtItemClass) && $mtItemClass['def_item_class_thing_id'] === $params['item_class'] &&
                            $mtItemClass['item_class_cd'] === $params['update_item_class_code7'][$j] &&
                            $mtItemClass['item_class_name'] === $params['update_item_class_name7'][$j] &&
                            $mtItemClass['ec_display_flg'] === $paramFlg
                        ) {
                            $j++;
                            continue; //変更がない場合、更新を行わない
                        }
                        $mtItemClass->def_item_class_thing_id = $params['item_class'];
                        $mtItemClass->item_class_cd = $params['update_item_class_code7'][$j];
                        $mtItemClass->item_class_name = $params['update_item_class_name7'][$j];
                        $mtItemClass->ec_display_flg = $paramFlg;
                        $mtItemClass->mt_user_last_update_id = Auth::user()->id;
                        $mtItemClass->save();
                    }
                    $j++;
                }
            }

            //新規登録
            $i = 0;
            foreach ($params as $param) {
                if (!empty($params['insert_code'][$i])) {
                    if (isset($params['insert_ec_display_flg'])) {
                        $paramFlg = in_array($i, $params['insert_ec_display_flg']) ? 1 : 0;
                    } else {
                        $paramFlg = 0;
                    }
                    $mtItemClass = new MtItemClass();
                    $mtItemClass->def_item_class_thing_id = $params['item_class'];
                    $mtItemClass->item_class_cd = $params['insert_code'][$i];
                    $mtItemClass->item_class_name = $params['insert_name'][$i];
                    $mtItemClass->ec_display_flg = $paramFlg;
                    $mtItemClass->mt_user_last_update_id = Auth::user()->id;
                    $mtItemClass->save();
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
     * 商品分類データの情報取得
     * @param array $params
     * @return Object
     */
    public function getItemClassData(array $params)
    {
        $result = MtItemClass::get();
        return $result;
    }

    /**
     * 商品分類リスト(一覧) 出力
     * @param $service
     * @return Object
     */
    public function export($params)
    {
        $startCode = '';
        $endCode = 'ZZZZZZ';
        if ($params['item_class_id'] === '1') {
            $startCode = (isset($params['code1_start'])) ? $params['code1_start'] : '';
            $endCode = (isset($params['code1_end'])) ? $params['code1_end'] : 'ZZZZZZ';
        } elseif ($params['item_class_id'] === '2') {
            $startCode = (isset($params['code2_start'])) ? $params['code2_start'] : '';
            $endCode = (isset($params['code2_end'])) ? $params['code2_end'] : 'ZZZZZZ';
        } elseif ($params['item_class_id'] === '3') {
            $startCode = (isset($params['code3_start'])) ? $params['code3_start'] : '';
            $endCode = (isset($params['code3_end'])) ? $params['code3_end'] : 'ZZZZZZ';
        } elseif ($params['item_class_id'] === '4') {
            $startCode = (isset($params['code4_start'])) ? $params['code4_start'] : '';
            $endCode = (isset($params['code4_end'])) ? $params['code4_end'] : 'ZZZZZZ';
        } elseif ($params['item_class_id'] === '5') {
            $startCode = (isset($params['code5_start'])) ? $params['code5_start'] : '';
            $endCode = (isset($params['code5_end'])) ? $params['code5_end'] : 'ZZZZZZ';
        } elseif ($params['item_class_id'] === '6') {
            $startCode = (isset($params['code6_start'])) ? $params['code6_start'] : '';
            $endCode = (isset($params['code6_end'])) ? $params['code6_end'] : 'ZZZZZZ';
        } elseif ($params['item_class_id'] === '7') {
            $startCode = (isset($params['code7_start'])) ? $params['code7_start'] : '';
            $endCode = (isset($params['code7_end'])) ? $params['code7_end'] : 'ZZZZZZ';
        }

        $result = MtItemClass::select('id', 'def_item_class_thing_id', 'item_class_cd', 'item_class_name', 'ec_display_flg')
            // ->whereBetween("item_class_cd", [$startCode, $endCode])
            ->where("def_item_class_thing_id", $params['item_class_id'])
            ->where("item_class_cd", '>=', $startCode)
            ->where("item_class_cd", '<=', $endCode)
            ->orderBy('item_class_cd')
            ->get();
        return $result;
    }

    /**
     * 商品分類 名称補完(code指定)
     * @param $code, $def_item_class_thing_id
     * @return Object
     */
    public function getByCode($code, $def_item_class_thing_id)
    {
        $result = MtItemClass::where('def_item_class_thing_id', $def_item_class_thing_id)->where('item_class_cd', $code)->first();
        return $result;
    }
}
