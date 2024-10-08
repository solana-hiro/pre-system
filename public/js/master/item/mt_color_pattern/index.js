import {addNewOpenEvent} from "../../../modules/search_master_modal/src/modal.js";
import {LimitLength} from "../../../modules/update_dom/index.js";

/* カラーパターンマスタ start */
function colorPatternCodeCellHTML() {
    // IDにcolor_patternが含まれないとeventBlurCodeautoColorPatternが正しく動作しないため、ID重複するが指定する
    // eventBlurCodeautoColorPatternはかなりおかしな条件になっているので修正推奨
    return [
        '<input',
        ' type="number"',
        ' id="color_pattern_code"',
        ' onblur="eventBlurCodeautoColorPattern(arguments[0], this)"',
        ' name="insert_color_pattern_code[]"',
        ' class="grid_textbox input_number_4"',
        ' data-limit-len="4"',
        ' data-limit-minus',
        '>'
    ].join('');
}

function colorNameCellHTML(nameIndex) {
    return [
        '<input',
        ` name="insert_color_name${nameIndex}[]"`,
        ' class="grid_textbox txt_blue"',
        ' readonly',
        '>'
    ].join('');
}

function colorCodeCellHTML(nameIndex, rowIndex) {
    return [
        '<div class="flex">',
        '<input',
        ' type="text"',
        ` id="input_color_code${nameIndex}${rowIndex}"`,
        ' onblur="eventBlurCodeautoColorPatternColor(arguments[0], this)"',
        ` name="insert_color_code${nameIndex}[]"`,
        ' class="grid_textbox"',
        ' minlength="0"',
        ' maxlength="5"',
        '>',
        '<img class="vector"',
        ` id="img_color_code${nameIndex}${rowIndex}"`,
        ' src="/img/icon/vector.svg"',
        // ' onclick="searchColor(this.id);return false;"',
        ' data-smm-open="search_color_modal"',
        '>',
        '</div>'
    ].join('');
}


// 行追加
window.colorPatternAddLine = function() {
    const table = document.getElementById("color_pattern_grid_table");
    const tbody = table.tBodies[0];
    const tableCodeRowCount = (table.rows.length - 2) / 2; // ヘッダ分を除いて、nameRow分を除く
    const codeRow = table.insertRow(-1);
    const nameRow = table.insertRow(-1);
    const colorPatternCodeCell = codeRow.insertCell(-1);
    const colorCodeCells = [...Array(20)].map((_, _i) => {
        return codeRow.insertCell(-1);
    });
    const colorNameCells = [...Array(20)].map((_, _i) => {
        return nameRow.insertCell(-1);
    });

    // パターンコード部分
    colorPatternCodeCell.setAttribute("rowspan", "2");
    colorPatternCodeCell.setAttribute("class", "grid_col_1");
    colorPatternCodeCell.innerHTML = colorPatternCodeCellHTML();

    // コード入力行
    colorCodeCells.forEach((cell, index) => {
        cell.setAttribute("class", "grid_col_1");
        cell.innerHTML = colorCodeCellHTML(index + 1, tableCodeRowCount);
        addNewOpenEvent(cell.getElementsByTagName('img')[0]);
    });
    // コード名表示行
    colorNameCells.forEach((cell, index) => {
        cell.setAttribute("class", "grid_col_1");
        cell.innerHTML = colorNameCellHTML(index + 1);
    });
    LimitLength.start();
}
/* カラーパターンマスタ end */

