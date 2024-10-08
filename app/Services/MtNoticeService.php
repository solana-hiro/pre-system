<?php

namespace App\Services;

use App\Repositories\MtNotice\MtNoticeRepository;
use Illuminate\Support\Facades\Log;

/**
 * お知らせ関連 サービスクラス
 */
class MtNoticeService
{

    /**
     * @var MtNoticeRepository
     */
    private MtNoticeRepository $mtNoticeRepository;

    /**
     * @param MtNoticeRepository $mtNoticeRepository
     */
    public function __construct()
    {
        $this->mtNoticeRepository = new MtNoticeRepository();
    }

    /** お知らせ  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtNoticeRepository->getAll();
        return $datas;
    }

    /** お知らせ  指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtNoticeRepository->get($params);
        return $datas;
    }

    /** お知らせ  IDにて取得
     * @param $params
     * @return MtNotice
     */
    public function getDetailById($id)
    {
        $datas = $this->mtNoticeRepository->getDetailById($id);
        return $datas;
    }

    /** お知らせ  最小ID取得
     * @return $rows
     */
    public function getMinId()
    {
        $datas = $this->mtNoticeRepository->getMinId();
        return $datas;
    }

    /** お知らせ  最大ID取得
     * @return $rows
     */
    public function getMaxID()
    {
        $datas = $this->mtNoticeRepository->getMaxId();
        return $datas;
    }

    /** お知らせ  前頁
     * @param $id
     * @return $rows
     */
    public function getPrevById($id)
    {
        $datas = $this->mtNoticeRepository->getPrevById($id);
        return $datas;
    }

    /** お知らせ  次頁
     * @param $id
     * @return $rows
     */
    public function getNextById($id)
    {
        $datas = $this->mtNoticeRepository->getNextById($id);
        return $datas;
    }

    /** お知らせ  前頁
     * @param $code
     * @return $rows
     */
    public function getPrevByCode($code)
    {
        $datas = $this->mtNoticeRepository->getPrevByCode($code);
        return $datas;
    }

    /** お知らせ  次頁
     * @param $code
     * @return $rows
     */
    public function getNextByCode($code)
    {
        $datas = $this->mtNoticeRepository->getNextByCode($code);
        return $datas;
    }

    /** お知らせ  削除
     * @param $id
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtNoticeRepository->delete($id);
        return $datas;
    }

    /** お知らせ  更新
     * @param $param
     * @param $fileParam
     * @return $rows
     */
    public function update($param, $fileParam = null)
    {
        $datas = $this->mtNoticeRepository->update($param, $fileParam);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->mtNoticeRepository->getByCode($params);
        return $datas;
    }
}
