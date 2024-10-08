<?php

namespace App\Exports;

use App\Services\AnaSearchLargeReceivedOrderService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaSearchLargeReceivedOrderExport implements FromCollection, WithHeadings, WithMapping
{
    private AnaSearchLargeReceivedOrderService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaSearchLargeReceivedOrderService();
        $this->params = $params;
    }

    public function collection()
    {
        return $this->service->csv($this->params);
    }

    public function headings(): array
    {
        return [
            '受注NO',
            '得意先コード',
            '得意先名',
            '納品先コード',
            '納品先名',
            '商品名',
            'CS1コード',
            'CS1名',
            'CS2名',
            '受注数量',
            '伝票備考',
            '付箋区分名',
            '相手先NO',
            '付箋区分コード',
            '付箋種別',
            '受注金額',
            'ルートコード',
            'ルート名',
        ];
    }

    public function map($record): array
    {
        if ($record->total_flag) {
            return [
                $record->title,
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                $record->order_receive_quantity,
                '',
                '',
                '',
                '',
                '',
                $record->order_receive_amount,
                '',
                '',
            ];
        } else {
            return [
                $record->order_receive_number,
                $record->customer_cd,
                $record->bk_customer_name,
                $record->delivery_destination_id,
                $record->bk_delivery_destination_name,
                $record->item_name,
                $record->color_cd,
                $record->color_name,
                $record->size_name,
                $record->order_receive_quantity,
                $record->slip_memo,
                $record->sticky_note_name,
                $record->order_number,
                $record->branch_number,
                $record->sticky_note_kind_cd,
                $record->order_receive_amount,
                $record->root_cd,
                $record->root_name,
            ];
        }
    }
}
