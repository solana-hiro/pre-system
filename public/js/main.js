/* 共通 start */
document.addEventListener('DOMContentLoaded', function () {
    document.body.style.display = 'block';
});

/* 郵便番号補完 */
let initPostcodeJp = function () {
    let autoComplement = new postcodejp.address.AutoComplementService('pD8cCwGVYj2pXLkXesPYrrBBd5eUIxuRIfAbmF6');
    autoComplement.setZipTextbox('zip');
    autoComplement.add(new postcodejp.address.StateTownStreetTextbox('address'));
    autoComplement.observe();
};
if (window.addEventListener) {
    window.addEventListener('load', initPostcodeJp)
} else {
    window.attachEvent('onload', initPostcodeJp)
}

/* menu部分 */
let menuButton = document.getElementById("overlap-group");
let overlap = document.getElementById("overlap");
let rectangle = document.getElementById("rectangle");
let menuFrame = document.getElementById("menu-frame");
let menuGroup = document.getElementById("menu-group");
let menuImg = document.getElementById("menu-img");
let mainContent = document.getElementById("main_content");

menuButton.addEventListener('click', function () {
    let result = menuButton.classList.contains('is-active');
    if (result) {
        menuButton.classList.remove('is-active');
        let width = 20;
        let positon = 8;
        let mainWidth = 96;
        overlap.style.width = width + "px";
        rectangle.style.width = width + "px";
        menuFrame.style.display = "none";
        menuGroup.style.left = positon + "px";
        menuImg.src = '/img/icon/arrow-right-menu.svg';
        mainContent.style.width = mainWidth + "%";
    } else {
        menuButton.classList.add('is-active');
        let width = 200;
        let positon = 188;
        let mainWidth = 82;
        overlap.style.width = width + "px";
        rectangle.style.width = width + "px";
        menuFrame.style.display = "block";
        menuGroup.style.left = positon + "px";
        menuImg.src = '/img/icon/arrow-left.svg';
        mainContent.style.width = mainWidth + "%";
    }
}, false);
$("dt").click(function () {
    if ($("dd").css("display") == "block") {
        $("dd:not(:animated)").slideUp("slow");
    } else {
        $("dd").slideDown("slow");
    }
});

/*
window.addEventListener('load', function () {
    // テキストボックスにイベントを設定
    document.getElementById('sample').addEventListener('change', function () {
        this.value = this.value.padLeft('0', 6); // 0埋め
    });
});

// 0埋めファンクション
String.prototype.padLeft = function (char, length) {
    if (this.length > length) return this;
    var left = '';
    for (;left.length < length; left += char);
    return (left+this.toString()).slice(-length);
}
*/
/* download監視 */

/* 共通 end */

/* 付箋マスタ start */
// ラジオボタン変更
function stickyNoteIdIndexClick() {
    let check1 = document.mtStickNoteIndexForm.def_sticky_note_kind_id_1.checked;
    let check2 = document.mtStickNoteIndexForm.def_sticky_note_kind_id_2.checked;
    let check3 = document.mtStickNoteIndexForm.def_sticky_note_kind_id_3.checked;
    let rightContent1 = document.getElementById('right_content_1');
    let rightContent2 = document.getElementById('right_content_2');
    let rightContent3 = document.getElementById('right_content_3');
    if (check2 === true) {
        rightContent1.style.display = 'none';
        rightContent2.style.display = 'inline-flex';
        rightContent3.style.display = 'none';
    } else if (check3 === true) {
        rightContent1.style.display = 'none';
        rightContent2.style.display = 'none';
        rightContent3.style.display = 'inline-flex';
    } else {
        rightContent1.style.display = 'inline-flex';
        rightContent2.style.display = 'none';
        rightContent3.style.display = 'none';
    }
}
/* 付箋マスタ end */

/* 得意先分類入力リスト start */
// ラジオボタン変更
function customerClassIdListClick() {
    let check1 = document.mtCustomerClassListForm.customer_class_thing_id_1.checked;
    let check2 = document.mtCustomerClassListForm.customer_class_thing_id_2.checked;
    let check3 = document.mtCustomerClassListForm.customer_class_thing_id_3.checked;
    let customerClassThing1 = document.getElementById('customer_class_thing_1');
    let customerClassThing2 = document.getElementById('customer_class_thing_2');
    let customerClassThing3 = document.getElementById('customer_class_thing_3');
    if (check2 === true) {
        customerClassThing1.style.display = 'none';
        customerClassThing2.style.display = 'inline-flex';
        customerClassThing3.style.display = 'none';
    } else if (check3 === true) {
        customerClassThing1.style.display = 'none';
        customerClassThing2.style.display = 'none';
        customerClassThing3.style.display = 'inline-flex';
    } else {
        customerClassThing1.style.display = 'inline-flex';
        customerClassThing2.style.display = 'none';
        customerClassThing3.style.display = 'none';
    }
}
/* 得意先分類入力リスト end */


