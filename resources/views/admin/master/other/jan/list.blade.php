@extends('layouts.admin.app')
@section('page_title', 'JANコードマスタ（一覧表）')
@section('title', 'JANコードマスタ（一覧表）')
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
    <form role="search" action="{{ route('master.other.mt_stock_keeping_unit.export') }}" method="post"
        name="mtItemClassListForm">
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
                                    <input type="radio" id="item_class_id_1" name="item_class" value="1"
                                        onClick="itemClassListClick()" @if (old('item_class') === '1' || null === old('item_class')) checked @endif />
                                    ブランド1
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_2" name="item_class"
                                        onClick="itemClassListClick()" value="2"
                                        @if (old('item_class') === '2') checked @endif />
                                    競技・カテゴリ
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_3" name="item_class"
                                        onClick="itemClassListClick()" value="3"
                                        @if (old('item_class') === '3') checked @endif />
                                    ジャンル
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_4" name="item_class"
                                        onClick="itemClassListClick()" value="4"
                                        @if (old('item_class') === '4') checked @endif />
                                    販売開始年
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_5" name="item_class"
                                        onClick="itemClassListClick()" value="5"
                                        @if (old('item_class') === '5') checked @endif />
                                    工場分類５
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_6" name="item_class"
                                        onClick="itemClassListClick()" value="6"
                                        @if (old('item_class') === '6') checked @endif />
                                    製品/工賃6
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_7" name="item_class"
                                        onClick="itemClassListClick()" value="7"
                                        @if (old('item_class') === '7') checked @endif />
                                    資産在庫JA
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (old('item_class') === '2' ||
                    old('item_class') === '3' ||
                    old('item_class') === '4' ||
                    old('item_class') === '5' ||
                    old('item_class') === '6' ||
                    old('item_class') === '7')
                <div class="element-form" id="item_class_1" style="display: none;">
                @else
                    <div class="element-form" id="item_class_1">
            @endif
            <div class="text_wrapper label">ブランド1コード範囲</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="code1_start" id="input_code1_start" class="element" minlength="0"
                        maxlength="6" size="6" value="{{ old('code1_start', '') }}" />
                    <img class="vector" id="img_code1_start" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_brand1_modal" />
                </div>
                <div class="text_wrapper">～</div>
                <div class="textbox">
                    <input type="text" name="code1_end" id="input_code1_end" class="element" minlength="0"
                        maxlength="6" size="6" value="{{ old('code1_end', '') }}" />
                    <img class="vector" id="img_code1_end" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_brand1_modal" />
                </div>
            </div>
        </div>
        @if (old('item_class') === '2')
            <div class="element-form" id="item_class_2">
            @else
                <div class="element-form" id="item_class_2" style="display:none;">
        @endif
        <div class="text_wrapper label">競技・カテゴリコード範囲</div>
        <div class="frame">
            <div class="textbox">
                <input type="text" name="code2_start" id="input_code2_start" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('code2_start', '') }}" />
                <img class="vector" id="img_code2_start" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_game_category_modal" />
            </div>
            <div class="text_wrapper">～</div>
            <div class="textbox">
                <input type="text" name="code2_end" id="input_code2_end" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('code2_end', '') }}" />
                <img class="vector" id="img_code2_end" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_game_category_modal" />
            </div>
        </div>
        </div>
        @if (old('item_class') === '3')
            <div class="element-form" id="item_class_3">
            @else
                <div class="element-form" id="item_class_3" style="display:none;">
        @endif
        <div class="text_wrapper label">ジャンルコード範囲</div>
        <div class="frame">
            <div class="textbox">
                <input type="text" name="code3_start" id="input_code3_start" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('code3_start', '') }}" />
                <img class="vector" id="img_code3_start" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_genre_modal" />
            </div>
            <div class="text_wrapper">～</div>
            <div class="textbox">
                <input type="text" name="code3_end" id="input_code3_end" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('code3_end', '') }}" />
                <img class="vector" id="img_code3_end" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_genre_modal" />
            </div>
        </div>
        </div>
        @if (old('item_class') === '4')
            <div class="element-form" id="item_class_4">
            @else
                <div class="element-form" id="item_class_4" style="display:none;">
        @endif
        <div class="text_wrapper label">販売開始年コード範囲</div>
        <div class="frame">
            <div class="textbox">
                <input type="text" name="code4_start" id="input_code4_start" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('code4_start', '') }}" />
                <img class="vector" id="img_code4_start" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_item_class_thing4_modal" />
            </div>
            <div class="text_wrapper">～</div>
            <div class="textbox">
                <input type="text" name="code4_end" id="input_code4_end" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('code4_end', '') }}" />
                <img class="vector" id="img_code4_end" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_item_class_thing4_modal" />
            </div>
        </div>
        </div>
        @if (old('item_class') === '5')
            <div class="element-form" id="item_class_5">
            @else
                <div class="element-form" id="item_class_5" style="display:none;">
        @endif
        <div class="text_wrapper label">工場分類５コード範囲</div>
        <div class="frame">
            <div class="textbox">
                <input type="text" name="code5_start" id="input_code5_start" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('code5_start', '') }}" />
                <img class="vector" id="img_code5_start" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_item_class_thing5_modal" />
            </div>
            <div class="text_wrapper">～</div>
            <div class="textbox">
                <input type="text" name="code5_end" id="input_code5_end" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('code5_end', '') }}" />
                <img class="vector" id="img_code5_end" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_item_class_thing5_modal" />
            </div>
        </div>
        </div>
        @if (old('item_class') === '6')
            <div class="element-form" id="item_class_6">
            @else
                <div class="element-form" id="item_class_6" style="display:none;">
        @endif
        <div class="text_wrapper label">製品/工賃6コード範囲</div>
        <div class="frame">
            <div class="textbox">
                <input type="text" name="code6_start" id="input_code6_start" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('code6_start', '') }}" />
                <img class="vector" id="img_code6_start" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_item_class_thing6_modal" />
            </div>
            <div class="text_wrapper">～</div>
            <div class="textbox">
                <input type="text" name="code6_end" id="input_code6_end" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('code6_end', '') }}" />
                <img class="vector" id="img_code6_end" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_item_class_thing6_modal" />
            </div>
        </div>
        </div>
        @if (old('item_class') === '7')
            <div class="element-form" id="item_class_7">
            @else
                <div class="element-form" id="item_class_7" style="display:none;">
        @endif
        <div class="text_wrapper label">資産在庫JAコード範囲</div>
        <div class="frame">
            <div class="textbox">
                <input type="text" name="code7_start" id="input_code7_start" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('code7_start', '') }}" />
                <img class="vector" id="img_code7_start" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_item_class_thing7_modal" />
            </div>
            <div class="text_wrapper">～</div>
            <div class="textbox">
                <input type="text" name="code7_end" id="input_code7_end" class="element" minlength="0"
                    maxlength="6" size="6" value="{{ old('code7_end', '') }}" />
                <img class="vector" id="img_code7_end" src="{{ asset('/img/icon/vector.svg') }}"
                    data-smm-open="search_item_class_thing7_modal" />
            </div>
        </div>
        </div><br>
        <div class="element-form element-form-rows">
            <div class="text_wrapper label">商品コード範囲</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="item_cd_start" id="input_item_cd_start" class="element" minlength="0"
                        maxlength="9" size="9" value="{{ old('item_cd_start') }}" />
                    <img class="vector" id="img_item_cd_start" src="/img/icon/vector.svg"
                        data-smm-open="search_item_cd_modal" />
                </div>
                <div class="text_wrapper">～</div>
                <div class="textbox">
                    <input type="text" name="item_cd_end" id="input_item_cd_end" class="element" minlength="0"
                        maxlength="9" size="9" value="{{ old('item_cd_end') }}" />
                    <img class="vector" id="img_item_cd_end" src="/img/icon/vector.svg"
                        data-smm-open="search_item_cd_modal" />
                </div>
            </div>
            <input type="hidden" id="hidden_item_cd_start" value="" name="hidden_item_cd_start" />
            <input type="hidden" id="hidden_item_cd_end" value="" name="hidden_item_cd_end" />
        </div><br>
        <div class="element-form">
            <div class="text_wrapper">カラーコード範囲</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="color_code_start" id="input_color_code_start" class="element"
                        minlength="0" maxlength="5" size="5" value="{{ old('color_code_start', '') }}" />
                    <img class="vector" id="img_color_code_start" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_color_modal" />
                </div>
                <div class="text_wrapper">～</div>
                <div class="textbox">
                    <input type="text" name="color_code_end" id="input_color_code_end" class="element"
                        minlength="0" maxlength="5" size="5" value="{{ old('color_code_end', '') }}" />
                    <img class="vector" id="img_color_code_end" src="{{ asset('/img/icon/vector.svg') }}"
                        data-smm-open="search_color_modal" />
                </div>
                <input type="hidden" id="hidden_color_code_start" value="" name="hidden_color_code_start" />
                <input type="hidden" id="hidden_color_code_end" value="" name="hidden_color_code_end" />
            </div>
        </div><br>
        <div class="element-form element-form-rows">
            <div class="text_wrapper label">サイズコード範囲</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="size_code_start" id="input_size1" class="element" minlength="0"
                        maxlength="5" size="5" value="{{ old('size_code_start', '') }}" />
                    <img class="vector" id="img_size1" src="/img/icon/vector.svg" data-smm-open="search_size_modal" />
                </div>
                <div class="text_wrapper">～</div>
                <div class="textbox">
                    <input type="text" name="size_code_end" id="input_size2" class="element" minlength="0"
                        maxlength="5" size="5" value="{{ old('size_code_end', '') }}" />
                    <img class="vector" id="img_size2" src="/img/icon/vector.svg" data-smm-open="search_size_modal" />
                </div>
                <input type="hidden" id="hidden_size1" value="" name="hidden_size1" />
                <input type="hidden" id="hidden_size2" value="" name="hidden_size2" />
            </div>
        </div><br>
        <div class="element_inline element-form-rows">
            <div class="text_wrapper">出力区分：</div>
            <div class="frame_inline">
                <div class="div">
                    <label class="text_wrapper_2">
                        <input type="radio" id="" name="output_kbn" value="0"
                            @if (old('output_kbn') === '0' || null === old('output_kbn')) checked @endif />
                        JANあり
                    </label>
                </div>
                <div class="div">
                    <label class="text_wrapper_2">
                        <input type="radio" id="" name="output_kbn" value="1"
                            @if (old('output_kbn') === '1') checked @endif />
                        JANなし
                    </label>
                </div>
                <div class="div">
                    <label class="text_wrapper_2">
                        <input type="radio" id="" name="output_kbn" value="2"
                            @if (old('output_kbn') === '2') checked @endif />
                        すべて
                    </label>
                </div>
            </div>
        </div><br>
        <div class="element-form element-form-rows">
            <div class="text_wrapper label">JANコード範囲</div>
            <div class="frame">
                <div class="textbox">
                    <input type="text" name="jan_code_start" id="jan_code_start" class="element" minlength="0"
                        maxlength="13" size="13" value="{{ old('jan_code_start', '') }}" />
                </div>
                <div class="text_wrapper">～</div>
                <div class="textbox">
                    <input type="text" name="jan_code_end" id="jan_code_end" class="element" minlength="0"
                        maxlength="13" size="13" value="{{ old('jan_code_end', '') }}" />
                </div>
            </div>
        </div>
        </div>
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    <input type="hidden" id="hidden_code1_start" value="" name="hidden_code1_start" />
    <input type="hidden" id="hidden_code1_end" value="" name="hidden_code1_end" />
    <input type="hidden" id="hidden_code2_start" value="" name="hidden_code2_start" />
    <input type="hidden" id="hidden_code2_end" value="" name="hidden_code2_end" />
    <input type="hidden" id="hidden_code3_start" value="" name="hidden_code3_start" />
    <input type="hidden" id="hidden_code3_end" value="" name="hidden_code3_end" />
    <input type="hidden" id="hidden_code4_start" value="" name="hidden_code4_start" />
    <input type="hidden" id="hidden_code4_end" value="" name="hidden_code4_end" />
    <input type="hidden" id="hidden_code5_start" value="" name="hidden_code5_start" />
    <input type="hidden" id="hidden_code5_end" value="" name="hidden_code5_end" />
    <input type="hidden" id="hidden_code6_start" value="" name="hidden_code6_start" />
    <input type="hidden" id="hidden_code6_end" value="" name="hidden_code6_end" />
    <input type="hidden" id="hidden_code7_start" value="" name="hidden_code7_start" />
    <input type="hidden" id="hidden_code7_end" value="" name="hidden_code7_end" />

    @include('admin.master.search.brand1')
    @include('admin.master.search.game_category')
    @include('admin.master.search.genre')
    @include('admin.master.search.item_class_thing4')
    @include('admin.master.search.item_class_thing5')
    @include('admin.master.search.item_class_thing6')
    @include('admin.master.search.item_class_thing7')
    @include('admin.master.search.item_cd')
    @include('admin.master.search.color')
    @include('admin.master.search.size')
    <script>
        const inputBox1 = document.getElementById("input_item_cd_start");
        const outputBox1 = document.getElementById("input_item_cd_end");
        const inputBox2 = document.getElementById("input_code1_start");
        const outputBox2 = document.getElementById("input_code1_end");
        const inputBox3 = document.getElementById("input_code2_start");
        const outputBox3 = document.getElementById("input_code2_end");
        const inputBox4 = document.getElementById("input_code3_start");
        const outputBox4 = document.getElementById("input_code3_end");
        const inputBox5 = document.getElementById("input_code4_start");
        const outputBox5 = document.getElementById("input_code4_end");
        const inputBox6 = document.getElementById("input_code5_start");
        const outputBox6 = document.getElementById("input_code5_end");
        const inputBox7 = document.getElementById("input_code6_start");
        const outputBox7 = document.getElementById("input_code6_end");
        const inputBox8 = document.getElementById("input_code7_start");
        const outputBox8 = document.getElementById("input_code7_end");
        const inputBox9 = document.getElementById("input_color_code_start");
        const outputBox9 = document.getElementById("input_color_code_end");
        const inputBox10 = document.getElementById("input_size1");
        const outputBox10 = document.getElementById("input_size2");
        const inputBox11 = document.getElementById("jan_code_start");
        const outputBox11 = document.getElementById("jan_code_end");
        inputBox1.onblur = function() {
            // if("" !== inputBox1.value) {
            //     inputBox1.value = inputBox1.value.toString().padStart(9, '0');
            // }
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
        // inputBox5.onblur = function () {
        //     if("" !== inputBox5.value) {
        //         inputBox5.value = inputBox5.value.toString().padStart(6, '0');
        //     }
        // };
        //  outputBox5.onblur = function () {
        //     if("" !== outputBox5.value) {
        //         outputBox5.value = outputBox5.value.toString().padStart(6, '0');
        //     }
        // };
        // inputBox6.onblur = function () {
        //     if("" !== inputBox6.value) {
        //         inputBox6.value = inputBox6.value.toString().padStart(6, '0');
        //     }
        // };
        //  outputBox6.onblur = function () {
        //     if("" !== outputBox6.value) {
        //         outputBox6.value = outputBox6.value.toString().padStart(6, '0');
        //     }
        // };
        // inputBox7.onblur = function () {
        //     if("" !== inputBox7.value) {
        //         inputBox7.value = inputBox7.value.toString().padStart(6, '0');
        //     }
        // };
        //  outputBox7.onblur = function () {
        //     if("" !== outputBox7.value) {
        //         outputBox7.value = outputBox7.value.toString().padStart(6, '0');
        //     }
        // };
        // inputBox8.onblur = function () {
        //     if("" !== inputBox8.value) {
        //         inputBox8.value = inputBox8.value.toString().padStart(6, '0');
        //     }
        // };
        //  outputBox8.onblur = function () {
        //     if("" !== outputBox8.value) {
        //         outputBox8.value = outputBox8.value.toString().padStart(6, '0');
        //     }
        // };
        // inputBox9.onblur = function () {
        //     if("" !== inputBox9.value) {
        //         inputBox9.value = inputBox9.value.toString().padStart(5, '0');
        //     }
        // };
        //  outputBox9.onblur = function () {
        //     if("" !== outputBox9.value) {
        //         outputBox9.value = outputBox9.value.toString().padStart(5, '0');
        //     }
        // };
        // inputBox10.onblur = function () {
        //     if("" !== inputBox10.value) {
        //         inputBox10.value = inputBox10.value.toString().padStart(5, '0');
        //     }
        // };
        //  outputBox10.onblur = function () {
        //     if("" !== outputBox10.value) {
        //         outputBox10.value = outputBox10.value.toString().padStart(5, '0');
        //     }
        // };
        // inputBox11.onblur = function () {
        //     if("" !== inputBox11.value) {
        //         inputBox11.value = inputBox11.value.toString().padStart(13, '0');
        //     }
        // };
        //  outputBox11.onblur = function () {
        //     if("" !== outputBox11.value) {
        //         outputBox11.value = outputBox11.value.toString().padStart(13, '0');
        //     }
        // };
    </script>
@endsection
