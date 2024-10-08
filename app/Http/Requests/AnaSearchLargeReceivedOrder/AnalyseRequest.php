<?php

namespace App\Http\Requests\AnaSearchLargeReceivedOrder;

use App\Http\Requests\AnalyseRequestBase;
use Illuminate\Http\Request;

class AnalyseRequest extends AnalyseRequestBase
{
    protected $redirectRoute = 'analyse.detail.search_large_received_order.analyse';

    const VALIDATIONS = [
        ['name' => 'specify_deadline', 'type' => 'date'],
        ['name' => 'slip_memo', 'type' => 'value'],
        ['name' => 'root_cd', 'type' => 'value'],
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
