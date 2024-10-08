<?php

namespace App\Services;

use App\Repositories\Analyse\AnaSearchRecivedOrderForCheck\AnaSearchRecivedOrderForCheckRepository;

/**
 * 受注伝票検索 サービス
 */
class AnaSearchRecivedOrderForCheckService extends AnalyseServiceBase
{
    private AnaSearchRecivedOrderForCheckRepository $repository;
    private $data;

    public function __construct()
    {
        $this->repository = new AnaSearchRecivedOrderForCheckRepository();
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
