window.onload = function() {
    let classId2 = document.getElementById('customer_class_thing_id_2');
    let classId3 = document.getElementById('customer_class_thing_id_3');
    if (classId2.checked === true) {
        document.getElementById('customer_class_thing_name_title').innerHTML = "業種・特徴2名";
    } else if (classId3.checked === true) {
        document.getElementById('customer_class_thing_name_title').innerHTML = "ランク3名";
    } else {
        document.getElementById('customer_class_thing_name_title').innerHTML = "販売パターン1名";
    }
}

// ラジオボタン変更
function customerClassIdIndexClick() {
    let check1 = document.mtCustomerClassIndexForm.customer_class_thing_id_1.checked;
    let check2 = document.mtCustomerClassIndexForm.customer_class_thing_id_2.checked;
    let check3 = document.mtCustomerClassIndexForm.customer_class_thing_id_3.checked;
    let name1 = document.getElementById('customer_class_thing_name_title');
    let rightContents1 = document.getElementById('right_content_1');
    let rightContents2 = document.getElementById('right_content_2');
    let rightContents3 = document.getElementById('right_content_3');

    if (check2 == true) {
        name1.innerHTML = '業種・特徴2名';
        rightContents1.style.display = 'none';
        rightContents2.style.display = 'block';
        rightContents3.style.display = 'none';
    } else if (check3 == true) {
        name1.innerHTML = 'ランク3名';
        rightContents1.style.display = 'none';
        rightContents2.style.display = 'none';
        rightContents3.style.display = 'block';
    } else {
        name1.innerHTML = '販売パターン1名';
        rightContents1.style.display = 'block';
        rightContents2.style.display = 'none';
        rightContents3.style.display = 'none';
    }
}


/* 補完関連　共通処理 得意先分類 */
function eventBlurCodeautoCustomerClass(event, element) {
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    //得意先分類
    let data = [];
    let elements = document.getElementsByName('def_customer_class_thing_id');
    let len = elements.length;
    let checkValue = '';
    for (let i = 0; i < len; i++) {
        if (elements.item(i).checked) {
            checkValue = elements.item(i).value;
        }
    }
    data.map(tag_key => params.append('key', 'val'));
    const params = {
        customer_class_cd: element.value,
        def_customer_class_thing_id: checkValue,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../code_auto/customer_class?" + query_params;
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
                tr.parentNode.cells[column + 1].childNodes[0].value = data['customer_class_name'];
                let msgHTML = '<li>登録済みの得意先分類コードです</li>';
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

// 行追加
function customerClassAddLine() {
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

/* 検索関連フィルタ　共通処理 得意先分類 */
function eventBlurSearchCustomerClass(event, element) {
    // 得意先分類
    if (element.id.match('input_search_name1') || element.id.match('input_search_name2') || element.id.match('input_search_name3')) {
        if (null === element.value || "" === element.value) {
            return false;
        }
        let data = [];
        let elements = document.getElementsByName('def_customer_class_thing_id');
        let len = elements.length;
        let checkValue = '';
        for (let i = 0; i < len; i++) {
            if (elements.item(i).checked) {
                checkValue = elements.item(i).value;
            }
        }
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            customer_class_cd: element.value,
            def_customer_class_thing_id: checkValue,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        const manageUrl = "../../../code_auto/customer_class?" + query_params;
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
                    if (element.id.match('input_search_name1')) {
                        tableData = document.getElementById('grid_table_1');
                    } else if (element.id.match('input_search_name2')) {
                        tableData = document.getElementById('grid_table_2');
                    } else if (element.id.match('input_search_name3')) {
                        tableData = document.getElementById('grid_table_3');
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
