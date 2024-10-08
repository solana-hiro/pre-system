<?php

namespace App\Exports;

use App\Services\AnaCustomerDeliveryDestinationDataService;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaCustomerDeliveryDestinationDataExport implements FromQuery, WithHeadings, WithMapping
{
    private AnaCustomerDeliveryDestinationDataService $service;
    protected $params;

    public function __construct($params)
    {
        $this->service = new AnaCustomerDeliveryDestinationDataService();
        $this->params = $params;
    }

    public function query()
    {
        return $this->service->csv($this->params);
    }

    public function headings(): array
    {
        return [
            '納品先CD',
            '全納品先名',
            '名カナ',
            '郵便番号',
            '全住所',
            '電話番号',
            'FAX番号',
            '得意先CD',
            'ルート名',
            '備考1',
            '備考2',
            '運送会社名',
            '削除区分',
            '削除区分_得納',
        ];
    }

    public function map($record): array
    {
        return [
            $record->delivery_destination_id,
            $record->delivery_destination_name,
            $record->delivery_destination_name_kana,
            $record->post_number,
            $record->address,
            $record->tel,
            $record->fax,
            $record->customer_cd,
            $record->root_name,
            $record->arrival_date_name,
            $record->sale_decision_print_paper_flg,
            $record->item_class_name,
            $record->del_kbn_delivery_destination,
            $record->del_kbn_customer,
        ];
    }
}
