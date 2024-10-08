<?php

namespace App\Exports;

use App\Services\AnaDailyPaymentService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaDailyPaymentExport implements FromCollection, WithHeadings, WithMapping
{
    private AnaDailyPaymentService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaDailyPaymentService();
        $this->params = $params;
    }

    public function collection()
    {
        return $this->service->csv($this->params);
    }

    public function headings(): array
    {
        return [
            '入金区分コード',
            '入金区分名',
            '銀行名',
            '得意先コード',
            '得意先名',
            '入金金額',
            '備考1',
            '備考2',
            '入金NO',
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
                '',
                $record->amount,
                '',
                '',
                '',
                '',
            ];
        } else {
            return [
                $record->payment_kbn_cd,
                $record->payment_kbn_name,
                $record->bank_name,
                $record->customer_cd,
                $record->customer_name,
                $record->amount,
                $record->memo1,
                $record->memo2,
                $record->payment_number,
                $record->user_name,
            ];
        }
    }
}
