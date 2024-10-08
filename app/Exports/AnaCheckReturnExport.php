<?php

namespace App\Exports;

use App\Services\AnaCheckReturnService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaCheckReturnExport implements FromCollection, WithHeadings, WithMapping
{
    private AnaCheckReturnService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaCheckReturnService();
        $this->params = $params;
    }

    public function collection()
    {
        return $this->service->csv($this->params);
    }

    public function headings(): array
    {
        return [
            '販売日付',
            '売上返品区分',
            '取引区分コード',
            '販売NO',
            '倉庫名',
            '伝票備考',
            '得意先コード',
            '得意先名',
            '納品先コード',
            '納品先名',
            '他品番',
            '商品コード',
            '商品名',
            'CS1コード',
            'CS1名',
            'CS2コード',
            'CS2名',
            '売上数量',
            '売上金額',
            '上代金額',
            '入力者名',
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
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                $record->sale_quantity,
                $record->sale_amount,
                $record->retail_amount,
                '',
            ];
        } else {
            return [
                $record->sale_date,
                $record->sale_return_kbn,
                $record->sale_kbn_cd,
                $record->sale_number,
                $record->warehouse_name,
                $record->slip_memo,
                $record->customer_cd,
                $record->bk_customer_name,
                $record->delivery_destination_id,
                $record->bk_delivery_destination_name,
                $record->other_part_number,
                $record->item_cd,
                $record->item_name,
                $record->color_cd,
                $record->color_name,
                $record->size_cd,
                $record->size_name,
                $record->sale_quantity,
                $record->sale_amount,
                $record->retail_amount,
                $record->user_name,
            ];
        }
    }
}
