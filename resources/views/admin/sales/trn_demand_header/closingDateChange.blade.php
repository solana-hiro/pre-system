@extends('layouts.admin.app')
@section('page_title', '請求締日変更処理')
@section('title', '請求締日変更処理')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('sales_management.demand.closing_date.change.update') }}" method="post">
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
                                onblur="eventBlurCodeautoBillingAddressRedirect(arguments[0], this)" minlength="0"
                                maxlength="6" size="6"
                                value="{{ old('billing_address_code', isset($initData) ? $initData['billing_address_cd'] : '') }}" />
                            <img class="vector" id="img_billing_address" src="/img/icon/vector.svg"
                                data-smm-open="search_billing_address_modal" />
                        </div>
                    </div>
                    <input type="hidden" id="hidden_billing_address" value="" name="hidden_billing_address" />
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

            <div class="box">
                <p class="text_18px">現在 締・回収日</p>
                <div class="group group_font_gray">
                    <div class="element element-form">
                        <div class="element-form element-form-rows">
                            <div class="frame">
                                <div class="text_wrapper td_80px grid_wrapper_right">締日１：</div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="text" name="" class="element" minlength="0" maxlength="2"
                                            size="2" disabled
                                            @if (isset($initData)) value="{{ $initData['closing_date_1'] }}" @endif />
                                        日締
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="" value="0"
                                            @if (isset($initData) && $initData['collect_month_1'] === 0) checked @endif disabled />
                                        当月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="" value="1"
                                            @if (isset($initData) && $initData['collect_month_1'] === 1) checked @endif disabled />
                                        翌月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="" value="2"
                                            @if (isset($initData) && $initData['collect_month_1'] === 2) checked @endif disabled />
                                        翌々月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="" value=""
                                            @if (isset($initData) && $initData['collect_month_1'] > 2) checked @endif disabled />
                                        <input type="text" name="" class="element" minlength="0"
                                            maxlength="2" size="2" disabled
                                            @if (isset($initData) && $initData['collect_month_1'] > 2) value="{{ $initData['collect_month_1'] }}" @endif />
                                        々月後&emsp;
                                        <input type="text" name="" class="element" minlength="0"
                                            maxlength="2" size="2" disabled
                                            @if (isset($initData)) value="{{ $initData['collect_date_1'] }}" @endif />
                                        日回収
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-rows">
                            <div class="frame">
                                <div class="text_wrapper td_80px grid_wrapper_right">締日２：</div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="text" name="" class="element" minlength="0"
                                            maxlength="2" size="2" disabled
                                            @if (isset($initData)) value="{{ $initData['closing_date_2'] }}" @endif />
                                        日締
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="" value=""
                                            @if (isset($initData) && $initData['collect_month_2'] === 0) checked @endif disabled />
                                        当月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="" value=""
                                            @if (isset($initData) && $initData['collect_month_2'] === 1) checked @endif disabled />
                                        翌月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="" value=""
                                            @if (isset($initData) && $initData['collect_month_2'] === 2) checked @endif disabled />
                                        翌々月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="" value=""
                                            @if (isset($initData) && $initData['collect_month_2'] > 2) checked @endif disabled />
                                        <input type="text" name="" class="element" minlength="0"
                                            maxlength="2" size="2" disabled
                                            @if (isset($initData) && $initData['collect_month_2'] > 2) value="{{ $initData['collect_month_2'] }}" @endif />
                                        々月後&emsp;
                                        <input type="text" name="" class="element" minlength="0"
                                            maxlength="2" size="2" disabled
                                            @if (isset($initData)) value="{{ $initData['collect_date_2'] }}" @endif />
                                        日回収
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-rows">
                            <div class="frame">
                                <div class="text_wrapper td_80px grid_wrapper_right">締日３：</div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="text" name="" class="element" minlength="0"
                                            maxlength="2" size="2" disabled
                                            @if (isset($initData)) value="{{ $initData['closing_date_3'] }}" @endif />
                                        日締
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="kbn" value=""
                                            @if (isset($initData) && $initData['collect_month_3'] === 0) checked @endif disabled />
                                        当月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="kbn" value=""
                                            @if (isset($initData) && $initData['collect_month_3'] === 0) checked @endif disabled />
                                        翌月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="kbn" value=""
                                            @if (isset($initData) && $initData['collect_month_3'] === 0) checked @endif disabled />
                                        翌々月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="" value=""
                                            @if (isset($initData) && $initData['collect_month_3'] > 2) checked @endif disabled />
                                        <input type="text" name="" class="element" minlength="0"
                                            maxlength="2" size="2" disabled
                                            @if (isset($initData) && $initData['collect_month_3'] > 2) value="{{ $initData['collect_month_3'] }}" @endif />
                                        々月後&emsp;
                                        <input type="text" name="" class="element" minlength="0"
                                            maxlength="2" size="2" disabled
                                            @if (isset($initData)) value="{{ $initData['collect_date_3'] }}" @endif />
                                        日回収
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div><br>
                </div>
            </div>

            <div class="box">
                <p class="text_18px">新 締・回収日</p>
                <div class="group">
                    <div class="element element-form">
                        <div class="element-form element-form-rows">
                            <div class="frame">
                                <div class="text_wrapper td_80px grid_wrapper_right txt_required">締日１：</div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="text" name="closing_date_1" class="element" minlength="0"
                                            maxlength="2" size="2" />
                                        日締
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="collect_month_1" name="collect_month_1" value="0"
                                            checked />
                                        当月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="collect_month_1" name="collect_month_1"
                                            value="1" />
                                        翌月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="collect_month_1" name="collect_month_1"
                                            value="2" />
                                        翌々月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="collect_month_1" value="" />
                                        <input type="text" name="collect_month_1_txt" class="element" minlength="0"
                                            maxlength="2" size="2" />
                                        々月後&emsp;
                                        <input type="text" name="collect_date_1" class="element" minlength="0"
                                            maxlength="2" size="2" />
                                        日回収
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-rows">
                            <div class="frame">
                                <div class="text_wrapper td_80px grid_wrapper_right txt_required">締日２：</div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="text" name="closing_date_2" class="element" minlength="0"
                                            maxlength="2" size="2" />
                                        日締
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="collect_month_2" value="0"
                                            checked />
                                        当月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="collect_month_2" value="1" />
                                        翌月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="collect_month_2" value="2" />
                                        翌々月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="collect_month_2" value="" />
                                        <input type="text" name="collect_month_2_txt" class="element" minlength="0"
                                            maxlength="2" size="2" />
                                        々月後&emsp;
                                        <input type="text" name="collect_date_2" class="element" minlength="0"
                                            maxlength="2" size="2" />
                                        日回収
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-rows">
                            <div class="frame">
                                <div class="text_wrapper td_80px grid_wrapper_right txt_required">締日３：</div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="text" name="closing_date_3" class="element" minlength="0"
                                            maxlength="2" size="2" />
                                        日締
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="collect_month_3" value="0"
                                            checked />
                                        当月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="collect_month_3" value="1" />
                                        翌月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="collect_month_3" value="2" />
                                        翌々月
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="" value="" />
                                        <input type="text" name="collect_month_3_txt" class="element" minlength="0"
                                            maxlength="2" size="2" />
                                        々月後&emsp;
                                        <input type="text" name="collect_date_3" class="element" minlength="0"
                                            maxlength="2" size="2" />
                                        日回収
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div><br>
                </div>
            </div>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">更新開始日付</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" id="calendar1-year" name="year" class="element textbox_40px"
                            minlength="0" maxlength="4" value="{{ date('Y') }}">年
                        <input type="text" id="calendar1-month" name="month" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ date('m') }}">月
                        <input type="text" id="calendar1-date" name="day" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ date('d') }}">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
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
@endsection
