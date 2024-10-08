<?php

namespace App\Http\Requests\AnaSearchRecivedOrder;

use App\Http\Requests\AnalyseRequestBase;
use Illuminate\Http\Request;

class AnalyseRequest extends AnalyseRequestBase
{
    protected $redirectRoute = 'analyse.detail.search_recived_order.analyse';

    const VALIDATIONS = [
        ['name' => 'customer_cd', 'type' => 'value'],
        ['name' => 'order_receive_number', 'type' => 'value'],
        ['name' => 'order_receive_date', 'type' => 'date'],
        ['name' => 'specify_deadline', 'type' => 'date'],
        ['name' => 'delivery_destination_id', 'type' => 'value'],
        ['name' => 'other_part_number', 'type' => 'value'],
        ['name' => 'color_cd', 'type' => 'value'],
        ['name' => 'size_name', 'type' => 'value'],
        ['name' => 'slip_memo', 'type' => 'value'],
        ['name' => 'order_number', 'type' => 'value'],
        ['name' => 'order_receive_finish_flg', 'type' => 'value'],
        ['name' => 'ec_order_receive_number', 'type' => 'value'],
        ['name' => 'keep_guidance_expiration_flg', 'type' => 'value'],
        ['name' => 'customer_class_cd', 'type' => 'value'],
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
