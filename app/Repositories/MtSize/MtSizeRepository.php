<?php
namespace App\Repositories\MtSize;

use App\Models\MtSize;
use App\Consts\CommonConsts;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtSizeRepository implements MtSizeRepositoryInterface
{

    /**
     * サイズ情報取得 全件取得
     * @return Object
     */
    public function getAll() {
		$result = MtSize::orderBy('size_cd')->paginate(CommonConsts::PAGINATION);
		return $result;
    }

    /**
     * サイズ情報取得 初期データ取得
     * @return Object
     */
    public function getInitData()
    {
        $result = MtSize::orderBy('size_cd')->get();
        return $result;
    }

    /**
     * サイズマスタ(一覧) 更新
     * @param $param
     * @return Object
     */
    public function update($params)
    {
        $result = array();
        try {
            DB::beginTransaction();
            // 更新
            $j = 0;
            foreach ($params['update_size_code'] as $param) {
                if (!empty($params['update_size_code'][$j])) {
                    $mtSize = MtSize::where('id', $params['update_id'][$j])->first();
                    //変更の有無を確認
                    if (
                        isset($mtSize) &&
                        $mtSize['size_cd'] === $params['update_size_code'][$j] &&
                        $mtSize['size_name'] === $params['update_size_name'][$j] &&
                        $mtSize['sort_order'] === $params['update_sort_order'][$j]
                    ) {
                        $j++;
                        continue; //変更がない場合、更新を行わない
                    }
                    $mtSize->size_cd = $params['update_size_code'][$j];
                    $mtSize->size_name = $params['update_size_name'][$j];
                    $mtSize->sort_order = $params['update_sort_order'][$j];
                    $mtSize->mt_user_last_update_id = Auth::user()->id;
                    $mtSize->save();
                }
                $j++;
            }

            //新規登録
            $i = 0;
            foreach ($params as $param) {
                if (!empty($params['insert_size_code'][$i])) {
                    $mtSize = new MtSize();
                    $mtSize->size_cd = $params['insert_size_code'][$i];
                    $mtSize->size_name = $params['insert_size_name'][$i];
                    $mtSize->sort_order = $params['insert_sort_order'][$i];
                    $mtSize->mt_user_last_update_id = Auth::user()->id;
                    $mtSize->save();
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
     * サイズマスタ(一覧) 削除
     * @param $id
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $result['data'] = MtSize::where('id', $id)->delete();
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
     * サイズ情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params) {
        $result = MtSize::when(isset($params['size_cd']), function ($query) use ($params) {
            return $query->where(function ($query) use ($params) {
                return $query->where("size_cd", '>=', $params['size_cd']);
            });
        })->when(isset($params['size_name']), function ($query) use ($params) {
            return $query->where(function ($query) use ($params) {
                return $query->where("size_name", 'like', '%' . $params['size_name'] . '%');
            });
        })->orderBy('size_cd')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * サイズリスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params) {
        $startCode = ($params['code_start']) ? $params['code_start'] : '';
        $endCode = ($params['code_end']) ? $params['code_end'] : 'ZZZZZ';
        $result = MtSize::whereBetween("size_cd", [$startCode, $endCode])
            ->orderBy("size_cd")
            ->get();
        return $result;
    }

    /**
     * サイズ 名称補完(code指定)
     * @param $code
     * @return Object
     */
    public function getByCode($code)
    {
        $result = MtSize::where('size_cd', $code)->first();
        return $result;
    }

    public function getByIds($ids)
    {
        $result = MtSize::whereIn('id', $ids)->get();
        return $result;
    }
}
