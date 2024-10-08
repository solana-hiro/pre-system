<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MtCustomerClass\MtCustomerClassRequest;
use App\Http\Requests\MtCustomerClass\MtCustomerClassExportRequest;
use App\Http\Requests\MtCustomerClass\MtCustomerClassUpdateRequest;
use App\Http\Requests\MtCustomer\MtCustomerExportRequest;
use App\Services\MtCustomerClassService as MtCustomerClassService;
use App\Services\CommonService as CommonService;
use App\Exports\MtCustomerClassExport;
use App\Exports\CommonExport;
use App\Consts\CommonConsts;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class MtCustomerClassController extends Controller
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
     * 得意先分類入力(一覧) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function index(Request $request, MtCustomerClassService $service, CommonService $commonService)
    {
        $initData = $service->getInitData();
        $defCustomerClassThingId = '1';
        if ($request->session()->has('def_customer_class_thing_id')) {
            $defCustomerClassThingId = $request->session()->get('def_customer_class_thing_id');
        }
		return view('admin.master.customer.mt_customer_class.index', [
            'commonParams' => $this->commonParams,
            'initData' => $initData,
            'defCustomerClassThingId' => $defCustomerClassThingId,
        ]);
    }

    /**
     * 得意先分類入力(一覧) 更新
     * @param $request
     * @param $service MtCustomerClassUpdateRequest
     * @return Object
     */
    public function update(MtCustomerClassUpdateRequest $request, MtCustomerClassService $service)
    {
        if($request->has('cancel')) {
            if ($request->session()->has('def_customer_class_thing_id')) {
                $request->session()->forget('def_customer_class_thing_id');
            }
            return back();
        } elseif($request->has('update')) {
            if (null !== $request->input('def_customer_class_thing_id')) {
                $request->session()->put('def_customer_class_thing_id', $request->input('def_customer_class_thing_id'));
            }
        	$result = $service->update($request->input());
            if($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error").'<br><br>'. $result['error'];
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('master.customer.mt_customer_class.index')->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('delete')) {
            if (null !== $request->input('def_customer_class_thing_id')) {
                $request->session()->put('def_customer_class_thing_id', $request->input('def_customer_class_thing_id'));
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
                return redirect()->route('master.customer.mt_customer_class.index')->with('flashmessage', $flashmessage);
            }
        }
        return redirect()->route('master.customer.mt_customer_class.index');
    }

    /**
     * 得意先分類入力(一覧) 削除
     * @param $request
     * @param $service
     * @return Object
     */
    public function delete($id, MtCustomerClassService $service)
    {
        $result = $service->delete($id);
		return redirect()->route('master.customer.mt_customer_class.index');
    }

    /**
     * 得意先分類リスト(一覧) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function list(Request $request, CommonService $commonService)
    {
        $customerClass1Data = $commonService->searchCustomerClassThing();
        $customerClass2Data = $commonService->searchIndustry();
        $rank3Data = $commonService->searchRank3();
		return view('admin.master.customer.mt_customer_class.list', ['commonParams' => $this->commonParams
            , 'customerClass1Data' => $customerClass1Data, 'customerClass2Data' => $customerClass2Data, 'rank3Data' => $rank3Data]);
    }

    /**
     * 得意先分類リスト(一覧) 出力(Excel)
     * @param $request
     * @param $service
     * @return Object
     */
    public function export(MtCustomerClassExportRequest $request, MtCustomerClassService $service)
    {
        if($request->has('cancel')) {
            return back();
        } elseif ($request->has('preview') || $request->has('excel')) {
            $customerClassThingId = $request->input()['customer_class_thing_id'];
            $param = $request->input();
        	$datas = $service->export($param);
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $codeStart = '';
            $codeEnd = 'ZZZZZZ';
        	if($customerClassThingId == 1) {
        		$fileName = "販売パターン1マスタ（一覧表）_".Carbon::now()->format('Ymd').".xlsx";
                $codeStart = ($param['code1_start']) ? $param['code1_start'] : '';
                $codeEnd = ($param['code1_end']) ? $param['code1_end'] : 'ZZZZZZ';
        	} elseif($customerClassThingId == 2) {
        		$fileName = "業種・特徴2マスタ（一覧表）_".Carbon::now()->format('Ymd').".xlsx";
                $codeStart = ($param['code2_start']) ? $param['code2_start'] : '';
                $codeEnd = ($param['code2_end']) ? $param['code2_end'] : 'ZZZZZZ';
        	} elseif($customerClassThingId == 3) {
        		$fileName = "ランク3マスタ（一覧表）_".Carbon::now()->format('Ymd').".xlsx";
                $codeStart = ($param['code3_start']) ? $param['code3_start'] : '';
                $codeEnd = ($param['code3_end']) ? $param['code3_end'] : 'ZZZZZZ';
        	}
        	$params = [
                'customer_class_thing_id' => $customerClassThingId,
        		'startDate' => $codeStart,
        		'endDate' => $codeEnd,
        		'currentDate' => Carbon::now()->format('Y/m/d'),
        		'datas' => $datas,
        	];

            if ($request->has('preview')) {
                if ($customerClassThingId == 1) {
                    $view = view('export.mt_customer_class_list_1_preview', compact('params'));
                } elseif ($customerClassThingId == 2) {
                    $view = view('export.mt_customer_class_list_2_preview', compact('params'));
                } elseif ($customerClassThingId == 3) {
                    $view = view('export.mt_customer_class_list_3_preview', compact('params'));
                }
                return $view;
            } else if ($request->has('excel')) {
                try {
                    if ($customerClassThingId == 1) {
                        $view = view('export.mt_customer_class_list_1', compact('params'));
                    } elseif ($customerClassThingId == 2) {
                        $view = view('export.mt_customer_class_list_2', compact('params'));
                    } elseif ($customerClassThingId == 3) {
                        $view = view('export.mt_customer_class_list_3', compact('params'));
                    }
                    $header = [
                        'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    ];
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：".$e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        }
        return redirect()->route('master.customer.mt_customer_class.list');
    }

    /**
     * ランク3検索
     * @param $request
     * @param $service
     * @return Object
     */
    public function searchRank3(Request $request, MtCustomerClassService $service)
    {
        $datas =  $service->getRank3($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 業種・特徴2検索
     * @param $request
     * @param $service
     * @return Object
     */
    public function searchIndustry(Request $request, MtCustomerClassService $service)
    {
        $datas =  $service->getIndustry($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }


    /**
     * 販売パターン１検索
     * @param $request
     * @param $service
     * @return Object
     */
    public function searchSalesPattern(Request $request, MtCustomerClassService $service)
    {
        $datas =  $service->getSalesPattern($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 得意先分類入力　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtCustomerClassService $service)
    {
        $datas =  $service->codeAutoComplete($request->input('customer_class_cd'), $request->input('def_customer_class_thing_id'));
        header('Content-type: application/json');
        return json_encode($datas);
    }

}
