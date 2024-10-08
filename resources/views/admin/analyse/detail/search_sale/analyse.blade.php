@extends('layouts.admin.app')
@section('page_title', '②売上伝票検索')
@section('title', '②売上伝票検索')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('analyse.detail.search_sale.analyse') }}" method="get">
        @csrf
        <div class="main-area">
            @include('admin.analyse.button_area')
            @include('admin.analyse.def_area', [
                'code' => '1-02',
                'title' => '②売上伝票検索',
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
                                'defaultCondition' => 'none',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '受注NO',
                                'column' => 'order_receive_number',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '販売NO',
                                'column' => 'sale_number',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '納品先コード',
                                'column' => 'delivery_destination_id',
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
                                'title' => '伝票備考',
                                'column' => 'slip_memo',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '送り状番号',
                                'column' => 'shipping_document_numbers',
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
                                    'title' => '得意先コード',
                                    'column' => 'mt_customers.customer_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '販売日付',
                                    'column' => 'trn_sale_headers.sale_date',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '受注NO',
                                    'column' => 'trn_order_receive_headers.order_receive_number',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '販売NO',
                                    'column' => 'trn_sale_headers.sale_number',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '得意先名',
                                    'column' => 'mt_customers.customer_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '納品先コード',
                                    'column' => 'mt_delivery_destinations.delivery_destination_id',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '納品先名',
                                    'column' => 'trn_sale_headers.bk_delivery_destination_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '商品名',
                                    'column' => 'trn_sale_details.item_name',
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
                                    'title' => 'CS2名',
                                    'column' => 'mt_sizes.size_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '売上数量',
                                    'column' => 'sale_quantity',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '売上単価',
                                    'column' => 'trn_sale_details.sale_price',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '伝票備考',
                                    'column' => 'trn_sale_headers.slip_memo',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '運送会社名',
                                    'column' => 'mt_shipping_companies.shipping_company_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '送り状番号',
                                    'column' => 'trn_shippings.shipping_document_numbers',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '個口数',
                                    'column' => 'trn_shippings.piece_number',
                                ])
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @isset($data)
                                @foreach ($data as $record)
                                    <tr>
                                        <td class="grid_wrapper_center">{{ $record->customer_cd }}</td>
                                        <td class="grid_wrapper_center">{{ $record->sale_date }}</td>
                                        <td class="grid_wrapper_center">{{ $record->order_receive_number }}</td>
                                        <td class="grid_wrapper_center">{{ $record->sale_number }}</td>
                                        <td class="grid_wrapper_left">{{ $record->bk_customer_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->delivery_destination_id }}</td>
                                        <td class="grid_wrapper_left">{{ $record->bk_delivery_destination_name }}</td>
                                        <td class="grid_wrapper_left">{{ $record->item_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->color_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->color_name }}</td>
                                        <td class="grid_wrapper_left">{{ $record->size_name }}</td>
                                        <td class="grid_wrapper_right">{{ number_format($record->sale_quantity) }}</td>
                                        <td class="grid_wrapper_right">{{ number_format($record->sale_price) }}</td>
                                        <td class="grid_wrapper_left">{{ $record->slip_memo }}</td>
                                        <td class="grid_wrapper_left">{{ $record->shipping_company_name }}</td>
                                        <td class="grid_wrapper_left">{{ $record->shipping_document_numbers }}</td>
                                        <td class="grid_wrapper_left">{{ $record->piece_number }}</td>
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
