<?php

namespace App\Repositories\MtCatalog;

use App\Models\MtCatalog;
use App\Models\MtCatalogItem;
use App\Models\MtMemberSiteItem;
use App\Consts\CommonConsts;
use App\Lib\CodeUtil;
use App\Services\S3Service;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Exception;

class MtCatalogRepository implements MtCatalogRepositoryInterface
{

    /**
     * カタログ情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtCatalog::orderBy('catalog_cd')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * カタログ情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params)
    {
        $code = $params['catalog_cd'] ? CodeUtil::pad($params['catalog_cd'], 4) : null;
        $name = $params['catalog_name'] ?? null;

        $query = MtCatalog::query();
        $query->when($code, fn($query) => $query->where("catalog_cd", '>=', $code));
        $query->when($name, fn($query) => $query->where("catalog_name", 'like', "%$name%"));
        $query->orderBy('catalog_cd');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * カタログ情報取得 指定IDにて取得
     * @param $id
     * @return Object
     */
    public function getDetailById($id)
    {
        $result['MtCatalog'] = MtCatalog::where('id', $id)->first();
        $result['MtCatalogItem'] = MtCatalogItem::select(
            'mt_catalog_items.id as id',
            'mt_catalog_items.*',
            'mt_member_site_items.ec_item_cd',
            'mt_member_site_items.ec_item_name',
            'mt_member_site_items.item_image_file_1'
        )
            ->leftJoin('mt_member_site_items', 'mt_catalog_items.mt_member_site_items_id', 'mt_member_site_items.id')->where('mt_catalog_id', $id)->get();
        return $result;
    }

    /**
     * カタログの最小ID取得
     * @return Object
     */
    public function getMinId()
    {
        $result = MtCatalog::min('id');
        return $result;
    }

    /**
     * カタログの最大ID取得
     * @return Object
     */
    public function getMaxId()
    {
        $result = MtCatalog::max('id');
        return $result;
    }

    /**
     * カタログの最小Code取得
     * @return Object
     */
    public function getMinCode()
    {
        $result = MtCatalog::min('catalog_cd');
        return $result;
    }

    /**
     * カタログの最大Code取得
     * @return Object
     */
    public function getMaxCode()
    {
        $result = MtCatalog::max('catalog_cd');
        return $result;
    }

    /**
     * カタログ　前頁
     * @param $id
     * @return Object
     */
    public function getPrevById($id)
    {
        if (isset($id)) {
            $result = MtCatalog::where('id', '<', $id)->orderByDesc('id')->first();
        } else {
            $result = MtCatalog::orderBy('id')->first();
        }
        return $result;
    }

    /**
     * カタログ　次頁
     * @param $id
     * @return Object
     */
    public function getNextById($id)
    {
        if (isset($id)) {
            $result = MtCatalog::where('id', '>', $id)->orderBy('id')->first();
        } else {
            $result = MtCatalog::orderBy('id')->first();
        }
        return $result;
    }

    /**
     * カタログ　前頁
     * @param $code
     * @return Object
     */
    public function getPrevByCode($code)
    {
        if (isset($code)) {
            $result = MtCatalog::where('catalog_cd', '<', $code)->orderByDesc('catalog_cd')->first();
        } else {
            $result = MtCatalog::orderBy('catalog_cd')->first();
        }
        return $result;
    }

    /**
     * カタログ　次頁
     * @param $code
     * @return Object
     */
    public function getNextByCode($code)
    {
        if (isset($code)) {
            $result = MtCatalog::where('catalog_cd', '>', $code)->orderBy('catalog_cd')->first();
        } else {
            $result = MtCatalog::orderBy('catalog_cd')->first();
        }
        return $result;
    }

