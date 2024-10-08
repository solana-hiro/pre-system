@extends('layouts.admin.app')
@section('page_title', '棚卸更新処理')
@section('title', '棚卸更新処理')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('stock_management.inventory.update.execute') }}" method="post"
        name="mtItemClassListForm">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button class="button" type="submit" name="cancel">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button class="button-2" type="submit" name="execute">
                        <div class="text_wrapper_3">実行する</div>
                    </button>
                </div>
            </div>

            <div class="box">
                <div class="element-form element-form-rows">
                    <div class="group">
                        <div class="element">
                            <div class="text_wrapper">処理区分</div>
                            <div class="frame">
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="kbn" value="0" checked />
                                        更新
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="kbn" value="1" />
                                        更新取消
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="kbn" value="2" />
                                        棚卸計上データの削除
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <img class="vector tooltip" id="info" src="/img/icon/info.svg">
                    </div>
                </div><br>
                <div class="element-form element-form-rows">
                    <div class="text_wrapper label">更新者</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="user_cd" class="element" minlength="0" maxlength="4"
                                size="6" />
                            <img class="vector" src="/img/icon/vector.svg" />
                        </div>
                        <div class="textbox td_200px">
                        </div>
                    </div>
                </div><br>
                <div class="element-form element-form-rows">
                    <div class="text_wrapper label">今回棚卸日付</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="now_date_year" class="element textbox_40px" minlength="0"
                                maxlength="4" value="">年
                            <input type="text" name="now_date_month" class="element textbox_24px" minlength="0"
                                maxlength="2" value="">月
                            <input type="text" name="now_date_day" class="element textbox_24px" minlength="0"
                                maxlength="2" value="">日
                            <img src="/img/icon/calender.svg">
                        </div>
                    </div>
                </div><br>
                <div class="element-form element-form-rows">
                    <div class="text_wrapper label">実施棚卸日付</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="implementation_inventory_date_year" class="element textbox_40px"
                                minlength="0" maxlength="4" value="">年
                            <input type="text" name="implementation_inventory_date_month" class="element textbox_24px"
                                minlength="0" maxlength="2" value="">月
                            <input type="text" name="implementation_inventory_date_day" class="element textbox_24px"
                                minlength="0" maxlength="2" value="">日
                            <img src="/img/icon/calender.svg">
                        </div>
                    </div>
                </div><br>
                <div class="element-form">
                    <div class="text_wrapper">倉庫コード範囲</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="start_warehouse_code" id="input_warehouse_start" class="element"
                                minlength="0" maxlength="6" size="6" value="" />
                            <img class="vector" id="img_warehouse_start" src="/img/icon/vector.svg"
                                data-smm-open="search_warehouse_modal" />
                        </div>
                        <div class="text_wrapper">～</div>
                        <div class="textbox">
                            <input type="text" ame="end_warehouse_code" id="input_warehouse_end" class="element"
                                minlength="0" maxlength="6" size="6" value="" />
                            <img class="vector" id="img_warehouse_end" src="/img/icon/vector.svg"
                                data-smm-open="search_warehouse_modal" />
                        </div>
                        <input type="hidden" id="hidden_warehouse_start" value=""
                            name="hidden_warehouse_start" />
                        <input type="hidden" id="hidden_warehouse_end" value="" name="hidden_warehouse_end" />
                    </div>
                </div><br><br>
                <div class="group">
                    <div class="element">
                        <div class="text_wrapper">対象商品分類</div>
                        <div class="frame">
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_1" name="item_class"
                                        onclick="itemClassListClick()" value="1" checked />
                                    ブランド1
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_2" name="item_class"
                                        onclick="itemClassListClick()" value="2" />
                                    競技・カテゴリ
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_3" name="item_class"
                                        onclick="itemClassListClick()" value="3" />
                                    ジャンル
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_4" name="item_class"
                                        onclick="itemClassListClick()" value="4" />
                                    販売開始年
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_5" name="item_class"
                                        onclick="itemClassListClick()" value="5" />
                                    工場分類5
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_6" name="item_class"
                                        onclick="itemClassListClick()" value="6" />
                                    製品/工賃6
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="item_class_id_7" name="item_class"
                                        onclick="itemClassListClick()" value="7" />
                                    資産在庫JA
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="element-form" id="item_class_1">
                <div class="text_wrapper label">ブランド1コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="code1_start" id="input_code1_start" class="element" minlength="0"
                            maxlength="6" size="6" value="" />
                        <img class="vector" id="img_code1_start" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_brand1_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="code1_end" id="input_code1_end" class="element" minlength="0"
                            maxlength="6" size="6" value="" />
                        <img class="vector" id="img_code1_end" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_brand1_modal" />
                    </div>
                </div>
            </div>
            <div class="element-form" id="item_class_2" style="display:none;">
                <div class="text_wrapper label">競技・カテゴリコード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="code2_start" id="input_code2_start" class="element" minlength="0"
                            maxlength="6" size="6" value="" />
                        <img class="vector" id="img_code2_start" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_game_category_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="code2_end" id="input_code2_end" class="element" minlength="0"
                            maxlength="6" size="6" value="" />
                        <img class="vector" id="img_code2_end" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_game_category_modal" />
                    </div>
                </div>
            </div>
            <div class="element-form" id="item_class_3" style="display:none;">
                <div class="text_wrapper label">ジャンルコード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="code3_start" id="input_code3_start" class="element" minlength="0"
                            maxlength="6" size="6" value="" />
                        <img class="vector" id="img_code3_start" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_genre_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="code3_end" id="input_code3_end" class="element" minlength="0"
                            maxlength="6" size="6" value="" />
                        <img class="vector" id="img_code3_end" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_genre_modal" />
                    </div>
                </div>
            </div>
            <div class="element-form" id="item_class_4" style="display:none;">
                <div class="text_wrapper label">販売開始年コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="code4_start" id="input_code4_start" class="element" minlength="0"
                            maxlength="6" size="6" value="" />
                        <img class="vector" id="img_code4_start" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_item_class_thing4_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="code4_end" id="input_code4_end" class="element" minlength="0"
                            maxlength="6" size="6" value="" />
                        <img class="vector" id="img_code4_end" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_item_class_thing4_modal" />
                    </div>
                </div>
            </div>
            <div class="element-form" id="item_class_5" style="display:none;">
                <div class="text_wrapper label">工場分類５コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="code5_start" id="input_code5_start" class="element" minlength="0"
                            maxlength="6" size="6" value="" />
                        <img class="vector" id="img_code5_start" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_item_class_thing5_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="code5_end" id="input_code5_end" class="element" minlength="0"
                            maxlength="6" size="6" value="" />
                        <img class="vector" id="img_code5_end" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_item_class_thing5_modal" />
                    </div>
                </div>
            </div>
            <div class="element-form" id="item_class_6" style="display:none;">
                <div class="text_wrapper label">製品/工賃6コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="code6_start" id="input_code6_start" class="element" minlength="0"
                            maxlength="6" size="6" value="" />
                        <img class="vector" id="img_code6_start" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_item_class_thing6_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="code6_end" id="input_code6_end" class="element" minlength="0"
                            maxlength="6" size="6" value="" />
                        <img class="vector" id="img_code6_end" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_item_class_thing6_modal" />
                    </div>
                </div>
            </div>
            <div class="element-form" id="item_class_7" style="display:none;">
                <div class="text_wrapper label">資産在庫JAコード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="code7_start" id="input_code7_start" class="element" minlength="0"
                            maxlength="6" size="6" value="" />
                        <img class="vector" id="img_code7_start" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_item_class_thing7_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="code7_end" id="input_code7_end" class="element" minlength="0"
                            maxlength="6" size="6" value="" />
                        <img class="vector" id="img_code7_end" src="{{ asset('/img/icon/vector.svg') }}"
                            data-smm-open="search_item_class_thing7_modal" />
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">商品コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="item_code_start" class="element" minlength="0" maxlength="13"
                            size="13" value="" />
                        <img class="vector" src="/img/icon/vector.svg" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="item_code_end" class="element" minlength="0" maxlength="13"
                            size="13" value="" />
                        <img class="vector" src="/img/icon/vector.svg" />
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
        <input type="hidden" id="hidden_code4_start" value="" name="hidden_code4_start" />
        <input type="hidden" id="hidden_code4_end" value="" name="hidden_code4_end" />
        <input type="hidden" id="hidden_code5_start" value="" name="hidden_code5_start" />
        <input type="hidden" id="hidden_code5_end" value="" name="hidden_code5_end" />
        <input type="hidden" id="hidden_code6_start" value="" name="hidden_code6_start" />
        <input type="hidden" id="hidden_code6_end" value="" name="hidden_code6_end" />
        <input type="hidden" id="hidden_code7_start" value="" name="hidden_code7_start" />
        <input type="hidden" id="hidden_code7_end" value="" name="hidden_code7_end" />

        @include('admin.master.search.brand1', ['brand1Data' => $brand1Data])
        @include('admin.master.search.game_category', ['itemClassThing2Data' => $itemClassThing2Data])
        @include('admin.master.search.genre', ['genreData' => $genreData])
        @include('admin.master.search.item_class_thing4', ['itemClassThing4Data' => $itemClassThing4Data])
        @include('admin.master.search.item_class_thing5', ['itemClassThing5Data' => $itemClassThing5Data])
        @include('admin.master.search.item_class_thing6', ['itemClassThing6Data' => $itemClassThing6Data])
        @include('admin.master.search.item_class_thing7', ['itemClassThing7Data' => $itemClassThing7Data])
        @include('admin.master.search.warehouse', ['warehouseData' => $warehouseData])
        @include('admin.master.search.item_cd', ['itemData' => $itemData])
    </form>
@endsection
