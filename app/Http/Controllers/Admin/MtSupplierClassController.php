<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MtSupplierClass\MtSupplierClassUpdateRequest;
use App\Http\Requests\MtSupplierClass\MtSupplierClassListRequest;
use App\Services\MtSupplierClassService as MtSupplierClassService;
use App\Services\CommonService as CommonService;
use App\Exports\MtSupplierClassExport;
use App\Exports\CommonExport;
use App\Consts\CommonConsts;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class MtSupplierClassController extends Controller
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
     * 仕入先分類入力(一覧) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function index(Request $request, MtSupplierClassService $service, CommonService $commonService)
    {
        $initData = $service->getInitData();
        $defSupplierClassThingId = '1';
        if ($request->session()->has('def_supplier_class_thing_id')) {
            $defSupplierClassThingId = $request->session()->get('def_supplier_class_thing_id');
        }
        return view('admin.master.supplier.mt_supplier_class.index', [
            'commonParams' => $this->commonParams,
            'initData' => $initData,
            'defSupplierClassThingId' => $defSupplierClassThingId,
        ]);
    }

    /**
     * 仕入先分類入力(一覧) 更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(MtSupplierClassUpdateRequest $request, MtSupplierClassService $service)
    {
        if ($request->has('cancel')) {
            if ($request->session()->has('def_supplier_class_thing_id')) {
                $request->session()->forget('def_supplier_class_thing_id');
            }
            return back();
        } elseif ($request->has('update')) {
            if (null !== $request->input('def_supplier_class_thing_id')) {
                $request->session()->put('def_supplier_class_thing_id', $request->input('def_supplier_class_thing_id'));
            }
            $result = $service->update($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                if (str_contains($result['error'], 'SQLSTATE[23000]')) {
                    $errormessage = __("validation.error_messages.update_constraint_key_error");
                } else {
                    $errormessage = __("validation.error_messages.update_error");
                }
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('master.supplier.mt_supplier_class.index')->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('delete')) {
            if (null !== $request->input('def_supplier_class_thing_id')) {
                $request->session()->put('def_supplier_class_thing_id', $request->input('def_supplier_class_thing_id'));
            }
            $result = $service->delete($request->input('delete'));
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                if (str_contains($result['error'], 'SQLSTATE[23000]')) {
                    $errormessage = __("validation.error_messages.delete_constraint_key_error");
                } else {
                    $errormessage = __("validation.error_messages.delete_error");
                }
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.delete_complete");
                return redirect()->route('master.supplier.mt_supplier_class.index')->with('flashmessage', $flashmessage);
            }
        }
        return redirect()->route('master.supplier.mt_supplier_class.index');
    }

    /**
     * 仕入先分類リスト(一覧) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function list(Request $request, CommonService $commonService)
    {
        $supplierClass1Data = $commonService->searchClass1();
        $supplierClass2Data = $commonService->searchClass2();
        $supplierClass3Data = $commonService->searchClass3();
        return view('admin.master.supplier.mt_supplier_class.list', [
            'commonParams' => $this->commonParams,
            'supplierClass1Data' => $supplierClass1Data,
            'supplierClass2Data' => $supplierClass2Data,
            'supplierClass3Data' => $supplierClass3Data
        ]);
    }

    /**
     * 仕入先分類リスト(一覧) 出力(Excel)
     * @param $request
     * @param $service
     * @return Object
     */
    public function export(MtSupplierClassListRequest $request, MtSupplierClassService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('preview') || $request->has('excel')) {
            $supplierClassThingId = $request->input()['supplier_class_thing_id'];
            $param = $request->input();
            $datas = $service->export($param);
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $startCode = '';
            $endCode = 'ZZZZZZ';
            if ($supplierClassThingId === '1') {
                $fileName = "仕入先分類1マスタ（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
                $startCode = (isset($param['code1_start'])) ? $param['code1_start'] : '';
                $endCode = (isset($param['code1_end'])) ? $param['code1_end'] : 'ZZZZZZ';
            } elseif ($supplierClassThingId === '2') {
                $fileName = "仕入先分類2マスタ（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
                $startCode = (isset($param['code2_start'])) ? $param['code2_start'] : '';
                $endCode = (isset($param['code2_end'])) ? $param['code2_end'] : 'ZZZZZZ';
            } elseif ($supplierClassThingId === '3') {
                $fileName = "仕入先分類3マスタ（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
                $startCode = (isset($param['code3_start'])) ? $param['code3_start'] : '';
                $endCode = (isset($param['code3_end'])) ? $param['code3_end'] : 'ZZZZZZ';
            }
            $params = [
                'supplier_class_thing_id' => $supplierClassThingId,
                'startCode' => $startCode,
                'endCode' => $endCode,
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];

            if ($request->has('preview')) {
                if ($supplierClassThingId == 1) {
                    $view = view('export.mt_supplier_class_list_1_preview', compact('params'));
                } elseif ($supplierClassThingId == 2) {
                    $view = view('export.mt_supplier_class_list_2_preview', compact('params'));
                } elseif ($supplierClassThingId == 3) {
                    $view = view('export.mt_supplier_class_list_3_preview', compact('params'));
                }
                return $view;
            } elseif ($request->has('excel')) {
                try {
                    if ($supplierClassThingId == 1) {
                        $view = view('export.mt_supplier_class_list_1', compact('params'));
                    } elseif ($supplierClassThingId == 2) {
                        $view = view('export.mt_supplier_class_list_2', compact('params'));
                    } elseif ($supplierClassThingId == 3) {
                        $view = view('export.mt_supplier_class_list_3', compact('params'));
                    }
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        }
        return redirect()->route('master.supplier.mt_supplier_class.list');
    }

    /**
     * 仕入先分類1検索
     * @param $request
     * @param $service
     * @return Object
     */
    public function searchClass1(Request $request, MtSupplierClassService $service)
    {
        $datas =  $service->getClass1($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 仕入先分類2検索
     * @param $request
     * @param $service
     * @return Object
     */
    public function searchClass2(Request $request, MtSupplierClassService $service)
    {
        $datas =  $service->getClass2($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 仕入先分類3検索
     * @param $request
     * @param $service
     * @return Object
     */
    public function searchClass3(Request $request, MtSupplierClassService $service)
    {
        $datas =  $service->getClass3($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 仕入先分類入力　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtSupplierClassService $service)
    {
        $datas =  $service->codeAutoComplete($request->input('supplier_class_cd'), $request->input('def_supplier_class_thing_id'));
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