    /**
     * カタログのIDによる削除
     * @param $id
     * @return Object
     */
    public function delete($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $result['mtCatalogItemId'] = MtCatalogItem::where('mt_catalog_id', $id)->delete();
            $result['mtNoticeId'] = MtCatalog::where('id', $id)->delete();
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
     * カタログの更新
     * @param $params
     * @param $fileParam
     * @return Object
     */
    public function update($params, $fileParam)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $isCatalog = MtCatalog::where('catalog_cd', $params['catalogcode'])->exists();
            if ($isCatalog) {
                //更新
                $mtCatalog = MtCatalog::where('catalog_cd', $params['catalogcode'])->first();
                $mtCatalog->catalog_name = $params['catalogtitle'] ?? '';
                $startDateTime = $params['release_start_datetime_year'] . '-' . $params['release_start_datetime_month'] . '-' . $params['release_start_datetime_day'] . ' ' . $params['release_start_datetime_time'];
                $mtCatalog->release_start_datetime = checkdate($params['release_start_datetime_month'], $params['release_start_datetime_day'], $params['release_start_datetime_year']) ? Carbon::parse($startDateTime) : null;
                $endDateTime = $params['release_end_datetime_year'] . '-' . $params['release_end_datetime_month'] . '-' . $params['release_end_datetime_day'] . ' ' . $params['release_end_datetime_time'];
                $mtCatalog->release_end_datetime = checkdate($params['release_end_datetime_month'], $params['release_end_datetime_day'], $params['release_end_datetime_year']) ? Carbon::parse($endDateTime) : null;
                $mtCatalog->display_flg = $params['display_flg'];
                $mtCatalog->display_sort_order = $params['display_sort_order'];
                $mtCatalog->catalog_explanation_type = $params['content_type'];
                if ($params['content_type'] === '0') {
                    $mtCatalog->catalog_explanation = $params['content'];
                } elseif ($params['content_type'] === '1') {
                    $mtCatalog->catalog_explanation = $params['rich_text_contents'];
                }
                $mtCatalog->mt_user_last_update_id = Auth::user()->id;
                $mtCatalog->save();

                foreach ($params['mt_catalog_items'] as $param) {
                    is_null($param['id']) ? $this->createCatalogItem($mtCatalog->id, $param) : $this->updateCatalogItem($param);
                }

                //画像関連　更新(パスにIDが必要な為、別で更新する)$tableName . '/' . $keyId . '/' . $key;
                $commonS3Path = "mt_catalogs/" . $mtCatalog['id'] . '/';
                if (isset($fileParam['image_file'])) {
                    $mtCatalog->image_file = $commonS3Path . 'image_file/' . $fileParam['image_file']->getClientOriginalName();
                }
                $mtCatalog->save();
                $result = [
                    'mtCatalogId' => $mtCatalog['id']
                ];
            } else {
                //新規登録
                $mtCatalog = new MtCatalog();
                $mtCatalog->catalog_cd = $params['catalogcode'];
                $mtCatalog->catalog_name = $params['catalogtitle'] ?? '';
                $startDateTime = $params['release_start_datetime_year'] . '-' . $params['release_start_datetime_month'] . '-' . $params['release_start_datetime_day'] . ' ' . $params['release_start_datetime_time'];
                $mtCatalog->release_start_datetime = checkdate($params['release_start_datetime_month'], $params['release_start_datetime_day'], $params['release_start_datetime_year']) ? Carbon::parse($startDateTime) : null;
                $endDateTime = $params['release_end_datetime_year'] . '-' . $params['release_end_datetime_month'] . '-' . $params['release_end_datetime_day'] . ' ' . $params['release_end_datetime_time'];
                $mtCatalog->release_end_datetime = checkdate($params['release_end_datetime_month'], $params['release_end_datetime_day'], $params['release_end_datetime_year']) ? Carbon::parse($endDateTime) : null;
                $mtCatalog->display_flg = $params['display_flg'];
                $mtCatalog->display_sort_order = $params['display_sort_order'];
                $mtCatalog->catalog_explanation = $params['content'];
                if ($params['content_type'] === '0') {
                    $mtCatalog->catalog_explanation = $params['content'];
                } elseif ($params['content_type'] === '1') {
                    $mtCatalog->catalog_explanation = $params['rich_text_contents'];
                }
                $mtCatalog->image_file = $params['image_file'] ?? ''; //仮更新
                $mtCatalog->mt_user_last_update_id = Auth::user()->id;
                $mtCatalog->save();

                foreach ($params['mt_catalog_items'] as $param) {
                    $this->createCatalogItem($mtCatalog->id, $param);
                }

                //画像関連　更新(パスにIDが必要な為、別で更新する)$tableName . '/' . $keyId . '/' . $key;
                if (isset($fileParam['image_file'])) {
                    $commonS3Path = "mt_catalogs/" . $mtCatalog['id'] . '/';
                    $mtCatalog->image_file = isset($fileParam['image_file']) ? $commonS3Path . 'image_file/' . $fileParam['image_file']->getClientOriginalName() : null;
                } else {
                    $oldFileName = pathinfo($params['image_file_src'], PATHINFO_BASENAME);
                    $oldPath = $params['image_file_src'];
                    $newPath = "mt_catalogs/{$mtCatalog->id}/image_file/{$oldFileName}";
                    (new S3Service())->copy($oldPath, $newPath);
                    $mtCatalog->image_file = $newPath;
                }
                $mtCatalog->save();
                $result = [
                    'mtCatalogId' => $mtCatalog['id']
                ];
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

    private function createCatalogItem($mtCatalogId, $param)
    {
        if (is_null($param['mt_member_site_items_id'])) return;

        $item = new MtCatalogItem();
        $item->mt_catalog_id = $mtCatalogId;
        $item->fill($param);
        $item->mt_user_last_update_id = Auth::user()->id;
        $item->save();
    }

    private function updateCatalogItem($param)
    {
        $item = MtCatalogItem::find($param['id']);
        $item->fill($param);
        $item->mt_user_last_update_id = Auth::user()->id;
        $item->save();
    }

    /**
     * カタログアイテムの削除
     * @param $id
     * @return Object
     */
    public function deleteItem($id)
    {
        $result = array();
        try {
            DB::beginTransaction();
            $result['mtCatalogId'] = MtCatalogItem::where('id', $id)->first();
            $result['mtCatalogItemId'] = MtCatalogItem::where('id', $id)->delete();
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
     * 名称補完(code指定)
     * @param $params
     * @return Object
     */
    public function getByCode($params)
    {
        $code = $params['catalog_cd'] ? CodeUtil::pad($params['catalog_cd'], 4) : null;

        $query = MtCatalog::query();
        $query->where('catalog_cd', $code);

        return $query->first();
    }
}
