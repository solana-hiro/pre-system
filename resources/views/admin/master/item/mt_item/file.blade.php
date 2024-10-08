@extends('layouts.admin.app')
@section('page_title', '商品マスタExcel取込')
@section('title', '商品マスタExcel取込')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<div class="main-area">
		<form role="search" action="{{ route('master.item.mt_item.file.import') }}" method="post" name="mtItemFileImportForm" enctype="multipart/form-data">
	    @csrf
			<div class="button_area">
				<div class="div">
                    @if(Session::has('itemImportError'))
					    <button class="button" type="submit" id="error_output" name="error_output"><div class="text_wrapper">エラー結果出力</div></button>
                    @else
                        <button class="button" type="submit" id="error_output" name="error_output" disabled><div class="text_wrapper">エラー結果出力</div></button>
                    @endif
					<button class="div-wrapper" type="button" id="imgUploadButton1"><div class="text_wrapper_2"><label for="file_upload">取込ファイル<input type="file" id="imgUpload1" class="file_input display_none_all" name="import_file"></label></div></button>
                    <button type="button" data-toggle="modal" data-target="#file_confirm4" data-value="" class="button-2" data-url="" name="update2"><div class="text_wrapper_3">実行する</div></button>
				</div>
	    	</div>
            <div class="box">
                <div class="group">
                    <div class="element">
                        <div class="frame">
                            <div class="text_wrapper grid_wrapper_right td_100px">取込区分：</div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="input_kbn_0" name="input_kbn" value="0"
                                        @if (old('input_kbn') == '0' || null == old('input_kbn')) checked @endif 
                                        onclick="clickKbn(this);"
                                    />
                                    新規
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="input_kbn_1" name="input_kbn" value="1" 
                                        @if (old('input_kbn') == '1') checked @endif 
                                        onclick="clickKbn(this);"
                                    />
                                    修正
                                </label>
                            </div>
                        </div>
                        <div>
                            <p class="frame_text grid_wrapper_right td_380px">新規 → すでに登録済みの商品コードがあればエラー</p>
                            <p class="frame_text grid_wrapper_right td_380px">修正 → 未登録（新規）の商品コードがあればエラー</p>
                        </div>
                        <div class="frame">
                            <div class="text_wrapper grid_wrapper_right td_100px">取込原本区分：</div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="input_original_kbn_0" name="input_original_kbn" value="0" 
                                        @if (old('input_original_kbn') == '0' || null == old('input_original_kbn')) checked @endif 
                                    />
                                    品番
                                </label>
                            </div>
                            <div class="div">
                                <label class="text_wrapper_2">
                                    <input type="radio" id="input_original_kbn_1" name="input_original_kbn" value="1" 
                                        @if (old('input_original_kbn') == '1') checked @endif 
                                    />
                                    SKU
                                </label>
                            </div>
                        </div>
                    </div>
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
            <input type="hidden" id="jan_mode" name="jan_mode" class="display_none_all" value=""></input>
            @include('components.menu.selected', ['view' => 'main'])
		</form>
	</div>
    <script>
        function clickKbn(elm) {
            let clickedId = elm;
            if(clickedId.value === "1"){
                document.getElementById('input_original_kbn_0').checked = true;
                document.getElementById('input_original_kbn_1').disabled = true;
            } else {
                document.getElementById('input_original_kbn_1').disabled = false;
            }
        }
    </script>
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
    <script>
        $('#jan_mode_yes').on('click', function (ev) {
            document.getElementById("jan_mode").value = 1;
        })
        $('#jan_mode_no').on('click', function (ev) {
            document.getElementById("jan_mode").value = 0;
        })
    </script>
@endsection
