@extends('layouts.admin.app')
@section('page_title', 'PS区分別得意先掛率マスタ一覧入力')
@section('title', 'PS区分別得意先掛率マスタ一覧入力')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('master.price.mt_customer_other_item_rate.ps_kbn.update') }}" method="post"
        name="psKbnIndexForm">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    @if (isset($initData) && !$initData->onFirstPage())
                        <a href="{{ $initData->previousPageUrl() }}" rel="prev"><button class="div-wrapper"
                                type="button" name="back">
                                <div class="text_wrapper_2">前頁</div>
                            </button></a>
                    @endif
                    @if (isset($initData) && $initData->hasMorePages())
                        <a href="{{ $initData->nextPageUrl() }}" rel="next"><button class="div-wrapper" type="button"
                                name="next">
                                <div class="text_wrapper_2">次頁</div>
                            </button></a>
                    @endif
                    <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value="" class="button-2"
                        data-url="" name="update2">
                        <div class="text_wrapper_3">登録する</div>
                    </button>
                </div>
            </div>

            <div class="box">
                <div class="element-form-rows">
                    <div class="element-form">
                        <div class="text_wrapper">P/S区分</div>
                        <div class="frame">
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="ps_kbn" value="0" checked>
                                    プロパー
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="group">
                    <div class="element">
                        <div class="text_wrapper">対象得意先分類</div>
                        <div class="frame">
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="customer_class_thing_id_1" name='customer_class_thing_id'
                                        onclick="psKbnClick()" value='1'
                                        @if (Session::has('customer_class_thing_id') && session('customer_class_thing_id') === '1') checked @elseif(null !== Session::has('customer_class_thing_id')) checked @endif />
                                    販売パターン1
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="customer_class_thing_id_2" name='customer_class_thing_id'
                                        onclick="psKbnClick()" value='2'
                                        @if (Session::has('customer_class_thing_id') && session('customer_class_thing_id') === '2') checked @endif />
                                    業種・特徴2
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="customer_class_thing_id_3" name='customer_class_thing_id'
                                        onclick="psKbnClick()" value='3'
                                        @if (Session::has('customer_class_thing_id') && session('customer_class_thing_id') === '3') checked @endif />
                                    ランク3
                                </label>
                            </div>
                        </div>
                    </div>
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
            <div class="box">
                <div class="element-form-rows">
                    @if (Session::has('customer_class_thing_id') && session('customer_class_thing_id') !== '1')
                        <div class="element-form" id="customer_class_thing_1" style="display: none;">
                        @else
                            <div class="element-form" id="customer_class_thing_1">
                    @endif
                    <div class="text_wrapper" id="customer_class_name">販売パターン1</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="customer_class_cd" class="element" id='input_customer_class1_code'
                                onblur="eventBlurCodeautoCustomerClassRedirect(arguments[0], this)" minlength="0"
                                maxlength="6" size="6"
                                value="@if (Session::has('customer_class_thing_id') &&
                                        session('customer_class_thing_id') === '1' &&
                                        Session::has('customer_class_code')) {{ session('customer_class_code') }} @endif" />
                            <img class="vector" id="img_customer_class1_code" src="{{ asset('/img/icon/vector.svg') }}"
                                data-smm-open="search_customer_class_thing1_modal" />
                        </div>
                        <input type="hidden" id="hidden_customer_class1_code" value=""
                            name="hidden_customer_class1_code" />
                        <div class="textbox td_200px" id="names_customer_class1_code">
                            @if (isset($customerClassInfo) && $customerClassInfo['def_customer_class_thing_id'] === 1)
                                {{ $customerClassInfo['customer_class_name'] }}
                            @endif
                        </div>
                    </div>
                </div>
                @if (Session::has('customer_class_thing_id') && session('customer_class_thing_id') === '2')
                    <div class="element-form" id="customer_class_thing_2" style="display: inline-flex;">
                    @else
                        <div class="element-form" id="customer_class_thing_2" style="display: none;">
                @endif
                <div class="text_wrapper" id="customer_class_name">業種・特徴2</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="customer_class_cd" class="element" id='input_customer_class2_code'
                            onblur="eventBlurCodeautoCustomerClassRedirect(arguments[0], this)" minlength="0"
                            maxlength="6" size="6"
                            value="@if (Session::has('customer_class_thing_id') &&
                                    session('customer_class_thing_id') === '2' &&
                                    Session::has('customer_class_code')) {{ session('customer_class_code') }} @endif" />
                        <img class="vector" id="img_customer_class2_code" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_customer_class_thing2_modal" />
                    </div>
                    <input type="hidden" id="hidden_customer_class2_code" value=""
                        name="hidden_customer_class1_code" />
                    <div class="textbox td_200px" id="names_customer_class2_code">
                        @if (isset($customerClassInfo) && $customerClassInfo['def_customer_class_thing_id'] === 2)
                            {{ $customerClassInfo['customer_class_name'] }}
                        @endif
                    </div>
                </div>
            </div>
            @if (Session::has('customer_class_thing_id') && session('customer_class_thing_id') === '3')
                <div class="element-form " id="customer_class_thing_3" style="display: inline-flex;">
                @else
                    <div class="element-form " id="customer_class_thing_3" style="display: none;">
            @endif
            <div class="text_wrapper" id="customer_class_name">ランク3</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="customer_class_cd" class="element" id='input_customer_class3_code'
                        onblur="eventBlurCodeautoCustomerClassRedirect(arguments[0], this)" minlength="0" maxlength="6"
                        size="6"
                        value="@if (Session::has('customer_class_thing_id') &&
                                session('customer_class_thing_id') === '3' &&
                                Session::has('customer_class_code')) {{ session('customer_class_code') }} @endif" />
                    <img class="vector" id="img_customer_class3_code" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_rank3_modal" />
                </div>
                <input type="hidden" id="hidden_customer_class3_code" value=""
                    name="hidden_customer_class1_code" />
                <div class="textbox td_200px" id="names_customer_class3_code">
                    @if (isset($customerClassInfo) && $customerClassInfo['def_customer_class_thing_id'] === 3)
                        {{ $customerClassInfo['customer_class_name'] }}
                    @endif
                </div>
            </div>
        </div>
        </div>
        </div>
        <div class="box">
            <div class="element-form element-form-rows ml_40p">
                <div class="text_wrapper label">一括設定</div>
                <div class="frame">
                    <div class="textbox disabled_color">
                        <input type="text" name="name" class="element textbox_40px" minlength="0" maxlength="4"
                            value="" disabled>年
                        <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2"
                            value="" disabled>月
                        <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2"
                            value="" disabled>日
                        <img src="/img/icon/calender.svg">
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox disabled_color">
                        <input type="text" name="name" class="element textbox_40px" minlength="0" maxlength="4"
                            value="" disabled>年
                        <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2"
                            value="" disabled>月
                        <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2"
                            value="" disabled>日
                        <img src="/img/icon/calender.svg">
                    </div>
                </div>
            </div><br>
            <div class="grid">
                <table>
                    <thead class="grid_header">
                        <tr>
                            <td colspan="3" class="grid_wrapper_center td_380px">得意先</td>
                            <td colspan="2" class="grid_wrapper_center td_60px">掛率</td>
                            <td class="grid_wrapper_center td_200px">セール開始日付</td>
                            <td class="grid_wrapper_center col_rec_noline td_10px"></td>
                            <td class="grid_wrapper_center td_200px">セール終了日付</td>
                        </tr>
                    </thead>
                    <tbody class="grid_body">
                        @if (isset($initData) && count($initData) > 0)
                            @php $i=0; @endphp
                            @foreach ($initData as $data)
                                <tr class="">
                                    <td class="grid_col_6 col_rec col_rec td_100px">{{ $data['customer_cd'] }}</td>
                                    <td class="grid_col_2 col_rec td_200px">{{ $data['customer_name'] }}</td>
                                    <td class="grid_col_2 col_rec td_60px">
                                        @if ($data['tax_kbn'] === 1)
                                            {{ '税抜' }}
                                        @elseif($data['tax_kbn'] === 2)
                                            {{ '税込' }}
                                        @endif
                                    </td>
                                    <td class="grid_col_2 col_rec td_50px"><input type="text" name="price_rate[]"
                                            value="{{ $data['price_rate'] }}" placeholder="" class="grid_textbox"
                                            minlength="0" maxlength="3"></td>
                                    <td class="grid_col_2 col_rec_noline td_20px">%</td>
                                    <td class="grid_col_4 col_rec disabled_color">
                                        <input type="text" placeholder="" class="grid_textbox grid_textbox_25em "
                                            minlength="0" maxlength="4" disabled>年
                                        <input type="text" placeholder="" class="grid_textbox grid_textbox_15em"
                                            minlength="0" maxlength="2" disabled>月
                                        <input type="text" placeholder="" class="grid_textbox grid_textbox_15em"
                                            minlength="0" maxlength="2" disabled>日
                                        <img src="/img/icon/calender.svg" class="img_calender">
                                    </td>
                                    <td class="grid_col_4 col_rec col_rec_noline disabled_color">
                                        ～
                                    </td>
                                    <td class="grid_col_4 col_rec disabled_color">
                                        <input type="text" placeholder="" class="grid_textbox grid_textbox_25em"
                                            minlength="0" maxlength="4" disabled>年
                                        <input type="text" placeholder="" class="grid_textbox grid_textbox_15em"
                                            minlength="0" maxlength="2" disabled>月
                                        <input type="text" placeholder="" class="grid_textbox grid_textbox_15em"
                                            minlength="0" maxlength="2" disabled>日
                                        <img src="/img/icon/calender.svg" class="img_calender">
                                    </td>
                                </tr>
                                <input type="hidden" id="hidden_customer_id" name="hidden_customer_id[]"
                                    value="{{ $data['customer_id'] }}" />
                            @endforeach
                            @php $i++; @endphp
                        @else
                            @for ($i = 0; $i < 20; $i++)
                                <tr class="">
                                    <td class="grid_col_6 col_rec col_rec td_100px"></td>
                                    <td class="grid_col_2 col_rec td_200px"></td>
                                    <td class="grid_col_2 col_rec td_60px"></td>
                                    <td class="grid_col_2 col_rec td_50px"></td>
                                    <td class="grid_col_2 col_rec_noline td_20px">%</td>
                                    <td class="grid_col_4 col_rec disabled_color">
                                        <input type="text" placeholder="" class="grid_textbox grid_textbox_25em "
                                            minlength="0" maxlength="4" disabled>年
                                        <input type="text" placeholder="" class="grid_textbox grid_textbox_15em"
                                            minlength="0" maxlength="2" disabled>月
                                        <input type="text" placeholder="" class="grid_textbox grid_textbox_15em"
                                            minlength="0" maxlength="2" disabled>日
                                        <img src="/img/icon/calender.svg" class="img_calender">
                                    </td>
                                    <td class="grid_col_4 col_rec col_rec_noline disabled_color">
                                        ～
                                    </td>
                                    <td class="grid_col_4 col_rec disabled_color">
                                        <input type="text" placeholder="" class="grid_textbox grid_textbox_25em"
                                            minlength="0" maxlength="4" disabled>年
                                        <input type="text" placeholder="" class="grid_textbox grid_textbox_15em"
                                            minlength="0" maxlength="2" disabled>月
                                        <input type="text" placeholder="" class="grid_textbox grid_textbox_15em"
                                            minlength="0" maxlength="2" disabled>日
                                        <img src="/img/icon/calender.svg" class="img_calender">
                                    </td>
                                </tr>
                            @endfor
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="update" name="update" class="display_none_all"></button>
        <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
        <button type="submit" id="redirect" name="redirect" class="display_none_all" value=""></button>
        <input type="hidden" id="redirect_hidden" name="redirect_hidden" class="display_none_all" value="" />
        <input type="hidden" id="hidden_input_customer_class_name" name="hidden_input_customer_class_name"
            class="display_none_all" value="" />
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.master.search.customer_class_thing1', ['customerClass1Data' => $customerClass1Data])
    @include('admin.master.search.customer_class_thing2', ['customerClass2Data' => $customerClass2Data])
    @include('admin.master.search.rank3', ['rank3Data' => $rank3Data])
@endsection
