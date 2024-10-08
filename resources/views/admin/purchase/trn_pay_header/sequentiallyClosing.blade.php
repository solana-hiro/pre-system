@extends('layouts.admin.app')
@section('page_title', '支払随時締処理')
@section('title', '支払随時締処理')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<form role="search" action="{{ route('purchase_management.pay.sequentially.closing.update') }}" method="post">
	    @csrf
		<div class="main_contents">
			<div class="button_area">
				<div class="div">
					<button class="button" type="submit" name="cancel"><div class="text_wrapper">キャンセル</div></button>
					<button class="button-2" type="submit" name="update"><div class="text_wrapper_3">登録する</div></button>
				</div>
	    	</div>
			<div class="element-form-rows">
				<div class="element-form element-form-columns">
					<div class="text_wrapper">支払先コード</div>
					<div class="frame">
					    <div class="textbox">
							<input type="text" name="name" class="element" minlength="0" maxlength="6" size="6" />
							<img class="vector" src="/img/icon/vector.svg" />
						</div>
					</div>
				</div>
				<div class="element-form element-form-columns">
					<div class="text_wrapper">支払先名</div>
					<div class="frame">
					    <div class="textbox">
							<input type="text" name="name" class="element" minlength="0" maxlength="30" size="20" />
						</div>
					</div>
				</div>
			</div><br>
			<div class="element-forms">
				<div class="element-form element-form-columns">
					<div class="text_wrapper">郵便番号</div>
					<div class="frame">
					    <div class="textbox">
							<input type="text" name="name" class="element" minlength="0" maxlength="7" size="7" />
						</div>
					</div>
				</div>
				<div class="element-form element-form-rows">
					<div class="element-form element-form-columns">
						<div class="text_wrapper">住所</div>
						<div class="frame">
						    <textarea id="" name="" rows="5" cols="80" class="textarea"></textarea>
						</div>
					</div>
					<div>
						<div class="element-form element-form-columns">
							<div class="text_wrapper">TEL</div>
							<div class="frame">
							    <div class="textbox">
									<input type="text" name="name" class="element" minlength="0" maxlength="11" size="11" />
								</div>
							</div>
						</div>
						<div class="element-form element-form-columns">
							<div class="text_wrapper">FAX</div>
							<div class="frame">
							    <div class="textbox">
									<input type="text" name="name" class="element" minlength="0" maxlength="11" size="11" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="element-form element-form-rows">
				<div class="text_wrapper label">前回集計締日付</div>
				<div class="frame">
					<div class="textbox">
					    <input type="text" name="name" class="element textbox_40px" minlength="0" maxlength="4" value="">年
					    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="">月
					    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="">日
					    <img src="/img/icon/calender.svg">
					</div>
				</div>
			</div>

			<div class="box">
			    <p class="text_18px">今回締条件</p>
				<div class="group">
					<div class="element-form element-form-columns">
					    <div class="element-form element-form-rows">
							<div class="text_wrapper label">今回支払締日付</div>
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
							<div class="text_wrapper label">今回回収日</div>
							<div class="frame">
								<div class="textbox">
								    <input type="text" name="name" class="element textbox_40px" minlength="0" maxlength="4" value="">年
								    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="">月
								    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="">日
								    <img src="/img/icon/calender.svg">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection
