/* 補完関連　共通処理 仕入れ先分類 */
function eventBlurCodeautoSupplierClass(event, element) {
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    //得意先分類
    let data = [];
    let elements = document.getElementsByName('def_supplier_class_thing_id');
    let len = elements.length;
    let checkValue = '';
    for (let i = 0; i < len; i++) {
        if (elements.item(i).checked) {
            checkValue = elements.item(i).value;
        }
    }
    data.map(tag_key => params.append('key', 'val'));
    const params = {
        supplier_class_cd: element.value,
        def_supplier_class_thing_id: checkValue,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../code_auto/supplier_class?" + query_params;
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
                tr.parentNode.cells[column + 1].childNodes[0].value = data['supplier_class_name'];
                let msgHTML = '<li>登録済みの仕入先分類コードです</li>';
                alertArea.insertAdjacentHTML('beforeend', msgHTML);
            } else {
                let msgHTML = '<li>新規データです</li>';
                alertArea.insertAdjacentHTML('beforeend', msgHTML);
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 仕入先分類入力(一覧) start　*/
// ラジオボタン変更
function supplierClassIdIndexClick() {
    let check1 = document.mtSupplierClassIndexForm.supplier_class_thing_id_1.checked;
    let check2 = document.mtSupplierClassIndexForm.supplier_class_thing_id_2.checked;
    let check3 = document.mtSupplierClassIndexForm.supplier_class_thing_id_3.checked;
    let rightContents1 = document.getElementById('right_content_1');
    let rightContents2 = document.getElementById('right_content_2');
    let rightContents3 = document.getElementById('right_content_3');

    if (check2 == true) {
        rightContents1.style.display = 'none';
        rightContents2.style.display = 'block';
        rightContents3.style.display = 'none';
    } else if (check3 == true) {
        rightContents1.style.display = 'none';
        rightContents2.style.display = 'none';
        rightContents3.style.display = 'block';
    } else {
        rightContents1.style.display = 'block';
        rightContents2.style.display = 'none';
        rightContents3.style.display = 'none';
    }
}

// 行追加
// function supplierClassAddLine() {
//     var table1 = document.getElementById("grid_table");
//     var row = table1.insertRow(-1);
//     var cell1 = row.insertCell(-1);
//     var cell2 = row.insertCell(-1);
//     cell1.innerHTML = '<input type="text" placeholder="" class="grid_textbox" name="insert_class_code[]" minlength="0" maxlength="4">';
//     cell2.innerHTML = '<input type="text" placeholder="" class="grid_textbox" name="insert_class_name[]" minlength="0" maxlength="20">';
// }
/* 仕入先分類入力(一覧) end　*/


// 行追加
function supplierClassAddLine() {
    var table1 = document.getElementById("grid_table");
    var trs = $('#grid_table tbody tr');
    // 最終行のクローン取得
    var lastTr = trs[trs.length - 1];
    var td = $(lastTr).children();
    var row = table1.insertRow(-1);
    var cell1 = row.insertCell(-1);
    var cell2 = row.insertCell(-1);
    cell1.innerHTML = td[0].innerHTML;
    cell2.innerHTML = td[1].innerHTML;
}
/* 仕入先分類入力リスト end */

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
