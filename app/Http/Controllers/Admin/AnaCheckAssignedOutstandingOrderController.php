<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaCheckAssignedOutstandingOrderExport;
use App\Http\Requests\AnaCheckAssignedOutstandingOrder\AnalyseRequest;
use App\Services\AnaCheckAssignedOutstandingOrderService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaCheckAssignedOutstandingOrderController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaCheckAssignedOutstandingOrderService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.detail.check_assigned_outstanding_order.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "発注残割当確認" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaCheckAssignedOutstandingOrderExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.detail.check_assigned_outstanding_order.analyse');
        }
        return view('admin.analyse.detail.check_assigned_outstanding_order.analyse', ['commonParams' => $this->commonParams]);
    }
}
