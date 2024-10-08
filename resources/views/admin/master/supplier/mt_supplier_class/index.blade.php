@extends('layouts.admin.app')
@section('page_title', '仕入先分類入力（一覧）')
@section('title', '仕入先分類入力（一覧）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('master.supplier.mt_supplier_class.update') }}" method="post"
        name="mtSupplierClassIndexForm">
        @csrf <div class="main-area">
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
                        <div class="text_wrapper">対象仕入先分類</div>
                        <div class="frame">
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="supplier_class_thing_id_1"
                                        onclick="supplierClassIdIndexClick()" name="def_supplier_class_thing_id"
                                        value="1"
                                        @if (old('def_supplier_class_thing_id') === '1' ||
                                                empty(old('def_supplier_class_thing_id')) ||
                                                (empty(old('def_supplier_class_thing_id')) &&
                                                    isset($defSupplierClassThingId) &&
                                                    $defSupplierClassThingId === '1')) checked @endif />
                                    仕入先分類1
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="supplier_class_thing_id_2"
                                        onclick="supplierClassIdIndexClick()" name="def_supplier_class_thing_id"
                                        value="2" 
                                        @if (old('def_supplier_class_thing_id') === '2' ||
                                                (empty(old('def_supplier_class_thing_id')) &&
                                                    isset($defSupplierClassThingId) &&
                                                    $defSupplierClassThingId === '2')) checked @endif />
                                    仕入先分類2
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="supplier_class_thing_id_3"
                                        onclick="supplierClassIdIndexClick()" name="def_supplier_class_thing_id"
                                        value="3"
                                        @if (old('def_supplier_class_thing_id') === '3' ||
                                                (empty(old('def_supplier_class_thing_id')) &&
                                                    isset($defSupplierClassThingId) &&
                                                    $defSupplierClassThingId === '3')) checked @endif />
                                    仕入先分類3
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
                        <table class="grid_gray_table_100p" id="grid_table">
                            <thead class="grid_gray_header">
                                <tr>
                                    <td class="grid_wrapper_center td_30p">コード</td>
                                    <td class="grid_wrapper_center td_70p" id="supplier_class_thing_name_title">仕入先分類名</td>
                                </tr>
                            </thead>
                            <tbody class="grid_body">
                                @empty(old('insert_class_code'))
                                    @for ($i = 0; $i < 2; $i++)
                                        <tr>
                                            <td class="grid_wrapper_left"><input type="text" placeholder=""
                                                    name="insert_class_code[]" id="insert_supplier_class_code"
                                                    onblur="eventBlurCodeautoSupplierClass(arguments[0], this)"
                                                    class="grid_textbox" minlength="0" maxlength="6"></td>
                                            <td class="grid_wrapper_left"><input type="text" placeholder=""
                                                    name="insert_class_name[]" class="grid_textbox" minlength="0"
                                                    maxlength="20"></td>
                                        </tr>
                                    @endfor
                                @else
                                    @for ($i = 0; $i < count(old('insert_class_code')); $i++)
                                        <tr>
                                            <td class="grid_wrapper_left"><input type="text" placeholder=""
                                                    name="insert_class_code[]" value='{{ old("insert_class_code.{$i}") }}'
                                                    id="insert_supplier_class_code"
                                                    onblur="eventBlurCodeautoSupplierClass(arguments[0], this)"
                                                    class="grid_textbox" minlength="0" maxlength="6"></td>
                                            <td class="grid_wrapper_left"><input type="text" placeholder=""
                                                    name="insert_class_name[]" value='{{ old("insert_class_name.{$i}") }}'
                                                    class="grid_textbox" minlength="0" maxlength="20"></td>
                                        </tr>
                                    @endfor
                                @endempty
                            </tbody>
                        </table>
                        <div class="plus_rec">
                            <div class="blue_text_wrapper" id="add_line" onclick="supplierClassAddLine()">+ 行を追加する</div>
                        </div>
                    </div>
                </div>
                @if (
                    (
                        old('def_supplier_class_thing_id') !== '2' &&
                        old('def_supplier_class_thing_id') !== '3' &&
                        !empty(old('def_supplier_class_thing_id'))
                     ) ||
                    (
                        empty(old('def_supplier_class_thing_id')) &&
                        isset($defSupplierClassThingId) &&
                        $defSupplierClassThingId !== '2' &&
                        $defSupplierClassThingId !== '3'
                    ) ||
                    (
                        empty(old('def_supplier_class_thing_id')) &&
                        !isset($defSupplierClassThingId)
                    ))
                    <div class="right_contents" id="right_content_1">
                @else
                    <div class="right_contents display_none_all" id="right_content_1">
                @endif
                <div class="element-form">
                    <div class="text_wrapper">仕入先分類1コード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="name" id="input_supplier_class1"
                                onblur="eventBlurSearchSupplierClass(arguments[0], this)" class="element" minlength="0"
                                maxlength="6" size="6" />
                            <img class="vector" id="img_supplier_class1" src="/img/icon/vector.svg"
                                data-smm-open="search_supplier_class1_modal" />
                            <input type="hidden" id="hidden_supplier_class1" value=""
                                name="hidden_supplier_class1" />
                        </div>
                    </div>
                </div>

                <div class="grid">
                    <table class="table_sticky" id="grid_table_1">
                        <thead class="grid_header">
                            <tr>
                                <td class="grid_wrapper_center td_5p">削除</td>
                                <td class="grid_wrapper_center td_15p">コード</td>
                                <td class="grid_wrapper_center td_40p">仕入先分類1</td>
                            </tr>
                        </thead>
                        <tbody class="tbody_scroll">
                            @php $i=0; @endphp
                            @foreach ($initData as $data)
                                @if ($data['def_supplier_class_thing_id'] === 1)
                                @empty(old('update_class_code1'))
                                    <tr>
                                        <td class="grid_wrapper_center col_rec"><button type="button"
                                                data-toggle="modal" data-target="#modal_delete"
                                                data-value="{{ $data['id'] }}" class="display_none"
                                                data-url="{{ route('master.customer.mt_customer_class.update') }}"
                                                name="delete"><img class="grid_img_center"
                                                    src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                        <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                                name="update_class_code1[]" id="update_supplier_class_code"
                                                onblur="eventBlurCodeautoSupplierClass(arguments[0], this)"
                                                class="grid_textbox" minlength="0" maxlength="6"
                                                value="{{ $data['supplier_class_cd'] }}" readonly></td>
                                        <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                                name="update_class_name1[]" class="grid_textbox" minlength="0"
                                                maxlength="20" value="{{ $data['supplier_class_name'] }}"></td>
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
                                                name="update_class_code1[]" id="update_supplier_class_code"
                                                onblur="eventBlurCodeautoSupplierClass(arguments[0], this)"
                                                class="grid_textbox" minlength="0" maxlength="6"
                                                value="{{ old("update_class_code1.{$i}", $data['supplier_class_cd']) }}" readonly>
                                        </td>
                                        <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                                name="update_class_name1[]" class="grid_textbox" minlength="0"
                                                maxlength="20"
                                                value="{{ old("update_class_name1.{$i}", $data['supplier_class_name']) }}">
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
        @if (old('def_supplier_class_thing_id') === '2' ||
                (empty(old('def_supplier_class_thing_id')) &&
                    isset($defSupplierClassThingId) &&
                    $defSupplierClassThingId === '2'))
            <div class="right_contents" id="right_content_2">
            @else
                <div class="right_contents display_none_all" id="right_content_2">
        @endif
        <div class="element-form">
            <div class="text_wrapper">仕入先分類2コード</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="name" id="input_supplier_class2"
                        onblur="eventBlurSearchSupplierClass(arguments[0], this)" class="element" minlength="0"
                        maxlength="6" size="6" />
                    <img class="vector" id="img_supplier_class2" src="/img/icon/vector.svg"
                        data-smm-open="search_supplier_class2_modal" />
                    <input type="hidden" id="hidden_supplier_class2" value=""
                        name="hidden_supplier_class2" />
                </div>
            </div>
        </div>

        <div class="grid">
            <table class="table_sticky" id="grid_table_2">
                <thead class="grid_header">
                    <tr>
                        <td class="grid_wrapper_center td_5p">削除</td>
                        <td class="grid_wrapper_center td_15p">コード</td>
                        <td class="grid_wrapper_center td_40p">仕入先分類2</td>
                    </tr>
                </thead>
                <tbody class="tbody_scroll">
                    @php $i=0; @endphp
                    @foreach ($initData as $data)
                        @if ($data['def_supplier_class_thing_id'] === 2)
                        @empty(old('update_class_code2'))
                            <tr>
                                <td class="grid_wrapper_center col_rec"><button type="button" data-toggle="modal"
                                        data-target="#modal_delete" data-value="{{ $data['id'] }}"
                                        class="display_none"
                                        data-url="{{ route('master.customer.mt_customer_class.update') }}"
                                        name="delete"><img class="grid_img_center"
                                            src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                        name="update_class_code2[]" id="update_supplier_class_code"
                                        onblur="eventBlurCodeautoSupplierClass(arguments[0], this)"
                                        class="grid_textbox" minlength="0" maxlength="6"
                                        value="{{ $data['supplier_class_cd'] }}" readonly></td>
                                <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                        name="update_class_name2[]" class="grid_textbox" minlength="0"
                                        maxlength="20" value="{{ $data['supplier_class_name'] }}"></td>
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
                                        name="update_class_code2[]" id="update_supplier_class_code"
                                        onblur="eventBlurCodeautoSupplierClass(arguments[0], this)"
                                        class="grid_textbox" minlength="0" maxlength="6"
                                        value="{{ old("update_class_code2.{$i}", $data['supplier_class_cd']) }}" readonly></td>
                                <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                        name="update_class_name2[]" class="grid_textbox" minlength="0"
                                        maxlength="20"
                                        value="{{ old("update_class_name2.{$i}", $data['supplier_class_name']) }}">
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
@if (old('def_supplier_class_thing_id') === '3' ||
        (empty(old('def_supplier_class_thing_id')) &&
            isset($defSupplierClassThingId) &&
            $defSupplierClassThingId === '3'))
<div class="right_contents" id="right_content_3">
@else
    <div class="right_contents display_none_all" id="right_content_3">
@endif
<div class="element-form">
    <div class="text_wrapper">仕入先分類3コード</div>
    <div class="frame">
        <div class="textbox">
            <input type="text" name="name" id="input_supplier_class3"
                onblur="eventBlurSearchSupplierClass(arguments[0], this)" class="element" minlength="0"
                maxlength="6" size="6" />
            <img class="vector" id="img_supplier_class3" src="/img/icon/vector.svg"
                data-smm-open="search_supplier_class3_modal" />
            <input type="hidden" id="hidden_supplier_class3" value="" name="hidden_supplier_class3" />
        </div>
    </div>
</div>

<div class="grid">
    <table class="table_sticky" id="grid_table_3">
        <thead class="grid_header">
            <tr>
                <td class="grid_wrapper_center td_5p">削除</td>
                <td class="grid_wrapper_center td_15p">コード</td>
                <td class="grid_wrapper_center td_40p">仕入先分類3</td>
            </tr>
        </thead>
        <tbody class="tbody_scroll">
            @php $i=0; @endphp
            @foreach ($initData as $data)
                @if ($data['def_supplier_class_thing_id'] === 3)
                @empty(old('update_class_code3'))
                    <tr>
                        <td class="grid_wrapper_center col_rec"><button type="button" data-toggle="modal"
                                data-target="#modal_delete" data-value="{{ $data['id'] }}"
                                class="display_none"
                                data-url="{{ route('master.customer.mt_customer_class.update') }}"
                                name="delete"><img class="grid_img_center"
                                    src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                        <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                name="update_class_code3[]" id="update_supplier_class_code"
                                onblur="eventBlurCodeautoSupplierClass(arguments[0], this)" class="grid_textbox"
                                minlength="0" maxlength="6" value="{{ $data['supplier_class_cd'] }}" readonly></td>
                        <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                name="update_class_name3[]" class="grid_textbox" minlength="0" maxlength="20"
                                value="{{ $data['supplier_class_name'] }}"></td>
                        <input type="hidden" name="update_id3[]" value="{{ $data['id'] }}" />
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
                                name="update_class_code3[]" id="update_supplier_class_code"
                                onblur="eventBlurCodeautoSupplierClass(arguments[0], this)" class="grid_textbox"
                                minlength="0" maxlength="6"
                                value="{{ old("update_class_code3.{$i}", $data['supplier_class_cd']) }}" readonly></td>
                        <td class="grid_wrapper_left col_rec"><input type="text" placeholder=""
                                name="update_class_name3[]" class="grid_textbox" minlength="0" maxlength="20"
                                value="{{ old("update_class_code3.{$i}", $data['supplier_class_name']) }}"></td>
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
</div>
<button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
<button type="submit" id="update" name="update" class="display_none_all"></button>
<button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
@include('components.menu.selected', ['view' => 'main'])
</form>
@include('admin.master.search.supplier_class1')
@include('admin.master.search.supplier_class2')
@include('admin.master.search.supplier_class3')
<script src="{{ asset('js/master/supplier/mt_supplier_class/index.js') }}"></script>
@endsection
