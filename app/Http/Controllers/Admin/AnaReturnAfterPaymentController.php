<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaReturnAfterPaymentExport;
use App\Http\Requests\AnaReturnAfterPayment\AnalyseRequest;
use App\Services\AnaReturnAfterPaymentService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaReturnAfterPaymentController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaReturnAfterPaymentService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.detail.return_after_payment.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "入金後返品チェックリスト" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaReturnAfterPaymentExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.detail.return_after_payment.analyse');
        }
        return view('admin.analyse.detail.return_after_payment.analyse', ['commonParams' => $this->commonParams]);
    }
}
