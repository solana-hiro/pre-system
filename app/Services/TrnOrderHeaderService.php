<?php

namespace App\Services;

use App\Repositories\TrnOrderHeader\TrnOrderHeaderRepository;
use Illuminate\Support\Facades\Log;

/**
 * 発注ヘッダ関連 サービスクラス
 */
class TrnOrderHeaderService
{

    /**
     * @var trnOrderHeaderRepository
     */
    private TrnOrderHeaderRepository $trnOrderHeaderRepository;

    /**
     * @param TrnOrderHeaderRepository $trnOrderHeaderRepository
     */
    public function __construct()
    {
        $this->trnOrderHeaderRepository = new TrnOrderHeaderRepository();
    }

    /** コード補完(Itemcode指定)
     * @param $code
     * @return $rows
     */
    public function codeAutoComplete($code)
    {
        $datas = $this->trnOrderHeaderRepository->getByCode($code);
        return $datas;
    }

    /** 発注ヘッダ  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->trnOrderHeaderRepository->getAll();
        return $datas;
    }

    /** 発注伝票一括発行の情報取得
     * @param $params
     * @return $rows
     */
    public function getSlipIssue($params)
    {
        $datas = $this->trnOrderHeaderRepository->getSlipIssue($params);
        return $datas;
    }

    /** 発注チェックリストの情報取得
     * @param $params
     * @return $rows
     */
    public function getChecklist($params)
    {
        $datas = $this->trnOrderHeaderRepository->getChecklist($params);
        return $datas;
    }

    /** 発注残一覧表(仕入先別納期別)の情報取得
     * @param $params
     * @return $rows
     */
    public function getOrderBalanceListSupplier($params)
    {
        $datas = $this->trnOrderHeaderRepository->getOrderBalanceListSupplier($params);
        return $datas;
    }

    /** 発注残一覧表(商品別納期別)の情報取得
     * @param $params
     * @return $rows
     */
    public function getOrderBalanceListItem($params)
    {
        $datas = $this->trnOrderHeaderRepository->getOrderBalanceListItem($params);
        return $datas;
    }

}
