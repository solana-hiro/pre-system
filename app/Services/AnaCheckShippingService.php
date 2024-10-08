<?php

namespace App\Services;

use App\Repositories\Analyse\AnaCheckShipping\AnaCheckShippingRepository;

/**
 * 当日出荷チェック サービス
 */
class AnaCheckShippingService extends AnalyseServiceBase
{
    private AnaCheckShippingRepository $repository;
    private $data;

    public function __construct()
    {
        $this->repository = new AnaCheckShippingRepository();
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
