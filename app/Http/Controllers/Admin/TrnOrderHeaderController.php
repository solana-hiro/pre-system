<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\TrnOrderHeaderService;
use App\Models\TrnOrderDetail;
use App\Services\CommonService;
use App\Http\Requests\TrnOrderHeader\SlipIssueRequest;
use App\Http\Requests\TrnOrderHeader\CheckListRequest;
use App\Http\Requests\TrnOrderHeader\OrderBalanceListItemRequest;
use App\Http\Requests\TrnOrderHeader\OrderBalanceListSupplierRequest;
use App\Exports\CommonExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\Services\TrnOrderDetailService;

class TrnOrderHeaderController extends Controller
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
     * 発注計上入力  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showAccountant(Request $request, TrnOrderHeaderService $service)
    {
        $orderData = $service->getAll();
        return view('admin.purchase.trn_order_header.orderInput', ['commonParams' => $this->commonParams, 'orderData' => $orderData]);
    }
    
    /**
     * 発注計上入力  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateAccountant(Request $request)
    {
		//return view('admin.sales.trn_order_receive_header.accountantIndex', ['commonParams' => $this->commonParams]);
    }

    /**
     * 発注問合せ  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showInquiry(Request $request)
    {
		//return view('admin.sales.trn_order_receive_header.accountantIndex', ['commonParams' => $this->commonParams]);
    }

    /**
     * 発注問合せ  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateInquiry(Request $request)
    {
		//return view('admin.sales.trn_order_receive_header.accountantIndex', ['commonParams' => $this->commonParams]);
    }

    /**
     * 発注伝票一括発行  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showSlipIssue(Request $request, CommonService $commonService)
    {
        $supplierData = $commonService->searchSupplier();
		return view('admin.purchase.trn_order_header.slipIssue', ['commonParams' => $this->commonParams, 'supplierData' => $supplierData]);
    }

    /**
     * 入出庫ヘッダー　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, TrnOrderHeaderService $service)
    {
        $datas =  $service->codeAutoComplete($request->input('trn_order_header_id'));
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 発注伝票一括発行  プレビュー表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportSlipIssue(SlipIssueRequest $request, TrnOrderHeaderService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('preview')) {
			//プレビュー表示
			$datas = $service->getSlipIssue($request->input());
            if ($datas->isEmpty()) {
                return back()->withInput()->with('flashmessage', __("validation.error_messages.data_is_not_exist"));
            }
            /* TODO: Preview
            $fileName = "仕入先マスタ（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'startDate' => str_pad($request['code_start'], 6, 0, STR_PAD_LEFT),
                'endDate' => str_pad($request['code_end'], 6, 0, STR_PAD_LEFT),
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            $view = view('export.mt_supplier_list', compact('params'));

            if (isset($view) && isset($fileName)) {
                return Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
            }
            */

		}
        return redirect()->route('purchase_management.order.slip.issue.index');
    }

    /**
     * 発注チェックリスト  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showChecklist(Request $request)
    {
		return view('admin.purchase.trn_order_header.checkList', ['commonParams' => $this->commonParams]);
    }

    /**
     * 発注チェックリスト  Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportChecklist(CheckListRequest $request, TrnOrderHeaderService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
            $param = $request->input();
        	$datas = $service->getChecklist($param);
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "発注チェックリスト_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                //'startDate' => str_pad($request['code_start'], 6, 0, STR_PAD_LEFT),
                //'endDate' => str_pad($request['code_end'], 6, 0, STR_PAD_LEFT),
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];

            $view = view('export.trn_order_header_checklist', compact('params'));
            $headers = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/octet-stream'
            ];
            $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $headers);
            if ($result->getStatusCode() !== 200) {
                //$flashmessage = $result->get
                //return back()->withInput()->with('flashmessage', $flashmessage);
            }
            return $result;

		}
        return redirect()->route('purchase_management.order.checklist.index');
    }

    /**
     * 発注残一覧表(仕入先別納期別)  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showOrderBalanceListSupplier(OrderBalanceListSupplierRequest $request, CommonService $commonService)
    {
        $supplierData = $commonService->searchSupplier();
		return view('admin.purchase.trn_order_header.orderBalanceListSupplier', ['commonParams' => $this->commonParams, 'supplierData' => $supplierData]);
    }

    /**
     * 発注残一覧表(仕入先別納期別)  Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportOrderBalanceListSupplier(OrderBalanceListSupplierRequest $request, TrnOrderHeaderService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
			//Excel
            $param = $request->input();
        	$datas = $service->getOrderBalanceListSupplier($param);
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "発注残一覧表(仕入先別納期別)_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                //'startDate' => str_pad($request['code_start'], 6, 0, STR_PAD_LEFT),
                //'endDate' => str_pad($request['code_end'], 6, 0, STR_PAD_LEFT),
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];

            $view = view('export.trn_order_balance_list_supplier', compact('params'));
            $headers = [
                    'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                    'Content-Type' => 'application/octet-stream'
                ];
            $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $headers);
            if ($result->getStatusCode() !== 200) {
                //$flashmessage = $result->get
                //return back()->withInput()->with('flashmessage', $flashmessage);
            }
            return $result;
		}
        return redirect()->route('purchase_management.order.order_balance.list.supplier.index');
    }

    /**
     * 発注残一覧表(商品別納期別)  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showOrderBalanceListItem(Request $request, CommonService $commonService)
    {
        $itemData = $commonService->searchItem();
		return view('admin.purchase.trn_order_header.orderBalanceListItem', ['commonParams' => $this->commonParams, 'itemData' => $itemData]);
    }

    /**
     * 発注残一覧表(商品別納期別)  Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportOrderBalanceListItem(OrderBalanceListItemRequest $request, TrnOrderHeaderService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
			$param = $request->input();
        	$datas = $service->getOrderBalanceListItem($request->input());
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "発注残一覧表(商品別納期別)_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                //'startDate' => str_pad($request['code_start'], 6, 0, STR_PAD_LEFT),
                //'endDate' => str_pad($request['code_end'], 6, 0, STR_PAD_LEFT),
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];

            $view = view('export.trn_order_balance_list_item', compact('params'));
            $headers = [
                    'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                    'Content-Type' => 'application/octet-stream'
                ];
            $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $headers);
            if ($result->getStatusCode() !== 200) {
                //$flashmessage = $result->get
                //return back()->withInput()->with('flashmessage', $flashmessage);
            }
            return $result;
		}
        return redirect()->route('purchase_management.order.order_balance.list.item.index');
    }

    /**
     * 発注割当数変更  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showQuotaChange(Request $request)
    {
		//return view('admin.sales.trn_order_receive_header.accountantIndex', ['commonParams' => $this->commonParams]);
    }

    /**
     * 発注割当数変更  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateQuotaChange(Request $request)
    {
		//return view('admin.sales.trn_order_receive_header.accountantIndex', ['commonParams' => $this->commonParams]);
    }

}
