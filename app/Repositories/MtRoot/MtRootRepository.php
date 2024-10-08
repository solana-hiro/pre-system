<?php

namespace App\Repositories\MtRoot;

use App\Models\MtRoot;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtRootRepository implements MtRootRepositoryInterface
{

    /**
     * ルートマスタ情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtRoot::orderBy('sort')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * ルートマスタ情報　初期データ取得
     * @return Object
     */
    public function getInitData()
    {
        $result = MtRoot::orderBy('root_cd')->get();
        return $result;
    }

    /**
     * ルートマスタ情報　削除
     * @param $id
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $result['data'] = MtRoot::where('id', $id)->delete();
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
     * ルートマスタ 更新
     * @param $params
     * @return Object
     */
    public function update($params)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $j = 0;
            foreach ($params['update_root_code'] as $param) {
                if (!empty($params['update_root_code'][$j])) {
                    $mtRoot = MtRoot::where('id', $params['update_id'][$j])->first();
                    //変更の有無を確認
                    if (
                        isset($mtRoot) &&
                        $mtRoot['root_cd'] === $params['update_root_code'][$j] &&
                        $mtRoot['root_name'] === $params['update_root_name'][$j] &&
                        $mtRoot['sort'] === $params['update_sort'][$j]
                    ) {
                        $j++;
                        continue; //変更がない場合、更新を行わない
                    }
                    $mtRoot->root_cd = $params['update_root_code'][$j];
                    $mtRoot->root_name = $params['update_root_name'][$j];
                    $mtRoot->sort = $params['update_sort'][$j];
                    $mtRoot->mt_user_last_update_id = Auth::user()->id;
                    $mtRoot->save();
                }
                $j++;
            }

            //新規登録
            $i = 0;
            foreach ($params as $param) {
                if (!empty($params['insert_root_code'][$i])) {
                    $mtRootExists = MtRoot::where('root_cd', $params['insert_root_code'][$i])->first();
                    if (!empty($mtRootExists)) {
                        DB::rollback();
                        $result['status'] = CommonConsts::STATUS_ERROR;
                        $result['error'] = "既にルートコード={$mtRootExists['root_cd']}で<br>登録されています";
                        return $result;
                    }
                    $mtRoot = new MtRoot();
                    $mtRoot->root_cd = $params['insert_root_code'][$i];
                    $mtRoot->root_name = $params['insert_root_name'][$i];
                    $mtRoot->sort = $params['insert_sort'][$i];
                    $mtRoot->mt_user_last_update_id = Auth::user()->id;
                    $mtRoot->save();
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
     * ルートマスタ 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params)
    {
        $code = $params['root_cd'] ? CodeUtil::pad($params['root_cd'], 4) : null;
        $name = $params['root_name'] ?? null;

        $query = MtRoot::query();
        $query->when($code, fn($query) => $query->where("root_cd", '>=', $code));
        $query->when($name, fn($query) => $query->where("root_name", 'like', "%$name%"));
        $query->orderBy('root_cd');

        return $query->paginate(CommonConsts::PAGINATION);
    }


    /**
     * ルートマスタ 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['root_cd'] ? CodeUtil::pad($params['root_cd'], 4) : null;

        $query = MtRoot::query();
        $query->where('root_cd', $code);

        return $query->first();
    }
}
