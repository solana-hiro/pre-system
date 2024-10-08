<?php

namespace App\Exports;

use App\Services\AnaSearchSaleService;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaSearchSaleExport implements FromQuery, WithHeadings, WithMapping
{
    private AnaSearchSaleService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaSearchSaleService();
        $this->params = $params;
    }

    public function query()
    {
        return $this->service->csv($this->params);
    }

    public function headings(): array
    {
        return [
            '得意先コード',
            '販売日付',
            '受注NO',
            '販売NO',
            '得意先名',
            '納品先コード',
            '納品先名',
            '商品名',
            'CS1コード',
            'CS1名',
            'CS2名',
            '売上数量',
            '売上単価',
            '伝票備考',
            '運送会社名',
            '送り状番号',
            '個口数',
        ];
    }

    public function map($record): array
    {
        return [
            $record->customer_cd,
            $record->sale_date,
            $record->order_receive_number,
            $record->sale_number,
            $record->bk_customer_name,
            $record->delivery_destination_id,
            $record->bk_delivery_destination_name,
            $record->item_name,
            $record->color_cd,
            $record->color_name,
            $record->size_name,
            $record->sale_quantity,
            $record->sale_price,
            $record->slip_memo,
            $record->shipping_company_name,
            $record->shipping_document_numbers,
            $record->piece_number,
        ];
    }
}
