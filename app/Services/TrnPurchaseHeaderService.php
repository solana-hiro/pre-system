<?php

namespace App\Services;

use App\Repositories\TrnPurchaseHeader\TrnPurchaseHeaderRepository;
use Illuminate\Support\Facades\Log;

/**
 * 仕入ヘッダ関連 サービスクラス
 */
class TrnPurchaseHeaderService
{

    /**
     * @var trnPurchaseHeaderRepository
     */
    private TrnPurchaseHeaderRepository $trnPurchaseHeaderRepository;

    /**
     * @param TrnPurchaseHeaderRepository $trnPurchaseHeaderRepository
     */
    public function __construct()
    {
        $this->trnPurchaseHeaderRepository = new TrnPurchaseHeaderRepository();
    }

    /** 仕入ヘッダ  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->trnPurchaseHeaderRepository->getAll();
        return $datas;
    }

    /** 仕入チェックリストの情報取得
     *
     * @return $rows
     */
    public function getChecklist($params)
    {
        $datas = $this->trnPurchaseHeaderRepository->getChecklist($params);
        return $datas;
    }

    /** 商品仕入日計表の情報取得
     *
     * @return $rows
     */
    public function getItemDailyList($params)
    {
        $datas = $this->trnPurchaseHeaderRepository->getItemDailyList($params);
        return $datas;
    }

}
