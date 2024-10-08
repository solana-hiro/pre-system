<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\MtSlipKindService as MtSlipKindService;
use App\Services\CommonService as CommonService;
use Illuminate\Support\Facades\Log;

class MtSlipKindController extends Controller
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
     * 環境設定 伝票種別マスタ 初期表示
     * @param $request
     * @return Object
     */
    public function setSlipKind(Request $request, CommonService $commonService, MtSlipKindService $service)
    {
        $initData = $service->getInitData();
        $slipKindData = $commonService->searchSlipKind();
        return view('admin.system.environment.slipKind', ['commonParams' => $this->commonParams, 'initData' => $initData, 'slipKindData' => $slipKindData]);
    }

    /**
     * 環境設定 伝票種別マスタ 更新
     * @param $request
     * @return Object
     */
    public function updateSlipKind(Request $request, CommonService $commonService, MtSlipKindService $service)
    {
        if ($request->has('redirectFromSearch')) {
            $kbn = $request->input('redirectFromSearch');
            $param = ['slip_kind_cd' => $kbn];
            //検索結果を受け取り
            $initData = $service->get($param);
            $slipKindData = $commonService->searchSlipKind();
            return view('admin.system.environment.slipKind', ['commonParams' => $this->commonParams, 'slipKindData' => $slipKindData, 'initData' => $initData]);
        }
        return redirect()->route('system.environment.slip_kind.index');
    }

    /**
     * 伝票種別 自動補完
     * @param $request
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtSlipKindService $service)
    {
        $data =  $service->codeAutoComplete($request->input());
        header('Content-type: application/json');
        return json_encode($data);
    }
}
