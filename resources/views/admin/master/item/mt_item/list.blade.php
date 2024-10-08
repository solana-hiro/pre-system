@extends('layouts.admin.app')
@section('page_title', '商品リスト（一覧）')
@section('title', '商品リスト（一覧）')
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
    <form role="search" action="{{ route('master.item.mt_item.export') }}" method="post">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button class="button" type="submit" name="cancel" onclick="this.form.target='_self'">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="sku" onclick="this.form.target='_self'">
                        <div class="text_wrapper_2">取込原本（SKU）へ出力</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="item_cd" onclick="this.form.target='_self'">
                        <div class="text_wrapper_2">取込原本（品番）へ出力</div>
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
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">ブランド1コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="item_class1_start" id="input_item_class1_start" class="element"
                            minlength="0" maxlength="6" size="6" value="" />
                        <img class="vector" id="img_item_class1_start" src="/img/icon/vector.svg"
                            data-smm-open="search_brand1_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="item_class1_end" id="input_item_class1_end" class="element"
                            minlength="0" maxlength="6" size="6" value="" />
                        <img class="vector" id="img_item_class1_end" src="/img/icon/vector.svg"
                            data-smm-open="search_brand1_modal" />
                    </div>
                </div>
                <input type="hidden" id="hidden_item_class1_start" value="" name="hidden_item_class1_start" />
                <input type="hidden" id="hidden_item_class1_end" value="" name="hidden_item_class1_end" />
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">競技・カテゴリコード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="item_class2_start" id="input_item_class2_start" class="element"
                            minlength="0" maxlength="6" size="6" value="" />
                        <img class="vector" id="img_item_class2_start" src="/img/icon/vector.svg"
                            data-smm-open="search_game_category_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="item_class2_end" id="input_item_class2_end" class="element"
                            minlength="0" maxlength="6" size="6" value="" />
                        <img class="vector" id="img_item_class2_end" src="/img/icon/vector.svg"
                            data-smm-open="search_game_category_modal" />
                    </div>
                </div>
                <input type="hidden" id="hidden_item_class2_start" value="" name="hidden_item_class2_start" />
                <input type="hidden" id="hidden_item_class2_end" value="" name="hidden_item_class2_end" />
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">ジャンルコード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="item_class3_start" id="input_item_class3_start" class="element"
                            minlength="0" maxlength="6" size="6" value="" />
                        <img class="vector" id="img_item_class3_start" src="/img/icon/vector.svg"
                            data-smm-open="search_genre_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="item_class3_end" id="input_item_class3_end" class="element"
                            minlength="0" maxlength="6" size="6" value="" />
                        <img class="vector" id="img_item_class3_end" src="/img/icon/vector.svg"
                            data-smm-open="search_genre_modal" />
                    </div>
                </div>
                <input type="hidden" id="hidden_item_class3_start" value="" name="hidden_item_class3_start" />
                <input type="hidden" id="hidden_item_class3_end" value="" name="hidden_item_class3_end" />
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">販売開始年コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="item_class4_start" id="input_item_class4_start" class="element"
                            minlength="0" maxlength="6" size="6" value="" />
                        <img class="vector" id="img_item_class4_start" src="/img/icon/vector.svg"
                            data-smm-open="search_item_class_thing4_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="item_class4_end" id="input_item_class4_end" class="element"
                            minlength="0" maxlength="6" size="6" value="" />
                        <img class="vector" id="img_item_class4_end" src="/img/icon/vector.svg"
                            data-smm-open="search_item_class_thing4_modal" />
                    </div>
                </div>
                <input type="hidden" id="hidden_item_class4_start" value="" name="hidden_item_class4_start" />
                <input type="hidden" id="hidden_item_class4_end" value="" name="hidden_item_class4_end" />
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">工場分類5コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="item_class5_start" id="input_item_class5_start" class="element"
                            minlength="0" maxlength="6" size="6" value="" />
                        <img class="vector" id="img_item_class5_start" src="/img/icon/vector.svg"
                            data-smm-open="search_item_class_thing5_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="item_class5_end" id="input_item_class5_end" class="element"
                            minlength="0" maxlength="6" size="6" value="" />
                        <img class="vector" id="img_item_class5_end" src="/img/icon/vector.svg"
                            data-smm-open="search_item_class_thing5_modal" />
                    </div>
                </div>
                <input type="hidden" id="hidden_item_class5_start" value="" name="hidden_item_class5_start" />
                <input type="hidden" id="hidden_item_class5_end" value="" name="hidden_item_class5_end" />
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">製品/工賃6コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="item_class6_start" id="input_item_class6_start" class="element"
                            minlength="0" maxlength="6" size="6" value="" />
                        <img class="vector" id="img_item_class6_start" src="/img/icon/vector.svg"
                            data-smm-open="search_item_class_thing6_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="item_class6_end" id="input_item_class6_end" class="element"
                            minlength="0" maxlength="6" size="6" value="" />
                        <img class="vector" id="img_item_class6_end" src="/img/icon/vector.svg"
                            data-smm-open="search_item_class_thing6_modal" />
                    </div>
                </div>
                <input type="hidden" id="hidden_item_class6_start" value="" name="hidden_item_class6_start" />
                <input type="hidden" id="hidden_item_class6_end" value="" name="hidden_item_class6_end" />
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">資産在庫JAコード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="item_class7_start" id="input_item_class7_start" class="element"
                            minlength="0" maxlength="6" size="6" value="" />
                        <img class="vector" id="img_item_class7_start" src="/img/icon/vector.svg"
                            data-smm-open="search_item_class_thing7_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="item_class7_end" id="input_item_class7_end" class="element"
                            minlength="0" maxlength="6" size="6" value="" />
                        <img class="vector" id="img_item_class7_end" src="/img/icon/vector.svg"
                            data-smm-open="search_item_class_thing7_modal" />
                    </div>
                    <input type="hidden" id="hidden_item_class7_start" value=""
                        name="hidden_item_class7_start" />
                    <input type="hidden" id="hidden_item_class7_end" value="" name="hidden_item_class7_end" />
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">商品コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="item_cd_start" id="input_item_cd_start" class="element"
                            minlength="0" maxlength="9" size="9" />
                        <img class="vector" id="img_item_cd_start" src="/img/icon/vector.svg"
                            data-smm-open="search_item_cd_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="item_cd_end" id="input_item_cd_end" class="element" minlength="0"
                            maxlength="9" size="9" />
                        <img class="vector" id="img_item_cd_end" src="/img/icon/vector.svg"
                            data-smm-open="search_item_cd_modal" />
                    </div>
                </div>
                <input type="hidden" id="hidden_item_cd_start" value="" name="hidden_item_cd_start" />
                <input type="hidden" id="hidden_item_cd_end" value="" name="hidden_item_cd_end" />
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">他品番範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="other_part_number_start" id="other_part_number_start"
                            class="element" minlength="0" maxlength="20" size="20" value="" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="other_part_number_end" id="other_part_number_end" class="element"
                            minlength="0" maxlength="20" size="20" value="" />
                    </div>
                </div>
                </di>
            </div>
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.master.search.brand1')
    @include('admin.master.search.game_category')
    @include('admin.master.search.genre')
    @include('admin.master.search.item_class_thing4')
    @include('admin.master.search.item_class_thing5')
    @include('admin.master.search.item_class_thing6')
    @include('admin.master.search.item_class_thing7')
    @include('admin.master.search.item_cd')

    <script>
        const inputBox1 = document.getElementById("input_item_cd_start");
        const outputBox1 = document.getElementById("input_item_cd_end");
        const inputBox2 = document.getElementById("input_item_class1_start");
        const outputBox2 = document.getElementById("input_item_class1_end");
        const inputBox3 = document.getElementById("input_item_class2_start");
        const outputBox3 = document.getElementById("input_item_class2_end");
        const inputBox4 = document.getElementById("input_item_class3_start");
        const outputBox4 = document.getElementById("input_item_class3_end");
        const inputBox5 = document.getElementById("input_item_class4_start");
        const outputBox5 = document.getElementById("input_item_class4_end");
        const inputBox6 = document.getElementById("input_item_class5_start");
        const outputBox6 = document.getElementById("input_item_class5_end");
        const inputBox7 = document.getElementById("input_item_class6_start");
        const outputBox7 = document.getElementById("input_item_class6_end");
        const inputBox8 = document.getElementById("input_item_class7_start");
        const outputBox8 = document.getElementById("input_item_class7_end");
        const inputBox9 = document.getElementById("other_part_number_start");
        const outputBox9 = document.getElementById("other_part_number_end");
        inputBox1.onblur = function() {
            if ("" === outputBox1.value) {
                outputBox1.value = inputBox1.value;
            }
        };
    </script>
@endsection
