@extends('layouts.admin.app')
@section('page_title', '得意先別粗利管理表')
@section('title', '得意先別粗利管理表')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>
@section('content')
    <form role="search" action="{{ route('analyse.tally.gross_profit_chart.analyse') }}" method="get">
        @csrf
        <div class="main-area">
            @include('admin.analyse.button_area')
            @include('admin.analyse.def_area', ['code' => '3-007', 'title' => '得意先別粗利管理表'])
            <br>

            <div class="element-form-rows">
                <div class="element-form">
                    <div class="text_wrapper">順位表示</div>
                    <div class="frame">
                        <select name="rank_base" class="large_selectbox">
                            <option value="net_sales" @if (old('rank_base') === 'net_sales') selected @endif>
                                純売上金額
                            </option>
                            <option value="loss_cost" @if (old('rank_base') === 'loss_cost') selected @endif>
                                ロス原価
                            </option>
                        </select>
                    </div>
                </div>
                <div class="element-form">
                    <div class="frame">
                        <select name="rank_order" class="medium_selectbox">
                            <option value="desc" @if (old('rank_order') === 'desc') selected @endif>
                                ベスト
                            </option>
                            <option value="asc" @if (old('rank_order') === 'asc') selected @endif>
                                ワースト
                            </option>
                        </select>
                    </div>
                </div>
            </div>

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
                                'title' => '商品コード',
                                'column' => 'item_cd',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.date_filter_form', [
                                'title' => '販売日付',
                                'column' => 'sale_date',
                                'calendarId1' => 'calendar1',
                                'calendarId2' => 'calendar2',
                                'defaultCondition' => 'none',
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
                                    'title' => '順位',
                                    'column' => 'rank_no',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '請求先コード',
                                    'column' => 'billing_address_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '請求先名',
                                    'column' => 'bk_customer_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '純売上金額',
                                    'column' => 'net_sales',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'ロス原価',
                                    'column' => 'loss_cost',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '粗利金額',
                                    'column' => 'gross_profit',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '粗利率（％）',
                                    'column' => 'gross_profit_rate',
                                ])
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @isset($data)
                                @foreach ($data as $record)
                                    @if (isset($record->total_flag))
                                        <tr>
                                            <td class="grid_wrapper_right" colspan="3">合計</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->net_sales) }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->loss_cost) }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->gross_profit) }}</td>
                                            <td class="grid_wrapper_center">{{ $record->gross_profit_rate }}％</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="grid_wrapper_center">{{ $record->rank_no }}</td>
                                            <td class="grid_wrapper_center">{{ $record->billing_address_cd }}</td>
                                            <td class="grid_wrapper_left">{{ $record->bk_customer_name }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->net_sales) }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->loss_cost) }}</td>
                                            <td class="grid_wrapper_right">{{ number_format($record->gross_profit) }}</td>
                                            <td class="grid_wrapper_center">{{ $record->gross_profit_rate }}％</td>
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
