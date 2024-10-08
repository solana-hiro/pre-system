@extends('layouts.admin.app')
@section('page_title', 'ルートマスタ')
@section('title', 'ルートマスタ')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('master.other.mt_root.update') }}" method="post">
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
                        <table class="grid_gray_table_100p" id="root_grid_table">
                            <thead class="grid_gray_header">
                                <tr>
                                    <td class="grid_wrapper_center td_10p">ルートコード</td>
                                    <td class="grid_wrapper_center td_50p">ルート名</td>
                                    <td class="grid_wrapper_center td_20p">ソート順</td>
                                </tr>
                            </thead>
                            <tbody class="grid_body">
                                @empty(old('insert_root_code'))
                                    @for ($i = 0; $i < 2; $i++)
                                        <tr>
                                            <td class="grid_wrapper_left grid_textbox_10p input_number_4"><input type="number" placeholder=""
                                                    onblur="eventBlurCodeautoRoot(arguments[0], this)" id="insert_root_code"
                                                    name="insert_root_code[]" class="grid_textbox" data-limit-len="4" data-limit-minus ></td>
                                            <td class="grid_wrapper_left grid_textbox_50p"><input type="text" placeholder=""
                                                    name="insert_root_name[]" class="grid_textbox" minlength="0"
                                                    maxlength="20"></td>
                                            <td class="grid_wrapper_left grid_textbox_20p"><input type="number" placeholder=""
                                                    name="insert_sort[]" class="grid_textbox input_number_3" data-limit-len="3"
                                                    data-limit-minus>
                                            </td>
                                        </tr>
                                    @endfor
                                @else
                                    @for ($i = 0; $i < count(old('insert_root_code')); $i++)
                                        <tr>
                                            <td class="grid_wrapper_left grid_textbox_10p input_number_4"><input type="number" placeholder=""
                                                    onblur="eventBlurCodeautoRoot(arguments[0], this)" id="insert_root_code"
                                                    value='{{ old("insert_root_code.{$i}") }}' name="insert_root_code[]"
                                                    class="grid_textbox" data-limit-len="4" data-limit-minus></td>
                                            <td class="grid_wrapper_left grid_textbox_50p"><input type="text" placeholder=""
                                                    name="insert_root_name[]" value='{{ old("insert_root_name.{$i}") }}'
                                                    class="grid_textbox" minlength="0" maxlength="20"></td>
                                            <td class="grid_wrapper_left grid_textbox_20p"><input type="number" placeholder=""
                                                    name="insert_sort[]" value='{{ old("insert_sort.{$i}") }}'
                                                    class="grid_textbox input_number_3" data-limit-len="3"
                                                    data-limit-minus></td>
                                        </tr>
                                    @endfor
                                @endempty
                            </tbody>
                        </table>
                        <div class="plus_rec">
                            <div class="blue_text_wrapper" id="add_line" onclick="rootAddLine()">+ 行を追加する</div>
                        </div>
                    </div>
                </div>
                <div class="left_contents">
                    <div class="element-form">
                        <div class="text_wrapper">ルートコード</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="number" id="input_root" name="name" class="element input_number_4" 
                                data-limit-len="4" data-limit-minus onblur="eventBlurSearchRoot(arguments[0], this)" />
                                <img class="vector" id="img_root" src="/img/icon/vector.svg"
                                    data-smm-open="search_root_modal" />
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="hidden_root" value="" name="hidden_root" />
                    <div class="grid">
                        <table class="table_sticky" id="grid_table_1">
                            <thead class="grid_header">
                                <tr>
                                    <td class="grid_wrapper_center td_5p">削除</td>
                                    <td class="grid_wrapper_center td_20p">ルートコード</td>
                                    <td class="grid_wrapper_center td_60p">ルート名</td>
                                    <td class="grid_wrapper_center td_15p">ソート順</td>
                                </tr>
                            </thead>
                            <tbody class="tbody_scroll">
                                @php $i=0; @endphp
                                @foreach ($initData as $data)
                                    @empty(old('update_root_code'))
                                        <tr>
                                            <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                                    data-target="#modal_delete" data-value="{{ $data['id'] }}"
                                                    class="display_none" name="delete"><img class="grid_img_center"
                                                        src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                            <td class="grid_col_6 col_rec"><input type="text" name="update_root_code[]"
                                                    onblur="eventBlurCodeautoRoot(arguments[0], this)"
                                                    id="input_update_root_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox grid_textbox_70p" minlength="0" maxlength="4"
                                                    value="{{ $data['root_cd'] }}" readonly></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_root_name[]"
                                                    id="names_update_root_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox" minlength="0" maxlength="20" size="20"
                                                    value="{{ $data['root_name'] }}"></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_sort[]"
                                                    placeholder="" class="grid_textbox" minlength="0" maxlength="3"
                                                    value="{{ $data['sort'] }}"></td>
                                            <input type="hidden" name="update_id[]" value="{{ $data['id'] }}" />
                                            <input type="hidden" id="hidden_update_root_{{ $data['id'] }}" value=""
                                                name="hidden_root_{{ $data['id'] }}" />
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                                    data-target="#modal_delete" data-value="{{ $data['id'] }}"
                                                    class="display_none" name="delete"><img class="grid_img_center"
                                                        src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                            <td class="grid_col_6 col_rec"><input type="text" name="update_root_code[]"
                                                    onblur="eventBlurCodeautoRoot(arguments[0], this)"
                                                    id="input_update_root_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox grid_textbox_70p" minlength="0" maxlength="4"
                                                    value="{{ old("update_root_code.{$i}", $data['root_cd']) }}" readonly></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_root_name[]"
                                                    id="names_update_root_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox" minlength="0" maxlength="20" size="20"
                                                    value="{{ old("update_root_name.{$i}", $data['root_name']) }}"></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_sort[]"
                                                    placeholder="" class="grid_textbox" minlength="0" maxlength="3"
                                                    value="{{ old("update_sort.{$i}", $data['sort']) }}"></td>
                                            <input type="hidden" name="update_id[]" value="{{ $data['id'] }}" />
                                            <input type="hidden" id="hidden_update_root_{{ $data['id'] }}" value=""
                                                name="hidden_root_{{ $data['id'] }}" />
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
    @include('admin.master.search.root', ['rootData' => $rootData])
    <script src="{{ asset('js/master/other/mt_root/index.js') }}"></script>
@endsection
