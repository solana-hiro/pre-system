<?php

namespace App\Exports;

use App\Services\AnaCheckAssignedOutstandingOrderService;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaCheckAssignedOutstandingOrderExport implements FromQuery, WithHeadings, WithMapping
{
    private AnaCheckAssignedOutstandingOrderService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaCheckAssignedOutstandingOrderService();
        $this->params = $params;
    }

    public function query()
    {
        return $this->service->csv($this->params);
    }

    public function headings(): array
    {
        return [
            '発注NO',
            '指定納期',
            '商品コード',
            '商品名',
            'CS1コード',
            'CS1名',
            'CS2コード',
            'CS2名',
            '発注数量',
            // 割当済発注数
            '完了区分',
        ];
    }

    public function map($record): array
    {
        return [
            $record->order_number,
            $record->specify_deadline,
            $record->item_cd,
            $record->item_name,
            $record->color_cd,
            $record->color_name,
            $record->size_cd,
            $record->size_name,
            $record->total_order_quantity,
            // 割当済発注数
            $record->order_finish_flg,
        ];
    }
}
