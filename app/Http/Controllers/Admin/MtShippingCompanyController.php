<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MtShippingCompany\UpdateRequest;
use App\Http\Requests\MtShippingCompany\ExportRequest;
use App\Services\MtShippingCompanyService as MtShippingCompanyService;
use App\Services\CommonService as CommonService;
use App\Exports\MtShippingCompanyExport;
use App\Exports\CommonExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use App\Consts\CommonConsts;
use Carbon\Carbon;
use Exception;

class MtShippingCompanyController extends Controller
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
     * 運送会社マスタ 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function index(Request $request, CommonService $commonService, MtShippingCompanyService $service)
    {
        $shippingCompanyData = $commonService->searchShippingCompany();
        $initData = $service->getInitData();
        return view('admin.master.other.mt_shipping_company.index', [
            'commonParams' => $this->commonParams,
            'shippingCompanyData' => $shippingCompanyData,
            'initData' => $initData,
        ]);
    }

    /**
     * 運送会社マスタリスト 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function list(Request $request, CommonService $commonService)
    {
        $shippingCompanyData = $commonService->searchShippingCompany();
        return view('admin.master.other.mt_shipping_company.list', ['commonParams' => $this->commonParams, 'shippingCompanyData' => $shippingCompanyData]);
    }

    /**
     * 運送会社マスタ(一覧) 更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(UpdateRequest $request, MtShippingCompanyService $service)
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
                return redirect()->route('master.other.mt_shipping_company.index')->with('flashmessage', $flashmessage);
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
                return redirect()->route('master.other.mt_shipping_company.index')->with('flashmessage', $flashmessage);
            }
        }
        return redirect()->route('master.other.mt_shipping_company.index');
    }

    /**
     * 運送会社リスト(一覧)  キャンセル・Excel出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function export(ExportRequest $request, MtShippingCompanyService $service)
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
            $fileName = "運送会社マスタ（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'startCode' => isset($param['code_start']) ? str_pad($param['code_start'], 4, 0, STR_PAD_LEFT) : '',
                'endCode' => isset($param['code_end']) ? str_pad($param['code_end'], 4, 0, STR_PAD_LEFT) : 'ZZZZ',
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            if ($request->has('preview')) {
                $view = view('export.mt_shipping_company_list_preview', compact('params'));
                return $view;
            } elseif ($request->has('excel')) {
                try {
                    $view = view('export.mt_shipping_company_list', compact('params'));
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        }
        return redirect()->route('master.other.mt_shipping_company.list');
    }

    /**
     * 運送会社　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtShippingCompanyService $service)
    {
        $datas =  $service->codeAutoComplete($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
