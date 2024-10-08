<?php

namespace App\Http\Requests\AnaSearchRecivedOrderForCheck;

use App\Http\Requests\AnalyseRequestBase;
use Illuminate\Http\Request;

class AnalyseRequest extends AnalyseRequestBase
{
    protected $redirectRoute = 'analyse.detail.search_recived_order_for_check.analyse';

    const VALIDATIONS = [
        ['name' => 'specify_deadline', 'type' => 'date'],
        ['name' => 'sticky_note_name', 'type' => 'value'],
        ['name' => 'settlement_method', 'type' => 'value'],
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
