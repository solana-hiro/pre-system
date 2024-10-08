<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaSearchRecivedOrderExport;
use App\Http\Requests\AnaSearchRecivedOrder\AnalyseRequest;
use App\Services\AnaSearchRecivedOrderService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaSearchRecivedOrderController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaSearchRecivedOrderService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.detail.search_recived_order.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "①受注伝票検索" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaSearchRecivedOrderExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.detail.search_recived_order.analyse');
        }
        return view('admin.analyse.detail.search_recived_order.analyse', ['commonParams' => $this->commonParams]);
    }
}
