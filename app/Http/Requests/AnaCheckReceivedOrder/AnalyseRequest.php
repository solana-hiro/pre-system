<?php

namespace App\Http\Requests\AnaCheckReceivedOrder;

use App\Http\Requests\AnalyseRequestBase;
use Illuminate\Http\Request;

class AnalyseRequest extends AnalyseRequestBase
{
    protected $redirectRoute = 'analyse.detail.check_received_order.analyse';

    const VALIDATIONS = [
        ['name' => 'specify_deadline', 'type' => 'date'],
        ['name' => 'order_number', 'type' => 'value'],
        ['name' => 'ec_order_receive_number', 'type' => 'value'],
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
