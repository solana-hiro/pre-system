@extends('layouts.admin.app')
@section('page_title', '受注確認')
@section('title', '受注確認')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('analyse.detail.check_received_order.analyse') }}" method="get">
        @csrf
        <div class="main-area">
            @include('admin.analyse.button_area')
            @include('admin.analyse.def_area', [
                'code' => '1-801',
                'title' => '受注確認',
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
                                'calendarId1' => 'calendar3',
                                'calendarId2' => 'calendar4',
                                'defaultCondition' => 'none',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '相手先NO',
                                'column' => 'order_number',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => 'EC注文番号',
                                'column' => 'ec_order_receive_number',
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
                                    'column' => 'order_receive_number',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '得意先コード',
                                    'column' => 'customer_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '得意先名',
                                    'column' => 'customer_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '商品分類2名',
                                    'column' => 'item_class_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '他品番',
                                    'column' => 'other_part_number',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'CS1名',
                                    'column' => 'color_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'CS2名',
                                    'column' => 'size_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '受注数量',
                                    'column' => 'order_receive_quantity',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '受注金額',
                                    'column' => 'amount',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '付箋区分名',
                                    'column' => 'sticky_note_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '相手先NO',
                                    'column' => 'order_number',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '決済方法',
                                    'column' => 'settlement_method',
                                ])
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @isset($data)
                                @foreach ($data as $record)
                                    @if (isset($record->total_flag))
                                        <tr class="ana_total_tr">
                                            <td class="grid_wrapper_left" colspan="7">{{ $record->title }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->order_receive_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_right">{{ number_format($record->amount) }}</td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                        </tr>
                                    @elseif (isset($record->sub_total_flag))
                                        <tr class="ana_sub_total_tr">
                                            <td class="grid_wrapper_left" colspan="7">{{ $record->title }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->order_receive_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_right">{{ number_format($record->amount) }}</td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="grid_wrapper_center">{{ $record->order_receive_number }}</td>
                                            <td class="grid_wrapper_center">{{ $record->customer_cd }}</td>
                                            <td class="grid_wrapper_left">{{ $record->customer_name }}</td>
                                            <td class="grid_wrapper_left">{{ $record->item_class_name }}</td>
                                            <td class="grid_wrapper_center">{{ $record->other_part_number }}</td>
                                            <td class="grid_wrapper_left">{{ $record->color_name }}</td>
                                            <td class="grid_wrapper_left">{{ $record->size_name }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->order_receive_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->order_receive_quantity * $record->order_receive_price) }}
                                            </td>
                                            <td class="grid_wrapper_left">{{ $record->sticky_note_name }}</td>
                                            <td class="grid_wrapper_center">{{ $record->order_number }}</td>
                                            <td class="grid_wrapper_left">
                                                @if ($record->settlement_method === 0)
                                                    通常
                                                @else
                                                    クレジット決済
                                                @endif
                                            </td>
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
    @include('admin.common.calendar', ['calendarId' => 'calendar3'])
    @include('admin.common.calendar', ['calendarId' => 'calendar4'])
@endsection
