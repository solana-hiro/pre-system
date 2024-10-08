<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\MtSupplierItemPriceService;
use App\Services\MtSupplierService;
use App\Services\CommonService;
use App\Http\Requests\MtSupplierItemPrice\ExportRequest;
use App\Http\Requests\MtSupplierItemPrice\UpdateRequest;
use App\Exports\MtSupplierItemPriceExport;
use App\Exports\CommonExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as Excels;
use Carbon\Carbon;
use App\Consts\CommonConsts;
use Exception;

class MtSupplierItemPriceController extends Controller
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
     * 仕入先商品単価(一覧) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function index(Request $request)
    {
        return view('admin.master.price.mt_supplier_item_price.index', [
            'commonParams' => $this->commonParams,
            'supplier' => null,
        ]);
    }

    /**
     * 仕入先商品単価(一覧) 初期表示(ID指定)
     * @param $request
     * @param $service
     * @return Object
     */
    public function indexById($id, Request $request, MtSupplierService $supplierService, MtSupplierItemPriceService $itemPriceService)
    {
        $supplier = $supplierService->getById(['id' => $id]);
        $existsItemPrices = $itemPriceService->existsItemPrices(['supplier_id' => $id]);

        return view('admin.master.price.mt_supplier_item_price.index', [
            'commonParams' => $this->commonParams,
            'supplier' => $supplier,
            'existsItemPrices' => $existsItemPrices,
        ]);
    }

    public function pageById($id, Request $request, MtSupplierService $supplierService, MtSupplierItemPriceService $itemPriceService)
    {
        $supplier = $supplierService->getById(['id' => $id]);
        $itemPrices = $itemPriceService->get(['supplier_id' => $id]);

        return view('admin.master.price.mt_supplier_item_price.index', [
            'commonParams' => $this->commonParams,
            'supplier' => $supplier,
            'itemPrices' => $itemPrices,
        ]);
    }

    /**
     * 仕入先商品単価(一覧)  更新
     * @param $request
     * @param $service
     * @return Object
     */
    public function update(UpdateRequest $request, MtSupplierItemPriceService $service, MtSupplierService $mtSupplierService)
    {
        if ($request->has('cancel')) return redirect()->route('master.price.mt_supplier_item_price.index');
        if ($request->has('update')) {
            $result = $service->update($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('master.price.mt_supplier_item_price.index')->with('flashmessage', $flashmessage);
            }
        }
        if ($request->has('redirect')) {
            $id = $request->input('redirect');
            return redirect()->route('master.price.mt_supplier_item_price.index_by_id', ['id' => $id]);
        }
        return redirect()->route('master.price.mt_supplier_item_price.index');
    }

    /**
     * 仕入先商品単価(リスト) 初期表示
     * @param $request
     * @param $service
     * @return Object
     */
    public function list(Request $request, CommonService $commonService)
    {
        $supplierData = $commonService->searchSupplier();
        $brand1Data = $commonService->searchBrand1();
        $itemClassThing2Data = $commonService->searchItemClassThing2();
        $genreData = $commonService->searchGenre();
        $itemClassThing4Data = $commonService->searchClass4();
        $itemClassThing5Data = $commonService->searchItemClassThing5();
        $itemClassThing6Data = $commonService->searchItemClassThing6();
        $itemClassThing7Data = $commonService->searchItemClassThing7();
        $itemData = $commonService->searchItem();
        return view('admin.master.price.mt_supplier_item_price.list', [
            'commonParams' => $this->commonParams,
            'supplierData' => $supplierData,
            'itemData' => $itemData,
            'brand1Data' => $brand1Data,
            'itemClassThing2Data' => $itemClassThing2Data,
            'genreData' => $genreData,
            'itemClassThing4Data' => $itemClassThing4Data,
            'itemClassThing5Data' => $itemClassThing5Data,
            'itemClassThing6Data' => $itemClassThing6Data,
            'itemClassThing7Data' => $itemClassThing7Data,
        ]);
    }

    /**
     * 仕入先商品単価(一覧) 出力
     * @param $request
     * @param $service
     * @return Object
     */
    public function export(ExportRequest $request, MtSupplierItemPriceService $service)
    {
        if ($request->has('cancel')) {
            return back();
        } elseif ($request->has('preview') || $request->has('excel')) {
            $datas = $service->export($request->input());
            if ($datas->isEmpty()) {
                $sessionErrors[] = __("validation.error_messages.data_is_not_exist");
                return back()->withInput()->with('sessionErrors', $sessionErrors);
            }
            $fileName = "仕入先商品単価（一覧表）_" . Carbon::now()->format('Ymd') . ".xlsx";
            $params = [
                'supplierStartCode' => ($request['supplier_code_start']) ? str_pad($request['supplier_code_start'], 6, 0, STR_PAD_LEFT) : '',
                'supplierEndCode' => ($request['supplier_code_end']) ? str_pad($request['supplier_code_end'], 6, 0, STR_PAD_LEFT) : 'ZZZZZZ',
                'itemStartCode' => ($request['item_code_start']) ? $request['item_code_start'] : '',
                'itemEndCode' => ($request['item_code_end']) ? $request['item_code_end'] : 'ZZZZZZZZZ',
                'currentDate' => Carbon::now()->format('Y/m/d'),
                'datas' => $datas,
            ];
            $header = [
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];
            if ($request->has('preview')) {
                $view = view('export.mt_supplier_item_price_list_preview', compact('params'));
                return $view;
            } elseif ($request->has('excel')) {
                $view = view('export.mt_supplier_item_price_list', compact('params'));
                $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
                return $result;
            }
        }
        return redirect()->route('master.price.mt_supplier_item_price.list');
    }

    public function codeAutoComplete(Request $request, MtSupplierItemPriceService $service)
    {
        $datas =  $service->codeAutoComplete($request->input());
        header('Content-type: application/json');
        return json_encode($datas);
    }
}
