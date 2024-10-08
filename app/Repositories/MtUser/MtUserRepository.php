<?php

namespace App\Repositories\MtUser;

use App\Models\MtUser;
use App\Models\MtUser1Security;
use App\Models\MtUser2Security;
use App\Models\MtUser3Security;
use App\Models\DefDepartment;
use App\Models\Def1Menu;
use App\Models\Def2Menu;
use App\Models\Def3Menu;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class MtUserRepository implements MtUserRepositoryInterface
{

    /**
     * ユーザ情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtUser::paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * ユーザ情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($code, $kana, $excludeDisabled = false)
    {
        $query = MtUser::query();
        $query->when($code, fn($query) => $query->where("user_cd", '>=', $code));
        $query->when($kana, fn($query) => $query->where("user_name_kana", 'like', "%$kana%"));
        $query->when($excludeDisabled, fn($query) => $query->where('validity_flg', 1));
        $query->orderBy('user_cd');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * ユーザ情報取得 初期データを取得
     * @param $id
     * @return Object
     */
    public function getInitData($id)
    {
        $datas['mtUser'] = MtUser::select(
            'mt_users.*',
            'def_departments.department_cd',
            'def_departments.department_name'
        )->leftJoin('def_departments', 'mt_users.def_department_id', 'def_departments.id')
            ->where('mt_users.id', $id)->first();
        $datas['mtUser1Securities'] = MtUser1Security::where('mt_user_id', $id)->get();
        $datas['mtUser2Securities'] = MtUser2Security::where('mt_user_id', $id)->get();
        $datas['mtUser3Securities'] = MtUser3Security::where('mt_user_id', $id)->get();
        return $datas;
    }


    /**
     * ユーザ情報取得 初期データを取得
     * @param $id
     * @return Object
     */
    public function getDepartmentName($code)
    {
        $result = DefDepartment::where('department_cd', str_pad($code, 4, 0, STR_PAD_LEFT))->first();
        if (!$result) {
            return '';
        } else {
            return $result['department_name'];
        }
    }

    /**
     * ユーザ情報取得 一覧用初期データを取得
     * @param $id
     * @return Object
     */
    public function getInitDataList()
    {
        $datas = MtUser::select('mt_users.*', 'def_departments.department_cd', 'def_departments.department_name')
            ->leftJoin('def_departments', 'mt_users.def_department_id', 'def_departments.id')
            ->orderBy('mt_users.user_cd')->get();
        return $datas;
    }

    /**
     * ユーザ情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function search($params)
    {
        $userCd = $params['user_cd'] ? str_pad($params['user_cd'], 4, 0, STR_PAD_LEFT) : null;
        $departmemtCd = $params['department_cd'] ? str_pad($params['department_cd'], 4, 0, STR_PAD_LEFT) : null;
        $departmentId = DefDepartment::where('department_cd', $departmemtCd)->pluck('id');

        $datas = MtUser::select('mt_users.*', 'def_departments.department_cd', 'def_departments.department_name')
            ->leftJoin('def_departments', 'mt_users.def_department_id', 'def_departments.id')
            ->when(($params['user_cd']), function ($query) use ($params, $userCd) {
                return $query->where(function ($query) use ($params, $userCd) {
                    return $query->where("user_cd", '>=', $userCd);
                });
            })->when(($params['user_name']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("user_name", 'like', '%' . $params['user_name'] . '%');
                });
            })->when(($params['user_name_kana']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("user_name_kana", 'like', '%' . $params['user_name_kana'] . '%');
                });
            })->when(($params['department_cd']), function ($query) use ($params, $departmentId) {
                return $query->where(function ($query) use ($params, $departmentId) {
                    return $query->where("def_department_id", $departmentId);
                });
            })->when(isset($params['sp_auth_price_correction_possible']) && $params['sp_auth_price_correction_possible'] === '1', function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("sp_auth_price_correction_possible", '=', $params['sp_auth_price_correction_possible']);
                });
            })->when(isset($params['sp_auth_star_none_possible']) && $params['sp_auth_star_none_possible'] === '1', function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("sp_auth_star_none_possible", '=', $params['sp_auth_star_none_possible']);
                });
            })->when(isset($params['sp_auth_hand_inspection_possible']) && $params['sp_auth_hand_inspection_possible'] === '1', function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("sp_auth_hand_inspection_possible", '=', $params['sp_auth_hand_inspection_possible']);
                });
            })->when(isset($params['validity_flg']) && $params['validity_flg'] === '1', function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("validity_flg", '=', $params['validity_flg']);
                });
            })->orderBy('mt_users.user_cd')->get();
        return $datas;
    }

    /**
     * ユーザ情報取得 指定条件にて出力内容の取得
     * @param Array
     * @return Object
     */
    public function export($params)
    {
        $userCd = $params['user_cd'] ? str_pad($params['user_cd'], 4, 0, STR_PAD_LEFT) : null;
        $departmemtCd = $params['department_cd'] ? str_pad($params['department_cd'], 4, 0, STR_PAD_LEFT) : null;
        $departmentId = DefDepartment::where('department_cd', $departmemtCd)->pluck('id');

        $datas = MtUser::select('mt_users.*', 'def_departments.department_cd', 'def_departments.department_name')
            ->leftJoin('def_departments', 'mt_users.def_department_id', 'def_departments.id')
            ->when(($params['user_cd']), function ($query) use ($params, $userCd) {
                return $query->where(function ($query) use ($params, $userCd) {
                    return $query->where("user_cd", '>=', $userCd);
                });
            })->when(($params['user_name']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("user_name", 'like', '%' . $params['user_name'] . '%');
                });
            })->when(($params['user_name_kana']), function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("user_name_kana", 'like', '%' . $params['user_name_kana'] . '%');
                });
            })->when(($params['department_cd']), function ($query) use ($params, $departmentId) {
                return $query->where(function ($query) use ($params, $departmentId) {
                    return $query->where("def_department_id", $departmentId);
                });
            })->when(isset($params['sp_auth_price_correction_possible']) && $params['sp_auth_price_correction_possible'] === '1', function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("sp_auth_price_correction_possible", '=', $params['sp_auth_price_correction_possible']);
                });
            })->when(isset($params['sp_auth_star_none_possible']) && $params['sp_auth_star_none_possible'] === '1', function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("sp_auth_star_none_possible", '=', $params['sp_auth_star_none_possible']);
                });
            })->when(isset($params['sp_auth_hand_inspection_possible']) && $params['sp_auth_hand_inspection_possible'] === '1', function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("sp_auth_hand_inspection_possible", '=', $params['sp_auth_hand_inspection_possible']);
                });
            })->when(isset($params['validity_flg']) && $params['validity_flg'] === '1', function ($query) use ($params) {
                return $query->where(function ($query) use ($params) {
                    return $query->where("validity_flg", '=', $params['validity_flg']);
                });
            })->orderBy('mt_users.user_cd')->get();
        return $datas;
    }

    /**
     * ユーザ情報取得(ユーザId指定)
     * @param string $userId
     * @return Object
     */
    public function getUserInfo($userId)
    {
        $result = MtUser::with('mtUser1Security', 'mtUser2Security', 'mtUser3Security')->where('id', $userId)->first();
        return $result;
    }

    /**
     * ログイン
     * @param array $params
     * @return Object
     */
    public function login(array $params)
    {
        $user = MtUser::where('user_cd', $params['user_cd'])->where('validity_flg', 1)->first();
        return $user;
    }

    /**
     * ユーザの最小ID取得 (最小codeのID)
     * @return Object
     */
    public function getMinId()
    {
        $result = MtUser::orderBy('user_cd')->first();
        return $result['id'];
    }

    /**
     * ユーザの最大ID取得(最大codeのID)
     * @return Object
     */
    public function getMaxId()
    {
        $result = MtUser::orderByDesc('user_cd')->first();
        return $result['id'];
    }

    /**
     * ユーザ　前頁
     * @param $id
     * @return Object
     */
    public function getPrevById($id)
    {
        if (isset($id)) {
            $code = MtUser::where('id', $id)->first();
            $result = MtUser::where('user_cd', '<', $code['user_cd'])->orderByDesc('user_cd')->first();
        }
        return $result;
    }

    /**
     * ユーザ　次頁
     * @param $id
     * @return Object
     */
    public function getNextById($id)
    {
        if (isset($id)) {
            $code = MtUser::where('id', $id)->first();
            $result = MtUser::where('user_cd', '>', $code['user_cd'])->orderBy('user_cd')->first();
        } else {
            $result = MtUser::orderBy('user_cd')->first();
        }
        return $result;
    }

    /**
     * ユーザIDによる削除
     * @param $id
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            //関連テーブルの削除
            $result['mtUser1SecurityId'] = MtUser1Security::where('mt_user_id', $id)->delete();
            $result['mtUser2SecurityId'] = MtUser2Security::where('mt_user_id', $id)->delete();
            $result['mtUser3SecurityId'] = MtUser3Security::where('mt_user_id', $id)->delete();
            $result['mtUserId'] = MtUser::where('id', $id)->delete();
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
     * ユーザの更新
     * @param $param
     * @return Object
     */
    public function update($param)
    {
        $result = array();
        try {
            DB::beginTransaction();
            if ($param['update_id'] && !empty(MtUser::where('id', $param['update_id'])->first())) {
                //更新
                $mtUser = MtUser::where('id', $param['update_id'])->first();
                $mtUser->user_cd = $param['user_cd'];
                $mtUser->user_name = $param['user_name'];
                $mtUser->user_name_kana = $param['user_name_kana'];
                if ($param['password_mode'] !== '0') {
                    $mtUser->password = Hash::make($param['password']);
                }
                $mtUser->mail = $param['mail'];
                $departmentId = DefDepartment::where('department_cd', $param['department_cd'])->first();
                if ($departmentId) {
                    $mtUser->def_department_id = $departmentId['id'];
                } else {
                    $mtUser->def_department_id = '';
                }
                if (isset($param['sp_auth_price_correction_possible']) &&  $param['sp_auth_price_correction_possible'] === "1") {
                    $mtUser->sp_auth_price_correction_possible = $param['sp_auth_price_correction_possible'];
                } else {
                    $mtUser->sp_auth_price_correction_possible = 0;
                }
                if (isset($param['sp_auth_star_none_possible']) &&  $param['sp_auth_star_none_possible'] === "1") {
                    $mtUser->sp_auth_star_none_possible = $param['sp_auth_star_none_possible'];
                } else {
                    $mtUser->sp_auth_star_none_possible = 0;
                }
                if (isset($param['sp_auth_hand_inspection_possible']) &&  $param['sp_auth_hand_inspection_possible'] === "1") {
                    $mtUser->sp_auth_hand_inspection_possible = $param['sp_auth_hand_inspection_possible'];
                } else {
                    $mtUser->sp_auth_hand_inspection_possible = 0;
                }
                if (isset($param['validity_flg']) &&  $param['validity_flg'] === "1") {
                    $mtUser->validity_flg = $param['validity_flg'];
                } else {
                    $mtUser->validity_flg = 0;
                }
                $mtUser->mt_user_last_update_id = Auth::user()->id;
                $mtUser->save();

                if (isset($param['def1_auth_use_flg'])) {
                    ksort($param['def1_auth_use_flg']);
                    foreach ($param['def1_auth_use_flg'] as $key => $value) {
                        $mtUser1Security = MtUser1Security::where('mt_user_id', $param['update_id'])->where('def_1_menu_id', $key)->first();
                        if (!$mtUser1Security) {
                            $mtUser1Security = new MtUser1Security();
                            $mtUser1Security->mt_user_id = $param['update_id'];
                            $mtUser1Security->def_1_menu_id = $key;
                        }
                        $mtUser1Security->auth_use_flg = $value;
                        $mtUser1Security->mt_user_last_update_id = Auth::user()->id;
                        $mtUser1Security->save();
                    }
                }
                if (isset($param['def2_auth_use_flg'])) {
                    ksort($param['def2_auth_use_flg']);
                    foreach ($param['def2_auth_use_flg'] as $key => $value) {
                        $mtUser2Security = MtUser2Security::where('mt_user_id', $param['update_id'])->where('def_2_menu_id', $key)->first();
                        if (!$mtUser2Security) {
                            $mtUser2Security = new MtUser2Security();
                            $mtUser2Security->mt_user_id = $param['update_id'];
                            $mtUser2Security->def_2_menu_id = $key;
                            $def1Id = Def2Menu::where('id', $key)->first();
                            $mtUser2Security->def_1_menu_id = $def1Id['def_1_menu_id'];
                        }
                        $mtUser2Security->auth_use_flg = $value;
                        $mtUser2Security->mt_user_last_update_id = Auth::user()->id;
                        $mtUser2Security->save();
                    }
                }
                if (isset($param['def3_auth_use_flg'])) {
                    ksort($param['def3_auth_use_flg']);
                    foreach ($param['def3_auth_use_flg'] as $key => $value) {
                        $mtUser3Security = MtUser3Security::where('mt_user_id', $param['update_id'])->where('def_3_menu_id', $key)->first();
                        if (!$mtUser3Security) {
                            $mtUser3Security = new mtUser3Security();
                            $mtUser3Security->mt_user_id = $param['update_id'];
                            $mtUser3Security->def_3_menu_id = $key;
                            $def1Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_1_menu_id = $def1Id['def_1_menu_id'];
                            $def2Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_2_menu_id = $def2Id['def_2_menu_id'];
                        }
                        $mtUser3Security->auth_use_flg = $value;
                        $mtUser3Security->mt_user_last_update_id = Auth::user()->id;
                        $mtUser3Security->save();
                    }
                }
                if (isset($param['def3_auth_register_flg'])) {
                    ksort($param['def3_auth_register_flg']);
                    foreach ($param['def3_auth_register_flg'] as $key => $value) {
                        $mtUser3Security = MtUser3Security::where('mt_user_id', $param['update_id'])->where('def_3_menu_id', $key)->first();
                        if (!$mtUser3Security) {
                            $mtUser3Security = new mtUser3Security();
                            $mtUser3Security->mt_user_id = $param['update_id'];
                            $mtUser3Security->def_3_menu_id = $key;
                            $def1Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_1_menu_id = $def1Id['def_1_menu_id'];
                            $def2Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_2_menu_id = $def2Id['def_2_menu_id'];
                        }
                        $mtUser3Security->auth_register_flg = $value;
                        $mtUser3Security->mt_user_last_update_id = Auth::user()->id;
                        $mtUser3Security->save();
                    }
                }
                if (isset($param['def3_auth_del_flg'])) {
                    ksort($param['def3_auth_del_flg']);
                    foreach ($param['def3_auth_del_flg'] as $key => $value) {
                        $mtUser3Security = MtUser3Security::where('mt_user_id', $param['update_id'])->where('def_3_menu_id', $key)->first();
                        if (!$mtUser3Security) {
                            $mtUser3Security = new mtUser3Security();
                            $mtUser3Security->mt_user_id = $param['update_id'];
                            $mtUser3Security->def_3_menu_id = $key;
                            $def1Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_1_menu_id = $def1Id['def_1_menu_id'];
                            $def2Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_2_menu_id = $def2Id['def_2_menu_id'];
                        }
                        $mtUser3Security->auth_del_flg = $value;
                        $mtUser3Security->mt_user_last_update_id = Auth::user()->id;
                        $mtUser3Security->save();
                    }
                }
                if (isset($param['def3_auth_print_flg'])) {
                    ksort($param['def3_auth_print_flg']);
                    foreach ($param['def3_auth_print_flg'] as $key => $value) {
                        $mtUser3Security = MtUser3Security::where('mt_user_id', $param['update_id'])->where('def_3_menu_id', $key)->first();
                        if (!$mtUser3Security) {
                            $mtUser3Security = new mtUser3Security();
                            $mtUser3Security->mt_user_id = $param['update_id'];
                            $mtUser3Security->def_3_menu_id = $key;
                            $def1Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_1_menu_id = $def1Id['def_1_menu_id'];
                            $def2Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_2_menu_id = $def2Id['def_2_menu_id'];
                        }
                        $mtUser3Security->auth_print_flg = $value;
                        $mtUser3Security->mt_user_last_update_id = Auth::user()->id;
                        $mtUser3Security->save();
                    }
                }
                if (isset($param['def3_auth_change_flg'])) {
                    ksort($param['def3_auth_change_flg']);
                    foreach ($param['def3_auth_change_flg'] as $key => $value) {
                        $mtUser3Security = MtUser3Security::where('mt_user_id', $mtUser['id'])->where('def_3_menu_id', $key)->first();
                        if (!$mtUser3Security) {
                            $mtUser3Security = new mtUser3Security();
                            $mtUser3Security->mt_user_id = $mtUser['id'];
                            $mtUser3Security->def_3_menu_id = $key;
                            $def1Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_1_menu_id = $def1Id['def_1_menu_id'];
                            $def2Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_2_menu_id = $def2Id['def_2_menu_id'];
                        }
                        // 受注計上入力のみ入力値により変更/受注計上入力以外は登録フラグに合わせる
                        if ($key === 1) {
                            $mtUser3Security->auth_change_flg = $value;
                        } else {
                            $mtUser3Security->auth_change_flg = $param['def3_auth_register_flg'][$key];
                        }
                        $mtUser3Security->mt_user_last_update_id = Auth::user()->id;
                        $mtUser3Security->save();
                    }
                }
            } else {
                //新規登録
                $mtUser = new MtUser();
                $mtUser->user_cd = $param['user_cd'];
                $mtUser->user_name = $param['user_name'];
                $mtUser->user_name_kana = $param['user_name_kana'];
                if ($param['password_mode'] !== '0') {
                    $mtUser->password = Hash::make($param['password']);
                }
                $mtUser->mail = $param['mail'];
                $departmentId = DefDepartment::where('department_cd', $param['department_cd'])->first();
                if ($departmentId) {
                    $mtUser->def_department_id = $departmentId['id'];
                } else {
                    $mtUser->def_department_id = '';
                }
                if (isset($param['sp_auth_price_correction_possible']) &&  $param['sp_auth_price_correction_possible'] === "1") {
                    $mtUser->sp_auth_price_correction_possible = $param['sp_auth_price_correction_possible'];
                } else {
                    $mtUser->sp_auth_price_correction_possible = 0;
                }
                if (isset($param['sp_auth_star_none_possible']) &&  $param['sp_auth_star_none_possible'] === "1") {
                    $mtUser->sp_auth_star_none_possible = $param['sp_auth_star_none_possible'];
                } else {
                    $mtUser->sp_auth_star_none_possible = 0;
                }
                if (isset($param['sp_auth_hand_inspection_possible']) &&  $param['sp_auth_hand_inspection_possible'] === "1") {
                    $mtUser->sp_auth_hand_inspection_possible = $param['sp_auth_hand_inspection_possible'];
                } else {
                    $mtUser->sp_auth_hand_inspection_possible = 0;
                }
                if (isset($param['validity_flg']) &&  $param['validity_flg'] === "1") {
                    $mtUser->validity_flg = $param['validity_flg'];
                } else {
                    $mtUser->validity_flg = 0;
                }
                $mtUser->mt_user_last_update_id = Auth::user()->id;
                $mtUser->save();

                if (isset($param['def1_auth_use_flg'])) {
                    ksort($param['def1_auth_use_flg']);
                    foreach ($param['def1_auth_use_flg'] as $key => $value) {
                        $mtUser1Security = MtUser1Security::where('mt_user_id', $mtUser['id'])->where('def_1_menu_id', $key)->first();
                        if (!$mtUser1Security) {
                            $mtUser1Security = new MtUser1Security();
                            $mtUser1Security->mt_user_id = $mtUser['id'];
                            $mtUser1Security->def_1_menu_id = $key;
                        }
                        $mtUser1Security->auth_use_flg = $value;
                        $mtUser1Security->mt_user_last_update_id = Auth::user()->id;
                        $mtUser1Security->save();
                    }
                }
                if (isset($param['def2_auth_use_flg'])) {
                    ksort($param['def2_auth_use_flg']);
                    foreach ($param['def2_auth_use_flg'] as $key => $value) {
                        $mtUser2Security = MtUser2Security::where('mt_user_id', $mtUser['id'])->where('def_2_menu_id', $key)->first();
                        if (!$mtUser2Security) {
                            $mtUser2Security = new MtUser2Security();
                            $mtUser2Security->mt_user_id = $mtUser['id'];
                            $mtUser2Security->def_2_menu_id = $key;
                            $def1Id = Def2Menu::where('id', $key)->first();
                            $mtUser2Security->def_1_menu_id = $def1Id['def_1_menu_id'];
                        }
                        $mtUser2Security->auth_use_flg = $value;
                        $mtUser2Security->mt_user_last_update_id = Auth::user()->id;
                        $mtUser2Security->save();
                    }
                }
                if (isset($param['def3_auth_use_flg'])) {
                    ksort($param['def3_auth_use_flg']);
                    foreach ($param['def3_auth_use_flg'] as $key => $value) {
                        $mtUser3Security = MtUser3Security::where('mt_user_id', $mtUser['id'])->where('def_3_menu_id', $key)->first();
                        if (!$mtUser3Security) {
                            $mtUser3Security = new mtUser3Security();
                            $mtUser3Security->mt_user_id = $mtUser['id'];
                            $mtUser3Security->def_3_menu_id = $key;
                            $def1Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_1_menu_id = $def1Id['def_1_menu_id'];
                            $def2Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_2_menu_id = $def2Id['def_2_menu_id'];
                        }
                        $mtUser3Security->auth_use_flg = $value;
                        $mtUser3Security->mt_user_last_update_id = Auth::user()->id;
                        $mtUser3Security->save();
                    }
                }
                if (isset($param['def3_auth_register_flg'])) {
                    ksort($param['def3_auth_register_flg']);
                    foreach ($param['def3_auth_register_flg'] as $key => $value) {
                        $mtUser3Security = MtUser3Security::where('mt_user_id', $mtUser['id'])->where('def_3_menu_id', $key)->first();
                        if (!$mtUser3Security) {
                            $mtUser3Security = new mtUser3Security();
                            $mtUser3Security->mt_user_id = $mtUser['id'];
                            $mtUser3Security->def_3_menu_id = $key;
                            $def1Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_1_menu_id = $def1Id['def_1_menu_id'];
                            $def2Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_2_menu_id = $def2Id['def_2_menu_id'];
                        }
                        $mtUser3Security->auth_register_flg = $value;
                        $mtUser3Security->mt_user_last_update_id = Auth::user()->id;
                        $mtUser3Security->save();
                    }
                }
                if (isset($param['def3_auth_del_flg'])) {
                    ksort($param['def3_auth_del_flg']);
                    foreach ($param['def3_auth_del_flg'] as $key => $value) {
                        $mtUser3Security = MtUser3Security::where('mt_user_id', $mtUser['id'])->where('def_3_menu_id', $key)->first();
                        if (!$mtUser3Security) {
                            $mtUser3Security = new mtUser3Security();
                            $mtUser3Security->mt_user_id = $mtUser['id'];
                            $mtUser3Security->def_3_menu_id = $key;
                            $def1Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_1_menu_id = $def1Id['def_1_menu_id'];
                            $def2Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_2_menu_id = $def2Id['def_2_menu_id'];
                        }
                        $mtUser3Security->auth_del_flg = $value;
                        $mtUser3Security->mt_user_last_update_id = Auth::user()->id;
                        $mtUser3Security->save();
                    }
                }
                if (isset($param['def3_auth_print_flg'])) {
                    ksort($param['def3_auth_print_flg']);
                    foreach ($param['def3_auth_print_flg'] as $key => $value) {
                        $mtUser3Security = MtUser3Security::where('mt_user_id', $mtUser['id'])->where('def_3_menu_id', $key)->first();
                        if (!$mtUser3Security) {
                            $mtUser3Security = new mtUser3Security();
                            $mtUser3Security->mt_user_id = $mtUser['id'];
                            $mtUser3Security->def_3_menu_id = $key;
                            $def1Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_1_menu_id = $def1Id['def_1_menu_id'];
                            $def2Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_2_menu_id = $def2Id['def_2_menu_id'];
                        }
                        $mtUser3Security->auth_print_flg = $value;
                        $mtUser3Security->mt_user_last_update_id = Auth::user()->id;
                        $mtUser3Security->save();
                    }
                }
                if (isset($param['def3_auth_change_flg'])) {
                    ksort($param['def3_auth_change_flg']);
                    foreach ($param['def3_auth_change_flg'] as $key => $value) {
                        $mtUser3Security = MtUser3Security::where('mt_user_id', $mtUser['id'])->where('def_3_menu_id', $key)->first();
                        if (!$mtUser3Security) {
                            $mtUser3Security = new mtUser3Security();
                            $mtUser3Security->mt_user_id = $mtUser['id'];
                            $mtUser3Security->def_3_menu_id = $key;
                            $def1Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_1_menu_id = $def1Id['def_1_menu_id'];
                            $def2Id = Def3Menu::where('id', $key)->first();
                            $mtUser3Security->def_2_menu_id = $def2Id['def_2_menu_id'];
                        }
                        // 受注計上入力のみ入力値により変更/受注計上入力以外は登録フラグに合わせる
                        if ($key === 1) {
                            $mtUser3Security->auth_change_flg = $value;
                        } else {
                            $mtUser3Security->auth_change_flg = $param['def3_auth_register_flg'][$key];
                        }
                        $mtUser3Security->mt_user_last_update_id = Auth::user()->id;
                        $mtUser3Security->save();
                    }
                }
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
            $result['mtUserId'] = $mtUser['id'];
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * ユーザ コピー
     * @param $param
     * @return Object
     */
    public function copy($id)
    {
        $maxId = MtUser::max('id') + 1;
        $datas['mtUser'] = MtUser::select(
            'mt_users.*',
            'def_departments.department_cd',
            'def_departments.department_name'
        )->leftJoin('def_departments', 'mt_users.def_department_id', 'def_departments.id')
            ->where('mt_users.id', $id)->first();
        //値のクリア
        $datas['mtUser']['id'] = null;
        $datas['mtUser']['user_cd'] = null;
        $datas['mtUser']['password'] = null;
        $datas['mtUser']['user_name'] = null;
        $datas['mtUser']['user_name_kana'] = null;
        $datas['mtUser']['mail'] = null;
        $datas['mtUser1Securities'] = MtUser1Security::where('mt_user_id', $id)->get();
        $i = 0;
        foreach ($datas['mtUser1Securities'] as $rec) {
            $datas['mtUser1Securities'][$i]['mt_user_id'] = null;
            $i++;
        }
        $datas['mtUser2Securities'] = MtUser2Security::where('mt_user_id', $id)->get();
        $i = 0;
        foreach ($datas['mtUser2Securities'] as $rec) {
            $datas['mtUser2Securities'][$i]['mt_user_id'] = null;
            $i++;
        }
        $datas['mtUser3Securities'] = MtUser3Security::where('mt_user_id', $id)->get();
        $i = 0;
        foreach ($datas['mtUser3Securities'] as $rec) {
            $datas['mtUser3Securities'][$i]['mt_user_id'] = null;
            $i++;
        }
        return $datas;
    }

    /**
     * ユーザ パスワードリセット
     * @param $param
     * @return Object
     */
    public function passwordReset($param)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $mtUser = MtUser::where('id', $param['update_id'])->first();
            $mtUser->password = '';
            $mtUser->save();
            //関連テーブルの削除
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
     * 仕入先分類 存在確認(code指定)
     * @param $code
     * @return Object
     */
    public function isExist($code)
    {
        $result = MtUser::where('user_cd', $code)->exists();
        return $result;
    }

    /**
     * コード 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['user_cd'] ? CodeUtil::pad($params['user_cd'], 4) : null;

        $query = MtUser::query();
        $query->where('user_cd', $code);

        return $query->first();
    }
}
