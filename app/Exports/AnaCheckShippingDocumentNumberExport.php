<?php

namespace App\Exports;

use App\Services\AnaCheckShippingDocumentNumberService;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaCheckShippingDocumentNumberExport implements FromQuery, WithHeadings, WithMapping
{
    private AnaCheckShippingDocumentNumberService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaCheckShippingDocumentNumberService();
        $this->params = $params;
    }

    public function query()
    {
        return $this->service->csv($this->params);
    }

    public function headings(): array
    {
        return [
            '販売NO',
            '送り状番号',
            '販売日付',
            '得意先コード',
            '得意先名',
            '納品先コード',
            '納品先名',
            '運送会社コード',
            '運送会社名',
            '伝票備考',
        ];
    }

    public function map($record): array
    {
        return [
            $record->sale_number,
            $record->shipping_document_numbers,
            $record->sale_date,
            $record->customer_cd,
            $record->bk_customer_name,
            $record->delivery_destination_id,
            $record->bk_delivery_destination_name,
            $record->shipping_company_cd,
            $record->shipping_company_name,
            $record->slip_memo,
        ];
    }
}
