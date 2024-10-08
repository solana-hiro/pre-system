@extends('layouts.admin.app')
@section('page_title', '売掛残高一覧表(20日締)')
@section('title', '売掛残高一覧表(20日締)')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<div class="main-area">
		<div class="button_area">
			<div class="div">
				<button class="button"><div class="text_wrapper">キャンセル</div></button>
				<button class="div-wrapper"><div class="text_wrapper_2" onclick="this.form.target='_blank'">プレビューを見る</div></button>
				<button class="div-wrapper"><div class="text_wrapper_2">PDFへ出力</div></button>
				<button class="div-wrapper"><div class="text_wrapper_2">Excelへ出力</div></button>
			</div>
    	</div>

		<div class="element-form element-form-rows">
			<div class="text_wrapper label">対象年月日</div>
			<div class="frame">
				<div class="textbox">
				    <input type="text" name="name" class="element textbox_40px" minlength="0" maxlength="4" value="">年
				    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="">月
				    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="">日
				    <img src="/img/icon/calender.svg">
				</div>
			</div>
		</div><br>
		<div class="element-form element-form-rows">
			<div class="text_wrapper label">請求先コード範囲</div>
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
@endsection
