@extends('layouts.admin.app')
@section('page_title', '発注残割当確認')
@section('title', '発注残割当確認')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('analyse.detail.check_assigned_outstanding_order.analyse') }}" method="get">
        @csrf
        <div class="main-area">
            @include('admin.analyse.button_area')
            @include('admin.analyse.def_area', [
                'code' => '1-777',
                'title' => '発注残割当確認',
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
                                'defaultCondition' => 'none',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '商品コード',
                                'column' => 'item_cd',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '完了区分',
                                'column' => 'order_finish_flg',
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
                                    'title' => '発注NO',
                                    'column' => 'trn_order_headers.order_number',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '指定納期',
                                    'column' => 'trn_order_headers.specify_deadline',
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
                                    'title' => '発注数量',
                                    'column' => 'total_order_quantity',
                                ])
                                {{-- @include('admin.analyse.sortable_th', [
                                    'title' => '割当済発注数',
                                    'column' => '',
                                ]) --}}
                                @include('admin.analyse.sortable_th', [
                                    'title' => '完了区分',
                                    'column' => 'trn_order_details.order_finish_flg',
                                ])
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @isset($data)
                                @foreach ($data as $record)
                                    <tr>
                                        <td class="grid_wrapper_center">{{ $record->order_number }}</td>
                                        <td class="grid_wrapper_center">{{ $record->specify_deadline }}</td>
                                        <td class="grid_wrapper_center">{{ $record->item_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->item_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->color_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->color_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->size_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->size_name }}</td>
                                        <td class="grid_wrapper_right">
                                            {{ number_format($record->total_order_quantity) }}
                                        </td>
                                        {{-- <td class="grid_wrapper_right">
                                            {{ number_format($record->割当済発注数) }}
                                        </td> --}}
                                        <td class="grid_wrapper_center">{{ $record->order_finish_flg }}</td>
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
