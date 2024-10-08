<?php
namespace App\Repositories\MtColor;

use App\Models\MtColor;
use App\Consts\CommonConsts;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtColorRepository implements MtColorRepositoryInterface
{

    /**
     * カラー情報取得 全件取得
     * @return Object
     */
    public function getAll() {
		$result = MtColor::orderBy('color_cd')->paginate(CommonConsts::PAGINATION);
		return $result;
    }

    /**
     * カラー情報取得 全件取得
     * @return Object
     */
    public function getInitData()
    {
        $result = MtColor::orderBy('color_cd')->get();
        return $result;
    }

    /**
     * カラーマスタ(一覧) 更新
     * @param $param
     * @return Object
     */
    public function update($params) {
        $result = array();
        try {
            DB::beginTransaction();
            // 更新
            $j = 0;
            foreach ($params['update_id'] as $param) {
                if (!empty($params['update_color_code'][$j])) {
                    $mtColor = MtColor::where('id', $param)->first();
                    //変更の有無を確認
                    if (
                        isset($mtColor) &&
                        $mtColor['color_cd'] === $params['update_color_code'][$j] &&
                        $mtColor['color_name'] === $params['update_color_name'][$j] &&
                        $mtColor['html_color_cd'] === $params['update_html_color_code'][$j] &&
                        $mtColor['sort_order'] === $params['update_sort_order'][$j]
                    ) {
                        $j++;
                        continue; //変更がない場合、更新を行わない
                    }
                    $mtColor->color_cd = $params['update_color_code'][$j];
                    $mtColor->color_name = $params['update_color_name'][$j];
                    $mtColor->html_color_cd = $params['update_html_color_code'][$j];
                    $mtColor->sort_order = $params['update_sort_order'][$j];
                    $mtColor->mt_user_last_update_id = Auth::user()->id;
                    $mtColor->save();
                }
                $j++;
            }

            //新規登録
            $i = 0;
            foreach ($params as $param) {
                if (!empty($params['insert_color_code'][$i])) {
                    $mtColor = new MtColor();
                    $mtColor->color_cd = $params['insert_color_code'][$i];
                    $mtColor->color_name = $params['insert_color_name'][$i];
                    $mtColor->html_color_cd = $params['insert_html_color_code'][$i];
                    $mtColor->sort_order = $params['insert_sort_order'][$i];
                    $mtColor->mt_user_last_update_id = Auth::user()->id;
                    $mtColor->save();
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
     * カラーマスタ(一覧) 削除
     * @param $id
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $result['data'] = MtColor::where('id', $id)->delete();
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
     * カラー情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params) {
        $result = MtColor::when(isset($params['color_cd']), function ($query) use ($params) {
            return $query->where(function ($query) use ($params) {
                return $query->where("color_cd", '>=', $params['color_cd']);
            });
        })->when(isset($params['color_name']), function ($query) use ($params) {
            return $query->where(function ($query) use ($params) {
                return $query->where("color_name", 'like', '%' . $params['color_name'] . '%');
            });
        })->orderBy('color_cd')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    public function getByIds($ids)
    {
        $result = MtColor::whereIn('id', $ids)->get();
        return $result;
    }

    /**
     * カラーリスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params) {

        $startCode = ($params['code_start']) ? $params['code_start'] : '';
        $endCode = ($params['code_end'])  ? $params['code_end'] : 'ZZZZZ';
        $result = MtColor::whereBetween("color_cd", [$startCode, $endCode])
            ->orderBy("color_cd")
            ->get();
		return $result;
    }

    /**
     * カラー 名称補完(code指定)
     * @param $code
     * @return Object
     */
    public function getByCode($code)
    {
        $result = MtColor::where('color_cd', $code)->first();
        return $result;
    }
}
