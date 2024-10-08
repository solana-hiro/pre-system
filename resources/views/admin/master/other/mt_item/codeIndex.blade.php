@extends('layouts.admin.app')
@section('page_title', '商品コード変更処理')
@section('title', '商品コード変更処理')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
    <script src="{{ asset('js/master/other/mt_item/codeindex.js') }}"></script>
@endsection
@section('content')
    <form role="search" action="{{ route('master.other.mt_item.item_cd.update') }}" method="post" id="mtItemChangeForm">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value="" class="button-2"
                        data-url="" name="update2">
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
            <div class="box">
                <div class="group">
                    <div class="element">
                        <div class="text_wrapper">変更区分</div>
                        <div class="frame">
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="change_kbn_1" name="change_kbn" value="1"
                                        onclick="itemChangeKbnClick()" @if (old('change_kbn') === '1' || null === old('change_kbn')) checked @endif>
                                    商品コード
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="change_kbn_2" name="change_kbn" value="2"
                                        onclick="itemChangeKbnClick()" @if (old('change_kbn') === '2') checked @endif>
                                    商品コード＋カラーコード
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="change_kbn_3" name="change_kbn" value="3"
                                        onclick="itemChangeKbnClick()" @if (old('change_kbn') === '3') checked @endif>
                                    商品コード＋サイズコード
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="diff_contents">
                    <div class="diff_left_contents">
                        <p class="diff_text">変更前情報</p>
                        <div class="diff_box">
                            <div class="grid" id="item1" style="visibility: visible;">
                                <span id="alert_before_item" class="alert alert-danger text-left"></span>
                                <table class="table_100">
                                    <thead class="grid_header">
                                        <tr>
                                            <td colspan="2" class="grid_wrapper_center td_100p">商品コード/名称</td>
                                        </tr>
                                    </thead>
                                    <tbody class="grid_body">
                                        <tr>
                                            <td class="grid_col_2 col_rec td_30p">
                                                <div class="flex">
                                                    <input type="text" id="input_before_item"
                                                        onblur="eventBlurCodeautoItem(arguments[0], this)"
                                                        name="before_item_code" placeholder="" class="grid_textbox"
                                                        minlength="0" maxlength="9"
                                                        value="{{ old('before_item_code') }}"
                                                    >
                                                    <img class="vector" id="img_item_code" src="/img/icon/vector.svg"
                                                        data-smm-open="search_item_cd_modal" 
                                                    />
                                                </div>
                                            </td>
                                            <input type="hidden" id="hidden_item" value="" name="hidden_item" />
                                            <td class="grid_col_2 col_rec td_70p" id="">
                                                <input type="text"
                                                    placeholder="" id="name_before_item" name="name_before_item" class="grid_textbox"
                                                    minlength="0" maxlength="" readonly
                                                    value="{{ old('name_before_item') }}"
                                                >
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @if (old('change_kbn') === '2')
                                <div class="grid" id="item2" style="visibility: visible;">
                                @else
                                    <div class="grid" id="item2" style="visibility: hidden;">
                            @endif
                            <span id="alert_before_color" class="alert alert-danger text-left"></span>
                            <table class="table_100">
                                <thead class="grid_header">
                                    <tr>
                                        <td colspan="2" class="grid_wrapper_center td_100p">カラーコード/名称</td>
                                    </tr>
                                </thead>
                                <tbody class="grid_body">
                                    <tr>
                                        <td class="grid_col_2 col_rec td_70p">
                                        <select class="grid_textbox"
                                            name="before_color_code" id="before_color_code"
                                            value="{{old('before_color_code')}}"
                                            onchange="eventChangeBeforeColor(arguments[0], this)"
                                        >
                                            <option></option>
                                        </select>
                                        </td>
                                        <input type="hidden" id="hidden_color" value="{{ old('hidden_color') }}" name="hidden_color" />
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @if (old('change_kbn') === '3')
                            <div class="grid" id="item3" style="visibility: visible;">
                            @else
                                <div class="grid" id="item3" style="visibility: hidden;">
                        @endif
                        <span id="alert_before_size" class="alert alert-danger text-left"></span>
                        <table class="table_100">
                            <thead class="grid_header">
                                <tr>
                                    <td colspan="2" class="grid_wrapper_center td_100p">サイズコード/名称</td>
                                </tr>
                            </thead>
                            <tbody class="grid_body">
                                <tr>
                                    <td class="grid_col_2 col_rec td_70p">
                                        <select class="grid_textbox"
                                            name="before_size_code" id="before_size_code"
                                            value="{{old('before_size_code')}}"
                                            onchange="eventChangeBeforeSize(arguments[0], this)"
                                        >
                                            <option></option>
                                        </select>
                                    </td>
                                    <input type="hidden" id="hidden_size" value="{{ old('hidden_size') }}" name="hidden_size" />
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="diff_center_contents">
                <img src="{{ asset('/img/icon/arrow-right-blue.svg') }}">
                <img src="{{ asset('/img/icon/arrow-right-blue.svg') }}">
                <img src="{{ asset('/img/icon/arrow-right-blue.svg') }}">
            </div>
            <div class="diff_right_contents">
                <p class="diff_text">変更後情報</p>
                <div class="diff_box">
                    @if (old('change_kbn') === '1' || null === old('change_kbn'))
                        <div class="grid" id="item4" style="visibility: vidible;">
                    @else
                        <div class="grid" id="item4" style="visibility: hidden;">
                    @endif
                    <span id="alert_after_item" class="alert alert-danger text-left"></span>
                    <table class="table_100">
                        <thead class="grid_header">
                            <tr>
                                <td class="grid_wrapper_center td_100p">商品コード</td>
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            <tr>
                                <td class="grid_col_2 col_rec  td_50p">
                                    <input type="text" placeholder=""
                                        onblur="eventBlurCodeautoItemAfter(arguments[0], this)"
                                        class="grid_textbox" minlength="0" maxlength="9" name="after_item_code"
                                        value="{{ old('after_item_code') }}"
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if (old('change_kbn') === '2')
                    <div class="grid" id="item5" style="visibility: visible;">
                    @else
                        <div class="grid" id="item5" style="visibility: hidden;">
                @endif
                <span id="alert_after_color" class="alert alert-danger text-left"></span>
                <table class="table_100">
                    <thead class="grid_header">
                        <tr>
                            <td colspan="2" class="grid_wrapper_center td_100p">カラーコード/名称</td>
                        </tr>
                    </thead>
                    <tbody class="grid_body">
                        <tr>
                            <td class="grid_col_2 col_rec td_30p">
                                <div class="flex">
                                    <input type="text" id="after_color_code"
                                        onblur="eventBlurCodeautoColor(arguments[0], this)"
                                        name="after_color_code" placeholder="" class="grid_textbox" minlength="0"
                                        maxlength="5"
                                        value="{{ old('after_color_code') }}"
                                    >
                                    <img class="vector" id="img_after_color" src="/img/icon/vector.svg"
                                        data-smm-open="search_color_modal"
                                    />
                                </div>
                            </td>
                            <td class="grid_col_2 col_rec td_70p" id="names_after_color">
                                <input type="text"
                                    placeholder="" id="name_after_color" name="name_after_color" class="grid_textbox"
                                    minlength="0" maxlength="" readonly
                                    value="{{ old('name_after_color') }}"
                                >
                            </td>
                            <input type="hidden" id="hidden_after_color" value="" name="hiddenafter__color" />
                        </tr>
                    </tbody>
                </table>
            </div>
            @if (old('change_kbn') === '3')
                <div class="grid" id="item6" style="visibility: visible;">
                @else
                    <div class="grid" id="item6" style="visibility: hidden;">
            @endif
            <span id="alert_after_size" class="alert alert-danger text-left"></span>
            <table class="table_100">
                <thead class="grid_header">
                    <tr>
                        <td colspan="2" class="grid_wrapper_center td_100p">サイズコード/名称</td>
                    </tr>
                </thead>
                <tbody class="grid_body">
                    <tr>
                        <td class="grid_col_2 col_rec td_30p">
                            <div class="flex">
                                <input type="text" id="after_size_code"
                                    onblur="eventBlurCodeautoSize(arguments[0], this)"
                                    name="after_size_code" placeholder="" class="grid_textbox" minlength="0"
                                    maxlength="5"
                                    value="{{ old('after_size_code') }}"
                                >
                                <img class="vector" id="img_after_size" src="/img/icon/vector.svg"
                                    data-smm-open="search_size_modal" 
                                />
                            </div>
                        </td>
                        <td class="grid_col_2 col_rec td_70p" id="names_after_size">
                            <input type="text"
                                placeholder="" id="name_after_size" name="name_after_size" class="grid_textbox"
                                minlength="0" maxlength="" readonly
                                value="{{ old('name_after_size') }}"
                            >
                        </td>
                        <input type="hidden" id="hidden_after_size" value="" name="hidden_after_size" />
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <input type="hidden" id="hidden_item_code" value="" name="hidden_item_code" />

        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="update" name="update" class="display_none_all"></button>
        @include('admin.master.search.item_cd')
        @include('admin.master.search.color')
        @include('admin.master.search.size')
        @include('components.menu.selected', ['view' => 'main'])
    </form>
@endsection
