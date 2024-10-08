<?php

namespace App\Http\Requests\AnaOutstandingOrder;

use App\Http\Requests\AnalyseRequestBase;
use Illuminate\Http\Request;

class AnalyseRequest extends AnalyseRequestBase
{
    protected $redirectRoute = 'analyse.tally.outstanding_order.analyse';

    const VALIDATIONS = [
        ['name' => 'order_date', 'type' => 'date'],
        ['name' => 'specify_deadline', 'type' => 'date'],
        ['name' => 'order_finish_flg', 'type' => 'value'],
        ['name' => 'memo', 'type' => 'value'],
        ['name' => 'supplier_cd', 'type' => 'value'],
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
