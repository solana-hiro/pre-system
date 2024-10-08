@extends('layouts.admin.app')
@section('page_title', 'カラーパターンマスタ（一覧）')
@section('title', 'カラーパターンマスタ（一覧）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('master.item.mt_color_pattern.update') }}" method="post">
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
                <table class="grid_gray_pattern_table" id="color_pattern_grid_table">
                    <thead class="grid_header">
                        <tr>
                            <td rowspan="2" class="grid_wrapper_center td01">カラー<br>パターン<br>コード</td>
                            <td class="grid_wrapper_center td02">カラーコード1</td>
                            <td class="grid_wrapper_center td02">カラーコード2</td>
                            <td class="grid_wrapper_center td02">カラーコード3</td>
                            <td class="grid_wrapper_center td02">カラーコード4</td>
                            <td class="grid_wrapper_center td02">カラーコード5</td>
                            <td class="grid_wrapper_center td02">カラーコード6</td>
                            <td class="grid_wrapper_center td02">カラーコード7</td>
                            <td class="grid_wrapper_center td02">カラーコード8</td>
                            <td class="grid_wrapper_center td02">カラーコード9</td>
                            <td class="grid_wrapper_center td02">カラーコード10</td>
                            <td class="grid_wrapper_center td02">カラーコード11</td>
                            <td class="grid_wrapper_center td02">カラーコード12</td>
                            <td class="grid_wrapper_center td02">カラーコード13</td>
                            <td class="grid_wrapper_center td02">カラーコード14</td>
                            <td class="grid_wrapper_center td02">カラーコード15</td>
                            <td class="grid_wrapper_center td02">カラーコード16</td>
                            <td class="grid_wrapper_center td02">カラーコード17</td>
                            <td class="grid_wrapper_center td02">カラーコード18</td>
                            <td class="grid_wrapper_center td02">カラーコード19</td>
                            <td class="grid_wrapper_center td02">カラーコード20</td>
                        </tr>
                        <tr>
                            <td class="grid_wrapper_center td02">カラー名1</td>
                            <td class="grid_wrapper_center td02">カラー名2</td>
                            <td class="grid_wrapper_center td02">カラー名3</td>
                            <td class="grid_wrapper_center td02">カラー名4</td>
                            <td class="grid_wrapper_center td02">カラー名5</td>
                            <td class="grid_wrapper_center td02">カラー名6</td>
                            <td class="grid_wrapper_center td02">カラー名7</td>
                            <td class="grid_wrapper_center td02">カラー名8</td>
                            <td class="grid_wrapper_center td02">カラー名9</td>
                            <td class="grid_wrapper_center td02">カラー名10</td>
                            <td class="grid_wrapper_center td02">カラー名11</td>
                            <td class="grid_wrapper_center td02">カラー名12</td>
                            <td class="grid_wrapper_center td02">カラー名13</td>
                            <td class="grid_wrapper_center td02">カラー名14</td>
                            <td class="grid_wrapper_center td02">カラー名15</td>
                            <td class="grid_wrapper_center td02">カラー名16</td>
                            <td class="grid_wrapper_center td02">カラー名17</td>
                            <td class="grid_wrapper_center td02">カラー名18</td>
                            <td class="grid_wrapper_center td02">カラー名19</td>
                            <td class="grid_wrapper_center td02">カラー名20</td>
                        </tr>
                    </thead>
                    <tbody class="grid_body">
                        @empty(old('insert_color_pattern_code'))
                            @for ($i = 0; $i < 2; $i++)
                                <tr>
                                    <td rowspan="2" class="grid_col_1"><input type="number" placeholder=""
                                            id="color_pattern_code input_number_4" onblur="eventBlurCodeautoColorPattern(arguments[0], this)"
                                            name="insert_color_pattern_code[]" class="grid_textbox" data-limit-len="4" data-limit-minus></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code1{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code1[]" class="grid_textbox" minlength="0" maxlength="5"><img
                                            class="vector" id="img_color_code1{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code2{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code2[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code2{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code3{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code3[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code3{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code4{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code4[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code4{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code5{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code5[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code5{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code6{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code6[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code6{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code7{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code7[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code7{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code8{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code8[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code8{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code9{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code9[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code9{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code10{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code10[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code10{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code11{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code11[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code11{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code12{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code12[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code12{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code13{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code13[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code13{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code14{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code14[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code14{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code15{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code15[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code15{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code16{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"name="insert_color_code16[]"
                                            class="grid_textbox" minlength="0" maxlength="5"><img class="vector"
                                            id="img_color_code16{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code17{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code17[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code17{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code18{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code18[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code18{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code19{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code19[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code19{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="input_color_code20{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code20[]" class="grid_textbox" minlength="0"
                                            maxlength="5"><img class="vector" id="img_color_code20{{ $i }}"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_modal" /></div></td>
                                </tr>
                                <tr>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name1[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name2[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name3[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name4[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name5[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name6[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name7[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name8[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name9[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name10[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name11[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name12[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name13[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name14[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name15[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name16[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name17[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name18[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name19[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name20[]" class="grid_textbox txt_blue" readonly>
                                    </td>
                                </tr>
                            @endfor
                        @else
                            @for ($i = 0; $i < count(old('insert_color_pattern_code')); $i++)
                                <tr>
                                    <td rowspan="2" class="grid_col_1"><input type="text" placeholder=""
                                            id="color_pattern_code" onblur="eventBlurCodeautoColorPattern(arguments[0], this)"
                                            name="insert_color_pattern_code[]" class="grid_textbox" minlength="0"
                                            maxlength="4" value="{{ old('insert_color_pattern_code')[$i] }}"></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code1{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code1[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code1')[$i] }}"><img class="vector"
                                            id="img_color_code1{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code2{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code2[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code2')[$i] }}"><img class="vector"
                                            id="img_color_code2{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code3{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code3[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code3')[$i] }}"><img class="vector"
                                            id="img_color_code3{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code4{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code4[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code4')[$i] }}"><img class="vector"
                                            id="img_color_code4{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code5{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code5[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code5')[$i] }}"><img class="vector"
                                            id="img_color_code5{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code6{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code6[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code6')[$i] }}"><img class="vector"
                                            id="img_color_code6{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code7{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code7[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code7')[$i] }}"><img class="vector"
                                            id="img_color_code7{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code8{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code8[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code8')[$i] }}"><img class="vector"
                                            id="img_color_code8{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code9{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code9[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code9')[$i] }}"><img class="vector"
                                            id="img_color_code9{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code10{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code10[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code10')[$i] }}"><img class="vector"
                                            id="img_color_code10{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code11{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code11[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code11')[$i] }}"><img class="vector"
                                            id="img_color_code11{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code12{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code12[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code12')[$i] }}"><img class="vector"
                                            id="img_color_code12{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code13{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code13[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code13')[$i] }}"><img class="vector"
                                            id="img_color_code13{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code14{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code14[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code14')[$i] }}"><img class="vector"
                                            id="img_color_code14{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code15{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code15[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code15')[$i] }}"><img class="vector"
                                            id="img_color_code15{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code16{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code16[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code16')[$i] }}"><img class="vector"
                                            id="img_color_code16{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code17{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code17[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code17')[$i] }}"><img class="vector"
                                            id="img_color_code17{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code18{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code18[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code18')[$i] }}"><img class="vector"
                                            id="img_color_code18{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code19{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code19[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code19')[$i] }}"><img class="vector"
                                            id="img_color_code19{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                    <td class="grid_col_1"><div class="flex"><input type="text" placeholder=""
                                            id="color_code20{{ $i }}"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="insert_color_code20[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ old('insert_color_code20')[$i] }}"><img class="vector"
                                            id="img_color_code20{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" /></div></td>
                                </tr>
                                <tr>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name1[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name1')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name2[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name2')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name3[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name3')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name4[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name4')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name5[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name5')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name6[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name6')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name7[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name7')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name8[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name8')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name9[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name9')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name10[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name10')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name11[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name11')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name12[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name12')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name13[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name13')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name14[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name14')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name15[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name15')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name16[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name16')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name17[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name17')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name18[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name18')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name19[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name19')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_1">
                                        <input name="insert_color_name20[]" class="grid_textbox txt_blue"
                                            value="{{ old('insert_color_name20')[$i] }}" readonly>
                                    </td>
                                </tr>
                            @endfor
                        @endempty
                    </tbody>
                </table>
            </div>

            <div class="plus_rec">
                <div class="blue_text_wrapper" id="add_line" onclick="colorPatternAddLine()">+ 行を追加する</div>
            </div>

            <div class="element-form element-form-single">
                <div class="text_wrapper">カラーパターンコード</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="number" name="color_pattern_cd" id="input_color_pattern" class="element input_number_4"
                            data-limit-len="4" data-limit-minus data-ft="filter-table" data-pad-len="4" />
                        <img class="vector" id="img_color_pattern" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_color_pattern_modal" />
                    </div>
                </div>
                <input type="hidden" id="hidden_color_pattern" value="" name="hidden_color_pattern" />
            </div>

            <div class="grid">
                <table class="grid_table" id="filter-table">
                    <thead class="grid_header">
                        <tr>
                            <td rowspan="2" class="grid_wrapper_center col1">削除</td>
                            <td rowspan="2" class="grid_wrapper_center col2">カラー<br>パターン<br>コード</td>
                            <td class="grid_wrapper_center col11">カラーコード1</td>
                            <td class="grid_wrapper_center col11">カラーコード2</td>
                            <td class="grid_wrapper_center col11">カラーコード3</td>
                            <td class="grid_wrapper_center col11">カラーコード4</td>
                            <td class="grid_wrapper_center col11">カラーコード5</td>
                            <td class="grid_wrapper_center col11">カラーコード6</td>
                            <td class="grid_wrapper_center col11">カラーコード7</td>
                            <td class="grid_wrapper_center col11">カラーコード8</td>
                            <td class="grid_wrapper_center col11">カラーコード9</td>
                            <td class="grid_wrapper_center col11">カラーコード10</td>
                            <td class="grid_wrapper_center col11">カラーコード11</td>
                            <td class="grid_wrapper_center col11">カラーコード12</td>
                            <td class="grid_wrapper_center col11">カラーコード13</td>
                            <td class="grid_wrapper_center col11">カラーコード14</td>
                            <td class="grid_wrapper_center col11">カラーコード15</td>
                            <td class="grid_wrapper_center col11">カラーコード16</td>
                            <td class="grid_wrapper_center col11">カラーコード17</td>
                            <td class="grid_wrapper_center col11">カラーコード18</td>
                            <td class="grid_wrapper_center col11">カラーコード19</td>
                            <td class="grid_wrapper_center col11">カラーコード20</td>
                        </tr>
                        <tr>
                            <td class="grid_wrapper_center col11">カラー名1</td>
                            <td class="grid_wrapper_center col11">カラー名2</td>
                            <td class="grid_wrapper_center col11">カラー名3</td>
                            <td class="grid_wrapper_center col11">カラー名4</td>
                            <td class="grid_wrapper_center col11">カラー名5</td>
                            <td class="grid_wrapper_center col11">カラー名6</td>
                            <td class="grid_wrapper_center col11">カラー名7</td>
                            <td class="grid_wrapper_center col11">カラー名8</td>
                            <td class="grid_wrapper_center col11">カラー名9</td>
                            <td class="grid_wrapper_center col11">カラー名10</td>
                            <td class="grid_wrapper_center col11">カラー名11</td>
                            <td class="grid_wrapper_center col11">カラー名12</td>
                            <td class="grid_wrapper_center col11">カラー名13</td>
                            <td class="grid_wrapper_center col11">カラー名14</td>
                            <td class="grid_wrapper_center col11">カラー名15</td>
                            <td class="grid_wrapper_center col11">カラー名16</td>
                            <td class="grid_wrapper_center col11">カラー名17</td>
                            <td class="grid_wrapper_center col11">カラー名18</td>
                            <td class="grid_wrapper_center col11">カラー名19</td>
                            <td class="grid_wrapper_center col11">カラー名20</td>
                        </tr>
                    </thead>
                    <tbody class="grid_body">
                        @empty(old('update_color_pattern_code'))
                            @foreach ($initData as $data)
                                <tr data-trv="{{ $data['color_pattern_cd'] }}">
                                    <td rowspan="2" class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                            data-target="#modal_delete" data-value="{{ $data['id'] }}"
                                            class="display_none" name="delete"><img class="grid_img_center"
                                                src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                    <td rowspan="2" class="grid_col_2 col_rec"><input type="text"
                                            onblur="eventBlurCodeautoColorPattern(arguments[0], this)" placeholder=""
                                            name="update_color_pattern_code[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ $data['color_pattern_cd'] }}" readonly></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code1"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code1[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['color_cd1'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code2"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code2[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['color_cd2'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code3"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code3[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['color_cd3'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code4"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code4[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['color_cd4'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code5"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code5[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['color_cd5'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code6"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code6[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['color_cd6'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code7"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code7[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['color_cd7'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code8"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code8[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['color_cd8'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code9"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code9[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['color_cd9'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code10"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code10[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['color_cd10'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code11"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code11[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['color_cd11'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code12"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code12[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['color_cd12'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code13"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code13[]" class="grid_textbox" minlength="0" maxlength="5"
                                            value="{{ $data['color_cd13'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code14"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code14[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ $data['color_cd14'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code15"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code15[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ $data['color_cd15'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code16"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code16[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ $data['color_cd16'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code17"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code17[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ $data['color_cd17'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code18"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code18[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ $data['color_cd18'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code19"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code19[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ $data['color_cd19'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" id="update_color_code20"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)" placeholder=""
                                            name="update_color_code20[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ $data['color_cd20'] }}"></td>
                                </tr>
                                <tr data-trv="{{ $data['color_pattern_cd'] }}">
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name1[]" class="grid_textbox"
                                            value="{{ $data['color_name1'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name2[]" class="grid_textbox"
                                            value="{{ $data['color_name2'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name3[]" class="grid_textbox"
                                            value="{{ $data['color_name3'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name4[]" class="grid_textbox"
                                            value="{{ $data['color_name4'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name5[]" class="grid_textbox"
                                            value="{{ $data['color_name5'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name6[]" class="grid_textbox"
                                            value="{{ $data['color_name6'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name7[]" class="grid_textbox"
                                            value="{{ $data['color_name7'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name8[]" class="grid_textbox"
                                            value="{{ $data['color_name8'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name9[]" class="grid_textbox"
                                            value="{{ $data['color_name9'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name10[]" class="grid_textbox"
                                            value="{{ $data['color_name10'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name11[]" class="grid_textbox"
                                            value="{{ $data['color_name11'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name12[]" class="grid_textbox"
                                            value="{{ $data['color_name12'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name13[]" class="grid_textbox"
                                            value="{{ $data['color_name13'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name14[]" class="grid_textbox"
                                            value="{{ $data['color_name14'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name15[]" class="grid_textbox"
                                            value="{{ $data['color_name15'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name16[]" class="grid_textbox"
                                            value="{{ $data['color_name16'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name17[]" class="grid_textbox"
                                            value="{{ $data['color_name17'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name18[]" class="grid_textbox"
                                            value="{{ $data['color_name18'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name19[]" class="grid_textbox"
                                            value="{{ $data['color_name19'] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name20[]" class="grid_textbox"
                                            value="{{ $data['color_name20'] }}" readonly>
                                    </td>
                                </tr>
                                <input type="hidden" name="update_id[]" value="{{ $data['id'] }}" />
                            @endforeach
                        @else
                            @for ($i = 0; $i < count(old('update_color_pattern_code')); $i++)
                                <tr data-trv="{{ old('update_color_pattern_code')[$i] }}">
                                    <td rowspan="2" class="grid_col_1 col_rec"><button type="button"
                                            data-toggle="modal" data-target="#modal_delete"
                                            data-value="{{ old('update_id')[$i] }}" class="display_none"
                                            name="delete"><img class="grid_img_center"
                                                src="{{ asset('/img/icon/trash.svg') }}"></button>
                                    </td>
                                    <td rowspan="2" class="grid_col_2 col_rec"><input type="text"
                                            onblur="eventBlurCodeautoColorPattern(arguments[0], this)" placeholder=""
                                            name="update_color_pattern_code[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_pattern_code')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code1"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code1[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code1')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code2"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code2[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code2')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code3"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code3[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code3')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code4"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code4[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code4')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code5"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code5[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code5')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code6"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code6[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code6')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code7"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code7[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code7')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code8"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code8[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code8')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code9"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code9[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code9')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code10"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code10[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code10')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code11"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code11[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code11')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code12"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code12[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code12')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code13"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code13[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code13')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code14"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code14[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code14')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code15"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code15[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code15')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code16"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code16[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code16')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code17"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code17[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code17')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code18"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code18[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code18')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code19"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code19[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code19')[$i] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                            id="update_color_code20"
                                            onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"
                                            name="update_color_code20[]" class="grid_textbox" minlength="0"
                                            maxlength="5" value="{{ old('update_color_code20')[$i] }}"></td>
                                </tr>
                                <tr data-trv="{{ old('update_color_pattern_code')[$i] }}">
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name1[]" class="grid_textbox"
                                            value="{{ old('update_color_name1')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name2[]" class="grid_textbox"
                                            value="{{ old('update_color_name2')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name3[]" class="grid_textbox"
                                            value="{{ old('update_color_name3')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name4[]" class="grid_textbox"
                                            value="{{ old('update_color_name4')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name5[]" class="grid_textbox"
                                            value="{{ old('update_color_name5')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name6[]" class="grid_textbox"
                                            value="{{ old('update_color_name6')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name7[]" class="grid_textbox"
                                            value="{{ old('update_color_name7')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name8[]" class="grid_textbox"
                                            value="{{ old('update_color_name8')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name9[]" class="grid_textbox"
                                            value="{{ old('update_color_name9')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name10[]" class="grid_textbox"
                                            value="{{ old('update_color_name10')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name11[]" class="grid_textbox"
                                            value="{{ old('update_color_name11')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name12[]" class="grid_textbox"
                                            value="{{ old('update_color_name12')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name13[]" class="grid_textbox"
                                            value="{{ old('update_color_name13')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name14[]" class="grid_textbox"
                                            value="{{ old('update_color_name14')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name15[]" class="grid_textbox"
                                            value="{{ old('update_color_name15')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name16[]" class="grid_textbox"
                                            value="{{ old('update_color_name16')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name17[]" class="grid_textbox"
                                            value="{{ old('update_color_name17')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name18[]" class="grid_textbox"
                                            value="{{ old('update_color_name18')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name19[]" class="grid_textbox"
                                            value="{{ old('update_color_name19')[$i] }}" readonly>
                                    </td>
                                    <td class="grid_col_2 col_rec">
                                        <input name="update_color_name20[]" class="grid_textbox"
                                            value="{{ old('update_color_name20')[$i] }}" readonly>
                                    </td>
                                </tr>
                                <input type="hidden" name="update_id[]"
                                    value="{{ old('update_color_pattern_code')[$i] }}" />
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
    @include('admin.master.search.color_pattern', ['colorPatternData' => $colorPatternData])
    @include('admin.master.search.color', ['colorData' => $colorData])
    <script type="module" src="{{ asset('js/master/item/mt_color_pattern/index.js') }}"></script>
@endsection
