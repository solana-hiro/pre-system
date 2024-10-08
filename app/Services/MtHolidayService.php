<?php

namespace App\Services;

use App\Repositories\MtHoliday\MtHolidayRepository;
use Illuminate\Support\Facades\Log;

/**
 * 休日関連 サービスクラス
 */
class MtHolidayService
{

    /**
     * @var mtHolidayRepository
     */
    private MtHolidayRepository $mtHolidayRepository;

    /**
     * @param mtBankRepository $mtHolidayRepository
     */
    public function __construct()
    {
        $this->mtHolidayRepository = new mtHolidayRepository();
    }

    /** 休日 全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtHolidayRepository->getAll();
        return $datas;
    }

    /** 休日 初期データ取得
     *
     * @return $rows
     */
    public function getInitData()
    {
        $datas = $this->mtHolidayRepository->getInitData();
        return $datas;
    }

    /** 銀行マスタ（一覧）  更新
     * @param $params
     * @return $rows
     */
    public function update($params)
    {
        $datas = $this->mtHolidayRepository->update($params);
        return $datas;
    }

}
