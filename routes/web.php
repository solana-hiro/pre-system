<?php

use App\Http\Controllers\Admin\AnaBacklogController;
use App\Http\Controllers\Admin\AnaBacklogWithoutLocationController;
use App\Http\Controllers\Admin\AnaCheckAssignedOutstandingOrderController;
use App\Http\Controllers\Admin\AnaCheckOutstandingOrderAndBacklogController;
use App\Http\Controllers\Admin\AnaCheckReceivedOrderController;
use App\Http\Controllers\Admin\AnaCheckReturnController;
use App\Http\Controllers\Admin\AnaCheckShippingController;
use App\Http\Controllers\Admin\AnaCheckShippingDocumentNumberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\MtBankController;
use App\Http\Controllers\Admin\MtBillingAddressController;
use App\Http\Controllers\Admin\MtColorController;
use App\Http\Controllers\Admin\MtColorPatternController;
use App\Http\Controllers\Admin\MtCustomerClassController;
use App\Http\Controllers\Admin\MtCustomerController;
use App\Http\Controllers\Admin\MtCustomerManagerController;
use App\Http\Controllers\Admin\MtCustomerDeliveryDestinationController;
use App\Http\Controllers\Admin\MtCustomerOtherItemClassRateController;
use App\Http\Controllers\Admin\MtCustomerOtherItemRateController;
use App\Http\Controllers\Admin\MtDeliveryDestinationController;
use App\Http\Controllers\Admin\MtEcLoginCertificationInformationController;
use App\Http\Controllers\Admin\MtFareController;
use App\Http\Controllers\Admin\MtHolidayController;
use App\Http\Controllers\Admin\MtInOutController;
use App\Http\Controllers\Admin\MtItemChangeHistoryController;
use App\Http\Controllers\Admin\MtItemClassController;
use App\Http\Controllers\Admin\MtItemController;
use App\Http\Controllers\Admin\MtLocationController;
use App\Http\Controllers\Admin\MtManagerController;
use App\Http\Controllers\Admin\MtOrderReceiveListNarrowDownController;
use App\Http\Controllers\Admin\MtOrderReceiveStickyNoteController;
use App\Http\Controllers\Admin\MtPayDestinationController;
use App\Http\Controllers\Admin\MtPostNumberController;
use App\Http\Controllers\Admin\MtRootController;
use App\Http\Controllers\Admin\MtShippingCompanyController;
use App\Http\Controllers\Admin\MtSizeController;
use App\Http\Controllers\Admin\MtSizePatternController;
use App\Http\Controllers\Admin\MtSlipKindController;
use App\Http\Controllers\Admin\MtStockKeepingUnitController;
use App\Http\Controllers\Admin\MtSupplierClassController;
use App\Http\Controllers\Admin\MtSupplierController;
use App\Http\Controllers\Admin\MtSupplierItemPriceController;
use App\Http\Controllers\Admin\MtSystemController;
use App\Http\Controllers\Admin\MtTaxRateSettingController;
use App\Http\Controllers\Admin\MtThingNameController;
use App\Http\Controllers\Admin\MtUser1SecurityController;
use App\Http\Controllers\Admin\MtUser2SecurityController;
use App\Http\Controllers\Admin\MtUser3SecurityController;
use App\Http\Controllers\Admin\MtUserController;
use App\Http\Controllers\Admin\MtWarehouseController;
use App\Http\Controllers\Admin\MtNoticeController;
use App\Http\Controllers\Admin\MtCatalogController;
use App\Http\Controllers\Admin\MtCatalogItemController;
use App\Http\Controllers\Admin\MtTopFreeAreaController;
use App\Http\Controllers\Admin\MtTopFreeAreaPublicationDestinationController;
use App\Http\Controllers\Admin\MtCartController;
use App\Http\Controllers\Admin\MtMemberSiteItemController;
use App\Http\Controllers\Admin\DefDepartmentController;
use App\Http\Controllers\Admin\Def1MenuController;
use App\Http\Controllers\Admin\Def2MenuController;
use App\Http\Controllers\Admin\Def3MenuController;
use App\Http\Controllers\Admin\DefCustomerClassThingController;
use App\Http\Controllers\Admin\DefArrivalDateController;
use App\Http\Controllers\Admin\DefDistrictClassController;
use App\Http\Controllers\Admin\DefPsKbnController;
use App\Http\Controllers\Admin\DefPioneerYearController;
use App\Http\Controllers\Admin\DefSupplierClassThingController;
use App\Http\Controllers\Admin\DefItemClassThingController;
use App\Http\Controllers\Admin\DefSlipKindKbnController;
use App\Http\Controllers\Admin\DefTaxRateKbnController;
use App\Http\Controllers\Admin\DefStickyNoteKindController;
use App\Http\Controllers\Admin\DefOrderReceiveKbnController;
use App\Http\Controllers\Admin\TrnOrderReceiveHeaderController;
use App\Http\Controllers\Admin\TrnOrderReceiveDetailController;
use App\Http\Controllers\Admin\TrnOrderReceiveBreakdownController;
use App\Http\Controllers\Admin\TrnShippingInspectionHeaderController;
use App\Http\Controllers\Admin\TrnShippingInspectionDetailController;
use App\Http\Controllers\Admin\TrnShippingController;
use App\Http\Controllers\Admin\TrnSaleHeaderController;
use App\Http\Controllers\Admin\TrnSaleDetailController;
use App\Http\Controllers\Admin\TrnDemandHeaderController;
use App\Http\Controllers\Admin\TrnDemandDetailController;
use App\Http\Controllers\Admin\TrnPaymentHeaderController;
use App\Http\Controllers\Admin\TrnPaymentDetailController;
use App\Http\Controllers\Admin\TrnOrderHeaderController;
use App\Http\Controllers\Admin\TrnOrderDetailController;
use App\Http\Controllers\Admin\TrnOrderBreakdownController;
use App\Http\Controllers\Admin\TrnShipmentDetailController;
use App\Http\Controllers\Admin\TrnShipmentBreakdownController;
use App\Http\Controllers\Admin\TrnPurchaseHeaderController;
use App\Http\Controllers\Admin\TrnPurchaseDetailController;
use App\Http\Controllers\Admin\TrnPayHeaderController;
use App\Http\Controllers\Admin\TrnPayDetailController;
use App\Http\Controllers\Admin\TrnPaySequentiallyPayDestinationIntelligence;
use App\Http\Controllers\Admin\TrnInOutHeaderController;
use App\Http\Controllers\Admin\TrnInOutDetailController;
use App\Http\Controllers\Admin\WkInventoryBaseController;
use App\Http\Controllers\Admin\WkInventoryAchievementController;
use App\Http\Controllers\Admin\BookEdgeClassController;
use App\Http\Controllers\Admin\FavoriteController;
use App\Http\Controllers\Admin\AnaGrossProfitChartController;
use App\Http\Controllers\Admin\AnaCustomerDataController;
use App\Http\Controllers\Admin\AnaCustomerDeliveryDestinationDataController;
use App\Http\Controllers\Admin\AnaDailyPaymentController;
use App\Http\Controllers\Admin\AnaMonthlyPaymentController;
use App\Http\Controllers\Admin\AnaOutstandingOrderController;
use App\Http\Controllers\Admin\AnaOutstandingOrderMasterController;
use App\Http\Controllers\Admin\AnaPaymentByCustomerController;
use App\Http\Controllers\Admin\AnaReturnAfterPaymentController;
use App\Http\Controllers\Admin\AnaSearchLargeReceivedOrderController;
use App\Http\Controllers\Admin\AnaSearchRecivedOrderController;
use App\Http\Controllers\Admin\AnaSearchRecivedOrderForCheckController;
use App\Http\Controllers\Admin\AnaSearchSaleController;
use App\Http\Controllers\Admin\SearchModalController;

