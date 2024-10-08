<?php

namespace App\Exports;

use App\Services\AnaSearchRecivedOrderService;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaSearchRecivedOrderExport implements FromQuery, WithHeadings, WithMapping
{
    private AnaSearchRecivedOrderService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaSearchRecivedOrderService();
        $this->params = $params;
    }

    public function query()
    {
        return $this->service->csv($this->params);
    }

    public function headings(): array
    {
        return [
            '得意先コード',
            '受注NO',
            '受注日付',
            '指定納期',
            '得意先名',
            '納品先コード',
            '納品先名',
            '明細処理区分',
            '行NO',
            '商品名',
            'CS1コード',
            'CS1名',
            'CS2名',
            '受注数量',
            '売上数量',
            '明細備考2',
            '付箋区分名',
            '伝票備考',
            '相手先NO',
            '入力者名',
            '完了区分',
            'ピッキングリスト発行済みフラグ',
            'EC注文番号',
            'KEEP案内期限切フラグ',
            '得意先分類コード',
            '得意先分類名',
            '送料',
            '決済方法',
        ];
    }

    public function map($record): array
    {
        return [
            $record->customer_cd,
            $record->order_receive_number,
            $record->order_receive_date,
            $record->specify_deadline,
            $record->customer_name,
            $record->delivery_destination_id,
            $record->bk_delivery_destination_name,
            $record->process_kbn,
            $record->order_line_no,
            $record->item_name,
            $record->color_cd,
            $record->color_name,
            $record->size_name,
            $record->order_receive_quantity,
            $record->sale_quantity,
            $record->memo_2,
            $record->sticky_note_name,
            $record->slip_memo,
            $record->order_number,
            $record->user_name,
            $record->order_receive_finish_flg,
            $record->picking_list_output_flg,
            $record->ec_order_receive_number,
            $record->keep_guidance_expiration_flg,
            $record->customer_class_cd,
            $record->customer_class_name,
            $record->postage,
            $this->settlementMethod($record),
        ];
    }

    private function settlementMethod($record)
    {
        return $record->settlement_method === 0 ? '通常' : 'クレジット決済';
    }
}
