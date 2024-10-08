@extends('layouts.admin.app')
@section('page_title', 'ロケーション無受注残リスト')
@section('title', 'ロケーション無受注残リスト')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('analyse.detail.backlog_without_location.analyse') }}" method="get">
        @csrf
        <div class="main-area">
            @include('admin.analyse.button_area')
            @include('admin.analyse.def_area', [
                'code' => '2-095-2',
                'title' => 'ロケーション無受注残リスト',
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
                                'title' => '商品コード',
                                'column' => 'item_cd',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => 'ピッキングリスト発行済フラグ',
                                'column' => 'picking_list_output_flg',
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
                                    'title' => 'JANコード',
                                    'column' => 'trn_order_receive_breakdowns.jan_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '受注数量',
                                    'column' => 'trn_order_receive_breakdowns.order_receive_quantity',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '棚番1',
                                    'column' => 'trn_order_receive_breakdowns.shelf_number_1',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '得意先コード',
                                    'column' => 'mt_customers.customer_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '得意先名',
                                    'column' => 'trn_order_receive_headers.bk_customer_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '商品コード',
                                    'column' => 'mt_items.item_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '商品名',
                                    'column' => 'mt_items.item_name',
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
                                    'title' => 'ピッキングリスト発行済フラグ',
                                    'column' => 'trn_order_receive_details.picking_list_output_flg',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '指定納期',
                                    'column' => 'trn_order_receive_details.specify_deadline',
                                ])
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @isset($data)
                                @foreach ($data as $record)
                                    <tr>
                                        <td class="grid_wrapper_center">{{ $record->jan_cd }}</td>
                                        <td class="grid_wrapper_right">{{ number_format($record->order_receive_quantity) }}
                                        </td>
                                        <td class="grid_wrapper_center">{{ $record->shelf_number_1 }}</td>
                                        <td class="grid_wrapper_center">{{ $record->customer_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->bk_customer_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->item_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->item_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->color_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->color_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->size_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->size_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->picking_list_output_flg }}</td>
                                        <td class="grid_wrapper_left">{{ $record->specify_deadline }}</td>
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
