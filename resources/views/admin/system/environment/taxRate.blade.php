@extends('layouts.admin.app')
@section('page_title', '税率設定ファイル')
@section('title', '税率設定ファイル')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('system.environment.tax_rate.update') }}" method="post" name="mtTaxRateSettingForm">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    @if (isset($initData) && !$initData->onFirstPage())
                        <a href="{{ $initData->previousPageUrl() }}" rel="prev"><button class="div-wrapper" type="button"
                                name="back">
                                <div class="text_wrapper_2">前頁</div>
                            </button></a>
                    @else
                        <a href="{{ $initData->previousPageUrl() }}" rel="prev"><button class="div-wrapper"
                                type="button" name="back" disabled>
                                <div class="text_wrapper_2">前頁</div>
                            </button></a>
                    @endif
                    @if (isset($initData) && $initData->hasMorePages())
                        <a href="{{ $initData->nextPageUrl() }}" rel="next"><button class="div-wrapper" type="button"
                                name="next">
                                <div class="text_wrapper_2">次頁</div>
                            </button></a>
                    @else
                        <a href="{{ $initData->nextPageUrl() }}" rel="next"><button class="div-wrapper" type="button"
                                name="next" disabled>
                                <div class="text_wrapper_2">次頁</div>
                            </button></a>
                    @endif
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value="" class="button-2"
                        data-url="" name="update2">
                        <div class="text_wrapper_3">登録する</div>
                    </button>
                </div>
            </div>
            <div class="box">
                <div class="group">
                    <div class="element-form-rows">
                        <div class="element-form-columns">
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper">税率区分</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="tax_kbn_cd" id="input_taxrate" class="element"
                                            minlength="0" maxlength="7" size="7"
                                            onblur="eventBlurSearchTaxRate(arguments[0], this)"
                                            value="{{ $initDefTaxRateKbns['tax_rate_kbn_cd'] }}" />
                                        <img class="vector" id="img_taxrate" src="/img/icon/vector.svg"
                                            data-smm-open="search_tax_rate_kbn_modal" />
                                        <input type="hidden" id="hidden_taxrate" value="" name="hidden_taxrate" />
                                    </div>
                                    <div class="textbox td_200px txt_blue" id="names_taxrate">
                                        {{ $initDefTaxRateKbns['tax_rate_kbn_name'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
            <div class="sub_contents">
                <div class="left_contents">
                    <div class="grid_gray">
                        <table class="grid_gray_table_100p" id="grid_table">
                            <thead class="grid_gray_header">
                                <tr>
                                    <td class="grid_wrapper_center td_40p">税率</td>
                                    <td class="grid_wrapper_center td_60p">適用開始日</td>
                                </tr>
                            </thead>
                            <tbody class="grid_body">
                                @for ($i = 1; $i <= 2; $i++)
                                    <tr>
                                        <td class="grid_wrapper_left td_200px"><input type="text" placeholder=""
                                                name="insert_tax_rate[]" id="insert_supplier_class_code"
                                                class="grid_textbox" minlength="0" maxlength="7" size="7"></td>
                                        <td>
                                            <div class="element-form">
                                                <input type="text" id="calendar{{ $i }}-year"
                                                    name="insert_release_start_datetime_year[]"
                                                    class="element textbox_40px" minlength="0" maxlength="4"
                                                    value="{{ old('release_start_datetime_year', isset($detailData['MtCatalog']['release_start_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtCatalog']['release_start_datetime'])->format('Y') : date('Y')) }}">年
                                                <input type="text" id="calendar{{ $i }}-month"
                                                    name="insert_release_start_datetime_month[]"
                                                    class="element textbox_24px" minlength="0" maxlength="2"
                                                    value="{{ old('release_start_datetime_month', isset($detailData['MtCatalog']['release_start_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtCatalog']['release_start_datetime'])->format('m') : date('m')) }}">月
                                                <input type="text" id="calendar{{ $i }}-date"
                                                    name="insert_release_start_datetime_day[]"
                                                    class="element textbox_24px" minlength="0" maxlength="2"
                                                    value="{{ old('release_start_datetime_day', isset($detailData['MtCatalog']['release_start_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtCatalog']['release_start_datetime'])->format('d') : date('d')) }}">日
                                                <img src="/img/icon/calender.svg"
                                                    onclick="onOpenCalendar('calendar{{ $i }}')">
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                        <div class="plus_rec">
                            <div class="blue_text_wrapper" id="add_line" onclick="taxRateAddLine()">+ 行を追加する</div>
                        </div>
                    </div>
                </div>
                <div class="right_contents">
                    <div class="grid" style="margin-top: 0;">
                        <table class="table_sticky" id="grid_table_1">
                            <thead class="grid_header">
                                <tr>
                                    <td class="grid_wrapper_center td_10p">削除</td>
                                    <td class="grid_wrapper_center td_15p">税率</td>
                                    <td class="grid_wrapper_center td_40p">適用開始日</td>
                                </tr>
                            </thead>
                            <tbody class="tbody_scroll">
                                @php $i=10; @endphp
                                @foreach ($initData as $data)
                                    <tr id="{{ $data['id'] }}">
                                        <td class="grid_wrapper_center col_rec"><button type="button"
                                                data-toggle="modal" data-target="#modal_delete"
                                                data-value="{{ $data['id'] }}" class="display_none"
                                                data-url="{{ route('system.environment.tax_rate.update') }}"
                                                name="delete"><img class="grid_img_center"
                                                    src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                        <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                                name="update_tax_rate[]" id="" class="grid_textbox"
                                                minlength="0" maxlength="6" value="{{ $data['tax_rate'] }}"></td>
                                        <td class="grid_wrapper_center">
                                            <div class="element-form">
                                                <input type="text" id="calendar{{ $i }}-year"
                                                    name="update_release_start_datetime_year[]"
                                                    class="element textbox_40px" minlength="0" maxlength="4"
                                                    value="{{ old('update_release_start_datetime_year[]', isset($data['application_start_date']) ? \Carbon\Carbon::createFromFormat('Y-m-d', $data['application_start_date'])->format('Y') : date('Y')) }}">年
                                                <input type="text" id="calendar{{ $i }}-month"
                                                    name="update_release_start_datetime_month[]"
                                                    class="element textbox_24px" minlength="0" maxlength="2"
                                                    value="{{ old('update_release_start_datetime_month[]', isset($data['application_start_date']) ? \Carbon\Carbon::createFromFormat('Y-m-d', $data['application_start_date'])->format('m') : date('m')) }}">月
                                                <input type="text" id="calendar{{ $i }}-date"
                                                    name="update_release_start_datetime_day[]"
                                                    class="element textbox_24px" minlength="0" maxlength="2"
                                                    value="{{ old('update_release_start_datetime_day[]', isset($data['application_start_date']) ? \Carbon\Carbon::createFromFormat('Y-m-d', $data['application_start_date'])->format('d') : date('d')) }}">日
                                                <img src="/img/icon/calender.svg"
                                                    onclick="onOpenCalendar('calendar{{ $i }}')">
                                            </div>
                                        </td>
                                        <input type="hidden" name="update_id[]" value="{{ $data['id'] }}" />
                                    </tr>
                                    @php $i++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="update" name="update" class="display_none_all"></button>
        <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
        <button type="submit" id="redirect" name="redirect" class="display_none_all" value=""></button>
        @include('admin.common.calendar', ['calendarId' => 'calendar1'])
        @include('admin.common.calendar', ['calendarId' => 'calendar2'])
        @include('admin.common.calendar', ['calendarId' => 'calendar3'])
        @include('admin.common.calendar', ['calendarId' => 'calendar4'])
        @include('admin.common.calendar', ['calendarId' => 'calendar5'])
        @include('admin.common.calendar', ['calendarId' => 'calendar10'])
        @include('admin.common.calendar', ['calendarId' => 'calendar11'])
        @include('admin.common.calendar', ['calendarId' => 'calendar12'])
        @include('admin.common.calendar', ['calendarId' => 'calendar13'])
        @include('admin.common.calendar', ['calendarId' => 'calendar14'])
        @include('admin.common.calendar', ['calendarId' => 'calendar15'])
        @include('admin.common.calendar', ['calendarId' => 'calendar16'])
        @include('admin.common.calendar', ['calendarId' => 'calendar17'])
        @include('admin.common.calendar', ['calendarId' => 'calendar18'])
        @include('admin.common.calendar', ['calendarId' => 'calendar19'])
    </form>
    @include('admin.master.search.tax_rate_kbn', ['taxRateKbnData' => $taxRateKbnData])
@endsection
