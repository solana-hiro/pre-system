<?php

namespace App\Services;

use App\Repositories\Analyse\AnaCustomerData\AnaCustomerDataRepository;

/**
 * 得意先別粗利管理表 サービス
 */
class AnaCustomerDataService
{
    private AnaCustomerDataRepository $repository;
    private $data;

    public function __construct()
    {
        $this->repository = new AnaCustomerDataRepository();
    }

    public function search($params)
    {
        $this->data = $this->repository->search($params);
        return $this->data;
    }
}
