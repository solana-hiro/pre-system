<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\TrnPayHeaderService;
use App\Http\Requests\TrnPayHeader\TaxCalcurateRequest;
use App\Http\Requests\TrnPayHeader\DataDecisionRequest;
use App\Http\Requests\TrnPayHeader\PaymentListRequest;
use App\Http\Requests\TrnPayHeader\PaymentIssueRequest;
use App\Http\Requests\TrnPayHeader\ListRequest;
use App\Http\Requests\TrnPayHeader\SupplierLedgerRequest;
use App\Http\Requests\TrnPayHeader\UpdateClosingDateRequest;
use App\Http\Requests\TrnPayHeader\UpdateSequentiallyClosingRequest;
use App\Http\Requests\TrnPayHeader\UpdateSequentiallyClosingRemoveRequest;

class TrnPayHeaderController extends Controller
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
     * 支払締日変更処理  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showClosingDateChange(Request $request)
    {
		return view('admin.purchase.trn_pay_header.closingDateChange', ['commonParams' => $this->commonParams]);
    }

    /**
     * 支払締日変更処理  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateClosingDateChange(UpdateClosingDateRequest $request)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('execute')) {
			//実行
			//$datas = $service->updateTaxCalculate($request->input());
		}
		return redirect()->route('purchase_management.pay.closing_date.change.index');
    }

    /**
     * 支払随時締処理  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showSequentiallyClosing(Request $request)
    {
		return view('admin.purchase.trn_pay_header.sequentiallyClosing', ['commonParams' => $this->commonParams]);
    }

    /**
     * 支払随時締処理  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateSequentiallyClosing(UpdateSequentiallyClosingRequest $request)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('execute')) {
			//実行
			//$datas = $service->updateTaxCalculate($request->input());
		}
		return redirect()->route('purchase_management.pay.sequentially.closing.index');
    }

    /**
     * 支払随時締解除処理  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showSequentiallyClosingRemove(Request $request)
    {
		return view('admin.purchase.trn_pay_header.sequentiallyClosingRemove', ['commonParams' => $this->commonParams]);
    }

    /**
     * 支払随時締解除処理  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateSequentiallyClosingRemove(UpdateSequentiallyClosingRemoveRequest $request)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('execute')) {
			//実行
			//$datas = $service->updateTaxCalculate($request->input());
		}
		return redirect()->route('purchase_management.pay.sequentially.closing.remove.index');
    }

    /**
     * 支払時消費税一括計算  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showTaxCalculate(Request $request)
    {
		return view('admin.purchase.trn_pay_header.taxCalculate', ['commonParams' => $this->commonParams]);
    }

    /**
     * 支払時消費税一括計算  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateTaxCalculate(TaxCalcurateRequest $request, TrnPayHeaderService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('execute')) {
			//実行
			$datas = $service->updateTaxCalculate($request->input());
		}
		return view('admin.purchase.trn_pay_header.taxCalculate', ['commonParams' => $this->commonParams]);
    }

    /**
     * 支払データ確定処理  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showDataDecision(Request $request)
    {
		return view('admin.purchase.trn_pay_header.dataDecision', ['commonParams' => $this->commonParams]);
    }

    /**
     * 支払データ確定処理  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateDataDecision(DataDecisionRequest $request, TrnPayHeaderService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('delete')) {
			//削除
			$datas = $service->deleteDataDecision($request->input());
		} elseif($request->has('execute')) {
			//実行
			$datas = $service->updateDataDecision($request->input());
		}
		return view('admin.purchase.trn_pay_header.dataDecision', ['commonParams' => $this->commonParams]);
    }

    /**
     * 支払一覧表  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showPaymentList(Request $request)
    {
		return view('admin.purchase.trn_pay_header.paymentList', ['commonParams' => $this->commonParams]);
    }

    /**
     * 支払一覧表  PDF・Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportPaymentList(PaymentListRequest $request, TrnPayHeaderService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('pdf')) {
			//PDF
			$datas = $service->getPdfPaymentList($request->input());
		} elseif($request->has('excel')) {
			//EXCEL
			$datas = $service->getPdfPaymentList($request->input());
		}
		return view('admin.purchase.trn_pay_header.paymentList', ['commonParams' => $this->commonParams]);
    }

    /**
     * 支払明細書  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showPaymentIssue(Request $request)
    {
		return view('admin.purchase.trn_pay_header.paymentIssue', ['commonParams' => $this->commonParams]);
    }

    /**
     * 支払明細書  Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportPaymentIssue(PaymentIssueRequest $request, TrnPayHeaderService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
			//EXCEL
			$datas = $service->getPaymentIssue($request->input());
		}
		return view('admin.purchase.trn_pay_header.paymentIssue', ['commonParams' => $this->commonParams]);
    }

    /**
     * 支払計上入力  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showAccountant(Request $request)
    {
      
		  return view('admin.purchase.trn_pay_header.accountantIndex', ['commonParams' => $this->commonParams]);
    }

    /**
     * 支払計上入力  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateAccountant(Request $request)
    {
		//return view('admin.sales.trn_order_receive_header.accountantIndex', ['commonParams' => $this->commonParams]);
    }

    /**
     * 買掛残高一覧表  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showList(Request $request)
    {
		return view('admin.purchase.trn_pay_header.list', ['commonParams' => $this->commonParams]);
    }

    /**
     * 買掛残高一覧表  Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportList(ListRequest $request, TrnPayHeaderService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
			//EXCEL
			$datas = $service->getList($request->input());
		}
		return view('admin.purchase.trn_pay_header.list', ['commonParams' => $this->commonParams]);
    }

    /**
     * 仕入先元帳  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showSupplierLedger(Request $request)
    {
		return view('admin.purchase.trn_pay_header.supplierLedger', ['commonParams' => $this->commonParams]);
    }

    /**
     * 仕入先元帳  プレビュー表示・PDF出力・Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportSupplierLedger(SupplierLedgerRequest $request, TrnPayHeaderService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('preview')) {
			//プレビュー
			$datas = $service->getPreviewSupplierLedger($request->input());
		} elseif($request->has('pdf')) {
			//PDF
			$datas = $service->getPreviewSupplierLedger($request->input());
		} elseif($request->has('excel')) {
			//EXCEL
			$datas = $service->getPreviewSupplierLedger($request->input());
		}
		return view('admin.purchase.trn_pay_header.supplierLedger', ['commonParams' => $this->commonParams]);
    }

}
