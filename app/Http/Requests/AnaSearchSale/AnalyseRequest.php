<?php

namespace App\Http\Requests\AnaSearchSale;

use App\Http\Requests\AnalyseRequestBase;
use Illuminate\Http\Request;

class AnalyseRequest extends AnalyseRequestBase
{
    protected $redirectRoute = 'analyse.detail.search_sale.analyse';

    const VALIDATIONS = [
        ['name' => 'customer_cd', 'type' => 'value'],
        ['name' => 'sale_date', 'type' => 'date'],
        ['name' => 'order_receive_number', 'type' => 'value'],
        ['name' => 'sale_number', 'type' => 'value'],
        ['name' => 'delivery_destination_id', 'type' => 'value'],
        ['name' => 'other_part_number', 'type' => 'value'],
        ['name' => 'slip_memo', 'type' => 'value'],
        ['name' => 'shipping_document_numbers', 'type' => 'value'],
    ];

    public function rules(Request $request)
    {
        return parent::createRules(self::VALIDATIONS, $request);
    }

    public function attributes()
    {
        return parent::createAttributes(self::VALIDATIONS);
    }

    public function messages()
    {
        return parent::createMessages(self::VALIDATIONS);
    }
}
