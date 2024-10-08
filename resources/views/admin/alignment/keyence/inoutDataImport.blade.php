@extends('layouts.admin.app')
@section('page_title', '入出庫データ取込')
@section('title', '入出庫データ取込')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<form role="search" action="{{ route('alignment.keyence.in_out_data.import.update') }}" method="post">
	    @csrf
		<div class="main-area">
			<div class="button_area">
				<div class="div">
					<button class="button" type="submit" name="cancel"><div class="text_wrapper">キャンセル</div></button>
					<button class="div-wrapper" type="submit" name="folder"><div class="text_wrapper_2">フォルダ</div></button>
					<button class="div-wrapper" type="submit" name="preview" onclick="this.form.target='_blank'"><div class="text_wrapper_2">プレビューを見る</div></button>
					<button class="button-2" type="submit" name="update"><div class="text_wrapper_3">実行する</div></button>
				</div>
	    	</div>

			<div class="element-form element-form-rows">
				<div class="text_wrapper">実行区分：</div>
				<div class="frame">
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="customer_class" value="" checked />
							ファイルから取込
						</label>
					</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="customer_class" value="" />
							マスタなし（変換エラー）分再取込
						</label>
					</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="customer_class" value="" />
							エラー削除
						</label>
					</div>
				</div>
			</div><br>
			<div class="element-form element-form-rows">
				<div class="text_wrapper">処理区分：</div>
				<div class="frame">
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="customer_class" value="" checked />
							すべて
						</label>
					</div>
					<div class="div">
						<label class="text_wrapper_2">
							<input type="radio" id="" name="customer_class" value="" />
							自ログインID分
						</label>
					</div>
				</div>
			</div>
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
	</form>
@endsection
