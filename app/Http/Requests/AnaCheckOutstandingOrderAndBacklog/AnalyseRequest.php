<?php

namespace App\Http\Requests\AnaCheckOutstandingOrderAndBacklog;

use App\Http\Requests\AnalyseRequestBase;
use Illuminate\Http\Request;

class AnalyseRequest extends AnalyseRequestBase
{
    protected $redirectRoute = 'analyse.tally.check_outstanding_order_and_backlog.analyse';

    const VALIDATIONS = [
        ['name' => 'item_class_cd', 'type' => 'value'],
        ['name' => 'other_part_number', 'type' => 'value'],
        ['name' => 'color_cd', 'type' => 'value'],
        ['name' => 'size_cd', 'type' => 'value'],
        ['name' => 'warehouse_cd', 'type' => 'value'],
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
