<?php

namespace App\Http\Requests\AnaGrossProfitChart;

use App\Http\Requests\AnalyseRequestBase;
use Illuminate\Http\Request;

class AnalyseRequest extends AnalyseRequestBase
{
    protected $redirectRoute = 'analyse.tally.gross_profit_chart.analyse';

    const VALIDATIONS = [
        ['name' => 'item_cd', 'type' => 'value'],
        ['name' => 'sale_date', 'type' => 'date'],
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
