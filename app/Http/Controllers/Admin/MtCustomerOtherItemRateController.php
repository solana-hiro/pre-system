<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\MtCustomerOtherItemRateService;
use App\Services\MtCustomerClassService;
use App\Services\CommonService;
use App\Http\Requests\MtCustomerOtherItemRate\PsKbnUpdateRequest;
use App\Http\Requests\MtCustomerOtherItemRate\UpdateRequest;
use App\Http\Requests\MtCustomerOtherItemRate\ExportRequest;
use App\Exports\MtCustomerOtherRateExport;
use App\Exports\CommonExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use App\Consts\CommonConsts;
use App\Services\MtCustomerService;
use Exception;

class MtCustomerOtherItemRateController extends Controller
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
     * PS区分別得意先掛率マスタ一覧入力  初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function PsKbnIndex(Request $request, CommonService $commonService)
    {
        // 後継フェーズで実装予定のため一時的にTopへリダイレクト
        return redirect()->route('top.index');

        if ($request->session()->has('customer_class_thing_id')) {
            $request->session()->forget('customer_class_thing_id');
        }
        $customerClass1Data = $commonService->searchCustomerClassThing();
        $customerClass2Data = $commonService->searchIndustry();
        $rank3Data = $commonService->searchRank3();
        return view('admin.master.price.mt_customer_other_item_rate.psKbnIndex', [
            'commonParams' => $this->commonParams,
            'customerClass1Data' => $customerClass1Data,
            'customerClass2Data' => $customerClass2Data,
            'rank3Data' => $rank3Data
        ]);
    }

    /**
     * PS区分別得意先掛率マスタ一覧入力  初期表示(得意先分類ID指定)
     * @param $request
     * @param $service
     * @return Object
     */
    public function PsKbnIndexByClassId($classId, UpdateRequest $request, MtCustomerOtherItemRateService $service, CommonService $commonService)
    {
        // 後継フェーズで実装予定のため一時的にTopへリダイレクト
        return redirect()->route('top.index');

        $customerClass1Data = $commonService->searchCustomerClassThing();
        $customerClass2Data = $commonService->searchIndustry();
        $rank3Data = $commonService->searchRank3();
        $initData = $service->getByClassId($classId);
        $customerClassInfo = $service->getCustomerCode($classId);
        return view('admin.master.price.mt_customer_other_item_rate.psKbnIndex', [
            'commonParams' => $this->commonParams,
            'customerClass1Data' => $customerClass1Data,
            'customerClass2Data' => $customerClass2Data,
            'rank3Data' => $rank3Data,
            'initData' => $initData,
            'customerClassInfo' => $customerClassInfo
        ]);
    }

    /**
     * PS区分別得意先掛率マスタ一覧入力  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function PsKbnUpdate(Request $request, MtCustomerOtherItemRateService $service, MtCustomerClassService $customerClassService)
    {
        // 後継フェーズで実装予定のため一時的にTopへリダイレクト
        return redirect()->route('top.index');

        if ($request->has('cancel')) {
            return back();
            if ($request->session()->has('customer_class_thing_id')) {
                $request->session()->forget('customer_class_thing_id');
            }
        } elseif ($request->has('update')) {
            //更新
            $result = $service->update($request);
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('master.price.mt_customer_other_item_rate.ps_kbn.index')->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('redirect')) {
            if (null !== $request->input('customer_class_thing_id')) {
                $request->session()->put('customer_class_thing_id', $request->input('customer_class_thing_id'));
            }
            if (null !== $request->input('redirect')) {
                $request->session()->put('customer_class_code', $request->input('redirect'));
            }
            $customerClassCd = $request->input('redirect');
            $defCustomerClassId = $request->input('redirect_hidden');
            $customerClassId = $customerClassService->codeAutoComplete($customerClassCd, $defCustomerClassId);
            return redirect()->route('master.price.mt_customer_other_item_rate.ps_kbn.index_by_class_id', ['classId' => $customerClassId]);
        }
        return redirect()->route('master.price.mt_customer_other_item_rate.ps_kbn.index');
    }

    /**
     * 得意先別商品掛率マスタ初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function indexForNew(Request $request, MtCustomerOtherItemRateService $itemRateService)
    {
        $view = 'admin.master.price.mt_customer_other_item_rate.index_for_new';
        return $this->index($request, $itemRateService, $view);
    }

    public function indexForFix(Request $request, MtCustomerOtherItemRateService $itemRateService)
    {
        $view = 'admin.master.price.mt_customer_other_item_rate.index_for_fix';
        return $this->index($request, $itemRateService, $view);
    }

    private function index(Request $request, MtCustomerOtherItemRateService $itemRateService, $view)
    {
        $customer = null;
        $existsItemRates = $itemRateService->existsItemRates(['customer_id' => null]);

        return view($view, [
            'commonParams' => $this->commonParams,
            'customer' => $customer,
            'existsItemRates' => $existsItemRates,
        ]);
    }

    /**
     * 得意先別商品掛率マスタ初期表示(ID指定)
     * @param $id: 得意先ID
     * @param $service
     * @return Object
     */
    public function indexByIdForNew($id, Request $request, MtCustomerService $customerService, MtCustomerOtherItemRateService $itemRateService)
    {
        $view = 'admin.master.price.mt_customer_other_item_rate.index_for_new';
        return $this->indexById($id, $request, $customerService, $itemRateService, $view);
    }

    public function indexByIdForFix($id, Request $request, MtCustomerService $customerService, MtCustomerOtherItemRateService $itemRateService)
    {
        $view = 'admin.master.price.mt_customer_other_item_rate.index_for_fix';
        return $this->indexById($id, $request, $customerService, $itemRateService, $view);
    }

    private function indexById($id, Request $request, MtCustomerService $customerService, MtCustomerOtherItemRateService $itemRateService, $view)
    {
        $customer = $customerService->getById(['id' => $id]);
        $existsItemRates = $itemRateService->existsItemRates(['customer_id' => $id]);

        return view($view, [
            'commonParams' => $this->commonParams,
            'customer' => $customer,
            'existsItemRates' => $existsItemRates,
        ]);
    }

    public function pageByIdForNew($id, Request $request, MtCustomerService $customerService, MtCustomerOtherItemRateService $itemRateService)
    {
        $view = 'admin.master.price.mt_customer_other_item_rate.index_for_new';
        return $this->pageById($id, $request, $customerService, $itemRateService, $view);
    }

    public function pageByIdForFix($id, Request $request, MtCustomerService $customerService, MtCustomerOtherItemRateService $itemRateService)
    {
        $view = 'admin.master.price.mt_customer_other_item_rate.index_for_fix';
        return $this->pageById($id, $request, $customerService, $itemRateService, $view);
    }

    private function pageById($id, Request $request, MtCustomerService $customerService, MtCustomerOtherItemRateService $itemRateService, $view)
    {
        // $id = nullのリクエストがbladeから送信できないため
        // $id = 0 のリクエストで代用しServiceで0はnullとして扱う
        $customer = $customerService->getById(['id' => $id]);
        $itemRates = $itemRateService->get(['customer_id' => $id]);

        return view($view, [
            'commonParams' => $this->commonParams,
            'customer' => $customer,
            'itemRates' => $itemRates,
        ]);
    }

    /**
     * 得意先別商品掛率マスタ入力  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(UpdateRequest $request, MtCustomerOtherItemRateService $service)
    {
        if ($request->has('cancel')) return redirect()->route('master.price.mt_customer_other_item_rate.index_for_new');
        if ($request->has('update')) {
            $result = $service->update($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error") . '<br><br>' . $result['error'];
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()
                    ->route('master.price.mt_customer_other_item_rate.index_for_new')
                    ->with('flashmessage', $flashmessage);
            }
        }
        if ($request->has('redirect')) {
            $id = $request->input('redirect');
            if ($id == 0) return redirect()->route("master.price.mt_customer_other_item_rate.index{$this->getNewOrFixRoute($request)}");
            return redirect()->route("master.price.mt_customer_other_item_rate.index_by_id{$this->getNewOrFixRoute($request)}", ['id' => $id]);
        }
        if ($request->has('mode')) {
            $id = $request->input('mode');
            $routeIndex = 'master.price.mt_customer_other_item_rate.index';
            $routeIndexById = 'master.price.mt_customer_other_item_rate.index_by_id';
            return is_null($id)
                ? redirect()->route("{$routeIndex}{$this->getNewOrFixRoute($request)}")->withInput($request->except('items'))
                : redirect()->route("{$routeIndexById}{$this->getNewOrFixRoute($request)}", ['id' => $id])->withInput($request->except('items'));
        }
    }

    private function getNewOrFixRoute($request)
    {
        return $request->input('kbn') == 0 ? '_for_new' : '_for_fix';
    }

    /**
     * 得意先別商品掛率マスタリスト 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function list(Request $request, CommonService $commonService)
    {
        $customerData = $commonService->searchCustomer();
        $itemData = $commonService->searchItem();
        $brand1Data = $commonService->searchBrand1();
        $itemClassThing2Data = $commonService->searchItemClassThing2();
        $genreData = $commonService->searchGenre();
        $itemClassThing4Data = $commonService->searchClass4();
        $itemClassThing5Data = $commonService->searchItemClassThing5();
        $itemClassThing6Data = $commonService->searchItemClassThing6();
        $itemClassThing7Data = $commonService->searchItemClassThing7();
        return view('admin.master.price.mt_customer_other_item_rate.list', [
            'commonParams' => $this->commonParams,
            'customerData' => $customerData,
            'itemData' => $itemData,
            'brand1Data' => $brand1Data,
            'itemClassThing2Data' => $itemClassThing2Data,
            'genreData' => $genreData,
            'itemClassThing4Data' => $itemClassThing4Data,
            'itemClassThing5Data' => $itemClassThing5Data,
            'itemClassThing6Data' => $itemClassThing6Data,
            'itemClassThing7Data' => $itemClassThing7Data
        ]);
    }

    /**
     * 得意先別商品掛率マスタリスト 出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function export(ExportRequest $request, MtCustomerOtherItemRateService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('preview') || $request->has('excel')) {
            $param = $request->input();
            $datas = $service->export($param);
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "得意先別商品掛率マスタ（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'customerStartCode' => ($param['customer_code_start']) ? str_pad($param['customer_code_start'], 6, 0, STR_PAD_LEFT) : '',
                'customerEndCode' => ($param['customer_code_end']) ? str_pad($param['customer_code_end'], 6, 0, STR_PAD_LEFT) : '999999',
                'itemStartCode' => ($param['item_code_start']) ? str_pad($param['item_code_start'], 9, 0, STR_PAD_LEFT) : '',
                'itemEndCode' => ($param['item_code_end']) ? str_pad($param['item_code_end'], 9, 0, STR_PAD_LEFT) : 'ZZZZZZZZZ',
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            if ($request->has('preview')) {
                $view = view('export.mt_customer_other_item_rate_list_preview', compact('params'));
                return $view;
            } elseif ($request->has('excel')) {
                try {
                    $view = view('export.mt_customer_other_item_rate_list', compact('params'));
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        }
        return redirect()->route('master.price.mt_customer_other_item_rate.list');
    }

    /**
     * 自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtCustomerOtherItemRateService $service)
    {
        $datas =  $service->codeAutoComplete($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
