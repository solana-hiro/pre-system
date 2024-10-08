@extends('layouts.admin.app')
@section('page_title', '当日出荷チェック')
@section('title', '当日出荷チェック')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('analyse.tally.check_shipping.analyse') }}" method="get">
        @csrf
        <div class="main-area">
            @include('admin.analyse.button_area')
            @include('admin.analyse.def_area', [
                'code' => '2-104',
                'title' => '当日出荷チェック',
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
                                'title' => 'ルートコード',
                                'column' => 'root_cd',
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
                                    'title' => '受注NO',
                                    'column' => 'trn_order_receive_headers.order_receive_number',
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
                                    'title' => '納品先コード',
                                    'column' => 'mt_delivery_destinations.delivery_destination_id',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '納品先名',
                                    'column' => 'trn_order_receive_headers.bk_delivery_destination_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'ピッキング担当者コード',
                                    'column' => 'picking_users.user_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'ピッキング担当者名',
                                    'column' => 'picking_users.user_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '最終ピッキング担当者コード',
                                    'column' => 'last_picking_users.user_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '最終ピッキング担当者名',
                                    'column' => 'last_picking_users.user_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '検品担当者コード',
                                    'column' => 'inspection_users.user_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '検品担当者名',
                                    'column' => 'inspection_users.user_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '納品書発行フラグ',
                                    'column' => 'trn_sale_header.delivery_slip_return_slip_output_flg',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'ルートコード',
                                    'column' => 'mt_roots.root_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'ルート名',
                                    'column' => 'mt_roots.root_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '付箋区分名_明細',
                                    'column' => 'mt_order_receive_sticky_notes.sticky_note_name',
                                ])
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @isset($data)
                                @foreach ($data as $record)
                                    <tr>
                                        <td class="grid_wrapper_center">{{ $record->order_receive_number }}</td>
                                        <td class="grid_wrapper_center">{{ $record->customer_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->bk_customer_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->delivery_destination_id }}</td>
                                        <td class="grid_wrapper_left">{{ $record->bk_delivery_destination_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->picking_user_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->picking_user_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->last_picking_user_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->last_picking_user_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->inspection_user_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->inspection_user_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->delivery_slip_return_slip_output_flg }}
                                        </td>
                                        <td class="grid_wrapper_center">{{ $record->root_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->root_name }}</td>
                                        <td class="grid_wrapper_left">{{ $record->sticky_note_name }}</td>
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
