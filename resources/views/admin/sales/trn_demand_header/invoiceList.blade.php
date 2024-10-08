@extends('layouts.admin.app')
@section('page_title', '請求一覧表')
@section('title', '請求一覧表')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
    <form role="search" action="{{ route('sales_management.demand.invoice.list.export') }}" method="post">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="preview" id="preview"
                        onclick="this.form.target='_blank'">
                        <div class="text_wrapper_2">プレビューを見る</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="excel" id="download">
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
                <div class="text_wrapper label">対象請求締日</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" id="calendar1-year" name="year" class="element textbox_40px" minlength="0"
                            maxlength="4" value="{{ date('Y') }}">年
                        <input type="text" id="calendar1-month" name="month" class="element textbox_24px"
                            minlength="0" maxlength="2" value="{{ date('m') }}">月
                        <input type="text" id="calendar1-date" name="day" class="element textbox_24px" minlength="0"
                            maxlength="2" value="{{ date('d') }}">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('calendar1')">
                    </div>
                    <div class="txt_memo">
                        （末日=99）
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper">出力順：</div>
                <div class="frame">
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="sort_order" value="0" checked />
                            請求先順
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="sort_order" value="1" />
                            担当者順
                        </label>
                    </div>
                    <div class="div">
                        <label class="text_wrapper_2">
                            <input type="radio" id="" name="sort_order" value="2" />
                            部門＋担当者順
                        </label>
                    </div>
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label txt_required">請求先コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="billing_address_start" id="input_billing_address_start" class="element"
                            minlength="0" maxlength="6" size="6" value="{{ old('billing_address_start', '') }}" />
                        <img class="vector" id="img_billing_address_start" src="/img/icon/vector.svg"
                            data-smm-open="search_billing_address_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="billing_address_end" id="input_billing_address_end" class="element"
                            minlength="0" maxlength="6" size="6" value="{{ old('billing_address_end', '') }}" />
                        <img class="vector" id="img_billing_address_end" src="/img/icon/vector.svg"
                            data-smm-open="search_billing_address_modal" />
                    </div>
                    <input type="hidden" id="hidden_billing_address_start" value=""
                        name="hidden_billing_address_start" />
                    <input type="hidden" id="hidden_billing_address_end" value=""
                        name="hidden_billing_address_end" />
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label txt_required">部門コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="department_code_start" id="input_department_start" class="element"
                            minlength="0" maxlength="4" size="4"
                            value="{{ old('department_code_start', '') }}" />
                        <img class="vector" id="img_department_start" src="/img/icon/vector.svg"
                            data-smm-open="search_department_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="department_code_end" id="input_department_end" class="element"
                            minlength="0" maxlength="4" size="4"
                            value="{{ old('department_code_end', '') }}" />
                        <img class="vector" id="img_department_end" src="/img/icon/vector.svg"
                            data-smm-open="search_department_modal" />
                    </div>
                    <input type="hidden" id="hidden_department_start" value="" name="input_department_start" />
                    <input type="hidden" id="hidden_department_end" value="" name="hidden_department_end" />
                </div>
            </div><br>
            <div class="element-form element-form-rows">
                <div class="text_wrapper label txt_required">担当者コード範囲</div>
                <div class="frame">
                    <div class="textbox">
                        <input type="text" name="manager_code_start" id="input_manager_start" class="element"
                            minlength="0" maxlength="4" size="4" value="{{ old('manager_code_start', '') }}" />
                        <img class="vector" id="img_manager_start" src="/img/icon/vector.svg"
                            data-smm-open="search_manager_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="manager_code_end" id="input_manager_end" class="element"
                            minlength="0" maxlength="4" size="4" value="{{ old('manager_code_end', '') }}" />
                        <img class="vector" id="img_manager_end" src="/img/icon/vector.svg"
                            data-smm-open="search_manager_modal" onclick="(this.id);return false;" />
                    </div>
                </div>
                <input type="hidden" id="hidden_manager_start" value="" name="hidden_manager_start" />
                <input type="hidden" id="hidden_manager_end" value="" name="hidden_manager_end" />
            </div>
        </div>
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
    </form>
    @include('admin.master.search.manager', ['managerData' => $managerData])
    @include('admin.master.search.department', ['departmentData' => $departmentData])
    @include('admin.master.search.billing_address', ['billingAddressData' => $billingAddressData])
    @include('admin.common.calendar', ['calendarId' => 'calendar1'])
@endsection
