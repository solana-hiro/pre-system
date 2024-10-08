/* 納品先入力(一覧) start　*/
// 行追加
function deliveryDestiationAddLine() {
    var table1 = document.getElementById("grid_table");
    /*
    var row = table1.insertRow(-1);

    var cell1 = row.insertCell(-1);
    var cell2 = row.insertCell(-1);
    var cell3 = row.insertCell(-1);
    cell1.innerHTML = '<input type="text" name="insert_code[]" placeholder="" class="grid_textbox" minlength="0" maxlength="6">';
    cell2.innerHTML = '<input type="text" name="insert_name[]" placeholder="" class="grid_textbox" minlength="0" maxlength="60">';
    cell3.innerHTML = '<input type="text" name="insert_flg[]" placeholder="" class="grid_textbox" minlength="0" maxlength="1">';
    */
    /*
    var trs = $('#grid_table tbody tr');
    var td = $(trs[2]).children();
    var childTd = $(td[6]).children();
    var row = table1.insertRow(-1);
    row.insertRow(childTd);
    */
    var table1 = document.getElementById("grid_table");
    var trs = $('#grid_table tbody tr');
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

/* 納品先入力(一覧) end　*/

/* 補完関連　共通処理 納品先 */
function eventBlurCodeautoDelivery(event, element) {
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    const alertArea = document.getElementById('alert-danger-ul');

    if("" !== element.value ) {
        element.value = element.value.toString().padStart(6, '0');
    } else {
        tr.parentNode.cells[column + 1].childNodes[0].value = "";
        tr.parentNode.cells[column + 2].childNodes[0].value = "";
        alertArea.innerHTML = "";
        return;
    }
    //納品先
    if (element.id.match('insert_delivery_code')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            delivery_destination_id: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        const manageUrl = "../../../code_auto/delivery_destination?" + query_params;
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
                    let msgHTML = '<li>登録済みの納品先コードです</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                    tr.parentNode.cells[column + 1].childNodes[0].value = data['delivery_destination_name'];
                    tr.parentNode.cells[column + 2].childNodes[0].value = data['del_kbn_delivery_destination'];
                } else {
                    let msgHTML = '<li>新規データです</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                }
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
    }
}
