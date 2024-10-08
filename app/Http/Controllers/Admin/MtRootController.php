<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MtRoot\UpdateRequest;
use App\Services\MtRootService as MtRootService;
use App\Services\CommonService as CommonService;
use App\Consts\CommonConsts;
use Exception;

class MtRootController extends Controller
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
     * ルートマスタ 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function index(Request $request, MtRootService $service, CommonService $commonService)
    {
        $rootData = $commonService->searchRoot();
        $initData = $service->getInitData();
        return view('admin.master.other.mt_root.index', [
            'commonParams' => $this->commonParams,
            'rootData' => $rootData,
            'initData' => $initData
        ]);
    }

    /**
     * ルートマスタ  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(UpdateRequest $request, MtRootService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('update')) {
            $result = $service->update($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error") . "<br>" . $result['error'];
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('master.other.mt_root.index')->with('flashmessage', $flashmessage);
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
                return redirect()->route('master.other.mt_root.index')->with('flashmessage', $flashmessage);
            }
        }
        return redirect()->route('master.other.mt_root.index');
    }

    /**
     * ルート　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtRootService $service)
    {
        $datas =  $service->codeAutoComplete($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
