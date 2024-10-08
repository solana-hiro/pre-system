<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaGrossProfitChartExport;
use App\Http\Requests\AnaGrossProfitChart\AnalyseRequest;
use App\Services\AnaGrossProfitChartService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaGrossProfitChartController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaGrossProfitChartService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.tally.gross_profit_chart.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "得意先別粗利管理表" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaGrossProfitChartExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.tally.gross_profit_chart.analyse');
        }
        return view('admin.analyse.tally.gross_profit_chart.analyse', ['commonParams' => $this->commonParams]);
    }
}
