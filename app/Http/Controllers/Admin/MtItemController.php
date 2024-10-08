<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\MtItemService;
use App\Services\MtColorService;
use App\Services\MtSizeService;
use App\Services\MtStockService;
use App\Services\CommonService as CommonService;
use App\Http\Requests\MtItem\MtItemExportRequest;
use App\Http\Requests\MtItem\MtItemByClassExportRequest;
use App\Http\Requests\MtItem\ItemCodeUpdateRequest;
use App\Http\Requests\MtItem\UpdateRequest;
use App\Exports\MtItemByClassExport;
use App\Exports\CommonExport;
use App\Imports\CommonImport;
use App\Imports\MtItemImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Consts\CommonConsts;
use Illuminate\Support\Facades\Storage;
use Exception;

class MtItemController extends Controller
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
     * 商品マスタリスト(一覧) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function list(Request $request, CommonService $commonService)
    {
        return view('admin.master.item.mt_item.list', [
            'commonParams' => $this->commonParams,
        ]);
    }

    /**
     * 商品マスタリスト(一覧) 出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function export(MtItemExportRequest $request, MtItemService $service)
    {
        $params = $request->input();
        if ($request->has('cancel')) {
            return redirect()->route('master.item.mt_item.list');
        } elseif ($request->has('sku')) {
            $datas = $service->exportSku($params);
            if (empty($datas['mtItem'])) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "取込原本（SKU）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'datas' => $datas,
            ];
            $view = view('export.mt_item_list_sku', compact('params'));
            $headers = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/octet-stream'
            ];
            try {
                $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $headers);
                return $result;
            } catch (Exception $e) {
                $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                return back()->withInput()->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('item_cd')) {
            $datas = $service->exportItemCd($params);
            if (empty($datas['mtItem'])) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "取込原本（品番）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'datas' => $datas,
            ];

            $view = view('export.mt_item_list_itemcd', compact('params'));
            $headers = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/octet-stream'
            ];
            try {
                $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $headers);
                return $result;
            } catch (Exception $e) {
                $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                return back()->withInput()->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('excel') || $request->has('preview')) {
            $datas = $service->export($params);
            //dd($datas['mtSize']->where('id', $datas['mtItem'][0]['colors'][1]['size'][0]->mt_size_id)->first()['size_name']);
            if (empty($datas['mtItem'])) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "商品リスト（一覧）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'itemClass1Start' => $params['item_class1_start'] ? $params['item_class1_start'] : '',
                'itemClass1End' => $params['item_class1_end'] ? $params['item_class1_end'] : 'ZZZZZZ',
                'itemClass2Start' => $params['item_class2_start'] ? $params['item_class2_start'] : '',
                'itemClass2End' => $params['item_class2_end'] ? $params['item_class2_end'] : 'ZZZZZZ',
                'itemClass3Start' => $params['item_class3_start'] ? $params['item_class3_start'] : '',
                'itemClass3End' => $params['item_class3_end'] ? $params['item_class3_end'] : 'ZZZZZZ',
                'itemClass4Start' => $params['item_class4_start'] ? $params['item_class4_start'] : '',
                'itemClass4End' => $params['item_class4_end'] ? $params['item_class4_end'] : 'ZZZZZZ',
                'itemClass5Start' => $params['item_class5_start'] ? $params['item_class5_start'] : '',
                'itemClass5End' => $params['item_class5_end'] ? $params['item_class5_end'] : 'ZZZZZZ',
                'itemClass6Start' => $params['item_class6_start'] ? $params['item_class6_start'] : '',
                'itemClass6End' => $params['item_class6_end'] ? $params['item_class6_end'] : 'ZZZZZZ',
                'itemClass7Start' => $params['item_class7_start'] ? $params['item_class7_start'] : '',
                'itemClass7End' => $params['item_class7_end'] ? $params['item_class7_end'] : 'ZZZZZZ',
                'itemCodeStart' => $params['item_cd_start'] ? $params['item_cd_start'] : '',
                'itemCodeEnd' => $params['item_cd_end'] ? $params['item_cd_end'] : 'ZZZZZZZZZ',
                'otherPartNumberStart' => $params['other_part_number_start'] ? $params['other_part_number_start'] : '',
                'otherPartNumberEnd' => $params['other_part_number_end'] ? $params['other_part_number_end'] : 'ZZZZZZZZZZZZZZZZZZZZ',
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];

            if ($request->has('preview')) {
                $view = view('export.mt_item_list_preview', compact('params'));
                return $view;
            } elseif ($request->has('excel')) {
                $view = view('export.mt_item_list', compact('params'));
                $headers = [
                    'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                    'Content-Type' => 'application/octet-stream'
                ];
                try {
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $headers);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        }
        return redirect()->route('master.item.mt_item.list');
    }

    /**
     * 商品マスタ入力(詳細) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function detail(UpdateRequest $request, CommonService $commonService, MtItemService $service)
    {
        $maxCode = $service->getMaxCode();
        $minCode = $service->getMinCode();
        return view('admin.master.item.mt_item.detail', [
            'commonParams' => $this->commonParams,
            'minCode' => $minCode,
            'maxCode' => $maxCode,
        ]);
    }

    /**
     * 商品マスタ入力(詳細) IDによる詳細表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function detailById($id, Request $request, CommonService $commonService, MtItemService $service)
    {
        $maxCode = $service->getMaxCode();
        $minCode = $service->getMinCode();
        $detailData = $service->getDetailById($id);
        if (app()->isLocal() || app()->runningUnitTests()) {
            $item_image_file_1_path = isset($detailData['memberSiteItemData']['item_image_file_1']) && !empty($detailData['memberSiteItemData']['item_image_file_1']) ? Storage::url($detailData['memberSiteItemData']['item_image_file_1']) : '';
            $item_image_file_2_path = isset($detailData['memberSiteItemData']['item_image_file_2']) && !empty($detailData['memberSiteItemData']['item_image_file_2']) ? Storage::url($detailData['memberSiteItemData']['item_image_file_2']) : '';
            $item_image_file_3_path = isset($detailData['memberSiteItemData']['item_image_file_3']) && !empty($detailData['memberSiteItemData']['item_image_file_3']) ? Storage::url($detailData['memberSiteItemData']['item_image_file_3']) : '';
            $item_image_file_4_path = isset($detailData['memberSiteItemData']['item_image_file_4']) && !empty($detailData['memberSiteItemData']['item_image_file_4']) ? Storage::url($detailData['memberSiteItemData']['item_image_file_4']) : '';
            $pdf_file_1_path = isset($detailData['memberSiteItemData']['pdf_file_1']) && !empty($detailData['memberSiteItemData']['pdf_file_1']) ? Storage::url($detailData['memberSiteItemData']['pdf_file_1']) : '';
            $pdf_file_2_path = isset($detailData['memberSiteItemData']['pdf_file_2']) && !empty($detailData['memberSiteItemData']['pdf_file_2']) ? Storage::url($detailData['memberSiteItemData']['pdf_file_2']) : '';
            $pdf_file_3_path = isset($detailData['memberSiteItemData']['pdf_file_3']) && !empty($detailData['memberSiteItemData']['pdf_file_3']) ? Storage::url($detailData['memberSiteItemData']['pdf_file_3']) : '';
            $pdf_file_4_path = isset($detailData['memberSiteItemData']['pdf_file_4']) && !empty($detailData['memberSiteItemData']['pdf_file_4']) ? Storage::url($detailData['memberSiteItemData']['pdf_file_4']) : '';
            $pdf_file_5_path = isset($detailData['memberSiteItemData']['pdf_file_5']) && !empty($detailData['memberSiteItemData']['pdf_file_5']) ? Storage::url($detailData['memberSiteItemData']['pdf_file_5']) : '';
            $item_banner_image_file_1_path = isset($detailData['memberSiteItemData']['item_banner_image_file_1']) && !empty($detailData['memberSiteItemData']['item_banner_image_file_1']) ? Storage::url($detailData['memberSiteItemData']['item_banner_image_file_1']) : '';
            $item_banner_image_file_2_path = isset($detailData['memberSiteItemData']['item_banner_image_file_2']) && !empty($detailData['memberSiteItemData']['item_banner_image_file_2']) ? Storage::url($detailData['memberSiteItemData']['item_banner_image_file_2']) : '';
        } else {
            $item_image_file_1_path = isset($detailData['memberSiteItemData']['item_image_file_1']) && !empty($detailData['memberSiteItemData']['item_image_file_1']) ? Storage::disk('s3')->url($detailData['memberSiteItemData']['item_image_file_1']) : '';
            $item_image_file_2_path = isset($detailData['memberSiteItemData']['item_image_file_2']) && !empty($detailData['memberSiteItemData']['item_image_file_2']) ? Storage::disk('s3')->url($detailData['memberSiteItemData']['item_image_file_2']) : '';
            $item_image_file_3_path = isset($detailData['memberSiteItemData']['item_image_file_3']) && !empty($detailData['memberSiteItemData']['item_image_file_3']) ? Storage::disk('s3')->url($detailData['memberSiteItemData']['item_image_file_3']) : '';
            $item_image_file_4_path = isset($detailData['memberSiteItemData']['item_image_file_4']) && !empty($detailData['memberSiteItemData']['item_image_file_4']) ? Storage::disk('s3')->url($detailData['memberSiteItemData']['item_image_file_4']) : '';
            $pdf_file_1_path = isset($detailData['memberSiteItemData']['pdf_file_1']) && !empty($detailData['memberSiteItemData']['pdf_file_1']) ? Storage::disk('s3')->url($detailData['memberSiteItemData']['pdf_file_1']) : '';
            $pdf_file_2_path = isset($detailData['memberSiteItemData']['pdf_file_2']) && !empty($detailData['memberSiteItemData']['pdf_file_2']) ? Storage::disk('s3')->url($detailData['memberSiteItemData']['pdf_file_2']) : '';
            $pdf_file_3_path = isset($detailData['memberSiteItemData']['pdf_file_3']) && !empty($detailData['memberSiteItemData']['pdf_file_3']) ? Storage::disk('s3')->url($detailData['memberSiteItemData']['pdf_file_3']) : '';
            $pdf_file_4_path = isset($detailData['memberSiteItemData']['pdf_file_4']) && !empty($detailData['memberSiteItemData']['pdf_file_4']) ? Storage::disk('s3')->url($detailData['memberSiteItemData']['pdf_file_4']) : '';
            $pdf_file_5_path = isset($detailData['memberSiteItemData']['pdf_file_5']) && !empty($detailData['memberSiteItemData']['pdf_file_5']) ? Storage::disk('s3')->url($detailData['memberSiteItemData']['pdf_file_5']) : '';
            $item_banner_image_file_1_path = isset($detailData['memberSiteItemData']['item_banner_image_file_1']) && !empty($detailData['memberSiteItemData']['item_banner_image_file_1']) ?  Storage::disk('s3')->url($detailData['memberSiteItemData']['item_banner_image_file_1']) : '';
            $item_banner_image_file_2_path = isset($detailData['memberSiteItemData']['item_banner_image_file_2']) && !empty($detailData['memberSiteItemData']['item_banner_image_file_2']) ?  Storage::disk('s3')->url($detailData['memberSiteItemData']['item_banner_image_file_2']) : '';
        }
        return view('admin.master.item.mt_item.detail', [
            'commonParams' => $this->commonParams,
            'minCode' => $minCode,
            'maxCode' => $maxCode,
            'detailData' => $detailData,
            'item_image_file_1_path' => $item_image_file_1_path,
            'item_image_file_2_path' => $item_image_file_2_path,
            'item_image_file_3_path' => $item_image_file_3_path,
            'item_image_file_4_path' => $item_image_file_4_path,
            'pdf_file_1_path' => $pdf_file_1_path,
            'pdf_file_2_path' => $pdf_file_2_path,
            'pdf_file_3_path' => $pdf_file_3_path,
            'pdf_file_4_path' => $pdf_file_4_path,
            'pdf_file_5_path' => $pdf_file_5_path,
            'item_banner_image_file_1_path' => $item_banner_image_file_1_path,
            'item_banner_image_file_2_path' => $item_banner_image_file_2_path,
        ]);
    }

    /**
     * 商品マスタ入力(詳細) 更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(UpdateRequest $request, CommonService $commonService, MtItemService $service)
    {
        $param = $request->input();
        $fileParam = $request->file();
        if ($request->has('cancel')) {
            return redirect()->route('master.item.mt_item.detail');
        } elseif ($request->has('prev')) {
            $result = $service->getPrevByCode($param['item_cd']);
            if (isset($result)) {
                return redirect()->route('master.item.mt_item.detail_by_id', ['id' => $result['id']]);
            }
        } elseif ($request->has('next')) {
            $result = $service->getNextByCode($param['item_cd']);
            if (isset($result)) {
                return redirect()->route('master.item.mt_item.detail_by_id', ['id' => $result['id']]);
            }
        } elseif ($request->has('delete')) {
            $result = $service->delete($param['hidden_detail_id']);
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                if (str_contains($result['error'], 'SQLSTATE[23000]')) {
                    $errormessage = __("validation.error_messages.delete_constraint_key_error");
                } else {
                    $errormessage = __("validation.error_messages.delete_error");
                }
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.delete_complete");
                return redirect()->route('master.item.mt_item.detail')->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('delete_ec')) {
            $result = $service->deleteEcData($param['delete_ec']);
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                if (str_contains($result['error'], 'SQLSTATE[23000]')) {
                    $errormessage = __("validation.error_messages.delete_constraint_key_error");
                } else {
                    $errormessage = __("validation.error_messages.delete_error");
                }
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.delete_complete");
                return redirect()->route('master.delivery.mt_delivery_destinations.index')->with('flashmessage', $flashmessage);
            }
            return back()->withInput();
        } elseif ($request->has('update')) {
            $result = $service->update($param, $fileParam);
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                if (isset($result['mtMemberSiteItemId'])) {
                    $key = $result['mtMemberSiteItemId'];
                    if (isset($fileParam)) {
                        $info = ['table' => 'mt_member_site_items'];
                        // 過去にアップロード済みのファイルを削除
                        $result['s3'] = $commonService->s3Delete($fileParam, $key, $info);
                        $result['s3'] = $commonService->s3Upload($fileParam, $key, $info);
                    }
                }

                if (isset($result['customMSG'])) {
                    $flashmessage = $result['customMSG'];
                } else {
                    $flashmessage = __("validation.complete_message.update_complete");
                }

                return redirect()->route('master.item.mt_item.detail_by_id', ['id' => $result['mtItemId']])->with('flashmessage', $flashmessage);
            }
        } elseif ($request->has('redirect')) {
            $id = $request->input('redirect');
            return redirect()->route('master.item.mt_item.detail_by_id', ['id' => $id]);
        }
        return redirect()->route('master.item.mt_item.detail');
    }


    /**
     * 商品マスタリスト(分類別) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function classList(Request $request, CommonService $commonService)
    {
        return view('admin.master.item.mt_item.classlist', [
            'commonParams' => $this->commonParams,
        ]);
    }

    /**
     * 商品マスタリスト(分類別) 出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function classExport(MtItemByClassExportRequest $request, MtItemService $service)
    {
        if ($request->has('cancel')) {
            return redirect()->route('master.item.mt_item.class.list');
        } elseif ($request->has('preview') || $request->has('excel')) {
            $itemClassThingId = $request->input('item_class_id');
            $datas = $service->exportByClass($request->input());
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            if ($itemClassThingId == 1) {
                $fileName = "商品マスタ（ブランド1別）_" . Carbon::now()->format('Ymd') . ".xlsx";
                $itemClassCodeStartCode = ($request['item_class_code1_start']) ? $request['item_class_code1_start'] : '';
                $itemClassCodeEndCode = ($request['item_class_code1_end']) ? $request['item_class_code1_end'] : 'ZZZZZZ';
            } elseif ($itemClassThingId == 2) {
                $fileName = "商品マスタ（競技・カテゴリ別）_" . Carbon::now()->format('Ymd') . ".xlsx";
                $itemClassCodeStartCode = ($request['item_class_code2_start']) ? $request['item_class_code2_start'] : '';
                $itemClassCodeEndCode = ($request['item_class_code2_end']) ? $request['item_class_code2_end'] : 'ZZZZZZ';
            } elseif ($itemClassThingId == 3) {
                $fileName = "商品マスタ（ジャンル別）_" . Carbon::now()->format('Ymd') . ".xlsx";
                $itemClassCodeStartCode = ($request['item_class_code3_start']) ? $request['item_class_code3_start'] : '';
                $itemClassCodeEndCode = ($request['item_class_code3_end']) ? $request['item_class_code3_end'] : 'ZZZZZZ';
            }
            $params = [
                'item_class_thing_id' => $itemClassThingId,
                'itemClassCodeStartCode' => $itemClassCodeStartCode,
                'itemClassCodeEndCode' => $itemClassCodeEndCode,
                'itemCodeStartCode' => ($request['item_code_start']) ? $request['item_code_start'] : '',
                'itemCodeEndCode' => ($request['item_code_end']) ? $request['item_code_end'] : 'ZZZZZZZZZ',
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            if ($request->has('preview')) {
                if ($itemClassThingId == 1) {
                    $view = view('export.mt_item_class_list_1_preview', compact('params'));
                } elseif ($itemClassThingId == 2) {
                    $view = view('export.mt_item_class_list_2_preview', compact('params'));
                } elseif ($itemClassThingId == 3) {
                    $view = view('export.mt_item_class_list_3_preview', compact('params'));
                }
                return $view;
            } elseif ($request->has('excel')) {
                try {
                    if ($itemClassThingId == 1) {
                        $view = view('export.mt_item_class_list_1', compact('params'));
                    } elseif ($itemClassThingId == 2) {
                        $view = view('export.mt_item_class_list_2', compact('params'));
                    } elseif ($itemClassThingId == 3) {
                        $view = view('export.mt_item_class_list_3', compact('params'));
                    }
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    // $result = Excel::download(new MtItemByClassExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        }
        return redirect()->route('master.item.mt_item.class.list');
    }

    /**
     * 商品マスタExcel取込 初期表示
     * @param $request
     * @return Object
     */
    public function fileIndex(Request $request)
    {
        return view('admin.master.item.mt_item.file', ['commonParams' => $this->commonParams]);
    }

    /**
     * 商品マスタExcel取込 更新
     * @param $request
     * @return Object
     */
    public function fileImport(Request $request, MtItemService $service)
    {
        if ($request->has('error_output')) {
            //エラー情報が存在するか判定
            if (!$request->session()->has('itemImportError')) {
                return back()->with('errorMessage', __("validation.error_messages.error_is_not_exist"));
            }
            if (empty($request->session()->has('itemImportError'))) {
                return back()->with('errorMessage', __("validation.error_messages.error_is_not_exist"));
            } else {
                //エラーファイル出力
                $errorInfo = $request->session()->get('itemImportError')[0];
                $rows = $request->session()->get('itemImport')[0];
                if (!empty($request->session()->has('searchCondition'))) {
                    $searchCondition = $request->session()->get('searchCondition');
                }
                $i = 0;
                foreach ($rows as $row) {
                    $errorDetail = $errorInfo[$i + 1]->all();
                    foreach ($row as $key => $value) {
                        if (is_numeric($key) && $key >= 51) {
                            unset($row[$key]);
                        }
                    }
                    $rows[$i] = $row;
                    $rows[$i]['エラー内容'] = implode(",", $errorDetail);
                    $i++;
                }
                $errorsList = array();
                $j = 1;
                foreach ($errorInfo as $error) {
                    $keys = $error->keys();
                    foreach ($keys as $key) {
                        $errorsList[$j][] = (string)$key;
                    }
                    $j++;
                }
                try {
                    $params = [
                        'datas' => $rows,
                        'errorsList' => $errorsList,
                    ];
                    // 品番
                    if ($searchCondition['input_original_kbn'] === '0') {
                        $fileName = "エラー商品マスタ_品番.xlsx";
                        $view = view('export.mt_item_code_export_list', compact('params'));
                    } else {
                        $fileName = "エラー商品マスタ_SKU.xlsx";
                        $view = view('export.mt_item_sku_export_list', compact('params'));
                    }
                    $header = [
                        'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    ];
                    if ($request->session()->has('itemImportError')) {
                        $request->session()->forget('itemImportError');
                    }
                    $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                    return $result;
                } catch (Exception $e) {
                    $flashmessage = "Excel出力が失敗しました。<br>エラー情報：" . $e->getMessage();
                    return back()->withInput()->with('flashmessage', $flashmessage);
                }
            }
        } elseif ($request->has('update')) {
            //ファイルが選択されていない場合
            if ($request->file('import_file') === false) {
                return back()->with('errorMessage', __("validation.error_messages.file_is_not_exist"));
            }
            $file = $request->file('import_file');
            if ($file === null) {
                $flashmessage = __("validation.error_messages.import_file_not_exists");;
                return back()->withInput()->with('flashmessage', $flashmessage);
            }
            if ($file->getClientMimeType() !== 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                $flashmessage = __("validation.error_messages.file_type_is_not_excel");;
                return back()->withInput()->with('flashmessage', $flashmessage);
            }
            try {
                $rows = Excel::toArray(new CommonImport, $file, null, Excels::XLSX);
                // 品番=新規+修正, SKU=修正
                $mode = $request->input('input_kbn');
                $input_kbn = $request->input('input_kbn');
                $target = $request->input('input_original_kbn');
                $janMode = $request->input('jan_mode');
                $checkFormat = $service->checkImportFormat($rows, $mode, $target, $input_kbn);
                $request->session()->put('searchCondition', $request->input());
                if ($checkFormat['status'] === CommonConsts::STATUS_ERROR || !isset($checkFormat['status'])) {
                    // Sessionにエラー内容と入力内容を保存
                    if (isset($checkFormat['rowErrors'])) {
                        $request->session()->put('itemImportError', $checkFormat['rowErrors']);
                    }
                    $request->session()->put('itemImport', $rows);
                    // 取り込んだエクセルの項目チェックエラー
                    if (isset($checkFormat['rowErrors'])) {
                        $errormessage = __("validation.error_messages.excel_import_fail") . "<br>";
                        if (isset($checkFormat['rowErrors'][0])) {
                            foreach ($checkFormat['rowErrors'][0] as $errors) {
                                foreach ($errors->all() as $error) {
                                    $errormessage .= "「" . $error . "」";
                                }
                                $errormessage .= "<br>";
                            }
                        }
                        // エクセル内データのバリデーションエラー
                    } else if (isset($checkFormat['error'])) {
                        $errormessage = __("validation.error_messages.excel_import_fail") . "<br>" . $checkFormat['error'];
                    }
                    return back()->withInput()->with('errormessage', $errormessage);
                }
                //UPDATEorINSERT 商品マスタ, メンバーサイト商品マスタ, SKUマスタ, 商品変更履歴マスタ
                $result = $service->importUpdate($rows, $mode, $target, $janMode);
                if ($result['status'] === CommonConsts::STATUS_ERROR || !isset($result['status'])) {
                    $errormessage = __("validation.error_messages.update_error") . "<br>" . $result['error'];
                    return back()->withInput()->with('errormessage', $errormessage);
                } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                    if ($request->session()->has('itemImportError')) {
                        $request->session()->forget('itemImportError');
                    }
                    if (isset($result['customMSG'])) {
                        $flashmessage = $result['customMSG'];
                    } else {
                        $flashmessage = __("validation.complete_message.update_complete");
                    }

                    return redirect()->route('master.item.mt_item.file.index')->with('flashmessage', $flashmessage);
                }
            } catch (Exception $e) {
                $flashmessage = "エラーが発生したため、取込処理を中断します。<br>エラー情報：" . $e->getMessage();
                return back()->withInput()->with('flashmessage', $flashmessage);
            }
        }
        redirect()->route('master.item.mt_item.file.index');
    }

    /**
     * 商品コード変更 初期表示
     * @param $request
     * @return Object
     */
    public function itemCodeIndex(Request $request, CommonService $commonService)
    {
        return view('admin.master.other.mt_item.codeIndex', [
            'commonParams' => $this->commonParams,
        ]);
    }

    /**
     * 商品コード変更 更新
     * @param $request
     * @return Object
     */
    public function itemCodeUpdate(ItemCodeUpdateRequest $request, MtItemService $service)
    {
        if ($request->has('cancel')) {
            return redirect()->route('master.other.mt_item.item_cd.index');
        } elseif ($request->has('update')) {
            $result = $service->updateItemCode($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('master.other.mt_item.item_cd.index')->with('flashmessage', $flashmessage);
            }
        }
        return redirect()->route('master.other.mt_item.item_cd.index');
    }

    /**
     * 商品データ出力 初期表示
     * @param $request
     * @return Object
     */
    public function indexItemDataOutput(Request $request)
    {
        return view('admin.alignment.jph.itemDataOutput', ['commonParams' => $this->commonParams]);
    }

    /**
     * 商品データ出力 更新
     * @param $request
     * @return Object
     */
    public function exportItemDataOutput(Request $request, MtItemService $service)
    {
        //$data = $service->updateItemDataOutput();
        return view('admin.alignment.jph.itemDataOutput', ['commonParams' => $this->commonParams]);
    }

    /**
     * 商品コード　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtItemService $service)
    {
        $datas =  $service->codeAutoComplete($request->input('item_cd'));
        header('Content-type: application/json');
        return json_encode($datas);
    }


    /**
     * 商品コード（SKU含む）　自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoCompleteWithSKU(Request $request, MtItemService $service)
    {
        $datas =  $service->codeAutoCompleteWIthSKU($request->input('item_cd'));
        header('Content-type: application/json');
        return json_encode($datas);
    }

    public function getStockInfo(Request $request, MtItemService $service, MtColorService $colorService, MtSizeService $sizeService, MtStockService $stockService)
    {
        $mt_stock_keeping_units =  $service->getStockInfo($request->input('item_cd'));
        $mt_colors = $colorService->getColors($request->input('item_cd'));
        $mt_sizes = $sizeService->getSizes($request->input('item_cd'));
        $mt_stocks = $stockService->getStocks($request->input('warehouse_cd'), $mt_stock_keeping_units);

        $res = [
            'mt_stock_keeping_units' => $mt_stock_keeping_units,
            'mt_colors' => $mt_colors,
            'mt_sizes' => $mt_sizes,
            'mt_stocks' => $mt_stocks,
        ];
        header('Content-type: application/json');
        return json_encode($res);
    }

    public function getStockDetailInfo(Request $request, MtItemService $service, MtStockService $stockService)
    {
        $mt_stock_keeping_unit = $service->getStockKeepingUnit($request->input('item_cd'), $request->input('color_cd'), $request->input('size_cd'));
        $stocks = $stockService->getStocksByKeepingUnitId($mt_stock_keeping_unit->id);

        header('Content-type: application/json');
        return json_encode($stocks);
    }
}
