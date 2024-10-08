@extends('layouts.admin.app')
@section('page_title', '仕入先入力（詳細）')
@section('title', '仕入先入力（詳細）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
    <script src="{{ asset('/js/calendar.js') }}"></script>
    <script src="{{ asset('js/master/supplier/mt_supplier/detail.js') }}"></script>
@endsection

@section('content')
    <form role="search" action="{{ route('master.supplier.mt_supplier.detail.update') }}" method="post" id="check_target"
        data-monitoring>
        @csrf
        <div class="main_contents">
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    @if (isset($detailData['id']))
                        <button class="button" type="button" name="delete" data-toggle="modal" data-target="#modal_delete"
                            data-value="{{ isset($detailData) ? $detailData['id'] : '' }}">
                            <div class="text_wrapper">削除する</div>
                        </button>
                    @endif
                    @if (isset($detailData) && $minId < $detailData['supplier_cd'])
                        <button class="button" type="submit" name="prev">
                            <div class="text_wrapper_2">前頁</div>
                        </button>
                    @else
                        <button class="button" type="submit" name="prev" disabled>
                            <div class="text_wrapper_2">前頁</div>
                        </button>
                    @endif
                    @if ((isset($detailData) && $maxId > $detailData['supplier_cd']) || (!isset($detailData) && isset($maxId)))
                        <button class="button" type="submit" name="next">
                            <div class="text_wrapper_2">次頁</div>
                        </button>
                    @else
                        <button class="button" type="submit" name="next" disabled>
                            <div class="text_wrapper_2">次頁</div>
                        </button>
                    @endif
                    <button type="button" data-toggle="modal" data-target="#modal_extend" data-value="" class="div-wrapper"
                        id="extendButton" data-url="" name="extend">
                        <div class="text_wrapper_2">拡張</div>
                    </button>
                    <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value="" class="button-2"
                        id="updateButton" data-url="" name="update2"
                        data-del-kbn="{{ old('del_kbn', isset($detailData['del_kbn']) ? $detailData['del_kbn'] : 0) }}">
                        <div class="text_wrapper_3">登録する</div>
                    </button>
                </div>
            </div>
            <div class="main_contents">
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
                <div class="element-form-rows">
                    <div class="element-form element-form-columns">
                        <div class="text_wrapper txt_required">仕入先コード</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="number" name="supplier_cd" id="input_supplier" class="element input_number_6"
                                    data-limit-len="6" data-limit-minus onblur="autoComplementSupplierCode(event)"
                                    value="{{ old('supplier_cd', isset($detailData) ? $detailData['supplier_cd'] : '') }}"
                                    data-monitoring-exclude />
                                <img class="vector" id="img_supplier" src="/img/icon/vector.svg"
                                    data-smm-open="search_supplier_modal" />
                            </div>
                        </div>
                    </div>
                    <div class="element-form element-form-columns">
                        <div class="text_wrapper txt_required">支払先コード</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="number" name="pay_destination_cd" id="input_pay_destination"
                                    class="element input_number_6" data-limit-len="6" data-limit-minus
                                    onblur="autoCompletePayDestinationCode(event)"
                                    value="{{ old('pay_destination_cd', isset($detailData) ? $detailData['pay_destination_cd'] : '') }}" />
                                <img class="vector" id="img_pay_destination" src="/img/icon/vector.svg"
                                    data-smm-open="search_pay_destination_modal" />
                            </div>
                            <input type="hidden" id="hidden_pay_destination" value="" name="hidden_pay_destination" />
                        </div>
                    </div>
                    <div class="element-form element-form-columns">
                        <div class="text_wrapper txt_required">担当者</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" id="user_cd" name="user_cd" class="element input_number_4"
                                    data-limit-len="4" data-limit-minus style="border:none;" onblur="autoCompleteUser(event)"
                                    value="{{ old('user_cd', isset($detailData) ? $detailData['user_cd'] : '') }}" />
                                <img class="vector" id="img_manager" src="/img/icon/vector.svg"
                                    data-smm-open="search_manager_modal" />
                            </div>
                            <div class="textbox">
                                <input type="text" class="element td_140px txt_blue" name="user_name" id="user_name"
                                    readonly
                                    value="{{ old('user_name', isset($detailData) ? $detailData['user_name'] : '') }}">
                            </div>
                            <input type="hidden" id="hidden_manager" value="" name="hidden_manager" />
                        </div>
                    </div>
                </div>
    
                <div class="box">
                    <div class="group">
                        <div class="element-form-rows">
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper txt_blue">仕入先名</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="supplier_name" class="element" minlength="0"
                                            maxlength="60" size="60"
                                            value="{{ old('supplier_name', isset($detailData) ? $detailData['supplier_name'] : '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="element-form-rows">
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">名カナ</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="supplier_name_kana" class="element" minlength="0"
                                            maxlength="10" size="10"
                                            value="{{ old('supplier_name_kana', isset($detailData) ? $detailData['supplier_name_kana'] : '') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">敬称区分</div>
                                <div class="frame">
                                    <label for="kbn1">
                                        <input type="radio" id="" name="honorific_kbn" value="1"
                                            @if (old('honorific_kbn', isset($detailData['honorific_kbn']) ? $detailData['honorific_kbn'] : 1) == 1) checked @endif />
                                        御中
                                    </label>
                                    <label for="kbn2">
                                        <input type="radio" id="" name="honorific_kbn" value="2"
                                            @if (old('honorific_kbn', isset($detailData['honorific_kbn']) ? $detailData['honorific_kbn'] : 1) == 2) checked @endif />
                                        様
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="element-forms">
                    <div class="element-form element-form-columns">
                        <div class="text_wrapper">郵便番号</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" id="zip" name="post_number" class="element" minlength="0"
                                    maxlength="8" size="8"
                                    value="{{ old('post_number', isset($detailData) ? $detailData['post_number'] : '') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="element-form element-form-columns">
                        <div class="text_wrapper">住所</div>
                        <div class="frame">
                            <div class="textbox_720px">
                                <input type="text" name="address" id="address" class="element"
                                    value="{{ old('address', isset($detailData) ? $detailData['address'] : '') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="element-form element-form-columns">
                        <div class="text_wrapper">TEL</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" name="tel" class="element" minlength="0" maxlength="11"
                                    size="11" value="{{ old('tel', isset($detailData) ? $detailData['tel'] : '') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="element-form element-form-columns">
                        <div class="text_wrapper">FAX</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" name="fax" class="element" minlength="0" maxlength="11"
                                    size="11" value="{{ old('fax', isset($detailData) ? $detailData['fax'] : '') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="group">
                    <div class="element element-form">
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper td_120px grid_wrapper_right">代表者名</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="representative_name" class="element" minlength="0"
                                        maxlength="30" size="30"
                                        value="{{ old('representative_name', isset($detailData) ? $detailData['representative_name'] : '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper td_120px grid_wrapper_right">代表者E-Mail</div>
                            <div class="frame">
                                <div class="textbox">
                                    <a href="mailto:" id="link_representative_mail"><img class="vector"
                                            src="/img/icon/email.svg" /></a>
                                    <input type="text" name="representative_mail" id="representative_mail"
                                        onblur="eventBlurEmail(arguments[0], this)" class="element" minlength="0"
                                        maxlength="256" size="64"
                                        value="{{ old('representative_mail', isset($detailData) ? $detailData['representative_mail'] : '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper td_120px grid_wrapper_right">仕入先担当者名</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="supplier_manager_name" class="element" minlength="0"
                                        maxlength="30" size="30"
                                        value="{{ old('supplier_manager_name', isset($detailData) ? $detailData['supplier_manager_name'] : '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper td_120px grid_wrapper_right">仕入先担当者E-Mail</div>
                            <div class="frame">
                                <div class="textbox">
                                    <a href="mailto:" id="link_supplier_manager_mail"><img class="vector"
                                            src="/img/icon/email.svg" /></a>
                                    <input type="text" name="supplier_manager_mail" id="supplier_manager_mail"
                                        onblur="eventBlurEmail(arguments[0], this)" class="element" minlength="0"
                                        maxlength="256" size="64"
                                        value="{{ old('supplier_manager_mail', isset($detailData) ? $detailData['supplier_manager_mail'] : '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper td_120px grid_wrapper_right">&emsp;&emsp;仕入先URL</div>
                            <div class="frame">
                                <div class="textbox">
                                    <a href="" id="url_supplier_url" target="_blank"><img class="vector"
                                            src="/img/icon/link.svg" /></a>
                                    <input type="text" name="supplier_url" id="supplier_url"
                                        onblur="eventBlurUrl(arguments[0], this)" class="element" minlength="0"
                                        maxlength="2083" size="64"
                                        value="{{ old('supplier_url', isset($detailData) ? $detailData['supplier_url'] : '') }}" />
                                </div>
                            </div>
                        </div>
                    </div><br>
                </div>
            </div>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_blue">仕入先分類1</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="mt_supplier_class1_cd" id="input_supplier_class1" class="element"
                                minlength="0" maxlength="6" size="6" onblur="autoCompleteSupplierClassCode(event)"
                                value="{{ old('mt_supplier_class1_cd', isset($detailData) ? $detailData['ms1_supplier_class_cd'] : '') }}" />
                            <img class="vector" id="img_supplier_class1" src="/img/icon/vector.svg"
                                data-smm-open="search_supplier_class1_modal" />
                        </div>
                        <input type="hidden" id="hidden_supplier_class1" value="" name="hidden_supplier_class1" />
                        <div class="textbox">
                            <input type="text" class="element td_140px txt_blue" name="name_supplier_class1"
                                id="name_supplier_class1" readonly
                                value="{{ old('name_supplier_class1', isset($detailData) ? $detailData['ms1_supplier_class_name'] : '') }}">
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">仕入先分類2</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="mt_supplier_class2_cd" id="input_supplier_class2" class="element"
                                minlength="0" maxlength="6" size="6" onblur="autoCompleteSupplierClassCode(event)"
                                value="{{ old('mt_supplier_class2_cd', isset($detailData) ? $detailData['ms2_supplier_class_cd'] : '') }}" />
                            <img class="vector" id="img_supplier_class2" src="/img/icon/vector.svg"
                                data-smm-open="search_supplier_class2_modal" />
                        </div>
                        <input type="hidden" id="hidden_supplier_class2" value="" name="hidden_supplier_class2" />
                        <div class="textbox">
                            <input type="text" class="element td_140px txt_blue" name="name_supplier_class2"
                                id="name_supplier_class2" readonly
                                value="{{ old('name_supplier_class2', isset($detailData) ? $detailData['ms2_supplier_class_name'] : '') }}">
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">仕入先分類3</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="mt_supplier_class3_cd" id="input_supplier_class3" class="element"
                                minlength="0" maxlength="6" size="6" onblur="autoCompleteSupplierClassCode(event)"
                                value="{{ old('mt_supplier_class3_cd', isset($detailData) ? $detailData['ms3_supplier_class_cd'] : '') }}" />
                            <img class="vector" id="img_supplier_class3" src="/img/icon/vector.svg"
                                data-smm-open="search_supplier_class3_modal" />
                        </div>
                        <input type="hidden" id="hidden_supplier_class3" value="" name="hidden_supplier_class3" />
                        <div class="textbox">
                            <input type="text" class="element td_140px txt_blue" name="name_supplier_class3"
                                id="name_supplier_class3" readonly
                                value="{{ old('name_supplier_class3', isset($detailData) ? $detailData['ms3_supplier_class_name'] : '') }}">
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="box">
                <div class="group">
                    <div class="element element-form">
                        <div class="blue_box_deadline">
                            <div class="blue_box_deadline_left">
                                <div class="frame">
                                    <div class="text_wrapper">随時区分：</div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" id="" name="sequentially_kbn" value="0"
                                                onchange="updateFormStateForChangeSequentiallyKbn(event)"
                                                @if (old('sequentially_kbn', isset($detailData['sequentially_kbn']) ? $detailData['sequentially_kbn'] : 0) == 0) checked @endif />
                                            通常
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" id="" name="sequentially_kbn" value="1"
                                                onchange="updateFormStateForChangeSequentiallyKbn(event)"
                                                @if (old('sequentially_kbn', isset($detailData['sequentially_kbn']) ? $detailData['sequentially_kbn'] : 0) == 1) checked @endif />
                                            随時
                                        </label>
                                    </div>
                                </div><br>
                                <div class="frame">
                                    <div class="text_wrapper">&emsp;締日：</div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="number" name="closing_date" class="element w-50"
                                                onblur="autoCompleteDate(event)"
                                                value="{{ old('closing_date', isset($detailData) ? $detailData['closing_date'] : '') }}" />
                                            日締
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" id="closing_month" name="closing_month" value="0"
                                                @if (old('closing_month', isset($detailData['closing_month']) ? $detailData['closing_month'] : '') == 0) checked @endif />
                                            当月
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" id="closing_month" name="closing_month" value="1"
                                                @if (old('closing_month', isset($detailData['closing_month']) ? $detailData['closing_month'] : '') == 1) checked @endif />
                                            翌月
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" id="closing_month" name="closing_month" value="2"
                                                @if (old('closing_month', isset($detailData['closing_month']) ? $detailData['closing_month'] : '') == 2) checked @endif />
                                            翌々月
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="number" name="pay_date" class="element w-50"
                                                onblur="autoCompleteDate(event)"
                                                value="{{ old('pay_date', isset($detailData) ? $detailData['pay_date'] : '') }}" />
                                            日支払
                                        </label>
                                    </div>
                                </div><br>
                            </div>
                            <div class="blue_box_deadline_right">
                                <div class="element-form element-form-columns">
                                    <div class="text_wrapper">データ確定日</div>
                                    <div class="textbox">
                                        <input type="text" name="data_decision_date_y" id="calendar1-year"
                                            class="element textbox_40px" minlength="0" maxlength="4"
                                            value="{{ old('data_decision_date_y', isset($detailData['data_decision_date']) ? mb_substr($detailData['data_decision_date'], 0, 4) : '') }}"
                                            disabled>年
                                        <input type="text" name="data_decision_date_m" id="calendar1-month"
                                            class="element textbox_24px" minlength="0" maxlength="2"
                                            value="{{ old('data_decision_date_m', isset($detailData['data_decision_date']) ? mb_substr($detailData['data_decision_date'], 5, 2) : '') }}"
                                            disabled>月
                                        <input type="text" name="data_decision_date_d" id="calendar1-day"
                                            class="element textbox_24px" minlength="0" maxlength="2"
                                            value="{{ old('data_decision_date_d', isset($detailData['data_decision_date']) ? mb_substr($detailData['data_decision_date'], 7, 2) : '') }}"
                                            disabled>日
                                        <!-- <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')"> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                </div>
            </div>
            <div class="box">
                <div class="element">
                    <div class="frame">
                        <div class="text_wrapper td_100px grid_wrapper_right">名称入力区分：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="name_input_kbn" value="0"
                                    @if (old('name_input_kbn', isset($detailData['name_input_kbn']) ? $detailData['name_input_kbn'] : 0) == 0) checked @endif />
                                しない
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="name_input_kbn" value="1"
                                    @if (old('name_input_kbn', isset($detailData['name_input_kbn']) ? $detailData['name_input_kbn'] : 0) == 1) checked @endif />
                                する
                            </label>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="text_wrapper td_100px grid_wrapper_right">削除区分：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="del_kbn" value="0"
                                    onclick="updateButtonValue()" @if (old('del_kbn', isset($detailData['del_kbn']) ? $detailData['del_kbn'] : 0) == 0) checked @endif />
                                しない
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="del_kbn" value="1"
                                    onclick="updateButtonValue()" @if (old('del_kbn', isset($detailData['del_kbn']) ? $detailData['del_kbn'] : 0) == 1) checked @endif />
                                する
                            </label>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="text_wrapper td_100px grid_wrapper_right">単価端数処理：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="price_fraction_process" value="0"
                                    @if (old(
                                            'price_fraction_process',
                                            isset($detailData['price_fraction_process']) ? $detailData['price_fraction_process'] : 0) == 0) checked @endif />
                                切り捨て
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="price_fraction_process" value="5"
                                    @if (old(
                                            'price_fraction_process',
                                            isset($detailData['price_fraction_process']) ? $detailData['price_fraction_process'] : 0) == 5) checked @endif />
                                四捨五入
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="price_fraction_process" value="9"
                                    @if (old(
                                            'price_fraction_process',
                                            isset($detailData['price_fraction_process']) ? $detailData['price_fraction_process'] : 0) == 9) checked @endif />
                                切り上げ
                            </label>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="text_wrapper td_100px grid_wrapper_right">金額端数処理：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="all_amount_fraction_process" value="0"
                                    @if (old(
                                            'all_amount_fraction_process',
                                            isset($detailData['all_amount_fraction_process']) ? $detailData['all_amount_fraction_process'] : 0) == 0) checked @endif />
                                切り捨て
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="all_amount_fraction_process" value="5"
                                    @if (old(
                                            'all_amount_fraction_process',
                                            isset($detailData['all_amount_fraction_process']) ? $detailData['all_amount_fraction_process'] : 0) == 5) checked @endif />
                                四捨五入
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="all_amount_fraction_process" value="9"
                                    @if (old(
                                            'all_amount_fraction_process',
                                            isset($detailData['all_amount_fraction_process']) ? $detailData['all_amount_fraction_process'] : 0) == 9) checked @endif />
                                切り上げ
                            </label>
                        </div>
                    </div>
                </div><br><br>
                <div class="element-form-rows">
                    <div class="element-form element-form-columns">
                        <div class="text_wrapper txt_blue">発注伝票種別</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" name="mt_slip_kind_order_cd" id="input_slip_kind" class="element"
                                    minlength="0" maxlength="6" size="6" onblur="autoCompleteSlipKind(event)"
                                    value="{{ old('mt_slip_kind_order_cd', isset($detailData) ? $detailData['slip_kind_cd'] : '') }}" />
                                <img class="vector" id="img_slip_kind" src="/img/icon/vector.svg"
                                    data-smm-open="search_slip_kind_04_modal" />
                            </div>
                            <input type="hidden" id="hidden_slip_kind" value="" name="hidden_slip_kind" />
                            <div class="textbox">
                                <input type="text" class="element td_140px txt_blue" name="name_slip_kind"
                                    id="name_slip_kind" readonly
                                    value="{{ old('name_slip_kind', isset($detailData) ? $detailData['slip_kind_name'] : '') }}">
                            </div>
                        </div>
                    </div>
                </div><br><br>
                <div class="blue_box">
                    <div class="blue_box_left">
                        <span>消費税</span>
                    </div>
                    <div class="blue_box_right">
                        <div class="element">
                            <div class="frame">
                                <div class="text_wrapper td_100px grid_wrapper_right">税区分：</div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="tax_kbn" value="1"
                                            onchange="updateFormStateForChangeTaxKbn(event)"
                                            @if (old('tax_kbn', isset($detailData['tax_kbn']) ? $detailData['tax_kbn'] : 1) == 1) checked @endif />
                                        税抜
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="tax_kbn" value="2"
                                            onchange="updateFormStateForChangeTaxKbn(event)"
                                            @if (old('tax_kbn', isset($detailData['tax_kbn']) ? $detailData['tax_kbn'] : 1) == 2) checked @endif />
                                        税込
                                    </label>
                                </div>
                            </div>
                            <div class="frame">
                                <div class="text_wrapper td_100px grid_wrapper_right">算出基準：</div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="tax_calculation_standard" value="1"
                                            @if (old(
                                                    'tax_calculation_standard',
                                                    isset($detailData['tax_calculation_standard']) ? $detailData['tax_calculation_standard'] : 1) == 1) checked @endif />
                                        伝票明細
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="tax_calculation_standard" value="2"
                                            @if (old(
                                                    'tax_calculation_standard',
                                                    isset($detailData['tax_calculation_standard']) ? $detailData['tax_calculation_standard'] : 1) == 2) checked @endif />
                                        伝票合計
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="tax_calculation_standard" value="3"
                                            @if (old(
                                                    'tax_calculation_standard',
                                                    isset($detailData['tax_calculation_standard']) ? $detailData['tax_calculation_standard'] : 1) == 3) checked @endif />
                                        請求合計
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="tax_calculation_standard" value="9"
                                            @if (old(
                                                    'tax_calculation_standard',
                                                    isset($detailData['tax_calculation_standard']) ? $detailData['tax_calculation_standard'] : 1) == 9) checked @endif />
                                        対象外
                                    </label>
                                </div>
                            </div>
                            <div class="frame">
                                <div class="text_wrapper td_100px grid_wrapper_right">端数区分：</div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="tax_fraction_process_1" value="0"
                                            @if (old(
                                                    'tax_fraction_process_1',
                                                    isset($detailData['tax_fraction_process_1']) ? $detailData['tax_fraction_process_1'] : 0) == 0) checked @endif />
                                        円未満
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="tax_fraction_process_1" value="1"
                                            @if (old(
                                                    'tax_fraction_process_1',
                                                    isset($detailData['tax_fraction_process_1']) ? $detailData['tax_fraction_process_1'] : 0) == 1) checked @endif />
                                        十円未満
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="tax_fraction_process_1" value="2"
                                            @if (old(
                                                    'tax_fraction_process_1',
                                                    isset($detailData['tax_fraction_process_1']) ? $detailData['tax_fraction_process_1'] : 0) == 2) checked @endif />
                                        百円未満
                                    </label>
                                </div>
                            </div>
                            <div class="frame">
                                <div class="text_wrapper td_100px grid_wrapper_right">端数処理：</div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="tax_fraction_process_2" value="0"
                                            @if (old(
                                                    'tax_fraction_process_2',
                                                    isset($detailData['tax_fraction_process_2']) ? $detailData['tax_fraction_process_2'] : 0) == 0) checked @endif />
                                        切り捨て
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="tax_fraction_process_2" value="5"
                                            @if (old(
                                                    'tax_fraction_process_2',
                                                    isset($detailData['tax_fraction_process_2']) ? $detailData['tax_fraction_process_2'] : 0) == 5) checked @endif />
                                        四捨五入
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="tax_fraction_process_2" value="9"
                                            @if (old(
                                                    'tax_fraction_process_2',
                                                    isset($detailData['tax_fraction_process_2']) ? $detailData['tax_fraction_process_2'] : 0) == 9) checked @endif />
                                        切り上げ
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="element">
                    <div class="element-form-columns">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">仕入先備考１</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="supplier_memo_1" class="element" minlength="0"
                                        maxlength="256" size="64"
                                        value="{{ old('supplier_memo_1', isset($detailData) ? $detailData['supplier_memo_1'] : '') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="element-form-columns">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">仕入先備考2</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="supplier_memo_2" class="element" minlength="0"
                                        maxlength="256" size="64"
                                        value="{{ old('supplier_memo_2', isset($detailData) ? $detailData['supplier_memo_2'] : '') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="element-form-columns">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">仕入先備考3</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="supplier_memo_3" class="element" minlength="0"
                                        maxlength="256" size="64"
                                        value="{{ old('supplier_memo_3', isset($detailData) ? $detailData['supplier_memo_3'] : '') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="update_id" name="update_id"
            value="{{ old('update_id', isset($detailData) ? $detailData['id'] : '') }}">
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="update" name="update" class="display_none_all"></button>
        <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
        <button type="submit" id="redirect" name="redirect" class="display_none_all" value=""></button>
        <input type="hidden" id="redirect_hidden" name="redirect_hidden" class="display_none_all" value="" />
        <input type="hidden" id="supplier_expansion_1" name="supplier_expansion_1" class="display_none_all"
            value="{{ isset($detailData) ? $detailData['supplier_expansion_1'] : '' }}" />
        <input type="hidden" id="supplier_expansion_2" name="supplier_expansion_2" class="display_none_all"
            value="{{ isset($detailData) ? $detailData['supplier_expansion_2'] : '' }}" />
        <input type="hidden" id="supplier_expansion_3" name="supplier_expansion_3" class="display_none_all"
            value="{{ isset($detailData) ? $detailData['supplier_expansion_3'] : '' }}" />
        <input type="hidden" id="supplier_expansion_4" name="supplier_expansion_4" class="display_none_all"
            value="{{ isset($detailData) ? $detailData['supplier_expansion_4'] : '' }}" />
        <input type="hidden" id="supplier_expansion_5" name="supplier_expansion_5" class="display_none_all"
            value="{{ isset($detailData) ? $detailData['supplier_expansion_5'] : '' }}" />
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    <div class="display_none_all">
        <span id="bk_closing_date"
            data-bk_closing_date="{{ isset($detailData['closing_date']) ? $detailData['closing_date'] : '' }}"></span>
        <span id="bk_closing_month"
            data-bk_closing_month="{{ isset($detailData['closing_month']) ? $detailData['closing_month'] : '' }}"></span>
    </div>
    @include('admin.master.search.supplier')
    @include('admin.master.search.pay_destination')
    @include('admin.master.search.supplier_class1')
    @include('admin.master.search.supplier_class2')
    @include('admin.master.search.supplier_class3')
    @include('admin.master.search.manager')
    @include('admin.master.search.slip_kind', ['slipKindKbnCd' => '04'])
    @include('admin.common.calendar', ['calendarId' => 'calendar1'])
    @include('components.modal.extend')
    <script>
        function eventBlurEmail(event, element) {
            let mailAddress = document.getElementById(element.id).value;
            let IdName = 'link_' + element.id;
            document.getElementById(IdName).href = "mailto:" + mailAddress;
        }

        function eventBlurUrl(event, element) {
            let url = document.getElementById(element.id).value;
            let IdName = 'url_' + element.id;
            document.getElementById(IdName).href = url;
        }
    </script>
@endsection
