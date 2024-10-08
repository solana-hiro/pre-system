<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\CommonService as CommonService;
use App\Services\MtCustomerDeliveryDestinationService as MtCustomerDeliveryDestinationService;
use App\Exports\CommonExport;
use App\Consts\CommonConsts;
use App\Http\Requests\MtUser\UpdateMaintenanceRequest;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class MtCustomerDeliveryDestinationController extends Controller
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
    public function codeAutoComplete(Request $request, MtCustomerDeliveryDestinationService $service)
    {
        $datas =  $service->codeAutoComplete($request->input('customer_cd'), $request->input('delivery_destination_cd'));
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
