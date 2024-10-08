@extends('layouts.admin.app')
@section('page_title', '日本郵政向け出荷指示データ出力')
@section('title', '日本郵政向け出荷指示データ出力')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<div class="main-area">
		<div class="button_area">
			<div class="div">
				<button class="button"><div class="text_wrapper">キャンセル</div></button>
				<button class="div-wrapper"><div class="text_wrapper_2">フォルダ</div></button>
				<button class="button-2"><div class="text_wrapper_3">実行する</div></button>
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
				<div class="txt_memo">
					（末日=99）
				</div>
			</div>
		</div><br>
		<div class="element-form element-form-rows">
			<div class="text_wrapper">連携区分：</div>
			<div class="frame">
				<div class="div">
					<label class="text_wrapper_2">
						<input type="radio" id="" name="customer_class" value="" checked />
						未連携
					</label>
				</div>
				<div class="div">
					<label class="text_wrapper_2">
						<input type="radio" id="" name="customer_class" value="" />
						連携済
					</label>
				</div>
				<div class="div">
					<label class="text_wrapper_2">
						<input type="radio" id="" name="customer_class" value="" />
						すべて
					</label>
				</div>
			</div>
		</div><br>
		<div class="element-form element-form-rows">
			<div class="text_wrapper label">受注No.範囲</div>
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
			<div class="text_wrapper label">ブランド1コード</div>
			<div class="frame">
			    <div class="textbox">
					<input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
					<img class="vector" src="/img/icon/vector.svg" />
				</div>
				<div class="textbox">
					<input type="text" name="name" class="element" minlength="0" maxlength="20" size="20" />
				</div>
			</div>
		</div><br>
		<div class="msg">
			<div class="view">
				<div class="text_wrapper">コメントーー<br/>
      			</div>
			</div>
		</div>
		<div class="element-form-url">
			<div class="frame">
				<div class="icon-file-open"></div>
				<div class="sample-example-jp"></div>
			</div>
		</div>
	</div>
@endsection
