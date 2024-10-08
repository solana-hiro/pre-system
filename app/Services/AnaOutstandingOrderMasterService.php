<?php

namespace App\Services;

use App\Repositories\Analyse\AnaOutstandingOrderMaster\AnaOutstandingOrderMasterRepository;

/**
 * 発注残 サービス
 */
class AnaOutstandingOrderMasterService extends AnalyseServiceBase
{
    private AnaOutstandingOrderMasterRepository $repository;
    private $data;

    public function __construct()
    {
        $this->repository = new AnaOutstandingOrderMasterRepository();
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
