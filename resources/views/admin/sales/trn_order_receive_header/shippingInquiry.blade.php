@extends('layouts.admin.app')
@section('page_title', '入出荷予定問合せ')
@section('title', '入出荷予定問合せ')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('sales_management.order_receive.in_shipping.inquiry.execute') }}" method="post">
        @csrf
        <div class="button_area">
            <div class="div">
                <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                    data-url="" name="cancel2">
                    <div class="text_wrapper">キャンセル</div>
                </button>
                <!--
                                <button class="div-wrapper" type="submit" name="preview" id="preview" onclick="this.form.target='_blank';"><div class="text_wrapper_2">プレビューを見る</div></button>
                    -->
                <button class="div-wrapper" type="submit" name="excel">
                    <div class="text_wrapper_2">Excelへ出力</div>
                </button>
                <button class="button-2" type="submit" name="search">
                    <div class="text_wrapper_3">実行する</div>
                </button>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @elseif (Session::has('sessionErrors'))
            <div class="alert alert-danger">
                <ul>
                    @foreach (session('sessionErrors') as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @elseif (Session::has('flashmessage'))
            <div class="alert alert-danger">
                <ul>
                    <li>{!! session('flashmessage') !!}</li>
                </ul>
            </div>
        @elseif (Session::has('errormessage'))
            <div class="alert alert-danger">
                <ul>
                    <li>{!! session('errormessage') !!}</li>
                </ul>
            </div>
        @endif
        <div class="alert alert-danger">
            <ul id="alert-danger-ul">
        </div>

        <div class="main-area">
            <div class="box">
                <div class="group">
                    <div class="element_row">
                        <div class="frame">
                            <div class="text_wrapper">出力対象：</div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" name="target" value="0" checked />
                                    すべて
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" name="target" value="1" />
                                    受注のみ
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" name="target" value="2" />
                                    発注のみ
                                </label>
                            </div>
                        </div>
                        <div class="frame">
                            <div class="element-form">
                                <div class="text_wrapper">対象日付：</div>
                                <div class="textbox">
                                    <input type="text" id="calendar1-year" name="start_date_y"
                                        class="element textbox_40px" minlength="0" maxlength="4" value="1900" />年
                                    <input type="text" id="calendar1-month" name="start_date_m"
                                        class="element textbox_24px" minlength="0" maxlength="2" value="01" />月
                                    <input type="text" id="calendar1-date" name="start_date_d"
                                        class="element textbox_24px" minlength="0" maxlength="2" value="01" />日
                                    <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
                                </div>
                                <div class="text_wrapper">～</div>
                                <div class="textbox">
                                    <input type="text" id="calendar2-year" name="end_date_y" class="element textbox_40px"
                                        minlength="0" maxlength="4" value="2050" />年
                                    <input type="text" id="calendar2-month" name="end_date_m"
                                        class="element textbox_24px" minlength="0" maxlength="2" value="12" />月
                                    <input type="text" id="calendar2-date" name="end_date_d"
                                        class="element textbox_24px" minlength="0" maxlength="2" value="31" />日
                                    <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar2')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="element-form-rows">
                <div class="element-form">
                    <div class="text_wrapper">商品コード範囲</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="start_item_code" id="input_item_code_start" class="element"
                                minlength="0" maxlength="9" size="9" />
                            <img class="vector" id="img_item_code_start" src="/img/icon/vector.svg"
                                data-smm-open="search_item_cd_modal" />
                        </div>
                        <div class="text_wrapper">～</div>
                        <div class="textbox">
                            <input type="text" name="end_item_code" id="input_item_code_end" class="element"
                                minlength="0" maxlength="9" size="9" />
                            <img class="vector" id="img_item_code_end" src="/img/icon/vector.svg"
                                data-smm-open="search_item_cd_modal" />
                        </div>
                    </div>
                    <input type="hidden" id="hidden_item_code_start" value="" name="hidden_item_code_start" />
                    <input type="hidden" id="hidden_item_code_end" value="" name="hidden_item_code_end" />
                </div>
                <div class="element-form">
                    <div class="text_wrapper">カラーコード範囲</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="start_color_code" id="input_color_start" class="element"
                                minlength="0" maxlength="5" size="5" />
                            <img class="vector" id="img_color_start" src="/img/icon/vector.svg"
                                data-smm-open="search_color_modal" />
                        </div>
                        <div class="text_wrapper">～</div>
                        <div class="textbox">
                            <input type="text" name="end_color_code" id="input_color_end" class="element"
                                minlength="0" maxlength="5" size="5" />
                            <img class="vector" id="img_color_end" src="/img/icon/vector.svg"
                                data-smm-open="search_color_modal" />
                        </div>
                        <input type="hidden" id="hidden_color_start" value="" name="hidden_color_start" />
                        <input type="hidden" id="hidden_color_end" value="" name="hidden_color_end" />
                    </div>
                </div>
            </div><br>
            <div class="element-form-rows">
                <div class="element-form">
                    <div class="text_wrapper">倉庫コード範囲</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="start_warehouse_code" id="input_warehouse_start" class="element"
                                minlength="0" maxlength="6" size="6" value="" />
                            <img class="vector" id="img_warehouse_start" src="/img/icon/vector.svg"
                                data-smm-open="search_warehouse_modal" />
                        </div>
                        <div class="text_wrapper">～</div>
                        <div class="textbox">
                            <input type="text" name="end_warehouse_code" id="input_warehouse_end" class="element"
                                minlength="0" maxlength="6" size="6" value="" />
                            <img class="vector" id="img_warehouse_end" src="/img/icon/vector.svg"
                                data-smm-open="search_warehouse_modal" />
                        </div>
                        <input type="hidden" id="hidden_warehouse_start" value=""
                            name="hidden_warehouse_start" />
                        <input type="hidden" id="hidden_warehouse_end" value="" name="hidden_warehouse_end" />
                    </div>
                </div>
                <div class="element-form">
                    <div class="text_wrapper">サイズコード範囲</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="start_size_code" id="input_size_start" class="element"
                                minlength="0" maxlength="5" size="5" />
                            <img class="vector" id="img_size_start" src="/img/icon/vector.svg"
                                data-smm-open="search_color_modal" />
                        </div>
                        <div class="text_wrapper">～</div>
                        <div class="textbox">
                            <input type="text" name="end_size_code" id="input_size_end" class="element"
                                minlength="0" maxlength="5" size="5" />
                            <img class="vector" id="img_size_end" src="/img/icon/vector.svg"
                                data-smm-open="search_color_modal" />
                        </div>
                        <input type="hidden" id="hidden_size_start" value="" name="hidden_size_start" />
                        <input type="hidden" id="hidden_size_end" value="" name="hidden_size_end" />
                    </div>
                </div>
            </div>
            <div class="grid mt-5">
                <table>
                    <thead class="grid_header">
                        <tr>
                            <td class="grid_wrapper_center td_10p">商品コード</td>
                            <td class="grid_wrapper_center td_20p">商品名</td>
                            <td class="grid_wrapper_center td_10p">カラーコード</td>
                            <td class="grid_wrapper_center td_15p">カラー名</td>
                            <td class="grid_wrapper_center td_10p">サイズコード</td>
                            <td class="grid_wrapper_center td_15p">サイズ名</td>
                            <td class="grid_wrapper_center td_15p">指定納期</td>
                            <td class="grid_wrapper_center td_15p">発注数量</td>
                            <td class="grid_wrapper_center td_15p">受注数量</td>
                            <td class="grid_wrapper_center td_15p">在庫予定数量</td>
                            <td class="grid_wrapper_center td_15p">受発注No</td>
                            <td class="grid_wrapper_center td_15p">行No</td>
                            <td class="grid_wrapper_center td_15p">受発注日付</td>
                            <td class="grid_wrapper_center td_15p">取引先コード</td>
                            <td class="grid_wrapper_center td_15p">取引先名</td>
                            <td class="grid_wrapper_center td_15p">オーダーNo</td>
                            <td class="grid_wrapper_center td_15p">倉庫コード</td>
                            <td class="grid_wrapper_center td_15p">倉庫名</td>
                        </tr>
                    </thead>
                    <tbody class="grid_body">
                        @if (Session::has('listDatas'))
                            @php
                                $prevItemCd = null;
                                $prevSizeCd = null;
                                $prevColorCd = null;
                                $orderAmountItem = null;
                                $receiveAmountItem = null;
                                $orderAmountColor = null;
                                $receiveAmountColor = null;
                                $orderAmountSize = null;
                                $receiveAmountSize = null;
                                $i = 0;
                            @endphp
                            @foreach (session('listDatas') as $data)
                                @php
                                    $itemAmountTag = null;
                                    $sizeAmountTag = null;
                                    $colorAmountTag = null;
                                    if ($i === 0) {
                                        $orderAmountItem = $data->order_quantity;
                                        $receiveAmountItem = $data->order_receive_quantity;
                                        $orderAmountSize = $data->order_quantity;
                                        $receiveAmountSize = $data->order_receive_quantity;
                                        $orderAmountColor = $data->order_quantity;
                                        $receiveAmountColor = $data->order_receive_quantity;
                                    }

                                    // size
                                    if ($i !== count(session('listDatas')) && !empty($prevSizeCd)) {
                                        if ($prevSizeCd === $data->size_cd) {
                                            $orderAmountSize += $data->order_quantity;
                                            $receiveAmountSize += $data->order_receive_quantity;
                                        } elseif ($prevSizeCd !== $data->size_cd) {
                                            $sizeAmountTag = [
                                                'orderAmountSize' => $orderAmountSize,
                                                'receiveAmountSize' => $receiveAmountSize,
                                            ];
                                            if ($i !== count(session('listDatas')) - 1) {
                                                $orderAmountSize = 0;
                                                $receiveAmountSize = 0;
                                            }
                                        }
                                    }

                                    // color
                                    if ($i !== count(session('listDatas')) && !empty($prevColorCd)) {
                                        if ($prevColorCd === $data->color_cd) {
                                            $orderAmountColor += $data->order_quantity;
                                            $receiveAmountColor += $data->order_receive_quantity;
                                        } elseif ($prevColorCd !== $data->color_cd) {
                                            $colorAmountTag = [
                                                'orderAmountColor' => $orderAmountColor,
                                                'receiveAmountColor' => $receiveAmountColor,
                                            ];
                                            if ($i !== count(session('listDatas')) - 1) {
                                                $orderAmountColor = 0;
                                                $receiveAmountColor = 0;
                                            }
                                        }
                                    }

                                    //item
                                    if ($i !== count(session('listDatas')) && !empty($prevItemCd)) {
                                        if ($prevItemCd === $data->item_cd) {
                                            $orderAmountItem += $data->order_quantity;
                                            $receiveAmountItem += $data->order_receive_quantity;
                                        } elseif ($prevItemCd !== $data->item_cd) {
                                            $itemAmountTag = [
                                                'orderAmountItem' => $orderAmountItem,
                                                'receiveAmountItem' => $receiveAmountItem,
                                            ];
                                            if ($i !== count(session('listDatas')) - 1) {
                                                $orderAmountItem = 0;
                                                $receiveAmountItem = 0;
                                            }
                                        }
                                    }

                                    $prevItemCd = $data->item_cd;
                                    $prevSizeCd = $data->size_cd;
                                    $prevColorCd = $data->color_cd;
                                    $i++;
                                @endphp
                                @if (!empty($sizeAmountTag))
                                    <tr class="amount_row">
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left">サイズ計</td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_right">
                                            {{ sprintf('%.1f', $sizeAmountTag['orderAmountSize']) }}</td>
                                        <td class="grid_wrapper_right">{{ $sizeAmountTag['receiveAmountSize'] }}</td>
                                        <td class="grid_wrapper_right"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                    </tr>
                                @endif
                                @if (!empty($colorAmountTag))
                                    <tr class="amount_row">
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left">カラー計</td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_right">
                                            {{ sprintf('%.1f', $colorAmountTag['orderAmountColor']) }}</td>
                                        <td class="grid_wrapper_right">{{ $colorAmountTag['receiveAmountColor'] }}</td>
                                        <td class="grid_wrapper_right"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                    </tr>
                                @endif
                                @if (!empty($itemAmountTag))
                                    <tr class="amount_row">
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left">商品計</td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_right">
                                            {{ sprintf('%.1f', $itemAmountTag['orderAmountItem']) }}</td>
                                        <td class="grid_wrapper_right">{{ $itemAmountTag['receiveAmountItem'] }}</td>
                                        <td class="grid_wrapper_right"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                        <td class="grid_wrapper_left"></td>
                                    </tr>
                                @endif

                                <tr>
                                    <td class="grid_wrapper_left">{{ $data->item_cd }}</td>
                                    <td class="grid_wrapper_left">{{ $data->item_name }}</td>
                                    <td class="grid_wrapper_left">{{ $data->color_cd }}</td>
                                    <td class="grid_wrapper_left">{{ $data->color_name }}</td>
                                    <td class="grid_wrapper_left">{{ $data->size_cd }}</td>
                                    <td class="grid_wrapper_left">{{ $data->size_name }}</td>
                                    <td class="grid_wrapper_left">{{ $data->deadline }}</td>
                                    <td class="grid_wrapper_right">{{ sprintf('%.1f', $data->order_quantity) }}</td>
                                    <td class="grid_wrapper_right">{{ $data->order_receive_quantity }}</td>
                                    <td class="grid_wrapper_right">{{ $data->now_stock_quantity }}</td>
                                    <td class="grid_wrapper_right">{{ $data->number }}</td>
                                    <td class="grid_wrapper_left">{{ $data->line_no }}</td>
                                    <td class="grid_wrapper_left">{{ $data->order_date }}</td>
                                    <td class="grid_wrapper_left">{{ $data->cs_cd }}</td>
                                    <td class="grid_wrapper_left">{{ $data->cs_name }}</td>
                                    <td class="grid_wrapper_left">{{ $data->order_number }}</td>
                                    <td class="grid_wrapper_left">{{ $data->warehouse_cd }}</td>
                                    <td class="grid_wrapper_left">{{ $data->warehouse_name }}</td>
                                    <input type="hidden" name="hidden_id" value="{{ $data->id }}">
                                </tr>
                            @endforeach
                            <tr class="amount_row">
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left">サイズ計</td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_right">{{ sprintf('%.1f', $orderAmountSize) }}</td>
                                <td class="grid_wrapper_right">{{ $receiveAmountSize }}</td>
                                <td class="grid_wrapper_right"></td>
                                <td class="grid_wrapper_right"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                            </tr>
                            <tr class="amount_row">
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left">カラー計</td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_right">{{ sprintf('%.1f', $orderAmountColor) }}</td>
                                <td class="grid_wrapper_right">{{ $receiveAmountColor }}</td>
                                <td class="grid_wrapper_right"></td>
                                <td class="grid_wrapper_right"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                            </tr>
                            <tr class="amount_row">
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left">商品計</td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_right">{{ sprintf('%.1f', $orderAmountItem) }}</td>
                                <td class="grid_wrapper_right">{{ $receiveAmountItem }}</td>
                                <td class="grid_wrapper_right"></td>
                                <td class="grid_wrapper_right"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                                <td class="grid_wrapper_left"></td>
                            </tr>
                        @else
                            @for ($i = 0; $i <= 16; $i++)
                                <tr>
                                    <td class="grid_wrapper_center"></td>
                                    <td class="grid_wrapper_center"></td>
                                    <td class="grid_wrapper_center"></td>
                                    <td class="grid_wrapper_center"></td>
                                    <td class="grid_wrapper_center"></td>
                                    <td class="grid_wrapper_center"></td>
                                    <td class="grid_wrapper_center"></td>
                                    <td class="grid_wrapper_center"></td>
                                    <td class="grid_wrapper_center"></td>
                                    <td class="grid_wrapper_center"></td>
                                    <td class="grid_wrapper_center"></td>
                                    <td class="grid_wrapper_center"></td>
                                    <td class="grid_wrapper_center"></td>
                                    <td class="grid_wrapper_center"></td>
                                    <td class="grid_wrapper_center"></td>
                                    <td class="grid_wrapper_center"></td>
                                    <td class="grid_wrapper_center"></td>
                                    <td class="grid_wrapper_center"></td>
                                </tr>
                            @endfor
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="execute" name="execute" class="display_none_all"></button>
        <button type="submit" id="redirect" name="redirect" class="display_none_all" value=""></button>

    </form>
    @include('admin.master.search.brand1', ['brand1Data' => $brand1Data])
    @include('admin.master.search.game_category', ['itemClassThing2Data' => $itemClassThing2Data])
    @include('admin.master.search.genre', ['genreData' => $genreData])
    @include('admin.master.search.item_class_thing4', ['itemClassThing4Data' => $itemClassThing4Data])
    @include('admin.master.search.item_class_thing5', ['itemClassThing5Data' => $itemClassThing5Data])
    @include('admin.master.search.item_class_thing6', ['itemClassThing6Data' => $itemClassThing6Data])
    @include('admin.master.search.item_class_thing7', ['itemClassThing7Data' => $itemClassThing7Data])
    @include('admin.master.search.item_cd', ['itemData' => $itemData])
    @include('admin.master.search.color', ['colorData' => $colorData])
    @include('admin.master.search.size', ['sizeData' => $sizeData])
    @include('admin.master.search.warehouse', ['warehouseData' => $warehouseData])
    @include('admin.common.calendar', ['calendarId' => 'calendar1'])
    @include('admin.common.calendar', ['calendarId' => 'calendar2'])
    <script>
        const inputBox = document.getElementById("input_item_code_start");
        const outputBox = document.getElementById("input_item_code_end");
        inputBox.onblur = function() {
            // if("" !== inputBox.value) {
            //     inputBox.value = inputBox.value.toString().padStart(9, '0');
            // }
            if ("" === outputBox.value) {
                outputBox.value = inputBox.value;
            }
        };
        // outputBox.onblur = function () {
        //     if("" !== outputBox.value) {
        //         outputBox.value = outputBox.value.toString().padStart(9, '0');
        //     }
        // };
        const inputBox2 = document.getElementById("input_color_start");
        const outputBox2 = document.getElementById("input_color_end");
        inputBox2.onblur = function() {
            // if("" !== inputBox2.value) {
            //     inputBox2.value = inputBox2.value.toString().padStart(5, '0');
            // }
            if ("" === outputBox2.value) {
                outputBox2.value = inputBox2.value;
            }
        };
        // outputBox2.onblur = function () {
        //     if("" !== outputBox2.value) {
        //         outputBox2.value = outputBox2.value.toString().padStart(5, '0');
        //     }
        // };
        const inputBox3 = document.getElementById("input_size_start");
        const outputBox3 = document.getElementById("input_size_end");
        inputBox3.onblur = function() {
            // if("" !== inputBox3.value) {
            //     inputBox3.value = inputBox3.value.toString().padStart(5, '0');
            // }
            if ("" === outputBox3.value) {
                outputBox3.value = inputBox3.value;
            }
        };
        // outputBox3.onblur = function () {
        //     if("" !== outputBox3.value) {
        //         outputBox3.value = outputBox3.value.toString().padStart(5, '0');
        //     }
        // };
        const inputBox4 = document.getElementById("input_warehouse_start");
        const outputBox4 = document.getElementById("input_warehouse_end");
        inputBox4.onblur = function() {
            if ("" !== inputBox4.value) {
                inputBox4.value = inputBox4.value.toString().padStart(6, '0');
            }
        };
        outputBox4.onblur = function() {
            if ("" !== outputBox4.value) {
                outputBox4.value = outputBox4.value.toString().padStart(6, '0');
            }
        };
    </script>

@endsection
