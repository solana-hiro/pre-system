<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaSearchLargeReceivedOrderExport;
use App\Http\Requests\AnaSearchLargeReceivedOrder\AnalyseRequest;
use App\Services\AnaSearchLargeReceivedOrderService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaSearchLargeReceivedOrderController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaSearchLargeReceivedOrderService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.detail.search_large_received_order.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "大口検索用" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaSearchLargeReceivedOrderExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.detail.search_large_received_order.analyse');
        }
        return view('admin.analyse.detail.search_large_received_order.analyse', ['commonParams' => $this->commonParams]);
    }
}
