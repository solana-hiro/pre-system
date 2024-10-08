<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MtColorPattern\MtColorPatternSearchRequest;
use App\Http\Requests\MtColorPattern\MtColorPatternUpdateRequest;
use App\Http\Requests\MtColorPattern\MtColorPatternExportRequest;
use App\Services\MtColorPatternService as MtColorPatternService;
use App\Services\CommonService as CommonService;
use App\Exports\MtColorPatternExport;
use App\Exports\CommonExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use App\Consts\CommonConsts;
use Carbon\Carbon;
use Exception;

class MtColorPatternController extends Controller
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
     * カラーパターンマスタ(一覧) 初期表示
     * @param $request
     * @return Object
     */
    public function index(Request $request, CommonService $commonService, MtColorPatternService $service)
    {
        $colorPatternData = $commonService->searchMtColorPattern();
        $initData = $service->getInitData();
        $colorData = $commonService->searchMtColor();
        return view('admin.master.item.mt_color_pattern.index', ['commonParams' => $this->commonParams, 'colorPatternData' => $colorPatternData, 'initData' => $initData, 'colorData' => $colorData]);
    }

    /**
     * カラーパターンマスタ(一覧) 更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(MtColorPatternUpdateRequest $request, MtColorPatternService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('update')) {  //Integrity constraint violation: 1062
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
                return redirect()->route('master.item.mt_color_pattern.index')->with('flashmessage', $flashmessage);
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
                return redirect()->route('master.item.mt_color_pattern.index')->with('flashmessage', $flashmessage);
            }
        }
        return redirect()->route('master.item.mt_color_pattern.index');
    }

    /**
     * カラーパターンリスト(一覧) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function list(Request $request, CommonService $commonService)
    {
        $colorPatternData = $commonService->searchMtColorPattern();
        return view('admin.master.item.mt_color_pattern.list', ['commonParams' => $this->commonParams, 'colorPatternData' => $colorPatternData]);
    }

    /**
     * カラーパターンリスト(一覧)  キャンセル・プレビュー・Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function export(MtColorPatternExportRequest $request, MtColorPatternService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('preview') || $request->has('excel')) {
            $datas = $service->export($request->input());
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "カラーパターンマスタ（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
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
                $view = view('export.mt_color_pattern_list_preview', compact('params'));
                return $view;
            } elseif ($request->has('excel')) {
                try {
                    $view = view('export.mt_color_pattern_list', compact('params'));
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        }
        return redirect()->route('master.item.mt_color_pattern.list');
    }

    /**
     * カラーパターン　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtColorPatternService $service)
    {
        $datas =  $service->codeAutoComplete($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
