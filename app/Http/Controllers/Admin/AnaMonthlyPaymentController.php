<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaMonthlyPaymentExport;
use App\Http\Requests\AnaMonthlyPayment\AnalyseRequest;
use App\Services\AnaMonthlyPaymentService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaMonthlyPaymentController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaMonthlyPaymentService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.detail.monthly_payment.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "入金集計表(月次)" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaMonthlyPaymentExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.detail.monthly_payment.analyse');
        }
        return view('admin.analyse.detail.monthly_payment.analyse', ['commonParams' => $this->commonParams]);
    }
}
