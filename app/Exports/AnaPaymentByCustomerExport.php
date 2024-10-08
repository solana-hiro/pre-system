<?php

namespace App\Exports;

use App\Services\AnaPaymentByCustomerService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaPaymentByCustomerExport implements FromCollection, WithHeadings, WithMapping
{
    private AnaPaymentByCustomerService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaPaymentByCustomerService();
        $this->params = $params;
    }

    public function collection()
    {
        return $this->service->csv($this->params);
    }

    public function headings(): array
    {
        return [
            '得意先コード',
            '得意先名',
            '入金日付',
            '入金金額',
            '入金区分名',
            '備考1',
            '備考2',
            '銀行名',
            '更新者名',
        ];
    }

    public function map($record): array
    {
        // total_flag行はsub_total_flagもtrueなので分岐は不要
        if ($record->sub_total_flag) {
            return [
                $record->title,
                '',
                '',
                '',
                $record->amount,
                '',
                '',
                '',
                '',
                '',
            ];
        } else {
            return [
                $record->customer_cd,
                $record->customer_name,
                $record->payment_date,
                $record->amount,
                $record->payment_kbn_name,
                $record->memo1,
                $record->memo2,
                $record->bank_name,
                $record->user_name,
            ];
        }
    }
}
