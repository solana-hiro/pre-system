<?php

namespace App\Http\Controllers\Admin;

use App\Services\TrnOrderReceiveHeaderService;
use App\Services\TrnOrderReceiveDetailService;
use App\Services\MtOrderReceiveStickyNoteService;
use App\Services\MtItemService;
use App\Services\CommonService;
use App\Http\Requests\TrnOrderReceiveHeader\ShippingInquiryRequest;
use App\Http\Requests\TrnOrderReceiveHeader\AccountantInquiryRequest;
use App\Http\Requests\TrnOrderReceiveHeader\AccountantRequest;
use App\Exports\ShippingInquiryExport;
use App\Exports\CommonExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Consts\CommonConsts;
use Exception;

class TrnOrderReceiveHeaderController extends Controller
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
        // ログインしているユーザーの情報
        $this->commonParams = ['menus' => $menus, 'pageInfo' => $pageInfo];
    }

    /**
     * 受注計上入力  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showAccountant(Request $request, TrnOrderReceiveHeaderService $service, MtOrderReceiveStickyNoteService $mtOrderReceiveStickyNoteService)
    {
        // 初期表示するデーターの用意
        $accountant_default_data = $service->getAccountantDefaultData();
        // 付箋マスタ取得
        $stickyNotes = $mtOrderReceiveStickyNoteService->getStickyNotesForReceiveOrder();
        return view('admin.sales.trn_order_receive_header.accountantIndex', ['commonParams' => $this->commonParams, 'accountant_default_data' => $accountant_default_data, 'stickyNotes' => $stickyNotes]);
    }

    /**
     * 受注計上入力  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function updateAccountant(AccountantRequest $request, TrnOrderReceiveHeaderService $service, TrnOrderReceiveDetailService $detailService)
    {
//        return redirect()->back()->withErrors(['custom_error' => 'エラーが発生しました。'])->withInput();
        // 'action'の値で処理を分岐
        if ($request->has('create')) {
            // 色んなチェックを行う
            if ($this->checkProcessKbnWithOutOfStock($request->input(), $detailService)) {
                return redirect()->back()->withErrors(['custom_error' => $this->checkProcessKbnWithOutOfStock($request->input(), $detailService)])->withInput();
            }
            if ($this->checkSpecifyDeadline($request->input(), $detailService)) {
                return redirect()->back()->withErrors(['custom_error' => $this->checkSpecifyDeadline($request->input(), $detailService)])->withInput();
            }
            if ($this->checkOrderReceiveAmount($request->input(), $detailService)) {
                return redirect()->back()->withErrors(['custom_error' => $this->checkOrderReceiveAmount($request->input(), $detailService)])->withInput();
            }
            if ($this->checkCreditLimit($request->input(), $detailService)) {
                return redirect()->back()->withErrors(['confirm_error' => $this->checkCreditLimit($request->input(), $detailService)])->withInput();
            }
            if ($this->checkCommission($request->input(), $detailService)) {
                return redirect()->back()->withErrors(['commission_confirm_error' => $this->checkCommission($request->input(), $detailService)])->withInput();
            }

            $trnOrderReceiveHeader = $service->createTrnOrderReceiveHeader($request->input());

            if ($trnOrderReceiveHeader) {
                $trnOrderReceiveHeaderId = $trnOrderReceiveHeader->id;
                $detailService->createTrnOrderReceiveDetail($request->input(), $trnOrderReceiveHeaderId);
                // redirectする
                return redirect()->route('sales_management.order_receive.accountant.index');
            } else {
                return redirect()->back()->withErrors(['custom_error' => '受注Noが存在しています'])->withInput();
            }
        }
        return redirect()->route('sales_management.order_receive.accountant.index');
    }

    private function checkProcessKbnWithOutOfStock($params, $detailService)
    {
        return $detailService->checkProcessKbnWithOutOfStock($params);
    }

    private function checkSpecifyDeadline($params, $detailService)
    {
        return $detailService->checkSpecifyDeadline($params);
    }

    private function checkOrderReceiveAmount($params, $detailService)
    {
        return $detailService->checkOrderReceiveAmount($params);
    }

    private function checkCreditLimit($params, $detailService)
    {
        return $detailService->checkCreditLimit($params);
    }

    private function checkCommission($params, $detailService)
    {
        return $detailService->checkCommission($params);
    }

    /**
     * 受注リスト  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function showAccountantList(Request $request, TrnOrderReceiveHeaderService $service, MtOrderReceiveStickyNoteService $mtOrderReceiveStickyNoteService)
    {
        // ボタン権限取得の処理
        $all_permission = $this->getSecurityInfo();
        $permissions = $all_permission->filter(function($pms) {
            return $pms['mt_user_id'] == Auth::guard('user')->user()->id && $pms['def_1_menu_id'] == 1 && $pms['def_2_menu_id'] == 1 && $pms['def_3_menu_id'] == 2;
        });
        $permission = $permissions->first();

        // 受注情報取得の処理
        $params = $request->input();
        $orders = $service->searchOrderReceiveList($params);

        // 付箋マスタ取得
        $stickyNotes = $mtOrderReceiveStickyNoteService->getStickyNotesForReceiveOrder();

        return view('admin.sales.trn_order_receive_header.accountantList', ['commonParams' => $this->commonParams, 'permission' => $permission, 'orders' => $orders, 'stickyNotes' => $stickyNotes]);
    }

    public function updateAccountantList(Request $request, TrnOrderReceiveHeaderService $service)
    {
        $service->updateAccountantList($request->input());

        return redirect()->route('sales_management.order_receive.accountant.list');
    }

    /**
     * 受注リスト  出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function exportAccountantList(Request $request)
    {
		//return view('admin.sales.trn_order_receive_header.accountantList', ['commonParams' => $this->commonParams]);
    }

    /**
     * 受注問合せ  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function accountantInquiry(Request $request, CommonService $commonService)
    {
        $itemData = $commonService->searchItem();
        $brand1Data = $commonService->searchBrand1();
        $itemClassThing2Data = $commonService->searchItemClassThing2();
        $genreData = $commonService->searchGenre();
        $itemClassThing4Data = $commonService->searchClass4();
        $itemClassThing5Data = $commonService->searchItemClassThing5();
        $itemClassThing6Data = $commonService->searchItemClassThing6();
        $itemClassThing7Data = $commonService->searchItemClassThing7();
        $customerData = $commonService->searchCustomer();
		return view('admin.sales.trn_order_receive_header.accountantInquiry', ['commonParams' => $this->commonParams,
            'itemData' => $itemData, 'brand1Data' => $brand1Data, 'itemClassThing2Data' => $itemClassThing2Data, 'genreData' => $genreData,
            'itemClassThing4Data' => $itemClassThing4Data, 'itemClassThing5Data' => $itemClassThing5Data, 'itemClassThing6Data' => $itemClassThing6Data,
            'itemClassThing7Data' => $itemClassThing7Data, 'customerData' => $customerData
        ]);
    }

    /**
     * 受注問合せ  検索・出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function executeAccountantInquiry(AccountantInquiryRequest $request, TrnOrderReceiveHeaderService $service)
    {
        $param = $request->input();
    	if($request->has('cancel')) {
            if ($request->session()->has('searchCondition') == true) {
                $request->session()->forget('searchCondition');
            }
            if ($request->session()->has('listDatas') == true) {
                $request->session()->forget('listDatas');
            }
            return back();
        } elseif($request->has('search')) {
            $datas = $service->getAccountantInquiry($param);
            if ($datas->isEmpty()) {
                //一覧のリセット
                if ($request->session()->has('listDatas') == true) {
                    $request->session()->forget('listDatas');
                }
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            //dd($datas);
            //検索条件の保存
            $request->session()->put('searchCondition', $param);
            $request->session()->put('listDatas', $datas);
            return redirect()->route('sales_management.order_receive.accountant.inquiry');
        } elseif ($request->has('redirect')) {
            //一覧のリセット
            if ($request->session()->has('listDatas') == true) {
                $request->session()->forget('listDatas');
            }
            return redirect()->route('sales_management.order_receive.accountant.inquiry');
        }
        return redirect()->route('sales_management.order_receive.accountant.inquiry');
    }

    /**
     * 入出荷予定問合せ  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function shippingInquiry(Request $request, CommonService $commonService)
    {
        $itemData = $commonService->searchItem();
        $brand1Data = $commonService->searchBrand1();
        $itemClassThing2Data = $commonService->searchItemClassThing2();
        $genreData = $commonService->searchGenre();
        $itemClassThing4Data = $commonService->searchClass4();
        $itemClassThing5Data = $commonService->searchItemClassThing5();
        $itemClassThing6Data = $commonService->searchItemClassThing6();
        $itemClassThing7Data = $commonService->searchItemClassThing7();
        $colorData = $commonService->searchMtColor();
        $warehouseData = $commonService->searchWarehouse();
        $sizeData = $commonService->searchMtSize();
		return view('admin.sales.trn_order_receive_header.shippingInquiry', ['commonParams' => $this->commonParams,
            'itemData' => $itemData, 'colorData' => $colorData, 'warehouseData' => $warehouseData, 'sizeData' => $sizeData,
            'brand1Data' => $brand1Data, 'itemClassThing2Data' => $itemClassThing2Data, 'genreData' => $genreData,
            'itemClassThing4Data' => $itemClassThing4Data, 'itemClassThing5Data' => $itemClassThing5Data, 'itemClassThing6Data' => $itemClassThing6Data,
            'itemClassThing7Data' => $itemClassThing7Data,
        ]);
    }

    /**
     * 入出荷予定問合せ  実行(検索、Excel出力)
     * @param $request
     * @param $service
     * @return Object
     */
    public function executeShippingInquiry(ShippingInquiryRequest $request, TrnOrderReceiveHeaderService $service)
    {
        $param = $request->input();
        if ($request->has('cancel')) {
            if($request->session()->has('searchCondition') == true) {
                $request->session()->forget('searchCondition');
            }
            if ($request->session()->has('listDatas') == true) {
                $request->session()->forget('listDatas');
            }
            return back();
    	} elseif($request->has('preview') || $request->has('excel')) {
			//Excel出力
			$datas = $service->exportShippingInquiry($request->input());
            if ($datas->isEmpty()) {
                if ($request->session()->has('listDatas') == true) {
                    $request->session()->forget('listDatas');
                }
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
        	$fileName = "入出荷予定問合せ_".Carbon::now()->format('Ymd').".xlsx";
        	$params = [
                'target' => $param['target'] === '0' ? "すべて" : ($param['target'] === '1' ? "受注のみ" : "発注のみ"),
        		'startDate' => $param['start_date_y'].'/'. $param['start_date_m'].'/'. $param['start_date_d'],
        		'endDate' => $param['end_date_y'].'/'. $param['end_date_m'].'/'. $param['end_date_d'],
                'startItemCode' => ($param['start_item_code']) ? str_pad($param['start_item_code'], 5, 0, STR_PAD_LEFT) : '',
                'endItemCode' => ($param['end_item_code']) ? str_pad($param['end_item_code'], 5, 0, STR_PAD_LEFT) : 'ZZZZZZZZZ',
                'startColorCode' => ($param['start_color_code']) ? str_pad($param['start_color_code'], 5, 0, STR_PAD_LEFT) : '',
                'endColorCode' => ($param['end_color_code']) ? str_pad($param['end_color_code'], 5, 0, STR_PAD_LEFT) : 'ZZZZZ',
                'startSizeCode' => ($param['start_size_code']) ? str_pad($param['start_size_code'], 5, 0, STR_PAD_LEFT) : '',
                'endSizeCode' => ($param['end_size_code']) ? str_pad($param['end_size_code'], 5, 0, STR_PAD_LEFT) : 'ZZZZZ',
                'startWarehouseCode' => ($param['start_warehouse_code']) ? str_pad($param['start_warehouse_code'], 6, 0, STR_PAD_LEFT) : '',
                'endWarehouseCode' => ($param['end_warehouse_code']) ? str_pad($param['end_warehouse_code'], 6, 0, STR_PAD_LEFT) : 'ZZZZZZ',
        		'currentDate' => Carbon::now()->format('Y/m/d'),
        		'datas' => $datas,
        	];
        	$header = [
	            'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
	            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
	        ];
            if ($request->has('preview')) {
                $view = view('export.sales_shipping_inquiry_preview', compact('params'));
                return $view;
            } elseif ($request->has('excel')) {
                try {
                    $view = view('export.sales_shipping_inquiry_preview', compact('params'));
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        } elseif($request->has('search')) {
            //検索条件の保存
            $request->session()->put('searchCondition', $param);
        	$datas = $service->getShippingInquiry($param);
            if ($datas->isEmpty()) {
                if ($request->session()->has('listDatas') == true) {
                    $request->session()->forget('listDatas');
                }
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->with('sessionErrors', $sessionErrors);
            }
            $request->session()->put('listDatas', $datas);
            return redirect()->route('sales_management.order_receive.in_shipping.inquiry');
        }
		return redirect()->route('sales_management.order_receive.in_shipping.inquiry');
    }

}
?>
