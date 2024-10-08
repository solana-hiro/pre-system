<?php

namespace App\Exports;

use App\Services\AnaCheckReceivedOrderService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaCheckReceivedOrderExport implements FromCollection, WithHeadings, WithMapping
{
    private AnaCheckReceivedOrderService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaCheckReceivedOrderService();
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
            '商品分類2名',
            '他品番',
            'CS1名',
            'CS2名',
            '受注数量',
            '受注金額',
            '付箋区分名',
            '相手先NO',
            'クレジット決済',
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
                '',
                '',
                $record->order_receive_quantity,
                $record->amount,
                '',
                '',
                '',
            ];
        } else {
            return [
                $record->order_receive_number,
                $record->customer_cd,
                $record->customer_name,
                $record->item_class_name,
                $record->other_part_number,
                $record->color_name,
                $record->size_name,
                $record->order_receive_quantity,
                $record->order_receive_quantity * $record->order_receive_price,
                $record->sticky_note_name,
                $record->order_number,
                $record->settlement_method,
            ];
        }
    }
}
