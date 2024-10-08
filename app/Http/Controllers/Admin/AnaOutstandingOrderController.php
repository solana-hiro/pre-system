<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaOutstandingOrderExport;
use App\Http\Requests\AnaOutstandingOrder\AnalyseRequest;
use App\Services\AnaOutstandingOrderService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaOutstandingOrderController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaOutstandingOrderService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.tally.outstanding_order.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "発注残" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaOutstandingOrderExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.tally.outstanding_order.analyse');
        }
        return view('admin.analyse.tally.outstanding_order.analyse', ['commonParams' => $this->commonParams]);
    }
}
