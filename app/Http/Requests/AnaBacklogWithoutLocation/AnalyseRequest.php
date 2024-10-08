<?php

namespace App\Http\Requests\AnaBacklogWithoutLocation;

use App\Http\Requests\AnalyseRequestBase;
use Illuminate\Http\Request;

class AnalyseRequest extends AnalyseRequestBase
{
    protected $redirectRoute = 'analyse.detail.backlog_without_location.analyse';

    const VALIDATIONS = [
        ['name' => 'specify_deadline', 'type' => 'date'],
        ['name' => 'item_cd', 'type' => 'value'],
        ['name' => 'picking_list_output_flg', 'type' => 'value'],
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
