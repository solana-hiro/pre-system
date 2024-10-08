@extends('layouts.admin.app')
@section('page_title', '支払一覧表')
@section('title', '支払一覧表')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<form role="search" action="{{ route('purchase_management.pay.payment.list.export') }}" method="post">
	    @csrf
		<div class="main-area">
			<div class="button_area">
				<div class="div">
					<button class="button" type="submit" name="cancel"><div class="text_wrapper">キャンセル</div></button>
					<button class="div-wrapper" type="submit" name="pdf"><div class="text_wrapper_2">PDFへ出力</div></button>
					<button class="div-wrapper" type="submit" name="excel"><div class="text_wrapper_2">Excelへ出力</div></button>
				</div>
	    	</div>

			<div class="element-form element-form-rows">
				<div class="text_wrapper label">対象支払締日</div>
				<div class="frame">
					<div class="textbox">
					    <input type="text" name="name" class="element textbox_40px" minlength="0" maxlength="4" value="">年
					    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="">月
					    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="">日
					    <img src="/img/icon/calender.svg">
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
							<input type="radio" id="" name="customer_class" value="" checked />
							支払先順
						</label>
					</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="customer_class" value="" />
							担当者順
						</label>
					</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="customer_class" value="" />
							部門+担当者順
						</label>
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper label">支払先コード範囲</div>
				<div class="frame">
				    <div class="textbox">
						<input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
					<div class="text_wrapper">～</div>
					<div class="textbox">
						<input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper label">部門コード</div>
				<div class="frame">
				    <div class="textbox">
						<input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
					<div class="text_wrapper">～</div>
					<div class="textbox">
						<input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper label">ユーザコード範囲</div>
				<div class="frame">
				    <div class="textbox">
						<input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
					<div class="text_wrapper">～</div>
					<div class="textbox">
						<input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
						<img class="vector" src="/img/icon/vector.svg" />
					</div>
				</div>
			</div><br>
		</div>
	</form>
@endsection
