window.onload = function() {
    let classId2 = document.getElementById('item_class_id_2');
    let classId3 = document.getElementById('item_class_id_3');
    let classId4 = document.getElementById('item_class_id_4');
    let classId5 = document.getElementById('item_class_id_5');
    let classId6 = document.getElementById('item_class_id_6');
    let classId7 = document.getElementById('item_class_id_7');
    if (classId2.checked === true) {
        document.getElementById('item_class_label').innerHTML = "競技・カテゴリ名";
    } else if (classId3.checked === true) {
        document.getElementById('item_class_label').innerHTML = "ジャンル名";
    } else if (classId4.checked === true) {
        document.getElementById('item_class_label').innerHTML = "販売開始年名";
    } else if (classId5.checked === true) {
        document.getElementById('item_class_label').innerHTML = "工場分類5名";
    } else if (classId6.checked === true) {
        document.getElementById('item_class_label').innerHTML = "製品/工賃6名";
    } else if (classId7.checked === true) {
        document.getElementById('item_class_label').innerHTML = "資産在庫JA名";
    } else {
        document.getElementById('item_class_label').innerHTML = "ブランド1名";
    }
}

// ラジオボタン変更
function itemClassMstClick() {
    let check1 = document.mtItemClassListForm.item_class_id_1.checked;
    let check2 = document.mtItemClassListForm.item_class_id_2.checked;
    let check3 = document.mtItemClassListForm.item_class_id_3.checked;
    let check4 = document.mtItemClassListForm.item_class_id_4.checked;
    let check5 = document.mtItemClassListForm.item_class_id_5.checked;
    let check6 = document.mtItemClassListForm.item_class_id_6.checked;
    let check7 = document.mtItemClassListForm.item_class_id_7.checked;
    let itemClass1 = document.getElementById('item_class_1');
    let itemClass2 = document.getElementById('item_class_2');
    let itemClass3 = document.getElementById('item_class_3');
    let itemClass4 = document.getElementById('item_class_4');
    let itemClass5 = document.getElementById('item_class_5');
    let itemClass6 = document.getElementById('item_class_6');
    let itemClass7 = document.getElementById('item_class_7');
    let label = document.getElementById('item_class_label');
    if (check2 == true) {
        itemClass1.style.display = "none";
        itemClass2.style.display = "block";
        itemClass3.style.display = "none";
        itemClass4.style.display = "none";
        itemClass5.style.display = "none";
        itemClass6.style.display = "none";
        itemClass7.style.display = "none";
        if (null !== label) {
            label.innerHTML = '競技・カテゴリ名';
        }
    } else if (check3 == true) {
        itemClass1.style.display = "none";
        itemClass2.style.display = "none";
        itemClass3.style.display = "block";
        itemClass4.style.display = "none";
        itemClass5.style.display = "none";
        itemClass6.style.display = "none";
        itemClass7.style.display = "none";
        if (null !== label) {
            label.innerHTML = 'ジャンル名';
        }
    } else if (check4 == true) {
        itemClass1.style.display = "none";
        itemClass2.style.display = "none";
        itemClass3.style.display = "none";
        itemClass4.style.display = "block";
        itemClass5.style.display = "none";
        itemClass6.style.display = "none";
        itemClass7.style.display = "none";
        if (null !== label) {
            label.innerHTML = '販売開始年名';
        }
    } else if (check5 == true) {
        itemClass1.style.display = "none";
        itemClass2.style.display = "none";
        itemClass3.style.display = "none";
        itemClass4.style.display = "none";
        itemClass5.style.display = "block";
        itemClass6.style.display = "none";
        itemClass7.style.display = "none";
        if (null !== label) {
            label.innerHTML = '工場分類5名';
        }
    } else if (check6 == true) {
        itemClass1.style.display = "none";
        itemClass2.style.display = "none";
        itemClass3.style.display = "none";
        itemClass4.style.display = "none";
        itemClass5.style.display = "none";
        itemClass6.style.display = "block";
        itemClass7.style.display = "none";
        if (null !== label) {
            label.innerHTML = '製品/工賃6名';
        }
    } else if (check7 == true) {
        itemClass1.style.display = "none";
        itemClass2.style.display = "none";
        itemClass3.style.display = "none";
        itemClass4.style.display = "none";
        itemClass5.style.display = "none";
        itemClass6.style.display = "none";
        itemClass7.style.display = "block";
        if (null !== label) {
            label.innerHTML = '資産在庫JA名';
        }
    } else {
        itemClass1.style.display = "block";
        itemClass2.style.display = "none";
        itemClass3.style.display = "none";
        itemClass4.style.display = "none";
        itemClass5.style.display = "none";
        itemClass6.style.display = "none";
        itemClass7.style.display = "none";
        if (null !== label) {
            label.innerHTML = 'ブランド1名';
        }
    }
}

// 行追加
function itemClassAddLine() {
    // 現在の行数(ヘッダー分とINDEX0スタートに合わせる)
    var table1 = document.getElementById("item_class_grid_table");
    var trs = $('#item_class_grid_table tbody tr');
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
    cell3.setAttribute('class', 'grid_wrapper_center center');
}

/* 検索関連フィルタ　共通処理 商品分類 */
function eventBlurSearchItemClass(event, element) {
    if (null === element.value || "" === element.value) {
        return false;
    }
    // 商品分類
    if (element.id.match('input_item_class')) {
        let data = [];
        let elements = document.getElementsByName('item_class');
        let len = elements.length;
        let checkValue = '';
        for (let i = 0; i < len; i++) {
            if (elements.item(i).checked) {
                checkValue = elements.item(i).value;
            }
        }
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            item_class_cd: element.value,
            def_item_class_thing_id: checkValue,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        const manageUrl = "../../../code_auto/item_class?" + query_params;
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
                    if (element.id.match('input_item_class1')) {
                        tableData = document.getElementById('grid_table_1');
                    } else if (element.id.match('input_item_class2')) {
                        tableData = document.getElementById('grid_table_2');
                    } else if (element.id.match('input_item_class3')) {
                        tableData = document.getElementById('grid_table_3');
                    } else if (element.id.match('input_item_class4')) {
                        tableData = document.getElementById('grid_table_4');
                    } else if (element.id.match('input_item_class5')) {
                        tableData = document.getElementById('grid_table_5');
                    } else if (element.id.match('input_item_class6')) {
                        tableData = document.getElementById('grid_table_6');
                    } else if (element.id.match('input_item_class7')) {
                        tableData = document.getElementById('grid_table_7');
                    }

                    //tableData.rows[1].cells[1].childNodes[0].value
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

/* 補完関連　共通処理 商品分類 */
function eventBlurCodeautoItemClass(event, element) {
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    //商品分類
    if (element.id.match('item_class_code')) {
        let data = [];
        let elements = document.getElementsByName('item_class');
        let len = elements.length;
        let checkValue = '';
        for (let i = 0; i < len; i++) {
            if (elements.item(i).checked) {
                checkValue = elements.item(i).value;
            }
        }
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            item_class_cd: element.value,
            def_item_class_thing_id: checkValue,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        const manageUrl = "../../../code_auto/item_class?" + query_params;
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
                    tr.parentNode.cells[column + 1].childNodes[0].value = data['item_class_name'];
                    if (data['ec_display_flg'] === 1) {
                        tr.parentNode.cells[column + 2].childNodes[0].checked = true;
                    }
                    let msgHTML = '<li>登録済みの商品分類コードです</li>';
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