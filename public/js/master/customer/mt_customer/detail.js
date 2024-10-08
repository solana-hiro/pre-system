window.onload = function() {
    checkSequentiallyKbn();
    checkBillingAddressCd();

    customer_url = document.getElementById('customer_url');
    eventBlurUrl(arguments[0], customer_url);

    input_manager = document.getElementById('input_manager');
    input_customer_class1 = document.getElementById('input_customer_class1');
    input_customer_class2 = document.getElementById('input_customer_class2');
    input_customer_class3 = document.getElementById('input_customer_class3');
    input_district_class = document.getElementById('input_district_class');
    input_pioneer = document.getElementById('input_pioneer');
    input_warehouse = document.getElementById('input_warehouse');
    input_root = document.getElementById('input_root');
    input_brand1 = document.getElementById('input_brand1');
    input_arrival_date = document.getElementById('input_arrival_date');
    input_slip_kind2 = document.getElementById('input_slip_kind2');

    blurCodeautoUser(arguments[0], input_manager);
    blurCodeautoCustomerClass(arguments[0], input_customer_class1);
    blurCodeautoCustomerClass(arguments[0], input_customer_class2);
    blurCodeautoCustomerClass(arguments[0], input_customer_class3);
    blurCodeautoDistrictClasse(arguments[0], input_district_class)
    blurCodeautoPioneerYear(arguments[0], input_pioneer)
    blurCodeautoWarehouse(arguments[0], input_warehouse)
    blurCodeautoRoot(arguments[0], input_root)
    blurCodeautoItemClass1(arguments[0], input_brand1)
    blurCodeautoArrivalDate(arguments[0], input_arrival_date)
    blurCodeautoSlipKind(arguments[0], input_slip_kind2)
}

