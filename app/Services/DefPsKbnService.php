<?php

namespace App\Services;

use App\Repositories\DefPsKbn\DefPsKbnRepository;
use Illuminate\Support\Facades\Log;

/**
 * PS区分関連 サービスクラス
 */
class DefPsKbnService
{

    /**
     * @var DefPsKbnRepository
     */
    private DefPsKbnRepository $defPsKbnRepository;

    /**
     * @param DefPsKbnRepository $defPsKbnRepository
     */
    public function __construct()
    {
        $this->defPsKbnRepository = new DefPsKbnRepository();
    }

    /** PS区分  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->defPsKbnRepository->getAll();
        return $datas;
    }

    /** PS区分  指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->defPsKbnRepository->get($params);
        return $datas;
    }

}