// TEST CODE
use App\Http\Controllers\Admin\SampleController;
use App\Http\Controllers\Admin\SidemenuController;
use App\Models\DefArrivalDate;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('auth.index');
Route::post('/', [AuthController::class, 'login'])->name('auth.login');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::group(['middleware' => ['auth:user', 'sidemenu']], function () {
    // TOP
    Route::prefix('top')->name('top.')->group(function () {
        Route::get('/', [IndexController::class, 'index'])->name('index');
    });
    Route::prefix('side')->name('side.')->group(function () {
        Route::get('/sidemenu', [SidemenuController::class, 'redirect'])->name('redirect');
    });

    // 販売管理
    Route::prefix('sales_management')->name('sales_management.')->group(function () {
        //受注
        Route::prefix('order_receive')->name('order_receive.')->group(function () {
            //受注計上入力
            Route::get('/accountant', [TrnOrderReceiveHeaderController::class, 'showAccountant'])->name('accountant.index');		//初期表示
            Route::post('/accountant', [TrnOrderReceiveHeaderController::class, 'updateAccountant'])->name('accountant.update');	//更新

            // 入金案内Excelダウンロード
            Route::get('/payment_guidance_excel', [TrnOrderReceiveDetailController::class, 'paymentGuidanceExcel'])->name('payment_guidance_excel');
            // 欠品案内Excelダウンロード
            Route::get('/shortage_guidance_excel', [TrnOrderReceiveDetailController::class, 'shortageGuidanceExcel'])->name('shortage_guidance_excel');
            // 出荷案内Excelダウンロード
            Route::get('/shipping_guidance_excel', [TrnOrderReceiveDetailController::class, 'shippingGuidanceExcel'])->name('shipping_guidance_excel');
            // KEEP案内Excelダウンロード
            Route::get('/keep_guidance_excel', [TrnOrderReceiveDetailController::class, 'keepGuidanceExcel'])->name('keep_guidance_excel');

            //受注リスト
            Route::get('/accountant/list', [TrnOrderReceiveHeaderController::class, 'showAccountantList'])->name('accountant.list');		//初期表示
            Route::post('/accountant/list', [TrnOrderReceiveHeaderController::class, 'updateAccountantList'])->name('accountant.list.update');
            Route::post('/accountant/list/export', [TrnOrderReceiveHeaderController::class, 'exportAccountantList'])->name('accountant.list.export');	//出力

            //受注問合せ
            Route::get('/accountant/inquiry', [TrnOrderReceiveHeaderController::class, 'accountantInquiry'])->name('accountant.inquiry');  //初期表示・検索結果表示
            Route::post('/accountant/inquiry', [TrnOrderReceiveHeaderController::class, 'executeAccountantInquiry'])->name('accountant.inquiry.execute');  //実行

            //入出荷予定問合せ
            Route::get('/in_shipping/inquiry', [TrnOrderReceiveHeaderController::class, 'shippingInquiry'])->name('in_shipping.inquiry');	//初期表示
            Route::post('/in_shipping/inquiry', [TrnOrderReceiveHeaderController::class, 'executeShippingInquiry'])->name('in_shipping.inquiry.execute');	//実行・Excel出力
        });
        //出荷
        Route::prefix('shipping')->name('shipping.')->group(function () {
            //ピッキングリスト発行
            Route::get('/picking_list/issue', [TrnShippingInspectionHeaderController::class, 'showPickingList'])->name('picking_list.issue.index');  //初期表示
            Route::post('/picking_list/issue', [TrnShippingInspectionHeaderController::class, 'exportPickingList'])->name('picking_list.issue.export');  //プレビュー表示・キャンセル

            //出荷検品処理
            Route::get('/inspection', [TrnShippingInspectionHeaderController::class, 'showInspection'])->name('inspection.index');	//初期表示
            Route::post('/inspection', [TrnShippingInspectionHeaderController::class, 'updateInspection'])->name('inspection.execute');	//手検品・登録・キャンセル

            //売上確定処理
            Route::get('/sale/decision', [TrnSaleHeaderController::class, 'showSaleDecision'])->name('sale.decision.index');  //初期表示
            Route::post('/sale/decision', [TrnSaleHeaderController::class, 'updateSaleDecision'])->name('sale.decision.update');  //更新・一括反映

            //出荷案内発行
            Route::get('/guidance/issue', [TrnShippingInspectionHeaderController::class, 'showGuidanceIssue'])->name('guidance.issue.index');  //初期表示
            Route::post('/guidance/issue', [TrnShippingInspectionHeaderController::class, 'exportGuidanceIssue'])->name('guidance.issue.export');  //Excel出力・キャンセル

            //トータルピッキングリスト発行
            Route::get('/total_picking_list/issue', [TrnShippingInspectionHeaderController::class, 'showTotalPickingList'])->name('total_picking_list.issue.index');  //初期表示
            Route::post('/total_picking_list/issue', [TrnShippingInspectionHeaderController::class, 'exportTotalPickingList'])->name('total_picking_list.issue.export');  //プレビュー表示・キャンセル
        });
        //売上
        Route::prefix('sales')->name('sales.')->group(function () {
            //売上計上入力
            Route::get('/accountant', [TrnSaleHeaderController::class, 'showAccountant'])->name('accountant.index');  //初期表示
            Route::post('/accountant', [TrnSaleHeaderController::class, 'updateAccountant'])->name('accountant.update');  //更新

            //売上伝票一括発行
            Route::get('/slip/issue', [TrnSaleHeaderController::class, 'showSlipList'])->name('slip.issue.index');  //初期表示
            Route::post('/slip/issue', [TrnSaleHeaderController::class, 'exportSlipList'])->name('slip.issue.export');  //プレビュー表示・キャンセル

            //送り状入力  delete
            //Route::get('/shipping_document/issue', [TrnSaleHeaderController::class, 'showShippingDocumentIssue'])->name('shipping_document.issue.index');	//初期表示
            //Route::post('/shipping_document/issue', [TrnSaleHeaderController::class, 'updateShippingDocumentIssue'])->name('shipping_document.issue.update');	//更新

            //売上チェックリスト
            Route::get('/checklist', [TrnSaleHeaderController::class, 'showChecklist'])->name('checklist.index');	//初期表示
            Route::post('/checklist', [TrnSaleHeaderController::class, 'exportChecklist'])->name('checklist.export');	//EXCEL出力・キャンセル
        });
        //請求
        Route::prefix('demand')->name('demand.')->group(function () {
            //請求締日変更処理
            Route::get('/closing_date/change', [TrnDemandHeaderController::class, 'showClosingDateChange'])->name('closing_date.change.index');  //初期表示
            Route::get('/closing_date/change/{id}', [TrnDemandHeaderController::class, 'showClosingDateChangeById'])->name('closing_date.change.index_by_id');  //初期表示
            Route::post('/closing_date/change', [TrnDemandHeaderController::class, 'updateClosingDateChange'])->name('closing_date.change.update');  //更新

            //請求随時締解除処理
            Route::get('/sequentially/closing/remove', [TrnDemandHeaderController::class, 'showSequentiallyClosingRemove'])->name('sequentially.closing.remove.index');  //初期表示
            Route::get('/sequentially/closing/remove/{id}', [TrnDemandHeaderController::class, 'showSequentiallyClosingRemoveById'])->name('sequentially.closing.remove.index_by_id');  //初期表示
            Route::post('/sequentially/closing/remove', [TrnDemandHeaderController::class, 'updateSequentiallyClosingRemove'])->name('sequentially.closing.remove.update');  //更新

            //請求随時締処理
            Route::get('/sequentially/closing', [TrnDemandHeaderController::class, 'showSequentiallyClosing'])->name('sequentially.closing.index');  //初期表示
            Route::get('/sequentially/closing/{id}', [TrnDemandHeaderController::class, 'showSequentiallyClosingById'])->name('sequentially.closing.index_by_id');  //初期表示
            Route::post('/sequentially/closing', [TrnDemandHeaderController::class, 'updateSequentiallyClosing'])->name('sequentially.closing.update');  //更新

            //請求時消費税一括計算
            Route::get('/tax/calculate', [TrnDemandHeaderController::class, 'showTaxCalculate'])->name('tax.calculate.index');  //初期表示
            Route::post('/tax/calculate', [TrnDemandHeaderController::class, 'updateTaxCalculate'])->name('tax.calculate.update');  //更新・削除

            //請求データ確定処理
            Route::get('/data/decision', [TrnDemandHeaderController::class, 'showDataDecision'])->name('data.decision.index');  //初期表示
            Route::post('/data/decision', [TrnDemandHeaderController::class, 'updateDataDecision'])->name('data.decision.update');  //更新

            //請求残高問合せ
            Route::get('/balance/inquiry', [TrnDemandHeaderController::class, 'showBalanceInquiry'])->name('balance.inquiry.index');  //初期表示
            Route::post('/balance/inquiry', [TrnDemandHeaderController::class, 'exportBalanceInquiry'])->name('balance.inquiry.update');  //キャンセル・前頁・後頁・実行

            //請求履歴問合せ
            Route::get('/history/inquiry', [TrnDemandHeaderController::class, 'showHistoryInquiry'])->name('history.inquiry.index');  //初期表示
            Route::post('/history/inquiry', [TrnDemandHeaderController::class, 'exportHistoryInquiry'])->name('history.inquiry.update');  //キャンセル・前頁・後頁・実行

            //請求一覧表
            Route::get('/invoice/list', [TrnDemandHeaderController::class, 'showInvoiceList'])->name('invoice.list.index');  //初期表示
            Route::post('/invoice/list', [TrnDemandHeaderController::class, 'exportInvoiceList'])->name('invoice.list.export');  //プレビュー表示

            //請求書発行
            Route::get('/invoice/issue', [TrnDemandHeaderController::class, 'showInvoiceIssue'])->name('invoice.issue.index');  //初期表示
            Route::post('/invoice/issue', [TrnDemandHeaderController::class, 'exportInvoiceIssue'])->name('invoice.issue.update');  //プレビュー表示
        });
        //売掛
        Route::prefix('accounts_receivable')->name('accounts_receivable.')->group(function () {
            //入金計上入力
            Route::get('/payment', [TrnPaymentHeaderController::class, 'showPayment'])->name('payment.index');  //初期表示
            Route::post('/payment', [TrnPaymentHeaderController::class, 'updatePayment'])->name('payment.update');  //更新

            //入金チェックリスト
            Route::get('/checklist', [TrnPaymentHeaderController::class, 'showChecklist'])->name('checklist.index');  //初期表示
            Route::post('/checklist', [TrnPaymentHeaderController::class, 'exportChecklist'])->name('checklist.export');  //キャンセル・Excel出力

            //未回収残一覧表
            Route::get('/collect_balance/list', [TrnPaymentHeaderController::class, 'showCollectBalanceList'])->name('collect_balance.list.index');  //初期表示
            Route::post('/collect_balance/list', [TrnPaymentHeaderController::class, 'exportCollectBalanceList'])->name('collect_balance.list.export');  //キャンセル・Excel出力

            //受取手形一覧表
            Route::get('/bill_receipt/list', [TrnPaymentHeaderController::class, 'showBillReceipt'])->name('bill_receipt.list.index');  //初期表示
            Route::post('/bill_receipt/list', [TrnPaymentHeaderController::class, 'exportBillReceipt'])->name('bill_receipt.list.export');  //キャンセル・Excel出力

            //売掛残高一覧表
            Route::get('/list', [TrnPaymentHeaderController::class, 'showList'])->name('list.index');  //初期表示
            Route::post('/list', [TrnPaymentHeaderController::class, 'exportList'])->name('list.export');  //キャンセル・Excel出力

            //得意先元帳
            Route::get('/customer_ledger', [TrnPaymentHeaderController::class, 'showCustomerLedger'])->name('customer_ledger.index');    //初期表示
            Route::post('/customer_ledger', [TrnPaymentHeaderController::class, 'exportCustomerLedger'])->name('customer_ledger.export');  //キャンセル・PDF出力・Excel出力

            //得意先概況問合
            Route::get('/customer_overview/inquiry', [TrnPaymentHeaderController::class, 'showCustomerOverview'])->name('customer_overview.inquiry.index');  //初期表示
            Route::post('/customer_overview/inquiry', [TrnPaymentHeaderController::class, 'updateCustomerOverview'])->name('customer_overview.inquiry.update');  //更新
        });
    });
    // 購買管理
    Route::prefix('purchase_management')->name('purchase_management.')->group(function () {
        //発注
        Route::prefix('order')->name('order.')->group(function () {
            //発注計上入力
            Route::get('/accountant', [TrnOrderHeaderController::class, 'showAccountant'])->name('accountant.index');  //初期表示			
			Route::get('/get_search_order_number_all', [SearchModalController::class, 'getSearchOrderAll'])->name('accountant.getSearchOrderAll');  
			Route::get('/get_search_order_number_with_keyword', [SearchModalController::class, 'getSearchOrderWithKeyword'])->name('accountant.getSearchOrderWithKeyword');
			Route::get('/get_search_user_input_id_all', [SearchModalController::class, 'getSearchUserInputIdAll'])->name('accountant.getSearchUserInputIdAll');
			Route::get('/get_search_user_input_id_with_keyword', [SearchModalController::class, 'getSearchUserInputIdWithKeyword'])->name('accountant.getSearchUserInputIdWithKeyword');
			Route::get('/get_search_supplier_all', [SearchModalController::class, 'getSearchSupplierAll'])->name('accountant.getSearchSupplierAll');
			Route::get('/get_search_supplier_with_keyword', [SearchModalController::class, 'getSearchSupplierWithKeyword'])->name('accountant.getSearchSupplierWithKeyword');
			Route::get('/get_search_supplier_class_one_all', [SearchModalController::class, 'getSearchSupplierClassOneAll'])->name('accountant.getSearchSupplierClassOneAll');
			Route::get('/get_search_supplier_class_one_with_keyword', [SearchModalController::class, 'getSearchSupplierClassOneWithKeyword'])->name('accountant.getSearchSupplierClassOneWithKeyword');
			Route::get('/get_search_department_all', [SearchModalController::class, 'getSearchDepartmentAll'])->name('accountant.getSearchDepartmentAll');
			Route::get('/get_search_department_with_keyword', [SearchModalController::class, 'getSearchDepartmentWithKeyword'])->name('accountant.getSearchDepartmentWithKeyword');
            Route::post('/accountant', [TrnOrderHeaderController::class, 'updateAccountant'])->name('accountant.update');  //更新

            //発注問合せ
            Route::get('/inquiry', [TrnOrderHeaderController::class, 'showInquiry'])->name('inquiry.index');  //初期表示
            Route::post('/inquiry', [TrnOrderHeaderController::class, 'updateInquiry'])->name('inquiry.update');  //更新

            //発注伝票一括発行
            Route::get('/slip/issue', [TrnOrderHeaderController::class, 'showSlipIssue'])->name('slip.issue.index');  //初期表示
            Route::post('/slip/issue', [TrnOrderHeaderController::class, 'exportSlipIssue'])->name('slip.issue.export');  //プレビュー表示

            //発注チェックリスト
            Route::get('/checklist', [TrnOrderHeaderController::class, 'showChecklist'])->name('checklist.index');  //初期表示
            Route::post('/checklist', [TrnOrderHeaderController::class, 'exportChecklist'])->name('checklist.export');  //Excel出力

            //発注残一覧表(仕入先別納期別)
            Route::get('/order_balance/list/supplier', [TrnOrderHeaderController::class, 'showOrderBalanceListSupplier'])->name('order_balance.list.supplier.index');  //初期表示
            Route::post('/order_balance/list/supplier', [TrnOrderHeaderController::class, 'exportOrderBalanceListSupplier'])->name('order_balance.list.supplier.export');  //Excel出力

            //発注残一覧表(商品別納期別)
            Route::get('/order_balance/list/item', [TrnOrderHeaderController::class, 'showOrderBalanceListItem'])->name('order_balance.list.item.index');  //初期表示
            Route::post('/order_balance/list/item', [TrnOrderHeaderController::class, 'exportOrderBalanceListItem'])->name('order_balance.list.item.export');  //Excel出力

            //発注割当数変更
            Route::get('/quota/change', [TrnOrderHeaderController::class, 'showQuotaChange'])->name('quota.change.index');  //初期表示
            Route::post('/quota/change', [TrnOrderHeaderController::class, 'updateQuotaChange'])->name('quota.change.update');  //更新
        });
        //仕入
        Route::prefix('purchase')->name('purchase.')->group(function () {
            //仕入計上入力
            Route::get('/accountant', [TrnPurchaseHeaderController::class, 'showAccountant'])->name('accountant.index');  //初期表示
            Route::post('/accountant', [TrnPurchaseHeaderController::class, 'updateAccountant'])->name('accountant.update');  //更新

            //仕入チェックリスト
            Route::get('/checklist', [TrnPurchaseHeaderController::class, 'showChecklist'])->name('checklist.index');  //初期表示
            Route::post('/checklist', [TrnPurchaseHeaderController::class, 'exportChecklist'])->name('checklist.export');  //Excel出力

            //商品仕入日計表
            Route::get('/item_daily/list', [TrnPurchaseHeaderController::class, 'showItemDailyList'])->name('item_daily.list.index');  //初期表示
            Route::post('/item_daily/list', [TrnPurchaseHeaderController::class, 'exportItemDailyList'])->name('item_daily.list.export');  //Excel出力
        });
        //支払
        Route::prefix('pay')->name('pay.')->group(function () {
            //支払締日変更処理
            Route::get('/closing_date/change', [TrnPayHeaderController::class, 'showClosingDateChange'])->name('closing_date.change.index');  //初期表示
            Route::post('/closing_date/change', [TrnPayHeaderController::class, 'updateClosingDateChange'])->name('closing_date.change.update');  //更新

            //支払随時締処理
            Route::get('/sequentially/closing', [TrnPayHeaderController::class, 'showSequentiallyClosing'])->name('sequentially.closing.index');  //初期表示
            Route::post('/sequentially/closing', [TrnPayHeaderController::class, 'updateSequentiallyClosing'])->name('sequentially.closing.update');  //更新

            //支払随時締解除処理
            Route::get('/sequentially/closing/remove', [TrnPayHeaderController::class, 'showSequentiallyClosingRemove'])->name('sequentially.closing.remove.index');  //初期表示
            Route::post('/sequentially/closing/remove', [TrnPayHeaderController::class, 'updateSequentiallyClosingRemove'])->name('sequentially.closing.remove.update');  //更新

            //支払時消費税一括計算
            Route::get('/tax/calculate', [TrnPayHeaderController::class, 'showTaxCalculate'])->name('tax.calculate.index');  //初期表示
            Route::post('/tax/calculate', [TrnPayHeaderController::class, 'updateTaxCalculate'])->name('tax.calculate.update');  //更新

            //支払データ確定処理
            Route::get('/data/decision', [TrnPayHeaderController::class, 'showDataDecision'])->name('data.decision.index');  //初期表示
            Route::post('/data/decision', [TrnPayHeaderController::class, 'updateDataDecision'])->name('data.decision.update');  //更新

            //支払一覧表
            Route::get('/payment/list', [TrnPayHeaderController::class, 'showPaymentList'])->name('payment.list.index');  //初期表示
            Route::post('/payment/list', [TrnPayHeaderController::class, 'exportPaymentList'])->name('payment.list.export');  //PDF・Excel出力

            //支払明細書
            Route::get('/payment/issue', [TrnPayHeaderController::class, 'showPaymentIssue'])->name('payment.issue.index');  //初期表示
            Route::post('/payment/issue', [TrnPayHeaderController::class, 'exportPaymentIssue'])->name('payment.issue.export');  //Excel出力
        });
        //買掛
        Route::prefix('accounts_payable')->name('accounts_payable.')->group(function () {
            //支払計上入力
            Route::get('/accountant', [TrnPayHeaderController::class, 'showAccountant'])->name('accountant.index');  //初期表示
            Route::post('/accountant', [TrnPayHeaderController::class, 'updateAccountant'])->name('accountant.update');  //更新
            
            Route::get('/get_search_supplier_all', [SearchModalController::class, 'getSearchSupplierAll'])->name('accountant.getSearchSupplierAll');
            //買掛残高一覧表
            Route::get('/list', [TrnPayHeaderController::class, 'showList'])->name('list.index');  //初期表示
            Route::post('/list', [TrnPayHeaderController::class, 'exportList'])->name('list.export');  //Excel出力

            //仕入先元帳
            Route::get('/supplier_ledger', [TrnPayHeaderController::class, 'showSupplierLedger'])->name('supplier_ledger.index');  //初期表示
            Route::post('/supplier_ledger', [TrnPayHeaderController::class, 'exportSupplierLedger'])->name('supplier_ledger.export');  //Excel出力
        });
    });
    // 在庫管理
    Route::prefix('stock_management')->name('stock_management.')->group(function () {
        //在庫
        Route::prefix('stock')->name('stock.')->group(function () {
            //入出庫入力
            Route::get('/in_out/input', [TrnInOutHeaderController::class, 'showInoutInput'])->name('in_out.input.index');  //初期表示
            Route::get('/in_out/input/{id}', [TrnInOutHeaderController::class, 'showInoutById'])->name('in_out.input.showById');  //初期表示
            Route::post('/in_out/input', [TrnInOutHeaderController::class, 'updateInoutInput'])->name('in_out.input.update');  //更新

            //入出庫明細内訳
            Route::get('/in_out/breakdown', [TrnInOutDetailController::class, 'getDetailBreakdowns'])->name('in_out.input.breakdown'); //コードから名称補完

            //入出庫チェックリスト
            Route::get('/in_out/checklist', [TrnInOutHeaderController::class, 'showInoutChecklist'])->name('in_out.checklist.index');  //初期表示
            Route::post('/in_out/checklist', [TrnInOutHeaderController::class, 'exportInoutChecklist'])->name('in_out.checklist.export');  //プレビュー表示・PDF・Excel出力

            //在庫一覧表
            Route::get('/list', [TrnInOutHeaderController::class, 'showList'])->name('list.index');  //初期表示
            Route::post('/list', [TrnInOutHeaderController::class, 'exportList'])->name('list.export');  //Excel出力・キャンセル

            //商品別倉庫別在庫一覧表
            Route::get('/warehouse/list', [TrnInOutHeaderController::class, 'showWarehouseList'])->name('warehouse.list.index');  //初期表示
            Route::post('/warehouse/list', [TrnInOutHeaderController::class, 'exportWarehouseList'])->name('warehouse.list.export');  //プレビュー表示・Excel出力

            //在庫データ書出し
            Route::get('/data/output', [TrnInOutHeaderController::class, 'showDataOutput'])->name('data.output.index');  //初期表示
            Route::post('/data/output', [TrnInOutHeaderController::class, 'exportDataOutput'])->name('data.output.export');  //Excel出力

            //在庫移動EXCEL取込
            Route::get('/stock_moving/import', [TrnInOutHeaderController::class, 'showStockMovingImport'])->name('stock_moving.import.index');  //初期表示
            Route::post('/stock_moving/import', [TrnInOutHeaderController::class, 'updateStockMovingImport'])->name('stock_moving.import.update');  //更新
        });
        //棚卸
        Route::prefix('inventory')->name('inventory.')->group(function () {
            //棚卸原票
            Route::get('/slip', [WkInventoryBaseController::class, 'showSlip'])->name('slip.index');  //初期表示
            Route::post('/slip', [WkInventoryBaseController::class, 'exportSlip'])->name('slip.export');  //プレビュー表示・Excel出力

            //棚卸開始処理
            Route::get('/start', [WkInventoryBaseController::class, 'indexStart'])->name('start.index');  //初期表示
            Route::post('/start', [WkInventoryBaseController::class, 'updateStart'])->name('start.update');  //更新

            //棚卸計上入力
            Route::get('/accountant', [WkInventoryBaseController::class, 'showAccountant'])->name('accountant.index');  //初期表示
            Route::post('/accountant', [WkInventoryBaseController::class, 'updateAccountant'])->name('accountant.update');  //更新

            //棚卸チェックリスト
            Route::get('/checklist', [WkInventoryBaseController::class, 'showChecklist'])->name('checklist.index');  //初期表示
            Route::post('/checklist', [WkInventoryBaseController::class, 'exportChecklist'])->name('checklist.export');  //プレビュー表示・Excel出力

            //棚卸更新処理
            Route::get('/update', [WkInventoryBaseController::class, 'showUpdate'])->name('update.index');  //初期表示
            Route::post('/update', [WkInventoryBaseController::class, 'execUpdate'])->name('update.execute');  //更新

            //棚卸終了処理
            Route::get('/end', [WkInventoryBaseController::class, 'indexEnd'])->name('end.index');  //初期表示
            Route::post('/end', [WkInventoryBaseController::class, 'updateEnd'])->name('end.update');  //更新

            //棚卸差異表
            Route::get('/difference/list', [WkInventoryBaseController::class, 'showDifferenceList'])->name('difference.list.index');  //初期表示
            Route::post('/difference/list', [WkInventoryBaseController::class, 'exportDifferenceList'])->name('difference.list.export');  //プレビュー表示・Excel出力

            //棚卸EXCEL取込
            Route::get('/import', [WkInventoryBaseController::class, 'showImport'])->name('import.index');  //初期表示
            Route::post('/import', [WkInventoryBaseController::class, 'updateImport'])->name('import.update');  //更新
        });
        //分析
        Route::prefix('analysis')->name('analysis.')->group(function () {
            //資産在庫表
            Route::get('/asset_stock/list', [WkInventoryBaseController::class, 'showAssetStockList'])->name('asset_stock.list.index');  //初期表示
            Route::post('/asset_stock/list', [WkInventoryBaseController::class, 'exportAssetStockList'])->name('asset_stock.list.export');  //PDF出力・Excel出力
        });
    });
    // マスタ管理
    Route::prefix('master')->name('master.')->group(function () {
        //得意先
        Route::prefix('customer')->name('customer.')->group(function () {
            //得意先リスト(一覧)
            Route::get('/mt_customer/list', [MtCustomerController::class, 'list'])->name('mt_customer.list');	//初期表示
            Route::post('/mt_customer/list', [MtCustomerController::class, 'export'])->name('mt_customer.export');	//出力

            //得意先入力(詳細)
            Route::get('/mt_customer/detail', [MtCustomerController::class, 'detail'])->name('mt_customer.detail');  //初期表示
            Route::get('/mt_customer/detail/{id}', [MtCustomerController::class, 'detailById'])->name('mt_customer.detail_by_id');  //初期表示
            Route::post('/mt_customer/detail', [MtCustomerController::class, 'update'])->name('mt_customer.detail.update');  //更新

            //得意先入力(残高) 実装不要
            //Route::get('/mt_customer/balance', [MtCustomerController::class, 'indexBalance'])->name('mt_customer.balance.index');  //初期表示
            //Route::post('/mt_customer/balance', [MtCustomerController::class, 'updateBalance'])->name('mt_customer.balance.update');  //更新

            //得意先マスタExcel取込
            Route::get('/mt_customer/file', [MtCustomerController::class, 'fileIndex'])->name('mt_customer.file.index');  //初期表示
            Route::post('/mt_customer/file/import', [MtCustomerController::class, 'fileImport'])->name('mt_customer.file.import');  //更新

            //得意先分類入力(一覧)
            Route::get('/mt_customer_class', [MtCustomerClassController::class, 'index'])->name('mt_customer_class.index');  //初期表示
            Route::post('/mt_customer_class', [MtCustomerClassController::class, 'update'])->name('mt_customer_class.update');  //更新

            //得意先分類リスト(一覧)
            Route::get('/mt_customer_class/list', [MtCustomerClassController::class, 'list'])->name('mt_customer_class.list');  //初期表示
            Route::post('/mt_customer_class/list/export', [MtCustomerClassController::class, 'export'])->name('mt_customer_class.list.export');  //出力
        });
        //納品先
        Route::prefix('delivery')->name('delivery.')->group(function () {
            //納品先入力(一覧)
            Route::get('/mt_delivery_destinations', [MtDeliveryDestinationController::class, 'index'])->name('mt_delivery_destinations.index');  //初期表示
            Route::post('/mt_delivery_destinations', [MtDeliveryDestinationController::class, 'update'])->name('mt_delivery_destinations.update');  //更新

            //納品先入力(詳細)
            Route::get('/mt_delivery_destinations/detail', [MtDeliveryDestinationController::class, 'detailIndex'])->name('mt_delivery_destinations.detail.index');  //初期表示
            Route::get('/mt_delivery_destinations/detail/{id}', [MtDeliveryDestinationController::class, 'detailById'])->name('mt_delivery_destinations.detail_by_id');  //初期表示(ID指定)
            Route::post('/mt_delivery_destinations/detail', [MtDeliveryDestinationController::class, 'detailUpdate'])->name('mt_delivery_destinations.detail.update');  //更新

            //納品先リスト(一覧)
            Route::get('/mt_delivery_destinations/list', [MtDeliveryDestinationController::class, 'list'])->name('mt_delivery_destinations.list');	//初期表示
            Route::post('/mt_delivery_destinations/export', [MtDeliveryDestinationController::class, 'export'])->name('mt_delivery_destinations.export');	//出力

            //納品先マスタExcel取込
            Route::get('/mt_delivery_destinations/file', [MtDeliveryDestinationController::class, 'fileIndex'])->name('mt_delivery_destinations.file.index');  //初期表示
            Route::post('/mt_delivery_destinations/file/import', [MtDeliveryDestinationController::class, 'fileImport'])->name('mt_delivery_destinations.file.import');  //更新
        });
        //仕入先
        Route::prefix('supplier')->name('supplier.')->group(function () {
            //仕入先入力(詳細)
            Route::get('/mt_supplier/detail', [MtSupplierController::class, 'index'])->name('mt_supplier.detail');  //初期表示
            Route::get('/mt_supplier/detail/{id}', [MtSupplierController::class, 'detailById'])->name('mt_supplier.detail_by_id');  //初期表示(ID指定)
            Route::post('/mt_supplier/detail', [MtSupplierController::class, 'update'])->name('mt_supplier.detail.update');  //更新

            //仕入先リスト(一覧)
            Route::get('/mt_supplier/list', [MtSupplierController::class, 'list'])->name('mt_supplier.list');	//初期表示
            Route::post('/mt_supplier/export', [MtSupplierController::class, 'export'])->name('mt_supplier.export');	//出力

            //仕入先入力(残高)　実装不要
            //Route::get('/mt_supplier/balance', [MtSupplierController::class, 'indexBalance'])->name('mt_supplier.balance.index');  //初期表示
            //Route::post('/mt_supplier/balance', [MtSupplierController::class, 'updateBalance'])->name('mt_supplier.balance.update');  //更新

            //仕入先分類入力(一覧)
            Route::get('/mt_supplier_class', [MtSupplierClassController::class, 'index'])->name('mt_supplier_class.index');  //初期表示
            Route::post('/mt_supplier_class', [MtSupplierClassController::class, 'update'])->name('mt_supplier_class.update');  //更新

            //仕入先分類リスト(一覧)
            Route::get('/mt_supplier_class/list', [MtSupplierClassController::class, 'list'])->name('mt_supplier_class.list');  //初期表示
            Route::post('/mt_supplier_class/export', [MtSupplierClassController::class, 'export'])->name('mt_supplier_class.list.export');  //出力
        });
        //商品
        Route::prefix('item')->name('item.')->group(function () {
            //カラーマスタ(一覧)
            Route::get('/mt_color', [MtColorController::class, 'index'])->name('mt_color.index');  //初期表示
            Route::post('/mt_color', [MtColorController::class, 'update'])->name('mt_color.update');  //更新

            //カラーリスト(一覧)
            Route::get('/mt_color/list', [MtColorController::class, 'list'])->name('mt_color.list');  //初期表示
            Route::post('/mt_color/export', [MtColorController::class, 'export'])->name('mt_color.export');  //プレビュー・Excel出力

            //サイズマスタ(一覧)
            Route::get('/mt_size', [MtSizeController::class, 'index'])->name('mt_size.index');  //初期表示
            Route::post('/mt_size', [MtSizeController::class, 'update'])->name('mt_size.update');  //更新

            //サイズリスト(一覧)
            Route::get('/mt_size/list', [MtSizeController::class, 'list'])->name('mt_size.list');  //初期表示
            Route::post('/mt_size/export', [MtSizeController::class, 'export'])->name('mt_size.export');  //出力

            //カラーパターンマスタ(一覧)
            Route::get('/mt_color_pattern', [MtColorPatternController::class, 'index'])->name('mt_color_pattern.index');  //初期表示
            Route::post('/mt_color_pattern', [MtColorPatternController::class, 'update'])->name('mt_color_pattern.update');  //更新

            //カラーパターンリスト(一覧)
            Route::get('/mt_color_pattern/list', [MtColorPatternController::class, 'list'])->name('mt_color_pattern.list');  //初期表示
            Route::post('/mt_color_pattern/export', [MtColorPatternController::class, 'export'])->name('mt_color_pattern.export');  //プレビュー・Excel出力

            //サイズパターンマスタ(一覧)
            Route::get('/mt_size_pattern', [MtSizePatternController::class, 'index'])->name('mt_size_pattern.index'); //初期表示
            Route::post('/mt_size_pattern', [MtSizePatternController::class, 'update'])->name('mt_size_pattern.update'); //更新

            //サイズパターンリスト(一覧)
            Route::get('/mt_size_pattern/list', [MtSizePatternController::class, 'list'])->name('mt_size_pattern.list');  //初期表示
            Route::post('/mt_size_pattern/export', [MtSizePatternController::class, 'export'])->name('mt_size_pattern.export');  //プレビュー・Excel出力

            //商品分類入力(一覧)
            Route::get('/mt_item_class', [MtItemClassController::class, 'index'])->name('mt_item_class.index');  //初期表示
            Route::post('/mt_item_class', [MtItemClassController::class, 'update'])->name('mt_item_class.update');  //更新

            //商品分類リスト(一覧)
            Route::get('/mt_item_class/list', [MtItemClassController::class, 'list'])->name('mt_item_class.list');  //初期表示
            Route::post('/mt_item_class/export', [MtItemClassController::class, 'export'])->name('mt_item_class.export');  //プレビュー・Excel出力

            //商品入力(詳細)
            Route::get('/mt_item/detail', [MtItemController::class, 'detail'])->name('mt_item.detail');  //初期表示
            Route::get('/mt_item/detail/{id}', [MtItemController::class, 'detailById'])->name('mt_item.detail_by_id');  //初期表示
            Route::post('/mt_item/detail', [MtItemController::class, 'update'])->name('mt_item.update');  //更新

            //商品リスト(一覧)
            Route::get('/mt_item/list', [MtItemController::class, 'list'])->name('mt_item.list');  //初期表示
            Route::post('/mt_item/export', [MtItemController::class, 'export'])->name('mt_item.export');  //出力

            //商品リスト(分類別)
            Route::get('/mt_item/class/list', [MtItemController::class, 'classList'])->name('mt_item.class.list');  //初期表示
            Route::post('/mt_item/class/export', [MtItemController::class, 'classExport'])->name('mt_item.class.export');  //出力

            //商品マスタ(EXCEL取込)
            Route::get('/mt_item/file', [MtItemController::class, 'fileIndex'])->name('mt_item.file.index');  //初期表示
            Route::post('/mt_item/file/import', [MtItemController::class, 'fileImport'])->name('mt_item.file.import');  //更新

            //JANコード登録マスタ(一覧)
            Route::get('/jan', [MtStockKeepingUnitController::class, 'index'])->name('jan.list');  //初期表示
            Route::get('/jan/{mtItemId}', [MtStockKeepingUnitController::class, 'indexById'])->name('jan.list_by_id');  //初期表示(ID指定)
            Route::post('/jan', [MtStockKeepingUnitController::class, 'update'])->name('jan.update');  //更新
        });
        //単価
        Route::prefix('price')->name('price.')->group(function () {
            //PS区分別得意先掛率マスタ一覧入力
            Route::get('/mt_customer_other_item_rate/ps_kbn', [MtCustomerOtherItemRateController::class, 'PsKbnIndex'])->name('mt_customer_other_item_rate.ps_kbn.index'); //初期表示
            Route::get('/mt_customer_other_item_rate/ps_kbn/{classId}', [MtCustomerOtherItemRateController::class, 'PsKbnIndexByClassId'])->name('mt_customer_other_item_rate.ps_kbn.index_by_class_id'); //初期表示
            Route::post('/mt_customer_other_item_rate/ps_kbn', [MtCustomerOtherItemRateController::class, 'PsKbnUpdate'])->name('mt_customer_other_item_rate.ps_kbn.update'); //更新

            //仕入先商品単価一覧リスト
            Route::get('/mt_supplier_item_price/list', [MtSupplierItemPriceController::class, 'list'])->name('mt_supplier_item_price.list');  //初期表示
            Route::post('/mt_supplier_item_price/export', [MtSupplierItemPriceController::class, 'export'])->name('mt_supplier_item_price.export');  //出力

            //仕入先商品単価一覧入力
            Route::get('/mt_supplier_item_price', [MtSupplierItemPriceController::class, 'index'])->name('mt_supplier_item_price.index'); //初期表示
            Route::get('/mt_supplier_item_price/page/{id}', [MtSupplierItemPriceController::class, 'pageById'])->name('mt_supplier_item_price.page_by_id'); //初期表示
            Route::get('/mt_supplier_item_price/{id}', [MtSupplierItemPriceController::class, 'indexById'])->name('mt_supplier_item_price.index_by_id'); //初期表示
            Route::post('/mt_supplier_item_price', [MtSupplierItemPriceController::class, 'update'])->name('mt_supplier_item_price.update'); //更新

            //得意先別商品掛率マスタリスト(同一URLの{id}があるため先に定義する必要あり)
            Route::get('/mt_customer_other_item_rate/list', [MtCustomerOtherItemRateController::class, 'list'])->name('mt_customer_other_item_rate.list');  //初期表示
            Route::post('/mt_customer_other_item_rate/export', [MtCustomerOtherItemRateController::class, 'export'])->name('mt_customer_other_item_rate.export');  //出力

            //得意先別商品掛率マスタ入力
            Route::get('/mt_customer_other_item_rate_new', [MtCustomerOtherItemRateController::class, 'indexForNew'])->name('mt_customer_other_item_rate.index_for_new'); //初期表示
            Route::get('/mt_customer_other_item_rate_fix', [MtCustomerOtherItemRateController::class, 'indexForFix'])->name('mt_customer_other_item_rate.index_for_fix'); //初期表示
            Route::get('/mt_customer_other_item_rate_new/page/{id}', [MtCustomerOtherItemRateController::class, 'pageByIdForNew'])->name('mt_customer_other_item_rate.page_by_id_for_new'); //初期表示
            Route::get('/mt_customer_other_item_rate_fix/page/{id}', [MtCustomerOtherItemRateController::class, 'pageByIdForFix'])->name('mt_customer_other_item_rate.page_by_id_for_fix'); //初期表示
            Route::get('/mt_customer_other_item_rate_new/{id}', [MtCustomerOtherItemRateController::class, 'indexByIdForNew'])->name('mt_customer_other_item_rate.index_by_id_for_new'); //初期表示
            Route::get('/mt_customer_other_item_rate_fix/{id}', [MtCustomerOtherItemRateController::class, 'indexByIdForFix'])->name('mt_customer_other_item_rate.index_by_id_for_fix'); //初期表示
            Route::post('/mt_customer_other_item_rate', [MtCustomerOtherItemRateController::class, 'update'])->name('mt_customer_other_item_rate.update'); //更新

            //得意先別商品分類掛率マスタリスト(同一URLの{id}があるため先に定義する必要あり)
            Route::get('/mt_customer_other_item_class_rate/list', [MtCustomerOtherItemClassRateController::class, 'list'])->name('mt_customer_other_item_class_rate.list');  //初期表示
            Route::post('/mt_customer_other_item_class_rate/export', [MtCustomerOtherItemClassRateController::class, 'export'])->name('mt_customer_other_item_class_rate.export');  //出力

            //得意先別商品分類掛率マスタ入力
            Route::get('/mt_customer_other_item_class_rate_new', [MtCustomerOtherItemClassRateController::class, 'indexForNew'])->name('mt_customer_other_item_class_rate.index_for_new'); //初期表示
            Route::get('/mt_customer_other_item_class_rate_fix', [MtCustomerOtherItemClassRateController::class, 'indexForFix'])->name('mt_customer_other_item_class_rate.index_for_fix'); //初期表示
            Route::get('/mt_customer_other_item_class_rate_new/page/{id}', [MtCustomerOtherItemClassRateController::class, 'pageByIdForNew'])->name('mt_customer_other_item_class_rate.page_by_id_for_new');
            Route::get('/mt_customer_other_item_class_rate_fix/page/{id}', [MtCustomerOtherItemClassRateController::class, 'pageByIdForFix'])->name('mt_customer_other_item_class_rate.page_by_id_for_fix');
            Route::get('/mt_customer_other_item_class_rate_new/{id}', [MtCustomerOtherItemClassRateController::class, 'indexByIdForNew'])->name('mt_customer_other_item_class_rate.index_by_id_for_new'); //初期表示
            Route::get('/mt_customer_other_item_class_rate_fix/{id}', [MtCustomerOtherItemClassRateController::class, 'indexByIdForFix'])->name('mt_customer_other_item_class_rate.index_by_id_for_fix'); //初期表示
            Route::post('/mt_customer_other_item_class_rate', [MtCustomerOtherItemClassRateController::class, 'update'])->name('mt_customer_other_item_class_rate.update'); //更新

            //売価情報マスタ入力
            Route::get('/selling_price', [MtCustomerOtherItemClassRateController::class, 'sellingPriceIndex'])->name('selling_price.index'); //初期表示
            Route::post('/selling_price', [MtCustomerOtherItemClassRateController::class, 'sellingPriceUpdate'])->name('selling_price.update'); //更新

            //売価情報マスタリスト
            Route::get('/selling_price/list', [MtCustomerOtherItemClassRateController::class, 'sellingPriceList'])->name('selling_price.list');  //初期表示
            Route::post('/selling_price/export', [MtCustomerOtherItemClassRateController::class, 'sellingPriceExport'])->name('selling_price.export');  //出力
        });
        //その他
        Route::prefix('other')->name('other.')->group(function () {
            //JANコードマスタ(一覧表)
            Route::get('/jan/list', [MtStockKeepingUnitController::class, 'list'])->name('mt_stock_keeping_unit.list');  //初期表示
            Route::post('/jan/export', [MtStockKeepingUnitController::class, 'export'])->name('mt_stock_keeping_unit.export');  //出力

            //ルートマスタ入力
            Route::get('/mt_root', [MtRootController::class, 'index'])->name('mt_root.index');  //初期表示
            Route::post('/mt_root', [MtRootController::class, 'update'])->name('mt_root.update');  //更新

            //ロケーションマスタリスト
            Route::get('/mt_location/list', [MtLocationController::class, 'list'])->name('mt_location.list');  //初期表示
            Route::post('/mt_location/export', [MtLocationController::class, 'export'])->name('mt_location.export');  //出力

            //ロケーションマスタ(EXCEL取込)
            Route::get('/mt_location/file', [MtLocationController::class, 'fileIndex'])->name('mt_location.file.index');  //初期表示
            Route::post('/mt_location/file/import', [MtLocationController::class, 'fileImport'])->name('mt_location.file.import');  //更新

            //ロケーションマスタ入力
            Route::get('/mt_location', [MtLocationController::class, 'index'])->name('mt_location.index');  //初期表示
            Route::get('/mt_location/{id}', [MtLocationController::class, 'indexById'])->name('mt_location.index_by_id');  //初期表示
            Route::post('/mt_location', [MtLocationController::class, 'update'])->name('mt_location.update');  //更新

            //運送会社マスタ入力
            Route::get('/mt_shipping_company', [MtShippingCompanyController::class, 'index'])->name('mt_shipping_company.index');  //初期表示
            Route::post('/mt_shipping_company', [MtShippingCompanyController::class, 'update'])->name('mt_shipping_company.update');  //更新

            //運送会社マスタリスト
            Route::get('/mt_shipping_company/list', [MtShippingCompanyController::class, 'list'])->name('mt_shipping_company.list');  //初期表示
            Route::post('/mt_shipping_company/export', [MtShippingCompanyController::class, 'export'])->name('mt_shipping_company.export');  //出力

            //銀行マスタ入力
            Route::get('/mt_bank', [MtBankController::class, 'index'])->name('mt_bank.index');  //初期表示
            Route::post('/mt_bank', [MtBankController::class, 'update'])->name('mt_bank.update');  //更新

            //銀行マスタリスト
            Route::get('/mt_bank/list', [MtBankController::class, 'list'])->name('mt_bank.list');  //初期表示
            Route::post('/mt_bank/export', [MtBankController::class, 'export'])->name('mt_bank.export');  //出力

            //商品コード変更
            Route::get('/mt_item/item_cd', [MtItemController::class, 'itemCodeIndex'])->name('mt_item.item_cd.index');  //初期表示
            Route::post('/mt_item/item_cd', [MtItemController::class, 'itemCodeUpdate'])->name('mt_item.item_cd.update');  //更新

            //商品変更履歴リスト
            Route::get('/mt_item_change_history/list', [MtItemChangeHistoryController::class, 'list'])->name('mt_item_change_history.list');  //初期表示
            Route::post('/mt_item_change_history/export', [MtItemChangeHistoryController::class, 'export'])->name('mt_item_change_history.export');  //出力

            //倉庫マスタ入力
            Route::get('/mt_warehouse', [MtWarehouseController::class, 'index'])->name('mt_warehouse.index');  //初期表示
            Route::post('/mt_warehouse', [MtWarehouseController::class, 'update'])->name('mt_warehouse.update');  //更新

            //倉庫マスタリスト
            Route::get('/mt_warehouse/list', [MtWarehouseController::class, 'list'])->name('mt_warehouse.list');  //初期表示
            Route::post('/mt_warehouse/export', [MtWarehouseController::class, 'export'])->name('mt_warehouse.export');  //出力
        });
        //EC関連
        Route::prefix('ec')->name('ec.')->group(function () {
            //TOP自由領域入力(詳細)
            Route::get('/top_free_area/detail', [MtTopFreeAreaController::class, 'detail'])->name('top_free_area.detail');  //初期表示
            Route::get('/top_free_area/detail/{id}', [MtTopFreeAreaController::class, 'detailById'])->name('top_free_area.detail_by_id');  //初期表示(ID指定)
            Route::post('/top_free_area/detail', [MtTopFreeAreaController::class, 'update'])->name('top_free_area.detail.update');  //更新

            //お知らせ入力(詳細)
            Route::get('/notice/detail', [MtNoticeController::class, 'detail'])->name('notice.detail');  //初期表示
            Route::get('/notice/detail/{id}', [MtNoticeController::class, 'detailById'])->name('notice.detail_by_id');  //初期表示(ID指定)
            Route::post('/notice/detail', [MtNoticeController::class, 'update'])->name('notice.detail.update');  //更新

            //ピックアップ検索注文入力（詳細）
            Route::get('/catalog/detail', [MtCatalogController::class, 'detail'])->name('catalog.detail');  //初期表示
            Route::get('/catalog/detail/{id}', [MtCatalogController::class, 'detailById'])->name('catalog.detail_by_id');  //初期表示(ID指定)
            Route::post('/catalog/detail', [MtCatalogController::class, 'update'])->name('catalog.detail.update');  //更新
        });
    });
    // データ連携
    Route::prefix('alignment')->name('alignment.')->group(function () {
        //KEYENCE
        Route::prefix('keyence')->name('keyence.')->group(function () {
            //売上データ取込
            Route::get('/sales_data/import', [TrnSaleHeaderController::class, 'indexSalesDataImport'])->name('sales_data.import.index');  //初期表示
            Route::post('/sales_data/import', [TrnSaleHeaderController::class, 'updateSalesDataImport'])->name('sales_data.import.update');  //更新

            //入出庫データ取込
            Route::get('/in_out_data/import', [TrnInOutHeaderController::class, 'indexInOutDataImport'])->name('in_out_data.import.index');  //初期表示
            Route::post('/in_out_data/import', [TrnInOutHeaderController::class, 'updateInOutDataImport'])->name('in_out_data.import.update');  //更新
        });
        //日本郵政データ
        Route::prefix('jph')->name('jph.')->group(function () {
            //商品データ出力
            Route::get('/item_data/output', [MtItemController::class, 'indexItemDataOutput'])->name('item_data.output.index');  //初期表示
            Route::post('/item_data/output', [MtItemController::class, 'exportItemDataOutput'])->name('item_data.output.export');  //出力

            //出荷指示データ出力
            Route::get('/shipping_instruction/output', [TrnShippingController::class, 'indexShippingInstructionOutput'])->name('shipping_instruction.output.index');  //初期表示
            Route::post('/shipping_instruction/output', [TrnShippingController::class, 'exportShippingInstructionOutput'])->name('shipping_instruction.output.export');  //出力

            //出荷データ取込
            Route::get('/shipping_data/import', [TrnShippingController::class, 'indexShippingDataImport'])->name('shipping_data.import.index');  //初期表示
            Route::post('/shipping_data/import', [TrnShippingController::class, 'updateShippingDataImport'])->name('shipping_data.import.update');  //更新
        });
    });
    // システム
    Route::prefix('system')->name('system.')->group(function () {
        //セキュリティ
        Route::prefix('security')->name('security.')->group(function () {
            //ユーザマスタ(メンテナンス)
            Route::get('/user/maintenance', [MtUserController::class, 'indexUserMaintenance'])->name('user.maintenance.index');    //初期表示
            Route::get('/user/maintenance/{id}', [MtUserController::class, 'indexUserMaintenanceById'])->name('user.maintenance.index_by_id');    //初期表示(ID指定)
            Route::post('/user/maintenance', [MtUserController::class, 'updateUserMaintenance'])->name('user.maintenance.update');    //更新

            //ユーザマスタ(一覧)
            Route::get('/user/list', [MtUserController::class, 'indexUserList'])->name('user.list');	//初期表示
            Route::post('/user/list', [MtUserController::class, 'updateUserList'])->name('user.update');	//更新
        });
        //環境設定
        Route::prefix('environment')->name('environment.')->group(function () {
            //会社情報
            Route::get('/company', [MtSystemController::class, 'setCompany'])->name('company.index');		//初期表示
            Route::post('/company', [MtSystemController::class, 'updateCompany'])->name('company.update');	//更新

            //休日マスタ
            Route::get('/holiday', [MtHolidayController::class, 'setHoliday'])->name('holiday.index');		//初期表示
            Route::post('/holiday', [MtHolidayController::class, 'updateHoliday'])->name('holiday.update');	//更新

            //受付付箋マスタ
            Route::get('/sticky_note', [MtOrderReceiveStickyNoteController::class, 'setStickyNote'])->name('sticky_note.index');		//初期表示
            Route::post('/sticky_note', [MtOrderReceiveStickyNoteController::class, 'updateStickyNote'])->name('sticky_note.update');		//更新

            //税率設定ファイル
            Route::get('/tax_rate', [MtTaxRateSettingController::class, 'setTaxRate'])->name('tax_rate.index');	//初期表示
            Route::post('/tax_rate', [MtTaxRateSettingController::class, 'updateTaxRate'])->name('tax_rate.update');	//更新

            //伝票種別マスタ
            Route::get('/slip_kind', [MtSlipKindController::class, 'setSlipKind'])->name('slip_kind.index');	//初期表示
            Route::post('/slip_kind', [MtSlipKindController::class, 'updateSlipKind'])->name('slip_kind.update');	//更新
        });
    });
    // 特化型分析
    Route::prefix('analyse')->name('analyse.')->group(function () {
        // 明細表
        Route::prefix('detail')->name('detail.')->group(function () {
            Route::get('/backlog_without_location', [AnaBacklogWithoutLocationController::class, 'analyse'])->name('backlog_without_location.analyse');
            Route::get('/check_assigned_outstanding_order', [AnaCheckAssignedOutstandingOrderController::class, 'analyse'])->name('check_assigned_outstanding_order.analyse');
            Route::get('/check_received_order', [AnaCheckReceivedOrderController::class, 'analyse'])->name('check_received_order.analyse');
            Route::get('/check_return', [AnaCheckReturnController::class, 'analyse'])->name('check_return.analyse');
            Route::get('/customer_data', [AnaCustomerDataController::class, 'analyse'])->name('customer_data.analyse');
            Route::get('/customer_delivery_destination_data', [AnaCustomerDeliveryDestinationDataController::class, 'analyse'])->name('customer_delivery_destination_data.analyse');
            Route::get('/daily_payment', [AnaDailyPaymentController::class, 'analyse'])->name('daily_payment.analyse');
            Route::get('/monthly_payment', [AnaMonthlyPaymentController::class, 'analyse'])->name('monthly_payment.analyse');
            Route::get('/outstanding_order_master', [AnaOutstandingOrderMasterController::class, 'analyse'])->name('outstanding_order_master.analyse');
            Route::get('/payment_by_customer', [AnaPaymentByCustomerController::class, 'analyse'])->name('payment_by_customer.analyse');
            Route::get('/return_after_payment', [AnaReturnAfterPaymentController::class, 'analyse'])->name('return_after_payment.analyse');
            Route::get('/search_large_received_order', [AnaSearchLargeReceivedOrderController::class, 'analyse'])->name('search_large_received_order.analyse');
            Route::get('/search_recived_order', [AnaSearchRecivedOrderController::class, 'analyse'])->name('search_recived_order.analyse');
            Route::get('/search_recived_order_for_check', [AnaSearchRecivedOrderForCheckController::class, 'analyse'])->name('search_recived_order_for_check.analyse');
            Route::get('/search_sale', [AnaSearchSaleController::class, 'analyse'])->name('search_sale.analyse');
        });
        // 集計表
        Route::prefix('tally')->name('tally.')->group(function () {
            Route::get('/backlog', [AnaBacklogController::class, 'analyse'])->name('backlog.analyse');
            Route::get('/check_outstanding_order_and_backlog', [AnaCheckOutstandingOrderAndBacklogController::class, 'analyse'])->name('check_outstanding_order_and_backlog.analyse');
            Route::get('/check_shipping', [AnaCheckShippingController::class, 'analyse'])->name('check_shipping.analyse');
            Route::get('/check_shipping_document_number', [AnaCheckShippingDocumentNumberController::class, 'analyse'])->name('check_shipping_document_number.analyse');
            Route::get('/gross_profit_chart', [AnaGrossProfitChartController::class, 'analyse'])->name('gross_profit_chart.analyse');
            Route::get('/outstanding_order', [AnaOutstandingOrderController::class, 'analyse'])->name('outstanding_order.analyse');
        });
    });
    Route::get('/get_stock_info', [MtItemController::class, 'getStockInfo'])->name('get_stock_info');
    Route::get('/get_stock_detail_info', [MtItemController::class, 'getStockDetailInfo'])->name('get_stock_detail_info');
    // コード自動補完 for JS
    Route::prefix('code_auto')->name('code_auto.')->group(function () {
        //部門定義
        Route::get('/department', [DefDepartmentController::class, 'codeAutoComplete'])->name('department'); //コードから名称補完
        //倉庫マスタ
        Route::get('/warehouse', [MtWarehouseController::class, 'codeAutoComplete'])->name('warehouse'); //コードから名称補完
        //得意先分類入力マスタ
        Route::get('/customer_class', [MtCustomerClassController::class, 'codeAutoComplete'])->name('customer_class'); //コードから名称補完
        //仕入先分類入力マスタ
        Route::get('/supplier_class', [MtSupplierClassController::class, 'codeAutoComplete'])->name('supplier_class'); //コードから名称補完
        //得意先マスタ
        Route::get('/customer', [MtCustomerController::class, 'codeAutoComplete'])->name('customer'); //コードから名称補完
        //納品先マスタ
        Route::get('/delivery_destination', [MtDeliveryDestinationController::class, 'codeAutoComplete'])->name('delivery_destination'); //コードから名称補完
        //請求先マスタ
        Route::get('/billing_address', [MtBillingAddressController::class, 'codeAutoComplete'])->name('billing_address'); //コードから名称補完
        //商品分類入力マスタ
        Route::get('/item_class', [MtItemClassController::class, 'codeAutoComplete'])->name('item_class'); //コードから名称補完
        //商品分類入力マスタ（ブランド1）
        Route::get('/item_class_brand1', [MtItemClassController::class, 'codeAutoCompleteBrand1'])->name('item_class_brand1'); //コードから名称補完
        //カラーマスタ
        Route::get('color', [MtColorController::class, 'codeAutoComplete'])->name('color'); //コードから名称補完
        //サイズマスタ
        Route::get('size', [MtSizeController::class, 'codeAutoComplete'])->name('size'); //コードから名称補完
        //カラーパターンマスタ
        Route::get('color_pattern', [MtColorPatternController::class, 'codeAutoComplete'])->name('color_pattern'); //コードから名称補完
        //サイズパターンマスタ
        Route::get('size_pattern', [MtSizePatternController::class, 'codeAutoComplete'])->name('size_pattern'); //コードから名称補完
        //ルートマスタ
        Route::get('root', [MtRootController::class, 'codeAutoComplete'])->name('root'); //コードから名称補完
        //ロケーションマスタ
        Route::get('location', [MtLocationController::class, 'codeAutoComplete'])->name('location'); //コードから名称補完
        //運送会社マスタ
        Route::get('shipping_company', [MtShippingCompanyController::class, 'codeAutoComplete'])->name('shipping_company'); //コードから名称補完
        //銀行マスタ
        Route::get('bank', [MtBankController::class, 'codeAutoComplete'])->name('bank'); //コードから名称補完
        //商品マスタ
        Route::get('item', [MtItemController::class, 'codeAutoComplete'])->name('item'); //コードから名称補完
        Route::get('item_with_sku', [MtItemController::class, 'codeAutoCompleteWithSKU'])->name('item_with_sku'); //コードから名称補完
        Route::get('/jan_check', [MtStockKeepingUnitController::class, 'janCodeExistCheck'])->name('jan.jan_check');  //JANコード存在チェック
        //TOP自由領域
        Route::get('top_free_area', [MtTopFreeAreaController::class, 'codeAutoComplete'])->name('top_free_area'); //コードから名称補完
        //お知らせ
        Route::get('notice', [MtNoticeController::class, 'codeAutoComplete'])->name('notice'); //コードから名称補完
        //カタログ
        Route::get('catalog', [MtCatalogController::class, 'codeAutoComplete'])->name('catalog'); //コードから名称補完
        //SKU
        Route::get('sku', [MtStockKeepingUnitController::class, 'codeAutoComplete'])->name('sku'); //コードから名称補完
        //SKU
        Route::get('skus', [MtStockKeepingUnitController::class, 'codeAutoCompleteSkus'])->name('sku'); //コードから名称補完
        //仕入先マスタ
        Route::get('/supplier', [MtSupplierController::class, 'codeAutoComplete'])->name('supplier'); //コードから名称補完
        //税率設定
        Route::get('/tax_rate', [MtTaxRateSettingController::class, 'codeAutoComplete'])->name('tax_rate'); //コードから名称補完
        Route::get('/tax_rate_kbn', [DefTaxRateKbnController::class, 'codeAutoComplete'])->name('tax_rate_kbn'); //コードから名称補完
        Route::get('/tax_rate_kbn_wiht_rate', [DefTaxRateKbnController::class, 'codeAutoCompleteWithRate'])->name('tax_rate_kbn_wiht_rate'); //コードから名称補完
        //メンバーサイト商品コード
        Route::get('/member_site_item', [MtMemberSiteItemController::class, 'codeAutoComplete'])->name('member_site_item'); //コードから名称補完
        Route::get('/member_site_item_with_catalog_order', [MtMemberSiteItemController::class, 'codeAutoCompleteWithCatalogOrder'])->name('member_site_item_with_catalog_order'); //コードから名称補完
        Route::get('/member_site_item_with_recommendation', [MtMemberSiteItemController::class, 'codeAutoCompleteWithRecommendation'])->name('member_site_item_with_recommendation'); //コードから名称補完
        Route::get('/member_site_item_recommendation_management', [MtMemberSiteItemController::class, 'codeAutoCompleteRecommendationManagement'])->name('member_site_item_recommendation_management'); //コードから名称補完
        //ユーザコード
        Route::get('/user', [MtUserController::class, 'codeAutoComplete'])->name('user'); //コードから名称補完
        //得意先別納品先
        Route::get('/mt_customer_delivery_destination', [MtCustomerDeliveryDestinationController::class, 'codeAutoComplete'])->name('mt_customer_delivery_destination'); //コードから名称補完
        //得意先別担当者
        Route::get('/mt_customer_manager', [MtCustomerManagerController::class, 'codeAutoComplete'])->name('mt_customer_manager'); //コードから名称補完
        //得意先別商品掛率
        Route::get('/customer_other_item_rate', [MtCustomerOtherItemRateController::class, 'codeAutoComplete'])->name('customer_other_item_rate'); //コードから名称補完
        //得意先別商品分類掛率
        Route::get('/customer_other_item_class_rate', [MtCustomerOtherItemClassRateController::class, 'codeAutoComplete'])->name('customer_other_item_class_rate'); //コードから名称補完
        //支払先コード
        Route::get('/pay_destination', [MtPayDestinationController::class, 'codeAutoComplete'])->name('pay_destination'); //コードから名称補完
        //伝票種別
        Route::get('/slip_kind', [MtSlipKindController::class, 'codeAutoComplete'])->name('slip_kind'); //コードから名称補完
        //着日定義
        Route::get('/arrival_date', [DefArrivalDateController::class, 'codeAutoComplete'])->name('arrival_date'); //コードから名称補完
        //地区分類定義
        Route::get('/district_classe', [DefDistrictClassController::class, 'codeAutoComplete'])->name('district_classe'); //コードから名称補完
        //開拓年分類定義
        Route::get('/pioneer_year', [DefPioneerYearController::class, 'codeAutoComplete'])->name('pioneer_year'); //コードから名称補完
        //入出庫伝票
        Route::get('/trn_inout_header', [TrnInOutHeaderController::class, 'codeAutoComplete'])->name('trn_order_header'); //コードから名称補完
        //仕入先商品単価
        Route::get('supplier_item_price', [MtSupplierItemPriceController::class, 'codeAutoComplete'])->name('supllier_item_price');
    });
    // データロード for JS
    Route::prefix('load')->name('load.')->group(function () {
        Route::get('/item_location', [MtStockKeepingUnitController::class, 'loadByWarehouseAndItem']);
    });
});
