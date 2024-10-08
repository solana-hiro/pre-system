@extends('layouts.admin.app')
@section('page_title', '①受注伝票検索')
@section('title', '①受注伝票検索')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('analyse.detail.search_recived_order.analyse') }}" method="get">
        @csrf
        <div class="main-area">
            @include('admin.analyse.button_area')
            @include('admin.analyse.def_area', [
                'code' => '1-01',
                'title' => '①受注伝票検索',
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
                            @include('admin.analyse.value_filter_form', [
                                'title' => '受注NO',
                                'column' => 'order_receive_number',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.date_filter_form', [
                                'title' => '受注日付',
                                'column' => 'order_receive_date',
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
                                'title' => 'CS1コード',
                                'column' => 'color_cd',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => 'CS2名',
                                'column' => 'size_name',
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
                                'title' => '相手先NO',
                                'column' => 'order_number',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '完了区分',
                                'column' => 'order_receive_finish_flg',
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
                            @include('admin.analyse.value_filter_form', [
                                'title' => 'KEEP案内期限切フラグ',
                                'column' => 'keep_guidance_expiration_flg',
                                'defaultCondition' => '',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '得意先分類コード',
                                'column' => 'customer_class_cd',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.value_filter_form', [
                                'title' => '決済方法',
                                'column' => 'settlement_method',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                            @include('admin.analyse.filter_help', [
                                'helpMessage' => '※決済方法（0:通常、1:クレジット決済）',
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
                                    'title' => '受注NO',
                                    'column' => 'trn_order_receive_headers.order_receive_number',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '受注日付',
                                    'column' => 'trn_order_receive_headers.order_receive_date',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '指定納期',
                                    'column' => 'trn_order_receive_details.specify_deadline',
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
                                    'column' => 'trn_order_receive_headers.bk_delivery_destination_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '明細処理区分',
                                    'column' => 'trn_order_receive_headers.process_kbn',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '行NO',
                                    'column' => 'trn_order_receive_details.order_line_no',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '商品名',
                                    'column' => 'trn_order_receive_details.item_name',
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
                                    'title' => '受注数量',
                                    'column' => 'trn_order_receive_details.order_receive_quantity',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '売上数量',
                                    'column' => 'trn_sale_details.sale_quantity',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '明細備考2',
                                    'column' => 'trn_order_receive_details.memo_2',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '付箋区分名',
                                    'column' => 'mt_order_receive_sticky_notes.sticky_note_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '伝票備考',
                                    'column' => 'trn_order_receive_headers.slip_memo',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '相手先NO',
                                    'column' => 'trn_order_receive_headers.order_number',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '入力者名',
                                    'column' => 'mt_users.user_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '完了区分',
                                    'column' => 'trn_order_receive_details.order_receive_finish_flg',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'ピッキングリスト発行済みフラグ',
                                    'column' => 'trn_order_receive_details.picking_list_output_flg',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'EC注文番号',
                                    'column' => 'trn_order_receive_headers.ec_order_receive_number',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'KEEP案内期限切フラグ',
                                    'column' => 'trn_order_receive_headers.keep_guidance_expiration_flg',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '得意先分類コード',
                                    'column' => 'mt_customer_classes.customer_class_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '得意先分類名',
                                    'column' => 'mt_customer_classes.customer_class_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '送料',
                                    'column' => 'trn_order_receive_headers.postage',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '決済方法',
                                    'column' => 'trn_order_receive_headers.settlement_method',
                                ])
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @isset($data)
                                @foreach ($data as $record)
                                    <tr>
                                        <td class="grid_wrapper_center">{{ $record->customer_cd }}</td>
                                        <td class="grid_wrapper_center">{{ $record->order_receive_number }}</td>
                                        <td class="grid_wrapper_center">{{ $record->order_receive_date }}</td>
                                        <td class="grid_wrapper_center">{{ $record->specify_deadline }}</td>
                                        <td class="grid_wrapper_left">{{ $record->customer_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->delivery_destination_id }}</td>
                                        <td class="grid_wrapper_left">{{ $record->bk_delivery_destination_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->process_kbn }}</td>
                                        <td class="grid_wrapper_center">{{ $record->order_line_no }}</td>
                                        <td class="grid_wrapper_left">{{ $record->item_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->color_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->color_name }}</td>
                                        <td class="grid_wrapper_left">{{ $record->size_name }}</td>
                                        <td class="grid_wrapper_right">{{ number_format($record->order_receive_quantity) }}
                                        </td>
                                        <td class="grid_wrapper_right">{{ number_format($record->sale_quantity) }}</td>
                                        <td class="grid_wrapper_left">{{ $record->memo_2 }}</td>
                                        <td class="grid_wrapper_left">{{ $record->sticky_note_name }}</td>
                                        <td class="grid_wrapper_left">{{ $record->slip_memo }}</td>
                                        <td class="grid_wrapper_center">{{ $record->order_number }}</td>
                                        <td class="grid_wrapper_left">{{ $record->user_name }}</td>
                                        <td class="grid_wrapper_center">{{ $record->order_receive_finish_flg }}</td>
                                        <td class="grid_wrapper_center">{{ $record->picking_list_output_flg }}</td>
                                        <td class="grid_wrapper_center">{{ $record->ec_order_receive_number }}</td>
                                        <td class="grid_wrapper_center">{{ $record->keep_guidance_expiration_flg }}</td>
                                        <td class="grid_wrapper_center">{{ $record->customer_class_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->customer_class_name }}</td>
                                        <td class="grid_wrapper_right">{{ number_format($record->postage) }}</td>
                                        <td class="grid_wrapper_left">
                                            @if ($record->settlement_method === 0)
                                                通常
                                            @else
                                                クレジット決済
                                            @endif
                                        </td>
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
