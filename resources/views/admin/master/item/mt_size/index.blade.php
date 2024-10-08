@extends('layouts.admin.app')
@section('page_title', 'サイズマスタ（一覧）')
@section('title', 'サイズマスタ（一覧）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <div class="main-area">
        <form role="search" action="{{ route('master.item.mt_size.update') }}" method="post">
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
                            <table class="grid_gray_table_100p" id="size_grid_table">
                                <thead class="grid_gray_header">
                                    <tr>
                                        <td class="grid_wrapper_center td_10p">サイズコード</td>
                                        <td class="grid_wrapper_center td_50p">サイズ名</td>
                                        <td class="grid_wrapper_center td_20p">ソート順</td>
                                    </tr>
                                </thead>
                                <tbody class="grid_body">
                                    @empty(old('insert_size_code'))
                                        @for ($i = 0; $i < 2; $i++)
                                            <tr>
                                                <td class="grid_wrapper_left grid_textbox_10p"><input type="text"
                                                        placeholder="" id="size_code"
                                                        onblur="eventBlurCodeautoSize(arguments[0], this)"
                                                        name="insert_size_code[]" class="grid_textbox" minlength="0"
                                                        maxlength="5"></td>
                                                <td class="grid_wrapper_left grid_textbox_50p"><input type="text"
                                                        placeholder="" name="insert_size_name[]" class="grid_textbox"
                                                        minlength="0" maxlength="20"></td>
                                                <td class="grid_wrapper_left grid_textbox_20p"><input type="text"
                                                        placeholder="" name="insert_sort_order[]" class="grid_textbox"
                                                        minlength="0" maxlength="3"></td>
                                            </tr>
                                        @endfor
                                    @else
                                        @for ($i = 0; $i < count(old('insert_size_code')); $i++)
                                            <tr>
                                                <td class="grid_wrapper_left grid_textbox_10p"><input type="text"
                                                        placeholder="" id="size_code"
                                                        onblur="eventBlurCodeautoSize(arguments[0], this)"
                                                        name="insert_size_code[]" value='{{ old("insert_size_code.{$i}") }}'
                                                        class="grid_textbox" minlength="0" maxlength="5"></td>
                                                <td class="grid_wrapper_left grid_textbox_50p"><input type="text"
                                                        placeholder="" name="insert_size_name[]"
                                                        value='{{ old("insert_size_name.{$i}") }}' class="grid_textbox"
                                                        minlength="0" maxlength="20"></td>
                                                <td class="grid_wrapper_left grid_textbox_20p"><input type="text"
                                                        placeholder="" name="insert_sort_order[]"
                                                        value='{{ old("insert_sort_order.{$i}") }}'class="grid_textbox"
                                                        minlength="0" maxlength="3"></td>
                                            </tr>
                                        @endfor

                                    @endempty
                                </tbody>
                            </table>
                            <div class="plus_rec">
                                <div class="blue_text_wrapper" id="add_line" onclick="sizeAddLine()">+ 行を追加する</div>
                            </div>
                        </div>
                    </div>
                    <div class="left_contents">
                        <div class="element-form">
                            <div class="text_wrapper">サイズコード</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" id="input_size" name="name" class="element"
                                        onblur="eventBlurSearchSize(arguments[0], this)" minlength="0" maxlength="5"
                                        size="5" />
                                    <img class="vector" id="img_size" src="/img/icon/vector.svg"
                                        data-smm-open="search_size_modal" />
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="hidden_size" value="" name="hidden_size" />
                        <div class="grid">
                            <table class="table_sticky" id="grid_table_1">
                                <thead class="grid_header">
                                    <tr>
                                        <td class="grid_wrapper_center td_5p">削除</td>
                                        <td class="grid_wrapper_center td_25p">サイズコード</td>
                                        <td class="grid_wrapper_center td_40p">サイズ名</td>
                                        <td class="grid_wrapper_center td_15p">ソート順</td>
                                    </tr>
                                </thead>
                                <tbody class="tbody_scroll">
                                    @php $i=0; @endphp
                                    @foreach ($initData as $data)
                                        @empty(old('update_size_code'))
                                            <tr>
                                            <td class="grid_col_1 col_rec col_rec"><button type="button" data-toggle="modal"
                                                    data-target="#modal_delete" data-value="{{ $data['id'] }}"
                                                    class="display_none" name="delete"><img class="grid_img_center"
                                                        src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                            <td class="grid_col_6 col_rec col_rec"><input type="text"
                                                    name="update_size_code[]" id="input_update_size_{{ $data['id'] }}"
                                                    placeholder="" class="grid_textbox grid_textbox_70p" minlength="0"
                                                    maxlength="5" value="{{ $data['size_cd'] }}" readonly></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_size_name[]"
                                                    id="names_update_size_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox" minlength="0" maxlength="10" size="10"
                                                    value="{{ $data['size_name'] }}"></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_sort_order[]"
                                                    placeholder="" class="grid_textbox" minlength="0" maxlength="3"
                                                    value="{{ $data['sort_order'] }}"></td>
                                            <input type="hidden" name="update_id[]" value="{{ $data['id'] }}" />
                                            <input type="hidden" id="hidden_update_size_{{ $data['id'] }}" value=""
                                                name="hidden_size_{{ $data['id'] }}" />
                                            </tr>
                                        @else
                                            <tr>
                                            <td class="grid_col_1 col_rec col_rec"><button type="button" data-toggle="modal"
                                                    data-target="#modal_delete" data-value="{{ $data['id'] }}"
                                                    class="display_none" name="delete"><img class="grid_img_center"
                                                        src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                            <td class="grid_col_6 col_rec col_rec"><input type="text"
                                                    name="update_size_code[]" id="input_update_size_{{ $data['id'] }}"
                                                    placeholder="" class="grid_textbox grid_textbox_70p" minlength="0"
                                                    maxlength="5"
                                                    value="{{ old("update_size_code.{$i}", $data['size_cd']) }}" readonly></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_size_name[]"
                                                    id="names_update_size_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox" minlength="0" maxlength="10" size="10"
                                                    value="{{ old("update_size_name.{$i}", $data['size_name']) }}"></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_sort_order[]"
                                                    placeholder="" class="grid_textbox" minlength="0" maxlength="3"
                                                    value="{{ old("update_sort_order.{$i}", $data['sort_order']) }}"></td>
                                            <input type="hidden" name="update_id[]" value="{{ $data['id'] }}" />
                                            <input type="hidden" id="hidden_update_size_{{ $data['id'] }}" value=""
                                                name="hidden_size_{{ $data['id'] }}" />
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
        @include('admin.master.search.size', ['sizeData' => $sizeData])
    </div>
    <script src="{{ asset('js/master/item/mt_size/index.js') }}"></script>
@endsection
