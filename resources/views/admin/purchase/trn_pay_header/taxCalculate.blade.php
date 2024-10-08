@extends('layouts.admin.app')
@section('page_title', '支払時消費税一括計算')
@section('title', '支払時消費税一括計算')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<form role="search" action="{{ route('purchase_management.pay.tax.calculate.update') }}" method="post">
	    @csrf
		<div class="main-area">
			<div class="button_area">
				<div class="div">
					<button class="button" type="submit" name="cancel"><div class="text_wrapper">キャンセル</div></button>
					<button class="button-2" type="submit" name="execute"><div class="text_wrapper_3">実行する</div></button>
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
			</div>
		</div>
	</form>
@endsection
