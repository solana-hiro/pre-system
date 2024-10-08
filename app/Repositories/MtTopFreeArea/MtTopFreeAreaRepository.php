<?php

namespace App\Repositories\MtTopFreeArea;

use App\Models\MtTopFreeArea;
use App\Models\MtTopFreeAreaPublicationDestination;
use App\Models\MtCustomerClass;
use App\Models\MtCustomer;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtTopFreeAreaRepository implements MtTopFreeAreaRepositoryInterface
{

    /**
     * TOP自由領域情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtTopFreeArea::orderBy('area_cd')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * TOP自由領域情報取得関連データ 全件取得
     * @return Object
     */
    public function getAllData()
    {
        $result['MtCustomerClass1'] = MtCustomerClass::where('def_customer_class_thing_id', 1)->get();
        $result['MtCustomerClass2'] = MtCustomerClass::where('def_customer_class_thing_id', 2)->get();
        $result['MtCustomerClass3'] = MtCustomerClass::where('def_customer_class_thing_id', 3)->get();
        $result['MtCustomer'] = MtCustomer::get();
        return $result;
    }

    /**
     * TOP自由領域情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params)
    {
        $code = $params['area_cd'] ? CodeUtil::pad($params['area_cd'], 4) : null;
        $title = $params['area_title'] ?? null;

        $query = MtTopFreeArea::query();
        $query->when($code, fn($query) => $query->where("area_cd", '>=', $code));
        $query->when($title, fn($query) => $query->where("area_title", 'like', "%$title%"));
        $query->orderBy('area_cd');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * TOP自由領域情報取得 指定IDにて取得
     * @param $id
     * @return Object
     */
    public function getDetailById($id)
    {
        $result['MtTopFreeArea'] = MtTopFreeArea::where('id', $id)->first();
        $result['MtTopFreeAreaPublicationDestination'] = MtTopFreeAreaPublicationDestination::where('mt_top_free_area_id', $id)->get();
        return $result;
    }

    /**
     * TOP自由領域の最小ID取得
     * @return Object
     */
    public function getMinId()
    {
        $result = MtTopFreeArea::min('id');
        return $result;
    }

    /**
     * TOP自由領域の最大ID取得
     * @return Object
     */
    public function getMaxId()
    {
        $result = MtTopFreeArea::max('id');
        return $result;
    }

    /**
     * TOP自由領域　前頁
     * @param $id
     * @return Object
     */
    public function getPrevById($id)
    {
        if (isset($id)) {
            $result = MtTopFreeArea::where('id', '<', $id)->orderByDesc('id')->first();
        } else {
            $result = MtTopFreeArea::orderBy('id')->first();
        }
        return $result;
    }

    /**
     * TOP自由領域　次頁
     * @param $id
     * @return Object
     */
    public function getNextById($id)
    {
        if (isset($id)) {
            $result = MtTopFreeArea::where('id', '>', $id)->orderBy('id')->first();
        } else {
            $result = MtTopFreeArea::orderBy('id')->first();
        }
        return $result;
    }

    /**
     * TOP自由領域のIDによる削除
     * @param $id
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $result['MtTopFreeArea'] = MtTopFreeArea::where('id', $id)->delete();
            $result['MtTopFreeAreaPublicationDestination'] = MtTopFreeAreaPublicationDestination::where('mt_top_free_area_id', $id)->delete();
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
     * TOP自由領域の更新
     * @param $param
     * @param $fileParam
     * @return Object
     */
    public function update($param, $fileParam)
    {
        // 登録・TOP自由領域マスタ, TOP自由領域公開先マスタ
        // 削除: TOP自由領域マスタ, TOP自由領域公開先マスタ
        $result = array();
        try {
            DB::beginTransaction();
            // 更新
            $isTopFreeArea = MtTopFreeArea::where('area_cd', $param['input_area_cd'])->exists();
            if ($isTopFreeArea) {
                //更新
                $mtTopFreeArea = MtTopFreeArea::where('area_cd', $param['input_area_cd'])->first();
                $mtTopFreeArea->area_title = $param['input_area_title'] ?? '';
                $mtTopFreeArea->setting_position = $param['setting_position'] ?? 0;
                $mtTopFreeArea->content_type = $param['content_type'] ?? 0;
                $mtTopFreeArea->content = $param['content_type'] === '1' ? $param['rich_text_contents'] : $param['content'];
                $startDateTime = $param['release_start_datetime_year'] . '-' . $param['release_start_datetime_month'] . '-' . $param['release_start_datetime_day'] . ' ' . $param['release_start_datetime_time'];
                $mtTopFreeArea->release_start_datetime = checkdate($param['release_start_datetime_month'], $param['release_start_datetime_day'], $param['release_start_datetime_year']) ? Carbon::parse($startDateTime) : null;
                $endDateTime = $param['release_end_datetime_year'] . '-' . $param['release_end_datetime_month'] . '-' . $param['release_end_datetime_day'] . ' ' . $param['release_end_datetime_time'];
                $mtTopFreeArea->release_end_datetime = checkdate($param['release_end_datetime_month'], $param['release_end_datetime_day'], $param['release_end_datetime_year']) ? Carbon::parse($endDateTime) : null;
                $mtTopFreeArea->display_flg = $param['display_flg'] ?? 0;
                $mtTopFreeArea->display_sort_order = $param['display_sort_order'] ?? 0;
                $mtTopFreeArea->publication_destination_flg = $param['publication_destination_flg'] ?? 0;
                $mtTopFreeArea->mt_user_last_update_id = Auth::user()->id;
                $mtTopFreeArea->save();

                // 更新　データが存在する場合、一旦リセット
                $isTopFreeAreaPublicationDestination = MtTopFreeAreaPublicationDestination::where('mt_top_free_area_id', $mtTopFreeArea['id'])->exists();
                if ($isTopFreeAreaPublicationDestination) {
                    MtTopFreeAreaPublicationDestination::where('mt_top_free_area_id', $mtTopFreeArea['id'])->delete();
                }
                $this->createMtTopFreeAreaPublicationDestination($param, $mtTopFreeArea->id);

                //画像関連　更新(パスにIDが必要な為、別で更新する)$tableName . '/' . $keyId . '/' . $key;
                $commonS3Path = "mt_top_free_areas/" . $mtTopFreeArea['id'] . '/';
                if (isset($fileParam['image_file'])) {
                    $mtTopFreeArea->image_file = $commonS3Path . 'image_file/' . $fileParam['image_file']->getClientOriginalName();
                } elseif (is_null($param['image_file_src'])) {
                    $mtTopFreeArea->image_file = null;
                }

                $mtTopFreeArea->save();
                $result['mtTopFreeAreaId'] = $mtTopFreeArea['id'];
                $result['mtMemberSiteItemId'] = isset($mtTopFreeAreaPublicationDestination) ? $mtTopFreeAreaPublicationDestination['id'] : null;
            } else {
                //新規登録
                $mtTopFreeArea = new MtTopFreeArea();
                $mtTopFreeArea->area_cd = $param['input_area_cd'];
                $mtTopFreeArea->area_title = $param['input_area_title'];
                $mtTopFreeArea->setting_position = $param['setting_position'] ?? 0;
                $mtTopFreeArea->content_type = $param['content_type'] ?? 0;
                $mtTopFreeArea->content = $param['content'] ?? '';
                $startDateTime = $param['release_start_datetime_year'] . '-' . $param['release_start_datetime_month'] . '-' . $param['release_start_datetime_day'] . ' ' . $param['release_start_datetime_time'];
                $mtTopFreeArea->release_start_datetime = checkdate($param['release_start_datetime_month'], $param['release_start_datetime_day'], $param['release_start_datetime_year']) ? Carbon::parse($startDateTime) : null;
                $endDateTime = $param['release_end_datetime_year'] . '-' . $param['release_end_datetime_month'] . '-' . $param['release_end_datetime_day'] . ' ' . $param['release_end_datetime_time'];
                $mtTopFreeArea->release_end_datetime = checkdate($param['release_end_datetime_month'], $param['release_end_datetime_day'], $param['release_end_datetime_year']) ?  Carbon::parse($endDateTime) : null;
                $mtTopFreeArea->display_flg = $param['display_flg'] ?? 0;
                $mtTopFreeArea->display_sort_order = $param['display_sort_order'] ?? 0;
                $mtTopFreeArea->publication_destination_flg = $param['publication_destination_flg'] ?? 0;
                $mtTopFreeArea->mt_user_last_update_id = Auth::user()->id;
                $mtTopFreeArea->save();

                $this->createMtTopFreeAreaPublicationDestination($param, $mtTopFreeArea->id);

                //画像関連　更新(パスにIDが必要な為、別で更新する)$tableName . '/' . $keyId . '/' . $key;
                $commonS3Path = "mt_top_free_areas/" . $mtTopFreeArea['id'] . '/';
                $mtTopFreeArea->image_file = isset($fileParam['image_file']) ? $commonS3Path . 'image_file/' . $fileParam['image_file']->getClientOriginalName() : null;
                $mtTopFreeArea->save();
                $result['mtTopFreeAreaId'] = $mtTopFreeArea['id'];
                $result['mtMemberSiteItemId'] = isset($mtTopFreeAreaPublicationDestination) ? $mtTopFreeAreaPublicationDestination['id'] : null;
            }
            DB::commit();
            $result['status'] = CommonConsts::STATUS_SUCCESS;
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
            $result['status'] = CommonConsts::STATUS_ERROR;
            $result['error'] = $e->getMessage();
        }
        return $result;
    }

    private function createMtTopFreeAreaPublicationDestination($param, $mt_top_free_area_id)
    {
        if ($param['publication_destination_flg'] === "1") {
            //得意先分類
            if ($param['class1_type'] === "1") {
                if (array_key_exists('hidden_customer_class1', $param)) { //重複排除
                    foreach (array_unique($param['hidden_customer_class1']) as $para) {
                        $mtTopFreeAreaPublicationDestination = new MtTopFreeAreaPublicationDestination();
                        $mtTopFreeAreaPublicationDestination->mt_top_free_area_id = $mt_top_free_area_id;
                        $mtTopFreeAreaPublicationDestination->public_classification = '0';
                        $mtTopFreeAreaPublicationDestination->mt_publication_destination_id = $para;
                        $mtTopFreeAreaPublicationDestination->mt_user_last_update_id = Auth::user()->id;
                        $mtTopFreeAreaPublicationDestination->save();
                    }
                }
            }
            if ($param['class2_type'] === "1") {
                if (array_key_exists('hidden_customer_class2', $param)) {
                    foreach (array_unique($param['hidden_customer_class2']) as $para) {
                        $mtTopFreeAreaPublicationDestination = new MtTopFreeAreaPublicationDestination();
                        $mtTopFreeAreaPublicationDestination->mt_top_free_area_id = $mt_top_free_area_id;
                        $mtTopFreeAreaPublicationDestination->public_classification = '1';
                        $mtTopFreeAreaPublicationDestination->mt_publication_destination_id = $para;
                        $mtTopFreeAreaPublicationDestination->mt_user_last_update_id = Auth::user()->id;
                        $mtTopFreeAreaPublicationDestination->save();
                    }
                }
            }
            if ($param['class3_type'] === "1") {
                if (array_key_exists('hidden_customer_class3', $param)) {
                    foreach (array_unique($param['hidden_customer_class3']) as $para) {
                        $mtTopFreeAreaPublicationDestination = new MtTopFreeAreaPublicationDestination();
                        $mtTopFreeAreaPublicationDestination->mt_top_free_area_id = $mt_top_free_area_id;
                        $mtTopFreeAreaPublicationDestination->public_classification = '2';
                        $mtTopFreeAreaPublicationDestination->mt_publication_destination_id = $para;
                        $mtTopFreeAreaPublicationDestination->mt_user_last_update_id = Auth::user()->id;
                        $mtTopFreeAreaPublicationDestination->save();
                    }
                }
            }
        } elseif ($param['publication_destination_flg'] === "2") {
            //得意先
            if ($param['customer_type'] === "1") {
                if (array_key_exists('hidden_customer', $param)) {
                    foreach (array_unique($param['hidden_customer']) as $para) {
                        $mtTopFreeAreaPublicationDestination = new MtTopFreeAreaPublicationDestination();
                        $mtTopFreeAreaPublicationDestination->mt_top_free_area_id = $mt_top_free_area_id;
                        $mtTopFreeAreaPublicationDestination->public_classification = '3';
                        $mtTopFreeAreaPublicationDestination->mt_publication_destination_id = $para;
                        $mtTopFreeAreaPublicationDestination->mt_user_last_update_id = Auth::user()->id;
                        $mtTopFreeAreaPublicationDestination->save();
                    }
                }
            }
        }
    }

    /**
     * TOP自由領域　前頁
     * @param $code
     * @return Object
     */
    public function getPrevByCode($code)
    {
        if (isset($code)) {
            $result = MtTopFreeArea::where('area_cd', '<', $code)->orderByDesc('area_cd')->first();
        } else {
            $result = MtTopFreeArea::orderBy('area_cd')->first();
        }
        return $result;
    }

    /**
     * TOP自由領域　次頁
     * @param $code
     * @return Object
     */
    public function getNextByCode($code)
    {
        if (isset($code)) {
            $result = MtTopFreeArea::where('area_cd', '>', $code)->orderBy('area_cd')->first();
        } else {
            $result = MtTopFreeArea::orderBy('area_cd')->first();
        }
        return $result;
    }

    /**
     * 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['area_cd'] ? CodeUtil::pad($params['area_cd'], 4) : null;

        $query = MtTopFreeArea::query();
        $query->where('area_cd', $code);

        return $query->first();
    }
}
