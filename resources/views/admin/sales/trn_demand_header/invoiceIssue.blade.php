@extends('layouts.admin.app')
@section('page_title', '請求書発行')
@section('title', '請求書発行')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
<script src="{{ asset('/js/calendar.js') }}"></script>

@section('content')
	<form role="search" action="{{ route('sales_management.demand.invoice.issue.update') }}" method="post">
	    @csrf
		<div class="main-area">
			<div class="button_area">
				<div class="div">
					<button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button"
                        data-url="" name="cancel2">
                        <div class="text_wrapper">キャンセル</div>
                    </button>
					<button class="div-wrapper" type="submit" name="preview" onclick="this.form.target='_blank'"><div class="text_wrapper_2">プレビューを見る</div></button>
				</div>
	    	</div>

			<div class="element-form element-form-rows">
				<div class="text_wrapper label">対象請求締日</div>
				<div class="frame">
					<div class="textbox">
					    <input type="text" name="billing_year" id="calendar1-year" class="element textbox_40px" minlength="0" maxlength="4" value="{{ date('Y') }}">年
					    <input type="text" name="billing_month" id="calendar1-month" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('m') }}">月
					    <input type="text" name="billing_day" id="calendar1-date" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('d') }}">日
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
							部門順
						</label>
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper label">請求先コード範囲</div>
				<div class="frame">
                    <div class="textbox">
                        <input type="text" name="code_start" id="input_billing_address_start" class="element"
                            minlength="0" maxlength="6" size="6" value="{{ old('code_start', '') }}" />
                        <img class="vector" id="img_billing_address_start" src="/img/icon/vector.svg"
                            data-smm-open="search_billing_address_modal" />
                    </div>
                    <div class="text_wrapper">～</div>
                    <div class="textbox">
                        <input type="text" name="code_end" id="input_billing_address_end" class="element" minlength="0"
                            maxlength="6" size="6" value="{{ old('code_end', '') }}" />
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
				<div class="text_wrapper label">部門コード範囲</div>
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
				<div class="text_wrapper">出力条件：</div>
				<div class="frame">
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="output" value="0" checked />
							全件
						</label>
					</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="output" value="1" />
							請求発生分
						</label>
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper">請求書発行種別：</div>
				<div class="frame">
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="issue_kbn" value="1" checked />
							請求書発行
						</label>
					</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="issue_kbn" value="2" />
							すべて
						</label>
					</div>
				</div>
			</div><br>
		</div>
	</form>
	@include('admin.master.search.billing_address', ['billingAddressData' => $billingAddressData])
	@include('admin.master.search.department', ['departmentData' => $departmentData])
    @include('admin.common.calendar', ['calendarId' => 'calendar1'])
	<script>
        const inputBox1 = document.getElementById("input_billing_address_start");
        const outputBox1 = document.getElementById("input_billing_address_end");
        const inputBox2 = document.getElementById("input_department_start");
        const outputBox2 = document.getElementById("input_department_end");
        inputBox1.onblur = function () {
            if("" !== inputBox1.value) {
                inputBox1.value = inputBox1.value.toString().padStart(6, '0');
            }
        };
        outputBox1.onblur = function () {
            if("" !== outputBox1.value) {
                outputBox1.value = outputBox1.value.toString().padStart(6, '0');
            }
        };
        inputBox2.onblur = function () {
            if("" !== inputBox2.value) {
                inputBox2.value = inputBox2.value.toString().padStart(4, '0');
            }
        };
        outputBox2.onblur = function () {
            if("" !== outputBox2.value) {
                outputBox2.value = outputBox2.value.toString().padStart(4, '0');
            }
        };
    </script>
@endsection
