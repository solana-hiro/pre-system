<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaCustomerDataExport;
use Illuminate\Http\Request;
use App\Services\AnaCustomerDataService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaCustomerDataController extends Controller
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

    public function analyse(Request $request, AnaCustomerDataService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.detail.customer_data.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "共有用得意先データ" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaCustomerDataExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.detail.customer_data.analyse');
        }
        return view('admin.analyse.detail.customer_data.analyse', ['commonParams' => $this->commonParams]);
    }
}
