@extends('layouts.admin.app')
@section('page_title', '入金後返品チェックリスト')
@section('title', '入金後返品チェックリスト')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('analyse.detail.return_after_payment.analyse') }}" method="get">
        @csrf
        <div class="main-area">
            @include('admin.analyse.button_area')
            @include('admin.analyse.def_area', ['code' => '3-015', 'title' => '入金後返品チェックリスト'])
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
                                'title' => '得意先コード',
                                'column' => 'customer_cd',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.date_filter_form', [
                                'title' => '販売日付',
                                'column' => 'sale_date',
                                'calendarId1' => 'calendar1',
                                'calendarId2' => 'calendar2',
                                'defaultCondition' => 'eq',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '売上返品区分',
                                'column' => 'sale_return_kbn',
                                'defaultCondition' => 'eq',
                                'defaultValueFirst' => '2',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '入金区分',
                                'column' => 'payment_kbn',
                                'defaultCondition' => 'eq',
                                'defaultValueFirst' => '2',
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
                                    'title' => '得意先コード',
                                    'column' => 'customer_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '得意先名',
                                    'column' => 'bk_customer_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '販売日付',
                                    'column' => 'sale_date',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '販売NO',
                                    'column' => 'id',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '売上金額合計',
                                    'column' => 'all_total',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '伝票備考',
                                    'column' => 'slip_memo',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '入力者名',
                                    'column' => 'user_name',
                                ])
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @isset($data)
                                @foreach ($data as $record)
                                    @if (isset($record->total_flag))
                                        <tr class="ana_total_tr">
                                            <td class="grid_wrapper_left" colspan="4">{{ $record->title }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->all_total) }}</td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                        </tr>
                                    @elseif (isset($record->sub_total_flag))
                                        <tr class="ana_sub_total_tr">
                                            <td class="grid_wrapper_left" colspan="4">{{ $record->title }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->all_total) }}</td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="grid_wrapper_center">{{ $record->customer_cd }}</td>
                                            <td class="grid_wrapper_left">{{ $record->bk_customer_name }}</td>
                                            <td class="grid_wrapper_center">{{ $record->sale_date }}</td>
                                            <td class="grid_wrapper_center">{{ $record->id }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->all_total) }}</td>
                                            <td class="grid_wrapper_left">{{ $record->slip_memo }}</td>
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
