@extends('layouts.admin.app')
@section('page_title', '得意先入力（詳細）')
@section('title', '得意先入力（詳細）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
    <script src="{{ asset('js/master/customer/mt_customer/detail.js') }}"></script>
@endsection

@section('content')
    <form role="search" action="{{ route('master.customer.mt_customer.detail.update') }}" method="post"
        name="mt_customer_detail_form" data-monitoring>
        @csrf
        <div class="main_contents">
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    @if (isset($detailData))
                        <button class="button" type="button" name="delete" data-toggle="modal" data-target="#modal_delete"
                            data-value="{{ isset($detailData) ? $detailData['id'] : '' }}">
                            <div class="text_wrapper">削除する</div>
                        </button>
                    @else
                        <button class="button" type="button" name="delete" data-toggle="modal" data-target="#modal_delete"
                            data-value="" disabled>
                            <div class="text_wrapper">削除する</div>
                        </button>
                    @endif
                    @if (isset($detailData['customer_cd']) && $minCode !== $detailData['customer_cd'])
                        <button class="button" type="submit" name="prev">
                            <div class="text_wrapper_2">前頁</div>
                        </button>
                    @else
                        <button class="button" type="submit" name="prev" disabled>
                            <div class="text_wrapper_2">前頁</div>
                        </button>
                    @endif
                    @if (
                        (isset($detailData['customer_cd']) && $maxCode !== $detailData['customer_cd']) ||
                            (!isset($detailData) && $maxCode > 0))
                        <button class="button" type="submit" name="next">
                            <div class="text_wrapper_2">次頁</div>
                        </button>
                    @else
                        <button class="button" type="submit" name="next" disabled>
                            <div class="text_wrapper_2">次頁</div>
                        </button>
                    @endif
                    <button type="button" data-toggle="modal" data-target="#modal_extend_customer" data-value=""
                        class="div-wrapper" id="extendButton" data-url="" name="extend">
                        <div class="text_wrapper_2">拡張</div>
                    </button>
                    <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value="" class="button-2"
                        id="updateButton" data-url="" name="update2"
                        data-del-kbn="{{ old('del_kbn', isset($detailData) ? $detailData['del_kbn'] : '') }}"
                        data-send-check="">
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
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_required">得意先コード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="customer_cd" id="input_customer" class="element input_number_6"
                                onblur="eventBlurCodeautoCustomerRedirect(arguments[0], this)" data-limit-len="6"
                                data-limit-minus data-monitoring-exclude
                                value="{{ old('customer_cd', isset($detailData) ? $detailData['customer_cd'] : '') }}" />
                            <img class="vector" id="img_customer" src="/img/icon/vector.svg"
                                data-smm-open="search_customer_modal" />
                        </div>
                        <input type="hidden" id="hidden_customer" value="" name="hidden_customer" />
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_required">請求先コード<span id="alert-danger-ul-billing-address"
                            class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="mt_billing_address_cd" id="input_billing_address"
                                class="element input_number_6" data-limit-len="6" data-limit-minus
                                onblur="blurCodeAutoBillingAddress(arguments[0], this)"
                                value="{{ old('mt_billing_address_cd', isset($detailData) ? $detailData['billing_address_cd'] : '') }}" />
                            <img class="vector" id="img_billing_address" src="/img/icon/vector.svg"
                                data-smm-open="search_billing_address_modal" />
                        </div>
                        <input type="hidden" id="hidden_billing_address" value=""
                            name="hidden_billing_address" />
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">付箋(特記事項)</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="hidden" id="hidden_order_receive_sticky_note"
                                value="{{ old('hidden_order_receive_sticky_note', isset($detailData) ? $detailData['sticky_note_id'] : '') }}"
                                name="hidden_order_receive_sticky_note" />
                            <input type="hidden" id="hidden_order_receive_sticky_note_color"
                                value="{{ old('hidden_order_receive_sticky_note_color', isset($detailData) ? $detailData['sticky_note_color'] : '') }}"
                                name="hidden_order_receive_sticky_note_color" />
                            <input type="text" name="sticky_note_name" id="input_order_receive_sticky_note"
                                style="background-color:{{ old('hidden_order_receive_sticky_note_color', isset($detailData) ? $detailData['sticky_note_color'] : $orderReceiveStickyNoteData[0]['sticky_note_color']) }}"
                                onblur="blurAutosOrderReceiveStickyNote(arguments[0], this)" class="element"
                                minlength="0" maxlength="20" size="10" readonly
                                value="{{ old('sticky_note_name', isset($detailData) ? $detailData['sticky_note_name'] : $orderReceiveStickyNoteData[0]['sticky_note_name']) }}" />
                            <img class="vector" id="img_order_receive_sticky_note" src="/img/icon/vector.svg"
                                data-smm-open="search_order_receive_sticky_note_modal" />
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">入金区分</div>
                    <div class="frame">
                        <label for="kbn1">
                            <input type="radio" name="payment_kbn" value="1"
                                @if (old('payment_kbn', isset($detailData) ? $detailData['payment_kbn'] : '1') == '1') checked @endif />
                            掛売
                        </label>
                        <label for="kbn2">
                            <input type="radio" name="payment_kbn" value="2"
                                @if (old('payment_kbn', isset($detailData) ? $detailData['payment_kbn'] : '') == '2') checked @endif />
                            入金後
                        </label>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_blue">担当者<span id="alert-danger-ul-manager"
                            class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="manager_cd" id="input_manager" class="element input_number_4"
                                data-limit-len="4" data-limit-minus onblur="blurCodeautoUser(arguments[0], this)"
                                value="{{ old('manager_cd', isset($detailData) ? $detailData['user_cd'] : '') }}" />
                            <img class="vector" id="img_manager" src="/img/icon/vector.svg"
                                data-smm-open="search_manager_modal" />
                        </div>
                        <div class="textbox txt_blue td_200px" id="names_manager">
                            {{ isset($detailData) ? $detailData['user_name'] : '' }}
                        </div>
                        <input type="hidden" id="hidden_manager" value="" name="hidden_manager" />
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="group">
                    <div class="element-form-rows">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper txt_blue">得意先名</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="customer_name" class="element" minlength="0"
                                        maxlength="60" size="60"
                                        value="{{ old('customer_name', isset($detailData) ? $detailData['customer_name'] : '') }}" />
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="element-form-rows">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">名カナ</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="customer_name_kana" class="element" minlength="0"
                                        maxlength="10" size="10"
                                        value="{{ old('customer_name_kana', isset($detailData) ? $detailData['customer_name_kana'] : '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">敬称区分</div>
                            <div class="frame">
                                <label for="kbn1">
                                    <input type="radio" name="honorific_kbn" value="1"
                                        @if (old('honorific_kbn', isset($detailData) ? $detailData['honorific_kbn'] : '1') == '1') checked @endif />
                                    御中
                                </label>
                                <label for="kbn2">
                                    <input type="radio" name="honorific_kbn" value="2"
                                        @if (old('honorific_kbn', isset($detailData) ? $detailData['honorific_kbn'] : '') == '2') checked @endif />
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
            <div class="box">
                <div class="group">
                    <div class="element-form element-form-rows">
                        <div class="text_wrapper">代表者</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" name="representative_name" class="element" minlength="0"
                                    maxlength="30" size="30"
                                    value="{{ old('representative_name', isset($detailData) ? $detailData['representative_name'] : '') }}" />
                            </div>
                        </div>
                    </div><br>
                    <div class="element-form element-form-rows">
                        <div class="text_wrapper">E-Mail</div>
                        <div class="frame">
                            <div class="textbox">
                                <a href="mailto:{{ old('representative_mail', isset($detailData) ? $detailData['representative_mail'] : '') }}"
                                    id="link_representative_mail"><img class="vector"
                                        onblur="eventBlurEmail(arguments[0], this)" src="/img/icon/email.svg" /></a>
                                <input type="text" name="representative_mail" class="element" minlength="0"
                                    maxlength="256" size="64" onblur="eventBlurEmail(arguments[0], this)"
                                    value="{{ old('representative_mail', isset($detailData) ? $detailData['representative_mail'] : '') }}" />
                            </div>
                        </div>
                    </div><br>
                    <div class="element-form-rows">
                        <div class="grid">
                            <table style="overflow-y: hidden; overflow-x: hidden;" id="grid_table">
                                <thead class="grid_header">
                                    <tr>
                                        <td class="grid_wrapper_center td_5p">No.</td>
                                        <td class="grid_wrapper_center td_15p">担当者コード</td>
                                        <td class="grid_wrapper_center td_15p">得意先担当者名</td>
                                        <td class="grid_wrapper_center td_15p">メールアドレス</td>
                                        <td class="grid_wrapper_center td_10p">ECログインID</td>
                                        <td class="grid_wrapper_center td_10p">ECログイン<br>パスワード</td>
                                        <td class="grid_wrapper_center td_10p">パスワード発行<br>メール送信</td>
                                        <td class="grid_wrapper_center td_5p">有効</td>
                                        <td class="grid_wrapper_center td_20p">備考</td>
                                        <td class="grid_wrapper_center td_5p">編集</td>
                                        <td class="grid_wrapper_center td_5p">削除</td>
                                    </tr>
                                </thead>
                                <tbody class="grid_body">
                                    @php $i=0;@endphp
                                    @if (old('customer_manager_cd'))
                                        @for ($i = 0; $i < count(old('customer_manager_cd')); $i++)
                                            <tr>
                                                <td class="grid_wrapper_center td_100px">@php
                                                    if (old("manager_id.{$i}")) {
                                                        echo $i + 1;
                                                    }
                                                @endphp</td>
                                                <td class="grid_col_2 col_rec ">
                                                    <input type="text" name="customer_manager_cd[]"
                                                        class="readonly-input"
                                                        value="{{ old("customer_manager_cd.{$i}") }}" readonly />
                                                </td>
                                                <td class="grid_col_2 col_rec">
                                                    <input type="text" name="customer_manager_name[]"
                                                        class="readonly-input"
                                                        value="{{ old("customer_manager_name.{$i}", '') }}" readonly />
                                                </td>
                                                <td class="grid_col_2 col_rec">
                                                    <input type="text" name="customer_manager_mail[]"
                                                        class="readonly-input"
                                                        value="{{ old("customer_manager_mail.{$i}", '') }}" readonly />
                                                </td>
                                                <td class="grid_col_2 col_rec">
                                                    <input type="text" name="ec_login_id[]" class="readonly-input"
                                                        value="{{ old("ec_login_id.{$i}", '') }}" readonly />
                                                </td>
                                                <td class="grid_col_2 col_rec">@php
                                                    if (old("ec_login_password.{$i}")) {
                                                        echo '********';
                                                    }
                                                @endphp</td>
                                                <td class="grid_col_1 col_rec">
                                                    <input name="send_password_flg[]" type="hidden"
                                                        value="{{ old("send_password_flg.{$i}", '') }}">
                                                    <input type="checkbox" name="send_password_flg_check" value="1"
                                                        onclick="return false;"
                                                        @if (old("send_password_flg.{$i}") == 1) checked @endif>
                                                </td>
                                                <td class="grid_col_1 col_rec">
                                                    <input name="validity_flg[]" type="hidden"
                                                        value="{{ old("validity_flg.{$i}", '') }}">
                                                    <input type="checkbox" name="" value="1"
                                                        onclick="return false;"
                                                        @if (old("validity_flg.{$i}") == 1) checked @endif>
                                                </td>
                                                <td class="grid_col_2 col_rec">
                                                    <input type="text" name="customer_memo[]" class="readonly-input"
                                                        value="{{ old("customer_memo.{$i}", '') }}" readonly />
                                                </td>
                                                <input type="hidden" name="display_order[]"
                                                    value="{{ old("display_order.{$i}", '') }}">
                                                <input type="hidden" name="ec_login_password[]"
                                                    value="{{ old("ec_login_password.{$i}", '') }}">
                                                <input type="hidden" name="change_password_flg[]"
                                                    value="{{ old("change_password_flg.{$i}", '') }}">
                                                <input type="hidden" name="manager_id[]"
                                                    value="{{ old("manager_id.{$i}", '') }}">
                                                <td class="grid_col_1 col_rec">
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#modal_manager" data-value=""
                                                        class="div-wrapper display_none" data-url="" name="">
                                                        <img src="/img/icon/edit.svg" class="img_center">
                                                    </button>
                                                </td>
                                                <td class="grid_col_1 col_rec">
                                                    <button type="button" onclick="removeManager(this)"
                                                        class="div-wrapper display_none" name="delete">
                                                        <img src="{{ asset('/img/icon/trash.svg') }}" class="img_center">
                                                    </button>
                                                </td>
                                            </tr>
                                        @endfor
                                    @elseif (isset($managerDetailData) && count($managerDetailData) > 0)
                                        @foreach ($managerDetailData as $data)
                                            <tr>
                                                <td class="grid_wrapper_center td_100px">{{ $i + 1 }}</td>
                                                <td class="grid_col_2 col_rec ">
                                                    <input type="text" name="customer_manager_cd[]"
                                                        class="readonly-input"
                                                        value="{{ old("customer_manager_cd.{$i}", isset($data) ? $data['manager_cd'] : '') }}"
                                                        readonly />
                                                </td>
                                                <td class="grid_col_2 col_rec">
                                                    <input type="text" name="customer_manager_name[]"
                                                        class="readonly-input"
                                                        value="{{ old("customer_manager_name.{$i}", isset($data) ? $data['manager_name'] : '') }}"
                                                        readonly />
                                                </td>
                                                <td class="grid_col_2 col_rec">
                                                    <input type="text" name="customer_manager_mail[]"
                                                        class="readonly-input"
                                                        value="{{ old("customer_manager_mail.{$i}", isset($data) ? $data['manager_mail'] : '') }}"
                                                        readonly />
                                                </td>
                                                <td class="grid_col_2 col_rec">
                                                    <input type="text" name="ec_login_id[]" class="readonly-input"
                                                        value="{{ old("ec_login_id.{$i}", isset($data) ? $data['ec_login_id'] : '') }}"
                                                        readonly />
                                                </td>
                                                <td class="grid_col_2 col_rec">********</td>
                                                <td class="grid_col_1 col_rec">
                                                    <input name="send_password_flg[]" type="hidden"
                                                        value="{{ old("send_password_flg.{$i}", '') }}">
                                                    <input type="checkbox" value="1" name="send_password_flg_check"
                                                        onclick="return false;"
                                                        @if (old("send_password_flg.{$i}") == 1) checked @endif>
                                                </td>
                                                <td class="grid_col_1 col_rec">
                                                    <input name="validity_flg[]" type="hidden"
                                                        value="{{ old("validity_flg.{$i}", $data ? $data['validity_flg'] : '') }}">
                                                    <input name="" type="checkbox" value="1"
                                                        onclick="return false;"
                                                        @if (old("validity_flg.{$i}") == '1' || (is_null(old("validity_flg.{$i}")) && $data['validity_flg'] == '1')) checked @endif>
                                                </td>
                                                <td class="grid_col_2 col_rec">
                                                    <input type="text" name="customer_memo[]" class="readonly-input"
                                                        value="{{ old("customer_memo.{$i}", isset($data) ? $data['memo'] : '') }}"
                                                        readonly />
                                                </td>
                                                <input type="hidden" name="display_order[]"
                                                    value="{{ old("display_order.{$i}", isset($data) ? $data['display_order'] : '') }}">
                                                <input type="hidden" name="ec_login_password[]"
                                                    value="{{ old("ec_login_password.{$i}", '') }}">
                                                <input type="hidden" name="change_password_flg[]"
                                                    value="{{ old("change_password_flg.{$i}", '') }}">
                                                <input type="hidden" name="manager_id[]"
                                                    value="{{ isset($data) ? $data['id'] : '' }}">
                                                <td class="grid_col_1 col_rec">
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#modal_manager" data-value=""
                                                        class="div-wrapper display_none" data-url="" name="">
                                                        <img src="/img/icon/edit.svg" class="img_center"
                                                            id="{{ $data['id'] }}">
                                                    </button>
                                                </td>
                                                <td class="grid_col_1 col_rec">
                                                    <button type="button" onclick="removeManager(this)"
                                                        class="div-wrapper display_none" name="delete">
                                                        <img src="{{ asset('/img/icon/trash.svg') }}" class="img_center">
                                                    </button>
                                                </td>
                                            </tr>
                                            @php $i++;@endphp
                                        @endforeach
                                        <tr>
                                            <td class="grid_wrapper_center td_100px"></td>
                                            <td class="grid_col_2 col_rec ">
                                                <input type="text" name="customer_manager_cd[]" class="readonly-input"
                                                    value="" readonly />
                                            </td>
                                            <td class="grid_col_2 col_rec">
                                                <input type="text" name="customer_manager_name[]"
                                                    class="readonly-input"
                                                    value="{{ old("customer_manager_name.{$i}", '') }}" readonly />
                                            </td>
                                            <td class="grid_col_2 col_rec">
                                                <input type="text" name="customer_manager_mail[]"
                                                    class="readonly-input"
                                                    value="{{ old("customer_manager_mail.{$i}", '') }}" readonly />
                                            </td>
                                            <td class="grid_col_2 col_rec">
                                                <input type="text" name="ec_login_id[]" class="readonly-input"
                                                    value="{{ old("ec_login_id.{$i}", '') }}" readonly />
                                            </td>
                                            <td class="grid_col_2 col_rec"></td>
                                            <td class="grid_col_1 col_rec">
                                                <input name="send_password_flg[]" type="hidden"
                                                    value="{{ old("send_password_flg.{$i}", '') }}">
                                                <input type="checkbox" name="send_password_flg_check" value="1"
                                                    onclick="return false;"
                                                    @if (old("send_password_flg.{$i}") == 1) checked @endif>
                                            </td>
                                            <td class="grid_col_1 col_rec">
                                                <input name="validity_flg[]" type="hidden"
                                                    value="{{ old("validity_flg.{$i}", '') }}">
                                                <input type="checkbox" name="" value="1"
                                                    onclick="return false;"
                                                    @if (old("validity_flg.{$i}") == 1) checked @endif>
                                            </td>
                                            <td class="grid_col_2 col_rec">
                                                <input type="text" name="customer_memo[]" class="readonly-input"
                                                    value="{{ old("customer_memo.{$i}", '') }}" readonly />
                                            </td>
                                            <input type="hidden" name="display_order[]"
                                                value="{{ old("display_order.{$i}", '') }}">
                                            <input type="hidden" name="ec_login_password[]"
                                                value="{{ old("ec_login_password.{$i}", '') }}">
                                            <input type="hidden" name="change_password_flg[]"
                                                value="{{ old("change_password_flg.{$i}", '') }}">
                                            <input type="hidden" name="manager_id[]" value="">
                                            <td class="grid_col_1 col_rec">
                                                <button type="button" data-toggle="modal" data-target="#modal_manager"
                                                    data-value="" class="div-wrapper display_none" data-url=""
                                                    name="">
                                                    <img src="/img/icon/edit.svg" class="img_center">
                                                </button>
                                            </td>
                                            <td class="grid_col_1 col_rec">
                                                <button type="button" onclick="removeManager(this)"
                                                    class="div-wrapper display_none" name="delete">
                                                    <img src="{{ asset('/img/icon/trash.svg') }}" class="img_center">
                                                </button>
                                            </td>
                                        </tr>
                                    @else
                                        @for ($i = 0; $i < 2; $i++)
                                            <tr>
                                                <td class="grid_wrapper_center td_100px"></td>
                                                <td class="grid_col_2 col_rec ">
                                                    <input type="text" name="customer_manager_cd[]"
                                                        class="readonly-input" value="" readonly />
                                                </td>
                                                <td class="grid_col_2 col_rec">
                                                    <input type="text" name="customer_manager_name[]"
                                                        class="readonly-input" value="" readonly />
                                                </td>
                                                <td class="grid_col_2 col_rec">
                                                    <input type="text" name="customer_manager_mail[]"
                                                        class="readonly-input" value="" readonly />
                                                </td>
                                                <td class="grid_col_2 col_rec">
                                                    <input type="text" name="ec_login_id[]" class="readonly-input"
                                                        value="" readonly />
                                                </td>
                                                <td class="grid_col_2 col_rec"></td>
                                                <td class="grid_col_1 col_rec">
                                                    <input name="send_password_flg[]" type="hidden" value="">
                                                    <input type="checkbox" name="send_password_flg_check" value="1"
                                                        onclick="return false;">
                                                </td>
                                                <td class="grid_col_1 col_rec">
                                                    <input name="validity_flg[]" type="hidden" value="">
                                                    <input type="checkbox" name="" value="1"
                                                        onclick="return false;">
                                                </td>
                                                <td class="grid_col_2 col_rec">
                                                    <input type="text" name="customer_memo[]" class="readonly-input"
                                                        value="" readonly />
                                                </td>
                                                <input type="hidden" name="display_order[]" value="">
                                                <input type="hidden" name="ec_login_password[]" value="">
                                                <input type="hidden" name="change_password_flg[]" value="">
                                                <input type="hidden" name="manager_id[]" value="">
                                                <td class="grid_col_1 col_rec">
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#modal_manager" data-value=""
                                                        class="div-wrapper display_none" data-url="" name="">
                                                        <img src="/img/icon/edit.svg" class="img_center">
                                                    </button>
                                                </td>
                                                <td class="grid_col_1 col_rec">
                                                    <button type="button" onclick="removeManager(this)"
                                                        class="div-wrapper display_none" name="delete">
                                                        <img src="{{ asset('/img/icon/trash.svg') }}" class="img_center">
                                                    </button>
                                                </td>
                                            </tr>
                                        @endfor
                                    @endif
                                </tbody>
                            </table>
                            <div class="plus_rec plus_rec_left">
                                <div class="blue_text_wrapper" onclick="customerManagerAddLine()">+ 行を追加する</div>
                            </div>
                        </div>
                    </div>
                    <div class="element-form-rows">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper txt_blue">単価掛率</div>
                            <div class="frame frame_short">
                                <div class="text_wrapper">プロパー</div>
                                <div class="textbox">
                                    <input type="number" name="price_rate" class="element input_number_3"
                                        data-limit-len="3" data-limit-minus
                                        value="{{ old('price_rate', isset($detailData) ? $detailData['price_rate'] : '') }}" />
                                </div>
                                <div class="text_wrapper">%</div>
                            </div>
                        </div>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">与信限度額</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="credit_limit_amount" id="credit_limit_amount"
                                        class="element align-right" minlength="0" maxlength="20" size="10"
                                        onblur="addFigure(this)"
                                        @if (!empty(old('credit_limit_amount'))) value="{{ old('credit_limit_amount') }}"
                                        @elseif(!empty(isset($detailData)))
                                            value="{{ number_format((int) $detailData['credit_limit_amount']) }}" @endif />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper"><br></div>
                            <label for="scales">
                                <input type="checkbox" id="scales" name="credit_limit_amount_check_flg"
                                    value="1" @if (old(
                                            'credit_limit_amount_check_flg',
                                            isset($detailData['credit_limit_amount_check_flg']) ? $detailData['credit_limit_amount_check_flg'] : '') == '1') checked @endif />
                                与信限度額をチェックする
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_blue">販売パターン1<span id="alert-danger-ul-customer-class1"
                            class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="customer_class_cd1" id="input_customer_class1" class="element"
                                minlength="0" maxlength="6" size="6"
                                onblur="blurCodeautoCustomerClass(arguments[0], this)"
                                value="{{ old('customer_class_cd1', isset($detailData) ? $detailData['customer_class_cd_mc1'] : '') }}" />
                            <img class="vector" id="img_customer_class1" src="/img/icon/vector.svg"
                                data-smm-open="search_customer_class_thing1_modal" />
                        </div>
                        <div class="textbox td_120px txt_blue" id="names_customer_class1">
                            {{ isset($detailData) ? $detailData['customer_class_name_mc1'] : '' }}
                        </div>
                    </div>
                    <input type="hidden" id="hidden_customer_class1" value="" name="hidden_customer_class1" />
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">業種・特徴2<span id="alert-danger-ul-customer-class2"
                            class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="customer_class_cd2" id="input_customer_class2" class="element"
                                minlength="0" maxlength="6" size="6"
                                onblur="blurCodeautoCustomerClass(arguments[0], this)"
                                value="{{ old('customer_class_cd2', isset($detailData) ? $detailData['customer_class_cd_mc2'] : '') }}" />
                            <img class="vector" id="img_customer_class2" src="/img/icon/vector.svg"
                                data-smm-open="search_customer_class_thing2_modal" />
                        </div>
                        <div class="textbox td_120px txt_blue" id="names_customer_class2">
                            {{ isset($detailData) ? $detailData['customer_class_name_mc2'] : '' }}
                        </div>
                    </div>
                    <input type="hidden" id="hidden_customer_class2" value="" name="hidden_customer_class2" />
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">ランク3<span id="alert-danger-ul-customer-class3"
                            class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="customer_class_cd3" id="input_customer_class3" class="element"
                                minlength="0" maxlength="6" size="6"
                                onblur="blurCodeautoCustomerClass(arguments[0], this)"
                                value="{{ old('customer_class_cd3', isset($detailData) ? $detailData['customer_class_cd_mc3'] : '') }}" />
                            <img class="vector" id="img_customer_class3" src="/img/icon/vector.svg"
                                data-smm-open="search_rank3_modal" />
                        </div>
                        <div class="textbox td_120px txt_blue" id="names_customer_class3">
                            {{ isset($detailData) ? $detailData['customer_class_name_mc3'] : '' }}
                        </div>
                    </div>
                    <input type="hidden" id="hidden_rank3" value="" name="hidden_rank3" />
                </div>
            </div>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">地区分類<span id="alert-danger-ul-district-class"
                            class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="def_district_class_cd" id="input_district_class"
                                class="element input_number_4" data-limit-len="4" data-limit-minus
                                onblur="blurCodeautoDistrictClasse(arguments[0], this)"
                                value="{{ old('def_district_class_cd', isset($detailData) ? $detailData['district_class_cd'] : '') }}" />
                            <img class="vector" id="img_district_class" src="/img/icon/vector.svg"
                                data-smm-open="search_district_class_modal" />
                        </div>
                        <div class="textbox td_120px txt_blue" id="names_district_class">
                            {{ isset($detailData) ? $detailData['district_class_name'] : '' }}
                        </div>
                    </div>
                    <input type="hidden" id="hidden_district_class" value="" name="hidden_district_class" />
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">開拓年分類<span id="alert-danger-ul-pioneer-year"
                            class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="def_pioneer_year_cd" id="input_pioneer"
                                class="element input_number_4" data-limit-len="4" data-limit-minus
                                onblur="blurCodeautoPioneerYear(arguments[0], this)"
                                value="{{ old('def_pioneer_year_cd', isset($detailData) ? $detailData['pioneer_year_cd'] : '') }}" />
                            <img class="vector" id="img_pioneer" src="/img/icon/vector.svg"
                                data-smm-open="search_pioneer_modal" />
                        </div>
                        <div class="textbox td_120px txt_blue" id="names_pioneer">
                            {{ isset($detailData) ? $detailData['pioneer_year_name'] : '' }}
                        </div>
                    </div>
                    <input type="hidden" id="hidden_pioneer" value="" name="hidden_pioneer" />
                </div>
            </div>
            <div class="box">
                <div class="group">
                    <div class="element element-form">
                        <div class="blue_box_deadline">
                            <div class="blue_box_deadline_left">
                                <div class="frame">
                                    <div class="text_wrapper td_80px wrapper_right">随時区分：</div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="sequentially_kbn" value="0"
                                                onchange="checkSequentiallyKbn()"
                                                @if (old('sequentially_kbn', isset($detailData) ? $detailData['sequentially_kbn'] : '0') == '0') checked @endif />
                                            通常
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="sequentially_kbn" value="1"
                                                onchange="checkSequentiallyKbn()"
                                                @if (old('sequentially_kbn', isset($detailData) ? $detailData['sequentially_kbn'] : '') == '1') checked @endif />
                                            随時
                                        </label>
                                    </div>
                                </div><br>
                                <div class="frame">
                                    <div class="text_wrapper td_80px wrapper_right">締日１：</div>
                                    <div class="div">
                                        <input type="number" name="closing_date_1" id="closing_date_1"
                                            class="element input_number_2" data-limit-len="2" data-limit-minus
                                            onblur="autoCompleteDate(arguments[0], this)"
                                            value="{{ old('closing_date_1', isset($detailData) ? $detailData['closing_date_1'] : '') }}" />
                                        日締
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="collect_month_1" value="0"
                                                @if (old('collect_month_1', isset($detailData) ? $detailData['collect_month_1'] : '') == '0') checked @endif />
                                            当月
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="collect_month_1" value="1"
                                                @if (old('collect_month_1', isset($detailData) ? $detailData['collect_month_1'] : '') == '1') checked @endif />
                                            翌月
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="collect_month_1" value="2"
                                                @if (old('collect_month_1', isset($detailData) ? $detailData['collect_month_1'] : '') == '2') checked @endif />
                                            翌々月
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="collect_month_1" value="3"
                                                @if (old('collect_month_1', isset($detailData) ? $detailData['collect_month_1'] : '') >= '3') checked @endif />
                                            <input type="number" name="collect_month_1_txt" id="collect_month_1_txt"
                                                class="element input_number_1" data-limit-len="1" data-limit-minus
                                                onblur="blurCollectMonth(arguments[0], this)"
                                                value="{{ old('collect_month_1_txt', isset($detailData) ? $detailData['collect_month_1_txt'] : '') }}" />
                                            ヵ月後&emsp;
                                            <input type="number" name="collect_date_1" id="collect_date_1"
                                                class="element input_number_2" data-limit-len="2" data-limit-minus
                                                onblur="autoCompleteDate(arguments[0], this)"
                                                value="{{ old('collect_date_1', isset($detailData) ? $detailData['collect_date_1'] : '') }}" />
                                            日回収
                                        </label>
                                    </div>
                                </div><br>
                                <div class="frame">
                                    <div class="text_wrapper td_80px wrapper_right">締日２：</div>
                                    <div class="div">
                                        <input type="number" name="closing_date_2" id="closing_date_2"
                                            class="element input_number_2" data-limit-len="2" data-limit-minus
                                            onblur="autoCompleteDate(arguments[0], this)"
                                            value="{{ old('closing_date_2', isset($detailData) ? $detailData['closing_date_2'] : '') }}" />
                                        日締
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="collect_month_2" value="0"
                                                @if (old('collect_month_2', isset($detailData) ? $detailData['collect_month_2'] : '') == '0') checked @endif />
                                            当月
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="collect_month_2" value="1"
                                                @if (old('collect_month_2', isset($detailData) ? $detailData['collect_month_2'] : '') == '1') checked @endif />
                                            翌月
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="collect_month_2" value="2"
                                                @if (old('collect_month_2', isset($detailData) ? $detailData['collect_month_2'] : '') == '2') checked @endif />
                                            翌々月
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="collect_month_2" value="3"
                                                @if (old('collect_month_2', isset($detailData) ? $detailData['collect_month_2'] : '') >= '3') checked @endif />
                                            <input type="number" name="collect_month_2_txt" id="collect_month_2_txt"
                                                class="element input_number_1" data-limit-len="1" data-limit-minus
                                                onblur="blurCollectMonth(arguments[0], this)"
                                                value="{{ old('collect_month_2_txt', isset($detailData) ? $detailData['collect_month_2_txt'] : '') }}" />
                                            ヵ月後&emsp;
                                            <input type="number" name="collect_date_2" id="collect_date_2"
                                                class="element input_number_2" data-limit-len="2" data-limit-minus
                                                onblur="autoCompleteDate(arguments[0], this)"
                                                value="{{ old('collect_date_2', isset($detailData) ? $detailData['collect_date_2'] : '') }}" />
                                            日回収
                                        </label>
                                    </div>
                                </div><br>
                                <div class="frame">
                                    <div class="text_wrapper td_80px wrapper_right">締日３：</div>
                                    <div class="div">
                                        <input type="number" name="closing_date_3" id="closing_date_3"
                                            class="element input_number_2" data-limit-len="2" data-limit-minus
                                            onblur="autoCompleteDate(arguments[0], this)"
                                            value="{{ old('closing_date_3', isset($detailData) ? $detailData['closing_date_3'] : '') }}" />
                                        日締
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="collect_month_3" value="0"
                                                @if (old('collect_month_3', isset($detailData) ? $detailData['collect_month_3'] : '') == '0') checked @endif />
                                            当月
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="collect_month_3" value="1"
                                                @if (old('collect_month_3', isset($detailData) ? $detailData['collect_month_3'] : '0') == '1') checked @endif />

                                            翌月
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="collect_month_3" value="2"
                                                @if (old('collect_month_3', isset($detailData) ? $detailData['collect_month_3'] : '0') == '2') checked @endif />

                                            翌々月
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="collect_month_3" value="3"
                                                @if (old('collect_month_3', isset($detailData) ? $detailData['collect_month_3'] : '') >= '3') checked @endif />
                                            <input type="number" name="collect_month_3_txt" id="collect_month_3_txt"
                                                class="element input_number_1" data-limit-len="1" data-limit-minus
                                                onblur="blurCollectMonth(arguments[0], this)"
                                                value="{{ old('collect_month_3_txt', isset($detailData) ? $detailData['collect_month_3_txt'] : '') }}" />
                                            ヵ月後&emsp;
                                            <input type="number" name="collect_date_3" id="collect_date_3"
                                                class="element input_number_2" data-limit-len="2" data-limit-minus
                                                onblur="autoCompleteDate(arguments[0], this)"
                                                value="{{ old('collect_date_3', isset($detailData) ? $detailData['collect_date_3'] : '') }}" />
                                            日回収
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="blue_box_deadline_right">
                                <div class="element-form element-form-columns">
                                    <div class="text_wrapper">データ確定日</div>
                                    <div class="textbox">
                                        <input type="text" name="data_decision_date_y"
                                            class="element textbox_40px txt_blue" minlength="0" maxlength="4"
                                            value="{{ isset($detailData) ? substr($detailData['data_decision_date'], 0, 4) : '' }}"
                                            disabled />年
                                        <input type="text" name="data_decision_date_m"
                                            class="element textbox_24px txt_blue" minlength="0" maxlength="2"
                                            value="{{ isset($detailData) ? substr($detailData['data_decision_date'], 4, 2) : '' }}"
                                            disabled />月
                                        <input type="text" name="data_decision_date_d"
                                            class="element textbox_24px txt_blue" minlength="0" maxlength="2"
                                            value="{{ isset($detailData) ? substr($detailData['data_decision_date'], 6, 2) : '' }}"
                                            disabled />日
                                        <!-- <img src="/img/icon/calender.svg"> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper td_140px wrapper_right">請求書通知用E-Mail1</div>
                            <div class="frame">
                                <div class="textbox">
                                    <a href="mailto:{{ old('invoice_notification_mail_1', isset($detailData) ? $detailData['invoice_notification_mail_1'] : '') }}"
                                        id="link_invoice_notification_mail_1"><img class="vector"
                                            onblur="eventBlurEmail(arguments[0], this)" src="/img/icon/email.svg" /></a>
                                    <input type="text" name="invoice_notification_mail_1" class="element"
                                        minlength="0" maxlength="256" size="64"
                                        onblur="eventBlurEmail(arguments[0], this)"
                                        value="{{ old('invoice_notification_mail_1', isset($detailData) ? $detailData['invoice_notification_mail_1'] : '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper td_140px wrapper_right">請求書通知用E-Mail2</div>
                            <div class="frame">
                                <div class="textbox">
                                    <a href="mailto:{{ old('invoice_notification_mail_2', isset($detailData) ? $detailData['invoice_notification_mail_2'] : '') }}"
                                        id="link_invoice_notification_mail_2"><img class="vector"
                                            onblur="eventBlurEmail(arguments[0], this)" src="/img/icon/email.svg" /></a>
                                    <input type="text" name="invoice_notification_mail_2" class="element"
                                        minlength="0" maxlength="256" size="64"
                                        onblur="eventBlurEmail(arguments[0], this)"
                                        value="{{ old('invoice_notification_mail_2', isset($detailData) ? $detailData['invoice_notification_mail_2'] : '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper td_140px wrapper_right">入金案内用E-Mail</div>
                            <div class="frame">
                                <div class="textbox">
                                    <a href="mailto:{{ old('payment_guidance_mail', isset($detailData) ? $detailData['payment_guidance_mail'] : '') }}"
                                        id="link_payment_guidance_mail"><img class="vector"
                                            onblur="eventBlurEmail(arguments[0], this)" src="/img/icon/email.svg" /></a>
                                    <input type="text" name="payment_guidance_mail" class="element" minlength="0"
                                        maxlength="256" size="64" onblur="eventBlurEmail(arguments[0], this)"
                                        value="{{ old('payment_guidance_mail', isset($detailData) ? $detailData['payment_guidance_mail'] : '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="frame">
                            <div class="text_wrapper td_140px wrapper_right">入金案内送信不要：</div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" name="payment_guidance_send_flg" value="1"
                                        @if (old('payment_guidance_send_flg') == '1' ||
                                                (null == old('payment_guidance_send_flg') &&
                                                    isset($detailData) &&
                                                    $detailData['payment_guidance_send_flg'] == 1) ||
                                                (null == old('payment_guidance_send_flg') && !isset($detailData))) checked @endif />
                                    必要
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" name="payment_guidance_send_flg" value="2"
                                        @if (old('payment_guidance_send_flg') == '2' ||
                                                (null == old('payment_guidance_send_flg') &&
                                                    isset($detailData) &&
                                                    $detailData['payment_guidance_send_flg'] == 2)) checked @endif />
                                    不要
                                </label>
                            </div>
                        </div>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper td_140px wrapper_right ">得意先URL</div>
                            <div class="frame">
                                <div class="textbox">
                                    <a href="{{ old('customer_url', isset($detailData) ? $detailData['customer_url'] : '') }}"
                                        id="url_customer_url" target="_blank"><img class="vector"
                                            src="/img/icon/link.svg" /></a>
                                    <input type="text" name="customer_url" class="element" minlength="0"
                                        id="customer_url" maxlength="256" size="64"
                                        onblur="eventBlurUrl(arguments[0], this)"
                                        value="{{ old('customer_url', isset($detailData) ? $detailData['customer_url'] : '') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="element">
                    <div class="frame">
                        <div class="text_wrapper td_120px wrapper_right">名称入力区分：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="name_input_kbn" value="0"
                                    @if (old('name_input_kbn', isset($detailData) ? $detailData['name_input_kbn'] : '0') == 0) checked @endif />
                                しない
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="name_input_kbn" value="1"
                                    @if (old('name_input_kbn', isset($detailData) ? $detailData['name_input_kbn'] : '') == 1) checked @endif />
                                する
                            </label>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="text_wrapper td_120px wrapper_right">削除区分：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="del_kbn" value="0"
                                    onchange="changeDelKbnCustomer(arguments[0], this)"
                                    @if (old('del_kbn', isset($detailData) ? $detailData['del_kbn'] : '0') == 0) checked @endif />
                                しない
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="del_kbn" value="1"
                                    onchange="changeDelKbnCustomer(arguments[0], this)"
                                    @if (old('del_kbn', isset($detailData) ? $detailData['del_kbn'] : '') == 1) checked @endif />
                                する
                            </label>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="text_wrapper td_120px wrapper_right">単価端数処理：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="price_fraction_process" value="0"
                                    @if (old('price_fraction_process', isset($detailData) ? $detailData['price_fraction_process'] : '0') == 0) checked @endif />
                                切り捨て
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="price_fraction_process" value="5"
                                    @if (old('price_fraction_process', isset($detailData) ? $detailData['price_fraction_process'] : '') == 1) checked @endif />

                                四捨五入
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="price_fraction_process" value="9"
                                    @if (old('price_fraction_process', isset($detailData) ? $detailData['price_fraction_process'] : '') == 9) checked @endif />

                                切り上げ
                            </label>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="text_wrapper td_120px wrapper_right">金額端数処理</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="all_amount_fraction_process" value="0"
                                    @if (old('all_amount_fraction_process', isset($detailData) ? $detailData['all_amount_fraction_process'] : '0') == 0) checked @endif />
                                切り捨て
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="all_amount_fraction_process" value="5"
                                    @if (old('all_amount_fraction_process', isset($detailData) ? $detailData['all_amount_fraction_process'] : '') == 5) checked @endif />
                                四捨五入
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="all_amount_fraction_process" value="9"
                                    @if (old('all_amount_fraction_process', isset($detailData) ? $detailData['all_amount_fraction_process'] : '') == 9) checked @endif />
                                切り上げ
                            </label>
                        </div>
                    </div>
                    <div class="blue_box">
                        <div class="blue_box_left td_120px wrapper_left">
                            <span>消費税</span>
                        </div>
                        <div class="blue_box_right">
                            <div class="element">
                                <div class="frame">
                                    <div class="text_wrapper td_120px wrapper_right">税区分：</div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="tax_kbn" value="1"
                                                @if (old('tax_kbn', isset($detailData) ? $detailData['tax_kbn'] : '1') == 1) checked @endif />
                                            税抜
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="tax_kbn" value="2"
                                                @if (old('tax_kbn', isset($detailData) ? $detailData['tax_kbn'] : '') == 2) checked @endif />
                                            税込
                                        </label>
                                    </div>
                                </div>
                                <div class="frame">
                                    <div class="text_wrapper td_120px wrapper_right">運賃掛率適用：</div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="tax_fare_rate_application" value="0"
                                                @if (old('tax_fare_rate_application', isset($detailData) ? $detailData['tax_fare_rate_application'] : '0') == 0) checked @endif />
                                            しない
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="tax_fare_rate_application" value="1"
                                                @if (old('tax_fare_rate_application', isset($detailData) ? $detailData['tax_fare_rate_application'] : '') == 1) checked @endif />
                                            する
                                        </label>
                                    </div>
                                </div>
                                <div class="frame">
                                    <div class="text_wrapper td_120px wrapper_right">算出基準：</div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="tax_calculation_standard" value="1"
                                                @if (old('tax_calculation_standard', isset($detailData) ? $detailData['tax_calculation_standard'] : '1') == 1) checked @endif />
                                            伝票明細
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="tax_calculation_standard" value="2"
                                                @if (old('tax_calculation_standard', isset($detailData) ? $detailData['tax_calculation_standard'] : '') == 2) checked @endif />
                                            伝票合計
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="tax_calculation_standard" value="3"
                                                @if (old('tax_calculation_standard', isset($detailData) ? $detailData['tax_calculation_standard'] : '') == 3) checked @endif />
                                            請求合計
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="tax_calculation_standard" value="9"
                                                @if (old('tax_calculation_standard', isset($detailData) ? $detailData['tax_calculation_standard'] : '') == 9) checked @endif />
                                            対象外
                                        </label>
                                    </div>
                                </div>
                                <div class="frame">
                                    <div class="text_wrapper td_120px wrapper_right">端数区分：</div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="tax_fraction_process_yen" value="0"
                                                @if (old('tax_fraction_process_yen', isset($detailData) ? $detailData['tax_fraction_process_yen'] : '0') == 0) checked @endif />
                                            円未満
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="tax_fraction_process_yen" value="1"
                                                @if (old('tax_fraction_process_yen', isset($detailData) ? $detailData['tax_fraction_process_yen'] : '') == 1) checked @endif />
                                            十円未満
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="tax_fraction_process_yen" value="2"
                                                @if (old('tax_fraction_process_yen', isset($detailData) ? $detailData['tax_fraction_process_yen'] : '') == 2) checked @endif />
                                            百円未満
                                        </label>
                                    </div>
                                </div>
                                <div class="frame">
                                    <div class="text_wrapper td_120px wrapper_right">端数処理：</div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="tax_fraction_process" value="0"
                                                @if (old('tax_fraction_process', isset($detailData['tax_fraction_process']) ? $detailData['tax_fraction_process'] : 0) ==
                                                        0) checked @endif />
                                            切り捨て
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="tax_fraction_process" value="5"
                                                @if (old('tax_fraction_process', isset($detailData['tax_fraction_process']) ? $detailData['tax_fraction_process'] : 0) ==
                                                        5) checked @endif />
                                            四捨五入
                                        </label>
                                    </div>
                                    <div class="div">
                                        <label class="text_wrapper_2">
                                            <input type="radio" name="tax_fraction_process" value="9"
                                                @if (old('tax_fraction_process', isset($detailData['tax_fraction_process']) ? $detailData['tax_fraction_process'] : 0) ==
                                                        9) checked @endif />
                                            切り上げ
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">館内配送料</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="delivery_price" class="element align-right" minlength="0"
                                maxlength="" size="10" onblur="addFigure(this)"
                                @if (!empty(old('delivery_price'))) value="{{ old('delivery_price') }}"
                                @elseif(!empty(isset($detailData)))
                                    value="{{ number_format((int) $detailData['delivery_price']) }}" @endif />
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_blue">受注倉庫<span id="alert-danger-ul-warehouse"
                            class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="warehouse_cd" id="input_warehouse"
                                class="element input_number_6" data-limit-len="6" data-limit-minus
                                onblur="blurCodeautoWarehouse(arguments[0], this)"
                                value="{{ old('warehouse_cd', isset($detailData) ? $detailData['warehouse_cd'] : '') }}" />
                            <img class="vector" id="img_warehouse" src="/img/icon/vector.svg"
                                data-smm-open="search_warehouse_modal" />
                        </div>
                        <div class="textbox td_100px txt_blue" id="names_warehouse">
                            {{ isset($detailData) ? $detailData['warehouse_name'] : '' }}
                        </div>
                    </div>
                    <input type="hidden" id="hidden_warehouse" value="" name="hidden_warehouse" />
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_blue">ルートコード<span id="alert-danger-ul-root"
                            class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="root_cd" id="input_root" class="element input_number_4"
                                data-limit-len="4" data-limit-minus onblur="blurCodeautoRoot(arguments[0], this)"
                                value="{{ old('root_cd', isset($detailData) ? $detailData['root_cd'] : '') }}" />
                            <img class="vector" id="img_root" src="/img/icon/vector.svg"
                                data-smm-open="search_root_modal" />
                        </div>
                        <div class="textbox td_100px txt_blue" id="names_root">
                            {{ isset($detailData) ? $detailData['root_name'] : '' }}
                        </div>
                    </div>
                    <input type="hidden" id="hidden_root" value="" name="hidden_root" />
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_blue">運送会社<span id="alert-danger-ul-item-class1"
                            class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="shipping_companie_cd" id="input_brand1"
                                class="element input_number_6" data-limit-len="6" data-limit-minus
                                onblur="blurCodeautoItemClass1(arguments[0], this)"
                                value="{{ old('shipping_companie_cd', isset($detailData) ? $detailData['item_class_cd'] : '') }}" />
                            <img class="vector" id="img_brand1" src="/img/icon/vector.svg"
                                data-smm-open="search_brand1_modal" />
                        </div>
                        <div class="textbox td_100px txt_blue" id="names_brand1">
                            {{ isset($detailData) ? $detailData['item_class_name'] : '' }}
                        </div>
                    </div>
                    <input type="hidden" id="hidden_brand1" value="" name="hidden_brand1" />
                </div>
            </div>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">得意先着日<span id="alert-danger-ul-arrival-date"
                            class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="arrival_date" id="input_arrival_date"
                                class="element input_number_4" data-limit-len="4" data-limit-minus
                                onblur="blurCodeautoArrivalDate(arguments[0], this)"
                                value="{{ old('arrival_date', isset($detailData) ? $detailData['arrival_date_cd'] : '') }}" />
                            <img class="vector" id="img_arrival_date" src="/img/icon/vector.svg"
                                data-smm-open="search_arrival_date_modal" />
                        </div>
                        <div class="textbox td_160px txt_blue" id="names_arrival_date">
                            {{ isset($detailData) ? $detailData['arrival_date_name'] : '' }}
                        </div>
                    </div>
                    <input type="hidden" id="hidden_arrival_date" value="" name="hidden_arrival_date" />
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_blue">売上伝票種別<span id="alert-danger-ul-slip_kind2"
                            class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="slip_kind_sale" id="input_slip_kind2"
                                class="element input_number_3" data-limit-len="3" data-limit-minus
                                onblur="blurCodeautoSlipKind(arguments[0], this)"
                                value="{{ old('slip_kind_sale', isset($detailData) ? $detailData['slip_kind_cd'] : '') }}" />
                            <img class="vector" id="img_slip_kind2" src="/img/icon/vector.svg"
                                data-smm-open="search_slip_kind_02_modal" />
                        </div>
                        <div class="textbox td_160px txt_blue" id="names_slip_kind2">
                            {{ isset($detailData) ? $detailData['slip_kind_name'] : '' }}
                        </div>
                    </div>
                    <input type="hidden" id="hidden_slip_kind2" value="" name="hidden_slip_kind2" />
                </div>
            </div>
            <div class="box">
                <div class="element">
                    <div class="frame">
                        <div class="text_wrapper td_160px wrapper_right">請求書種別：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="invoice_kind_flg" value="1"
                                    @if (old('invoice_kind_flg', isset($detailData) ? $detailData['invoice_kind_flg'] : '1') == 1) checked @endif />

                                明細あり
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="invoice_kind_flg" value="2"
                                    @if (old('invoice_kind_flg', isset($detailData) ? $detailData['invoice_kind_flg'] : '') == 2) checked @endif />
                                明細なし
                            </label>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="text_wrapper td_160px wrapper_right">直送納品書郵送要不要：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="direct_delivery_slip_mailing_flg" value="1"
                                    @if (old(
                                            'direct_delivery_slip_mailing_flg',
                                            isset($detailData) ? $detailData['direct_delivery_slip_mailing_flg'] : '1') == 1) checked @endif />
                                必要
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="direct_delivery_slip_mailing_flg" value="2"
                                    @if (old(
                                            'direct_delivery_slip_mailing_flg',
                                            isset($detailData) ? $detailData['direct_delivery_slip_mailing_flg'] : '') == 2) checked @endif />
                                不要
                            </label>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="text_wrapper td_160px wrapper_right">請求書郵送要不要：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="invoice_mailing_flg" value="1"
                                    @if (old('invoice_mailing_flg', isset($detailData) ? $detailData['invoice_mailing_flg'] : '1') == 1) checked @endif />
                                必要
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="invoice_mailing_flg" value="2"
                                    @if (old('invoice_mailing_flg', isset($detailData) ? $detailData['invoice_mailing_flg'] : '') == 2) checked @endif />
                                不要
                            </label>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="text_wrapper td_160px wrapper_right">売上確定時印刷用紙：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="sale_decision_print_paper_flg" value="1"
                                    @if (old('sale_decision_print_paper_flg', isset($detailData) ? $detailData['sale_decision_print_paper_flg'] : '1') == 1) checked @endif />
                                納品書・返品申請書印刷
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" name="sale_decision_print_paper_flg" value="2"
                                    @if (old('sale_decision_print_paper_flg', isset($detailData) ? $detailData['sale_decision_print_paper_flg'] : '') == 2) checked @endif />
                                出荷明細印刷
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="element">
                    <div class="element-form-columns">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">得意先備考1</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="customer_memo_1" class="element" minlength="0"
                                        maxlength="30" size="30"
                                        value="{{ old('customer_memo_1', isset($detailData) ? $detailData['customer_memo_1'] : '') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="element-form-columns">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">得意先備考2</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="customer_memo_2" class="element" minlength="0"
                                        maxlength="30" size="30"
                                        value="{{ old('customer_memo_2', isset($detailData) ? $detailData['customer_memo_2'] : '') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="element-form-columns">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">得意先備考3</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="customer_memo_3" class="element" minlength="0"
                                        maxlength="30" size="30"
                                        value="{{ old('customer_memo_3', isset($detailData) ? $detailData['customer_memo_3'] : '') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="hidden_detail_id" value="{{ isset($detailData) ? $detailData['id'] : '' }}">
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="update" name="update" class="display_none_all"></button>
        <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
        <button type="submit" id="redirect" name="redirect" class="display_none_all" value=""></button>
        <input type="hidden" id="redirect_hidden" name="redirect_hidden" class="display_none_all"
            value="" />
        <input type="hidden" id="customer_expansion_1" name="customer_expansion_1" class="display_none_all"
            value="{{ old('customer_expansion_1', isset($detailData) ? $detailData['customer_expansion_1'] : '') }}" />
        <input type="hidden" id="customer_expansion_2" name="customer_expansion_2" class="display_none_all"
            value="{{ old('customer_expansion_2', isset($detailData) ? $detailData['customer_expansion_2'] : '') }}" />
        <input type="hidden" id="customer_expansion_3" name="customer_expansion_3" class="display_none_all"
            value="{{ old('customer_expansion_3', isset($detailData) ? $detailData['customer_expansion_3'] : '') }}" />
        <input type="hidden" id="customer_expansion_4" name="customer_expansion_4" class="display_none_all"
            value="{{ old('customer_expansion_4', isset($detailData) ? $detailData['customer_expansion_4'] : '') }}" />
        <input type="hidden" id="customer_expansion_5" name="customer_expansion_5" class="display_none_all"
            value="{{ old('customer_expansion_5', isset($detailData) ? $detailData['customer_expansion_5'] : '') }}" />
        @include('components.menu.selected', ['view' => 'main'])
    </form>

    @include('admin.master.search.customer', ['includeDeleted' => true])
    @include('admin.master.search.manager')
    @include('admin.master.search.customer_class_thing1')
    @include('admin.master.search.root')
    @include('admin.master.search.warehouse')
    @include('admin.master.search.district_class')
    @include('admin.master.search.billing_address')
    @include('admin.master.search.rank3')
    @include('admin.master.search.customer_class_thing2')
    @include('admin.master.search.pioneer')
    @include('admin.master.search.brand1')
    @include('admin.master.search.arrival_date')
    @include('admin.master.search.slip_kind', ['slipKindKbnCd' => '02'])
    @include('admin.master.search.order_receive_sticky_note')
    @include('components.modal.extendCustomer')
    @include('components.modal.manager')
@endsection
