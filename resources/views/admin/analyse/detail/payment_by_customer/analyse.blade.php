@extends('layouts.admin.app')
@section('page_title', '入金明細表（得意先別）')
@section('title', '入金明細表（得意先別）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('analyse.detail.payment_by_customer.analyse') }}" method="get">
        @csrf
        <div class="main-area">
            @include('admin.analyse.button_area')
            @include('admin.analyse.def_area', ['code' => '3-007', 'title' => '入金明細表（得意先別）'])
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
                                'defaultCondition' => 'eq',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.date_filter_form', [
                                'title' => '入金日付',
                                'column' => 'payment_date',
                                'calendarId1' => 'calendar1',
                                'calendarId2' => 'calendar2',
                                'defaultCondition' => 'between',
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
                                    'column' => 'customer_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '入金日付',
                                    'column' => 'payment_date',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '入金金額',
                                    'column' => 'amount',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '入金区分名',
                                    'column' => 'payment_kbn_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '備考1',
                                    'column' => 'memo1',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '備考2',
                                    'column' => 'memo2',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '銀行名',
                                    'column' => 'bank_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '更新者名',
                                    'column' => 'user_name',
                                ])
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @isset($data)
                                @foreach ($data as $record)
                                    @if (isset($record->total_flag))
                                        <tr class="ana_total_tr">
                                            <td class="grid_wrapper_left" colspan="3">{{ $record->title }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->amount) }}</td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                        </tr>
                                    @elseif (isset($record->sub_total_flag))
                                        <tr class="ana_sub_total_tr">
                                            <td class="grid_wrapper_left" colspan="3">{{ $record->title }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->amount) }}</td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                            <td class="grid_wrapper_left"></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="grid_wrapper_center">{{ $record->customer_cd }}</td>
                                            <td class="grid_wrapper_left">{{ $record->customer_name }}</td>
                                            <td class="grid_wrapper_center">{{ $record->payment_date }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->amount) }}</td>
                                            <td class="grid_wrapper_left">{{ $record->payment_kbn_name }}</td>
                                            <td class="grid_wrapper_left">{{ $record->memo1 }}</td>
                                            <td class="grid_wrapper_left">{{ $record->memo2 }}</td>
                                            <td class="grid_wrapper_left">{{ $record->bank_name }}</td>
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
