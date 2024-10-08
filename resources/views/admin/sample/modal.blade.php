@extends('layouts.admin.app')
@section('page_title', 'SAMPLE')
@section('title', 'SAMPLE')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

	<h3>modalTEST</h3>

<button id="btn1">ディレクトリを開く</button>
<script>
document.getElementById('btn1').addEventListener('click', async () => {
  // ディレクトリ選択ダイアログを表示して

  var root_dir = null;
var selected_fileHandle = null;
window.addEventListener('load', (event) => {
    document.querySelector('#btn1').addEventListener('click', async() => {
        const dirHandle = await window.showDirectoryPicker();
        root_dir = dirHandle;
        console.log(dirHandle);
        for await (const entry of dirHandle.values()) {
            console.log(entry.kind, entry.name, entry);
            const path = await dirHandle.resolve(entry);
            console.log(path);
        }

    });
    document.querySelector('#btn_select_file').addEventListener('click', async() => {
        [fileHandle] = await window.showOpenFilePicker();
        await readFile(fileHandle);
        if (root_dir) {
            const path = await root_dir.resolve(fileHandle);
            path.unshift(root_dir.name);
            console.log(path);
            document.querySelector('#file_path').textContent = path.join('/');
        }
    });
    // ファイルを読み込む
    async function readFile(fileHandle) {
        selected_fileHandle = fileHandle;
        const file = await selected_fileHandle.getFile();
        const fileContents = await file.text();
        console.log(file);
        console.log(fileContents);
        document.querySelector('#file_path').textContent = file.name;
        document.querySelector('#editor').value = fileContents;
//        document.querySelector('#btn_save').disabled = false;
    }
});
});
</script>


	<button class="tooltip">
	<span class="tooltip-text">ツールチップの内容</span>
	tooltip TEST
	</button>
	<br><br>
	<div class="div_tooltip">
		<input type="text" size="100" name="memo" value="{{ old('memo') }}">
		<div class="tooltip">ハンドル名は4～20文字です</div>
	</div>

	<br><br>
	<input type="text" size="100" name="memo" value="{{ old('memo') }}">
	<div class="button_area">
		<div class="div">
			<button class="button" type="submit" name="cancel"><div class="text_wrapper">キャンセル</div></button>
			<button class="button" type="submit" name="delete"><div class="text_wrapper">削除する</div></button>
			<button class="div-wrapper" type="submit" name="prev"><div class="text_wrapper_2">前頁</div></button>
			<button class="div-wrapper" type="submit" name="next"><div class="text_wrapper_2">次頁</div></button>
			<button class="button-2" type="submit" name="update"><div class="text_wrapper_3">実行する</div></button>

			<button class="button" name="delete" data-toggle="modal" data-target="#deleteModal" data-title="{{ 'TEST100' }}" data-url="{{ route('master.search.sample') }}" ><div class="text_wrapper">削除するTEST</div></button>
		</div>
	</div>
	<a class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal" data-title="{{ 'TEST100' }}" data-url="{{ route('master.search.sample') }}" > 削除 </a>
	<a class="btn btn-outline-danger" data-toggle="modal" data-target="#errorModal" data-title="{{ 'TEST100' }}" data-url="{{ route('master.search.sample') }}" > エラー </a>
	<a class="btn btn-outline-danger" data-toggle="modal" data-target="#delete-btn" data-title="{{ 'TEST100' }}" data-url="{{ route('master.search.sample') }}" > 削除2 </a>

	<a href="#delete-btn" class="button delete-btn">削除</a>

	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	    <form role="form" class="form-inline" method="get" action="">
	    @csrf
	    <figure>
	   		<figcaption>
	        <div class="modal-dialog modal-dialog-centered">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h4 class="modal-title" id="myModalLabel">削除確認</h4>
	                </div>
	                <div class="modal-body">
	                    <p></p>
	                </div>
	                <div class="modal-footer">
	                    <a class="btn btn-light" data-dismiss="modal">閉じる</a>
	                    <button type="submit" class="btn btn-danger" name="delete">削除</button>
	                </div>
	                </figcaption>
	            </div>
	        </div>
	        </figcaption>
	    </figure>
	    </form>

	    <script>
	    window.onload = function() {
	        $('#deleteModal').on('shown.bs.modal', function (event) {
	            var button = $(event.relatedTarget);//モーダルを呼び出すときに使われたボタンを取得
	            var title = button.data('title');//data-titleの値を取得
	            var url = button.data('url');//data-urlの値を取得
	            var modal = $(this);//モーダルを取得

	            //Ajaxの処理はここに
	            //modal-bodyのpタグにtextメソッド内を表示
	            modal.find('.modal-body p').eq(0).text("本当に"+title+"を削除しますか?");
	            //formタグのaction属性にurlのデータ渡す
	            modal.find('form').attr('action',url);
	        });
	    }
		</script>
	</div>

	<div class="modal" id="delete-btn">
		<figure>
		<a href="#" class="close"></a>
			<figcaption><p>表示中のデータを削除します。<br>よろしいですか？</p>
				<div class="button-area">
					<a href="#" class="button clear-btn">キャンセル</a>
					<a href="#deletecompleted" class="button" id="deleteconfirmed">OK</a>
				</div>
			</figcaption>

		</figure>
	</div>


<div class="modal" id="deleteCompleted">
    <figure>
        <a href="#" class="close"></a>
        <figcaption><p>データを削除しました。</p>
            <div class="button-area">
                <a href="" class="button">OK</a>
            </div>
        </figcaption>
    </figure>
</div>

@endsection
