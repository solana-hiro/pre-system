<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\TrnDemandHeaderService;
use App\Services\MtBillingAddressService;
use App\Services\CommonService;
use App\Http\Requests\TrnDemandHeader\DataDecisionRequest;
use App\Http\Requests\TrnDemandHeader\InvoiceListRequest;
use App\Http\Requests\TrnDemandHeader\InvoiceIssueRequest;
use App\Http\Requests\TrnDemandHeader\TaxCalculateRequest;
use App\Http\Requests\TrnDemandHeader\BalanceInquiryRequest;
use App\Http\Requests\TrnDemandHeader\UpdateClosingDateRequest;
use App\Http\Requests\TrnDemandHeader\UpdateSequentiallyClosingRequest;
use App\Http\Requests\TrnDemandHeader\UpdateSequentiallyClosingRemoveRequest;
use App\Http\Requests\TrnDemandHeader\HistoryInquiryRequest;
use App\Exports\TrnDemandHeaderInvoiceListExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use App\Consts\CommonConsts;

class TrnDemandHeaderController extends Controller
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
     * 受注計上入力  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showAccountant(Request $request)
    {
		return view('admin.sales.trn_order_receive_header.accountantIndex', ['commonParams' => $this->commonParams]);
    }

    /**
     * 受注計上入力  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateAccountant(Request $request)
    {
		//
    }

    /**
     * 請求締日変更処理  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showClosingDateChange(Request $request, CommonService $commonService)
    {
        $billingAddressData = $commonService->searchBillingAddress();
		return view('admin.sales.trn_demand_header.closingDateChange', ['commonParams' => $this->commonParams,
            'billingAddressData' => $billingAddressData
        ]);
    }

    /**
     * 請求締日変更処理  初期表示(ID指定)
     * @param $request
     * @param $service
     * @return Object
     */
    public function showClosingDateChangeById($id, Request $request, CommonService $commonService, MtBillingAddressService $service)
    {
        $billingAddressData = $commonService->searchBillingAddress();
        $initData = $service->getInitData($id);
        return view('admin.sales.trn_demand_header.closingDateChange', [
            'commonParams' => $this->commonParams,
            'billingAddressData' => $billingAddressData,
            'initData' => $initData
        ]);
    }

    /**
     * 請求締日変更処理  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateClosingDateChange(UpdateClosingDateRequest $request, TrnDemandHeaderService $service)
    {
    	if($request->has('cancel')) {
            return back();
		} elseif($request->has('update')) {
            $result =  $service->updateClosingDateChange($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('sales_management.demand.closing_date.change.index_by_id', ['id' => $result['mtBillingAddressId']])->with('flashmessage', $flashmessage);
            }
		} elseif($request->has('redirect')) {
            $id = $request->input('redirect');
            return redirect()->route('sales_management.demand.closing_date.change.index_by_id', ['id' => $id]);
        }
		return redirect()->route('sales_management.demand.closing_date.change.index');
    }

    /**
     * 請求随時締処理  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showSequentiallyClosing(Request $request, CommonService $commonService)
    {
        $billingAddressData = $commonService->searchBillingAddress();
		return view('admin.sales.trn_demand_header.sequentiallyClosing', ['commonParams' => $this->commonParams,
            'billingAddressData' => $billingAddressData
        ]);
    }


    /**
     * 請求随時締処理  初期表示(ID指定)
     * @param $request
     * @param $service
     * @return Object
     */
    public function showSequentiallyClosingById($id, Request $request, CommonService $commonService, MtBillingAddressService $service)
    {
        $billingAddressData = $commonService->searchBillingAddress();
        $initData = $service->getSequentiallyInitData($id);
        return view('admin.sales.trn_demand_header.sequentiallyClosing', [
            'commonParams' => $this->commonParams,
            'billingAddressData' => $billingAddressData, 'initData' => $initData
        ]);
    }

    /**
     * 請求随時締処理  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateSequentiallyClosing(UpdateSequentiallyClosingRequest $request, TrnDemandHeaderService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('update')) {
            $result = $service->updateSequentiallyClosing($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('sales_management.demand.sequentially.closing.index_by_id', ['id' => $result['mtBillingAddressId']])->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('redirect')) {
            $id = $request->input('redirect');
            return redirect()->route('sales_management.demand.sequentially.closing.index_by_id', ['id' => $id]);
        }
		return redirect()->route('sales_management.demand.sequentially.closing.index');
    }

    /**
     * 請求随時締解除処理  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showSequentiallyClosingRemove(Request $request, CommonService $commonService)
    {
        $billingAddressData = $commonService->searchBillingAddress();
		return view('admin.sales.trn_demand_header.sequentiallyClosingRemove', ['commonParams' => $this->commonParams,
            'billingAddressData' => $billingAddressData
        ]);
    }

    /**
     * 請求随時締解除処理  初期表示(ID指定)
     * @param $request
     * @param $service
     * @return Object
     */
    public function showSequentiallyClosingRemoveById($id, Request $request, CommonService $commonService, MtBillingAddressService $service)
    {
        $billingAddressData = $commonService->searchBillingAddress();
        $initData = $service->getClosingInitData($id);
        return view('admin.sales.trn_demand_header.sequentiallyClosingRemove', ['commonParams' => $this->commonParams,
            'billingAddressData' => $billingAddressData, 'initData' => $initData
        ]);
    }

    /**
     * 請求随時締解除処理  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateSequentiallyClosingRemove(UpdateSequentiallyClosingRemoveRequest $request, TrnDemandHeaderService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('update')) {
            $result = $service->updateSequentiallyClosingRemove($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('sales_management.demand.sequentially.closing.remove.index_by_id', ['id' => $result['mtBillingAddressId']])->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('redirect')) {
            $id = $request->input('redirect');
            return redirect()->route('sales_management.demand.sequentially.closing.remove.index_by_id', ['id' => $id]);
        }
        return redirect()->route('sales_management.demand.sequentially.closing.remove.index');
    }

    /**
     * 請求時消費税一括計算  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showTaxCalculate(Request $request, CommonService $commonService)
    {
        $billingAddressData = $commonService->searchBillingAddress();
		return view('admin.sales.trn_demand_header.taxCalculate', ['commonParams' => $this->commonParams, 'billingAddressData' => $billingAddressData]);
    }

    /**
     * 請求時消費税一括計算  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateTaxCalculate(TaxCalculateRequest $request, TrnDemandHeaderService $service)
    {
    	if($request->has('cancel')) {
            return back();
		} elseif($request->has('remove')) {
            // 削除
            $result =  $service->deleteTaxCalculate($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                if (str_contains($result['error'], 'SQLSTATE[23000]')) {
                    $errormessage = __("validation.error_messages.delete_constraint_key_error");
                } else {
                    $errormessage = __("validation.error_messages.delete_error");
                }
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.remove_complete");
                return redirect()->route('sales_management.demand.tax.calculate.index')->with('flashmessage', $flashmessage);
            }
		} elseif($request->has('execute')) {
		    // 実行
    		$result =  $service->updateTaxCalculate($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.execute_complete");
                return redirect()->route('sales_management.demand.tax.calculate.index')->with('flashmessage', $flashmessage);
            }
		}
		return redirect()->route('sales_management.demand.tax.calculate.index');
    }

    /**
     * 請求データ確定処理  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showDataDecision(Request $request, CommonService $commonService)
    {
        $billingAddressData = $commonService->searchBillingAddress();
		return view('admin.sales.trn_demand_header.dataDecision', ['commonParams' => $this->commonParams, 'billingAddressData' => $billingAddressData]);
    }

    /**
     * 請求データ確定処理  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateDataDecision(DataDecisionRequest $request, TrnDemandHeaderService $service)
    {
        $param = $request->input();
    	if($request->has('cancel')) {
            return back();
		} elseif($request->has('remove')) {
			$result =  $service->removeDataDecision($param);
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                if (str_contains($result['error'], 'SQLSTATE[23000]')) {
                    $errormessage = __("validation.error_messages.delete_constraint_key_error");
                } else {
                    $errormessage = __("validation.error_messages.delete_error");
                }
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.remove_complete");
                return redirect()->route('sales_management.demand.data.decision.index')->with('flashmessage', $flashmessage);
            }
		} elseif($request->has('execute')) {
        	$result =  $service->updateDataDecision($param);
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.execute_complete");
                return redirect()->route('sales_management.demand.data.decision.index')->with('flashmessage', $flashmessage);
            }
		}
        return redirect()->route('sales_management.demand.data.decision.index');
    }

    /**
     * 請求残高問合せ  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showBalanceInquiry(Request $request)
    {
		return view('admin.sales.trn_demand_header.balanceInquiry', ['commonParams' => $this->commonParams]);
    }

    /**
     * 請求残高問合せ  キャンセル・前頁・後頁・実行
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportBalanceInquiry(BalanceInquiryRequest $request, TrnDemandHeaderService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('back')) {
			//前頁
			$data = $service->backBalanceInquiry($request->input());
		} elseif($request->has('next')) {
			//後頁
			$data = $service->nextBalanceInquiry($request->input());
		} elseif($request->has('execute')) {
		    //実行
			$data = $service->exportBalanceInquiry($request->input());
		}
        return redirect()->route('sales_management.demand.balance.inquiry.index');
    }

    /**
     * 請求履歴問合せ  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showHistoryInquiry(Request $request)
    {
		return view('admin.sales.trn_demand_header.historyInquiry', ['commonParams' => $this->commonParams]);
    }

    /**
     * 請求履歴問合せ  キャンセル・前頁・後頁・実行
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportHistoryInquiry(HistoryInquiryRequest $request, TrnDemandHeaderService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('back')) {
			//前頁
			$data = $service->backHistoryInquiry($request->input());
		} elseif($request->has('next')) {
			//後頁
			$data = $service->nextHistoryInquiry($request->input());
		} elseif($request->has('execute')) {
		    //実行
			$data = $service->executeHistoryInquiry($request->input());
		}
		return redirect()->route('sales_management.demand.history.inquiry.index');
    }

    /**
     * 請求一覧表  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showInvoiceList(Request $request, CommonService $commonService)
    {
        $managerData = $commonService->searchManager();
        $departmentData = $commonService->searchDepartment();
        $billingAddressData = $commonService->searchBillingAddress();
		return view('admin.sales.trn_demand_header.invoiceList', ['commonParams' => $this->commonParams,
            'managerData' => $managerData, 'departmentData' => $departmentData, 'billingAddressData' => $billingAddressData
        ]);
    }

    /**
     * 請求一覧表  Excel出力・キャンセル
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportInvoiceList(InvoiceListRequest $request, TrnDemandHeaderService $service)
    {
    	if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel') || $request->has('preview')) {
			// EXCEL出力
			$datas = $service->exportInvoiceList($request->input());
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "_" . Carbon::now()->format('Ymd') . ".xlsx";
            $billingDate = $request['year'].'-'.$request['month'].'-'.$request['date'];
            $sortOrder = $request['sort_order'];
            $billingAddressStart = $request['billing_address_start'];
            $billingAddressEnd = $request['billing_address_end'];
            $departmentCodeStart = $request['department_code_start'];
            $departmentCodeEnd = $request['department_code_end'];
            $managerCodeStart = $request['manager_code_start'];
            $managerCodeEnd = $request['manager_code_end'];
            $params = [
                'billingDate' => $request['code_start'],
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            $view = view('export.trn_demand_header_invoice_list', compact('params'));
            if (isset($view) && isset($fileName)) {
                return Excel::download(new TrnDemandHeaderInvoiceListExport($view), $fileName, Excels::XLSX, $header);
            } else {
                return redirect()->route('sales_management.demand.invoice.list.index');
            }
        }
        return redirect()->route('sales_management.demand.invoice.list.index');
    }

    /**
     * 請求書発行  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showInvoiceIssue(Request $request, CommonService $commonService)
    {
        $billingAddressData = $commonService->searchBillingAddress();
        $departmentData = $commonService->searchDepartment();
		return view('admin.sales.trn_demand_header.invoiceIssue', ['commonParams' => $this->commonParams,
            'billingAddressData' => $billingAddressData,
            'departmentData' => $departmentData
        ]);
    }

    /**
     * 請求書発行  プレビュー表示・キャンセル
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportInvoiceIssue(InvoiceIssueRequest $request, TrnDemandHeaderService $service)
    {
    	if($request->has('cancel')) {
            return back();
		} elseif($request->has('preview')) {
			// プレビュー
			$data = $service->exportInvoiceIssue($request->input());
            // メール送信
		}
        return redirect()->route('sales_management.demand.invoice.issue.index');
    }

}
