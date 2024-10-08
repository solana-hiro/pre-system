<?php

namespace App\Services;

use App\Repositories\MtCatalog\MtCatalogRepository;
use Illuminate\Support\Facades\Log;

/**
 * カタログ関連 サービスクラス
 */
class MtCatalogService
{

    /**
     * @var MtCatalogRepository
     */
    private MtCatalogRepository $mtCatalogRepository;

    /**
     * @param MtCatalogRepository $mtCatalogRepository
     */
    public function __construct()
    {
        $this->mtCatalogRepository = new MtCatalogRepository();
    }

    /** カタログ  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtCatalogRepository->getAll();
        return $datas;
    }

    /** カタログ  指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtCatalogRepository->get($params);
        return $datas;
    }

    /** カタログ IDにて取得
     * @param $params
     * @return $rows
     */
    public function getDetailById($id)
    {
        $datas = $this->mtCatalogRepository->getDetailById($id);
        return $datas;
    }

    /** カタログ  最小ID取得
     * @return $rows
     */
    public function getMinId()
    {
        $datas = $this->mtCatalogRepository->getMinId();
        return $datas;
    }

    /** カタログ  最大ID取得
     * @return $rows
     */
    public function getMaxID()
    {
        $datas = $this->mtCatalogRepository->getMaxId();
        return $datas;
    }

    /** カタログ  最小Code取得
     * @return $rows
     */
    public function getMinCode()
    {
        $datas = $this->mtCatalogRepository->getMinCode();
        return $datas;
    }

    /** カタログ  最大Code取得
     * @return $rows
     */
    public function getMaxCode()
    {
        $datas = $this->mtCatalogRepository->getMaxCode();
        return $datas;
    }

    /** カタログ  前頁
     * @param $id
     * @return $rows
     */
    public function getPrevById($id)
    {
        $datas = $this->mtCatalogRepository->getPrevById($id);
        return $datas;
    }

    /** カタログ  次頁
     * @param $id
     * @return $rows
     */
    public function getNextById($id)
    {
        $datas = $this->mtCatalogRepository->getNextById($id);
        return $datas;
    }

    /** カタログ  前頁
     * @param $code
     * @return $rows
     */
    public function getPrevByCode($code)
    {
        $datas = $this->mtCatalogRepository->getPrevByCode($code);
        return $datas;
    }

    /** カタログ  次頁
     * @param $code
     * @return $rows
     */
    public function getNextByCode($code)
    {
        $datas = $this->mtCatalogRepository->getNextByCode($code);
        return $datas;
    }

    /** カタログ  削除
     * @param $id
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtCatalogRepository->delete($id);
        return $datas;
    }

    /** カタログ  更新
     * @param $param
     * @param $fileParam
     * @return $rows
     */
    public function update($param, $fileParam = null)
    {
        $datas = $this->mtCatalogRepository->update($param, $fileParam);
        return $datas;
    }

    /** カタログアイテム削除
     * @param $param
     * @param $fileParam
     * @return $rows
     */
    public function deleteItem($id)
    {
        $datas = $this->mtCatalogRepository->deleteItem($id);
        return $datas;
    }


    /** コード補完(code指定)
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->mtCatalogRepository->getByCode($params);
        return $datas;
    }
}
