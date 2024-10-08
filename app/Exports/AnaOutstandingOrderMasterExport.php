<?php

namespace App\Exports;

use App\Services\AnaOutstandingOrderMasterService;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaOutstandingOrderMasterExport implements FromQuery, WithHeadings, WithMapping
{
    private AnaOutstandingOrderMasterService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaOutstandingOrderMasterService();
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
            '他品番',
            'CS1コード',
            'CS1名',
            'CS2コード',
            'CS2名',
            '指定納期',
            '発注数量',
            '明細備考1',
            '明細備考2',
            '完了区分',
            '仕入先コード',
            '仕入先名',
            '相手先NO',
            '伝票備考',
        ];
    }

    public function map($record): array
    {
        return [
            $record->order_number,
            $record->other_part_number,
            $record->color_cd,
            $record->color_name,
            $record->size_cd,
            $record->size_name,
            $record->specify_deadline,
            $record->total_order_quantity,
            $record->memo,
            $record->memo2,
            $record->order_finish_flg,
            $record->supplier_cd,
            $record->supplier_name,
            $record->partner_number,
            $record->slip_memo,
        ];
    }
}
