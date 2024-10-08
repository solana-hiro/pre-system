<?php

namespace App\Services;

use App\Repositories\MtSystem\MtSystemRepository;
use Illuminate\Support\Facades\Log;

/**
 * システム関連 サービスクラス
 */
class MtSystemService
{

    /**
     * @var mtSystemRepository
     */
    private MtSystemRepository $mtSystemRepository;

    /**
     * @param MtSystemRepository $mtSystemRepository
     */
    public function __construct()
    {
        $this->mtSystemRepository = new MtSystemRepository();
    }

    /** システム 全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtSystemRepository->getAll();
        return $datas;
    }

    /** システム 初期データ取得
     *
     * @return $rows
     */
    public function getInitData()
    {
        $datas = $this->mtSystemRepository->getInitData();
        return $datas;
    }

    /** システム  更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtSystemRepository->update($params);
        return $datas;
    }

}
