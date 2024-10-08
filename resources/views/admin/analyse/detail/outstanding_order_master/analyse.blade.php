@extends('layouts.admin.app')
@section('page_title', '発注残マスター')
@section('title', '発注残マスター')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('analyse.detail.outstanding_order_master.analyse') }}" method="get">
        @csrf
        <div class="main-area">
            @include('admin.analyse.button_area')
            @include('admin.analyse.def_area', [
                'code' => '4-31',
                'title' => '発注残マスター',
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
                                'title' => '発注NO',
                                'column' => 'order_number',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
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
                                'title' => '明細備考2',
                                'column' => 'memo2',
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
                                    'title' => '発注NO',
                                    'column' => 'trn_order_headers.order_number',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '他品番',
                                    'column' => 'mt_items.other_part_number',
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
                                    'title' => '指定納期',
                                    'column' => 'trn_order_headers.specify_deadline',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '発注数量',
                                    'column' => 'total_order_quantity',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '明細備考1',
                                    'column' => 'trn_order_details.memo',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '明細備考2',
                                    'column' => 'trn_order_details.memo2',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '完了区分',
                                    'column' => 'trn_order_details.order_finish_flg',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '仕入先コード',
                                    'column' => 'mt_suppliers.supplier_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '仕入先名',
                                    'column' => 'mt_suppliers.supplier_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '相手先NO',
                                    'column' => 'trn_order_headers.partner_number',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '伝票備考',
                                    'column' => 'trn_order_headers.slip_memo',
                                ])
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @isset($data)
                                @foreach ($data as $record)
                                    <tr>
                                        <td class="grid_wrapper_center">{{ $record->order_number }}</td>
                                        <td class="grid_wrapper_center">{{ $record->other_part_number }}</td>
                                        <td class="grid_wrapper_center">{{ $record->color_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->color_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->size_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->size_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->specify_deadline }}</td>
                                        <td class="grid_wrapper_right">
                                            {{ number_format($record->total_order_quantity) }}
                                        </td>
                                        <td class="grid_wrapper_left">{{ $record->memo }}</td>
                                        <td class="grid_wrapper_left">{{ $record->memo2 }}</td>
                                        <td class="grid_wrapper_center">{{ $record->order_finish_flg }}</td>
                                        <td class="grid_wrapper_center">{{ $record->supplier_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->supplier_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->partner_number }}</td>
                                        <td class="grid_wrapper_left">{{ $record->slip_memo }}</td>
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
    @include('admin.common.calendar', ['calendarId' => 'calendar3'])
    @include('admin.common.calendar', ['calendarId' => 'calendar4'])
@endsection
