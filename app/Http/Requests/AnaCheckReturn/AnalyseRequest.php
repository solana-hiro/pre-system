<?php

namespace App\Http\Requests\AnaCheckReturn;

use App\Http\Requests\AnalyseRequestBase;
use Illuminate\Http\Request;

class AnalyseRequest extends AnalyseRequestBase
{
    protected $redirectRoute = 'analyse.detail.check_return.analyse';

    const VALIDATIONS = [
        ['name' => 'sale_date', 'type' => 'date'],
        ['name' => 'sale_return_kbn', 'type' => 'value'],
        ['name' => 'sale_number', 'type' => 'value'],
        ['name' => 'warehouse_name', 'type' => 'value'],
        ['name' => 'slip_memo', 'type' => 'value'],
        ['name' => 'customer_cd', 'type' => 'value'],
        ['name' => 'other_part_number', 'type' => 'value'],
        ['name' => 'item_cd', 'type' => 'value'],
        ['name' => 'item_name', 'type' => 'value'],
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
