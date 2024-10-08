<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaBacklogWithoutLocationExport;
use App\Http\Requests\AnaBacklogWithoutLocation\AnalyseRequest;
use App\Services\AnaBacklogWithoutLocationService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaBacklogWithoutLocationController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaBacklogWithoutLocationService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.detail.backlog_without_location.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "ロケーション無受注残リスト" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaBacklogWithoutLocationExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.detail.backlog_without_location.analyse');
        }
        return view('admin.analyse.detail.backlog_without_location.analyse', ['commonParams' => $this->commonParams]);
    }
}
