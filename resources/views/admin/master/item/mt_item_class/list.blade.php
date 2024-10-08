@extends('layouts.admin.app')
@section('page_title', '商品分類リスト（一覧）')
@section('title', '商品分類リスト（一覧）')
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
    <div class="main-area">
        <form role="search" action="{{ route('master.item.mt_item_class.export') }}" method="post" name="mtItemClassListForm">
            @csrf
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
                                        onclick="itemClassListClick()" @if (old('item_class_id') === '1' || null === old('item_class_id')) checked @endif />
                                    ブランド1
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_2" name="item_class_id" value="2"
                                        onclick="itemClassListClick()" @if (old('item_class_id') === '2') checked @endif />
                                    競技・カテゴリ
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_3" name="item_class_id" value="3"
                                        onclick="itemClassListClick()" @if (old('item_class_id') === '3') checked @endif />
                                    ジャンル
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_4" name="item_class_id" value="4"
                                        onclick="itemClassListClick()" @if (old('item_class_id') === '4') checked @endif />
                                    販売開始年
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_5" name="item_class_id" value="5"
                                        onclick="itemClassListClick()" @if (old('item_class_id') === '5') checked @endif />
                                    工場分類５
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_6" name="item_class_id" value="6"
                                        onclick="itemClassListClick()" @if (old('item_class_id') === '6') checked @endif />
                                    製品/工賃6
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_7" name="item_class_id" value="7"
                                        onclick="itemClassListClick()" @if (old('item_class_id') === '7') checked @endif />
                                    資産在庫JA
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (old('item_class_id') === '2' ||
                    old('item_class_id') === '3' ||
                    old('item_class_id') === '4' ||
                    old('item_class_id') === '5' ||
                    old('item_class_id') === '6' ||
                    old('item_class_id') === '7')
                <div class="element-form" id="item_class_1" style="display:none;">
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
    @if (old('item_class_id') === '2')
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
            <input type="text" name="code2_end" id="input_code2_end" class="element" minlength="0" maxlength="6"
                size="6" value="{{ old('code2_end', '') }}" />
            <img class="vector" id="img_code2_end" src="{{ asset('/img/icon/vector.svg') }}"
                data-smm-open="search_game_category_modal" />
        </div>
    </div>
    </div>
    @if (old('item_class_id') === '3')
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
            <input type="text" name="code3_end" id="input_code3_end" class="element" minlength="0" maxlength="6"
                size="6" value="{{ old('code3_end', '') }}" />
            <img class="vector" id="img_code3_end" src="{{ asset('/img/icon/vector.svg') }}"
                data-smm-open="search_genre_modal" />
        </div>
    </div>
    </div>
    @if (old('item_class_id') === '4')
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
            <input type="text" name="code4_end" id="input_code4_end" class="element" minlength="0" maxlength="6"
                size="6" value="{{ old('code4_end', '') }}" />
            <img class="vector" id="img_code4_end" src="{{ asset('/img/icon/vector.svg') }}"
                data-smm-open="search_item_class_thing4_modal" />
        </div>
    </div>
    </div>
    @if (old('item_class_id') === '5')
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
            <input type="text" name="code5_end" id="input_code5_end" class="element" minlength="0" maxlength="6"
                size="6" value="{{ old('code5_end', '') }}" />
            <img class="vector" id="img_code5_end" src="{{ asset('/img/icon/vector.svg') }}"
                data-smm-open="search_item_class_thing5_modal" />
        </div>
    </div>
    </div>
    @if (old('item_class_id') === '6')
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
            <input type="text" name="code6_end" id="input_code6_end" class="element" minlength="0" maxlength="6"
                size="6" value="{{ old('code6_start', '') }}" />
            <img class="vector" id="img_code6_end" src="{{ asset('/img/icon/vector.svg') }}"
                data-smm-open="search_item_class_thing6_modal" />
        </div>
    </div>
    </div>
    @if (old('item_class_id') === '7')
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
            <input type="text" name="code7_end" id="input_code7_end" class="element" minlength="0" maxlength="6"
                size="6" value="{{ old('code7_end', '') }}" />
            <img class="vector" id="img_code7_end" src="{{ asset('/img/icon/vector.svg') }}"
                data-smm-open="search_item_class_thing7_modal" />
        </div>
    </div>
    </div>
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
    @include('components.menu.selected', ['view' => 'main'])
    </form>
    </div>
    <script>
        const inputBox1 = document.getElementById("input_code1_start");
        const outputBox1 = document.getElementById("input_code1_end");
        const inputBox2 = document.getElementById("input_code2_start");
        const outputBox2 = document.getElementById("input_code2_end");
        const inputBox3 = document.getElementById("input_code3_start");
        const outputBox3 = document.getElementById("input_code3_end");
        const inputBox4 = document.getElementById("input_code4_start");
        const outputBox4 = document.getElementById("input_code4_end");
        const inputBox5 = document.getElementById("input_code5_start");
        const outputBox5 = document.getElementById("input_code5_end");
        const inputBox6 = document.getElementById("input_code6_start");
        const outputBox6 = document.getElementById("input_code6_end");
        const inputBox7 = document.getElementById("input_code7_start");
        const outputBox7 = document.getElementById("input_code7_end");
        inputBox1.onblur = function() {
            // if ("" !== inputBox1.value) {
            //     inputBox1.value = inputBox1.value.toString().padStart(6, '0');
            // }
        };
        outputBox1.onblur = function() {
            // if ("" !== outputBox1.value) {
            //     outputBox1.value = outputBox1.value.toString().padStart(6, '0');
            // }
        };
        inputBox2.onblur = function() {
            // if ("" !== inputBox2.value) {
            //     inputBox2.value = inputBox2.value.toString().padStart(6, '0');
            // }
        };
        outputBox2.onblur = function() {
            // if ("" !== outputBox2.value) {
            //     outputBox2.value = outputBox2.value.toString().padStart(6, '0');
            // }
        };
        inputBox3.onblur = function() {
            // if ("" !== inputBox3.value) {
            //     inputBox3.value = inputBox3.value.toString().padStart(6, '0');
            // }
        };
        outputBox3.onblur = function() {
            // if ("" !== outputBox3.value) {
            //     outputBox3.value = outputBox3.value.toString().padStart(6, '0');
            // }
        };
        inputBox4.onblur = function() {
            // if ("" !== inputBox4.value) {
            //     inputBox4.value = inputBox4.value.toString().padStart(6, '0');
            // }
        };
        outputBox4.onblur = function() {
            // if ("" !== outputBox4.value) {
            //     outputBox4.value = outputBox4.value.toString().padStart(6, '0');
            // }
        };
        inputBox5.onblur = function() {
            // if ("" !== inputBox5.value) {
            //     inputBox5.value = inputBox5.value.toString().padStart(6, '0');
            // }
        };
        outputBox5.onblur = function() {
            //     if ("" !== outputBox5.value) {
            //         outputBox5.value = outputBox5.value.toString().padStart(6, '0');
            //     }
        };
        inputBox6.onblur = function() {
            // if ("" !== inputBox6.value) {
            //     inputBox6.value = inputBox6.value.toString().padStart(6, '0');
            // }
        };
        outputBox6.onblur = function() {
            // if ("" !== outputBox6.value) {
            //     outputBox6.value = outputBox6.value.toString().padStart(6, '0');
            // }
        };
        inputBox7.onblur = function() {
            // if ("" !== inputBox7.value) {
            //     inputBox7.value = inputBox7.value.toString().padStart(6, '0');
            // }
        };
        outputBox7.onblur = function() {
            // if ("" !== outputBox7.value) {
            //     outputBox7.value = outputBox7.value.toString().padStart(6, '0');
            // }
        };
    </script>
@endsection
