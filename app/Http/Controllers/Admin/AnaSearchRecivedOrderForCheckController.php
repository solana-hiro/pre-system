<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnaSearchRecivedOrderForCheckExport;
use App\Http\Requests\AnaSearchRecivedOrderForCheck\AnalyseRequest;
use App\Services\AnaSearchRecivedOrderForCheckService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class AnaSearchRecivedOrderForCheckController extends Controller
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

    public function analyse(AnalyseRequest $request, AnaSearchRecivedOrderForCheckService $service)
    {
        if ($request->has('search')) {
            session()->flashInput($request->all());
            $data = $service->search($request->input());
            return view('admin.analyse.detail.search_recived_order_for_check.analyse', ['commonParams' => $this->commonParams, 'data' => $data]);
        } elseif ($request->has('csv')) {
            $csvName = "受注伝票検索（管理部17時チェック用）" . Carbon::now()->format('Ymd') . ".csv";
            $csv = new AnaSearchRecivedOrderForCheckExport($request->input());
            return Excel::download($csv, $csvName);
        } elseif ($request->has('cancel')) {
            return redirect()->route('analyse.detail.search_recived_order_for_check.analyse');
        }
        return view('admin.analyse.detail.search_recived_order_for_check.analyse', ['commonParams' => $this->commonParams]);
    }
}
