<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\TrnPaymentHeaderService;
use App\Services\CommonService;
use App\Http\Requests\TrnPaymentHeader\CheckListRequest;
use App\Http\Requests\TrnPaymentHeader\ListRequest;
use App\Http\Requests\TrnPaymentHeader\BillReceiptRequest;
use App\Http\Requests\TrnPaymentHeader\CustomerLedgerRequest;
use App\Http\Requests\TrnPaymentHeader\CollectionBalanceRequest;
use App\Exports\TrnPayChecklistExport;
use App\Exports\TrnBillReceiptExport;
use App\Exports\TrnPayBalanceExport;
use App\Exports\TrnPaymentCustomerLedgerExport;
use App\Exports\TrnPaymentCollectBalanceExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;

class TrnPaymentHeaderController extends Controller
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
     * 入金計上入力  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showPayment(Request $request)
    {
		return view('admin.sales.trn_payment_header.accountantIndex', ['commonParams' => $this->commonParams]);
    }

    /**
     * 入金計上入力  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updatePayment(Request $request)
    {
		//return view('admin.sales.trn_order_receive_header.accountantIndex');
    }

    /**
     * 入金チェックリスト  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showChecklist(Request $request)
    {
		return view('admin.sales.trn_payment_header.checklist', ['commonParams' => $this->commonParams]);
    }

    /**
     * 入金チェックリスト  キャンセル・Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportChecklist(CheckListRequest $request, TrnPaymentHeaderService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
			$datas =  $service->exportCheckList($request->input());
            $fileName = "入金チェックリスト_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'startDate' => $request['code_start'],
                'endDate' => $request['code_end'],
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            $view = view('export.trn_payment_checklist_list', compact('params'));

            if (isset($view) && isset($fileName)) {
                return Excel::download(new TrnPayChecklistExport($view), $fileName, Excels::XLSX, $header);
            } else {
                return redirect()->route('sales_management.accounts_receivable.checklist.index');
            }
		}
        return redirect()->route('sales_management.accounts_receivable.checklist.index');
    }

    /**
     * 未回収残一覧表  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showCollectBalanceList(Request $request, CommonService $commonService)
    {
        $managerData = $commonService->searchManager();
        $billingAddressData = $commonService->searchBillingAddress();
		return view('admin.sales.trn_payment_header.collectBalanceList', ['commonParams' => $this->commonParams,
            'managerData' => $managerData, 'billingAddressData' => $billingAddressData
        ]);
    }

    /**
     * 未回収残一覧表  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportCollectBalanceList(CollectionBalanceRequest $request, TrnPaymentHeaderService $service)
    {
        $param = $request->input();
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
			$datas =  $service->exportCollectBalanceList($request->input());
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "未回収残一覧表_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'targetDate' => $param['year'].'年' . $param['month'] . '月',
                'managerCodeStart' => $param['manager_code_start'],
                'managerCodeEnd' => $param['manager_code_end'],
                'billingAddressCodeStart' => $param['billing_address_code_start'],
                'billingAddressCodeEnd' => $param['billing_address_code_end'],
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'targetDateYM' => $param['year'].$param['month'],
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            $view = view('export.trn_payment_collect_balance_list', compact('params'));
            $result = Excel::download(new TrnPaymentCollectBalanceExport($view), $fileName, Excels::XLSX, $header);
            return $result;
		}
		return redirect()->route('sales_management.accounts_receivable.collect_balance.list.index');
    }

    /**
     * 受取手形一覧表  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showBillReceipt(Request $request)
    {
		return view('admin.sales.trn_payment_header.billReceipt', ['commonParams' => $this->commonParams]);
    }

    /**
     * 受取手形一覧表  キャンセル・Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportBillReceipt(BillReceiptRequest $request, TrnPaymentHeaderService $service)
    {
        $param = $request->input();
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
			$datas =  $service->exportBillReceipt($param);
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "受取手形一覧表_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'targetDate' => $param['year'].'年'. $param['month'].'月以降',
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            $view = view('export.trn_payment_bill_receipt', compact('params'));

            if (isset($view) && isset($fileName)) {
                return Excel::download(new TrnBillReceiptExport($view), $fileName, Excels::XLSX, $header);
            } else {
                return redirect()->route('sales_management.accounts_receivable.bill_receipt.list.index');
            }
		}
        return redirect()->route('sales_management.accounts_receivable.bill_receipt.list.index');
    }

    /**
     * 売掛残高一覧表  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showList(Request $request, CommonService $commonService)
    {
        $billingAddressData = $commonService->searchBillingAddress();
		return view('admin.sales.trn_payment_header.list', ['commonParams' => $this->commonParams,
            'billingAddressData' => $billingAddressData
        ]);
    }

    /**
     * 売掛残高一覧表  キャンセル・Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportList(ListRequest $request, TrnPaymentHeaderService $service)
    {
        $param = $request->input();
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
			$datas =  $service->exportList($request->input());
            $fileName = "売掛残高一覧表_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'startDate' => $param['year_start'].'年' . $param['month_start'] . '月' . $param['day_start'] . '日',
                'endDate' => $param['year_end'] . '年' . $param['month_end'] . '月' . $param['day_end'] . '日',
                'startCode' => $param['code_start'],
                'endCode' => $param['code_end'],
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            $view = view('export.trn_payment_balance_list', compact('params'));
            $result =  Excel::download(new TrnPayBalanceExport($view), $fileName, Excels::XLSX, $header);
            return $result;
		}
        return redirect()->route('sales_management.accounts_receivable.list.index');
    }

    /**
     * 得意先元帳  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showCustomerLedger(Request $request,CommonService $commonService)
    {
        $billingAddressData = $commonService->searchBillingAddress();
		return view('admin.sales.trn_payment_header.customerLedger', ['commonParams' => $this->commonParams,
            'billingAddressData' => $billingAddressData
        ]);
    }

    /**
     * 得意先元帳   キャンセル・Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportCustomerLedger(CustomerLedgerRequest $request, TrnPaymentHeaderService $service)
    {
        $param = $request->input();
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
			$datas =  $service->exportCustomerLedger($request->input());
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "得意先元帳_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'startCode' => $param['billing_address_code_start'],
                'endCode' => $param['billing_address_code_end'],
                'startDate' => $param['calendar1-year'] . '年' . $param['calendar1-month'] . '月' . $param['calendar1-date'] . '日',
                'endDate' => $param['calendar2-year'] . '年' . $param['calendar2-month'] . '月' . $param['calendar2-date'] . '日',
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'outputKbn' => $param['output_kbn'],
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            if($param['output_kbn'] === '1') {
                $view = view('export.trn_payment_customer_ledger', compact('params'));
            } else if ($param['output_kbn'] === '2') {
                $view = view('export.trn_payment_customer_ledger_kbn2', compact('params'));
            }
            $result = Excel::download(new TrnPaymentCustomerLedgerExport($view), $fileName, Excels::XLSX, $header);
            return $result;
		}
        return redirect()->route('sales_management.accounts_receivable.customer_ledger.index');
    }

    /**
     * 得意先概況問合  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showCustomerOverview(Request $request)
    {
		return view('admin.sales.trn_payment_header.customerOverviewInquiry', ['commonParams' => $this->commonParams]);
    }

    /**
     * 得意先概況問合  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateCustomerOverview(Request $request)
    {
		//return view('admin.sales.trn_order_receive_header.accountantIndex');
    }

}
