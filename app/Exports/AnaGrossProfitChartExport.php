<?php

namespace App\Exports;

use App\Services\AnaGrossProfitChartService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaGrossProfitChartExport implements FromCollection, WithHeadings, WithMapping
{
    private AnaGrossProfitChartService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaGrossProfitChartService();
        $this->params = $params;
    }

    public function collection()
    {
        return $this->service->csv($this->params);
    }

    public function headings(): array
    {
        return [
            '順位',
            '請求先コード',
            '請求先名',
            '純売上金額',
            'ロス原価',
            '粗利金額',
            '粗利率（％）',
        ];
    }

    public function map($record): array
    {
        // おそらくEloquentのコレクションではないのでissetで判定が必要
        if (isset($record->total_flag)) {
            return [
                '',
                '',
                '合計',
                $record->net_sales,
                $record->loss_cost,
                $record->gross_profit,
                $record->gross_profit_rate,
            ];
        } else {
            return [
                $record->rank_no,
                $record->billing_address_cd,
                $record->bk_customer_name,
                $record->net_sales,
                $record->loss_cost,
                $record->gross_profit,
                $record->gross_profit_rate,
            ];
        }
    }
}
