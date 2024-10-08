@extends('layouts.admin.app')
@section('page_title', '請求随時締処理')
@section('title', '請求随時締処理')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('sales_management.demand.sequentially.closing.update') }}" method="post">
        @csrf
        <div class="main_contents">
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value="" class="button-2"
                        id="updateButton" data-url="" name="update2">
                        <div class="text_wrapper_3">登録する</div>
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
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">請求先コード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="billing_address_code" id="input_billing_address" class="element"
                                onblur="eventBlurCodeautoBillingAddressRedirect2(arguments[0], this)" minlength="0"
                                maxlength="6" size="6"
                                value="{{ old('billing_address_code', isset($initData) ? $initData['billing_address_cd'] : '') }}" />
                            <img class="vector" id="img_billing_address" src="/img/icon/vector.svg"
                                data-smm-open="search_billing_address_modal" />
                        </div>
                        <input type="hidden" id="hidden_billing_address" value="" name="hidden_billing_address" />
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">請求先名</div>
                    <div class="frame">
                        <div class="textbox td_300px">{{ isset($initData) ? $initData['customer_name'] : '' }}
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="element-forms">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">郵便番号</div>
                    <div class="frame">
                        <div class="textbox td_120px">{{ isset($initData) ? $initData['post_number'] : '' }}
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-rows">
                    <div class="element-form element-form-columns">
                        <div class="text_wrapper">住所</div>
                        <div class="frame">
                            <div class="textbox td_500px tr_100px" style="align-items: start;">
                                {{ isset($initData) ? $initData['address'] : '' }}
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">TEL</div>
                            <div class="frame">
                                <div class="textbox td_160px">{{ isset($initData) ? $initData['tel'] : '' }}
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">FAX</div>
                            <div class="frame">
                                <div class="textbox td_160px">{{ isset($initData) ? $initData['fax'] : '' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="element-form element-form-rows">
                <div class="text_wrapper label">前回集計締日付</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="" id="" class="element textbox_40px" minlength="0"
                            maxlength="4" value="{{ isset($initData) ? substr($initData['demand_closing_date'], 0, 4) : '' }}"
                            disabled>年
                        <input type="text" name="" id="" class="element textbox_24px"
                            minlength="0" maxlength="2"
                            value="{{ isset($initData) ? substr($initData['demand_closing_date'], 4, 2) : '' }}" disabled>月
                        <input type="text" name="" id="" class="element textbox_24px" minlength="0"
                            maxlength="2" value="{{ isset($initData) ? substr($initData['demand_closing_date'], 6, 2) : '' }}"
                            disabled>日
                    </div>
                </div>
            </div>

            <div class="box">
                <p class="text_18px">今回締条件</p>
                <div class="group">
                    <div class="element-form element-form-rows">
                        <div class="text_wrapper label">今回請求締日付</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" id="calendar1-year" name="closing_year"
                                    class="element textbox_40px" minlength="0" maxlength="4"
                                    value="{{ date('Y') }}">年
                                <input type="text" id="calendar1-month" name="closing_month"
                                    class="element textbox_24px" minlength="0" maxlength="2"
                                    value="{{ date('m') }}">月
                                <input type="text" id="calendar1-date" name="closing_day"
                                    class="element textbox_24px" minlength="0" maxlength="2"
                                    value="{{ date('d') }}">日
                                <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
                            </div>
                        </div>
                    </div><br>
                    <div class="element-form element-form-rows">
                        <div class="text_wrapper label">&emsp;&emsp;今回回収日</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" id="calendar2-year" name="collect_year"
                                    class="element textbox_40px" minlength="0" maxlength="4"
                                    value="{{ date('Y') }}">年
                                <input type="text" id="calendar2-month" name="collect_month"
                                    class="element textbox_24px" minlength="0" maxlength="2"
                                    value="{{ date('m') }}">月
                                <input type="text" id="calendar2-date" name="collect_day"
                                    class="element textbox_24px" minlength="0" maxlength="2"
                                    value="{{ date('d') }}">日
                                <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar2')">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="update" name="update" class="display_none_all"></button>
        <button type="submit" id="redirect" name="redirect" class="display_none_all" value=""></button>
    </form>
    @include('admin.master.search.billing_address', ['billingAddressData' => $billingAddressData])
    @include('admin.common.calendar', ['calendarId' => 'calendar1'])
    @include('admin.common.calendar', ['calendarId' => 'calendar2'])
@endsection
