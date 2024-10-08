import {addNewOpenEvent} from "../../../modules/search_master_modal/src/modal.js";
import {start} from "../../../modules/select_image/src/event.js";

window.onload = function() {
    let taxRate = document.getElementById('input_tax_rate_kbn');
    eventBlurCodeautoTaxRateKbnInit('', taxRate);

    let item_banner_url_1 = document.getElementById('item_banner_url_1');
    eventBlurUrl(arguments[0], item_banner_url_1);
    let item_banner_url_2 = document.getElementById('item_banner_url_2');
    eventBlurUrl(arguments[0], item_banner_url_2);
}

window.eventBlurUrl = function(event, element) {
    let url = element.value;
    let IdName = 'url_' + element.id;
    if("" != url){
        document.getElementById(IdName).setAttribute('href', url);
    }else{
        document.getElementById(IdName).removeAttribute('href');
    }
}

/* 補完関連 共通処理 item リダイレクトあり */
window.eventBlurCodeautoItemRedirect = function(event, element) {
    //書き込み先の設定
    let alertArea = document.getElementById('alert-danger-ul');
    if (null == element.value || "" == element.value) {
        return;
    }
    if (900930 == element.value || 900940 == element.value || 900950 == element.value || 901000 == element.value) {
        let msgHTML = `<li>商品コード${element.value}は使用できません。</li>`;
        alertArea.innerHTML = msgHTML;
        element.value = "";
        return;
    }

    const params = {
        item_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/item?" + query_params;
     // console.log(manageUrl);

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
                document.getElementById('redirect').value = data.id;
                document.getElementById('redirect').click();
            } else {
                let msgHTML = '<li>新規のデータです。</li>';
                alertArea.insertAdjacentHTML('beforeend', msgHTML);
                //document.getElementById('names_item_code').innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}


// 行追加
window.itemDetailAddLine2 = function(event, element) {
    var table1 = document.getElementById("member_grids");
    var row = table1.tBodies[0].insertRow(-1);
    row.innerHTML = memberSiteItemHTML();
    var cell1 = row.getElementsByTagName('td')[0];
    addNewOpenEvent(cell1.getElementsByTagName('img')[0]);
}

/* 商品詳細 end */
/* 補完関連 共通処理 カラーパターン */
window.eventBlurColorPatterns = function(event, element) {
    //書き込み先の設定
    let alertArea = document.getElementById('alert-danger-ul-table');
    if (null == element.value || "" == element.value) {
        return;
    }
    element.value = Util.padZero(element.value, 4);
    const params = {
        color_pattern_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/color_pattern?" + query_params;
     // console.log(manageUrl);

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
                for(let i = 0; i < 20; i++){
                    let j = i + 1;
                    if(data[`color_cd_${j}`]){
                        document.getElementById(`input_color_code${i}`).value = data[`color_cd_${j}`];
                        document.getElementById(`input_color_name${i}`).value = data[`color_name_${j}`];
                    }else{
                        document.getElementById(`input_color_code${i}`).value = "";
                        document.getElementById(`input_color_name${i}`).value = "";
                    }
                }
            } else {
                let msgHTML = 'カラーパターンを登録してください';
                alertArea.insertAdjacentHTML('beforeend', msgHTML);
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 補完関連 共通処理 サイズパターン */
window.eventBlurSizePatterns = function(event, element) {
    //書き込み先の設定
    let alertArea = document.getElementById('alert-danger-ul-table');
    if (null == element.value || "" == element.value) {
        return;
    }
    element.value = Util.padZero(element.value, 4);
    const params = {
        size_pattern_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/size_pattern?" + query_params;
     // console.log(manageUrl);

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
                for(let i = 0; i < 10; i++){
                    let j = i + 1;
                    if(data[`size_cd_${j}`]){
                        document.getElementById(`input_size_code${i}`).value = data[`size_cd_${j}`];
                        document.getElementById(`input_size_name${i}`).value = data[`size_name_${j}`];
                    }else{
                        document.getElementById(`input_size_code${i}`).value = "";
                        document.getElementById(`input_size_name${i}`).value = "";
                    }
                }
            } else {
                let msgHTML = 'サイズパターンを登録してください';
                alertArea.insertAdjacentHTML('beforeend', msgHTML);
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

window.removeExample = function(element) {
    let parent = element.parentNode.parentNode;
    parent.remove();
}

/* JANコード登録有無変更時 */
window.changeRegisterJanCode = function(event, element) {
    if(element.checked){
        document.getElementById('updateButton').dataset.registerJanCode = element.value;
    }else{
        document.getElementById('updateButton').dataset.registerJanCode = "";
    }
}

/* 補完関連 共通処理 商品分類 */
window.eventBlurCodeautoItemClass = function(event, element) {
    if (null === element.value || "" === element.value) {
        return false;
    }
    // let data = [];
    const alertId = element.id.replace('input', 'alert');
    const elementId = element.id.replace('input', 'names');
    const nameArea = document.getElementById(elementId);
    const alertArea = document.getElementById(alertId);
    const itemClassThingId = element.id.replace('input_item_class_cd_', '');

    // data.map(tag_key => params.append('key', 'val'));
    const params = {
        item_class_cd: element.value,
        def_item_class_thing_id: itemClassThingId,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/item_class?" + query_params;
     // console.log(manageUrl);

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
                nameArea.value = data['item_class_name'];
            } else {
                let msgHTML = '商品分類マスタの登録を行ってください';
                alertArea.insertAdjacentHTML('beforeend', msgHTML);
                nameArea.value = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 仕入先コード 補完 コード設定リダイレクトなし */
window.eventBlurCodeautoSupplier = function(event, element) {
    const alertArea = document.getElementById('alert-danger-ul-supplier');
    const nameArea = document.getElementById('names_mt_supplier_cd');
    if (null === element.value || "" === element.value) {
        alertArea.innerHTML = "";
        nameArea.innerHTML = "";
        return false;
    }
    element.value = Util.padZero(element.value, 6);
    const params = {
        supplier_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    const manageUrl = "../../../../code_auto/supplier?" + query_params;
     // console.log(manageUrl);

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
                if (data['del_kbn'] === 0) {
                    nameArea.value = data['supplier_name'];
                } else {
                    let msgHTML = '削除区分が有効になっているコードです'
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                    nameArea.value = "";
                }
            } else {
                let msgHTML = '仕入先マスタの登録を行ってください';
                alertArea.innerHTML('beforeend', msgHTML);
                nameArea.value = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 検索関連フィルタ 共通処理 税率区分 */
window.eventBlurCodeautoTaxRateKbn = function(event, element) {
    const alertArea = document.getElementById('alert-danger-ul-tax-rate');
    const nameArea = document.getElementById('names_tax_rate_kbn');
    const retail_price_tax_out = document.getElementById('retail_price_tax_out');
    const retail_price_tax_in = document.getElementById('retail_price_tax_in');
    const reference_retail_tax_out = document.getElementById('reference_retail_tax_out');
    const reference_retail_tax_in = document.getElementById('reference_retail_tax_in');
    const purchase_price_tax_out = document.getElementById('purchase_price_tax_out');
    const purchase_price_tax_in = document.getElementById('purchase_price_tax_in');
    const hidden_tax_rate = document.getElementById('hidden_tax_rate');
    
    if (null === element.value || "" === element.value) {
        alertArea.innerHTML = "";
        nameArea.innerHTML = "";
        return false;
    }
    let data = [];
    data.map(tag_key => params.append('key', 'val'));
    const params = {
        tax_rate_kbn_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/tax_rate_kbn_wiht_rate?" + query_params;
     // console.log(manageUrl);

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
                nameArea.innerHTML = data['tax_rate_kbn_name'];
                var result = window.confirm("税率区分が変更されました。税込単価を再計算しますか？");
                if( result ) {
                    retail_price_tax_in.value = (retail_price_tax_out.value * (1 + data['rate']['tax_rate']/100)).toFixed(0);
                    reference_retail_tax_in.value = (reference_retail_tax_out.value * (1 + data['rate']['tax_rate']/100)).toFixed(0);
                    purchase_price_tax_in.value = (purchase_price_tax_out.value * (1 + data['rate']['tax_rate']/100)).toFixed(1);
                    hidden_tax_rate.value = data['rate']['tax_rate'];
                }
                else {
                }

            } else {
                let msgHTML = '税率設定マスタの登録を行ってください';
                alertArea.insertAdjacentHTML('beforeend', msgHTML);
                nameArea.innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

window.eventBlurTaxAutoRetailPrice = function(event, element) {
    const retail_price_tax_in = document.getElementById('retail_price_tax_in');
    const hidden_tax_rate = document.getElementById('hidden_tax_rate');

    if (null === element.value || "" === element.value) {
        return false;
    }
    element.value = element.value.replace(/[^0-9]/g, "");
    if("" != hidden_tax_rate && null != hidden_tax_rate){
        retail_price_tax_in.value = (element.value * (1 + hidden_tax_rate.value / 100)).toFixed(0);
        console.log(hidden_tax_rate.value)
        console.log(retail_price_tax_in.value)
        addFigure(retail_price_tax_in);
    }

    addFigure(element);
}

window.eventBlurTaxAutoReferenceRetail = function(event, element) {
    const reference_retail_tax_in = document.getElementById('reference_retail_tax_in');
    const hidden_tax_rate = document.getElementById('hidden_tax_rate');

    if (null === element.value || "" === element.value) {
        return false;
    }
    element.value = element.value.replace(/[^0-9]/g, "");
    if("" != hidden_tax_rate && null != hidden_tax_rate){
        reference_retail_tax_in.value = (element.value * (1 + hidden_tax_rate.value / 100)).toFixed(0);
        addFigure(reference_retail_tax_in);
    }
    addFigure(element);
}

window.eventBlurTaxAutoPurchasePrice = function(event, element) {
    const purchase_price_tax_in = document.getElementById('purchase_price_tax_in');
    const hidden_tax_rate = document.getElementById('hidden_tax_rate');

    if (null === element.value || "" === element.value) {
        return false;
    }

    element.value = element.value.replace(/[^0-9]/g, "");
    if("" != hidden_tax_rate && null != hidden_tax_rate){
        purchase_price_tax_in.value = (element.value * (1 + hidden_tax_rate.value / 100)).toFixed(1);
        decimalAddFigure(purchase_price_tax_in);
    }
    decimalAddFigure(element);
}

/* 検索関連フィルタ 共通処理 税率区分 確認ダイアログなし */
window.eventBlurCodeautoTaxRateKbnInit = function(event, element) {
    const alertArea = document.getElementById('alert-danger-ul-tax-rate');
    const nameArea = document.getElementById('names_tax_rate_kbn');

    if (null === element.value || "" === element.value) {
        alertArea.innerHTML = "";
        nameArea.innerHTML = "";
        return false;
    }
    let data = [];
    data.map(tag_key => params.append('key', 'val'));
    const params = {
        tax_rate_kbn_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/tax_rate_kbn_wiht_rate?" + query_params;
     // console.log(manageUrl);

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
                nameArea.innerHTML = data['tax_rate_kbn_name'];
            } else {
                let msgHTML = '税率設定マスタの登録を行ってください';
                alertArea.insertAdjacentHTML('beforeend', msgHTML);
                nameArea.innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 補完関連 共通処理 サイズ選択 */
window.eventBlurCodeautoSize = function(event, element) {
    //書き込み先の設定
    let alertArea = document.getElementById('alert-danger-ul-table');
    const elementId = element.id.replace('code', 'name');
    const nameArea = document.getElementById(elementId);
    if (null === element.value || "" === element.value) {
        return false;
    }
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    console.log(tr)
    let data = [];
    data.map(tag_key => params.append('key', 'val'));
    const params = {
        size_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/size?" + query_params;
     // console.log(manageUrl);

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
        } else {
            let msgHTML = 'サイズマスタの登録を行ってください';
            alertArea.insertAdjacentHTML('beforeend', msgHTML);
        }
    })
    .catch(error => {
        console.log(error); // エラー表示
    });
}

/* 補完関連 共通処理 カラー選択 */
window.eventBlurCodeautoColor = function(event, element) {
    //書き込み先の設定
    let alertArea = document.getElementById('alert-danger-ul-table');
    const elementId = element.id.replace('code', 'name');
    const nameArea = document.getElementById(elementId);
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
        const manageUrl = "../../../../code_auto/color?" + query_params;
         // console.log(manageUrl);

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
                } else {
                    let msgHTML = 'カラーマスタの登録を行ってください';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                }
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
    }
}

/* 補完関連 サイズ全チェック */
window.eventBlurSizeCheckAll = function(event, element) {
    const targetFlag = element.id.replace('size_check_all', '');
    if(element.checked == false){
        for (let step = 0; step < 20; step++) {
            let targetID = "hidden_flg" + String(step) + String(targetFlag) ;
            let target = document.getElementById(targetID);
            target.checked = false;
        }
    } else {
        for (let step = 0; step < 20; step++) {
            let targetID = "hidden_flg" + String(step) + String(targetFlag) ;
            let target = document.getElementById(targetID);
            target.checked = true;
        }
    }
}

/* 補完関連 カラー全チェック */
window.eventBlurColorCheckAll = function(event, element) {
    const targetFlag = element.id.replace('color_check_all', '');
    if(element.checked == false){
        for (let step = 0; step < 10; step++) {
            let targetID = "hidden_flg" + String(targetFlag) + String(step) ;
            let target = document.getElementById(targetID);
            target.checked = false;
        }
    } else {
        for (let step = 0; step < 10; step++) {
            let targetID = "hidden_flg" + String(targetFlag) + String(step) ;
            let target = document.getElementById(targetID);
            target.checked = true;
        }
    }
}

function memberSiteItemHTML() {
    return [
        '<tr>',

        '<td class="grid_col_2 col_rec">',
        '    <div class="flex">',
        '        <input type="text" placeholder=""',
        '            name="recommend_ec_item_cd[]" class="grid_textbox"',
        '            value=""',
        '            onblur="eventBlurCodeautoMemberSiteItemRecommendationManagements(arguments[0], this)"',
        '        >',
        '        <img class="vector" src="/img/icon/vector.svg"',
        '            data-smm-open="search_member_site_item_class" />',
        '    </div>',
        '</td>',
        '<td class="grid_col_2 col_rec"><input type="text" placeholder=""',
        '        name="recommend_ec_item_name[]" class="grid_textbox txt_blue"',
        '        value="" readonly></td>',
        '<td class="grid_col_2 col_rec"><input type="text" placeholder=""',
        '        name="recommend_display_order[]" class="grid_textbox"',
        '        value=""></td>',
        '<td class="grid_col_2 col_rec"><button type="button"',
        '        name="delete_ec[]" onclick="removeExample(this)"',
        `        class="display_none"`,
        '        value=""><img',
        '            src="/img/icon/trash.svg"',
        '            class="img_center"></button></td>',
        '<input type="hidden" name="recommend_ec_item_id[]" value="">',
        '</tr>',
    ].join('');
}

/* 補完関連 メンバーサイト商品情報 */
window.eventBlurCodeautoMemberSiteItem = function(event, element) {
    //書き込み先の設定
    let alertArea = document.getElementById('alert-item-ec-item-cd');
    if (null === element.value || "" === element.value) {
        return false;
    }
    let ecItemName = document.getElementById('ec_item_name');
    let ranking = document.getElementById('ranking');
    let printedProductsFlg = document.getElementById('printed_products_flg');

    let itemBannerUrl1 = document.getElementById('item_banner_url_1');
    let itemBannerUrl2 = document.getElementById('item_banner_url_2');
    let itemMemo1 = document.getElementById('item_memo_1');
    let itemMemo2 = document.getElementById('item_memo_2');
    let itemMemo3 = document.getElementById('item_memo_3');
    let itemMemo4 = document.getElementById('item_memo_4');
    let itemMemo5 = document.getElementById('item_memo_5');
    // おすすめ商品


    const params = {
        ec_item_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/member_site_item_with_recommendation?" + query_params;
     // console.log(manageUrl);

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
                console.log(data);
                ecItemName.value = data['ec_item_name'];
                ranking.value = data['ranking'];
                if(data['printed_products_flg']){
                    printedProductsFlg.checked = true;
                }else{
                    printedProductsFlg.checked = false;
                }

                if(data['item_image_file_1_path']){
                    setImgData('item_image_file_1', data);
                }else{
                    unSetImgData('item_image_file_1');
                }
                if(data['item_image_file_2_path']){
                    setImgData('item_image_file_2', data);
                }else{
                    unSetImgData('item_image_file_2');
                }
                if(data['item_image_file_3_path']){
                    setImgData('item_image_file_3', data);
                }else{
                    unSetImgData('item_image_file_3');
                }
                if(data['item_image_file_4_path']){
                    setImgData('item_image_file_4', data);
                }else{
                    unSetImgData('item_image_file_4');
                }

                if(data['pdf_file_1']){
                    setPdfData('pdf_file_1', data);
                }else{
                    unSetPdfData('pdf_file_1');
                }
                if(data['pdf_file_2']){
                    setPdfData('pdf_file_2', data);
                }else{
                    unSetPdfData('pdf_file_2');
                }
                if(data['pdf_file_3']){
                    setPdfData('pdf_file_3', data);
                }else{
                    unSetPdfData('pdf_file_3');
                }
                if(data['pdf_file_4']){
                    setPdfData('pdf_file_4', data);
                }else{
                    unSetPdfData('pdf_file_4');
                }
                if(data['pdf_file_5']){
                    setPdfData('pdf_file_5', data);
                }else{
                    unSetPdfData('pdf_file_5');
                }

                if(data['item_banner_image_file_1_path']){
                    setImgData('item_banner_image_file_1', data);
                }else{
                    unSetImgData('item_banner_image_file_1');
                }
                if(data['item_banner_image_file_2_path']){
                    setImgData('item_banner_image_file_2', data);
                }else{
                    unSetImgData('item_banner_image_file_2');
                }

                itemBannerUrl1.value = data['item_banner_url_1'];
                itemBannerUrl2.value = data['item_banner_url_2'];
                itemMemo1.value = data['item_memo_1'];
                itemMemo2.value = data['item_memo_2'];
                itemMemo3.value = data['item_memo_3'];
                itemMemo4.value = data['item_memo_4'];
                itemMemo5.value = data['item_memo_5'];

                // 表示中のおすすめ商品を削除
                if(data['mtMemberSiteItemRecommendations'].length > 0){
                    $('#member_grids tbody tr').remove();
                    for(let i = 0; i < data['mtMemberSiteItemRecommendations'].length; i++){
                        var table1 = document.getElementById("member_grids");
                        var row = table1.tBodies[0].insertRow(-1);
                        row.innerHTML = memberSiteItemHTML();
                        var cell1 = row.getElementsByTagName('td')[0];
                        var cell2 = row.getElementsByTagName('td')[1];
                        var cell3 = row.getElementsByTagName('td')[2];
                        var cell4 = row.getElementsByTagName('td')[3];

                        cell1.children[0].children[0].value = data['mtMemberSiteItemRecommendations'][i]['ec_item_cd'];
                        cell2.children[0].value = data['mtMemberSiteItemRecommendations'][i]['ec_item_name'];
                        cell3.children[0].value = data['mtMemberSiteItemRecommendations'][i]['display_order'];
                        // cell4.children[0].value = data['mtMemberSiteItemRecommendations'][i]['id'];
                        cell3.nextElementSibling.nextElementSibling.value = data['mtMemberSiteItemRecommendations'][i]['id'];
                        cell1.setAttribute("class", "grid_col_1 col_rec");
                        addNewOpenEvent(cell1.getElementsByTagName('img')[0]);
                        cell2.setAttribute("class", "grid_col_2 col_rec");
                        cell3.setAttribute("class", "grid_col_2 col_rec");
                        cell4.setAttribute("class", "grid_col_2 col_rec");
                    }
                    start();
                }else{
                    $('#member_grids tbody tr').remove();
                }
            } else {
                let msgHTML = '新規データです';
                alertArea.insertAdjacentHTML('beforeend', msgHTML);
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* ファイル再読み込み */
function setImgData(name, data) {
    let img_name = name + "_img"
    let src_name = name + "_src"
    let name_name = name + "_img_name"
    let itemImgFileImg = document.getElementsByName(img_name)[0];
    let itemImgFileSrc = document.getElementsByName(src_name)[0];
    let itemImgFileName = document.getElementsByName(name_name)[0];
    let path = name + "_path";
    itemImgFileImg.setAttribute('src', data[path]);
    itemImgFileImg.style.display = '';
    itemImgFileSrc.value = data[name];
    itemImgFileName.innerHTML = data[name].replace(/^.*[\\\/]/, '');
}

/* ファイル再読み込み */
function unSetImgData(name) {
    let img_name = name + "_img"
    let src_name = name + "_src"
    let name_name = name + "_img_name"
    let itemImgFileImg = document.getElementsByName(img_name)[0];
    let itemImgFileSrc = document.getElementsByName(src_name)[0];
    let itemImgFileName = document.getElementsByName(name_name)[0];
    itemImgFileImg.setAttribute('src', '');
    itemImgFileImg.style.display = 'none';
    itemImgFileSrc.value = '';
    itemImgFileName.innerHTML = '';
}

/* PDF再読み込み */
function setPdfData(name, data) {
    let src_name = name + "_src"
    let name_name = name + "_img_name"
    let itemPdfFileSrc = document.getElementsByName(src_name)[0];
    let itemPdfFileName = document.getElementsByName(name_name)[0];
    itemPdfFileSrc.value = data[name];
    itemPdfFileName.innerHTML = data[name].replace(/^.*[\\\/]/, '');
}

/* PDF再読み込み */
function unSetPdfData(name) {
    let src_name = name + "_src"
    let name_name = name + "_img_name"
    let itemPdfFileSrc = document.getElementsByName(src_name)[0];
    let itemPdfFileName = document.getElementsByName(name_name)[0];
    itemPdfFileSrc.value = '';
    itemPdfFileName.innerHTML = '';
}

/* 補完関連 メンバーサイト商品おすすめ管理マスタ */
window.eventBlurCodeautoMemberSiteItemRecommendationManagements = function(event, element) {
    //書き込み先の設定
    let alertArea = document.getElementById('alert-item-ec-item-recommend');
    let item_cd = document.getElementById('ec_item_cd');

    if (null === item_cd.value || "" === item_cd.value) {
        element.value = "";
        let msgHTML = '上部のメンバーサイト商品コードが選択されていません';
        alertArea.innerHTML = msgHTML;
        return false;
    }
    let baseElement = element.parentNode.parentNode;
    let ecItemName = baseElement.nextElementSibling.firstElementChild;
    let displayOrder = baseElement.nextElementSibling.nextElementSibling.firstElementChild;
    let ecItemID = baseElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling;
    if (null === element.value || "" === element.value) {
        ecItemName.value = "";
        ecItemID.value = "";
        displayOrder.value = "";
        return false;
    }

    let elementArea = document.getElementById('recommend_ec_items');
    // let inputElements = elementArea.getElementsByTagName('input');
    let inputElements = elementArea.querySelectorAll('[name^="recommend_ec_item_cd"]');
    let len = inputElements.length;

    if( len > 0 ){
        for(let i = 0; i < len; i++){
            if(inputElements[i] != element && inputElements[i].value == element.value){
                element.value = "";
                let msgHTML = '既に選択済みです。';
                alertArea.innerHTML = msgHTML;
                return false;
            }
        }
    }

    const params = {
        ec_item_cd1: item_cd.value,
        ec_item_cd2: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/member_site_item_recommendation_management?" + query_params;
     // console.log(manageUrl);

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
                ecItemName.value = data['ec_item_name'];
                ecItemID.value = data['id'];
                if(data['mtMemberSiteRecommendationManagement'] && data['mtMemberSiteRecommendationManagement']['display_order']){
                    displayOrder.value = data['mtMemberSiteRecommendationManagement']['display_order'];
                }
            } else {
                let msgHTML = 'メンバーサイト商品コードの登録を行ってください';
                alertArea.insertAdjacentHTML('beforeend', msgHTML);
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 削除区分（得意先）変更時 */
window.changeDelKbnItem = function(event, element) {
    document.getElementById('updateButton').dataset.delKbn = element.value;
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

// 入力値 3桁区切り
window.decimalAddFigure = function(element) {
    var removed = element.value.replace(/[^0-9.]/g, "");
    if (removed == '') {
        element.value = removed;
        return;
    }

    // var numVal = parseInt(removed, 10);
    var numVal = Number(removed).toFixed(1);
    element.value = numVal.toLocaleString();
}