<?php

namespace App\Exports;

use App\Services\AnaReturnAfterPaymentService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaReturnAfterPaymentExport implements FromCollection, WithHeadings, WithMapping
{
    private AnaReturnAfterPaymentService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaReturnAfterPaymentService();
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
            '販売日付',
            '販売NO',
            '売上返品区分',
            '売上金額合計',
            '伝票備考',
            '入力者名',
            '入金区分',
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
                $record->all_total,
                '',
                '',
            ];
        } else {
            return [
                $record->customer_cd,
                $record->bk_customer_name,
                $record->sale_date,
                $record->id,
                $record->all_total,
                $record->slip_memo,
                $record->user_name,
            ];
        }
    }
}
