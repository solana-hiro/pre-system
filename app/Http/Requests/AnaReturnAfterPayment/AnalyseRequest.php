<?php

namespace App\Http\Requests\AnaReturnAfterPayment;

use App\Http\Requests\AnalyseRequestBase;
use Illuminate\Http\Request;

class AnalyseRequest extends AnalyseRequestBase
{
    protected $redirectRoute = 'analyse.detail.return_after_payment.analyse';

    const VALIDATIONS = [
        ['name' => 'customer_cd', 'type' => 'value'],
        ['name' => 'sale_date', 'type' => 'date'],
        ['name' => 'sale_return_kbn', 'type' => 'value'],
        ['name' => 'payment_kbn', 'type' => 'value'],
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
