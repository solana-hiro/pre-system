@extends('layouts.admin.app')
@section('page_title', '商品入力（詳細）')
@section('title', '商品入力（詳細）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
    <script type="module" src="{{ asset('js/master/item/mt_item/detail.js') }}"></script>
@endsection

@section('content')
    <form role="search" action="{{ route('master.item.mt_item.update') }}" method="post" name="mtCustomerClassIndexForm"
        enctype="multipart/form-data" data-monitoring>
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    @if (isset($detailData['itemData']['id']))
                        <button class="button" type="button" name="delete" data-toggle="modal" data-target="#modal_delete"
                            data-value="{{ $detailData['itemData']['id'] }}">
                            <div class="text_wrapper">削除する</div>
                        </button>
                    @else
                        <button class="button" type="button" name="delete" data-toggle="modal" disabled>
                            <div class="text_wrapper">削除する</div>
                        </button>
                    @endif
                    @if (isset($detailData['itemData']) && $minCode < $detailData['itemData']['item_cd'])
                        <button class="button" type="submit" name="prev">
                            <div class="text_wrapper_2">前頁</div>
                        </button>
                    @else
                        <button class="button" type="submit" name="prev" disabled>
                            <div class="text_wrapper_2">前頁</div>
                        </button>
                    @endif
                    @if ((isset($detailData['itemData']) && $maxCode > $detailData['itemData']['item_cd']) || !isset($detailData['itemData']))
                        <button class="button" type="submit" name="next">
                            <div class="text_wrapper_2">次頁</div>
                        </button>
                    @else
                        <button class="button" type="submit" name="next" disabled>
                            <div class="text_wrapper_2">次頁</div>
                        </button>
                    @endif
                    <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value="" class="button-2"
                        id="updateButton" data-url="" name="update2"
                        data-register-jan-code="{{ old('register_jan_code') }}"
                        data-del-kbn="{{ old('del_kbn', isset($detailData['itemData']) ? $detailData['itemData']['del_kbn'] : '') }}">
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
                    <div class="text_wrapper txt_required">商品コード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="item_cd" id="input_item_cd"  class="element" minlength="0"
                                maxlength="9" size="9" onblur="eventBlurCodeautoItemRedirect(arguments[0], this)" 
                                data-monitoring-exclude
                                value="{{ old('item_cd', isset($detailData['itemData']) ? $detailData['itemData']['item_cd'] : '') }}" />
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
                            <input type="text" name="other_part_number" class="element" minlength="0" maxlength="20" size="20"
                                value="{{ old('other_part_number', isset($detailData['itemData']) ? $detailData['itemData']['other_part_number'] : '') }}" />
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper"><br></div>
                    <label for="register_jan_code">
                        <input type="checkbox" name="register_jan_code" id="register_jan_code" value="1"
                        onchange="changeRegisterJanCode(arguments[0], this)"
                            @if (old('register_jan_code') == 1) checked @endif />
                        <span class="checkbox_span">JANコード登録</span>
                    </label>
                </div>
            </div>
            <div class="box">
                <div class="group">
                    <div class="element-form-rows">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper txt_required">商品名</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="item_name" class="element" minlength="0" maxlength="40"
                                        size="40"
                                        value="{{ old('item_name', isset($detailData['itemData']) ? $detailData['itemData']['item_name'] : '') }}" />
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
                                        value="{{ old('item_name_kana', isset($detailData['itemData']) ? $detailData['itemData']['item_name_kana'] : '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">単位</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" name="unit" class="element" minlength="0" maxlength="4"
                                        size="4"
                                        value="{{ old('unit', isset($detailData['itemData']) ? $detailData['itemData']['unit'] : '') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_required">ブランド1コード<span id="alert_item_class_cd_1" class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="item_class_cd_1" id="input_item_class_cd_1"
                                class="element w-100" minlength="0" maxlength="6" size="6" onblur="eventBlurCodeautoItemClass(arguments[0], this)" 
                                value="{{ old('item_class_cd_1', isset($detailData['itemData']) ? $detailData['itemData']['item_class1_cd'] : '') }}" />
                            <img class="vector" id="img_item_class_cd_1" src="/img/icon/vector.svg"
                                data-smm-open="search_brand1_modal" />
                            <input type="hidden" id="hidden_item_class_cd_1"
                                value="{{ isset($detailData['itemData']['mt_item_class1_id']) ? $detailData['itemData']['mt_item_class1_id'] : '' }}"
                                name="hidden_mt_item_class1_cd" />
                        </div>
                        <div class="textbox">
                            <input type="text" class="element td_140px txt_blue" id="names_item_class_cd_1" name="item_class1_name" readonly
                                value="{{ old('item_class1_name', isset($detailData['itemData']) ? $detailData['itemData']['item_class1_name'] : '') }}" />
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">競技・カテゴリコード<span id="alert_item_class_cd_2" class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="item_class_cd_2" id="input_item_class_cd_2"
                                class="element w-100" minlength="0" maxlength="6" size="6" onblur="eventBlurCodeautoItemClass(arguments[0], this)" 
                                value="{{ old('item_class_cd_2', isset($detailData['itemData']) ? $detailData['itemData']['item_class2_cd'] : '') }}" />
                            <img class="vector" id="img_item_class_cd_2" src="/img/icon/vector.svg"
                                data-smm-open="search_game_category_modal" />
                            <input type="hidden" id="hidden_item_class_cd_2"
                                value="{{ isset($detailData['itemData']['mt_item_class2_id']) ? $detailData['itemData']['mt_item_class2_id'] : '' }}"
                                name="hidden_mt_item_class2_cd" />
                        </div>
                        <div class="textbox">
                            <input type="text" class="element td_140px txt_blue" id="names_item_class_cd_2" name="item_class2_name" readonly
                                value="{{ old('item_class2_name', isset($detailData['itemData']) ? $detailData['itemData']['item_class2_name'] : '') }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">ジャンルコード<span id="alert_item_class_cd_3" class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="item_class_cd_3" id="input_item_class_cd_3"
                                class="element w-100" minlength="0" maxlength="6" size="6" onblur="eventBlurCodeautoItemClass(arguments[0], this)" 
                                value="{{ old('item_class_cd_3', isset($detailData['itemData']) ? $detailData['itemData']['item_class3_cd'] : '') }}" />
                            <img class="vector" id="img_item_class_cd_3" src="/img/icon/vector.svg"
                                data-smm-open="search_genre_modal" />
                            <input type="hidden" id="hidden_item_class_cd_3"
                                value="{{ isset($detailData['itemData']['mt_item_class3_id']) ? $detailData['itemData']['mt_item_class3_id'] : '' }}"
                                name="hidden_mt_item_class3_cd" />
                        </div>
                        <div class="textbox">
                            <input type="text" class="element td_140px txt_blue" id="names_item_class_cd_3" name="item_class3_name" readonly
                                value="{{ old('item_class3_name', isset($detailData['itemData']) ? $detailData['itemData']['item_class3_name'] : '') }}" />
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">販売開始年コード<span id="alert_item_class_cd_4" class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="item_class_cd_4" id="input_item_class_cd_4"
                                class="element w-100" minlength="0" maxlength="6" size="6" onblur="eventBlurCodeautoItemClass(arguments[0], this)" 
                                value="{{ old('item_class_cd_4', isset($detailData['itemData']) ? $detailData['itemData']['item_class4_cd'] : '') }}" />
                            <img class="vector" id="img_item_class_cd_4" src="/img/icon/vector.svg"
                                data-smm-open="search_item_class_thing4_modal" />
                            <input type="hidden" id="hidden_item_class_cd_4"
                                value="{{ isset($detailData['itemData']['mt_item_class4_id']) ? $detailData['itemData']['mt_item_class4_id'] : '' }}"
                                name="hidden_mt_item_class4_cd" />
                        </div>
                        <div class="textbox">
                            <input type="text" class="element td_140px txt_blue" id="names_item_class_cd_4" name="item_class4_name" readonly
                                value="{{ old('item_class4_name', isset($detailData['itemData']) ? $detailData['itemData']['item_class4_name'] : '') }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">工場分類5コード<span id="alert_item_class_cd_5" class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="item_class_cd_5" id="input_item_class_cd_5" class="element w-100"
                                minlength="0" maxlength="6" size="6" onblur="eventBlurCodeautoItemClass(arguments[0], this)" 
                                value="{{ old('item_class_cd_5', isset($detailData['itemData']) ? $detailData['itemData']['item_class5_cd'] : '') }}" />
                            <img class="vector" id="img_item_class_cd_5" src="/img/icon/vector.svg"
                                data-smm-open="search_item_class_thing5_modal" />
                            <input type="hidden" id="hidden_item_class_cd_5"
                                value="{{ isset($detailData['itemData']['mt_item_class5_id']) ? $detailData['itemData']['mt_item_class5_id'] : '' }}"
                                name="hidden_item_class_cd_5" />
                        </div>
                        <div class="textbox">
                            <input type="text" class="element td_140px txt_blue" id="names_item_class_cd_5" name="item_class5_name" readonly
                                value="{{ old('item_class5_name', isset($detailData['itemData']) ? $detailData['itemData']['item_class5_name'] : '') }}" />
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">製品/工賃6コード<span id="alert_item_class_cd_6" class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="item_class_cd_6" id="input_item_class_cd_6" class="element w-100"
                                minlength="0" maxlength="6" size="6" onblur="eventBlurCodeautoItemClass(arguments[0], this)" 
                                value="{{ old('item_class_cd_6', isset($detailData['itemData']) ? $detailData['itemData']['item_class6_cd'] : '') }}" />
                            <img class="vector" id="img_item_class_cd_6" src="/img/icon/vector.svg"
                                data-smm-open="search_item_class_thing6_modal" />
                            <input type="hidden" id="hidden_item_class_cd_6"
                                value="{{ isset($detailData['itemData']['mt_item_class6_id']) ? $detailData['itemData']['mt_item_class6_id'] : '' }}"
                                name="hidden_item_class_cd_6" />
                        </div>
                        <div class="textbox">
                            <input type="text" class="element td_140px txt_blue" id="names_item_class_cd_6" name="item_class6_name" readonly
                                value="{{ old('item_class6_name', isset($detailData['itemData']) ? $detailData['itemData']['item_class6_name'] : '') }}" />
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">資産在庫JAコード<span id="alert_item_class_cd_7" class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="item_class_cd_7" id="input_item_class_cd_7" class="element w-100"
                                minlength="0" maxlength="6" size="6" onblur="eventBlurCodeautoItemClass(arguments[0], this)" 
                                value="{{ old('item_class_cd_7', isset($detailData['itemData']) ? $detailData['itemData']['item_class7_cd'] : '') }}" />
                            <img class="vector" id="img_item_class_cd_7" src="/img/icon/vector.svg"
                                data-smm-open="search_item_class_thing7_modal" />
                            <input type="hidden" id="hidden_item_class_cd_7"
                                value="{{ isset($detailData['itemData']['mt_item_class7_id']) ? $detailData['itemData']['mt_item_class7_id'] : '' }}"
                                name="hidden_item_class_cd_7" />
                        </div>
                        <div class="textbox">
                            <input type="text" class="element td_140px txt_blue" id="names_item_class_cd_7" name="item_class7_name" readonly
                                value="{{ old('item_class7_name', isset($detailData['itemData']) ? $detailData['itemData']['item_class7_name'] : '') }}" />
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_required">仕入先コード<span id="alert-danger-ul-supplier" class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="mt_supplier_cd" id="input_mt_supplier_cd" class="element w-100"
                                data-limit-len="6" data-limit-minus onblur="eventBlurCodeautoSupplier(arguments[0], this)" 
                                value="{{ old('mt_supplier_cd', isset($detailData['itemData']) ? $detailData['itemData']['supplier_cd'] : '') }}" />
                            <img class="vector" id="img_mt_supplier_cd" src="/img/icon/vector.svg"
                                data-smm-open="search_supplier_modal" />
                            <input type="hidden" id="hidden_mt_supplier_id" name="hidden_mt_supplier_id"
                                value="{{ old('hidden_mt_supplier_id', isset($detailData['itemData']) ? $detailData['itemData']['mt_supplier_id'] : '') }}" />
                        </div>
                        <div class="textbox">
                            <input type="text" class="element td_140px txt_blue" id="names_mt_supplier_cd" name="supplier_name" readonly
                                value="{{ old('supplier_name', isset($detailData['itemData']) ? $detailData['itemData']['supplier_name'] : '') }}" />
                        </div>
                    </div>
                </div>
            </div><br><br>
            <div>
                <span id="alert-danger-ul-table" class="alert alert-danger"></span>
                <div class="grid_blue_pattern">
                    <table class="grid_blue_pattern_table" id="pattern_grid_table">
                        <thead class="">
                            <tr class="">
                                <td colspan="3" class="grid_wrapper_left grid_wrapper_white td_300px sticky_11"></td>
                                <td colspan="20" class="grid_header grid_wrapper_left sticky_12">
                                    <div class="element-form-rows">
                                        <div class="search-label">サイズ</div>
                                        <div class="search-form" role="search">
                                            <input type="number" name="size_pattern_cd" id="input_size_pattern_cd"
                                                data-limit-minus data-limit-len="4" onblur="eventBlurSizePatterns(arguments[0], this)" 
                                                class="search-input" placeholder="サイズパターンから入力">
                                            <img class="search-button" id="img_size_pattern_cd"
                                                src="/img/icon/vector.svg" data-smm-open="search_size_pattern_modal" />
                                            <input type="hidden" id="hidden_size_pattern_cd" value=""
                                                name="hidden_size_pattern_cd" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                                <td colspan="3" rowspan="2" class="grid_header grid_wrapper_center td_300px sticky_21">
                                    <span class="td_center">カラー</span>
                                    <div class="search-form" role="search">
                                        <input type="number" name="color_pattern_cd" id="input_color_pattern_cd"
                                            onblur="eventBlurColorPatterns(arguments[0], this)" class="search-input"
                                            data-limit-len="4" data-limit-minus
                                            placeholder="カラーパターンから入力">
                                        <img class="search-button" id="img_color_pattern_cd"
                                            src="/img/icon/vector.svg" data-smm-open="search_color_pattern_modal" />
                                        <input type="hidden" id="hidden_color_pattern_cd" value=""
                                            name="hidden_color_pattern_cd" />
                                    </div>
                                </td>
                            @empty(old('input_size_code'))
                                <!-- サイズデータがある場合 -->
                                @if (isset($detailData['sizeData']) && count($detailData['sizeData']) > 0)
                                    @php $i=0 @endphp
                                    @foreach ($detailData['sizeData'] as $data)
                                        <td class="row_rec_blue_white td_60px sticky_22">
                                            <div class="flex">
                                                <input type="text" placeholder=""
                                                id="input_size_code{{ $i }}"
                                                value="{{$data['size_cd']}}"
                                                onblur="eventBlurCodeautoSize(arguments[0], this)"
                                                name="input_size_code[]" class="grid_textbox" minlength="0" maxlength="5" />
                                                <img
                                                class="vector" id="img_size_code{{ $i }}" src="/img/icon/vector.svg"
                                                data-smm-open="search_size_modal" />
                                            </div>
                                        </td>
                                        <td class="grid_col_2 col_rec_blue_white td_180px sticky_22">
                                            <input id="input_size_name{{ $i }}" name="input_size_name[]" class="grid_textbox txt_blue" value="{{$data['size_name']}}" readonly>
                                        </td>
                                    @php $i++ @endphp
                                    @endforeach
                                    @for ($j = $i; $j < 10; $j++)
                                    <td class="row_rec_blue_white td_60px sticky_22">
                                        <div class="flex">
                                            <input type="text" placeholder=""
                                            id="input_size_code{{ $j }}"
                                            value=""
                                            onblur="eventBlurCodeautoSize(arguments[0], this)"
                                            name="input_size_code[]" class="grid_textbox" minlength="0" maxlength="5" />
                                            <img
                                            class="vector" id="img_size_code{{ $j }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_size_modal" />
                                        </div>
                                    </td>
                                    <td class="grid_col_2 col_rec_blue_white td_180px sticky_22">
                                        <input id="input_size_name{{ $j }}" name="input_size_name[]" class="grid_textbox txt_blue" value="" readonly>
                                    </td>
                                    @endfor
                                <!-- サイズデータなし（初期画面）の場合 -->
                                @else
                                    @for ($i = 0; $i < 10; $i++)
                                    <td class="row_rec_blue_white td_80px sticky_22">
                                        <div class="flex">
                                            <input type="text" placeholder=""
                                            id="input_size_code{{ $i }}"
                                            value=""
                                            onblur="eventBlurCodeautoSize(arguments[0], this)"
                                            name="input_size_code[]" class="grid_textbox" minlength="0" maxlength="5" />
                                            <img
                                            class="vector" id="img_size_code{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_size_modal" />
                                        </div>
                                    </td>
                                    <td class="grid_col_2 col_rec_blue_white td_180px sticky_22">
                                        <input id="input_size_name{{ $i }}" name="input_size_name[]" class="grid_textbox txt_blue" value="" readonly>
                                    </td>
                                    @endfor
                                @endif
                            @else
                                @for ($i = 0; $i < count(old('input_size_code')); $i++)
                                    <td class="grid_wrapper_center row_rec_blue_white td_80px sticky_22">
                                        <div class="grid_col_1">
                                            <input type="text" placeholder=""
                                            id="input_size_code{{ $i }}"
                                            value="{{ old("input_size_code.{$i}")}}"
                                            onblur="eventBlurCodeautoSize(arguments[0], this)"
                                            name="input_size_code[]" class="grid_textbox" minlength="0" maxlength="5" />
                                            <img
                                            class="vector" id="img_size_code{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_size_modal" />
                                        </div>
                                    </td>
                                    <td class="grid_col_2 col_rec_blue_white td_180px sticky_22">
                                        <input id="input_size_name{{ $i }}" name="input_size_name[]" class="grid_textbox txt_blue" value="{{ old("input_size_name.{$i}", '') }}" readonly>
                                    </td>
                                @endfor
                                @for ($j = $i; $j < 10; $j++)
                                <td class="row_rec_blue_white td_60px sticky_22">
                                    <div class="grid_col_1">
                                        <input type="text" placeholder=""
                                        id="input_size_code{{ $j }}"
                                        value=""
                                        onblur="eventBlurCodeautoSize(arguments[0], this)"
                                        name="input_size_code[]" class="grid_textbox" minlength="0" maxlength="5" />
                                        <img
                                        class="vector" id="img_size_code{{ $j }}" src="/img/icon/vector.svg"
                                        data-smm-open="search_size_modal" />
                                    </div>
                                </td>
                                <td class="grid_col_2 col_rec_blue_white td_180px sticky_22">
                                    <input id="input_size_name{{ $j }}" name="input_size_name[]" class="grid_textbox txt_blue" value="" readonly>
                                </td>
                                @endfor
                            @endempty
                            </tr>
                            <!-- 対象サイズ全チェック用ボタン -->
                            <tr>
                                @for ($i = 0; $i < 10; $i++)
                                <td colspan="2" class="grid_wrapper_center col_rec_blue td_50px sticky_32">
                                    <input
                                        id="size_check_all{{ $i }}" type="checkbox" class="grid_checkbox"
                                        onchange="eventBlurSizeCheckAll(arguments[0], this)"
                                    />
                                </td>
                                @endfor
                            </tr>
                        </thead>
                        <tbody class="grid_body">
                            @empty(old('input_color_code'))
                                @if (isset($detailData['colorData']) && count($detailData['colorData']) > 0)
                                    @php $i=0 @endphp
                                    @foreach ($detailData['colorData'] as $data)
                                        @php
                                        $hiddenFlagData = array_filter($detailData['hiddenFlagData'], function($item) use ($data){
                                            return $item['color_id'] == $data['color_id'];
                                        });
                                        @endphp
                                    <tr>
                                        <td class="grid_col_1 col_rec_blue_white td_60px sticky_41">
                                            <input type="text" placeholder=""
                                            id="input_color_code{{ $i }}"
                                            value="{{$data['color_cd']}}"
                                            onblur="eventBlurCodeautoColor(arguments[0], this)"
                                            name="input_color_code[]" class="grid_textbox" minlength="0" maxlength="5" />
                                            <img
                                            class="vector" id="img_color_code{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" />
                                        </td>
                                        <td class="grid_col_2 col_rec_blue_white td_180px sticky_42">
                                            <input id="input_color_name{{ $i }}" name="input_color_name[]" class="grid_textbox txt_blue" value="{{$data['color_name']}}" readonly>
                                        </td>
                                        <!-- 対象カラー全チェック用ボタン -->
                                        <td class="grid_col_2 col_rec_blue_white td_60px sticky_43">
                                            <input type="checkbox" class="grid_checkbox"
                                                id="color_check_all{{ $i }}"
                                                onchange="eventBlurColorCheckAll(arguments[0], this)"
                                            />
                                        </td>
                                        <!-- 非表示フラグ -->
                                        @php $j=0 @endphp
                                        @foreach ($hiddenFlagData as $flagData)
                                        <td colspan="2" class="grid_wrapper_center col_rec">
                                            <input type="checkbox"
                                                id="hidden_flg{{ $i }}{{ $j }}"
                                                name="hidden_flg[{{ $i }}{{ $j }}]"
                                                value="1"
                                                class="grid_checkbox" @if ($flagData['hidden_flg'] == '1') checked @endif
                                            >
                                        </td>
                                        @php $j++ @endphp
                                        @endforeach
                                        <!-- 非表示フラグ （データ無し）-->
                                        @for ($j; $j < 10; $j++)
                                        <td colspan="2" class="grid_wrapper_center col_rec">
                                            <input type="checkbox"
                                                id="hidden_flg{{ $i }}{{ $j }}"
                                                name="hidden_flg[{{ $i }}{{ $j }}]"
                                                value="1"
                                                class="grid_checkbox"
                                            >
                                        </td>
                                        @endfor
                                    </tr>
                                        @php $i++ @endphp
                                    @endforeach
                                    <!-- 空のカラー行を追加 -->
                                    @for ($k = $i; $k < 20; $k++)
                                    <tr>
                                        <td class="grid_col_1 col_rec_blue_white td_60px sticky_41">
                                            <input type="text" placeholder=""
                                            id="input_color_code{{ $k }}"
                                            value=""
                                            onblur="eventBlurCodeautoColor(arguments[0], this)"
                                            name="input_color_code[]" class="grid_textbox" minlength="0" maxlength="5" />
                                            <img
                                            class="vector" id="img_color_code{{ $k }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" />
                                        </td>
                                        <td class="grid_col_2 col_rec_blue_white td_180px sticky_42">
                                            <input id="input_color_name{{ $k }}" name="input_color_name[]" class="grid_textbox txt_blue" value="" readonly>
                                        </td>
                                        <!-- 対象カラー全チェック用ボタン -->
                                        <td class="grid_col_2 col_rec_blue_white td_60px sticky_43">
                                            <input type="checkbox" class="grid_checkbox"
                                                id="color_check_all{{ $k }}"
                                                onchange="eventBlurColorCheckAll(arguments[0], this)"
                                            >
                                        </td>
                                        <!-- 非表示フラグ （データ無し）-->
                                        @for ($j=0; $j < 10; $j++)
                                        <td colspan="2" class="grid_wrapper_center col_rec">
                                            <input type="checkbox"
                                                id="hidden_flg{{ $k }}{{ $j }}"
                                                name="hidden_flg[{{ $k }}{{ $j }}]"
                                                value="1"
                                                class="grid_checkbox"
                                            >
                                        </td>
                                        @endfor
                                    </tr>
                                    @endfor
                                <!-- データがない場合 -->
                                @else
                                    @for ($i = 0; $i < 20; $i++)
                                    <tr>
                                        <td class="grid_col_1 col_rec_blue_white td_60px sticky_41">
                                            <input type="text" placeholder=""
                                            id="input_color_code{{ $i }}"
                                            value="{{old("input_color_code.{$i}")}}"
                                            onblur="eventBlurCodeautoColor(arguments[0], this)"
                                            name="input_color_code[]" class="grid_textbox" minlength="0" maxlength="5" />
                                            <img
                                            class="vector" id="img_color_code{{ $i }}" src="/img/icon/vector.svg"
                                            data-smm-open="search_color_modal" />
                                        </td>
                                        <td class="grid_col_2 col_rec_blue_white td_180px sticky_42">
                                            <input id="input_color_name{{ $i }}" name="input_color_name[]" class="grid_textbox txt_blue" value="" readonly>
                                        </td>
                                        <!-- 対象カラー全チェック用ボタン -->
                                        <td class="grid_col_2 col_rec_blue_white td_60px sticky_43">
                                            <input type="checkbox" class="grid_checkbox"
                                                id="color_check_all{{ $i }}"
                                                onchange="eventBlurColorCheckAll(arguments[0], this)"
                                            >
                                        </td>
                                        <!-- 非表示フラグ （データ無し）-->
                                        @for ($j=0; $j < 10; $j++)
                                        <td colspan="2" class="grid_wrapper_center col_rec">
                                            <input type="checkbox"
                                                id="hidden_flg{{ $i }}{{ $j }}"
                                                name="hidden_flg[{{ $i }}{{ $j }}]"
                                                value="1"
                                                class="grid_checkbox"
                                            >
                                        </td>
                                        @endfor
                                    </tr>
                                    @endfor
                                @endif
                            <!-- oldがある場合 -->
                            @else
                                @php $i=0 @endphp
                                @for ($i = 0; $i < count(old('input_color_code')); $i++)
                                <tr>
                                    <td class="grid_col_1 col_rec_blue_white td_60px sticky_41">
                                        <input type="text" placeholder=""
                                        id="input_color_code{{ $i }}"
                                        value="{{ old("input_color_code.{$i}")}}"
                                        onblur="eventBlurCodeautoColor(arguments[0], this)"
                                        name="input_color_code[]" class="grid_textbox" minlength="0" maxlength="5" />
                                        <img
                                        class="vector" id="img_color_code{{ $i }}" src="/img/icon/vector.svg"
                                        data-smm-open="search_color_modal" />
                                    </td>
                                    <td class="grid_col_2 col_rec_blue_white td_180px sticky_42">
                                        <input id="input_color_name{{ $i }}" name="input_color_name[]" class="grid_textbox txt_blue" value="{{ old("input_color_name.{$i}")}}" readonly>
                                    </td>
                                    <!-- 対象カラー全チェック用ボタン -->
                                    <td class="grid_col_2 col_rec_blue_white td_60px sticky_43">
                                        <input type="checkbox" class="grid_checkbox"
                                        id="color_check_all{{ $i }}"
                                        onchange="eventBlurColorCheckAll(arguments[0], this)"
                                    />
                                    </td>
                                    <!-- 非表示フラグ -->
                                    @if(null !== old('hidden_flg'))
                                        @for ($j = 0; $j < count(old('hidden_flg')); $j++)
                                        <td colspan="2" class="grid_wrapper_center col_rec">
                                            <input type="checkbox"
                                                id="hidden_flg{{ $i }}{{ $j }}"
                                                name="hidden_flg[{{ $i }}{{ $j }}]"
                                                value="1"
                                                class="grid_checkbox"
                                                @if(old("hidden_flg.{$i}{$j}") == '1') checked @endif
                                            >
                                        </td>
                                        @endfor
                                    @else
                                        @php $j = 0 @endphp
                                    @endif
                                    <!-- 非表示フラグ （データ無し）-->
                                    @for ($j; $j < 10; $j++)
                                    <td colspan="2" class="grid_wrapper_center col_rec">
                                        <input type="checkbox"
                                            id="hidden_flg{{ $i }}{{ $j }}"
                                            name="hidden_flg[{{ $i }}{{ $j }}]"
                                            value="1"
                                            class="grid_checkbox"
                                        >
                                    </td>
                                    @endfor
                                </tr>
                                @endfor
                                <!-- 空のカラー行を追加 -->
                                @for ($j = $i; $j < 20; $j++)
                                <tr>
                                    <td class="grid_col_1 col_rec_blue_white td_60px sticky_41">
                                        <input type="text" placeholder=""
                                        id="input_color_code{{ $j }}"
                                        value=""
                                        onblur="eventBlurCodeautoColor(arguments[0], this)"
                                        name="input_color_code[]" class="grid_textbox" minlength="0" maxlength="5" />
                                        <img
                                        class="vector" id="img_color_code{{ $j }}" src="/img/icon/vector.svg"
                                        data-smm-open="search_color_modal" />
                                    </td>
                                    <td class="grid_col_2 col_rec_blue_white td_180px sticky_42">
                                        <input id="input_color_name{{ $i }}" name="input_color_name[]" class="grid_textbox txt_blue" value="" readonly>
                                    </td>
                                    <!-- 対象カラー全チェック用ボタン -->
                                    <td class="grid_col_2 col_rec_blue_white td_60px sticky_43">
                                        <input type="checkbox" class="grid_checkbox"
                                            id="color_check_all{{ $j }}"
                                            onchange="eventBlurColorCheckAll(arguments[0], this)"
                                        />
                                    </td>
                                    <!-- 非表示フラグ （データ無し）-->
                                    @for ($k=0; $k < 10; $k++)
                                    <td colspan="2" class="grid_wrapper_center col_rec">
                                        <input type="checkbox"
                                            id="hidden_flg{{ $j }}{{ $k }}"
                                            name="hidden_flg[{{ $j }}{{ $k }}]"
                                            value="1"
                                            class="grid_checkbox"
                                        >
                                    </td>
                                    @endfor
                                </tr>
                                @endfor
                            @endempty
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box">
                <div class="element">
                    <div class="frame">
                        <div class="text_wrapper txt_required">&emsp;&emsp;商品区分：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="item_kbn" value="0"
                                    @if (old('item_kbn', isset($detailData['itemData']) ? $detailData['itemData']['item_kbn'] : '0') == 0) checked @endif />
                                商品
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="item_kbn" value="1"
                                    @if (old('item_kbn', isset($detailData['itemData']) ? $detailData['itemData']['item_kbn'] : '') == 1) checked @endif />
                                製品
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="item_kbn" value="2"
                                    @if (old('item_kbn', isset($detailData['itemData']) ? $detailData['itemData']['item_kbn'] : '') == 2) checked @endif />
                                部品
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="item_kbn" value="4"
                                    @if (old('item_kbn', isset($detailData['itemData']) ? $detailData['itemData']['item_kbn'] : '') == 4) checked @endif />
                                運賃
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="item_kbn" value="6"
                                    @if (old('item_kbn', isset($detailData['itemData']) ? $detailData['itemData']['item_kbn'] : '') == 6) checked @endif />
                                値引
                            </label>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="text_wrapper txt_required">在庫管理区分：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="stock_management_kbn" value="0"
                                    @if (old(
                                            'stock_management_kbn',
                                            isset($detailData['itemData']) ? $detailData['itemData']['stock_management_kbn'] : '0') == 0) checked  @endif />
                                対象
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="stock_management_kbn" value="1"
                                    @if (old(
                                            'stock_management_kbn',
                                            isset($detailData['itemData']) ? $detailData['itemData']['stock_management_kbn'] : '') == 1) checked @endif />
                                対象外
                            </label>
                        </div>
                    </div>
                    <div class="frame">
                        <div class="text_wrapper txt_required">&emsp;非課税区分：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="non_tax_kbn" value="0"
                                    @if (old('non_tax_kbn', isset($detailData['itemData']) ? $detailData['itemData']['non_tax_kbn'] : '0') == 0) checked @endif/>
                                課税
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="non_tax_kbn" value="1"
                                    @if (old('non_tax_kbn', isset($detailData['itemData']) ? $detailData['itemData']['non_tax_kbn'] : '')) checked @endif />
                                非課税
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_required">税率区分<span id="alert-danger-ul-tax-rate" class="alert alert-danger"></span></div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="def_tax_rate_kbns_cd" id="input_tax_rate_kbn" class="element input_number_1"
                                data-limit-len="1" data-limit-minus onblur="eventBlurCodeautoTaxRateKbn(arguments[0], this)"
                                value="{{ old('def_tax_rate_kbns_cd', isset($detailData['itemData']) ? $detailData['itemData']['tax_rate_kbn_cd'] : '') }}" />
                            <img class="vector" id="img_tax_rate" src="/img/icon/vector.svg"
                                data-smm-open="search_tax_rate_kbn_modal" />
                            <input type="hidden" id="hidden_tax_rate" value="{{ old('hidden_tax_rate', isset($detailData['taxRate']) ? $detailData['taxRate'] : '') }}" name="hidden_tax_rate" />
                        </div>
                        <div class="textbox td_100px grid_wrapper_left txt_blue" id="names_tax_rate_kbn">
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="box">
                <div class="element_row">
                    <div class="element">
                        <div class="frame">
                            <div class="text_wrapper txt_required">名称入力区分：</div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="name_input_kbn" value="0"
                                        @if (old('name_input_kbn', isset($detailData['itemData']) ? $detailData['itemData']['name_input_kbn'] : '0') == 0) checked @endif />
                                    しない
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="name_input_kbn" value="1"
                                        @if (old('name_input_kbn', isset($detailData['itemData']) ? $detailData['itemData']['name_input_kbn'] : '') == 1) checked @endif />
                                    する
                                </label>
                            </div>
                        </div>
                        <div class="frame">
                            <div class="text_wrapper txt_required">&emsp;&emsp;削除区分：</div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="del_kbn" value="0"
                                        onchange="changeDelKbnItem(arguments[0], this)"
                                        @if (old('del_kbn', isset($detailData['itemData']) ? $detailData['itemData']['del_kbn'] : '0') == 0) checked  @endif />
                                    しない
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="del_kbn" value="1"
                                        onchange="changeDelKbnItem(arguments[0], this)"
                                        @if (old('del_kbn', isset($detailData['itemData']) ? $detailData['itemData']['del_kbn'] : '') == 1) checked @endif />
                                    する
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="element">
                        <div class="frame">
                            <div class="text_wrapper txt_required">メンバーサイト連携区分：</div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="ec_alignment_kbn" value="0"
                                        @if (old('ec_alignment_kbn', isset($detailData['itemData']) ? $detailData['itemData']['ec_alignment_kbn'] : '0') == 0) checked
                                        @endif />
                                    連動
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="ec_alignment_kbn" value="1"
                                        @if (old('ec_alignment_kbn', isset($detailData['itemData']) ? $detailData['itemData']['ec_alignment_kbn'] : '') == 1) checked @endif />
                                    表示無し
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="ec_alignment_kbn" value="2"
                                        @if (old('ec_alignment_kbn', isset($detailData['itemData']) ? $detailData['itemData']['ec_alignment_kbn'] : '') == 2) checked @endif />
                                    非連携
                                </label>
                            </div>
                        </div>
                        <div class="frame">
                            <div class="text_wrapper txt_required">&emsp;&emsp;&emsp;&emsp;&emsp;日本郵政区分：</div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="japan_post_office" value="0"
                                        @if (old('japan_post_office', isset($detailData['itemData']) ? $detailData['itemData']['japan_post_office'] : '0') == 0) checked 
                                        @endif />
                                    未
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="japan_post_office" value="1"
                                        @if (old('japan_post_office', isset($detailData['itemData']) ? $detailData['itemData']['japan_post_office'] : '') == 1) checked @endif />
                                    済
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="" name="japan_post_office" value="2"
                                        @if (old('japan_post_office', isset($detailData['itemData']) ? $detailData['itemData']['japan_post_office'] : '') == 2) checked @endif />
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
                                        <input type="text" id="retail_price_tax_out" name="retail_price_tax_out" class="element input_number_8 align-right" 
                                            data-limit-len="14" data-limit-minus
                                            onblur="eventBlurTaxAutoRetailPrice(arguments[0], this)"
                                            @if(!empty(old('retail_price_tax_out')))
                                                value="{{ old('retail_price_tax_out') }}"
                                            @elseif(!empty(isset($detailData['itemData'])))
                                                value="{{ number_format((int)$detailData['itemData']['retail_price_tax_out']) }}"
                                            @endif
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper">税込</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" id="retail_price_tax_in" name="retail_price_tax_in" class="element input_number_8 align-right" 
                                            data-limit-len="14" data-limit-minus
                                            @if(!empty(old('retail_price_tax_in')))
                                                value="{{ old('retail_price_tax_in') }}"
                                            @elseif(!empty(isset($detailData['itemData'])))
                                                value="{{ number_format((int)$detailData['itemData']['retail_price_tax_in']) }}"
                                            @endif
                                        />
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
                                        <input type="text" id="reference_retail_tax_out" name="reference_retail_tax_out" class="element input_number_8 align-right" 
                                            data-limit-len="14" data-limit-minus
                                            onblur="eventBlurTaxAutoReferenceRetail(arguments[0], this)"
                                            @if(!empty(old('reference_retail_tax_out')))
                                                value="{{ old('reference_retail_tax_out') }}"
                                            @elseif(!empty(isset($detailData['itemData'])))
                                                value="{{ number_format((int)$detailData['itemData']['reference_retail_tax_out']) }}"
                                            @endif
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper">税込</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" id="reference_retail_tax_in" name="reference_retail_tax_in" class="element input_number_8 align-right"
                                            data-limit-len="14" data-limit-minus
                                            @if(!empty(old('reference_retail_tax_in')))
                                                value="{{ old('reference_retail_tax_in') }}"
                                            @elseif(!empty(isset($detailData['itemData'])))
                                                value="{{ number_format((int)$detailData['itemData']['reference_retail_tax_in']) }}"
                                            @endif
                                        />
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
                                        <input type="text" step="0.1" id="purchase_price_tax_out" name="purchase_price_tax_out" class="element input_number_8 align-right" 
                                            data-limit-len="14" data-limit-minus
                                            onblur="eventBlurTaxAutoPurchasePrice(arguments[0], this)"
                                            @if(!empty(old('purchase_price_tax_out')))
                                                value="{{ old('purchase_price_tax_out') }}"
                                            @elseif(!empty(isset($detailData['itemData'])))
                                                value="{{ number_format((float)$detailData['itemData']['purchase_price_tax_out']) }}"
                                            @endif
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper">税込</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" step="0.1" id="purchase_price_tax_in" name="purchase_price_tax_in" class="element input_number_8 align-right"
                                            data-limit-len="14" data-limit-minus
                                            @if(!empty(old('purchase_price_tax_in')))
                                                value="{{ old('purchase_price_tax_in') }}"
                                            @elseif(!empty(isset($detailData['itemData'])))
                                                value="{{ number_format((float)$detailData['itemData']['purchase_price_tax_in']) }}"
                                            @endif
                                        />
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
                                        <input type="text" step="0.1" id="cost_price" name="cost_price" class="element input_number_8 align-right" 
                                            data-limit-len="14" data-limit-minus onblur="decimalAddFigure(this)"
                                            @if(!empty(old('cost_price')))
                                                value="{{ old('cost_price') }}"
                                            @elseif(!empty(isset($detailData['itemData'])))
                                                value="{{ number_format((float)$detailData['itemData']['cost_price']) }}"
                                            @endif
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper">粗利算出原価単価</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" step="0.1" id="profit_calculation_cost_price" name="profit_calculation_cost_price" class="element input_number_8 align-right" 
                                            data-limit-len="14" data-limit-minus  onblur="decimalAddFigure(this)"
                                            @if(!empty(old('profit_calculation_cost_price')))
                                                value="{{ old('profit_calculation_cost_price') }}"
                                            @elseif(!empty(isset($detailData['itemData'])))
                                                value="{{ number_format((float)$detailData['itemData']['profit_calculation_cost_price']) }}"
                                            @endif
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="box">
                <span id="alert-item-ec-item-cd" class="alert alert-danger"></span>
                <div class="group_100p">
                    <div class="element-form-rows">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">メンバーサイト商品コード</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" id="ec_item_cd" name="ec_item_cd" class="element" minlength="0"
                                        maxlength="20" size="20" onblur="eventBlurCodeautoMemberSiteItem(arguments[0], this)"
                                        value="{{ old('ec_item_cd', isset($detailData['memberSiteItemData']) ? $detailData['memberSiteItemData']['ec_item_cd'] : '') }}" />
                                    <img class="vector" id="img_ec_item_cd" src="/img/icon/vector.svg"
                                        data-smm-open="search_member_site_item_class" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">メンバーサイト商品名</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" id="ec_item_name" name="ec_item_name" class="element" minlength="0"
                                        maxlength="30" size="30"
                                        value="{{ old('ec_item_name', isset($detailData['memberSiteItemData']) ? $detailData['memberSiteItemData']['ec_item_name'] : '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">ランキング</div>
                            <div class="frame">
                                <div class="textbox">
                                    <input type="text" id="ranking" name="ranking" class="element" minlength="0" maxlength="3"
                                        size="5"
                                        value="{{ old('ranking', isset($detailData['memberSiteItemData']) ? $detailData['memberSiteItemData']['ranking'] : '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper"><br></div>
                            <label for="printed_products_flg">
                                <input type="checkbox" id="printed_products_flg" name="printed_products_flg" value="1"
                                    @if (old('printed_products_flg') == 1) checked @elseif (isset($detailData['memberSiteItemData']['printed_products_flg']) &&
                                            $detailData['memberSiteItemData']['printed_products_flg'] == 1) checked @endif />
                                <span class="checkbox_span">プリント商品</span>
                            </label>
                        </div>
                    </div><br><br>
                    <div class="element-form-rows-image">
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">商品画像1</div>
                                <div class="frame">
                                    @include('admin.common.image_form_item', [
                                    'name' => 'item_image_file_1',
                                    'data' => $detailData['memberSiteItemData']['item_image_file_1'] ?? null,
                                    'path' => $item_image_file_1_path ?? null,
                                    ])
                                </div>
                            </div><br>
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">商品画像2</div>
                                <div class="frame">
                                    @include('admin.common.image_form_item', [
                                    'name' => 'item_image_file_2',
                                    'data' => $detailData['memberSiteItemData']['item_image_file_2'] ?? null,
                                    'path' => $item_image_file_2_path ?? null,
                                    ])
                                </div>
                            </div><br>
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">商品画像3</div>
                                <div class="frame">
                                    @include('admin.common.image_form_item', [
                                    'name' => 'item_image_file_3',
                                    'data' => $detailData['memberSiteItemData']['item_image_file_3'] ?? null,
                                    'path' => $item_image_file_3_path ?? null,
                                    ])
                                </div>
                            </div><br>
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">商品画像4</div>
                                <div class="frame">
                                    @include('admin.common.image_form_item', [
                                    'name' => 'item_image_file_4',
                                    'data' => $detailData['memberSiteItemData']['item_image_file_4'] ?? null,
                                    'path' => $item_image_file_4_path ?? null,
                                    ])
                                </div>
                            </div>
                    </div><br>

                    <div class="element-form-rows-image">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">PDFファイル1</div>
                            <div class="frame">
                                @include('admin.common.pdf_form', [
                                'name' => 'pdf_file_1',
                                'data' => $detailData['memberSiteItemData']['pdf_file_1'] ?? null,
                                'path' => $pdf_file_1_path ?? null,
                                ])
                            </div>
                        </div><br>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">PDFファイル2</div>
                            <div class="frame">
                                @include('admin.common.pdf_form', [
                                'name' => 'pdf_file_2',
                                'data' => $detailData['memberSiteItemData']['pdf_file_2'] ?? null,
                                'path' => $pdf_file_2_path ?? null,
                                ])
                            </div>
                        </div><br>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">PDFファイル3</div>
                            <div class="frame">
                                @include('admin.common.pdf_form', [
                                'name' => 'pdf_file_3',
                                'data' => $detailData['memberSiteItemData']['pdf_file_3'] ?? null,
                                'path' => $pdf_file_3_path ?? null,
                                ])
                            </div>
                        </div><br>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">PDFファイル4</div>
                            <div class="frame">
                                @include('admin.common.pdf_form', [
                                'name' => 'pdf_file_4',
                                'data' => $detailData['memberSiteItemData']['pdf_file_4'] ?? null,
                                'path' => $pdf_file_4_path ?? null,
                                ])
                            </div>
                        </div><br>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">PDFファイル5</div>
                            <div class="frame">
                                @include('admin.common.pdf_form', [
                                'name' => 'pdf_file_5',
                                'data' => $detailData['memberSiteItemData']['pdf_file_5'] ?? null,
                                'path' => $pdf_file_5_path ?? null,
                                ])
                            </div>
                        </div>
                    </div><br>
                    <div class="element-form-rows-image">
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">商品バナー画像1</div>
                            <div class="frame">
                                @include('admin.common.image_form_item', [
                                'name' => 'item_banner_image_file_1',
                                'data' => $detailData['memberSiteItemData']['item_banner_image_file_1'] ?? null,
                                'path' => $item_banner_image_file_1_path ?? null,
                                ])
                            </div>
                        </div><br>
                        <div class="element-form element-form-columns">
                            <div class="text_wrapper">商品バナー画像2</div>
                            <div class="frame">
                                @include('admin.common.image_form_item', [
                                'name' => 'item_banner_image_file_2',
                                'data' => $detailData['memberSiteItemData']['item_banner_image_file_2'] ?? null,
                                'path' => $item_banner_image_file_2_path ?? null,
                                ])
                            </div>
                        </div>
                    </div></br>
                    <div class="element">
                        <div class="element-form-columns">
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">商品バナーURL1</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <a href="{{ old('item_banner_url_1', isset($detailData['memberSiteItemData']) ? $detailData['memberSiteItemData']['item_banner_url_1'] : '') }}"
                                            id="url_item_banner_url_1" target="_blank"><img class="vector"
                                                src="/img/icon/link.svg" /></a>
                                        <input type="text" name="item_banner_url_1" class="element" minlength="0"
                                            id="item_banner_url_1" maxlength="256" size="64"
                                            onblur="eventBlurUrl(arguments[0], this)"
                                            value="{{ old('item_banner_url_1', isset($detailData['memberSiteItemData']) ? $detailData['memberSiteItemData']['item_banner_url_1'] : '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="element">
                        <div class="element-form-columns">
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">商品バナーURL2</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <a href="{{ old('item_banner_url_2', isset($detailData['memberSiteItemData']) ? $detailData['memberSiteItemData']['item_banner_url_2'] : '') }}"
                                            id="url_item_banner_url_2" target="_blank"><img class="vector"
                                                src="/img/icon/link.svg" /></a>
                                        <input type="text" name="item_banner_url_2" class="element" minlength="0"
                                            id="item_banner_url_2" maxlength="256" size="64"
                                            onblur="eventBlurUrl(arguments[0], this)"
                                            value="{{ old('item_banner_url_2', isset($detailData['memberSiteItemData']) ? $detailData['memberSiteItemData']['item_banner_url_2'] : '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div></br>
                    <div class="element">
                        <div class="element-form-columns">
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">商品備考1</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" id="item_memo_1" name="item_memo_1" class="element" minlength="0"
                                            maxlength="30" size="30"
                                            value="{{ old('item_memo_2', isset($detailData['memberSiteItemData']) ? $detailData['memberSiteItemData']['item_memo_1'] : '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element-form-columns">
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">商品備考2</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" id="item_memo_2" name="item_memo_2" class="element" minlength="0"
                                            maxlength="30" size="30"
                                            value="{{ old('item_memo_2', isset($detailData['memberSiteItemData']) ? $detailData['memberSiteItemData']['item_memo_2'] : '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element-form-columns">
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">商品備考3</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" id="item_memo_3" name="item_memo_3" class="element" minlength="0"
                                            maxlength="30" size="30"
                                            value="{{ old('item_memo_3', isset($detailData['memberSiteItemData']) ? $detailData['memberSiteItemData']['item_memo_3'] : '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element-form-columns">
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">商品備考4</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" id="item_memo_4" name="item_memo_4" class="element" minlength="0"
                                            maxlength="30" size="30"
                                            value="{{ old('item_memo_4', isset($detailData['memberSiteItemData']) ? $detailData['memberSiteItemData']['item_memo_4'] : '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="element-form-columns">
                            <div class="element-form element-form-columns">
                                <div class="text_wrapper">商品備考5</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" id="item_memo_5" name="item_memo_5" class="element" minlength="0"
                                            maxlength="30" size="30"
                                            value="{{ old('item_memo_5', isset($detailData['memberSiteItemData']) ? $detailData['memberSiteItemData']['item_memo_5'] : '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br><br>
                    <div class="element-form-columns">
                        <div class="text_wrapper">おすすめ商品<span id="alert-item-ec-item-recommend" class="alert alert-danger"></span></div>
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
                                    <tbody class="grid_body" id="recommend_ec_items">
                                        @empty(old('recommend_ec_item_cd'))
                                            @if (isset($detailData['recommendData']) && count($detailData['recommendData']) > 0)
                                                @foreach ($detailData['recommendData'] as $data)
                                                    <tr>
                                                        <td class="grid_col_2 col_rec">
                                                            <div class="flex">
                                                                <input type="text" placeholder=""
                                                                    name="recommend_ec_item_cd[]" class="grid_textbox"
                                                                    value="{{ $data['ec_item_cd'] }}"
                                                                    onblur="eventBlurCodeautoMemberSiteItemRecommendationManagements(arguments[0], this)"
                                                                >
                                                                <img class="vector" src="/img/icon/vector.svg"
                                                                    data-smm-open="search_member_site_item_class" />
                                                            </div>
                                                        </td>
                                                        <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                                                name="recommend_ec_item_name[]" class="grid_textbox txt_blue"
                                                                value="{{ $data['ec_item_name'] }}" readonly></td>
                                                        <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                                                name="recommend_display_order[]" class="grid_textbox"
                                                                value="{{ $data['display_order'] }}"></td>
                                                        <td class="grid_col_2 col_rec"><button type="button"
                                                                name="" onclick="removeExample(this)"
                                                                class="display_none"
                                                                value=""><img
                                                                    src="{{ asset('/img/icon/trash.svg') }}"
                                                                    class="img_center"></button></td>
                                                        <input type="hidden" name="recommend_ec_item_id[]" value="{{ $data['ec_item_id'] }}">
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td class="grid_col_2 col_rec">
                                                        <div class="flex">
                                                            <input type="text" placeholder=""
                                                                name="recommend_ec_item_cd[]" class="grid_textbox"
                                                                value=""
                                                                onblur="eventBlurCodeautoMemberSiteItemRecommendationManagements(arguments[0], this)"
                                                            >
                                                            <img class="vector" src="/img/icon/vector.svg"
                                                                data-smm-open="search_member_site_item_class" data-toggle="modal" />
                                                        </div>
                                                    </td>
                                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                                            name="recommend_ec_item_name[]" class="grid_textbox txt_blue"
                                                            value="" readonly></td>
                                                    <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                                            name="recommend_display_order[]" class="grid_textbox"
                                                            value=""></td>
                                                    <td class="grid_col_2 col_rec"><button type="button"
                                                            onclick="removeExample(this)" name=""
                                                            class="display_none" value=""><img
                                                                src="{{ asset('/img/icon/trash.svg') }}"
                                                                class="img_center"></button></td>
                                                    <input type="hidden" name="recommend_ec_item_id[]" value="">
                                                </tr>
                                            @endif
                                        @else
                                            @for ($i = 0; $i < count(old('recommend_ec_item_cd')); $i++)
                                            <tr>
                                                <td class="grid_col_2 col_rec">
                                                    <div class="flex">
                                                        <input type="text" placeholder=""
                                                            name="recommend_ec_item_cd[]" class="grid_textbox"
                                                            value="{{ old("recommend_ec_item_cd.{$i}")}}"
                                                            onblur="eventBlurCodeautoMemberSiteItemRecommendationManagements(arguments[0], this)"
                                                        >
                                                        <img class="vector" src="/img/icon/vector.svg"
                                                            data-smm-open="search_member_site_item_class" />
                                                    </div>
                                                </td>
                                                <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                                        name="recommend_ec_item_name[]" class="grid_textbox txt_blue"
                                                        value="{{ old("recommend_ec_item_name.{$i}")}}" readonly></td>
                                                <td class="grid_col_2 col_rec"><input type="text" placeholder=""
                                                        name="recommend_display_order[]" class="grid_textbox"
                                                        value="{{ old("recommend_display_order.{$i}") }}"></td>
                                                <td class="grid_col_2 col_rec"><button type="button"
                                                        name="" onclick="removeExample(this)"
                                                        id="delete_ec{{ $i }}" class="display_none"
                                                        value=""><img
                                                            src="{{ asset('/img/icon/trash.svg') }}"
                                                            class="img_center"></button></td>
                                                <input type="hidden" name="recommend_ec_item_id[]" value="{{ old("recommend_ec_item_id.{$i}") }}">
                                            </tr>
                                            @endfor
                                        @endempty
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
            </div>
            <input type="hidden" id="hidden_detail_id"
                value="{{ old('hidden_detail_id', isset($detailData['itemData']) ? $detailData['itemData']['id'] : '') }}"
                name="hidden_detail_id" 
            />
            <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
            <button type="submit" id="update" name="update" class="display_none_all"></button>
            <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
            <button type="submit" id="redirect" name="redirect" class="display_none_all"
                value=""></button>
            <input type="hidden" id="redirect_hidden" name="redirect_hidden" class="display_none_all"
                value="" />
        </div>
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    @include('admin.master.search.item_class_thing5')
    @include('admin.master.search.item_class_thing6')
    @include('admin.master.search.item_class_thing7')
    @include('admin.master.search.supplier')
    @include('admin.master.search.color_pattern')
    @include('admin.master.search.color')
    @include('admin.master.search.size_pattern')
    @include('admin.master.search.size')
    @include('admin.master.search.tax_rate_kbn')
    @include('admin.master.search.brand1')
    @include('admin.master.search.game_category')
    @include('admin.master.search.genre')
    @include('admin.master.search.item_class_thing4')
    @include('admin.master.search.item_cd', ['includeDeleted' => true])
    @include('admin.master.search.member_site_item')
@endsection
