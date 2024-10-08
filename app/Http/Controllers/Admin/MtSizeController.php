<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MtSize\MtSizeSearchRequest;
use App\Http\Requests\MtSize\MtSizeUpdateRequest;
use App\Http\Requests\MtSize\MtSizeExportRequest;
use App\Services\MtSizeService as MtSizeService;
use App\Services\CommonService as CommonService;
use App\Exports\MtSizeExport;
use App\Exports\CommonExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use App\Consts\CommonConsts;
use Carbon\Carbon;
use Exception;

class MtSizeController extends Controller
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
     * サイズマスタ(一覧) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function index(Request $request, MtSizeService $service, CommonService $commonService)
    {
        $sizeData = $commonService->searchMtSize();
        $initData = $service->getInitData();
        return view('admin.master.item.mt_size.index', ['commonParams' => $this->commonParams, 'sizeData' => $sizeData, 'initData' => $initData]);
    }

    /**
     * サイズマスタ(一覧) 更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(MtSizeUpdateRequest $request, MtSizeService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('update')) {
            $result = $service->update($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('master.item.mt_size.index')->with('flashmessage', $flashmessage);
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
                return redirect()->route('master.item.mt_size.index')->with('flashmessage', $flashmessage);
            }
        }
        return redirect()->route('master.item.mt_size.index');
    }

    /**
     * サイズリスト(一覧) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function list(Request $request, CommonService $commonService)
    {
        $sizeData = $commonService->searchMtSize();
        return view('admin.master.item.mt_size.list', ['commonParams' => $this->commonParams, 'sizeData' => $sizeData]);
    }

    /**
     * サイズリスト(一覧)  キャンセル・プレビュー・Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function export(MtSizeExportRequest $request, MtSizeService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('preview') || $request->has('excel')) {
            $datas = $service->export($request->input());
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "サイズマスタ（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'startCode' => ($request['code_start']) ? $request['code_start'] : '',
                'endCode' => ($request['code_end']) ? $request['code_end'] : 'ZZZZZ',
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            if ($request->has('preview')) {
                $view = view('export.mt_size_list_preview', compact('params'));
                return $view;
            } elseif ($request->has('excel')) {
                try {
                    $view = view('export.mt_size_list', compact('params'));
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        }
        return redirect()->route('master.item.mt_size.list');
    }

    /**
     * サイズ　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtSizeService $service)
    {
        $datas =  $service->codeAutoComplete($request->input('size_cd'));
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
