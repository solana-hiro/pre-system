@extends('layouts.admin.app')
@section('page_title', '運送会社入力')
@section('title', '運送会社入力')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script type="module" src="{{ asset('js/master/other/mt_shipping_company/index.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('master.other.mt_shipping_company.update') }}" method="post" data-monitoring>
        @csrf
        <div class="button_area">
            <div class="div">
                <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                    data-url="" name="cancel2">
                    <div class="text_wrapper">キャンセル</div>
                </button>
                <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value="" class="button-2"
                    data-url="" name="update2">
                    <div class="text_wrapper_3">登録する</div>
                </button>
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
        @elseif (Session::has('sessionErrors'))
            <div class="alert alert-danger">
                <ul>
                    @foreach (session('sessionErrors') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif (Session::has('flashmessage'))
            @include('components.modal.message', ['flashmessage' => session('flashmessage')])
        @elseif (Session::has('errormessage'))
            @include('components.modal.error', ['errormessage' => session('errormessage')])
        @endif
        <div class="alert alert-danger">
            <ul id="alert-danger-ul">
        </div>
        <div class="main_area">
            <div class="sub_contents_y">
                <div>
                    <div class="grid_gray">
                        <table class="grid_gray_table_100p" id="shipping_grid_table">
                            <thead class="grid_gray_header">
                                <tr>
                                    <td class="grid_wrapper_center">運送会社コード</td>
                                    <td class="grid_wrapper_center">運送会社名</td>
                                    <td class="grid_wrapper_center">送り状種別</td>
                                    <td class="grid_wrapper_center">荷札種別</td>
                                </tr>
                            </thead>
                            <tbody class="grid_body">
                                @empty(old('insert_shipping_company_code'))
                                    @for ($i = 0; $i < 2; $i++)
                                        <tr>
                                            <td class="grid_wrapper_left">
                                                <input type="number" onblur="autoCompleteShippingCompany(event)"
                                                    id="insert_shipping_company_code" name="insert_shipping_company_code[]"
                                                    class="grid_textbox input_number_4" data-limit-len="4" data-limit-minus>
                                            </td>
                                            <td class="grid_wrapper_left">
                                                <input type="text" name="insert_shipping_company_name[]"
                                                    class="grid_textbox input_text_20" minlength="0" maxlength="20">
                                            </td>
                                            <td class="grid_wrapper_left">
                                                <div class="flex">
                                                    <input type="number" id="input_slip_kind7{{ $i }}"
                                                        name="insert_slip_kind7[]" class="grid_textbox input_number_3"
                                                        data-limit-len="3" data-limit-minus>
                                                    <img class="vector" id="img_slip_kind7{{ $i }}"
                                                        src="/img/icon/vector.svg" data-smm-open="search_slip_kind_07_modal" />
                                                </div>
                                            </td>
                                            <td class="grid_wrapper_left">
                                                <div class="flex">
                                                    <input type="number" id="input_slip_kind17{{ $i }}"
                                                        name="insert_slip_kind17[]" class="grid_textbox input_number_3"
                                                        data-limit-len="3" data-limit-minus>
                                                    <img class="vector" id="img_slip_kind17{{ $i }}"
                                                        src="/img/icon/vector.svg" data-smm-open="search_slip_kind_17_modal" />
                                                </div>
                                            </td>
                                        </tr>
                                        <input type="hidden" id="hidden_slip_kind7{{ $i }}" value=""
                                            name="hidden_slip_kind7" />
                                        <input type="hidden" id="hidden_slip_kind17{{ $i }}" value=""
                                            name="hidden_slip_kind17" />
                                    @endfor
                                @else
                                    @for ($i = 0; $i < count(old('insert_shipping_company_code')); $i++)
                                        <tr>
                                            <td class="grid_wrapper_left">
                                                <input type="number" onblur="autoCompleteShippingCompany(event)"
                                                    id="insert_shipping_company_code" name="insert_shipping_company_code[]"
                                                    class="grid_textbox input_number_4" data-limit-len="4" data-limit-minus
                                                    value="{{ old("insert_shipping_company_code.{$i}") }}">
                                            </td>
                                            <td class="grid_wrapper_left">
                                                <input type="text" name="insert_shipping_company_name[]"
                                                    class="grid_textbox input_text_20" minlength="0" maxlength="20"
                                                    value="{{ old("insert_shipping_company_name.{$i}") }}">
                                            </td>
                                            <td class="grid_wrapper_left">
                                                <div class="flex">
                                                    <input type="number" id="input_slip_kind7{{ $i }}"
                                                        name="insert_slip_kind7[]" class="grid_textbox input_number_3"
                                                        data-limit-len="3" data-limit-minus
                                                        value="{{ old("insert_slip_kind7.{$i}") }}">
                                                    <img class="vector" id="img_slip_kind7{{ $i }}"
                                                        src="/img/icon/vector.svg"
                                                        data-smm-open="search_slip_kind_07_modal" />
                                                </div>
                                            </td>
                                            <td class="grid_wrapper_left">
                                                <div class="flex">
                                                    <input type="number" id="input_slip_kind17{{ $i }}"
                                                        name="insert_slip_kind17[]" class="grid_textbox input_number_3"
                                                        data-limit-len="3" data-limit-minus
                                                        value="{{ old("insert_slip_kind17.{$i}") }}">
                                                    <img class="vector" id="img_slip_kind17{{ $i }}"
                                                        src="/img/icon/vector.svg"
                                                        data-smm-open="search_slip_kind_17_modal" />
                                                </div>
                                            </td>
                                        </tr>
                                        <input type="hidden" id="hidden_slip_kind7{{ $i }}" value=""
                                            name="hidden_slip_kind7" />
                                        <input type="hidden" id="hidden_slip_kind17{{ $i }}" value=""
                                            name="hidden_slip_kind17" />
                                    @endfor
                                @endempty
                            </tbody>
                        </table>
                        <div class="plus_rec">
                            <div class="blue_text_wrapper" id="add_line" onclick="shippingCompanyAddLine()">+ 行を追加する
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="element-form">
                        <div class="text_wrapper">運送会社コード</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="number" id="input_shipping_company" name="name"
                                    class="element input_number_4" data-ft="exist-shipping-company-table"
                                    data-pad-len="4" data-limit-len="4" data-limit-minus data-monitoring-exclude />
                                <img class="vector" id="img_shipping_company" src="/img/icon/vector.svg"
                                    data-smm-open="search_shipping_company_modal" />
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="hidden_shipping_company" value="" name="hidden_shipping_company" />
                    <div class="grid">
                        <table class="table_sticky" id="exist-shipping-company-table">
                            <thead class="grid_header">
                                <tr>
                                    <td class="grid_wrapper_center">削除</td>
                                    <td class="grid_wrapper_center">運送会社コード</td>
                                    <td class="grid_wrapper_center">&emsp;&emsp;&emsp;運送会社名&emsp;&emsp;&emsp;</td>
                                    <td class="grid_wrapper_center">送り状種別</td>
                                    <td class="grid_wrapper_center">荷札種別</td>
                                </tr>
                            </thead>
                            <tbody class="tbody_scroll">
                                @php $i=0; @endphp
                                @foreach ($initData as $data)
                                    <tr data-trv="{{ $data->shipping_company_cd }}">
                                        <td class="grid_col_1 col_rec">
                                            <button type="button" data-toggle="modal" data-target="#modal_delete"
                                                data-value="{{ $data['id'] }}" class="display_none" name="delete">
                                                <img class="grid_img_center" src="{{ asset('/img/icon/trash.svg') }}">
                                            </button>
                                        </td>
                                        <td class="grid_col_2 col_rec">
                                            <input type="number" name="update_shipping_company_code[]"
                                                id="input_update_shipping_company_{{ $data['id'] }}"
                                                class="grid_textbox input_number_4"
                                                value="{{ old("update_shipping_company_code.{$i}", $data['shipping_company_cd']) }}"
                                                readonly>
                                        </td>
                                        <td class="grid_col_2 col_rec">
                                            <input type="text" name="update_shipping_company_name[]"
                                                id="names_update_shipping_company_{{ $data['id'] }}"
                                                class="grid_textbox input_text_20" minlength="0" maxlength="20"
                                                value="{{ old("update_shipping_company_name.{$i}", $data['shipping_company_name']) }}">
                                        </td>
                                        <td class="grid_col_2 col_rec">
                                            <div class="flex">
                                                <input type="number" id="input_upd_slip_kind7{{ $i }}"
                                                    name="update_slip_kind7[]" class="grid_textbox input_number_3"
                                                    value="{{ old("update_slip_kind7.{$i}", $data['slip_kind_7_cd']) }}"
                                                    data-limit-len="3" data-limit-minus>
                                                <img class="vector" id="img_upd_slip_kind7{{ $i }}"
                                                    src="/img/icon/vector.svg"
                                                    data-smm-open="search_slip_kind_07_modal" />
                                            </div>
                                        </td>
                                        <td class="grid_col_2 col_rec">
                                            <div class="flex">
                                                <input type="number" id="input_upd_slip_kind17{{ $i }}"
                                                    name="update_slip_kind17[]" class="grid_textbox input_number_3"
                                                    value="{{ old("update_slip_kind17.{$i}", $data['slip_kind_17_cd']) }}"
                                                    data-limit-len="3" data-limit-minus>
                                                <img class="vector" id="img_upd_slip_kind17{{ $i }}"
                                                    src="/img/icon/vector.svg"
                                                    data-smm-open="search_slip_kind_17_modal" />
                                            </div>
                                        </td>
                                        <input type="hidden" name="update_id[]" value="{{ $data['id'] }}" />
                                        <input type="hidden" id="hidden_update_shipping_company_{{ $data['id'] }}"
                                            value="" name="hidden_shipping_company_{{ $data['id'] }}" />
                                        <input type="hidden" id="hidden_upd_slip_kind7{{ $i }}"
                                            value="" name="hidden_upd_slip_kind7{{ $i }}" />
                                        <input type="hidden" id="hidden_upd_slip_kind17{{ $i }}"
                                            value="" name="hidden_upd_slip_kind17{{ $i }}" />
                                    </tr>
                                    @php $i++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="update" name="update" class="display_none_all"></button>
        <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.master.search.shipping_company', ['shippingCompanyData' => $shippingCompanyData])
    @include('admin.master.search.slip_kind', ['slipKindKbnCd' => '07'])
    @include('admin.master.search.slip_kind', ['slipKindKbnCd' => '17'])
@endsection
