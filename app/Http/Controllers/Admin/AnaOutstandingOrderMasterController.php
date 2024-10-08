<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaOutstandingOrderMasterExport;
use App\Http\Requests\AnaOutstandingOrderMaster\AnalyseRequest;
use App\Services\AnaOutstandingOrderMasterService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaOutstandingOrderMasterController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaOutstandingOrderMasterService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.detail.outstanding_order_master.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "発注残マスター" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaOutstandingOrderMasterExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.detail.outstanding_order_master.analyse');
        }
        return view('admin.analyse.detail.outstanding_order_master.analyse', ['commonParams' => $this->commonParams]);
    }
}
