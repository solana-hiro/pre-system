<?php

namespace App\Services;

use App\Lib\CodeUtil;
use App\Repositories\MtUser\MtUserRepository;
use Illuminate\Support\Facades\Log;

/**
 * ユーザマスタ サービスクラス
 */
class MtUserService
{

    /**
     * @var MtUserRepository
     */
    private MtUserRepository $mtUserRepository;

    /**
     * @param MtUserRepository $mtUserRepository
     */
    public function __construct()
    {
        $this->mtUserRepository = new MtUserRepository();
    }

    /** ユーザ情報  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtUserRepository->getAll();
        return $datas;
    }

    /** ユーザ情報  条件により取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $code = $params['user_cd'] ? CodeUtil::pad($params['user_cd'], 4) : null;
        $kana = $params['user_name_kana'] ?? null;
        $excludeDisabled = $params['exclude_disabled'] ?? false;

        $datas = $this->mtUserRepository->get($code, $kana, $excludeDisabled);
        return $datas;
    }

    /** 部門情報  取得(code指定)
     *
     * @return $rows
     */
    public function getDemapartmentName($code)
    {
        $datas = $this->mtUserRepository->getDemapartmentName($code);
        return $datas;
    }


    /** ユーザ情報  初期データ取得
     * @param $params
     * @return $rows
     */
    public function getInitData($id)
    {
        $datas = $this->mtUserRepository->getInitData($id);
        return $datas;
    }

    /** ユーザ情報  初期データ取得
     * @return $rows
     */
    public function getInitDataList()
    {
        $datas = $this->mtUserRepository->getInitDataList();
        return $datas;
    }


    /** ユーザ情報  検索条件により取得
     * @param $params
     * @return $rows
     */
    public function search($params)
    {
        $datas = $this->mtUserRepository->search($params);
        return $datas;
    }

    /** ユーザ情報  出力内容の取得
     * @param $params
     * @return $rows
     */
    public function export($params)
    {
        $datas = $this->mtUserRepository->export($params);
        return $datas;
    }


    /** ユーザ情報  出力内容の取得
     * @param $params
     * @return $rows
     */
    public function getDepartmentName($departmentCd)
    {
        $datas = $this->mtUserRepository->getDepartmentName($departmentCd);
        return $datas;
    }

    /** ユーザ情報  最小値の取得
     * @param $params
     * @return $rows
     */
    public function getMinId()
    {
        $datas = $this->mtUserRepository->getMinId();
        return $datas;
    }

    /** ユーザ情報  最大値の取得
     * @param $params
     * @return $rows
     */
    public function getMaxId()
    {
        $datas = $this->mtUserRepository->getMaxId();
        return $datas;
    }

    /** ユーザ情報  前頁
     * @param $id
     * @return $rows
     */
    public function getPrevById($id)
    {
        $datas = $this->mtUserRepository->getPrevById($id);
        return $datas;
    }

    /** ユーザ情報  次頁
     * @param $id
     * @return $rows
     */
    public function getNextById($id)
    {
        $datas = $this->mtUserRepository->getNextById($id);
        return $datas;
    }

    /** ユーザ情報  削除
     * @param $id
     * @return $rows
     */
    public function delete($id)
    {
        $datas = $this->mtUserRepository->delete($id);
        return $datas;
    }

    /** ユーザ情報  更新
     * @param $param
     * @param $fileParam
     * @return $rows
     */
    public function update($param)
    {
        $datas = $this->mtUserRepository->update($param);
        return $datas;
    }

    /** ユーザ情報  コピー
     * @param $param
     * @param $fileParam
     * @return $rows
     */
    public function copy($id)
    {
        $datas = $this->mtUserRepository->copy($id);
        return $datas;
    }

    /** ユーザ情報  パスワードリセット
     * @param $param
     * @param $fileParam
     * @return $rows
     */
    public function passwordReset($param)
    {
        $datas = $this->mtUserRepository->passwordReset($param);
        return $datas;
    }


    /** コード補完(code指定)
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->mtUserRepository->getByCode($params);
        return $datas;
    }
}
