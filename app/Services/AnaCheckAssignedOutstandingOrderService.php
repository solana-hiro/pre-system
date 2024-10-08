<?php

namespace App\Services;

use App\Repositories\Analyse\AnaCheckAssignedOutstandingOrder\AnaCheckAssignedOutstandingOrderRepository;

/**
 * 発注残 サービス
 */
class AnaCheckAssignedOutstandingOrderService extends AnalyseServiceBase
{
    private AnaCheckAssignedOutstandingOrderRepository $repository;
    private $data;

    public function __construct()
    {
        $this->repository = new AnaCheckAssignedOutstandingOrderRepository();
    }

    public function search($params)
    {
        $this->data = $this->repository->search($params);
        $this->common($params);
        return $this->data;
    }

    public function csv($params)
    {
        $this->data = $this->repository->csv($params);
        $this->common($params);
        return $this->data;
    }

    private function common($params)
    {
        return;
    }
}
