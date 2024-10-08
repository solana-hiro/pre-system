window.onload = function() {
    let beforeItem = document.getElementById('input_before_item');
    eventBlurCodeautoItem('', beforeItem);
}

/* 商品コード変更処理 start */
// ラジオボタン変更
function itemChangeKbnClick() {
    let check1 = document.getElementById('change_kbn_1').checked;
    let check2 = document.getElementById('change_kbn_2').checked;
    let check3 = document.getElementById('change_kbn_3').checked;
    let item1 = document.getElementById('item1');
    let item2 = document.getElementById('item2');
    let item3 = document.getElementById('item3');
    let item4 = document.getElementById('item4');
    let item5 = document.getElementById('item5');
    let item6 = document.getElementById('item6');
    if (check2 === true) {
        item1.style.visibility = "visible";
        item2.style.visibility = "visible";
        item3.style.visibility = "hidden";
        item4.style.visibility = "hidden";
        item5.style.visibility = "visible";
        item6.style.visibility = "hidden";
    } else if (check3 === true) {
        item1.style.visibility = "visible";
        item2.style.visibility = "hidden";
        item3.style.visibility = "visible";
        item4.style.visibility = "hidden";
        item5.style.visibility = "hidden";
        item6.style.visibility = "visible";
    } else {
        item1.style.visibility = "visible";
        item2.style.visibility = "hidden";
        item3.style.visibility = "hidden";
        item4.style.visibility = "visible";
        item5.style.visibility = "hidden";
        item6.style.visibility = "hidden";
    }
}
/* 商品コード変更処理 end */


/* 補完関連　共通処理 商品 */
function eventBlurCodeautoItem(event, element) {
    if (null === element.value || "" === element.value) {
        return false;
    }
    const nameArea = document.getElementById('name_before_item');
    const alertArea = document.getElementById('alert_before_item');
    const selectColor = document.getElementById('before_color_code');
    const selectSize = document.getElementById('before_size_code');
    const beforeColorCode = document.getElementById('hidden_color');
    const beforeSizeCode = document.getElementById('hidden_size');
    console.log(beforeColorCode);
    console.log(beforeColorCode.value);

    const params = {
        item_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    manageUrl = "../../../code_auto/item_with_sku?" + query_params;
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
                nameArea.value = data['item']['item_name'];

                // 変更名カラーの選択肢変更
                while (0 < selectColor.childNodes.length) {
                    selectColor.removeChild(selectColor.childNodes[0]);
                }
                if(data['colors']){
                    var colorKeys = Object.keys(data['colors']).sort();

                    colorKeys.forEach(function (key) {
                        var option = document.createElement('option');
                        var colorName = data['colors'][key] ? data['colors'][key] : '';
                        var text = document.createTextNode(key + '(' + colorName + ')');
                        option.value = key;
                        option.appendChild(text);
                        if(option.value.indexOf(beforeColorCode.value) === 0){
                            option.selected = true;
                        }
                        selectColor.appendChild(option);
                    });
                    if(!beforeColorCode.value){
                        selectColor.selectedIndex = 0;
                    }
                }

                // 変更名サイズーの選択肢変更
                while (0 < selectSize.childNodes.length) {
                    selectSize.removeChild(selectSize.childNodes[0]);
                }
                if(data['sizes']){
                    var sizeKeys = Object.keys(data['sizes']).sort();
                    sizeKeys.forEach(function (key) {
                        var option = document.createElement('option');
                        var colorName = data['sizes'][key] ? data['sizes'][key] : '';
                        var text = document.createTextNode(key + '(' + colorName + ')');
                        option.value = key;
                        option.appendChild(text);
                        if(option.value.indexOf(beforeSizeCode.value) === 0){
                            option.selected = true;
                        }
                        selectSize.appendChild(option);
                    });
                    if(!beforeSizeCode.value){
                        selectSize.selectedIndex = 0;
                    }
                }
            } else {
                let msgHTML = '新規データです。<br>商品マスタの登録を行ってください';
                alertArea.insertAdjacentHTML('beforeend', msgHTML);
                nameArea.value = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 補完関連　共通処理 商品 */
function eventBlurCodeautoItemAfter(event, element) {
    if (null === element.value || "" === element.value) {
        return false;
    }

    const alertArea = document.getElementById('alert_after_item');
    const beforeItemCode = document.getElementById('input_before_item')
    if(element.value == beforeItemCode.value){
        alertArea.innerHTML = "変更前と同じコードは入力できません";
        return;
    }
    const params = {
        item_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    manageUrl = "../../../code_auto/item?" + query_params;
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
            console.log(data);
            if (null !== data) {
                alertArea.innerHTML = "この商品コードは既に登録されています";
            } else {
                alertArea.innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

function eventChangeBeforeColor(event, element){
    
    const beforeColorCode = document.getElementById('hidden_color');
    beforeColorCode.value = element.value;
    console.log(beforeColorCode.value);
}

function eventChangeBeforeSize(event, element){
    
    const beforeColorCode = document.getElementById('hidden_size');
    beforeColorCode.value = element.value;
}

/* 補完関連　共通処理 カラー */
function eventBlurCodeautoColor(event, element) {
    if (null === element.value || "" === element.value) {
        return false;
    }
    const nameArea = document.getElementById('name_after_color');
    const alertArea = document.getElementById('alert_after_color');
    const beforeColorCode = document.getElementById('before_color_code');
    const colorOptions = document.getElementById('before_color_code').options;
    if(element.value == beforeColorCode.value){
        alertArea.innerHTML = "変更前と同じコードは入力できません";
        return;
    }

    var exitsColors = [];
    [...colorOptions].forEach(option => {
        exitsColors.push(option.value);
    });

    if (exitsColors.includes(element.value)) {
        alertArea.innerHTML = "商品マスタ内に重複するカラーコードが存在するため、更新できません";
        return;
    }

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
            alertArea.innerHTML = "";
            if (null !== data) {
                nameArea.value = data['color_name'];
                alertArea.innerHTML = "";
            } else {
                let msgHTML = 'カラーマスタに登録してください';
                alertArea.insertAdjacentHTML('beforeend', msgHTML);
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 補完関連　共通処理 サイズ */
function eventBlurCodeautoSize(event, element) {
    if (null === element.value || "" === element.value) {
        return false;
    }
    const nameArea = document.getElementById('name_after_size');
    const alertArea = document.getElementById('alert_after_size');
    const beforeSizeCode = document.getElementById('before_size_code');
    const sizeOptions = document.getElementById('before_size_code').options;
    if(element.value == beforeSizeCode.value){
        alertArea.innerHTML = "変更前と同じコードは入力できません";
        return;
    }

    var exitsSizes = [];
    [...sizeOptions].forEach(option => {
        exitsSizes.push(option.value);
    });

    if (exitsSizes.includes(element.value)) {
        alertArea.innerHTML = "商品マスタ内に重複するサイズコードが存在するため、更新できません";
        return;
    }

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
            alertArea.innerHTML = "";
            if (null !== data) {
                nameArea.value = data['size_name'];
                alertArea.innerHTML = "";
            } else {
                let msgHTML = 'サイズマスタに登録してください';
                alertArea.insertAdjacentHTML('beforeend', msgHTML);
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}
