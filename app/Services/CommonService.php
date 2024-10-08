<?php

namespace App\Services;

use App\Repositories\Def1Menu\Def1MenuRepository;
use App\Repositories\Def2Menu\Def2MenuRepository;
use App\Repositories\Def3Menu\Def3MenuRepository;
use App\Repositories\MtUser3Security\MtUser3SecurityRepository;
use App\Services\DefPsKbnService as DefPsKbnService;
use App\Services\MtTopFreeAreaService as MtTopFreeAreaService;
use App\Services\MtNoticeService as MtNoticeService;
use App\Services\MtCatalogService as MtCatalogService;
use App\Services\MtColorPatternService as MtColorPatternService;
use App\Services\MtColorService as MtColorService;
use App\Services\MtSizePatternService as MtSizePatternService;
use App\Services\MtSizeService as MtSizeService;
use App\Services\DefPioneerYearService as DefPioneerYearService;
use App\Services\MtPayDestinationService as MtPayDestinationService;
use App\Services\MtSlipKindService as MtSlipKindService;
use App\Services\MtMemberSiteItemService as MtMemberSiteItemService;
use App\Services\S3Service as S3Service;
use Illuminate\Support\Facades\Auth;

/**
 * 汎用機能　サービスクラス
 */
class CommonService
{

    /**
     * @var Def1MenuRepository
     */
    private Def1MenuRepository $def1MenuRepository;

    /**
     * @var Def2MenuRepository
     */
    private Def2MenuRepository $def2MenuRepository;

    /**
     * @var Def3MenuRepository
     */
    private Def3MenuRepository $def3MenuRepository;

    /**
     * @var MtUser3SecurityRepository
     */
    private MtUser3SecurityRepository $mtUser3SecurityRepository;

    /**
     * @param Def1MenuRepository $def1MenuRepository
     */
    public function __construct()
    {
        $this->def1MenuRepository = new Def1MenuRepository();
        $this->def2MenuRepository = new Def2MenuRepository();
        $this->def3MenuRepository = new Def3MenuRepository();
        $this->mtUser3SecurityRepository = new MtUser3SecurityRepository();
    }

    /** メニュー取得
     * @return $rows
     */
    public function getMenu()
    {
        $menu = $this->def1MenuRepository->getAll();
        return $menu;
    }

    /** メニュー取得(1階層)
     * @return $rows
     */
    public function getDef1()
    {
        $menu = $this->def1MenuRepository->getDef1();
        return $menu;
    }

    /** メニュー取得(2階層)
     * @return $rows
     */
    public function getDef2()
    {
        $menu = $this->def2MenuRepository->getDef2();
        return $menu;
    }

    /** メニュー取得(2階層)
     * @return $rows
     */
    public function getDef3()
    {
        $menu = $this->def3MenuRepository->getDef3();
        return $menu;
    }

