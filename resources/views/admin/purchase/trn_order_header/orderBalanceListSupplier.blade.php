@extends('layouts.admin.app')
@section('page_title', '発注残一覧表（仕入先別納期別）')
@section('title', '発注残一覧表（仕入先別納期別）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('purchase_management.order.order_balance.list.supplier.export') }}" method="post">
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
                <div class="text_wrapper label">仕入先コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="supplier_code_start" id="input_supplier_code_start" class="element"
                            minlength="0" maxlength="6" size="6" value="" />
                        <img class="vector" id="img_supplier_code_start" src="/img/icon/vector.svg"
                            data-smm-open="search_supplier_modal">
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="supplier_code_end" id="input_supplier_code_end" class="element"
                            minlength="0" maxlength="6" size="6" value="" />
                        <img class="vector" id="img_supplier_code_end" src="/img/icon/vector.svg"
                            data-smm-open="search_supplier_modal">
                    </div>
                </div>
                <input type="hidden" name="hidden_supplier_code_start" id="hidden_supplier_code_start">
                <input type="hidden" name="hidden_supplier_code_end" id="hidden_supplier_code_end">
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">対象納期日付</div>
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
        </div>
    </form>
    @include('admin.master.search.supplier', ['supplierData' => $supplierData])
@endsection
