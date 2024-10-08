@extends('layouts.admin.app')
@section('page_title', '売上チェックリスト')
@section('title', '売上チェックリスト')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('sales_management.sales.checklist.export') }}" method="post">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button class="button" type="submit" name="cancel">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="excel">
                        <div class="text_wrapper_2">EXCELへ出力</div>
                    </button>
                </div>
            </div>
            <div class="element-form element-form-rows">
                <div class="text_wrapper">帳票区分：</div>
                <div class="frame">
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="document_kbn" value="0" checked />
                            伝票単位
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="document_kbn" value="1" />
                            商品単位
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="document_kbn" value="2" />
                            SKU単位（マトリックス）
                        </label>
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper">出力順：</div>
                <div class="frame">
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="sort_order" value="1" checked />
                            入力日付＋処理区分＋売上No.順
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="sort_order" value="2" />
                            伝票日付＋売上No.順
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="sort_order" value="3" />
                            伝票日付＋担当者順
                        </label>
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">対象日付</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" id="calendar1-year" name="year_start" class="element textbox_40px"
                            minlength="0" maxlength="4" value="{{ date('Y') }}">年
                        <input type="text" id="calendar1-month" name="month_start" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ date('m') }}">月
                        <input type="text" id="calendar1-date" name="day_start" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ date('d') }}">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" id="calendar2-year" name="year_end" class="element textbox_40px"
                            minlength="0" maxlength="4" value="{{ date('Y') }}">年
                        <input type="text" id="calendar2-month" name="month_end" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ date('m') }}">月
                        <input type="text" id="calendar2-date" name="day_end" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ date('d') }}">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar2')">
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper">処理区分：</div>
                <div class="frame">
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="process_kbn" value="0" checked />
                            新規伝票
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="process_kbn" value="1" />
                            修正伝票
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="process_kbn" value="2" />
                            すべて
                        </label>
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">入力者コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="user_code_start" id="input_user_start" class="element"
                            minlength="0" maxlength="4" size="4" value="{{ old('manager_code_start', '') }}" />
                        <img class="vector" id="img_user_start" src="/img/icon/vector.svg"
                            data-smm-open="search_manager_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="user_code_end" id="input_user_end" class="element" minlength="0"
                            maxlength="4" size="4" value="{{ old('manager_code_end', '') }}" />
                        <img class="vector" id="img_user_end" src="/img/icon/vector.svg"
                            data-smm-open="search_manager_modal" />
                    </div>
                </div>
                <input type="hidden" id="hidden_user_start" value="" name="hidden_user_start" />
                <input type="hidden" id="hidden_user_end" value="" name="hidden_user_end" />
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">得意先コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="customer_code_start" id="input_customer_start" class="element"
                            minlength="0" maxlength="6" size="6"
                            value="{{ old('customer_code_start', '') }}" />
                        <img class="vector" id="img_customer_start" src="/img/icon/vector.svg"
                            data-smm-open="search_customer_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="customer_code_end" id="input_customer_end" class="element"
                            minlength="0" maxlength="6" size="6" value="{{ old('customer_code_end', '') }}" />
                        <img class="vector" id="img_customer_end" src="/img/icon/vector.svg"
                            data-smm-open="search_customer_modal" />
                    </div>
                    <input type="hidden" id="hidden_customer_start" value="" name="hidden_customer_start" />
                    <input type="hidden" id="hidden_customer_end" value="" name="hidden_customer_end" />
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">担当者コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="manager_code_start" id="input_manager_start" class="element"
                            minlength="0" maxlength="4" size="4" value="{{ old('manager_code_start', '') }}" />
                        <img class="vector" id="img_manager_start" src="/img/icon/vector.svg"
                            data-smm-open="search_manager_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="manager_code_end" id="input_manager_end" class="element"
                            minlength="0" maxlength="4" size="4" value="{{ old('manager_code_end', '') }}" />
                        <img class="vector" id="img_manager_end" src="/img/icon/vector.svg"
                            data-smm-open="search_manager_modal" />
                    </div>
                </div>
                <input type="hidden" id="hidden_manager_start" value="" name="hidden_manager_start" />
                <input type="hidden" id="hidden_manager_end" value="" name="hidden_manager_end" />
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">売上伝票No.範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="slip_kind_no" class="element" minlength="0" maxlength="8"
                            size="8" value="" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="slip_kind_no" class="element" minlength="0" maxlength="8"
                            size="8" value="" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                </div>
            </div><br>
        </div>
    </form>
    @include('admin.master.search.customer', ['customerData' => $customerData])
    @include('admin.master.search.manager', ['managerData' => $managerData])
    @include('admin.common.calendar', ['calendarId' => 'calendar1'])
    @include('admin.common.calendar', ['calendarId' => 'calendar2'])
@endsection