/* 補完関連　共通処理 カラーパターン */
window.eventBlurCodeautoColorPattern = function(event, element) {
// function eventBlurCodeautoColorPattern(event, element) {
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    if (null === element.value || "" === element.value) {
        return false;
    }

    element.value = element.value.toString().padStart(4, '0');
    //カラーパターン
    if (element.id.match('color_pattern')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            color_pattern_cd: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        const manageUrl = "../../../code_auto/color_pattern?" + query_params;
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
                    // code適用
                    tr.parentNode.cells[column + 1].childNodes[0].value = data['color_cd_1'];
                    tr.parentNode.cells[column + 2].childNodes[0].value = data['color_cd_2'];
                    tr.parentNode.cells[column + 3].childNodes[0].value = data['color_cd_3'];
                    tr.parentNode.cells[column + 4].childNodes[0].value = data['color_cd_4'];
                    tr.parentNode.cells[column + 5].childNodes[0].value = data['color_cd_5'];
                    tr.parentNode.cells[column + 6].childNodes[0].value = data['color_cd_6'];
                    tr.parentNode.cells[column + 7].childNodes[0].value = data['color_cd_7'];
                    tr.parentNode.cells[column + 8].childNodes[0].value = data['color_cd_8'];
                    tr.parentNode.cells[column + 9].childNodes[0].value = data['color_cd_9'];
                    tr.parentNode.cells[column + 10].childNodes[0].value = data['color_cd_10'];
                    tr.parentNode.cells[column + 11].childNodes[0].value = data['color_cd_11'];
                    tr.parentNode.cells[column + 12].childNodes[0].value = data['color_cd_12'];
                    tr.parentNode.cells[column + 13].childNodes[0].value = data['color_cd_13'];
                    tr.parentNode.cells[column + 14].childNodes[0].value = data['color_cd_14'];
                    tr.parentNode.cells[column + 15].childNodes[0].value = data['color_cd_15'];
                    tr.parentNode.cells[column + 16].childNodes[0].value = data['color_cd_16'];
                    tr.parentNode.cells[column + 17].childNodes[0].value = data['color_cd_17'];
                    tr.parentNode.cells[column + 18].childNodes[0].value = data['color_cd_18'];
                    tr.parentNode.cells[column + 19].childNodes[0].value = data['color_cd_19'];
                    tr.parentNode.cells[column + 20].childNodes[0].value = data['color_cd_20'];
                    // name適用
                    tr.parentNode.nextElementSibling.cells[column].firstElementChild.value = data['color_name_1'];
                    tr.parentNode.nextElementSibling.cells[column + 1].firstElementChild.value = data['color_name_2'];
                    tr.parentNode.nextElementSibling.cells[column + 2].firstElementChild.value = data['color_name_3'];
                    tr.parentNode.nextElementSibling.cells[column + 3].firstElementChild.value = data['color_name_4'];
                    tr.parentNode.nextElementSibling.cells[column + 4].firstElementChild.value = data['color_name_5'];
                    tr.parentNode.nextElementSibling.cells[column + 5].firstElementChild.value = data['color_name_6'];
                    tr.parentNode.nextElementSibling.cells[column + 6].firstElementChild.value = data['color_name_7'];
                    tr.parentNode.nextElementSibling.cells[column + 7].firstElementChild.value = data['color_name_8'];
                    tr.parentNode.nextElementSibling.cells[column + 8].firstElementChild.value = data['color_name_9'];
                    tr.parentNode.nextElementSibling.cells[column + 9].firstElementChild.value = data['color_name_10'];
                    tr.parentNode.nextElementSibling.cells[column + 10].firstElementChild.value = data['color_name_11'];
                    tr.parentNode.nextElementSibling.cells[column + 11].firstElementChild.value = data['color_name_12'];
                    tr.parentNode.nextElementSibling.cells[column + 12].firstElementChild.value = data['color_name_13'];
                    tr.parentNode.nextElementSibling.cells[column + 13].firstElementChild.value = data['color_name_14'];
                    tr.parentNode.nextElementSibling.cells[column + 14].firstElementChild.value = data['color_name_15'];
                    tr.parentNode.nextElementSibling.cells[column + 15].firstElementChild.value = data['color_name_16'];
                    tr.parentNode.nextElementSibling.cells[column + 16].firstElementChild.value = data['color_name_17'];
                    tr.parentNode.nextElementSibling.cells[column + 17].firstElementChild.value = data['color_name_18'];
                    tr.parentNode.nextElementSibling.cells[column + 18].firstElementChild.value = data['color_name_19'];
                    tr.parentNode.nextElementSibling.cells[column + 19].firstElementChild.value = data['color_name_20'];
                    let msgHTML = '<li>登録済みのカラーパターンコードです。</li>';
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

/* 補完関連　共通処理 カラーパターンの中のカラー */
window.eventBlurCodeautoColorPatternColor = function(event, element) {
// function eventBlurCodeautoColorPatternColor(event, element) {
    if (null === element.value || "" === element.value) {
        return false;
    }

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
                    if (element.id.match('update')) {
                        tr.parentNode.nextElementSibling.cells[column - 2].firstElementChild.value = data['color_name'];
                    } else {
                        tr.parentNode.nextElementSibling.cells[column - 1].firstElementChild.value = data['color_name'];
                    }
                } else {
                    let msgHTML = '<li>カラーマスタの登録を行ってください。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                }
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
    }
}
