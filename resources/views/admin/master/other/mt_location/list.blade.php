@extends('layouts.admin.app')
@section('page_title', 'ロケーションマスタリスト（一覧）')
@section('title', 'ロケーションマスタリスト（一覧）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
    <script type="module" src="{{ asset('js/master/other/mt_location/list.js') }}"></script>
    <script>
        const laravelResponse = [
            @json(session('_old_input')),
            @json($errors->all()),
            @json(session('sessionErrors'))
        ]; // ListErrorAlert専用
    </script>
@endsection


@section('content')
    <form role="search" action="{{ route('master.other.mt_location.export') }}" method="post">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button class="button" type="submit" name="cancel" onclick="this.form.target='_self'">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="preview" id="preview"
                        onclick="this.form.target='_blank'">
                        <div class="text_wrapper_2">プレビューを見る</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="excel" onclick="this.form.target='_self'">
                        <div class="text_wrapper_2">Excelへ出力</div>
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
            @endif
            <div class="alert alert-danger">
                <ul id="alert-danger-ul">
            </div>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">倉庫</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="warehouse_code" id="input_warehouse" class="element" minlength="0"
                            maxlength="6" size="6"
                            value="{{ old('warehouse_code', $initWarehouseInfo['warehouse_cd']) }}" data-ac="warehouse" />
                        <img class="vector" id="img_warehouse" src="/img/icon/vector.svg"
                            data-smm-open="search_warehouse_modal" />
                    </div>
                    <div class="textbox td_200px txt_blue" id="warehouse_name">{{ $initWarehouseInfo['warehouse_name'] }}
                    </div>
                    <input type="hidden" id="hidden_warehouse" value="" name="hidden_warehouse" />
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">商品コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="item_code_start" id="input_item_code_start" class="element"
                            minlength="0" maxlength="9" size="9" value="{{ old('item_code_start') }}"
                            data-ac="item_code" />
                        <img class="vector" id="img_item_code_start" src="/img/icon/vector.svg"
                            data-smm-open="search_item_cd_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="item_code_end" id="input_item_code_end" class="element" minlength="0"
                            maxlength="9" size="9" value="{{ old('item_code_end') }}" />
                        <img class="vector" id="img_item_code_end" src="/img/icon/vector.svg"
                            data-smm-open="search_item_cd_modal" />
                    </div>
                </div>
                <input type="hidden" id="hidden_item_code_start" value="" name="hidden_item_code_start" />
                <input type="hidden" id="hidden_item_code_end" value="" name="hidden_item_code_end" />
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">カラーコード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="color_code_start" id="input_color1" class="element" minlength="0"
                            maxlength="5" size="5" value="{{ old('color_code_start', '') }}" />
                        <img class="vector" id="img_color1" src="/img/icon/vector.svg"
                            data-smm-open="search_color_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="color_code_end" id="input_color2" class="element" minlength="0"
                            maxlength="5" size="5" value="{{ old('color_code_end', '') }}" />
                        <img class="vector" id="img_color2" src="/img/icon/vector.svg"
                            data-smm-open="search_color_modal" />
                    </div>
                    <input type="hidden" id="hidden_color1" value="" name="hidden_color1" />
                    <input type="hidden" id="hidden_color2" value="" name="hidden_color2" />
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">サイズコード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="size_code_start" id="input_size1" class="element" minlength="0"
                            maxlength="5" size="5" value="{{ old('size_code_start', '') }}" />
                        <img class="vector" id="img_size1" src="/img/icon/vector.svg"
                            data-smm-open="search_size_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="size_code_end" id="input_size2" class="element" minlength="0"
                            maxlength="5" size="5" value="{{ old('size_code_end', '') }}" />
                        <img class="vector" id="img_size2" src="/img/icon/vector.svg"
                            data-smm-open="search_size_modal" />
                    </div>
                    <input type="hidden" id="hidden_size1" value="" name="hidden_size1" />
                    <input type="hidden" id="hidden_size2" value="" name="hidden_size2" />
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">棚番1範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="shelf_number_code1_start" id="shelf_number_code1_start"
                            class="element" minlength="0" maxlength="10" size="10"
                            value="{{ old('shelf_number_code1_start') }}" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="shelf_number_code1_end" id="shelf_number_code1_end" class="element"
                            minlength="0" maxlength="10" size="10" value="{{ old('shelf_number_code1_end') }}" />
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">棚番2範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="shelf_number_code2_start" id="shelf_number_code2_start"
                            class="element" minlength="0" maxlength="10" size="10"
                            value="{{ old('shelf_number_code2_start') }}" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="shelf_number_code2_end" id="shelf_number_code2_end" class="element"
                            minlength="0" maxlength="10" size="10" value="{{ old('shelf_number_code2_end') }}" />
                    </div>
                </div>
            </div>
        </div>
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.master.search.warehouse', ['warehouseData' => $warehouseData])
    @include('admin.master.search.item_cd', ['itemData' => $itemData])
    @include('admin.master.search.color', ['colorData' => $colorData])
    @include('admin.master.search.size', ['sizeData' => $sizeData])
    @include('admin.master.search.brand1', ['brand1Data' => $brand1Data])
    @include('admin.master.search.game_category', ['itemClassThing2Data' => $itemClassThing2Data])
    @include('admin.master.search.genre', ['genreData' => $genreData])
    @include('admin.master.search.item_class_thing4', ['itemClassThing4Data' => $itemClassThing4Data])
    @include('admin.master.search.item_class_thing5', ['itemClassThing5Data' => $itemClassThing5Data])
    @include('admin.master.search.item_class_thing6', ['itemClassThing6Data' => $itemClassThing6Data])
    @include('admin.master.search.item_class_thing7', ['itemClassThing7Data' => $itemClassThing7Data])
@endsection
