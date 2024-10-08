<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaSearchSaleExport;
use App\Http\Requests\AnaSearchSale\AnalyseRequest;
use App\Services\AnaSearchSaleService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaSearchSaleController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaSearchSaleService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.detail.search_sale.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "②売上伝票検索" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaSearchSaleExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.detail.search_sale.analyse');
        }
        return view('admin.analyse.detail.search_sale.analyse', ['commonParams' => $this->commonParams]);
    }
}
