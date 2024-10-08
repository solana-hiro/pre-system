<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\TrnSaleHeaderService;
use App\Services\CommonService;
use App\Http\Requests\TrnSaleHeader\CheckListRequest;
use App\Http\Requests\TrnSaleHeader\SlipListRequest;
use App\Http\Requests\TrnSaleHeader\UpdateSalesDataRequest;
use App\Http\Requests\TrnSaleHeader\UpdateSalesDecisionRequest;
use App\Exports\TrnSaleHeaderChecklistExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;

class TrnSaleHeaderController extends Controller
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
     * 売上確定処理 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showSaleDecision(Request $request, TrnSaleHeaderService $service)
    {

		return view('admin.sales.trn_sale_receive_header.saleDecision', ['commonParams' => $this->commonParams]);
    }

    /**
     * 売上確定処理  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateSaleDecision(UpdateSalesDecisionRequest $request, TrnSaleHeaderService $service)
    {
        if ($request->has('cancel')) {
            return redirect()->route('sales_management.shipping.sale.decision.index');
        } elseif ($request->has('update')) {
            //登録  確定ボタン?
            $datas =  $service->exportSlipList($request->input());
            // メール送信
        } elseif ($request->has('execute')) {
            //一括反映
            $datas =  $service->executeSaleDecision($request->input());
        }
        return redirect()->route('sales_management.shipping.sale.decision.index');
    }

    /**
     * 売上計上入力  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showAccountant(Request $request)
    {
		return view('admin.sales.trn_sale_header.accountantIndex', ['commonParams' => $this->commonParams]);
    }

    /**
     * 売上計上入力  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateAccountant(Request $request)
    {
		//
    }

    /**
     * 売上伝票一括発行  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showSlipList(Request $request, CommonService $commonService)
    {
        //倉庫検索、伝票検索、得意先コード検索
        $warehouseData = $commonService->searchWarehouse();
        $customerData = $commonService->searchCustomer();
		return view('admin.sales.trn_sale_header.slipList', ['commonParams' => $this->commonParams,
            'warehouseData' => $warehouseData, 'customerData' => $customerData
        ]);
    }

    /**
     * 売上伝票一括発行  プレビュー表示・キャンセル
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportSlipList(SlipListRequest $request, TrnSaleHeaderService $service)
    {
        $param = $request->input();
    	if($request->has('cancel')) {
            return back();
		} elseif($request->has('preview')) {
            //プレビュー情報取得
            $datas = $service->exportSlipList($param);
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "売上伝票_" . Carbon::now()->format('Ymd') . ".xlsx";
            // 指定納期, データ
            $params = [
                'startCode' => ($param['code_start']) ? str_pad($param['code_start'], 4, 0, STR_PAD_LEFT) : '',
                'endCode' => ($param['code_end']) ? str_pad($param['code_end'], 4, 0, STR_PAD_LEFT) : 'ZZZZ',
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            //$view = view('export.total_picking_list_preview', compact('params'));
            //return $view;
		}
		return view('admin.sales.trn_sale_header.slipList', ['commonParams' => $this->commonParams]);
    }

    /**
     * 売上チェックリスト発行  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showChecklist(Request $request, CommonService $commonService)
    {
        $customerData = $commonService->searchCustomer();
        $managerData = $commonService->searchManager();
		return view('admin.sales.trn_sale_header.checkList', ['commonParams' => $this->commonParams,
            'customerData' => $customerData, 'managerData' => $managerData
        ]);
    }

    /**
     * 売上チェックリスト発行  EXCEL出力・キャンセル
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportChecklist(CheckListRequest $request, TrnSaleHeaderService $service)
    {
    	if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
		    //EXCEL出力
        	$datas =  $service->exportChecklist($request->input());
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            //帳票区分(document_kbn), 出力順(sort_order)ごと
            $fileName = "売上チェックリスト_" . Carbon::now()->format('Ymd') . ".xlsx";
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
            $view = view('export.trn_sale_header_checklist', compact('params'));
            if (isset($view) && isset($fileName)) {
                return Excel::download(new TrnSaleHeaderChecklistExport($view), $fileName, Excels::XLSX, $header);
            } else {
                return redirect()->route('sales_management.sales.checklist.index');
            }
		}
        return redirect()->route('sales_management.sales.checklist.index');
    }

    /**
     * 売上データ取込  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function indexSalesDataImport(Request $request)
    {
		return view('admin.alignment.keyence.salesDataImport', ['commonParams' => $this->commonParams]);
    }

    /**
     * 売上データ取込  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateSalesDataImport(UpdateSalesDataRequest $request, TrnSaleHeaderService $service)
    {
        if($request->has('cancel')) {
            return back();
		} elseif($request->has('preview')) {
			$result = $service->updateSalesDataImport($request->input());
		} elseif($request->has('excel')) {
			$result = $service->updateSalesDataImport($request->input());
		} elseif($request->has('excel')) {
			$result = $service->updateSalesDataImport($request->input());
		}
		return redirect()->route('alignment.keyence.sales_data.import.index');
    }
}
