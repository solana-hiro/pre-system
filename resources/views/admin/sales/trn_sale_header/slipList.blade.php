@extends('layouts.admin.app')
@section('page_title', '売上伝票一括発行')
@section('title', '売上伝票一括発行')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('sales_management.sales.slip.issue.export') }}" method="post">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button class="button" type="submit" name="cancel">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="preview" onclick="this.form.target='_blank'">
                        <div class="text_wrapper_2">プレビューを見る</div>
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
            @endif
            <div class="alert alert-danger">
                <ul id="alert-danger-ul">
            </div>

            <div class="element-form element-form-rows">
                <div class="text_wrapper">ログインID：</div>
                <div class="frame">
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="login_id" value="0" checked />
                            すべて
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="login_id" value="1" />
                            自ログインID分
                        </label>
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">出庫倉庫</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="warehouse_code_start" id="input_warehouse_start" class="element"
                            minlength="0" maxlength="6" size="6" value="{{ old('warehouse_code_start', '') }}" />
                        <img class="vector" id="img_warehouse_start" src="/img/icon/vector.svg"
                            data-smm-open="search_warehouse_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="warehouse_code_end" id="input_warehouse_end" class="element"
                            minlength="0" maxlength="6" size="6" value="{{ old('warehouse_code_end', '') }}" />
                        <img class="vector" id="img_warehouse_end" src="/img/icon/vector.svg"
                            data-smm-open="search_warehouse_modal" />
                    </div>
                    <input type="hidden" id="hidden_warehouse_start" value="" name="hidden_warehouse_start" />
                    <input type="hidden" id="hidden_warehouse_end" value="" name="hidden_warehouse_end" />
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper">発行区分：</div>
                <div class="frame">
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="order_kbn" value="0" />
                            未発行
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="order_kbn" value="1" />
                            発行済
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="order_kbn" value="2" checked />
                            すべて
                        </label>
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">売上更新日付</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="update_year_start" id="calendar1-year" class="element textbox_40px"
                            minlength="0" maxlength="4" value="{{ old('update_year_start', date('Y')) }}">年
                        <input type="text" name="update_month_start" id="calendar1-month"
                            class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ old('update_month_start', date('m')) }}">月
                        <input type="text" name="update_day_start" id="calendar1-day" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ old('update_day_start', date('d')) }}">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="update_year_end" id="calendar2-year" class="element textbox_40px"
                            minlength="0" maxlength="4" value="{{ old('update_year_end', date('Y')) }}">年
                        <input type="text" name="update_month_end" id="calendar2-month" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ old('update_month_end', date('m')) }}">月
                        <input type="text" name="update_day_end" id="calendar2-day" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ old('update_day_end', date('d')) }}">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar2')">
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">売上伝票日付</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="slip_year_start" id="calendar3-year" class="element textbox_40px"
                            minlength="0" maxlength="4" value="{{ old('slip_year_start', date('Y')) }}">年
                        <input type="text" name="slip_month_start" id="calendar3-month" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ old('slip_month_start', date('m')) }}">月
                        <input type="text" name="slip_day_start" id="calendar3-day" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ old('slip_day_start', date('d')) }}">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar3')">
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="slip_year_end" id="calendar4-year" class="element textbox_40px"
                            minlength="0" maxlength="4" value="{{ old('slip_year_end', date('Y')) }}">年
                        <input type="text" name="slip_month_end" id="calendar4-month" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ old('slip_month_end', date('m')) }}">月
                        <input type="text" name="slip_day_end" id="calendar4-day" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ old('slip_day_end', date('d')) }}">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar4')">
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">伝票No.範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="slip_no_start" class="element" minlength="0" maxlength="8"
                            size="8" value="{{ old('slip_no_start', '') }}" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="slip_no_end" class="element" minlength="0" maxlength="8"
                            size="8" value="{{ old('slip_no_end', '') }}" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                </div>
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
            </div>
        </div>
    </form>
    @include('admin.master.search.warehouse', ['warehouseData' => $warehouseData])
    @include('admin.master.search.customer', ['customerData' => $customerData])
    @include('admin.common.calendar', ['calendarId' => 'calendar1'])
    @include('admin.common.calendar', ['calendarId' => 'calendar2'])
    @include('admin.common.calendar', ['calendarId' => 'calendar3'])
    @include('admin.common.calendar', ['calendarId' => 'calendar4'])
@endsection
