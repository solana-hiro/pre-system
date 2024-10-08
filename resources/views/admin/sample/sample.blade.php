@extends('layouts.admin.app')
@section('page_title', 'SAMPLE')
@section('title', 'SAMPLE')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <h3>検索TESTページ<input type="text" id="test" name="" class="element" style="" placeholder="初期化確認用入力スペース" />
    </h3>

    <div style="margin-left: 30px;">PS区分検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_ps_kbn" name="input_ps_kbn" class="element" style="border:none;" />
            <img class="vector" id="img_ps_kbn" src="/img/icon/vector.svg" onclick="searchPsKbn(this.id);return false;" />
        </div>
        <div class="textbox td_200px" id="names_ps_kbn"></div>
        <input type="hidden" id="hidden_ps_kbn" value="" name="hidden_ps_kbn" />
    </div>

    <div style="margin-left: 30px;">TOP自由領域コード検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_top_free_area" name="input_top_free_area" class="element"
                style="border:none;" />
            <img class="vector" id="img_top_free_area" src="/img/icon/vector.svg"
                data-smm-open="search_top_free_area_modal" />
        </div>
        <div class="textbox td_200px" id="names_top_free_area"></div>
        <input type="hidden" id="hidden_top_free_area" value="" name="hidden_top_free_area" />
    </div>

    <div style="margin-left: 30px;">お知らせ検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_notice" name="input_notice" class="element" style="border:none;" />
            <img class="vector" id="img_notice" src="/img/icon/vector.svg" data-smm-open="search_member_site_item_class" />
        </div>
        <div class="textbox td_200px" id="names_notice"></div>
        <input type="hidden" id="hidden_notice" value="" name="hidden_notice" />
    </div>

    <div style="margin-left: 30px;">カタログ検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_catalog" name="input_catalog" class="element" style="border:none;" />
            <img class="vector" id="img_catalog" src="/img/icon/vector.svg" data-smm-open="search_catalog_modal" />
        </div>
        <div class="textbox td_200px" id="names_catalog"></div>
        <input type="hidden" id="hidden_catalog" value="" name="hidden_catalog" />
    </div>

    <div style="margin-left: 30px;">カラーパターン検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_color_pattern" name="input_color_pattern" class="element"
                style="border:none;" />
            <img class="vector" id="img_color_pattern" src="/img/icon/vector.svg"
                data-smm-open="search_color_pattern_modal" />
        </div>
        <!--
                                                                                                                                                                            <div class="textbox td_200px" id="names_color_pattern"></div>
                                                                                                                                                                            -->
        <input type="hidden" id="hidden_color_pattern" value="" name="hidden_color_pattern" />
    </div>

    <div style="margin-left: 30px;">カラー検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_color" name="input_color" class="element" style="border:none;" />
            <img class="vector" id="img_color" src="/img/icon/vector.svg" data-smm-open="search_color_modal" />
        </div>
        <div class="textbox td_200px" id="names_color"></div>
        <input type="hidden" id="hidden_color" value="" name="hidden_color" />
    </div>

    <div style="margin-left: 30px;">サイズパターン検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_size_pattern" name="input_size_pattern" class="element"
                style="border:none;" />
            <img class="vector" id="img_size_pattern" src="/img/icon/vector.svg"
                data-smm-open="search_size_pattern_modal" />
        </div>
        <div class="textbox td_200px" id="names_size_pattern"></div>
        <input type="hidden" id="hidden_size_pattern" value="" name="hidden_size_pattern" />
    </div>

    <div style="margin-left: 30px;">サイズ検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_size" name="input_size" class="element" style="border:none;" />
            <img class="vector" id="img_size" src="/img/icon/vector.svg" data-smm-open="search_size_modal" />
        </div>
        <div class="textbox td_200px" id="names_size"></div>
        <input type="hidden" id="hidden_size" value="" name="hidden_size" />
    </div>

    <div style="margin-left: 30px;">ジャンル検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_genre" name="input_genre" class="element" style="border:none;" />
            <img class="vector" id="img_genre" src="/img/icon/vector.svg" data-smm-open="search_genre_modal" />
        </div>
        <div class="textbox td_200px" id="names_genre"></div>
        <input type="hidden" id="hidden_genre" value="" name="hidden_genre" />
    </div>

    <div style="margin-left: 30px;">ブランド1検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_brand1" name="input_brand1" class="element" style="border:none;" />
            <img class="vector" id="img_brand1" src="/img/icon/vector.svg" data-smm-open="search_brand1_modal" />
        </div>
        <div class="textbox td_200px" id="names_brand1"></div>
        <input type="hidden" id="hidden_brand1" value="" name="hidden_brand1" />
    </div>

    <div style="margin-left: 30px;">ランク3検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_rank3" name="input_rank3" class="element" style="border:none;" />
            <img class="vector" id="img_rank3" src="/img/icon/vector.svg" data-smm-open="search_rank3_modal" />
        </div>
        <div class="textbox td_200px" id="names_rank3"></div>
        <input type="hidden" id="hidden_rank3" value="" name="hidden_rank3" />
    </div>

    <div style="margin-left: 30px;">ルート検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_root" name="input_root" class="element" style="border:none;" />
            <img class="vector" id="img_root" src="/img/icon/vector.svg" data-smm-open="search_root_modal" />
        </div>
        <div class="textbox td_200px" id="names_root"></div>
        <input type="hidden" id="hidden_root" value="" name="hidden_root" />
    </div>

    <div style="margin-left: 30px;">仕入先コード検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_supplier" name="input_supplier" class="element" style="border:none;" />
            <img class="vector" id="img_supplier" src="/img/icon/vector.svg" data-smm-open="search_supplier_modal" />
        </div>
        <div class="textbox td_200px" id="names_supplier"></div>
        <input type="hidden" id="hidden_supplier" value="" name="hidden_supplier" />
    </div>

    <div style="margin-left: 30px;">仕入先分類1検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_supplier_class1" name="input_supplier_class1" class="element"
                style="border:none;" />
            <img class="vector" id="img_supplier_class1" src="/img/icon/vector.svg"
                data-smm-open="search_supplier_class1_modal" />
        </div>
        <div class="textbox td_200px" id="names_supplier_class1"></div>
        <input type="hidden" id="hidden_supplier_class1" value="" name="hidden_supplier_class1" />
    </div>

    <div style="margin-left: 30px;">仕入先分類2検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_supplier_class2" name="input_supplier_class2" class="element"
                style="border:none;" />
            <img class="vector" id="img_supplier_class2" src="/img/icon/vector.svg"
                data-smm-open="search_supplier_class2_modal" />
        </div>
        <div class="textbox td_200px" id="names_supplier_class2"></div>
        <input type="hidden" id="hidden_supplier_class2" value="" name="hidden_supplier_class2" />
    </div>

    <div style="margin-left: 30px;">仕入先分類3検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_supplier_class3" name="input_supplier_class3" class="element"
                style="border:none;" />
            <img class="vector" id="img_supplier_class3" src="/img/icon/vector.svg"
                data-smm-open="search_supplier_class3_modal" />
        </div>
        <div class="textbox td_200px" id="names_supplier_class3"></div>
        <input type="hidden" id="hidden_supplier_class3" value="" name="hidden_supplier_class3" />
    </div>

    <div style="margin-left: 30px;">仕入先残高検索 不要
        <!--
                                                                                                                                                                            <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
                                                                                                                                                                 <input type="text" id="input_supplier_balance" name="input_supplier_balance" class="element" style="border:none;" />
                                                                                                                                                                  <img class="vector" id="img_supplier_balance" ssrc="/img/icon/vector.svg" onclick="searchSupplierBalance(this.id);return false;" />
                                                                                                                                                                  </div>
                                                                                                                                                                            <div class="textbox td_200px" id="names_supplier_balance"></div>
                                                                                                                                                                            <input type="hidden" id="hidden_supplier_balance" value="" name="supplier_balance_search" />
                                                                                                                                                                        -->
    </div>

    <div style="margin-left: 30px;">伝票種別検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_slip_kind" name="input_slip_kind" class="element" style="border:none;" />
            <img class="vector" id="img_slip_kind" src="/img/icon/vector.svg" data-smm-open="search_slip_kind_modal" />
        </div>
        <div class="textbox td_200px" id="names_slip_kind"></div>
        <input type="hidden" id="hidden_slip_kind" value="" name="hidden_slip_kind" />
    </div>

    <div style="margin-left: 30px;">倉庫検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_warehouse" name="input_warehouse" class="element" style="border:none;" />
            <img class="vector" id="img_warehouse" src="/img/icon/vector.svg" data-smm-open="search_warehouse_modal" />
        </div>
        <div class="textbox td_200px" id="names_warehouse"></div>
        <input type="hidden" id="hidden_warehouse" value="" name="hidden_warehouse" />
    </div>

    <div style="margin-left: 30px;">商品コード検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_item_cd" name="input_item_cd" class="element" style="border:none;" />
            <img class="vector" id="img_item_cd" src="/img/icon/vector.svg" data-smm-open="search_item_cd_modal" />
        </div>
        <div class="textbox td_200px" id="names_item_cd"></div>
        <input type="hidden" id="hidden_item_cd" value="" name="hidden_item_cd" />
    </div>

    <div style="margin-left: 30px;">地区分類検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_district_class" name="input_district_class" class="element"
                style="border:none;" />
            <img class="vector" id="img_district_class" src="/img/icon/vector.svg"
                data-smm-open="search_district_class_modal" />
        </div>
        <div class="textbox td_200px" id="names_district_class"></div>
        <input type="hidden" id="hidden_district_class" value="" name="hidden_district_class" />
    </div>

    <div style="margin-left: 30px;">工場分類5検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_firm_class5" name="input_firm_class5" class="element"
                style="border:none;" />
            <img class="vector" id="img_firm_class5" src="/img/icon/vector.svg"
                data-smm-open="search_item_class_thing5_modal" />
        </div>
        <div class="textbox td_200px" id="names_firm_class5"></div>
        <input type="hidden" id="hidden_firm_class5" value="" name="hidden_firm_class5" />
    </div>

    <div style="margin-left: 30px;">得意先コード検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_customer" name="input_customer_cd" class="element" style="border:none;" />
            <img class="vector" id="img_customer" src="/img/icon/vector.svg" data-smm-open="search_customer_modal" />
        </div>
        <div class="textbox td_200px" id="names_customer"></div>
        <input type="hidden" id="hidden_customer" value="" name="hidden_customer" />
    </div>

    <div style="margin-left: 30px;">得意先残高検索 不要
        <!--
                                                                                                                                                                            <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
                                                                                                                                                                 <input type="text" id="input_customer_balance" name="input_customer_balance" class="element" style="border:none;" />
                                                                                                                                                                  <img class="vector" src="/img/icon/vector.svg" onclick="searchCustomerBalance(this.id);return false;" />
                                                                                                                                                                  </div>
                                                                                                                                                                            <input type="hidden" id="hidden_customer_balance" value="" name="hidden_customer_balance" />
                                                                                                                                                                        -->
    </div>

    <div style="margin-left: 30px;">担当者検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_manager" name="input_manager" class="element" style="border:none;" />
            <img class="vector" id="img_manager" src="/img/icon/vector.svg" data-smm-open="search_manager_modal" />
        </div>
        <div class="textbox td_200px" id="names_manager"></div>
        <input type="hidden" id="hidden_manager" value="" name="hidden_manager" />
    </div>

    <div style="margin-left: 30px;">支払先コード検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_pay_destination" name="input_pay_destination" class="element"
                style="border:none;" />
            <img class="vector" id="img_pay_destination" src="/img/icon/vector.svg"
                data-smm-open="search_pay_destination_modal" />
        </div>
        <div class="textbox td_200px" id="names_pay_destination"></div>
        <input type="hidden" id="hidden_pay_destination" value="" name="hidden_pay_destination" />
    </div>

    <div style="margin-left: 30px;">業種・特徴2検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_customer_class2" name="input_customer_class2" class="element"
                style="border:none;" />
            <img class="vector" id="img_customer_class2" src="/img/icon/vector.svg"
                data-smm-open="search_customer_class_thing2_modal" />
        </div>
        <div class="textbox td_200px" id="names_customer_class2"></div>
        <input type="hidden" id="hidden_customer_class2" value="" name="hidden_customer_class2" />
    </div>

    <div style="margin-left: 30px;">着日検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_arrival_date" name="input_arrival_date" class="element"
                style="border:none;" />
            <img class="vector" id="img_arrival_date" src="/img/icon/vector.svg"
                data-smm-open="search_arrival_date_modal" />
        </div>
        <div class="textbox td_200px" id="names_arrival_date"></div>
        <input type="hidden" id="hidden_arrival_date" value="" name="hidden_arrival_date" />
    </div>

    <div style="margin-left: 30px;">税率区分検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_tax_rate" name="input_tax_rate" class="element" style="border:none;" />
            <img class="vector" id="img_tax_rate" src="/img/icon/vector.svg"
                data-smm-open="search_tax_rate_kbn_modal" />
        </div>
        <div class="textbox td_200px" id="names_tax_rate"></div>
        <input type="hidden" id="hidden_tax_rate" value="" name="hidden_tax_rate" />
    </div>

    <div style="margin-left: 30px;">競技・カテゴリ検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_game_category" name="input_game_category" class="element"
                style="border:none;" />
            <img class="vector" id="img_game_category" src="/img/icon/vector.svg"
                data-smm-open="search_game_category_modal" />
        </div>
        <div class="textbox td_200px" id="names_game_category"></div>
        <input type="hidden" id="hidden_game_category" value="" name="hidden_game_category" />
    </div>

    <div style="margin-left: 30px;">納品先検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_delivery_destination" name="input_delivery_destination" class="element"
                style="border:none;" />
            <img class="vector" id="img_delivery_destination" src="/img/icon/vector.svg"
                data-smm-open="search_delivery_destination_modal" />
        </div>
        <div class="textbox td_200px" id="names_delivery_destination"></div>
        <input type="hidden" id="hidden_delivery_destination" value="" name="hidden_delivery_destination" />
    </div>

    <div style="margin-left: 30px;">製品/工賃6検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_item_class_thing6" name="input_item_class_thing6" class="element"
                style="border:none;" />
            <img class="vector" id="img_item_class_thing6" src="/img/icon/vector.svg"
                data-smm-open="search_item_class_thing6_modal" />
        </div>
        <div class="textbox td_200px" id="names_item_class_thing6"></div>
        <input type="hidden" id="hidden_item_class_thing6" value="" name="hidden_item_class_thing6" />
    </div>

    <div style="margin-left: 30px;">請求先コード検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_billing_address" name="input_billing_address" class="element"
                style="border:none;" />
            <img class="vector" id="img_billing_address" src="/img/icon/vector.svg"
                data-smm-open="search_billing_address_modal" />
        </div>
        <div class="textbox td_200px" id="names_billing_address"></div>
        <input type="hidden" id="hidden_billing_address" value="" name="hidden_billing_address" />
    </div>

    <div style="margin-left: 30px;">販売パターン1検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_customer_class1" name="input_customer_class1" class="element"
                style="border:none;" />
            <img class="vector" id="img_customer_class1" src="/img/icon/vector.svg"
                data-smm-open="search_customer_class_thing1_modal" />
        </div>
        <div class="textbox td_200px" id="names_customer_class1"></div>
        <input type="hidden" id="hidden_customer_class1" value="" name="hidden_customer_class1" />
    </div>

    <div style="margin-left: 30px;">販売開始年検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_item_class_thing4" name="input_item_class_thing4" class="element"
                style="border:none;" />
            <img class="vector" id="img_item_class_thing4" src="/img/icon/vector.svg"
                data-smm-open="search_item_class_thing4_modal" />
        </div>
        <div class="textbox td_200px" id="names_item_class_thing4"></div>
        <input type="hidden" id="hidden_item_class_thing4" value="" name="hidden_item_class_thing4" />
    </div>

    <div style="margin-left: 30px;">資産在庫JA検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_item_class_thing7" name="input_item_class_thing7" class="element"
                style="border:none;" />
            <img class="vector" id="img_item_class_thing7" src="/img/icon/vector.svg"
                data-smm-open="search_item_class_thing7_modal" />
        </div>
        <div class="textbox td_200px" id="names_item_class_thing7"></div>
        <input type="hidden" id="hidden_item_class_thing7" value="" name="hidden_item_class_thing7" />
    </div>

    <div style="margin-left: 30px;">運送会社検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_shipping_company" name="input_shipping_company" class="element"
                style="border:none;" />
            <img class="vector" id="img_shipping_company" src="/img/icon/vector.svg"
                data-smm-open="search_shipping_company_modal" />
        </div>
        <div class="textbox td_200px" id="names_shipping_company"></div>
        <input type="hidden" id="hidden_shipping_company" value="" name="hidden_shipping_company" />
    </div>

    <div style="margin-left: 30px;">部門検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_department" name="input_department" class="element" style="border:none;" />
            <img class="vector" id="img_department" src="/img/icon/vector.svg"
                data-smm-open="search_department_modal" />
        </div>
        <div class="textbox td_200px" id="names_department"></div>
        <input type="hidden" id="hidden_department" value="" name="hidden_department" />
    </div>

    <div style="margin-left: 30px;">銀行検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_bank" name="input_bank" class="element" style="border:none;" />
            <img class="vector" id="img_bank" src="/img/icon/vector.svg" data-smm-open="search_bank_modal" />
        </div>
        <div class="textbox td_200px" id="names_bank"></div>
        <input type="hidden" id="hidden_bank" value="" name="hidden_bank" />
    </div>

    <div style="margin-left: 30px;">開拓年分類検索
        <div class="textbox" style="display: flex; gap: 6px; border: solid 2px gray; width:200px;">
            <input type="text" id="input_pioneer" name="input_pioneer" class="element" style="border:none;" />
            <img class="vector" id="img_pioneer" src="/img/icon/vector.svg" data-smm-open="search_pioneer_modal" />
        </div>
        <div class="textbox td_200px" id="names_pioneer"></div>
        <input type="hidden" id="hidden_pioneer" value="" name="hidden_pioneer" />
    </div>

    @include('admin.master.search.ps_kbn', ['defPsKbnData' => $psKbnData])
    @include('admin.master.search.top_free_area', ['topFreeAreaData' => $topFreeAreaData])
    @include('admin.master.search.notice', ['noticeData' => $noticeData])
    @include('admin.master.search.catalog', ['catalogData' => $catalogData])
    @include('admin.master.search.color_pattern', ['colorPatternData' => $colorPatternData])
    @include('admin.master.search.color', ['colorData' => $colorData])
    @include('admin.master.search.size_pattern', ['sizePatternData' => $sizePatternData])
    @include('admin.master.search.size', ['sizeData' => $sizeData])
    @include('admin.master.search.genre', ['genreData' => $genreData])
    @include('admin.master.search.brand1', ['brand1Data' => $brand1Data])
    @include('admin.master.search.rank3', ['rank3Data' => $rank3Data])
    @include('admin.master.search.root', ['rootData' => $rootData])
    @include('admin.master.search.supplier', ['supplierData' => $supplierData])
    @include('admin.master.search.supplier_class1', ['supplierClass1Data' => $supplierClass1Data])
    @include('admin.master.search.supplier_class2', ['supplierClass2Data' => $supplierClass2Data])
    @include('admin.master.search.supplier_class3', ['supplierClass2Data' => $supplierClass2Data])
    @include('admin.master.search.supplier_balance')
    @include('admin.master.search.slip_kind', ['slipKindData' => $slipKindData])
    @include('admin.master.search.warehouse', ['warehouseData' => $warehouseData])
    @include('admin.master.search.item_cd', [
        'itemData' => $itemData,
        'brand1Data' => $brand1Data,
        'itemClassThing2Data' => $itemClassThing2Data,
        'genreData' => $genreData,
        'itemClassThing4Data' => $itemClassThing4Data,
        'itemClassThing5Data' => $itemClassThing5Data,
        'itemClassThing6Data' => $itemClassThing6Data,
        'itemClassThing7Data' => $itemClassThing7Data,
    ])
    @include('admin.master.search.district_class', ['districtClassData' => $districtClassData])
    @include('admin.master.search.item_class_thing5', ['itemClassThing5Data' => $itemClassThing5Data])
    @include('admin.master.search.customer', ['customerData' => $customerData])
    @include('admin.master.search.customer_balance')
    @include('admin.master.search.manager', ['managerData' => $managerData])
    @include('admin.master.search.pay_destination', ['payDestinationData' => $payDestinationData])
    @include('admin.master.search.customer_class_thing2', ['customerClass2Data' => $customerClass2Data])
    @include('admin.master.search.arrival_date', ['arrivalDateData' => $arrivalDateData])
    @include('admin.master.search.tax_rate_kbn', ['taxRateKbnData' => $taxRateKbnData])
    @include('admin.master.search.game_category', ['itemClassThing2Data' => $itemClassThing2Data])
    @include('admin.master.search.delivery_destination', [
        'deliveryDestinationData' => $deliveryDestinationData,
    ])
    @include('admin.master.search.item_class_thing6', ['itemClassThing6Data' => $itemClassThing6Data])
    @include('admin.master.search.billing_address', ['billingAddressData' => $billingAddressData])
    @include('admin.master.search.customer_class_thing1', ['customerClass1Data' => $customerClass1Data])
    @include('admin.master.search.item_class_thing4', ['itemClassThing4Data' => $itemClassThing4Data])
    @include('admin.master.search.item_class_thing7', ['itemClassThing7Data' => $itemClassThing7Data])
    @include('admin.master.search.shipping_company', ['shippingCompanyData' => $shippingCompanyData])
    @include('admin.master.search.department', ['departmentData' => $departmentData])
    @include('admin.master.search.bank', ['bankData' => $bankData])
    @include('admin.master.search.pioneer', ['pioneerData' => $pioneerData])
    </div>
