<?php

namespace App\Services;

use App\Repositories\Analyse\AnaCustomerDeliveryDestinationData\AnaCostomerDeliveryDestinationDataRepository;

/**
 * 得意先別粗利管理表 サービス
 */
class AnaCustomerDeliveryDestinationDataService
{
    private AnaCostomerDeliveryDestinationDataRepository $repository;
    private $data;

    public function __construct()
    {
        $this->repository = new AnaCostomerDeliveryDestinationDataRepository();
    }

    public function search($params)
    {
        $this->data = $this->repository->search($params);
        return $this->data;
    }

    public function csv($params)
    {
        $query = $this->repository->csv($params);
        return $query;
    }
}
