<?php

namespace App\Repositories\MtColorPattern;

use App\Models\MtColorPattern;
use App\Models\MtColor;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtColorPatternRepository implements MtColorPatternRepositoryInterface
{

    /**
     * カラーパターン情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtColorPattern::select(
            'mt_color_patterns.id as id',
            'mt_color_patterns.color_pattern_cd as color_pattern_cd',
            'mc1.id as color_id1',
            'mc1.color_cd as color_cd1',
            'mc1.color_name as color_name1',
            'mc2.id as color_id2',
            'mc2.color_cd as color_cd2',
            'mc2.color_name as color_name2',
            'mc3.id as color_id3',
            'mc3.color_cd as color_cd3',
            'mc3.color_name as color_name3',
            'mc4.id as color_id4',
            'mc4.color_cd as color_cd4',
            'mc4.color_name as color_name4',
            'mc5.id as color_id5',
            'mc5.color_cd as color_cd5',
            'mc5.color_name as color_name5',
            'mc6.id as color_id6',
            'mc6.color_cd as color_cd6',
            'mc6.color_name as color_name6',
            'mc7.id as color_id7',
            'mc7.color_cd as color_cd7',
            'mc7.color_name as color_name7',
            'mc8.id as color_id8',
            'mc8.color_cd as color_cd8',
            'mc8.color_name as color_name8',
            'mc9.id as color_id19',
            'mc9.color_cd as color_cd9',
            'mc9.color_name as color_name9',
            'mc10.id as color_id10',
            'mc10.color_cd as color_cd10',
            'mc10.color_name as color_name10',
            'mc11.id as color_id11',
            'mc11.color_cd as color_cd11',
            'mc11.color_name as color_name11',
            'mc12.id as color_id12',
            'mc12.color_cd as color_cd12',
            'mc12.color_name as color_name12',
            'mc13.id as color_id13',
            'mc13.color_cd as color_cd13',
            'mc13.color_name as color_name13',
            'mc14.id as color_id14',
            'mc14.color_cd as color_cd14',
            'mc14.color_name as color_name14',
            'mc15.id as color_id15',
            'mc15.color_cd as color_cd15',
            'mc15.color_name as color_name15',
            'mc16.id as color_id16',
            'mc16.color_cd as color_cd16',
            'mc16.color_name as color_name16',
            'mc17.id as color_id17',
            'mc17.color_cd as color_cd17',
            'mc17.color_name as color_name17',
            'mc18.id as color_id18',
            'mc18.color_cd as color_cd18',
            'mc18.color_name as color_name18',
            'mc19.id as color_id19',
            'mc19.color_cd as color_cd19',
            'mc19.color_name as color_name19',
            'mc20.id as color_id20',
            'mc20.color_cd as color_cd20',
            'mc20.color_name as color_name20'
        )
            ->leftJoin("mt_colors as mc1", "mt_color_patterns.mt_color_id_1", "mc1.id")
            ->leftJoin("mt_colors as mc2", "mt_color_patterns.mt_color_id_2", "mc2.id")
            ->leftJoin("mt_colors as mc3", "mt_color_patterns.mt_color_id_3", "mc3.id")
            ->leftJoin("mt_colors as mc4", "mt_color_patterns.mt_color_id_4", "mc4.id")
            ->leftJoin("mt_colors as mc5", "mt_color_patterns.mt_color_id_5", "mc5.id")
            ->leftJoin("mt_colors as mc6", "mt_color_patterns.mt_color_id_6", "mc6.id")
            ->leftJoin("mt_colors as mc7", "mt_color_patterns.mt_color_id_7", "mc7.id")
            ->leftJoin("mt_colors as mc8", "mt_color_patterns.mt_color_id_8", "mc8.id")
            ->leftJoin("mt_colors as mc9", "mt_color_patterns.mt_color_id_9", "mc9.id")
            ->leftJoin("mt_colors as mc10", "mt_color_patterns.mt_color_id_10", "mc10.id")
            ->leftJoin("mt_colors as mc11", "mt_color_patterns.mt_color_id_11", "mc11.id")
            ->leftJoin("mt_colors as mc12", "mt_color_patterns.mt_color_id_12", "mc12.id")
            ->leftJoin("mt_colors as mc13", "mt_color_patterns.mt_color_id_13", "mc13.id")
            ->leftJoin("mt_colors as mc14", "mt_color_patterns.mt_color_id_14", "mc14.id")
            ->leftJoin("mt_colors as mc15", "mt_color_patterns.mt_color_id_15", "mc15.id")
            ->leftJoin("mt_colors as mc16", "mt_color_patterns.mt_color_id_16", "mc16.id")
            ->leftJoin("mt_colors as mc17", "mt_color_patterns.mt_color_id_17", "mc17.id")
            ->leftJoin("mt_colors as mc18", "mt_color_patterns.mt_color_id_18", "mc18.id")
            ->leftJoin("mt_colors as mc19", "mt_color_patterns.mt_color_id_19", "mc19.id")
            ->leftJoin("mt_colors as mc20", "mt_color_patterns.mt_color_id_20", "mc20.id")
            ->orderBy("mt_color_patterns.color_pattern_cd")
            ->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * カラーパターン情報取得 初期データ取得
     * @return Object
     */
    public function getInitData()
    {
        $result = MtColorPattern::select(
            'mt_color_patterns.id as id',
            'mt_color_patterns.color_pattern_cd as color_pattern_cd',
            'mc1.id as color_id1',
            'mc1.color_cd as color_cd1',
            'mc1.color_name as color_name1',
            'mc2.id as color_id2',
            'mc2.color_cd as color_cd2',
            'mc2.color_name as color_name2',
            'mc3.id as color_id3',
            'mc3.color_cd as color_cd3',
            'mc3.color_name as color_name3',
            'mc4.id as color_id4',
            'mc4.color_cd as color_cd4',
            'mc4.color_name as color_name4',
            'mc5.id as color_id5',
            'mc5.color_cd as color_cd5',
            'mc5.color_name as color_name5',
            'mc6.id as color_id6',
            'mc6.color_cd as color_cd6',
            'mc6.color_name as color_name6',
            'mc7.id as color_id7',
            'mc7.color_cd as color_cd7',
            'mc7.color_name as color_name7',
            'mc8.id as color_id8',
            'mc8.color_cd as color_cd8',
            'mc8.color_name as color_name8',
            'mc9.id as color_id19',
            'mc9.color_cd as color_cd9',
            'mc9.color_name as color_name9',
            'mc10.id as color_id10',
            'mc10.color_cd as color_cd10',
            'mc10.color_name as color_name10',
            'mc11.id as color_id11',
            'mc11.color_cd as color_cd11',
            'mc11.color_name as color_name11',
            'mc12.id as color_id12',
            'mc12.color_cd as color_cd12',
            'mc12.color_name as color_name12',
            'mc13.id as color_id13',
            'mc13.color_cd as color_cd13',
            'mc13.color_name as color_name13',
            'mc14.id as color_id14',
            'mc14.color_cd as color_cd14',
            'mc14.color_name as color_name14',
            'mc15.id as color_id15',
            'mc15.color_cd as color_cd15',
            'mc15.color_name as color_name15',
            'mc16.id as color_id16',
            'mc16.color_cd as color_cd16',
            'mc16.color_name as color_name16',
            'mc17.id as color_id17',
            'mc17.color_cd as color_cd17',
            'mc17.color_name as color_name17',
            'mc18.id as color_id18',
            'mc18.color_cd as color_cd18',
            'mc18.color_name as color_name18',
            'mc19.id as color_id19',
            'mc19.color_cd as color_cd19',
            'mc19.color_name as color_name19',
            'mc20.id as color_id20',
            'mc20.color_cd as color_cd20',
            'mc20.color_name as color_name20'
        )
            ->leftJoin("mt_colors as mc1", "mt_color_patterns.mt_color_id_1", "mc1.id")
            ->leftJoin("mt_colors as mc2", "mt_color_patterns.mt_color_id_2", "mc2.id")
            ->leftJoin("mt_colors as mc3", "mt_color_patterns.mt_color_id_3", "mc3.id")
            ->leftJoin("mt_colors as mc4", "mt_color_patterns.mt_color_id_4", "mc4.id")
            ->leftJoin("mt_colors as mc5", "mt_color_patterns.mt_color_id_5", "mc5.id")
            ->leftJoin("mt_colors as mc6", "mt_color_patterns.mt_color_id_6", "mc6.id")
            ->leftJoin("mt_colors as mc7", "mt_color_patterns.mt_color_id_7", "mc7.id")
            ->leftJoin("mt_colors as mc8", "mt_color_patterns.mt_color_id_8", "mc8.id")
            ->leftJoin("mt_colors as mc9", "mt_color_patterns.mt_color_id_9", "mc9.id")
            ->leftJoin("mt_colors as mc10", "mt_color_patterns.mt_color_id_10", "mc10.id")
            ->leftJoin("mt_colors as mc11", "mt_color_patterns.mt_color_id_11", "mc11.id")
            ->leftJoin("mt_colors as mc12", "mt_color_patterns.mt_color_id_12", "mc12.id")
            ->leftJoin("mt_colors as mc13", "mt_color_patterns.mt_color_id_13", "mc13.id")
            ->leftJoin("mt_colors as mc14", "mt_color_patterns.mt_color_id_14", "mc14.id")
            ->leftJoin("mt_colors as mc15", "mt_color_patterns.mt_color_id_15", "mc15.id")
            ->leftJoin("mt_colors as mc16", "mt_color_patterns.mt_color_id_16", "mc16.id")
            ->leftJoin("mt_colors as mc17", "mt_color_patterns.mt_color_id_17", "mc17.id")
            ->leftJoin("mt_colors as mc18", "mt_color_patterns.mt_color_id_18", "mc18.id")
            ->leftJoin("mt_colors as mc19", "mt_color_patterns.mt_color_id_19", "mc19.id")
            ->leftJoin("mt_colors as mc20", "mt_color_patterns.mt_color_id_20", "mc20.id")
            ->orderBy("mt_color_patterns.color_pattern_cd")
            ->get();
        return $result;
    }

    /**
     * カラーパターン情報 削除(id指定)
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $result['data'] = MtColorPattern::where('id', $id)->delete();
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
     * カラーパターンマスタ(一覧) 更新
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
                    if (!empty($params['update_color_pattern_code'][$j])) {
                        $mtColorPattern = MtColorPattern::where('id', $param)->first();
                        $mtColorIds = array();
                        // code⇒id変換
                        for ($k = 1; $k <= 20; $k++) {
                            if (isset($params["update_color_code{$k}"][$j])) {
                                if (empty($params["update_color_code{$k}"][$j])) {
                                    $mtColorIds["mt_color_id_{$k}"] = null;
                                } else {
                                    $mtColorId = MtColor::getIdByCode($params["update_color_code{$k}"][$j]);
                                    if (empty($mtColorId)) {
                                        DB::rollback();
                                        $result['status'] = CommonConsts::STATUS_ERROR;
                                        $result['error'] = "カラーコード{$k}がカラーマスタに存在しません";
                                        return $result;
                                    } else {
                                        $mtColorIds["mt_color_id_{$k}"] = $mtColorId['id'];
                                    }
                                }
                            }
                        }

                        /*
                        $mtColorIds['mt_color_id_1'] = MtColor::getIdByCode($params['update_color_code1'][$j]) ? MtColor::getIdByCode($params['update_color_code1'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_2'] = MtColor::getIdByCode($params['update_color_code1'][$j]) ? MtColor::getIdByCode($params['update_color_code2'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_3'] = MtColor::getIdByCode($params['update_color_code3'][$j]) ? MtColor::getIdByCode($params['update_color_code3'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_4'] = MtColor::getIdByCode($params['update_color_code4'][$j]) ? MtColor::getIdByCode($params['update_color_code4'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_5'] = MtColor::getIdByCode($params['update_color_code5'][$j]) ? MtColor::getIdByCode($params['update_color_code5'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_6'] = MtColor::getIdByCode($params['update_color_code6'][$j]) ? MtColor::getIdByCode($params['update_color_code6'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_7'] = MtColor::getIdByCode($params['update_color_code7'][$j]) ? MtColor::getIdByCode($params['update_color_code7'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_8'] = MtColor::getIdByCode($params['update_color_code8'][$j]) ? MtColor::getIdByCode($params['update_color_code8'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_9'] = MtColor::getIdByCode($params['update_color_code9'][$j]) ? MtColor::getIdByCode($params['update_color_code9'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_10'] = MtColor::getIdByCode($params['update_color_code10'][$j]) ? MtColor::getIdByCode($params['update_color_code10'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_11'] = MtColor::getIdByCode($params['update_color_code11'][$j]) ? MtColor::getIdByCode($params['update_color_code11'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_12'] = MtColor::getIdByCode($params['update_color_code12'][$j]) ? MtColor::getIdByCode($params['update_color_code12'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_13'] = MtColor::getIdByCode($params['update_color_code13'][$j]) ? MtColor::getIdByCode($params['update_color_code13'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_14'] = MtColor::getIdByCode($params['update_color_code14'][$j]) ? MtColor::getIdByCode($params['update_color_code14'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_15'] = MtColor::getIdByCode($params['update_color_code15'][$j]) ? MtColor::getIdByCode($params['update_color_code15'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_16'] = MtColor::getIdByCode($params['update_color_code16'][$j]) ? MtColor::getIdByCode($params['update_color_code16'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_17'] = MtColor::getIdByCode($params['update_color_code17'][$j]) ? MtColor::getIdByCode($params['update_color_code17'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_18'] = MtColor::getIdByCode($params['update_color_code18'][$j]) ? MtColor::getIdByCode($params['update_color_code18'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_19'] = MtColor::getIdByCode($params['update_color_code19'][$j]) ? MtColor::getIdByCode($params['update_color_code19'][$j])['id'] : NULL;
                        $mtColorIds['mt_color_id_20'] = MtColor::getIdByCode($params['update_color_code20'][$j]) ? MtColor::getIdByCode($params['update_color_code20'][$j])['id'] : NULL;
                        */
                        //変更の有無を確認
                        /*
                        if (
                            isset($mtColorPattern) &&
                            $mtColorPattern['mt_color_id_1'] === $mtColorIds['mt_color_id_1'] &&
                            $mtColorPattern['mt_color_id_2'] === $mtColorIds['mt_color_id_2'] &&
                            $mtColorPattern['mt_color_id_3'] === $mtColorIds['mt_color_id_3'] &&
                            $mtColorPattern['mt_color_id_4'] === $mtColorIds['mt_color_id_4'] &&
                            $mtColorPattern['mt_color_id_5'] === $mtColorIds['mt_color_id_5'] &&
                            $mtColorPattern['mt_color_id_6'] === $mtColorIds['mt_color_id_6'] &&
                            $mtColorPattern['mt_color_id_7'] === $mtColorIds['mt_color_id_7'] &&
                            $mtColorPattern['mt_color_id_8'] === $mtColorIds['mt_color_id_8'] &&
                            $mtColorPattern['mt_color_id_9'] === $mtColorIds['mt_color_id_9'] &&
                            $mtColorPattern['mt_color_id_10'] === $mtColorIds['mt_color_id_10'] &&
                            $mtColorPattern['mt_color_id_11'] === $mtColorIds['mt_color_id_11'] &&
                            $mtColorPattern['mt_color_id_12'] === $mtColorIds['mt_color_id_12'] &&
                            $mtColorPattern['mt_color_id_13'] === $mtColorIds['mt_color_id_13'] &&
                            $mtColorPattern['mt_color_id_14'] === $mtColorIds['mt_color_id_14'] &&
                            $mtColorPattern['mt_color_id_15'] === $mtColorIds['mt_color_id_15'] &&
                            $mtColorPattern['mt_color_id_16'] === $mtColorIds['mt_color_id_16'] &&
                            $mtColorPattern['mt_color_id_17'] === $mtColorIds['mt_color_id_17'] &&
                            $mtColorPattern['mt_color_id_18'] === $mtColorIds['mt_color_id_18'] &&
                            $mtColorPattern['mt_color_id_19'] === $mtColorIds['mt_color_id_19'] &&
                            $mtColorPattern['mt_color_id_20'] === $mtColorIds['mt_color_id_20']
                        ) {
                            $j++;
                            continue; //変更がない場合、更新を行わない
                        }
                            */
                        //$mtColorPattern->color_pattern_cd = $params['update_color_pattern_code'][$j];
                        $mtColorPattern->mt_color_id_1 = isset($mtColorIds['mt_color_id_1']) ? $mtColorIds['mt_color_id_1'] : null;
                        $mtColorPattern->mt_color_id_2 = isset($mtColorIds['mt_color_id_2']) ? $mtColorIds['mt_color_id_2'] : null;
                        $mtColorPattern->mt_color_id_3 = isset($mtColorIds['mt_color_id_3']) ? $mtColorIds['mt_color_id_3'] : null;
                        $mtColorPattern->mt_color_id_4 = isset($mtColorIds['mt_color_id_4']) ? $mtColorIds['mt_color_id_4'] : null;
                        $mtColorPattern->mt_color_id_5 = isset($mtColorIds['mt_color_id_5']) ? $mtColorIds['mt_color_id_5'] : null;
                        $mtColorPattern->mt_color_id_6 = isset($mtColorIds['mt_color_id_6']) ? $mtColorIds['mt_color_id_6'] : null;
                        $mtColorPattern->mt_color_id_7 = isset($mtColorIds['mt_color_id_7']) ? $mtColorIds['mt_color_id_7'] : null;
                        $mtColorPattern->mt_color_id_8 = isset($mtColorIds['mt_color_id_8']) ? $mtColorIds['mt_color_id_8'] : null;
                        $mtColorPattern->mt_color_id_9 = isset($mtColorIds['mt_color_id_9']) ? $mtColorIds['mt_color_id_9'] : null;
                        $mtColorPattern->mt_color_id_10 = isset($mtColorIds['mt_color_id_10']) ? $mtColorIds['mt_color_id_10'] : null;
                        $mtColorPattern->mt_color_id_11 = isset($mtColorIds['mt_color_id_11']) ? $mtColorIds['mt_color_id_11'] : null;
                        $mtColorPattern->mt_color_id_12 = isset($mtColorIds['mt_color_id_12']) ? $mtColorIds['mt_color_id_12'] : null;
                        $mtColorPattern->mt_color_id_13 = isset($mtColorIds['mt_color_id_13']) ? $mtColorIds['mt_color_id_13'] : null;
                        $mtColorPattern->mt_color_id_14 = isset($mtColorIds['mt_color_id_14']) ? $mtColorIds['mt_color_id_14'] : null;
                        $mtColorPattern->mt_color_id_15 = isset($mtColorIds['mt_color_id_15']) ? $mtColorIds['mt_color_id_15'] : null;
                        $mtColorPattern->mt_color_id_16 = isset($mtColorIds['mt_color_id_16']) ? $mtColorIds['mt_color_id_16'] : null;
                        $mtColorPattern->mt_color_id_17 = isset($mtColorIds['mt_color_id_17']) ? $mtColorIds['mt_color_id_17'] : null;
                        $mtColorPattern->mt_color_id_18 = isset($mtColorIds['mt_color_id_18']) ? $mtColorIds['mt_color_id_18'] : null;
                        $mtColorPattern->mt_color_id_19 = isset($mtColorIds['mt_color_id_19']) ? $mtColorIds['mt_color_id_19'] : null;
                        $mtColorPattern->mt_color_id_20 = isset($mtColorIds['mt_color_id_20']) ? $mtColorIds['mt_color_id_20'] : null;
                        $mtColorPattern->mt_user_last_update_id = Auth::user()->id;
                        $mtColorPattern->save();
                    }
                    $j++;
                }
            }

            //新規登録
            $i = 0;
            foreach ($params['insert_color_pattern_code'] as $param) {
                $mtColorPattern = MtColorPattern::where('color_pattern_cd', $param)->first();
                if (!empty($mtColorPattern)) {
                    DB::rollback();
                    $result['status'] = CommonConsts::STATUS_ERROR;
                    $result['error'] = "既にカラーパターンコード={$mtColorPattern['color_pattern_cd']}で<br>登録されています";
                    return $result;
                }
                // code⇒id変換
                $mtColorIds = array();
                for ($k = 1; $k <= 20; $k++) {
                    if (isset($params["insert_color_code{$k}"][$i])) {
                        $mtColorId = MtColor::getIdByCode($params["insert_color_code{$k}"][$i]);
                        Log::info("mt_color_id_{$k}");
                        // code⇒id変換
                        if (empty($params["insert_color_code{$k}"][$i])) {
                            //array_merge($mtColorIds, array("mt_color_id_{$k}" => null));
                            $mtColorIds["mt_color_id_{$k}"] = null;
                            Log::info("test01");
                        } else {
                            $mtColorId = MtColor::getIdByCode($params["insert_color_code{$k}"][$i]);
                            if (empty($mtColorId)) {;
                                DB::rollback();
                                $result['status'] = CommonConsts::STATUS_ERROR;
                                $result['error'] = "カラーコード{$k}がカラーマスタに存在しません";
                                return $result;
                            } else {
                                //array_merge($mtColorIds, array("mt_color_id_{$k}" => $mtColorId['id']));
                                $mtColorIds["mt_color_id_{$k}"] = $mtColorId['id'];
                            }
                        }
                    }
                }

                if (!empty($params['insert_color_pattern_code'][$i])) {
                    $mtColorPattern = new MtColorPattern();
                    $mtColorPattern->color_pattern_cd = $params['insert_color_pattern_code'][$i];
                    $mtColorPattern->mt_color_id_1 = isset($mtColorIds['mt_color_id_1']) ? $mtColorIds['mt_color_id_1'] : null;
                    $mtColorPattern->mt_color_id_2 = isset($mtColorIds['mt_color_id_2']) ? $mtColorIds['mt_color_id_2'] : null;
                    $mtColorPattern->mt_color_id_3 = isset($mtColorIds['mt_color_id_3']) ? $mtColorIds['mt_color_id_3'] : null;
                    $mtColorPattern->mt_color_id_4 = isset($mtColorIds['mt_color_id_4']) ? $mtColorIds['mt_color_id_4'] : null;
                    $mtColorPattern->mt_color_id_5 = isset($mtColorIds['mt_color_id_5']) ? $mtColorIds['mt_color_id_5'] : null;
                    $mtColorPattern->mt_color_id_6 = isset($mtColorIds['mt_color_id_6']) ? $mtColorIds['mt_color_id_6'] : null;
                    $mtColorPattern->mt_color_id_7 = isset($mtColorIds['mt_color_id_7']) ? $mtColorIds['mt_color_id_7'] : null;
                    $mtColorPattern->mt_color_id_8 = isset($mtColorIds['mt_color_id_8']) ? $mtColorIds['mt_color_id_8'] : null;
                    $mtColorPattern->mt_color_id_9 = isset($mtColorIds['mt_color_id_9']) ? $mtColorIds['mt_color_id_9'] : null;
                    $mtColorPattern->mt_color_id_10 = isset($mtColorIds['mt_color_id_10']) ? $mtColorIds['mt_color_id_10'] : null;
                    $mtColorPattern->mt_color_id_11 = isset($mtColorIds['mt_color_id_11']) ? $mtColorIds['mt_color_id_11'] : null;
                    $mtColorPattern->mt_color_id_12 = isset($mtColorIds['mt_color_id_12']) ? $mtColorIds['mt_color_id_12'] : null;
                    $mtColorPattern->mt_color_id_13 = isset($mtColorIds['mt_color_id_13']) ? $mtColorIds['mt_color_id_13'] : null;
                    $mtColorPattern->mt_color_id_14 = isset($mtColorIds['mt_color_id_14']) ? $mtColorIds['mt_color_id_14'] : null;
                    $mtColorPattern->mt_color_id_15 = isset($mtColorIds['mt_color_id_15']) ? $mtColorIds['mt_color_id_15'] : null;
                    $mtColorPattern->mt_color_id_16 = isset($mtColorIds['mt_color_id_16']) ? $mtColorIds['mt_color_id_16'] : null;
                    $mtColorPattern->mt_color_id_17 = isset($mtColorIds['mt_color_id_17']) ? $mtColorIds['mt_color_id_17'] : null;
                    $mtColorPattern->mt_color_id_18 = isset($mtColorIds['mt_color_id_18']) ? $mtColorIds['mt_color_id_18'] : null;
                    $mtColorPattern->mt_color_id_19 = isset($mtColorIds['mt_color_id_19']) ? $mtColorIds['mt_color_id_19'] : null;
                    $mtColorPattern->mt_color_id_20 = isset($mtColorIds['mt_color_id_20']) ? $mtColorIds['mt_color_id_20'] : null;
                    $mtColorPattern->mt_user_last_update_id = Auth::user()->id;
                    $mtColorPattern->save();
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
     * カラーパターン情報取得 指定条件にて取得
     * @param $params
     * @return Object
     */
    public function get($params)
    {
        $code = $params['color_pattern_cd'] ? CodeUtil::pad($params['color_pattern_cd'], 4) : null;

        $query = MtColorPattern::query();
        $query->select(
            'mt_color_patterns.color_pattern_cd as color_pattern_cd',
            'mc1.color_name as color_name1',
            'mc2.color_name as color_name2',
            'mc3.color_name as color_name3',
            'mc4.color_name as color_name4',
            'mc5.color_name as color_name5',
            'mc6.color_name as color_name6',
            'mc7.color_name as color_name7',
            'mc8.color_name as color_name8',
            'mc9.color_name as color_name9',
            'mc10.color_name as color_name10',
            'mc11.color_name as color_name11',
            'mc12.color_name as color_name12',
            'mc13.color_name as color_name13',
            'mc14.color_name as color_name14',
            'mc15.color_name as color_name15',
            'mc16.color_name as color_name16',
            'mc17.color_name as color_name17',
            'mc18.color_name as color_name18',
            'mc19.color_name as color_name19',
            'mc20.color_name as color_name20'
        );
        $query->leftJoin("mt_colors as mc1", "mt_color_patterns.mt_color_id_1", "mc1.id");
        $query->leftJoin("mt_colors as mc2", "mt_color_patterns.mt_color_id_2", "mc2.id");
        $query->leftJoin("mt_colors as mc3", "mt_color_patterns.mt_color_id_3", "mc3.id");
        $query->leftJoin("mt_colors as mc4", "mt_color_patterns.mt_color_id_4", "mc4.id");
        $query->leftJoin("mt_colors as mc5", "mt_color_patterns.mt_color_id_5", "mc5.id");
        $query->leftJoin("mt_colors as mc6", "mt_color_patterns.mt_color_id_6", "mc6.id");
        $query->leftJoin("mt_colors as mc7", "mt_color_patterns.mt_color_id_7", "mc7.id");
        $query->leftJoin("mt_colors as mc8", "mt_color_patterns.mt_color_id_8", "mc8.id");
        $query->leftJoin("mt_colors as mc9", "mt_color_patterns.mt_color_id_9", "mc9.id");
        $query->leftJoin("mt_colors as mc10", "mt_color_patterns.mt_color_id_10", "mc10.id");
        $query->leftJoin("mt_colors as mc11", "mt_color_patterns.mt_color_id_11", "mc11.id");
        $query->leftJoin("mt_colors as mc12", "mt_color_patterns.mt_color_id_12", "mc12.id");
        $query->leftJoin("mt_colors as mc13", "mt_color_patterns.mt_color_id_13", "mc13.id");
        $query->leftJoin("mt_colors as mc14", "mt_color_patterns.mt_color_id_14", "mc14.id");
        $query->leftJoin("mt_colors as mc15", "mt_color_patterns.mt_color_id_15", "mc15.id");
        $query->leftJoin("mt_colors as mc16", "mt_color_patterns.mt_color_id_16", "mc16.id");
        $query->leftJoin("mt_colors as mc17", "mt_color_patterns.mt_color_id_17", "mc17.id");
        $query->leftJoin("mt_colors as mc18", "mt_color_patterns.mt_color_id_18", "mc18.id");
        $query->leftJoin("mt_colors as mc19", "mt_color_patterns.mt_color_id_19", "mc19.id");
        $query->leftJoin("mt_colors as mc20", "mt_color_patterns.mt_color_id_20", "mc20.id");
        $query->when($query->when($code, fn($query) => $query->where("color_pattern_cd", '>=', $code)));
        $query->orderBy("mt_color_patterns.color_pattern_cd");

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * カラーパターンリスト(一覧)  出力情報を取得
     * @param $params
     * @return Object
     */
    public function export($params)
    {
        $startCode = ($params['code_start']) ? str_pad($params['code_start'], 4, 0, STR_PAD_LEFT) : '';
        $endCode = ($params['code_end']) ? str_pad($params['code_end'], 4, 0, STR_PAD_LEFT) : 'ZZZZ';
        $result = MtColorPattern::select(
            'mt_color_patterns.id as id',
            'mt_color_patterns.color_pattern_cd as color_pattern_cd',
            'mc1.color_cd as color_cd_1',
            'mc1.color_name as color_name_1',
            'mc2.color_cd as color_cd_2',
            'mc2.color_name as color_name_2',
            'mc3.color_cd as color_cd_3',
            'mc3.color_name as color_name_3',
            'mc4.color_cd as color_cd_4',
            'mc4.color_name as color_name_4',
            'mc5.color_cd as color_cd_5',
            'mc5.color_name as color_name_5',
            'mc6.color_cd as color_cd_6',
            'mc6.color_name as color_name_6',
            'mc7.color_cd as color_cd_7',
            'mc7.color_name as color_name_7',
            'mc8.color_cd as color_cd_8',
            'mc8.color_name as color_name_8',
            'mc9.color_cd as color_cd_9',
            'mc9.color_name as color_name_9',
            'mc10.color_cd as color_cd_10',
            'mc10.color_name as color_name_10',
            'mc11.color_cd as color_cd_11',
            'mc11.color_name as color_name_11',
            'mc12.color_cd as color_cd_12',
            'mc12.color_name as color_name_12',
            'mc13.color_cd as color_cd_13',
            'mc13.color_name as color_name_13',
            'mc14.color_cd as color_cd_14',
            'mc14.color_name as color_name_14',
            'mc15.color_cd as color_cd_15',
            'mc15.color_name as color_name_15',
            'mc16.color_cd as color_cd_16',
            'mc16.color_name as color_name_16',
            'mc17.color_cd as color_cd_17',
            'mc17.color_name as color_name_17',
            'mc18.color_cd as color_cd_18',
            'mc18.color_name as color_name_18',
            'mc19.color_cd as color_cd_19',
            'mc19.color_name as color_name_19',
            'mc20.color_cd as color_cd_20',
            'mc20.color_name as color_name_20',
        )
            ->leftJoin("mt_colors as mc1", "mt_color_patterns.mt_color_id_1", "mc1.id")
            ->leftJoin("mt_colors as mc2", "mt_color_patterns.mt_color_id_2", "mc2.id")
            ->leftJoin("mt_colors as mc3", "mt_color_patterns.mt_color_id_3", "mc3.id")
            ->leftJoin("mt_colors as mc4", "mt_color_patterns.mt_color_id_4", "mc4.id")
            ->leftJoin("mt_colors as mc5", "mt_color_patterns.mt_color_id_5", "mc5.id")
            ->leftJoin("mt_colors as mc6", "mt_color_patterns.mt_color_id_6", "mc6.id")
            ->leftJoin("mt_colors as mc7", "mt_color_patterns.mt_color_id_7", "mc7.id")
            ->leftJoin("mt_colors as mc8", "mt_color_patterns.mt_color_id_8", "mc8.id")
            ->leftJoin("mt_colors as mc9", "mt_color_patterns.mt_color_id_9", "mc9.id")
            ->leftJoin("mt_colors as mc10", "mt_color_patterns.mt_color_id_10", "mc10.id")
            ->leftJoin("mt_colors as mc11", "mt_color_patterns.mt_color_id_11", "mc11.id")
            ->leftJoin("mt_colors as mc12", "mt_color_patterns.mt_color_id_12", "mc12.id")
            ->leftJoin("mt_colors as mc13", "mt_color_patterns.mt_color_id_13", "mc13.id")
            ->leftJoin("mt_colors as mc14", "mt_color_patterns.mt_color_id_14", "mc14.id")
            ->leftJoin("mt_colors as mc15", "mt_color_patterns.mt_color_id_15", "mc15.id")
            ->leftJoin("mt_colors as mc16", "mt_color_patterns.mt_color_id_16", "mc16.id")
            ->leftJoin("mt_colors as mc17", "mt_color_patterns.mt_color_id_17", "mc17.id")
            ->leftJoin("mt_colors as mc18", "mt_color_patterns.mt_color_id_18", "mc18.id")
            ->leftJoin("mt_colors as mc19", "mt_color_patterns.mt_color_id_19", "mc19.id")
            ->leftJoin("mt_colors as mc20", "mt_color_patterns.mt_color_id_20", "mc20.id")
            ->whereBetween("mt_color_patterns.color_pattern_cd", [$startCode, $endCode])
            ->orderBy("mt_color_patterns.color_pattern_cd")
            ->get();
        return $result;
    }

    /**
     * カラーパターン 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['color_pattern_cd'] ? CodeUtil::pad($params['color_pattern_cd'], 4) : null;

        $query = MtColorPattern::query();
        $query->select(
            'mt_color_patterns.id as id',
            'mt_color_patterns.color_pattern_cd as color_pattern_cd',
            'mc1.color_cd as color_cd_1',
            'mc1.color_name as color_name_1',
            'mc2.color_cd as color_cd_2',
            'mc2.color_name as color_name_2',
            'mc3.color_cd as color_cd_3',
            'mc3.color_name as color_name_3',
            'mc4.color_cd as color_cd_4',
            'mc4.color_name as color_name_4',
            'mc5.color_cd as color_cd_5',
            'mc5.color_name as color_name_5',
            'mc6.color_cd as color_cd_6',
            'mc6.color_name as color_name_6',
            'mc7.color_cd as color_cd_7',
            'mc7.color_name as color_name_7',
            'mc8.color_cd as color_cd_8',
            'mc8.color_name as color_name_8',
            'mc9.color_cd as color_cd_9',
            'mc9.color_name as color_name_9',
            'mc10.color_cd as color_cd_10',
            'mc10.color_name as color_name_10',
            'mc11.color_cd as color_cd_11',
            'mc11.color_name as color_name_11',
            'mc12.color_cd as color_cd_12',
            'mc12.color_name as color_name_12',
            'mc13.color_cd as color_cd_13',
            'mc13.color_name as color_name_13',
            'mc14.color_cd as color_cd_14',
            'mc14.color_name as color_name_14',
            'mc15.color_cd as color_cd_15',
            'mc15.color_name as color_name_15',
            'mc16.color_cd as color_cd_16',
            'mc16.color_name as color_name_16',
            'mc17.color_cd as color_cd_17',
            'mc17.color_name as color_name_17',
            'mc18.color_cd as color_cd_18',
            'mc18.color_name as color_name_18',
            'mc19.color_cd as color_cd_19',
            'mc19.color_name as color_name_19',
            'mc20.color_cd as color_cd_20',
            'mc20.color_name as color_name_20',
        );
        $query->leftJoin("mt_colors as mc1", "mt_color_patterns.mt_color_id_1", "mc1.id");
        $query->leftJoin("mt_colors as mc2", "mt_color_patterns.mt_color_id_2", "mc2.id");
        $query->leftJoin("mt_colors as mc3", "mt_color_patterns.mt_color_id_3", "mc3.id");
        $query->leftJoin("mt_colors as mc4", "mt_color_patterns.mt_color_id_4", "mc4.id");
        $query->leftJoin("mt_colors as mc5", "mt_color_patterns.mt_color_id_5", "mc5.id");
        $query->leftJoin("mt_colors as mc6", "mt_color_patterns.mt_color_id_6", "mc6.id");
        $query->leftJoin("mt_colors as mc7", "mt_color_patterns.mt_color_id_7", "mc7.id");
        $query->leftJoin("mt_colors as mc8", "mt_color_patterns.mt_color_id_8", "mc8.id");
        $query->leftJoin("mt_colors as mc9", "mt_color_patterns.mt_color_id_9", "mc9.id");
        $query->leftJoin("mt_colors as mc10", "mt_color_patterns.mt_color_id_10", "mc10.id");
        $query->leftJoin("mt_colors as mc11", "mt_color_patterns.mt_color_id_11", "mc11.id");
        $query->leftJoin("mt_colors as mc12", "mt_color_patterns.mt_color_id_12", "mc12.id");
        $query->leftJoin("mt_colors as mc13", "mt_color_patterns.mt_color_id_13", "mc13.id");
        $query->leftJoin("mt_colors as mc14", "mt_color_patterns.mt_color_id_14", "mc14.id");
        $query->leftJoin("mt_colors as mc15", "mt_color_patterns.mt_color_id_15", "mc15.id");
        $query->leftJoin("mt_colors as mc16", "mt_color_patterns.mt_color_id_16", "mc16.id");
        $query->leftJoin("mt_colors as mc17", "mt_color_patterns.mt_color_id_17", "mc17.id");
        $query->leftJoin("mt_colors as mc18", "mt_color_patterns.mt_color_id_18", "mc18.id");
        $query->leftJoin("mt_colors as mc19", "mt_color_patterns.mt_color_id_19", "mc19.id");
        $query->leftJoin("mt_colors as mc20", "mt_color_patterns.mt_color_id_20", "mc20.id");
        $query->where("mt_color_patterns.color_pattern_cd", $code);
        return $query->first();
    }
}
