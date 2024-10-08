@extends('layouts.admin.app')
@section('page_title', 'ピッキングリスト発行')
@section('title', 'ピッキングリスト発行')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <div class="main-area">
        <form role="search" action="{{ route('sales_management.shipping.picking_list.issue.export') }}" method="post">
            @csrf
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
            @endif
            <div class="alert alert-danger">
                <ul id="alert-danger-ul">
            </div>

            <div class="element-form element-form-rows">
                <div class="text_wrapper label txt_required">指定納期</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" id="calendar1-year" name="date_year" class="element textbox_40px"
                            minlength="0" maxlength="4" value="{{ old('date_year', date('Y')) }}">年
                        <input type="text" id="calendar1-month" name="date_month" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ old('date_month', date('m')) }}">月
                        <input type="text" id="calendar1-date" name="date_day" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ old('date_day', date('d')) }}">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label txt_required">受注No.範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" id="input_order_receive_number_start" name="order_receive_number_start"
                            class="element" minlength="0" maxlength="8" size="8"
                            value="{{ old('order_receive_number_start', '') }}" />
                        <img class="vector" id="img_order_receive_number_start" src="/img/icon/vector.svg" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" id="input_order_receive_number_end" name="order_receive_number_end"
                            class="element" minlength="0" maxlength="8" size="8"
                            value="{{ old('order_receive_number_start', '') }}" />
                        <img class="vector" id="img_order_receive_number_end" src="/img/icon/vector.svg" />
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label txt_required">得意先コード</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="customer_start" id="input_customer_start" class="element" minlength="0"
                            maxlength="6" size="6" value="{{ old('customer_start', '') }}" />
                        <img class="vector" id="img_customer_start" src="/img/icon/vector.svg"
                            data-smm-open="search_customer_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="customer_end" id="input_customer_end" class="element" minlength="0"
                            maxlength="6" size="6" value="{{ old('customer_end', '') }}" />
                        <img class="vector" id="img_customer_end" src="/img/icon/vector.svg"
                            data-smm-open="search_customer_modal" />
                    </div>
                    <input type="hidden" id="hidden_customer_start" value="" name="hidden_customer_start" />
                    <input type="hidden" id="hidden_customer_end" value="" name="hidden_customer_end" />
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label txt_required">納品先コード</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="delivery_destination_start" id="input_delivery_destination_start"
                            class="element" minlength="0" maxlength="6" size="6"
                            value="{{ old('delivery_destination_start', '') }}" />
                        <img class="vector" id="img_delivery_destination_start" src="/img/icon/vector.svg"
                            data-smm-open="search_delivery_destination_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="delivery_destination_end" id="input_delivery_destination_end"
                            class="element" minlength="0" maxlength="6" size="6"
                            value="{{ old('delivery_destination_end', '') }}" />
                        <img class="vector" id="img_delivery_destination_end" src="/img/icon/vector.svg"
                            data-smm-open="search_delivery_destination_modal" />
                    </div>
                    <input type="hidden" id="hidden_delivery_destination_start" value=""
                        name="hidden_delivery_destination_start" />
                    <input type="hidden" id="hidden_delivery_destination_end" value=""
                        name="hidden_delivery_destination_end" />
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label txt_required">ルートコード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="root_start" id="input_root_start" class="element" minlength="0"
                            maxlength="4" size="4" value="{{ old('input_root_start', '') }}" />
                        <img class="vector" id="img_root_start" src="/img/icon/vector.svg"
                            data-smm-open="search_root_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="root_end" id="input_root_end" class="element" minlength="0"
                            maxlength="4" size="4" value="{{ old('input_root_end', '') }}" />
                        <img class="vector" id="img_root_end" src="/img/icon/vector.svg"
                            data-smm-open="search_root_modal" />
                    </div>
                    <input type="hidden" id="hidden_root_start" value="" name="hidden_root" />
                    <input type="hidden" id="hidden_root_end" value="" name="hidden_root" />
                </div>
            </div><br>
            <div class="box">
                <div class="group">
                    <div class="element-form element-form-columns">
                        <div class="frame">
                            <div class="text_wrapper td_100px grid_wrapper_right">直納区分：</div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="direct_delivery_kbn" value="0" />
                                    直納
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="direct_delivery_kbn" value="1"
                                        checked />
                                    すべて
                                </label>
                            </div>
                        </div>
                    </div><br>
                    <div class="frame">
                        <div class="text_wrapper td_100px grid_wrapper_right">発行区分：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="picking_list_output_flg" value="0"
                                    checked />
                                未発行
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="picking_list_output_flg" value="1" />
                                発行済
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="picking_list_output_flg" value="2" />
                                すべて
                            </label>
                        </div>
                    </div><br><br>
                    <div class="frame">
                        <div class="text_wrapper td_100px grid_wrapper_right">棚番：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="shelf_number" value="0" />
                                有り
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="shelf_number" value="1" />
                                無し
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="shelf_number" value="2" checked />
                                すべて
                            </label>
                        </div>
                    </div><br><br>
                    <div class="frame">
                        <div class="text_wrapper td_100px grid_wrapper_right">運送会社区分：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="item_class_cd" value="0" checked />
                                日本郵政以外
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="item_class_cd" value="1" />
                                すべて
                            </label>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>
    @include('admin.master.search.customer', ['customerData' => $customerData])
    @include('admin.master.search.delivery_destination', [
        'deliveryDestinationData' => $deliveryDestinationData,
    ])
    @include('admin.master.search.root', ['rootData' => $rootData])
    @include('admin.common.calendar', ['calendarId' => 'calendar1'])
    </div>
    <script>
        const inputBox1 = document.getElementById("input_order_receive_number_start");
        const outputBox1 = document.getElementById("input_order_receive_number_end");
        const inputBox2 = document.getElementById("input_customer_start");
        const outputBox2 = document.getElementById("input_customer_end");
        const inputBox3 = document.getElementById("input_delivery_destination_start");
        const outputBox3 = document.getElementById("input_delivery_destination_end");
        const inputBox4 = document.getElementById("input_root_start");
        const outputBox4 = document.getElementById("input_root_end");
        inputBox1.onblur = function() {
            if ("" !== inputBox1.value) {
                inputBox1.value = inputBox1.value.toString().padStart(8, '0');
            }
        };
        outputBox1.onblur = function() {
            if ("" !== outputBox1.value) {
                outputBox1.value = outputBox1.value.toString().padStart(8, '0');
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
        inputBox3.onblur = function() {
            if ("" !== inputBox3.value) {
                inputBox3.value = inputBox3.value.toString().padStart(6, '0');
            }
        };
        outputBox3.onblur = function() {
            if ("" !== outputBox3.value) {
                outputBox3.value = outputBox3.value.toString().padStart(6, '0');
            }
        };
        inputBox4.onblur = function() {
            if ("" !== inputBox4.value) {
                inputBox4.value = inputBox4.value.toString().padStart(4, '0');
            }
        };
        outputBox4.onblur = function() {
            if ("" !== outputBox4.value) {
                outputBox4.value = outputBox4.value.toString().padStart(4, '0');
            }
        };
    </script>
@endsection
