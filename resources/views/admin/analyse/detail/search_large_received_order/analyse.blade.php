@extends('layouts.admin.app')
@section('page_title', '大口検索用')
@section('title', '大口検索用')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('analyse.detail.search_large_received_order.analyse') }}" method="get">
        @csrf
        <div class="main-area">
            @include('admin.analyse.button_area')
            @include('admin.analyse.def_area', [
                'code' => '2-009',
                'title' => '大口検索用',
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
                                'title' => '伝票備考',
                                'column' => 'slip_memo',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
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
                                    'column' => 'order_receive_number',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '得意先コード',
                                    'column' => 'customer_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '得意先名',
                                    'column' => 'bk_customer_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '納品先コード',
                                    'column' => 'delivery_destination_id',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '納品先名',
                                    'column' => 'bk_delivery_destination_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '商品名',
                                    'column' => 'item_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'CS1コード',
                                    'column' => 'color_cd',
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
                                    'title' => '伝票備考',
                                    'column' => 'slip_memo',
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
                                    'title' => '付箋区分コード',
                                    'column' => 'branch_number',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '付箋種別',
                                    'column' => 'sticky_note_kind_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '受注金額',
                                    'column' => 'order_receive_amount',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'ルートコード',
                                    'column' => 'root_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'ルート名',
                                    'column' => 'root_name',
                                ])
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @isset($data)
                                @foreach ($data as $record)
                                    @if (isset($record->total_flag))
                                        <tr class="ana_total_tr">
                                            <td class="grid_wrapper_left" colspan="9">{{ $record->title }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->order_receive_quantity) }}
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_right">{{ number_format($record->order_receive_amount) }}
                                            </td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                        </tr>
                                    @elseif (isset($record->sub_total_flag))
                                        <tr class="ana_sub_total_tr">
                                            <td class="grid_wrapper_left" colspan="9">{{ $record->title }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->order_receive_quantity) }}
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_right">{{ number_format($record->order_receive_amount) }}
                                            </td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="grid_wrapper_center">{{ $record->order_receive_number }}</td>
                                            <td class="grid_wrapper_left">{{ $record->customer_cd }}</td>
                                            <td class="grid_wrapper_left">{{ $record->bk_customer_name }}</td>
                                            <td class="grid_wrapper_center">{{ $record->delivery_destination_id }}</td>
                                            <td class="grid_wrapper_left">{{ $record->bk_delivery_destination_name }}</td>
                                            <td class="grid_wrapper_left">{{ $record->item_name }}</td>
                                            <td class="grid_wrapper_center">{{ $record->color_cd }}</td>
                                            <td class="grid_wrapper_left">{{ $record->color_name }}</td>
                                            <td class="grid_wrapper_left">{{ $record->size_name }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->order_receive_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_left">{{ $record->slip_memo }}</td>
                                            <td class="grid_wrapper_left">{{ $record->sticky_note_name }}</td>
                                            <td class="grid_wrapper_center">{{ $record->order_number }}</td>
                                            <td class="grid_wrapper_center">{{ $record->branch_number }}</td>
                                            <td class="grid_wrapper_center">{{ $record->sticky_note_kind_cd }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->order_receive_amount) }}
                                            </td>
                                            <td class="grid_wrapper_center">{{ $record->root_cd }}</td>
                                            <td class="grid_wrapper_left">{{ $record->root_name }}</td>
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