/* 補完 開拓年分類 */
function blurCodeAutoBillingAddress(event, element) {
    //書き込み先の設定
    let alertArea = document.getElementById('alert-danger-ul-billing-address');
    let sequentially_kbns = document.getElementsByName('sequentially_kbn');

    let closing_date_1 = document.getElementById('closing_date_1');
    let closing_date_2 = document.getElementById('closing_date_2');
    let closing_date_3 = document.getElementById('closing_date_3');
    let collect_month_1 = document.getElementsByName('collect_month_1');
    let collect_month_2 = document.getElementsByName('collect_month_2');
    let collect_month_3 = document.getElementsByName('collect_month_3');
    let collect_month_1_txt = document.getElementById('collect_month_1_txt');
    let collect_month_2_txt = document.getElementById('collect_month_2_txt');
    let collect_month_3_txt = document.getElementById('collect_month_3_txt');
    let collect_date_1 = document.getElementById('collect_date_1');
    let collect_date_2 = document.getElementById('collect_date_2');
    let collect_date_3 = document.getElementById('collect_date_3');
    let credit_limit_amount = document.getElementById('credit_limit_amount');
    let price_fraction_process = document.getElementsByName('price_fraction_process');
    let all_amount_fraction_process = document.getElementsByName('all_amount_fraction_process');
    let tax_kbn = document.getElementsByName('tax_kbn');
    let tax_calculation_standard = document.getElementsByName('tax_calculation_standard');
    //「消費税端数処理（円）」
    let tax_fraction_process_yen = document.getElementsByName('tax_fraction_process_yen');
    //「消費税端数処理」
    let tax_fraction_process = document.getElementsByName('tax_fraction_process');
    let invoice_kind_flg = document.getElementsByName('invoice_kind_flg');
    let invoice_mailing_flg = document.getElementsByName('invoice_mailing_flg');
    let sale_decision_print_paper_flg = document.getElementsByName('sale_decision_print_paper_flg');


    if("" == element.value) {  //列数
        nameArea.innerHTML = "";
        alertArea.innerHTML = "";
        return;
    }
    element.value = element.value.toString().padStart(6, '0');
    const params = {
        billing_address_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/billing_address?" + query_params;
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
            console.log(data);
            // let hiddenArea = document.getElementById('hidden_root');
            alertArea.innerHTML = "";
            if (null !== data) {
                if( 1 == data['del_kbn']){
                    let msgHTML = '削除区分が有効になっているコードです';
                    alertArea.innerHTML = msgHTML;
                    element.value = "";
                    return;
                }
                if( null == data['customer_cd'] || "" == data['customer_cd']){
                    let msgHTML = 'この得意先を指定することはできません';
                    alertArea.innerHTML = msgHTML;
                    element.value = "";
                    return;
                }
                if( 1 == data['sequentially_kbn']){
                    let msgHTML = '随時締の得意先を指定することはできません';
                    alertArea.innerHTML = msgHTML;
                    element.value = "";
                    return;
                }else if( 0 == data['sequentially_kbn']){
                    sequentially_kbns[0].checked = true;
                }
                closing_date_1.value = data['closing_date_1'];
                closing_date_2.value = data['closing_date_2'];
                closing_date_3.value = data['closing_date_3'];
                if(!!data['collect_month_1'] && "" != data['collect_month_1']){
                    switch (data['collect_month_1']){
                        case 0:
                            collect_month_1[0].checked = true;
                            collect_month_1_txt.value = '';
                          break;
                        case 1:
                            collect_month_1[1].checked = true;
                            collect_month_1_txt.value = '';
                            break;
                        case 2:
                            collect_month_1[2].checked = true;
                            collect_month_1_txt.value = '';
                          break;
                        default:
                            collect_month_1[3].checked = true;
                            collect_month_1_txt.value = data['collect_month_1'];
                    }
                }
                if(!!data['collect_month_2'] && "" != data['collect_month_2']){
                    switch (data['collect_month_2']){
                        case 0:
                            collect_month_2[0].checked = true;
                            collect_month_2_txt.value = '';
                          break;
                        case 1:
                            collect_month_2[1].checked = true;
                            collect_month_2_txt.value = '';
                          break;
                        case 2:
                            collect_month_2[2].checked = true;
                            collect_month_2_txt.value = '';
                          break;
                        default:
                            collect_month_2[3].checked = true;
                            collect_month_2_txt.value = data['collect_month_2'];
                    }
                }
                if(!!data['collect_month_3'] && "" != data['collect_month_3']){
                    switch (data['closing_date_1']){
                        case 0:
                            collect_month_3[0].checked = true;
                            collect_month_3_txt.value = '';
                          break;
                        case 1:
                            collect_month_3[1].checked = true;
                            collect_month_3_txt.value = '';
                          break;
                        case 2:
                            collect_month_3[2].checked = true;
                            collect_month_3_txt.value = '';
                          break;
                        default:
                            collect_month_3[3].checked = true;
                            collect_month_3_txt.value = data['collect_month_3'];
                    }
                }

                collect_date_1.value = data['collect_date_1'];
                collect_date_2.value = data['collect_date_2'];
                collect_date_3.value = data['collect_date_3'];
                credit_limit_amount.value = data['credit_limit_amount'];
                addFigure(credit_limit_amount);

                if(!!data['price_fraction_process'] && "" != data['price_fraction_process']){
                    switch (data['price_fraction_process']){
                        case 0:
                            price_fraction_process[0].checked = true;
                          break;
                        case 5:
                            price_fraction_process[1].checked = true;
                          break;
                        case 9:
                            price_fraction_process[2].checked = true;
                          break;
                    }
                }
                if(!!data['all_amount_fraction_process'] && "" != data['all_amount_fraction_process']){
                    switch (data['all_amount_fraction_process']){
                        case 0:
                            all_amount_fraction_process[0].checked = true;
                          break;
                        case 5:
                            all_amount_fraction_process[1].checked = true;
                          break;
                        case 9:
                            all_amount_fraction_process[2].checked = true;
                          break;
                    }
                }

                if(!!data['tax_kbn'] && "" != data['tax_kbn']){
                    switch (data['tax_kbn']){
                        case 1:
                            tax_kbn[0].checked = true;
                          break;
                        case 2:
                            tax_kbn[1].checked = true;
                          break;
                    }
                }

                if(!!data['tax_calculation_standard'] && "" != data['tax_calculation_standard']){
                    switch (data['tax_calculation_standard']){
                        case 1:
                            tax_calculation_standard[0].checked = true;
                          break;
                        case 2:
                            tax_calculation_standard[1].checked = true;
                          break;
                        case 3:
                            tax_calculation_standard[2].checked = true;
                          break;
                        case 9:
                            tax_calculation_standard[3].checked = true;
                          break;
                    }
                }
                if(!!data['tax_fraction_process_yen'] && "" != data['tax_fraction_process_yen']){
                    switch (data['tax_fraction_process_yen']){
                        case 0:
                            tax_fraction_process_yen[0].checked = true;
                          break;
                        case 1:
                            tax_fraction_process_yen[1].checked = true;
                          break;
                        case 2:
                            tax_fraction_process_yen[2].checked = true;
                          break;
                    }
                }

                if(!!data['tax_fraction_process'] && "" != data['tax_fraction_process']){
                    switch (data['tax_fraction_process']){
                        case 0:
                            tax_fraction_process[0].checked = true;
                          break;
                        case 5:
                            tax_fraction_process[1].checked = true;
                          break;
                        case 9:
                            tax_fraction_process[2].checked = true;
                          break;
                    }
                }

                if(!!data['invoice_kind_flg'] && "" != data['invoice_kind_flg']){
                    switch (data['invoice_kind_flg']){
                        case 1:
                            invoice_kind_flg[0].checked = true;
                          break;
                        case 2:
                            invoice_kind_flg[1].checked = true;
                          break;
                    }
                }

                
                if(!!data['invoice_mailing_flg'] && "" != data['invoice_mailing_flg']){
                    switch (data['invoice_mailing_flg']){
                        case 1:
                            invoice_mailing_flg[0].checked = true;
                          break;
                        case 2:
                            invoice_mailing_flg[1].checked = true;
                          break;
                    }
                }

                
                if(!!data['sale_decision_print_paper_flg'] && "" != data['sale_decision_print_paper_flg']){
                    switch (data['sale_decision_print_paper_flg']){
                        case 1:
                            sale_decision_print_paper_flg[0].checked = true;
                          break;
                        case 2:
                            sale_decision_print_paper_flg[1].checked = true;
                          break;
                    }
                }
                checkBillingAddressCd()
            } else {
                let msgHTML = 'マスタに存在しません';
                alertArea.innerHTML = msgHTML;
                nameArea.innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

// 随時区分が随時の場合は非活性とする対応
function checkSequentiallyKbn() {
    let value = document.mt_customer_detail_form.sequentially_kbn.value;

    let closing_date_1 = document.getElementsByName("closing_date_1")[0];
    let closing_date_2 = document.getElementsByName("closing_date_2")[0];
    let closing_date_3 = document.getElementsByName("closing_date_3")[0];
    let collect_month_1 = document.getElementsByName("collect_month_1");
    let collect_month_2 = document.getElementsByName("collect_month_2");
    let collect_month_3 = document.getElementsByName("collect_month_3");
    let collect_month_1_txt = document.getElementsByName("collect_month_1_txt")[0];
    let collect_month_2_txt = document.getElementsByName("collect_month_2_txt")[0];
    let collect_month_3_txt = document.getElementsByName("collect_month_3_txt")[0];
    let collect_date_1 = document.getElementsByName("collect_date_1")[0];
    let collect_date_2 = document.getElementsByName("collect_date_2")[0];
    let collect_date_3 = document.getElementsByName("collect_date_3")[0];

    if(value == 0){
        closing_date_1.disabled = false;
        closing_date_2.disabled = false;
        closing_date_3.disabled = false;
        collect_month_1.forEach(ele => {
            ele.disabled = false;
        });
        collect_month_2.forEach(ele => {
            ele.disabled = false;
        });
        collect_month_3.forEach(ele => {
            ele.disabled = false;
        });
        collect_month_1_txt.disabled = false;
        collect_month_2_txt.disabled = false;
        collect_month_3_txt.disabled = false;
        collect_date_1.disabled = false;
        collect_date_2.disabled = false;
        collect_date_3.disabled = false;
    }else{
        closing_date_1.disabled = true;
        closing_date_2.disabled = true;
        closing_date_3.disabled = true;
        collect_month_1.forEach(ele => {
            ele.disabled = true;
        });
        collect_month_2.forEach(ele => {
            ele.disabled = true;
        });
        collect_month_3.forEach(ele => {
            ele.disabled = true;
        });
        collect_month_1_txt.disabled = true;
        collect_month_2_txt.disabled = true;
        collect_month_3_txt.disabled = true;
        collect_date_1.disabled = true;
        collect_date_2.disabled = true;
        collect_date_3.disabled = true;
    }
}

// 得意先コードと請求先コードが異なる場合は非活性とする対応
function checkBillingAddressCd() {
    let itemCd = document.getElementById("input_customer").value;
    let billingAddressCd = document.getElementById("input_billing_address").value;

    if(itemCd == billingAddressCd){
        enableRadioButton('sequentially_kbn');
        enableInputText('closing_date_1');
        enableInputText('closing_date_2');
        enableInputText('closing_date_3');
        enableRadioButton('collect_month_1');
        enableRadioButton('collect_month_2');
        enableRadioButton('collect_month_3');
        enableInputText('collect_month_1_txt');
        enableInputText('collect_month_2_txt');
        enableInputText('collect_month_3_txt');
        enableInputText('collect_date_1');
        enableInputText('collect_date_2');
        enableInputText('collect_date_3');
        enableInputText('credit_limit_amount');
        enableRadioButton('price_fraction_process');
        enableRadioButton('all_amount_fraction_process');
        enableRadioButton('tax_kbn');
        enableRadioButton('tax_calculation_standard');
        enableRadioButton('tax_fraction_process_yen');
        enableRadioButton('tax_fraction_process');
        enableRadioButton('invoice_kind_flg');
        enableRadioButton('invoice_mailing_flg');
        enableRadioButton('sale_decision_print_paper_flg');

    }else{
        disableRadioButton('sequentially_kbn');
        disableInputText('closing_date_1');
        disableInputText('closing_date_2');
        disableInputText('closing_date_3');
        disableRadioButton('collect_month_1');
        disableRadioButton('collect_month_2');
        disableRadioButton('collect_month_3');
        disableInputText('collect_month_1_txt');
        disableInputText('collect_month_2_txt');
        disableInputText('collect_month_3_txt');
        disableInputText('collect_date_1');
        disableInputText('collect_date_2');
        disableInputText('collect_date_3');
        disableInputText('credit_limit_amount');
        disableRadioButton('price_fraction_process');
        disableRadioButton('all_amount_fraction_process');
        disableRadioButton('tax_kbn');
        disableRadioButton('tax_calculation_standard');
        disableRadioButton('tax_fraction_process_yen');
        disableRadioButton('tax_fraction_process');
        disableRadioButton('invoice_kind_flg');
        disableRadioButton('invoice_mailing_flg');
        disableRadioButton('sale_decision_print_paper_flg');
    }
}

const enableRadioButton = (name) => {
    document.getElementsByName(name).forEach((el) => {
      el.disabled = false;
    });
  }

  const disableRadioButton = (name) => {
    document.getElementsByName(name).forEach((el) => {
      if(!el.checked) el.disabled = true;
    });
  }

  const enableInputText = (name) => {
    document.getElementsByName(name)[0].readOnly = false;
  }

  const disableInputText = (name) => {
    document.getElementsByName(name)[0].readOnly = true;
  }
/* 補完 2桁パディング */
function blurAutoPad2(event, element) {
    if("" !== element.value) {
        element.value = element.value.toString().padStart(2, '0');
    }
}
/* 補完 4桁パディング */
function blurAutoPad4(event, element) {
    if("" !== element.value) {
        element.value = element.value.toString().padStart(4, '0');
    }
}

/* 補完 6桁パディング */
function blurAutoPad6(event, element) {
    if("" !== element.value) {
        element.value = element.value.toString().padStart(6, '0');
    }
}
// 日付補完
const autoCompleteDate = (e) => {
    if (e.target.readOnly) return;
    if (!e.target.value) return;

    const date = Number(e.target.value);
    ((1 <= date && date <= 27) || date === 99)
      ? e.target.value = e.target.value.padStart(2, '0')
      : e.target.value = '99';
}

// 〇ヵ月後
const blurCollectMonth = (e) => {
    if (!e.target.value) return;
    const monthRadioName = e.target.name.replace(/_txt/g, '');
    const month = Number(e.target.value);
    // monthRadio = document.getElementsByName(monthRadioName)[0];
    const monthRadios = document.querySelectorAll(`input[name=${monthRadioName}]`);
    if(month < 3){
        monthRadios[month].checked = true;
        e.target.value = "";
    }else{
        monthRadios[3].checked = true;
    }
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


/* 削除区分（得意先）変更時 */
function changeDelKbnCustomer(event, element) {
    document.getElementById('updateButton').dataset.delKbn = element.value;
}

/* 補完 担当者 */
function blurCodeautoUser(event, element) {
    //書き込み先の設定
    let alertArea = document.getElementById('alert-danger-ul-manager');
    let nameArea = document.getElementById('names_manager');
    if("" == element.value) {  //列数
        nameArea.innerHTML = "";
        alertArea.innerHTML = "";
        return;
    }
    element.value = element.value.toString().padStart(4, '0');
    let data = [];
    const params = {
        user_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/user?" + query_params;
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
            // let hiddenArea = document.getElementById('hidden_root');
            alertArea.innerHTML = "";
            if (null !== data) {
                nameArea.innerHTML = data['user_name'];
            } else {
                let msgHTML = '担当者マスタの登録を行ってください';
                alertArea.innerHTML = msgHTML;
                nameArea.innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 補完 販売パターン1 */
/* 検索関連フィルタ　共通処理 得意先分類 */
function blurCodeautoCustomerClass(event, element) {
    if (element.id.match('customer_class1')) {
        nameArea = document.getElementById('names_customer_class1');
        alertArea = document.getElementById('alert-danger-ul-customer-class1');
        thing_id = 1;
    } else if (element.id.match('customer_class2')) {
        nameArea = document.getElementById('names_customer_class2');
        alertArea = document.getElementById('alert-danger-ul-customer-class2');
        thing_id = 2;
    } else if (element.id.match('customer_class3')) {
        nameArea = document.getElementById('names_customer_class3');
        alertArea = document.getElementById('alert-danger-ul-customer-class3');
        thing_id = 3;
    }
    // 得意先分類
    if (null === element.value || "" === element.value) {
        nameArea.innerHTML = "";
        alertArea.innerHTML = "";
        return false;
    }

    const params = {
        customer_class_cd: element.value,
        def_customer_class_thing_id: thing_id,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/customer_class?" + query_params;
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
            // onload 時に連続で実行するためこちらで再定義する必要がある
            if (element.id.match('customer_class1')) {
                nameArea = document.getElementById('names_customer_class1');
                alertArea = document.getElementById('alert-danger-ul-customer-class1');
                thing_id = 1;
                msgHTML = '販売パターン1の登録を行ってください';
            } else if (element.id.match('customer_class2')) {
                nameArea = document.getElementById('names_customer_class2');
                alertArea = document.getElementById('alert-danger-ul-customer-class2');
                thing_id = 2;
                msgHTML = '業種・特徴2の登録を行ってください';
            } else if (element.id.match('customer_class3')) {
                nameArea = document.getElementById('names_customer_class3');
                alertArea = document.getElementById('alert-danger-ul-customer-class3');
                thing_id = 3;
                msgHTML = 'ランク3の登録を行ってください';
            }
            alertArea.innerHTML = "";
            if (null !== data) {
                nameArea.innerHTML = data['customer_class_name'];
            } else {
                alertArea.innerHTML = msgHTML;
                nameArea.value = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 補完 地区分類 */
function blurCodeautoDistrictClasse(event, element) {
    //書き込み先の設定
    let alertArea = document.getElementById('alert-danger-ul-district-class');
    let nameArea = document.getElementById('names_district_class');
    if("" == element.value) {  //列数
        nameArea.innerHTML = "";
        alertArea.innerHTML = "";
        return;
    }
    element.value = element.value.toString().padStart(4, '0');
    let data = [];
    const params = {
        district_class_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/district_classe?" + query_params;
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
            // let hiddenArea = document.getElementById('hidden_root');
            alertArea.innerHTML = "";
            if (null !== data) {
                nameArea.innerHTML = data['district_class_name'];
            } else {
                let msgHTML = '地区分類定義の登録を行ってください';
                alertArea.innerHTML = msgHTML;
                nameArea.innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 補完 開拓年分類 */
function blurCodeautoPioneerYear(event, element) {
    //書き込み先の設定
    let alertArea = document.getElementById('alert-danger-ul-pioneer-year');
    let nameArea = document.getElementById('names_pioneer');
    if("" == element.value) {  //列数
        nameArea.innerHTML = "";
        alertArea.innerHTML = "";
        return;
    }
    element.value = element.value.toString().padStart(4, '0');
    let data = [];
    const params = {
        pioneer_year_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/pioneer_year?" + query_params;
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
            // let hiddenArea = document.getElementById('hidden_root');
            alertArea.innerHTML = "";
            if (null !== data) {
                nameArea.innerHTML = data['pioneer_year_name'];
            } else {
                let msgHTML = '開拓年分類定義の登録を行ってください';
                alertArea.innerHTML = msgHTML;
                nameArea.innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 補完 受注倉庫 */
function blurCodeautoWarehouse(event, element) {
    //書き込み先の設定
    let alertArea = document.getElementById('alert-danger-ul-warehouse');
    let nameArea = document.getElementById('names_warehouse');
    if("" == element.value) {  //列数
        nameArea.innerHTML = "";
        alertArea.innerHTML = "";
        return;
    }
    element.value = element.value.toString().padStart(6, '0');
    const params = {
        warehouse_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    const manageUrl = "../../../../code_auto/warehouse?" + query_params;
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
                nameArea.innerHTML = data['warehouse_name'];
            } else {
                let msgHTML = '倉庫マスタの登録を行ってください';
                alertArea.innerHTML = msgHTML;
                nameArea.innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 補完 ルート */
function blurCodeautoRoot(event, element) {
    //書き込み先の設定
    let alertArea = document.getElementById('alert-danger-ul-root');
    let nameArea = document.getElementById('names_root');
    if("" == element.value) {  //列数
        nameArea.innerHTML = "";
        alertArea.innerHTML = "";
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
            // let hiddenArea = document.getElementById('hidden_root');
            alertArea.innerHTML = "";
            if (null !== data) {
                nameArea.innerHTML = data['root_name'];
            } else {
                let msgHTML = 'ルートマスタの登録を行ってください';
                alertArea.innerHTML = msgHTML;
                nameArea.innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 補完 運送会社 */
function blurCodeautoItemClass1(event, element) {
    let alertArea = document.getElementById('alert-danger-ul-item-class1');
    let nameArea = document.getElementById('names_brand1');

    if("" == element.value) { 
        nameArea.innerHTML = "";
        alertArea.innerHTML = "";
        return;
    }

    if("800000" > element.value || "819999" < element.value){
        let msgHTML = '入力範囲：800000～819999です。';
        alertArea.innerHTML = msgHTML;
        nameArea.innerHTML = "";
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
                nameArea.innerHTML = data['item_class_name'];
            } else {
                let msgHTML = '商品分類１マスタの登録を行ってください';
                alertArea.innerHTML = msgHTML;
                nameArea.innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 納品先着日  */
function blurCodeautoArrivalDate(event, element) {
    //書き込み先の設定
    let alertArea = document.getElementById('alert-danger-ul-arrival-date');
    let nameArea = document.getElementById('names_arrival_date');

    if("" == element.value) {  //列数
        nameArea.innerHTML = "";
        alertArea.innerHTML = "";
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
            // let hiddenArea = document.getElementById('hidden_root');
            alertArea.innerHTML = "";
            if (null !== data) {
                nameArea.innerHTML = data['arrival_date_name'];
            } else {
                let msgHTML = '着日定義の登録を行ってください';
                alertArea.innerHTML = msgHTML;
                nameArea.innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 補完 付箋（特記事項）コード */
function blurAutosOrderReceiveStickyNote(event, element) {
    let colorArea = document.getElementById('hidden_order_receive_sticky_note_color');
    if("" == colorArea.value) {
        element.style.backgroundColor = "#FFFFFF";
        return;
    }
    element.style.backgroundColor = colorArea.value;
}

/* 補完関連　共通処理 得意先 リダイレクトあり */
function eventBlurCodeautoCustomerRedirect(event, element) {
    if("" == element.value) {
        return;
    }
    const column = element.parentNode.cellIndex;  //行数
    const tr = element.parentNode;
    const row = tr.parentNode.sectionRowIndex;  //列数
    //書き込み先の設定
    let alertArea = document.getElementById('alert-danger-ul');
    let billingAddressCd = document.getElementById('input_billing_address');

    element.value = element.value.toString().padStart(6, '0');

    if (element.id.match('customer')) {
        // let data = [];
        // data.map(tag_key => params.append('key', 'val'));
        const params = {
            customer_cd: element.value,
        };
        let query_params = new URLSearchParams(params);
        // 管理用urlの上書き
        const manageUrl = "../../../../code_auto/customer?" + query_params;
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
                    let msgHTML = '<li>新規データです。</li>';
                    alertArea.insertAdjacentHTML('beforeend', msgHTML);
                    billingAddressCd.value = element.value;
                    customerManagerClear();
                    checkBillingAddressCd();
                }
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
    }
}

/* 補完 売上伝票種別 */
function blurCodeautoSlipKind(event, element) {
    let alertArea = document.getElementById('alert-danger-ul-slip_kind2');
    let nameArea = document.getElementById('names_slip_kind2');

    if("" == element.value) {  //列数
        nameArea.innerHTML = "";
        alertArea.innerHTML = "";
        return;
    }
    element.value = element.value.toString().padStart(3, '0');

    const params = {
        slip_kind_cd: element.value,
        slip_kind_kbn_cd: '02',
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/slip_kind?" + query_params;
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
                nameArea.innerHTML = data['slip_kind_name'];
            } else {
                let msgHTML = '売上伝票種別の登録を行ってください';
                alertArea.innerHTML = msgHTML;
                nameArea.innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

/* 担当者編集 */
// 行追加
function customerManagerAddLine() {
    var table1 = document.getElementById("grid_table");
    var trs = $('#grid_table tbody tr');
    // 最終行のクローン取得
    var lastTr = trs[trs.length - 1];
    var td = $(lastTr).children();

    var row = table1.tBodies[0].insertRow(-1);
    row.innerHTML = customerManagerHTML();
}

/* 担当者編集 */
// 情報のクリア
function customerManagerClear() {
    var table1 = document.getElementById("grid_table");
    var trs = $('#grid_table tbody tr');
    // 最終行のクローン取得
    const length = trs.length;
    for(i=0;i < length; i++){
        trs[i].remove();
    }

    // 空行を2行追加
    var row1 = table1.tBodies[0].insertRow(-1);
    row1.innerHTML = customerManagerHTML();
    var row2 = table1.tBodies[0].insertRow(-1);
    row2.innerHTML = customerManagerHTML();
}

/* 担当者編集 */
// 行削除
function removeManager(element) {
    let parent = element.parentNode.parentNode;
    // if(parent.previousElementSibling){
        parent.remove();
    // }
}

function customerManagerHTML() {
    return [
        '<tr>',
        '    <td class="grid_wrapper_center td_100px"></td>',
        '    <td class="grid_col_2 col_rec ">',
        '        <input type="text" name="customer_manager_cd[]"',
        '            class="readonly-input"',
        '            value="" readonly />',
        '    </td>',
        '    <td class="grid_col_2 col_rec">',
        '        <input type="text" name="customer_manager_name[]"',
        '            class="readonly-input"',
        '            value="" readonly />',
        '    </td>',
        '    <td class="grid_col_2 col_rec">',
        '        <input type="text" name="customer_manager_mail[]"',
        '            class="readonly-input"',
        '            value="" readonly />',
        '    </td>',
        '    <td class="grid_col_2 col_rec">',
        '        <input type="text" name="ec_login_id[]" class="readonly-input"',
        '            value="" readonly />',
        '    </td>',
        '    <td class="grid_col_2 col_rec"></td>',
        '    <td class="grid_col_1 col_rec">',
        '        <input name="send_password_flg[]" type="hidden"',
        '            value="">',
        '        <input type="checkbox" name="send_password_flg_check" value="1"',
        '            onclick="return false;"',
        '        >',
        '    </td>',
        '    <td class="grid_col_1 col_rec">',
        '        <input name="validity_flg[]" type="hidden"',
        '            value="">',
        '        <input type="checkbox" name="" value="1"',
        '            onclick="return false;"',
        '        >',
        '    </td>',
        '    <td class="grid_col_2 col_rec">',
        '        <input type="text" name="customer_memo[]" class="readonly-input"',
        '            value="" readonly />',
        '    </td>',
        '    <input type="hidden" name="display_order[]"',
        '        value="">',
        '    <input type="hidden" name="ec_login_password[]"',
        '        value="">',
        '    <input type="hidden" name="change_password_flg[]"',
        '        value="">',
        '    <input type="hidden" name="manager_id[]" value="">',
        '    <td class="grid_col_1 col_rec">',
        '        <button type="button" data-toggle="modal"',
        '            data-target="#modal_manager" data-value=""',
        '            class="div-wrapper display_none" data-url="" name="">',
        '            <img src="/img/icon/edit.svg" class="img_center">',
        '        </button>',
        '    </td>',
        '    <td class="grid_col_1 col_rec">',
        '        <button type="button" onclick="removeManager(this)"',
        '            class="div-wrapper display_none" name="delete">',
        '            <img src="/img/icon/trash.svg" class="img_center">',
        '        </button>',
        '    </td>',
        '</tr>',
    ].join('');
}