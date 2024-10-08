@extends('layouts.admin.app')
@section('page_title', '共有用納品先データ')
@section('title', '共有用納品先データ')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('analyse.detail.customer_delivery_destination_data.analyse') }}" method="get">
        @csrf
        <div class="main-area">
            @include('admin.analyse.button_area')
            @include('admin.analyse.def_area', [
                'code' => '1-43',
                'title' => '共有用納品先データ',
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
                                'title' => '削除区分_得納',
                                'column' => 'del_kbn_customer',
                                'defaultCondition' => 'none',
                                'defaultValueFirst' => '',
                                'defaultValueSecond' => '',
                            ])
                        </tbody>
                    </table>
                </div>
            </div>

            @isset($data)
                {{ $data->links('admin.analyse.pagination') }}
            @endisset
            <div class="box">
                <div class="grid">
                    <table>
                        <thead class="grid_header">
                            <tr>
                                @include('admin.analyse.sortable_th', [
                                    'title' => '納品先CD',
                                    'column' => 'mt_delivery_destinations.delivery_destination_id',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '全納品先名',
                                    'column' => 'mt_delivery_destinations.delivery_destination_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '名カナ',
                                    'column' => 'mt_delivery_destinations.delivery_destination_name_kana',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '郵便番号',
                                    'column' => 'mt_delivery_destinations.post_number',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '全住所',
                                    'column' => 'mt_delivery_destinations.address',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '電話番号',
                                    'column' => 'mt_delivery_destinations.tel',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'FAX番号',
                                    'column' => 'mt_delivery_destinations.fax',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '得意先CD',
                                    'column' => 'mt_customers.customer_cd',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => 'ルート名',
                                    'column' => 'mt_roots.root_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '備考1',
                                    'column' => 'def_arrival_dates.arrival_date_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '備考2',
                                    'column' => 'mt_customer_delivery_destinations.sale_decision_print_paper_flg',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '運送会社名',
                                    'column' => 'mt_item_classes.item_class_name',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '削除区分',
                                    'column' => 'mt_delivery_destinations.del_kbn_delivery_destination',
                                ])
                                @include('admin.analyse.sortable_th', [
                                    'title' => '削除区分_得納',
                                    'column' => 'mt_customer_delivery_destinations.del_kbn_customer',
                                ])
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @isset($data)
                                @foreach ($data as $record)
                                    <tr>
                                        <td class="grid_wrapper_center">
                                            {{ $record->delivery_destination_id }}
                                        </td>
                                        <td class="grid_wrapper_left">
                                            {{ $record->delivery_destination_name }}
                                        </td>
                                        <td class="grid_wrapper_left">
                                            {{ $record->delivery_destination_name_kana }}
                                        </td>
                                        <td class="grid_wrapper_center">
                                            {{ $record->post_number }}
                                        </td>
                                        <td class="grid_wrapper_left">
                                            {{ $record->address }}
                                        </td>
                                        <td class="grid_wrapper_center">
                                            {{ $record->tel }}
                                        </td>
                                        <td class="grid_wrapper_center">
                                            {{ $record->fax }}
                                        </td>
                                        <td class="grid_wrapper_center">
                                            {{ $record->customer_cd }}
                                        </td>
                                        <td class="grid_wrapper_left">
                                            {{ $record->root_name }}
                                        </td>
                                        <td class="grid_wrapper_left">
                                            {{ $record->arrival_date_name }}
                                        </td>
                                        <td class="grid_wrapper_left">
                                            {{ $record->sale_decision_print_paper_flg }}
                                        </td>
                                        <td class="grid_wrapper_left">
                                            {{ $record->item_class_name }}
                                        </td>
                                        <td class="grid_wrapper_left">
                                            {{ $record->del_kbn_delivery_destination }}
                                        </td>
                                        <td class="grid_wrapper_left">
                                            {{ $record->del_kbn_customer }}
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
@endsection
