/* 完了メッセージ・エラーメッセージ用 */
let overlay_gray_common = document.createElement("div");
overlay_gray_common.classList.add("overlay_gray");

let commonModal = document.getElementById('message_modal');

if (null !== commonModal) {
    commonModal.classList.add('is-active');
    commonModal.classList.add('zindex_9002');
    overlay_gray_common.classList.add("overlay_gray");
    document.body.appendChild(overlay_gray_common);

    let close = document.getElementById('common_modal_close');
    if (close != null) {
        close.addEventListener('click', function () {
            if (commonModal != null) {
                commonModal.classList.remove('is-active');
                commonModal.classList.remove('zindex_9002');
            }
            document.body.removeChild(overlay_gray_common);
        }, false);
    }

    let ok = document.getElementById('common_modal_ok');
    if (ok != null) {
        ok.addEventListener('click', function () {
            if (commonModal != null) {
                commonModal.classList.remove('is-active');
                commonModal.classList.remove('zindex_9002');
            }
            document.body.removeChild(overlay_gray_common);
        }, false);
    }
}
// 確認用
$('#modal_confirm').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var url = button.data('url');
    var modal = $(this);
    modal.find('.modal-body p').eq(0).text(title);
    modal.find('form').attr('action', url);
    // 特殊メッセージの表示はボタンに付与される値でコントロール
    const uButton = document.getElementById("updateButton");
    if (uButton) {
        if(uButton.dataset.delKbn == 1 && uButton.dataset.registerJanCode == 1){
            modal.find("#modal_attention").html("JANコード登録が有効になっています。<br>削除区分が有効になっています。<br>登録しますか？");
        }else if(uButton.dataset.delKbn == 1 ){
            modal.find("#modal_attention").html("削除区分が有効になっています。<br>登録しますか？");
        }else if(uButton.dataset.registerJanCode == 1){
            modal.find("#modal_attention").html("JANコード登録が有効になっています。<br>登録しますか？");
        }else if(uButton.dataset.sendCheck == 1){
            modal.find("#modal_attention").html("登録します。<br>ECログインパスワード発行メール送信が有効になっています。送信してよろしいですか。");
        }else{
            modal.find("#modal_attention").html("登録します。よろしいですか？");
        }
    } // 通常メッセージはblade参照
    let confirmModal = document.getElementById('modal_confirm');
    if (null !== confirmModal) {
        confirmModal.classList.add('is-active');
        confirmModal.classList.add('zindex_9002');
        document.body.appendChild(overlay_gray_common);

        let close_button = document.getElementById('modal_close_button2');
        if (close_button != null) {
            close_button.addEventListener('click', function () {
                if (confirmModal != null) {
                    confirmModal.classList.remove('is-active');
                    confirmModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let close = document.getElementById('modal_close2');
        if (close != null) {
            close.addEventListener('click', function () {
                if (confirmModal != null) {
                    confirmModal.classList.remove('is-active');
                    confirmModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let ok = document.getElementById('modal_ok');
        if (ok != null) {
            ok.addEventListener('click', function () {
                if (confirmModal != null) {
                    confirmModal.classList.remove('is-active');
                    confirmModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
    }
});

// 削除用
$('#modal_delete').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var url = button.data('url');
    var value = button.data('value');
    var modal = $(this);
    document.getElementById('delete').value = value;
    modal.find('.modal-body p').eq(0).text(title);
    modal.find('form').attr('action', url);
    let deleteModal = document.getElementById('modal_delete');
    if (null !== deleteModal) {
        deleteModal.classList.add('is-active');
        deleteModal.classList.add('zindex_9002');
        document.body.appendChild(overlay_gray_common);

        let close_button = document.getElementById('modal_close_button3');
        if (close_button != null) {
            close_button.addEventListener('click', function () {
                if (deleteModal != null) {
                    deleteModal.classList.remove('is-active');
                    deleteModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let close = document.getElementById('modal_close3');
        if (close != null) {
            close.addEventListener('click', function () {
                if (deleteModal != null) {
                    deleteModal.classList.remove('is-active');
                    deleteModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let ok = document.getElementById('modal_ok');
        if (ok != null) {
            ok.addEventListener('click', function () {
                if (deleteModal != null) {
                    deleteModal.classList.remove('is-active');
                    deleteModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
    }
});

// キャンセル用
$('#modal_cancel').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var url = button.data('url');
    var modal = $(this);
    modal.find('.modal-body p').eq(0).text(title);
    modal.find('form').attr('action', url);
    let cancelModal = document.getElementById('modal_cancel');
    if (null !== cancelModal) {
        cancelModal.classList.add('is-active');
        cancelModal.classList.add('zindex_9002');
        document.body.appendChild(overlay_gray_common);

        let close_button = document.getElementById('modal_close_button');
        if (close_button != null) {
            close_button.addEventListener('click', function () {
                if (cancelModal != null) {
                    cancelModal.classList.remove('is-active');
                    cancelModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let close = document.getElementById('modal_close');
        if (close != null) {
            close.addEventListener('click', function () {
                if (cancelModal != null) {
                    cancelModal.classList.remove('is-active');
                    cancelModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let ok = document.getElementById('modal_ok');
        if (ok != null) {
            ok.addEventListener('click', function () {
                if (cancelModal != null) {
                    cancelModal.classList.remove('is-active');
                    cancelModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
    }
});

// 詳細など遷移用
$('#modal_transition_confirm').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var url = button.data('url');
    var value = button.data('value');
    var modal = $(this);
    document.getElementById('transition').value = value;
    modal.find('.modal-body p').eq(0).text(title);
    modal.find('form').attr('action', url);
    let transitionModal = document.getElementById('modal_transition_confirm');
    if (null !== transitionModal) {
        transitionModal.classList.add('is-active');
        transitionModal.classList.add('zindex_9002');
        document.body.appendChild(overlay_gray_common);

        let close_button = document.getElementById('modal_close_button4');
        if (close_button != null) {
            close_button.addEventListener('click', function () {
                if (transitionModal != null) {
                    transitionModal.classList.remove('is-active');
                    transitionModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let close = document.getElementById('modal_close4');
        if (close != null) {
            close.addEventListener('click', function () {
                if (transitionModal != null) {
                    transitionModal.classList.remove('is-active');
                    transitionModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let ok = document.getElementById('modal_ok');
        if (ok != null) {
            ok.addEventListener('click', function () {
                if (transitionModal != null) {
                    transitionModal.classList.remove('is-active');
                    transitionModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
    }
});

// パスワードリセット用
$('#modal_password_reset').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var url = button.data('url');
    var modal = $(this);
    modal.find('.modal-body p').eq(0).text(title);
    modal.find('form').attr('action', url);
    let resetPasswordModal = document.getElementById('modal_password_reset');
    if (null !== resetPasswordModal) {
        resetPasswordModal.classList.add('is-active');
        resetPasswordModal.classList.add('zindex_9002');
        document.body.appendChild(overlay_gray_common);

        let close_button = document.getElementById('modal_close_button5');
        if (close_button != null) {
            close_button.addEventListener('click', function () {
                if (resetPasswordModal != null) {
                    resetPasswordModal.classList.remove('is-active');
                    resetPasswordModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let close = document.getElementById('modal_close5');
        if (close != null) {
            close.addEventListener('click', function () {
                if (resetPasswordModal != null) {
                    resetPasswordModal.classList.remove('is-active');
                    resetPasswordModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let ok = document.getElementById('modal_ok');
        if (ok != null) {
            ok.addEventListener('click', function () {
                if (resetPasswordModal != null) {
                    resetPasswordModal.classList.remove('is-active');
                    resetPasswordModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
    }
});

// サブ削除用
$('#modal_sub_delete').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var url = button.data('url');
    var value = button.data('value');
    var modal = $(this);
    document.getElementById('sub_delete').value = value;
    modal.find('.modal-body p').eq(0).text(title);
    modal.find('form').attr('action', url);
    let subDeleteModal = document.getElementById('modal_sub_delete');
    if (null !== subDeleteModal) {
        subDeleteModal.classList.add('is-active');
        subDeleteModal.classList.add('zindex_9002');
        document.body.appendChild(overlay_gray_common);

        let close_button = document.getElementById('modal_close_button6');
        if (close_button != null) {
            close_button.addEventListener('click', function () {
                if (subDeleteModal != null) {
                    subDeleteModal.classList.remove('is-active');
                    subDeleteModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let close = document.getElementById('modal_close6');
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

// 拡張用
$('#modal_extend').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var url = button.data('url');
    var value = button.data('value');
    var modal = $(this);
    document.getElementById('mod_supplier_expansion_1').value = document.getElementById('supplier_expansion_1').value;
    document.getElementById('mod_supplier_expansion_2').value = document.getElementById('supplier_expansion_2').value;
    document.getElementById('mod_supplier_expansion_3').value = document.getElementById('supplier_expansion_3').value;
    document.getElementById('mod_supplier_expansion_4').value = document.getElementById('supplier_expansion_4').value;
    document.getElementById('mod_supplier_expansion_5').value = document.getElementById('supplier_expansion_5').value;
    modal.find('.modal-body p').eq(0).text(title);
    modal.find('form').attr('action', url);
    let subDeleteModal = document.getElementById('modal_extend');
    if (null !== subDeleteModal) {
        subDeleteModal.classList.add('is-active');
        subDeleteModal.classList.add('zindex_9002');
        document.body.appendChild(overlay_gray_common);

        let close_button = document.getElementById('modal_close_button_extend');
        if (close_button != null) {
            close_button.addEventListener('click', function () {
                if (subDeleteModal != null) {
                    subDeleteModal.classList.remove('is-active');
                    subDeleteModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let close = document.getElementById('modal_close_extend');
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

// 拡張用2
$('#modal_extend_customer').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var url = button.data('url');
    var value = button.data('value');
    var modal = $(this);
    document.getElementById('mod_customer_expansion_1').value = document.getElementById('customer_expansion_1').value;
    document.getElementById('mod_customer_expansion_2').value = document.getElementById('customer_expansion_2').value;
    document.getElementById('mod_customer_expansion_3').value = document.getElementById('customer_expansion_3').value;
    document.getElementById('mod_customer_expansion_4').value = document.getElementById('customer_expansion_4').value;
    document.getElementById('mod_customer_expansion_5').value = document.getElementById('customer_expansion_5').value;
    modal.find('.modal-body p').eq(0).text(title);
    modal.find('form').attr('action', url);
    let subDeleteModal = document.getElementById('modal_extend_customer');
    if (null !== subDeleteModal) {
        subDeleteModal.classList.add('is-active');
        subDeleteModal.classList.add('zindex_9002');
        document.body.appendChild(overlay_gray_common);

        let close_button = document.getElementById('modal_close_button_extend');
        if (close_button != null) {
            close_button.addEventListener('click', function () {
                if (subDeleteModal != null) {
                    subDeleteModal.classList.remove('is-active');
                    subDeleteModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let close = document.getElementById('modal_close_extend');
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

// 解除用
$('#modal_remove_confirm').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var url = button.data('url');
    var value = button.data('value');
    var modal = $(this);
    document.getElementById('remove').value = value;
    modal.find('.modal-body p').eq(0).text(title);
    modal.find('form').attr('action', url);
    let removeModal = document.getElementById('modal_remove_confirm');
    if (null !== removeModal) {
        removeModal.classList.add('is-active');
        removeModal.classList.add('zindex_9002');
        document.body.appendChild(overlay_gray_common);

        let close_button = document.getElementById('modal_remove_close_button');
        if (close_button != null) {
            close_button.addEventListener('click', function () {
                if (removeModal != null) {
                    removeModal.classList.remove('is-active');
                    removeModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let close = document.getElementById('modal_remove_close');
        if (close != null) {
            close.addEventListener('click', function () {
                if (removeModal != null) {
                    removeModal.classList.remove('is-active');
                    removeModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let ok = document.getElementById('modal_ok');
        if (ok != null) {
            ok.addEventListener('click', function () {
                if (removeModal != null) {
                    removeModal.classList.remove('is-active');
                    removeModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
    }
});

// 実行用
$('#modal_execute_confirm').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var url = button.data('url');
    var value = button.data('value');
    var modal = $(this);
    document.getElementById('execute').value = value;
    modal.find('.modal-body p').eq(0).text(title);
    modal.find('form').attr('action', url);
    let executeModal = document.getElementById('modal_execute_confirm');
    if (null !== executeModal) {
        executeModal.classList.add('is-active');
        executeModal.classList.add('zindex_9002');
        document.body.appendChild(overlay_gray_common);

        let close_button = document.getElementById('modal_execute_close_button');
        if (close_button != null) {
            close_button.addEventListener('click', function () {
                if (executeModal != null) {
                    executeModal.classList.remove('is-active');
                    executeModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let close = document.getElementById('modal_execute_close');
        if (close != null) {
            close.addEventListener('click', function () {
                if (executeModal != null) {
                    executeModal.classList.remove('is-active');
                    executeModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let ok = document.getElementById('modal_ok');
        if (ok != null) {
            ok.addEventListener('click', function () {
                if (executeModal != null) {
                    executeModal.classList.remove('is-active');
                    executeModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
    }
});

// Unsavedは現在グローバルで定義してある
// わかりずらいので要修正（これもモジュール化するのが吉）
function submitCancel() {
    Unsaved.disable();
    document.getElementById('cancel').click();
}

function submitUpdate() {
    Unsaved.disable();
    document.getElementById('update').click();
}

function submitExecute() {
    Unsaved.disable();
    document.getElementById('execute').click();
}

function submitRemove() {
    Unsaved.disable();
    document.getElementById('remove').click();
}

function submitDelete() {
    Unsaved.disable();
    document.getElementById('delete').click();
}

function submitSubDelete() {
    Unsaved.disable();
    document.getElementById('sub_delete').click();
}

function submitTransition() {
    Unsaved.disable();
    document.getElementById('transition').click();
}

// 名前にsubmitとあるがsubmitじゃない、だがbuttonのtypeがsubmitなのでバグの原因になる可能性大
function submitExtend() {
    document.getElementById('supplier_expansion_1').value = document.getElementById('mod_supplier_expansion_1').value;
    document.getElementById('supplier_expansion_2').value = document.getElementById('mod_supplier_expansion_2').value;
    document.getElementById('supplier_expansion_3').value = document.getElementById('mod_supplier_expansion_3').value;
    document.getElementById('supplier_expansion_4').value = document.getElementById('mod_supplier_expansion_4').value;
    document.getElementById('supplier_expansion_5').value = document.getElementById('mod_supplier_expansion_5').value;
    let modal = document.getElementById('modal_extend');
    if (modal != null) {
        modal.classList.remove('is-active');
        modal.classList.remove('zindex_9002');
        modal.style.display = 'none';
    }
    document.body.removeChild(overlay_gray_common);

}

// 名前にsubmitとあるがsubmitじゃない、だがbuttonのtypeがsubmitなのでバグの原因になる可能性大
function submitExtendCustomer() {
    document.getElementById('customer_expansion_1').value = document.getElementById('mod_customer_expansion_1').value;
    document.getElementById('customer_expansion_2').value = document.getElementById('mod_customer_expansion_2').value;
    document.getElementById('customer_expansion_3').value = document.getElementById('mod_customer_expansion_3').value;
    document.getElementById('customer_expansion_4').value = document.getElementById('mod_customer_expansion_4').value;
    document.getElementById('customer_expansion_5').value = document.getElementById('mod_customer_expansion_5').value;
    let modal = document.getElementById('modal_extend_customer');
    if (modal != null) {
        modal.classList.remove('is-active');
        modal.classList.remove('zindex_9002');
        modal.style.display = 'none';
    }
    document.body.removeChild(overlay_gray_common);

}

// 名前にsubmitとあるがsubmitじゃない、だがbuttonのtypeがsubmitなのでバグの原因になる可能性大
function submitPasswordReset() {
    //パスワード入力欄のUI変更 0:既存データ変更なし　1:新規　2:パスワードリセット
    document.getElementById('password_mode').value = '2';
    document.getElementById('password1').disabled = false;
    document.getElementById('password1').value = '';
    document.getElementById('password2').disabled = false;
    document.getElementById('password2').value = '';
    document.getElementById('eye1').style.display = 'block';
    document.getElementById('eye2').style.display = 'block';

    let resetPasswordModal = document.getElementById('modal_password_reset');
    if (resetPasswordModal != null) {
        resetPasswordModal.classList.remove('is-active');
        resetPasswordModal.classList.remove('zindex_9002');
        resetPasswordModal.style.display = 'none';
    }
    document.body.removeChild(overlay_gray_common);


}

// 確認用　ファイルインポート1
$('#file_confirm1').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var url = button.data('url');
    var modal = $(this);
    modal.find('.modal-body p').eq(0).text(title);
    modal.find('form').attr('action', url);
    let confirmModal = document.getElementById('file_confirm1');
    if (null !== confirmModal) {
        confirmModal.classList.add('is-active');
        confirmModal.classList.add('zindex_9002');
        document.body.appendChild(overlay_gray_common);

        let close_button = document.getElementById('modal_close_button_file_confirm1');
        if (close_button != null) {
            close_button.addEventListener('click', function () {
                if (confirmModal != null) {
                    confirmModal.classList.remove('is-active');
                    confirmModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let close = document.getElementById('modal_close_file_confirm1');
        if (close != null) {
            close.addEventListener('click', function () {
                if (confirmModal != null) {
                    confirmModal.classList.remove('is-active');
                    confirmModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let ok = document.getElementById('modal_ok');
        if (ok != null) {
            ok.addEventListener('click', function () {
                if (confirmModal != null) {
                    confirmModal.classList.remove('is-active');
                    confirmModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
    }
});

// 確認用　ファイルインポート2
$('#file_confirm2').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var url = button.data('url');
    var modal = $(this);
    modal.find('.modal-body p').eq(0).text(title);
    modal.find('form').attr('action', url);
    let confirmModal = document.getElementById('file_confirm2');
    if (null !== confirmModal) {
        confirmModal.classList.add('is-active');
        confirmModal.classList.add('zindex_9002');
        document.body.appendChild(overlay_gray_common);

        let close_button = document.getElementById('modal_close_button_file_confirm2');
        if (close_button != null) {
            close_button.addEventListener('click', function () {
                if (confirmModal != null) {
                    confirmModal.classList.remove('is-active');
                    confirmModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let close = document.getElementById('modal_close_file_confirm2');
        if (close != null) {
            close.addEventListener('click', function () {
                if (confirmModal != null) {
                    confirmModal.classList.remove('is-active');
                    confirmModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let ok = document.getElementById('modal_ok');
        if (ok != null) {
            ok.addEventListener('click', function () {
                if (confirmModal != null) {
                    confirmModal.classList.remove('is-active');
                    confirmModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
    }
});

// 確認用　ファイルインポート3
$('#file_confirm3').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var url = button.data('url');
    var modal = $(this);
    modal.find('.modal-body p').eq(0).text(title);
    modal.find('form').attr('action', url);
    let confirmModal = document.getElementById('file_confirm3');
    if (null !== confirmModal) {
        confirmModal.classList.add('is-active');
        confirmModal.classList.add('zindex_9002');
        document.body.appendChild(overlay_gray_common);

        let close_button = document.getElementById('modal_close_button_file_confirm3');
        if (close_button != null) {
            close_button.addEventListener('click', function () {
                if (confirmModal != null) {
                    confirmModal.classList.remove('is-active');
                    confirmModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let close = document.getElementById('modal_close_file_confirm3');
        if (close != null) {
            close.addEventListener('click', function () {
                if (confirmModal != null) {
                    confirmModal.classList.remove('is-active');
                    confirmModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let ok = document.getElementById('modal_ok');
        if (ok != null) {
            ok.addEventListener('click', function () {
                if (confirmModal != null) {
                    confirmModal.classList.remove('is-active');
                    confirmModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
    }
});

// 確認用　ファイルインポート4
$('#file_confirm4').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var url = button.data('url');
    var modal = $(this);
    modal.find('.modal-body p').eq(0).text(title);
    modal.find('form').attr('action', url);
    let confirmModal = document.getElementById('file_confirm4');
    if (null !== confirmModal) {
        confirmModal.classList.add('is-active');
        confirmModal.classList.add('zindex_9002');
        document.body.appendChild(overlay_gray_common);

        let close_button = document.getElementById('modal_close_button_file_confirm4');
        if (close_button != null) {
            close_button.addEventListener('click', function () {
                if (confirmModal != null) {
                    confirmModal.classList.remove('is-active');
                    confirmModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let close = document.getElementById('modal_close_file_confirm4');
        if (close != null) {
            close.addEventListener('click', function () {
                if (confirmModal != null) {
                    confirmModal.classList.remove('is-active');
                    confirmModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
    }
});

// 確認用　ファイルインポート5
$('#file_confirm5').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var title = button.data('title');
    var url = button.data('url');
    var modal = $(this);
    modal.find('.modal-body p').eq(0).text(title);
    modal.find('form').attr('action', url);
    let confirmModal = document.getElementById('file_confirm5');

    $('#file_confirm4').modal('hide');

    if (null !== confirmModal) {
        confirmModal.classList.add('is-active');
        confirmModal.classList.add('zindex_9002');
        document.body.appendChild(overlay_gray_common);

        let close_button = document.getElementById('modal_close_button_file_confirm5');
        if (close_button != null) {
            close_button.addEventListener('click', function () {
                if (confirmModal != null) {
                    confirmModal.classList.remove('is-active');
                    confirmModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let close = document.getElementById('modal_close_file_confirm5');
        if (close != null) {
            close.addEventListener('click', function () {
                if (confirmModal != null) {
                    confirmModal.classList.remove('is-active');
                    confirmModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
        let ok = document.getElementById('modal_ok');
        if (ok != null) {
            ok.addEventListener('click', function () {
                if (confirmModal != null) {
                    confirmModal.classList.remove('is-active');
                    confirmModal.classList.remove('zindex_9002');
                }
                document.body.removeChild(overlay_gray_common);
            }, false);
        }
    }
});

