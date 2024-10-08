@extends('layouts.admin.app')
@section('page_title', '発注伝票一括発行')
@section('title', '発注伝票一括発行')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('purchase_management.order.slip.issue.export') }}" method="post">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button class="button" type="submit" name="cancel">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="preview" onclick="this.form.target='_blank'">
                        <div class="text_wrapper_2">プレビューを見る</div>
                    </button>
                </div>
            </div>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">対象伝票日付</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="year_start" class="element textbox_40px" minlength="0" maxlength="4"
                            value="{{ date('Y') }}">年
                        <input type="text" name="month_start" class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ date('m') }}">月
                        <input type="text" name="day_start" class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ date('Y') }}">日
                        <img src="/img/icon/calender.svg">
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="year_end" class="element textbox_40px" minlength="0" maxlength="4"
                            value="{{ date('Y') }}">年
                        <input type="text" name="month_end" class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ date('Y') }}">月
                        <input type="text" name="day_end" class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ date('Y') }}">日
                        <img src="/img/icon/calender.svg">
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">入力者コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" id="user_cd_start" name="user_cd_start" class="element" minlength="0"
                            maxlength="4" size="4" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" id="user_cd_end" name="user_cd_end" class="element" minlength="0"
                            maxlength="4" size="4" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                </div>
            </div><br>
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
                <div class="text_wrapper label">伝票No.範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="slip_no_start" class="element" minlength="0" maxlength="8"
                            size="8" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="slip_no_end" class="element" minlength="0" maxlength="8"
                            size="8" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                </div>
            </div><br>
        </div>
    </form>
    @include('admin.master.search.supplier', ['supplierData' => $supplierData])
    <script>
        const inputBox1 = document.getElementById("user_cd_start");
        const outputBox1 = document.getElementById("user_cd_end");
        const inputBox2 = document.getElementById("supplier_cd_start");
        const outputBox2 = document.getElementById("supplier_cd_end");
        inputBox1.onblur = function() {
            if ("" !== inputBox1.value) {
                inputBox1.value = inputBox1.value.toString().padStart(4, '0');
            }
        };
        outputBox1.onblur = function() {
            if ("" !== outputBox1.value) {
                outputBox1.value = outputBox1.value.toString().padStart(4, '0');
            }
        };
        inputBox2.onblur = function() {
            if ("" !== inputBox2.value) {
                inputBox2.value = inputBox2.value.toString().padStart(6, '0');
            }
        };
        outputBox2.onblur = function() {
            if ("" !== outputBox2.value) {
                outputBox2.value = outputBox2.value.toString().padStart(6, '0');
            }
        };
    </script>
@endsection
