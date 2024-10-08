<?php

namespace App\Repositories\MtMemberSiteItem;

use App\Models\MtMemberSiteItem;
use App\Consts\CommonConsts;
use App\Models\MtCatalogItem;
use App\Models\MtMemberSiteItemRecommendationManagement;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;

class MtMemberSiteItemRepository implements MtMemberSiteItemRepositoryInterface
{
    /**
     * 情報取得 全件取得
     * @return Object
     */
    public function getAll()
    {
        $result = MtMemberSiteItem::orderBy('ec_item_cd')->paginate(CommonConsts::PAGINATION);
        return $result;
    }

    /**
     * 情報取得 指定条件にて取得
     * @param Array
     * @return Object
     */
    public function get($params)
    {
        $code = $params['ec_item_cd'];
        $name = $params['ec_item_name'];

        $query = MtMemberSiteItem::query();
        // $query->distinct();
        $query->select('mt_member_site_items.*');
        // 商品マスタ商品では不要となる条件のため一時的にコメントアウト
        // $query->join('mt_items', 'mt_items.mt_member_site_item_id', 'mt_member_site_items.id');
        // $query->where('del_kbn', '=', 0);
        // $query->where('ec_alignment_kbn', '=', 0);
        $query->when($code, fn($query) => $query->where('ec_item_cd', '>=', $code));
        $query->when($name, fn($query) => $query->where('ec_item_name', 'like', "%$name%"));
        $query->orderBy('ec_item_cd');

        return $query->paginate(CommonConsts::PAGINATION);
    }

    /**
     * 名称補完(code指定)
     * @param $code
     * @return Object
     */
    public function getByCode($code)
    {
        $result = MtMemberSiteItem::where('ec_item_cd', $code)->first();
        if (empty($result)) {
            if (app()->isLocal() || app()->runningUnitTests()) {
                $item_image_file_1_path = isset($result['item_image_file_1']) && !empty($result['item_image_file_1']) ? Storage::url($result['item_image_file_1']) : '';
            } else {
                $item_image_file_1_path = isset($result['item_image_file_1']) && !empty($result['item_image_file_1']) ? Storage::disk('s3')->url($result['item_image_file_1']) : '';
            }
            $result['item_image_file_1_path'] = $item_image_file_1_path;
        }
        return $result;
    }

    /**
     * 名称補完(code, catalog_id指定)
     * @param $code
     * @param $catalogId
     * @return Object
     */
    public function getByCodeWithCatalogItem($code, $catalogId)
    {
        $result = MtMemberSiteItem::where('ec_item_cd', $code)->first();
        if ($result) {
            $result->mtCatalogItem = MtCatalogItem::query()
                ->where('mt_catalog_id', $catalogId)
                ->where('mt_member_site_items_id', $result->id)
                ->first();
        }
        return $result;
    }


    /**
     * 名称補完(code指定)
     * @param $code
     * @return Object
     */
    public function getByCodeWithRecommendation($code)
    {
        $result = MtMemberSiteItem::where('ec_item_cd', $code)->first();
        if ($result) {
            // おすすめ商品側のデータを保持
            $result->mtMemberSiteItemRecommendations = MtMemberSiteItemRecommendationManagement::query()
                ->select('mt_member_site_items.id', 'ec_item_cd', 'ec_item_name', 'display_order')
                ->join('mt_member_site_items', 'mt_member_site_items.id', '=', 'mt_member_site_item_recommendation_managements.mt_member_site_item_id_recommendation')
                ->where('mt_member_site_item_id_base', $result->id)
                ->orderBy('mt_member_site_items.ec_item_cd')
                ->get();
        }
        return $result;
    }

    /**
     * 名称補完(code指定)
     * @param $code
     * @return Object
     */
    public function getByCodeRecommendationManagement($code1, $code2)
    {
        $item1 = MtMemberSiteItem::where('ec_item_cd', $code1)->first();
        $result = MtMemberSiteItem::select('id', 'ec_item_name')->where('ec_item_cd', $code2)->first();
        if ($item1 && $result) {
            $result->mtMemberSiteRecommendationManagement = MtMemberSiteItemRecommendationManagement::query()
                ->select('mt_member_site_items.id', 'ec_item_name', 'ranking')
                ->join('mt_member_site_items', 'mt_member_site_items.id', '=', 'mt_member_site_item_recommendation_managements.mt_member_site_item_id_recommendation')
                ->where('mt_member_site_item_id_base', $item1->id)
                ->where('mt_member_site_item_id_recommendation', $result->id)
                ->first();
        }
        return $result;
    }
}
