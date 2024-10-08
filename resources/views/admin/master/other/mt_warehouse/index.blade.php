@extends('layouts.admin.app')
@section('page_title', '倉庫入力')
@section('title', '倉庫入力')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('master.other.mt_warehouse.update') }}" method="post">
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
                <table class="grid_gray_pattern_table_100p" id="warehouse_grid_table">
                    <thead class="grid_header">
                        <tr>
                            <td class="grid_wrapper_center td_5p">倉庫コード</td>
                            <td class="grid_wrapper_center td_25p">倉庫名</td>
                            <td class="grid_wrapper_center td_15p">名カナ</td>
                            <td class="grid_wrapper_center td_10p">倉庫種別</td>
                            <td class="grid_wrapper_center td_10p">分析用各倉庫区分</td>
                            <td class="grid_wrapper_center td_10p">資産在庫有効区分</td>
                            <td class="grid_wrapper_center td_10p">削除区分</td>
                        </tr>
                    </thead>
                    <tbody class="grid_body">
                        @empty(old('insert_warehouse_code'))
                            @for ($i = 0; $i < 2; $i++)
                                <tr>
                                    <td class="grid_col_1 grid_wrapper_left"><input type="number" data-limit-len="6" data-limit-minus placeholder=""
                                            name="insert_warehouse_code[]"
                                            onblur="eventBlurCodeautoWarehouse(arguments[0], this)" id="insert_warehouse_code"
                                            class="grid_textbox input_number_6"></td>
                                    <td class="grid_col_1 grid_wrapper_left"><input type="text" placeholder=""
                                            name="insert_warehouse_name[]" class="grid_textbox" minlength="0" maxlength="20">
                                    </td>
                                    <td class="grid_col_1 grid_wrapper_left"><input type="text" placeholder=""
                                            name="insert_warehouse_name_kana[]" class="grid_textbox" minlength="0"
                                            maxlength="10"></td>
                                    <td class="grid_col_1 grid_wrapper_left"><input type="text" placeholder=""
                                            name="insert_warehouse_kind[]" class="grid_textbox" minlength="0" maxlength="3">
                                    </td>
                                    <td class="grid_col_1 grid_wrapper_left"><input type="text" placeholder=""
                                            name="insert_analysis_warehouse_kbn[]" class="grid_textbox" minlength="0"
                                            maxlength="3"></td>
                                    <td class="grid_col_1 grid_wrapper_left"><input type="text" placeholder=""
                                            name="insert_asset_stock_validity_kbn[]" class="grid_textbox" minlength="0"
                                            maxlength="3"></td>
                                    <td class="grid_col_1 grid_wrapper_left"><input type="text" placeholder=""
                                            name="insert_del_kbn[]" class="grid_textbox" minlength="0" maxlength="3"></td>
                                </tr>
                            @endfor
                        @else
                            @for ($i = 0; $i < count(old('insert_warehouse_code')); $i++)
                                <tr>
                                    <td class="grid_col_1 grid_wrapper_left"><input type="number" data-limit-len="6" data-limit-minus placeholder=""
                                            name="insert_warehouse_code[]"
                                            onblur="eventBlurCodeautoWarehouse(arguments[0], this)" id="insert_warehouse_code"
                                            value='{{ old("insert_warehouse_code.{$i}") }}' class="grid_textbox input_number_6"></td>
                                    <td class="grid_col_1 grid_wrapper_left"><input type="text" placeholder=""
                                            name="insert_warehouse_name[]" value='{{ old("insert_warehouse_name.{$i}") }}'
                                            class="grid_textbox" minlength="0" maxlength="20"></td>
                                    <td class="grid_col_1 grid_wrapper_left"><input type="text" placeholder=""
                                            name="insert_warehouse_name_kana[]"
                                            value='{{ old("insert_warehouse_name_kana.{$i}") }}' class="grid_textbox"
                                            minlength="0" maxlength="10"></td>
                                    <td class="grid_col_1 grid_wrapper_left"><input type="text" placeholder=""
                                            name="insert_warehouse_kind[]" value='{{ old("insert_warehouse_kind.{$i}") }}'
                                            class="grid_textbox" minlength="0" maxlength="3"></td>
                                    <td class="grid_col_1 grid_wrapper_left"><input type="text" placeholder=""
                                            name="insert_analysis_warehouse_kbn[]"
                                            value='{{ old("insert_analysis_warehouse_kbn.{$i}") }}' class="grid_textbox"
                                            minlength="0" maxlength="3"></td>
                                    <td class="grid_col_1 grid_wrapper_left"><input type="text" placeholder=""
                                            name="insert_asset_stock_validity_kbn[]"
                                            value='{{ old("insert_asset_stock_validity_kbn.{$i}") }}' class="grid_textbox"
                                            minlength="0" maxlength="3"></td>
                                    <td class="grid_col_1 grid_wrapper_left"><input type="text" placeholder=""
                                            name="insert_del_kbn[]" value='{{ old("insert_del_kbn.{$i}") }}'
                                            class="grid_textbox" minlength="0" maxlength="3"></td>
                                </tr>
                            @endfor

                        @endempty
                    </tbody>
                </table>
            </div>

            <div class="plus_rec">
                <div class="blue_text_wrapper" onClick="warehouseClassAddLine();">+ 行を追加する</div>
            </div>

            <div class="element-form element-form-single">
                <div class="text_wrapper">倉庫コード</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="number" name="search_warehouse_cd" id="input_search_warehouse_cd"
                            onblur="eventBlurSearchWarehouse(arguments[0], this)" class="element input_number_6" data-limit-len="6" data-limit-minus />
                        <img class="vector" id="img_search_warehouse_cd" src="/img/icon/vector.svg"
                            data-smm-open="search_warehouse_modal" />
                    </div>
                </div>
                <input type="hidden" id="hidden_search_warehouse_cd" value="" name="hidden_warehouse" />
            </div>

            <div class="grid">
                <table class="grid_gray_table_100p" id="grid_table_1">
                    <thead class="grid_header">
                        <tr>
                            <td rowspan="2" class="grid_wrapper_center td_5p">削除</td>
                            <td rowspan="2" class="grid_wrapper_center td_10p">倉庫コード</td>
                            <td class="grid_wrapper_center td_20p">倉庫名</td>
                            <td class="grid_wrapper_center td_15p">名カナ</td>
                            <td class="grid_wrapper_center td_10p">倉庫種別</td>
                            <td class="grid_wrapper_center td_10p">分析用各倉庫区分</td>
                            <td class="grid_wrapper_center td_10p">資産在庫有効区分</td>
                            <td class="grid_wrapper_center td_10p">削除区分</td>
                        </tr>
                    </thead>
                    <tbody class="grid_body">
                        @php $i=0; @endphp
                        @foreach ($initData as $data)
                            @empty(old('update_warehouse_code'))
                                <tr>
                                    <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                            data-target="#modal_delete" data-value="{{ $data['id'] }}"
                                            class="display_none" name="delete"><img class="grid_img_center"
                                                src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                    <td class="grid_col_6 col_rec col_rec"><input type="text"
                                            name="update_warehouse_code[]"
                                            onblur="eventBlurCodeautoWarehouse(arguments[0], this)"
                                            id="input_update_warehouse_{{ $data['id'] }}" placeholder=""
                                            class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6"
                                            value="{{ $data['warehouse_cd'] }}" readonly></td>
                                    <td class="grid_col_2 col_rec"><input type="text" name="update_warehouse_name[]"
                                            id="names_update_warehouse_{{ $data['id'] }}" placeholder=""
                                            class="grid_textbox" minlength="0" maxlength="20" size="20"
                                            value="{{ $data['warehouse_name'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" name="update_warehouse_name_kana[]"
                                            placeholder="" class="grid_textbox" minlength="0" maxlength="10"
                                            size="10" value="{{ $data['warehouse_name_kana'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" name="update_warehouse_kind[]"
                                            placeholder="" class="grid_textbox" minlength="0" maxlength="3"
                                            size="3" value="{{ $data['warehouse_kind'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text"
                                            name="update_analysis_warehouse_kbn[]" placeholder="" class="grid_textbox"
                                            minlength="0" maxlength="3" size="3"
                                            value="{{ $data['analysis_warehouse_kbn'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text"
                                            name="update_asset_stock_validity_kbn[]" placeholder="" class="grid_textbox"
                                            minlength="0" maxlength="3" size="3"
                                            value="{{ $data['asset_stock_validity_kbn'] }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" name="update_del_kbn[]"
                                            placeholder="" class="grid_textbox" minlength="0" maxlength="3"
                                            size="3" value="{{ $data['del_kbn'] }}"></td>
                                    <input type="hidden" name="update_id[]" value="{{ $data['id'] }}" />
                                    <input type="hidden" id="hidden_update_warehouse_{{ $data['id'] }}" value=""
                                        name="hidden_warehouse_{{ $data['id'] }}" />
                                </tr>
                            @else
                                <tr>
                                    <td class="grid_col_1 col_rec"><button type="button" data-toggle="modal"
                                            data-target="#modal_delete" data-value="{{ $data['id'] }}"
                                            class="display_none" name="delete"><img class="grid_img_center"
                                                src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                                    <td class="grid_col_6 col_rec col_rec"><input type="text"
                                            name="update_warehouse_code[]"
                                            onblur="eventBlurCodeautoWarehouse(arguments[0], this)"
                                            id="input_update_warehouse_{{ $data['id'] }}" placeholder=""
                                            class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6"
                                            value="{{ old("update_warehouse_code.{$i}", $data['warehouse_cd']) }}" readonly></td>
                                    <td class="grid_col_2 col_rec"><input type="text" name="update_warehouse_name[]"
                                            id="names_update_warehouse_{{ $data['id'] }}" placeholder=""
                                            class="grid_textbox" minlength="0" maxlength="20" size="20"
                                            value="{{ old("update_warehouse_name.{$i}", $data['warehouse_name']) }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" name="update_warehouse_name_kana[]"
                                            placeholder="" class="grid_textbox" minlength="0" maxlength="10"
                                            size="10"
                                            value="{{ old("update_warehouse_name_kana.{$i}", $data['warehouse_name_kana']) }}"></td>
                                    <td class="grid_col_2 col_rec"><input type="text" name="update_warehouse_kind[]"
                                            placeholder="" class="grid_textbox" minlength="0" maxlength="3"
                                            size="3"
                                            value="{{ old("update_warehouse_kind.{$i}", $data['warehouse_kind']) }}">
                                    </td>
                                    <td class="grid_col_2 col_rec"><input type="text"
                                            name="update_analysis_warehouse_kbn[]" placeholder="" class="grid_textbox"
                                            minlength="0" maxlength="3" size="3"
                                            value="{{ old("update_analysis_warehouse_kbn.{$i}", $data['analysis_warehouse_kbn']) }}">
                                    </td>
                                    <td class="grid_col_2 col_rec"><input type="text"
                                            name="update_asset_stock_validity_kbn[]" placeholder="" class="grid_textbox"
                                            minlength="0" maxlength="3" size="3"
                                            value="{{ old("update_asset_stock_validity_kbn.{$i}", $data['asset_stock_validity_kbn']) }}">
                                    </td>
                                    <td class="grid_col_2 col_rec"><input type="text" name="update_del_kbn[]"
                                            placeholder="" class="grid_textbox" minlength="0" maxlength="3"
                                            size="3" value="{{ old("update_del_kbn.{$i}", $data['del_kbn']) }}"></td>
                                    <input type="hidden" name="update_id[]" value="{{ $data['id'] }}" />
                                    <input type="hidden" id="hidden_update_warehouse_{{ $data['id'] }}" value=""
                                        name="hidden_warehouse_{{ $data['id'] }}" />
                                </tr>
                            @endempty
                            @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="update" name="update" class="display_none_all"></button>
        <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.master.search.warehouse', ['warehouseData' => $warehouseData])
    <script src="{{ asset('js/master/other/mt_warehouse/index.js') }}"></script>
@endsection