/* 仕入先分類入力リスト start */
// ラジオボタン変更
function supplierClassIdListClick() {
    let check1 = document.mtSupplierClassListForm.supplier_class_thing_id_1.checked;
    let check2 = document.mtSupplierClassListForm.supplier_class_thing_id_2.checked;
    let check3 = document.mtSupplierClassListForm.supplier_class_thing_id_3.checked;
    let supplierClassThing1 = document.getElementById('supplier_class_thing_1');
    let supplierClassThing2 = document.getElementById('supplier_class_thing_2');
    let supplierClassThing3 = document.getElementById('supplier_class_thing_3');
    if (check2 === true) {
        supplierClassThing1.style.display = 'none';
        supplierClassThing2.style.display = 'inline-flex';
        supplierClassThing3.style.display = 'none';
    } else if (check3 === true) {
        supplierClassThing1.style.display = 'none';
        supplierClassThing2.style.display = 'none';
        supplierClassThing3.style.display = 'inline-flex';
    } else {
        supplierClassThing1.style.display = 'inline-flex';
        supplierClassThing2.style.display = 'none';
        supplierClassThing3.style.display = 'none';
    }
}


/* 商品リスト(分類別) start */
// ラジオボタン変更
function itemByClassListClick() {
    let check1 = document.mtItemByClassListForm.item_class_id_1.checked;
    let check2 = document.mtItemByClassListForm.item_class_id_2.checked;
    let check3 = document.mtItemByClassListForm.item_class_id_3.checked;
    let itemClass1 = document.getElementById('item_class_1');
    let itemClass2 = document.getElementById('item_class_2');
    let itemClass3 = document.getElementById('item_class_3');
    if (check2 == true) {
        itemClass1.style.display = "none";
        itemClass2.style.display = "inline-flex";
        itemClass3.style.display = "none";
    } else if (check3 == true) {
        itemClass1.style.display = "none";
        itemClass2.style.display = "none";
        itemClass3.style.display = "inline-flex";
    } else {
        itemClass1.style.display = "inline-flex";
        itemClass2.style.display = "none";
        itemClass3.style.display = "none";

    }
}
/* 商品リスト(分類別) end */

/* 商品分類リスト その他商品分類関連共通 start */
// ラジオボタン変更
function itemClassListClick() {
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
        itemClass2.style.display = "inline-flex";
        itemClass3.style.display = "none";
        itemClass4.style.display = "none";
        itemClass5.style.display = "none";
        itemClass6.style.display = "none";
        itemClass7.style.display = "none";
        if (null !== label) {
            label.innerHTML = '競技・カテゴリ';
        }
    } else if (check3 == true) {
        itemClass1.style.display = "none";
        itemClass2.style.display = "none";
        itemClass3.style.display = "inline-flex";
        itemClass4.style.display = "none";
        itemClass5.style.display = "none";
        itemClass6.style.display = "none";
        itemClass7.style.display = "none";
        if (null !== label) {
            label.innerHTML = 'ジャンル';
        }
    } else if (check4 == true) {
        itemClass1.style.display = "none";
        itemClass2.style.display = "none";
        itemClass3.style.display = "none";
        itemClass4.style.display = "inline-flex";
        itemClass5.style.display = "none";
        itemClass6.style.display = "none";
        itemClass7.style.display = "none";
        if (null !== label) {
            label.innerHTML = '販売開始年';
        }
    } else if (check5 == true) {
        itemClass1.style.display = "none";
        itemClass2.style.display = "none";
        itemClass3.style.display = "none";
        itemClass4.style.display = "none";
        itemClass5.style.display = "inline-flex";
        itemClass6.style.display = "none";
        itemClass7.style.display = "none";
        if (null !== label) {
            label.innerHTML = '工場分類5';
        }
    } else if (check6 == true) {
        itemClass1.style.display = "none";
        itemClass2.style.display = "none";
        itemClass3.style.display = "none";
        itemClass4.style.display = "none";
        itemClass5.style.display = "none";
        itemClass6.style.display = "inline-flex";
        itemClass7.style.display = "none";
        if (null !== label) {
            label.innerHTML = '製品/工賃6';
        }
    } else if (check7 == true) {
        itemClass1.style.display = "none";
        itemClass2.style.display = "none";
        itemClass3.style.display = "none";
        itemClass4.style.display = "none";
        itemClass5.style.display = "none";
        itemClass6.style.display = "none";
        itemClass7.style.display = "inline-flex";
        if (null !== label) {
            label.innerHTML = '資産在庫JA';
        }
    } else {
        itemClass1.style.display = "inline-flex";
        itemClass2.style.display = "none";
        itemClass3.style.display = "none";
        itemClass4.style.display = "none";
        itemClass5.style.display = "none";
        itemClass6.style.display = "none";
        itemClass7.style.display = "none";
        if (null !== label) {
            label.innerHTML = 'ブランド1';
        }
    }
}
/* 商品分類リスト end */

