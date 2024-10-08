<?php

namespace App\Services;

use App\Repositories\TrnShippingInspectionHeader\TrnShippingInspectionHeaderRepository;
use Illuminate\Support\Facades\Log;

/**
 * 出荷検品ヘッダ関連 サービスクラス
 */
class TrnShippingInspectionHeaderService
{

    /**
     * @var TrnShippingInspectionHeaderRepository
     */
    private TrnShippingInspectionHeaderRepository $trnShippingInspectionHeaderRepository;

    /**
     * @param TrnShippingInspectionHeaderRepository $trnShippingInspectionHeaderRepository
     */
    public function __construct()
    {
        $this->trnShippingInspectionHeaderRepository = new TrnShippingInspectionHeaderRepository();
    }

    /** 出荷検品ヘッダ  全件取得
     *
     * @return $rows
     */
    public function getAll()
    {
        $datas = $this->trnShippingInspectionHeaderRepository->getAll();
        return $datas;
    }

    /** 出荷案内発行  全件取得
     *
     * @return $rows
     */
    public function getGuidanceIssue($params)
    {
        $datas = $this->trnShippingInspectionHeaderRepository->getGuidanceIssue($params);
        return $datas;
    }

    /** 出荷検品処理  全件取得
     *
     * @return $rows
     */
    public function getInspection($params)
    {
        $datas = $this->trnShippingInspectionHeaderRepository->getInspection($params);
        return $datas;
    }

    /** 出荷検品処理  更新
     *
     * @return $rows
     */
    public function updateInspection($params)
    {
        $datas = $this->trnShippingInspectionHeaderRepository->updateInspection($params);
        // TODO: 更新
        return $datas;
    }

    /** 出荷検品処理  手検品実施
     *
     * @return $rows
     */
    public function executeInspection($params)
    {
        $datas = $this->trnShippingInspectionHeaderRepository->executeInspection($params);
        // TODO: 更新
        return $datas;
    }

    /** ピッキングリスト発行  全件取得
     *
     * @return $rows
     */
    public function getPickingList($params)
    {
        $datas = $this->trnShippingInspectionHeaderRepository->getPickingList($params);
        return $datas;
    }

    /** トータルピッキングリスト発行  全件取得
     *
     * @return $rows
     */
    public function getTotalPickingList($params)
    {
        $datas = $this->trnShippingInspectionHeaderRepository->getTotalPickingList($params);
        return $datas;
    }

}
