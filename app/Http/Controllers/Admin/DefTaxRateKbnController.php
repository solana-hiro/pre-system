<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\DefTaxRateKb\SearchRequest;
use App\Services\DefTaxRateKbnService as DefTaxRateKbnService;
use Illuminate\Support\Facades\Log;

class DefTaxRateKbnController extends Controller
{
    /**
     * commonParams: 共通パラメータ
     */
    private $commonParams;

    public function __construct()
    {
        parent::__construct();
        $menus = $this->getMenu();
        $pageInfo = $this->getPageInfo();
        $this->commonParams = ['menus' => $menus, 'pageInfo' => $pageInfo];
    }

    /**
     * 税率区分 自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, DefTaxRateKbnService $service)
    {
        $datas =  $service->codeAutoComplete($request->input('tax_rate_kbn_cd'));
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 税率設定　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoCompleteWithRate(Request $request, DefTaxRateKbnService $service)
    {
        $datas =  $service->codeAutoCompleteWithRate($request->input('tax_rate_kbn_cd'));
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
