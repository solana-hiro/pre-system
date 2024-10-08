@extends('layouts.admin.app')
@section('page_title', '得意先分類入力（一覧）')
@section('title', '得意先分類入力（一覧）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('content')
    <div class="main-area">
        <form role="search" action="{{ route('master.customer.mt_customer_class.update') }}" method="post"
            name="mtCustomerClassIndexForm">
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
            <div class="box">
                <div class="group">
                    <div class="element">
                        <div class="text_wrapper">対象得意先分類</div>
                        <div class="frame">
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="customer_class_thing_id_1" name="def_customer_class_thing_id"
                                        onclick="customerClassIdIndexClick()" value="1"
                                        @if (old('def_customer_class_thing_id') === '1' ||
                                                empty(old('def_customer_class_thing_id')) ||
                                                (empty(old('def_customer_class_thing_id')) &&
                                                    isset($defCustomerClassThingId) &&
                                                    $defCustomerClassThingId === '1')) checked @endif />
                                    販売パターン1
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="customer_class_thing_id_2" name="def_customer_class_thing_id"
                                        onclick="customerClassIdIndexClick()" value="2"
                                        @if (old('def_customer_class_thing_id') === '2' ||
                                                (empty(old('def_customer_class_thing_id')) &&
                                                    isset($defCustomerClassThingId) &&
                                                    $defCustomerClassThingId === '2')) checked @endif />
                                    業種・特徴2
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="customer_class_thing_id_3" name="def_customer_class_thing_id"
                                        onclick="customerClassIdIndexClick()" value="3"
                                        @if (old('def_customer_class_thing_id') === '3' ||
                                                (empty(old('def_customer_class_thing_id')) &&
                                                    isset($defCustomerClassThingId) &&
                                                    $defCustomerClassThingId === '3')) checked @endif />
                                    ランク3
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger"><span class="bold">新規登録・コードは数字4桁</span></div>
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
                        <table class="grid_gray_table_100p" id="grid_table">
                            <thead class="grid_gray_header">
                                <tr>
                                    <td class="grid_wrapper_center td_30p">コード</td>
                                    <td class="grid_wrapper_center td_70p" id="customer_class_thing_name_title">販売パターン1名
                                    </td>
                                </tr>
                            </thead>
                            <tbody class="grid_body">
                                @empty(old('insert_class_code'))
                                    @for ($i = 0; $i < 2; $i++)
                                        <tr>
                                            <td class="grid_wrapper_left"><input type="text" name="insert_class_code[]"
                                                    id="insert_customer_class_code"
                                                    onblur="eventBlurCodeautoCustomerClass(arguments[0], this)" placeholder=""
                                                    class="grid_textbox" minlength="0" maxlength="6"></td>
                                            <td class="grid_wrapper_left"><input type="text" name="insert_class_name[]"
                                                    placeholder="" class="grid_textbox" minlength="0" maxlength="20"></td>
                                        </tr>
                                    @endfor
                                @else
                                    @for ($i = 0; $i < count(old('insert_class_code')); $i++)
                                        <tr>
                                            <td class="grid_wrapper_left"><input type="text" name="insert_class_code[]"
                                                    value='{{ old("insert_class_code.{$i}") }}'
                                                    onblur="eventBlurCodeautoCustomerClass(arguments[0], this)" placeholder=""
                                                    class="grid_textbox" minlength="0" maxlength="6"></td>
                                            <td class="grid_wrapper_left"><input type="text" name="insert_class_name[]"
                                                    value='{{ old("insert_class_name.{$i}") }}' placeholder=""
                                                    class="grid_textbox" minlength="0" maxlength="20"></td>
                                        </tr>
                                    @endfor
                                @endempty
                            </tbody>
                        </table>
                        <div class="plus_rec">
                            <div class="blue_text_wrapper" id="add_line" onclick="customerClassAddLine()">+ 行を追加する</div>
                        </div>
                    </div>
                </div>
                @if (
                    (
                        old('def_customer_class_thing_id') !== '2' &&
                        old('def_customer_class_thing_id') !== '3' &&
                        !empty(old('def_customer_class_thing_id'))
                     ) ||
                    (
                        empty(old('def_customer_class_thing_id')) &&
                        isset($defCustomerClassThingId) &&
                        $defCustomerClassThingId !== '2' &&
                        $defCustomerClassThingId !== '3'
                    ) ||
                    (
                        empty(old('def_customer_class_thing_id')) &&
                        !isset($defCustomerClassThingId)
                    ))
                    <div class="right_contents" id="right_content_1">
                @else
                    <div class="right_contents display_none_all" id="right_content_1">
                @endif
                <div class="element-form">
                    <div class="text_wrapper" id="customer_class_thing_search_title">販売パターン1コード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="search_name" id="input_search_name1"
                                onblur="eventBlurSearchCustomerClass(arguments[0], this)" class="element" minlength="0"
                                maxlength="6" size="6" />
                            <img class="vector" id="img_search_name1" src="/img/icon/vector.svg"
                                data-smm-open="search_customer_class_thing1_modal" />
                            <input type="hidden" id="hidden_search_name1" value="" name="hidden_search_name1" />
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <table class="table_sticky" id="grid_table_1">
                        <thead class="grid_header">
                            <tr>
                                <td class="grid_wrapper_center td_50px">削除</td>
                                <td class="grid_wrapper_center td_200px">コード</td>
                                <td class="grid_wrapper_center td_800px" id="customer_class_thing_grid_title">販売パターン1名
                                </td>
                            </tr>
                        </thead>
                        <tbody class="tbody_scroll">
                            @php $i=0; @endphp
                            @foreach ($initData as $data)
                                @if ($data['def_customer_class_thing_id'] === 1)
                                @empty(old('update_class_code1'))
                                    <tr>
                                        <td class="grid_wrapper_center col_rec"><button type="button"
                                                data-toggle="modal" data-target="#modal_delete"
                                                data-value="{{ $data['id'] }}" class="display_none"
                                                data-url="{{ route('master.customer.mt_customer_class.update') }}"
                                                name="delete"><img class="grid_img_center"
                                                    src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                        <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                                name="update_class_code1[]" value="{{ $data['customer_class_cd'] }}"
                                                id="update_customer_class_code"
                                                onblur="eventBlurCodeautoCustomerClass(arguments[0], this)"
                                                class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6" readonly></td>
                                        <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                                name="update_class_name1[]" class="grid_textbox" minlength="0"
                                                maxlength="20" value="{{ $data['customer_class_name'] }}"></td>
                                        <input type="hidden" name="update_id1[]" value="{{ $data['id'] }}" />
                                    </tr>
                                @else
                                    <tr>
                                        <td class="grid_wrapper_center col_rec"><button type="button"
                                                data-toggle="modal" data-target="#modal_delete"
                                                data-value="{{ $data['id'] }}" class="display_none"
                                                data-url="{{ route('master.customer.mt_customer_class.update') }}"
                                                name="delete"><img class="grid_img_center"
                                                    src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                        <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                                name="update_class_code1[]"
                                                value="{{ old("update_class_code1.{$i}", $data['customer_class_cd']) }}"
                                                id="update_customer_class_code"
                                                onblur="eventBlurCodeautoCustomerClass(arguments[0], this)"
                                                class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6" readonly></td>
                                        <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                                name="update_class_name1[]" class="grid_textbox" minlength="0"
                                                maxlength="20"
                                                value="{{ old("update_class_name1.{$i}", $data['customer_class_name']) }}">
                                        </td>
                                        <input type="hidden" name="update_id1[]" value="{{ $data['id'] }}" />
                                    </tr>
                                    @php $i++; @endphp
                                @endempty
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if (old('def_customer_class_thing_id') === '2' ||
                (empty(old('def_customer_class_thing_id')) &&
                    isset($defCustomerClassThingId) &&
                    $defCustomerClassThingId === '2'))
            <div class="right_contents" id="right_content_2">
            @else
                <div class="right_contents display_none_all" id="right_content_2">
        @endif
        <div class="element-form">
            <div class="text_wrapper" id="customer_class_thing_search_title">業種・特徴2コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="search_name" id="input_search_name2"
                        onblur="eventBlurSearchCustomerClass(arguments[0], this)" class="element" minlength="0"
                        maxlength="6" size="4" />
                    <img class="vector" id="img_search_name2" src="/img/icon/vector.svg"
                        data-smm-open="search_customer_class_thing2_modal" />
                    <input type="hidden" id="hidden_search_name2" value="" name="hidden_search_name2" />
                </div>
            </div>
        </div>
        <div class="grid">
            <table class="table_sticky" id="grid_table_2">
                <thead class="grid_header">
                    <tr>
                        <td class="grid_wrapper_center td_50px">削除</td>
                        <td class="grid_wrapper_center td_200px">コード</td>
                        <td class="grid_wrapper_center td_800px" id="customer_class_thing_grid_title">業種・特徴2名</td>
                    </tr>
                </thead>
                <tbody class="tbody_scroll">
                    @php $i=0; @endphp
                    @foreach ($initData as $data)
                        @if ($data['def_customer_class_thing_id'] === 2)
                        @empty(old('update_class_code2'))
                            <tr>
                                <td class="grid_wrapper_center col_rec"><button type="button" data-toggle="modal"
                                        data-target="#modal_delete" data-value="{{ $data['id'] }}"
                                        class="display_none"
                                        data-url="{{ route('master.customer.mt_customer_class.update') }}"
                                        name="delete"><img class="grid_img_center"
                                            src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                        name="update_class_code2[]" value="{{ $data['customer_class_cd'] }}"
                                        id="update_customer_class_code"
                                        onblur="eventBlurCodeautoCustomerClass(arguments[0], this)"
                                        class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6" readonly></td>
                                <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                        name="update_class_name2[]" class="grid_textbox" minlength="0"
                                        maxlength="20" value="{{ $data['customer_class_name'] }}"></td>
                                <input type="hidden" name="update_id2[]" value="{{ $data['id'] }}" />
                            </tr>
                        @else
                            <tr>
                                <td class="grid_wrapper_center col_rec"><button type="button" data-toggle="modal"
                                        data-target="#modal_delete" data-value="{{ $data['id'] }}"
                                        class="display_none"
                                        data-url="{{ route('master.customer.mt_customer_class.update') }}"
                                        name="delete"><img class="grid_img_center"
                                            src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                        name="update_class_code2[]"
                                        value="{{ old("update_class_code2.{$i}", $data['customer_class_cd']) }}"
                                        id="update_customer_class_code"
                                        onblur="eventBlurCodeautoCustomerClass(arguments[0], this)"
                                        class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6" readonly></td>
                                <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                        name="update_class_name2[]" class="grid_textbox" minlength="0"
                                        maxlength="20"
                                        value="{{ old("update_class_name2.{$i}", $data['customer_class_name']) }}">
                                </td>
                                <input type="hidden" name="update_id2[]" value="{{ $data['id'] }}" />
                            </tr>
                            @php $i++; @endphp
                        @endempty
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@if (old('def_customer_class_thing_id') === '3' ||
        (empty(old('def_customer_class_thing_id')) &&
            isset($defCustomerClassThingId) &&
            $defCustomerClassThingId === '3'))
<div class="right_contents" id="right_content_3">
@else
    <div class="right_contents display_none_all" id="right_content_3">
@endif
<div class="element-form">
<div class="text_wrapper" id="customer_class_thing_search_title">ランク3コード</div>
<div class="frame">
    <div class="textbox">
        <input type="text" name="search_name" id="input_search_name3"
            onblur="eventBlurSearchCustomerClass(arguments[0], this)" class="element" minlength="0"
            maxlength="6" size="6" />
        <img class="vector" id="img_search_name3" src="/img/icon/vector.svg"
            data-smm-open="search_rank3_modal" />
        <input type="hidden" id="hidden_search_name3" value="" name="hidden_search_name3" />
    </div>
</div>
</div>
<div class="grid">
<table class="table_sticky" id="grid_table_3">
    <thead class="grid_header">
        <tr>
            <td class="grid_wrapper_center td_50px">削除</td>
            <td class="grid_wrapper_center td_200px">コード</td>
            <td class="grid_wrapper_center td_800px" id="customer_class_thing_grid_title">ランク3名</td>
        </tr>
    </thead>
    <tbody class="tbody_scroll">
        @php $i=0; @endphp
        @foreach ($initData as $data)
            @if ($data['def_customer_class_thing_id'] === 3)
            @empty(old('update_class_code2'))
                <tr>
                    <td class="grid_wrapper_center col_rec"><button type="button" data-toggle="modal"
                            data-target="#modal_delete" data-value="{{ $data['id'] }}" class="display_none"
                            data-url="{{ route('master.customer.mt_customer_class.update') }}"
                            name="delete"><img class="grid_img_center"
                                src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                    <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                            name="update_class_code3[]" value="{{ $data['customer_class_cd'] }}"
                            id="update_customer_class_code"
                            onblur="eventBlurCodeautoCustomerClass(arguments[0], this)"
                            class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6" readonly></td>
                    <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                            name="update_class_name3[]" class="grid_textbox" minlength="0" maxlength="20"
                            value="{{ $data['customer_class_name'] }}"></td>
                    <input type="hidden" name="update_id3[]" value="{{ $data['id'] }}" />
                </tr>
            @else
                <tr>
                    <td class="grid_wrapper_center col_rec"><button type="button" data-toggle="modal"
                            data-target="#modal_delete" data-value="{{ $data['id'] }}" class="display_none"
                            data-url="{{ route('master.customer.mt_customer_class.update') }}"
                            name="delete"><img class="grid_img_center"
                                src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                    <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                            name="update_class_code3[]"
                            value="{{ old("update_class_code3.{$i}", $data['customer_class_cd']) }}"
                            id="update_customer_class_code"
                            onblur="eventBlurCodeautoCustomerClass(arguments[0], this)"
                            class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6" readonly></td>
                    <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                            name="update_class_name3[]" class="grid_textbox" minlength="0" maxlength="20"
                            value="{{ old("update_class_name3.{$i}", $data['customer_class_name']) }}"></td>
                    <input type="hidden" name="update_id3[]" value="{{ $data['id'] }}" />
                </tr>
                @php $i++; @endphp
            @endempty
        @endif
    @endforeach
</tbody>
</table>
</div>
</div>
</div>
<button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
<button type="submit" id="update" name="update" class="display_none_all"></button>
<button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
@include('components.menu.selected', ['view' => 'main'])
</form>
</div>
@include('admin.master.search.customer_class_thing1')
@include('admin.master.search.customer_class_thing2')
@include('admin.master.search.rank3')
<script src="{{ asset('js/master/customer/mt_customer_class/index.js') }}"></script>
@endsection
