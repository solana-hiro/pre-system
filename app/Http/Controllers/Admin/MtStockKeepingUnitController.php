<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MtStockKeepingUnit\UpdateRequest;
use App\Http\Requests\MtStockKeepingUnit\ExportRequest;
use App\Services\MtStockKeepingUnitService as MtStockKeepingUnitService;
use App\Services\DefItemClassThingService as DefItemClassThingService;
use App\Services\MtItemService as MtItemService;
use App\Services\CommonService as CommonService;
use Illuminate\Http\Request;
use App\Exports\CommonExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use App\Consts\CommonConsts;
use Exception;

class MtStockKeepingUnitController extends Controller
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
     * JANコード登録マスタ(一覧) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function index(Request $request, CommonService $commonService)
    {
        return view('admin.master.item.jan.index', [
            'commonParams' => $this->commonParams,
        ]);
    }

    /**
     * JANコード登録マスタ(一覧) 初期表示(ID指定)
     * @param $request
     * @param $service
     * @return Object
     */
    public function indexById($mtItemId, Request $request, CommonService $commonService, MtStockKeepingUnitService $service)
    {
        $itemData = $commonService->searchItem();
        $brand1Data = $commonService->searchBrand1();
        $itemClassThing2Data = $commonService->searchItemClassThing2();
        $genreData = $commonService->searchGenre();
        $itemClassThing4Data = $commonService->searchClass4();
        $itemClassThing5Data = $commonService->searchItemClassThing5();
        $itemClassThing6Data = $commonService->searchItemClassThing6();
        $itemClassThing7Data = $commonService->searchItemClassThing7();
        $itemDetail = $service->getByID($mtItemId);
        // emptyだとなぜかtrueにならないのでcountを使用
        if (count($itemDetail['mtStockKeepingUnit']) === 0) {
            return redirect()->route('master.item.jan.list');
        }
        return view('admin.master.item.jan.index', [
            'commonParams' => $this->commonParams,
            'itemData' => $itemData,
            'itemDetail' => $itemDetail,
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
     * JANコード登録マスタ(一覧) 更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(UpdateRequest $request, MtStockKeepingUnitService $service, MtItemService $itemService)
    {
        if ($request->has('cancel')) {
            return redirect()->route('master.item.jan.list');
        } elseif ($request->has('update')) {
            $result = $service->update($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('master.item.jan.list_by_id', ['mtItemId' => $result['item_id']])->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('redirect')) {
            $itemCd = $request->input('redirect');
            $itemId = $itemService->codeAutoComplete($itemCd);
            return redirect()->route('master.item.jan.list_by_id', ['mtItemId' => $itemId]);
        }
        return redirect()->route('master.item.jan.list');
    }

    /**
     * JANコードマスタ(一覧表) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function list(Request $request, CommonService $commonService)
    {
        return view('admin.master.other.jan.list', [
            'commonParams' => $this->commonParams,
        ]);
    }

    /**
     * JANコードマスタ(一覧表) 出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function export(ExportRequest $request, MtStockKeepingUnitService $service, DefItemClassThingService $defItemClassThingService)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('preview') || $request->has('excel')) {
            $param = $request->input();
            $datas = $service->export($param);
            $defItemClass = $defItemClassThingService->getById($param['item_class']);
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "JANコードマスタ（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $startCode = '';
            $endCode = '';
            if ($param['item_class'] === '1') {
                $startCode = (isset($param['code1_start'])) ? $param['code1_start'] : '';
                $endCode = (isset($param['code1_end'])) ? $param['code1_end'] : 'ZZZZZZ';
                $fileName = "JANコードマスタ（一覧表）（ブランド1別）_" . Carbon::now()->format('Ymd') . ".xlsx";
            } elseif ($param['item_class'] === '2') {
                $startCode = (isset($param['code2_start'])) ? $param['code2_start'] : '';
                $endCode = (isset($param['code2_end'])) ? $param['code2_end'] : 'ZZZZZZ';
                $fileName = "JANコードマスタ（一覧表）（競技・カテゴリ別）_" . Carbon::now()->format('Ymd') . ".xlsx";
            } elseif ($param['item_class'] === '3') {
                $startCode = (isset($param['code3_start'])) ? $param['code3_start'] : '';
                $endCode = (isset($param['code3_end'])) ? $param['code3_end'] : 'ZZZZZZ';
                $fileName = "JANコードマスタ（一覧表）（ジャンル別）_" . Carbon::now()->format('Ymd') . ".xlsx";
            } elseif ($param['item_class'] === '4') {
                $startCode = (isset($param['code4_start'])) ? $param['code4_start'] : '';
                $endCode = (isset($param['code4_end'])) ? $param['code4_end'] : 'ZZZZZZ';
                $fileName = "JANコードマスタ（一覧表）（販売開始年別）_" . Carbon::now()->format('Ymd') . ".xlsx";
            } elseif ($param['item_class'] === '5') {
                $startCode = (isset($param['code5_start'])) ? $param['code5_start'] : '';
                $endCode = (isset($param['code5_end'])) ? $param['code5_end'] : 'ZZZZZZ';
                $fileName = "JANコードマスタ（一覧表）（工場分類5別）_" . Carbon::now()->format('Ymd') . ".xlsx";
            } elseif ($param['item_class'] === '6') {
                $startCode = (isset($param['code6_start'])) ? $param['code6_start'] : '';
                $endCode = (isset($param['code6_end'])) ? $param['code6_end'] : 'ZZZZZZ';
                $fileName = "JANコードマスタ（一覧表）（製品／工賃6別）_" . Carbon::now()->format('Ymd') . ".xlsx";
            } elseif ($param['item_class'] === '7') {
                $startCode = (isset($param['code7_start'])) ? $param['code7_start'] : '';
                $endCode = (isset($param['code7_end'])) ? $param['code7_end'] : 'ZZZZZZ';
                $fileName = "JANコードマスタ（一覧表）（資産在庫JA別）_" . Carbon::now()->format('Ymd') . ".xlsx";
            }

            $params = [
                'item_class_name' => $defItemClass['item_class_thing_name'],
                'item_class_cd' => $param['item_class'],
                'startCode' => $startCode,
                'endCode' => $endCode,
                'startItemCode' => ($param['item_cd_start']) ? $param['item_cd_start'] : '',
                'endItemCode' => ($param['item_cd_end']) ? $param['item_cd_end'] : 'ZZZZZZZZZ',
                'startColorCode' => ($param['color_code_start']) ? $param['color_code_start'] : '',
                'endColorCode' => ($param['color_code_end']) ? $param['color_code_end'] : 'ZZZZZ',
                'startSizeCode' => ($param['size_code_start']) ? $param['size_code_start'] : '',
                'endSizeCode' => ($param['size_code_end']) ? $param['size_code_end'] : 'ZZZZZ',
                'outputKbn' => $param['output_kbn'],
                'startJanCode' => ($param['jan_code_start']) ? $param['jan_code_start'] : '',
                'endJanCode' => ($param['jan_code_end']) ? $param['jan_code_end'] : 'ZZZZZZZZZZZZZ',
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            if ($request->has('preview')) {
                $view = view('export.mt_jan_list_preview', compact('params'));
                return $view;
            } elseif ($request->has('excel')) {
                try {
                    $view = view('export.mt_jan_list', compact('params'));
                    $result =  Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        }
        return redirect()->route('master.other.mt_stock_keeping_unit.list');
    }

    /**
     * SKU　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtStockKeepingUnitService $service)
    {
        $datas =  $service->codeAutoComplete($request->input('mt_item_cd'));
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * SKU　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoCompleteSkus(Request $request, MtStockKeepingUnitService $service)
    {
        $datas =  $service->getById($request->input('mt_item_cd'));
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 商品のロケーション情報
     * @param Request $request
     * @param MtStockKeepingUnitService $service
     * @return string the query result json
     */
    public function loadByWarehouseAndItem(Request $request, MtStockKeepingUnitService $service)
    {
        $datas =  $service->loadByWarehouseAndItem($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * SKU　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function janCodeExistCheck(Request $request, MtStockKeepingUnitService $service)
    {
        \Log::info($request->input());
        $datas =  $service->getByJanCode($request->input('item_cd'), $request->input('jan_cd'));
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
