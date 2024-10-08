@extends('layouts.admin.app')
@section('page_title', '銀行入力')
@section('title', '銀行入力')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('js/master/other/mt_bank/index.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('master.other.mt_bank.update') }}" method="post" data-monitoring>
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
            <div class="sub_contents">
                <div class="left_contents">
                    <div class="grid_gray">
                        <table class="grid_gray_table_100p" id="bank_grid_table">
                            <thead class="grid_gray_header">
                                <tr>
                                    <td class="grid_wrapper_center td_10p">銀行コード</td>
                                    <td class="grid_wrapper_center td_50p">銀行名</td>
                                </tr>
                            </thead>
                            <tbody class="grid_body">
                                @empty(old('insert_bank_code'))
                                    @for ($i = 0; $i < 2; $i++)
                                        <tr>
                                            <td class="grid_wrapper_left grid_textbox_10p"><input type="number"
                                                    name="insert_bank_code[]" onblur="autoCompleteBank(event)"
                                                    id="insert_bank_code" class="grid_textbox" data-limit-len="4"
                                                    data-limit-minus>
                                            </td>
                                            <td class="grid_wrapper_left grid_textbox_50p"><input type="text"
                                                    name="insert_bank_name[]" class="grid_textbox" minlength="0"
                                                    maxlength="20"></td>
                                        </tr>
                                    @endfor
                                @else
                                    @for ($i = 0; $i < count(old('insert_bank_code')); $i++)
                                        <tr>
                                            <td class="grid_wrapper_left grid_textbox_10p"><input type="number"
                                                    name="insert_bank_code[]" onblur="autoCompleteBank(event)"
                                                    id="insert_bank_code" value='{{ old("insert_bank_code.{$i}") }}'
                                                    class="grid_textbox" data-limit-len="4" data-limit-minus></td>
                                            <td class="grid_wrapper_left grid_textbox_50p"><input type="text"
                                                    name="insert_bank_name[]" value='{{ old("insert_bank_name.{$i}") }}'
                                                    class="grid_textbox" minlength="0" maxlength="20"></td>
                                        </tr>
                                    @endfor
                                @endempty
                            </tbody>
                        </table>
                        <div class="plus_rec">
                            <div class="blue_text_wrapper" id="add_line" onclick="bankAddLine()">+ 行を追加する</div>
                        </div>
                    </div>
                </div>
                <div class="left_contents">
                    <div class="element-form">
                        <div class="text_wrapper">銀行コード</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="number" id="input_bank" name="name" class="element input_number_4"
                                    data-ft="filter-table" data-pad-len="4" data-limit-len="4" data-limit-minus />
                                <img class="vector" id="img_bank" src="/img/icon/vector.svg"
                                    data-smm-open="search_bank_modal" />
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="hidden_bank" value="" name="hidden_bank" />
                    <div class="grid">
                        <table class="table_sticky" id="filter-table">
                            <thead class="grid_header">
                                <tr>
                                    <td class="grid_wrapper_center td_5p">削除</td>
                                    <td class="grid_wrapper_center td_20p">銀行コード</td>
                                    <td class="grid_wrapper_center td_60p">銀行名</td>
                                </tr>
                            </thead>
                            <tbody class="tbody_scroll">
                                @php $i=0; @endphp
                                @foreach ($initData as $data)
                                    <tr data-trv="{{ $data->bank_cd }}">
                                        <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                                data-target="#modal_delete" data-value="{{ $data['id'] }}"
                                                class="display_none" name="delete"><img class="grid_img_center"
                                                    src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                        <td class="grid_col_6 col_rec"><input type="number" name="update_bank_code[]"
                                                id="input_update_bank_{{ $data['id'] }}" class="grid_textbox"
                                                value="{{ old("update_bank_code.{$i}", $data['bank_cd']) }}"
                                                data-limit-len="4" data-limit-minus readonly></td>
                                        <td class="grid_col_2 col_rec"><input type="text" name="update_bank_name[]"
                                                id="names_update_bank_{{ $data['id'] }}" class="grid_textbox"
                                                minlength="0" maxlength="20" size="20"
                                                value="{{ old("update_bank_name.{$i}", $data['bank_name']) }}"></td>
                                        <input type="hidden" name="update_id[]" value="{{ $data['id'] }}" />
                                        <input type="hidden" id="hidden_update_bank_{{ $data['id'] }}" value=""
                                            name="hidden_bank_{{ $data['id'] }}" />
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
    @include('admin.master.search.bank', ['bankData' => $bankData])
@endsection
