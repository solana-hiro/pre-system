<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\TrnInOutHeaderService;
use App\Services\CommonService;
use App\Http\Requests\TrnInOutHeader\InoutCheckListRequest;
use App\Http\Requests\TrnInOutHeader\WarehouseListRequest;
use App\Http\Requests\TrnInOutHeader\ListRequest;
use App\Http\Requests\TrnInOutHeader\StockMovingImportRequest;
use App\Exports\CommonExport;
use App\Repositories\TrnInOutHeader\TrnInOutHeaderRepository;
use App\Services\DefInOutKbnService;
use App\Services\TrnInOutBreakdownService;
use App\Services\TrnInOutDetailService;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

class TrnInOutHeaderController extends Controller
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
     * 入出庫ヘッダー　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, TrnInOutHeaderService $service)
    {
        $datas = $service->codeAutoComplete($request->input('trn_order_header_id'));
        header('Content-type: application/json');
        return json_encode($datas);
    }
    public function lastInOutNo(Request $request, TrnInOutHeaderService $service)
    {
        $data = $service->lastInOutNo();
        header('Content-type: application/json');
        return json_encode($data);
    }

    /**
     * 入出庫入力  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showInoutInput(Request $request, TrnInOutHeaderRepository $trnInOutHeaderRepository)
    {
        $inoutInputData = $trnInOutHeaderRepository->getInputDefaultData();
        return view('admin.stock.trn_in_out_header.inoutInput', ['commonParams' => $this->commonParams, 'in_out_default_data' => $inoutInputData]);
    }

    /**
     * 得意先入力(詳細) 初期表示(ID指定)
     * @param $request
     * @param $service
     * @return Object
     */
    public function showInoutById($id, Request $request, TrnInOutHeaderRepository $trnInOutHeaderRepository)
    {

        $inoutInputData = $trnInOutHeaderRepository->getInputDefaultDataById($id);
        return view('admin.stock.trn_in_out_header.inoutInput', ['commonParams' => $this->commonParams, 'in_out_default_data' => $inoutInputData]);
    }


    /**
     * 入出庫入力  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateInoutInput(Request $request, TrnInOutHeaderService $trnInOutHeaderService, TrnInOutDetailService $trnInOutDetailService, TrnInOutBreakdownService $trnInOutBreakdownService)
    {
        $params = $request->input();
        DB::beginTransaction();
        try {
            if ($request->has('cancel')) {
                return redirect()->route('stock_management.stock.in_out.input.index');
            } elseif ($request->has('prev')) {
                $result = $trnInOutHeaderService->getPrevByCode($params);
                if (isset($result)) {
                    return redirect()->route('stock_management.stock.in_out.input.showById', ['id' => $result->id]);
                }
            } elseif ($request->has('next')) {
                $result = $trnInOutHeaderService->getNextByCode($params);
                if (isset($result)) {
                    return redirect()->route('stock_management.stock.in_out.input.showById', ['id' => $result->id]);
                }
            } elseif ($request->has('redirect')) {
                $in_out_number = $request->input('redirect');
                return redirect()->route('stock_management.stock.in_out.input.showById', ['id' => $in_out_number]);
            } elseif ($request->has('delete')) {
                $result = $trnInOutHeaderService->deleteByCode($params['trn_in_out_header']['id']);
                return redirect()->route('stock_management.stock.in_out.input.index');
            } elseif ($request->has('update')) {
                $trnInOutHeader = $trnInOutHeaderService->updateInOutData($params);
                if ($trnInOutHeader) {
                    if (isset($params['trn_in_out_details'])) {
                        foreach ($params['trn_in_out_details'] as $key => $value) {
                            $trnInOutDetail = $trnInOutDetailService->updateInOutData($value, $trnInOutHeader->id, $key);
                            if ($trnInOutDetail && $value['breakdowns']) {
                                $breakdowns = json_decode($value['breakdowns']);
                                $trnInOutBreakdownService->updateInOutData($breakdowns, $trnInOutDetail->id);
                            }
                        }
                    } else {
                        return redirect()->back()->withErrors(['error' => '入出庫明細データがありません。']);
                    }
                    if (isset($params['deleted_details'])) {
                        foreach ($params['deleted_details'] as $value) {
                            $trnInOutBreakdownService->deleteInOutData($value);
                            $trnInOutDetailService->deleteInOutData($value);
                        }
                    }
                }
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect()->back()->with('flashmessage', '入出庫データを更新しました。');
    }

    /**
     * 入出庫チェックリスト  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showInoutChecklist(Request $request, DefInOutKbnService $defInOutKbnService)
    {
        $inOutKbnData = $defInOutKbnService->getAll();
        return view('admin.stock.trn_in_out_header.inoutCheckList', ['commonParams' => $this->commonParams, 'inOutKbnData' => $inOutKbnData]);
    }

    /**
     * 入出庫チェックリスト Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportInoutChecklist(InoutCheckListRequest $request, TrnInOutHeaderService $service)
    {
        $param = $request->input();
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('excel')) {
            //EXCEL
            $datas = $service->getInoutChecklist($param);
            if ($datas->isEmpty()) {
                return back()->withInput()->with('flashmessage', __("validation.error_messages.data_is_not_exist"));
            }
            $fileName = "入出庫チェックリスト（日記帳）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'reportKbn' => $param['report_kbn'],
                'outputKbn' => $param['output_kbn'],
                'startDate' => $param['date_year_start'] . '年' . $param['date_month_start'] . '月' . $param['date_day_start'] . '日',
                'endDate' => $param['date_year_end'] . '年' . $param['date_month_end'] . '月' . $param['date_day_end'] . '日',
                'processKbn' => $param['process_kbn'],
                'userCdStart' => isset($param['user_cd_start']) ? str_pad($param['user_cd_start'], 4, 0, STR_PAD_LEFT) : '',
                'userCdEnd' => isset($param['user_cd_end']) ? str_pad($param['user_cd_end'], 4, 0, STR_PAD_LEFT) : 'ZZZZ',
                'warehouseCdStart' => isset($param['warehouse_cd_start']) ? str_pad($param['warehouse_cd_start'], 6, 0, STR_PAD_LEFT) : '',
                'warehouseCdEnd' => isset($param['warehouse_cd_end']) ? str_pad($param['warehouse_cd_end'], 6, 0, STR_PAD_LEFT) : 'ZZZZZZ',
                'inOutKbnCd' => $param['in_out_kbn_cd'],
                'itemCdStart' => isset($param['item_cd_start']) ? str_pad($param['item_cd_start'], 13, 0, STR_PAD_LEFT) : '',
                'itemCdEnd' => isset($param['item_cd_end']) ? str_pad($param['item_cd_end'], 13, 0, STR_PAD_LEFT) : 'ZZZZZZZZZZZZZ',
                'inOutNumberStart' => isset($param['in_out_number_start']) ? str_pad($param['in_out_number_start'], 8, 0, STR_PAD_LEFT) : '',
                'inOutNumberEnd' => isset($param['in_out_number_end']) ? str_pad($param['in_out_number_end'], 8, 0, STR_PAD_LEFT) : 'ZZZZZZZZ',
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            //帳票区分・出力順ごと
            if ($params['reportKbn'] === '0' && $params['outputKbn'] === '1') {  //帳票区分0：商品単位　出力順1:入力日付+処理区分+伝票No
                $view = view('export.in_out_checklist_1', compact('params'));
            } else if ($params['reportKbn'] === '0' && $params['outputKbn'] === '2') { //帳票区分0：商品単位　出力順2:伝票日付+伝票No順
                $view = view('export.in_out_checklist_2', compact('params'));
            } else if ($params['reportKbn'] === '1' && $params['outputKbn'] === '2') { //帳票区分1：SKU単位　出力順1：入力日付+処理区分+伝票No順
                $view = view('export.in_out_checklist_3', compact('params'));
            } else if ($params['reportKbn'] === '1' && $params['outputKbn'] === '2') { //帳票区分1：SKU単位　出力順2:伝票日付+伝票No
                $view = view('export.in_out_checklist_4', compact('params'));
            }

            if (isset($view) && isset($fileName)) {
                return Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
            } else {
                return redirect()->route('stock_management.stock.in_out.checklist.index');
            }
        }
    }

    /**
     * 在庫一覧表  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showList(Request $request, CommonService $commonService)
    {
        $brand1Data = $commonService->searchBrand1();
        $itemClassThing2Data = $commonService->searchItemClassThing2();
        $genreData = $commonService->searchGenre();
        $itemClassThing4Data = $commonService->searchClass4();
        $itemClassThing5Data = $commonService->searchItemClassThing5();
        $itemClassThing6Data = $commonService->searchItemClassThing6();
        $itemClassThing7Data = $commonService->searchItemClassThing7();
        $itemData = $commonService->searchItem();
        return view('admin.stock.trn_in_out_header.list', [
            'commonParams' => $this->commonParams,
            'brand1Data' => $brand1Data,
            'itemClassThing2Data' => $itemClassThing2Data,
            'genreData' => $genreData,
            'itemClassThing4Data' => $itemClassThing4Data,
            'itemClassThing5Data' => $itemClassThing5Data,
            'itemClassThing6Data' => $itemClassThing6Data,
            'itemClassThing7Data' => $itemClassThing7Data,
            'itemData' => $itemData
        ]);
    }

    /**
     * 在庫一覧表  Excel出力・キャンセル
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportList(ListRequest $request, TrnInOutHeaderService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('excel')) {
            //EXCEL
            $param = $request->input();
            $datas = $service->getList($param);
            if ($datas->isEmpty()) {
                return back()->withInput()->with('flashmessage', __("validation.error_messages.data_is_not_exist"));
            }
            $params = [
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];

            //出力順ごと
            if ($params['output_kbn'] === '1') {  //商品別
                $fileName = "在庫一覧表_" . Carbon::now()->format('Ymd') . ".xlsx";
                $view = view('export.stock_list_1', compact('params'));
            } else if ($params['output_kbn'] === '2') { //カラー別サイズ別
                $fileName = "カラー別サイズ別在庫一覧表_" . Carbon::now()->format('Ymd') . ".xlsx";
                $view = view('export.stock_list_2', compact('params'));
            }

            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            if (isset($view) && isset($fileName)) {
                return Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
            }
        }
        return redirect()->route('stock_management.stock.list.index');
    }

    /**
     * 商品別倉庫別在庫一覧表  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showWarehouseList(Request $request, CommonService $commonService)
    {
        $brand1Data = $commonService->searchBrand1();
        $itemClassThing2Data = $commonService->searchItemClassThing2();
        $genreData = $commonService->searchGenre();
        $itemClassThing4Data = $commonService->searchClass4();
        $itemClassThing5Data = $commonService->searchItemClassThing5();
        $itemClassThing6Data = $commonService->searchItemClassThing6();
        $itemClassThing7Data = $commonService->searchItemClassThing7();
        $warehouseData = $commonService->searchWarehouse();
        $itemData = $commonService->searchItem();
        $colorData = $commonService->searchMtColor();
        $sizeData = $commonService->searchMtSize();
        return view('admin.stock.trn_in_out_header.warehouseList', [
            'commonParams' => $this->commonParams,
            'brand1Data' => $brand1Data,
            'itemClassThing2Data' => $itemClassThing2Data,
            'genreData' => $genreData,
            'itemClassThing4Data' => $itemClassThing4Data,
            'itemClassThing5Data' => $itemClassThing5Data,
            'itemClassThing6Data' => $itemClassThing6Data,
            'itemClassThing7Data' => $itemClassThing7Data,
            'warehouseData' => $warehouseData,
            'itemData' => $itemData,
            'colorData' => $colorData,
            'sizeData' => $sizeData
        ]);
    }

    /**
     * 商品別倉庫別在庫一覧表  Excel出力・キャンセル
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportWarehouseList(WarehouseListRequest $request, TrnInOutHeaderService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('excel')) {
            //EXCEL
            $param = $request->input();
            $datas = $service->getWarehouseList($param);
            if ($datas->isEmpty()) {
                return back()->withInput()->with('flashmessage', __("validation.error_messages.data_is_not_exist"));
            }
            $params = [
                'targetDate' => $param['year'] . '年' . $param['month'] . '月' . $param['day'] . '日',
                'outputKbn' => $param['output_kbn'],
                'itemClass' => $param['item_class'],
                'itemClassCdStart' => isset($param['item_class_start']) ? str_pad($param['item_class_start'], 6, 0, STR_PAD_LEFT) : '',
                'itemClassCdEnd' => isset($param['item_class_end']) ? str_pad($param['item_class_end'], 6, 0, STR_PAD_LEFT) : 'ZZZZZZ',
                'itemCdStart' => isset($param['item_cd_start']) ? str_pad($param['item_cd_start'], 13, 0, STR_PAD_LEFT) : '',
                'itemCdEnd' => isset($param['item_cd_end']) ? str_pad($param['item_cd_end'], 13, 0, STR_PAD_LEFT) : 'ZZZZZZZZZZZZZ',
                'warehouseCdStart' => isset($param['warehouse_cd_start']) ? str_pad($param['warehouse_cd_start'], 6, 0, STR_PAD_LEFT) : '',
                'warehouseCdEnd' => isset($param['warehouse_cd_end']) ? str_pad($param['warehouse_cd_end'], 6, 0, STR_PAD_LEFT) : 'ZZZZZ',
                'colorCdStart' => isset($param['color_code_start']) ? str_pad($param['color_code_start'], 5, 0, STR_PAD_LEFT) : '',
                'colorCdEnd' => isset($param['color_code_end']) ? str_pad($param['color_code_end'], 5, 0, STR_PAD_LEFT) : 'ZZZZZ',
                'sizeCdStart' => isset($param['size_code_start']) ? str_pad($param['size_code_start'], 5, 0, STR_PAD_LEFT) : '',
                'sizeCdEnd' => isset($param['size_code_end']) ? str_pad($param['size_code_end'], 5, 0, STR_PAD_LEFT) : 'ZZZZZ',
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            //出力条件ごと
            $fileName = "";
            if ($params['output_kbn'] === '1') {  //商品別
                $fileName = "商品別倉庫別在庫一覧表_" . Carbon::now()->format('Ymd') . ".xlsx";
                $view = view('export.warehouse_list_1', compact('params'));
            } else if ($params['output_kbn'] === '2') {  //カラー別・サイズ別
                $fileName = "カラー別サイズ別商品別倉庫在庫一覧表_" . Carbon::now()->format('Ymd') . ".xlsx";
                $view = view('export.warehouse_list_2', compact('params'));
            }
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];

            if (isset($view) && isset($fileName)) {
                return Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
            } else {
                return redirect()->route('master.other.mt_bank.list');
            }

        }
        return view('admin.stock.trn_in_out_header.warehouseList', ['commonParams' => $this->commonParams]);
    }

    /**
     * 在庫データ書き出し  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showDataOutput(Request $request)
    {
        return view('admin.stock.trn_in_out_header.dataOutput', ['commonParams' => $this->commonParams]);
    }

    /**
     * 在庫データ書出し  Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportDataOutput(Request $request, TrnInOutHeaderService $service)
    {
        $datas = $service->getDataOutput($request->input());
        if ($datas->isEmpty()) {
            return back()->withInput()->with('flashmessage', __("validation.error_messages.data_is_not_exist"));
        }
        $fileName = "StockData.xlsx";
        $params = [
            'datas' => $datas,
        ];
        $header = [
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];
        $view = view('export.stock_data_output', compact('params'));
        if (isset($view) && isset($fileName)) {
            return Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
        }
        return redirect()->route('stock_management.stock.data.output.export');
    }

    /**
     * 在庫移動EXCEL取込  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showStockMovingImport(Request $request)
    {
        return view('admin.stock.trn_in_out_header.stockMovingImport', ['commonParams' => $this->commonParams]);
    }

    /**
     * 在庫移動EXCEL取込  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateStockMovingImport(StockMovingImportRequest $request)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('error')) {
            //エラー結果取込
            //$datas = $service->getList($request->input());
        } elseif ($request->has('file')) {
            //エラー結果取込
            //$datas = $service->getList($request->input());
        } elseif ($request->has('update')) {
            //実行
            //$datas = $service->getList($request->input());
        }
        return redirect()->route('stock_management.stock.stock_moving.import.index');
    }

    /**
     * 入出庫データ取込  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function indexInOutDataImport(Request $request)
    {
        return view('admin.alignment.keyence.inoutDataImport', ['commonParams' => $this->commonParams]);
    }

    /**
     * 入出庫データ取込  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateInOutDataImport(Request $request, TrnInOutHeaderService $service)
    {
        //TODO request
        //条件分岐
        $datas = $service->updateInOutDataImport($request->input());
        //プレビュー表示
        //$datas =  $service->exportPreviewInOutDataImport($request->input());
        return view('admin.alignment.keyence.inoutDataImport', ['commonParams' => $this->commonParams]);
    }

}
