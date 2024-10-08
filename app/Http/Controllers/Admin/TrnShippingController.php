<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\TrnShippingService;

class TrnShippingController extends Controller
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
     * 出荷指示データ出力 初期表示
     * @param $request
     * @return Object
     */
    public function indexShippingInstructionOutput(Request $request)
    {
		return view('admin.alignment.jph.shippingInstructionOutput', ['commonParams' => $this->commonParams]);
    }

    /**
     * 出荷指示データ出力 更新
     * @param $request
     * @return Object
     */
    public function exportShippingInstructionOutput(Request $request, TrnShippingService $service)
    {
        $data = $service->getShippingInstructionOutput();
		return view('admin.alignment.jph.shippingInstructionOutput', ['commonParams' => $this->commonParams]);
    }

    /**
     * 出荷データ取込 初期表示
     * @param $request
     * @return Object
     */
    public function indexShippingDataImport(Request $request)
    {
		return view('admin.alignment.jph.shippingDataImport', ['commonParams' => $this->commonParams]);
    }

    /**
     * 出荷データ取込 更新
     * @param $request
     * @return Object
     */
    public function updateShippingDataImport(Request $request, TrnShippingService $service)
    {
        $data = $service->updateShippingInstructionImport();
		return view('admin.alignment.jph.shippingInstructionOutput', ['commonParams' => $this->commonParams]);
    }

}
