<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\TrnOrderHeaderService;
use App\Models\TrnOrderDetail;
use App\Services\CommonService;
use App\Exports\CommonExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use App\Services\TrnOrderDetailService;
use App\Services\MtUserService;
use App\Services\MtSupplierService;
use App\Services\MtSupplierClassService;
use App\Services\DefDepartmentService;

class SearchModalController extends Controller
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

    public function getSearchOrderAll(Request $request, TrnOrderDetailService $service)
    {
        $data = $service->getAll();

        return Response::json([
            'data' => $data,
        ], 200);
    }
    
    public function getSearchOrderWithKeyword(Request $request, TrnOrderDetailService $service)
    {
        $params = $request->input();
        $data = $service->get($params);
        
        return Response::json([
            'data' => $data,
        ], 200);
    }
    
    public function getSearchUserInputIdAll(Request $request, MtUserService $service)
    {
        $data = $service->getAll();
    
        return Response::json([
            'data' => $data,
        ], 200);
    }
    
    public function getSearchUserInputIdWithKeyword(Request $request, MtUserService $service)
    {
        $params = $request->input();
        $data = $service->get($params);
        
        return Response::json([
            'data' => $data,
        ], 200);
    }
    
    
    public function getSearchSupplierAll(Request $request, MtSupplierService $service)
    {
        $data = $service->getAll();
        
        return Response::json([
            'data' => $data,
        ], 200);
    }
    public function getSearchSupplierWithKeyword(Request $request, MtSupplierService $service)
    {
        $params = $request->input();
        $data = $service->get($params);
        
        return Response::json([
            'data' => $data,
        ], 200);
    }
    public function getSearchSupplierClassOneAll(Request $request, MtSupplierClassService $service)
    {
        $data = $service->getAllClass1();
        
        return Response::json([
            'data' => $data,
        ], 200);
    }
    public function getSearchSupplierClassOneWithKeyword(Request $request, MtSupplierClassService $service)
    {
        $params = $request->input();
        $data = $service->getClass1($params);
        
        return Response::json([
            'data' => $data,
        ], 200);
    }

    public function getSearchDepartmentAll(Request $request, DefDepartmentService $service)
    {
        $data = $service->getAll();
        
        return Response::json([
            'data' => $data,
        ], 200);
    }
    public function getSearchDepartmentWithKeyword(Request $request, DefDepartmentService $service)
    {
        $params = $request->input();
        $data = $service->get($params);
        
        return Response::json([
            'data' => $data,
        ], 200);
    }
}

