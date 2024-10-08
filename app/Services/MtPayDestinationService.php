<?php

namespace App\Services;

use App\Repositories\MtPayDestination\MtPayDestinationRepository;
use Illuminate\Support\Facades\Log;

/**
 * 支払先関連 サービスクラス
 */
class MtPayDestinationService
{
    /**
     * @var MtPayDestinationRepository
     */
    private MtPayDestinationRepository $mtPayDestinationRepository;

    /**
     * @param MtPayDestinationRepository $mtPayDestinationRepository
     */
    public function __construct()
    {
        $this->mtPayDestinationRepository = new MtPayDestinationRepository();
    }

    /** 支払先 全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtPayDestinationRepository->getAll();
        return $datas;
    }

    /** 支払先 指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtPayDestinationRepository->get($params);
        return $datas;
    }

    /** コード補完(code指定)
     * @param $params
     * @return $rows
     */
    public function codeAutoComplete($params)
    {
        $datas = $this->mtPayDestinationRepository->getByCode($params);
        return $datas;
    }
}
