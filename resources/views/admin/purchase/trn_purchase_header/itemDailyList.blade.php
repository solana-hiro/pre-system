@extends('layouts.admin.app')
@section('page_title', '商品仕入日計表')
@section('title', '商品仕入日計表')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('purchase_management.purchase.item_daily.list.export') }}" method="post">
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
                <div class="text_wrapper label">対象日付</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="year_start" class="element textbox_40px" minlength="0" maxlength="4"
                            value="{{ date('Y') }}">年
                        <input type="text" name="month_start" class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ date('m') }}">月
                        <input type="text" name="day_start" class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ date('d') }}">日
                        <img src="/img/icon/calender.svg">
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="year_end" class="element textbox_40px" minlength="0" maxlength="4"
                            value="{{ date('Y') }}">年
                        <input type="text" name="month_end" class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ date('m') }}">月
                        <input type="text" name="day_end" class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ date('d') }}">日
                        <img src="/img/icon/calender.svg">
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">商品コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="item_code_start" id="input_item_code_start" class="element"
                            minlength="0" maxlength="9" size="9" value="" />
                        <img class="vector" id="img_item_code_start" src="/img/icon/vector.svg"
                            data-smm-open="search_item_cd_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="item_code_end" id="input_item_code_end" class="element" minlength="0"
                            maxlength="9" size="9" value="" />
                        <img class="vector" id="img_item_code_end" src="/img/icon/vector.svg"
                            data-smm-open="search_item_cd_modal" />
                    </div>
                    <input type="hidden" id="hidden_item_code_start" value="" name="hidden_item_code_start" />
                    <input type="hidden" id="hidden_item_code_end" value="" name="hidden_item_code_end" />
                </div>
            </div>
        </div>
    </form>
    @include('admin.master.search.item_cd', ['itemData' => $itemData])
@endsection
