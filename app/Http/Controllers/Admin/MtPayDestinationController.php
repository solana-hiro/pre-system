<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MtPayDestination\SearchRequest;
use App\Services\MtPayDestinationService as MtPayDestinationService;
use App\Services\MtSupplierService as MtSupplierService;
use Illuminate\Support\Facades\Log;

class MtPayDestinationController extends Controller
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
    public function codeAutoComplete(Request $request, MtPayDestinationService $service)
    {
        $datas =  $service->codeAutoComplete($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
