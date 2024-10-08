<?php

namespace App\Services;

use App\Models\TrnSaleBreakdown;
use App\Repositories\Analyse\AnaCheckReturn\AnaCheckReturnRepository;

/**
 * 返品確認データ サービス
 */
class AnaCheckReturnService extends AnalyseServiceBase
{
    private AnaCheckReturnRepository $repository;
    private $data;

    public function __construct()
    {
        $this->repository = new AnaCheckReturnRepository();
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
        $this->appendTotal();
    }

    private function appendTotal()
    {
        $total = new TrnSaleBreakdown();
        $total->total_flag = true;
        $total->title = '合計';
        $total->sale_quantity = $this->data->sum('sale_quantity');
        $total->sale_amount = $this->data->sum('sale_amount');
        $total->retail_amount = $this->data->sum('retail_amount');
        $this->data->push($total);
    }
}
