<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaPaymentByCustomerExport;
use App\Http\Requests\AnaPaymentByCustomer\AnalyseRequest;
use App\Services\AnaPaymentByCustomerService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaPaymentByCustomerController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaPaymentByCustomerService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.detail.payment_by_customer.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "入金明細表（得意先別）" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaPaymentByCustomerExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.detail.payment_by_customer.analyse');
        }
        return view('admin.analyse.detail.payment_by_customer.analyse', ['commonParams' => $this->commonParams]);
    }
}
