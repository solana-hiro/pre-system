<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\WkInventoryBaseService;
use App\Services\CommonService;
use App\Http\Requests\WkInventoryBase\CheckListRequest;
use App\Http\Requests\WkInventoryBase\SlipRequest;
use App\Http\Requests\WkInventoryBase\DifferenceListRequest;
use App\Http\Requests\WkInventoryBase\UpdateRequest;
use App\Http\Requests\WkInventoryBase\StartRequest;
use App\Http\Requests\WkInventoryBase\EndRequest;
use App\Http\Requests\WkInventoryBase\AssetStockListRequest;
use App\Exports\CommonExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;

class WkInventoryBaseController extends Controller
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
     * 棚卸原票  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showSlip(Request $request, CommonService $commonService)
    {
        $brand1Data = $commonService->searchBrand1();
        $itemClassThing2Data = $commonService->searchItemClassThing2();
        $genreData = $commonService->searchGenre();
        $itemClassThing4Data = $commonService->searchClass4();
        $itemClassThing5Data = $commonService->searchItemClassThing5();
        $itemClassThing6Data = $commonService->searchItemClassThing6();
        $itemClassThing7Data = $commonService->searchItemClassThing7();
        $itemData = $commonService->searchItem();
		return view('admin.stock.wk_inventory_base.slip', ['commonParams' => $this->commonParams, 'brand1Data' => $brand1Data,  'itemClassThing2Data' => $itemClassThing2Data,
            'genreData' => $genreData, 'itemClassThing4Data' => $itemClassThing4Data, 'itemClassThing5Data' => $itemClassThing5Data, 'itemClassThing6Data' => $itemClassThing6Data, 'itemClassThing7Data' => $itemClassThing7Data,
            'itemData' => $itemData
        ]);
    }

    /**
     * 棚卸原票  プレビュー表示・Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportSlip(SlipRequest $request, WkInventoryBaseService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
			//EXCEL
            $param = $request->input();
	        $datas = $service->getSlip($param);
            if ($datas->isEmpty()) {
                return back()->withInput()->with('flashmessage', __("validation.error_messages.data_is_not_exist"));
            }
            $fileName = "棚卸原票_" . Carbon::now()->format('Ymd') . ".xlsx";
            /*
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
            */
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            $view = view('export.slip_list', compact('params'));
		}
        return redirect()->route('stock_management.inventory.slip.index');
    }

    /**
     * 棚卸開始処理  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function indexStart(Request $request, WkInventoryBaseService $service)
    {
        //終了の棚卸ベースワーク.今回棚卸日付の取得(wk_inventory_bases.now_inventory_date)
        $nowInventoryDateInfo = $service->getNowInventoryDateEnd();
        $nowInventoryDate = $nowInventoryDateInfo ? $nowInventoryDateInfo['now_inventory_date'] : Carbon::now();
		return view('admin.stock.wk_inventory_base.start', ['commonParams' => $this->commonParams, 'nowInventoryDate' => $nowInventoryDate]);
    }

    /**
     * 棚卸開始処理  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateStart(StartRequest $request, WkInventoryBaseService $service)
    {
		if($request->has('execute')) {
	        $datas = $service->updateStart($request->input());
	    }
		return view('admin.stock.wk_inventory_base.end', ['commonParams' => $this->commonParams]);
    }

    /**
     * 棚卸計上入力  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showAccountant(Request $request)
    {
		return view('admin.stock.wk_inventory_base.accountant', ['commonParams' => $this->commonParams]);
    }

    /**
     * 棚卸計上入力  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateAccountant(Request $request)
    {
		if($request->has('update')) {
			//$datas = $service->getChecklist($request->input());
		}
		return redirect()->route('stock_management.inventory.accountant.index');
    }

    /**
     * 棚卸チェックリスト  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showChecklist(Request $request, CommonService $commonService)
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
		return view('admin.stock.wk_inventory_base.checkList', ['commonParams' => $this->commonParams, 'brand1Data' => $brand1Data,  'itemClassThing2Data' => $itemClassThing2Data,
            'genreData' => $genreData, 'itemClassThing4Data' => $itemClassThing4Data, 'itemClassThing5Data' => $itemClassThing5Data, 'itemClassThing6Data' => $itemClassThing6Data, 'itemClassThing7Data' => $itemClassThing7Data,
            'warehouseData' => $warehouseData, 'itemData' => $itemData,
        ]);
    }

    /**
     * 棚卸チェックリスト  キャンセル・Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportChecklist(CheckListRequest $request, WkInventoryBaseService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
			//EXCEL
            $param = $request->input();
	        $datas = $service->getChecklist($param);
            if ($datas->isEmpty()) {
                return back()->withInput()->with('flashmessage', __("validation.error_messages.data_is_not_exist"));
            }
            $fileName = "棚卸チェックリスト.xlsx";
            /*
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
            */
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            //帳票区分・出力順ごと
            if ($params['reportKbn'] === '0' && $params['outputKbn'] === '1') {  //商品コード順
                $view = view('export.inventory_checklist_1', compact('params'));
            } else if ($params['reportKbn'] === '0' && $params['outputKbn'] === '2') { //JANコード順
                $view = view('export.inventory_checklist_2', compact('params'));
            }

            if (isset($view) && isset($fileName)) {
                return Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
            }
		}
        return redirect()->route('stock_management.inventory.checklist.index');
    }

    /**
     * 棚卸更新処理  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showUpdate(Request $request, CommonService $commonService)
    {
        $brand1Data = $commonService->searchBrand1();
        $itemClassThing2Data = $commonService->searchItemClassThing2();
        $genreData = $commonService->searchGenre();
        $itemClassThing4Data = $commonService->searchClass4();
        $itemClassThing5Data = $commonService->searchItemClassThing5();
        $itemClassThing6Data = $commonService->searchItemClassThing6();
        $itemClassThing7Data = $commonService->searchItemClassThing7();
        $itemData = $commonService->searchItem();
        $warehouseData = $commonService->searchWarehouse();
		return view('admin.stock.wk_inventory_base.update', ['commonParams' => $this->
            commonParams, 'brand1Data' => $brand1Data,  'itemClassThing2Data' => $itemClassThing2Data,
                'genreData' => $genreData, 'itemClassThing4Data' => $itemClassThing4Data, 'itemClassThing5Data' => $itemClassThing5Data, 'itemClassThing6Data' => $itemClassThing6Data, 'itemClassThing7Data' => $itemClassThing7Data,
                'warehouseData' => $warehouseData, 'itemData' => $itemData
            ]);
    }

    /**
     * 棚卸更新処理  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function execUpdate(UpdateRequest $request, WkInventoryBaseService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('execute')) {
			//実行
	        $datas = $service->update($request->input());
		}
        return redirect()->route('stock_management.inventory.update.index');
    }

    /**
     * 棚卸終了処理  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function indexEnd(Request $request, WkInventoryBaseService $service)
    {
        //実施中の棚卸ベースワーク.今回棚卸日付の取得(wk_inventory_bases.now_inventory_date)
        $nowInventoryDateInfo = $service->getNowInventoryDateNow();
        $nowInventoryDate = $nowInventoryDateInfo ? $nowInventoryDateInfo['now_inventory_date'] : Carbon::now();
		return view('admin.stock.wk_inventory_base.end', ['commonParams' => $this->commonParams, 'nowInventoryDate' => $nowInventoryDate]);
    }

    /**
     * 棚卸終了処理  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateEnd(EndRequest $request, WkInventoryBaseService $service)
    {
		if($request->has('execute')) {
        	$datas = $service->updateEnd($request->input());
        }
        return redirect()->route('stock_management.inventory.end.index');
    }

    /**
     * 棚卸差異表  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showDifferenceList(Request $request, CommonService $commonService)
    {
        $brand1Data = $commonService->searchBrand1();
        $itemClassThing2Data = $commonService->searchItemClassThing2();
        $genreData = $commonService->searchGenre();
        $itemClassThing4Data = $commonService->searchClass4();
        $itemClassThing5Data = $commonService->searchItemClassThing5();
        $itemClassThing6Data = $commonService->searchItemClassThing6();
        $itemClassThing7Data = $commonService->searchItemClassThing7();
        $itemData = $commonService->searchItem();
		return view('admin.stock.wk_inventory_base.differenceList', ['commonParams' => $this->commonParams, 'brand1Data' => $brand1Data,  'itemClassThing2Data' => $itemClassThing2Data,
            'genreData' => $genreData, 'itemClassThing4Data' => $itemClassThing4Data, 'itemClassThing5Data' => $itemClassThing5Data, 'itemClassThing6Data' => $itemClassThing6Data, 'itemClassThing7Data' => $itemClassThing7Data,
            'itemData' => $itemData,
        ]);
    }

    /**
     * 棚卸差異表  キャンセル・Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportDifferenceList(DifferenceListRequest $request, WkInventoryBaseService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
			//EXCEL
            $param = $request->input();
	        $datas = $service->getDifferenceList($param);
            if ($datas->isEmpty()) {
                return back()->withInput()->with('flashmessage', __("validation.error_messages.data_is_not_exist"));
            }
            $fileName = "棚卸差異表.xlsx";
            /*
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
            */
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];

            $view = view('export.stock_difference_list', compact('params'));
            if (isset($view) && isset($fileName)) {
                return Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
            }
		}
        return redirect()->route('stock_management.inventory.difference.list.index');
    }

    /**
     * 棚卸EXCEL取込  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showImport(Request $request, CommonService $commonService)
    {
		return view('admin.stock.wk_inventory_base.import', ['commonParams' => $this->commonParams]);
    }

    /**
     * 棚卸EXCEL取込  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateImport(Request $request, WkInventoryBaseService $service)
    {
        if ($request->has('cancel')) {
            return redirect()->route('stock_management.inventory.import.index');
        } elseif ($request->has('error_output')) {
            //エラー情報が存在するか判定


        } elseif ($request->has('execute')) {
            //ファイルが選択されていない場合
            if ($request->file('import_file') === false) {
                return back()->with('errorMessage', __("validation.error_messages.file_is_not_exist"));
            }
            $file = $request->file('import_file');
            $rows = Excel::toArray(new CommonImport, $file, null, Excels::XLSX);
            $checkFormat = $service->checkImportFormat($rows);
            $result = $service->importUpdate($rows);
            return back()->withInput();
        }
        return redirect()->route('stock_management.inventory.import.index');
    }

    /**
     * 資産在庫表  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showAssetStockList(Request $request, CommonService $commonService)
    {
        $brand1Data = $commonService->searchBrand1();
        $itemClassThing2Data = $commonService->searchItemClassThing2();
        $genreData = $commonService->searchGenre();
        $itemClassThing4Data = $commonService->searchClass4();
        $itemClassThing5Data = $commonService->searchItemClassThing5();
        $itemClassThing6Data = $commonService->searchItemClassThing6();
        $itemClassThing7Data = $commonService->searchItemClassThing7();
        $itemData = $commonService->searchItem();
		return view('admin.stock.wk_inventory_base.assetStockList', ['commonParams' => $this->commonParams, 'brand1Data' => $brand1Data,  'itemClassThing2Data' => $itemClassThing2Data,
            'genreData' => $genreData, 'itemClassThing4Data' => $itemClassThing4Data, 'itemClassThing5Data' => $itemClassThing5Data, 'itemClassThing6Data' => $itemClassThing6Data, 'itemClassThing7Data' => $itemClassThing7Data,
            'itemData' => $itemData,
        ]);
    }

    /**
     * 資産在庫表  キャンセル・Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportAssetStockList(AssetStockListRequest $request, WkInventoryBaseService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
			//EXCEL
            $param = $request->input();
	        $datas = $service->getAssetStockList($param);
            if ($datas->isEmpty()) {
                return back()->withInput()->with('flashmessage', __("validation.error_messages.data_is_not_exist"));
            }
            $fileName =
            "資産在庫表_" . Carbon::now()->format('Ymd') . ".xlsx";
            /*
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
            */
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];

            $view = view('export.asset_stock_list', compact('params'));
            if (isset($view) && isset($fileName)) {
                return Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
            }
		}
        return redirect()->route('stock_management.analysis.asset_stock.list.index');
    }

}