    /**
     * PS区分検索
     * @param DefPsKbnService $service
     * @return $rows
     */
    public function searchPsKbn()
    {
        $service = new DefPsKbnService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * TOP自由領域コード検索
     * @param MtNoticeService $service
     * @return $rows
     */
    public function searchMtTopFreeArea()
    {
        $service = new MtTopFreeAreaService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * お知らせ検索
     * @param MtNoticeService $service
     * @return $rows
     */
    public function searchMtNotice()
    {
        $service = new MtNoticeService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * カタログ検索
     * @param MtCatalogService $service
     * @return $rows
     */
    public function searchMtCatalog()
    {
        $service = new MtCatalogService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * カラーパターン検索
     * @param MtColorPatternService $service
     * @return $rows
     */
    public function searchMtColorPattern()
    {
        $service = new MtColorPatternService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * カラー検索
     * @param MtColorService $service
     * @return $rows
     */
    public function searchMtColor()
    {
        $service = new MtColorService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * サイズパターン検索
     * @param MtSizePatternService $service
     * @return $rows
     */
    public function searchMtSizePattern()
    {
        $service = new MtSizePatternService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * サイズ検索
     * @param MtSizeService $service
     * @return $rows
     */
    public function searchMtSize()
    {
        $service = new MtSizeService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * ジャンル検索
     * @param MtItemClassService $service
     * @return $rows
     */
    public function searchGenre()
    {
        $service = new MtItemClassService();
        $data =  $service->getAllGenre();
        return $data;
    }

    /**
     * ブランド1検索
     * @param MtItemClassService $service
     * @return $rows
     */
    public function searchBrand1()
    {
        $service = new MtItemClassService();
        $data =  $service->getAllBrand1();
        return $data;
    }

    /**
     * ランク3検索
     * @param MtItemClassService $service
     * @return $rows
     */
    public function searchRank3()
    {
        $service = new MtCustomerClassService();
        $data =  $service->getAllRank3();
        return $data;
    }

    /**
     * ルート検索
     * @param MtRootService $service
     * @return $rows
     */
    public function searchRoot()
    {
        $service = new MtRootService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * 運送会社検索
     * @param MtShippingCompanyService $service
     * @return $rows
     */
    public function searchShippingCompany()
    {
        $service = new MtShippingCompanyService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * 開拓年分類検索
     * @param DefPioneerYearService $service
     * @return $rows
     */
    public function searchPioneer()
    {
        $service = new DefPioneerYearService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * 競技・カテゴリ検索
     * @param DefItemClassThingService $service
     * @return $rows
     */
    public function searchItemClassThing2()
    {
        $service = new MtItemClassService();
        $data =  $service->getAllCategory();
        return $data;
    }

    /**
     * 業種・特徴2検索
     * @param MtCustomerClassService $service
     * @return $rows
     */
    public function searchIndustry()
    {
        $service = new MtCustomerClassService();
        $data =  $service->getAllIndustry();
        return $data;
    }

    /**
     * 銀行検索
     * @param MtbankService $service
     * @return $rows
     */
    public function searchBank()
    {
        $service = new MtBankService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * 工場分類5検索
     * @param DefItemClassThingService $service
     * @return $rows
     */
    public function searchItemClassThing5()
    {
        $service = new MtItemClassService();
        $data =  $service->getAllItemClassThing5();
        return $data;
    }

    /**
     * 仕入先コード検索
     * @param MtSupplierService $service
     * @return $rows
     */
    public function searchSupplier()
    {
        $service = new MtSupplierService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * 仕入先分類1検索
     * @param MtSupplierClassService $service
     * @return $rows
     */
    public function searchClass1()
    {
        $service = new MtSupplierClassService();
        $data =  $service->getAllClass1();
        return $data;
    }

    /**
     * 仕入先分類2検索
     * @param MtSupplierClassService $service
     * @return $rows
     */
    public function searchClass2()
    {
        $service = new MtSupplierClassService();
        $data =  $service->getAllClass2();
        return $data;
    }

    /**
     * 仕入先分類3検索
     * @param MtSupplierClassService $service
     * @return $rows
     */
    public function searchClass3()
    {
        $service = new MtSupplierClassService();
        $data =  $service->getAllClass3();
        return $data;
    }

    /**
     * 支払先コード検索
     * @param MtPayDestinationService $service
     * @return $rows
     */
    public function searchPayDestination()
    {
        $service = new MtSupplierService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * 資産在庫JA検索
     * @param DefItemClassThingService $service
     * @return $rows
     */
    public function searchItemClassThing7()
    {
        $service = new MtItemClassService();
        $data =  $service->getAllItemClassThing7();
        return $data;
    }

    /**
     * 製品/工賃6検索
     * @param DefItemClassThingService $service
     * @return $rows
     */
    public function searchItemClassThing6()
    {
        $service = new MtItemClassService();
        $data =  $service->getAllItemClassThing6();
        return $data;
    }

    /**
     * 商品コード検索
     * @param MtItemService $service
     * @return $rows
     */
    public function searchItem()
    {
        $service = new MtItemService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * 請求先コード検索
     * @param MtBillingAddressService $service
     * @return $rows
     */
    public function searchBillingAddress()
    {
        $service = new MtBillingAddressService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * 税率区分検索
     * @param DefTaxRateKbnService $service
     * @return $rows
     */
    public function searchTaxRateKbn()
    {
        $service = new DefTaxRateKbnService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * 倉庫検索
     * @param MtWarehouseService $service
     * @return $rows
     */
    public function searchWarehouse()
    {
        $service = new MtWarehouseService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * 担当者検索
     * @param MtUserService $service
     * @return $rows
     */
    public function searchManager()
    {
        $service = new MtUserService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * 地区分類検索
     * @param DefDistrictClassService $service
     * @return $rows
     */
    public function searchDistrictClass()
    {
        $service = new DefDistrictClassService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * 着日検索
     * @param DefArrivalDateService $service
     * @return $rows
     */
    public function searchArrivalDate()
    {
        $service = new DefArrivalDateService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * 伝票種別検索
     * @param MtSlipKindService $service
     * @return $rows
     */
    public function searchSlipKind()
    {
        $service = new MtSlipKindService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * 伝票種別検索(送り状)
     * @param MtSlipKindService $service
     * @return $rows
     */
    public function searchSlipKind7()
    {
        $service = new MtSlipKindService();
        $data =  $service->get7All();
        return $data;
    }

    /**
     * 伝票種別検索(荷札)
     * @param MtSlipKindService $service
     * @return $rows
     */
    public function searchSlipKind17()
    {
        $service = new MtSlipKindService();
        $data =  $service->get17All();
        return $data;
    }

    /**
     * 伝票種別検索(売上)
     * @param MtSlipKindService $service
     * @return $rows
     */
    public function searchSlipKind2()
    {
        $service = new MtSlipKindService();
        $data =  $service->get2All();
        return $data;
    }

    /**
     * 得意先コード検索
     * @param MtWarehouseService $service
     * @return $rows
     */
    public function searchCustomer()
    {
        $service = new MtCustomerService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * 得意先残高検索　対応不要
     * @param MtWarehouseService $service
     * @return $rows
     */
    /*
    public function searchCustomerBalance()
    {
        $service = new MtCustomerService();
        $data =  $service->getAllBalance();
        return $data;
    }
    */

    /**
     * 納品先検索
     * @param MtDeliveryDestinationService $service
     * @return $rows
     */
    public function searchDeliveryDestination()
    {
        $service = new MtDeliveryDestinationService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * 販売パターン1検索
     * @param DefCustomerClassThingService $service
     * @return $rows
     */
    public function searchCustomerClassThing()
    {
        $service = new MtCustomerClassService();
        $data =  $service->getAllSalesPattern();
        return $data;
    }

    /**
     * 販売開始年検索
     * @param DefCustomerClassThingService $service
     * @return $rows
     */
    public function searchClass4()
    {
        $service = new MtItemClassService();
        $data =  $service->getAllItemClassThing4();
        return $data;
    }

    /**
     * 部門検索
     * @param DefCustomerClassThingService $service
     * @return $rows
     */
    public function searchDepartment()
    {
        $service = new DefDepartmentService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * ECアイテム検索
     * @param MtMemberSiteItemService $service
     * @return $rows
     */
    public function searchMemberSiteItem()
    {
        $service = new MtMemberSiteItemService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * 受注付箋検索
     * @param MtOrderReceiveStickyNoteService $service
     * @return $rows
     */
    public function searchOrderReceiveStickyNote()
    {
        $service = new MtOrderReceiveStickyNoteService();
        $data =  $service->getAll();
        return $data;
    }

    /**
     * S3アップロード
     * @param $param
     * @param $keyId
     * @param $info
     * @return $rows
     */
    public function s3Upload($param, $keyId, $info)
    {
        $service = new S3Service();
        $data =  $service->upload($param, $keyId, $info);
        return $data;
    }

    /**
     * S3データ削除
     * @param $param
     * @param $keyId
     * @param $info
     * @return $rows
     */
    public function s3Delete($param, $keyId, $info)
    {
        $service = new S3Service();
        $data =  $service->deleteDirectory($param, $keyId, $info);
        return $data;
    }
    /** セキュリティ情報取得
     * @return $userSecurity
     */
    public function getUserSecurity()
    {
        $userSecurity = $this->mtUser3SecurityRepository->getUser3Security();
        return $userSecurity;
    }
}
