@extends('layouts.admin.app')
@section('page_title', '日本郵政向け出荷データ取込')
@section('title', '日本郵政向け出荷データ取込')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<div class="main-area">
		<div class="button_area">
			<div class="div">
				<button class="button"><div class="text_wrapper">キャンセル</div></button>
				<button class="div-wrapper"><div class="text_wrapper_2">フォルダ</div></button>
				<button class="div-wrapper" onclick="this.form.target='_blank'"><div class="text_wrapper_2">プレビューを見る</div></button>
				<button class="button-2"><div class="text_wrapper_3">実行する</div></button>
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
@endsection
