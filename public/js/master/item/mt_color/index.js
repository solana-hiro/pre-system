/* 補完関連　共通処理 カラー */
function eventBlurCodeautoColor(event, element) {
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    //カラー
    if (element.id.match('color_code')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            color_cd: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        const manageUrl = "../../../code_auto/color?" + query_params;
        console.log(manageUrl);

        fetch(manageUrl, {
            method: 'GET', // HTTPメソッドを指定
            headers: {
                'Content-Type': 'application/json',
            }
        })
            .then(response => {
                return response.json();
            })
            .then(data => { // 取得したデータの処理
                //書き込み先の設定
                let alertArea = document.getElementById('alert-danger-ul');
                alertArea.innerHTML = "";
                if (null !== data) {
                    tr.parentNode.cells[column + 1].childNodes[0].value = data['color_name'];
                    tr.parentNode.cells[column + 2].childNodes[0].value = data['html_color_cd'];
                    tr.parentNode.cells[column + 3].childNodes[0].value = data['sort_order'];
                    let msgHTML = '<li>登録済みのカラーコードです。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                } else {
                    let msgHTML = '<li>新規データです。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                }
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
    }
}

/* カラーマスタ start */
// 行追加
function colorAddLine() {
    /*
    var table1 = document.getElementById("color_grid_table");
    var row1 = table1.insertRow(-1);
    var cell1 = row1.insertCell(-1);
    var cell2 = row1.insertCell(-1);
    var cell3 = row1.insertCell(-1);
    var cell4 = row1.insertCell(-1);

    cell1.innerHTML = '<input type="text" placeholder="" name="insert_color_code[]" class="grid_textbox" minlength="0" maxlength="5">';
    cell2.innerHTML = '<input type="text" placeholder="" name="insert_color_name[]" class="grid_textbox" minlength="0" maxlength="20">';
    cell3.innerHTML = '<input type="text" placeholder="" name="insert_html_color_code[]" class="grid_textbox" minlength="0" maxlength="7">';
    cell4.innerHTML = '<input type="text" placeholder="" name="insert_sort_order[]" class="grid_textbox" minlength="0" maxlength="3">';
    */
    // 現在の行数(ヘッダー分とINDEX0スタートに合わせる)
    var table1 = document.getElementById("color_grid_table");
    var trs = $('#color_grid_table tbody tr');
    // 最終行のクローン取得
    var lastTr = trs[trs.length - 1];
    var td = $(lastTr).children();
    var row = table1.insertRow(-1);
    var cell1 = row.insertCell(-1);
    var cell2 = row.insertCell(-1);
    var cell3 = row.insertCell(-1);
    var cell4 = row.insertCell(-1);
    cell1.innerHTML = td[0].innerHTML;
    cell2.innerHTML = td[1].innerHTML;
    cell3.innerHTML = td[2].innerHTML;
    cell4.innerHTML = td[2].innerHTML;
}
/* カラーマスタ end */


/* 検索関連フィルタ　共通処理 カラー */
function eventBlurSearchColor(event, element) {
    if (null === element.value || "" === element.value) {
        return false;
    }
    // カラー
    if (element.id.match('input_color')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            color_cd: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        const manageUrl = "../../../code_auto/color?" + query_params;
        console.log(manageUrl);

        fetch(manageUrl, {
            method: 'GET', // HTTPメソッドを指定
            headers: {
                'Content-Type': 'application/json',
            }
        })
            .then(response => {
                return response.json();
            })
            .then(data => { // 取得したデータの処理
                //書き込み先の設定
                let alertArea = document.getElementById('alert-danger-ul');
                alertArea.innerHTML = "";
                if (null !== data) {
                    let tableData = null;
                    tableData = document.getElementById('grid_table_1');
                    for (let j = 0; j < tableData.rows.length; j++) {
                        if (tableData.rows[j].cells[1].childNodes[0].value < element.value) {
                            tableData.rows[j].setAttribute('class', 'display_none_all');
                        } else {
                            tableData.rows[j].removeAttribute('class', 'display_none_all');
                        }
                    }
                } else {
                    let msgHTML = '<li>検索用コードがマスタに存在しません。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                }
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
    }
}
