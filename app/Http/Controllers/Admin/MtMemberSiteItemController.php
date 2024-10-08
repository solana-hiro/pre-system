<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\MtMemberSiteItemService as MtMemberSiteItemService;
use App\Services\CommonService as CommonService;
use App\Exports\MtLocationExport;
use App\Consts\CommonConsts;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;

class MtMemberSiteItemController extends Controller
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
     * 自動補完
     * @param $inputCode
     * @param $service
     * @return Object
     */
    public function codeAutoComplete(Request $request, MtMemberSiteItemService $service)
    {
        $datas =  $service->codeAutoComplete($request->input('ec_item_cd'));
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 自動補完
     * @param $request
     * @param $service
     * @return Object
     */
    public function codeAutoCompleteWithCatalogOrder(Request $request, MtMemberSiteItemService $service)
    {
        $datas =  $service->codeAutoCompleteWithCatalogOrder(
            $request->input('ec_item_cd'),
            $request->input('catalog_id'),
        );
        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 自動補完
     * @param $request
     * @param $service
     * @return Object
     */
    public function codeAutoCompleteWithRecommendation(Request $request, MtMemberSiteItemService $service)
    {
        $datas =  $service->codeAutoCompleteWithRecommendation(
            $request->input('ec_item_cd'),
        );

        if (app()->isLocal() || app()->runningUnitTests()) {
            $item_image_file_1_path = isset($datas['item_image_file_1']) && !empty($datas['item_image_file_1']) ? Storage::url($datas['item_image_file_1']) : '';
            $item_image_file_2_path = isset($datas['item_image_file_2']) && !empty($datas['item_image_file_2']) ? Storage::url($datas['item_image_file_2']) : '';
            $item_image_file_3_path = isset($datas['item_image_file_3']) && !empty($datas['item_image_file_3']) ? Storage::url($datas['item_image_file_3']) : '';
            $item_image_file_4_path = isset($datas['item_image_file_4']) && !empty($datas['item_image_file_4']) ? Storage::url($datas['item_image_file_4']) : '';
            $pdf_file_1_path = isset($datas['pdf_file_1']) && !empty($datas['pdf_file_1']) ? Storage::url($datas['pdf_file_1']) : '';
            $pdf_file_2_path = isset($datas['pdf_file_2']) && !empty($datas['pdf_file_2']) ? Storage::url($datas['pdf_file_2']) : '';
            $pdf_file_3_path = isset($datas['pdf_file_3']) && !empty($datas['pdf_file_3']) ? Storage::url($datas['pdf_file_3']) : '';
            $pdf_file_4_path = isset($datas['pdf_file_4']) && !empty($datas['pdf_file_4']) ? Storage::url($datas['pdf_file_4']) : '';
            $pdf_file_5_path = isset($datas['pdf_file_5']) && !empty($datas['pdf_file_5']) ? Storage::url($datas['pdf_file_5']) : '';
            $item_banner_image_file_1_path = isset($datas['item_banner_image_file_1']) && !empty($datas['item_banner_image_file_1']) ? Storage::url($datas['item_banner_image_file_1']) : '';
            $item_banner_image_file_2_path = isset($datas['item_banner_image_file_2']) && !empty($datas['item_banner_image_file_2']) ? Storage::url($datas['item_banner_image_file_2']) : '';
        } else {
            $item_image_file_1_path = isset($datas['item_image_file_1']) && !empty($datas['item_image_file_1']) ? Storage::disk('s3')->url($datas['item_image_file_1']) : '';
            $item_image_file_2_path = isset($datas['item_image_file_2']) && !empty($datas['item_image_file_2']) ? Storage::disk('s3')->url($datas['item_image_file_2']) : '';
            $item_image_file_3_path = isset($datas['item_image_file_3']) && !empty($datas['item_image_file_3']) ? Storage::disk('s3')->url($datas['item_image_file_3']) : '';
            $item_image_file_4_path = isset($datas['item_image_file_4']) && !empty($datas['item_image_file_4']) ? Storage::disk('s3')->url($datas['item_image_file_4']) : '';
            $pdf_file_1_path = isset($datas['pdf_file_1']) && !empty($datas['pdf_file_1']) ? Storage::disk('s3')->url($datas['pdf_file_1']) : '';
            $pdf_file_2_path = isset($datas['pdf_file_2']) && !empty($datas['pdf_file_2']) ? Storage::disk('s3')->url($datas['pdf_file_2']) : '';
            $pdf_file_3_path = isset($datas['pdf_file_3']) && !empty($datas['pdf_file_3']) ? Storage::disk('s3')->url($datas['pdf_file_3']) : '';
            $pdf_file_4_path = isset($datas['pdf_file_4']) && !empty($datas['pdf_file_4']) ? Storage::disk('s3')->url($datas['pdf_file_4']) : '';
            $pdf_file_5_path = isset($datas['pdf_file_5']) && !empty($datas['pdf_file_5']) ? Storage::disk('s3')->url($datas['pdf_file_5']) : '';
            $item_banner_image_file_1_path = isset($datas['item_banner_image_file_1']) && !empty($datas['item_banner_image_file_1']) ?  Storage::disk('s3')->url($datas['item_banner_image_file_1']) : '';
            $item_banner_image_file_2_path = isset($datas['item_banner_image_file_2']) && !empty($datas['item_banner_image_file_2']) ?  Storage::disk('s3')->url($datas['item_banner_image_file_2']) : '';
        }
        $datas['item_image_file_1_path'] = $item_image_file_1_path;
        $datas['item_image_file_2_path'] = $item_image_file_2_path;
        $datas['item_image_file_3_path'] = $item_image_file_3_path;
        $datas['item_image_file_4_path'] = $item_image_file_4_path;
        $datas['pdf_file_1_path'] = $pdf_file_1_path;
        $datas['pdf_file_2_path'] = $pdf_file_2_path;
        $datas['pdf_file_3_path'] = $pdf_file_3_path;
        $datas['pdf_file_4_path'] = $pdf_file_4_path;
        $datas['pdf_file_5_path'] = $pdf_file_5_path;
        $datas['item_banner_image_file_1_path'] = $item_banner_image_file_1_path;
        $datas['item_banner_image_file_2_path'] = $item_banner_image_file_2_path;

        header('Content-type: application/json');
        return json_encode($datas);
    }

    /**
     * 自動補完
     * @param $request
     * @param $service
     * @return Object
     */
    public function codeAutoCompleteRecommendationManagement(Request $request, MtMemberSiteItemService $service)
    {
        $datas =  $service->codeAutoCompleteRecommendationManagement(
            $request->input('ec_item_cd1'),
            $request->input('ec_item_cd2'),
        );
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
