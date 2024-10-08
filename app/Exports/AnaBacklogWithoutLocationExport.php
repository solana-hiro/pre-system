<?php

namespace App\Exports;

use App\Services\AnaBacklogWithoutLocationService;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaBacklogWithoutLocationExport implements FromQuery, WithHeadings, WithMapping
{
    private AnaBacklogWithoutLocationService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaBacklogWithoutLocationService();
        $this->params = $params;
    }

    public function query()
    {
        return $this->service->csv($this->params);
    }

    public function headings(): array
    {
        return [
            'JANコード',
            '受注数量',
            '棚番1',
            '得意先コード',
            '得意先名',
            '商品名',
            'CS1コード',
            'CS1名',
            'CS2コード',
            'CS2名',
            'ピッキングリスト発行済フラグ',
            '指定納期',
        ];
    }

    public function map($record): array
    {
        return [
            $record->jan_cd,
            $record->order_receive_quantity,
            $record->shelf_number_1,
            $record->customer_cd,
            $record->bk_customer_name,
            $record->item_name,
            $record->color_cd,
            $record->color_name,
            $record->size_cd,
            $record->size_name,
            $record->picking_list_output_flg,
            $record->specify_deadline,
        ];
    }
}
