<?php

namespace App\Http\Controllers\Admin;

//use App\Http\Requests\MtDeliveryDestinationRequest;
//use App\Http\Requests\MtDeliveryDestinationSearchRequest;
use App\Services\MtDeliveryDestinationService as MtDeliveryDestinationService;
use App\Services\CommonService as CommonService;
use App\Http\Requests\MtDeliveryDestination\ExportRequest;
use App\Http\Requests\MtDeliveryDestination\UpdateRequest;
use App\Http\Requests\MtDeliveryDestination\ImportRequest;
use App\Http\Requests\MtDeliveryDestination\DetailUpdateRequest;
use App\Exports\MtDeliveryDestinationExport;
use App\Exports\CommonExport;
use App\Imports\CommonImport;
use App\Consts\CommonConsts;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use PHPUnit\Framework\MockObject\Stub\ReturnSelf;
use App\Models\MtCustomer;
use App\Models\MtCustomerDeliveryDestination;

class MtDeliveryDestinationController extends Controller
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
     * 納品先入力(一覧) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function index(Request $request, MtDeliveryDestinationService $service, CommonService $commonService)
    {
        return view('admin.master.delivery.mt_delivery_destinations.index', ['commonParams' => $this->commonParams]);
    }

    /**
     * 納品先入力(一覧) 更新
     * @param $id
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(UpdateRequest $request, MtDeliveryDestinationService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('update')) {
            $result = $service->update($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('master.delivery.mt_delivery_destinations.index')->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('delete')) {
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
                return redirect()->route('master.delivery.mt_delivery_destinations.index')->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('transition')) {
            return redirect()->route('master.delivery.mt_delivery_destinations.detail_by_id', ['id' => $request->input('transition')]);
        }
        return redirect()->route('master.delivery.mt_delivery_destinations.index');
    }

    /**
     * 納品先入力(詳細) 初期表示
     * @param $id
     * @param $request
     * @param $service
     * @return Object
     */
    public function detailIndex(CommonService $commonService, MtDeliveryDestinationService $service)
    {
        $minCode = $service->getMinCode();
        $maxCode = $service->getMaxCode();
        return view('admin.master.delivery.mt_delivery_destinations.detail', [
            'commonParams' => $this->commonParams,
            'minCode' => $minCode,
            'maxCode' => $maxCode
        ]);
    }

    /**
     * 納品先入力(詳細) 初期表示(ID指定)
     * @param $id
     * @param $request
     * @param $service
     * @return Object
     */
    public function detailById($id, MtDeliveryDestinationService $service, CommonService $commonService, Request $request)
    {
        $detailData = "";
        $customer_id = $request->query('customer_id');
        if ($customer_id) {
            $detailData = $service->getDetailById($id, $customer_id);
        } else {
            $detailData = $service->getDetailById($id);
        }
        $minCode = $service->getMinCode();
        $maxCode = $service->getMaxCode();
        if (empty($detailData['mtDeliveryDestination'])) {
            return redirect()->route('master.delivery.mt_delivery_destinations.detail.index');
        }

        return view('admin.master.delivery.mt_delivery_destinations.detail', [
            'commonParams' => $this->commonParams,
            'detailData' => $detailData,
            'minCode' => $minCode,
            'maxCode' => $maxCode
        ]);
    }

    /**
     * 納品先入力(詳細) 更新
     * @param $id
     * @param $request
     * @param $service
     * @return Object
     */
    public function detailUpdate(DetailUpdateRequest $request, MtDeliveryDestinationService $service)
    {
        $params = $request->input();
        if ($request->has('cancel')) {
            return redirect()->route('master.delivery.mt_delivery_destinations.detail.index');
        } elseif ($request->has('prev')) {
            $result = $service->getPrevById($params['hidden_detail_id']);
            if (isset($result)) {
                return redirect()->route('master.delivery.mt_delivery_destinations.detail_by_id', ['id' => $result['id']]);
            }
        } elseif ($request->has('next')) {
            $result = $service->getNextById($params['hidden_detail_id']);
            if (isset($result)) {
                return redirect()->route('master.delivery.mt_delivery_destinations.detail_by_id', ['id' => $result['id']]);
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
                return redirect()->route('master.delivery.mt_delivery_destinations.detail.index')->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('update')) {
            $result = $service->updateDetail($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                if ($result['is_new'] == 1) {
                    $flashmessage = '納品先コード = ' . $result['mtDeliveryDestinationCode'] . 'で登録しました';
                } else {
                    $flashmessage = __("validation.complete_message.update_complete");
                }
                return redirect()->route('master.delivery.mt_delivery_destinations.detail_by_id', ['id' => $result['mtDeliveryDestinationId'], 'customer_id' => $result['mtCustomerId'], 'customer_delivery_destination_id' => $result['mtCustomerDeliveryDestinationId']])->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('redirect')) {
            // customer情報に紐づく情報をSessionで渡す
            $customerInfo = [
                'customer_cd' => $request->input('customer_cd'),
                'del_kbn_customer' => $request->input('del_kbn_customer'),
                'direct_delivery_commission_demand_flg' => $request->input('direct_delivery_commission_demand_flg'),
                'def_arrival_date_cd' => $request->input('def_arrival_date_cd'), //着日定義
                'sale_decision_print_paper_flg' => $request->input('sale_decision_print_paper_flg'),
                'delivery_price' => $request->input('delivery_price'),
                'register_kind_flg' => $request->input('register_kind_flg'),
                'root_cd' => $request->input('root_cd'),
                'root_name' => $request->input('root_name'),
                'item_class_cd' => $request->input('item_class_cd'),
                'item_class_name' => $request->input('item_class_name'),
                'item_class_cd' => $request->input('item_class_cd'),
                'arrival_date_cd' => $request->input('arrival_date_cd'),
                'arrival_date_name' => $request->input('arrival_date_name'),
                'delivery_destination_memo_1' => $request->input('delivery_destination_memo_1'),
                'delivery_destination_memo_2' => $request->input('delivery_destination_memo_2'),
                'delivery_destination_memo_3' => $request->input('delivery_destination_memo_3'),
                'delivery_destination_memo_4' => $request->input('delivery_destination_memo_4'),
                'delivery_destination_memo_5' => $request->input('delivery_destination_memo_5'),
            ];
            $request->session()->put('customerInfo', $customerInfo);
            $deliveryId = $request->input('redirect');
            return redirect()->route('master.delivery.mt_delivery_destinations.detail_by_id', ['id' => $deliveryId]);
        }
        return redirect()->route('master.delivery.mt_delivery_destinations.detail.index');
    }

    /**
     * 納品先リスト(一覧) 初期表示
     * @param $request
     * @return Object
     */
    public function list(Request $request, CommonService $commonService)
    {
        $deliveryDestinationData = $commonService->searchDeliveryDestination();
        return view('admin.master.delivery.mt_delivery_destinations.list', ['commonParams' => $this->commonParams, 'deliveryDestinationData' => $deliveryDestinationData]);
    }

    /**
     * 納品先リスト(一覧) 出力(Excel)
     * @param $request
     * @param $service
     * @return Object
     */
    public function export(ExportRequest $request, MtDeliveryDestinationService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('preview') || $request->has('excel')) {
            $datas = $service->export($request->input());
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "納品先マスタ（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'startDate' => ($request['code_start']) ? str_pad($request['code_start'], 6, 0, STR_PAD_LEFT) : "",
                'endDate' => ($request['code_end']) ? str_pad($request['code_end'], 6, 0, STR_PAD_LEFT) : "ZZZZZZ",
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];

            if ($request->has('preview')) {
                $view = view('export.mt_delivery_destination_list_preview', compact('params'));
                return $view;
            } elseif ($request->has('excel')) {
                try {
                    $view = view('export.mt_delivery_destination_list', compact('params'));
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        }
        return view('admin.master.delivery.mt_delivery_destinations.list', ['commonParams' => $this->commonParams]);
    }

    /**
     * 納品先マスタExcel取込 初期表示
     * @param $request
     * @return Object
     */
    public function fileIndex(Request $request)
    {
        return view('admin.master.delivery.mt_delivery_destinations.file', ['commonParams' => $this->commonParams]);
    }

    /**
     * 納品先マスタExcel取込 更新
     * @param $request
     * @return Object
     */
    public function fileImport(Request $request, MtDeliveryDestinationService $service)
    {
        if ($request->has('error_output')) {
            //エラー情報が存在するか判定
            if (!$request->session()->has('deliveryDestinationImportError')) {
                return back()->with('errorMessage', __("validation.error_messages.error_is_not_exist"));
            }
            if (empty($request->session()->has('deliveryDestinationImportError'))) {
                return back()->with('errorMessage', __("validation.error_messages.error_is_not_exist"));
            } else {
                $errorInfo = $request->session()->get('deliveryDestinationImportError')[0];
                $rows = $request->session()->get('deliveryDestinationImport')[0];
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
                    $fileName = "エラー納品先マスタ.xlsx";
                    $params = [
                        'datas' => $rows,
                        'errorsList' => $errorsList,
                    ];
                    $header = [
                        'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    ];
                    $view = view('export.mt_delivery_destination_export_list', compact('params'));
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    if ($request->session()->has('deliveryDestinationImportError')) {
                        $request->session()->forget('deliveryDestinationImportError');
                    }
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
                        $request->session()->put('deliveryDestinationImportError', $checkFormat['rowErrors']);
                    }
                    $request->session()->put('deliveryDestinationImport', $rows);

                    // 取り込んだエクセルの項目チェックエラー
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
                        // エクセル内データのバリデーションエラー
                    } else if (isset($checkFormat['error'])) {
                        $errormessage = __("validation.error_messages.excel_import_fail") . "<br>" . $checkFormat['error'];
                    }
                    return back()->withInput()->with('errormessage', $errormessage);
                }
                //UPDATEorINSERT
                $result = $service->importUpdate($rows);
                if ($result['status'] === CommonConsts::STATUS_ERROR) {
                    $errormessage = __("validation.error_messages.update_error") . "<br>" . $result['error'];
                    return back()->withInput()->with('errormessage', $errormessage);
                } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                    if ($request->session()->has('deliveryDestinationImportError')) {
                        $request->session()->forget('deliveryDestinationImportError');
                    }
                    $flashmessage = __("validation.complete_message.update_complete");
                    return redirect()->route('master.delivery.mt_delivery_destinations.file.index')->with('flashmessage', $flashmessage);
                }
            } catch (Exception $e) {
                $flashmessage = "エラーが発生したため、取込処理を中断します。<br>エラー情報：" . $e->getMessage();
                return back()->withInput()->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('delete')) {
            //仮登録データ削除　
            $result = $service->tempDataDelete();
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.delete_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.delete_complete");
                return redirect()->route('master.delivery.mt_delivery_destinations.file.index')->with('flashmessage', $flashmessage);
            }
        }
        redirect()->route('master.delivery.mt_delivery_destinations.file.index');
    }

    /**
     * 納品先　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtDeliveryDestinationService $service)
    {
        $datas =  $service->codeAutoComplete($request->input());
        header("Content-type: application/json");
        return json_encode($datas);
    }
}
