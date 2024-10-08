<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaCheckReturnExport;
use App\Http\Requests\AnaCheckReturn\AnalyseRequest;
use App\Services\AnaCheckReturnService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaCheckReturnController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaCheckReturnService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.detail.check_return.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "返品確認データ" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaCheckReturnExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.detail.check_return.analyse');
        }
        return view('admin.analyse.detail.check_return.analyse', ['commonParams' => $this->commonParams]);
    }
}
