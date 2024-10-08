<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MtTopFreeArea\MtTopFreeAreaSearchRequest;
use App\Services\MtTopFreeAreaService as MtTopFreeAreaService;
use App\Services\CommonService as CommonService;
use App\Consts\CommonConsts;
use App\Http\Requests\MtTopFreeArea\UpdateRequest;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;
use Exception;

class MtTopFreeAreaController extends Controller
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
     * TOP自由領域入力詳細　初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function detail(MtTopFreeAreaService $service)
    {
        $nextCode = $service->getNextByCode(null);
        return view('admin.master.ec.mt_top_free_area.detail', ['commonParams' => $this->commonParams, 'nextCode' => $nextCode]);
    }

    /**
     * TOP自由領域入力詳細　初期表示(ID指定)
     * @param $request
     * @param $service
     * @return Object
     */
    public function detailById($id, MtTopFreeAreaService $service)
    {
        $detailData = $service->getDetailById($id);
        if (empty($detailData['MtTopFreeArea'])) {
            return redirect()->route('master.ec.top_free_area.detail');
        }
        $allData = $service->getAllData();
        if (app()->isLocal() || app()->runningUnitTests()) {
            $path = isset($detailData['MtTopFreeArea']['image_file']) && !empty($detailData['MtTopFreeArea']['image_file']) ? Storage::url($detailData['MtTopFreeArea']['image_file']) : '';
        } else {
            $path = isset($detailData['MtTopFreeArea']['image_file']) && !empty($detailData['MtTopFreeArea']['image_file']) ? Storage::disk('s3')->url($detailData['MtTopFreeArea']['image_file']) : '';
        }
        return view('admin.master.ec.mt_top_free_area.detail', [
            'commonParams' => $this->commonParams,
            'detailData' => $detailData,
            'path' => $path,
            'allData' => $allData,
            'prevCode' => $service->getPrevByCode($detailData['MtTopFreeArea']->area_cd),
            'nextCode' => $service->getNextByCode($detailData['MtTopFreeArea']->area_cd),
        ]);
    }

    /**
     * TOP自由領域入力詳細　更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(UpdateRequest $request, CommonService $commonService, MtTopFreeAreaService $service)
    {
        $param = $request->input();
        $fileParam = $request->file();
        if ($request->has('cancel')) {
            return redirect()->route('master.ec.top_free_area.detail');
        } elseif ($request->has('prev')) {
            return redirect()->route('master.ec.top_free_area.detail_by_id', ['id' => $request->input('prev')]);
        } elseif ($request->has('next')) {
            return redirect()->route('master.ec.top_free_area.detail_by_id', ['id' => $request->input('next')]);
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
                return redirect()->route('master.ec.top_free_area.detail')->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('update')) {
            $result = $service->update($param, $fileParam);
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $key = $result['mtTopFreeAreaId'];
                if (isset($fileParam)) {
                    $info = ['table' => 'mt_top_free_areas'];
                    $result['s3'] = $commonService->s3Upload($fileParam, $key, $info);
                }
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('master.ec.top_free_area.detail_by_id', ['id' => $key])->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('redirect')) {
            $id = $request->input('redirect');
            return redirect()->route('master.ec.top_free_area.detail_by_id', ['id' => $id]);
        }
        return redirect()->route('master.ec.top_free_area.detail');
    }

    /**
     * TOP自由領域入力詳細　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtTopFreeAreaService $service)
    {
        $datas =  $service->codeAutoComplete($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
