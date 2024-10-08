<?php

namespace App\Services;

use App\Repositories\Analyse\AnaGrossProfitChart\AnaGrossProfitChartRepository;
use \Illuminate\Support\Collection;

/**
 * 得意先別粗利管理表 サービス
 */
class AnaGrossProfitChartService extends AnalyseServiceBase
{
    private AnaGrossProfitChartRepository $repository;
    private Collection $data;

    public function __construct()
    {
        $this->repository = new AnaGrossProfitChartRepository();
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
        $this->append();
        $this->sort($params);
        $this->appendTotal();
    }

    private function append()
    {
        foreach ($this->data as $record) {
            $record->gross_profit = $this->calculateGrossProfit($record);
            $record->gross_profit_rate = $this->calculateGrossProfitRate($record);
        }
    }

    private function sort($params)
    {
        $sortElement = parent::sortByParams([], $params);
        $this->data = $this->data->sortBy($sortElement);
    }

    private function appendTotal()
    {
        $total = clone $this->data->last();
        $total->total_flag = true;
        $total->net_sales = $this->data->sum('net_sales');
        $total->loss_cost = $this->data->sum('loss_cost');
        $total->gross_profit = $this->calculateGrossProfit($total);
        $total->gross_profit_rate = $this->calculateGrossProfitRate($total);
        $this->data->push($total);
    }

    private function calculateGrossProfit($record)
    {
        return $record->net_sales - $record->loss_cost;
    }

    private function calculateGrossProfitRate($record)
    {
        if ($record->net_sales === '0') return '00.00';
        $div = bcdiv($record->gross_profit, $record->net_sales, 4);
        $rate = bcmul($div, '100', 2);
        return $rate;
    }
}
