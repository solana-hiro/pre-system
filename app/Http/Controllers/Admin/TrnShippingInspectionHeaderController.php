<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\TrnShippingInspectionHeaderService;
use App\Services\CommonService;
use App\Http\Requests\TrnShippingInspectionHeader\TotalPickingListRequest;
use App\Http\Requests\TrnShippingInspectionHeader\PickingListRequest;
use App\Http\Requests\TrnShippingInspectionHeader\GuidanceIssueRequest;
use App\Http\Requests\TrnShippingInspectionHeader\InspectionRequest;
use App\Exports\GuidanceIssueExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;

class TrnShippingInspectionHeaderController extends Controller
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
     * ピッキングリスト発行 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showPickingList(Request $request, CommonService $commonService)
    {
        $customerData = $commonService->searchCustomer();
        $deliveryDestinationData = $commonService->searchDeliveryDestination();
        $rootData = $commonService->searchRoot();
		return view('admin.sales.trn_shipping_inspection_header.pickingList', ['commonParams' => $this->commonParams,
            'customerData' => $customerData, 'deliveryDestinationData' => $deliveryDestinationData, 'rootData' => $rootData
        ]);
    }

    /**
     * ピッキングリスト発行 キャンセル・プレビュー表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportPickingList(PickingListRequest $request, TrnShippingInspectionHeaderService $service)
    {
        $param = $request->input();
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('preview')) {
            //プレビュー情報取得
            $datas = $service->getPickingList($param);
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "トータルピッキングリスト_" . Carbon::now()->format('Ymd') . ".xlsx";
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
        return redirect()->route('sales_management.shipping.picking_list.issue.export');
	}

    /**
     * 出荷検品処理 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showInspection(Request $request, TrnShippingInspectionHeaderService $service)
    {
        $datas = $service->getInspection($request->input());
		return view('admin.sales.trn_shipping_inspection_header.shippingGuidance', ['commonParams' => $this->commonParams]);
    }

    /**
     * 出荷検品処理　登録・手検品・キャンセル
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateInspection(InspectionRequest $request, TrnShippingInspectionHeaderService $service)
    {
    	if($request->has('cancel')) {
            //MESSAGE: 検品ステータスは更新されませんが、キャンセルしますか？
			return back();
		} elseif($request->has('inspection')) {
			//手検品
			$datas = $service->executeInspection($request->input());
		} elseif($request->has('update')) {
			//更新
			$datas = $service->updateInspection($request->input());
		}
		//return view('admin.sales.trn_shipping_inspection_header.totalPickingList', ['commonParams' => $this->commonParams]);
    }

    /**
     * 出荷案内発行 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showGuidanceIssue(Request $request, TrnShippingInspectionHeaderService $service)
    {
		return view('admin.sales.trn_shipping_inspection_header.guidanceIssue', ['commonParams' => $this->commonParams]);
    }

    /**
     * 出荷案内発行 キャンセル・Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportGuidanceIssue(GuidanceIssueRequest $request, TrnShippingInspectionHeaderService $service)
    {
    	if($request->has('cancel')) {
            return back();
		} elseif($request->has('excel')) {
		    //EXCEL出力
        	$datas = $service->getGuidanceIssue($request->input());
            /*
            if($datas->empty()) {
                // 対象のデータはありません。
            }
            */
            $fileName = "出荷案内_" . Carbon::now()->format('Ymd') . ".xlsx";
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
            $view = view('export.guidance_issue_list', compact('params'));

            if (isset($view) && isset($fileName)) {
                return Excel::download(new GuidanceIssueExport($view), $fileName, Excels::XLSX, $header);
            } else {
                return redirect()->route('sales_management.shipping.guidance.issue.index');
            }
		}
        return redirect()->route('sales_management.shipping.guidance.issue.index');
    }

    /**
     * トータルピッキングリスト発行 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showTotalPickingList(Request $request, TrnShippingInspectionHeaderService $service, CommonService $commonService)
    {
        // 検索: 受注伝票, 得意先コード, 納品先コード, ルートコード範囲, ブランド1コード
        // TODO:受注伝票
        $customerData = $commonService->searchCustomer();
        $deliveryDestinationData = $commonService->searchDeliveryDestination();
        $rootData = $commonService->searchRoot();
        $rank3Data = $commonService->searchRank3();
        $brand1Data = $commonService->searchBrand1();
		return view('admin.sales.trn_shipping_inspection_header.totalPickingList', ['commonParams' => $this->commonParams,
            'customerData' => $customerData, 'deliveryDestinationData' => $deliveryDestinationData, 'rootData' => $rootData,
            'brand1Data' => $brand1Data, 'rank3Data' => $rank3Data
        ]);
    }

    /**
     * トータルピッキングリスト発行　キャンセル・プレビュー表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportTotalPickingList(TotalPickingListRequest $request, TrnShippingInspectionHeaderService $service)
    {
        $param = $request->input();
    	if($request->has('cancel')) {
            return back();
		} elseif($request->has('preview')) {
            //プレビュー情報取得
            $datas = $service->getTotalPickingList($param);
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "トータルピッキングリスト_" . Carbon::now()->format('Ymd') . ".xlsx";
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
		return redirect()->route('sales_management.shipping.total_picking_list.issue.export');
	}
}
