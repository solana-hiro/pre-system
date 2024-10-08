@extends('layouts.admin.app')
@section('page_title', '受注伝票検索(管理部17時チェック用)')
@section('title', '受注伝票検索(管理部17時チェック用)')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('analyse.detail.search_recived_order_for_check.analyse') }}" method="get">
        @csrf
        <div class="main-area">
            @include('admin.analyse.button_area')
            @include('admin.analyse.def_area', [
                'code' => '3-01',
                'title' => '受注伝票検索（管理部17時チェック用）',
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
                                'title' => '指定納期',
                                'column' => 'specify_deadline',
                                'calendarId1' => 'calendar1',
                                'calendarId2' => 'calendar2',
                                'defaultCondition' => 'eq',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '付箋区分名',
                                'column' => 'sticky_note_name',
                                'defaultCondition' => 'like',
                                'defaultValueFirst' => 'トータルピッキング',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '決済方法',
                                'column' => 'settlement_method',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.filter_help', [
                                'helpMessage' => '※決済方法（0:通常、1:クレジット決済）',
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
                                    'title' => '得意先コード',
                                    'column' => 'mt_customers.customer_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '受注NO',
                                    'column' => 'trn_order_receive_headers.order_receive_number',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '受注日付',
                                    'column' => 'trn_order_receive_headers.order_receive_date',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '指定納期',
                                    'column' => 'trn_order_receive_details.specify_deadline',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '得意先名',
                                    'column' => 'mt_customers.customer_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '納品先コード',
                                    'column' => 'mt_delivery_destinations.delivery_destination_id',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '納品先名',
                                    'column' => 'trn_order_receive_headers.bk_delivery_destination_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '商品名',
                                    'column' => 'trn_order_receive_details.item_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '受注数量',
                                    'column' => 'trn_order_receive_breakdowns.order_receive_quantity',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '売上数量',
                                    'column' => 'sale_quantity',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '付箋区分名',
                                    'column' => 'mt_order_receive_sticky_notes.sticky_note_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '伝票備考',
                                    'column' => 'trn_order_receive_headers.slip_memo',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '決済方法',
                                    'column' => 'trn_order_receive_headers.settlement_method',
                                ])
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @isset($data)
                                @foreach ($data as $record)
                                    <tr>
                                        <td class="grid_wrapper_center">{{ $record->customer_cd }}</td>
                                        <td class="grid_wrapper_right">{{ $record->order_receive_number }}</td>
                                        <td class="grid_wrapper_center">{{ $record->order_receive_date }}</td>
                                        <td class="grid_wrapper_center">{{ $record->specify_deadline }}</td>
                                        <td class="grid_wrapper_left">{{ $record->customer_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->delivery_destination_id }}</td>
                                        <td class="grid_wrapper_left">{{ $record->bk_delivery_destination_name }}</td>
                                        <td class="grid_wrapper_left">{{ $record->item_name }}</td>
                                        <td class="grid_wrapper_right">{{ number_format($record->order_receive_quantity) }}
                                        </td>
                                        <td class="grid_wrapper_right">{{ number_format($record->sale_quantity) }}</td>
                                        <td class="grid_wrapper_left">{{ $record->sticky_note_name }}</td>
                                        <td class="grid_wrapper_left">{{ $record->slip_memo }}</td>
                                        <td class="grid_wrapper_left">
                                            @if ($record->settlement_method === 0)
                                                通常
                                            @else
                                                クレジット決済
                                            @endif
                                        </td>
                                    </tr>
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