/* file選択関連 */
let upFile = document.getElementById('upfile');
if (upFile != null) {
    upFile.addEventListener('change', function (e) {
        document.getElementById('file_path').innerHTML = upFile.files[0].name;
    }, false);
};

/* PS区分別得意先掛率マスタ一覧入力 start */
// ラジオボタン変更
function psKbnClick() {
    let check1 = document.psKbnIndexForm.customer_class_thing_id_1.checked;
    let check2 = document.psKbnIndexForm.customer_class_thing_id_2.checked;
    let check3 = document.psKbnIndexForm.customer_class_thing_id_3.checked;
    let customerClassThing1 = document.getElementById('customer_class_thing_1');
    let customerClassThing2 = document.getElementById('customer_class_thing_2');
    let customerClassThing3 = document.getElementById('customer_class_thing_3');
    if (check2 === true) {
        customerClassThing1.style.display = 'none';
        customerClassThing2.style.display = 'inline-flex';
        customerClassThing3.style.display = 'none';
    } else if (check3 === true) {
        customerClassThing1.style.display = 'none';
        customerClassThing2.style.display = 'none';
        customerClassThing3.style.display = 'inline-flex';
    } else {
        customerClassThing1.style.display = 'inline-flex';
        customerClassThing2.style.display = 'none';
        customerClassThing3.style.display = 'none';
    }
}
/* 得意先分類入力リスト end */


/* 商品別倉庫別在庫一覧表 start */
// ラジオボタン変更
function outputKbnClick() {
    let check1 = document.mtItemClassListForm.output_kbn_1.checked;
    let check2 = document.mtItemClassListForm.output_kbn_2.checked;
    let outPutKbn1 = document.getElementById('color_code');
    let outPutKbn2 = document.getElementById('size_code');
    if (check2 == true) {
        outPutKbn1.style.display = "inline-flex";
        outPutKbn2.style.display = "inline-flex";
    } else {
        outPutKbn1.style.display = "none";
        outPutKbn2.style.display = "none";
    }
}
/* 商品別倉庫別在庫一覧表 end */

/* 銀行マスタ start */
// 行追加
function bankAddLine() {
    var table1 = document.getElementById("bank_grid_table");
    var trs = $('#bank_grid_table tbody tr');
    // 最終行のクローン取得
    var lastTr = trs[trs.length - 1];
    var td = $(lastTr).children();
    var row = table1.insertRow(-1);
    var cell1 = row.insertCell(-1);
    var cell2 = row.insertCell(-1);;
    cell1.innerHTML = td[0].innerHTML;
    cell2.innerHTML = td[1].innerHTML;
    /*
    var row1 = table1.insertRow(-1);
    var cell1 = row1.insertCell(-1);
    var cell2 = row1.insertCell(-1);

    cell1.innerHTML = '<input type="text" placeholder="" name="insert_bank_code[]" class="grid_textbox" minlength="0" maxlength="4">';
    cell2.innerHTML = '<input type="text" placeholder="" name="insert_bank_name[]" class="grid_textbox" minlength="0" maxlength="20">';
    */
}
/* 銀行マスタ end */


