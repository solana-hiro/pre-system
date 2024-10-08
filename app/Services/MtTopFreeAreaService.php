<?php

namespace App\Services;

use App\Repositories\MtTopFreeArea\MtTopFreeAreaRepository;
use Illuminate\Support\Facades\Log;

/**
 * TOP自由領域コード関連 サービスクラス
 */
class MtTopFreeAreaService
{

    /**
     * @var MtTopFreeAreaRepository
     */
    private MtTopFreeAreaRepository $mtTopFreeAreaRepository;

    /**
     * @param MtTopFreeAreaRepository $mtTopFreeAreaRepository
     */
    public function __construct()
    {
        $this->mtTopFreeAreaRepository = new MtTopFreeAreaRepository();
    }

    /** TOP自由領域コード  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtTopFreeAreaRepository->getAll();
        return $datas;
    }

    /** TOP自由領域コード  関連データ全件取得
     *
     * @return $rows
     */
    public function getAllData()
    {
        $datas = $this->mtTopFreeAreaRepository->getAllData();
        return $datas;
    }

    /** TOP自由領域コード 指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtTopFreeAreaRepository->get($params);
        return $datas;
    }

    /** TOP自由領域コード IDにて取得
     * @param $params
     * @return $rows
     */
    public function getDetailById($id)
    {
        $datas = $this->mtTopFreeAreaRepository->getDetailById($id);
        return $datas;
    }

    /** TOP自由領域コード 最小ID取得
     * @return $rows
     */
    public function getMinId()
    {
        $datas = $this->mtTopFreeAreaRepository->getMinId();
        return $datas;
    }

    /** TOP自由領域コード 最大ID取得
     * @return $rows
     */
    public function getMaxID()
    {
        $datas = $this->mtTopFreeAreaRepository->getMaxId();
        return $datas;
    }

    /** TOP自由領域コード 前頁
     * @param $id
     * @return $rows
     */
    public function getPrevById($id)
    {
        $datas = $this->mtTopFreeAreaRepository->getPrevById($id);
        return $datas;
    }

    /** TOP自由領域コード  次頁
     * @param $id
     * @return $rows
     */
    public function getNextById($id)
    {
        $datas = $this->mtTopFreeAreaRepository->getNextById($id);
        return $datas;
    }

    /** TOP自由領域  前頁
     * @param $code
     * @return $rows
     */
    public function getPrevByCode($code)
    {
        $datas = $this->mtTopFreeAreaRepository->getPrevByCode($code);
        return $datas;
    }

    /** TOP自由領域  次頁
     * @param $code
     * @return $rows
     */
    public function getNextByCode($code)
    {
        $datas = $this->mtTopFreeAreaRepository->getNextByCode($code);
        return $datas;
    }

    /** TOP自由領域コード 削除
     * @param $id
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtTopFreeAreaRepository->delete($id);
        return $datas;
    }

    /** TOP自由領域コード 更新
     * @param $param
     * @param $fileParam
     * @return $rows
     */
    public function update($param, $fileParam = null)
    {
        $datas = $this->mtTopFreeAreaRepository->update($param, $fileParam);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->mtTopFreeAreaRepository->getByCode($params);
        return $datas;
    }
}
