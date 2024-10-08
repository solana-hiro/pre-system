<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MtNotice\MtNoticeSearchRequest;
use App\Services\MtNoticeService as MtNoticeService;
use App\Services\CommonService as CommonService;
use App\Http\Requests\MtNotice\UpdateRequest as UpdateRequest;
use App\Consts\CommonConsts;
use Illuminate\Support\Facades\Storage;
use Exception;

class MtNoticeController extends Controller
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
     * お知らせ入力詳細　初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function detail(MtNoticeService $service)
    {
        return view('admin.master.ec.mt_notice.detail', [
            'commonParams' => $this->commonParams,
            'nextCode' => $service->getNextByCode(null),
        ]);
    }

    /**
     * お知らせ入力詳細　初期表示(ID指定)
     * @param $request
     * @param $service
     * @return Object
     */
    public function detailById($id, Request $request, CommonService $commonService, MtNoticeService $service)
    {
        $detailData = $service->getDetailById($id);
        if (empty($detailData)) {
            return redirect()->route('master.ec.notice.detail');
        }
        if (app()->isLocal() || app()->runningUnitTests()) {
            $path = isset($detailData['image_file']) && !empty($detailData['image_file']) ? Storage::url($detailData['image_file']) : '';
        } else {
            $path = isset($detailData['image_file']) && !empty($detailData['image_file']) ? Storage::disk('s3')->url($detailData['image_file']) : '';
        }
        return view('admin.master.ec.mt_notice.detail', [
            'commonParams' => $this->commonParams,
            'detailData' => $detailData,
            'path' => $path,
            'prevCode' => $service->getPrevByCode($detailData->notice_cd),
            'nextCode' => $service->getNextByCode($detailData->notice_cd),
        ]);
    }

    /**
     * お知らせ入力詳細　更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(UpdateRequest $request, CommonService $commonService, MtNoticeService $service)
    {
        $param = $request->input();
        $fileParam = $request->file();
        if ($request->has('cancel')) {
            return redirect()->route('master.ec.notice.detail');
        } elseif ($request->has('prev')) {
            return redirect()->route('master.ec.notice.detail_by_id', ['id' => $request->input('prev')]);
        } elseif ($request->has('next')) {
            return redirect()->route('master.ec.notice.detail_by_id', ['id' => $request->input('next')]);
        } elseif ($request->has('delete')) {
            $result = $service->delete($param['delete']);
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                if (str_contains($result['error'], 'SQLSTATE[23000]')) {
                    $errormessage = __("validation.error_messages.delete_constraint_key_error");
                } else {
                    $errormessage = __("validation.error_messages.delete_error");
                }
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.delete_complete");
                return redirect()->route('master.ec.notice.detail')->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('update')) {
            $result = $service->update($param, $fileParam);
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $key = $result['mtNoticeId'];
                if (isset($fileParam)) {
                    $info = ['table' => 'mt_notices'];
                    $result = $commonService->s3Upload($fileParam, $key, $info);
                }
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('master.ec.notice.detail_by_id', ['id' => $key])->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('redirect')) {
            $id = $request->input('redirect');
            return redirect()->route('master.ec.notice.detail_by_id', ["id" => $id]);
        }
        return redirect()->route('master.ec.notice.detail');
    }

    /**
     * お知らせ　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtNoticeService $service)
    {
        $datas =  $service->codeAutoComplete($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
