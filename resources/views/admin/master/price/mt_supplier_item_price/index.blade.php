{{-- {{ dd($itemPrices[1]) }} --}}
@extends('layouts.admin.app')
@section('page_title', '仕入先商品単価一覧 入力')
@section('title', '仕入先商品単価一覧 入力')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
    <script type="module" src="{{ asset('js/master/price/mt_supplier_item_price/index.js') }}"></script>
    <script src="{{ asset('/js/calendar.js') }}"></script>
@endsection

@section('content')
    <form role="search" action="{{ route('master.price.mt_supplier_item_price.update') }}" method="post" data-monitoring>
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    @if (isset($itemPrices))
                        {{-- 仕入先の単価リスト表示時の頁ボタン --}}
                        <a href="{{ $itemPrices->previousPageUrl() }}" rel="prev"
                            class="page-button @if (is_null($itemPrices->previousPageUrl())) page-button-disabled @endif">
                            <span class="page-button-label">前頁<span>
                        </a>
                        <a href="{{ $itemPrices->nextPageUrl() }}" rel="next"
                            class="page-button @if (is_null($itemPrices->nextPageUrl())) page-button-disabled @endif">
                            <span class="page-button-label">次頁</span>
                        </a>
                    @else
                        @if (is_null($supplier))
                            {{-- 初期表示時の頁ボタン --}}
                            <a rel="prev" class="page-button page-button-disabled">
                                <span class="page-button-label">前頁<span>
                            </a>
                            <a rel="next" class="page-button page-button-disabled">
                                <span class="page-button-label">次頁</span>
                            </a>
                        @else
                            {{-- 仕入先選択時の頁ボタン --}}
                            <a rel="prev" class="page-button page-button-disabled">
                                <span class="page-button-label">前頁<span>
                            </a>
                            <a href="{{ route('master.price.mt_supplier_item_price.page_by_id', ['id' => $supplier->id]) }}"
                                rel="next"
                                class="page-button @if (!$existsItemPrices) page-button-disabled @endif">
                                <span class="page-button-label">次頁</span>
                            </a>
                        @endif
                    @endif
                    <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value="" class="button-2"
                        data-url="" name="update2">
                        <div class="text_wrapper_3">登録する</div>
                    </button>
                </div>
            </div>
            @include('components.message.alert', ['errors' => $errors])
            <div class="box">
                <div class="element-form-rows">
                    <div class="element-form">
                        <div class="text_wrapper">仕入先コード</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="number" name="supplier_code" class="element w-16" data-limit-len="6"
                                    data-limit-minus data-ac="supplier" data-monitoring-exclude
                                    value="{{ old('supplier_code', $supplier?->supplier_cd ?? '') }}" />
                                <img class="vector" src="/img/icon/vector.svg" data-smm-open="search_supplier_modal">
                            </div>
                            <div class="textbox td_200px txt_blue">
                                <input type="text" name="supplier_name" id="supplier_name" class="grid_textbox"
                                    value="{{ old('supplier_name', $supplier?->supplier_name ?? '') }}" readonly>
                                <input type="hidden" name="supplier_id" class="grid_textbox"
                                    value="{{ old('supplier_id', $supplier?->id ?? '') }}">
                            </div>
                        </div>
                    </div>
                    <div class="element-form">
                        <div class="text_wrapper">税区分</div>
                        <div class="textbox txt_blue">
                            <input type="text" name="tax_kbn_name" id="tax_kbn_name" class="grid_textbox w-12"
                                value="{{ old('tax_kbn_name', $supplier?->tax_kbn === 0 ? '税込' : ($supplier?->tax_kbn === 1 ? '税抜' : '')) }}"
                                readonly>
                        </div>
                    </div>
                    <div class="element-form">
                        <div class="text_wrapper">初期設定日</div>
                        <div class="textbox">
                            <input type="number" id="calendar1-year" name="year" class="grid_textbox w-10"
                                value="{{ old('year', date('Y')) }}" data-limit-len="4" data-limit-minus><span>年</span>
                            <input type="number" id="calendar1-month" name="month" class="grid_textbox w-5"
                                value="{{ old('month', date('m')) }}" data-limit-len="2" data-limit-minus><span>月</span>
                            <input type="number" id="calendar1-date" name="day" class="grid_textbox w-5"
                                value="{{ old('day', date('d')) }}" data-limit-len="2" data-limit-minus><span>日</span>
                            <img src="/img/icon/calender.svg" class="img_calender" onclick="onOpenCalendar('calendar1')">
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid">
                <table id="kbn1_grid">
                    <thead class="grid_header">
                        <tr>
                            <td class="grid_wrapper_center">削除</td>
                            <td class="grid_wrapper_center w-28">商品コード</td>
                            <td class="grid_wrapper_center w-60">商品</td>
                            <td class="grid_wrapper_center w-40">設定 日付</td>
                            <td class="grid_wrapper_center w-40">単価</td>
                        </tr>
                    </thead>
                    <tbody class="grid_body">
                        @for ($i = 0; $i < 20; $i++)
                            <tr class="tr_36px">
                                <input type="hidden" name="items[{{ $i }}][supplier_item_price_id]"
                                    value="{{ old("items.$i.supplier_item_price_id", $itemPrices[$i]->id ?? '') }}">
                                <td class="grid_wrapper_center col_rec">
                                    <button type="button" data-clear>
                                        <img class="" src="{{ asset('/img/icon/trash.svg') }}">
                                    </button>
                                </td>
                                <td class="grid_col_6 col_rec col_rec">
                                    <div class="flex">
                                        <input type="text" name="items[{{ $i }}][item_cd]"
                                            class="grid_textbox" maxlength="9" data-ac="item"
                                            value="{{ old("items.$i.item_cd", $itemPrices[$i]->mtItem->item_cd ?? '') }}"
                                            @if (!is_null($itemPrices[$i] ?? null)) readonly @endif>
                                        <img class="grid_img_left" src="/img/icon/vector.svg"
                                            @if (is_null($itemPrices[$i] ?? null)) data-smm-open="search_item_cd_modal" @endif />
                                        <input type="hidden" name="items[{{ $i }}][mt_item_id]"
                                            value="{{ old("items.$i.mt_item_id", $itemPrices[$i]->mtItem->id ?? '') }}">
                                    </div>
                                </td>
                                <td class="grid_col_2 col_rec txt_blue">
                                    <input type="text" name="items[{{ $i }}][item_name]"
                                        class="grid_textbox !w-full"
                                        value="{{ old("items.$i.item_name", $itemPrices[$i]->mtItem->item_name ?? '') }}"
                                        readonly>
                                </td>
                                <td class="grid_col_4 col_rec">
                                    <div class="flex">
                                        <input type="number" id="calendar{{ $i + 2 }}-year"
                                            name="items[{{ $i }}][year]" class="grid_textbox w-10"
                                            value="{{ old("items.$i.year", explode('-', $itemPrices[$i]?->set_date ?? '--')[0]) }}"
                                            data-limit-len="4" data-limit-minus><span>年</span>
                                        <input type="number" id="calendar{{ $i + 2 }}-month"
                                            name="items[{{ $i }}][month]" class="grid_textbox w-5"
                                            value="{{ old("items.$i.month", explode('-', $itemPrices[$i]?->set_date ?? '--')[1]) }}"
                                            data-limit-len="2" data-limit-minus><span>月</span>
                                        <input type="number" id="calendar{{ $i + 2 }}-date"
                                            name="items[{{ $i }}][day]" class="grid_textbox w-5"
                                            value="{{ old("items.$i.day", explode('-', $itemPrices[$i]?->set_date ?? '--')[2]) }}"
                                            data-limit-len="2" data-limit-minus><span>日</span>
                                        <img src="/img/icon/calender.svg" class="img_calender"
                                            onclick="onOpenCalendar('calendar{{ $i + 2 }}')">
                                    </div>
                                </td>
                                <td class="grid_col_4 col_rec">
                                    <input type="number" class="grid_textbox text-right"
                                        name="items[{{ $i }}][price]" step="0.1"
                                        value="{{ old("items.$i.price", $itemPrices[$i]->price ?? '') }}"
                                        data-limit-minus>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="update" name="update" class="display_none_all"></button>
        <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
        <button type="submit" id="redirect" name="redirect" class="display_none_all" value=""></button>
        <input type="hidden" id="redirect_hidden" name="redirect_hidden" class="display_none_all" value="" />
        <input type="hidden" id="hidden_item_cd" value="" name="hidden_item_cd" />
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.master.search.item_cd')
    @include('admin.master.search.supplier')
    @for ($i = 1; $i <= 21; $i++)
        @include('admin.common.calendar', ['calendarId' => "calendar{$i}"])
    @endfor
@endsection
