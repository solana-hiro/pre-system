<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaBacklogExport;
use App\Http\Requests\AnaBacklog\AnalyseRequest;
use App\Services\AnaBacklogService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaBacklogController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaBacklogService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.tally.backlog.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "受注残" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaBacklogExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.tally.backlog.analyse');
        }
        return view('admin.analyse.tally.backlog.analyse', ['commonParams' => $this->commonParams]);
    }
}
