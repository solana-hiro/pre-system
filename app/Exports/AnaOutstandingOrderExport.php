<?php

namespace App\Exports;

use App\Services\AnaOutstandingOrderService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaOutstandingOrderExport implements FromCollection, WithHeadings, WithMapping
{
    private AnaOutstandingOrderService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaOutstandingOrderService();
        $this->params = $params;
    }

    public function collection()
    {
        return $this->service->csv($this->params);
    }

    public function headings(): array
    {
        return [
            '商品分類1コード',
            '商品分類1名',
            '他品番',
            'CS1コード',
            'CS1名',
            'CS2コード',
            'CS2名',
            '発注数量',
            '発注日付',
            '指定納期',
            '完了区分',
            '明細備考1',
            '仕入先コード',
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
                $record->total_order_quantity,
                '',
                '',
                '',
                '',
            ];
        } else {
            return [
                $record->item_class_cd,
                $record->item_class_name,
                $record->other_part_number,
                $record->color_cd,
                $record->color_name,
                $record->size_cd,
                $record->size_name,
                $record->order_quantity,
                $record->order_date,
                $record->specify_deadline,
                $record->order_finish_flg,
                $record->memo,
                $record->supplier_cd,
            ];
        }
    }
}
