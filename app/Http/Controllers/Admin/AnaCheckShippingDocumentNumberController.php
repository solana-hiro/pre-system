<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaCheckShippingDocumentNumberExport;
use App\Http\Requests\AnaCheckShippingDocumentNumber\AnalyseRequest;
use App\Services\AnaCheckShippingDocumentNumberService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaCheckShippingDocumentNumberController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaCheckShippingDocumentNumberService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.tally.check_shipping_document_number.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "当日分送り状No.チェック用データ" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaCheckShippingDocumentNumberExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.tally.check_shipping_document_number.analyse');
        }
        return view('admin.analyse.tally.check_shipping_document_number.analyse', ['commonParams' => $this->commonParams]);
    }
}
