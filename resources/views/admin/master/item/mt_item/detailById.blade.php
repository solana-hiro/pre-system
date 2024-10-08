@extends('layouts.admin.app')
@section('page_title', '商品入力（詳細）')
@section('title', '商品入力（詳細）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <div class="main_contents">
        <form role="search" action="{{ route('master.item.mt_item.update') }}" method="post" name="mtCustomerClassIndexForm"
            enctype="multipart/form-data">
            @csrf
            <div class="button_area">
                <div class="div">
                    <button class="button" type="submit" name="cancel">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button class="button" type="submit" name="delete" value="{{ $detailData['itemData']['id'] }}">
                        <div class="text_wrapper">削除する</div>
                    </button>
                    @if ($minId < $detailData['itemData']['id'])
                        <button class="button" type="submit" name="prev">
                            <div class="text_wrapper_2">前頁</div>
                        </button>
                    @endif
                    @if ($maxId > $detailData['itemData']['id'])
                        <button class="button" type="submit" name="next">
                            <div class="text_wrapper_2">次頁</div>
                        </button>
                    @endif
                    <button class="button-2" type="submit" name="update">
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
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">商品コード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="item_cd" class="element" id="input_item_cd" minlength="0"
                                maxlength="9" size="9"
                                value="{{ old('item_cd', $detailData['itemData']['item_cd']) }}" />
                            <img class="vector" id="img_item_cd" src="/img/icon/vector.svg"
                                data-smm-open="search_item_cd_modal" />
                        </div>
                        <input type="hidden" id="hidden_item_cd" value="" name="hidden_item_cd" />
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">他品番</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="other_part_number" class="element" minlength="0" maxlength="20"
                                size="20"
                                value="{{ old('other_part_number', $detailData['itemData']['other_part_number']) }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="group">
                    <div class="element-form-rows">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">商品名</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="item_name" class="element" minlength="0" maxlength="40"
                                        size="40"
                                        value="{{ old('item_name', $detailData['itemData']['item_name']) }}" />
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="element-form-rows">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">商品名カナ</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="item_name_kana" class="element" minlength="0"
                                        maxlength="10" size="10"
                                        value="{{ old('item_name_kana', $detailData['itemData']['item_name_kana']) }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">単位</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="unit" class="element" minlength="0" maxlength="4"
                                        size="4" value="{{ old('unit', $detailData['itemData']['unit']) }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">ブランド1コード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="item_class_cd_1" id="input_item_class_cd_1"
                                class="element" minlength="0" maxlength="6" size="6"
                                value="{{ old('mt_item_class1_cd') ?? ($detailData['memberSiteItemData']['item_class1_cd'] ?? '') }}" />
                            <img class="vector" id="img_item_class_cd_1" src="/img/icon/vector.svg"
                                data-smm-open="search_brand1_modal" />
                            <input type="hidden" id="hidden_item_class_cd_1"
                                value="{{ isset($detailData['memberSiteItemData']['mt_item_class1_id']) ? $detailData['memberSiteItemData']['mt_item_class1_id'] : '' }}"
                                name="hidden_mt_item_class1_cd" />
                        </div>
                        <div class="textbox td_200px">
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">競技・カテゴリコード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="item_class_cd_2" id="input_item_class_cd_2"
                                class="element" minlength="0" maxlength="6" size="6"
                                value="{{ old('mt_item_class2_cd') ?? ($detailData['memberSiteItemData']['item_class2_cd'] ?? '') }}" />
                            <img class="vector" id="img_item_class_cd_2" src="/img/icon/vector.svg"
                                data-smm-open="search_game_category_modal" />
                            <input type="hidden" id="hidden_item_class_cd_2"
                                value="{{ isset($detailData['memberSiteItemData']['mt_item_class2_id']) ? $detailData['memberSiteItemData']['mt_item_class2_id'] : '' }}"
                                name="hidden_mt_item_class2_cd" />
                        </div>
                        <div class="textbox td_200px">
                        </div>
                    </div>
                </div>
            </div>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">ジャンルコード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="item_class_cd_3" id="input_item_class_cd_3"
                                class="element" minlength="0" maxlength="6" size="6"
                                value="{{ old('mt_item_class3_cd') ?? ($detailData['memberSiteItemData']['item_class3_cd'] ?? '') }}" />
                            <img class="vector" id="img_item_class_cd_3" src="/img/icon/vector.svg"
                                data-smm-open="search_genre_modal" />
                            <input type="hidden" id="hidden_item_class_cd_3"
                                value="{{ isset($detailData['memberSiteItemData']['mt_item_class3_id']) ? $detailData['memberSiteItemData']['mt_item_class3_id'] : '' }}"
                                name="hidden_mt_item_class3_cd" />
                        </div>
                        <div class="textbox td_200px">
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">販売開始年コード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="item_class_cd_4" id="input_item_class_cd_4"
                                class="element" minlength="0" maxlength="6" size="6"
                                value="{{ old('mt_item_class4_cd') ?? ($detailData['memberSiteItemData']['item_class4_cd'] ?? '') }}" />
                            <img class="vector" id="img_item_class_cd_4" src="/img/icon/vector.svg"
                                data-smm-open="search_item_class_thing4_modal" />
                            <input type="hidden" id="hidden_item_class_cd_4"
                                value="{{ isset($detailData['memberSiteItemData']['mt_item_class4_id']) ? $detailData['memberSiteItemData']['mt_item_class4_id'] : '' }}"
                                name="hidden_mt_item_class4_cd" />
                        </div>
                        <div class="textbox td_200px">
                        </div>
                    </div>
                </div>
            </div><br><br>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">工場分類5コード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="item_class_cd_5" id="input_item_class_cd_5" class="element"
                                minlength="0" maxlength="6" size="6"
                                value="{{ old('item_class_cd_5', $detailData['itemData']['item_class5_cd']) }}" />
                            <img class="vector" id="img_item_class_cd_5" src="/img/icon/vector.svg"
                                data-smm-open="search_item_class_thing5_modal" />
                            <input type="hidden" id="hidden_item_class_cd_5"
                                value="{{ isset($detailData['itemData']['mt_item_class5_id']) ? $detailData['itemData']['mt_item_class5_id'] : '' }}"
                                name="hidden_item_class_cd_5" />
                        </div>
                        <div class="textbox td_200px" id="names_item_class_cd_5">
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">製品/工賃6コード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="item_class_cd_6" id="input_item_class_cd_6" class="element"
                                minlength="0" maxlength="6" size="6"
                                value="{{ old('item_class_cd_6', $detailData['itemData']['item_class6_cd']) }}" />
                            <img class="vector" id="img_item_class_cd_6" src="/img/icon/vector.svg"
                                data-smm-open="search_item_class_thing6_modal" />
                            <input type="hidden" id="hidden_item_class_cd_6"
                                value="{{ isset($detailData['itemData']['mt_item_class6_id']) ? $detailData['itemData']['mt_item_class6_id'] : '' }}"
                                name="hidden_item_class_cd_6" />
                        </div>
                        <div class="textbox td_200px" id="names_item_class_cd_6">
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">資産在庫JAコード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="item_class_cd_7" id="input_item_class_cd_7" class="element"
                                minlength="0" maxlength="6" size="6"
                                value="{{ old('item_class_cd_7', $detailData['itemData']['item_class7_cd']) }}" />
                            <img class="vector" id="img_item_class_cd_7" src="/img/icon/vector.svg"
                                data-smm-open="search_item_class_thing7_modal" />
                            <input type="hidden" id="hidden_item_class_cd_7"
                                value="{{ isset($detailData['itemData']['mt_item_class7_id']) ? $detailData['itemData']['mt_item_class7_id'] : '' }}"
                                name="hidden_item_class_cd_7" />
                        </div>
                        <div class="textbox td_200px" id="names_item_class_cd_7">
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">仕入先コード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="mt_supplier_cd" id="input_mt_supplier_cd" class="element"
                                minlength="0" maxlength="6" size="6"
                                value="{{ old('supplier_cd', $detailData['itemData']['supplier_cd']) }}" />
                            <img class="vector" id="img_mt_supplier_cd" src="/img/icon/vector.svg"
                                data-smm-open="search_supplier_modal" />
                            <input type="hidden" id="hidden_mt_supplier_cd" name="hidden_mt_supplier_cd"
                                value="{{ isset($detailData['itemData']['mt_supplier_id']) ? $detailData['itemData']['mt_supplier_id'] : '' }}" />
                        </div>
                        <div class="textbox td_200px" id="names_mt_supplier_cd">
                        </div>
                    </div>
                </div>
            </div><br><br>
            <div class="element-form" style="align-items: flex-start;">
                <div>
                    <div class="grid">
                        <table class="table_sticky_colors" id="pattern_grid_table">
                            <thead class="grid_header">
                                <tr>
                                    <td colspan="3" class="grid_wrapper_left grid_wrapper_white col7 td_300px"></td>
                                    <td colspan="20" class="grid_wrapper_center col10">
                                        <span class="td_center">サイズ</span>
                                        <div class="search-form" role="search">
                                            <input type="text" name="size_pattern_cd" id="input_size_pattern_cd"
                                                class="search-input" placeholder="サイズパターンから入力する">
                                            <img class="search-button" id="img_size_pattern_cd"
                                                src="/img/icon/vector.svg" data-smm-open="search_size_pattern_modal" />
                                            <input type="hidden" id="hidden_size_pattern_cd" value=""
                                                name="hidden_size_pattern_cd" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" rowspan="2" class="grid_wrapper_center col7 td_300px"></td><br>
                                    <div class="search-form" role="search">
                                        <input type="text" name="color_pattern_cd" id="input_color_pattern_cd"
                                            class="search-input" placeholder="カラーパターンから入力する">
                                        <img class="search-button" id="img_color_pattern_cd" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_pattern_modal" />
                                        <input type="hidden" id="hidden_color_pattern_cd" value=""
                                            name="hidden_color_pattern_cd" />
                                    </div>
                                    </td>
                                    <td class="grid_wrapper_center col8 col_rec_blue td_50px"></td>
                                    <td class="grid_wrapper_center col9 col_rec_blue td_80px"></td>
                                    <td class="grid_wrapper_center col8 col_rec_blue td_50px"></td>
                                    <td class="grid_wrapper_center col9 col_rec_blue td_80px"></td>
                                    <td class="grid_wrapper_center col8 col_rec_blue td_50px"></td>
                                    <td class="grid_wrapper_center col9 col_rec_blue td_80px"></td>
                                    <td class="grid_wrapper_center col8 col_rec_blue td_50px"></td>
                                    <td class="grid_wrapper_center col9 col_rec_blue td_80px"></td>
                                    <td class="grid_wrapper_center col8 col_rec_blue td_50px"></td>
                                    <td class="grid_wrapper_center col9 col_rec_blue td_80px"></td>
                                    <td class="grid_wrapper_center col8 col_rec_blue td_50px"></td>
                                    <td class="grid_wrapper_center col9 col_rec_blue td_80px"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="grid_wrapper_center col8 col_rec_blue td_50px"><input
                                            type="checkbox" class="grid_checkbox"></td>
                                    <td colspan="2" class="grid_wrapper_center col8 col_rec_blue td_50px"><input
                                            type="checkbox" class="grid_checkbox"></td>
                                    <td colspan="2" class="grid_wrapper_center col8 col_rec_blue td_50px"><input
                                            type="checkbox" class="grid_checkbox"></td>
                                    <td colspan="2" class="grid_wrapper_center col8 col_rec_blue td_50px"><input
                                            type="checkbox" class="grid_checkbox"></td>
                                    <td colspan="2" class="grid_wrapper_center col8 col_rec_blue td_50px"><input
                                            type="checkbox" class="grid_checkbox"></td>
                                    <td colspan="2" class="grid_wrapper_center col8 col_rec_blue td_50px"><input
                                            type="checkbox" class="grid_checkbox"></td>
                                </tr>
                            </thead>
                            <tbody class="grid_body">
                                @if (isset($detailData['colorSizeData']) && count($detailData['colorSizeData']) > 0)
                                    @foreach ($detailData['colorSizeData'] as $data)
                                        <tr>
                                            <td class="grid_col_1 col_rec_blue_white td_60px">{{ $data['color_cd'] }}</td>
                                            <td class="grid_col_2 col_rec_blue_white td_180px">{{ $data['color_name'] }}
                                            </td>
                                            <td class="grid_col_2 col_rec_blue_white td_60px"><input type="checkbox"
                                                    class="grid_checkbox"></td>
                                            <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                    class="grid_checkbox" name=""></td>
                                            <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                    class="grid_checkbox" name=""></td>
                                            <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                    class="grid_checkbox" name=""></td>
                                            <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                    class="grid_checkbox" name=""></td>
                                            <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                    class="grid_checkbox" name=""></td>
                                            <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                    class="grid_checkbox" name=""></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="grid_col_1 col_rec_blue_white td_60px"></td>
                                        <td class="grid_col_2 col_rec_blue_white td_180px"></td>
                                        <td class="grid_col_2 col_rec_blue_white td_60px"><input type="checkbox"
                                                class="grid_checkbox"></td>
                                        <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                class="grid_checkbox"></td>
                                        <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                class="grid_checkbox"></td>
                                        <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                class="grid_checkbox"></td>
                                        <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                class="grid_checkbox"></td>
                                        <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                class="grid_checkbox"></td>
                                        <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                class="grid_checkbox"></td>
                                    </tr>
                                    @for ($i = 0; $i <= 5; $i++)
                                        <tr>
                                            <td class="grid_col_1 col_rec_blue_white"></td>
                                            <td class="grid_col_2 col_rec_blue_white"></td>
                                            <td class="grid_col_2 col_rec_blue_white td_40px"><input type="checkbox"
                                                    class="grid_checkbox"></td>
                                            <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                    class="grid_checkbox"></td>
                                            <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                    class="grid_checkbox"></td>
                                            <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                    class="grid_checkbox"></td>
                                            <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                    class="grid_checkbox"></td>
                                            <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                    class="grid_checkbox"></td>
                                            <td colspan="2" class="grid_wrapper_center col_rec"><input type="checkbox"
                                                    class="grid_checkbox"></td>
                                        </tr>
                                    @endfor
                                @endif
                            </tbody>
                        </table>

                        <div class="plus_rec plus_rec_left">
                            <div class="blue_text_wrapper" id="add_line_1" onclick="itemDetailAddLine1()">+ 行を追加する</div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="plus_rec plus_rec_left">
                        <div class="blue_text_wrapper" id="add_row" onclick="itemDetailAddRow()">+ 列を追加する</div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="element">
                    <div class="frame">
                        <div class="text_wrapper">&emsp;&emsp;商品区分：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="item_kbn" value="0"
                                    @if (old('item_kbn', $detailData['itemData']['item_kbn']) === 0) checked @endif />
                                商品
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="item_kbn" value="1"
                                    @if (old('item_kbn', $detailData['itemData']['item_kbn']) === 1) checked @endif />
                                製品
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="item_kbn" value="2"
                                    @if (old('item_kbn', $detailData['itemData']['item_kbn']) === 2) checked @endif />
                                部品
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="item_kbn" value="4"
                                    @if (old('item_kbn', $detailData['itemData']['item_kbn']) === 4) checked @endif />
                                運賃
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="item_kbn" value="6"
                                    @if (old('item_kbn', $detailData['itemData']['item_kbn']) === 6) checked @endif />
                                値引
                            </label>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="text_wrapper">在庫管理区分：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="stock_management_kbn" value="0"
                                    @if (old('stock_management_kbn', $detailData['itemData']['stock_management_kbn']) === 0) checked @endif />
                                対象
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="stock_management_kbn" value="1"
                                    @if (old('stock_management_kbn', $detailData['itemData']['stock_management_kbn']) === 1) checked @endif />
                                対象外
                            </label>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="text_wrapper">&emsp;非課税区分：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="non_tax_kbn" value="0"
                                    @if (old('non_tax_kbn', $detailData['itemData']['non_tax_kbn']) === 0) checked @endif />
                                課税
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="non_tax_kbn" value="1"
                                    @if (old('non_tax_kbn', $detailData['itemData']['non_tax_kbn']) === 1) checked @endif />
                                非課税
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">税率区分</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="def_tax_rate_kbns_cd" id="input_tax_rate" class="element"
                                minlength="0" maxlength="1" size="1"
                                value="{{ old('def_tax_rate_kbns_cd', $detailData['itemData']['tax_rate_kbn_cd']) }}" />
                            <img class="vector" id="img_tax_rate" src="/img/icon/vector.svg"
                                data-smm-open="search_tax_rate_kbn_modal" />
                            <input type="hidden" id="hidden_tax_rate" value="" name="hidden_tax_rate" />
                        </div>
                        <div class="textbox td_100px grid_wrapper_left" id="names_tax_rate">
                        </div>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="element_row">
                    <div class="element">
                        <div class="frame">
                            <div class="text_wrapper">名称入力区分：</div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="name_input_kbn" value="0"
                                        @if (old('name_input_kbn', $detailData['itemData']['name_input_kbn']) === 0) checked @endif />
                                    しない
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="name_input_kbn" value="1"
                                        @if (old('name_input_kbn', $detailData['itemData']['name_input_kbn']) === 1) checked @endif />
                                    する
                                </label>
                            </div>
                        </div>
                        <div class="frame">
                            <div class="text_wrapper">&emsp;&emsp;削除区分：</div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="del_kbn" value="0"
                                        @if (old('del_kbn', $detailData['itemData']['del_kbn']) === 0) checked @endif />
                                    しない
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="del_kbn" value="1"
                                        @if (old('del_kbn', $detailData['itemData']['del_kbn']) === 1) checked @endif />
                                    する
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="element">
                        <div class="frame">
                            <div class="text_wrapper">メンバーサイト連携区分：</div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="ec_alignment_kbn" value="0"
                                        @if (old('ec_alignment_kbn', $detailData['itemData']['ec_alignment_kbn']) === 0) checked @endif />
                                    連動
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="ec_alignment_kbn" value="1"
                                        @if (old('ec_alignment_kbn', $detailData['itemData']['ec_alignment_kbn']) === 1) checked @endif />
                                    表示無し
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="ec_alignment_kbn" value="2"
                                        @if (old('ec_alignment_kbn', $detailData['itemData']['ec_alignment_kbn']) === 2) checked @endif />
                                    非連携
                                </label>
                            </div>
                        </div>
                        <div class="frame">
                            <div class="text_wrapper">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;日本郵政：</div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="japan_post_office" value="0"
                                        @if (old('japan_post_office', $detailData['itemData']['japan_post_office']) === 0) checked @endif />
                                    未
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="japan_post_office" value="1"
                                        @if (old('japan_post_office', $detailData['itemData']['japan_post_office']) === 1) checked @endif />
                                    済
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="japan_post_office" value="2"
                                        @if (old('japan_post_office', $detailData['itemData']['japan_post_office']) === 2) checked @endif />
                                    一部済
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="blue_box_25p">
                    <div class="blue_box_25p_left">
                        <span>上代単価</span>
                    </div>
                    <div class="">
                        <div class="element element-form">
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper">税抜</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="retail_price_tax_out" class="element" minlength="0"
                                            maxlength="" size="8"
                                            value="{{ old('retail_price_tax_out', $detailData['itemData']['retail_price_tax_out']) }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper">税込</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="retail_price_tax_in" class="element" minlength="0"
                                            maxlength="" size="8"
                                            value="{{ old('retail_price_tax_in', $detailData['itemData']['retail_price_tax_in']) }}" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="blue_box_25p">
                    <div class="blue_box_25p_left">
                        <span>参考上代</span>
                    </div>
                    <div class="">
                        <div class="element element-form">
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper">税抜</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="reference_retail_tax_out" class="element"
                                            minlength="0" maxlength="" size="8"
                                            value="{{ old('reference_retail_tax_out', $detailData['itemData']['reference_retail_tax_out']) }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper">税込</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="reference_retail_tax_in" class="element"
                                            minlength="0" maxlength="" size="8"
                                            value="{{ old('reference_retail_tax_in', $detailData['itemData']['reference_retail_tax_in']) }}" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="blue_box_25p">
                    <div class="blue_box_25p_left">
                        <span>仕入単価</span>
                    </div>
                    <div class="">
                        <div class="element element-form">
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper">税抜</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="purchase_price_tax_out" class="element"
                                            minlength="0" maxlength="" size="8"
                                            value="{{ old('purchase_price_tax_out', $detailData['itemData']['purchase_price_tax_out']) }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper">税込</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="purchase_price_tax_in" class="element"
                                            minlength="0" maxlength="" size="8"
                                            value="{{ old('purchase_price_tax_in', $detailData['itemData']['purchase_price_tax_in']) }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blue_box_25p">
                    <div class="">
                        <div class="element element-form">
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper">&emsp;&emsp;&emsp;&emsp;原価単価</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="cost_price" class="element" minlength="0"
                                            maxlength="" size="8"
                                            value="{{ old('cost_price', $detailData['itemData']['cost_price']) }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper">粗利算出原価単価</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="profit_calculation_cost_price" class="element"
                                            minlength="0" maxlength="" size="8"
                                            value="{{ old('profit_calculation_cost_price', $detailData['itemData']['profit_calculation_cost_price']) }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="group_100p">
                    <div class="element-form-rows">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">メンバーサイト商品コード</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="ec_item_cd" class="element" minlength="0"
                                        maxlength="20" size="20"
                                        value="{{ old('ec_item_cd') ?? ($detailData['memberSiteItemData']['ec_item_cd'] ?? '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">メンバーサイト商品名</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="ec_item_name" class="element" minlength="0"
                                        maxlength="30" size="30"
                                        value="{{ old('ec_item_name') ?? ($detailData['memberSiteItemData']['ec_item_name'] ?? '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">ランキング</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="ranking" class="element" minlength="0" maxlength="5"
                                        size="5"
                                        value="{{ old('ranking') ?? ($detailData['memberSiteItemData']['ranking'] ?? '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper"><br></div>
                            <label for="scales">
                                <input type="checkbox" id="scales" name="printed_products_flg"
                                    @if (old('printed_products_flg') === 1) checked @elseif (isset($detailData['memberSiteItemData']['printed_products_flg']) &&
                                            $detailData['memberSiteItemData']['printed_products_flg'] === 1) checked @endif />
                                <span class="checkbox_span">プリント商品</span>
                            </label>
                        </div>
                    </div><br><br>
                    <div class="element-form-columns element-buttons">
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper">商品画像1</div>
                            <div class="frame">
                                <input type="file" name="item_image_file_1" class="button_gray" value="ファイルを選択">
                            </div>
                        </div><br>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper">商品画像2</div>
                            <div class="frame">
                                <input type="file" name="item_image_file_2" class="button_gray" value="ファイルを選択">
                            </div>
                        </div><br>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper">商品画像3</div>
                            <div class="frame">
                                <input type="file" name="item_image_file_3" class="button_gray" value="ファイルを選択">
                            </div>
                        </div><br>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper">商品画像4</div>
                            <div class="frame">
                                <input type="file" name="item_image_file_4" class="button_gray" value="ファイルを選択">
                            </div>
                        </div>
                    </div><br>
                    <div class="element-form-columns element-buttons">
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper">PDFファイル1</div>
                            <div class="frame">
                                <input type="file" name="pdf_file_1" class="button_gray" value="ファイルを選択">
                            </div>
                        </div><br>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper">PDFファイル2</div>
                            <div class="frame">
                                <input type="file" name="pdf_file_2" class="button_gray" value="ファイルを選択">
                            </div>
                        </div><br>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper">PDFファイル3</div>
                            <div class="frame">
                                <input type="file" name="pdf_file_3" class="button_gray" value="ファイルを選択">
                            </div>
                        </div><br>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper">PDFファイル4</div>
                            <div class="frame">
                                <input type="file" name="pdf_file_4" class="button_gray" value="ファイルを選択">
                            </div>
                        </div><br>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper">PDFファイル5</div>
                            <div class="frame">
                                <input type="file" name="pdf_file_5" class="button_gray" value="ファイルを選択">
                            </div>
                        </div>
                    </div><br>
                    <div class="element-form-columns element-buttons">
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper">商品バナー画像1</div>
                            <div class="frame">
                                <input type="file" name="item_banner_image_file_1" class="button_gray"
                                    value="ファイルを選択">
                            </div>
                        </div><br>
                        <div class="element-form element-form-rows">
                            <div class="text_wrapper">商品バナー画像2</div>
                            <div class="frame">
                                <input type="file" name="item_banner_image_file_2" class="button_gray"
                                    value="ファイルを選択">
                            </div>
                        </div>
                    </div><br>
                    <div class="element">
                        <div class="element-form-columns">
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">商品備考1</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="item_memo_1" class="element" minlength="0"
                                            maxlength="30" size="30"
                                            value="{{ old('item_memo_1') ?? ($detailData['memberSiteItemData']['item_memo_1'] ?? '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element-form-columns">
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">商品備考2</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="item_memo_2" class="element" minlength="0"
                                            maxlength="30" size="30"
                                            value="{{ old('item_memo_2') ?? ($detailData['memberSiteItemData']['item_memo_1'] ?? '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element-form-columns">
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">商品備考3</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="item_memo_3" class="element" minlength="0"
                                            maxlength="30" size="30"
                                            value="{{ old('item_memo_3') ?? ($detailData['memberSiteItemData']['item_memo_3'] ?? '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element-form-columns">
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">商品備考4</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="item_memo_4" class="element" minlength="0"
                                            maxlength="30" size="30"
                                            value="{{ old('item_memo_4') ?? ($detailData['memberSiteItemData']['item_memo_4'] ?? '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element-form-columns">
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">商品備考5</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" name="item_memo_5" class="element" minlength="0"
                                            maxlength="30" size="30"
                                            value="{{ old('item_memo_5') ?? ($detailData['memberSiteItemData']['item_memo_5'] ?? '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br><br><br>
                    <div class="element-form-rows">
                        <div class="grid">
                            <table class="no_scroll" id="member_grids">
                                <thead class="grid_header">
                                    <tr>
                                        <td class="grid_wrapper_center td_25p">メンバーサイト商品コード</td>
                                        <td class="grid_wrapper_center td_50p">メンバーサイト商品名</td>
                                        <td class="grid_wrapper_center td_15p">表示順</td>
                                        <td class="grid_wrapper_center td_10p">削除</td>
                                    </tr>
                                </thead>
                                <tbody class="grid_body">
                                    @if (isset($detailData['recommendData']) && count($detailData['recommendData']) > 0)
                                        @foreach ($detailData['recommendData'] as $data)
                                            <tr>
                                                <td class="grid_col_1 col_rec"><input type="text" placeholder=""
                                                        name="recommend_ec_item_cd[]" class="grid_textbox"
                                                        value="{{ old('ec_item_cd', $data['ec_item_cd']) }}"></td>
                                                <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                                        name="recommend_ec_item_name[]" class="grid_textbox"
                                                        value="{{ old('ec_item_name', $data['ec_item_name']) }}"></td>
                                                <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                                        name="recommend_display_order[]" class="grid_textbox"
                                                        value="{{ old('display_order', $data['display_order']) }}"></td>
                                                <td class="grid_col_2 col_rec"><button type="pbmit" name="delete_ec[]"
                                                        class="display_none"
                                                        value="{{ isset($data['id']) ? $data['id'] : '' }}"><img
                                                            src="{{ asset('/img/icon/trash.svg') }}"
                                                            class="img_center"></button></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="grid_col_1 col_rec"><input type="text" placeholder=""
                                                    name="recommend_ec_item_cd[]" class="grid_textbox"
                                                    value="{{ old('ec_item_cd') }}"></td>
                                            <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                                    name="recommend_ec_item_name[]" class="grid_textbox"
                                                    value="{{ old('ec_item_name') }}"></td>
                                            <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                                    name="recommend_display_order[]" class="grid_textbox"
                                                    value="{{ old('display_order') }}"></td>
                                            <td class="grid_col_2 col_rec"></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="plus_rec plus_rec_left">
                                <div class="blue_text_wrapper" id="add_line_2" onclick="itemDetailAddLine2()">+ 行を追加する
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="hidden_detail_id"
                value="{{ isset($detailData['itemData']['id']) ? $detailData['itemData']['id'] : '' }}"
                name="hidden_detail_id" />
            @include('components.menu.selected', ['view' => 'main'])
        </form>
    </div>
    @include('admin.master.search.item_class_thing5', ['itemClassThing5Data' => $itemClassThing5Data])
    @include('admin.master.search.item_class_thing6', ['itemClassThing6Data' => $itemClassThing6Data])
    @include('admin.master.search.item_class_thing7', ['itemClassThing7Data' => $itemClassThing7Data])
    @include('admin.master.search.supplier', ['supplierData' => $supplierData])
    @include('admin.master.search.color_pattern', ['colorPatternData' => $colorPatternData])
    @include('admin.master.search.size_pattern', ['sizePatternData' => $sizePatternData])
    @include('admin.master.search.tax_rate_kbn', ['taxRateKbnData' => $taxRateKbnData])
    @include('admin.master.search.brand1', ['brand1Data' => $brand1Data])
    @include('admin.master.search.game_category', ['itemClassThing2Data' => $itemClassThing2Data])
    @include('admin.master.search.genre', ['genreData' => $genreData])
    @include('admin.master.search.item_class_thing4', ['itemClassThing4Data' => $itemClassThing4Data])
    @include('admin.master.search.item_cd', ['itemData' => $itemData])
@endsection
<script src="{{ asset('js/master/item/mt_item/detailById.js') }}"></script>