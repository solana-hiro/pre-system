@extends('layouts.admin.app')
@section('page_title', '商品リスト（分類別）')
@section('title', '商品リスト（分類別）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
    <script>
        const laravelResponse = [
            @json(session('_old_input')),
            @json($errors->all()),
            @json(session('sessionErrors'))
        ]; // ListErrorAlert専用
    </script>
@endsection

@section('content')
    <form role="search" action="{{ route('master.item.mt_item.class.export') }}" method="post" name="mtItemByClassListForm">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button class="button" type="submit" name="cancel" onclick="this.form.target='_self'">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="preview" onclick="this.form.target='_blank'">
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
            <div class="box">
                <div class="group">
                    <div class="element">
                        <div class="text_wrapper">対象商品分類</div>
                        <div class="frame">
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_1" name="item_class_id" value="1"
                                        onclick="itemByClassListClick()" @if (old('item_class_id') === '1' || null === old('item_class_id')) checked @endif />
                                    ブランド1
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_2" name="item_class_id" value="2"
                                        onclick="itemByClassListClick()" @if (old('item_class_id') === '2') checked @endif />
                                    競技・カテゴリ
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_3" name="item_class_id" value="3"
                                        onclick="itemByClassListClick()" @if (old('item_class_id') === '3') checked @endif />
                                    ジャンル
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (old('item_class_id') === '2' || old('item_class_id') === '3')
                <div class="element-form element-form-rows" id="item_class_1" style="display:none">
                @else
                    <div class="element-form element-form-rows" id="item_class_1">
            @endif
            <div class="text_wrapper label" id="item_class_name">ブランド1コード範囲</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="item_class_code1_start" id="input_code1_start" class="element"
                        minlength="0" maxlength="6" size="6" value="{{ old('item_class_code1_start', '') }}" />
                    <img class="vector" id="img_code1_start" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_brand1_modal" />
                </div>
                <div class="text_wrapper">～</div>
                <div class="textbox">
                    <input type="text" name="item_class_code1_end" id="input_code1_end" class="element" minlength="0"
                        maxlength="6" size="6" value="{{ old('item_class_code1_end', '') }}" />
                    <img class="vector" id="img_code1_end" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_brand1_modal" />
                </div>
            </div>
        </div>
        @if (old('item_class_id') === '2')
            <div class="element-form element-form-rows" id="item_class_2">
            @else
                <div class="element-form element-form-rows" id="item_class_2" style="display:none;">
        @endif
        <div class="text_wrapper label" id="item_class_name">競技・カテゴリコード範囲</div>
        <div class="frame">
            <div class="textbox">
                <input type="text" name="item_class_code2_start" id="input_code2_start" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('item_class_code2_start', '') }}" />
                <img class="vector" id="img_code2_start" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_game_category_modal" />
            </div>
            <div class="text_wrapper">～</div>
            <div class="textbox">
                <input type="text" name="item_class_code2_end" id="input_code2_end" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('item_class_code2_end', '') }}" />
                <img class="vector" id="img_code2_end" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_game_category_modal" />
            </div>
        </div>
        </div>
        @if (old('item_class_id') === '3')
            <div class="element-form element-form-rows" id="item_class_3">
            @else
                <div class="element-form element-form-rows" id="item_class_3" style="display:none;">
        @endif
        <div class="text_wrapper label" id="item_class_name">ジャンルコード範囲</div>
        <div class="frame">
            <div class="textbox">
                <input type="text" name="item_class_code3_start" id="input_code3_start" class="element"
                    minlength="0" maxlength="6" size="6" value="{{ old('item_class_code3_start', '') }}" />
                <img class="vector" id="img_code3_start" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_genre_modal" />
            </div>
            <div class="text_wrapper">～</div>
            <div class="textbox">
                <input type="text" name="item_class_code3_end" id="input_code3_end" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('item_class_code3_end', '') }}" />
                <img class="vector" id="img_code3_end" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_genre_modal" />
            </div>
        </div>
        </div><br>
        <div class="element-form element-form-rows">
            <div class="text_wrapper label">商品コード範囲</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="item_code_start" id="input_item_code_start" class="element"
                        minlength="0" maxlength="9" size="9" value="{{ old('item_code_start') }}" />
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
        </div>
        </div>
        <input type="hidden" id="hidden_code1_start" value="" name="hidden_code1_start" />
        <input type="hidden" id="hidden_code1_end" value="" name="hidden_code1_end" />
        <input type="hidden" id="hidden_code2_start" value="" name="hidden_code2_start" />
        <input type="hidden" id="hidden_code2_end" value="" name="hidden_code2_end" />
        <input type="hidden" id="hidden_code3_start" value="" name="hidden_code3_start" />
        <input type="hidden" id="hidden_code3_end" value="" name="hidden_code3_end" />
        <input type="hidden" id="hidden_item_code_start" value="" name="hidden_item_code_start" />
        <input type="hidden" id="hidden_item_code_end" value="" name="hidden_item_code_end" />
        @include('admin.master.search.brand1')
        @include('admin.master.search.game_category')
        @include('admin.master.search.genre')
        @include('admin.master.search.item_cd')
        @include('admin.master.search.item_class_thing4')
        @include('admin.master.search.item_class_thing5')
        @include('admin.master.search.item_class_thing6')
        @include('admin.master.search.item_class_thing7')
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    <script>
        const inputBox1 = document.getElementById("input_item_code_start");
        const outputBox1 = document.getElementById("input_item_code_end");
        const inputBox2 = document.getElementById("input_code1_start");
        const outputBox2 = document.getElementById("input_code1_end");
        const inputBox3 = document.getElementById("input_code2_start");
        const outputBox3 = document.getElementById("input_code2_end");
        const inputBox4 = document.getElementById("input_code3_start");
        const outputBox4 = document.getElementById("input_code3_end");
        inputBox1.onblur = function() {
            if ("" === outputBox1.value) {
                outputBox1.value = inputBox1.value;
            }
        };
        // outputBox1.onblur = function () {
        //     if("" !== outputBox1.value) {
        //         outputBox1.value = outputBox1.value.toString().padStart(9, '0');
        //     }
        // };
        // inputBox2.onblur = function () {
        //     if("" !== inputBox2.value) {
        //         inputBox2.value = inputBox2.value.toString().padStart(6, '0');
        //     }
        // };
        // outputBox2.onblur = function () {
        //     if("" !== outputBox2.value) {
        //         outputBox2.value = outputBox2.value.toString().padStart(6, '0');
        //     }
        // };
        // inputBox3.onblur = function () {
        //     if("" !== inputBox3.value) {
        //         inputBox3.value = inputBox3.value.toString().padStart(6, '0');
        //     }
        // };
        //  outputBox3.onblur = function () {
        //     if("" !== outputBox3.value) {
        //         outputBox3.value = outputBox3.value.toString().padStart(6, '0');
        //     }
        // };
        // inputBox4.onblur = function () {
        //     if("" !== inputBox4.value) {
        //         inputBox4.value = inputBox4.value.toString().padStart(6, '0');
        //     }
        // };
        //  outputBox4.onblur = function () {
        //     if("" !== outputBox4.value) {
        //         outputBox4.value = outputBox4.value.toString().padStart(6, '0');
        //     }
        // };
    </script>
@endsection
