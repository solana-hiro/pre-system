@extends('layouts.admin.app')
@section('page_title', '受注問合せ')
@section('title', '受注問合せ')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <div class="main-area">
        <form role="search" action="{{ route('sales_management.order_receive.accountant.inquiry.execute') }}" method="post">
            @csrf
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button class="button-2" type="execute" name="search">
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

            <div class="box">
                <div class="group">
                    <div class="element_row">
                        <div class="frame">
                            <div class="text_wrapper">決済方法区分：</div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="settlement_method" value="1"
                                        @if (old('settlement_method') === '1' ||
                                                (null === old('settlement_method') &&
                                                    Session::has('searchCondition') &&
                                                    session('searchCondition.settlement_method') === '1')) checked @endif />
                                    クレジット決済
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="settlement_method" value="0"
                                        @if (old('settlement_method') === '0' ||
                                                (null === old('settlement_method') &&
                                                    Session::has('searchCondition') &&
                                                    session('searchCondition.settlement_method') === '0')) checked @endif />
                                    クレジット決済以外
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="settlement_method" value="2"
                                        @if (old('settlement_method') === '2' ||
                                                (null === old('settlement_method') && !Session::has('searchCondition')) ||
                                                (null === old('settlement_method') &&
                                                    Session::has('searchCondition') &&
                                                    session('searchCondition.settlement_method') === '2')) checked @endif />
                                    すべて
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="element-form-rows">
                    <div class="element-form">
                        <div class="text_wrapper">得意先</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" name="customer_code" id="input_customer_code" class="element"
                                    minlength="0" maxlength="6" size="6"
                                    value="{{ old('customer_code', Session::has('searchCondition') ? session('searchCondition.customer_code') : '') }}" />
                                <img class="vector" id="img_customer_code" src="/img/icon/vector.svg"
                                    data-smm-open="search_customer_modal" />
                            </div>
                            <div class="textbox td_380px grid_wrapper_left txt_blue" id="names_customer_code">
                            </div>
                        </div>
                        <input type="hidden" id="hidden_customer_code" value="" name="hidden_customer_code" />
                    </div>
                </div><br>
                <div class="element-form-rows">
                    <div class="element-form">
                        <div class="text_wrapper">商品</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" name="item_code" id="input_item_code" class="element" minlength="0"
                                    maxlength="9" size="9"
                                    value="{{ old('item_code', Session::has('searchCondition') ? session('searchCondition.item_code') : '') }}" />
                                <img class="vector" id="img_item_code" src="/img/icon/vector.svg"
                                    data-smm-open="search_item_cd_modal" />
                            </div>
                            <div class="textbox td_380px grid_wrapper_left txt_blue" id="names_item_code">
                            </div>
                        </div>
                        <input type="hidden" id="hidden_item_code" value="" name="hidden_item_code" />
                    </div>
                </div><br>
                <div class="element-form-rows">
                    <div class="element-form">
                        <div class="text_wrapper">得意先名(曖昧)</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" name="customer_name_like" class="element" minlength="0"
                                    maxlength="60" size="20"
                                    value="{{ old('customer_name_like', Session::has('searchCondition') ? session('searchCondition.customer_name_like') : '') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="element-form">
                        <div class="text_wrapper">納品先名(曖昧)</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" name="delivery_destination_name_like" class="element"
                                    minlength="0" maxlength="60" size="20"
                                    value="{{ old('delivery_destination_name_like', Session::has('searchCondition') ? session('searchCondition.delivery_destination_name_like') : '') }}" />
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="element-form mt-2">
                    <div class="text_wrapper">対象完了区分:</div>
                    <div class="frame">
                        <label for="kbn1">
                            <input type="radio" id="" name="complete_kbn" value="0"
                                @if (old('complete_kbn') === '0' ||
                                        (null === old('complete_kbn') &&
                                            Session::has('searchCondition') &&
                                            session('searchCondition.complete_kbn') === '0')) checked @endif />
                            未完
                        </label>
                        <label for="kbn2">
                            <input type="radio" id="" name="complete_kbn" value="1"
                                @if (old('complete_kbn') === '1' ||
                                        (null === old('complete_kbn') &&
                                            Session::has('searchCondition') &&
                                            session('searchCondition.complete_kbn') === '1')) checked @endif />
                            完了
                        </label>
                        <label for="kbn2">
                            <input type="radio" id="" name="complete_kbn" value="2"
                                @if (old('complete_kbn') === '2' ||
                                        (null === old('complete_kbn') && !Session::has('searchCondition')) ||
                                        (null === old('complete_kbn') &&
                                            Session::has('searchCondition') &&
                                            session('searchCondition.complete_kbn') === '2')) checked @endif />
                            すべて
                        </label>
                    </div>
                </div><br>
                <div class="element-form mt-2">
                    <div class="text_wrapper">&emsp;並び替え順:</div>
                    <div class="frame">
                        <label for="kbn1">
                            <input type="radio" id="sort_order_0" name="sort_order" value="0"
                                onclick="clickSortOrder(this);" @if (old('sort_order') === '0' ||
                                        (null === old('complete_kbn') && !Session::has('searchCondition')) ||
                                        (null === old('sort_order') &&
                                            Session::has('searchCondition') &&
                                            session('searchCondition.sort_order') === '0')) checked @endif />
                            受注日
                        </label>
                        <label for="kbn2">
                            <input type="radio" id="sort_order_1" name="sort_order" value="1"
                                onclick="clickSortOrder(this);" @if (old('sort_order') === '1' ||
                                        (null === old('sort_order') &&
                                            Session::has('searchCondition') &&
                                            session('searchCondition.sort_order') === '1')) checked @endif />
                            指定納期
                        </label>
                    </div>
                </div><br>
                <div class="element-form-rows">
                    <div class="element-form mr-6">
                        <div class="text_wrapper">発注引当区分:</div>
                        <div class="frame">
                            <label>
                                <input type="radio" />
                                未
                            </label>
                            <label>
                                <input type="radio" />
                                済
                            </label>
                            <label>
                                <input type="radio" />
                                一部
                            </label>
                            <label>
                                <input type="radio" />
                                すべて
                            </label>
                        </div>
                    </div>
                    <div class="element-form">
                        <div class="text_wrapper text-required" id="date_label">受注日</div>
                        <div class="textbox">
                            <input type="text" name="start_date_y" id="calendar1-year" class="element textbox_40px"
                                minlength="0" maxlength="4"
                                value="{{ old('start_date_y', Session::has('searchCondition') ? session('searchCondition.start_date_y') : date('Y')) }}">年
                            <input type="text" name="start_date_m" id="calendar1-month" class="element textbox_24px"
                                minlength="0" maxlength="2"
                                value="{{ old('start_date_m', Session::has('searchCondition') ? session('searchCondition.start_date_m') : date('m')) }}">月
                            <input type="text" name="start_date_d" id="calendar1-date" class="element textbox_24px"
                                minlength="0" maxlength="2"
                                value="{{ old('start_date_d', Session::has('searchCondition') ? session('searchCondition.start_date_d') : date('d')) }}">日
                            <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
                        </div>
                        <div class="text_wrapper">以降</div>
                        <div class="textbox">
                            <input type="text" name="end_date_y" id="calendar2-year" class="element textbox_40px"
                                minlength="0" maxlength="4"
                                value="{{ old('end_date_y', Session::has('searchCondition') ? session('searchCondition.end_date_y') : date('Y')) }}">年
                            <input type="text" name="end_date_m" id="calendar2-month" class="element textbox_24px"
                                minlength="0" maxlength="2"
                                value="{{ old('end_date_m', Session::has('searchCondition') ? session('searchCondition.end_date_m') : date('m')) }}">年
                            <input type="text" name="end_date_d" id="calendar2-date" class="element textbox_24px"
                                minlength="0" maxlength="2"
                                value="{{ old('end_date_d', Session::has('searchCondition') ? session('searchCondition.end_date_d') : date('d')) }}">年
                            <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar2')">
                        </div>
                        まで
                    </div>
                </div><br>
                <div class="element-form-rows w-full justify-end pr-10" style="position: relative; top: -50px; margin-bottom: -50px;">
                    <div class="element-form-columns">
                        <div class="text_wrapper">最大表示件数</div>
                        <div class="frame">
                            <select name="rec_count" class="border border-border pl-3 text-sm w-[80px] rounded-sm h-7">
                                <option value="1000" @if (old('rec_count') === '1000' || null === old('rec_count')) selected @endif>1000</option>
                                <option value="3000" @if (old('rec_count') === '3000') selected @endif>3000</option>
                                <option value="5000" @if (old('rec_count') === '5000') selected @endif>5000</option>
                                <option value="10000" @if (old('rec_count') === '10000') selected @endif>10000</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid">
                <table>
                    <thead class="grid_header">
                        <tr>
                            <td class="grid_wrapper_center td_5p">受注日付</td>
                            <td class="grid_wrapper_center td_5p">指定納期</td>
                            <td class="grid_wrapper_center td_5p">受注No</td>
                            <td class="grid_wrapper_center td_5p">決済方法名</td>
                            <td class="grid_wrapper_center td_5p">得意先コード</td>
                            <td class="grid_wrapper_center td_5p">得意先名</td>
                            <td class="grid_wrapper_center td_5p">商品コード</td>
                            <td class="grid_wrapper_center td_5p">商品名</td>
                            <td class="grid_wrapper_center td_3p">カラーコード</td>
                            <td class="grid_wrapper_center td_5p">カラー名</td>
                            <td class="grid_wrapper_center td_2p">サイズコード</td>
                            <td class="grid_wrapper_center td_5p">サイズ名</td>
                            <td class="grid_wrapper_center td_5p">受注数量</td>
                            <td class="grid_wrapper_center td_5p">受注単価</td>
                            <td class="grid_wrapper_center td_5p">受注金額</td>
                            <td class="grid_wrapper_center td_5p">受注残数量</td>
                            <td class="grid_wrapper_center td_5p">受注残金額</td>
                            <td class="grid_wrapper_center td_5p">相手先No</td>
                            <td class="grid_wrapper_center td_5p">完了区分</td>
                            <td class="grid_wrapper_center td_5p">納品先コード</td>
                            <td class="grid_wrapper_center td_5p">納品先名</td>
                        </tr>
                    </thead>
                    <tbody class="grid_body">
                        @if (Session::has('listDatas'))
                            @foreach (session('listDatas') as $data)
                                <tr>
                                    <td class="grid_wrapper_left">{{ $data['order_receive_date'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['specify_deadline'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['order_receive_number'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['settlement_method'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['customer_cd'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['customer_name'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['item_cd'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['item_name'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['color_cd'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['color_name'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['size_cd'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['size_name'] }}</td>
                                    <td class="grid_wrapper_left">
                                        {{ $data['trn_order_receive_details_order_receive_quantity'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['order_receive_price'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['sum'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['quantity'] }}></td>
                                    <td class="grid_wrapper_left">{{ $data['balance'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['order_number'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['order_receive_finish_flg'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['delivery_destination_id'] }}</td>
                                    <td class="grid_wrapper_left">{{ $data['delivery_destination_name'] }}</td>
                                </tr>
                            @endforeach
                        @else
                            @for ($i = 0; $i <= 16; $i++)
                                <tr>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                    <td class="grid_wrapper_left"></td>
                                </tr>
                            @endfor
                        @endif
                    </tbody>
                </table>
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
        @include('admin.master.search.customer', ['customerData' => $customerData])
        @include('admin.common.calendar', ['calendarId' => 'calendar1'])
        @include('admin.common.calendar', ['calendarId' => 'calendar2'])
    </div>
    <script>
        window.onload = function() {
            //sort_order_0, sort_order_1, date_label
            let sortOrder0 = document.getElementById('sort_order_0');
            let sortOrder1 = document.getElementById('sort_order_1');
            let dateLabel1 = document.getElementById('date_label');
            if (sortOrder0.checked === true) {
                dateLabel1.innerHTML = "受注日";
            } else if (sortOrder1.checked === true) {
                dateLabel1.innerHTML = "指定納期";
            }
        }

        function clickSortOrder(elm) {
            let dateLabel1 = document.getElementById('date_label');
            if (elm.id === "sort_order_0") {
                dateLabel1.innerHTML = "受注日";
            } else if (elm.id === "sort_order_1") {
                dateLabel1.innerHTML = "指定納期";
            }
        }
    </script>
@endsection
