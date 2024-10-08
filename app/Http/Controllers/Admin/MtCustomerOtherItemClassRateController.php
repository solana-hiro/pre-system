<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\MtCustomerOtherItemClassRateService;
use App\Services\CommonService;
use App\Http\Requests\MtCustomerOtherItemClassRate\ExportRequest;
use App\Http\Requests\MtCustomerOtherItemClassRate\UpdateRequest;
use App\Http\Requests\MtCustomerOtherItemClassRate\sellingPriceUpdateRequest;
use App\Http\Requests\MtCustomerOtherItemClassRate\sellingPriceExportRequest;
use App\Exports\MtCustomerOtherClassRateExport;
use App\Exports\CommonExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use App\Consts\CommonConsts;
use App\Services\MtCustomerService;
use Exception;

class MtCustomerOtherItemClassRateController extends Controller
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
     * 得意先別商品分類掛率マスタ入力  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function indexForNew(Request $request, MtCustomerOtherItemClassRateService $itemClassRateService)
    {
        $view = 'admin.master.price.mt_customer_other_item_class_rate.index_for_new';
        return $this->index($request, $itemClassRateService, $view);
    }

    public function indexForFix(Request $request, MtCustomerOtherItemClassRateService $itemClassRateService)
    {
        $view = 'admin.master.price.mt_customer_other_item_class_rate.index_for_fix';
        return $this->index($request, $itemClassRateService, $view);
    }

    private function index(Request $request, MtCustomerOtherItemClassRateService $itemClassRateService, $view)
    {
        $customer = null;
        $existsItemClassRates = $itemClassRateService->existsItemClassRates(['customer_id' => null]);

        return view($view, [
            'commonParams' => $this->commonParams,
            'customer' => $customer,
            'existsItemClassRates' => $existsItemClassRates,
        ]);
    }

    /**
     * 得意先別商品分類掛率マスタ入力  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function indexByIdForNew($id, Request $request, MtCustomerService $customerService, MtCustomerOtherItemClassRateService $itemClassRateService)
    {
        $view = 'admin.master.price.mt_customer_other_item_class_rate.index_for_new';
        return $this->indexById($id, $request, $customerService, $itemClassRateService, $view);
    }

    public function indexByIdForFix($id, Request $request, MtCustomerService $customerService, MtCustomerOtherItemClassRateService $itemClassRateService)
    {
        $view = 'admin.master.price.mt_customer_other_item_class_rate.index_for_fix';
        return $this->indexById($id, $request, $customerService, $itemClassRateService, $view);
    }

    private function indexById($id, Request $request, MtCustomerService $customerService, MtCustomerOtherItemClassRateService $itemClassRateService, $view)
    {
        $customer = $customerService->getById(['id' => $id]);
        $existsItemClassRates = $itemClassRateService->existsItemClassRates(['customer_id' => $id]);

        return view($view, [
            'commonParams' => $this->commonParams,
            'customer' => $customer,
            'existsItemClassRates' => $existsItemClassRates,
        ]);
    }

    public function pageByIdForNew($id, Request $request, MtCustomerService $customerService, MtCustomerOtherItemClassRateService $itemClassRateService)
    {
        $view = 'admin.master.price.mt_customer_other_item_class_rate.index_for_new';
        return $this->pageById($id, $request, $customerService, $itemClassRateService, $view);
    }

    public function pageByIdForFix($id, Request $request, MtCustomerService $customerService, MtCustomerOtherItemClassRateService $itemClassRateService)
    {
        $view = 'admin.master.price.mt_customer_other_item_class_rate.index_for_fix';
        return $this->pageById($id, $request, $customerService, $itemClassRateService, $view);
    }

    private function pageById($id, Request $request, MtCustomerService $customerService, MtCustomerOtherItemClassRateService $itemClassRateService, $view)
    {
        // $id = nullのリクエストがbladeから送信できないため
        // $id = 0 のリクエストで代用しServiceで0はnullとして扱う
        $customer = $customerService->getById(['id' => $id]);
        $itemClassRates = $itemClassRateService->get(['customer_id' => $id]);

        return view($view, [
            'commonParams' => $this->commonParams,
            'customer' => $customer,
            'itemClassRates' => $itemClassRates,
        ]);
    }

    /**
     * 得意先別商品分類掛率マスタ入力  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(UpdateRequest $request, MtCustomerOtherItemClassRateService $service)
    {
        if ($request->has('cancel')) return redirect()->route('master.price.mt_customer_other_item_class_rate.index_for_new');
        if ($request->has('update')) {
            $result = $service->update($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error") . '<br><br>' . $result['error'];
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()
                    ->route('master.price.mt_customer_other_item_class_rate.index_for_new')
                    ->with('flashmessage', $flashmessage);
            }
        }
        if ($request->has('redirect')) {
            $id = $request->input('redirect');
            if ($id == 0) return redirect()->route("master.price.mt_customer_other_item_class_rate.index{$this->getNewOrFixRoute($request)}");
            return redirect()->route("master.price.mt_customer_other_item_class_rate.index_by_id{$this->getNewOrFixRoute($request)}", ['id' => $id]);
        }
        if ($request->has('mode')) {
            $id = $request->input('mode');
            $routeIndex = 'master.price.mt_customer_other_item_class_rate.index';
            $routeIndexById = 'master.price.mt_customer_other_item_class_rate.index_by_id';
            return is_null($id)
                ? redirect()->route("{$routeIndex}{$this->getNewOrFixRoute($request)}")->withInput($request->except('item_classes'))
                : redirect()->route("{$routeIndexById}{$this->getNewOrFixRoute($request)}", ['id' => $id])->withInput($request->except('item_classes'));
        }

        return redirect()->route('master.price.mt_customer_other_item_class_rate.index_for_new');
    }

    private function getNewOrFixRoute($request)
    {
        return $request->input('kbn') == 0 ? '_for_new' : '_for_fix';
    }

    /**
     * 得意先別商品分類掛率マスタリスト  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function list(Request $request, CommonService $commonService)
    {
        $customerData = $commonService->searchCustomer();
        $brand1Data = $commonService->searchBrand1();
        return view('admin.master.price.mt_customer_other_item_class_rate.list', ['commonParams' => $this->commonParams, 'customerData' => $customerData, 'brand1Data' => $brand1Data]);
    }

    /**
     * 得意先別商品分類掛率マスタリスト 出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function export(ExportRequest $request, MtCustomerOtherItemClassRateService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('preview') || $request->has('excel')) {
            $param = $request->input();
            $datas = $service->export($request->input());
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "得意先別商品分類掛率マスタ（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'customerStartCode' => ($param['customer_code_start']) ? str_pad($param['customer_code_start'], 6, 0, STR_PAD_LEFT) : '',
                'customerEndCode' => ($param['customer_code_end']) ? str_pad($param['customer_code_end'], 6, 0, STR_PAD_LEFT) : 'ZZZZZZ',
                'brandStartCode' => ($param['brand_code_start']) ? $param['brand_code_start'] : '',
                'brandEndCode' => ($param['brand_code_end']) ? $param['brand_code_end'] : 'ZZZZZZ',
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];

            if ($request->has('preview')) {
                $view = view('export.mt_customer_other_item_class_rate_list_preview', compact('params'));
                return $view;
            } elseif ($request->has('excel')) {
                try {
                    $view = view('export.mt_customer_other_item_class_rate_list', compact('params'));
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        }
        return redirect()->route('master.price.mt_customer_other_item_class_rate.list');
    }

    /**
     * 売価情報マスタ  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function sellingPriceIndex(Request $request)
    {
        return view('admin.master.price.mt_customer_other_item_class_rate.sellingPriceIndex', ['commonParams' => $this->commonParams]);
    }

    /**
     * 売価情報マスタリスト 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function sellingPriceList(Request $request)
    {
        return view('admin.master.price.mt_customer_other_item_class_rate.sellingPriceList', ['commonParams' => $this->commonParams]);
    }

    /**
     * 売価情報マスタ 更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function sellingPriceUpdate(sellingPriceUpdateRequest $request, MtCustomerOtherItemClassRateService $service)
    {
        /* 対応不要
        if($request->has('cancel')) {
			return redirect()->route('master.price.selling_price.index');
		} elseif($request->has('delete')) {
			$result = $service->updateSellingPrice($request);
		} elseif($request->has('back')) {
			$result = $service->updateSellingPrice($request);
		} elseif($request->has('next')) {
			$result = $service->updateSellingPrice($request);
		} elseif($request->has('update')) {
			$result = $service->updateSellingPrice($request);
		}
        */
        return redirect()->route('master.price.selling_price.index');
    }

    /**
     * 売価情報マスタリスト 出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function sellingPriceExport(sellingPriceExportRequest $request, MtCustomerOtherItemClassRateService $service)
    {
        /* 対応不要
        if($request->has('cancel')) {
			return redirect()->route('master.price.selling_price.list');
		} elseif($request->has('excel')) {
			$result = $service->exportSellingPrice($request);
		}
        */
        return redirect()->route('master.price.selling_price.list');
    }

    public function codeAutoComplete(Request $request, MtCustomerOtherItemClassRateService $service)
    {
        $datas =  $service->codeAutoComplete($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
