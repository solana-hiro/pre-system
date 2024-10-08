import {addNewOpenEvent} from "../../../modules/search_master_modal/src/modal.js";
import {LimitLength} from "../../../modules/update_dom/index.js";

/* サイズパターンマスタ start */
function sizePatternCodeCellHTML() {
    // IDにsize_patternが含まれないとeventBlurCodeautoSizePatternが正しく動作しないため、ID重複するが指定する
    // eventBlurCodeautoSizePatternはかなりおかしな条件になっているので修正推奨
    return [
        '<input',
        ' type="number"',
        ' id="size_pattern_code"',
        ' onblur="eventBlurCodeautoSizePattern(arguments[0], this)"',
        ' name="insert_size_pattern_code[]"',
        ' class="grid_textbox input_number_4"',
        ' data-limit-len="4"',
        ' data-limit-minus',
        '>'
    ].join('');
}

function sizeNameCellHTML(nameIndex) {
    return [
        '<input',
        ` name="insert_size_name${nameIndex}[]"`,
        ' class="grid_textbox txt_blue"',
        ' readonly',
        '>'
    ].join('');
}

function sizeCodeCellHTML(nameIndex, rowIndex) {
    return [
        '<div class="flex">',
        '<input',
        ' type="text"',
        ` id="input_size_code${nameIndex}${rowIndex}"`,
        ' onblur="eventBlurCodeautoSizePatternSize(arguments[0], this)"',
        ` name="insert_size_code${nameIndex}[]"`,
        ' class="grid_textbox"',
        ' minlength="0"',
        ' maxlength="5"',
        '>',
        '<img class="vector"',
        ` id="img_size_code${nameIndex}${rowIndex}"`,
        ' src="/img/icon/vector.svg"',
        ' data-smm-open="search_size_modal"',
        '>',
        '</div>'
    ].join('');
}

// 行追加
window.sizePatternAddLine = function() {
    const table = document.getElementById("size_pattern_grid_table");
    const tbody = table.tBodies[0];
    const tableCodeRowCount = (table.rows.length - 2) / 2; // ヘッダ分を除いて、nameRow分を除く
    const codeRow = table.insertRow(-1);
    const nameRow = table.insertRow(-1);
    const sizePatternCodeCell = codeRow.insertCell(-1);
    const sizeCodeCells = [...Array(10)].map((_, _i) => {
        return codeRow.insertCell(-1);
    });
    const sizeNameCells = [...Array(10)].map((_, _i) => {
        return nameRow.insertCell(-1);
    });

    // パターンコード部分
    sizePatternCodeCell.setAttribute("rowspan", "2");
    sizePatternCodeCell.setAttribute("class", "grid_col_1");
    sizePatternCodeCell.innerHTML = sizePatternCodeCellHTML();

    // コード入力行
    sizeCodeCells.forEach((cell, index) => {
        cell.setAttribute("class", "grid_col_1");
        cell.innerHTML = sizeCodeCellHTML(index + 1, tableCodeRowCount);
        addNewOpenEvent(cell.getElementsByTagName('img')[0]);
    });
    // コード名表示行
    sizeNameCells.forEach((cell, index) => {
        cell.setAttribute("class", "grid_col_1");
        cell.innerHTML = sizeNameCellHTML(index + 1);
    });
    LimitLength.start();
}


/* 補完関連　共通処理 サイズパターン */
window.eventBlurCodeautoSizePattern = function(event, element) {
    if (null === element.value || "" === element.value) {
        return false;
    }
    
    element.value = element.value.toString().padStart(4, '0');
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    //サイズパターン
    if (element.id.match('size_pattern')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            size_pattern_cd: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        const manageUrl = "../../../code_auto/size_pattern?" + query_params;
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
                console.log(null !== data);
                if (null !== data) {
                    // code適用
                    tr.parentNode.cells[column + 1].childNodes[0].value = data['size_cd_1'];
                    tr.parentNode.cells[column + 2].childNodes[0].value = data['size_cd_2'];
                    tr.parentNode.cells[column + 3].childNodes[0].value = data['size_cd_3'];
                    tr.parentNode.cells[column + 4].childNodes[0].value = data['size_cd_4'];
                    tr.parentNode.cells[column + 5].childNodes[0].value = data['size_cd_5'];
                    tr.parentNode.cells[column + 6].childNodes[0].value = data['size_cd_6'];
                    tr.parentNode.cells[column + 7].childNodes[0].value = data['size_cd_7'];
                    tr.parentNode.cells[column + 8].childNodes[0].value = data['size_cd_8'];
                    tr.parentNode.cells[column + 9].childNodes[0].value = data['size_cd_9'];
                    tr.parentNode.cells[column + 10].childNodes[0].value = data['size_cd_10'];
                    // name適用
                    tr.parentNode.nextElementSibling.cells[column].firstElementChild.value = data['size_name_1'];
                    tr.parentNode.nextElementSibling.cells[column + 1].firstElementChild.value = data['size_name_2'];
                    tr.parentNode.nextElementSibling.cells[column + 2].firstElementChild.value = data['size_name_3'];
                    tr.parentNode.nextElementSibling.cells[column + 3].firstElementChild.value = data['size_name_4'];
                    tr.parentNode.nextElementSibling.cells[column + 4].firstElementChild.value = data['size_name_5'];
                    tr.parentNode.nextElementSibling.cells[column + 5].firstElementChild.value = data['size_name_6'];
                    tr.parentNode.nextElementSibling.cells[column + 6].firstElementChild.value = data['size_name_7'];
                    tr.parentNode.nextElementSibling.cells[column + 7].firstElementChild.value = data['size_name_8'];
                    tr.parentNode.nextElementSibling.cells[column + 8].firstElementChild.value = data['size_name_9'];
                    tr.parentNode.nextElementSibling.cells[column + 9].firstElementChild.value = data['size_name_10'];
                    let msgHTML = '<li>登録済みのサイズパターンコードです。</li>';
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


/* 補完関連　共通処理 サイズパターンの中のサイズ */
window.eventBlurCodeautoSizePatternSize = function(event, element) {
    if (null === element.value || "" === element.value) {
        return false;
    }
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    //サイズ
    if (element.id.match('size_code')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            size_cd: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        const manageUrl = "../../../code_auto/size?" + query_params;
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
                    if (element.id.match('update')) {
                        tr.parentNode.nextElementSibling.cells[column - 2].firstElementChild.value = data['size_name'];
                    } else {
                        tr.parentNode.nextElementSibling.cells[column - 1].firstElementChild.value = data['size_name'];
                    }
                } else {
                    let msgHTML = '<li>サイズマスタの登録を行ってください。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                }
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
    }
}
