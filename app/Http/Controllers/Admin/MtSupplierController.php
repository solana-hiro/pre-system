<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MtSupplier\MtSupplierUpdateRequest;
use App\Http\Requests\MtSupplier\MtSupplierExportRequest;
use App\Http\Requests\MtSupplier\MtSupplierBalanceRequest;
use App\Services\MtSupplierService as MtSupplierService;
use App\Services\CommonService as CommonService;
use App\Exports\MtSupplierExport;
use App\Exports\CommonExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Consts\CommonConsts;
use Illuminate\Support\Facades\DB;

class MtSupplierController extends Controller
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
     * 仕入先入力(詳細) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function index(Request $request, CommonService $commonService, MtSupplierService $service)
    {
        $supplierData = $commonService->searchSupplier();
        $payDestinationData = $commonService->searchPayDestination();
        $supplierClass1Data = $commonService->searchClass1();
        $supplierClass2Data = $commonService->searchClass1();
        $supplierClass3Data = $commonService->searchClass1();
        $managerData = $commonService->searchManager();
        $slipKindData = $commonService->searchSlipKind();
        $minId = $service->getMinId();
        $maxId = $service->getMaxId();
        return view('admin.master.supplier.mt_supplier.detail', [
            'commonParams' => $this->commonParams,
            'supplierData' => $supplierData,
            'payDestinationData' => $payDestinationData,
            'supplierClass1Data' => $supplierClass1Data,
            'supplierClass2Data' => $supplierClass2Data,
            'supplierClass3Data' => $supplierClass3Data,
            'managerData' => $managerData,
            'slipKindData' => $slipKindData,
            'minId' => $minId,
            'maxId' => $maxId,
        ]);
    }

    /**
     * 仕入先入力(詳細) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function detailById($id, MtSupplierService $service, CommonService $commonService)
    {
        $detailData = $service->getDetailById($id);
        // 該当データが存在しない場合
        if (empty($detailData)) {
            return redirect()->route('master.supplier.mt_supplier.detail');
        }
        $supplierData = $commonService->searchSupplier();
        $payDestinationData = $commonService->searchPayDestination();
        $supplierClass1Data = $commonService->searchClass1();
        $supplierClass2Data = $commonService->searchClass1();
        $supplierClass3Data = $commonService->searchClass1();
        $managerData = $commonService->searchManager();
        $slipKindData = $commonService->searchSlipKind();
        $minId = $service->getMinId();
        $maxId = $service->getMaxId();
        return view('admin.master.supplier.mt_supplier.detail', [
            'commonParams' => $this->commonParams,
            'detailData' => $detailData,
            'supplierData' => $supplierData,
            'payDestinationData' => $payDestinationData,
            'supplierClass1Data' => $supplierClass1Data,
            'supplierClass2Data' => $supplierClass2Data,
            'supplierClass3Data' => $supplierClass3Data,
            'managerData' => $managerData,
            'slipKindData' => $slipKindData,
            'minId' => $minId,
            'maxId' => $maxId,
        ]);
    }

    /**
     * 仕入先入力(詳細) 更新
     * @param $id
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(MtSupplierUpdateRequest $request, MtSupplierService $service)
    {
        $param = $request->input();
        if ($request->has('cancel')) {
            return redirect()->route('master.supplier.mt_supplier.detail');
        } elseif ($request->has('prev')) {
            $result = $service->getPrevById($param['update_id']);
            if (isset($result)) {
                return redirect()->route('master.supplier.mt_supplier.detail_by_id', ['id' => $result['id']]);
            }
        } elseif ($request->has('next')) {
            $id = isset($param['update_id']) ? $param['update_id'] : null;
            $result = $service->getNextById($id);
            if (isset($result)) {
                return redirect()->route('master.supplier.mt_supplier.detail_by_id', ['id' => $result['id']]);
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
                return redirect()->route('master.supplier.mt_supplier.detail')->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('update')) {
            $result = $service->update($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('master.supplier.mt_supplier.detail_by_id', ['id' => $result['mtSupplierId']])->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('redirect')) {
            $mtSupplierId = $request->input('redirect_hidden');
            return redirect()->route('master.supplier.mt_supplier.detail_by_id', ['id' => $mtSupplierId]);
        }
        return redirect()->route('master.supplier.mt_supplier.detail');
    }

    /**
     * 仕入先リスト(一覧) 初期表示
     * @param $request
     * @return Object
     */
    public function list(Request $request, CommonService $commonService)
    {
        $supplierData = $commonService->searchSupplier();
        return view('admin.master.supplier.mt_supplier.list', ['commonParams' => $this->commonParams, 'supplierData' => $supplierData]);
    }

    /**
     * 仕入先リスト(一覧) 出力(Excel)
     * @param $request
     * @param $service
     * @return Object
     */
    public function export(MtSupplierExportRequest $request, MtSupplierService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('preview') || $request->has('excel')) {
            //Excel
            $datas = $service->export($request->input());
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "仕入先マスタ（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
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
                $view = view('export.mt_supplier_list_preview', compact('params'));
                return $view;
            } elseif ($request->has('excel')) {
                try {
                    $view = view('export.mt_supplier_list', compact('params'));
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        }
        return redirect()->route('master.supplier.mt_supplier.list');
    }

    /**
     * 仕入先マスタ残高 初期表示
     * @param $id
     * @param $request
     * @return Object
     */
    public function indexBalance(Request $request, MtSupplierService $service)
    {
        return view('admin.master.supplier.mt_supplier.balance', ['commonParams' => $this->commonParams]);
    }

    /**
     * 仕入先マスタ残高 更新
     * @param $id
     * @param $request
     * @param $service
     * @return Object
     */
    /* 対応不要
    public function updateBalance(MtSupplierBalanceRequest $request, MtSupplierService $service)
    {
    	if($request->has('cancel')) {
			return redirect()->route('master.supplier.mt_supplier.balance.index');
		} elseif($request->has('delete')) {
			//削除
			$result = $service->updateBalance($request->input());
		} elseif($request->has('update')) {
			//更新
			$result = $service->updateBalance($request->input());
		}
		return redirect()->route('master.supplier.mt_supplier.balance.index');
    }
    */

    /**
     * 仕入先残高検索
     * @param $request
     * @param $service
     * @return Object
     */
    /*
    public function searchSupplierBalance(SearchRequest $request, MtSupplierService $service)
    {
        $datas =  $service->get($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }
    */

    /**
     * 仕入先　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtSupplierService $service)
    {
        $datas =  $service->codeAutoComplete($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
