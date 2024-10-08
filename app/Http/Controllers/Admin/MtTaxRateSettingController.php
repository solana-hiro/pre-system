<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\MtTaxRateSettingService as MtTaxRateSettingService;
use App\Services\CommonService as CommonService;
use App\Consts\CommonConsts;
use Exception;
use Illuminate\Support\Facades\DB;

class MtTaxRateSettingController extends Controller
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
     * 環境設定 税率設定マスタ 初期表示
     * @param $request
     * @return Object
     */
    public function setTaxRate(Request $request, CommonService $commonService, MtTaxRateSettingService $mtTaxRateSettingService)
    {
        $initData = $mtTaxRateSettingService->getInitData();
        $defTaxRateKbns = $mtTaxRateSettingService->getDefTaxRateKbns();
        $initDefTaxRateKbns = $defTaxRateKbns->where('tax_rate_kbn_cd', 1)->first();
        $taxRateKbnData = $commonService->searchTaxRateKbn();
        return view('admin.system.environment.taxRate', ['commonParams' => $this->commonParams, 'taxRateKbnData' => $taxRateKbnData, 'initDefTaxRateKbns' => $initDefTaxRateKbns,  'initData' => $initData]);
    }

    /**
     * 環境設定 税率設定マスタ 更新
     * @param $request
     * @return Object
     */
    public function updateTaxRate(Request $request, MtTaxRateSettingService $service, CommonService $commonService)
    {
        if ($request->has('cancel')) {
            return redirect()->route('system.environment.tax_rate.index');
        } elseif ($request->has('update')) {
            $result = $service->update($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('system.environment.tax_rate.index')->with('flashmessage', $flashmessage);
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
                return redirect()->route('system.environment.tax_rate.index')->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('redirect')) {
            $initData = $service->getInitDataById($request->input('redirect'));
            $defTaxRateKbns = $service->getDefTaxRateKbns();
            $initDefTaxRateKbns = $defTaxRateKbns->where('tax_rate_kbn_cd', $request->input('redirect'))->first();
            $taxRateKbnData = $commonService->searchTaxRateKbn();
            return view('admin.system.environment.taxRate', ['commonParams' => $this->commonParams, 'taxRateKbnData' => $taxRateKbnData, 'initDefTaxRateKbns' => $initDefTaxRateKbns,  'initData' => $initData]);
        }
        return redirect()->route('system.environment.tax_rate.index');
    }

    /**
     * 税率設定　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtTaxRateSettingService $service)
    {
        $datas =  $service->codeAutoComplete($request->input('tax_rate_kbn_cd'));
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
