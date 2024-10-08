{{-- {{ dd($detailData['MtCatalogItem'][1]->ec_item_name) }} --}}
@extends('layouts.admin.app')
@section('page_title', 'ピックアップ検索注文入力（詳細）')
@section('title', 'ピックアップ検索注文入力（詳細）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
    <script src="{{ asset('/js/quii_editor.js') }}"></script>
    <script src="{{ asset('/js/calendar.js') }}"></script>
    <script type="module" src="{{ asset('js/master/ec/mt_catalog/detail.js') }}"></script>
@endsection

@section('content')
    @include('admin.master.search.catalog')
    @include('admin.master.search.member_site_item')
    @include('admin.common.calendar', ['calendarId' => 'calendar1'])
    @include('admin.common.calendar', ['calendarId' => 'calendar2'])
    <div class="main_contents">
        <form role="search" action="{{ route('master.ec.catalog.detail.update') }}" method="post" name="mtNoticeIndexForm"
            enctype="multipart/form-data" data-monitoring>
            @csrf
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    @if (isset($detailData['MtCatalog']['id']))
                        <button class="button" type="button" name="delete" data-toggle="modal" data-target="#modal_delete"
                            data-value="{{ isset($detailData) ? $detailData['MtCatalog']['id'] : '' }}">
                            <div class="text_wrapper">削除する</div>
                        </button>
                    @else
                        <button class="button" type="button" name="delete" data-toggle="modal" data-target="#modal_delete"
                            data-value="{{ isset($detailData) ? $detailData['MtCatalog']['id'] : '' }}" disabled>
                            <div class="text_wrapper">削除する</div>
                        </button>
                    @endif
                    @if (isset($detailData))
                        @if (isset($prevCode))
                            <button class="button" type="submit" name="prev"
                                value="{{ $detailData['MtCatalog']->catalog_cd }}">
                                <div class="text_wrapper_2">前頁</div>
                            </button>
                        @else
                            <button class="button" type="submit" name="prev" disabled>
                                <div class="text_wrapper_2">前頁</div>
                            </button>
                        @endif
                        @if (isset($nextCode))
                            <button class="button" type="submit" name="next"
                                value="{{ $detailData['MtCatalog']->catalog_cd }}">
                                <div class="text_wrapper_2">次頁</div>
                            </button>
                        @else
                            <button class="button" type="submit" name="next" disabled>
                                <div class="text_wrapper_2">次頁</div>
                            </button>
                        @endif
                    @else
                        <button class="button" type="submit" name="prev" disabled>
                            <div class="text_wrapper_2">前頁</div>
                        </button>
                        @if (isset($nextCode))
                            <button class="button" type="submit" name="next" value="">
                                <div class="text_wrapper_2">次頁</div>
                            </button>
                        @else
                            <button class="button" type="submit" name="next" disabled>
                                <div class="text_wrapper_2">次頁</div>
                            </button>
                        @endif
                    @endif
                    <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value="" class="button-2"
                        id="updateButton" data-url="" name="update2">
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
                    <div class="text_wrapper txt_required">カタログコード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="catalogcode" id="input_catalog" class="element input_number_4"
                                value="{{ old('catalogcode') ? old('catalogcode') : (isset($detailData['MtCatalog']) ? $detailData['MtCatalog']['catalog_cd'] : '') }}"
                                data-limit-len="4" data-limit-minus data-ac="catalog" data-monitoring-exclude>
                            <img class="vector" id="img_catalog" src="/img/icon/vector.svg"
                                data-smm-open="search_catalog_modal" />
                        </div>
                    </div>
                    <input type="hidden" id="hidden_catalog" value="" name="hidden_catalog" />
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_required">カタログ名</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="catalogtitle" id="names_catalog" class="element" minlength="0"
                                maxlength="100" size="70"
                                value="{{ old('catalogtitle') ? old('catalogtitle') : (isset($detailData['MtCatalog']) ? $detailData['MtCatalog']['catalog_name'] : '') }}" />
                        </div>
                    </div>
                </div>
            </div><br><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">公開開始日時</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" id="calendar1-year" name="release_start_datetime_year"
                            class="element textbox_40px" minlength="0" maxlength="4"
                            value="{{ old('release_start_datetime_year', isset($detailData['MtCatalog']['release_start_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtCatalog']['release_start_datetime'])->format('Y') : '') }}">年
                        <input type="text" id="calendar1-month" name="release_start_datetime_month"
                            class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ old('release_start_datetime_month', isset($detailData['MtCatalog']['release_start_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtCatalog']['release_start_datetime'])->format('m') : '') }}">月
                        <input type="text" id="calendar1-date" name="release_start_datetime_day"
                            class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ old('release_start_datetime_day', isset($detailData['MtCatalog']['release_start_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtCatalog']['release_start_datetime'])->format('d') : '') }}">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
                    </div>
                    <div class="textbox td_100px">
                        <input type="time" name="release_start_datetime_time" class="element" minlength="0"
                            maxlength="" size="5"
                            value="{{ old('release_start_datetime_time', isset($detailData['MtCatalog']['release_start_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtCatalog']['release_start_datetime'])->format('H:i') : '') }}">
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">公開終了日時</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" id="calendar2-year" name="release_end_datetime_year"
                            class="element textbox_40px" minlength="0" maxlength="4"
                            value="{{ old('release_end_datetime_year', isset($detailData['MtCatalog']['release_end_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtCatalog']['release_end_datetime'])->format('Y') : '') }}">年
                        <input type="text" id="calendar2-month" name="release_end_datetime_month"
                            class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ old('release_end_datetime_month', isset($detailData['MtCatalog']['release_end_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtCatalog']['release_end_datetime'])->format('m') : '') }}">月
                        <input type="text" id="calendar2-date" name="release_end_datetime_day"
                            class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ old('release_end_datetime_day', isset($detailData['MtCatalog']['release_end_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtCatalog']['release_end_datetime'])->format('d') : '') }}">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar2')">
                    </div>
                    <div class="textbox td_100px">
                        <input type="time" name="release_end_datetime_time" class="element" minlength="0"
                            maxlength="" size="5"
                            value="{{ old('release_end_datetime_time', isset($detailData['MtCatalog']['release_end_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtCatalog']['release_end_datetime'])->format('H:i') : '') }}">
                    </div>
                </div>
            </div><br>
            <div class="element-form-rows element-buttons flex_start">
                <div class="element-form element-form-rows">
                    <div class="frame">
                        <div class="text_wrapper">表示：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="display_flg" value="0"
                                    @if (old('display_flg') !== '1' ||
                                            (null === old('display_flg') && isset($detailData) && $detailData['MtCatalog']['display_flg'] !== 1)) || !isset($detailData)) checked @endif />
                                表示
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="display_flg" value="1"
                                    @if (old('display_flg') === '1' ||
                                            (null === old('display_flg') && isset($detailData) && $detailData['MtCatalog']['display_flg'] === 1)) checked @endif />
                                非表示
                            </label>
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-rows">
                    <div class="frame">
                        <div class="text_wrapper txt_required">表示順</div>
                        <div class="frame">
                            <div class="textbox">
                                <input type="text" name="display_sort_order" class="element" minlength="0"
                                    maxlength="3" size="3"
                                    value="{{ old('display_sort_order') ? old('display_sort_order') : (isset($detailData['MtCatalog']) ? $detailData['MtCatalog']['display_sort_order'] : '') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="element-form-rows element-buttons flex_start">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_required">画像</div>
                    @include('admin.common.image_form', [
                        'name' => 'image_file',
                        'data' => $detailData['MtCatalog'] ?? null,
                        'path' => $path ?? null,
                    ])
                </div>
            </div><br>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="frame">
                        <div class="text_wrapper txt_required">カタログ詳細：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="0" name="content_type" value="0"
                                    onClick="changeTextType(this.value);"
                                    @if (old(
                                            'content_type',
                                            isset($detailData['MtCatalog']['catalog_explanation_type'])
                                                ? $detailData['MtCatalog']['catalog_explanation_type']
                                                : 0) == 0) checked @endif />
                                テキスト
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="1" name="content_type" value="1"
                                    onClick="changeTextType(this.value);"
                                    @if (old(
                                            'content_type',
                                            isset($detailData['MtCatalog']['catalog_explanation_type'])
                                                ? $detailData['MtCatalog']['catalog_explanation_type']
                                                : 0) == 1) checked @endif />
                                リッチテキスト
                            </label>
                        </div>
                    </div>
                    <div>
                        @if (old(
                                'content_type',
                                isset($detailData['MtCatalog']['catalog_explanation_type'])
                                    ? $detailData['MtCatalog']['catalog_explanation_type']
                                    : 0) == 0)
                            <div class="element-form-rows" id="normal_area" style="display:block;">
                            @else
                                <div class="element-form-rows" id="normal_area" style="display:none;">
                        @endif
                        <div class="element-form element-form-columns">
                            <div class="frame">
                                <textarea id="" name="content" rows="15" cols="100" class="textarea">{!! null !== old('content')
                                    ? old('content')
                                    : (isset($detailData['MtCatalog']['catalog_explanation'])
                                        ? nl2br($detailData['MtCatalog']['catalog_explanation'])
                                        : '') !!}</textarea>
                            </div>
                        </div>
                    </div><br>
                    @if (old(
                            'content_type',
                            isset($detailData['MtCatalog']['catalog_explanation_type'])
                                ? $detailData['MtCatalog']['catalog_explanation_type']
                                : 0) == 1)
                        <div class="element-form-rows" id="rich_area" style="display:block;">
                        @else
                            <div class="element-form-rows" id="rich_area" style="display:none;">
                    @endif
                    <div id="quill_editor" class="rich_text_area">{!! null !== old('rich_text_contents')
                        ? old('rich_text_contents')
                        : (isset($detailData['MtCatalog']['catalog_explanation'])
                            ? nl2br($detailData['MtCatalog']['catalog_explanation'])
                            : '') !!}</div>
                </div>
                <div class="grid">
                    <table class="table_sticky" id="catalog_grid_table">
                        <thead class="grid_header">
                            <tr>
                                <td class="grid_wrapper_center td_20p">メンバーサイト商品コード</td>
                                <td class="grid_wrapper_center td_30px">メンバーサイト商品名</td>
                                <td class="grid_wrapper_center td_20p">商品画像</td>
                                <td rowspan="2" class="grid_wrapper_center td_10p">表示順</td>
                                <td rowspan="2" class="grid_wrapper_center td_10p">削除</td>
                            </tr>
                        </thead>
                        <tbody class="tbody_scroll">
                            @php
                                $loop = count(old('mt_catalog_items', $detailData['MtCatalogItem'] ?? []));
                                $loop = max($loop, 3);
                            @endphp
                            @for ($i = 0; $i < $loop; $i++)
                                @include('admin.master.ec.mt_catalog.catalog_item_form', [
                                    'i' => $i,
                                    'items' => $detailData['MtCatalogItem'] ?? null,
                                ])
                            @endfor
                        </tbody>
                    </table>
                    <div class="plus_rec plus_rec_left">
                        <div class="blue_text_wrapper" data-new-item="catalog_grid_table">+ 商品を追加する</div>
                    </div>
                </div>
                <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
                <button type="submit" id="update" name="update" class="display_none_all"></button>
                <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
                <button type="submit" id="sub_delete" name="sub_delete" class="display_none_all"
                    value=""></button>
                <button type="submit" id="redirect" name="redirect" class="display_none_all" value=""></button>
                <input type="hidden" name="hidden_detail_id"
                    value="{{ isset($detailData['MtCatalog']['id']) ? $detailData['MtCatalog']['id'] : '' }}">
                <input type="hidden" name="hidden_detail_code"
                    value="{{ isset($detailData['MtCatalog']['catalog_cd']) ? $detailData['MtCatalog']['catalog_cd'] : '' }}">
            </div>
            @include('components.menu.selected', ['view' => 'main'])
        </form>
    </div>
    <input type="hidden" name="rich_text_contents" id="rich_contents" value="">
    <div class="display_none_all">
        {{-- For autoCompleteMemberSiteItem --}}
        <span id="catalog-id">{{ $detailData['MtCatalog']['id'] ?? '0' }}</span>
    </div>
    <script>
        const fonts = [
            'Arial',
            'Arial Black',
            'Comic Sans MS',
            'Courier New',
            'Narrow',
            'Garamond',
            'Georgia',
            'Impact',
            'Sans Serif',
            'Serif',
            'Tahoma',
            'Trebuchet MS',
            'Verdana',
        ];
        const fontSizes = ['x-small', 'small', 'medium', 'large', 'x-large', 'xx-large', 'xxx-large'];
        var Font = Quill.import('attributors/style/font');
        var Size = Quill.import('attributors/style/size');
        Font.whitelist = fonts;
        Size.whitelist = fontSizes;
        Quill.register(Font, true);
        Quill.register(Size, true);


        var quill = new Quill('#quill_editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike', {
                        'script': 'sub'
                    }, {
                        'script': 'super'
                    }],
                    [{
                        'font': fonts
                    }, {
                        'size': fontSizes
                    }, {
                        'header': [false, 1, 2, 3, 4, 5, 6]
                    }],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }, 'clean'],
                    [{
                        'list': 'bullet'
                    }, {
                        'list': 'ordered'
                    }],
                    [{
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    [{
                        'align': []
                    }],
                ]
            },
        });
    </script>
@endsection
