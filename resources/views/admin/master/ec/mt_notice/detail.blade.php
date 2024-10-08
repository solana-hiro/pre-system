@extends('layouts.admin.app')
@section('page_title', 'お知らせ入力（詳細）')
@section('title', 'お知らせ入力（詳細）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
    <script src="{{ asset('/js/quii_editor.js') }}"></script>
    <script src="{{ asset('/js/calendar.js') }}"></script>
    <script type="module" src="{{ asset('js/master/ec/mt_notice/detail.js') }}"></script>
@endsection

@section('content')
    <div class="main_contents">
        <form role="search" action="{{ route('master.ec.notice.detail.update') }}" method="post" name="mtNoticeIndexForm"
            enctype="multipart/form-data" data-monitoring>
            @csrf
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    @if (isset($detailData['id']))
                        <button class="button" type="button" name="delete" data-toggle="modal" data-target="#modal_delete"
                            data-value="{{ isset($detailData) ? $detailData['id'] : '' }}">
                            <div class="text_wrapper">削除する</div>
                        </button>
                    @else
                        <button class="button" type="button" name="delete" data-toggle="modal" data-target="#modal_delete"
                            data-value="{{ isset($detailData) ? $detailData['id'] : '' }}" disabled>
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
                    <div class="text_wrapper txt_required">お知らせコード</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="number" name="noticecd" class="element input_number_4"
                                value="{{ old('noticecd', $detailData['notice_cd'] ?? '') }}" data-limit-len="4"
                                data-limit-minus data-ac="notice" data-monitoring-exclude>
                            <img class="vector" id="img_notice" src="/img/icon/vector.svg"
                                data-smm-open="search_notice_modal" />
                        </div>
                    </div>
                </div>
                <div class="element-form element-form-columns">
                    <div class="text_wrapper txt_required">タイトル</div>
                    <div class="frame">
                        <div class="textbox">
                            <input type="text" name="noticetitle" class="element" minlength="0" maxlength="100"
                                size="50"
                                value="{{ old('noticetitle') ? old('noticetitle') : (isset($detailData) ? $detailData['title'] : '') }}" />
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="element-form-rows">
                <div class="element-form element-form-columns">
                    <div class="frame">
                        <div class="text_wrapper">ニュース種別：</div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="news_kind" value="0"
                                    @if (!isset($detailData['news_kind']) || $detailData['news_kind'] === 0) checked @endif />
                                通常のお知らせ
                            </label>
                        </div>
                        <div class="div">
                            <label class="text_wrapper_2">
                                <input type="radio" id="" name="news_kind" value="1"
                                    @if (isset($detailData['news_kind']) && $detailData['news_kind'] === 1) checked @endif />
                                キャンペーン
                            </label>
                        </div>
                    </div>
                    <div>
                    </div>
                    <div class="element-form-rows">
                        <div class="element-form element-form-columns">
                            <div class="frame">
                                <div class="text_wrapper">お知らせ内容：</div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="content_type" value="0"
                                            onClick="changeTextType(this.value);"
                                            @if (old('content_type', isset($detailData['notice_content_type']) ? $detailData['notice_content_type'] : 1) == 0) checked @endif />
                                        テキスト
                                    </label>
                                </div>
                                <div class="div">
                                    <label class="text_wrapper_2">
                                        <input type="radio" id="" name="content_type"
                                            onClick="changeTextType(this.value);" value="1"
                                            @if (old('content_type', isset($detailData['notice_content_type']) ? $detailData['notice_content_type'] : 1) == 1) checked @endif />
                                        リッチテキスト
                                    </label>
                                </div>
                            </div>
                            <div>
                            </div>
                            <div class="element-form-rows" id="normal_area"
                                @if (old('content_type', $detailData['notice_content_type'] ?? 1 == 1)) style="display:none;" @else style="display:block;" @endif>
                                <div class="element-form element-form-columns">
                                    <div class="frame">
                                        <textarea id="" name="content" rows="15" cols="100" class="textarea">{!! old('content', isset($detailData['notice_content']) ? nl2br($detailData['notice_content']) : '') !!}</textarea>
                                    </div>
                                </div>
                            </div><br>
                            <div class="element-form-rows" id="rich_area"
                                @if (old('content_type', $detailData['notice_content_type'] ?? 1 == 0)) style="display:none;" @else style="display:block;" @endif>
                                <div id="quill_editor" class="rich_text_area">{!! old('rich_text_contents', isset($detailData['notice_content']) ? nl2br($detailData['notice_content']) : '') !!}</div>
                            </div>
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper label">公開開始日時</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" id="calendar1-year" name="release_start_datetime_year"
                                            class="element textbox_40px" minlength="0" maxlength="4"
                                            value="{{ old('release_start_datetime_year', isset($detailData['release_start_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['release_start_datetime'])->format('Y') : '') }}">年
                                        <input type="text" id="calendar1-month" name="release_start_datetime_month"
                                            class="element textbox_24px" minlength="0" maxlength="2"
                                            value="{{ old('release_start_datetime_month', isset($detailData['release_start_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['release_start_datetime'])->format('m') : '') }}">月
                                        <input type="text" id="calendar1-date" name="release_start_datetime_day"
                                            class="element textbox_24px" minlength="0" maxlength="2"
                                            value="{{ old('release_start_datetime_day', isset($detailData['release_start_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['release_start_datetime'])->format('d') : '') }}">日
                                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
                                    </div>
                                    <div class="textbox td_100px">
                                        <input type="time" name="release_start_datetime_time" class="element"
                                            minlength="0" maxlength="" size="5"
                                            value="{{ old('release_start_datetime_time', isset($detailData['release_start_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['release_start_datetime'])->format('H:i') : '') }}">
                                    </div>
                                </div>
                            </div><br>
                            <div class="element-form element-form-rows">
                                <div class="text_wrapper label">公開終了日時</div>
                                <div class="frame">
                                    <div class="textbox">
                                        <input type="text" id="calendar2-year" name="release_end_datetime_year"
                                            class="element textbox_40px" minlength="0" maxlength="4"
                                            value="{{ old('release_end_datetime_year', isset($detailData['release_end_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['release_end_datetime'])->format('Y') : '') }}">年
                                        <input type="text" id="calendar2-month" name="release_end_datetime_month"
                                            class="element textbox_24px" minlength="0" maxlength="2"
                                            value="{{ old('release_end_datetime_month', isset($detailData['release_end_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['release_end_datetime'])->format('m') : '') }}">月
                                        <input type="text" id="calendar2-date" name="release_end_datetime_day"
                                            class="element textbox_24px" minlength="0" maxlength="2"
                                            value="{{ old('release_end_datetime_day', isset($detailData['release_end_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['release_end_datetime'])->format('d') : '') }}">日
                                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar2')">
                                    </div>
                                    <div class="textbox td_100px">
                                        <input type="time" name="release_end_datetime_time" class="element"
                                            minlength="0" maxlength="" size="5"
                                            value="{{ old('release_end_datetime_time', isset($detailData['release_end_datetime']) ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $detailData['release_end_datetime'])->format('H:i') : '') }}">
                                    </div>
                                </div>
                            </div><br><br>
                            <div class="element-form-rows element-buttons flex_start">
                                <div class="element-form element-form-columns">
                                    <div class="text_wrapper">画像</div>
                                    @include('admin.common.image_form', [
                                        'name' => 'image_file',
                                        'data' => $detailData ?? null,
                                        'path' => $path ?? null,
                                    ])
                                </div><br>
                                <div class="element-form-columns">
                                    <div class="element-form element-form-columns">
                                        <div class="text_wrapper">PDF</div>
                                        <div class="element-form element-form-columns" id="notice_grid_table">
                                            <div class="element-form" id="pdf1" style="display:inline-flex;">
                                                @if (isset($detailData['pdf_file_1']))
                                                    <div class="element-form-rows">
                                                        <input type="file" name="pdf_file_1" id="pdfUpload1"
                                                            class="button_gray" value="ファイルを選択1" style="display:none;">
                                                        <button type="button" name="pdf_file_1"
                                                            id="pdfUploadButton1">ファイルを選択</button>
                                                        <span class="img_name"
                                                            id="pdf_name1">{{ mb_substr($detailData['pdf_file_1'], mb_strrpos($detailData['pdf_file_1'], '/') + 1, mb_strlen($detailData['pdf_file_1'])) }}</span>
                                                    </div>
                                                @else
                                                    <input type="file" name="pdf_file_1" class="button_gray"
                                                        value="ファイルを選択" style="padding:2px;">
                                                @endif
                                                <a class="a_link" id="mt_notice_pdf_1" href="javascript:void(0);"
                                                    onClick="delFiles(this)">削除</a>
                                            </div>
                                            <input type="hidden" name="del_pdf_1" id="del_pdf_1" value="0" />

                                            <div class="element-form" id="pdf2"
                                                @if (isset($detailData['pdf_file_2'])) style="display:block;" @else style="display:none;" @endif>
                                                @if (isset($detailData['pdf_file_2']))
                                                    <div class="element-form-rows">
                                                        <input type="file" name="pdf_file_2" id="pdfUpload2"
                                                            class="button_gray" value="ファイルを選択" style="display:none;">
                                                        <button type="button" name="pdf_file_2"
                                                            id="pdfUploadButton2">ファイルを選択</button>
                                                        <span class="img_name"
                                                            id="pdf_name2">{{ mb_substr($detailData['pdf_file_2'], mb_strrpos($detailData['pdf_file_2'], '/') + 1, mb_strlen($detailData['pdf_file_2'])) }}</span>
                                                    </div>
                                                @else
                                                    <input type="file" name="pdf_file_2" class="button_gray"
                                                        value="ファイルを選択" style="padding:2px;">
                                                @endif
                                                <a class="a_link" id="mt_notice_pdf_2" href="javascript:void(0);"
                                                    onClick="delFiles(this)">削除</a>
                                            </div>
                                            <input type="hidden" name="del_pdf_2" id="del_pdf_2" value="" />
                                            <div class="element-form" id="pdf3"
                                                @if (isset($detailData['pdf_file_3'])) style="display:block;" @else style="display:none;" @endif>
                                                @if (isset($detailData['pdf_file_3']))
                                                    <div class="element-form-rows">
                                                        <input type="file" name="pdf_file_3" id="pdfUpload3"
                                                            class="button_gray" value="ファイルを選択" style="display:none;">
                                                        <button type="button" name="pdf_file_3"
                                                            id="pdfUploadButton3">ファイルを選択</button>
                                                        <span class="img_name"
                                                            id="pdf_name3">{{ mb_substr($detailData['pdf_file_3'], mb_strrpos($detailData['pdf_file_3'], '/') + 1, mb_strlen($detailData['pdf_file_3'])) }}</span>
                                                    </div>
                                                @else
                                                    <input type="file" name="pdf_file_3" class="button_gray"
                                                        value="ファイルを選択" style="padding:2px;">
                                                @endif
                                                <a class="a_link" id="mt_notice_pdf_3" href="javascript:void(0);"
                                                    onClick="delFiles(this)">削除</a>
                                            </div>
                                            <input type="hidden" name="del_pdf_3" id="del_pdf_3" value="" />
                                            <div class="element-form" id="pdf4"
                                                @if (isset($detailData['pdf_file_4'])) style="display:block;" @else style="display:none;" @endif>
                                                @if (isset($detailData['pdf_file_4']))
                                                    <div class="element-form-rows">
                                                        <input type="file" name="pdf_file_4" id="pdfUpload4"
                                                            class="button_gray" value="ファイルを選択" style="display:none;">
                                                        <button type="button" name="pdf_file_4"
                                                            id="pdfUploadButton4">ファイルを選択</button>
                                                        <span class="img_name"
                                                            id="pdf_name4">{{ mb_substr($detailData['pdf_file_4'], mb_strrpos($detailData['pdf_file_4'], '/') + 1, mb_strlen($detailData['pdf_file_4'])) }}</span>
                                                    </div>
                                                @else
                                                    <input type="file" name="pdf_file_4" class="button_gray"
                                                        value="ファイルを選択" style="padding:2px;">
                                                @endif
                                                <a class="a_link" id="mt_notice_pdf_4" href="javascript:void(0);"
                                                    onClick="delFiles(this)">削除</a>
                                            </div>
                                            <input type="hidden" name="del_pdf_4" id="del_pdf_4" value="" />
                                            <div class="element-form" id="pdf5"
                                                @if (isset($detailData['pdf_file_5'])) style="display:block;" @else style="display:none;" @endif>
                                                @if (isset($detailData['pdf_file_5']))
                                                    <div class="element-form-rows">
                                                        <input type="file" name="pdf_file_5" id="pdfUpload5"
                                                            class="button_gray" value="ファイルを選択" style="display:none;">
                                                        <button type="button" name="pdf_file_5"
                                                            id="pdfUploadButton5">ファイルを選択</button>
                                                        <span class="img_name"
                                                            id="pdf_name5">{{ mb_substr($detailData['pdf_file_5'], mb_strrpos($detailData['pdf_file_5'], '/') + 1, mb_strlen($detailData['pdf_file_5'])) }}</span>
                                                    </div>
                                                @else
                                                    <input type="file" name="pdf_file_5" class="button_gray"
                                                        value="ファイルを選択" style="padding:2px;">
                                                @endif
                                                <a class="a_link" id="mt_notice_pdf_5" href="javascript:void(0);"
                                                    onClick="delFiles(this)">削除</a>
                                            </div>
                                            <input type="hidden" name="del_pdf_5" id="del_pdf_5" value="" />
                                        </div>
                                    </div>
                                    <div class="plus_rec plus_rec_left">
                                        <div class="blue_text_wrapper" onClick="noticeAddLine(this.id)"
                                            id="noticeAddLine">+
                                            PDFファイルを追加する
                                        </div>
                                    </div>
                                </div>
                            </div><br><br>
                            <div class="element-form-columns">
                                <div class="element-form element-form-rows">
                                    <div class="frame">
                                        <div class="text_wrapper">表示：</div>
                                        <div class="div">
                                            <label class="text_wrapper_2">
                                                <input type="radio" id="" name="display_flg" value="0"
                                                    @if (old('display_flg') !== 1 || (isset($detailData['display_flg']) && $detailData['display_flg'] !== 1)) checked @endif />
                                                表示
                                            </label>
                                        </div>
                                        <div class="div">
                                            <label class="text_wrapper_2">
                                                <input type="radio" id="" name="display_flg" value="1"
                                                    @if (old('display_flg') === 1 || (isset($detailData['display_flg']) && $detailData['display_flg'] === 1)) checked @endif />
                                                非表示
                                            </label>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="element-form element-form-rows">
                                    <div class="frame">
                                        <div class="text_wrapper txt_required">表示順</div>
                                        <div class="frame">
                                            <div class="textbox">
                                                <input type="text" name="display_sort_order" class="element"
                                                    minlength="0" maxlength="3" size="3"
                                                    value="{{ old('display_sort_order', isset($detailData['display_sort_order']) ? $detailData['display_sort_order'] : '') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="hidden_detail_id" value="{{ isset($detailData) ? $detailData['id'] : '' }}">
            <input type="hidden" name="rich_text_contents" id="rich_contents">
            <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
            <button type="submit" id="update" name="update" class="display_none_all"></button>
            <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
            <button type="submit" id="redirect" name="redirect" class="display_none_all" value=""></button>
            @include('components.menu.selected', ['view' => 'main'])
        </form>
    </div>
    @include('admin.master.search.notice')
    @include('admin.common.calendar', ['calendarId' => 'calendar1'])
    @include('admin.common.calendar', ['calendarId' => 'calendar2'])
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

        // アイコン画像アップロード処理
        // 画像が選択される度に、この中の処理が走る
        $('#imgUpload1').on('change', function(ev) {
            // このFileReaderが画像を読み込む上で大切
            const reader = new FileReader();
            // ファイル名を取得
            //const fileName = ev.target.files[0].name;
            // 画像が読み込まれた時の動作を記述
            //reader.onload = function (ev) {
            $('#imgUpload1').css('display', 'block');
            $('#imgUploadButton1').css('display', 'none');
            $('#img_name1').css('display', 'none');
            //}
        })

        // PDFアップロード処理
        $('#pdfUpload1').on('change', function(ev) {
            const reader = new FileReader();
            $('#pdfUpload1').css('display', 'block');
            $('#pdfUploadButton1').css('display', 'none');
            $('#pdf_name1').css('display', 'none');
        })

        $('#pdfUpload2').on('change', function(ev) {
            const reader = new FileReader();
            $('#pdfUpload2').css('display', 'block');
            $('#pdfUploadButton2').css('display', 'none');
            $('#pdf_name2').css('display', 'none');
        })

        $('#pdfUpload3').on('change', function(ev) {
            const reader = new FileReader();
            $('#pdfUpload3').css('display', 'block');
            $('#pdfUploadButton3').css('display', 'none');
            $('#pdf_name3').css('display', 'none');
        })

        $('#pdfUpload4').on('change', function(ev) {
            const reader = new FileReader();
            $('#pdfUpload4').css('display', 'block');
            $('#pdfUploadButton4').css('display', 'none');
            $('#pdf_name4').css('display', 'none');
        })

        $('#pdfUpload5').on('change', function(ev) {
            const reader = new FileReader();
            $('#pdfUpload5').css('display', 'block');
            $('#pdfUploadButton5').css('display', 'none');
            $('#pdf_name5').css('display', 'none');
        })

        //画像削除
        function delFiles(elm) {
            if (elm.id === "mt_notice_img_1") {
                document.getElementById('img1').innerHTML =
                    '<div class="element-form-rows"><input type="file" name="image_file" class="button_gray" value="ファイルを選択"></div><a class="a_link" id="mt_notice_img_1" href="javascript:void(0);" onClick="delFiles(this)">削除</a>';
                document.getElementById('del_img_1').value = '1';
            }
            if (elm.id === "mt_notice_pdf_1") {
                document.getElementById('pdf1').innerHTML =
                    '<input type="file" name="pdf_file_1" class="button_gray" value="ファイルを選択" style="padding:2px;"><a class="a_link" id="mt_notice_pdf_1" href="javascript:void(0);" onClick="delFiles(this)">削除</a>';
                document.getElementById('del_pdf_1').value = '1';
            }
            if (elm.id === "mt_notice_pdf_2") {
                document.getElementById('pdf2').innerHTML =
                    '<input type="file" name="pdf_file_2" class="button_gray" value="ファイルを選択" style="padding:2px;"><a class="a_link" id="mt_notice_pdf_2" href="javascript:void(0);" onClick="delFiles(this)">削除</a>';
                document.getElementById('del_pdf_2').value = "1";
            }
            if (elm.id === "mt_notice_pdf_3") {
                document.getElementById('pdf3').innerHTML =
                    '<input type="file" name="pdf_file_3" class="button_gray" value="ファイルを選択" style="padding:2px;"><a class="a_link" id="mt_notice_pdf_3" href="javascript:void(0);" onClick="delFiles(this)">削除</a>';
                document.getElementById('del_pdf_3').value = "1";
            }
            if (elm.id === "mt_notice_pdf_4") {
                document.getElementById('pdf4').innerHTML =
                    '<input type="file" name="pdf_file_4" class="button_gray" value="ファイルを選択" style="padding:2px;"><a class="a_link" id="mt_notice_pdf_4" href="javascript:void(0);" onClick="delFiles(this)">削除</a>';
                document.getElementById('del_pdf_4').value = "1";
            }
            if (elm.id === "mt_notice_pdf_5") {
                document.getElementById('pdf5').innerHTML =
                    '<input type="file" name="pdf_file_5" class="button_gray" value="ファイルを選択" style="padding:2px;"><a class="a_link" id="mt_notice_pdf_5" href="javascript:void(0);" onClick="delFiles(this)">削除</a>';
                document.getElementById('del_pdf_5').value = "1";
            }
        }
    </script>
@endsection
