@extends('layouts.admin.app')
@section('page_title', '請求時消費税一括計算')
@section('title', '請求時消費税一括計算')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('sales_management.demand.tax.calculate.update') }}" method="post">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button type="button" data-toggle="modal" data-target="#modal_remove_confirm" data-value=""
                        class="button" id="removeButton" data-url="" name="update2">
                        <div class="text_wrapper">削除する</div>
                    </button>
                    <button type="button" data-toggle="modal" data-target="#modal_execute_confirm" data-value=""
                        class="button-2" id="updateButton" data-url="" name="update2">
                        <div class="text_wrapper_3">実行する</div>
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
                <div class="text_wrapper label txt_required">対象請求締日</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="year" id="calendar1-year" class="element textbox_40px" minlength="0"
                            maxlength="4" value="{{ old('year', date('Y')) }}">年
                        <input type="text" name="month" id="calendar1-month" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ old('month', date('m')) }}">月
                        <input type="text" name="day" id="calendar1-date" class="element textbox_24px" minlength="0"
                            maxlength="2" value="{{ old('day', date('d')) }}">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
                    </div>
                    <div class="txt_memo">
                        （末日=99）
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label txt_required">請求先コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="code_start" id="input_billing_address_start" class="element"
                            minlength="0" maxlength="6" size="6" value="{{ old('code_start', '') }}" />
                        <img class="vector" id="img_billing_address_start" src="/img/icon/vector.svg"
                            data-smm-open="search_billing_address_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="code_end" id="input_billing_address_end" class="element" minlength="0"
                            maxlength="6" size="6" value="{{ old('code_end', '') }}" />
                        <img class="vector" id="img_billing_address_end" src="/img/icon/vector.svg"
                            data-smm-open="search_billing_address_modal" />
                    </div>
                    <input type="hidden" id="hidden_billing_address_start" value=""
                        name="hidden_billing_address_start" />
                    <input type="hidden" id="hidden_billing_address_end" value=""
                        name="hidden_billing_address_end" />
                </div>
            </div>
            <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
            <button type="submit" id="remove" name="remove" class="display_none_all"></button>
            <button type="submit" id="execute" name="execute" class="display_none_all" value=""></button>
    </form>
    @include('admin.master.search.billing_address', ['billingAddressData' => $billingAddressData])
@endsection
