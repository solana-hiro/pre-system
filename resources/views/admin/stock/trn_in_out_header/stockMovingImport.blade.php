@extends('layouts.admin.app')
@section('page_title', '在庫移動Excel取込')
@section('title', '在庫移動Excel取込')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<form role="search" action="{{ route('stock_management.stock.stock_moving.import.update') }}" method="post">
	    @csrf
		<div class="main-area">
			<div class="button_area">
				<div class="div">
					<button class="button" type="submit" name="cancel"><div class="text_wrapper">キャンセル</div></button>
					<button class="div-wrapper" type="submit" name="error"><div class="text_wrapper_2">エラー結果を取込</div></button>
					<button class="div-wrapper" type="submit" name="file" ><div class="text_wrapper_2">取込ファイル</div></button>
					<button class="button-2" type="submit" name="update"><div class="text_wrapper_3">実行する</div></button>
				</div>
	    	</div>

			<div class="box">
				<div class="element-form element-form-rows">
					<div class="element-form element-form-columns">
						<div class="text_wrapper label">入力者</div>
						<div class="frame">
						    <div class="textbox">
								<input type="text" name="name" class="element" minlength="0" maxlength="6" size="6" />
								<img class="vector" src="/img/icon/vector.svg" />
							</div>
							<div class="textbox">
								<input type="text" name="name" class="element" minlength="0" maxlength="10" size="10" />
							</div>
						</div>
					</div>
					<div class="element-form element-form-columns">
						<div class="text_wrapper label">伝票日付</div>
						<div class="frame">
							<div class="textbox">
							    <input type="text" name="name" class="element textbox_40px" minlength="0" maxlength="4" value="">年
							    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="">月
							    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="">日
							    <img src="/img/icon/calender.svg">
							</div>
						</div>
					</div>
					<div class="element-form element-form-columns">
						<div class="text_wrapper label">取引区分</div>
						<div class="frame">
						    <div class="textbox">
								<input type="text" name="name" class="element" minlength="0" maxlength="6" size="2" />
								<img class="vector" src="/img/icon/vector.svg" />
							</div>
							<div class="textbox">
								<input type="text" name="name" class="element" minlength="0" maxlength="6" size="10" />
							</div>
						</div>
					</div>
				</div><br>
				<div class="element-form element-form-rows">
					<div class="element-form element-form-columns">
						<div class="text_wrapper label">出庫倉庫コード</div>
						<div class="frame">
						    <div class="textbox">
								<input type="text" name="name" class="element" minlength="0" maxlength="6" size="6" />
								<img class="vector" src="/img/icon/vector.svg" />
							</div>
							<div class="textbox">
								<input type="text" name="name" class="element" minlength="0" maxlength="10" size="10" />
							</div>
						</div>
					</div>
					<div class="element-form element-form-columns">
						<div class="text_wrapper label">入庫倉庫コード</div>
						<div class="frame">
						    <div class="textbox">
								<input type="text" name="name" class="element" minlength="0" maxlength="6" size="6" />
								<img class="vector" src="/img/icon/vector.svg" />
							</div>
							<div class="textbox">
								<input type="text" name="name" class="element" minlength="0" maxlength="10" size="10" />
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="element-form-url">
				<div class="url">取込元Excelファイル</div>
				<div class="frame">
					<div class="icon-file-open"></div>
					<div class="sample-example-jp"></div>
				</div>
			</div>
			<div class="msg">
				<div class="view">
					<div class="text_wrapper">エラーが発生したため、取込処理を中断します。<br/>
	      			エラー内容：Excelに「XXXX」列がありません。</div>
				</div>
			</div>
		</div>
	</form>
@endsection
