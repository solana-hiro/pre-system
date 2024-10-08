@extends('layouts.admin.app')
@section('page_title', 'TOP自由領域入力（詳細）')
@section('title', 'TOP自由領域入力（詳細）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
    <script src="{{ asset('/js/quii_editor.js') }}"></script>
    <script src="{{ asset('/js/calendar.js') }}"></script>
    <script type="module" src="{{ asset('js/master/ec/mt_top_free_area/detail.js') }}"></script>
@endsection

@section('content')
    <div class="main_contents">
        <form role="search" action="{{ route('master.ec.top_free_area.detail.update') }}" method="post"
            name="mtTopFreeAreaIndexForm" enctype="multipart/form-data" data-monitoring>
            @csrf
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    @if (isset($detailData['MtTopFreeArea']))
                        <button class="button" type="button" name="delete" data-toggle="modal" data-target="#modal_delete"
                            data-value="{{ isset($detailData['MtTopFreeArea']) ? $detailData['MtTopFreeArea']['id'] : '' }}">
                            <div class="text_wrapper">削除する</div>
                        </button>
                    @else
                        <button class="button" type="button" name="delete" data-toggle="modal" data-target="#modal_delete"
                            data-value="{{ isset($detailData['MtTopFreeArea']) ? $detailData['MtTopFreeArea']['id'] : '' }}"
                            disabled>
                            <div class="text_wrapper">削除する</div>
                        </button>
                    @endif

                    <button type="submit" class="button" name="prev"
                        @if (isset($prevCode)) value="{{ $prevCode->id }}" @endif
                        @if (!isset($prevCode)) disabled @endif>
                        <div class="text_wrapper_2">前頁</div>
                    </button>
                    <button type="submit" class="button" name="next"
                        @if (isset($nextCode)) value="{{ $nextCode->id }}" @endif
                        @if (!isset($nextCode)) disabled @endif>
                        <div class="text_wrapper_2">次頁</div>
                    </button>
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
                    <div class="text_wrapper txt_required">コード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="input_area_cd" id="input_top_free_area"
                                class="element input_number_4"
                                onblur="eventBlurCodeautoTopFreeAreaRedirect(arguments[0], this)" minlength="0"
                                value="{{ old('input_area_cd') ? old('input_area_cd') : (isset($detailData['MtTopFreeArea']) ? $detailData['MtTopFreeArea']['area_cd'] : '') }}"
                                data-limit-len="4" data-limit-minus data-ac="topFreeArea" data-monitoring-exclude />
                            <img class="vector" id="img_top_free_area" src="/img/icon/vector.svg"
                                data-smm-open="search_top_free_area_modal" />
                        </div>
                        <input type="hidden" id="hidden_top_free_area" value="" name="hidden_top_free_area" />
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_required">タイトル</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="input_area_title" class="element" minlength="0" maxlength="100"
                                size="100"
                                value="{{ old('input_area_title', $detailData['MtTopFreeArea']['area_title'] ?? '') }}" />
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="frame">
                        <div class="text_wrapper">設置位置：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="setting_position" value="0"
                                    @if (old('setting_position', $detailData['MtTopFreeArea']['setting_position'] ?? 0) == 0) checked @endif />
                                スライド（制限なし）
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="setting_position" value="1"
                                    @if (old('setting_position', $detailData['MtTopFreeArea']['setting_position'] ?? 0) == 1) checked @endif />
                                サブ（最大２つ）
                            </label>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="element-form-rows">
                <div class="element-form">
                    <div class="frame" style="margin-left: 0px">
                        <div class="text_wrapper">内容：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="0" name="content_type" value="0"
                                    onclick="changeTextType(this.value);" value="0"
                                    @if (old('content_type', $detailData['MtTopFreeArea']['content_type'] ?? 0) == 0) checked @endif>
                                テキスト
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="1" name="content_type"
                                    onclick="changeTextType(this.value);" value="1"
                                    @if (old('content_type', $detailData['MtTopFreeArea']['content_type'] ?? 0) == 1) checked @endif>
                                リッチテキスト
                            </label>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="element-form-rows">
                <div class="element-form">
                    <div class="element-form-rows" id="normal_area"
                        @if (old('content_type', $detailData['MtTopFreeArea']['content_type'] ?? 0) == 0) style="display:block;" @endif
                        @if (old('content_type', $detailData['MtTopFreeArea']['content_type'] ?? 0) == 1) style="display:none;" @endif>
                        <div class="element-form element-form-columns">
                            <div class="frame">
                                <textarea id="" name="content" rows="15" cols="100" class="textarea">{!! old('content', $detailData['MtTopFreeArea']['content'] ?? '') !!}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="element-form-rows" id="rich_area"
                        @if (old('content_type', $detailData['MtTopFreeArea']['content_type'] ?? 0) == 0) style="display:none;" @endif
                        @if (old('content_type', $detailData['MtTopFreeArea']['content_type'] ?? 0) == 1) style="display:block;" @endif>
                        <div id="quill_editor" class="rich_text_area">{!! old('rich_text_contents', $detailData['MtTopFreeArea']['content'] ?? '') !!}</div>
                    </div>
                </div>
            </div><br>
            <div class="element-form-rows element-buttons flex_start">
                <div class="element-form element-form-columns">
                    <div class="text_wrapper">画像</div>
                    @include('admin.common.image_form', [
                        'name' => 'image_file',
                        'data' => $detailData['MtTopFreeArea'] ?? null,
                        'path' => $path ?? null,
                    ])
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">公開開始日時</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" id="calendar1-year" name="release_start_datetime_year"
                            class="element textbox_40px" minlength="0" maxlength="4"
                            value="{{ old('release_start_datetime_year', isset($detailData['MtTopFreeArea']['release_start_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtTopFreeArea']['release_start_datetime'])->format('Y') : '') }}">年
                        <input type="text" id="calendar1-month" name="release_start_datetime_month"
                            class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ old('release_start_datetime_month', isset($detailData['MtTopFreeArea']['release_start_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtTopFreeArea']['release_start_datetime'])->format('m') : '') }}">月
                        <input type="text" id="calendar1-date" name="release_start_datetime_day"
                            class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ old('release_start_datetime_day', isset($detailData['MtTopFreeArea']['release_start_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtTopFreeArea']['release_start_datetime'])->format('d') : '') }}">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
                    </div>
                    <div class="textbox td_100px">
                        <input type="time" name="release_start_datetime_time" class="element" minlength="0"
                            maxlength="" size="5"
                            value="{{ old('release_start_datetime_time', isset($detailData['MtTopFreeArea']['release_start_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtTopFreeArea']['release_start_datetime'])->format('H:i') : '') }}">
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">公開終了日時</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" id="calendar2-year" name="release_end_datetime_year"
                            class="element textbox_40px" minlength="0" maxlength="4"
                            value="{{ old('release_end_datetime_year', isset($detailData['MtTopFreeArea']['release_end_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtTopFreeArea']['release_end_datetime'])->format('Y') : '') }}">年
                        <input type="text" id="calendar2-month" name="release_end_datetime_month"
                            class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ old('release_end_datetime_month', isset($detailData['MtTopFreeArea']['release_end_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtTopFreeArea']['release_end_datetime'])->format('m') : '') }}">月
                        <input type="text" id="calendar2-date" name="release_end_datetime_day"
                            class="element textbox_24px" minlength="0" maxlength="2"
                            value="{{ old('release_end_datetime_day', isset($detailData['MtTopFreeArea']['release_end_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtTopFreeArea']['release_end_datetime'])->format('d') : '') }}">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar2')">
                    </div>
                    <div class="textbox td_100px">
                        <input type="time" name="release_end_datetime_time" class="element" minlength="0"
                            maxlength="" size="5"
                            value="{{ old('release_end_datetime_time', isset($detailData['MtTopFreeArea']['release_end_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['MtTopFreeArea']['release_end_datetime'])->format('H:i') : '') }}">
                    </div>
                </div>
            </div><br>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="frame">
                        <div class="text_wrapper">表示：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="display_flg" value="0"
                                    @if (old(
                                            'display_flg',
                                            isset($detailData['MtTopFreeArea']['display_flg']) && $detailData['MtTopFreeArea']['display_flg']) !== 1) checked @endif />
                                表示
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="display_flg" value="1"
                                    @if (old(
                                            'display_flg',
                                            isset($detailData['MtTopFreeArea']['display_flg']) && $detailData['MtTopFreeArea']['display_flg'] === 1)) checked @endif />
                                非表示
                            </label>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper txt_required">表示順</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="display_sort_order" class="element" minlength="0" maxlength="3"
                            size="3"
                            value="{{ old('display_sort_order', isset($detailData['MtTopFreeArea']['display_sort_order']) ? $detailData['MtTopFreeArea']['display_sort_order'] : '') }}" />
                    </div>
                </div>
            </div><br>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="frame">
                        <div class="text_wrapper">公開先：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="publication_destination_flg_0"
                                    name="publication_destination_flg" onclick="publicationDestinationFlgClick();"
                                    value="0" @if (old('publication_destination_flg', $detailData['MtTopFreeArea']['publication_destination_flg'] ?? 0) == 0) checked @endif>
                                全体に公開
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="publication_destination_flg_1"
                                    name="publication_destination_flg" onclick="publicationDestinationFlgClick();"
                                    value="1" @if (old('publication_destination_flg', $detailData['MtTopFreeArea']['publication_destination_flg'] ?? 0) == 1) checked @endif>
                                指定した得意先分類に対して公開
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="publication_destination_flg_2"
                                    name="publication_destination_flg" onclick="publicationDestinationFlgClick();"
                                    value="2" @if (old('publication_destination_flg', $detailData['MtTopFreeArea']['publication_destination_flg'] ?? 0) == 2) checked @endif>
                                指定した得意先に対して公開
                            </label>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="element-form-rows">
                <div id="customer_classes"
                    @if (old('publication_destination_flg', $detailData['MtTopFreeArea']['publication_destination_flg'] ?? 0) == 1) style="display:block;" @else style="display:none;" @endif>
                    <div class="element-form-columns">
                        <div class="elements_both">
                            <div class="button_area_small_left">
                                <div class="box height_100p">
                                    <div class="group height_100p">
                                        <div class="element-form-columns">
                                            <div class="text_wrapper">販売パターン１ 公開種別</div>
                                            <div class="div">
                                                @php
                                                    $value1Data = [];
                                                    if (isset($detailData)) {
                                                        $value1 = $detailData['MtTopFreeAreaPublicationDestination']
                                                            ->where(
                                                                'mt_top_free_area_id',
                                                                $detailData['MtTopFreeArea']['id'],
                                                            )
                                                            ->where('public_classification', 0);
                                                        $pbData = $value1->where('public_classification', 0);
                                                        foreach ($value1 as $vl) {
                                                            $value = $vl['mt_publication_destination_id'];
                                                            if (null !== $value) {
                                                                $value1Data[] = $value;
                                                            }
                                                        }
                                                    } else {
                                                        $value1Data = null;
                                                    }
                                                    if (empty($value1Data)) {
                                                        $value1Data = null;
                                                    } else {
                                                        $value1Data = count($value1Data) === 0 ? null : $value1Data;
                                                    }
                                                @endphp
                                                <label class="text_wrapper_2">
                                                    <input type="radio" id="" name="class1_type"
                                                        value="0"
                                                        onclick="clickCustomerPublicType([this.name, this.value]);"
                                                        @if (!(old('class1_type') === '1' && (null === old('class1_type') && $value1Data !== null))) checked @endif />
                                                    全体
                                                </label>
                                            </div><br>
                                            <div class="div">
                                                <label class="text_wrapper_2">
                                                    <input type="radio" id="" name="class1_type"
                                                        value="1"
                                                        onclick="clickCustomerPublicType([this.name, this.value]);"
                                                        @if (old('class1_type') === '1' || (null === old('class1_type') && $value1Data !== null)) checked @endif />
                                                    指定
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="element-form-right" id="customer_class1_search_detail"
                                @if (old('class1_type', 0) == 0 && empty($value1Data)) style="display: none" @else style="display: block" @endif>
                                <div class="box height_100p">
                                    <div class="element-form-rows button_area_small_rows">
                                        <div class="text_wrapper">販売パターン１</div>
                                        <div class="button_area button_area_small">
                                            <div class="div">
                                                <button class="button button_area_small_button" type="button">
                                                    <div class="text_wrapper_2 button_area_small_text"
                                                        data-smm-open="search_customer_class_thing1_modal">検索して追加
                                                    </div>
                                                </button>
                                                <button class="button button_area_small_button" type="button"
                                                    onclick="resetCustomerClass1();return false;">
                                                    <div class="text_wrapper button_area_small_text">クリア</div>
                                                </button>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="element-form-rows button_area_small_rows">
                                        <div class="div">
                                            <div class="box_scroll" id="searchCustomerClass1List">
                                                @if (session('_old_input'))
                                                    @foreach (session('_old_input')['customer_class1'] ?? [] as $input)
                                                        <input type="text" class="search_list"
                                                            name="customer_class1[]" value="{{ $input }}"
                                                            readonly>
                                                    @endforeach
                                                    @foreach (session('_old_input')['hidden_customer_class1'] ?? [] as $input)
                                                        <input type="hidden" name="hidden_customer_class1[]"
                                                            value="{{ $input }}">
                                                    @endforeach
                                                @elseif (isset($detailData))
                                                    @foreach ($pbData as $pb)
                                                        @php $rec = $allData['MtCustomerClass1']->where('id', $pb['mt_publication_destination_id'])->first() @endphp
                                                        @if ($rec)
                                                            <input type="text" class="search_list"
                                                                name="customer_class1[]"
                                                                value="{{ $rec['customer_class_cd'] }}:{{ $rec['customer_class_name'] }}"
                                                                readonly>
                                                            <input type="hidden" name="hidden_customer_class1[]"
                                                                value="{{ $rec['id'] }}">
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="element-form-columns">
                        <div class="elements_both">
                            <div class="button_area_small_left">
                                <div class="box height_100p">
                                    <div class="group height_100p">
                                        <div class="element-form-columns">
                                            <div class="text_wrapper">業種・特徴2 公開種別</div>
                                            <div class="div">
                                                @php
                                                    $value2Data = [];
                                                    if (isset($detailData)) {
                                                        $value2 = $detailData['MtTopFreeAreaPublicationDestination']
                                                            ->where(
                                                                'mt_top_free_area_id',
                                                                $detailData['MtTopFreeArea']['id'],
                                                            )
                                                            ->where('public_classification', 1);
                                                        $pbData = $value2->where('public_classification', 1);
                                                        foreach ($value2 as $vl) {
                                                            $value = $vl['mt_publication_destination_id'];
                                                            if (null !== $value) {
                                                                $value2Data[] = $value;
                                                            }
                                                        }
                                                    } else {
                                                        $value2Data = null;
                                                    }
                                                    if (empty($value2Data)) {
                                                        $value2Data = null;
                                                    } else {
                                                        $value2Data = count($value2Data) === 0 ? null : $value2Data;
                                                    }
                                                @endphp
                                                <label class="text_wrapper_2">
                                                    <input type="radio" id="" name="class2_type"
                                                        value="0"
                                                        onclick="clickCustomerPublicType([this.name, this.value]);"
                                                        @if (!(old('class2_type') === '1' && (null === old('class2_type') && $value2Data !== null))) checked @endif />
                                                    全体
                                                </label>
                                            </div><br>
                                            <div class="div">
                                                <label class="text_wrapper_2">
                                                    <input type="radio" id="" name="class2_type"
                                                        value="1"
                                                        onclick="clickCustomerPublicType([this.name, this.value]);"
                                                        @if (old('class2_type') === '1' || (null === old('class2_type') && $value2Data !== null)) checked @endif />
                                                    指定
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="element-form-right" id="customer_class2_search_detail"
                                @if (old('class2_type', 0) == 0 && empty($value2Data)) style="display: none" @else style="display: block" @endif>
                                <div class="box height_100p">
                                    <div class="element-form-rows button_area_small_rows">
                                        <div class="text_wrapper">業種・特徴2</div>
                                        <div class="button_area button_area_small">
                                            <div class="div">
                                                <button type="button" class="button button_area_small_button">
                                                    <div class="text_wrapper_2 button_area_small_text"
                                                        data-smm-open="search_customer_class_thing2_modal">検索して追加</div>
                                                </button>
                                                <button type="button" class="button button_area_small_button"
                                                    onclick="resetCustomerClass2();return false;">
                                                    <div class="text_wrapper button_area_small_text">クリア</div>
                                                </button>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="element-form-rows button_area_small_rows">
                                        <div class="div">
                                            <div class="box_scroll" id="searchCustomerClass2List">
                                                @if (session('_old_input'))
                                                    @foreach (session('_old_input')['customer_class2'] ?? [] as $input)
                                                        <input type="text" class="search_list"
                                                            name="customer_class2[]" value="{{ $input }}"
                                                            readonly>
                                                    @endforeach
                                                    @foreach (session('_old_input')['hidden_customer_class2'] ?? [] as $input)
                                                        <input type="hidden" name="hidden_customer_class2[]"
                                                            value="{{ $input }}">
                                                    @endforeach
                                                @elseif (isset($detailData))
                                                    @foreach ($pbData as $pb)
                                                        @php $rec = $allData['MtCustomerClass2']->where('id', $pb['mt_publication_destination_id'])->first() @endphp
                                                        @if ($rec)
                                                            <input type="text" class="search_list"
                                                                name="customer_class2[]"
                                                                value="{{ $rec['customer_class_cd'] }}:{{ $rec['customer_class_name'] }}"
                                                                readonly>
                                                            <input type="hidden" id="hiddenSearchCustomerClass2List"
                                                                name="hidden_customer_class2[]"
                                                                value="{{ $rec['id'] }}">
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="element-form-columns">
                        <div class="elements_both">
                            <div class="button_area_small_left">
                                <div class="box height_100p">
                                    <div class="group height_100p">
                                        <div class="element-form-columns">
                                            <div class="text_wrapper">ランク3 公開種別</div>
                                            <div class="div">
                                                @php
                                                    $value3Data = [];
                                                    if (isset($detailData)) {
                                                        $value3 = $detailData['MtTopFreeAreaPublicationDestination']
                                                            ->where(
                                                                'mt_top_free_area_id',
                                                                $detailData['MtTopFreeArea']['id'],
                                                            )
                                                            ->where('public_classification', 2);
                                                        $pbData = $value3->where('public_classification', 2);
                                                        foreach ($value3 as $vl) {
                                                            $value = $vl['mt_publication_destination_id'];
                                                            if (null !== $value) {
                                                                $value3Data[] = $value;
                                                            }
                                                        }
                                                    } else {
                                                        $value3Data = null;
                                                    }
                                                    if (empty($value3Data)) {
                                                        $value3Data = null;
                                                    } else {
                                                        $value3Data = count($value3Data) === 0 ? null : $value3Data;
                                                    }
                                                @endphp
                                                <label class="text_wrapper_2">
                                                    <input type="radio" id="" name="class3_type"
                                                        value="0"
                                                        onclick="clickCustomerPublicType([this.name, this.value]);"
                                                        @if (!(old('class3_type') === '1' && (null === old('class3_type') && $value3Data !== null))) checked @endif />
                                                    全体
                                                </label>
                                            </div><br>
                                            <div class="div">
                                                <label class="text_wrapper_2">
                                                    <input type="radio" id="" name="class3_type"
                                                        value="1"
                                                        onclick="clickCustomerPublicType([this.name, this.value]);"
                                                        @if (old('class3_type') === '1' || (null === old('class3_type') && $value3Data !== null)) checked @endif />
                                                    指定
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="element-form-right" id="customer_class3_search_detail"
                                @if (old('class3_type', 0) == 0 && empty($value3Data)) style="display: none" @else style="display: block" @endif>
                                <div class="box height_100p">
                                    <div class="element-form-rows button_area_small_rows">
                                        <div class="text_wrapper">ランク3</div>
                                        <div class="button_area button_area_small">
                                            <div class="div">
                                                <button type="button" class="button button_area_small_button">
                                                    <div class="text_wrapper_2 button_area_small_text"
                                                        data-smm-open="search_rank3_modal">
                                                        検索して追加
                                                    </div>
                                                </button>
                                                <button type="button" class="button button_area_small_button"
                                                    onclick="resetCustomerClass3();return false;">
                                                    <div class="text_wrapper button_area_small_text">クリア</div>
                                                </button>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="element-form-rows button_area_small_rows">
                                        <div class="div">
                                            <div class="box_scroll" id="searchCustomerClass3List">
                                                @if (session('_old_input'))
                                                    @foreach (session('_old_input')['customer_class3'] ?? [] as $input)
                                                        <input type="text" class="search_list"
                                                            name="customer_class3[]" value="{{ $input }}"
                                                            readonly>
                                                    @endforeach
                                                    @foreach (session('_old_input')['hidden_customer_class3'] ?? [] as $input)
                                                        <input type="hidden" name="hidden_customer_class3[]"
                                                            value="{{ $input }}">
                                                    @endforeach
                                                @elseif (isset($detailData))
                                                    @foreach ($pbData as $pb)
                                                        @php $rec = $allData['MtCustomerClass3']->where('id', $pb['mt_publication_destination_id'])->first() @endphp
                                                        @if ($rec)
                                                            <input type="text" class="search_list"
                                                                name="customer_class3[]"
                                                                value="{{ $rec['customer_class_cd'] }}:{{ $rec['customer_class_name'] }}"
                                                                readonly>
                                                            <input type="hidden" id="hiddenSearchCustomerClass3List"
                                                                name="hidden_customer_class3[]"
                                                                value="{{ $rec['id'] }}">
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div id="customers"
                    @if (old('publication_destination_flg', $detailData['MtTopFreeArea']['publication_destination_flg'] ?? 0) == 2) style="display:block;" @else style="display:none;" @endif>
                    <div class="element-form-columns">
                        <div class="elements_both">
                            <div class="button_area_small_left">
                                <div class="box height_100p">
                                    <div class="group height_100p">
                                        <div class="element-form-columns">
                                            <div class="text_wrapper"> 得意先 公開種別</div>
                                            @php
                                                $value4Data = [];
                                                if (isset($detailData)) {
                                                    $value4 = $detailData['MtTopFreeAreaPublicationDestination']
                                                        ->where(
                                                            'mt_top_free_area_id',
                                                            $detailData['MtTopFreeArea']['id'],
                                                        )
                                                        ->where('public_classification', 3);
                                                    $pbData = $value4->where('public_classification', 3);
                                                    foreach ($value4 as $vl) {
                                                        $value = $vl['mt_publication_destination_id'];
                                                        if (null !== $value) {
                                                            $value4Data[] = $value;
                                                        }
                                                    }
                                                } else {
                                                    $value4Data = null;
                                                }
                                                if (empty($value4Data)) {
                                                    $value4Data = null;
                                                } else {
                                                    $value4Data = count($value4Data) === 0 ? null : $value4Data;
                                                }
                                            @endphp
                                            <div class="div">
                                                <label class="text_wrapper_2">
                                                    <input type="radio" id="" name="customer_type"
                                                        value="0"
                                                        onclick="clickCustomerPublicType([this.name, this.value]);"
                                                        @if (!(old('customer_type') === '1' && (null === old('customer_type') && $value4Data !== null))) checked @endif />
                                                    全体
                                                </label>
                                            </div><br>
                                            <div class="div">
                                                <label class="text_wrapper_2">
                                                    <input type="radio" id="" name="customer_type"
                                                        value="1"
                                                        onclick="clickCustomerPublicType([this.name, this.value]);"
                                                        @if (old('customer_type') === '1' || (null === old('customer_type') && $value4Data !== null)) checked @endif />
                                                    指定
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="element-form-right" id="customer_search_detail"
                                @if (old('customer_type', 0) == 0 && empty($value4Data)) style="display: none" @else style="display: block" @endif>
                                <div class="box height_100p">
                                    <div class="element-form-rows button_area_small_rows">
                                        <div class="text_wrapper">得意先</div>
                                        <div class="button_area button_area_small">
                                            <div class="div">
                                                <button type="button" class="button button_area_small_button">
                                                    <div class="text_wrapper_2 button_area_small_text"
                                                        data-smm-open="search_customer_modal">
                                                        検索して追加</div>
                                                </button>
                                                <button type="button" class="button button_area_small_button"
                                                    onclick="resetCustomer();return false;">
                                                    <div class="text_wrapper button_area_small_text">クリア</div>
                                                </button>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="element-form-rows button_area_small_rows">
                                        <div class="div">
                                            <div class="box_scroll" id="searchCustomerList">
                                                @if (session('_old_input'))
                                                    @foreach (session('_old_input')['customer'] ?? [] as $input)
                                                        <input type="text" class="search_list" name="customer[]"
                                                            value="{{ $input }}" readonly>
                                                    @endforeach
                                                    @foreach (session('_old_input')['hidden_customer'] ?? [] as $input)
                                                        <input type="hidden" name="hidden_customer[]"
                                                            value="{{ $input }}">
                                                    @endforeach
                                                @elseif (isset($detailData))
                                                    @foreach ($pbData as $pb)
                                                        @php $rec = $allData['MtCustomer']->where('id', $pb['mt_publication_destination_id'])->first() @endphp
                                                        @if ($rec)
                                                            <input type="text" disabled="" class="search_list"
                                                                name="customer[]"
                                                                value="{{ $rec['customer_cd'] }}:{{ $rec['customer_name'] }}">
                                                            <input type="hidden" id="hiddenSearchCustomerList"
                                                                name="hidden_customer[]" value="{{ $rec['id'] }}">
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="hidden_detail_id"
                            value="{{ isset($detailData['MtTopFreeArea']) ? $detailData['MtTopFreeArea']['id'] : '' }}">
                        <input type="hidden" name="rich_text_contents" id="rich_contents">
                        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
                        <button type="submit" id="update" name="update" class="display_none_all"></button>
                        <button type="submit" id="delete" name="delete" class="display_none_all"
                            value=""></button>
                        <button type="submit" id="redirect" name="redirect" class="display_none_all"
                            value=""></button>
                    </div>
                </div>
            </div>
            @include('components.menu.selected', ['view' => 'main'])
        </form>
        @include('admin.master.search.top_free_area')
        @include('admin.master.search.customer', [
            'option' => 'list',
            'target' => 'searchCustomerList',
            'oValue' => 'customer',
        ])
        @include('admin.master.search.customer_class_thing1', [
            'option' => 'list',
            'target' => 'searchCustomerClass1List',
            'oValue' => 'customer_class1',
        ])
        @include('admin.master.search.customer_class_thing2', [
            'option' => 'list',
            'target' => 'searchCustomerClass2List',
            'oValue' => 'customer_class2',
        ])
        @include('admin.master.search.rank3', [
            'option' => 'list',
            'target' => 'searchCustomerClass3List',
            'oValue' => 'customer_class3',
        ])
        @include('admin.common.calendar', ['calendarId' => 'calendar1'])
        @include('admin.common.calendar', ['calendarId' => 'calendar2'])
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
