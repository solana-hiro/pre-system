@extends('layouts.admin.app')
@section('page_title', 'ロケーションマスタ')
@section('title', 'ロケーションマスタ')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
    <script type="module" src="{{ asset('js/master/other/mt_location/index.js') }}"></script>
@endsection

@section('content')
    <form role="search" action="{{ route('master.other.mt_location.update') }}" method="post">
        @csrf
        <div class="main-area">
            @include('components.button.main_button')
            @include('components.message.alert', ['errors' => $errors])
            <div class="element-form-rows">
                <div class="element-form">
                    <div class="text_wrapper">倉庫コード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="warehouse_cd" class="element w-24" value="{{ old('warehouse_cd') }}"
                                data-limit-len="6" data-limit-minus data-ac="warehouse" data-load>
                            <img class="vector" id="img_warehouse" src="/img/icon/vector.svg"
                                data-smm-open="search_warehouse_modal" />
                        </div>
                        <div class="textbox td_300px txt_blue">
                            <input id="warehouse_name" type="text" name="warehouse_name" class="grid_textbox"
                                value="{{ old('warehouse_name') }}" readonly>
                            <input type="hidden" name="warehouse_id" value="{{ old('warehouse_id') }}">
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="element-form-rows">
                <div class="element-form">
                    <div class="text_wrapper">商品コード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="item_cd" class="element w-24" maxlength="9"
                                value="{{ old('item_cd') }}" data-ac="item" data-load>
                            <img class="vector" id="img_warehouse" src="/img/icon/vector.svg"
                                data-smm-open="search_item_cd_modal" />
                        </div>
                        <div class="textbox td_300px txt_blue">
                            <input id="item_name" type="text" name="item_name" class="grid_textbox"
                                value="{{ old('item_name') }}" readonly>
                            <input type="hidden" name="item_id" value="{{ old('item_id') }}">
                        </div>
                    </div>
                </div>
            </div>

            <div id="location-table" class="grid">
                @if (!is_null(old('location')))
                    <table>
                        <thead class="grid_header">
                            <tr>
                                <th class="grid_wrapper_center">削除</th>
                                <th colspan="2" class="grid_wrapper_center">カラー</th>
                                <th colspan="2" class="grid_wrapper_center">サイズ</th>
                                <th class="grid_wrapper_center">棚番1</th>
                                <th class="grid_wrapper_center">棚番2</th>
                                <th class="grid_wrapper_center">ランク</th>
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @foreach (old('location', []) as $i => $row)
                                <tr>
                                    <input type="hidden" name="location[{{ $i }}][mt_stock_keeping_unit_id]"
                                        value="{{ $row['mt_stock_keeping_unit_id'] }}">
                                    <td class="grid_wrapper_center col_rec">
                                        <button type="button" data-clear>
                                            <img class="" src="{{ asset('/img/icon/trash.svg') }}">
                                        </button>
                                    </td>
                                    <td class="grid_wrapper_center col_rec">
                                        <input name="location[{{ $i }}][color_cd]"
                                            class="grid_textbox w-20 txt_blue" value="{{ $row['color_cd'] }}" readonly>
                                    </td>
                                    <td class="grid_wrapper_center col_rec">
                                        <input name="location[{{ $i }}][color_name]"
                                            class="grid_textbox w-20 txt_blue" value="{{ $row['color_name'] }}" readonly>
                                    </td>
                                    <td class="grid_wrapper_center col_rec">
                                        <input name="location[{{ $i }}][size_cd]"
                                            class="grid_textbox w-20 txt_blue" value="{{ $row['size_cd'] }}" readonly>
                                    </td>
                                    <td class="grid_wrapper_center col_rec">
                                        <input name="location[{{ $i }}][size_name]"
                                            class="grid_textbox w-20 txt_blue" value="{{ $row['size_name'] }}" readonly>
                                    </td>
                                    <td class="grid_wrapper_center col_rec">
                                        <input name="location[{{ $i }}][shelf_number_1]"
                                            class="grid_textbox w-24" value="{{ $row['shelf_number_1'] }}" maxlength="10">
                                    </td>
                                    <td class="grid_wrapper_center col_rec">
                                        <input name="location[{{ $i }}][shelf_number_2]"
                                            class="grid_textbox w-24" value="{{ $row['shelf_number_2'] }}" maxlength="10">
                                    </td>
                                    <td class="grid_wrapper_center col_rec">
                                        <input name="location[{{ $i }}][rank]" class="grid_textbox w-10"
                                            value="{{ $row['rank'] }}" maxlength="2">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="update" name="update" class="display_none_all"></button>
        <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
        <button type="submit" id="redirect" name="redirect" class="display_none_all" value=""></button>
    </form>
    @include('admin.master.search.warehouse')
    @include('admin.master.search.item_cd')
@endsection