/* 倉庫入力 start */
// 行追加
function warehouseClassAddLine() {
    var table1 = document.getElementById("warehouse_grid_table");
    // 現在の行数(ヘッダー分とINDEX0スタートに合わせる)
    var trs = $('#warehouse_grid_table tbody tr');
    // 最終行のクローン取得
    var lastTr = trs[trs.length - 1];
    var td = $(lastTr).children();
    var row = table1.insertRow(-1);
    var cell1 = row.insertCell(-1);
    var cell2 = row.insertCell(-1);
    var cell3 = row.insertCell(-1);
    var cell4 = row.insertCell(-1);
    var cell5 = row.insertCell(-1);
    var cell6 = row.insertCell(-1);
    var cell7 = row.insertCell(-1);
    cell1.innerHTML = td[0].innerHTML;
    cell2.innerHTML = td[1].innerHTML;
    cell3.innerHTML = td[2].innerHTML;
    cell4.innerHTML = td[3].innerHTML;
    cell5.innerHTML = td[4].innerHTML;
    cell6.innerHTML = td[5].innerHTML;
    cell7.innerHTML = td[6].innerHTML;
    /*
    var row1 = table1.insertRow(-1);
    var cell1 = row1.insertCell(-1);
    var cell2 = row1.insertCell(-1);
    var cell3 = row1.insertCell(-1);
    var cell4 = row1.insertCell(-1);
    var cell5 = row1.insertCell(-1);
    var cell6 = row1.insertCell(-1);
    var cell7 = row1.insertCell(-1);

    // 現在の行数(ヘッダー分とINDEX0スタートに合わせる)
    cell1.innerHTML = '<input type="text" placeholder="" name="insert_warehouse_code[]" class="grid_textbox" minlength="0" maxlength="6">';
    cell2.innerHTML = '<input type="text" placeholder="" name="insert_warehouse_name[]" class="grid_textbox" minlength="0" maxlength="20">';
    cell3.innerHTML = '<input type="text" placeholder="" name="insert_warehouse_name_kana[]" class="grid_textbox" minlength="0" maxlength="10">';
    cell4.innerHTML = '<input type="text" placeholder="" name="insert_warehouse_kind[]" class="grid_textbox" minlength="0" maxlength="3">';
    cell5.innerHTML = '<input type="text" placeholder="" name="insert_analysis_warehouse_kbn[]" class="grid_textbox" minlength="0" maxlength="3">';
    cell6.innerHTML = '<input type="text" placeholder="" name="insert_asset_stock_validity_kbn[]" class="grid_textbox" minlength="0" maxlength="3">';
    cell7.innerHTML = '<input type="text" placeholder="" name="insert_del_kbn[]" class="grid_textbox" minlength="0" maxlength="3">';
    */
    cell1.setAttribute('class', 'grid_col_1 grid_wrapper_left');
    cell2.setAttribute('class', 'grid_col_1 grid_wrapper_left');
    cell3.setAttribute('class', 'grid_col_1 grid_wrapper_left');
    cell4.setAttribute('class', 'grid_col_1 grid_wrapper_left');
    cell5.setAttribute('class', 'grid_col_1 grid_wrapper_left');
    cell6.setAttribute('class', 'grid_col_1 grid_wrapper_left');
    cell7.setAttribute('class', 'grid_col_1 grid_wrapper_left');
}
/* 倉庫入力 end */

/* tooltip 位置調整 start */
/*
let elms = document.querySelectorAll('form input[type=text],form textarea');
for (let i = 0; i < elms.length; i++) {
    elms[i].onfocus = function () {
        let = tooltip = this.parentNode.querySelector('.tooltip');
        tooltip.style.display = 'inline-block';
    };
    elms[i].onblur = function () {
        let = tooltip = this.parentNode.querySelector('.tooltip');
        tooltip.style.display = 'none';
    }
}
*/
/* tooltip 位置調整 end */

/* リッチテキスト切り替え */
function changeTextType(elm) {
    let normalType = document.getElementById('normal_area');
    let richType = document.getElementById('rich_area');
    if (elm === "1") {
        richType.style.display = 'block';
        normalType.style.display = 'none';
    } else {
        richType.style.display = 'none';
        normalType.style.display = 'block';
    }
}

//リッチテキスト内容の送信
let updateButton = document.getElementById('updateButton');
if (null !== updateButton) {
    updateButton.addEventListener('click', event => {
        let richText = document.getElementById('rich_contents');
        if (null !== richText) {
            richText.value = document.getElementById('rich_text_contents').innerHTML;
        }
    });
}

//TOP自由領域　画像関連の操作
let imgSelect1 = document.getElementById("imgUploadButton1");
let imgElem1 = document.getElementById("imgUpload1");
if (null !== imgSelect1) {
    imgSelect1.addEventListener("click", (e) => {
        if (imgElem1) {
            imgElem1.click();
        }
    }, false);
}

let pdfSelect1 = document.getElementById("pdfUploadButton1");
let pdfElem1 = document.getElementById("pdfUpload1");
if (null !== pdfSelect1) {
    pdfSelect1.addEventListener("click", (e) => {
        if (pdfElem1) {
            pdfElem1.click();
        }
    }, false);
}

let pdfSelect2 = document.getElementById("pdfUploadButton2");
let pdfElem2 = document.getElementById("pdfUpload2");
if (null !== pdfSelect2) {
    pdfSelect2.addEventListener("click", (e) => {
        if (pdfElem2) {
            pdfElem2.click();
        }
    }, false);
}

