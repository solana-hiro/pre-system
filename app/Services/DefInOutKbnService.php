<?php

namespace App\Services;

use App\Repositories\DefInOutKbn\DefInOutKbnRepository;
use Illuminate\Support\Facades\Log;

/**
 * 部門定義関連 サービスクラス
 */
class DefInOutKbnService
{

    /**
     * @var defInOutKbnRepository
     */
    private DefInOutKbnRepository $defInOutKbnRepository;

    /**
     * @param DefInOutKbnRepository $defInOutKbnRepository
     */
    public function __construct()
    {
        $this->defInOutKbnRepository = new DefInOutKbnRepository();
    }

    /** 部門定義 全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->defInOutKbnRepository->getAll();
        return $datas;
    }

    /** 部門定義 指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->defInOutKbnRepository->get($params);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->defInOutKbnRepository->getByCode($params);
        return $datas;
    }
}
