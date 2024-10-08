@extends('layouts.admin.app')
@section('page_title', 'SAMPLE')
@section('title', 'SAMPLE')
@section('description', '')
@section('keywords', '')
@section('canonical', '')


@section('content')
    <a href="#ps_kbn" id="ps_kbn_search" style="color: red;">PS区分検索</a><br>
    @component('components.search.ps_kbn')
    @endcomponent

    <a href="#top_free_area" style="color: red;">TOP自由領域コード検索</a><br>
    @component('components.search.top_free_area')
    @endcomponent

    <a href="#notice" style="color: red;">お知らせ検索</a><br>
    @component('components.search.notice')
    @endcomponent

    <a href="#catalog" style="color: red;">カタログ検索</a><br>
    @component('components.search.catalog')
    @endcomponent

    <a href="#color_pattern" style="color: red;">カラーパターン検索</a><br>
    @component('components.search.color_pattern')
    @endcomponent

    <a href="#color" style="color: red;">カラー検索</a><br>
    @component('components.search.color')
    @endcomponent

    <a href="#size_pattern" style="color: red;">サイズパターン検索</a><br>
    @component('components.search.size_pattern')
    @endcomponent

    <a href="#size" style="color: red;">サイズ検索</a><br>
    @component('components.search.size')
    @endcomponent

    <a href="#genre" style="color: red;">ジャンル検索</a><br>
    @component('components.search.genre')
    @endcomponent

    <a href="#brand1" style="color: red;">ブランド1検索</a><br>
    @component('components.search.brand1')
    @endcomponent

    <a href="#rank3" style="color: red;">ランク3検索</a><br>
    @component('components.search.rank3')
    @endcomponent

    <a href="#component" style="color: red;">ルート検索</a><br>
    @component('components.search.component')
    @endcomponent

    <a href="#supplier" style="color: red;">仕入先コード検索</a><br>
    @component('components.search.supplier')
    @endcomponent

    <a href="#supplier_class1" style="color: red;">仕入先分類1検索</a><br>
    @component('components.search.supplier_class1')
    @endcomponent

    <a href="#supplier_class2" style="color: red;">仕入先分類2検索	</a><br>
    @component('components.search.supplier_class2')
    @endcomponent

    <a href="#supplier_class3" style="color: red;">仕入先分類3検索</a><br>
    @component('components.search.supplier_class3')
    @endcomponent

    <a href="#supplier_balance" style="color: red;">仕入先残高検索</a><br>
    @component('components.search.supplier_balance')
    @endcomponent

    <a href="#slip_kind" style="color: red;">伝票種別検索</a><br>
    @component('components.search.slip_kind')
    @endcomponent

    <a href="#warehouse" style="color: red;">倉庫検索</a><br>
    @component('components.search.warehouse')
    @endcomponent

    <a href="#item_cd" style="color: red;">商品コード検索</a><br>
    @component('components.search.item_cd')
    @endcomponent

    <a href="#district_class" style="color: red;">地区分類検索</a><br>
    @component('components.search.district_class')
    @endcomponent

    <a href="#firm_class" style="color: red;">工場分類5検索</a><br>
    @component('components.search.firm_class')
    @endcomponent

    <a href="#customer_cd" style="color: red;">得意先コード検索</a><br>
    @component('components.search.customer_cd')
    @endcomponent

    <a href="#customer_balance" style="color: red;">得意先残高検索</a><br>
    @component('components.search.customer_balance')
    @endcomponent

    <a href="#manager" style="color: red;">担当者検索</a><br>
    @component('components.search.manager')
    @endcomponent

    <a href="#pay" style="color: red;">支払先コード検索</a><br>
    @component('components.search.pay')
    @endcomponent

    <a href="#customer_class2" style="color: red;">業種・特徴2検索</a><br>
    @component('components.search.customer_class2')
    @endcomponent

    <a href="#arrival_date" style="color: red;">着日検索</a><br>
    @component('components.search.arrival_date')
    @endcomponent

    <a href="#search.tax_rate" style="color: red;">税率区分検索</a><br>
    @component('components.search.search.tax_rate')
    @endcomponent

    <a href="#game_category" style="color: red;">競技・カテゴリ検索</a><br>
    @component('components.search.game_category')
    @endcomponent

    <a href="#delivery_destination" style="color: red;">納品先検索</a><br>
    @component('components.search.delivery_destination')
    @endcomponent

    <a href="#item_class6" style="color: red;">製品／工賃6検索</a><br>
    @component('components.search.item_class6')
    @endcomponent

    <a href="#billing_address" style="color: red;">請求先コード検索</a><br>
    @component('components.search.billing_address')
    @endcomponent

    <a href="#marketing_pattern1" style="color: red;">販売パターン1検索</a><br>
    @component('components.search.marketing_pattern1')
    @endcomponent

    <a href="#marketing_start_year" style="color: red;">販売開始年検索</a><br>
    @component('components.search.marketing_start_year')
    @endcomponent

    <a href="#item_class7" style="color: red;">資産在庫JA検索</a><br>
    @component('components.search.item_class7')
    @endcomponent

    <a href="#shipping_company" style="color: red;">運送会社検索</a><br>
    @component('components.search.shipping_company')
    @endcomponent

    <a href="#department" style="color: red;">部門検索</a><br>
    @component('components.search.department')
    @endcomponent

    <a href="#bank" style="color: red;">銀行検索</a><br>
    @component('components.search.bank')
    @endcomponent

    <a href="#pioneer" style="color: red;">開拓年分類検索</a><br>
    @component('components.search.pioneer')
    @endcomponent

@endsection
