<?php

namespace App\Exports;

use App\Services\AnaCheckShippingService;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaCheckShippingExport implements FromQuery, WithHeadings, WithMapping
{
    private AnaCheckShippingService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaCheckShippingService();
        $this->params = $params;
    }

    public function query()
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
            'ピッキング担当者コード',
            'ピッキング担当者名',
            '最終ピッキング担当者コード',
            '最終ピッキング担当者名',
            '検品担当者コード',
            '検品担当者名',
            'ルートコード',
            'ルート名',
            '付箋区分名_明細',
        ];
    }

    public function map($record): array
    {
        return [
            $record->order_receive_number,
            $record->customer_cd,
            $record->bk_customer_name,
            $record->delivery_destination_id,
            $record->bk_delivery_destination_name,
            $record->picking_user_cd,
            $record->picking_user_name,
            $record->last_picking_user_cd,
            $record->last_picking_user_name,
            $record->inspection_user_cd,
            $record->inspection_user_name,
            $record->delivery_slip_return_slip_output_flg,
            $record->root_cd,
            $record->root_name,
            $record->sticky_note_name,
        ];
    }
}
