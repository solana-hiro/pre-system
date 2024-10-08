@extends('layouts.admin.app')
@section('page_title', 'カラーマスタ（一覧）')
@section('title', 'カラーマスタ（一覧）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <div class="main-area">
        <form role="search" action="{{ route('master.item.mt_color.update') }}" method="post">
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
                            <table class="grid_gray_table_100p" id="color_grid_table">
                                <thead class="grid_gray_header">
                                    <tr>
                                        <td class="grid_wrapper_center td_10p">カラーコード</td>
                                        <td class="grid_wrapper_center td_50p">カラー名</td>
                                        <td class="grid_wrapper_center td_20p">htmlカラー<br>コード</td>
                                        <td class="grid_wrapper_center td_20p">ソート順</td>
                                    </tr>
                                </thead>
                                <tbody class="grid_body">
                                    @empty(old('insert_color_code'))
                                        @for ($i = 0; $i < 2; $i++)
                                            <tr>
                                                <td class="grid_wrapper_left grid_textbox_10p"><input type="text"
                                                        placeholder="" id="color_code"
                                                        onblur="eventBlurCodeautoColor(arguments[0], this)"
                                                        name="insert_color_code[]" class="grid_textbox" minlength="0"
                                                        maxlength="5"></td>
                                                <td class="grid_wrapper_left grid_textbox_50p"><input type="text"
                                                        placeholder="" name="insert_color_name[]" class="grid_textbox"
                                                        minlength="0" maxlength="20"></td>
                                                <td class="grid_wrapper_left grid_textbox_20p"><input type="text"
                                                        placeholder="" name="insert_html_color_code[]" class="grid_textbox"
                                                        minlength="0" maxlength="7"></td>
                                                <td class="grid_wrapper_left grid_textbox_20p"><input type="text"
                                                        placeholder="" name="insert_sort_order[]" class="grid_textbox"
                                                        minlength="0" maxlength="3"></td>
                                            </tr>
                                        @endfor
                                    @else
                                        @for ($i = 0; $i < count(old('insert_color_code')); $i++)
                                            <tr>
                                                <td class="grid_wrapper_left grid_textbox_10p"><input type="text"
                                                        placeholder="" id="color_code" name="insert_color_code[]"
                                                        onblur="eventBlurCodeautoColor(arguments[0], this)"
                                                        value='{{ old("insert_color_code.{$i}") }}' class="grid_textbox"
                                                        minlength="0" maxlength="5"></td>
                                                <td class="grid_wrapper_left grid_textbox_50p"><input type="text"
                                                        placeholder="" name="insert_color_name[]"
                                                        value='{{ old("insert_color_name.{$i}") }}' class="grid_textbox"
                                                        minlength="0" maxlength="20"></td>
                                                <td class="grid_wrapper_left grid_textbox_20p"><input type="text"
                                                        placeholder="" name="insert_html_color_code[]"
                                                        value='{{ old("insert_html_color_code.{$i}") }}' class="grid_textbox"
                                                        minlength="0" maxlength="7"></td>
                                                <td class="grid_wrapper_left grid_textbox_20p"><input type="text"
                                                        placeholder="" name="insert_sort_order[]"
                                                        value='{{ old("insert_sort_order.{$i}") }}' class="grid_textbox"
                                                        minlength="0" maxlength="3"></td>
                                            </tr>
                                        @endfor
                                    @endempty
                                </tbody>
                            </table>
                            <div class="plus_rec">
                                <div class="blue_text_wrapper" id="add_line" onclick="colorAddLine()">+ 行を追加する</div>
                            </div>
                        </div>
                    </div>
                    <div class="left_contents">
                        <div class="element-form">
                            <div class="text_wrapper">カラーコード</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" id="input_color" name="name" class="element"
                                        onblur="eventBlurSearchColor(arguments[0], this)" minlength="0" maxlength="5"
                                        size="5" />
                                    <img class="vector" id="img_color" src="/img/icon/vector.svg"
                                        data-smm-open="search_color_modal" />
                                </div>
                                <div class="textbox">
                                    <a href="https://www.colordic.org" target="_blank" rel="noopener noreferrer"
                                    ><span class="page-button-label">HTMLカラーコード参照サイト</span>
                                </a>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="hidden_color" value="" name="hidden_color" />
                        <div class="grid">
                            <table class="table_sticky" id="grid_table_1">
                                <thead class="grid_header">
                                    <tr>
                                        <td class="grid_wrapper_center td_5p">削除</td>
                                        <td class="grid_wrapper_center td_15p">カラー<br>コード</td>
                                        <td class="grid_wrapper_center td_25p">カラー名</td>
                                        <td class="grid_wrapper_center td_15p">htmlカラー<br>コード</td>
                                        <td class="grid_wrapper_center td_15p">ソート順</td>
                                    </tr>
                                </thead>
                                <tbody class="tbody_scroll">
                                    @php $i=0; @endphp
                                    @foreach ($initData as $data)
                                        @empty(old('update_color_code'))
                                            <tr>
                                                <td class="grid_col_1 col_rec col_rec"><button type="button"
                                                        data-toggle="modal" data-target="#modal_delete"
                                                        data-value="{{ $data['id'] }}" class="display_none"
                                                        name="delete"><img class="grid_img_center"
                                                            src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                                <td class="grid_col_6 col_rec col_rec"><input type="text"
                                                        name="update_color_code[]" id="color_code"
                                                        onblur="eventBlurCodeautoColor(arguments[0], this)"
                                                        id="input_update_color_{{ $data['id'] }}" placeholder=""
                                                        class="grid_textbox grid_textbox_70p" minlength="0" maxlength="5"
                                                        value="{{ $data['color_cd'] }}" readonly></td>
                                                <td class="grid_col_2 col_rec"><input type="text"
                                                        name="update_color_name[]"
                                                        id="names_update_color_{{ $data['id'] }}" placeholder=""
                                                        class="grid_textbox" minlength="0" maxlength="10" size="10"
                                                        value="{{ $data['color_name'] }}"></td>
                                                <td class="grid_col_2 col_rec"><input type="text"
                                                        name="update_html_color_code[]" placeholder="" class="grid_textbox"
                                                        minlength="0" maxlength="7" value="{{ $data['html_color_cd'] }}">
                                                </td>
                                                <td class="grid_col_1 col_rec"><input type="text"
                                                        name="update_sort_order[]" placeholder="" class="grid_textbox"
                                                        minlength="0" maxlength="3" value="{{ $data['sort_order'] }}">
                                                </td>
                                                <input type="hidden" name="update_id[]" value="{{ $data['id'] }}" />
                                                <input type="hidden" id="hidden_update_color_{{ $data['id'] }}"
                                                    value="" name="hidden_color_{{ $data['id'] }}" />
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="grid_col_1 col_rec col_rec"><button type="button"
                                                        data-toggle="modal" data-target="#modal_delete"
                                                        data-value="{{ $data['id'] }}" class="display_none"
                                                        name="delete"><img class="grid_img_center"
                                                            src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                                <td class="grid_col_6 col_rec col_rec"><input type="text"
                                                        name="update_color_code[]" id="color_code"
                                                        onblur="eventBlurCodeautoColor(arguments[0], this)"
                                                        id="input_update_color_{{ $data['id'] }}" placeholder=""
                                                        class="grid_textbox grid_textbox_70p" minlength="0" maxlength="5"
                                                        value="{{ old("update_color_code.{$i}", $data['color_cd']) }}" readonly></td>
                                                <td class="grid_col_2 col_rec"><input type="text"
                                                        name="update_color_name[]"
                                                        id="names_update_color_{{ $data['id'] }}" placeholder=""
                                                        class="grid_textbox" minlength="0" maxlength="10" size="10"
                                                        value="{{ old("update_color_name.{$i}", $data['color_name']) }}"></td>
                                                <td class="grid_col_2 col_rec"><input type="text"
                                                        name="update_html_color_code[]" placeholder="" class="grid_textbox"
                                                        minlength="0" maxlength="7"
                                                        value="{{ old("update_html_color_code.{$i}", $data['html_color_cd']) }}">
                                                </td>
                                                <td class="grid_col_2 col_rec"><input type="text"
                                                        name="update_sort_order[]" placeholder="" class="grid_textbox"
                                                        minlength="0" maxlength="3"
                                                        value="{{ old("update_sort_order.{$i}", $data['sort_order']) }}"></td>
                                                <input type="hidden" name="update_id[]" value="{{ $data['id'] }}" />
                                                <input type="hidden" id="hidden_update_color_{{ $data['id'] }}"
                                                    value="" name="hidden_color_{{ $data['id'] }}" />
                                            </tr>
                                            @php $i++; @endphp
                                        @endempty
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
        @include('admin.master.search.color', ['colorData' => $colorData])
    </div>
    <script src="{{ asset('js/master/item/mt_color/index.js') }}"></script>
@endsection
