<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaCustomerDeliveryDestinationDataExport;
use App\Http\Requests\AnaCustomerDeliveryDestinationData\AnalyseRequest;
use App\Services\AnaCustomerDeliveryDestinationDataService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaCustomerDeliveryDestinationDataController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaCustomerDeliveryDestinationDataService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.detail.customer_delivery_destination_data.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "共有用納品先データ" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaCustomerDeliveryDestinationDataExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.detail.customer_delivery_destination_data.analyse');
        }
        return view('admin.analyse.detail.customer_delivery_destination_data.analyse', ['commonParams' => $this->commonParams]);
    }
}
