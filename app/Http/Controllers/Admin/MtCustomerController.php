<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MtCustomer\MtCustomerListRequest;
use App\Http\Requests\MtCustomer\MtCustomerBalanceRequest;
use App\Http\Requests\MtCustomer\MtCustomerDetailRequest;
//use App\Http\Requests\MtCustomerSearchRequest;
//use App\Http\Requests\MtCustomerBalanceRequest;
use App\Services\MtCustomerService as MtCustomerService;
use App\Services\CommonService as CommonService;
use App\Exports\MtCustomerExport;
use App\Exports\CommonExport;
use App\Imports\CommonImport;
use App\Consts\CommonConsts;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;

class MtCustomerController extends Controller
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
        //$userInfo = $this->getAuth();
        //$this->commonParams = ['menus' => $menus, 'pageInfo' => $pageInfo, 'userInfo' => $userInfo];
        $this->commonParams = ['menus' => $menus, 'pageInfo' => $pageInfo];
    }

    /**
     * 得意先入力(詳細) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function detail(Request $request, MtCustomerService $service, CommonService $commonService)
    {
        //検索 得意先, 請求先, 付箋, 担当者, 得意先分類1,  得意先分類2, 得意先分類3, 地区分類, 開始年分類, 受注倉庫, ルートコード, 運送会社, 着日, 売上伝票種別
        $maxCode = $service->getMaxCode();
        $minCode = $service->getMinCode();
        $orderReceiveStickyNoteData = $commonService->searchOrderReceiveStickyNote();

        return view('admin.master.customer.mt_customer.detail', [
            'commonParams' => $this->commonParams,
            'minCode' => $minCode,
            'maxCode' => $maxCode,
            'orderReceiveStickyNoteData' => $orderReceiveStickyNoteData
        ]);
    }

    /**
     * 得意先入力(詳細) 初期表示(ID指定)
     * @param $request
     * @param $service
     * @return Object
     */
    public function detailById($id, Request $request, MtCustomerService $service, CommonService $commonService)
    {
        // 検索関連
        $orderReceiveStickyNoteData = $commonService->searchOrderReceiveStickyNote();

        // 詳細情報
        $maxCode = $service->getMaxCode();
        $minCode = $service->getMinCode();
        $result = $service->getDetailById($id);
        $detailData = $result['MtCustomer'];
        $managerDetailData = $result['MtManager'];
        return view('admin.master.customer.mt_customer.detail', [
            'commonParams' => $this->commonParams,
            'detailData' => $detailData,
            'managerDetailData' => $managerDetailData,
            'minCode' => $minCode,
            'maxCode' => $maxCode,
            'orderReceiveStickyNoteData' => $orderReceiveStickyNoteData
        ]);
    }

    /**
     * 得意先入力(詳細) 更新
     * @param $id
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(MtCustomerDetailRequest $request, MtCustomerService $service)
    {
        $params = $request->input();
        if ($request->has('cancel')) {
            return redirect()->route('master.customer.mt_customer.detail');
        } elseif ($request->has('prev')) {
            $result = $service->getPrevByCode($params['customer_cd']);
            if (isset($result)) {
                return redirect()->route('master.customer.mt_customer.detail_by_id', ['id' => $result['id']]);
            }
        } elseif ($request->has('next')) {
            $result = $service->getNextByCode($params['customer_cd']);
            if (isset($result)) {
                return redirect()->route('master.customer.mt_customer.detail_by_id', ['id' => $result['id']]);
            }
        } elseif ($request->has('delete')) {
            $result = $service->deleteDetail($request->input('hidden_detail_id'));
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                if (str_contains($result['error'], 'SQLSTATE[23000]')) {
                    $errormessage = __("validation.error_messages.delete_constraint_key_error");
                } else {
                    $errormessage = __("validation.error_messages.delete_error");
                }
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.delete_complete");
                return redirect()->route('master.customer.mt_customer.detail')->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('update')) {
            $result = $service->updateDetail($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                if (isset($result['customError'])) {
                    $errormessage = $result['customError'];
                } else {
                    $errormessage = __("validation.error_messages.update_error");
                }
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('master.customer.mt_customer.detail_by_id', ['id' => $result['mtCustomerId']])->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('redirect')) {
            $customerId = $request->input('redirect');
            return redirect()->route('master.customer.mt_customer.detail_by_id', ['id' => $customerId]);
        }
        return redirect()->route('master.customer.mt_customer.detail');
    }

    /**
     * 得意先リスト(一覧) 初期表示
     * @param $request
     * @return Object
     */
    public function list(Request $request, MtCustomerService $service, CommonService $commonService)
    {
        $customerData = $commonService->searchCustomer();
        return view('admin.master.customer.mt_customer.list', ['commonParams' => $this->commonParams, 'customerData' => $customerData]);
    }

    /**
     * 得意先リスト(一覧) 出力(Excel)
     * @param $request
     * @param $service
     * @return Object
     */
    public function export(MtCustomerListRequest $request, MtCustomerService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('preview') || $request->has('excel')) {
            $datas = $service->export($request->input());
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "得意先マスタ（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'startDate' => ($request['code_start']) ? str_pad($request['code_start'], 6, 0, STR_PAD_LEFT) : '',
                'endDate' => ($request['code_end']) ? str_pad($request['code_end'], 6, 0, STR_PAD_LEFT) : 'ZZZZZZ',
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            if ($request->has('preview')) {
                $view = view('export.mt_customer_list_preview', compact('params'));
                return $view;
            } elseif ($request->has('excel')) {
                try {
                    $view = view('export.mt_customer_list', compact('params'));
                    $headers = [
                        'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                        'Content-Type' => 'application/octet-stream'
                    ];
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $headers);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        }
        return redirect()->route('master.customer.mt_customer.list');
    }

    /**
     * 得意先マスタ残高 初期表示
     * @param $id
     * @param $request
     * @return Object
     */
    /*
    public function indexBalance(Request $request)
    {
		return view('admin.master.customer.mt_customer.balance', ['commonParams' => $this->commonParams]);
    }
    */

    /**
     * 得意先マスタ残高 更新
     * @param $id
     * @param $request
     * @param $service
     * @return Object
     */
    /*
    public function updateBalance(MtCustomerBalanceRequest $request, MtCustomerService $service)
    {
        if($request->has('cancel')) {
        	redirect()->route('master.customer.mt_customer.balance.index');
        } elseif($request->has('delete')) {
            //削除
        } elseif($request->has('back')) {
			//前頁
        } elseif($request->has('next')) {
        	//次頁
        } elseif($request->has('execute')) {
        	//$result = $service->updateBalance($request->input());
        }
		redirect()->route('master.customer.mt_customer.balance.index');
    }
    */
    /**
     * 得意先マスタExcel取込 初期表示
     * @param $request
     * @return Object
     */
    public function fileIndex(Request $request)
    {
        return view('admin.master.customer.mt_customer.file', ['commonParams' => $this->commonParams]);
    }

    /**
     * 得意先マスタExcel取込 更新
     * @param $request
     * @return Object
     */
    public function fileImport(Request $request, MtCustomerService $service)
    {
        if ($request->has('error_output')) {
            //エラー情報が存在するか判定
            if (!$request->session()->has('customerImportError')) {
                return back()->with('errorMessage', __("validation.error_messages.error_is_not_exist"));
            }
            if (empty($request->session()->has('customerImportError'))) {
                return back()->with('errorMessage', __("validation.error_messages.error_is_not_exist"));
            } else {
                //エラーファイル出力
                $errorInfo = $request->session()->get('customerImportError')[0];
                $rows = $request->session()->get('customerImport')[0];
                $i = 0;
                foreach ($rows as $row) {
                    $errorDetail = $errorInfo[$i + 1]->all();
                    foreach ($row as $key => $value) {
                        if (is_numeric($key) && $key >= 51) {
                            unset($row[$key]);
                        }
                    }
                    $rows[$i] = $row;
                    $rows[$i]['エラー内容'] = implode(",", $errorDetail);
                    $i++;
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
                    $fileName = "エラー得意先マスタ.xlsx";
                    $params = [
                        'datas' => $rows,
                        'errorsList' => $errorsList,
                    ];
                    $header = [
                        'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    ];
                    $view = view('export.mt_customer_export_list', compact('params'));
                    if ($request->session()->has('customerImportError')) {
                        $request->session()->forget('customerImportError');
                    }
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
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
                        $request->session()->put('customerImportError', $checkFormat['rowErrors']);
                    }
                    $request->session()->put('customerImport', $rows);
                    if (isset($checkFormat['rowErrors'])) {
                        $errormessage = __("validation.error_messages.excel_import_fail") . "<br>";
                        if (isset($checkFormat['rowErrors'][0])) {
                            foreach ($checkFormat['rowErrors'][0] as $errors) {
                                foreach ($errors->all() as $error) {
                                    $errormessage .= "「" . $error . "」";
                                }
                                $errormessage .= "<br>";
                            }
                        }
                    } else if (isset($checkFormat['error'])) {
                        $errormessage = __("validation.error_messages.excel_import_fail") . "<br>" . $checkFormat['error'];
                    }
                    return back()->withInput()->with('errormessage', $errormessage);
                }
                //UPDATEorINSERT 得意先マスタ, 請求先マスタ, 担当者マスタ, 得意先別担当者マスタ
                $result = $service->importUpdate($rows);
                if ($result['status'] === CommonConsts::STATUS_ERROR) {
                    $errormessage = __("validation.error_messages.update_error") . "<br>" . $result['error'];
                    return back()->withInput()->with('errormessage', $errormessage);
                } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                    if ($request->session()->has('customerImportError')) {
                        $request->session()->forget('customerImportError');
                    }
                    $flashmessage = __("validation.complete_message.update_complete");
                    return redirect()->route('master.customer.mt_customer.file.index')->with('flashmessage', $flashmessage);
                }
            } catch (Exception $e) {
                $flashmessage = "エラーが発生したため、取込処理を中断します。<br>エラー情報：" . $e->getMessage();
                return back()->withInput()->with('flashmessage', $flashmessage);
            }
        }
        redirect()->route('master.customer.mt_customer.file.index');
    }

    /**
     * 得意先残高検索
     * @param $request
     * @param $service
     * @return Object
     */
    /*
    public function searchBalance(SearchBalanceRequest $request, MtCustomerService $service)
    {
        $datas =  $service->get($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }
    */

    /**
     * 自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtCustomerService $service)
    {
        $datas =  $service->codeAutoComplete($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
