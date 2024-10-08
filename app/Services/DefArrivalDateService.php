<?php

namespace App\Services;

use App\Lib\CodeUtil;
use App\Repositories\DefArrivalDate\DefArrivalDateRepository;
use Illuminate\Support\Facades\Log;

/**
 * 着日定義関連 サービスクラス
 */
class DefArrivalDateService
{

    /**
     * @var defArrivalDateRepository
     */
    private DefArrivalDateRepository $defArrivalDateRepository;

    /**
     * @param DefArrivalDateRepository $defArrivalDateRepository
     */
    public function __construct()
    {
        $this->defArrivalDateRepository = new DefArrivalDateRepository();
    }

    /** 着日定義 全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->defArrivalDateRepository->getAll();
        return $datas;
    }

    /** 着日定義 指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->defArrivalDateRepository->get($params);
        return $datas;
    }

    /** 自動補完
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->defArrivalDateRepository->getByCode($params);
        return $datas;
    }
}
