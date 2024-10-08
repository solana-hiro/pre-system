<?php

namespace App\Services;

use App\Repositories\DefDistrictClass\DefDistrictClassRepository;
use Illuminate\Support\Facades\Log;

/**
 * 地区分類定義関連 サービスクラス
 */
class DefDistrictClassService
{

    /**
     * @var defDistrictClassRepository
     */
    private DefDistrictClassRepository $defDistrictClassRepository;

    /**
     * @param DefDistrictClassRepository $defDistrictClassRepository
     */
    public function __construct()
    {
        $this->defDistrictClassRepository = new DefDistrictClassRepository();
    }

    /** 地区分類定義 全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->defDistrictClassRepository->getAll();
        return $datas;
    }

    /** 地区分類定義 指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->defDistrictClassRepository->get($params);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->defDistrictClassRepository->getByCode($params);
        return $datas;
    }
}
