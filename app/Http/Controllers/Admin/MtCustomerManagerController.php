<?php

namespace App\Http\Controllers\Admin;

use App\Consts\CommonConsts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;

class MtCustomerManagerController extends Controller
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
     * 自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
     /*
    public function codeAutoComplete(Request $request, MtCustomerService $service)
    {
        $datas =  $service->codeAutoComplete($request->input('customer_cd'));
        header('Content-type: application/json');
        return json_encode($datas);
    }
    */
}
