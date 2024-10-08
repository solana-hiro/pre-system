<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaCheckOutstandingOrderAndBacklogExport;
use App\Http\Requests\AnaCheckOutstandingOrderAndBacklog\AnalyseRequest;
use App\Services\AnaCheckOutstandingOrderAndBacklogService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaCheckOutstandingOrderAndBacklogController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaCheckOutstandingOrderAndBacklogService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.tally.check_outstanding_order_and_backlog.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "発注残受注残チェック" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaCheckOutstandingOrderAndBacklogExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.tally.check_outstanding_order_and_backlog.analyse');
        }
        return view('admin.analyse.tally.check_outstanding_order_and_backlog.analyse', ['commonParams' => $this->commonParams]);
    }
}
