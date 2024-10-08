<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\MtItemChangeHistoryService;
use App\Services\CommonService;
use App\Http\Requests\MtItemClassChangeHistory\ExportRequest;
use App\Exports\MtItemClassChangeHistoryExport;
use App\Exports\CommonExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use Exception;

class MtItemChangeHistoryController extends Controller
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

    /**
     * 商品変更履歴リスト 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function list(Request $request, CommonService $commonService)
    {
        $itemData = $commonService->searchItem();
        $brand1Data = $commonService->searchBrand1();
        $itemClassThing2Data = $commonService->searchItemClassThing2();
        $genreData = $commonService->searchGenre();
        $itemClassThing4Data = $commonService->searchClass4();
        $itemClassThing5Data = $commonService->searchItemClassThing5();
        $itemClassThing6Data = $commonService->searchItemClassThing6();
        $itemClassThing7Data = $commonService->searchItemClassThing7();
        $managerData = $commonService->searchManager();
		return view('admin.master.other.mt_item_change_history.list', ['commonParams' => $this->commonParams, 'itemData' => $itemData,
            'brand1Data' => $brand1Data, 'itemClassThing2Data' => $itemClassThing2Data, 'genreData' => $genreData,
            'itemClassThing4Data' => $itemClassThing4Data, 'itemClassThing5Data' => $itemClassThing5Data, 'itemClassThing6Data' => $itemClassThing6Data,
            'itemClassThing7Data' => $itemClassThing7Data, 'itemData' => $itemData, 'managerData' => $managerData
        ]);
    }

    /**
     * 商品変更履歴リスト 出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function export(ExportRequest $request, MtItemChangeHistoryService $service)
    {
        if($request->has('cancel')) {
            return back();
		} elseif ($request->has('preview') || $request->has('excel')) {
            $datas = $service->export($request->input());
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "商品変更履歴リスト（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'startItemCode' => $request['item_code_start'] ? str_pad($request['item_code_start'], 9, 0, STR_PAD_LEFT) : '',
                'endItemCode' => $request['item_code_start'] ? str_pad($request['item_code_end'], 9, 0, STR_PAD_LEFT) : 'ZZZZZZZZZ',
                'startDate' => $request['date_year_start'] . '年' . $request['date_month_start'] . '月' . $request['date_day_start'] . '日',
                'endDate' => $request['date_year_end'].'年'. $request['date_month_end'].'月'. $request['date_day_end'].'日',
                'startUserCode' => $request['item_code_start'] ? str_pad($request['code_start'], 4, 0, STR_PAD_LEFT) : '',
                'endUserCode' => $request['item_code_start'] ? str_pad($request['code_end'], 4, 0, STR_PAD_LEFT) : 'ZZZZ',
                'updateDetail' => $request['update_detail'],
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            if ($request->has('preview')) {
                $view = view('export.mt_item_change_history_list_preview', compact('params'));
                return $view;
            } elseif ($request->has('excel')) {
                try {
                    $view = view('export.mt_item_change_history_list', compact('params'));
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        }
		return redirect()->route('master.other.mt_item_change_history.list');
    }

}
