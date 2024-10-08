<?php

namespace App\Exports;

use App\Services\AnaBacklogService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaBacklogExport implements FromCollection, WithHeadings, WithMapping
{
    private AnaBacklogService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaBacklogService();
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
            '商品コード',
            '他品番',
            'CS1コード',
            'CS1名',
            'CS2コード',
            'CS2名',
            '受注数量',
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
                '',
                $record->total_order_receive_quantity,
            ];
        } else {
            return [
                $record->item_class_cd,
                $record->item_class_name,
                $record->item_cd,
                $record->other_part_number,
                $record->color_cd,
                $record->color_name,
                $record->size_cd,
                $record->size_name,
                $record->total_order_receive_quantity,
            ];
        }
    }
}
