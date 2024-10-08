<div class="modal-box modal-box-w500px" tabindex="-1" role="dialog" id="modal_manager" style="z-index: 99999; padding:0;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<header class="header">
				<div class="text-wrapper">担当者情報編集</div>
				<div>
					<button type="" class="button_close" data-dismiss="modal" id="modal_close_button_manager">
					<img class="" src="{{ asset('/img/icon/modal_close.svg') }}"></button>
				</button>
				</div>
			</header>
            <div class="modal-body" style="margin-top: 10px;">
				 <div class="element-form-columns">
					<div class="alert alert-danger">
						<ul id="modal-alert-danger-ul">
					</div>
					<div class="element-form element-form-rows">
						<div class="text_wrapper txt_required">得意先担当者名</div>
						<div class="frame">
						    <div class="textbox" style="margin-left: 20px;">
								<input type="text" name="mod_manager_name" id="mod_manager_name" class="element" minlength="0" maxlength="20" size="24" value="" />
							</div>
						</div>
					</div><br>
					<div class="element-form element-form-rows">
						<div class="text_wrapper txt_required">E-Mail</div>
						<div class="frame">
						    <div class="textbox" style="margin-left: 10px;">
								<input type="text" name="mod_manager_mail" id="mod_manager_mail" class="element" minlength="0" maxlength="256" size="24" value="" />
							</div>
						</div>
					</div><br>
					<div class="element-form element-form-rows">
						<div class="text_wrapper txt_required">ECログインID</div>
						<div class="frame">
						    <div class="textbox" style="margin-left: 10px;">
								<input type="text" name="mod_ec_login_id" id="mod_ec_login_id" class="element" minlength="0" maxlength="15" size="24" value="" />
							</div>
						</div>
					</div><br>
					<div class="element-form element-form-rows">
						<div class="group">
								<input type="checkbox" name="mod_change_password_flg" id="mod_change_password_flg" value="0" onclick="checkChangePasswordFlg()"/>
								<label for="mod_change_password_flg">パスワードを変更する</label>
						</div>
					</div>
					<div class="element-form element-form-rows">
						<div class="text_wrapper">ECログインパスワード</div>
						<div class="frame">
						    <div class="textbox" style="margin-left: 10px;">
								<input type="password" name="mod_ec_login_password" id="mod_ec_login_password"
								    class="element" minlength="0" maxlength="20" size="24" value="" disabled/>
							</div>
						</div>
					</div><br>
					<div class="element-form element-form-rows">
						<div class="text_wrapper">ECログインパスワード（確認）</div>
						<div class="frame">
						    <div class="textbox" style="margin-left: 10px;">
								<input type="password" name="mod_ec_login_password_confirm" id="mod_ec_login_password_confirm" 
								    class="element" minlength="0" maxlength="20" size="24" value="" disabled/>
							</div>
						</div>
					</div><br>
					<div class="element-form element-form-rows">
						<div class="group">
								<input type="checkbox" name="" id="send_password_flg" value="0" />
								<label for="send_password_flg">パスワード発行メール送信</label>
						</div>
					</div><br>
					<div class="element-form element-form-rows">
						<div class="group">
								<input type="checkbox" name="" id="valid_flg" value="0" />
								<label for="valid_flg">有効</label>
						</div>
					</div><br>
					<div class="element-form element-form-rows">
						<div class="text_wrapper txt_required">表示順</div>
						<div class="frame">
						    <div class="textbox" style="margin-left: 10px;">
								<input type="number" name="mod_display_order" id="mod_display_order" class="element input_number_3" data-limit-len="3" data-limit-minus value="" />
							</div>
						</div>
					</div><br>
					<div class="element-form element-form-rows">
						<div class="text_wrapper">備考</div>
					</div><br>
					<div class="element-form element-form-rows">
						<div class="frame">
								<textarea id="mod_memo" name="content" rows="3" cols="50" class="textarea"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="button_area">
				<div>
					<button type="button" class="modal_button" onclick="updateManager();"><div class="text_wrapper" >OK</div></button>
					<button type="button" class="modal_button" data-dismiss="modal" id="modal_close_manager"><div class="text_wrapper">キャンセル</div></button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	var allTr;
	var modalAlertArea = document.getElementById('modal-alert-danger-ul');
	var mod_manager_name = document.getElementById('mod_manager_name');
	var mod_manager_mail = document.getElementById('mod_manager_mail');
	var mod_ec_login_id = document.getElementById('mod_ec_login_id');
	var send_password_flg = document.getElementById('send_password_flg');
	var valid_flg = document.getElementById('valid_flg');
	var mod_memo = document.getElementById('mod_memo');
	var mod_display_order = document.getElementById('mod_display_order');
	var mod_ec_login_password = document.getElementById('mod_ec_login_password');
	var mod_ec_login_password_confirm = document.getElementById('mod_ec_login_password_confirm');
	var mod_change_password_flg = document.getElementById('mod_change_password_flg');

	// 担当者設定用
    $('#modal_manager').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var title = button.data('title');
        var url = button.data('url');
        var value = button.data('value');
        var modal = $(this);
		modalAlertArea.innerHTML = "";

        var referenceElement = button.parent();
        allTr = referenceElement.siblings()

        mod_manager_name.value = allTr[2].firstElementChild.value;
        mod_manager_mail.value = allTr[3].firstElementChild.value;
        mod_ec_login_id.value = allTr[4].firstElementChild.value;

		if(allTr[6].firstElementChild.value == "1"){
			send_password_flg.checked = true;
		} else{
			send_password_flg.checked = false;
		}

        if(allTr[7].firstElementChild.value == "1") {
			valid_flg.checked = true;
		}else{
			valid_flg.checked = false;
		}
        mod_memo.value = allTr[8].firstElementChild.value;
        mod_display_order.value = allTr[9].value;
        mod_ec_login_password.value = allTr[10].value;
        mod_ec_login_password_confirm.value = allTr[10].value;
		if(allTr[11].value == "1") {
			mod_change_password_flg.checked = true;
		}else{
			mod_change_password_flg.checked = false;
		}

		checkChangeModalPasswordFlg();

        modal.find('.modal-body p').eq(0).text(title);
        modal.find('form').attr('action', url);
        let subDeleteModal = document.getElementById('modal_manager');
        if (null !== subDeleteModal) {
            subDeleteModal.classList.add('is-active');
            subDeleteModal.classList.add('zindex_9002');
            document.body.appendChild(overlay_gray_common);

            let close_button = document.getElementById('modal_close_button_manager');
            if (close_button != null) {
                close_button.addEventListener('click', function () {
                    if (subDeleteModal != null) {
                        subDeleteModal.classList.remove('is-active');
                        subDeleteModal.classList.remove('zindex_9002');
                    }
                    document.body.removeChild(overlay_gray_common);
                }, false);
            }
            let close = document.getElementById('modal_close_manager');
            if (close != null) {
                close.addEventListener('click', function () {
                    if (subDeleteModal != null) {
                        subDeleteModal.classList.remove('is-active');
                        subDeleteModal.classList.remove('zindex_9002');
                    }
                    document.body.removeChild(overlay_gray_common);
                }, false);
            }
            let ok = document.getElementById('modal_ok');
            if (ok != null) {
                ok.addEventListener('click', function () {
                    if (subDeleteModal != null) {
                        subDeleteModal.classList.remove('is-active');
                        subDeleteModal.classList.remove('zindex_9002');
                    }
                    document.body.removeChild(overlay_gray_common);
                }, false);
            }
        }
    });

	// 選択した元データでパスワード設定がされていればモーダルに反映
	function checkChangeModalPasswordFlg() {
		var ec_login_password = allTr[10].value;

		if(ec_login_password != "" && ec_login_password != null){
			mod_change_password_flg.checked = true;
			mod_ec_login_password.disabled = false;
            mod_ec_login_password_confirm.disabled = false;
            send_password_flg.disabled = false;
        }else{
			mod_change_password_flg.checked = false;
			mod_ec_login_password.disabled = true;
            mod_ec_login_password_confirm.disabled = true;
            send_password_flg.disabled = true;
        }
	}

	// パスワード変更チェック有無によるdisable変更
	function checkChangePasswordFlg() {
		if(mod_change_password_flg.checked){
            mod_ec_login_password.disabled = false;
            mod_ec_login_password_confirm.disabled = false;
			send_password_flg.disabled = false;
        }else{
            mod_ec_login_password.disabled = true;
            mod_ec_login_password_confirm.disabled = true;
			send_password_flg.disabled = true;
        }
	}

	// パスワードチェック
	function checkPasswordConfirm() {
		if(!mod_change_password_flg.checked) return true;

		if( "" != mod_ec_login_password.value && mod_ec_login_password.value == mod_ec_login_password_confirm.value){
			return true;
        }else{
			modalAlertArea.innerHTML = "ECログインパスワードが正しくありません";
			return false;
        }
	}

	// 必須入力項目のチェック
	function checkRequired() {
		if( "" == mod_manager_name.value){
			modalAlertArea.innerHTML = "得意先担当者名は必須項目です";
			return false;
        }
		if( "" == mod_manager_mail.value){
			modalAlertArea.innerHTML = "E-Mailは必須項目です";
			return false;
        }
		if( "" == mod_ec_login_id.value){
			modalAlertArea.innerHTML = "ECログインIDは必須項目です";
			return false;
        }
		if( "" == mod_display_order.value){
			modalAlertArea.innerHTML = "表示順は必須項目です";
			return false;
        }

		if( "" == allTr[12].value && "" == mod_ec_login_password.value) {
			modalAlertArea.innerHTML = "新規登録時はECログインパスワードは必須項目です";
			return false;
		}
		return true;
	}

	// メイン画面への値反映
    function updateManager() {
		modalAlertArea.innerHTML = "";
		if(!checkPasswordConfirm()) return;
		if(!checkRequired()) return;
        allTr[2].firstElementChild.value = mod_manager_name.value;
		allTr[3].firstElementChild.value = mod_manager_mail.value;
		allTr[4].firstElementChild.value = mod_ec_login_id.value;
        if(document.getElementById('send_password_flg').checked) {
			allTr[6].firstElementChild.value = 1;
			allTr[6].children[1].checked = true;
		} else{
			allTr[6].firstElementChild.value = 0;
			allTr[6].children[1].checked = false;
		}

		// 一件でもメール送付チェックがある場合は、登録モーダルのメッセージを変更する
		var sendPasswordFlgChecks = document.querySelectorAll('input[name="send_password_flg_check"]:checked');
		if (sendPasswordFlgChecks.length === 0) {
			document.getElementById('updateButton').dataset.sendCheck = 0;
		} else {
			document.getElementById('updateButton').dataset.sendCheck = 1;
		}

		if(document.getElementById('valid_flg').checked) {
			allTr[7].firstElementChild.value = 1;
			allTr[7].children[1].checked = true;
		} else{
			allTr[7].firstElementChild.value = 0;
			allTr[7].children[1].checked = false;
		}
		allTr[8].firstElementChild.value = mod_memo.value;
		allTr[9].value = mod_display_order.value;
		allTr[10].value = mod_ec_login_password.value;
        if(document.getElementById('mod_change_password_flg').checked) {
			allTr[11].value = 1;
		} else{
			allTr[11].value = 0;
		}
        let modal = document.getElementById('modal_manager');
        if (modal != null) {
            modal.classList.remove('is-active');
            modal.classList.remove('zindex_9002');
            modal.style.display = 'none';
        }
        document.body.removeChild(overlay_gray_common);

    }

</script>