@extends('layouts.admin.app')
@section('page_title', '会社情報')
@section('title', '会社情報')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <div class="main-area">
        <form role="search" action="{{ route('system.environment.company.update') }}" method="post">
            @csrf
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value="" class="button-2"
                        data-url="" name="update2">
                        <div class="text_wrapper_3">登録する</div>
                    </button>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif (Session::has('sessionErrors'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach (session('sessionErrors') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif (Session::has('flashmessage'))
                @include('components.modal.message', ['flashmessage' => session('flashmessage')])
            @elseif (Session::has('errormessage'))
                @include('components.modal.error', ['errormessage' => session('errormessage')])
            @endif
            <div class="alert alert-danger">
                <ul id="alert-danger-ul">
            </div>

            <div class="main_area">
                <div class="sub_contents">
                    <div class="left_contents">
                        <div class="box">
                            <div class="element-form-rows">
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper td_60px txt_required grid_wrapper_right">正式名称</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            <input type="text" name="corp_name" class="element" minlength="0"
                                                maxlength="30" size="30"
                                                value="{{ old('corp_name', $initData['corp_name']) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="element-form-rows">
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper td_60px txt_required grid_wrapper_right">略称</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            <input type="text" name="corp_name_abbreviation" class="element"
                                                minlength="0" maxlength="30" size="30"
                                                value="{{ old('corp_name_abbreviation', $initData['corp_name_abbreviation']) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="element-form-rows">
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper td_60px txt_required grid_wrapper_right">カナ</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            <input type="text" name="corp_name_kana" class="element" minlength="0"
                                                maxlength="30" size="30"
                                                value="{{ old('corp_name_kana', $initData['corp_name_kana']) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="element-form-rows">
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper td_60px txt_required grid_wrapper_right">郵便番号</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            <input type="text" id="zip" name="post_number" class="element"
                                                minlength="0" maxlength="8" size="8"
                                                value="{{ old('post_number', $initData['post_number']) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="element-form-rows">
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper td_60px txt_required grid_wrapper_right">住所</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            <input type="text" name="address_1" id="address" class="element"
                                                minlength="0" maxlength="90" size="40"
                                                value="{{ old('address_1', $initData['address_1']) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="element-form-rows">
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper td_60px grid_wrapper_right">電話番号</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            <input type="text" name="tel" class="element" minlength="0"
                                                maxlength="15" size="15"
                                                value="{{ old('tel', $initData['tel']) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="element-form-rows">
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper td_60px grid_wrapper_right">FAX番号</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            <input type="text" name="fax" class="element" minlength="0"
                                                maxlength="15" size="15"
                                                value="{{ old('fax', $initData['fax']) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="element-form-rows">
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper">代表者職氏名</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            <input type="text" name="representative_name" class="element"
                                                minlength="0" maxlength="30" size="30"
                                                value="{{ old('representative_name', $initData['representative_name']) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="element-form-rows">
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper">担当者職氏名</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            <input type="text" name="manager_name" class="element" minlength="0"
                                                maxlength="30" size="30"
                                                value="{{ old('manager_name', $initData['manager_name']) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="element-form-rows">
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper td_60px grid_wrapper_right">備考1</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            <input type="text" name="memo_1" class="element" minlength="0"
                                                maxlength="100" size="40"
                                                value="{{ old('memo_1', $initData['memo_1']) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="element-form-rows">
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper td_60px grid_wrapper_right">備考2</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            <input type="text" name="memo_2" class="element" minlength="0"
                                                maxlength="100" size="40"
                                                value="{{ old('memo_2', $initData['memo_2']) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <div class="element-form-rows">
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper td_60px grid_wrapper_right">備考3</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            <input type="text" name="memo_3" class="element" minlength="0"
                                                maxlength="100" size="40"
                                                value="{{ old('memo_3', $initData['memo_3']) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sub_title">在庫掛率</div>
                            <div class="element-form-columns">
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper td_100px grid_wrapper_right">1年未満在庫掛率</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            <input type="text" name="1_year_less_than_stock_rate"
                                                class="element align-right" minlength="0" maxlength="6" size="4"
                                                value="{{ old('1_year_less_than_stock_rate', $initData['1_year_less_than_stock_rate']) }}" />
                                        </div>
                                        %
                                    </div>
                                </div><br>
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper td_100px grid_wrapper_right">1年前在庫掛率</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            <input type="text" name="1_year_before_stock_rate"
                                                class="element align-right" minlength="0" maxlength="6" size="4"
                                                value="{{ old('1_year_before_stock_rate', $initData['1_year_before_stock_rate']) }}" />
                                        </div>
                                        %
                                    </div>
                                </div><br>
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper td_100px grid_wrapper_right">2年前在庫掛率</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            <input type="text" name="2_year_before_stock_rate"
                                                class="element align-right" minlength="0" maxlength="6" size="4"
                                                value="{{ old('2_year_before_stock_rate', $initData['2_year_before_stock_rate']) }}" />
                                        </div>
                                        %
                                    </div>
                                </div><br>
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper td_100px grid_wrapper_right">3年前在庫掛率</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            <input type="text" name="3_year_before_stock_rate"
                                                class="element align-right" minlength="0" maxlength="6" size="4"
                                                value="{{ old('3_year_before_stock_rate', $initData['3_year_before_stock_rate']) }}" />
                                        </div>
                                        %
                                    </div>
                                </div><br>
                                <div class="element-form element-form-rows">
                                    <div class="text_wrapper td_100px grid_wrapper_right">4年前在庫掛率</div>
                                    <div class="frame">
                                        <div class="textbox">
                                            <input type="text" name="4_year_before_stock_rate"
                                                class="element align-right" minlength="0" maxlength="6" size="4"
                                                value="{{ old('4_year_before_stock_rate', $initData['4_year_before_stock_rate']) }}" />
                                        </div>
                                        %
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right_contents">
                        <div class="box">
                            <div class="element-form">
                                <input id="basic" type="radio" name="tab_item" checked>
                                <label class="tab_item" for="basic">システム基本情報</label>
                                <input id="shipping" type="radio" name="tab_item">
                                <label class="tab_item" for="shipping">出荷関連設定</label>
                                <input id="ec" type="radio" name="tab_item">
                                <label class="tab_item" for="ec">EC設定</label>
                                <div class="tab_content" id="basic_content">
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_120px grid_wrapper_right">決算月日</div>
                                        <div class="frame">
                                            <div class="textbox">
                                                <input type="text" name="settlement_month_date" class="element"
                                                    minlength="0" maxlength="4" size="4"
                                                    value="{{ old('settlement_month_date', $initData['settlement_month_date']) }}" />
                                            </div>
                                            <div class="text_wrapper">前2桁:月&nbsp;&nbsp;&nbsp;後2桁:日(99:末日)</div>
                                        </div>
                                    </div><br>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_120px grid_wrapper_right">在庫評価方法</div>
                                        <div class="frame">
                                            <div class="textbox">
                                                <input type="text" name="stock_evaluation_method" class="element"
                                                    minlength="0" maxlength="3" size="3"
                                                    value="{{ old('stock_evaluation_method', $initData['stock_evaluation_method']) }}" />
                                            </div>
                                            <div class="text_wrapper">
                                                0:標準原価&nbsp;&nbsp;&nbsp;1:総平均&nbsp;&nbsp;&nbsp;2:最終仕入<br>3:月次総平均&nbsp;&nbsp;&nbsp;4:月次総平均(原価更新あり)
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_120px grid_wrapper_right">売買掛消費税区分</div>
                                        <div class="frame">
                                            <div class="textbox">
                                                <input type="text" name="accounts_receivable_payable_tax_kbn"
                                                    class="element" minlength="0" maxlength="3" size="3"
                                                    value="{{ old('accounts_receivable_payable_tax_kbn', $initData['accounts_receivable_payable_tax_kbn']) }}" />
                                            </div>
                                            <div class="text_wrapper">0:請求(支払)時&nbsp;&nbsp;&nbsp;1:売掛(買掛)時</div>
                                        </div>
                                    </div>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_120px grid_wrapper_right">売上単価採用区分</div>
                                        <div class="frame">
                                            <div class="textbox">
                                                <input type="text" name="sale_price_adoption_kbn" class="element"
                                                    minlength="0" maxlength="3" size="3"
                                                    value="{{ old('sale_price_adoption_kbn', $initData['sale_price_adoption_kbn']) }}" />
                                            </div>
                                            <div class="text_wrapper">
                                                0:特商単価&nbsp;&nbsp;&nbsp;1:ランク別&nbsp;&nbsp;&nbsp;2:上代単価</div>
                                        </div>
                                    </div>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_120px grid_wrapper_right">明細保存期間(月)</div>
                                        <div class="frame">
                                            <div class="textbox">
                                                <input type="text" name="detail_keep_period_month" class="element"
                                                    minlength="0" maxlength="2" size="2"
                                                    value="{{ old('detail_keep_period_month', $initData['detail_keep_period_month']) }}" />
                                            </div>
                                            <div class="text_wrapper">トラン保存期間(月次更新用)</div>
                                        </div>
                                    </div>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_120px grid_wrapper_right">サマリ保存期間(年)</div>
                                        <div class="frame">
                                            <div class="textbox">
                                                <input type="text" name="summary_keep_period_year" class="element"
                                                    minlength="0" maxlength="2" size="2"
                                                    value="{{ old('summary_keep_period_year', $initData['summary_keep_period_year']) }}" />
                                            </div>
                                            <div class="text_wrapper">サマリ保存期間(年次更新用)</div>
                                        </div>
                                    </div>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_120px grid_wrapper_right">運用開始日</div>
                                        <div class="frame">
                                            <div class="textbox">
                                                <input type="text" id="calendar1-year"
                                                    name="operation_start_date_year" class="element textbox_40px"
                                                    minlength="0" maxlength="4"
                                                    value="{{ old('operation_start_date_year', isset($initData['operation_start_date']) ? \Carbon\Carbon::createFromFormat('Y-m-d', $initData['operation_start_date'])->format('Y') : '') }}">年
                                                <input type="text" id="calendar1-month"
                                                    name="operation_start_date_month" class="element textbox_24px"
                                                    minlength="0" maxlength="2"
                                                    value="{{ old('release_start_date_month', isset($initData['operation_start_date']) ? \Carbon\Carbon::createFromFormat('Y-m-d', $initData['operation_start_date'])->format('m') : '') }}">月
                                                <input type="text" id="calendar1-date" name="operation_start_date_day"
                                                    class="element textbox_24px" minlength="0" maxlength="2"
                                                    value="{{ old('release_start_date_day', isset($initData['operation_start_date']) ? \Carbon\Carbon::createFromFormat('Y-m-d', $initData['operation_start_date'])->format('d') : '') }}">日
                                                <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_120px grid_wrapper_right">月次更新実行日</div>
                                        <div class="frame">
                                            <div class="textbox">
                                                <input type="text" id="calendar2-year"
                                                    name="month_update_execution_date_year" class="element textbox_40px"
                                                    minlength="0" maxlength="4"
                                                    value="{{ old('month_update_execution_date_year', isset($initData['month_update_execution_date']) ? \Carbon\Carbon::createFromFormat('Y-m-d', $initData['month_update_execution_date'])->format('Y') : '') }}">年
                                                <input type="text" id="calendar2-month"
                                                    name="month_update_execution_date_month" class="element textbox_24px"
                                                    minlength="0" maxlength="2"
                                                    value="{{ old('month_update_execution_date_month', isset($initData['month_update_execution_date']) ? \Carbon\Carbon::createFromFormat('Y-m-d', $initData['month_update_execution_date'])->format('m') : '') }}">月
                                                <input type="text" id="calendar2-date"
                                                    name="month_update_execution_date_day" class="element textbox_24px"
                                                    minlength="0" maxlength="2"
                                                    value="{{ old('month_update_execution_date_day', isset($initData['month_update_execution_date']) ? \Carbon\Carbon::createFromFormat('Y-m-d', $initData['month_update_execution_date'])->format('d') : '') }}">日
                                                <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar2')">
                                            </div>
                                        </div>
                                        <div class="element-form element-form-rows">
                                            <div class="text_wrapper td_100px grid_wrapper_right">業種コード</div>
                                            <div class="frame">
                                                <div class="textbox">
                                                    <input type="text" name="industry_cd" class="element"
                                                        minlength="0" maxlength="8" size="1"
                                                        value="{{ old('industry_cd', $initData['industry_cd']) }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_120px grid_wrapper_right">年次更新実行日</div>
                                        <div class="frame">
                                            <div class="textbox">
                                                <input type="text" id="calendar3-year"
                                                    name="year_update_execution_date_year" class="element textbox_40px"
                                                    minlength="0" maxlength="4"
                                                    value="{{ old('year_update_execution_date_year', isset($initData['year_update_execution_date']) ? \Carbon\Carbon::createFromFormat('Y-m-d', $initData['year_update_execution_date'])->format('Y') : '') }}">年
                                                <input type="text" id="calendar3-month"
                                                    name="year_update_execution_date_month" class="element textbox_24px"
                                                    minlength="0" maxlength="2"
                                                    value="{{ old('year_update_execution_date_month', isset($initData['year_update_execution_date']) ? \Carbon\Carbon::createFromFormat('Y-m-d', $initData['year_update_execution_date'])->format('m') : '') }}">月
                                                <input type="text" id="calendar3-date"
                                                    name="year_update_execution_date_day" class="element textbox_24px"
                                                    minlength="0" maxlength="2"
                                                    value="{{ old('year_update_execution_date_day', isset($initData['year_update_execution_date']) ? \Carbon\Carbon::createFromFormat('Y-m-d', $initData['year_update_execution_date'])->format('d') : '') }}">日
                                                <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar3')">
                                            </div>
                                        </div>
                                        <div class="element-form element-form-rows">
                                            <div class="text_wrapper td_100px grid_wrapper_right">バージョン</div>
                                            <div class="textbox">
                                                <input type="text" name="version" class="element" minlength="0"
                                                    maxlength="10" size="10"
                                                    value="{{ old('version', $initData['version']) }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_content" id="shipping_content">
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_160px grid_wrapper_right">按分方式：</div>
                                        <div class="frame">
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id=""
                                                        name="shipping_apportionment_method" value="0"
                                                        @if (old(
                                                                'shipping_apportionment_method',
                                                                isset($initData['shipping_apportionment_method']) ? $initData['shipping_apportionment_method'] : 0) == 0) checked @endif />
                                                    単純按分
                                                </label>
                                            </div>
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id=""
                                                        name="shipping_apportionment_method" value="1"
                                                        @if (old(
                                                                'shipping_apportionment_method',
                                                                isset($initData['shipping_apportionment_method']) ? $initData['shipping_apportionment_method'] : 0) == 1) checked @endif />
                                                    全数按分
                                                </label>
                                            </div>
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id=""
                                                        name="shipping_apportionment_method" value="2"
                                                        @if (old(
                                                                'shipping_apportionment_method',
                                                                isset($initData['shipping_apportionment_method']) ? $initData['shipping_apportionment_method'] : 0) == 2) checked @endif />
                                                    比較按分
                                                </label>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_160px grid_wrapper_right">販売可能数初期表示：</div>
                                        <div class="frame">
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id=""
                                                        name="marketing_possible_quantity_initial_display" value="0"
                                                        @if (old(
                                                                'marketing_possible_quantity_initial_display',
                                                                isset($initData['marketing_possible_quantity_initial_display'])
                                                                    ? $initData['marketing_possible_quantity_initial_display']
                                                                    : 0) == 0) checked @endif />
                                                    表示
                                                </label>
                                            </div>
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id=""
                                                        name="marketing_possible_quantity_initial_display" value="1"
                                                        @if (old(
                                                                'marketing_possible_quantity_initial_display',
                                                                isset($initData['marketing_possible_quantity_initial_display'])
                                                                    ? $initData['marketing_possible_quantity_initial_display']
                                                                    : 0) == 1) checked @endif />
                                                    非表示
                                                </label>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_160px grid_wrapper_right">出荷数量初期値：</div>
                                        <div class="frame">
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id=""
                                                        name="shipping_quantity_initial_display" value="0"
                                                        @if (old(
                                                                'shipping_quantity_initial_display',
                                                                isset($initData['shipping_quantity_initial_display']) ? $initData['shipping_quantity_initial_display'] : 0) == 0) checked @endif />
                                                    ゼロ
                                                </label>
                                            </div>
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id=""
                                                        name="shipping_quantity_initial_display" value="1"
                                                        @if (old(
                                                                'shipping_quantity_initial_display',
                                                                isset($initData['shipping_quantity_initial_display']) ? $initData['shipping_quantity_initial_display'] : 0) == 1) checked @endif />
                                                </label>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_160px grid_wrapper_right">代表倉庫</div>
                                        <div class="frame">
                                            <div class="textbox">
                                                <input type="text" name="warehouse_cd" class="element" minlength="0"
                                                    maxlength="6" size="6"
                                                    value="{{ old('warehouse_cd', $initData['warehouse_cd']) }}" />
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_160px grid_wrapper_right">振分可能数量入力区分：</div>
                                        <div class="frame">
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id=""
                                                        name="apportionment_possible_quantity_input_kbn" value="0"
                                                        @if (old(
                                                                'apportionment_possible_quantity_input_kbn',
                                                                isset($initData['apportionment_possible_quantity_input_kbn'])
                                                                    ? $initData['apportionment_possible_quantity_input_kbn']
                                                                    : 0) == 0) checked @endif />
                                                    使用する
                                                </label>
                                            </div>
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id=""
                                                        name="apportionment_possible_quantity_input_kbn" value="1"
                                                        @if (old(
                                                                'apportionment_possible_quantity_input_kbn',
                                                                isset($initData['apportionment_possible_quantity_input_kbn'])
                                                                    ? $initData['apportionment_possible_quantity_input_kbn']
                                                                    : 0) == 1) checked @endif />
                                                    使用しない
                                                </label>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_160px grid_wrapper_right">指示可能数量入力区分：</div>
                                        <div class="frame">
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id=""
                                                        name="instruction_possible_quantity_input_kbn" value="0"
                                                        @if (old(
                                                                'instruction_possible_quantity_input_kbn',
                                                                isset($initData['instruction_possible_quantity_input_kbn'])
                                                                    ? $initData['instruction_possible_quantity_input_kbn']
                                                                    : 0) == 0) checked @endif />
                                                    使用する
                                                </label>
                                            </div>
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id=""
                                                        name="instruction_possible_quantity_input_kbn" value="1"
                                                        @if (old(
                                                                'instruction_possible_quantity_input_kbn',
                                                                isset($initData['instruction_possible_quantity_input_kbn'])
                                                                    ? $initData['instruction_possible_quantity_input_kbn']
                                                                    : 0) == 1) checked @endif />
                                                    使用しない
                                                </label>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_160px grid_wrapper_right">ハンディ採用区分：</div>
                                        <div class="frame">
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id="" name="handy_adoption_kbn"
                                                        value="0"
                                                        @if (old('handy_adoption_kbn', isset($initData['handy_adoption_kbn']) ? $initData['handy_adoption_kbn'] : 0) == 0) checked @endif />
                                                    売掛
                                                </label>
                                            </div>
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id="" name="handy_adoption_kbn"
                                                        value="1"
                                                        @if (old('handy_adoption_kbn', isset($initData['handy_adoption_kbn']) ? $initData['handy_adoption_kbn'] : 0) == 1) checked @endif />
                                                    現金
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sub_title">JANコード</div>
                                    <div class="element-form element-form-rows" style="margin-left: 2em">
                                        <div class="text_wrapper">&nbsp;開始JAN</div>
                                        <div class="textbox">
                                            <input type="text" name="start_jan_code" class="element" minlength="0"
                                                maxlength="12" size="12"
                                                value="{{ old('start_jan_code', $initData['start_jan_code']) }}" />
                                        </div>
                                    </div><br />
                                    <div class="element-form element-form-rows" style="margin-left: 2em">
                                        <div class="text_wrapper">&nbsp;終了JAN</div>
                                        <div class="textbox">
                                            <input type="text" name="end_jan_code" class="element" minlength="0"
                                                maxlength="12" size="12"
                                                value="{{ old('end_jan_code', $initData['end_jan_code']) }}" />
                                        </div>
                                    </div><br />
                                    <div class="element-form element-form-rows" style="margin-left: 2em">
                                        <div class="text_wrapper">&nbsp;現在JAN</div>
                                        <div class="textbox">
                                            <input type="text" name="now_jan_code" class="element" minlength="0"
                                                maxlength="12" size="12"
                                                value="{{ old('now_jan_code', $initData['now_jan_code']) }}" />
                                        </div>
                                    </div>
                                    <div class="sub_title">バーコード発行機能</div>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_100px grid_wrapper_right">発注：</div>
                                        <div class="frame">
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id="" name="barcode_issue_order"
                                                        value="0"
                                                        @if (old('barcode_issue_order', isset($initData['barcode_issue_order']) ? $initData['barcode_issue_order'] : 0) == 0) checked @endif />
                                                    使用する
                                                </label>
                                            </div>
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id="" name="barcode_issue_order"
                                                        value="1"
                                                        @if (old('barcode_issue_order', isset($initData['barcode_issue_order']) ? $initData['barcode_issue_order'] : 0) == 1) checked @endif />
                                                    使用しない
                                                </label>
                                            </div>
                                        </div>
                                    </div><br />
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_100px grid_wrapper_right">&emsp;仕入：</div>
                                        <div class="frame">
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id="" name="barcode_issue_purchase"
                                                        value="0"
                                                        @if (old(
                                                                'barcode_issue_purchase',
                                                                isset($initData['barcode_issue_purchase']) ? $initData['barcode_issue_purchase'] : 0) == 0) checked @endif />
                                                    使用する
                                                </label>
                                            </div>
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id="" name="barcode_issue_purchase"
                                                        value="1"
                                                        @if (old(
                                                                'barcode_issue_purchase',
                                                                isset($initData['barcode_issue_purchase']) ? $initData['barcode_issue_purchase'] : 0) == 1) checked @endif />
                                                    使用しない
                                                </label>
                                            </div>
                                        </div>
                                    </div><br />
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_100px grid_wrapper_right">入出庫：</div>
                                        <div class="frame">
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id="" name="barcode_issue_in_out"
                                                        value="0"
                                                        @if (old('barcode_issue_in_out', isset($initData['barcode_issue_in_out']) ? $initData['barcode_issue_in_out'] : 0) == 0) checked @endif />
                                                    使用する
                                                </label>
                                            </div>
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id="" name="barcode_issue_in_out"
                                                        value="1"
                                                        @if (old('barcode_issue_in_out', isset($initData['barcode_issue_in_out']) ? $initData['barcode_issue_in_out'] : 0) == 1) checked @endif />
                                                    使用しない
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_content" id="ec_content">
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper">ECサイトオープン状態：</div>
                                        <div class="frame">
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id="" name="ecsite_open_situation"
                                                        value="0"
                                                        @if (old('ecsite_open_situation', isset($initData['ecsite_open_situation']) ? $initData['ecsite_open_situation'] : 0) ==
                                                                0) checked @endif />
                                                    オープン
                                                </label>
                                            </div>
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id="" name="ecsite_open_situation"
                                                        value="1"
                                                        @if (old('ecsite_open_situation', isset($initData['ecsite_open_situation']) ? $initData['ecsite_open_situation'] : 0) ==
                                                                1) checked @endif />
                                                    メンテナンス
                                                </label>
                                            </div>
                                        </div>
                                    </div><br><br>
                                    <div class="element-form-rows">
                                        <div class="element-form element-form-columns">
                                            <div class="text_wrapper">メンテナンス本文</div>
                                            <div class="frame">
                                                <textarea id="" name="maintenance_text" rows="10" cols="80" class="textarea">{{ old('maintenance_text', $initData['maintenance_text']) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sub_title">クレジット決済情報</div>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper">決済方法名</div>
                                        <div class="textbox">
                                            <input type="text" name="settlement_method_name" class="element"
                                                minlength="0" maxlength="30" size="20"
                                                value="{{ old('settlement_method_name', $initData['settlement_method_name']) }}" />
                                        </div>
                                    </div><br><br>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper">表示フラグ</div>
                                        <div class="frame">
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id="" name="display_flg"
                                                        value="0"
                                                        @if (old('display_flg', isset($initData['display_flg']) ? $initData['display_flg'] : 0) == 0) checked @endif />
                                                    表示
                                                </label>
                                            </div>
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id="" name="display_flg"
                                                        value="1"
                                                        @if (old('display_flg', isset($initData['display_flg']) ? $initData['display_flg'] : 0) == 1) checked @endif />
                                                    非表示
                                                </label>
                                            </div>
                                        </div>
                                    </div><br><br>
                                    <div class="element-form-rows">
                                        <div class="element-form element-form-columns">
                                            <div class="text_wrapper">説明文</div>
                                            <div class="frame">
                                                <textarea id="" name="explanatory_text" rows="10" cols="80" class="textarea">{{ old('explanatory_text', $initData['explanatory_text']) }}</textarea>
                                            </div>
                                        </div>
                                    </div><br><br>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_140px grid_wrapper_right">ショップID</div>
                                        <div class="textbox">
                                            <input type="text" name="shop_id" class="element" minlength="0"
                                                maxlength="20" size="20"
                                                value="{{ old('shop_id', $initData['shop_id']) }}" />
                                        </div>
                                    </div><br>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_140px grid_wrapper_right">ショップパスワード</div>
                                        <div class="textbox">
                                            <input type="text" name="shop_password" class="element" minlength="0"
                                                maxlength="20" size="20"
                                                value="{{ old('shop_password', $initData['shop_password']) }}" />
                                        </div>
                                    </div><br>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_140px grid_wrapper_right">3Dセキュア表示店舗名</div>
                                        <div class="textbox">
                                            <input type="text" name="3dsecure_display_store_name" class="element"
                                                minlength="0" maxlength="20" size="20"
                                                value="{{ old('3dsecure_display_store_name', $initData['3dsecure_display_store_name']) }}" />
                                        </div>
                                    </div><br>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_140px grid_wrapper_right">トークン変換APIキー</div>
                                        <div class="textbox">
                                            <input type="text" name="token_conversion_api_key" class="element"
                                                minlength="0" maxlength="20" size="20"
                                                value="{{ old('token_conversion_api_key', $initData['token_conversion_api_key']) }}" />
                                        </div>
                                    </div><br>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_140px grid_wrapper_right">サイトID</div>
                                        <div class="textbox">
                                            <input type="text" name="site_id" class="element" minlength="0"
                                                maxlength="20" size="20"
                                                value="{{ old('site_id', $initData['site_id']) }}" />
                                        </div>
                                    </div><br>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_140px grid_wrapper_right">サイトパスワード</div>
                                        <div class="textbox">
                                            <input type="text" name="site_password" class="element" minlength="0"
                                                maxlength="20" size="20"
                                                value="{{ old('site_password', $initData['site_password']) }}" />
                                        </div>
                                    </div><br>
                                    <div class="element-form element-form-rows">
                                        <div class="text_wrapper td_140px grid_wrapper_right">クレジット決済接続先</div>
                                        <div class="frame">
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id="" name="access_point"
                                                        value="0"
                                                        @if (old('access_point', isset($initData['access_point']) ? $initData['access_point'] : 0) == 0) checked @endif />
                                                    テスト環境
                                                </label>
                                            </div>
                                            <div class="div">
                                                <label class="text_wrapper_1">
                                                    <input type="radio" id="" name="access_point"
                                                        value="1"
                                                        @if (old('access_point', isset($initData['access_point']) ? $initData['access_point'] : 0) == 1) checked @endif />
                                                    本番環境
                                                </label>
                                            </div>
                                        </div>
                                    </div><br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="update_id" value="{{ $initData['id'] }}">

            <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
            <button type="submit" id="update" name="update" class="display_none_all"></button>
            <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
        </form>
        @include('admin.common.calendar', ['calendarId' => 'calendar1'])
        @include('admin.common.calendar', ['calendarId' => 'calendar2'])
        @include('admin.common.calendar', ['calendarId' => 'calendar3'])
    </div>
@endsection
