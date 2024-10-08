<?php

namespace App\Services;

use App\Repositories\MtMemberSiteItem\MtMemberSiteItemRepository;
use Illuminate\Support\Facades\Log;

/**
 * メンバサイトアイテム関連 サービスクラス
 */
class MtMemberSiteItemService
{

    /**
     * @var mtMemberSiteItemRepository
     */
    private MtMemberSiteItemRepository $mtMemberSiteItemRepository;

    /**
     * @param MtMemberSiteItemRepository $mtMemberSiteItemRepository
     */
    public function __construct()
    {
        $this->mtMemberSiteItemRepository = new MtMemberSiteItemRepository();
    }

    /** 全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtMemberSiteItemRepository->getAll();
        return $datas;
    }

    /** 指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtMemberSiteItemRepository->get($params);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $code
     * @return $rows
     */
    public function codeAutoComplete($code)
    {
        $datas = $this->mtMemberSiteItemRepository->getByCode($code);
        return $datas;
    }

    /** コード補完(code, catalog_id指定)
     * @param $code
     * @param $catalogId
     * @return $row
     */
    public function codeAutoCompleteWithCatalogOrder($code, $catalogId)
    {
        $datas = $this->mtMemberSiteItemRepository->getByCodeWithCatalogItem($code, $catalogId);
        return $datas;
    }

    /** コード補完(code, catalog_id指定)
     * @param $code
     * @param $catalogId
     * @return $row
     */
    public function codeAutoCompleteWithRecommendation($code)
    {
        $datas = $this->mtMemberSiteItemRepository->getByCodeWithRecommendation($code);
        return $datas;
    }

    /** コード補完(code, catalog_id指定)
     * @param $code
     * @param $catalogId
     * @return $row
     */
    public function codeAutoCompleteRecommendationManagement($code1, $code2)
    {
        $datas = $this->mtMemberSiteItemRepository->getByCodeRecommendationManagement($code1, $code2);
        return $datas;
    }
}
