<?php

namespace App\Services;

use App\Repositories\Analyse\AnaSearchSale\AnaSearchSaleRepository;

/**
 * 売上伝票検索 サービス
 */
class AnaSearchSaleService extends AnalyseServiceBase
{
    private AnaSearchSaleRepository $repository;
    private $data;

    public function __construct()
    {
        $this->repository = new AnaSearchSaleRepository();
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
