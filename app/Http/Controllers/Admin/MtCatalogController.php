<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\MtCatalog\MtCatalogSearchRequest;
use App\Services\MtCatalogService as MtCatalogService;
use App\Services\CommonService as CommonService;
use App\Consts\CommonConsts;
use App\Http\Requests\MtCatalog\UpdateRequest;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;
use Exception;

class MtCatalogController extends Controller
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
     * ピックアップ検索注文入力（詳細）　初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function detail(CommonService $commonService, MtCatalogService $service)
    {
        $nextCode = $service->getNextByCode(null);
        return view('admin.master.ec.mt_catalog.detail', ['commonParams' => $this->commonParams, 'nextCode' => $nextCode,]);
    }

    /**
     * ピックアップ検索注文入力（詳細）　初期表示(ID指定)
     * @param $request
     * @param $service
     * @return Object
     */
    public function detailById($id, CommonService $commonService, MtCatalogService $service)
    {
        $detailData = $service->getDetailById($id);
        if (empty($detailData['MtCatalog'])) {
            return redirect()->route('master.ec.catalog.detail');
        }
        $prevCode = $service->getPrevByCode($detailData['MtCatalog']->catalog_cd);
        $nextCode = $service->getNextByCode($detailData['MtCatalog']->catalog_cd);
        if (app()->isLocal() || app()->runningUnitTests()) {
            $path = isset($detailData['MtCatalog']['image_file']) && !empty($detailData['MtCatalog']['image_file']) ? Storage::url($detailData['MtCatalog']['image_file']) : '';
        } else {
            $path = isset($detailData['MtCatalog']['image_file']) && !empty($detailData['MtCatalog']['image_file']) ? Storage::disk('s3')->url($detailData['MtCatalog']['image_file']) : '';
        }
        return view('admin.master.ec.mt_catalog.detail', [
            'commonParams' => $this->commonParams,
            'detailData' => $detailData,
            'path' => $path,
            'prevCode' => $prevCode,
            'nextCode' => $nextCode,
        ]);
    }

    /**
     * ピックアップ検索注文入力（詳細）　更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(UpdateRequest $request, CommonService $commonService, MtCatalogService $service)
    {
        $param = $request->input();
        $fileParam = $request->file();
        if ($request->has('cancel')) {
            return redirect()->route('master.ec.catalog.detail');
        } elseif ($request->has('prev')) {
            $result = $service->getPrevByCode($request->input('prev'));
            if (isset($result)) {
                return redirect()->route('master.ec.catalog.detail_by_id', ['id' => $result['id']]);
            }
        } elseif ($request->has('next')) {
            $result = $service->getNextByCode($request->input('next'));
            if (isset($result)) {
                return redirect()->route('master.ec.catalog.detail_by_id', ['id' => $result['id']]);
            }
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
                return redirect()->route('master.ec.catalog.detail')->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('update')) {
            $result = $service->update($param, $fileParam);
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                if (str_contains($result['error'], "Column 'image_file' cannot be null")) {
                    $errormessage = __("validation.error_messages.image_file_is_required");
                } else {
                    $errormessage = __("validation.error_messages.update_error");
                }
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $key = $result['mtCatalogId'];
                if (isset($fileParam)) {
                    $info = ['table' => 'mt_catalogs'];
                    $result = $commonService->s3Upload($fileParam, $key, $info);
                }
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('master.ec.catalog.detail_by_id', ['id' => $key])->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('sub_delete')) {
            $result = $service->deleteItem($this->getSubDeleteTargetId($param));
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                if (str_contains($result['error'], 'SQLSTATE[23000]')) {
                    $errormessage = __("validation.error_messages.image_file_is_required");
                } else {
                    $errormessage = __("validation.error_messages.delete_error");
                }
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $this->removeSubDeleteTargetFromRequest($request);
                $flashmessage = __("validation.complete_message.delete_complete");
                return back()->withInput($request->all())->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('redirect')) {
            $id = $request->input('redirect');
            return redirect()->route('master.ec.catalog.detail_by_id', ['id' => $id]);
        }
        return redirect()->route('master.ec.catalog.detail');
    }

    // sub_delete（arrayのindex）から削除対象のID取得
    private function getSubDeleteTargetId($param)
    {
        return $param['mt_catalog_items'][$param['sub_delete']]['id'];
    }

    // リクエストパラメータから削除した行を取り除かないと画面で表示されるので削除する
    private function removeSubDeleteTargetFromRequest(&$request)
    {
        $tmp = $request->mt_catalog_items;
        array_splice($tmp, $request->sub_delete, 1);
        $request->merge(['mt_catalog_items' => $tmp]);
    }

    /**
     * カタログ　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtCatalogService $service)
    {
        $datas =  $service->codeAutoComplete($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
