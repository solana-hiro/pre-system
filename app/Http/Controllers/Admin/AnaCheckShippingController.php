<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaCheckShippingExport;
use App\Http\Requests\AnaCheckShipping\AnalyseRequest;
use App\Services\AnaCheckShippingService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaCheckShippingController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaCheckShippingService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.tally.check_shipping.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "当日出荷チェック" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaCheckShippingExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.tally.check_shipping.analyse');
        }
        return view('admin.analyse.tally.check_shipping.analyse', ['commonParams' => $this->commonParams]);
    }
}
