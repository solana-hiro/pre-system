@extends('layouts.admin.app')
@section('page_title', '得意先別商品分類掛率マスタ')
@section('title', '得意先別商品分類掛率マスタ')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
    <script type="module" src="{{ asset('js/master/price/mt_customer_other_item_class_rate/index.js') }}"></script>
    <script src="{{ asset('/js/calendar.js') }}"></script>
@endsection

@section('content')
    <form role="search" action="{{ route('master.price.mt_customer_other_item_class_rate.update') }}" method="post"
        data-monitoring>
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    @if (isset($itemClassRates))
                        {{-- 得意先の商品分類掛率リスト表示時の頁ボタン --}}
                        <a href="{{ $itemClassRates->previousPageUrl() }}" rel="prev"
                            class="page-button @if (is_null($itemClassRates->previousPageUrl())) page-button-disabled @endif">
                            <span class="page-button-label">前頁<span>
                        </a>
                        <a href="{{ $itemClassRates->nextPageUrl() }}" rel="next"
                            class="page-button @if (is_null($itemClassRates->nextPageUrl())) page-button-disabled @endif">
                            <span class="page-button-label">次頁</span>
                        </a>
                    @else
                        {{-- 初期頁ボタン --}}
                        <a rel="prev" class="page-button page-button-disabled">
                            <span class="page-button-label">前頁<span>
                        </a>
                        <a href="{{ route('master.price.mt_customer_other_item_class_rate.page_by_id_for_fix', ['id' => $customer->id ?? 0]) }}"
                            rel="next"
                            class="page-button @if (!$existsItemClassRates) page-button-disabled @endif">
                            <span class="page-button-label">次頁</span>
                        </a>
                    @endif
                    <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value="" class="button-2"
                        data-url="" name="update2">
                        <div class="text_wrapper_3">登録する</div>
                    </button>
                </div>
            </div>
            <div class="box">
                <div class="group">
                    <div class="element">
                        <div class="frame">
                            <div class="text_wrapper">処理区分：</div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" name="kbn" value="0" data-mode data-monitoring-exclude />
                                    新規
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" name="kbn" value="1" data-mode data-monitoring-exclude
                                        checked />
                                    修正
                                </label>
                            </div>
                        </div>
                        <div class="frame">
                            <div class="text_wrapper">&ensp;P/S区分：</div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="ps_kbn" value="0" checked />
                                    プロパー
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('components.message.alert', ['errors' => $errors])
            <div class="element-form-rows">
                <div class="element-form">
                    <div class="text_wrapper">得意先</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="customer_code" class="element w-16" data-limit-len="6"
                                data-limit-minus data-ac="customer" data-monitoring-exclude
                                value="{{ old('customer_code', $customer?->customer_cd ?? '') }}" />
                            <img class="vector" src="/img/icon/vector.svg" data-smm-open="search_customer_modal">
                        </div>
                        <div class="textbox td_200px txt_blue">
                            <input type="text" name="customer_name" id="customer_name" class="grid_textbox"
                                value="{{ old('customer_name', $customer?->customer_name ?? '') }}" readonly>
                            <input type="hidden" name="customer_id" class="grid_textbox"
                                value="{{ old('customer_id', $customer?->id ?? '') }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="grid">
                    <table class="grid_table">
                        <thead class="grid_header border-none">
                            <tr class="border-none !h-6">
                                <td colspan="9" class="col_rec_noline"></td>
                                <td colspan="5" class="grid_wrapper_center" id="setting_name">旧設定</td>
                            </tr>
                            <tr class="!h-8">
                                <td class="grid_wrapper_center w-[30px]">削除</td>
                                <td colspan="2" class="grid_wrapper_center min-w-[230px]">ブランド１</td>
                                <td colspan="2" class="grid_wrapper_center w-[70px]">掛率</td>
                                <td class="grid_wrapper_center w-[150px]">開始日付</td>
                                <td class="grid_wrapper_center col_rec_noline w-[20px]"></td>
                                <td class="grid_wrapper_center w-[150px]">終了日付</td>
                                <td class="grid_wrapper_center col_rec_noline "></td>
                                <td colspan="2" class="grid_wrapper_center w-[70px]">掛率</td>
                                <td class="grid_wrapper_center w-[133px]">開始日付</td>
                                <td class="grid_wrapper_center col_rec_noline w-[20px]"></td>
                                <td class="grid_wrapper_center w-[133px]">終了日付</td>
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @php $calendarNumber = 1 @endphp
                            @for ($i = 0; $i < 10; $i++)
                                <tr class="!h-8">
                                    <input type="hidden"
                                        name="item_classes[{{ $i }}][mt_customer_other_item_class_rate_id]"
                                        value="{{ old("item_classes.$i.mt_customer_other_item_class_rate_id", $itemClassRates[$i]->id ?? '') }}">
                                    <td class="grid_wrapper_center col_rec !px-1">
                                        <button type="button" data-clear>
                                            <img class="" src="{{ asset('/img/icon/trash.svg') }}">
                                        </button>
                                    </td>
                                    <td class="grid_col_4 col_rec !w-[88px] !px-1">
                                        <div class="flex">
                                            <input type="text" name="item_classes[{{ $i }}][item_class_cd]"
                                                class="grid_textbox" maxlength="6" data-ac="item_class"
                                                value="{{ old("item_classes.$i.item_class_cd", $itemClassRates[$i]->mtItemClass->item_class_cd ?? '') }}"
                                                @if (!is_null($itemClassRates[$i] ?? null)) readonly @endif>
                                            <img class="vector wrapper_right" src="/img/icon/vector.svg"
                                                @if (is_null($itemClassRates[$i] ?? null)) data-smm-open="search_brand1_modal" @endif />
                                            <input type="hidden"
                                                name="item_classes[{{ $i }}][mt_item_class_id]"
                                                value="{{ old("item_classes.$i.mt_item_class_id", $itemClassRates[$i]->mtItemClass->id ?? '') }}" />
                                        </div>
                                    </td>
                                    <td class="rid_col_2 col_rec txt_blue !min-w-[142px] !px-1">
                                        <input type="text" name="item_classes[{{ $i }}][item_class_name]"
                                            value="{{ old("item_classes.$i.item_class_name", $itemClassRates[$i]->mtItemClass->item_class_name ?? '') }}"
                                            class="grid_textbox !w-full" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec !w-[40px] !px-1">
                                        <input type="number" name="item_classes[{{ $i }}][rate]"
                                            value="{{ old("item_classes.$i.rate", $itemClassRates[$i]->rate ?? '') }}"
                                            class="grid_textbox text-right" data-limit-len="3" data-limit-minus>
                                    </td>
                                    <td class="grid_col_4 col_rec_noline !w-[20px] !px-0">%</td>
                                    <td class="grid_col_4 col_rec !px-1">
                                        @include('admin.master.price.date_form', [
                                            'initialDate' => $itemClassRates[$i]?->start_date ?? null,
                                            'paramName' => "item_classes[$i][start]",
                                            'oldParamName' => "item_classes.$i.start",
                                            'calendarIndex' => $calendarNumber,
                                            'width' => [
                                                'year' => '!w-[36px]',
                                                'month' => '!w-[18px]',
                                                'day' => '!w-[18px]',
                                            ],
                                            'readonly' => false,
                                        ])
                                        @php $calendarNumber++ @endphp
                                    </td>
                                    <td class="grid_col_4 col_rec col_rec_noline !w-[20px] !px-0">～</td>
                                    <td class="grid_col_4 col_rec !px-1">
                                        @include('admin.master.price.date_form', [
                                            'initialDate' => $itemClassRates[$i]?->end_date ?? null,
                                            'paramName' => "item_classes[$i][end]",
                                            'oldParamName' => "item_classes.$i.end",
                                            'calendarIndex' => $calendarNumber,
                                            'width' => [
                                                'year' => '!w-[36px]',
                                                'month' => '!w-[18px]',
                                                'day' => '!w-[18px]',
                                            ],
                                            'readonly' => false,
                                        ])
                                        @php $calendarNumber++ @endphp
                                    </td>
                                    <td class="grid_col_4 col_rec col_rec_noline !w-[20px] !px-0"></td>
                                    <td class="grid_col_2 col_rec !w-[40px] !px-1">
                                        <input type="number" name="item_classes[{{ $i }}][old_rate]"
                                            class="grid_textbox text-right"
                                            value="{{ old("item_classes.$i.old_rate", $itemClassRates[$i]->old_rate ?? '') }}"
                                            readonly>
                                    </td>
                                    <td class="grid_col_4 col_rec_noline !w-[20px] !px-0">%</td>
                                    <td class="grid_col_4 col_rec !px-1">
                                        @include('admin.master.price.date_form', [
                                            'initialDate' => $itemClassRates[$i]?->old_start_date ?? null,
                                            'paramName' => "item_classes[$i][old_start]",
                                            'oldParamName' => "item_classes.$i.old_start",
                                            'width' => [
                                                'year' => '!w-[36px]',
                                                'month' => '!w-[18px]',
                                                'day' => '!w-[18px]',
                                            ],
                                            'readonly' => true,
                                        ])
                                    </td>
                                    <td class="grid_col_4 col_rec col_rec_noline !w-[20px] !px-0">～</td>
                                    <td class="grid_col_4 col_rec !px-1">
                                        @include('admin.master.price.date_form', [
                                            'initialDate' => $itemClassRates[$i]?->old_end_date ?? null,
                                            'paramName' => "item_classes[$i][old_end]",
                                            'oldParamName' => "item_classes.$i.old_end",
                                            'width' => [
                                                'year' => '!w-[36px]',
                                                'month' => '!w-[18px]',
                                                'day' => '!w-[18px]',
                                            ],
                                            'readonly' => true,
                                        ])
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="update" name="update" class="display_none_all"></button>
        <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
        <button type="submit" id="mode" name="mode" class="display_none_all" value=""></button>
        <button type="submit" id="redirect" name="redirect" class="display_none_all" value=""></button>
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.master.search.customer')
    @include('admin.master.search.brand1')
    @for ($i = 1; $i <= 300; $i++)
        @include('admin.common.calendar', ['calendarId' => "calendar{$i}"])
    @endfor
@endsection
