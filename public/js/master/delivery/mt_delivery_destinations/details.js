window.onload = function() {
    customer_url = document.getElementById('delivery_destination_url');
    eventBlurUrl(arguments[0], customer_url);
}

function eventBlurEmail(event, element) {
    let mailAddress = document.getElementById(element.id).value;
    let IdName = 'link_' + element.id;
    document.getElementById(IdName).href = "mailto:" + mailAddress;
}

function eventBlurUrl(event, element) {
    let url = element.value;
    let IdName = 'url_' + element.id;
    if("" != url){
        document.getElementById(IdName).setAttribute('href', url);
    }else{
        document.getElementById(IdName).removeAttribute('href');
    }
}

/* 補完 得意先コード */
function blurCodeautoCustomer(event, element) {
    if("" !== element.value) {
        element.value = element.value.toString().padStart(6, '0');
    }
    const component = Livewire.getByName("master-search.delivery-destination")[0];
    if(component){
        component.set('customerCd', String(element.value), false);
    }
    getCustomerDeliveryDestination();
}

/* 補完 納品先コード */
function blurCodeautoDelivery(event, element) {
    if("" !== element.value) {
        element.value = element.value.toString().padStart(6, '0');
    }
    getCustomerDeliveryDestination();
}

/* 補完 ルート */
function blurCodeautoRoot(event, element) {
    //書き込み先の設定
    let alertArea = document.getElementById('alert-danger-ul-root');
    let nameArea = document.getElementById('names_root');

    if("" == element.value) {  //列数
        return;
    }
    element.value = element.value.toString().padStart(4, '0');

    let data = [];
    const params = {
        root_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/root?" + query_params;
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
            // let hiddenArea = document.getElementById('hidden_root');
            alertArea.innerHTML = "";
            if (null !== data) {
                nameArea.value = data['root_name'];
            } else {
                let msgHTML = 'ルートマスタの登録を行ってください。';
                alertArea.innerHTML = msgHTML;
                nameArea.value = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 補完 運送会社 */
function blurCodeautoItemClass1(event, element) {
    let alertArea = document.getElementById('alert-danger-ul-item-class1');
    let nameArea = document.getElementById('names_item_class1');

    if("" == element.value) { 
        alertArea.innerHTML = "";
        nameArea.value = "";
        return;
    }


    if("800000" > element.value || "819999" < element.value){
        let msgHTML = '入力範囲：800000～819999です。';
        alertArea.innerHTML = msgHTML;
        nameArea.value = "";
        return;
    }

    element.value = element.value.toString().padStart(4, '0');
    let data = [];
    const params = {
        item_class_cd: element.value,
    };
    let query_params = new URLSearchParams(params);

    //書き込み先の設定
    // let hiddenArea = document.getElementById('hidden_root');


    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/item_class_brand1?" + query_params;
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
                nameArea.value = data['item_class_name'];
            } else {
                let msgHTML = '商品分類１マスタの登録を行ってください。';
                alertArea.innerHTML = msgHTML;
                nameArea.value = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 納品先着日  */
function blurCodeautoArrivalDate(event, element) {
    if("" == element.value) {  //列数
        return;
    }
    element.value = element.value.toString().padStart(4, '0');
    //ルート
    let data = [];
    const params = {
        arrival_date_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/arrival_date?" + query_params;
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
            let alertArea = document.getElementById('alert-danger-ul-arrival-date');
            let nameArea = document.getElementById('names_arrival_date');
            // let hiddenArea = document.getElementById('hidden_root');
            alertArea.innerHTML = "";
            if (null !== data) {
                nameArea.value = data['arrival_date_name'];
            } else {
                let msgHTML = '着日定義の登録を行ってください。';
                alertArea.innerHTML = msgHTML;
                nameArea.value = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 削除区分（納品先）変更時 */
function changeDelKbnDeliveryDestination(event, element) {
    document.getElementById('updateButton').dataset.delKbn = element.value;
}

/* 補完関連　共通処理 納品先・得意先の関連性 */
function getCustomerDeliveryDestination() {
    const customer_cd =  document.getElementById('input_customer_cd').value;
    const delivery_destination_cd =  document.getElementById('input_delivery_cd').value;

    let data = [];
    data.map(tag_key => params.append('key', 'val'));
    const params = {
        customer_cd: customer_cd,
        delivery_destination_cd: delivery_destination_cd,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/mt_customer_delivery_destination?" + query_params;
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
                if (null === data['customer'] || "" === data['customer']) {
                    if(customer_cd !== ""){
                        let msgHTML = '<li>得意先マスタの登録を行ってください。</li>';
                        alertArea.insertAdjacentHTML('beforeend', msgHTML);
                    }
                    document.getElementById('names_customer_cd').value = "";
                } else {
                    if (data['customer']['del_kbn'] === 1) {
                        let msgHTML = '<li>削除区分が有効になっているコードです。</li>';
                        alertArea.insertAdjacentHTML('beforeend', msgHTML);
                        document.getElementById('names_customer_cd').value = data['customer']['customer_name'];
                    }else{
                        alertArea.innerHTML = "";
                        document.getElementById('names_customer_cd').value = data['customer']['customer_name'];
                    }
                }
                if (null === data['delivery_destination'] || "" === data['delivery_destination']) {
                    if (data['new_delivery_destination_code']){
                        document.getElementById('input_delivery_cd').value = data['new_delivery_destination_code'];
                    }
                    document.getElementsByName('delivery_destination_name').item(0).value = "";
                    document.getElementsByName('delivery_destination_name_kana').item(0).value = "";
                    document.getElementsByName('honorific_kbn').item(0).checked = true;
                    document.getElementsByName('post_number').item(0).value = "";
                    document.getElementsByName('address').item(0).value = "";
                    document.getElementsByName('tel').item(0).value = "";
                    document.getElementsByName('tel').item(0).value = "";
                    document.getElementsByName('fax').item(0).value = "";
                    document.getElementsByName('representative_name').item(0).value = "";
                    document.getElementsByName('representative_mail').item(0).value = "";
                    document.getElementsByName('delivery_destination_manager_name').item(0).value = "";
                    document.getElementsByName('delivery_destination_manager_mail').item(0).value = "";
                    document.getElementsByName('delivery_destination_url').item(0).value = "";
                    document.getElementsByName('representative_mail').item(0).value = "";
                    document.getElementsByName('name_input_kbn').item(0).checked = true;
                    document.getElementsByName('del_kbn_delivery_destination').item(0).checked = true;
                    document.getElementsByName('delivery_price').item(0).value = "";
                    document.getElementsByName('hidden_detail_id').item(0).value = "";
                    document.getElementById('updateButton').dataset.delKbn = "";
                    document.getElementById('delete_button').disabled = true;
                    document.getElementById('prev_button').disabled = true;
                    document.getElementById('next_button').disabled = false;
                }else{
                    elements = document.getElementsByName('delivery_destination_name');
                    elements.item(0).value = data['delivery_destination']['delivery_destination_name'];
                    elements = document.getElementsByName('delivery_destination_name_kana');
                    elements.item(0).value = data['delivery_destination']['delivery_destination_name_kana'];
                    let elements_honorific_kbn = document.getElementsByName('honorific_kbn');
                    let len_honorific_kbn = elements_honorific_kbn.length;
                    for (let i = 0; i < len_honorific_kbn; i++) {
                        if (elements_honorific_kbn.item(i).value == data['delivery_destination']['honorific_kbn']) {
                            elements_honorific_kbn.item(i).checked = true;
                        }
                    }
                    document.getElementsByName('post_number').item(0).value = data['delivery_destination']['post_number'];
                    document.getElementsByName('address').item(0).value = data['delivery_destination']['address'];
                    document.getElementsByName('tel').item(0).value = data['delivery_destination']['tel'];
                    document.getElementsByName('tel').item(0).value = data['delivery_destination']['tel'];
                    document.getElementsByName('fax').item(0).value = data['delivery_destination']['fax'];
                    document.getElementsByName('representative_name').item(0).value = data['delivery_destination']['representative_name'];
                    document.getElementsByName('representative_mail').item(0).value = data['delivery_destination']['representative_mail'];
                    document.getElementsByName('delivery_destination_manager_name').item(0).value = data['delivery_destination']['delivery_destination_manager_name'];
                    document.getElementsByName('delivery_destination_manager_mail').item(0).value = data['delivery_destination']['delivery_destination_manager_mail'];
                    document.getElementsByName('delivery_destination_url').item(0).value = data['delivery_destination']['delivery_destination_url'];
                    document.getElementsByName('representative_mail').item(0).value = data['delivery_destination']['representative_mail'];
                    let elements_name_input_kbn = document.getElementsByName('name_input_kbn');
                    let len_name_input_kbn = elements_name_input_kbn.length;
                    for (let i = 0; i < len_name_input_kbn; i++) {
                        if (elements_name_input_kbn.item(i).value == data['delivery_destination']['name_input_kbn']) {
                            elements_name_input_kbn.item(i).checked = true;
                        }
                    }
                    let elements_del_kbn_delivery_destination = document.getElementsByName('del_kbn_delivery_destination');
                    let len_del_kbn_delivery_destination = elements_del_kbn_delivery_destination.length;
                    for (let i = 0; i < len_del_kbn_delivery_destination; i++) {
                        if (elements_del_kbn_delivery_destination.item(i).value == data['delivery_destination']['del_kbn_delivery_destination']) {
                            elements_del_kbn_delivery_destination.item(i).checked = true;
                        }
                    }
                    document.getElementsByName('delivery_price').item(0).value = data['delivery_destination']['delivery_price'];
                    document.getElementsByName('hidden_detail_id').item(0).value = data['delivery_destination']['id'];

                    document.getElementById('updateButton').dataset.delKbn = data['delivery_destination']['del_kbn_delivery_destination'];

                    document.getElementById('delete_button').disabled = false;
                    document.getElementById('prev_button').disabled = false;
                    document.getElementById('next_button').disabled = false;

                    minCode = data['minCode'];
                    maxCode = data['maxCode'];

                    // 最初の納品コードの場合は前頁を非表示
                    if(delivery_destination_cd == minCode){
                        document.getElementById('prev_button').disabled = true;
                    }

                    // 最後の納品コードの場合は次頁を非表示
                    if(delivery_destination_cd == maxCode){
                        document.getElementById('next_button').disabled = true;
                    }
                }
                if (null !== data['data']) {
                    //戻り値から得意先別納品先マスタを登録
                    //data['data']['del_kbn_customer'];    削除区分(得意先)
                    let elements = document.getElementsByName('del_kbn_customer');
                    let len = elements.length;
                    let checkValue = '';
                    for (let i = 0; i < len; i++) {
                        if (elements.item(i).value == 0) {
                            elements.item(i).checked = true;
                        }
                    }
                    //data['data']['sale_decision_print_paper_flg']    売上確定時印刷用紙フラグ
                    elements = document.getElementsByName('sale_decision_print_paper_flg');
                    len = elements.length;
                    checkValue = '';
                    for (let i = 0; i < len; i++) {
                        if (elements.item(i).value == data['data']['sale_decision_print_paper_flg']) {
                            elements.item(i).checked = true;
                        }
                    }
                    //data['data']['arrival_date_cd']    //着日定義ID
                    document.getElementsByName('def_arrival_date_cd').item(0).value = data['data']['arrival_date_cd'];
                    //data['data']['arrival_date_name']
                    document.getElementsByName('arrival_date_name').item(0).value = data['data']['arrival_date_name'];

                    //data['data']['direct_delivery_commission_demand_flg']   //直送手数料請求フラグ
                    elements = document.getElementsByName('direct_delivery_commission_demand_flg');
                    len = elements.length;
                    checkValue = '';
                    for (let i = 0; i < len; i++) {
                        if (elements.item(i).value == data['data']['direct_delivery_commission_demand_flg']) {
                            elements.item(i).checked = true;
                        }
                    }
                    //data['data']['root_cd']             ルートマスタコード
                    document.getElementsByName('mt_root_cd').item(0).value = data['data']['root_cd'];
                    //data['data']['root_name']           //ルートマスタ
                    document.getElementsByName('mt_root_name').item(0).value = data['data']['root_name'];
                    //運送会社マスタID
                    document.getElementsByName('mt_item_class1_cd').item(0).value = "";
                    //data['data']['item_class_name']     //運送会社マスタ
                    document.getElementsByName('item_class1_name').item(0).value = "";
                    //data['data']['delivery_destination_memo_1']  //納品先備考1
                    document.getElementsByName('delivery_destination_memo_1').item(0).value = data['data']['delivery_destination_memo_1']
                    //data['data']['delivery_destination_memo_2']  //納品先備考2
                    document.getElementsByName('delivery_destination_memo_2').item(0).value = data['data']['delivery_destination_memo_2']
                    //data['data']['delivery_destination_memo_3']  //納品先備考1
                    document.getElementsByName('delivery_destination_memo_3').item(0).value = data['data']['delivery_destination_memo_3']
                    //data['data']['register_kind_flg']            //登録種別フラグ
                    elements = document.getElementsByName('register_kind_flg');
                    len = elements.length;
                    checkValue = '';
                    for (let i = 0; i < len; i++) {
                        if (elements.item(i).value == data['data']['register_kind_flg']) {
                            elements.item(i).checked = true;
                        }
                    }
                }
                if (data['flg'] === 1) {
                    let msgHTML = '<li>登録済の得意先と納品先の組み合わせです。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                    //flag == 1 の場合は「削除区分」「ルートマスタ」のみ更新する
                    //data['data']['del_kbn_customer'];    削除区分(得意先)
                    let elements = document.getElementsByName('del_kbn_customer');
                    let len = elements.length;
                    let checkValue = '';
                    for (let i = 0; i < len; i++) {
                        if (elements.item(i).value == data['data']['del_kbn_customer']) {
                            elements.item(i).checked = true;
                        }
                    }
                    //運送会社マスタID
                    document.getElementsByName('mt_item_class1_cd').item(0).value = data['data']['item_class_cd']

                    //data['data']['item_class_name']     //運送会社マスタ
                    document.getElementsByName('item_class1_name').item(0).value = data['data']['item_class_name']
                } else if (data['flg'] === 0) {
                    let msgHTML = '<li>新規の得意先と納品先の組み合わせです。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                }
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

// !!!!!!!!!!!!未使用!!!!!!!!!!!!!!!!!
/* 補完関連　共通処理 納品先 リダイレクトあり */
// function eventBlurCodeautoDeliveryRedirect(event, element) {
//     const column = element.parentNode.cellIndex;  //行数
//     const tr = element.parentNode;
//     const row = tr.parentNode.sectionRowIndex;  //列数
//     //納品先
//     if (element.id.match('input_delivery_cd')) {
//         let data = [];
//         data.map(tag_key => params.append('key', 'val'));
//         const params = {
//             delivery_cd: element.value,
//         };
//         let query_params = new URLSearchParams(params);
//         // 管理用urlの上書き
//         const manageUrl = "../../../../code_auto/delivery_destination?" + query_params;
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
//                     document.getElementById('redirect').value = data.id;
//                     document.getElementById('redirect').click();
//                 } else {
//                     let msgHTML = '<li>新規データです。</li>';
//                     alertArea.insertAdjacentHTML('beforeend', msgHTML);
//                 }
//             })
//             .catch(error => {
//                 console.log(error); // エラー表示
//             });
//     }
// }

