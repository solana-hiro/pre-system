<?php

namespace App\Http\Requests\AnaCheckAssignedOutstandingOrder;

use App\Http\Requests\AnalyseRequestBase;
use Illuminate\Http\Request;

class AnalyseRequest extends AnalyseRequestBase
{
    protected $redirectRoute = 'analyse.detail.check_assigned_outstanding_order.analyse';

    const VALIDATIONS = [
        ['name' => 'specify_deadline', 'type' => 'date'],
        ['name' => 'item_cd', 'type' => 'value'],
        ['name' => 'order_finish_flg', 'type' => 'value'],
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
