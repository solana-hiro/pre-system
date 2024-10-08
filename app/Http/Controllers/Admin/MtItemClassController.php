<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\MtItemClassService;
use App\Services\DefItemClassThingService;
use App\Services\CommonService;
use App\Http\Requests\MtItemClass\MtItemClassExportRequest;
use App\Http\Requests\MtItemClass\MtItemClassUpdateRequest;
use App\Exports\MtItemClassExport;
use App\Consts\CommonConsts;
use App\Exports\CommonExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use Exception;

class MtItemClassController extends Controller
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
     * 商品分類入力(一覧) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function index(Request $request, MtItemClassService $service, CommonService $commonService)
    {
        $initData1 = $service->getInitData1();
        $initData2 = $service->getInitData2();
        $initData3 = $service->getInitData3();
        $initData4 = $service->getInitData4();
        $initData5 = $service->getInitData5();
        $initData6 = $service->getInitData6();
        $initData7 = $service->getInitData7();
        $itemClassId = '1';
        if ($request->session()->has('item_class')) {
            $itemClassId = $request->session()->get('item_class');
        }
        return view('admin.master.item.mt_item_class.index', [
            'commonParams' => $this->commonParams,
            'initData1' => $initData1,
            'initData2' => $initData2,
            'initData3' => $initData3,
            'initData4' => $initData4,
            'initData5' => $initData5,
            'initData6' => $initData6,
            'initData7' => $initData7,
            'itemClassId' => $itemClassId
        ]);
    }

    /**
     * 商品分類入力(一覧) 更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(MtItemClassUpdateRequest $request, MtItemClassService $service)
    {
        if ($request->has('cancel')) {
            if ($request->session()->has('item_class')) {
                $request->session()->forget('item_class');
            }
            return back();
        } elseif ($request->has('update')) {
            if (null !== $request->input('item_class')) {
                $request->session()->put('item_class', $request->input('item_class'));
            }
            $result = $service->update($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('master.item.mt_item_class.index')->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('delete')) {
            if (null !== $request->input('item_class')) {
                $request->session()->put('item_class', $request->input('item_class'));
            }
            $result = $service->delete($request->input('delete'));
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                if (str_contains($result['error'], 'SQLSTATE[23000]')) {
                    $errormessage = __("validation.error_messages.delete_constraint_key_error");
                } else {
                    $errormessage = __("validation.error_messages.delete_error");
                }
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.delete_complete");
                return redirect()->route('master.item.mt_item_class.index')->with('flashmessage', $flashmessage);
            }
        }
        return redirect()->route('master.item.mt_item_class.index');
    }

    /**
     * 商品分類リスト(一覧) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function list(Request $request, CommonService $commonService)
    {
        return view('admin.master.item.mt_item_class.list', [
            'commonParams' => $this->commonParams
        ]);
    }

    /**
     * 商品分類リスト(一覧) 出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function export(MtItemClassExportRequest $request, MtItemClassService $service, DefItemClassThingService $defService)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('preview') || $request->has('excel')) {
            $param =  $request->input();
            $itemClassId = $param['item_class_id'];
            $datas = $service->export($param);
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "商品分類マスタ（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $itemClassData = $defService->getById($itemClassId);
            $codeStart = '';
            $codeEnd = 'ZZZZZZ';
            if ($itemClassId === '1') {
                $codeStart = ($param['code1_start']) ? $param['code1_start'] : '';
                $codeEnd = ($param['code1_end']) ? $param['code1_end'] : 'ZZZZZZ';
            } elseif ($itemClassId === '2') {
                $codeStart = ($param['code2_start']) ? $param['code2_start'] : '';
                $codeEnd = ($param['code2_end']) ? $param['code2_end'] : 'ZZZZZZ';
            } elseif ($itemClassId === '3') {
                $codeStart = ($param['code3_start']) ? $param['code3_start'] : '';
                $codeEnd = ($param['code3_end']) ? $param['code3_end'] : 'ZZZZZZ';
            } elseif ($itemClassId === '4') {
                $codeStart = ($param['code4_start']) ? $param['code4_start'] : '';
                $codeEnd = ($param['code4_end']) ? $param['code4_end'] : 'ZZZZZZ';
            } elseif ($itemClassId === '5') {
                $codeStart = ($param['code5_start']) ? $param['code5_start'] : '';
                $codeEnd = ($param['code5_end']) ? $param['code5_end'] : 'ZZZZZZ';
            } elseif ($itemClassId === '6') {
                $codeStart = ($param['code6_start']) ? $param['code6_start'] : '';
                $codeEnd = ($param['code6_end']) ? $param['code6_end'] : 'ZZZZZZ';
            } elseif ($itemClassId === '7') {
                $codeStart = ($param['code7_start']) ? $param['code7_start'] : '';
                $codeEnd = ($param['code7_end']) ? $param['code7_end'] : 'ZZZZZZ';
            }

            $params = [
                'itemClassId' => $itemClassId,
                'itemClassName' => $itemClassData['item_class_thing_name'],
                'startCode' => $codeStart,
                'endCode' => $codeEnd,
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];

            if ($request->has('preview')) {
                $view = view('export.mt_item_class_list_preview', compact('params'));
                return $view;
            } elseif ($request->has('excel')) {
                try {
                    $view = view('export.mt_item_class_list', compact('params'));
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        }
        return redirect()->route('master.item.mt_item_class.list');
    }

    /**
     * ジャンル検索
     * @param $request
     * @param $service
     * @return Object
     */
    public function searchGenre(Request $request, MtItemClassService $service)
    {
        $datas =  $service->getGenre($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * ブランド1検索
     * @param $request
     * @param $service
     * @return Object
     */
    public function searchBrand1(Request $request, MtItemClassService $service)
    {
        $datas =  $service->getBrand1($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 販売開始年
     * @param $request
     * @param $service
     * @return Object
     */
    public function searchItemClassThing4(Request $request, MtItemClassService $service)
    {
        $datas =  $service->getItemClassThing4($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 競技・カテゴリ検索
     * @param $request
     * @param $service
     * @return Object
     */
    public function searchItemClassThing2(Request $request, MtItemClassService $service)
    {
        $datas =  $service->getCategory($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 工場分類5検索
     * @param $request
     * @param $service
     * @return Object
     */
    public function searchItemClassThing5(Request $request, MtItemClassService $service)
    {
        $datas =  $service->getItemClassThing5($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 製品/工賃6検索
     * @param $request
     * @param $service
     * @return Object
     */
    public function searchItemClassThing6(Request $request, MtItemClassService $service)
    {
        $datas =  $service->getItemClassThing6($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 資産在庫JA検索
     * @param $request
     * @param $service
     * @return Object
     */
    public function searchItemClassThing7(Request $request, MtItemClassService $service)
    {
        $datas =  $service->getItemClassThing7($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 商品分類入力　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtItemClassService $service)
    {
        $datas =  $service->codeAutoComplete($request->input('item_class_cd'), $request->input('def_item_class_thing_id'));
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 商品分類入力（ブランド１）　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoCompleteBrand1(Request $request, MtItemClassService $service)
    {
        //商品分類項目定義ＩＤ に固定で１を渡す
        $datas =  $service->codeAutoComplete($request->input('item_class_cd'), 1);
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
