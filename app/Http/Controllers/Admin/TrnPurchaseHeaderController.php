<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\TrnPurchaseHeaderService;
use App\Services\CommonService;
use App\Http\Requests\TrnPurchaseHeader\CheckListRequest;
use App\Http\Requests\TrnPurchaseHeader\ItemDailyListRequest;
use App\Exports\CommonExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;

class TrnPurchaseHeaderController extends Controller
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
     * 仕入計上入力  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showAccountant(Request $request)
    {
		//return view('admin.sales.trn_order_receive_header.accountantIndex', ['commonParams' => $this->commonParams]);
    }

    /**
     * 仕入計上入力  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateAccountant(Request $request)
    {
		//return view('admin.sales.trn_order_receive_header.accountantIndex', ['commonParams' => $this->commonParams]);
    }

    /**
     * 仕入チェックリスト  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showChecklist(Request $request, CommonService $commonService)
    {
        $supplierData = $commonService->searchSupplier();
		return view('admin.purchase.trn_purchase_header.checkList', ['commonParams' => $this->commonParams, 'supplierData' => $supplierData]);
    }

    /**
     * 仕入チェックリスト  Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportChecklist(CheckListRequest $request, TrnPurchaseHeaderService $service)
    {
		if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
			//Excel出力
            $param = $request->input();
			$datas = $service->getChecklist($param);
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $params = [
                //'startDate' => str_pad($request['code_start'], 6, 0, STR_PAD_LEFT),
                //'endDate' => str_pad($request['code_end'], 6, 0, STR_PAD_LEFT),
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            // 帳票区分+出力順
            if($param['report_kbn'] === '0') {  //伝票単位
                $fileName = "仕入チェックリスト(伝票単位)_" . Carbon::now()->format('Ymd') . ".xlsx";
                $view = view('export.trn_purchase_header_checklist_slip', compact('params'));
            } elseif ($param['report_kbn'] === '1') {  //商品単位
                $fileName = "仕入チェックリスト(商品単位)_" . Carbon::now()->format('Ymd') . ".xlsx";
                $view = view('export.trn_purchase_header_checklist_item', compact('params'));
            } elseif ($param['report_kbn'] === '2') {   //SKU単位
                $fileName = "仕入チェックリスト(SKU単位)_" . Carbon::now()->format('Ymd') . ".xlsx";
                $view = view('export.trn_purchase_header_checklist_sku', compact('params'));
            }
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
        return redirect()->route('purchase_management.purchase.checklist.index');
    }

    /**
     * 商品仕入日計表  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showItemDailyList(Request $request, CommonService $commonService)
    {
        $itemData = $commonService->searchItem();
		return view('admin.purchase.trn_purchase_header.itemDailyList', ['commonParams' => $this->commonParams, 'itemData' => $itemData]);
    }

    /**
     * 商品仕入日計表  Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportItemDailyList(ItemDailyListRequest $request, TrnPurchaseHeaderService $service)
    {

		if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
            //Excel出力
            $param = $request->input();
        	$datas = $service->getItemDailyList($param);
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $params = [
                //'startDate' => str_pad($request['code_start'], 6, 0, STR_PAD_LEFT),
                //'endDate' => str_pad($request['code_end'], 6, 0, STR_PAD_LEFT),
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $fileName = "商品仕入日計表_" . Carbon::now()->format('Ymd') . ".xlsx";
            $view = view('export.trn_purchase_header_item_daily_list', compact('params'));
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
        return redirect()->route('purchase_management.purchase.item_daily.list.index');
    }

}
