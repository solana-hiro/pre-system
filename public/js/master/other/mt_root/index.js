/* 補完関連　共通処理 ルート */
function eventBlurCodeautoRoot(event, element) {
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    if ("" == element.value) {  //列数
        return;
    }
    element.value = element.value.toString().padStart(4, '0');
    //ルート
    if (element.id.match('root')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            root_cd: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        const manageUrl = "../../../code_auto/root?" + query_params;
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
                    tr.parentNode.cells[column + 1].childNodes[0].value = data['root_name'];
                    tr.parentNode.cells[column + 2].childNodes[0].value = data['sort'];
                    let msgHTML = '<li>登録済みのルートコードです。</li>';
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

// 行追加
function rootAddLine() {
    var table1 = document.getElementById("root_grid_table");
    var trs = $('#root_grid_table tbody tr');
    // 最終行のクローン取得
    var lastTr = trs[trs.length - 1];
    var td = $(lastTr).children();
    var row = table1.insertRow(-1);
    var cell1 = row.insertCell(-1);
    var cell2 = row.insertCell(-1);
    var cell3 = row.insertCell(-1);
    cell1.innerHTML = td[0].innerHTML;
    cell2.innerHTML = td[1].innerHTML;
    cell3.innerHTML = td[2].innerHTML;
}
/* ルートマスタ end */

/* 検索関連フィルタ　共通処理 ルート */
function eventBlurSearchRoot(event, element) {
    if (null === element.value || "" === element.value) {
        return false;
    }
    element.value = element.value.toString().padStart(4, '0');
    // ルート
    if (element.id.match('input_root')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            root_cd: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        const manageUrl = "../../../code_auto/root?" + query_params;
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
