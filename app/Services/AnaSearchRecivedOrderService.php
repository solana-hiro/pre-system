<?php

namespace App\Services;

use App\Repositories\Analyse\AnaSearchRecivedOrder\AnaSearchRecivedOrderRepository;

/**
 * 受注伝票検索 サービス
 */
class AnaSearchRecivedOrderService extends AnalyseServiceBase
{
    private AnaSearchRecivedOrderRepository $repository;
    private $data;

    public function __construct()
    {
        $this->repository = new AnaSearchRecivedOrderRepository();
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
