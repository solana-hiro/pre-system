<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\CommonService as CommonService;
use App\Services\MtUserService as MtUserService;
use App\Exports\CommonExport;
use App\Consts\CommonConsts;
use App\Http\Requests\MtUser\UpdateMaintenanceRequest;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class MtUserController extends Controller
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
     * ユーザマスタ(メンテナンス) 初期表示
     * @param $request
     * @return Object
     */
    public function indexUserMaintenance(Request $request, CommonService $commonService, MtUserService $service)
    {
        //権限確認
        $this->commonParams['auth'] = $this->commonExec(119);
        if ($this->commonParams['auth']['auth_use_flg'] !== 1) {
            return back();
        }
        $departmentData = $commonService->searchDepartment();
        $def1Data = $commonService->getDef1();
        $def2Data = $commonService->getDef2();
        $def3Data = $commonService->getDef3();
        $minId = $service->getMinId();
        $maxId = $service->getMaxId();

        return view('admin.system.security.userMaster', [
            'commonParams' => $this->commonParams,
            'departmentData' => $departmentData,
            'def1Data' => $def1Data,
            'def2Data' => $def2Data,
            'def3Data' => $def3Data,
            'minId' => $minId,
            'maxId' => $maxId
        ]);
    }

    /**
     * ユーザマスタ(メンテナンス) 初期表示
     * @param $request
     * @return Object
     */
    public function indexUserMaintenanceById($id, CommonService $commonService, MtUserService $service)
    {
        //権限確認
        $this->commonParams['auth'] = $this->commonExec(119);
        if ($this->commonParams['auth']['auth_use_flg'] !== 1) {
            return back();
        }
        // ID指定
        $departmentData = $commonService->searchDepartment();
        $def1Data = $commonService->getDef1();
        $def2Data = $commonService->getDef2();
        $def3Data = $commonService->getDef3();
        $initData = $service->getInitData($id);
        $minId = $service->getMinId();
        $maxId = $service->getMaxId();
        if (empty($initData['mtUser'])) {
            return redirect()->route('system.security.user.maintenance.index');
        }
        return view('admin.system.security.userMaster', [
            'commonParams' => $this->commonParams,
            'departmentData' => $departmentData,
            'def1Data' => $def1Data,
            'def2Data' => $def2Data,
            'def3Data' => $def3Data,
            'initData' => $initData,
            'minId' => $minId,
            'maxId' => $maxId,
            'userId' => $id
        ]);
    }

    /**
     * ユーザマスタ(メンテナンス) 更新
     * @param $request
     * @return Object
     */
    public function updateUserMaintenance(UpdateMaintenanceRequest $request, MtUserService $service, CommonService $commonService)
    {
        $params = $request->input();
        if ($request->has('cancel')) {
            return back();
            //return redirect()->route('system.security.user.maintenance.index');
        } elseif ($request->has('prev')) {
            $result = $service->getPrevById($params['update_id']);
            if (isset($result)) {
                return redirect()->route('system.security.user.maintenance.index_by_id', ['id' => $result['id']]);
            }
        } elseif ($request->has('next')) {
            $result = $service->getNextById($params['update_id']);
            if (isset($result)) {
                return redirect()->route('system.security.user.maintenance.index_by_id', ['id' => $result['id']]);
            }
        } elseif ($request->has('update')) {
            $result = $service->update($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('system.security.user.list')->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('delete')) {
            $result = $service->delete($request->input('update_id'));
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                if (str_contains($result['error'], 'SQLSTATE[23000]')) {
                    $errormessage = __("validation.error_messages.delete_constraint_key_error");
                } else {
                    $errormessage = __("validation.error_messages.delete_error");
                }
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.delete_complete");
                return redirect()->route('system.security.user.list')->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('copy')) {
            $initData = $service->copy($request->input('update_id'));
            $departmentData = $commonService->searchDepartment();
            $def1Data = $commonService->getDef1();
            $def2Data = $commonService->getDef2();
            $def3Data = $commonService->getDef3();
            $minId = $service->getMinId();
            $maxId = $service->getMaxId();
            $params = [
                'commonParams' => $this->commonParams,
                'departmentData' => $departmentData,
                'def1Data' => $def1Data,
                'def2Data' => $def2Data,
                'def3Data' => $def3Data,
                'initData' => $initData,
                'minId' => $minId,
                'maxId' => $maxId
            ];
            $result = $this->copyUserMaintenance($params);
            return $result;
            /*
            return view('admin.system.security.userMaster', [
                'commonParams' => $this->commonParams, 'departmentData' => $departmentData,
                'def1Data' => $def1Data, 'def2Data' => $def2Data, 'def3Data' => $def3Data, 'initData' => $initData, 'minId' => $minId, 'maxId' => $maxId
            ]);
            */
        } elseif ($request->has('password_reset')) {
            $result = $service->passwordReset($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.password_reset_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.password_reset_complete");
                return redirect()->route('system.security.user.maintenance.index')->with('flashmessage', $flashmessage);
            }
        }
        return redirect()->route('system.security.user.maintenance.index');
    }

    /**
     * ユーザマスタ(一覧) 初期表示
     * @param $request
     * @return Object
     */
    public function indexUserList(MtUserService $service, CommonService $commonService)
    {
        //権限確認
        $this->commonParams['auth'] = $this->commonExec(119);
        if ($this->commonParams['auth']['auth_use_flg'] !== 1) {
            return back();
        }
        $departmentData = $commonService->searchDepartment();
        $initData = $service->getInitDataList();
        return view('admin.system.security.userList', ['commonParams' => $this->commonParams, 'departmentData' => $departmentData, 'initData' => $initData]);
    }

    /**
     * ユーザマスタ(一覧) 更新
     * @param $request
     * @return Object
     */
    public function updateUserList(Request $request, MtUserService $service, CommonService $commonService)
    {
        if ($request->has('search')) {
            //検索結果を受け取り
            $this->commonParams['auth'] = $this->commonExec(119);
            if ($this->commonParams['auth']['auth_use_flg'] !== 1) {
                return back();
            }
            $initData = $service->search($request->input());
            $params = $request->input();
            $params['department_name'] = $service->getDepartmentName($request->input('department_cd'));
            $departmentData = $commonService->searchDepartment();
            return view('admin.system.security.userList', ['commonParams' => $this->commonParams, 'departmentData' => $departmentData, 'initData' => $initData, 'param' => $params]);
        } elseif ($request->has('excel')) {
            //Excelへ出力
            $datas = $service->export($request->input());
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "ユーザマスタ（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'user_cd' => ($request['user_cd']) ? str_pad($request['user_cd'], 4, 0, STR_PAD_LEFT) : '',
                'user_name' => ($request['user_name']) ? $request['user_name'] : '',
                'user_name_kana' => ($request['user_name_kana']) ? $request['user_name_kana'] : '',
                'department_cd' => ($request['department_cd']) ? str_pad($request['department_cd'], 4, 0, STR_PAD_LEFT) : '',
                'sp_auth_price_correction_possible' => ($request['sp_auth_price_correction_possible']) ?  ($request['sp_auth_price_correction_possible']) : '',
                'sp_auth_star_none_possible' => ($request['sp_auth_star_none_possible']) ?  ($request['sp_auth_star_none_possible']) : '',
                'sp_auth_hand_inspection_possible' => ($request['sp_auth_hand_inspection_possible']) ?  ($request['sp_auth_hand_inspection_possible']) : '',
                'validity_flg' => ($request['validity_flg']) ?  ($request['validity_flg']) : '',
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            try {
                $view = view('export.mt_user_list', compact('params'));
                $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                return $result;
            } catch (Exception $e) {
                $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                return back()->withInput()->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('update')) {
            //登録画面へ遷移
            return redirect()->route('system.security.user.maintenance.index');
        } elseif ($request->has('edit')) {
            //編集　画面遷移
            $id = $request->input('edit');
            return redirect()->route('system.security.user.maintenance.index_by_id', ['id' => $id]);
        }
        return redirect()->route('system.security.user.list');
    }

    /**
     * ユーザマスタ(メンテナンス) コピー処理
     * @return Object
     */
    private function copyUserMaintenance($params)
    {
        //権限確認
        $this->commonParams['auth'] = $this->commonExec(119);
        if ($this->commonParams['auth']['auth_use_flg'] !== 1) {
            return back();
        }
        // ID指定
        $departmentData = $params['departmentData'];
        $def1Data = $params['def1Data'];
        $def2Data = $params['def2Data'];
        $def3Data = $params['def3Data'];
        $initData = $params['initData'];
        $minId = $params['minId'];
        $maxId = $params['maxId'];
        $view = view('admin.system.security.userMaster', [
            'commonParams' => $this->commonParams,
            'departmentData' => $departmentData,
            'def1Data' => $def1Data,
            'def2Data' => $def2Data,
            'def3Data' => $def3Data,
            'initData' => $initData,
            'minId' => $minId,
            'maxId' => $maxId
        ]);
        return $view;
    }

    /**
     * 自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtUserService $service)
    {
        $datas =  $service->codeAutoComplete($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
