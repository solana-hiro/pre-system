@extends('layouts.admin.app')
@section('page_title', '得意先元帳')
@section('title', '得意先元帳')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('sales_management.accounts_receivable.customer_ledger.export') }}" method="post">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button class="div-wrapper" name="excel">
                        <div class="text_wrapper_2">Excelへ出力</div>
                    </button>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-da nger">
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

            <div class="element-form element-form-rows">
                <div class="text_wrapper label txt_required">対象伝票日付</div>
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
                        <input type="text" id="calendar2-date" name="day_end" class="element textbox_24px" minlength="0"
                            maxlength="2" value="{{ date('d') }}">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar2')">
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label txt_required">請求先コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="billing_address_code_start" id="input_billing_address_start"
                            class="element" minlength="0" maxlength="6" size="6"
                            value="{{ old('code_start', '') }}" />
                        <img class="vector" id="img_billing_address_start" src="/img/icon/vector.svg"
                            data-smm-open="search_billing_address_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="billing_address_code_end" id="input_billing_address_end" class="element"
                            minlength="0" maxlength="6" size="6" value="{{ old('code_end', '') }}" />
                        <img class="vector" id="img_billing_address_end" src="/img/icon/vector.svg"
                            data-smm-open="search_billing_address_modal" />
                    </div>
                    <input type="hidden" id="hidden_billing_address_start" value=""
                        name="hidden_billing_address_start" />
                    <input type="hidden" id="hidden_billing_address_end" value=""
                        name="hidden_billing_address_end" />
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper">出力条件：</div>
                <div class="frame">
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="output_kbn" value="1" checked />
                            商品別
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="output_kbn" value="2" />
                            カラー別サイズ別
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
    </form>
    @include('admin.master.search.billing_address', ['billingAddressData' => $billingAddressData])
    @include('admin.common.calendar', ['calendarId' => 'calendar1'])
    @include('admin.common.calendar', ['calendarId' => 'calendar2'])
@endsection
