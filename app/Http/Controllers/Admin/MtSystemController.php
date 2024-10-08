<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\MtSystemService as MtSystemService;
use Carbon\Carbon;
use App\Consts\CommonConsts;
use App\Http\Requests\MtSystem\UpdateRequest;

class MtSystemController extends Controller
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
     * 環境情報　会社情報 初期表示
     * @param $request
     * @return Object
     */
    public function setCompany(Request $request, MtSystemService $service)
    {
        $initData = $service->getInitData();
		return view('admin.system.environment.company', ['commonParams' => $this->commonParams, 'initData' => $initData]);
    }

    /**
     * 環境情報　会社情報 更新
     * @param $request
     * @return Object
     */
    public function updateCompany(UpdateRequest $request, MtSystemService $service)
    {
        if ($request->has('cancel')) {
            return redirect()->route('system.environment.company.index');
        } elseif ($request->has('update')) {
            $result = $service->update($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('system.environment.company.index')->with('flashmessage', $flashmessage);
            }
        }
        return redirect()->route('system.environment.company.index');
    }
}
