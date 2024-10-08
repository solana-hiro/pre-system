<?php

namespace App\Services;

use App\Repositories\TrnInOutBreakdown\TrnInOutBreakdownRepository;
use App\Repositories\TrnInOutDetail\TrnInOutDetailRepository;
use Illuminate\Support\Facades\Log;

/**
 * 入出庫ヘッダ関連 サービスクラス
 */
class TrnInOutBreakdownService
{

    /**
     * @var trnPayHeaderRepository
     */
    private TrnInOutBreakdownRepository $trnInOutBreakdownRepository;

    /**
     * @param TrnInOutBreakdownRepository $trnInOutBreakdownRepository
     */
    public function __construct()
    {
        $this->trnInOutBreakdownRepository = new TrnInOutBreakdownRepository();
    }

    /** コード補完(Itemcode指定)
     * @param $code
     * @return $rows
     */
    public function getDetailBreakdowns($params)
    {
        $datas = $this->trnInOutBreakdownRepository->getByDetailId($params);
        return $datas;
    }

    /** 入出庫データの更新
     * @param $params, $trn_in_out_header_id
     * @return Object
     */

    public function updateInOutData($params, $trn_in_out_detail_id)
    {
        $data = $this->trnInOutBreakdownRepository->updateInOutData($params, $trn_in_out_detail_id);
        return $data;
    }

    /** 入出庫データの更新
     * @param $params, $trn_in_out_header_id
     * @return Boolean
     */

    public function deleteInOutData($trn_in_out_detail_id)
    {
        $data = $this->trnInOutBreakdownRepository->deleteInOutData($trn_in_out_detail_id);
        return $data;
    }
}
