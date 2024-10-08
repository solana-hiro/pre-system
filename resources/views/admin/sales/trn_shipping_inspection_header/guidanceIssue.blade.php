@extends('layouts.admin.app')
@section('page_title', '出荷案内発行')
@section('title', '出荷案内発行')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<div class="main-area">
		<form role="search" action="{{ route('sales_management.shipping.guidance.issue.export') }}" method="post">
		@csrf
			<div class="button_area">
				<div class="div">
					<button class="button" type="submit" name="cancel"><div class="text_wrapper">キャンセル</div></button>
					<button class="div-wrapper" type="submit" name="excel"><div class="text_wrapper_2">Excelへ出力</div></button>
				</div>
	    	</div>

			<div class="element-form element-form-rows">
				<div class="frame">
					<div class="text_wrapper">対象：</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="target" value="0" checked />
							売上のみ
						</label>
					</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="target" value="1" />
							すべて
						</label>
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper label">売上日</div>
				<div class="frame">
					<div class="textbox">
					    <input type="text" name="year_start" class="element textbox_40px" minlength="0" maxlength="4" value="{{ date('Y') }}">年
					    <input type="text" name="month_start" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('m') }}">月
					    <input type="text" name="day_start" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('d') }}">日
					    <img src="/img/icon/calender.svg">
					</div>
					<div class="text_wrapper">～</div>
					<div class="textbox">
					    <input type="text" name="year_end" class="element textbox_40px" minlength="0" maxlength="4" value="{{ date('Y') }}">年
					    <input type="text" name="month_end" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('m') }}">月
					    <input type="text" name="day_end" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('d') }}">日
					    <img src="/img/icon/calender.svg">
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="frame">
					<div class="text_wrapper">発行区分：</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="issue_kbn" value="0" checked />
							未発行
						</label>
					</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="issue_kbn" value="1" />
							発行済
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
			<div class="element-form element-form-rows">
				<div class="frame">
					<div class="text_wrapper label">得意先コード</div>
				    <div class="textbox">
						<input type="text" name="customer_code_start" class="element" minlength="0" maxlength="6" size="6" value="" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
					<div class="text_wrapper">～</div>
					<div class="textbox">
						<input type="text" name="customer_code_end" class="element" minlength="0" maxlength="6" size="6" value="" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="frame">
					<div class="text_wrapper label">納品先コード</div>
				    <div class="textbox">
						<input type="text" name="delivery_code_start" class="element" minlength="0" maxlength="6" size="6" value="" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
					<div class="text_wrapper">～</div>
					<div class="textbox">
						<input type="text" name="delivery_code_end" class="element" minlength="0" maxlength="6" size="6" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
				</div>
			</div>
		</form>
	</div>
@endsection