let pdfSelect3 = document.getElementById("pdfUploadButton3");
let pdfElem3 = document.getElementById("pdfUpload3");
if (null !== pdfSelect3) {
    pdfSelect3.addEventListener("click", (e) => {
        if (pdfElem3) {
            pdfElem3.click();
        }
    }, false);
}

let pdfSelect4 = document.getElementById("pdfUploadButton4");
let pdfElem4 = document.getElementById("pdfUpload4");
if (null !== pdfSelect4) {
    pdfSelect4.addEventListener("click", (e) => {
        if (pdfElem4) {
            pdfElem4.click();
        }
    }, false);
}

let pdfSelect5 = document.getElementById("pdfUploadButton5");
let pdfElem5 = document.getElementById("pdfUpload5");
if (null !== pdfSelect5) {
    pdfSelect5.addEventListener("click", (e) => {
        if (pdfElem5) {
            pdfElem5.click();
        }
    }, false);
}

/* お知らせ入力 start */
// 行追加
function noticeAddLine(elm) {
    /*
    let i = 0;
    let rec = document.getElementById("notice_grid_table");
    let copied = rec.lastElementChild.cloneNode(true);
    let str = copied.name;
    let newStr = str.substring(0, str.length-1);
    let num1 = parseInt(str.substring(str.length-1));
    let num2 = parseInt(1);
    let num = num1 + num2;
    copied.setAttribute('name', newStr + num)
    copied.style.display = 'block';
    rec.appendChild(copied);
    */
    let rec2 = document.getElementById("pdf2");
    let rec3 = document.getElementById("pdf3");
    let rec4 = document.getElementById("pdf4");
    let rec5 = document.getElementById("pdf5");
    if (getComputedStyle(rec2).display === 'none') {
        rec2.style.display = "block";
    } else if (getComputedStyle(rec3).display === 'none') {
        rec3.style.display = "block";
    } else if (getComputedStyle(rec4).display === 'none') {
        rec4.style.display = "block";
    } else if (getComputedStyle(rec5).display === 'none') {
        rec5.style.display = "block";
    }
    let tags = document.getElementById(elm);
    if (getComputedStyle(rec2).display === 'block' && getComputedStyle(rec3).display === 'block' && getComputedStyle(rec4).display === 'block' && getComputedStyle(rec5).display === 'block') {
        tags.style.display = "none";
    } else {
        tags.style.display = "block";
    }
}
/* お知らせ入力 end */

/* 補完　倉庫コードから名称を補完 */
// どこからも利用されていない
// let inputWarehouseBox = document.getElementById('insert_customer_class_code');
// if(inputWarehouseBox != null) {
//     inputWarehouseBox.addEventListener('blur', function() {
//         let data = [];
//         data.map(tag_key => params.append('key','val'));
//         const params = {
//             warehouse_code: inputWarehouseBox.value,
//         };
//         let query_params  = new URLSearchParams(params);
//         // 管理用urlの上書き
//         manageUrl = "../../../code_auto/warehouse?" + query_params;
//         console.log(manageUrl);

//         fetch(manageUrl, {
//             method: 'GET', // HTTPメソッドを指定
//             headers: {
//                 'Content-Type': 'application/json',
//             }
//         })
//         .then(response => {
//             return response.json();
//         })
//         .then(data => { // 取得したデータの処理
//             let outputWarehouseBox = document.getElementById("names_warehouse");
//             let alertArea = document.getElementById('alert-danger-ul');
//             alertArea.innerHTML = "";
//             if(null !== data) {
//                 outputWarehouseBox.innerHTML = data['warehouse_name'];
//             } else {
//                 outputWarehouseBox.innerHTML = "";
//                 let msgHTML = '<li>倉庫コードが存在しません。倉庫マスタの登録を行ってください。</li>';
//                 alertArea.insertAdjacentHTML('beforeend', msgHTML);
//             }
//         })
//         .catch(error => {
//             console.log(error); // エラー表示
//         });
//     }, false);
// }


