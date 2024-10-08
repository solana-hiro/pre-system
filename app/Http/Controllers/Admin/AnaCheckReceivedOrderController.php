<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaCheckReceivedOrderExport;
use App\Http\Requests\AnaCheckReceivedOrder\AnalyseRequest;
use App\Services\AnaCheckReceivedOrderService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaCheckReceivedOrderController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaCheckReceivedOrderService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.detail.check_received_order.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "受注確認" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaCheckReceivedOrderExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.detail.check_received_order.analyse');
        }
        return view('admin.analyse.detail.check_received_order.analyse', ['commonParams' => $this->commonParams]);
    }
}
