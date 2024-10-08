<?php

namespace App\Http\Controllers\Admin;

use App\Services\CommonService as CommonService;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    /**
    * commonParams: 共通パラメータ
    */
    private $commonParams;

    /**
    * commonParams: 各検索情報テスト
    */
    private $psKbnData;  //PS区分
    private $topFreeAreaData;    //TOP自由領域コード検索
    private $noticeData; //お知らせ検索
    private $catalogData;    //カタログ検索
    private $colorPatternData;   //カラーパターン検索
    private $colorData;  //カラー検索
    private $sizePatternData;    //サイズパターン検索
    private $sizeData;   //サイズ検索
    private $genreData;    //ジャンル検索
    private $brand1Data;   //ブランド1検索
    private $rank3Data;    //ランク3検索
    private $rootData; //ルート検索
    private $shippingCompanyData;  //運送会社検索
    private $pioneerData;  //開拓年分類検索
    private $itemClassThing2Data;  //競技・カテゴリ検索
    private $customerClass2Data; //業種・特徴2検索
    private $bankData; //銀行検索
    private $itemClassThing5Data;  //工場分類5検索
    private $supplierData; //仕入先コード検索
    private $supplierClass1Data;   //仕入先分類1検索
    private $supplierClass2Data;   //仕入先分類2検索
    private $supplierClass3Data;   //仕入先分類3検索
    private $payDestinationData;   //支払先コード検索
    private $itemClassThing7Data;  //資産在庫JA検索
    private $itemClassThing6Data;  //製品/工賃6検索
    private $itemData;  //商品コード検索
    private $billingAddressData;  //請求先コード検索
    private $taxRateKbnData;   //税率区分検索
    private $warehouseData;    //倉庫検索
    private $managerData;  //担当者検索
    private $districtClassData;  //地区分類検索
    private $arrivalDateData;  //着日検索
    private $slipKindData; //伝票種別検索
    private $customerData; //得意先コード検索
    //private $customerBalanceData; //得意先残高検索 TODO:設計確認中
    private $deliveryDestinationData;  //納品先検索
    private $customerClass1Data;   //販売パターン1検索
    private $itemClassThing4Data;  //販売開始年検索
    private $departmentData;    //部門検索

    public function __construct()
    {
        parent::__construct();
        $menus = $this->getMenu();
        $pageInfo = $this->getPageInfo();
        $this->commonParams = ['menus' => $menus, 'pageInfo' => $pageInfo];
        $this->psKbnData = $this->searchPsKbn();  //PS区分検索
        $this->topFreeAreaData = $this->searchMtTopFreeArea();    //TOP自由領域コード検索
        $this->noticeData = $this->searchMtNotice(); //お知らせ検索
        $this->catalogData = $this->searchMtCatalog();    //カタログ検索
        $this->colorPatternData = $this->searchMtColorPattern();   //カラーパターン検索
        $this->colorData = $this->searchMtColor();  //カラー検索
        $this->sizePatternData = $this->searchMtSizePattern();    //サイズパターン検索
        $this->sizeData = $this->searchMtSize();   //サイズ検索
        $this->genreData = $this->searchGenre();    //ジャンル検索
        $this->brand1Data = $this->searchBrand1();   //ブランド1検索
        $this->rank3Data = $this->searchRank3();    //ランク3検索
        $this->rootData = $this->searchRoot(); //ルート検索
        $this->shippingCompanyData = $this->searchShippingCompany();  //運送会社検索
        $this->pioneerData = $this->searchPioneer();  //開拓年分類検索
        $this->itemClassThing2Data = $this->searchItemClassThing2();  //競技・カテゴリ検索
        $this->customerClass2Data = $this->searchIndustry(); //業種・特徴2検索
        $this->bankData = $this->searchBank(); //銀行検索
        $this->itemClassThing5Data = $this->searchItemClassThing5();  //工場分類5検索
        $this->supplierData = $this->searchSupplier(); //仕入先コード検索
        $this->supplierClass1Data = $this->searchSupplierClass1();   //仕入先分類1検索
        $this->supplierClass2Data = $this->searchSupplierClass2();   //仕入先分類2検索
        $this->supplierClass3Data = $this->searchSupplierClass3();   //仕入先分類3検索
        $this->payDestinationData = $this->searchPayDestination();   //支払先コード検索
        $this->itemClassThing7Data = $this->searchItemClassThing7();  //資産在庫JA検索
        $this->itemClassThing6Data = $this->searchItemClassThing6();  //製品/工賃6検索
        $this->itemData = $this->searchItem();  //商品コード検索
        $this->billingAddressData = $this->searchBillingAddress();  //請求先コード検索
        $this->taxRateKbnData = $this->searchTaxRateKbn();   //税率区分検索
        $this->warehouseData = $this->searchWarehouse();    //倉庫検索
        $this->managerData = $this->searchManager();  //担当者検索
        $this->districtClassData = $this->searchDistrictClass();  //地区分類検索
        $this->arrivalDateData = $this->searchArrivalDate();  //着日検索
        $this->slipKindData = $this->searchSlipKind(); //伝票種別検索
        $this->customerData = $this->searchCustomer(); //得意先コード検索
        //$this->xxxxxxxxx = $this->searchBalance(); //得意先残高検索 TODO:設計確認中
        $this->deliveryDestinationData = $this->searchDeliveryDestination();  //納品先検索
        $this->customerClass1Data = $this->searchCustomerClassThing();   //販売パターン1検索
        $this->itemClassThing4Data = $this->searchClass4();  //販売開始年検索
        $this->departmentData= $this->searchDepartment();
    }

    /**
     * modal test
     * @param $request
     * @param $service
     * @return Object
     */
    public function confirm()
    {
        return view('admin.sample.modal', ['commonParams' => $this->commonParams]);
    }
    /**
     * Component
     * @param $request
     * @param $service
     * @return Object
     */
    public function modal(Request $request)
    {
		return view('admin.sample.sample', [
            'commonParams' => $this->commonParams,
            'psKbnData' => $this->psKbnData,
            'topFreeAreaData' => $this->topFreeAreaData,
            'noticeData' => $this->noticeData, //お知らせ検索
            'catalogData' => $this->catalogData,    //カタログ検索
            'colorPatternData' => $this->colorPatternData,   //カラーパターン検索
            'colorData' => $this->colorData,  //カラー検索
            'sizePatternData' => $this->sizePatternData,    //サイズパターン検索
            'sizeData' => $this->sizeData,   //サイズ検索
            'genreData' => $this->genreData,    //ジャンル検索
            'brand1Data' => $this->brand1Data,   //ブランド1検索
            'rank3Data' => $this->rank3Data,    //ランク3検索
            'rootData' => $this->rootData, //ルート検索
            'shippingCompanyData' => $this->shippingCompanyData,  //運送会社検索
            'pioneerData' => $this->pioneerData,  //開拓年分類検索
            'itemClassThing2Data' => $this->itemClassThing2Data,  //競技・カテゴリ検索
            'customerClass2Data' => $this->customerClass2Data, //業種・特徴2検索
            'bankData' => $this->bankData, //銀行検索
            'itemClassThing5Data' => $this->itemClassThing5Data,  //工場分類5検索
            'supplierData' => $this->supplierData, //仕入先コード検索
            'supplierClass1Data' => $this->supplierClass1Data,   //仕入先分類1検索
            'supplierClass2Data' => $this->supplierClass2Data,   //仕入先分類2検索
            'supplierClass3Data' => $this->supplierClass3Data,   //仕入先分類3検索
            'payDestinationData' => $this->payDestinationData,   //支払先コード検索
            'itemClassThing7Data' => $this->itemClassThing7Data,  //資産在庫JA検索
            'itemClassThing6Data' => $this->itemClassThing6Data,  //製品/工賃6検索
            'itemData' => $this->itemData,  //商品コード検索
            'billingAddressData' => $this->billingAddressData,  //請求先コード検索
            'taxRateKbnData' => $this->taxRateKbnData,   //税率区分検索
            'warehouseData' => $this->warehouseData,    //倉庫検索
            'managerData' => $this->managerData,  //担当者検索
            'districtClassData' => $this->districtClassData,  //地区分類検索
            'arrivalDateData' => $this->arrivalDateData,  //着日検索
            'slipKindData' => $this->slipKindData, //伝票種別検索
            'customerData' => $this->customerData, //得意先コード検索
            //$this->xxxxxxxxx = $this->searchBalance(); //得意先残高検索 TODO:設計確認中
            'deliveryDestinationData' => $this->deliveryDestinationData,  //納品先検索
            'customerClass1Data' => $this->customerClass1Data,   //販売パターン1検索
            'itemClassThing4Data' => $this->itemClassThing4Data,  //販売開始年検索
            'departmentData' => $this->departmentData,    //部門検索
        ]);
    }

    /**
     * PS区分検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchPsKbn()
    {
        $service = new CommonService();
        $data =  $service->searchPsKbn();
        return $data;
    }

    /**
     * TOP自由領域コード検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchMtTopFreeArea()
    {
        $service = new CommonService();
        $data =  $service->searchMtTopFreeArea();
        return $data;
    }

    /**
     * お知らせ検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchMtNotice()
    {
        $service = new CommonService();
        $data =  $service->searchMtNotice();
        return $data;
    }

    /**
     * カタログ検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchMtCatalog()
    {
        $service = new CommonService();
        $data =  $service->searchMtCatalog();
        return $data;
    }

    /**
     * カラーパターン検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchMtColorPattern()
    {
        $service = new CommonService();
        $data =  $service->searchMtColorPattern();
        return $data;
    }

    /**
     * カラー検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchMtColor()
    {
        $service = new CommonService();
        $data =  $service->searchMtColor();
        return $data;
    }

    /**
     * サイズパターン検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchMtSizePattern()
    {
        $service = new CommonService();
        $data =  $service->searchMtSizePattern();
        return $data;
    }

    /**
     * サイズ検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchMtSize()
    {
        $service = new CommonService();
        $data =  $service->searchMtSize();
        return $data;
    }

    /**
     * ジャンル検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchGenre()
    {
        $service = new CommonService();
        $data =  $service->searchGenre();
        return $data;
    }

    /**
     * ブランド1検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchBrand1()
    {
        $service = new CommonService();
        $data =  $service->searchBrand1();
        return $data;
    }

    /**
     * ランク3検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchRank3()
    {
        $service = new CommonService();
        $data =  $service->searchRank3();
        return $data;
    }

    /**
     * ルート検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchRoot()
    {
        $service = new CommonService();
        $data =  $service->searchRoot();
        return $data;
    }

    /**
     * 運送会社検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchShippingCompany()
    {
        $service = new CommonService();
        $data =  $service->searchShippingCompany();
        return $data;
    }

    /**
     * 開拓年分類検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchPioneer()
    {
        $service = new CommonService();
        $data =  $service->searchPioneer();
        return $data;
    }

    /**
     * 競技・カテゴリ検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchItemClassThing2()
    {
        $service = new CommonService();
        $data =  $service->searchItemClassThing2();
        return $data;
    }

    /**
     * 業種・特徴2検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchIndustry()
    {
        $service = new CommonService();
        $data =  $service->searchIndustry();
        return $data;
    }

    /**
     * 銀行検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchBank()
    {
        $service = new CommonService();
        $data =  $service->searchBank();
        return $data;
    }

    /**
     * 工場分類5検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchItemClassThing5()
    {
        $service = new CommonService();
        $data =  $service->searchItemClassThing5();
        return $data;
    }

    /**
     * 仕入先コード検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchSupplier()
    {
        $service = new CommonService();
        $data =  $service->searchSupplier();
        return $data;
    }

    /**
     * 仕入先分類1検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchSupplierClass1()
    {
        $service = new CommonService();
        $data =  $service->searchClass1();
        return $data;
    }

    /**
     * 仕入先分類2検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchSupplierClass2()
    {
        $service = new CommonService();
        $data =  $service->searchClass2();
        return $data;
    }

    /**
     * 仕入先分類3検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchSupplierClass3()
    {
        $service = new CommonService();
        $data =  $service->searchClass3();
        return $data;
    }

    /**
     * 支払先コード検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchPayDestination()
    {
        $service = new CommonService();
        $data =  $service->searchPayDestination();
        return $data;
    }

    /**
     * 資産在庫JA検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchItemClassThing7()
    {
        $service = new CommonService();
        $data =  $service->searchItemClassThing7();
        return $data;
    }

    /**
     * 製品/工賃6検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchItemClassThing6()
    {
        $service = new CommonService();
        $data =  $service->searchItemClassThing6();
        return $data;
    }

    /**
     * 商品コード検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchItem()
    {
        $service = new CommonService();
        $data =  $service->searchItem();
        return $data;
    }

    /**
     * 請求先コード検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchBillingAddress()
    {
        $service = new CommonService();
        $data =  $service->searchBillingAddress();
        return $data;
    }

    /**
     * 税率区分検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchTaxRateKbn()
    {
        $service = new CommonService();
        $data =  $service->searchTaxRateKbn();
        return $data;
    }

    /**
     * 倉庫検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchWarehouse()
    {
        $service = new CommonService();
        $data =  $service->searchWarehouse();
        return $data;
    }

    /**
     * 担当者検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchManager()
    {
        $service = new CommonService();
        $data =  $service->searchManager();
        return $data;
    }

    /**
     * 地区分類検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchDistrictClass()
    {
        $service = new CommonService();
        $data =  $service->searchDistrictClass();
        return $data;
    }

    /**
     * 着日検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchArrivalDate()
    {
        $service = new CommonService();
        $data =  $service->searchArrivalDate();
        return $data;
    }

    /**
     * 伝票種別検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchSlipKind()
    {
        $service = new CommonService();
        $data =  $service->searchSlipKind();
        return $data;
    }

    /**
     * 得意先コード検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchCustomer()
    {
        $service = new CommonService();
        $data =  $service->searchCustomer();
        return $data;
    }

    /**
     * 得意先残高検索　TODO:設計確認中
     * @param CommonService $service
     * @return $rows
     */
    /*
    public function searchCustomerBalance()
    {
        $service = new CommonService();
        $data =  $service->searchCustomerBalance();
        return $data;
    }
    */

    /**
     * 納品先検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchDeliveryDestination()
    {
        $service = new CommonService();
        $data =  $service->searchDeliveryDestination();
        return $data;
    }

    /**
     * 販売パターン1検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchCustomerClassThing()
    {
        $service = new CommonService();
        $data =  $service->searchCustomerClassThing();
        return $data;
    }

    /**
     * 販売開始年検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchClass4()
    {
        $service = new CommonService();
        $data =  $service->searchClass4();
        return $data;
    }

    /**
     * 部門検索
     * @param CommonService $service
     * @return $rows
     */
    public function searchDepartment()
    {
        $service = new CommonService();
        $data =  $service->searchDepartment();
        return $data;
    }
}
