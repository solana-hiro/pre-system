<?php

namespace App\Services;

use App\Repositories\DefPioneerYear\DefPioneerYearRepository;
use Illuminate\Support\Facades\Log;

/**
 * 開拓年分類定義関連 サービスクラス
 */
class DefPioneerYearService
{

    /**
     * @var defPioneerYearRepository
     */
    private DefPioneerYearRepository $defPioneerYearRepository;

    /**
     * @param DefPioneerYearRepository $defPioneerYearRepository
     */
    public function __construct()
    {
        $this->defPioneerYearRepository = new DefPioneerYearRepository();
    }

    /** 開拓年分類 全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->defPioneerYearRepository->getAll();
        return $datas;
    }

    /** 開拓年分類  指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->defPioneerYearRepository->get($params);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->defPioneerYearRepository->getByCode($params);
        return $datas;
    }
}
