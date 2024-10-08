@extends('layouts.admin.app')
@section('page_title', '商品変更履歴リスト')
@section('title', '商品変更履歴リスト')
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
    <form role="search" action="{{ route('master.other.mt_item_change_history.export') }}" method="post">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button class="button" type="submit" name="cancel" onclick="this.form.target='_self'">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="preview" id="preview"
                        onclick="this.form.target='_blank'">
                        <div class="text_wrapper_2">プレビューを見る</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="excel" id="download"
                        onclick="this.form.target='_self'">
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
                <div class="text_wrapper label">商品コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="item_code_start" id="input_item_code_start" class="element"
                            minlength="0" maxlength="9" size="9" value="{{ old('item_code_start', '') }}" />
                        <img class="vector" id="img_item_code_start" src="/img/icon/vector.svg"
                            data-smm-open="search_item_cd_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="item_code_end" id="input_item_code_end" class="element" minlength="0"
                            maxlength="9" size="9" value="{{ old('item_code_end', '') }}" />
                        <img class="vector" id="img_item_code_end" src="/img/icon/vector.svg"
                            data-smm-open="search_item_cd_modal" />
                    </div>
                    <input type="hidden" id="hidden_item_code_start" value="" name="hidden_item_code_start" />
                    <input type="hidden" id="hidden_item_code_end" value="" name="hidden_item_code_end" />
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">変更日付範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" id="calendar1-year" name="date_year_start" class="element textbox_40px"
                            minlength="0" maxlength="4" value="{{ old( 'date_year_start',date('Y')) }}">年
                        <input type="text" id="calendar1-month" name="date_month_start" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ old( 'date_month_start',date('m')) }}">月
                        <input type="text" id="calendar1-date" name="date_day_start" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ old( 'date_day_start',date('d')) }}">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" id="calendar2-year" name="date_year_end" class="element textbox_40px"
                            minlength="0" maxlength="4" value="{{ old( 'date_year_end',date('Y')) }}">年
                        <input type="text" id="calendar2-month" name="date_month_end" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ old( 'date_month_end',date('m')) }}">月
                        <input type="text" id="calendar2-date" name="date_day_end" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ old( 'date_day_end',date('d')) }}">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar2')">
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">変更者ＩＤ範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="updated_user_id_start" id="input_manager_start" class="element"
                            minlength="0" maxlength="4" size="4" value="{{ old('updated_user_id_start', '') }}" />
                        <img class="vector" id="img_manager_start" src="/img/icon/vector.svg"
                            data-smm-open="search_manager_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="updated_user_id_end" id="input_manager_end" class="element"
                            minlength="0" maxlength="4" size="4" value="{{ old('updated_user_id_end', '') }}" />
                        <img class="vector" id="img_manager_end" src="/img/icon/vector.svg"
                            data-smm-open="search_manager_modal" />
                    </div>
                    <input type="hidden" id="hidden_manager_start" value="" name="hidden_manager_start" />
                    <input type="hidden" id="hidden_manager_end" value="" name="hidden_manager_end" />
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label">変更項目（部分）</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="update_detail" class="element" minlength="0" maxlength="20"
                            size="20" value="{{ old('update_detail', '') }}"/>
                    </div>
                </div>
            </div><br>
        </div>
        @include('components.menu.selected', ['view' => 'main'])
    </form>
    <script src="{{ asset('/js/calendar.js') }}"></script>
    @include('admin.master.search.item_cd', ['itemData' => $itemData])
    @include('admin.master.search.manager', ['managerData' => $managerData])
    @include('admin.common.calendar', ['calendarId' => 'calendar1'])
    @include('admin.common.calendar', ['calendarId' => 'calendar2'])
    <script>
        const inputBox1 = document.getElementById("input_item_code_start");
        const outputBox1 = document.getElementById("input_item_code_end");
        const inputBox2 = document.getElementById("input_manager_start");
        const outputBox2 = document.getElementById("input_manager_end");

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
        inputBox2.onblur = function() {
            if ("" !== inputBox2.value) {
                inputBox2.value = inputBox2.value.toString().padStart(4, '0');
            }
        };
        outputBox2.onblur = function() {
            if ("" !== outputBox2.value) {
                outputBox2.value = outputBox2.value.toString().padStart(4, '0');
            }
        };
    </script>
    </script>
@endsection
