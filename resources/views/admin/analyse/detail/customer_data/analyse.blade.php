@extends('layouts.admin.app')
@section('page_title', '共有用得意先データ')
@section('title', '共有用得意先データ')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('analyse.detail.customer_data.analyse') }}" method="get">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button class="button" type="submit" name="cancel">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="csv">
                        <div class="text_wrapper_2">保存する</div>
                    </button>
                    <button class="button-2" type="submit" name="search" value="search">
                        <div class="text_wrapper_3">問合せ</div>
                    </button>
                </div>
            </div>

            <div class="element-form-rows">
                <div class="element-form">
                    <div class="text_wrapper">定義</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="analyse_code" id="analyse_code" class="element" minlength="0"
                                maxlength="6" size="6" value="1-42" disabled />
                        </div>
                    </div>
                </div>
                <div class="element-form">
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="analyse_name" id="analyse_name" class="element" minlength="0"
                                maxlength="20" size="20" value="共有用得意先データ" disabled />
                        </div>
                    </div>
                </div>
            </div><br>

            @isset($data)
                {{ $data->links('admin.analyse.pagination') }}
            @endisset
            <div class="box">
                <div class="grid">
                    <table>
                        <thead class="grid_header">
                            <tr>
                                <td class="grid_wrapper_center">
                                    得意先CD
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="asc-customer_cd">▲</button>
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="desc-customer_cd">▼</button>
                                </td>
                                <td class="grid_wrapper_center">
                                    全得意先名
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="asc-customer_name">▲</button>
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="desc-customer_name">▼</button>
                                </td>
                                <td class="grid_wrapper_center">
                                    名カナ
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="asc-customer_name_kana">▲</button>
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="desc-customer_name_kana">▼</button>
                                </td>
                                <td class="grid_wrapper_center">
                                    郵便番号
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="asc-post_number">▲</button>
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="desc-post_number">▼</button>
                                </td>
                                <td class="grid_wrapper_center">
                                    全住所
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="asc-address">▲</button>
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="desc-address">▼</button>
                                </td>
                                <td class="grid_wrapper_center">
                                    電話番号
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="asc-tel">▲</button>
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="desc-tel">▼</button>
                                </td>
                                <td class="grid_wrapper_center">
                                    FAX番号
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="asc-fax">▲</button>
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="desc-fax">▼</button>
                                </td>
                                <td class="grid_wrapper_center">
                                    請求先CD
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="asc-mt_billing_addresses.billing_address_cd">▲</button>
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="desc-mt_billing_addresses.billing_address_cd">▼</button>
                                </td>
                                <td class="grid_wrapper_center">
                                    ルート名
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="asc-mt_roots.root_name">▲</button>
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="desc-mt_roots.root_name">▼</button>
                                </td>
                                <td class="grid_wrapper_center">
                                    備考1
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="asc-customer_memo_1">▲</button>
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="desc-customer_memo_1">▼</button>
                                </td>
                                <td class="grid_wrapper_center">
                                    備考2
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="asc-customer_memo_1">▲</button>
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="desc-customer_memo_1">▼</button>
                                </td>
                                <td class="grid_wrapper_center">
                                    運送会社名
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="asc-mt_item_classes.item_class_name">▲</button>
                                    <button class="ana_indicator_button" type="submit" name="search"
                                        value="desc-mt_item_classes.item_class_name">▼</button>
                                </td>
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @isset($data)
                                @foreach ($data as $record)
                                    <tr>
                                        <td class="grid_wrapper_center">{{ $record->customer_cd }}</td>
                                        <td class="grid_wrapper_left">{{ $record->customer_name }}</td>
                                        <td class="grid_wrapper_left">{{ $record->customer_name_kana }}</td>
                                        <td class="grid_wrapper_center">{{ $record->post_number }}</td>
                                        <td class="grid_wrapper_left">{{ $record->address }}</td>
                                        <td class="grid_wrapper_center">{{ $record->tel }}</td>
                                        <td class="grid_wrapper_center">{{ $record->fax }}</td>
                                        <td class="grid_wrapper_center">{{ $record->billing_address_cd }}
                                        </td>
                                        <td class="grid_wrapper_left">{{ $record->root_name }}</td>
                                        <td class="grid_wrapper_left">{{ $record->customer_memo_1 }}</td>
                                        <td class="grid_wrapper_left">{{ $record->customer_memo_2 }}</td>
                                        <td class="grid_wrapper_left">{{ $record->item_class_name }}</td>
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
