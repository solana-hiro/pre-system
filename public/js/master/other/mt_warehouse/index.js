/* 補完関連　共通処理 倉庫 */
function eventBlurCodeautoWarehouse(event, element) {
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    //書き込み先の設定
    let alertArea = document.getElementById('alert-danger-ul');

    if (null === element.value || "" === element.value) {
        tr.parentNode.cells[column + 1].childNodes[0].value = "";
        tr.parentNode.cells[column + 2].childNodes[0].value = "";
        tr.parentNode.cells[column + 3].childNodes[0].value = "";
        tr.parentNode.cells[column + 4].childNodes[0].value = "";
        tr.parentNode.cells[column + 5].childNodes[0].value = "";
        tr.parentNode.cells[column + 6].childNodes[0].value = "";
        alertArea.innerHTML = "";
        return;
    } else {
        element.value = element.value.toString().padStart(6, '0');
    }
    //倉庫
    if (element.id.match('warehouse')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            warehouse_code: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        manageUrl = "../../../../code_auto/warehouse?" + query_params;
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
                alertArea.innerHTML = "";
                if (null !== data) {
                    tr.parentNode.cells[column + 1].childNodes[0].value = data['warehouse_name'];
                    tr.parentNode.cells[column + 2].childNodes[0].value = data['warehouse_name_kana'];
                    tr.parentNode.cells[column + 3].childNodes[0].value = data['warehouse_kind'];
                    tr.parentNode.cells[column + 4].childNodes[0].value = data['analysis_warehouse_kbn'];
                    tr.parentNode.cells[column + 5].childNodes[0].value = data['asset_stock_validity_kbn'];
                    tr.parentNode.cells[column + 6].childNodes[0].value = data['del_kbn'];
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

/* 検索関連フィルタ　共通処理 倉庫 */
function eventBlurSearchWarehouse(event, element) {
    if (null === element.value || "" === element.value) {
        return false;
    }
    element.value = element.value.toString().padStart(6, '0');
    // 倉庫
    if (element.id.match('warehouse')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            warehouse_code: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        manageUrl = "../../../code_auto/warehouse?" + query_params;
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