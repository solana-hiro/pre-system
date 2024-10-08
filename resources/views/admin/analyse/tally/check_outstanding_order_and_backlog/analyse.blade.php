@extends('layouts.admin.app')
@section('page_title', '発注残受注残チェック')
@section('title', '発注残受注残チェック')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('analyse.tally.check_outstanding_order_and_backlog.analyse') }}" method="get">
        @csrf
        <div class="main-area">
            @include('admin.analyse.button_area')
            @include('admin.analyse.def_area', [
                'code' => '1-05',
                'title' => '発注残受注残チェック',
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
                            @include('admin.analyse.value_filter_form', [
                                'title' => '商品分類1コード',
                                'column' => 'item_class_cd',
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
                                'title' => 'CS1コード',
                                'column' => 'color_cd',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => 'CS2コード',
                                'column' => 'size_cd',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '倉庫コード',
                                'column' => 'warehouse_cd',
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
                                    'title' => '商品分類1コード',
                                    'column' => 'item_class_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '商品分類1名',
                                    'column' => 'item_class_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '他品番',
                                    'column' => 'other_part_number',
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
                                    'title' => 'CS2コード',
                                    'column' => 'size_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'CS2名',
                                    'column' => 'size_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '現在庫数量',
                                    'column' => 'now_stock_quantity',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '受注出荷残数量',
                                    'column' => 'remaining_order_receive_quantity',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '有効在庫',
                                    'column' => 'effective_stock_quantity',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '発注入荷残数量',
                                    'column' => 'remaining_order_warehousing_quantity',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '入荷後在庫',
                                    'column' => 'restock_quantity',
                                ])
                                {{-- @include('admin.analyse.sortable_th', [
                                    'title' => '出荷指示残数量',
                                    'column' => '',
                                ]) --}}
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @isset($data)
                                @foreach ($data as $record)
                                    @if (isset($record->total_flag))
                                        <tr class="ana_total_tr">
                                            <td class="grid_wrapper_left" colspan="7">{{ $record->title }}</td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->now_stock_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->remaining_order_receive_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->effective_stock_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->remaining_order_warehousing_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->restock_quantity) }}
                                            </td>
                                            {{-- <td class="grid_wrapper_right">
                                                {{ number_format($record->出荷指示残数量) }}
                                            </td> --}}
                                        </tr>
                                    @elseif (isset($record->sub_total_flag))
                                        <tr class="ana_sub_total_tr">
                                            <td class="grid_wrapper_left" colspan="7">{{ $record->title }}</td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->now_stock_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->remaining_order_receive_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->effective_stock_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->remaining_order_warehousing_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->restock_quantity) }}
                                            </td>
                                            {{-- <td class="grid_wrapper_right">
                                                {{ number_format($record->出荷指示残数量) }}
                                            </td> --}}
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="grid_wrapper_center">{{ $record->item_class_cd }}</td>
                                            <td class="grid_wrapper_left">{{ $record->item_class_name }}</td>
                                            <td class="grid_wrapper_left">{{ $record->other_part_number }}</td>
                                            <td class="grid_wrapper_center">{{ $record->color_cd }}</td>
                                            <td class="grid_wrapper_left">{{ $record->color_name }}</td>
                                            <td class="grid_wrapper_center">{{ $record->size_cd }}</td>
                                            <td class="grid_wrapper_left">{{ $record->size_name }}</td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->now_stock_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->remaining_order_receive_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->effective_stock_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->remaining_order_warehousing_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->restock_quantity) }}
                                            </td>
                                            {{-- <td class="grid_wrapper_right">
                                                {{ number_format($record->出荷指示残数量) }}
                                            </td> --}}
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
