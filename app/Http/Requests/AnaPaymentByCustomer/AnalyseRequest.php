<?php

namespace App\Http\Requests\AnaPaymentByCustomer;

use App\Http\Requests\AnalyseRequestBase;
use Illuminate\Http\Request;

class AnalyseRequest extends AnalyseRequestBase
{
    protected $redirectRoute = 'analyse.detail.payment_by_customer.analyse';

    const VALIDATIONS = [
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
