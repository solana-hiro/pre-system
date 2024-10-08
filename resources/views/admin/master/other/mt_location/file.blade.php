@extends('layouts.admin.app')
@section('page_title', 'ロケーションマスタExcel取込')
@section('title', 'ロケーションマスタExcel取込')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<div class="main-area">
        <form role="search" action="{{ route('master.other.mt_location.file.import') }}" method="post" name="mtDeliveryFileImportForm" enctype="multipart/form-data">
	    @csrf
			<div class="button_area">
				<div class="div">
                    @if(Session::has('locationImportError'))
					    <button class="button" type="submit" id="error_output" name="error_output"><div class="text_wrapper">エラー結果出力</div></button>
                    @else
                        <button class="button" type="submit" id="error_output" name="error_output" disabled><div class="text_wrapper">エラー結果出力</div></button>
                    @endif
					<button class="div-wrapper" type="button" id="imgUploadButton1"><div class="text_wrapper_2"><label for="file_upload">取込ファイル<input type="file" id="imgUpload1" class="file_input display_none_all" name="import_file"></label></div></button>
                    <button type="button" data-toggle="modal" data-target="#file_confirm2" data-value="" class="button-2" data-url="" name="update2"><div class="text_wrapper_3">実行する</div></button>
				</div>
	    	</div>
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
					<div class="text_wrapper">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li><p class="submsg">{!! $error !!}</p></li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif (Session::has('sessionErrors'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach (session('sessionErrors') as $error)
                                        <li><p class="submsg">{!! $error !!}</p></li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif (Session::has('flashmessage'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li><p class="submsg">{!! session('flashmessage') !!}</p></li>
                                </ul>
                            </div>
                        @elseif (Session::has('errormessage'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li><p class="submsg">{!! session('errormessage') !!}</p></li>
                                </ul>
                            </div>
                        @endif
                        <div class="alert alert-danger">
                            <ul id="alert-danger-ul">
                        </div>
                    </div>
				</div>
			</div>
            <button type="submit" id="update" name="update" class="display_none_all"></button>
            @include('components.menu.selected', ['view' => 'main'])
		</form>
	</div>
    <script>
        $('#imgUpload1').on('change', function (ev) {
            // このFileReaderが画像を読み込む上で大切
            const reader = new FileReader();
            // ファイル名を取得
            const fileName = ev.target.files[0].name;
            //前回のエラー削除
            var len = document.querySelectorAll(".submsg").length;
            for(var i=0 ; i < len ; i++){
                // 該当オブジェクト（ITEXT000）の入力値をクリア
                document.querySelectorAll(".submsg")[i].innerHTML = "";
            }
            // 画像が読み込まれた時の動作を記述
            document.getElementById("file_path").innerHTML = fileName;
            document.getElementById('error_output').disabled = true;
        })
    </script>
@endsection
