<?php

namespace App\Exports;

use App\Repositories\Analyse\AnaCustomerData\AnaCustomerDataRepository;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnaCustomerDataExport implements FromQuery, WithHeadings, WithMapping
{
    private AnaCustomerDataRepository $repository;
    protected $params;

    public function __construct($params)
    {
        $this->repository = new AnaCustomerDataRepository();
        $this->params = $params;
    }

    public function query()
    {
        return $this->repository->search($this->params);
    }

    public function headings(): array
    {
        return [
            '得意先CD',
            '全得意先名',
            '名カナ',
            '郵便番号',
            '全住所',
            '電話番号',
            'FAX番号',
            '請求先CD',
            'ルート名',
            '備考1',
            '備考2',
            '運送会社名'
        ];
    }

    public function map($record): array
    {
        return [
            $record->customer_cd,
            $record->customer_name,
            $record->customer_name_kana,
            $record->post_number,
            $record->address,
            $record->tel,
            $record->fax,
            $record->billing_address_cd,
            $record->root_name,
            $record->customer_memo_1,
            $record->customer_memo_2,
            $record->item_class_name,
        ];
    }
}
