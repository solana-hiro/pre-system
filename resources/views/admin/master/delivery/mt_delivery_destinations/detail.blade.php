@extends('layouts.admin.app')
@section('page_title', '納品先入力（詳細）')
@section('title', '納品先入力（詳細）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('master.delivery.mt_delivery_destinations.detail.update') }}" method="post"
        data-monitoring>
        @csrf
        <div class="main_contents">
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    @if (isset($detailData['mtDeliveryDestination']))
                        <button class="button" type="button" name="delete" id="delete_button" data-toggle="modal"
                            data-target="#modal_delete"
                            data-value="{{ isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['id'] : '' }}">
                            <div class="text_wrapper">削除する</div>
                        </button>
                    @else
                        <button class="button" type="button" name="delete" id="delete_button" data-toggle="modal"
                            data-target="#modal_delete" data-value="" disabled>
                            <div class="text_wrapper">削除する</div>
                        </button>
                    @endif
                    @if (isset($detailData['mtDeliveryDestination']['delivery_destination_id']) &&
                            $minCode !== $detailData['mtDeliveryDestination']['delivery_destination_id']
                    )
                        <button class="button" type="submit" name="prev" id="prev_button">
                            <div class="text_wrapper_2">前頁</div>
                        </button>
                    @else
                        <button class="button" type="submit" name="prev" id="prev_button" disabled>
                            <div class="text_wrapper_2">前頁</div>
                        </button>
                    @endif
                    @if (
                        (isset($detailData['mtDeliveryDestination']['delivery_destination_id']) &&
                            $maxCode !== $detailData['mtDeliveryDestination']['delivery_destination_id']) ||
                            (!isset($detailData) && $maxCode > 0))
                        <button class="button" type="submit" name="next" id="next_button">
                            <div class="text_wrapper_2">次頁</div>
                        </button>
                    @else
                        <button class="button" type="submit" name="next" id="next_button" disabled>
                            <div class="text_wrapper_2">次頁</div>
                        </button>
                    @endif
                    <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value=""
                        data-del-kbn="{{ old('del_kbn_delivery_destination', isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['del_kbn_delivery_destination'] : '') }}"
                        class="button-2" id="updateButton" data-url="" name="update2">
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
                            <input type="number" name="customer_cd" class="element input_number_6" id="input_customer_cd"
                                onblur="blurCodeautoCustomer(arguments[0], this)" data-limit-len="6" data-limit-minus
                                value="{{ old('customer_cd', isset($detailData['mtCustomerDeliveryDestination']) ? $detailData['mtCustomerDeliveryDestination']['customer_cd'] : '') }}" />
                            <img class="vector" id="img_customer_cd" src="/img/icon/vector.svg"
                                data-smm-open="search_customer_modal" />
                            <input type="hidden" id="hidden_customer_cd" value="" name="hidden_customer" />
                        </div>
                        <div>
                            <input type="text" class="textbox td_120px txt_blue" id="names_customer_cd"
                                name="customer_name" readonly
                                value="{{ old('customer_name', isset($detailData['mtCustomerDeliveryDestination']) ? $detailData['mtCustomerDeliveryDestination']['customer_name'] : '') }}" />
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_required">納品先コード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="delivery_destination_cd" class="element input_number_6"
                                id="input_delivery_cd" onblur="blurCodeautoDelivery(arguments[0], this)" data-limit-len="6"
                                data-limit-minus
                                value="{{ old('delivery_destination_cd', isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['delivery_destination_id'] : '') }}" />
                            <img class="vector" id="img_delivery_cd" src="/img/icon/vector.svg"
                                data-smm-open="search_delivery_destination_modal" />
                            <input type="hidden" id="hidden_delivery_cd" value="" name="hidden_delivery" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="group">
                    <div class="element-form-rows">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper txt_required">納品先名</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="delivery_destination_name" class="element"
                                        minlength="0" maxlength="60" size="60"
                                        value="{{ old('delivery_destination_name', isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['delivery_destination_name'] : '') }}" />
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="element-form-rows">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">納品先名カナ</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="delivery_destination_name_kana" class="element"
                                        minlength="0" maxlength="10" size="10"
                                        value="{{ old('delivery_destination_name_kana', isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['delivery_destination_name_kana'] : '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper txt_required">敬称区分</div>
                            <div class="frame">
                                <label for="kbn1">
                                    <input type="radio" id="" name="honorific_kbn" value="1"
                                        @if (old('honorific_kbn') === '1' ||
                                                (null === old('honorific_kbn') &&
                                                    isset($detailData['mtDeliveryDestination']) &&
                                                    $detailData['mtDeliveryDestination']['honorific_kbn'] != '2') ||
                                                (null === old('honorific_kbn') && !isset($detailData['mtDeliveryDestination']))) checked @endif />
                                    御中
                                </label>
                                <label for="kbn2">
                                    <input type="radio" id="" name="honorific_kbn" value="2"
                                        @if (old('honorific_kbn') === '2' ||
                                                (null === old('honorific_kbn') &&
                                                    isset($detailData['mtDeliveryDestination']) &&
                                                    $detailData['mtDeliveryDestination']['honorific_kbn'] == '2')) checked @endif />
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
                                value="{{ old('post_number', isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['post_number'] : '') }}" />
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">住所</div>
                    <div class="frame">
                        <div class="textbox_720px">
                            <input type="text" name="address" id="address" class="element"
                                value="{{ old('address', isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['address'] : '') }}" />
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">TEL</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="tel" class="element" minlength="0" maxlength="11"
                                size="11"
                                value="{{ old('tel', isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['tel'] : '') }}" />
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">FAX</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="fax" class="element" minlength="0" maxlength="11"
                                size="11"
                                value="{{ old('fax', isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['fax'] : '') }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="group">
                    <div class="element element-form">
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper td_100px grid_wrapper_right">代表者</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="representative_name" class="element" minlength="0"
                                        maxlength="20" size="20"
                                        value="{{ old('representative_name', isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['representative_name'] : '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper td_100px grid_wrapper_right">代表者E-Mail</div>
                            <div class="frame">
                                <div class="textbox">
                                    <a href="mailto:{{ old('representative_mail', isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['representative_mail'] : '') }}"
                                        id="link_representative_mail"><img class="vector"
                                            src="/img/icon/email.svg" /></a>
                                    <input type="text" name="representative_mail" class="element"
                                        id="representative_mail" minlength="0" maxlength="256" size="64"
                                        onblur="eventBlurEmail(arguments[0], this)"
                                        value="{{ old('representative_mail', isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['representative_mail'] : '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper td_100px grid_wrapper_right">納品先担当者名</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="delivery_destination_manager_name" class="element"
                                        minlength="0" maxlength="20" size="20"
                                        value="{{ old('delivery_destination_manager_name', isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['delivery_destination_manager_name'] : '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper td_100px grid_wrapper_right">担当者E-Mail</div>
                            <div class="frame">
                                <div class="textbox">
                                    <a href="mailto:{{ old('delivery_destination_manager_mail', isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['delivery_destination_manager_mail'] : '') }}"
                                        id="link_delivery_destination_manager_mail"><img class="vector"
                                            src="/img/icon/email.svg" /></a>
                                    <input type="text" name="delivery_destination_manager_mail" class="element"
                                        id="delivery_destination_manager_mail" minlength="0" maxlength="256"
                                        size="64" onblur="eventBlurEmail(arguments[0], this)"
                                        value="{{ old('delivery_destination_manager_mail', isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['delivery_destination_manager_mail'] : '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper td_100px grid_wrapper_right">納品先URL</div>
                            <div class="frame">
                                <div class="textbox">
                                    <a href="{{ old('delivery_destination_url', isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['delivery_destination_url'] : '') }}"
                                        id="url_delivery_destination_url" target="_blank">
                                        <img class="vector" src="/img/icon/link.svg" /></a>
                                    <input type="text" name="delivery_destination_url" class="element" minlength="0"
                                        maxlength="256" size="64" id="delivery_destination_url"
                                        onblur="eventBlurUrl(arguments[0], this)"
                                        value="{{ old('delivery_destination_url', isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['delivery_destination_url'] : '') }}" />
                                </div>
                            </div>
                        </div>
                    </div><br>
                </div>
            </div>

            <div class="box">
                <div class="element">
                    <div class="frame">
                        <div class="text_wrapper td_140px grid_wrapper_right txt_required">名称入力区分：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="name_input_kbn" value="0"
                                    @if (old('name_input_kbn') === '0' ||
                                            (null === old('name_input_kbn') &&
                                                isset($detailData['mtDeliveryDestination']) &&
                                                $detailData['mtDeliveryDestination']['name_input_kbn'] != '1') ||
                                            (null === old('name_input_kbn') && !isset($detailData['mtDeliveryDestination']))) checked @endif />
                                しない
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="name_input_kbn" value="1"
                                    @if (old('name_input_kbn') === '1' ||
                                            (null === old('name_input_kbn') &&
                                                isset($detailData['mtDeliveryDestination']) &&
                                                $detailData['mtDeliveryDestination']['name_input_kbn'] == '1')) checked @endif />
                                する
                            </label>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="text_wrapper td_140px grid_wrapper_right txt_required">削除区分（得意先）：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="del_kbn_customer" name="del_kbn_customer" value="0"
                                    @if (old('del_kbn_customer') === '0' ||
                                            (null === old('del_kbn_customer') &&
                                                isset($detailData['mtCustomerDeliveryDestination']) &&
                                                $detailData['mtCustomerDeliveryDestination']['del_kbn_customer'] != '1') ||
                                            (null === old('del_kbn_customer') && !isset($detailData['mtCustomerDeliveryDestination']))) checked @endif />
                                しない
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="del_kbn_customer" name="del_kbn_customer" value="1"
                                    @if (old('del_kbn_customer') === '1' ||
                                            (null === old('del_kbn_customer') &&
                                                isset($detailData['mtCustomerDeliveryDestination']) &&
                                                $detailData['mtCustomerDeliveryDestination']['del_kbn_customer'] == '1')) checked @endif />
                                する
                            </label>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="text_wrapper td_140px grid_wrapper_right txt_required">削除区分（納品先）：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="del_kbn_delivery_destination"
                                    onchange="changeDelKbnDeliveryDestination(arguments[0], this)"
                                    name="del_kbn_delivery_destination" value="0"
                                    @if (old('del_kbn_delivery_destination') === '0' ||
                                            (null === old('del_kbn_delivery_destination') &&
                                                isset($detailData['mtDeliveryDestination']) &&
                                                $detailData['mtDeliveryDestination']['del_kbn_delivery_destination'] != '1') ||
                                            (null === old('mtDeliveryDestination') && !isset($detailData['mtDeliveryDestination']))) checked @endif />
                                しない
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="del_kbn_delivery_destination"
                                    onchange="changeDelKbnDeliveryDestination(arguments[0], this)"
                                    name="del_kbn_delivery_destination" value="1"
                                    @if (old('del_kbn_delivery_destination') === '1' ||
                                            (null === old('del_kbn_delivery_destination') &&
                                                isset($detailData['mtDeliveryDestination']) &&
                                                $detailData['mtDeliveryDestination']['del_kbn_delivery_destination'] == '1')) checked @endif />
                                する
                            </label>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="text_wrapper td_140px grid_wrapper_right txt_required">登録種別 ：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="register_kind_flg" value="0"
                                    @if (old('register_kind_flg') === '0' ||
                                            (null === old('register_kind_flg') &&
                                                isset($detailData['mtCustomerDeliveryDestination']) &&
                                                $detailData['mtCustomerDeliveryDestination']['register_kind_flg'] != '1' &&
                                                (null === old('register_kind_flg') &&
                                                    isset($detailData['mtCustomerDeliveryDestination']) &&
                                                    $detailData['mtCustomerDeliveryDestination']['register_kind_flg'] != '2')) ||
                                            (null === old('register_kind_flg') && !isset($detailData['mtCustomerDeliveryDestination']))) checked @endif />
                                仮登録
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="register_kind_flg" value="1"
                                    @if (old('register_kind_flg') === '1' ||
                                            (null === old('register_kind_flg') &&
                                                isset($detailData['mtCustomerDeliveryDestination']) &&
                                                $detailData['mtCustomerDeliveryDestination']['register_kind_flg'] == '1')) checked @endif />
                                本登録
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="register_kind_flg" value="2"
                                    @if (old('register_kind_flg') === '2' ||
                                            (null === old('register_kind_flg') &&
                                                isset($detailData['mtCustomerDeliveryDestination']) &&
                                                $detailData['mtCustomerDeliveryDestination']['register_kind_flg'] == '2')) checked @endif />
                                EC表示不要
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">館内配送料</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="delivery_price" id="delivery_price" class="element"
                                minlength="0" maxlength="20" size="10" onblur="addFigure(this)"
                                @if (!empty(old('delivery_price'))) value="{{ old('delivery_price') }}"
                                @elseif(!empty(isset($detailData['mtDeliveryDestination'])))
                                    value="{{ number_format((int) $detailData['mtDeliveryDestination']['delivery_price']) }}" @endif />
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_required">
                        ルートコード
                        <span id="alert-danger-ul-root" class="alert alert-danger"></span>
                    </div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="mt_root_cd" class="element input_number_4" id="input_root"
                                onblur="blurCodeautoRoot(arguments[0], this)" data-limit-len="4" data-limit-minus
                                value="{{ old('mt_root_cd', isset($detailData['mtCustomerDeliveryDestination']) ? $detailData['mtCustomerDeliveryDestination']['root_cd'] : '') }}" />
                            <img class="vector" id="img_root" src="/img/icon/vector.svg"
                                data-smm-open="search_root_modal" />
                            <input type="hidden" id="hidden_root" value="" name="hidden_root" />
                        </div>
                        <div>
                            <input type="text" class="textbox td_120px txt_blue" id="names_root" name="mt_root_name"
                                readonly
                                value="{{ old('mt_root_name', isset($detailData['mtCustomerDeliveryDestination']) ? $detailData['mtCustomerDeliveryDestination']['root_name'] : '') }}" />
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_required">
                        運送会社
                        <span id="alert-danger-ul-item-class1" class="alert alert-danger"></span>
                    </div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="mt_item_class1_cd" class="element input_number_6"
                                id="input_item_class1_cd" onblur="blurCodeautoItemClass1(arguments[0], this)"
                                data-limit-len="6" data-limit-minus
                                value="{{ old('mt_item_class1_cd', isset($detailData['mtCustomerDeliveryDestination']) ? $detailData['mtCustomerDeliveryDestination']['item_class_cd'] : '') }}" />
                            <img class="vector" id="img_item_class1_cd" src="/img/icon/vector.svg"
                                data-smm-open="search_brand1_modal" />
                            <input type="hidden" id="hidden_item_class1_cd" value=""
                                name="hidden_item_class1_cd" />
                        </div>
                        <div>
                            <input type="text" class="textbox td_120px txt_blue" id="names_item_class1"
                                name="item_class1_name" readonly
                                value="{{ old('item_class1_name', isset($detailData['mtCustomerDeliveryDestination']) ? $detailData['mtCustomerDeliveryDestination']['item_class_name'] : '') }}" />
                        </div>
                    </div>
                </div>

                <div class="element-form element-form-columns">
                    <div class="text_wrapper">
                        納品先着日
                        <span id="alert-danger-ul-arrival-date" class="alert alert-danger"></span>
                    </div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="def_arrival_date_cd" id="input_arrival_date"
                                onblur="blurCodeautoArrivalDate(arguments[0], this)" class="element input_number_4"
                                data-limit-len="4" data-limit-minus
                                value="{{ old('def_arrival_date_cd', isset($detailData['mtCustomerDeliveryDestination']) ? $detailData['mtCustomerDeliveryDestination']['arrival_date_cd'] : '') }}" />
                            <img class="vector" id="img_arrival_date" src="/img/icon/vector.svg"
                                data-smm-open="search_arrival_date_modal" />
                            <input type="hidden" id="hidden_arrival_date" value="" name="hidden_arrival_date" />
                        </div>
                        <div>
                            <input type="text" class="textbox td_120px txt_blue" id="names_arrival_date"
                                name="arrival_date_name" readonly
                                value="{{ old('arrival_date_name', isset($detailData['mtCustomerDeliveryDestination']) ? $detailData['mtCustomerDeliveryDestination']['arrival_date_name'] : '') }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="element">
                    <div class="frame">
                        <div class="text_wrapper td_140px grid_wrapper_right txt_required">直送手数料請求：</div>
                        <div class="div">
                            <label class="text_wrapper_2 ">
                                <input type="radio" id="" name="direct_delivery_commission_demand_flg"
                                    value="1" @if (old('direct_delivery_commission_demand_flg') === '1' ||
                                            (null === old('direct_delivery_commission_demand_flg') &&
                                                isset($detailData['mtCustomerDeliveryDestination']) &&
                                                $detailData['mtCustomerDeliveryDestination']['direct_delivery_commission_demand_flg'] != '2') ||
                                            (null === old('direct_delivery_commission_demand_flg') && !isset($detailData['mtCustomerDeliveryDestination']))) checked @endif />
                                請求あり
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="direct_delivery_commission_demand_flg"
                                    value="2" @if (old('direct_delivery_commission_demand_flg') === '2' ||
                                            (null === old('direct_delivery_commission_demand_flg') &&
                                                isset($detailData['mtCustomerDeliveryDestination']) &&
                                                $detailData['mtCustomerDeliveryDestination']['direct_delivery_commission_demand_flg'] == '2')) checked @endif />
                                請求なし
                            </label>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="text_wrapper td_140px grid_wrapper_right txt_required">売上確定時印刷用紙：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="sale_decision_print_paper_flg" value="1"
                                    @if (old('sale_decision_print_paper_flg') === '1' ||
                                            (null === old('sale_decision_print_paper_flg') &&
                                                isset($detailData['mtCustomerDeliveryDestination']) &&
                                                $detailData['mtCustomerDeliveryDestination']['sale_decision_print_paper_flg'] != '2') ||
                                            (null === old('sale_decision_print_paper_flg') && !isset($detailData['mtCustomerDeliveryDestination']))) checked @endif />
                                納品書・返品申請書印刷
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="sale_decision_print_paper_flg" value="2"
                                    @if (old('sale_decision_print_paper_flg') === '2' ||
                                            (null === old('sale_decision_print_paper_flg') &&
                                                isset($detailData['mtCustomerDeliveryDestination']) &&
                                                $detailData['mtCustomerDeliveryDestination']['sale_decision_print_paper_flg'] == '2')) checked @endif />
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
                            <div class="text_wrapper">納品先備考1</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="delivery_destination_memo_1"
                                        id="delivery_destination_memo_1" class="element" minlength="0" maxlength="30"
                                        size="30"
                                        value="{{ old('delivery_destination_memo_1', isset($detailData['mtCustomerDeliveryDestination']) ? $detailData['mtCustomerDeliveryDestination']['delivery_destination_memo_1'] : '') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="element-form-columns">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">納品先備考2</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="delivery_destination_memo_2"
                                        id="delivery_destination_memo_2" class="element" minlength="0" maxlength="30"
                                        size="30"
                                        value="{{ old('delivery_destination_memo_2', isset($detailData['mtCustomerDeliveryDestination']) ? $detailData['mtCustomerDeliveryDestination']['delivery_destination_memo_2'] : '') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="element-form-columns">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">納品先備考3</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="delivery_destination_memo_3"
                                        id="delivery_destination_memo_3" class="element" minlength="0" maxlength="30"
                                        size="30"
                                        value="{{ old('delivery_destination_memo_3', isset($detailData['mtCustomerDeliveryDestination']) ? $detailData['mtCustomerDeliveryDestination']['delivery_destination_memo_3'] : '') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="hidden_detail_id"
            value="{{ old('hidden_detail_id', isset($detailData['mtDeliveryDestination']) ? $detailData['mtDeliveryDestination']['id'] : '') }}">
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="update" name="update" class="display_none_all"></button>
        <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
        <button type="submit" id="redirect" name="redirect" class="display_none_all" value=""></button>
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.master.search.customer')
    @include('admin.master.search.delivery_destination')
    @include('admin.master.search.arrival_date')
    @include('admin.master.search.root')
    @include('admin.master.search.brand1')
    <script src="{{ asset('js/master/delivery/mt_delivery_destinations/details.js') }}"></script>
@endsection
