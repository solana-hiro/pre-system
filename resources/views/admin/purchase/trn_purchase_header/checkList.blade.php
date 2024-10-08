@extends('layouts.admin.app')
@section('page_title', '仕入チェックリスト')
@section('title', '仕入チェックリスト')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('purchase_management.purchase.checklist.export') }}" method="post">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button class="button" type="submit" name="cancel">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button class="div-wrapper"type="submit" name="excel">
                        <div class="text_wrapper_2">Excelへ出力</div>
                    </button>
                </div>
            </div>
            <div class="element-form element-form-rows">
                <div class="text_wrapper">帳票区分：</div>
                <div class="frame">
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="0" name="report_kbn" value="0" />
                            伝票単位
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="1" name="report_kbn" value="1" checked />
                            商品単位
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="2" name="report_kbn" value="2" />
                            SKU単位(マトリックス)
                        </label>
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper">出力順：</div>
                <div class="frame">
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="output_kbn" value="1" checked />
                            入力日付+処理区分+仕入No.順
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="output_kbn" value="2" />
                            伝票日付+仕入No.順
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="output_kbn" value="3" />
                            伝票日付+担当者順
                        </label>
                    </div>
                </div>
            </div><br>
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
                <div class="text_wrapper">処理区分：</div>
                <div class="frame">
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="process_kbn" value="0" />
                            新規伝票
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="process_kbn" value="1" />
                            修正伝票
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="process_kbn" value="2" checked />
                            すべて
                        </label>
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">入力者コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="user_cd_start" class="element" minlength="0" maxlength="4"
                            size="4" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="user_cd_end" class="element" minlength="0" maxlength="4"
                            size="4" />
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
                    <input type="hidden" name="hidden_supplier_code_start" id="hidden_supplier_code_start">
                    <input type="hidden" name="hidden_supplier_code_end" id="hidden_supplier_code_end">
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">担当者コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="manager_code_start" class="element" minlength="0" maxlength="4"
                            size="4" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="anager_code_start" class="element" minlength="0" maxlength="4"
                            size="4" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">仕入伝票No.範囲</div>
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
@endsection
