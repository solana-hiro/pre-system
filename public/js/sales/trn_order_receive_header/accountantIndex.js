const activeClass = 'is-active';

let overlayList = [];
let overLayZIndex = 9001;
let modalZIndex = 9002;

let customerInfo = null;
let orderReceiveDetails = {};
let stock_order_line_no_val = 0;

initialization();

function initialization() {
    setTimeout(() => {
        if (default_mt_customer_id) {
            codeautoCustomerUpdate(default_mt_customer_id)
        }
        if (default_mt_delivery_destination_id) {
            codeautoDeliveryDestination(default_mt_delivery_destination_id)
        }
        if (default_mt_warehouse_id) {
            codeAutoWareHouseChange(default_mt_warehouse_id)
        }
    }, 2000)
}

function addClassList(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.add(activeClass);
    modal.style.zIndex = modalZIndex;
    modalZIndex++;
}

function appendOverlay() {
    const overlay = document.createElement('div');
    overlay.classList.add('overlay_gray');
    overlay.style.zIndex = overLayZIndex;
    document.body.appendChild(overlay);
    overlayList.push(overlay);
    overLayZIndex++;
}

function removeClassList(el) {
    const modal = el.closest('.modal-box');
    modal.classList.remove(activeClass);
    modal.style.zIndex = null;
    modalZIndex--;
}

