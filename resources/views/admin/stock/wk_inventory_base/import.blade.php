@extends('layouts.admin.app')
@section('page_title', '棚卸EXCEL取込')
@section('title', '棚卸EXCEL取込')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<form role="search" action="{{ route('stock_management.inventory.import.update') }}" method="post" name="mtInventoryFileImportForm" enctype="multipart/form-data">
	    @csrf
		<div class="main-area">
			<div class="button_area">
				<div class="div">
					<button class="button" type="submit" name="cancel"><div class="text_wrapper">キャンセル</div></button>
					<button class="button" type="submit" name="error_output"><div class="text_wrapper">エラー結果出力</div></button>
					<button class="div-wrapper" type="button"><div class="text_wrapper_2"><label for="file_upload">取込ファイル<input type="file" id="file_upload" class="file_input display_none_all" name="import_file"></label></div></button>
					<button class="button-2" type="submit" name="execute"><div class="text_wrapper_3">実行する</div></button>
				</div>
	    	</div>

			<div class="box">
				<div class="element-form element-form-rows">
					<div class="text_wrapper label">更新開始日付</div>
					<div class="frame">
						<div class="textbox">
						    <input type="text" name="name" class="element textbox_40px" minlength="0" maxlength="4" value="{{ date('Y') }}">年
						    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('m') }}">月
						    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('d') }}">日
						    <img src="/img/icon/calender.svg">
						</div>
					</div>
				</div><br>
				<div class="element-form element-form-rows">
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
				</div><br>
				<div class="element-form element-form-rows">
					<div class="text_wrapper label">実施棚卸日付</div>
					<div class="frame">
						<div class="textbox">
						    <input type="text" name="name" class="element textbox_40px" minlength="0" maxlength="4" value="{{ date('Y') }}">年
						    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('m') }}">月
						    <input type="text" name="name" class="element textbox_24px" minlength="0" maxlength="2" value="{{ date('d') }}">日
						    <img src="/img/icon/calender.svg">
						</div>
					</div>
				</div><br>
				<div class="element-form-url">
                    <div class="url">取込元Excelファイル</div>
                    <div class="frame">
                        <label class="url_label">
                            <div class="url_title" title="ファイルを選択">
                                <img class="icon-file-open" src="{{ asset('/img/icon/file-open.svg') }}">
                                <p id="file_path" class="url_file"></p>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="msg">
                    <div class="view">
                        <div class="text_wrapper"></div>
                    </div>
                </div>
			</div>
		</div>
	</form>
@endsection
