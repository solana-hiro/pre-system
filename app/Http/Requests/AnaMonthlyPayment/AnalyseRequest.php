<?php

namespace App\Http\Requests\AnaMonthlyPayment;

use App\Http\Requests\AnalyseRequestBase;
use Illuminate\Http\Request;

class AnalyseRequest extends AnalyseRequestBase
{
    protected $redirectRoute = 'analyse.detail.monthly_payment.analyse';

    const VALIDATIONS = [
        ['name' => 'payment_kbn_cd', 'type' => 'value'],
        ['name' => 'customer_cd', 'type' => 'value'],
        ['name' => 'payment_date', 'type' => 'date'],
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