function removeOverlay()  {
    const overlay = overlayList.pop();
    document.body.removeChild(overlay);
    overLayZIndex--;
}

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
    const params = {
        user_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../code_auto/user?" + query_params;

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

function codeautoCustomerUpdate(value) {
    let alertArea = document.getElementById('alert-danger-customer');
    let nameArea = document.getElementById('customer_name');
    let nameKbnArea = document.getElementById('name_input_kbn');
    let stickyNoteArea = document.getElementById('sticky_note_name');
    let customerManager = document.getElementById('customer_manager');
    if("" == value) {  //列数
        nameArea.value = "";
        nameKbnArea.value = "";
        alertArea.innerHTML = "";
        stickyNoteArea.innerHTML = "";
        customerManager.innerHTML = "";
        return;
    }
    value = value.toString().padStart(6, '0');
    const params = {
        customer_cd: value,
        with_sticky_note: 1,
        with_customer_manager: 1,
        with_billing_address: 1
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../code_auto/customer?" + query_params;

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
                customerInfo = data
                nameArea.value = data['customer_name'];
                nameKbnArea.value = data['name_input_kbn'];
                stickyNoteArea.innerHTML = data['mt_order_receive_sticky_note'] ? data['mt_order_receive_sticky_note']['sticky_note_name'] : '';
                if (data['mt_order_receive_sticky_note']) stickyNoteArea.style.backgroundColor = data['mt_order_receive_sticky_note'];

                let mtCustomerManagers = data['mt_customer_managers'];
                console.log(mtCustomerManagers, 'mtCustomerManagers')
                for (let i = 0; i < mtCustomerManagers.length; i++) {
                    let mtCustomerManager = mtCustomerManagers[i];
                    let manager = mtCustomerManager['mt_manager'];
                    if (manager) {
                        // option要素を生成
                        let option = document.createElement('option');
                        option.value = manager['id'];
                        option.textContent = manager['manager_name'];
                        // select要素にoption要素を追加
                        customerManager.appendChild(option);
                    }
                }
            } else {
                let msgHTML = '得意先マスタの登録を行ってください';
                alertArea.innerHTML = msgHTML;
                nameArea.innerHTML = "";
                stickyNoteArea.innerHTML = "";
                customerManager.innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

function blurCodeautoCustomer(event, element) {
    codeautoCustomerUpdate(element.value)
}

function codeautoDeliveryDestination(value) {
    let alertArea = document.getElementById('alert-danger-delivery-destination');
    let nameArea = document.getElementById('delivery_destination_name');
    let deliveryDestinationNameArea = document.getElementById('delivery_destination_name_input_kbn');
    if("" == value) {  //列数
        nameArea.innerHTML = "";
        alertArea.innerHTML = "";
        return;
    }
    value = value.toString().padStart(6, '0');
    const params = {
        delivery_destination_id: value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../code_auto/delivery_destination?" + query_params;

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
                nameArea.innerHTML = data['delivery_destination_name'];
                deliveryDestinationNameArea.value = data['name_input_kbn'];
            } else {
                let msgHTML = '納品先マスタの登録を行ってください';
                alertArea.innerHTML = msgHTML;
                nameArea.innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

function blurCodeautoDeliveryDestination(event, element) {
    codeautoDeliveryDestination(element.value)
}

function codeAutoWareHouseChange(value) {
    let alertArea = document.getElementById('alert-danger-warehouse');
    let nameArea = document.getElementById('warehouse_name');
    if("" == value) {  //列数
        nameArea.innerHTML = "";
        alertArea.innerHTML = "";
        return;
    }
    value = value.toString().padStart(6, '0');
    const params = {
        warehouse_cd: value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../code_auto/warehouse?" + query_params;

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
                let msgHTML = '納品先マスタの登録を行ってください';
                alertArea.innerHTML = msgHTML;
                nameArea.innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

function blurCodeAutoWareHouse(event, element) {
    codeAutoWareHouseChange(element.value)
}

function downloadExcel() {
    let specify_deadline_from_year = document.getElementById('specify_deadline_from-year')?.value;
    let specify_deadline_from_month = document.getElementById('specify_deadline_from-month')?.value;
    let specify_deadline_from_date = document.getElementById('specify_deadline_from-date')?.value;
    let specify_deadline_to_year = document.getElementById('specify_deadline_to-year')?.value;
    let specify_deadline_to_month = document.getElementById('specify_deadline_to-month')?.value;
    let specify_deadline_to_date = document.getElementById('specify_deadline_to-date')?.value;

    // URLパラメータの値を取得
    const specify_deadline_from = specify_deadline_from_year + '-' + specify_deadline_from_month + '-' + specify_deadline_from_date;
    const specify_deadline_to = specify_deadline_to_year + '-' + specify_deadline_to_month + '-' + specify_deadline_to_date;

    // クエリパラメータを組み立て
    const queryParams = `?specify_deadline_from=${encodeURIComponent(specify_deadline_from)}&specify_deadline_to=${encodeURIComponent(specify_deadline_to)}`;

    // fetchを使用して非同期でダウンロードリクエストを送信
    fetch('/sales_management/order_receive/payment_guidance_excel' + queryParams, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.blob();  // ファイルのBlobを取得
        })
        .then(blob => {
            const url = window.URL.createObjectURL(new Blob([blob]));
            const a = document.createElement('a');
            a.href = url;
            a.download = '入金案内書.xlsx';  // ダウンロードファイル名を指定
            document.body.appendChild(a);
            a.click();
            a.remove();  // ダウンロードが完了したらリンクを削除
            // payment_guidance_flgにチェックを入れる
            document.getElementById('payment_guidance_flg').checked = true;
            removeOverlay()
            removeClassList('partial_deposit_information');
        })
        .catch(error => {
            console.error('There was an error with the fetch operation:', error);
        });
}

function paymentGuidanceShow() {
    const selectedRadio = document.querySelector('input[name="payment_guidance_kbn"]:checked');

    if (selectedRadio) {
        const selectedRadioValue = selectedRadio.value;
        if (selectedRadioValue === '0') {
            return;
        } else if (selectedRadioValue === '1') {
            appendOverlay();
            addClassList('partial_deposit_information');
        } else if (selectedRadioValue === '2') {
            downloadExcel()
        }
    } else {
        return;
    }
}

function shortageGuidanceDownload() {
    fetch('/sales_management/order_receive/shortage_guidance_excel', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.blob();  // ファイルのBlobを取得
        })
        .then(blob => {
            const url = window.URL.createObjectURL(new Blob([blob]));
            const a = document.createElement('a');
            a.href = url;
            a.download = '欠品案内書.xlsx';  // ダウンロードファイル名を指定
            document.body.appendChild(a);
            a.click();
            a.remove();  // ダウンロードが完了したらリンクを削除
            // payment_guidance_flgにチェックを入れる
            document.getElementById('shortage_guidance_flg').checked = true;
        })
        .catch(error => {
            console.error('There was an error with the fetch operation:', error);
        });
}

function shippingGuidanceDownload() {
    fetch('/sales_management/order_receive/shipping_guidance_excel', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.blob();  // ファイルのBlobを取得
        })
        .then(blob => {
            const url = window.URL.createObjectURL(new Blob([blob]));
            const a = document.createElement('a');
            a.href = url;
            a.download = '出荷案内書.xlsx';  // ダウンロードファイル名を指定
            document.body.appendChild(a);
            a.click();
            a.remove();  // ダウンロードが完了したらリンクを削除
            // payment_guidance_flgにチェックを入れる
            document.getElementById('shipping_guidance_flg').checked = true;
        })
        .catch(error => {
            console.error('There was an error with the fetch operation:', error);
        });
}

function keepGuidanceDownload() {
    fetch('/sales_management/order_receive/keep_guidance_excel', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.blob();  // ファイルのBlobを取得
        })
        .then(blob => {
            const url = window.URL.createObjectURL(new Blob([blob]));
            const a = document.createElement('a');
            a.href = url;
            a.download = 'KEEP案内書.xlsx';  // ダウンロードファイル名を指定
            document.body.appendChild(a);
            a.click();
            a.remove();  // ダウンロードが完了したらリンクを削除
            // payment_guidance_flgにチェックを入れる
            document.getElementById('keep_guidance_flg').checked = true;
        })
        .catch(error => {
            console.error('There was an error with the fetch operation:', error);
        });
}

function blurItemCdChange(event, element) {
    const value = element.value;
    const tr = element.closest('tr');
    // このtrの次のtrを取得する
    const nextTr = tr.nextElementSibling;
    const no = tr.getElementsByClassName('detail_id')[0].textContent;

    const params = {
        item_cd: value,
        customer_cd: customer_cd
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../code_auto/item?" + query_params;

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
            console.log(data, customerInfo, '123123123123')
            // orderReceiveDetailsに noをkeyにしてdataを格納する
            orderReceiveDetails[no] = data;
            // trのtdの中でクラスがnon_tax_kbnのもののテキストを更新する
            let non_tax_kbn = tr.getElementsByClassName('non_tax_kbn')[0];
            non_tax_kbn.textContent = data['non_tax_kbn'] === '0' ? '課税' : '非課税';
            let item_name = nextTr.getElementsByClassName('item_name')[0];
            item_name.value = data.item_name;

            if (customerInfo) {
                let retail_price_tax = tr.getElementsByClassName('retail_price_tax')[0];
                const tax_kbn = customerInfo.mt_billing_address.tax_kbn
                let price_rate_input = tr.getElementsByClassName('price_rate_input')[0]
                const price_rate = customerInfo.price_rate
                price_rate_input.value = price_rate
                let order_receive_price = tr.getElementsByClassName('order_receive_price')[0]
                let unit_td = nextTr.getElementsByClassName('unit')[0]
                let profit_calculation_cost_price = nextTr.getElementsByClassName('profit_calculation_cost_price')[0]
                let tax_fee = 0;
                let order_receive_price_value = 0;
                if (tax_kbn === 1) {
                    tax_fee = data.retail_price_tax_out
                    order_receive_price_value = data.retail_price_tax_out * price_rate / 100
                } else {
                    tax_fee = data.retail_price_tax_in
                    order_receive_price_value = data.retail_price_tax_in * price_rate / 100
                }
                // currencyのformatterする
                retail_price_tax.value = `${tax_fee.toLocaleString()}`;
                order_receive_price.value = `${order_receive_price_value.toLocaleString()}`;
                unit_td.textContent = data.unit;
                profit_calculation_cost_price.value = `${data.profit_calculation_cost_price.toLocaleString()}`;

                if (tax_kbn === 1) {
                    tax_fee = data.retail_price_tax_out
                    if (value == '850000000') {
                        order_receive_price.value = tax_fee
                    }
                } else {
                    tax_fee = data.retail_price_tax_in
                    if (value == '850000000') {
                        order_receive_price.value = tax_fee
                    }
                }
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

function blurPriceRate(event, element) {
    const value = element.value;
    const tr = element.closest('tr');
    const no = tr.getElementsByClassName('detail_id')[0].textContent;
    if (customerInfo) {
        let item = orderReceiveDetails[no];
        let retail_price_tax = tr.getElementsByClassName('retail_price_tax')[0];
        let order_receive_price = tr.getElementsByClassName('order_receive_price')[0]
        const tax_kbn = customerInfo.mt_billing_address.tax_kbn
        let tax_fee = 0;
        let order_receive_price_value = 0;
        if (tax_kbn === 1) {
            tax_fee = item.retail_price_tax_out
            order_receive_price_value = item.retail_price_tax_out * value / 100
        } else {
            tax_fee = item.retail_price_tax_in
            order_receive_price_value = item.retail_price_tax_in * value / 100
        }
        // currencyのformatterする
        retail_price_tax.value = `${tax_fee.toLocaleString()}`;
        order_receive_price.value = `${order_receive_price_value.toLocaleString()}`;
        updateTableValue(event, element)
    }
}

function updateTableValue(event, element) {
    const tr = element.closest('tr');
    const detail_id_td = tr.getElementsByClassName('detail_id')[0];
    let prevTr = null
    let nextTr = null
    if (detail_id_td) {
        prevTr = tr
        nextTr = tr.nextElementSibling
    } else {
        prevTr = tr.previousElementSibling
        nextTr = tr
    }
    if (customerInfo) {
        const item_kbn = prevTr.getElementsByClassName('item_kbn')[0]
        const price_rate_input = prevTr.getElementsByClassName('price_rate_input')[0]
        const price_rate_input_val = parseInt(price_rate_input.value.replace(',', ''))
        const retail_price_tax_input = prevTr.getElementsByClassName('retail_price_tax')[0]
        const retail_price_tax_input_val = parseInt(retail_price_tax_input.value.replace(',', ''))
        const order_receive_price_input = prevTr.getElementsByClassName('order_receive_price')[0]
        order_receive_price_input.value = price_rate_input_val * retail_price_tax_input_val / 100
        const order_receive_amount_input = prevTr.getElementsByClassName('order_receive_amount')[0]
        const cost_amount = nextTr.getElementsByClassName('cost_amount')[0]
        const order_receive_quantity_input = nextTr.getElementsByClassName('order_receive_quantity')[0]
        const order_receive_quantity_input_val = order_receive_quantity_input.value

        if (item_kbn.value === '0' || item_kbn.value === '1' || item_kbn.value === '2') {
            order_receive_amount_input.value = order_receive_price_input.value * order_receive_quantity_input_val
            // order_receive_amount_inputのdisabledにtrue設定する
            order_receive_amount_input.readOnly = true
        } else {
            order_receive_amount_input.readOnly = false
        }

        cost_amount.value = order_receive_quantity_input_val * nextTr.getElementsByClassName('profit_calculation_cost_price')[0].value
    }
}

function itemKbnChange(element) {
    const item_kbn = element.value
    const tr = element.closest('tr');
    const order_receive_amount_input = tr.getElementsByClassName('order_receive_amount')[0]
    if (item_kbn == '1' || item_kbn == '2' || item_kbn == '3') {
        order_receive_amount_input.readOnly = true
    } else {
        order_receive_amount_input.readOnly = false
    }
}

function updateTotalReceiveQuantity() {
    const table_body = document.getElementById('table_body');
    const trs = table_body.children;
    let totalOrderReceiveQuantity = 0;
    for (let i = 0; i < trs.length; i++) {
        if (i % 2 === 1) {
            const tr = trs[i];
            const order_receive_quantity = tr.getElementsByClassName('order_receive_quantity')[0];
            totalOrderReceiveQuantity += order_receive_quantity.value ? parseInt(order_receive_quantity.value) : 0;
        }
    }
    document.getElementById('total_order_receive_quantity').value = totalOrderReceiveQuantity;
}

function updatePostageValue() {
    const table_body = document.getElementById('table_body');
    const trs = table_body.children;
    let totalPostage = 0;
    let totalAmount = 0;
    for (let i = 0; i < trs.length; i++) {
        if (i % 2 === 0) {
            const tr = trs[i];
            const order_receive_amount = tr.getElementsByClassName('order_receive_amount')[0];
            const item_kbn = tr.getElementsByClassName('item_kbn')[0];
            if (item_kbn.value == '4') {
                totalPostage += order_receive_amount.value ? parseInt(order_receive_amount.value.replace(',', '')) : 0;
            }
            totalAmount += order_receive_amount.value ? parseInt(order_receive_amount.value.replace(',', '')) : 0;
        }
    }
    document.getElementById('total_postage').value = totalPostage.toLocaleString();
    // format
    document.getElementById('total_order_receive_amount').value = totalAmount.toLocaleString();
}

function orderReceiveQuantityChange(event, element) {
    updateTableValue(event, element)
    updateTotalReceiveQuantity()
    updatePostageValue()
}

function orderReceivePriceChange(event, element) {
    updateTableValue(event, element)
    updatePostageValue()
}

// 受注明細削除
function deleteTableRow(element) {
    const tr = element.closest('tr');
    const nextTr = tr.nextElementSibling;
    const tbody = tr.closest('tbody');

    // trのdetail_idを整備する
    let trs = tbody.children;
    if (trs.length <= 2) {
        return
    }

    // tbodyからtrとnextTrを削除する
    tbody.removeChild(tr);
    tbody.removeChild(nextTr);

    updateTotalReceiveQuantity();

    for (let i = 0; i < trs.length; i++) {
        if (i % 2 === 0) {
            let tr = trs[i];
            let detail_id = tr.getElementsByClassName('detail_id')[0];
            let order_line_no = tr.getElementsByClassName('order_line_no')[0];
            const no = (i / 2 + 1);
            detail_id.textContent = no.toString().padStart(3, '0');
            order_line_no.value = no;
            tr.getElementsByClassName('order_receive_detail_cd')[0].value = no.toString().padStart(3, '0');

            if (no % 2 === 0) {
                for (let i = 0; i < tr.children.length; i++) {
                    tr.children[i].classList.add('bg-[#FFFFCC]');
                    tr.children[i].classList.remove('bg-[#FFFFFF]');
                }
                for (let i = 0; i < tr.nextElementSibling.children.length; i++) {
                    tr.nextElementSibling.children[i].classList.add('bg-[#FFFFCC]');
                    tr.nextElementSibling.children[i].classList.remove('bg-[#FFFFFF]');
                }
            } else {
                for (let i = 0; i < tr.children.length; i++) {
                    tr.children[i].classList.add('bg-[#FFFFFF]');
                    tr.children[i].classList.remove('bg-[#FFFFCC]')
                }
                for (let i = 0; i < tr.nextElementSibling.children.length; i++) {
                    tr.nextElementSibling.children[i].classList.add('bg-[#FFFFFF]');
                    tr.nextElementSibling.children[i].classList.remove('bg-[#FFFFCC]')
                }
            }
        }
    }
}

function applyReleaseStartDate() {
    const release_start_datetime_year = document.getElementById('release_start_datetime-year').value;
    const release_start_datetime_month = document.getElementById('release_start_datetime-month').value;
    const release_start_datetime_day = document.getElementById('release_start_datetime-date').value;

    if (release_start_datetime_year && release_start_datetime_month && release_start_datetime_day) {
        const table_body = document.getElementById('table_body');
        const trs = table_body.children;
        for (let i = 0; i < trs.length; i++) {
            if (i % 2 === 0) {
                const tr = trs[i];
                const release_start_datetime_year_with_td = tr.getElementsByClassName('release_start_datetime_year_with_td')[0];
                const release_start_datetime_month_with_td = tr.getElementsByClassName('release_start_datetime_month_with_td')[0];
                const release_start_datetime_day_with_td = tr.getElementsByClassName('release_start_datetime_day_with_td')[0];

                release_start_datetime_year_with_td.value = release_start_datetime_year;
                release_start_datetime_month_with_td.value = release_start_datetime_month;
                release_start_datetime_day_with_td.value = release_start_datetime_day;
            }
        }
    }
}

// 受注内訳モーダル表示
function showOrderBreakdownModal(element) {
    const tr = element.closest('tr');
    // このtrの前のtrを取得する
    const prevTr = tr.previousElementSibling;
    const itemName = tr.getElementsByClassName('item_name')[0];
    // prevTrから.item_kbnを取得する
    const item_kbn = prevTr.getElementsByClassName('item_kbn')[0];
    // prevTrから.item_cdを取得する
    const item_cd = prevTr.getElementsByClassName('item_cd')[0];

    const order_line_no = prevTr.getElementsByClassName('order_line_no')[0];
    stock_order_line_no_val = order_line_no.value;

    const disabled_item_kbns = ['4', '6']

    if (!disabled_item_kbns.includes(item_kbn.value) && item_cd.value) {
        appendOverlay();
        addClassList('order_breakdown_modal');

        const orderBreakdownItemCd = document.getElementById('order_breakdown_item_cd');
        const orderBreakdownItemName = document.getElementById('order_breakdown_item_name');

        orderBreakdownItemCd.value = item_cd.value;
        orderBreakdownItemName.value = itemName.value;

        const warehouse_cd = document.getElementById('mt_warehouse_id').value;

        getShowOrderBreakdownModalData(item_cd.value, warehouse_cd);
    }
}

function getShowOrderBreakdownModalData(item_cd, warehouse_cd) {
    const params = {
        item_cd: item_cd,
        warehouse_cd: warehouse_cd
    };

    let query_params = new URLSearchParams(params);
    const manageUrl = "../../../get_stock_info?" + query_params

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
            const sizes = data.mt_sizes;
            const colors = data.mt_colors;
            const stocks = data.mt_stocks;
            const mt_stock_keeping_units = data.mt_stock_keeping_units;
            // mt_stock_keeping_units を mt_size_idによってgroupByする
            const mt_stock_keeping_units_group_by_size = mt_stock_keeping_units.reduce((acc, cur) => {
                (acc[cur.mt_size_id] = acc[cur.mt_size_id] || []).push(cur);
                return acc;
            }, {});
            // mt_stock_keeping_units を mt_color_idによってgroupByする
            const mt_stock_keeping_units_group_by_color = mt_stock_keeping_units.reduce((acc, cur) => {
                (acc[cur.mt_color_id] = acc[cur.mt_color_id] || []).push(cur);
                return acc;
            }, {});

            const size_group_tr = document.getElementsByClassName('size_group_tr')[0];

            let total_count = 0;
            for (let i = 0; i < sizes.length; i++) {
                const size = sizes[i];
                const mt_stock_keeping_units_by_size = mt_stock_keeping_units_group_by_size[size.id];
                const sku_ids = mt_stock_keeping_units_by_size.map(item => item.id);
                let count = 0;
                stocks.forEach(stock => {
                    if (sku_ids.includes(stock.mt_stock_keeping_unit_id)) {
                        count += stock.remaining_order_receive_quantity;
                        total_count += stock.remaining_order_receive_quantity;
                    }
                })
                const mt_stock_keeping_units_td = size_group_tr.getElementsByClassName('size_group_' + i)[0];
                mt_stock_keeping_units_td.textContent = count.toLocaleString();
            }
            const size_group_total = size_group_tr.getElementsByClassName('size_group_total')[0];
            size_group_total.textContent = total_count.toLocaleString();

            const size_tr1 = document.getElementsByClassName('size_tr1')[0];
            const size_tr2 = document.getElementsByClassName('size_tr2')[0];
            // sizesを表示
            for (let i = 0; i < sizes.length; i++) {
                const size = sizes[i];
                const sizeOption = size_tr1.getElementsByClassName('size' + i)[0];
                const sizeOption2 = size_tr2.getElementsByClassName('size' + i)[0];
                sizeOption.textContent = size.size_cd;
                sizeOption2.textContent = size.size_name;
            }

            let index = 0;
            Object.entries(mt_stock_keeping_units_group_by_color).forEach(([key, value]) => {
                const color = colors.find(c => c.id == key);
                const mt_stock_keeping_units_by_color = value;

                const tr = document.createElement('tr');
                tr.classList.add('order_receive_row')
                const td_1 = document.createElement('td');
                // td_1にdivを追加
                const div_1 = document.createElement('div');
                div_1.textContent = color.color_cd;
                div_1.classList.add('text-[#1170C7]', 'text-sm', 'pl-1', 'h-[36px]', 'border', 'border-r-0', 'border-[#D0DFE4]', 'flex', 'items-center', 'w-[86px]')
                td_1.appendChild(div_1);
                td_1.classList.add('p-0', 'pt-1');

                const td_2 = document.createElement('td');
                // td_2にdivを追加
                const div_2 = document.createElement('div');
                div_2.textContent = color.color_name;
                div_2.classList.add('text-[#1170C7]', 'text-sm', 'pl-1', 'h-[36px]', 'border', 'border-[#D0DFE4]', 'flex', 'items-center', 'w-[86px]')
                td_2.appendChild(div_2);
                td_2.classList.add('p-0', 'pt-1');

                // trにtdを追加
                tr.appendChild(td_1);
                tr.appendChild(td_2);

                for (let i = 0; i < 10; i++) {
                    const mt_stock_keeping_unit = mt_stock_keeping_units_by_color[i];
                    let stock = null
                    if (mt_stock_keeping_unit) {
                        stock = stocks.find(s => s.mt_warehouse_id == warehouse_cd && s.mt_stock_keeping_unit_id == mt_stock_keeping_unit.id);
                    }
                    const td_for_input = document.createElement('td');
                    const div_for_input = document.createElement('div');
                    if (i === 0) {
                        td_for_input.classList.add('p-0', 'pt-1', 'pl-1');
                    } else {
                        td_for_input.classList.add('p-0', 'pt-1');
                    }
                    if (i !== 9) {
                        div_for_input.classList.add('text-[#1170C7]', 'text-sm', 'pl-1', 'h-[36px]', 'border', 'border-r-0', 'border-[#D0DFE4]', 'flex', 'items-center', 'w-[86px]')
                    } else {
                        div_for_input.classList.add('text-[#1170C7]', 'text-sm', 'pl-1', 'h-[36px]', 'border', 'pr-1', 'border-[#D0DFE4]', 'flex', 'items-center', 'w-[86px]')
                    }
                    // 上記にinputを追加する
                    const input = document.createElement('input');
                    input.type = 'number';
                    input.classList.add('w-full', 'h-[34px]', 'order_receive_quantity');
                    input.name = 'order_receive_quantity[' + index + '][' + i + ']';
                    input.onchange = function(event) {
                        onChangeOrderReceiveQuantity(event, input, stock);
                    }
                    const sizeInput = document.createElement('input');
                    sizeInput.type = 'hidden';
                    sizeInput.name = 'size_id[' + index + '][' + i + ']';
                    if (mt_stock_keeping_unit) {
                        sizeInput.value = mt_stock_keeping_unit.mt_size_id;
                    } else {
                        input.readOnly = true;
                    }
                    const colorInput = document.createElement('input');
                    colorInput.type = 'hidden';
                    colorInput.name = 'color_id[' + index + '][' + i + ']';
                    if (mt_stock_keeping_unit) {
                        colorInput.value = mt_stock_keeping_unit.mt_color_id;
                    } else {
                        input.readOnly = true;
                    }
                    div_for_input.appendChild(input);
                    div_for_input.appendChild(sizeInput);
                    div_for_input.appendChild(colorInput);
                    td_for_input.appendChild(div_for_input);
                    tr.appendChild(td_for_input);
                }

                const td_for_total = document.createElement('td');
                const div_for_total = document.createElement('div');
                div_for_total.textContent = '0';
                div_for_total.classList.add('text-[#1170C7]', 'text-sm', 'pr-1', 'h-[36px]', 'border', 'border-[#D0DFE4]', 'flex', 'items-center', 'w-[80px]', 'justify-end', 'subtotal_order_receive_quantity')
                td_for_total.appendChild(div_for_total);
                td_for_total.classList.add('p-0', 'pt-1');
                tr.appendChild(td_for_total);

                // trをsize_tr2の後に追加
                size_tr2.after(tr);

                index++;
            })
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

function onChangeOrderReceiveQuantity(event, input, stock) {
    if (event.target.value > stock.remaining_order_receive_quantity || !stock) {
        input.classList.add('text-red-500')
    } else {
        input.classList.remove('text-red-500')
    }
    let total = 0;
    const tr = input.closest('tr');
    const order_receive_quantity = tr.getElementsByClassName('order_receive_quantity');
    for (let i = 0; i < order_receive_quantity.length; i++) {
        total += parseInt(order_receive_quantity[i].value ? order_receive_quantity[i].value : 0);
    }
    const subtotal_order_receive_quantity = tr.getElementsByClassName('subtotal_order_receive_quantity')[0];
    subtotal_order_receive_quantity.textContent = total.toLocaleString();
    setTimeout(() => {
        updateTotalOrderReceiveQuantity();
    }, 1000)
}

function updateTotalOrderReceiveQuantity() {
    const total_order_receive_quantity = document.getElementsByClassName('total_order_receive_quantity_footer')[0];
    const order_receive_row = document.getElementsByClassName('order_receive_row')
    let total = 0;
    for (let i = 0; i < order_receive_row.length; i++) {
        const subtotal_order_receive_quantity = order_receive_row[i].getElementsByClassName('subtotal_order_receive_quantity')[0];
        total += parseInt(subtotal_order_receive_quantity.textContent != '' ? subtotal_order_receive_quantity.textContent.replace(',', '') : 0);
    }
    total_order_receive_quantity.textContent = total.toLocaleString();
}

function orderBreakdownModalClose() {
    removeOverlay();
    removeClassList('order_breakdown_modal');
}

function clearOrderReceiveQuantity() {
    const order_receive_row = document.getElementsByClassName('order_receive_row')
    for (let i = 0; i < order_receive_row.length; i++) {
        const order_receive_quantity = order_receive_row[i].getElementsByClassName('order_receive_quantity');
        for (let j = 0; j < order_receive_quantity.length; j++) {
            order_receive_quantity[j].value = '';
        }
        const subtotal_order_receive_quantity = order_receive_row[i].getElementsByClassName('subtotal_order_receive_quantity')[0];
        subtotal_order_receive_quantity.textContent = '0';
    }
    updateTotalOrderReceiveQuantity();
}

function validationOrderReceiveQuantity() {
    const order_receive_row = document.getElementsByClassName('order_receive_row')
    let valid = true;
    let valid1 = true;
    for (let i = 0; i < order_receive_row.length; i++) {
        const order_receive_quantity = order_receive_row[i].getElementsByClassName('order_receive_quantity');
        for (let j = 0; j < order_receive_quantity.length; j++) {
            if (!order_receive_quantity[j].value || order_receive_quantity[j].value == '') {
                valid = false;
            } else {
                // order_receive_quantity[j].valueが６桁以上の場合
                if (order_receive_quantity[j].value.length > 6) {
                    valid1 = false;
                }
            }
        }
    }

    if (!valid) {
        alert('内訳数量を入力して下さい')
        return
    }

    if (!valid1) {
        alert('整数桁がオーバーしています。')
        return
    }

    const tr = document.getElementById('table_row_' + (stock_order_line_no_val + 1));
    const order_receive_quantity = tr.getElementsByClassName('order_receive_quantity')[0];
    order_receive_quantity.value = document.getElementsByClassName('total_order_receive_quantity_footer')[0].textContent;
}

function searchStockQuantity() {
    appendOverlay();
    addClassList('stock_quantity_by_size_by_color');

    const tr = document.getElementById('table_row_' + stock_order_line_no_val);
    const item_cd = tr.getElementsByClassName('item_cd')[0].value;
    const nextTr = tr.nextElementSibling;
    const item_name = nextTr.getElementsByClassName('item_name')[0].value;

    document.getElementById('stock_quantity_item_cd').value = item_cd;
    document.getElementById('stock_quantity_item_name').value = item_name;
}

function closeStockQuantityBySizeByColorModal() {
    removeOverlay();
    removeClassList('stock_quantity_by_size_by_color');
}

function onChangeStockQuantityColorCd(event, element) {
    //書き込み先の設定
    let nameArea = document.getElementById('stock_quantity_color_name');
    if("" == element.value) {  //列数
        nameArea.innerHTML = "";
        return;
    }

    const stock_quantity_size_cd = document.getElementById('stock_quantity_size_cd').value;

    element.value = element.value.toString().padStart(4, '0');
    const params = {
        color_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../code_auto/color?" + query_params;

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
            if (null !== data) {
                nameArea.value = data['color_name'];
                if (stock_quantity_size_cd) {
                    getStockInfo(stock_quantity_size_cd, element.value);
                }
            } else {
                nameArea.value = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

function onChangeStockQuantitySizeCd(event, element) {
    //書き込み先の設定
    let nameArea = document.getElementById('stock_quantity_size_name');
    if("" == element.value) {  //列数
        nameArea.innerHTML = "";
        return;
    }
    const stock_quantity_color_cd = document.getElementById('stock_quantity_color_cd').value;
    element.value = element.value.toString().padStart(4, '0');
    const params = {
        size_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../code_auto/size?" + query_params;

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
            if (null !== data) {
                nameArea.value = data['size_name'];
                if (stock_quantity_color_cd) {
                    getStockInfo(element.value, stock_quantity_color_cd);
                }
            } else {
                nameArea.value = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

function getStockInfo(size_cd, color_cd) {
    const stock_quantity_item_cd = document.getElementById('stock_quantity_item_cd').value;
    const params = {
        item_cd: stock_quantity_item_cd,
        size_cd,
        color_cd
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../get_stock_detail_info?" + query_params;

    const stock_quantity_total_now_stock_quantity = document.getElementById('stock_quantity_total_now_stock_quantity');
    const stock_quantity_total_remaining_order_receive_quantity = document.getElementById('stock_quantity_total_remaining_order_receive_quantity');
    const stock_quantity_total_remaining_order_warehousing_quantity = document.getElementById('stock_quantity_total_remaining_order_warehousing_quantity');
    const stock_quantity_total_available_quantity = document.getElementById('stock_quantity_total_available_quantity');

    const stock_quantity_table_body = document.getElementById('stock_quantity_table_body')

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
            let stock_quantity_total_now_stock_quantity_val = 0;
            let stock_quantity_total_remaining_order_receive_quantity_val = 0;
            let stock_quantity_total_remaining_order_warehousing_quantity_val = 0;
            let stock_quantity_total_available_quantity_val = 0;

            if(data) {
                data.forEach(item => {
                    stock_quantity_total_now_stock_quantity_val += item.now_stock_quantity;
                    stock_quantity_total_remaining_order_receive_quantity_val += item.remaining_order_receive_quantity;
                    stock_quantity_total_remaining_order_warehousing_quantity_val += item.remaining_order_warehousing_quantity;
                    stock_quantity_total_available_quantity_val += item.now_stock_quantity + item.remaining_order_warehousing_quantity - item.remaining_order_receive_quantity;

                    const tr = document.createElement('tr');
                    const td_1 = document.createElement('td');
                    td_1.classList.add('grid_wrapper_left');
                    td_1.textContent = item.mt_warehouse.warehouse_cd;

                    const td_2 = document.createElement('td');
                    td_2.classList.add('grid_wrapper_left');
                    td_2.textContent = item.mt_warehouse.warehouse_name;

                    const td_3 = document.createElement('td');
                    td_3.classList.add('grid_wrapper_right');
                    td_3.textContent = item.now_stock_quantity.toLocaleString();

                    const td_4 = document.createElement('td');
                    td_4.classList.add('grid_wrapper_right');
                    td_4.textContent = item.remaining_order_receive_quantity.toLocaleString();

                    const td_5 = document.createElement('td');
                    td_5.classList.add('grid_wrapper_right');
                    td_5.textContent = item.remaining_order_warehousing_quantity.toLocaleString();

                    const td_6 = document.createElement('td');
                    td_6.classList.add('grid_wrapper_right');
                    td_6.textContent = stock_quantity_total_available_quantity_val.toLocaleString();

                    tr.appendChild(td_1);
                    tr.appendChild(td_2);
                    tr.appendChild(td_3);
                    tr.appendChild(td_4);
                    tr.appendChild(td_5);
                    tr.appendChild(td_6);

                    stock_quantity_table_body.appendChild(tr);
                })
            }

            stock_quantity_total_now_stock_quantity.textContent = stock_quantity_total_now_stock_quantity_val.toLocaleString();
            stock_quantity_total_remaining_order_receive_quantity.textContent = stock_quantity_total_remaining_order_receive_quantity_val.toLocaleString();
            stock_quantity_total_remaining_order_warehousing_quantity.textContent = stock_quantity_total_remaining_order_warehousing_quantity_val.toLocaleString();
            stock_quantity_total_available_quantity.textContent = stock_quantity_total_available_quantity_val.toLocaleString();
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

function showExtendedItemInput() {
    appendOverlay();
    addClassList('extended_item_input');
}

function closeExtendedItemInputModal() {
    removeOverlay();
    removeClassList('extended_item_input');
}

function showDetailExtensionItem() {
    appendOverlay();
    addClassList('detail_extension_item');
}

function closeDetailExtensionItemModal() {
    removeOverlay();
    removeClassList('detail_extension_item');
}

function showReferenceMenu() {
    appendOverlay();
    addClassList('reference_menu');
}

function closeReferenceMenuModal() {
    removeOverlay();
    removeClassList('reference_menu');
}
