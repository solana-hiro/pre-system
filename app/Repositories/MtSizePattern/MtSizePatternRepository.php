<?php

namespace App\Repositories\MtSizePattern;

use App\Models\MtSizePattern;
use App\Models\MtSize;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtSizePatternRepository implements MtSizePatternRepositoryInterface
{

    /**
     * サイズパターン情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtSizePattern::select(
            'mt_size_patterns.size_pattern_cd as size_pattern_cd',
            'ms1.size_cd as size_cd1',
            'ms2.size_cd as size_cd2',
            'ms3.size_cd as size_cd3',
            'ms4.size_cd as size_cd4',
            'ms5.size_cd as size_cd5',
            'ms6.size_cd as size_cd6',
            'ms7.size_cd as size_cd7',
            'ms8.size_cd as size_cd8',
            'ms9.size_cd as size_cd9',
            'ms10.size_cd as size_cd10',
            'ms1.size_name as size_name1',
            'ms2.size_name as size_name2',
            'ms3.size_name as size_name3',
            'ms4.size_name as size_name4',
            'ms5.size_name as size_name5',
            'ms6.size_name as size_name6',
            'ms7.size_name as size_name7',
            'ms8.size_name as size_name8',
            'ms9.size_name as size_name9',
            'ms10.size_name as size_name10',
        )
            ->leftJoin("mt_sizes as ms1", "mt_size_patterns.mt_size_id_1", "ms1.id")
            ->leftJoin("mt_sizes as ms2", "mt_size_patterns.mt_size_id_2", "ms2.id")
            ->leftJoin("mt_sizes as ms3", "mt_size_patterns.mt_size_id_3", "ms3.id")
            ->leftJoin("mt_sizes as ms4", "mt_size_patterns.mt_size_id_4", "ms4.id")
            ->leftJoin("mt_sizes as ms5", "mt_size_patterns.mt_size_id_5", "ms5.id")
            ->leftJoin("mt_sizes as ms6", "mt_size_patterns.mt_size_id_6", "ms6.id")
            ->leftJoin("mt_sizes as ms7", "mt_size_patterns.mt_size_id_7", "ms7.id")
            ->leftJoin("mt_sizes as ms8", "mt_size_patterns.mt_size_id_8", "ms8.id")
            ->leftJoin("mt_sizes as ms9", "mt_size_patterns.mt_size_id_9", "ms9.id")
            ->leftJoin("mt_sizes as ms10", "mt_size_patterns.mt_size_id_10", "ms10.id")
            ->orderBy("mt_size_patterns.size_pattern_cd")
            ->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * サイズパターン情報取得 初期データ取得
     * @return Object
     */
    public function getInitData()
    {
        $result = MtSizePattern::select(
            'mt_size_patterns.id as id',
            'mt_size_patterns.size_pattern_cd as size_pattern_cd',
            'ms1.size_cd as size_cd1',
            'ms2.size_cd as size_cd2',
            'ms3.size_cd as size_cd3',
            'ms4.size_cd as size_cd4',
            'ms5.size_cd as size_cd5',
            'ms6.size_cd as size_cd6',
            'ms7.size_cd as size_cd7',
            'ms8.size_cd as size_cd8',
            'ms9.size_cd as size_cd9',
            'ms10.size_cd as size_cd10',
            'ms1.size_name as size_name1',
            'ms2.size_name as size_name2',
            'ms3.size_name as size_name3',
            'ms4.size_name as size_name4',
            'ms5.size_name as size_name5',
            'ms6.size_name as size_name6',
            'ms7.size_name as size_name7',
            'ms8.size_name as size_name8',
            'ms9.size_name as size_name9',
            'ms10.size_name as size_name10',
        )
            ->leftJoin("mt_sizes as ms1", "mt_size_patterns.mt_size_id_1", "ms1.id")
            ->leftJoin("mt_sizes as ms2", "mt_size_patterns.mt_size_id_2", "ms2.id")
            ->leftJoin("mt_sizes as ms3", "mt_size_patterns.mt_size_id_3", "ms3.id")
            ->leftJoin("mt_sizes as ms4", "mt_size_patterns.mt_size_id_4", "ms4.id")
            ->leftJoin("mt_sizes as ms5", "mt_size_patterns.mt_size_id_5", "ms5.id")
            ->leftJoin("mt_sizes as ms6", "mt_size_patterns.mt_size_id_6", "ms6.id")
            ->leftJoin("mt_sizes as ms7", "mt_size_patterns.mt_size_id_7", "ms7.id")
            ->leftJoin("mt_sizes as ms8", "mt_size_patterns.mt_size_id_8", "ms8.id")
            ->leftJoin("mt_sizes as ms9", "mt_size_patterns.mt_size_id_9", "ms9.id")
            ->leftJoin("mt_sizes as ms10", "mt_size_patterns.mt_size_id_10", "ms10.id")
            ->orderBy("mt_size_patterns.size_pattern_cd")
            ->get();
        return $result;
    }

    /**
     * サイズパターンマスタ(一覧) 更新
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
            if (array_key_exists('update_id', $params)) {
                foreach ($params['update_id'] as $param) {
                    if (!empty($params['update_size_pattern_code'][$j])) {
                        $mtSizePattern = MtSizePattern::where('size_pattern_cd', $params['update_size_pattern_code'][$j])->first();
                        $mtSizeIds = array();
                        // code⇒id変換
                        for ($k = 1; $k <= 10; $k++) {
                            if (isset($params["update_size_code{$k}"][$j])) {
                                if (empty($params["update_size_code{$k}"][$j])) {
                                    $mtSizeIds["mt_size_id_{$k}"] = null;
                                } else {
                                    $mtSizeId = MtSize::getIdByCode($params["update_size_code{$k}"][$j]);
                                    if (empty($mtSizeId)) {
                                        DB::rollback();
                                        $result['status'] = CommonConsts::STATUS_ERROR;
                                        $result['error'] = "カラーコード{$k}がカラーマスタに存在しません";
                                        return $result;
                                    } else {
                                        $mtSizeIds["mt_size_id_{$k}"] = $mtSizeId['id'];
                                    }
                                }
                            }
                            // code⇒id変換
                            /*
                            $mtSizeIds['mt_size_id_1'] = MtSize::getIdByCode($params['update_size_code1'][$j]) ? MtSize::getIdByCode($params['update_size_code1'][$j])['id'] : NULL;
                            $mtSizeIds['mt_size_id_2'] = MtSize::getIdByCode($params['update_size_code1'][$j]) ? MtSize::getIdByCode($params['update_size_code2'][$j])['id'] : NULL;
                            $mtSizeIds['mt_size_id_3'] = MtSize::getIdByCode($params['update_size_code3'][$j]) ? MtSize::getIdByCode($params['update_size_code3'][$j])['id'] : NULL;
                            $mtSizeIds['mt_size_id_4'] = MtSize::getIdByCode($params['update_size_code4'][$j]) ? MtSize::getIdByCode($params['update_size_code4'][$j])['id'] : NULL;
                            $mtSizeIds['mt_size_id_5'] = MtSize::getIdByCode($params['update_size_code5'][$j]) ? MtSize::getIdByCode($params['update_size_code5'][$j])['id'] : NULL;
                            $mtSizeIds['mt_size_id_6'] = MtSize::getIdByCode($params['update_size_code6'][$j]) ? MtSize::getIdByCode($params['update_size_code6'][$j])['id'] : NULL;
                            $mtSizeIds['mt_size_id_7'] = MtSize::getIdByCode($params['update_size_code7'][$j]) ? MtSize::getIdByCode($params['update_size_code7'][$j])['id'] : NULL;
                            $mtSizeIds['mt_size_id_8'] = MtSize::getIdByCode($params['update_size_code8'][$j]) ? MtSize::getIdByCode($params['update_size_code8'][$j])['id'] : NULL;
                            $mtSizeIds['mt_size_id_9'] = MtSize::getIdByCode($params['update_size_code9'][$j]) ? MtSize::getIdByCode($params['update_size_code9'][$j])['id'] : NULL;
                            $mtSizeIds['mt_size_id_10'] = MtSize::getIdByCode($params['update_size_code10'][$j]) ? MtSize::getIdByCode($params['update_size_code10'][$j])['id'] : NULL;

                            //変更の有無を確認
                            if (
                                isset($mtSizePattern) &&
                                $mtSizePattern['mt_size_id_1'] === $mtSizeIds['mt_size_id_1'] &&
                                $mtSizePattern['mt_size_id_2'] === $mtSizeIds['mt_size_id_2'] &&
                                $mtSizePattern['mt_size_id_3'] === $mtSizeIds['mt_size_id_3'] &&
                                $mtSizePattern['mt_size_id_4'] === $mtSizeIds['mt_size_id_4'] &&
                                $mtSizePattern['mt_size_id_5'] === $mtSizeIds['mt_size_id_5'] &&
                                $mtSizePattern['mt_size_id_6'] === $mtSizeIds['mt_size_id_6'] &&
                                $mtSizePattern['mt_size_id_7'] === $mtSizeIds['mt_size_id_7'] &&
                                $mtSizePattern['mt_size_id_8'] === $mtSizeIds['mt_size_id_8'] &&
                                $mtSizePattern['mt_size_id_9'] === $mtSizeIds['mt_size_id_9'] &&
                                $mtSizePattern['mt_size_id_10'] === $mtSizeIds['mt_size_id_10']
                            ) {
                                $j++;
                                continue; //変更がない場合、更新を行わない
                            }
                            */
                            //$mtSizePattern->size_pattern_cd = $params['update_size_pattern_code'][$j];
                            $mtSizePattern->mt_size_id_1 = isset($mtSizeIds['mt_size_id_1']) ? $mtSizeIds['mt_size_id_1'] : null;
                            $mtSizePattern->mt_size_id_2 = isset($mtSizeIds['mt_size_id_2']) ? $mtSizeIds['mt_size_id_2'] : null;
                            $mtSizePattern->mt_size_id_3 = isset($mtSizeIds['mt_size_id_3']) ? $mtSizeIds['mt_size_id_3'] : null;
                            $mtSizePattern->mt_size_id_4 = isset($mtSizeIds['mt_size_id_4']) ? $mtSizeIds['mt_size_id_4'] : null;
                            $mtSizePattern->mt_size_id_5 = isset($mtSizeIds['mt_size_id_5']) ? $mtSizeIds['mt_size_id_5'] : null;
                            $mtSizePattern->mt_size_id_6 = isset($mtSizeIds['mt_size_id_6']) ? $mtSizeIds['mt_size_id_6'] : null;
                            $mtSizePattern->mt_size_id_7 = isset($mtSizeIds['mt_size_id_7']) ? $mtSizeIds['mt_size_id_7'] : null;
                            $mtSizePattern->mt_size_id_8 = isset($mtSizeIds['mt_size_id_8']) ? $mtSizeIds['mt_size_id_8'] : null;
                            $mtSizePattern->mt_size_id_9 = isset($mtSizeIds['mt_size_id_9']) ? $mtSizeIds['mt_size_id_9'] : null;
                            $mtSizePattern->mt_size_id_10 = isset($mtSizeIds['mt_size_id_10']) ? $mtSizeIds['mt_size_id_10'] : null;
                            $mtSizePattern->mt_user_last_update_id = Auth::user()->id;
                            $mtSizePattern->save();
                        }
                    }
                    $j++;
                }
            }

            //新規登録
            $i = 0;
            foreach ($params['insert_size_pattern_code'] as $param) {
                $mtSizePattern = MtSizePattern::where('size_pattern_cd', $param)->first();
                if (!empty($mtSizePattern)) {
                    DB::rollback();
                    $result['status'] = CommonConsts::STATUS_ERROR;
                    $result['error'] = "既にサイズパターンコード={$mtSizePattern['size_pattern_cd']}で<br>登録されています";
                    return $result;
                }
                // code⇒id変換
                $mtSizeIds = array();
                for ($k = 1; $k <= 10; $k++) {
                    if (isset($params["insert_size_code{$k}"][$i])) {
                        $mtSizeId = MtSize::getIdByCode($params["insert_size_code{$k}"][$i]);
                        // code⇒id変換
                        if (empty($params["insert_size_code{$k}"][$i])) {
                            //array_merge($mtSizeIds, array("mt_Size_id_{$k}" => null));
                            $mtSizeIds["mt_size_id_{$k}"] = null;
                        } else {
                            $mtSizeId = MtSize::getIdByCode($params["insert_size_code{$k}"][$i]);
                            if (empty($mtSizeId)) {;
                                DB::rollback();
                                $result['status'] = CommonConsts::STATUS_ERROR;
                                $result['error'] = "サイズコード{$k}がサイズマスタに存在しません";
                                return $result;
                            } else {
                                //array_merge($mtSizeIds, array("mt_Size_id_{$k}" => $mtSizeId['id']));
                                $mtSizeIds["mt_size_id_{$k}"] = $mtSizeId['id'];
                            }
                        }
                    }
                }

                if (!empty($params['insert_size_pattern_code'][$i])) {
                    $mtSizePattern = new MtSizePattern();
                    $mtSizePattern->size_pattern_cd = $params['insert_size_pattern_code'][$i];
                    $mtSizePattern->mt_size_id_1 = isset($mtSizeIds['mt_size_id_1']) ? $mtSizeIds['mt_size_id_1'] : null;
                    $mtSizePattern->mt_size_id_2 = isset($mtSizeIds['mt_size_id_2']) ? $mtSizeIds['mt_size_id_2'] : null;
                    $mtSizePattern->mt_size_id_3 = isset($mtSizeIds['mt_size_id_3']) ? $mtSizeIds['mt_size_id_3'] : null;
                    $mtSizePattern->mt_size_id_4 = isset($mtSizeIds['mt_size_id_4']) ? $mtSizeIds['mt_size_id_4'] : null;
                    $mtSizePattern->mt_size_id_5 = isset($mtSizeIds['mt_size_id_5']) ? $mtSizeIds['mt_size_id_5'] : null;
                    $mtSizePattern->mt_size_id_6 = isset($mtSizeIds['mt_size_id_6']) ? $mtSizeIds['mt_size_id_6'] : null;
                    $mtSizePattern->mt_size_id_7 = isset($mtSizeIds['mt_size_id_7']) ? $mtSizeIds['mt_size_id_7'] : null;
                    $mtSizePattern->mt_size_id_8 = isset($mtSizeIds['mt_size_id_8']) ? $mtSizeIds['mt_size_id_8'] : null;
                    $mtSizePattern->mt_size_id_9 = isset($mtSizeIds['mt_size_id_9']) ? $mtSizeIds['mt_size_id_9'] : null;
                    $mtSizePattern->mt_size_id_10 = isset($mtSizeIds['mt_size_id_10']) ? $mtSizeIds['mt_size_id_10'] : null;
                    $mtSizePattern->mt_user_last_update_id = Auth::user()->id;
                    $mtSizePattern->save();
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
     * サイズパターン情報　削除
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $result['data'] = MtSizePattern::where('id', $id)->delete();
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
     * サイズパターン情報取得 指定条件にて取得
     * @param $params
     * @return Object
     */
    public function get($params)
    {
        $code = $params['size_pattern_cd'] ? CodeUtil::pad($params['size_pattern_cd'], 4) : null;

        $query = MtSizePattern::query();
        $query->select(
            'mt_size_patterns.size_pattern_cd as size_pattern_cd',
            'ms1.size_name as size_name1',
            'ms2.size_name as size_name2',
            'ms3.size_name as size_name3',
            'ms4.size_name as size_name4',
            'ms5.size_name as size_name5',
            'ms6.size_name as size_name6',
            'ms7.size_name as size_name7',
            'ms8.size_name as size_name8',
            'ms9.size_name as size_name9',
            'ms10.size_name as size_name10',
        );
        $query->leftJoin("mt_sizes as ms1", "mt_size_patterns.mt_size_id_1", "ms1.id");
        $query->leftJoin("mt_sizes as ms2", "mt_size_patterns.mt_size_id_2", "ms2.id");
        $query->leftJoin("mt_sizes as ms3", "mt_size_patterns.mt_size_id_3", "ms3.id");
        $query->leftJoin("mt_sizes as ms4", "mt_size_patterns.mt_size_id_4", "ms4.id");
        $query->leftJoin("mt_sizes as ms5", "mt_size_patterns.mt_size_id_5", "ms5.id");
        $query->leftJoin("mt_sizes as ms6", "mt_size_patterns.mt_size_id_6", "ms6.id");
        $query->leftJoin("mt_sizes as ms7", "mt_size_patterns.mt_size_id_7", "ms7.id");
        $query->leftJoin("mt_sizes as ms8", "mt_size_patterns.mt_size_id_8", "ms8.id");
        $query->leftJoin("mt_sizes as ms9", "mt_size_patterns.mt_size_id_9", "ms9.id");
        $query->leftJoin("mt_sizes as ms10", "mt_size_patterns.mt_size_id_10", "ms10.id");
        $query->when($query->when($code, fn($query) => $query->where("size_pattern_cd", '>=', $code)));
        $query->orderBy("mt_size_patterns.size_pattern_cd");

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * サイズパターンリスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params)
    {
        $startCode = ($params['code_start']) ? str_pad($params['code_start'], 4, 0, STR_PAD_LEFT) : '';
        $endCode = ($params['code_end']) ? str_pad($params['code_end'], 4, 0, STR_PAD_LEFT) : 'ZZZZ';
        $result = MtSizePattern::select(
            'mt_size_patterns.id as id',
            'mt_size_patterns.size_pattern_cd as size_pattern_cd',
            'ms1.size_cd as size_cd_1',
            'ms1.size_name as size_name_1',
            'ms2.size_cd as size_cd_2',
            'ms2.size_name as size_name_2',
            'ms3.size_cd as size_cd_3',
            'ms3.size_name as size_name_3',
            'ms4.size_cd as size_cd_4',
            'ms4.size_name as size_name_4',
            'ms5.size_cd as size_cd_5',
            'ms5.size_name as size_name_5',
            'ms6.size_cd as size_cd_6',
            'ms6.size_name as size_name_6',
            'ms7.size_cd as size_cd_7',
            'ms7.size_name as size_name_7',
            'ms8.size_cd as size_cd_8',
            'ms8.size_name as size_name_8',
            'ms9.size_cd as size_cd_9',
            'ms9.size_name as size_name_9',
            'ms10.size_cd as size_cd_10',
            'ms10.size_name as size_name_10',
        )
            ->leftJoin("mt_sizes as ms1", "mt_size_patterns.mt_size_id_1", "ms1.id")
            ->leftJoin("mt_sizes as ms2", "mt_size_patterns.mt_size_id_2", "ms2.id")
            ->leftJoin("mt_sizes as ms3", "mt_size_patterns.mt_size_id_3", "ms3.id")
            ->leftJoin("mt_sizes as ms4", "mt_size_patterns.mt_size_id_4", "ms4.id")
            ->leftJoin("mt_sizes as ms5", "mt_size_patterns.mt_size_id_5", "ms5.id")
            ->leftJoin("mt_sizes as ms6", "mt_size_patterns.mt_size_id_6", "ms6.id")
            ->leftJoin("mt_sizes as ms7", "mt_size_patterns.mt_size_id_7", "ms7.id")
            ->leftJoin("mt_sizes as ms8", "mt_size_patterns.mt_size_id_8", "ms8.id")
            ->leftJoin("mt_sizes as ms9", "mt_size_patterns.mt_size_id_9", "ms9.id")
            ->leftJoin("mt_sizes as ms10", "mt_size_patterns.mt_size_id_10", "ms10.id")
            ->whereBetween("mt_size_patterns.size_pattern_cd", [$startCode, $endCode])
            ->orderBy("mt_size_patterns.size_pattern_cd")
            ->get();
        return $result;
    }

    /**
     * サイズパターン 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['size_pattern_cd'] ? CodeUtil::pad($params['size_pattern_cd'], 4) : null;

        $query = MtSizePattern::query();
        $query->select(
            'mt_size_patterns.id as id',
            'mt_size_patterns.size_pattern_cd as size_pattern_cd',
            'ms1.size_cd as size_cd_1',
            'ms1.size_name as size_name_1',
            'ms2.size_cd as size_cd_2',
            'ms2.size_name as size_name_2',
            'ms3.size_cd as size_cd_3',
            'ms3.size_name as size_name_3',
            'ms4.size_cd as size_cd_4',
            'ms4.size_name as size_name_4',
            'ms5.size_cd as size_cd_5',
            'ms5.size_name as size_name_5',
            'ms6.size_cd as size_cd_6',
            'ms6.size_name as size_name_6',
            'ms7.size_cd as size_cd_7',
            'ms7.size_name as size_name_7',
            'ms8.size_cd as size_cd_8',
            'ms8.size_name as size_name_8',
            'ms9.size_cd as size_cd_9',
            'ms9.size_name as size_name_9',
            'ms10.size_cd as size_cd_10',
            'ms10.size_name as size_name_10',
        );
        $query->leftJoin("mt_sizes as ms1", "mt_size_patterns.mt_size_id_1", "ms1.id");
        $query->leftJoin("mt_sizes as ms2", "mt_size_patterns.mt_size_id_2", "ms2.id");
        $query->leftJoin("mt_sizes as ms3", "mt_size_patterns.mt_size_id_3", "ms3.id");
        $query->leftJoin("mt_sizes as ms4", "mt_size_patterns.mt_size_id_4", "ms4.id");
        $query->leftJoin("mt_sizes as ms5", "mt_size_patterns.mt_size_id_5", "ms5.id");
        $query->leftJoin("mt_sizes as ms6", "mt_size_patterns.mt_size_id_6", "ms6.id");
        $query->leftJoin("mt_sizes as ms7", "mt_size_patterns.mt_size_id_7", "ms7.id");
        $query->leftJoin("mt_sizes as ms8", "mt_size_patterns.mt_size_id_8", "ms8.id");
        $query->leftJoin("mt_sizes as ms9", "mt_size_patterns.mt_size_id_9", "ms9.id");
        $query->leftJoin("mt_sizes as ms10", "mt_size_patterns.mt_size_id_10", "ms10.id");
        $query->where("mt_size_patterns.size_pattern_cd", $code);

        return $query->first();
    }
}
