<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MtSizePattern\MtSizePatternSearchRequest;
use App\Http\Requests\MtSizePattern\MtSizePatternUpdateRequest;
use App\Http\Requests\MtSizePattern\MtSizePatternExportRequest;
use App\Services\MtSizePatternService as MtSizePatternService;
use App\Services\CommonService as CommonService;
use App\Exports\MtSizePatternExport;
use App\Exports\CommonExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use App\Consts\CommonConsts;
use Carbon\Carbon;
use Exception;

class MtSizePatternController extends Controller
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
     * サイズパターンマスタ(一覧) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function index(Request $request, CommonService $commonService, MtSizePatternService $service)
    {
        $sizePatternData = $commonService->searchMtSizePattern();
        $initData = $service->getInitData();
        $sizeData = $commonService->searchMtSize();
        return view('admin.master.item.mt_size_pattern.index', [
            'commonParams' => $this->commonParams,
            'sizePatternData' => $sizePatternData,
            'initData' => $initData,
            'sizeData' => $sizeData
        ]);
    }

    /**
     * サイズパターンマスタ(一覧) 更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(MtSizePatternUpdateRequest $request, MtSizePatternService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('update')) {
            $result = $service->update($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                if (str_contains($result['error'], 'SQLSTATE[23000]')) {
                    $errormessage = __("validation.error_messages.color_is_not_exist");
                } else {
                    $errormessage = __("validation.error_messages.update_error") . "<br>" . $result['error'];
                }
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('master.item.mt_size_pattern.index')->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('delete')) {
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
                return redirect()->route('master.item.mt_size_pattern.index')->with('flashmessage', $flashmessage);
            }
        }
        return redirect()->route('master.item.mt_size_pattern.index');
    }

    /**
     * サイズパターンリスト(一覧) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function list(Request $request, CommonService $commonService)
    {
        $sizePatternData = $commonService->searchMtSizePattern();
        return view('admin.master.item.mt_size_pattern.list', ['commonParams' => $this->commonParams, 'sizePatternData' => $sizePatternData]);
    }

    /**
     * サイズパターンリスト(一覧)  キャンセル・Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function export(MtSizePatternExportRequest $request, MtSizePatternService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('preview') || $request->has('excel')) {
            $datas = $service->export($request->input());
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "サイズパターンマスタ（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'startCode' => ($request['code_start']) ? str_pad($request['code_start'], 4, 0, STR_PAD_LEFT) : '',
                'endCode' => ($request['code_end']) ? str_pad($request['code_end'], 4, 0, STR_PAD_LEFT) : 'ZZZZ',
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            if ($request->has('preview')) {
                $view = view('export.mt_size_pattern_list_preview', compact('params'));
                return $view;
            } elseif ($request->has('excel')) {
                try {
                    $view = view('export.mt_size_pattern_list', compact('params'));
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        }
        return redirect()->route('master.item.mt_size_pattern.list');
    }

    /**
     * サイズパターン　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtSizePatternService $service)
    {
        $datas =  $service->codeAutoComplete($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
