<?php

namespace App\Services;

use App\Lib\CodeUtil;
use App\Repositories\MtSlipKind\MtSlipKindRepository;
use Illuminate\Support\Facades\Log;

/**
 * 伝票種別マスタ関連 サービスクラス
 */
class MtSlipKindService
{

    /**
     * @var mtSlipKindRepository
     */
    private MtSlipKindRepository $mtSlipKindRepository;

    /**
     * @param MtSlipKindRepository $mtSlipKindRepository
     */
    public function __construct()
    {
        $this->mtSlipKindRepository = new MtSlipKindRepository();
    }

    /** 伝票種別マスタ 全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->mtSlipKindRepository->getAll();
        return $datas;
    }

    /** 伝票種別マスタ 指定条件にて取得
     * @param $params
     * @return $rows
     */
    public function get($params)
    {
        $datas = $this->mtSlipKindRepository->get($params);
        return $datas;
    }

    /** 伝票種別マスタ 初期データ取得
     *
     * @return $rows
     */
    public function getInitData()
    {
        $datas = $this->mtSlipKindRepository->getInitData();
        return $datas;
    }

    /** コード補完(code指定)
     * @param $params
     * @return $row
     */
    public function codeAutoComplete($params)
    {
        $slipKindKbnCd = $params['slip_kind_kbn_cd'];
        $slipKindCd = $params['slip_kind_cd'] ? CodeUtil::pad($params['slip_kind_cd'], 3) : null;

        $datas = $this->mtSlipKindRepository->getByCode($slipKindCd, $slipKindKbnCd);
        return $datas;
    }
}