/* 検索関連フィルタ　共通処理 仕入先分類 */
function eventBlurSearchDelivery(event, element) {
    if (null === element.value || "" === element.value) {
        return false;
    }
    // 納品先
    if (element.id.match('input_search_name')) {
        if (null === element.value || "" === element.value) {
            return false;
        }
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            delivery_cd: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        manageUrl = "../../../code_auto/delivery_destination?" + query_params;
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
                        if (tableData.rows[j].cells[1].childNodes[0].innerHTML < element.value) {
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


// TODO 未使用のため削除予定
/* 検索関連フィルタ　共通処理 カラーパターン */
// function eventBlurSearchColorPattern(event, element) {
//     if (null === element.value || "" === element.value) {
//         return false;
//     }
//     // カラーパターン
//     if (element.id.match('color_pattern')) {
//         let data = [];
//         data.map(tag_key => params.append('key', 'val'));
//         const params = {
//             color_pattern_cd: element.value,
//         };
//         let query_params = new URLSearchParams(params);
//         // 管理用urlの上書き
//         manageUrl = "../../../code_auto/color_pattern?" + query_params;
//         console.log(manageUrl);

//         fetch(manageUrl, {
//             method: 'GET', // HTTPメソッドを指定
//             headers: {
//                 'Content-Type': 'application/json',
//             }
//         })
//             .then(response => {
//                 return response.json();
//             })
//             .then(data => { // 取得したデータの処理
//                 //書き込み先の設定
//                 let alertArea = document.getElementById('alert-danger-ul');
//                 alertArea.innerHTML = "";
//                 if (null !== data) {
//                     let tableData = null;
//                     tableData = document.getElementById('grid_table_1');
//                     for (let j = 0; j < tableData.rows.length; j = j + 2) {
//                         if (tableData.rows[j].cells[1].childNodes[0].value < element.value) {
//                             tableData.rows[j].setAttribute('class', 'display_none_all');
//                             tableData.rows[j + 1].setAttribute('class', 'display_none_all');
//                         } else {
//                             tableData.rows[j].removeAttribute('class', 'display_none_all');
//                             tableData.rows[j + 1].removeAttribute('class', 'display_none_all');
//                         }
//                     }
//                 } else {
//                     let msgHTML = '<li>検索用コードがマスタに存在しません。</li>';
//                     alertArea.insertAdjacentHTML('beforeend', msgHTML);
//                 }
//             })
//             .catch(error => {
//                 console.log(error); // エラー表示
//             });
//     }
// }

// TODO 未使用のため削除予定
/* 検索関連フィルタ　共通処理 サイズパターン */
// function eventBlurSearchSizePattern(event, element) {
//     if (null === element.value || "" === element.value) {
//         return false;
//     }
//     // サイズパターン
//     if (element.id.match('size_pattern')) {
//         let data = [];
//         data.map(tag_key => params.append('key', 'val'));
//         const params = {
//             size_pattern_cd: element.value,
//         };
//         let query_params = new URLSearchParams(params);
//         // 管理用urlの上書き
//         manageUrl = "../../../code_auto/size_pattern?" + query_params;
//         console.log(manageUrl);

//         fetch(manageUrl, {
//             method: 'GET', // HTTPメソッドを指定
//             headers: {
//                 'Content-Type': 'application/json',
//             }
//         })
//             .then(response => {
//                 return response.json();
//             })
//             .then(data => { // 取得したデータの処理
//                 //書き込み先の設定
//                 let alertArea = document.getElementById('alert-danger-ul');
//                 alertArea.innerHTML = "";
//                 if (null !== data) {
//                     let tableData = null;
//                     tableData = document.getElementById('grid_table_1');
//                     for (let j = 0; j < tableData.rows.length; j = j + 2) {
//                         if (tableData.rows[j].cells[1].childNodes[0].value < element.value) {
//                             tableData.rows[j].setAttribute('class', 'display_none_all');
//                             tableData.rows[j + 1].setAttribute('class', 'display_none_all');
//                         } else {
//                             tableData.rows[j].removeAttribute('class', 'display_none_all');
//                             tableData.rows[j + 1].removeAttribute('class', 'display_none_all');
//                         }
//                     }
//                 } else {
//                     let msgHTML = '<li>検索用コードがマスタに存在しません。</li>';
//                     alertArea.insertAdjacentHTML('beforeend', msgHTML);
//                 }
//             })
//             .catch(error => {
//                 console.log(error); // エラー表示
//             });
//     }
// }


/* 補完関連　共通処理 得意先分類リダイレクトあり */
function eventBlurCodeautoCustomerClassRedirect(event, element) {
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    if (null === element.value || "" === element.value) {
        return false;
    }
    //得意先分類
    if (element.id.match('customer_class')) {
        let data = [];
        let elements = document.getElementsByName('customer_class_thing_id');
        let len = elements.length;
        let className = document.getElementById("hidden_input_customer_class_name");
        className.value = "";
        let checkValue = '';
        for (let i = 0; i < len; i++) {
            if (elements.item(i).checked) {
                checkValue = elements.item(i).value;
            }
        }
        /*
        if(checkValue === '1') {
            document.getElementById("names_customer_class1_code").innerHTML = "";
        } else if(checkValue === '2') {
            document.getElementById("names_customer_class2_code").innerHTML = "";
        } else if(checkValue === '3') {
            document.getElementById("names_customer_class3_code").innerHTML = "";
        }
            */
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            customer_class_cd: element.value,
            def_customer_class_thing_id: checkValue,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        manageUrl = "../../../../../code_auto/customer_class?" + query_params;
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
                    /*
                    if(checkValue === '1') {
                        className.value = data['customer_class_name'];
                    } else if(checkValue === '2') {
                        className.value = data['customer_class_name'];
                    } else if(checkValue === '3') {
                        className.value = data['customer_class_name'];
                    }
                        */
                    document.getElementById("redirect").value = element.value;
                    document.getElementById("redirect_hidden").value = checkValue;
                    document.getElementById("redirect").click();
                } else {
                    let msgHTML = '<li>存在しないコードです。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                }
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
    }
}

/* 仕入先コード　補完　コード設定リダイレクトあり　*/
function eventBlurCodeautoSupplierRedirect(event, element) {
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    //
    if (element.id.match('supplier')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            supplier_cd: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        manageUrl = "../../../../code_auto/supplier?" + query_params;
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
                    if (data['del_kbn'] === 0) {
                        document.getElementById("redirect").value = element.value;
                        document.getElementById("redirect_hidden").value = data['id'];
                        document.getElementById("redirect").click();
                    } else {
                        let msgHTML = '<li>削除区分が有効になっているコードです。</li>';
                        alertArea.insertAdjacentHTML('beforeend', msgHTML);
                    }
                } else {
                    let msgHTML = '<li>新規データです。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                    document.getElementById("input_pay_destination").value = element.value;
                }
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
    }
}

/* 仕入先コード　補完　コード設定リダイレクトなし　*/
// function eventBlurCodeautoSupplier(event, element) {

//     const column = element.parentNode.cellIndex;  //行数
//     const tr = element.parentNode;
//     const row = tr.parentNode.sectionRowIndex;  //列数
//     if (null === element.value || "" === element.value) {
//         return false;
//     }
//     if (element.id.match('supplier')) {
//         let data = [];
//         data.map(tag_key => params.append('key', 'val'));
//         const params = {
//             supplier_cd: element.value,
//         };
//         let query_params = new URLSearchParams(params);
//         // 管理用urlの上書き
//         manageUrl = "../../../code_auto/supplier?" + query_params;
//         console.log(manageUrl);

//         fetch(manageUrl, {
//             method: 'GET', // HTTPメソッドを指定
//             headers: {
//                 'Content-Type': 'application/json',
//             }
//         })
//             .then(response => {
//                 return response.json();
//             })
//             .then(data => { // 取得したデータの処理
//                 //書き込み先の設定
//                 let alertArea = document.getElementById('alert-danger-ul');
//                 alertArea.innerHTML = "";
//                 if (null !== data) {
//                     if (data['del_kbn'] === 0) {
//                         let msgHTML = '<li>マスタに存在しているコードです。</li>';
//                         alertArea.insertAdjacentHTML('beforeend', msgHTML);
//                         document.getElementById('names_supplier_code').value = data['supplier_name'];
//                         document.getElementById('tax_kbn').value = data['tax_kbn'];
//                     } else {
//                         let msgHTML = '<li>削除区分が有効になっているコードです。</li>'
//                         alertArea.insertAdjacentHTML('beforeend', msgHTML);
//                         document.getElementById('names_supplier_code').innerHTML = "";
//                     }
//                 } else {
//                     let msgHTML = '<li>マスタに存在しません。</li>';
//                     alertArea.insertAdjacentHTML('beforeend', msgHTML);
//                     document.getElementById('names_supplier_code').innerHTML = "";
//                 }
//             })
//             .catch(error => {
//                 console.log(error); // エラー表示
//             });
//     }
// }

/* 支払先コード　補完　コード設定リダイレクトなし　*/
function eventBlurCodeautoPayDestination(event, element) {
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    //
    if (element.id.match('pay')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            pay_destination_cd: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        manageUrl = "../../../../code_auto/pay_destination?" + query_params;
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
                    if (data['sequentially_kbn']) {
                        let msgHTML = '<li>随時締の仕入先を指定することはできません。</li>'
                        alertArea.insertAdjacentHTML('beforeend', msgHTML);
                    } else {
                        /*
                        ・「随時区分」を表示する
                      ・「締日「日締」」を表示する
                      ・「締日「締月」」を表示する
                      ・「締日「支払日」」を表示する
                      ・「単価端数処理」を表示する
                      ・「金額端数処理」を表示する
                      ・「消費税区分」を表示する
                      ・「消費税算出基準」を表示する
                      ・「消費税端数処理（円）」を表示する
                      ・「消費税端数処理」を表示する
                        */
                    }
                } else {
                    let msgHTML = '<li>マスタに存在しません。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                    document.getElementById("input_pay_destination").value = element.value;
                }
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
    }
}


/* 検索関連フィルタ　共通処理 税率区分 */
function eventBlurSearchTaxRate(event, element) {
    // 納品先
    if (element.id.match('input_taxrate')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            tax_rate_kbn_cd: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        manageUrl = "../../../code_auto/tax_rate?" + query_params;
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
                    const dataIds = data.map((obj) => obj.id);
                    document.getElementById('redirect').value = element.value;
                    document.getElementById('redirect').click();
                } else {
                    let msgHTML = '<li>コードがマスタに存在しません。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                }
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
    }
}

/* 税率設定 start */
// 行追加
function taxRateAddLine() {
    let i = 0;
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

/* 補完関連　共通処理 ユーザコード */
function eventBlurCodeautoUser(event, element) {
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    console.log(element.value);
    if (element.id.match('user')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            user_cd: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        manageUrl = "../../../../code_auto/user?" + query_params;
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
                    let msgHTML = '<li>登録済みのデータです。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                } else {
                    let msgHTML = '<li>新規のデータです。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                }
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
    }
}

// 入力値 3桁区切り
function addFigure(element) {
    var removed = element.value.replace(/[^0-9]/g, "");

    if (removed == '') {
        element.value = removed;
        return;
    }

    var numVal = parseInt(removed, 10);
    element.value = numVal.toLocaleString();
}

/* 補完関連　共通処理 得意先 */
function eventBlurCodeautoCustomer(event, element) {
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    if (element.id.match('customer')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            customer_cd: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        manageUrl = "../../../../code_auto/customer?" + query_params;
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
                    //tr.parentNode.cells[column+1].childNodes[0].value = data['customer_name'];
                    document.getElementById("names_customer_cd").innerHTML = data['customer_name'];
                } else {
                    let msgHTML = '<li>得意先マスタの登録を行ってください。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                    document.getElementById("names_customer_cd").innerHTML = "";
                }
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
    }
}


/* 得意先別商品掛率　補完　コード設定リダイレクトあり　*/
function eventBlurCodeautoCustomerOtherItemRate(event, element) {

    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    if (null === element.value || "" === element.value) {
        return false;
    }
    if (element.id.match('customer')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            customer_cd: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        manageUrl = "../../../code_auto/customer?" + query_params;
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
                    document.getElementById('redirect').value = data.id;
                    document.getElementById('redirect').click();
                    //document.getElementById('names_supplier_code').innerHTML = "";
                } else {
                    let msgHTML = '<li>得意先マスタの登録を行ってください。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                    document.getElementById('names_supplier_code').innerHTML = "";
                }
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
    }
}


