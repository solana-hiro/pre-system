@extends('layouts.admin.app')
@section('page_title', '商品分類入力（一覧）')
@section('title', '商品分類入力（一覧）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('master.item.mt_item_class.update') }}" method="post" name="mtItemClassListForm">
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
            <div class="box">
                <div class="group">
                    <div class="element">
                        <div class="text_wrapper">対象商品分類</div>
                        <div class="frame">
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_1" name="item_class"
                                        onclick="itemClassMstClick()" value="1" checked
                                        @if (old('item_class') === '1' || empty(old('item_class'))) checked @endif />
                                    ブランド1
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_2" name="item_class"
                                        onclick="itemClassMstClick()" value="2"
                                        @if (old('item_class') === '2' || (empty(old('item_class')) && isset($itemClassId) && $itemClassId === '2')) checked @endif />
                                    競技・カテゴリ
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_3" name="item_class"
                                        onclick="itemClassMstClick()" value="3"
                                        @if (old('item_class') === '3' || (empty(old('item_class')) && isset($itemClassId) && $itemClassId === '3')) checked @endif />
                                    ジャンル
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_4" name="item_class"
                                        onclick="itemClassMstClick()" value="4"
                                        @if (old('item_class') === '4' || (empty(old('item_class')) && isset($itemClassId) && $itemClassId === '4')) checked @endif />
                                    販売開始年
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_5" name="item_class"
                                        onclick="itemClassMstClick()" value="5"
                                        @if (old('item_class') === '5' || (empty(old('item_class')) && isset($itemClassId) && $itemClassId === '5')) checked @endif />
                                    工場分類5
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_6" name="item_class"
                                        onclick="itemClassMstClick()" value="6"
                                        @if (old('item_class') === '6' || (empty(old('item_class')) && isset($itemClassId) && $itemClassId === '6')) checked @endif />
                                    製品/工賃6
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_7" name="item_class"
                                        onclick="itemClassMstClick()" value="7"
                                        @if (old('item_class') === '7' || (empty(old('item_class')) && isset($itemClassId) && $itemClassId === '7')) checked @endif />
                                    資産在庫JA
                                </label>
                            </div>
                        </div>
                    </div>
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
            <div class="sub_contents">
                <div class="left_contents">
                    <div class="grid_gray">
                        <table class="grid_gray_table_100p" id="item_class_grid_table">
                            <thead class="grid_gray_header">
                                <tr>
                                    <td class="grid_wrapper_center td_15p">コード</td>
                                    <td class="grid_wrapper_center td_50p" id="item_class_label">ブランド1名</td>
                                    <td class="grid_wrapper_center td_20p">EC表示</td>
                                </tr>
                            </thead>
                            <tbody class="grid_body">
                                @empty(old('insert_code'))
                                    @for ($i = 0; $i < 2; $i++)
                                        <tr>
                                            <td class="grid_wrapper_left grid_textbox_15p"><input type="text"
                                                    onblur="eventBlurCodeautoItemClass(arguments[0], this)" 
                                                    id="insert_item_class_code" name="insert_code[]" placeholder=""
                                                    class="grid_textbox" minlength="0" maxlength="6"></td>
                                            <td class="grid_wrapper_left grid_textbox_50p"><input type="text"
                                                    name="insert_name[]" placeholder="" class="grid_textbox" minlength="0"
                                                    maxlength="20"></td>
                                            <td class="grid_wrapper_center center"><input type="checkbox" id=""
                                                    name="insert_ec_display_flg[]" value="{{ $i }}" /></td>
                                        </tr>
                                    @endfor
                                @else
                                    @for ($i = 0; $i < count(old('insert_code')); $i++)
                                        <tr>
                                            <td class="grid_wrapper_left grid_textbox_15p"><input type="text"
                                                    onblur="eventBlurCodeautoItemClass(arguments[0], this)"
                                                    id="insert_item_class_code" name="insert_code[]"
                                                    value='{{ old("insert_code.{$i}") }}' placeholder="" class="grid_textbox"
                                                    minlength="0" maxlength="6"></td>
                                            <td class="grid_wrapper_left grid_textbox_50p"><input type="text"
                                                    name="insert_name[]" alue='{{ old("insert_name.{$i}") }}' placeholder=""
                                                    class="grid_textbox" minlength="0" maxlength="20"></td>
                                            <td class="grid_wrapper_center center"><input type="checkbox" id=""
                                                    name="insert_ec_display_flg[]"
                                                    value="{{ old("insert_ec_display_flg.{$i}") }}" /></td>
                                        </tr>
                                    @endfor
                                @endempty
                            </tbody>
                        </table>
                        <div class="plus_rec">
                            <div class="blue_text_wrapper" id="add_line" onclick="itemClassAddLine()">+ 行を追加する</div>
                        </div>
                    </div>
                </div>
                @if (old('item_class', $itemClassId ? $itemClassId : '1' ) == '1')
                <div class="right_contents" id="item_class_1">
                @else
                <div class="right_contents" id="item_class_1" style="display: none;">
                @endif
                    <div class="element-form">
                        <div class="text_wrapper">ブランド1コード</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" name="item_class1" class="element" id="input_item_class1" 
                                    onblur="eventBlurSearchItemClass(arguments[0], this)" minlength="0" maxlength="6" size="6" />
                                <img class="vector" id="img_item_class1" src="/img/icon/vector.svg" data-smm-open="search_brand1_modal" />
                            </div>
                        </div>
                    </div>
                    <div class="grid">
                        <table class="table_sticky" id="grid_table_1">
                            <thead class="grid_header">
                                <tr>
                                    <td class="grid_wrapper_center td_5p">削除</td>
                                    <td class="grid_wrapper_center td_25p">コード</td>
                                    <td class="grid_wrapper_center td_40p">ブランド1名</td>
                                    <td class="grid_wrapper_center td_15p">EC表示</td>
                                </tr>
                            </thead>
                            <tbody class="tbody_scroll">
                                @php $i=0; @endphp
                                @foreach ($initData1 as $data)
                                    @empty(old('update_item_class_code1'))
                                        <tr>
                                            <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                                    data-target="#modal_delete" data-value="{{ $data['id'] }}"
                                                    class="display_none" name="delete"><img class="grid_img_center"
                                                        src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                            <td class="grid_col_6 col_rec"><input type="text" name="update_item_class_code1[]"
                                                    id="input_update_item_class_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6"
                                                    value="{{ $data['item_class_cd'] }}" readonly /></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_item_class_name1[]"
                                                    id="names_update_item_class_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox" minlength="0" maxlength="20" size="20"
                                                    value="{{ $data['item_class_name'] }}" /></td>
                                            <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                                    name="update_ec_display_flg1[]" value="{{ $data['id'] }}" class="gray"
                                                    @if ($data['ec_display_flg']) checked @endif /></td>
                                            <input type="hidden" name="update_id1[]" value="{{ $data['id'] }}" />
                                            <input type="hidden" id="hidden_update_item_class_{{ $data['id'] }}"
                                                value="" name="hidden_item_class_{{ $data['id'] }}" />
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                                    data-target="#modal_delete" data-value="{{ $data['id'] }}"
                                                    class="display_none" name="delete"><img class="grid_img_center"
                                                        src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                            <td class="grid_col_6 col_rec"><input type="text" name="update_item_class_code1[]"
                                                    id="input_update_item_class_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6"
                                                    value="{{ $data['item_class_cd'] }}" readonly /></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_item_class_name1[]"
                                                    id="names_update_item_class_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox" minlength="0" maxlength="20" size="20"
                                                    value="{{ $data['item_class_name'] }}" /></td>
                                            <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                                    name="update_ec_display_flg1[]" value="{{ $data['id'] }}" class="gray"
                                                    @if ($data['ec_display_flg']) checked @endif /></td>
                                            <input type="hidden" name="update_id1[]" value="{{ $data['id'] }}" />
                                            <input type="hidden" id="hidden_update_item_class_{{ $data['id'] }}"
                                                value="" name="hidden_item_class_{{ $data['id'] }}" />
                                        </tr>
                                        @php $i++; @endphp
                                    @endempty
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if (old('item_class', $itemClassId ? $itemClassId : '' ) == '2')
                <div class="right_contents" id="item_class_2">
                @else
                <div class="right_contents" id="item_class_2" style="display: none;">
                @endif
                    <div class="element-form">
                        <div class="text_wrapper">競技・カテゴリコード</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" name="item_class2" class="element" id="input_item_class2" 
                                    onblur="eventBlurSearchItemClass(arguments[0], this)" minlength="0" maxlength="6"
                                    size="6" />
                                <img class="vector" id="img_item_class2" src="/img/icon/vector.svg"
                                    data-smm-open="search_game_category_modal" />
                            </div>
                        </div>
                    </div>
                    <div class="grid">
                        <table class="table_sticky" id="grid_table_2">
                            <thead class="grid_header">
                                <tr>
                                    <td class="grid_wrapper_center td_5p">削除</td>
                                    <td class="grid_wrapper_center td_25p">コード</td>
                                    <td class="grid_wrapper_center td_40p">競技・カテゴリ名</td>
                                    <td class="grid_wrapper_center td_15p">EC表示</td>
                                </tr>
                            </thead>
                            <tbody class="tbody_scroll">
                                @php $i=0; @endphp
                                @foreach ($initData2 as $data)
                                    @empty(old('update_item_class_code2'))
                                        <tr>
                                            <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                                    data-target="#modal_delete" data-value="{{ $data['id'] }}"
                                                    class="display_none" name="delete"><img class="grid_img_center"
                                                        src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                            <td class="grid_col_6 col_rec"><input type="text" name="update_item_class_code2[]"
                                                    id="input_update_item_class_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6"
                                                    value="{{ $data['item_class_cd'] }}" readonly /></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_item_class_name2[]"
                                                    id="names_update_item_class_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox" minlength="0" maxlength="20" size="20"
                                                    value="{{ $data['item_class_name'] }}" /></td>
                                            <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                                    name="update_ec_display_flg2[]" value="{{ $data['id'] }}" class="gray"
                                                    @if ($data['ec_display_flg']) checked @endif /></td>
                                            <input type="hidden" name="update_id2[]" value="{{ $data['id'] }}" />
                                            <input type="hidden" id="hidden_update_item_class_{{ $data['id'] }}" value=""
                                                name="hidden_item_class_{{ $data['id'] }}" />
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                                    data-target="#modal_delete" data-value="{{ $data['id'] }}"
                                                    class="display_none" name="delete"><img class="grid_img_center"
                                                        src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                            <td class="grid_col_6 col_rec"><input type="text" name="update_item_class_code2[]"
                                                    id="input_update_item_class_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6"
                                                    value="{{ $data['item_class_cd'] }}" readonly /></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_item_class_name2[]"
                                                id="names_update_item_class_{{ $data['id'] }}" placeholder=""
                                                class="grid_textbox" minlength="0" maxlength="20" size="20"
                                                value="{{ $data['item_class_name'] }}" /></td>
                                            <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                                    name="update_ec_display_flg2[]" value="{{ $data['id'] }}" class="gray"
                                                    @if ($data['ec_display_flg']) checked @endif /></td>
                                            <input type="hidden" name="update_id2[]" value="{{ $data['id'] }}" />
                                            <input type="hidden" id="hidden_update_item_class_{{ $data['id'] }}" value=""
                                                name="hidden_item_class_{{ $data['id'] }}" />
                                        </tr>
                                        @php $i++; @endphp
                                    @endempty
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if (old('item_class', $itemClassId ? $itemClassId : '' ) == '3')
                <div class="right_contents" id="item_class_3">
                @else
                <div class="right_contents" id="item_class_3" style="display: none;">
                @endif
                    <div class="element-form">
                        <div class="text_wrapper">ジャンルコード</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" name="item_class3" class="element" id="input_item_class3"
                                    onblur="eventBlurSearchItemClass(arguments[0], this)" minlength="0" maxlength="6"
                                    size="6" />
                                <img class="vector" id="img_item_class3" src="/img/icon/vector.svg"
                                    data-smm-open="search_genre_modal" />
                            </div>
                        </div>
                    </div>
                    <div class="grid">
                        <table class="table_sticky" id="grid_table_3">
                            <thead class="grid_header">
                                <tr>
                                    <td class="grid_wrapper_center td_5p">削除</td>
                                    <td class="grid_wrapper_center td_25p">コード</td>
                                    <td class="grid_wrapper_center td_40p">ジャンル名</td>
                                    <td class="grid_wrapper_center td_15p">EC表示</td>
                                </tr>
                            </thead>
                            <tbody class="tbody_scroll">
                                @php $i=0; @endphp
                                @foreach ($initData3 as $data)
                                    @empty(old('update_item_class_code3'))
                                        <tr>
                                            <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                                    data-target="#modal_delete" data-value="{{ $data['id'] }}" class="display_none"
                                                    name="delete"><img class="grid_img_center"
                                                        src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                            <td class="grid_col_6 col_rec"><input type="text" name="update_item_class_code3[]"
                                                    id="input_update_item_class_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6"
                                                    value="{{ $data['item_class_cd'] }}" readonly /></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_item_class_name3[]"
                                                    id="names_update_item_class_{{ $data['id'] }}" placeholder="" class="grid_textbox"
                                                    minlength="0" maxlength="20" size="20"
                                                    value="{{ $data['item_class_name'] }}" /></td>
                                            <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                                    name="update_ec_display_flg3[]" value="{{ $data['id'] }}" class="gray"
                                                    @if ($data['ec_display_flg']) checked @endif /></td>
                                            <input type="hidden" name="update_id3[]" value="{{ $data['id'] }}" />
                                            <input type="hidden" id="hidden_update_item_class_{{ $data['id'] }}" value=""
                                                name="hidden_item_class_{{ $data['id'] }}" />
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                                    data-target="#modal_delete" data-value="{{ $data['id'] }}" class="display_none"
                                                    name="delete"><img class="grid_img_center"
                                                        src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                            <td class="grid_col_6 col_rec"><input type="text" name="update_item_class_code3[]"
                                                    id="input_update_item_class_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6"
                                                    value="{{ $data['item_class_cd'] }}" readonly /></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_item_class_name3[]"
                                                id="names_update_item_class_{{ $data['id'] }}" placeholder="" class="grid_textbox"
                                                minlength="0" maxlength="20" size="20"
                                                value="{{ $data['item_class_name'] }}" /></td>
                                            <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                                    name="update_ec_display_flg3[]" value="{{ $data['id'] }}" class="gray"
                                                    @if ($data['ec_display_flg']) checked @endif /></td>
                                            <input type="hidden" name="update_id3[]" value="{{ $data['id'] }}" />
                                            <input type="hidden" id="hidden_update_item_class_{{ $data['id'] }}" value=""
                                                name="hidden_item_class_{{ $data['id'] }}" />
                                        </tr>
                                        @php $i++ @endphp
                                    @endempty
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if (old('item_class', $itemClassId ? $itemClassId : '' ) == '4')
                <div class="right_contents" id="item_class_4">
                @else
                <div class="right_contents" id="item_class_4" style="display: none;">
                @endif
                    <div class="element-form">
                        <div class="text_wrapper">販売開始年コード</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" name="item_class4" class="element" id="input_item_class4"
                                    onblur="eventBlurSearchItemClass(arguments[0], this)" minlength="0" maxlength="6"
                                    size="6" />
                                <img class="vector" id="img_item_class4" src="/img/icon/vector.svg"
                                    data-smm-open="search_item_class_thing4_modal" />
                            </div>
                        </div>
                    </div>
                    <div class="grid">
                        <table class="table_sticky" id="grid_table_4">
                            <thead class="grid_header">
                                <tr>
                                    <td class="grid_wrapper_center td_5p">削除</td>
                                    <td class="grid_wrapper_center td_25p">コード</td>
                                    <td class="grid_wrapper_center td_40p">販売開始年名</td>
                                    <td class="grid_wrapper_center td_15p">EC表示</td>
                                </tr>
                            </thead>
                            <tbody class="tbody_scroll">
                                @php $i=0; @endphp
                                @foreach ($initData4 as $data)
                                    @empty(old('update_item_class_code4'))
                                        <tr>
                                            <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                                    data-target="#modal_delete" data-value="{{ $data['id'] }}" class="display_none"
                                                    name="delete"><img class="grid_img_center"
                                                        src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                            <td class="grid_col_6 col_rec"><input type="text"
                                                    name="update_item_class_code4[]" 
                                                    id="input_update_item_class_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6"
                                                    value="{{ $data['item_class_cd'] }}" readonly /></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_item_class_name4[]"
                                                    id="names_update_item_class_{{ $data['id'] }}" placeholder="" class="grid_textbox"
                                                    minlength="0" maxlength="20" size="20"
                                                    value="{{ $data['item_class_name'] }}" /></td>
                                            <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                                    name="update_ec_display_flg4[]" value="{{ $data['id'] }}" class="gray"
                                                    @if ($data['ec_display_flg']) checked @endif /></td>
                                            <input type="hidden" name="update_id4[]" value="{{ $data['id'] }}" />
                                            <input type="hidden" id="hidden_update_item_class_{{ $data['id'] }}" value=""
                                                name="hidden_item_class_{{ $data['id'] }}" />
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                                    data-target="#modal_delete" data-value="{{ $data['id'] }}" class="display_none"
                                                    name="delete"><img class="grid_img_center"
                                                        src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                            <td class="grid_col_6 col_rec"><input type="text" name="update_item_class_code4[]"
                                                    id="input_update_item_class_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6"
                                                    value="{{ $data['item_class_cd'] }}" readonly /></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_item_class_name4[]"
                                                    id="names_update_item_class_{{ $data['id'] }}" placeholder="" class="grid_textbox"
                                                    minlength="0" maxlength="20" size="20"
                                                    value="{{ $data['item_class_name'] }}" /></td>
                                            <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                                    name="update_ec_display_flg4[]" value="{{ $data['id'] }}" class="gray"
                                                    @if ($data['ec_display_flg']) checked @endif /></td>
                                            <input type="hidden" name="update_id4[]" value="{{ $data['id'] }}" />
                                            <input type="hidden" id="hidden_update_item_class_{{ $data['id'] }}" value=""
                                                name="hidden_item_class_{{ $data['id'] }}" />
                                        </tr>
                                        @php $i++ @endphp
                                    @endempty
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if (old('item_class', $itemClassId ? $itemClassId : '' ) == '5')
                <div class="right_contents" id="item_class_5">
                @else
                <div class="right_contents" id="item_class_5" style="display: none;">
                @endif
                    <div class="element-form">
                        <div class="text_wrapper">工場分類5コード</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" name="item_class5" class="element" id="input_item_class5"
                                    onblur="eventBlurSearchItemClass(arguments[0], this)" minlength="0" maxlength="6"
                                    size="6" />
                                <img class="vector" id="img_item_class5" src="/img/icon/vector.svg"
                                    data-smm-open="search_item_class_thing5_modal" />
                            </div>
                        </div>
                    </div>
                    <div class="grid">
                        <table class="table_sticky" id="grid_table_5">
                            <thead class="grid_header">
                                <tr>
                                    <td class="grid_wrapper_center td_5p">削除</td>
                                    <td class="grid_wrapper_center td_25p">コード</td>
                                    <td class="grid_wrapper_center td_40p">工場分類5名</td>
                                    <td class="grid_wrapper_center td_15p">EC表示</td>
                                </tr>
                            </thead>
                            <tbody class="tbody_scroll">
                                @php $i=0; @endphp
                                @foreach ($initData5 as $data)
                                    @empty(old('update_item_class_code5'))
                                        <tr>
                                            <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                                    data-target="#modal_delete" data-value="{{ $data['id'] }}" class="display_none"
                                                    name="delete"><img class="grid_img_center"
                                                        src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                            <td class="grid_col_6 col_rec"><input type="text" name="update_item_class_code5[]"
                                                    id="input_update_item_class_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6"
                                                    value="{{ $data['item_class_cd'] }}" readonly /></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_item_class_name5[]"
                                                    id="names_update_item_class_{{ $data['id'] }}" placeholder="" class="grid_textbox"
                                                    minlength="0" maxlength="20" size="20"
                                                    value="{{ $data['item_class_name'] }}" /></td>
                                            <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                                    name="update_ec_display_flg5[]" value="{{ $data['id'] }}" class="gray"
                                                    @if ($data['ec_display_flg']) checked @endif /></td>
                                            <input type="hidden" name="update_id5[]" value="{{ $data['id'] }}" />
                                            <input type="hidden" id="hidden_update_item_class_{{ $data['id'] }}" value=""
                                                name="hidden_item_class_{{ $data['id'] }}" />
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                                    data-target="#modal_delete" data-value="{{ $data['id'] }}" class="display_none"
                                                    name="delete"><img class="grid_img_center"
                                                        src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                            <td class="grid_col_6 col_rec"><input type="text" name="update_item_class_code5[]"
                                                    id="input_update_item_class_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6"
                                                    value="{{ $data['item_class_cd'] }}" readonly /></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_item_class_name5[]"
                                                id="names_update_item_class_{{ $data['id'] }}" placeholder="" class="grid_textbox"
                                                minlength="0" maxlength="20" size="20"
                                                value="{{ $data['item_class_name'] }}" /></td>
                                            <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                                    name="update_ec_display_flg5[]" value="{{ $data['id'] }}" class="gray"
                                                    @if ($data['ec_display_flg']) checked @endif /></td>
                                            <input type="hidden" name="update_id5[]" value="{{ $data['id'] }}" />
                                            <input type="hidden" id="hidden_update_item_class_{{ $data['id'] }}" value=""
                                                name="hidden_item_class_{{ $data['id'] }}" />
                                        </tr>
                                        @php $i++ @endphp
                                    @endempty
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if (old('item_class', $itemClassId ? $itemClassId : '' ) == '6')
                <div class="right_contents" id="item_class_6">
                @else
                <div class="right_contents" id="item_class_6" style="display: none;">
                @endif
                    <div class="element-form">
                        <div class="text_wrapper">製品/工賃6コード</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" name="item_class5" class="element" id="input_item_class6"
                                    onblur="eventBlurSearchItemClass(arguments[0], this)" minlength="0" maxlength="6"
                                    size="6" />
                                <img class="vector" id="img_item_class6" src="/img/icon/vector.svg"
                                    data-smm-open="search_item_class_thing6_modal" />
                            </div>
                        </div>
                    </div>
                    <div class="grid">
                        <table class="table_sticky" id="grid_table_6">
                            <thead class="grid_header">
                                <tr>
                                    <td class="grid_wrapper_center td_5p">削除</td>
                                    <td class="grid_wrapper_center td_25p">コード</td>
                                    <td class="grid_wrapper_center td_40p">製品/工賃6名</td>
                                    <td class="grid_wrapper_center td_15p">EC表示</td>
                                </tr>
                            </thead>
                            <tbody class="tbody_scroll">
                                @php $i=0; @endphp
                                @foreach ($initData6 as $data)
                                    @empty(old('update_item_class_code6'))
                                        <tr>
                                            <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                                    data-target="#modal_delete" data-value="{{ $data['id'] }}" class="display_none"
                                                    name="delete"><img class="grid_img_center"
                                                        src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                            <td class="grid_col_6 col_rec"><input type="text" name="update_item_class_code6[]"
                                                    id="input_update_item_class_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6"
                                                    value="{{ $data['item_class_cd'] }}" readonly /></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_item_class_name6[]"
                                                    id="names_update_item_class_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox" minlength="0" maxlength="20" size="20"
                                                    value="{{ $data['item_class_name'] }}" /></td>
                                            <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                                    name="update_ec_display_flg6[]" value="{{ $data['id'] }}" class="gray"
                                                    @if ($data['ec_display_flg']) checked @endif /></td>
                                            <input type="hidden" name="update_id6[]" value="{{ $data['id'] }}" />
                                            <input type="hidden" id="hidden_update_item_class_{{ $data['id'] }}" value=""
                                                name="hidden_item_class_{{ $data['id'] }}" />
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                                    data-target="#modal_delete" data-value="{{ $data['id'] }}" class="display_none"
                                                    name="delete"><img class="grid_img_center"
                                                        src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                            <td class="grid_col_6 col_rec"><input type="text" name="update_item_class_code6[]"
                                                    id="input_update_item_class_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6"
                                                    value="{{ $data['item_class_cd'] }}" readonly /></td>
                                            <td class="grid_col_2 col_rec"><input type="text" name="update_item_class_name6[]"
                                                    id="names_update_item_class_{{ $data['id'] }}" placeholder=""
                                                    class="grid_textbox" minlength="0" maxlength="20" size="20"
                                                    value="{{ $data['item_class_name'] }}" /></td>
                                            <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                                    name="update_ec_display_flg6[]" value="{{ $data['id'] }}" class="gray"
                                                    @if ($data['ec_display_flg']) checked @endif /></td>
                                            <input type="hidden" name="update_id6[]" value="{{ $data['id'] }}" />
                                            <input type="hidden" id="hidden_update_item_class_{{ $data['id'] }}" value=""
                                                name="hidden_item_class_{{ $data['id'] }}" />
                                        </tr>
                                        @php $i++ @endphp
                                    @endempty
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if (old('item_class', $itemClassId ? $itemClassId : '' ) == '7')
                <div class="right_contents" id="item_class_7">
                @else
                <div class="right_contents" id="item_class_7" style="display: none;">
                @endif
                    <div class="element-form">
                        <div class="text_wrapper">資産在庫JAコード</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" name="item_class7" class="element" id="input_item_class7"
                                    onblur="eventBlurSearchItemClass(arguments[0], this)" minlength="0" maxlength="6"
                                    size="6" />
                                <img class="vector" id="img_item_class7" src="/img/icon/vector.svg"
                                    data-smm-open="search_item_class_thing7_modal" />
                            </div>
                        </div>
                    </div>
                    <div class="grid">
                        <table class="table_sticky" id="grid_table_7">
                            <thead class="grid_header">
                                <tr>
                                    <td class="grid_wrapper_center td_5p">削除</td>
                                    <td class="grid_wrapper_center td_25p">コード</td>
                                    <td class="grid_wrapper_center td_40p">資産在庫JA名</td>
                                    <td class="grid_wrapper_center td_15p">EC表示</td>
                                </tr>
                            </thead>
                            <tbody class="tbody_scroll">
                                @php $i=0; @endphp
                                @foreach ($initData7 as $data)
                                    @empty(old('update_item_class_code7'))
                                        </tr>
                                        <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                                data-target="#modal_delete" data-value="{{ $data['id'] }}" class="display_none"
                                                name="delete"><img class="grid_img_center"
                                                    src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                        <td class="grid_col_6 col_rec"><input type="text" name="update_item_class_code7[]"
                                                id="input_update_item_class_{{ $data['id'] }}" placeholder=""
                                                class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6"
                                                value="{{ $data['item_class_cd'] }}" readonly /></td>
                                        <td class="grid_col_2 col_rec"><input type="text" name="update_item_class_name7[]"
                                                id="names_update_item_class_{{ $data['id'] }}" placeholder="" class="grid_textbox"
                                                minlength="0" maxlength="20" size="20" value="{{ $data['item_class_name'] }}" /></td>
                                        <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                                name="update_ec_display_flg7[]" value="{{ $data['id'] }}" class="gray"
                                                @if ($data['ec_display_flg']) checked @endif /></td>
                                        <input type="hidden" name="update_id7[]" value="{{ $data['id'] }}" />
                                        <input type="hidden" id="hidden_update_item_class_{{ $data['id'] }}" value=""
                                            name="hidden_item_class_{{ $data['id'] }}" />
                                        </tr>
                                    @else
                                        </tr>
                                        <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                                data-target="#modal_delete" data-value="{{ $data['id'] }}" class="display_none"
                                                name="delete"><img class="grid_img_center"
                                                    src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                        <td class="grid_col_6 col_rec">
                                            <input type="text" name="update_item_class_code7[]"
                                                id="input_update_item_class_{{ $data['id'] }}" placeholder=""
                                                class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6"
                                                value="{{ $data['item_class_cd'] }}" readonly /></td>
                                        <td class="grid_col_2 col_rec">
                                            <input type="text" name="update_item_class_name7[]"
                                                id="names_update_item_class_{{ $data['id'] }}" placeholder="" class="grid_textbox"
                                                minlength="0" maxlength="20" size="20" value="{{ $data['item_class_name'] }}" /></td>
                                        <td class="grid_col_1 col_rec center"><input type="checkbox" id=""
                                                name="update_ec_display_flg7[]" value="{{ $data['id'] }}" class="gray"
                                                @if ($data['ec_display_flg']) checked @endif /></td>
                                        <input type="hidden" name="update_id7[]" value="{{ $data['id'] }}" />
                                        <input type="hidden" id="hidden_update_item_class_{{ $data['id'] }}" value=""
                                            name="hidden_item_class_{{ $data['id'] }}" />
                                        </tr>
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
        <input type="hidden" id="hidden_item_class1" value="" name="hidden_item_class1" />
        <input type="hidden" id="hidden_item_class2" value="" name="hidden_item_class2" />
        <input type="hidden" id="hidden_item_class3" value="" name="hidden_item_class3" />
        <input type="hidden" id="hidden_item_class4" value="" name="hidden_item_class4" />
        <input type="hidden" id="hidden_item_class5" value="" name="hidden_item_class5" />
        <input type="hidden" id="hidden_item_class6" value="" name="hidden_item_class6" />
        <input type="hidden" id="hidden_item_class7" value="" name="hidden_item_class7" />
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.master.search.brand1')
    @include('admin.master.search.game_category')
    @include('admin.master.search.genre')
    @include('admin.master.search.item_class_thing4')
    @include('admin.master.search.item_class_thing5')
    @include('admin.master.search.item_class_thing6')
    @include('admin.master.search.item_class_thing7')
@endsection
<script src="{{ asset('js/master/item/mt_item_class/index.js') }}"></script>