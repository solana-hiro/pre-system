@extends('layouts.admin.app')
@section('page_title', '入出庫入力')
@section('title', '入出庫入力')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
    <link rel="stylesheet" href="{{ asset('/css/admin/inout.css') }}">
    <script src="{{ asset('/js/calendar.js') }}"></script>
    <script type="module" src="{{ asset('js/stock/trn_in_out_header/input.js') }}"></script>
@endsection

@section('content')
    @include('admin.common.calendar', ['calendarId' => 'calendar1'])
    @include('admin.common.calendar', ['calendarId' => 'calendar2'])
    @include('admin.common.calendar', ['calendarId' => 'calendar3'])
    <div class="main-area">
        <form role="search" action="{{ route('stock_management.stock.in_out.input.update') }}" method="post"
            name="mtNoticeIndexForm" enctype="multipart/form-data" {{-- data-monitoring --}}>
            @csrf
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    @if (isset($in_out_default_data))
                        <button class="submit" type="button" name="delete" data-toggle="modal" data-target="#modal_delete"
                            data-value="">
                            <div class="text_wrapper">削除する</div>
                        </button>
                    @else
                        <button class="submit" type="button" name="delete" data-toggle="modal" data-target="#modal_delete"
                            data-value="" disabled>
                            <div class="text_wrapper">削除する</div>
                        </button>
                    @endif
                    <button class="button" type="submit" name="prev">
                        <div class="text_wrapper_2">前頁</div>
                    </button>
                    <button class="button" type="submit" name="next">
                        <div class="text_wrapper_2">次頁</div>
                    </button>
                    <button type="submit" class="button-2" name="update">
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
            <div>
                @php
                    // dd($in_out_default_data);
                @endphp
                <div class="flex">
                    <div class="mr-5">
                        <label class="text-required text-sm">入出庫No.</label>
                        <div class="w-[198px] flex items-stretch">
                            <div class="inline-block relative w-[112px]">
                                <input type="hidden" name="trn_in_out_header[id]" id="inout-id"
                                value="{{ old('id', isset($in_out_default_data['id']) ? $in_out_default_data['id'] : '') }}">
                                <input id="inout-number" type="text"
                                    class="w-full wh-7 border border-border rounded-sm px-2"
                                    name="trn_in_out_header[in_out_number]" minlength="0" maxlength="8"
                                    value="{{ old('in_out_number', isset($in_out_default_data['in_out_number']) ? $in_out_default_data['in_out_number'] : '') }}"
                                    onblur="blurCodeautoInOut(arguments[0], this)" />
                                <i data-smm-open="search_inout_number_modal"
                                    class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                            </div>
                            <button type="button" onclick="repeatInOut(arguments[0], this)"
                                class="btn btn-success bg-[#B5D9FF] text-sm text-white ml-2 inline-block px-2">リピート</button>
                        </div>
                    </div>
                    <div class="mr-5 element-form flex flex-col items-start">
                        <label class="text-required text-sm">伝票日付</label>
                        <div class="frame" style="margin-left: 0">
                            <div class="textbox">
                                <input type="text" id="calendar1-year" name="trn_in_out_header[order_date_year]"
                                    class="element textbox_40px" minlength="0" maxlength="4"
                                    value="{{ old('inout_date_year', isset($in_out_default_data['inout_date_year']) ? $in_out_default_data['inout_date_year'] : '') }}">年
                                <input type="text" id="calendar1-month" name="trn_in_out_header[order_date_month]"
                                    class="element textbox_24px" minlength="0" maxlength="2"
                                    value="{{ old('inout_date_month', isset($in_out_default_data['inout_date_month']) ? $in_out_default_data['inout_date_month'] : '') }}">月
                                <input type="text" id="calendar1-date" name="trn_in_out_header[order_date_day]"
                                    class="element textbox_24px" minlength="0" maxlength="2"
                                    value="{{ old('inout_date_day', isset($in_out_default_data['inout_date_day']) ? $in_out_default_data['inout_date_day'] : '') }}">日
                                <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
                            </div>
                        </div>
                    </div>
                    <div class="mr-5">
                        <label class="text-required text-sm">入力者</label>
                        <div class="flex">
                            <div class="relative w-[76px] mr-2">
                                <input type="hidden" name="trn_in_out_header[user_id]"
                                    value="{{ $in_out_default_data['user_id'] }}">
                                <input type="text" class="w-full h-7 border border-border rounded-sm px-2"
                                    name="trn_in_out_header[user_cd]" onblur="blurCodeautoUser(arguments[0], this)"
                                    value="{{ old('user_cd', isset($in_out_default_data['user_cd']) ? $in_out_default_data['user_cd'] : '') }}" />
                                <i data-smm-open="search_manager_modal"
                                    class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                            </div>
                            <div class="relative min-w-[112px]">
                                <div class="w-full h-7 flex items-center border border-border rounded-sm px-2 text-required"
                                    id="names_manager">
                                    {{ old('user_name', isset($in_out_default_data['user_name']) ? $in_out_default_data['user_name'] : '') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex mt-3">
                    <div class="mr-5">
                        <label class="text-required text-sm">取引区分</label>
                        <div class="relative w-[120px]">
                            <select id="def_in_out_kbn_id" name="trn_in_out_header[def_in_out_kbn_id]"
                                class="w-full h-7 border border-border rounded-sm px-2">
                                <option></option>
                                @foreach ($in_out_default_data['def_in_out_kbn_ids'] as $key => $option)
                                    <option value="{{ $key }}"
                                        {{ $key == $in_out_default_data['def_in_out_kbn_id'] ? 'selected' : '' }}>
                                        {{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mr-5">
                        <label class="text-required text-sm">出庫倉庫</label>
                        <div class="flex">
                            <input type="hidden" name="trn_in_out_header[warehouse_issue_id]" id="warehouse_issue_id">
                            <div class="relative w-[96px] mr-2">
                                <input id="warehouse_issue_code" name="warehouse_cd" data-target="warehouse_name"
                                    type="text" class="w-full h-7 border border-border rounded-sm px-2"
                                    onblur="blurCodeautoOutWarehouse(arguments[0], this)"
                                    value="{{ old('warehouse_issue_cd', isset($in_out_default_data['warehouse_issue_cd']) ? $in_out_default_data['warehouse_issue_cd'] : '') }}" />
                                <i data-smm-open="search_warehouse_modal"
                                    class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                            </div>
                            <div class="relative w-[256px] mr-2">
                                <input id="warehouse_issue_name" disabled name="out_warehouse_name" id="warehouse_name"
                                    type="text" class="w-full h-7 border border-border rounded-sm px-2 text-required"
                                    value="{{ old('warehouse_issue_name', isset($in_out_default_data['warehouse_issue_name']) ? $in_out_default_data['warehouse_issue_name'] : '') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="mr-5">
                        <label class="text-required text-sm">入庫倉庫</label>
                        <div class="flex">
                            <input type="hidden" name="trn_in_out_header[warehouse_warehousing_id]"
                                id="warehouse_warehousing_id">
                            <div class="relative w-[96px] mr-2">
                                <input name="warehouse_warehousing_cd" id="warehouse_warehousing_cd"
                                    data-target="warehouse_warehousing_name" type="text"
                                    class="w-full h-7 border border-border rounded-sm px-2"
                                    onblur="blurCodeautoWarehouse(arguments[0], this)"
                                    value="{{ old('warehouse_warehousing_cd', isset($in_out_default_data['warehouse_warehousing_cd']) ? $in_out_default_data['warehouse_warehousing_cd'] : '') }}" />
                                <i data-smm-open="search_warehouse_modal"
                                    class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                            </div>
                            <div class="relative w-[256px] mr-2">
                                <input disabled name="warehouse_warehousing_name" id="warehouse_warehousing_name"
                                    type="text" class="w-full h-7 border border-border rounded-sm px-2 text-required"
                                    value="{{ old('warehouse_warehousing_name', isset($in_out_default_data['warehouse_warehousing_name']) ? $in_out_default_data['warehouse_warehousing_name'] : '') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 overflow-x-auto">
                <div id="deleted_table"></div>
                <table class="min-w-full border-collapse" id="headers_table">
                    <thead class="bg-[#3A5A9B] text-white">
                        <tr>
                            <th class="p-1 border border-gray-300 text-sm" rowspan="2">N0.</th>
                            <th class="p-1 border border-gray-300 text-sm w-[120px] ">商品コード</th>
                            <th class="p-1 border border-gray-300 text-sm">単位</th>
                            <th class="p-1 border border-gray-300 text-sm" rowspan="2">入出庫数量</th>
                            <th class="p-1 border border-gray-300 text-sm" rowspan="2">上代単価</th>
                            <th class="p-1 border border-gray-300 text-sm" rowspan="2">備考</th>
                            <th class="w-[32px] bg-white" rowspan="2"></th>
                        </tr>
                        <tr>
                            <th class="p-1 border border-gray-300 text-sm" colspan="2">商品名</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @include('admin.stock.partials.detail_row') --}}
                        @if ($in_out_default_data['trn_in_out_details'])
                            @foreach ($in_out_default_data['trn_in_out_details'] as $key => $detail)
                                {{-- @php
                                    dd($detail)
                                @endphp --}}
                                <tr>
                                    <td class="border border-tableBorder text-center px-2 text-sm number_cell "
                                        rowspan="2">{{ str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="border border-tableBorder px-2 relative">
                                        <div>
                                            <input type="hidden" name="trn_in_out_details[{{$loop->iteration}}][detail_id]"
                                                class="detail-id">
                                            <input type="hidden" name="trn_in_out_details[{{$loop->iteration}}][item_id]" class="item-id">
                                            <input type="hidden" name="trn_in_out_details[{{$loop->iteration}}][trn_in_out_header_id]"
                                                class="item-header-id">
                                            <input type="hidden" name="trn_in_out_details[{{$loop->iteration}}][order_line_no]"
                                                class="item-order_line_no">
                                            <input type="hidden" name="trn_in_out_details[{{$loop->iteration}}][item_name]"
                                                class="item-item_name">
                                            <span class="item-cd-1"></span>
                                            <input type="text" name="trn_in_out_details[{{$loop->iteration}}][item_cd]"
                                                class="item-cd h-full w-full text-sm form-control focus:border-none active:border-none focus-visible:none"
                                                onblur="blurCodeautoItem(arguments[0], this)"
                                                onclick="clickMagnifyIcon(this)" style="outline: none;"
                                                value="{{ isset($detail->mtItem->item_cd) ? $detail->mtItem->item_cd : '' }}">
                                            <i onclick="clickMagnifyIcon(this)" data-smm-open="search_item_cd_modal"
                                                class="absolute top-[12px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                                        </div>
                                    </td>
                                    <td class="border border-tableBorder px-2 text-sm">
                                        <input type="text" name="trn_in_out_details[{{$loop->iteration}}][unit]"
                                            class="h-full w-full text-sm form-control focus:border-none active:border-none focus-visible:none"
                                            style="outline: none;"
                                            value="{{ isset($detail->mtItem->unit) ? $detail->mtItem->unit : '' }}">
                                    </td>
                                    <td class="border text-right border-tableBorder px-2 text-sm quantity_td"
                                        rowspan="2">
                                        <button type="button" data-toggle="modal" data-target="#modal_quantity"
                                            data-value="" data-item-id="{{ isset($detail->mtItem->id) ? $detail->mtItem->id : '' }}"
                                            data-item-cd="{{ isset($detail->mtItem->item_cd) ? $detail->mtItem->item_cd : '' }}"
                                            data-detail-name="{{ isset($detail->item_name) ? $detail->item_name : '' }}"
                                            data-detail-id="{{ isset($detail->id) ? $detail->id : '' }}"
                                            class="div-wrapper link underline text-[#165C9D] border-none bg-none"
                                            data-url="" name="extend" onclick="getSkuData(arguments[0], this)">
                                            {{ isset($detail['total_quantity']) ? $detail['total_quantity'] : '' }}
                                        </button>
                                        <input type="hidden" name="trn_in_out_details[{{$loop->iteration}}][breakdowns]"
                                            class="item-breakdowns">
                                    </td>
                                    <td class="border border-tableBorder px-2 text-sm price_td" rowspan="2">
                                        <input name="trn_in_out_details[{{$loop->iteration}}][retail_price_tax_out]"
                                            onblur="blurUpdatePrice(arguments[0])"
                                            class="item-cost-price h-full w-full text-sm form-control resize-none focus:border-none active:border-none focus-visible:none text-right"
                                            style="outline: none;"
                                            value="{{ isset($detail->mtItem->retail_price_tax_out) ? $detail->mtItem->retail_price_tax_out : '' }}">
                                    </td>
                                    <td class="border border-tableBorder px-2 text-sm" rowspan="2">
                                        <textarea rows="3" name="trn_in_out_details[{{$loop->iteration}}][memo]"
                                            class="h-full w-full text-sm form-control resize-none  focus:border-none active:border-none focus-visible:none"
                                            style="outline: none;"> {{ isset($detail->memo) ? $detail->memo : '' }}</textarea>
                                    </td>
                                    <td class="border border-tableBorder p-2 text-sm" rowspan="2">
                                        <button type="button"
                                            class="border border-border bg-[#F9F9F9] text-[10px] w-[20px]"
                                            onclick="deleteRow(this)" style="text-orientation: upright;">行削除</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-tableBorder px-2 text-sm" colspan="2">
                                        <span
                                            class="item-name h-[28px] block">{{ isset($detail->item_name) ? $detail->item_name : '' }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
                <div class="flex mt-3">
                    <div class="pl-1">
                        <a data-new-item="add_new_item" id="add-new-item" data-row="1"
                            class="flex items-center text-sm text-active cursor-pointer"><i
                                class="fa-solid fa-plus mr-1"></i>明細の行を追加する</a>
                    </div>
                    <div class="flex ml-auto p-[6px] bg-[#F9F9F9] border-b border-[#DDDDDD] mt-2">
                        <div class="flex items-center mr-6">
                            <label class="text-sm mr-5">合計数量</label>
                            <input class="text-required" id="inoutput-total-quantity" readonly
                                name="trn_in_out_header[total_quantity]" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <div class="flex items-center">
                    <div class="mr-5">
                        <label class="text-sm">伝票備考</label>
                        <div>
                            <input name="trn_in_out_header[slip_memo]" type="text"
                                class="w-[370px] border border-border rounded-sm h-7" />
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
            <button type="submit" id="update" name="update" class="display_none_all"></button>
            <button type="submit" id="redirect" name="redirect" class="display_none_all"></button>
            <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
        </form>
    </div>

    <div class="hidden template-record" id="detail_row">
        <table>
            <tbody>
                @include('admin.stock.partials.detail_row')
            </tbody>
        </table>
    </div>



    @include('admin.master.search.item_class_thing5')
    @include('admin.master.search.item_class_thing6')
    @include('admin.master.search.item_class_thing7')
    @include('admin.master.search.supplier')
    @include('admin.master.search.color_pattern')
    @include('admin.master.search.color')
    @include('admin.master.search.size_pattern')
    @include('admin.master.search.size')
    @include('admin.master.search.tax_rate_kbn')
    @include('admin.master.search.brand1')
    @include('admin.master.search.game_category')
    @include('admin.master.search.genre')
    @include('admin.master.search.item_class_thing4')
    @include('admin.master.search.item_cd')
    @include('admin.master.search.member_site_item')
    @include('admin.master.search.stock_cd')
    @include('admin.master.search.warehouse')
    @include('admin.master.search.manager')
    @include('admin.stock.partials.qiuantity_modal')
@endsection
