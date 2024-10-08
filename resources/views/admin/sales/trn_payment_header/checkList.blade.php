@extends('layouts.admin.app')
@section('page_title', '入金チェックリスト')
@section('title', '入金チェックリスト')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<form role="search" action="{{ route('sales_management.accounts_receivable.checklist.export') }}" method="post">
	    @csrf
		<div class="main-area">
			<div class="button_area">
				<div class="div">
					<button class="button" type="submit" name="cancel"><div class="text_wrapper">キャンセル</div></button>
					<button class="div-wrapper" type="submit" name="excel"><div class="text_wrapper_2">Excelへ出力</div></button>
				</div>
	    	</div>
			<div class="element-form element-form-rows">
				<div class="text_wrapper">出力順：</div>
				<div class="frame">
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="sort_order" value="1" checked />
							入力日付+処理区分+入金No.順
						</label>
					</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="customer_class" value="2" />
							伝票日付+入金No.順
						</label>
					</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="customer_class" value="3" />
							伝票日付+担当者順
						</label>
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper label">対象日付</div>
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
				<div class="text_wrapper">処理区分：</div>
				<div class="frame">
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="kbn" value="0" />
							新規伝票
						</label>
					</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="kbn" value="1" />
							修正伝票
						</label>
					</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="kbn" value="2" checked />
							すべて
						</label>
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper label">得意先コード範囲</div>
				<div class="frame">
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
				<div class="text_wrapper label">担当者コード範囲</div>
				<div class="frame">
				    <div class="textbox">
						<input type="text" name="manager_code_start" class="element" minlength="0" maxlength="4" size="4" value="" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
					<div class="text_wrapper">～</div>
					<div class="textbox">
						<input type="text" name="manager_code_end" class="element" minlength="0" maxlength="4" size="4" value="" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper label">入金伝票No.範囲</div>
				<div class="frame">
				    <div class="textbox">
						<input type="text" name="slip_no_start" class="element" minlength="0" maxlength="8" size="8" value="" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
					<div class="text_wrapper">～</div>
					<div class="textbox">
						<input type="text" name="slip_no_end" class="element" minlength="0" maxlength="8" size="8" value="" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
				</div>
			</div><br>
		</div>
	</form>
@endsection
