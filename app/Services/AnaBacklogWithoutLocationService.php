<?php

namespace App\Services;

use App\Models\TrnOrderReceiveBreakdown;
use App\Repositories\Analyse\AnaBacklogWithoutLocation\AnaBacklogWithoutLocationRepository;

/**
 * ロケーション無受注残リスト サービス
 */
class AnaBacklogWithoutLocationService extends AnalyseServiceBase
{
    private AnaBacklogWithoutLocationRepository $repository;
    private $data;

    public function __construct()
    {
        $this->repository = new AnaBacklogWithoutLocationRepository();
    }

    public function search($params)
    {
        $this->data = $this->repository->search($params);
        return $this->data;
    }

    public function csv($params)
    {
        return $this->repository->csv($params);
    }
}
