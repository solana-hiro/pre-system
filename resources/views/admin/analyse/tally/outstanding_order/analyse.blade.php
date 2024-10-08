@extends('layouts.admin.app')
@section('page_title', '発注残')
@section('title', '発注残')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('analyse.tally.outstanding_order.analyse') }}" method="get">
        @csrf
        <div class="main-area">
            @include('admin.analyse.button_area')
            @include('admin.analyse.def_area', [
                'code' => '1-09',
                'title' => '発注残',
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
                                'title' => '発注日付',
                                'column' => 'order_date',
                                'calendarId1' => 'calendar1',
                                'calendarId2' => 'calendar2',
                                'defaultCondition' => 'none',
                            ])
                            @include('admin.analyse.date_filter_form', [
                                'title' => '指定納期',
                                'column' => 'specify_deadline',
                                'calendarId1' => 'calendar3',
                                'calendarId2' => 'calendar4',
                                'defaultCondition' => 'none',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '完了区分',
                                'column' => 'order_finish_flg',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '明細備考1',
                                'column' => 'memo',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '仕入先コード',
                                'column' => 'supplier_cd',
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
                                    'title' => '発注数量',
                                    'column' => 'order_quantity',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '発注日付',
                                    'column' => 'order_date',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '指定納期',
                                    'column' => 'specify_deadline',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '完了区分',
                                    'column' => 'order_finish_flg',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '明細備考1',
                                    'column' => 'memo',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '仕入先コード',
                                    'column' => 'supplier_cd',
                                ])
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @isset($data)
                                @foreach ($data as $record)
                                    @if (isset($record->total_flag))
                                        <tr class="ana_total_tr">
                                            <td class="grid_wrapper_left" colspan="7">{{ $record->title }}</td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->total_order_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                        </tr>
                                    @elseif (isset($record->sub_total_flag))
                                        <tr class="ana_sub_total_tr">
                                            <td class="grid_wrapper_left" colspan="7">{{ $record->title }}</td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->total_order_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="grid_wrapper_center">{{ $record->item_class_cd }}</td>
                                            <td class="grid_wrapper_left">{{ $record->item_class_name }}</td>
                                            <td class="grid_wrapper_center">{{ $record->other_part_number }}</td>
                                            <td class="grid_wrapper_center">{{ $record->color_cd }}</td>
                                            <td class="grid_wrapper_left">{{ $record->color_name }}</td>
                                            <td class="grid_wrapper_center">{{ $record->size_cd }}</td>
                                            <td class="grid_wrapper_left">{{ $record->size_name }}</td>
                                            <td class="grid_wrapper_right">
                                                {{ number_format($record->order_quantity) }}
                                            </td>
                                            <td class="grid_wrapper_center">{{ $record->order_date }}</td>
                                            <td class="grid_wrapper_center">{{ $record->specify_deadline }}</td>
                                            <td class="grid_wrapper_center">{{ $record->order_finish_flg }}</td>
                                            <td class="grid_wrapper_left">{{ $record->memo }}</td>
                                            <td class="grid_wrapper_center">{{ $record->supplier_cd }}</td>
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
