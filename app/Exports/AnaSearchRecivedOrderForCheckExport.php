<?php

namespace App\Exports;

use App\Services\AnaSearchRecivedOrderForCheckService;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaSearchRecivedOrderForCheckExport implements FromQuery, WithHeadings, WithMapping
{
    private AnaSearchRecivedOrderForCheckService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaSearchRecivedOrderForCheckService();
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
            '受注NO',
            '受注日付',
            '指定納期',
            '得意先名',
            '納品先コード',
            '納品先名',
            '商品名',
            '受注数量',
            '売上数量',
            '付箋区分名',
            '伝票備考',
            '決済方法',
        ];
    }

    public function map($record): array
    {
        return [
            $record->customer_cd,
            $record->order_receive_number,
            $record->order_receive_date,
            $record->specify_deadline,
            $record->customer_name,
            $record->delivery_destination_id,
            $record->bk_delivery_destination_name,
            $record->item_name,
            $record->order_receive_quantity,
            $record->sale_quantity,
            $record->sticky_note_name,
            $record->slip_memo,
            $this->settlementMethod($record),
        ];
    }

    private function settlementMethod($record)
    {
        return $record->settlement_method === 0 ? '通常' : 'クレジット決済';
    }
}
