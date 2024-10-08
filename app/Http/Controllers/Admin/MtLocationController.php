<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MtLocation\UpdateRequest;
use App\Http\Requests\MtLocation\ExportRequest;
use App\Services\MtLocationService as MtLocationService;
use App\Services\MtWarehouseService as MtWarehouseService;
use App\Services\CommonService as CommonService;
use App\Exports\MtLocationExport;
use App\Exports\CommonExport;
use App\Imports\CommonImport;
use App\Consts\CommonConsts;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class MtLocationController extends Controller
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
     * ロケーションマスタ 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function index()
    {
        return view('admin.master.other.mt_location.index', ['commonParams' => $this->commonParams,]);
    }

    /**
     * ロケーションマスタ 初期表示(倉庫ID指定)
     * @param $request
     * @param $service
     * @return Object
     */
    public function indexById($id, Request $request, MtLocationService $service)
    {
        $data = $service->getByWarehouseId($id);
        return view('admin.master.other.mt_location.index', ['commonParams' => $this->commonParams, 'data' => $data]);
    }

    /**
     * ロケーションマスタ(一覧) 更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(UpdateRequest $request, MtLocationService $service)
    {
        if ($request->has('cancel')) return redirect()->route('master.other.mt_location.index');
        if ($request->has('update')) {
            $result = $service->update($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error") . "<br>" . $result['error'];
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('master.other.mt_location.index')->with('flashmessage', $flashmessage);
            }
        }

        return redirect()->route('master.other.mt_location.index');
    }

    /**
     * ロケーションマスタリスト 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function list(Request $request, MtLocationService $service, CommonService $commonService)
    {
        //倉庫コード初期値設定
        $initWarehouseInfo = $service->getInitWarehouseCd();
        $warehouseData = $commonService->searchWarehouse();
        $itemData = $commonService->searchItem();
        $brand1Data = $commonService->searchBrand1();
        $itemClassThing2Data = $commonService->searchItemClassThing2();
        $genreData = $commonService->searchGenre();
        $itemClassThing4Data = $commonService->searchClass4();
        $itemClassThing5Data = $commonService->searchItemClassThing5();
        $itemClassThing6Data = $commonService->searchItemClassThing6();
        $itemClassThing7Data = $commonService->searchItemClassThing7();
        $colorData = $commonService->searchMtColor();
        $sizeData = $commonService->searchMtSize();
        return view('admin.master.other.mt_location.list', [
            'commonParams' => $this->commonParams,
            'initWarehouseInfo' => $initWarehouseInfo,
            'warehouseData' => $warehouseData,
            'itemData' => $itemData,
            'colorData' => $colorData,
            'sizeData' => $sizeData,
            'brand1Data' => $brand1Data,
            'itemClassThing2Data' => $itemClassThing2Data,
            'genreData' => $genreData,
            'itemClassThing4Data' => $itemClassThing4Data,
            'itemClassThing5Data' => $itemClassThing5Data,
            'itemClassThing6Data' => $itemClassThing6Data,
            'itemClassThing7Data' => $itemClassThing7Data,
        ]);
    }

    /**
     * ロケーションマスタリスト(一覧)  キャンセル・Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function export(ExportRequest $request, MtLocationService $service, MtWarehouseService $mtWarehouseService)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('preview') || $request->has('excel')) {
            $isWarehouse = $mtWarehouseService->isExist($request['warehouse_code']);
            if (!$isWarehouse) {
                $sessionErrors[] = __("validation.error_messages.warehouse_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $datas = $service->export($request->input());
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "ロケーションマスタ（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'warehouseCode' => str_pad($request['warehouse_code'], 6, 0, STR_PAD_LEFT),
                'itemStartCode' => ($request['item_code_start']) ? $request['item_code_start'] : '',
                'itemEndCode' => ($request['item_code_end']) ? $request['item_code_end'] : 'ZZZZZZZZZ',
                'colorStartCode' => ($request['color_code_start']) ? $request['color_code_start'] : '',
                'colorEndCode' => ($request['color_code_end']) ? $request['color_code_end'] : 'ZZZZZ',
                'sizeStartCode' => ($request['size_code_start']) ? $request['size_code_start'] : '',
                'sizeEndCode' => ($request['size_code_end']) ? $request['size_code_end'] : 'ZZZZZ',
                'shelfNumberCode1Start' => ($request['shelf_number_code1_start']) ? $request['shelf_number_code1_start'] : "",
                'shelfNumberCode1End' => ($request['shelf_number_code1_end']) ? $request['shelf_number_code1_end'] : "",
                'shelfNumberCode2Start' => ($request['shelf_number_code2_start']) ? $request['shelf_number_code2_start'] : "",
                'shelfNumberCode2End' => ($request['shelf_number_code2_end']) ? $request['shelf_number_code2_end'] : "",
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];

            if ($request->has('preview')) {
                $view = view('export.mt_location_list_preview', compact('params'));
                return $view;
            } elseif ($request->has('excel')) {
                try {
                    $view = view('export.mt_location_list', compact('params'));
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        }
        return redirect()->route('master.other.mt_location.list');
    }

    /**
     * ロケーションマスタExcel取込 初期表示
     * @param $request
     * @return Object
     */
    public function fileIndex(Request $request)
    {
        return view('admin.master.other.mt_location.file', ['commonParams' => $this->commonParams]);
    }

    /**
     * ロケーションマスタExcel取込 更新
     * @param $request
     * @return Object
     */
    public function fileImport(Request $request, MtLocationService $service)
    {
        if ($request->has('error_output')) {
            //エラー情報が存在するか判定
            if (!$request->session()->has('locationImportError')) {
                return back()->with('errorMessage', __("validation.error_messages.error_is_not_exist"));
            }
            if (empty($request->session()->has('locationImportError'))) {
                return back()->with('errorMessage', __("validation.error_messages.error_is_not_exist"));
            } else {
                //エラーファイル出力
                $errorInfo = $request->session()->get('locationImportError')[0];
                $rows = $request->session()->get('locationImport')[0];
                foreach ($rows as $i => $row) {
                    if (!array_key_exists($i + 1, $errorInfo)) continue;
                    $errorDetail = $errorInfo[$i + 1]->all();
                    foreach ($row as $key => $value) {
                        if (is_numeric($key) && $key >= 51) {
                            unset($row[$key]);
                        }
                    }
                    $rows[$i] = $row;
                    $rows[$i]['エラー内容'] = implode(",", $errorDetail);
                }
                $errorsList = array();
                $j = 1;
                foreach ($errorInfo as $error) {
                    $keys = $error->keys();
                    foreach ($keys as $key) {
                        $errorsList[$j][] = (string)$key;
                    }
                    $j++;
                }
                try {
                    $fileName = "エラーロケーションマスタ.xlsx";
                    $params = [
                        'datas' => $rows,
                        'errorsList' => $errorsList,
                    ];
                    $header = [
                        'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    ];
                    $view = view('export.mt_location_export_list', compact('params'));
                    if ($request->session()->has('locationImportError')) {
                        $request->session()->forget('locationImportError');
                    }
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    Log::error($e);
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        } elseif ($request->has('update')) {
            //ファイルが選択されていない場合
            if ($request->file('import_file') === false) {
                return back()->with('errorMessage', __("validation.error_messages.file_is_not_exist"));
            }
            $file = $request->file('import_file');
            if ($file === null) {
                $flashmessage = __("validation.error_messages.import_file_not_exists");;
                return back()->withInput()->with('flashmessage', $flashmessage);
            }
            if ($file->getClientMimeType() !== 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                $flashmessage = __("validation.error_messages.file_type_is_not_excel");;
                return back()->withInput()->with('flashmessage', $flashmessage);
            }
            try {
                $rows = Excel::toArray(new CommonImport, $file, null, Excels::XLSX);
                $checkFormat = $service->checkImportFormat($rows);
                if ($checkFormat['status'] === CommonConsts::STATUS_ERROR) {
                    // Sessionにエラー内容と入力内容を保存
                    if (isset($checkFormat['rowErrors'])) {
                        $request->session()->put('locationImportError', $checkFormat['rowErrors']);
                        $errormessage = __("validation.error_messages.excel_import_fail");
                    } else {
                        $errormessage = __("validation.error_messages.file_import_pause") . "<br>" . $checkFormat['error'];
                    }
                    $request->session()->put('locationImport', $rows);
                    return back()->withInput()->with('errormessage', $errormessage);
                }
                //UPDATEorINSERT
                $result = $service->importUpdate($rows);
                if ($result['status'] === CommonConsts::STATUS_ERROR) {
                    $errormessage = __("validation.error_messages.update_error") . "<br>" . $result['error'];
                    return back()->withInput()->with('errormessage', $errormessage);
                } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                    if ($request->session()->has('locationImportError')) {
                        $request->session()->forget('locationImportError');
                    }
                    $flashmessage = __("validation.complete_message.update_complete");
                    return redirect()->route('master.other.mt_location.file.index')->with('flashmessage', $flashmessage);
                }
            } catch (Exception $e) {
                Log::error($e);
                $flashmessage = "エラーが発生したため、取込処理を中断します。<br>エラー情報：" . $e->getMessage();
                return back()->withInput()->with('flashmessage', $flashmessage);
            }
        }
        redirect()->route('master.other.mt_location.file.index');
    }

    /**
     * ロケーション　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtLocationService $service)
    {
        $datas =  $service->codeAutoComplete($request->input('location_cd'));
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
