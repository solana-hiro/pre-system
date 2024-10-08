@extends('layouts.admin.app')
@section('page_title', 'サイズパターンマスタ（一覧）')
@section('title', 'サイズパターンマスタ（一覧）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('master.item.mt_size_pattern.update') }}" method="post">
        @csrf
        <div class="main-area">
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
            <div class="grid_gray_pattern">
                <table class="grid_gray_pattern_table" id="size_pattern_grid_table">
                    <thead class="grid_header">
                        <tr>
                            <td rowspan="2" class="grid_wrapper_center td01">サイズ<br>パターン<br>コード</td>
                            <td class="grid_wrapper_center td02">サイズコード1</td>
                            <td class="grid_wrapper_center td02">サイズコード2</td>
                            <td class="grid_wrapper_center td02">サイズコード3</td>
                            <td class="grid_wrapper_center td02">サイズコード4</td>
                            <td class="grid_wrapper_center td02">サイズコード5</td>
                            <td class="grid_wrapper_center td02">サイズコード6</td>
                            <td class="grid_wrapper_center td02">サイズコード7</td>
                            <td class="grid_wrapper_center td02">サイズコード8</td>
                            <td class="grid_wrapper_center td02">サイズコード9</td>
                            <td class="grid_wrapper_center td02">サイズコード10</td>
                        </tr>
                        <tr>
                            <td class="grid_wrapper_center td02">サイズ名1</td>
                            <td class="grid_wrapper_center td02">サイズ名2</td>
                            <td class="grid_wrapper_center td02">サイズ名3</td>
                            <td class="grid_wrapper_center td02">サイズ名4</td>
                            <td class="grid_wrapper_center td02">サイズ名5</td>
                            <td class="grid_wrapper_center td02">サイズ名6</td>
                            <td class="grid_wrapper_center td02">サイズ名7</td>
                            <td class="grid_wrapper_center td02">サイズ名8</td>
                            <td class="grid_wrapper_center td02">サイズ名9</td>
                            <td class="grid_wrapper_center td02">サイズ名10</td>
                        </tr>
                    </thead>
                    <tbody class="grid_body">
                        @empty(old('insert_size_pattern_code'))
                            @for ($i = 0; $i < 2; $i++)
                                <tr>
                                    <td rowspan="2" class="grid_col_1"><input type="number" placeholder=""
                                            id="size_pattern_code" onblur="eventBlurCodeautoSizePattern(arguments[0], this)"
                                            name="insert_size_pattern_code[]" class="grid_textbox input_number_4" data-limit-len="4" data-limit-minus></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code1{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code1[]" class="grid_textbox" minlength="0" maxlength="5"><img
                                            class="vector" id="img_size_code1{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code2{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code2[]" class="grid_textbox" minlength="0" maxlength="5"><img
                                            class="vector" id="img_size_code2{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code3{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code3[]" class="grid_textbox" minlength="0" maxlength="5"><img
                                            class="vector" id="img_size_code3{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code4{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code4[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_size_code4{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code5{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code5[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_size_code5{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code6{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code6[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_size_code6{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code7{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code7[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_size_code7{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code8{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code8[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_size_code8{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code9{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code9[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_size_code9{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code10{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code10[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_size_code10{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_size_modal" /></div></td>
                                </tr>
                                <tr>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name1[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name2[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name3[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name4[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name5[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name6[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name7[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name8[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name9[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name10[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                </tr>
                            @endfor
                        @else
                            @for ($i = 0; $i < count(old('insert_size_pattern_code')); $i++)
                                <tr>
                                    <td rowspan="2" class="grid_col_1"><input type="text" placeholder=""
                                            id="size_pattern_code" onblur="eventBlurCodeautoSizePattern(arguments[0], this)"
                                            name="insert_size_pattern_code[]" class="grid_textbox" minlength="0"
                                            maxlength="4" value="{{ old('insert_size_pattern_code')[$i] }}"></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code1{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code1[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_size_code1')[$i] }}"><img class="vector"
                                            id="img_size_code1{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code2{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code2[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_size_code2')[$i] }}"><img class="vector"
                                            id="img_size_code2{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code3{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code3[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_size_code3')[$i] }}"><img class="vector"
                                            id="img_size_code3{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code4{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code4[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_size_code4')[$i] }}"><img class="vector"
                                            id="img_size_code4{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code5{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code5[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_size_code5')[$i] }}"><img class="vector"
                                            id="img_size_code5{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code6{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code6[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_size_code6')[$i] }}"><img class="vector"
                                            id="img_size_code6{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code7{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code7[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_size_code7')[$i] }}"><img class="vector"
                                            id="img_size_code7{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code8{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code8[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_size_code8')[$i] }}"><img class="vector"
                                            id="img_size_code8{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code9{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code9[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_size_code9')[$i] }}"><img class="vector"
                                            id="img_size_code9{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_size_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_size_code10{{ $i }}"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="insert_size_code10[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_size_code10')[$i] }}"><img class="vector"
                                            id="img_size_code10{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_size_modal" /></div></td>
                                </tr>
                                <tr>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name1[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_size_name1')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name2[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_size_name2')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name3[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_size_name3')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name4[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_size_name4')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name5[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_size_name5')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name6[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_size_name6')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name7[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_size_name7')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name8[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_size_name8')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name9[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_size_name9')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_size_name10[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_size_name10')[$i] }}" readonly>
                                    </td>
                                </tr>
                            @endfor
                        @endempty
                    </tbody>
                </table>
            </div>

            <div class="plus_rec">
                <div class="blue_text_wrapper" id="add_line" onclick="sizePatternAddLine()">+ 行を追加する</div>
            </div>

            <div class="element-form element-form-single">
                <div class="text_wrapper">サイズパターンコード</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="number" name="size_pattern_cd" id="input_size_pattern" class="element input_number_4"
                        data-limit-len="4" data-limit-minus data-ft="filter-table" data-pad-len="4" />
                        <img class="vector" id="img_size_pattern" src="/img/icon/vector.svg"
                            data-smm-open="search_size_pattern_modal" />
                    </div>
                </div>
                <input type="hidden" id="hidden_size_pattern" value="" name="hidden_size_pattern" />
            </div>

            <div class="grid">
                <table class="grid_table" id="filter-table">
                    <thead class="grid_header">
                        <tr>
                            <td rowspan="2" class="grid_wrapper_center col1">削除</td>
                            <td rowspan="2" class="grid_wrapper_center col2">サイズ<br>パターン<br>コード</td>
                            <td class="grid_wrapper_center col11">サイズコード1</td>
                            <td class="grid_wrapper_center col11">サイズコード2</td>
                            <td class="grid_wrapper_center col11">サイズコード3</td>
                            <td class="grid_wrapper_center col11">サイズコード4</td>
                            <td class="grid_wrapper_center col11">サイズコード5</td>
                            <td class="grid_wrapper_center col11">サイズコード6</td>
                            <td class="grid_wrapper_center col11">サイズコード7</td>
                            <td class="grid_wrapper_center col11">サイズコード8</td>
                            <td class="grid_wrapper_center col11">サイズコード9</td>
                            <td class="grid_wrapper_center col11">サイズコード10</td>
                        </tr>
                        <tr>
                            <td class="grid_wrapper_center col11">サイズ名1</td>
                            <td class="grid_wrapper_center col11">サイズ名2</td>
                            <td class="grid_wrapper_center col11">サイズ名3</td>
                            <td class="grid_wrapper_center col11">サイズ名4</td>
                            <td class="grid_wrapper_center col11">サイズ名5</td>
                            <td class="grid_wrapper_center col11">サイズ名6</td>
                            <td class="grid_wrapper_center col11">サイズ名7</td>
                            <td class="grid_wrapper_center col11">サイズ名8</td>
                            <td class="grid_wrapper_center col11">サイズ名9</td>
                            <td class="grid_wrapper_center col11">サイズ名10</td>
                        </tr>
                    </thead>
                    <tbody class="grid_body">
                        @empty(old('update_size_pattern_code'))
                            @foreach ($initData as $data)
                                <tr data-trv="{{ $data['size_pattern_cd'] }}">
                                    <td rowspan="2" class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                            data-target="#modal_delete" data-value="{{ $data['id'] }}"
                                            class="display_none" name="delete"><img class="grid_img_center"
                                                src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                    <td rowspan="2" class="grid_col_2 col_rec"><input type="text"
                                            onblur="eventBlurCodeautoSizePattern(arguments[0], this)" placeholder=""
                                            name="update_size_pattern_code[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ $data['size_pattern_cd'] }}" readonly></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_size_code1"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)" placeholder=""
                                            name="update_size_code1[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['size_cd1'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_size_code2"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)" placeholder=""
                                            name="update_size_code2[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['size_cd2'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_size_code3"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)" placeholder=""
                                            name="update_size_code3[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['size_cd3'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_size_code4"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)" placeholder=""
                                            name="update_size_code4[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['size_cd4'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_size_code5"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)" placeholder=""
                                            name="update_size_code5[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['size_cd5'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_size_code6"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)" placeholder=""
                                            name="update_size_code6[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['size_cd6'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_size_code7"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)" placeholder=""
                                            name="update_size_code7[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['size_cd7'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_size_code8"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)" placeholder=""
                                            name="update_size_code8[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['size_cd8'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_size_code9"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)" placeholder=""
                                            name="update_size_code9[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['size_cd9'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_size_code10"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)" placeholder=""
                                            name="update_size_code10[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['size_cd10'] }}"></td>
                                </tr>
                                <tr data-trv="{{ $data['size_pattern_cd'] }}">
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name1[]" class="grid_textbox"
                                            value="{{ $data['size_name1'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name2[]" class="grid_textbox"
                                            value="{{ $data['size_name2'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name3[]" class="grid_textbox"
                                            value="{{ $data['size_name3'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name4[]" class="grid_textbox"
                                            value="{{ $data['size_name4'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name5[]" class="grid_textbox"
                                            value="{{ $data['size_name5'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name6[]" class="grid_textbox"
                                            value="{{ $data['size_name6'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name7[]" class="grid_textbox"
                                            value="{{ $data['size_name7'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name8[]" class="grid_textbox"
                                            value="{{ $data['size_name8'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name9[]" class="grid_textbox"
                                            value="{{ $data['size_name9'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name10[]" class="grid_textbox"
                                            value="{{ $data['size_name10'] }}" readonly>
                                    </td>
                                </tr>
                                <input type="hidden" name="update_id[]" value="{{ $data['id'] }}" />
                            @endforeach
                        @else
                            @for ($i = 0; $i < count(old('update_size_pattern_code')); $i++)
                                <tr data-trv="{{ old('update_size_pattern_code')[$i] }}">
                                    <td rowspan="2" class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                            data-target="#modal_delete" data-value="{{ old('update_id')[$i] }}"
                                            class="display_none" name="delete"><img class="grid_img_center"
                                                src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                    <td rowspan="2" class="grid_col_2 col_rec"><input type="text"
                                            onblur="eventBlurCodeautoSizePattern(arguments[0], this)" placeholder=""
                                            name="update_size_pattern_code[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_size_pattern_code')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_size_code1"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="update_size_code1[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('update_size_code1')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_size_code2"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="update_size_code2[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('update_size_code2')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_size_code3"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="update_size_code3[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('update_size_code3')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_size_code4"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="update_size_code4[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('update_size_code4')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_size_code5"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="update_size_code5[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('update_size_code5')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_size_code6"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="update_size_code6[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('update_size_code6')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_size_code7"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="update_size_code7[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('update_size_code7')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_size_code8"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="update_size_code8[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('update_size_code8')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_size_code9"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="update_size_code9[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('update_size_code9')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_size_code10"
                                            onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"
                                            name="update_size_code10[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('update_size_code10')[$i] }}"></td>
                                </tr>
                                <tr data-trv="{{ old('update_size_pattern_code')[$i] }}">
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name1[]" class="grid_textbox"
                                            value="{{ old('update_size_name1')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name2[]" class="grid_textbox"
                                            value="{{ old('update_size_name2')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name3[]" class="grid_textbox"
                                            value="{{ old('update_size_name3')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name4[]" class="grid_textbox"
                                            value="{{ old('update_size_name4')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name5[]" class="grid_textbox"
                                            value="{{ old('update_size_name5')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name6[]" class="grid_textbox"
                                            value="{{ old('update_size_name6')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name7[]" class="grid_textbox"
                                            value="{{ old('update_size_name7')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name8[]" class="grid_textbox"
                                            value="{{ old('update_size_name8')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name9[]" class="grid_textbox"
                                            value="{{ old('update_size_name9')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_size_name10[]" class="grid_textbox"
                                            value="{{ old('update_size_name10')[$i] }}" readonly>
                                    </td>
                                </tr>
                                <input type="hidden" name="update_id[]"
                                    value="{{ old('update_size_pattern_code')[$i] }}" />
                            @endfor
                        @endempty
                    </tbody>
                </table>
            </div>
        </div>
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="update" name="update" class="display_none_all"></button>
        <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.master.search.size_pattern', ['sizePatternData' => $sizePatternData])
    @include('admin.master.search.size', ['colorData' => $sizeData])
    <script type="module" src="{{ asset('js/master/item/mt_size_pattern/index.js') }}"></script>
@endsection
