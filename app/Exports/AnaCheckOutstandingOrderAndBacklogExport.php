<?php

namespace App\Exports;

use App\Services\AnaCheckOutstandingOrderAndBacklogService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaCheckOutstandingOrderAndBacklogExport implements FromCollection, WithHeadings, WithMapping
{
    private AnaCheckOutstandingOrderAndBacklogService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaCheckOutstandingOrderAndBacklogService();
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
            '現在庫数量',
            '受注出荷残数量',
            '有効在庫',
            '発注入荷残数量',
            '入荷後在庫',
            // '出荷指示残数量',
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
                $record->now_stock_quantity,
                $record->remaining_order_receive_quantity,
                $record->effective_stock_quantity,
                $record->remaining_order_warehousing_quantity,
                $record->restock_quantity,
                // 出荷指示残数量,
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
                $record->now_stock_quantity,
                $record->remaining_order_receive_quantity,
                $record->effective_stock_quantity,
                $record->remaining_order_warehousing_quantity,
                $record->restock_quantity,
                // 出荷指示残数量,
            ];
        }
    }
}
