@extends('layouts.admin.app')
@section('page_title', '発注残一覧表（商品別納期別）')
@section('title', '発注残一覧表（商品別納期別）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('purchase_management.order.order_balance.list.item.export') }}" method="post">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button class="button" type="submit" name="cancel">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="excel">
                        <div class="text_wrapper_2">Excelへ出力</div>
                    </button>
                </div>
            </div>

            <div class="element-form element-form-rows">
                <div class="text_wrapper label">商品コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="item_code_start" id="input_item_cd1" class="element" minlength="0"
                            maxlength="9" size="9" value="" />
                        <img class="vector" id="img_item_cd1" src="/img/icon/vector.svg"
                            data-smm-open="search_item_cd_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="item_code_end" id="input_item_cd2" class="element" minlength="0"
                            maxlength="9" size="9" value="" />
                        <img class="vector" id="img_item_cd2" src="/img/icon/vector.svg"
                            data-smm-open="search_item_cd_modal" />
                    </div>
                </div>
                <input type="hidden" id="hidden_item_cd1" value="" name="hidden_item_cd1" />
                <input type="hidden" id="hidden_item_cd2" value="" name="hidden_item_cd2" />
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">対象日付</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="name" class="element textbox_40px" minlength="0" maxlength="4"
                            value="{{ date('Y') }}">年
                        <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ date('m') }}">月
                        <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ date('d') }}">日
                        <img src="/img/icon/calender.svg">
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="name" class="element textbox_40px" minlength="0" maxlength="4"
                            value="{{ date('Y') }}">年
                        <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ date('m') }}">月
                        <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ date('d') }}">日
                        <img src="/img/icon/calender.svg">
                    </div>
                </div>
            </div><br>
        </div>
    </form>
    @include('admin.master.search.item_cd', ['itemData' => $itemData])
@endsection
