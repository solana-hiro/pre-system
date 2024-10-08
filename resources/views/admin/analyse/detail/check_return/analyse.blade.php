@extends('layouts.admin.app')
@section('page_title', '返品確認データ')
@section('title', '返品確認データ')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('analyse.detail.check_return.analyse') }}" method="get">
        @csrf
        <div class="main-area">
            @include('admin.analyse.button_area')
            @include('admin.analyse.def_area', [
                'code' => '2-003',
                'title' => '返品確認データ',
            ])
            <br>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="box">
                <div class="grid">
                    <table>
                        <thead class="grid_header">
                            <tr>
                                <td colspan="3" class="grid_wrapper_left">出力条件</td>
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @include('admin.analyse.date_filter_form', [
                                'title' => '販売日付',
                                'column' => 'sale_date',
                                'calendarId1' => 'calendar1',
                                'calendarId2' => 'calendar2',
                                'defaultCondition' => 'between',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '取引区分コード',
                                'column' => 'sale_kbn_cd',
                                'defaultCondition' => 'eq',
                                'defaultValueFirst' => '02',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '販売NO',
                                'column' => 'sale_number',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '倉庫名',
                                'column' => 'warehouse_name',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '伝票備考',
                                'column' => 'slip_memo',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '得意先コード',
                                'column' => 'customer_cd',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '他品番',
                                'column' => 'other_part_number',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '商品コード',
                                'column' => 'item_cd',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '商品名',
                                'column' => 'item_name',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box">
                <div class="grid">
                    <table>
                        <thead class="grid_header">
                            <tr>
                                @include('admin.analyse.sortable_th', [
                                    'title' => '販売日付',
                                    'column' => 'trn_sale_headers.sale_date',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '売上返品区分',
                                    'column' => 'trn_sale_headers.sale_return_kbn',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '取引区分コード',
                                    'column' => 'def_sale_kbns.sale_kbn_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '販売NO',
                                    'column' => 'trn_sale_headers.sale_number',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '倉庫名',
                                    'column' => 'mt_warehouses.warehouse_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '伝票備考',
                                    'column' => 'trn_sale_headers.slip_memo',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '得意先コード',
                                    'column' => 'mt_customers.customer_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '得意先名',
                                    'column' => 'trn_sale_headers.bk_customer_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '納品先コード',
                                    'column' => 'mt_delivery_destinations.delivery_destination_id',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '納品先名',
                                    'column' => 'trn_sale_headers.bk_delivery_destination_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '他品番',
                                    'column' => 'mt_items.other_part_number',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '商品コード',
                                    'column' => 'mt_items.item_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '商品名',
                                    'column' => 'trn_sale_details.item_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'CS1コード',
                                    'column' => 'mt_colors.color_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'CS1名',
                                    'column' => 'mt_colors.color_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'CS2コード',
                                    'column' => 'mt_sizes.size_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'CS2名',
                                    'column' => 'mt_sizes.size_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '売上数量',
                                    'column' => 'trn_sale_breakdowns.sale_quantity',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '売上金額',
                                    'column' => 'sale_amount',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '上代金額',
                                    'column' => 'retail_amount',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '入力者名',
                                    'column' => 'mt_users.user_name',
                                ])
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @isset($data)
                                @foreach ($data as $record)
                                    @if (isset($record->total_flag))
                                        <tr class="ana_total_tr">
                                            <td class="grid_wrapper_left" colspan="17">{{ $record->title }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->sale_quantity) }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->sale_amount) }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->retail_amount) }}</td>
                                            <td class="grid_wrapper_left"></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="grid_wrapper_center">{{ $record->sale_date }}</td>
                                            <td class="grid_wrapper_center">{{ $record->sale_return_kbn }}</td>
                                            <td class="grid_wrapper_center">{{ $record->sale_kbn_cd }}</td>
                                            <td class="grid_wrapper_center">{{ $record->sale_number }}</td>
                                            <td class="grid_wrapper_left">{{ $record->warehouse_name }}</td>
                                            <td class="grid_wrapper_left">{{ $record->slip_memo }}</td>
                                            <td class="grid_wrapper_center">{{ $record->customer_cd }}</td>
                                            <td class="grid_wrapper_left">{{ $record->bk_customer_name }}</td>
                                            <td class="grid_wrapper_center">{{ $record->delivery_destination_id }}</td>
                                            <td class="grid_wrapper_left">{{ $record->bk_delivery_destination_name }}</td>
                                            <td class="grid_wrapper_center">{{ $record->other_part_number }}</td>
                                            <td class="grid_wrapper_center">{{ $record->item_cd }}</td>
                                            <td class="grid_wrapper_left">{{ $record->item_name }}</td>
                                            <td class="grid_wrapper_center">{{ $record->color_cd }}</td>
                                            <td class="grid_wrapper_left">{{ $record->color_name }}</td>
                                            <td class="grid_wrapper_center">{{ $record->size_cd }}</td>
                                            <td class="grid_wrapper_left">{{ $record->size_name }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->sale_quantity) }}</td>
                                            <td class="grid_wrapper_right"> {{ number_format($record->sale_amount) }}</td>
                                            <td class="grid_wrapper_right"> {{ number_format($record->retail_amount) }}</td>
                                            <td class="grid_wrapper_left">{{ $record->user_name }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.common.calendar', ['calendarId' => 'calendar1'])
    @include('admin.common.calendar', ['calendarId' => 'calendar2'])
@endsection
