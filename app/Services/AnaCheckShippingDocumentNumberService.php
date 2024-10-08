<?php

namespace App\Services;

use App\Repositories\Analyse\AnaCheckShippingDocumentNumber\AnaCheckShippingDocumentNumberRepository;

/**
 * 売上伝票検索 サービス
 */
class AnaCheckShippingDocumentNumberService extends AnalyseServiceBase
{
    private AnaCheckShippingDocumentNumberRepository $repository;
    private $data;

    public function __construct()
    {
        $this->repository = new AnaCheckShippingDocumentNumberRepository();
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
