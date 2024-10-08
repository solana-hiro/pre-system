<?php

namespace App\Repositories\MtNotice;

use App\Models\MtNotice;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtNoticeRepository implements MtNoticeRepositoryInterface
{

    /**
     * お知らせ情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtNotice::orderBy('notice_cd')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * お知らせ 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params)
    {
        $code = $params['notice_cd'] ? CodeUtil::pad($params['notice_cd'], 4) : null;
        $title = $params['title'] ?? null;
        $dFlg = $params['display_flg'] ?? null;
        $nKind = $params['news_kind'] ?? null;

        $query = MtNotice::query();
        $query->when($code, fn($query) => $query->where("notice_cd", '>=', $code));
        $query->when($title, fn($query) => $query->where("title", 'like', "%$title%"));
        $query->when(!is_null($dFlg), fn($query) => $query->where("display_flg", '=', $dFlg));
        $query->when(!is_null($nKind), fn($query) => $query->where("news_kind", '=', $nKind));
        $query->orderBy('notice_cd', 'desc');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * お知らせ 指定IDにて取得
     * @param $id
     * @return Object
     */
    public function getDetailById($id)
    {
        $result = MtNotice::where('id', $id)->first();
        return $result;
    }

    /**
     * お知らせの最小ID取得
     * @return Object
     */
    public function getMinId()
    {
        $result = MtNotice::min('id');
        return $result;
    }

    /**
     * お知らせの最大ID取得
     * @return Object
     */
    public function getMaxId()
    {
        $result = MtNotice::max('id');
        return $result;
    }

    /**
     * お知らせ　前頁
     * @param $id
     * @return Object
     */
    public function getPrevById($id)
    {
        if (isset($id)) {
            $result = MtNotice::where('id', '<', $id)->orderByDesc('id')->first();
        } else {
            $result = MtNotice::orderBy('id')->first();
        }
        return $result;
    }

    /**
     * お知らせ　次頁
     * @param $id
     * @return Object
     */
    public function getNextById($id)
    {
        if (isset($id)) {
            $result = MtNotice::where('id', '>', $id)->orderBy('id')->first();
        } else {
            $result = MtNotice::orderBy('id')->first();
        }
        return $result;
    }

    /**
     * お知らせ　前頁
     * @param $code
     * @return Object
     */
    public function getPrevByCode($code)
    {
        if (isset($code)) {
            $result = MtNotice::where('notice_cd', '<', $code)->orderByDesc('notice_cd')->first();
        } else {
            $result = MtNotice::orderBy('notice_cd')->first();
        }
        return $result;
    }

    /**
     * お知らせ　次頁
     * @param $code
     * @return Object
     */
    public function getNextByCode($code)
    {
        if (isset($code)) {
            $result = MtNotice::where('notice_cd', '>', $code)->orderBy('notice_cd')->first();
        } else {
            $result = MtNotice::orderBy('notice_cd')->first();
        }
        return $result;
    }

    /**
     * お知らせのIDによる削除
     * @param $id
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $result['mtNoticeId'] = MtNotice::where('id', $id)->delete();
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
     * お知らせの更新
     * @param $param
     * @param $fileParam
     * @return Object
     */
    public function update($param, $fileParam)
    {
        // 登録・お知らせ
        // 削除: お知らせ
        $result = array();
        try {
            DB::beginTransaction();
            // 更新
            $isNotice = MtNotice::where('notice_cd', $param['noticecd'])->exists();
            if ($isNotice) {
                //更新
                $mtNotice = MtNotice::where('notice_cd', $param['noticecd'])->first();
                $mtNotice->title = $param['noticetitle'] ?? '';
                $mtNotice->news_kind = $param['news_kind'] ?? 0;
                $mtNotice->notice_content_type = $param['content_type'] ?? 0;
                $mtNotice->notice_content = $param['content_type'] === '1' ? $param['rich_text_contents'] : $param['content'];
                $startDateTime = $param['release_start_datetime_year'] . '-' . $param['release_start_datetime_month'] . '-' . $param['release_start_datetime_day'] . ' ' . $param['release_start_datetime_time'];
                $mtNotice->release_start_datetime = checkdate($param['release_start_datetime_month'], $param['release_start_datetime_day'], $param['release_start_datetime_year']) ? Carbon::parse($startDateTime) : null;
                $endDateTime = $param['release_end_datetime_year'] . '-' . $param['release_end_datetime_month'] . '-' . $param['release_end_datetime_day'] . ' ' . $param['release_end_datetime_time'];
                $mtNotice->release_end_datetime = checkdate($param['release_end_datetime_month'], $param['release_end_datetime_day'], $param['release_end_datetime_year']) ?  Carbon::parse($endDateTime) : null;
                $mtNotice->display_flg = $param['display_flg'] ?? 0;
                $mtNotice->display_sort_order = $param['display_sort_order'] ?? 0;
                $mtNotice->mt_user_last_update_id = Auth::user()->id;
                $mtNotice->save();

                //画像関連　更新(パスにIDが必要な為、別で更新する)$tableName . '/' . $keyId . '/' . $key;
                $commonS3Path = "mt_notices/" . $mtNotice['id'] . '/';
                if (isset($fileParam['image_file'])) {
                    $mtNotice->image_file = $commonS3Path . 'image_file/' . $fileParam['image_file']->getClientOriginalName();
                } elseif (is_null($param['image_file_src'])) {
                    $mtNotice->image_file = null;
                }

                if ($param['del_pdf_1'] === "1") {
                    $mtNotice->pdf_file_1 = null;
                }
                if (isset($fileParam['pdf_file_1'])) {
                    $mtNotice->pdf_file_1 = $commonS3Path . 'pdf_file_1/' . $fileParam['pdf_file_1']->getClientOriginalName();
                }

                if ($param['del_pdf_2'] === "1") {
                    $mtNotice->pdf_file_2 = null;
                }
                if (isset($fileParam['pdf_file_2'])) {
                    $mtNotice->pdf_file_2 = $commonS3Path . 'pdf_file_2/' . $fileParam['pdf_file_2']->getClientOriginalName();
                }

                if ($param['del_pdf_3'] === "1") {
                    $mtNotice->pdf_file_3 = null;
                }
                if (isset($fileParam['pdf_file_3'])) {
                    $mtNotice->pdf_file_3 = $commonS3Path . 'pdf_file_3/' . $fileParam['pdf_file_3']->getClientOriginalName();
                }

                if ($param['del_pdf_4'] === "1") {
                    $mtNotice->pdf_file_4 = null;
                }
                if (isset($fileParam['pdf_file_4'])) {
                    $mtNotice->pdf_file_4 = $commonS3Path . 'pdf_file_4/' . $fileParam['pdf_file_4']->getClientOriginalName();
                }

                if ($param['del_pdf_5'] === "1") {
                    $mtNotice->pdf_file_5 = null;
                }
                if (isset($fileParam['pdf_file_5'])) {
                    $mtNotice->pdf_file_5 = $commonS3Path . 'pdf_file_5/' . $fileParam['pdf_file_5']->getClientOriginalName();
                }

                $mtNotice->save();
                $result['mtNoticeId'] = $mtNotice['id'];
            } else {
                //新規登録
                $mtNotice = new MtNotice();
                $mtNotice->notice_cd = $param['noticecd'] ?? '';
                $mtNotice->title = $param['noticetitle'] ?? '';
                $mtNotice->news_kind = $param['news_kind'] ?? 0;
                $mtNotice->notice_content_type = $param['content_type'] ?? 0;
                $mtNotice->notice_content = $param['content_type'] === '1' ? $param['rich_text_contents'] : $param['content'];
                $startDateTime = $param['release_start_datetime_year'] . '-' . $param['release_start_datetime_month'] . '-' . $param['release_start_datetime_day'] . ' ' . $param['release_start_datetime_time'];
                $mtNotice->release_start_datetime = checkdate($param['release_start_datetime_month'], $param['release_start_datetime_day'], $param['release_start_datetime_year']) ? Carbon::parse($startDateTime) : null;
                $endDateTime = $param['release_end_datetime_year'] . '-' . $param['release_end_datetime_month'] . '-' . $param['release_end_datetime_day'] . ' ' . $param['release_end_datetime_time'];
                $mtNotice->release_end_datetime = checkdate($param['release_end_datetime_month'], $param['release_end_datetime_day'], $param['release_end_datetime_year']) ? Carbon::parse($endDateTime) : null;
                $mtNotice->display_flg = $param['display_flg'] ?? 0;
                $mtNotice->display_sort_order = $param['display_sort_order'] ?? 0;
                $mtNotice->mt_user_last_update_id = Auth::user()->id;
                $mtNotice->save();

                //画像関連　更新(パスにIDが必要な為、別で更新する)$tableName . '/' . $keyId . '/' . $key;
                $commonS3Path = "mt_notices/" . $mtNotice['id'] . '/';
                if (isset($fileParam['image_file'])) {
                    $mtNotice->image_file = $commonS3Path . 'image_file/' . $fileParam['image_file']->getClientOriginalName();
                }
                if (isset($fileParam['pdf_file_1'])) {
                    $mtNotice->pdf_file_1 = $commonS3Path . 'pdf_file_1/' . $fileParam['pdf_file_1']->getClientOriginalName();
                }
                if (isset($fileParam['pdf_file_2'])) {
                    $mtNotice->pdf_file_2 = $commonS3Path . 'pdf_file_2/' . $fileParam['pdf_file_2']->getClientOriginalName();
                }
                if (isset($fileParam['pdf_file_3'])) {
                    $mtNotice->pdf_file_3 = $commonS3Path . 'pdf_file_3/' . $fileParam['pdf_file_3']->getClientOriginalName();
                }
                if (isset($fileParam['pdf_file_4'])) {
                    $mtNotice->pdf_file_4 = $commonS3Path . 'pdf_file_4/' . $fileParam['pdf_file_4']->getClientOriginalName();
                }
                if (isset($fileParam['pdf_file_5'])) {
                    $mtNotice->pdf_file_5 = $commonS3Path . 'pdf_file_5/' . $fileParam['pdf_file_5']->getClientOriginalName();
                }
                $mtNotice->save();
                $result['mtNoticeId'] = $mtNotice['id'];
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

    /**
     * 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['notice_cd'] ? CodeUtil::pad($params['notice_cd'], 4) : null;

        $query = MtNotice::query();
        $query->where('notice_cd', $code);

        return $query->first();
    }
}