/* 補完関連　共通処理 請求先 リダイレクトあり */
function eventBlurCodeautoBillingAddressRedirect(event, element) {
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    //納品先
    if (element.id.match('billing')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            billing_address_cd: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        manageUrl = "../../../../code_auto/billing_address?" + query_params;
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
                    //随時締
                    if (data.sequentially_kbn === 1) {
                        let msgHTML = '<li>随時締の得意先は入力できません。</li>';
                        alertArea.insertAdjacentHTML('beforeend', msgHTML);
                    } else {
                        document.getElementById('redirect').value = data.id;
                        document.getElementById('redirect').click();
                    }
                } else {
                    let msgHTML = '<li>得意先マスタの登録を行ってください。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                }
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
    }
}

/* 補完関連　共通処理 請求先 リダイレクトあり */
function eventBlurCodeautoBillingAddressRedirect2(event, element) {
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    //納品先
    if (element.id.match('billing')) {
        let data = [];
        data.map(tag_key => params.append('key', 'val'));
        const params = {
            billing_address_cd: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        manageUrl = "../../../../code_auto/billing_address?" + query_params;
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
                    //随時締
                    if (data.sequentially_kbn === 0) {
                        let msgHTML = '<li>随時締以外の得意先は入力できません。</li>';
                        alertArea.insertAdjacentHTML('beforeend', msgHTML);
                    } else {
                        document.getElementById('redirect').value = data.id;
                        document.getElementById('redirect').click();
                    }
                } else {
                    let msgHTML = '<li>得意先マスタの登録を行ってください。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                }
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
    }
}
