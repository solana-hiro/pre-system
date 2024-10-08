import * as Smm from "../../modules/search_master_modal/src/modal.js";

function newItemListener(e, item) {
    // get the row number
    if (e) {
        var rowNumber = $(e.target).data('row')
    } else {
        var rowNumber = 1
    }
    // Get the hidden div containing the template row
    var templateDiv = document.getElementById("detail_row");
    // Set the row number in the template row
    let formattedNumber = ("000" + rowNumber).slice(-3)
    templateDiv.querySelector(".number_cell").innerText = formattedNumber
    // Extract the <tr> element from the div
    var templateRow = templateDiv.querySelector("tbody");

    // Clone the <tr> element
    // var clone = templateRow.innerHTML;
    var clone = templateRow.cloneNode(true);
    if (item) {
        clone.querySelector(".detail-id").value = item.id
        clone.querySelector(".item-id").value = item.mt_item_id
        clone.querySelector(".item-cd").dataset.itemCd = item.mt_item.item_cd
        clone.querySelector(".item-name").innerHTML = item.item_name
        clone.querySelector(".item-header-id").value = item.trn_in_out_header_id
        clone.querySelector(".item-cost-price").dataset.price = item.retail_price_tax_out
        clone.querySelector(".item-order_line_no").value = item.order_line_no
        clone.querySelector(".item-item_name").value = item.item_name

        clone.querySelector(".quantity_td .link").dataset.itemCd = item.mt_item.item_cd;
        clone.querySelector(".quantity_td .link").dataset.itemId = item.mt_item_id;
        clone.querySelector(".quantity_td .link").dataset.detailId = item.id;
        clone.querySelector(".quantity_td .link").dataset.detailName = item.item_name;
        clone.querySelector(".quantity_td .link").innerHTML = item.total_quantity

    }
    var namedElements = clone.querySelectorAll('[name]');
    namedElements.forEach(function (element) {
        // Get the current name attribute value
        var currentName = element.getAttribute('name');

        // Replace the [] with the rowNumber inside the name attribute
        var newName = currentName.replace('trn_in_out_details[][', `trn_in_out_details[${rowNumber}][`);

        // Set the updated name attribute back to the element
        element.setAttribute('name', newName);
    });

    // Append the cloned <tr> to the table's <tbody>
    $("#headers_table tbody").append(clone.innerHTML);

    $('#add-new-item').data('row', parseInt(rowNumber) + 1)
    Smm.start()
}

window.deleteRow = function (e) {
    // Insert the deleted detail input hidden
    const deletedDetailId = $(e).closest('tr').find('.detail-id').val();
    const deletedDetailInput = `<input type="hidden" name="deleted_details[]" value="${deletedDetailId}">`;
    $("#deleted_table").append(deletedDetailInput);
    $(e).closest('tr').next().remove();
    $(e).closest('tr').remove()
}

const addNewItemEvent = () => {
    const elements = [...document.querySelectorAll('[data-new-item]')];
    elements.map(el => el.addEventListener('click', newItemListener));
}

const start = () => {
    addNewItemEvent();
    newItemListener();
}

start()

let clickedRow = null
let clickedNextRow = null
let quantityModalText = ''

window.clickMagnifyIcon = function (e) {
    clickedRow = e.closest('tr')
    clickedNextRow = clickedRow.nextElementSibling
}

window.blurCodeautoOutWarehouse = function (event, element) {
    let alertArea = document.getElementById('alert-danger-ul');
    let nameArea = document.getElementById('warehouse_issue_name');
    let idArea = document.getElementById('warehouse_issue_id');
    if ("" == element.value) {  //列数
        nameArea.value = "";
        alertArea.innerHTML = "";
        idArea.value = "";
        return;
    }
    if ("" == element.value) {  //列数
        return;
    }
    element.value = element.value.toString().padStart(6, '0');
    const params = {
        warehouse_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/warehouse?" + query_params;

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
                nameArea.value = data['warehouse_name'];
                idArea.value = data['id'];
            } else {
                let msgHTML = '倉庫マスタの登録を行ってください';
                alertArea.innerHTML = msgHTML;
                nameArea.value = '';
                idArea.value = '';
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

window.blurCodeautoWarehouse = function (event, element) {
    let alertArea = document.getElementById('alert-danger-ul');
    let nameArea = document.getElementById('warehouse_warehousing_name');
    let idArea = document.getElementById('warehouse_warehousing_id');
    if ("" == element.value) {  //列数
        alertArea.innerHTML = "";
        return;
    }
    element.value = element.value.toString().padStart(6, '0');
    const params = {
        warehouse_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/warehouse?" + query_params;

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
                nameArea.value = data['warehouse_name'];
                idArea.value = data['id'];
            } else {
                let msgHTML = '倉庫マスタの登録を行ってください';
                alertArea.innerHTML = msgHTML;
                nameArea.value = '';
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

window.blurCodeautoInOut = function (event, element) {
    let alertArea = document.getElementById('alert-danger-ul');
    if ("" == element.value) {  //列数
        nameArea.innerHTML = "";
        alertArea.innerHTML = "";
        return;
    }
    element.value = element.value.toString().padStart(6, '0');
    const params = {
        trn_order_header_id: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const trnOrderHeaderUrl = "../../../../code_auto/trn_inout_header?" + query_params;
    fetch(trnOrderHeaderUrl, {
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
        }).catch(error => {
            console.log(error); // エラー表示
        });

}

window.blurCodeautoItem = function (event, element) {
    let alertArea = document.getElementById('alert-danger-ul');
    if ("" == element.value) {  //列数
        nameArea.innerHTML = "";
        alertArea.innerHTML = "";
        return;
    }
    if ("" == element.value) {  //列数
        return;
    }
    element.value = element.value.toString().padStart(6, '0');
    let nameField = clickedNextRow.querySelector('td .item-name')
    let priceField = clickedRow.querySelector('.price_td input')
    let quantityField = clickedRow.querySelector('.quantity_td .link')

    const params = {
        item_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/item?" + query_params;

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
                nameField.innerHTML = data['item_name'];
                quantityField.innerHTML = '0';
                quantityField.dataset.itemCd = data['item_cd'];
                quantityField.dataset.itemId = data['id'];
                quantityField.dataset.detailName = data['item_name'];
                priceField.innerHTML = data['retail_price_tax_out'];
                clickedRow.querySelector('.item-id').value = data['id'];
                clickedRow.querySelector('.item-item_name').value = data['item_name'];
            } else {
                let msgHTML = '商品マスタの登録を行ってください';
                alertArea.innerHTML = msgHTML;
                nameField.value = '';
                quantityField.innerHTML = '';
                priceField.innerHTML = '';
                quantityField.dataset.itemId = '';
                quantityField.dataset.detailName = '';
                clickedRow.querySelector('.item-id').value = '';
                clickedRow.querySelector('.item-item_name').value = '';
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

window.blurCodeautoUser = function (event, element) {
    //書き込み先の設定
    let alertArea = document.getElementById('alert-danger-ul');
    let nameArea = document.getElementById('names_manager');
    if ("" == element.value) {  //列数
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
    const manageUrl = "../../../../code_auto/user?" + query_params;

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


function createTableHeader(data) {
    let tableHtml = '<thead>';
    tableHtml += '<tr>';
    tableHtml += '<th class="relative p-2 text-sm w-[172px] h-[72px] bg-[#3A5A9B] text-white size-table-header" rowspan="2" colspan="2"><span class="block text-right">サイズ</span><span class="block text-left">カラー</span></th>';
    for (let i = 0; i < 10; i++) {
        if (data.mtSize[i] === undefined) {
            tableHtml += `<th class="w-[86px] h-[36px] p-1 border border-gray-300 text-sm"></th>`;
        } else {
            tableHtml += `<th class="w-[86px] h-[36px] p-1 border border-gray-300 text-sm text-left text-[#1170C7] font-normal">${data.mtSize[i].size_cd == 9999 ? '' : data.mtSize[i].size_cd}</th>`;
        }
    }
    tableHtml += `<th class="text-center text-sm border border-tableBorder bg-[#F9F9F9] w-[86px] h-[72px]" rowspan="2" >カラー計<br />数量</th>`
    tableHtml += '</tr><tr >';
    for (let i = 0; i < 10; i++) {
        if (data.mtSize[i] === undefined) {
            tableHtml += `<th class="w-[86px] h-[36px] p-1 border border-gray-300 text-sm"></th>`;
        } else {
            tableHtml += `<th class="w-[86px] h-[36px] p-1 border border-gray-300 text-sm text-left text-[#1170C7] font-normal">${data.mtSize[i].size_name == null ? '' : data.mtSize[i].size_name}</th>`;
        }
    }
    tableHtml += '</tr></thead>';
    return tableHtml
}

function createTableBody(data) {
    // let tableHtml = '<tbody>';
    // console.log(data.mtColor[1].color_cd);
    // for (let i = 0; i < 20; i++) {
    //     tableHtml += '<tr>';
    //     if (data.mtColor[i] === undefined) {
    //         tableHtml += `<td class="border border-tableBorder px-2 text-sm w-[86px] h-[36px]"></td>`;
    //         tableHtml += `<td class="border border-tableBorder px-2 text-sm w-[86px] h-[36px]"></td>`;
    //     } else {
    //         tableHtml += `<td class="border border-tableBorder px-2 text-sm w-[86px] h-[36px] text-sm text-left text-[#1170C7]">${data.mtColor[i].color_cd == 9999 ? '' : data.mtColor[i].color_cd}</td>`;
    //         tableHtml += `<td class="border border-tableBorder px-2 text-sm w-[86px] h-[36px] text-sm text-left text-[#1170C7]">${data.mtColor[i].color_name == null ? '' : data.mtColor[i].color_name}</td>`;
    //     }

    //     for (let j = 0; j < 10; j++) {
    //         if (data.mtColor[i] !== undefined && data.mtSize[j] !== undefined) {
    //             console.log();
    //             tableHtml += `<td class="border border-tableBorder px-2 text-sm w-[86px] h-[36px]"><input name="breakdown[${data.mtColor[i].id}][${data.mtSize[j].id}][quantity]" data-color-id="${data.mtColor[i].id}" data-size-id="${data.mtSize[j].id}" data-stock-keeping-unit-id="${getStockKeepingUnitId(data.mtColor[i].id, data.mtSize[j].id, data)}" class="available-quantity h-full w-full text-sm bg-transparent form-control focus:border-none active:border-none focus-visible:none text-right" type="text" name="breakdown[]"  onblur="changeQuantity(arguments[0], this)"></td>`;
    //         } else {
    //             tableHtml += `<td class="border border-tableBorder px-2 text-sm w-[86px] h-[36px]"></td>`;
    //         }
    //     }
    //     tableHtml += `<td class="text-center text-sm border border-tableBorder text-[#1170C7] w-[86px] h-[36px]" >0.00</td>`

    //     tableHtml += '</tr>';

        let tableHtml = '<tbody>';

        for (let i = 0; i < 20; i++) {
            tableHtml += '<tr>';
            if (data.mtColor[i] === undefined) {
                tableHtml += `<td class="border border-tableBorder px-2 text-sm w-[86px] h-[36px]"></td>`;
                tableHtml += `<td class="border border-tableBorder px-2 text-sm w-[86px] h-[36px]"></td>`;
            } else {
                tableHtml += `<td class="border border-tableBorder px-2 text-sm w-[86px] h-[36px] text-sm text-left text-[#1170C7]">${data.mtColor[i].color_cd == 9999 ? '' : data.mtColor[i].color_cd}</td>`;
                tableHtml += `<td class="border border-tableBorder px-2 text-sm w-[86px] h-[36px] text-sm text-left text-[#1170C7]">${data.mtColor[i].color_name == null ? '' : data.mtColor[i].color_name}</td>`;
            }

            for (let j = 0; j < 10; j++) {
                if (data.mtColor[i] !== undefined && data.mtSize[j] !== undefined) {
                    console.log(data);
                    tableHtml += `<td class="border border-tableBorder px-2 text-sm w-[86px] h-[36px]"><input name="breakdown[${data.mtColor[i].id}][${data.mtSize[j].id}][quantity]" data-color-id="${data.mtColor[i].id}" data-size-id="${data.mtSize[j].id}" data-stock-keeping-unit-id="${getStockKeepingUnitId(data.mtColor[i].id, data.mtSize[j].id, data)}" class="available-quantity h-full w-full text-sm bg-transparent form-control focus:border-none active:border-none focus-visible:none text-right" type="text" name="breakdown[]" onblur="changeQuantity(arguments[0], this)"></td>`;
                } else {
                    tableHtml += `<td class="border border-tableBorder px-2 text-sm w-[86px] h-[36px]"></td>`;
                }
            }
            tableHtml += `<td class="text-center text-sm border border-tableBorder text-[#1170C7] w-[86px] h-[36px]" >0.00</td>`

            tableHtml += '</tr>';
        }

        tableHtml += '</tbody>';
        return tableHtml
}

function createTableFooter(data) {
    let tableHtml = '<tfoot>';
    tableHtml += '<tr>';
    tableHtml += '<td class="text-right" colspan="2"><div class="inline-flex p-2 text-sm text-center w-[120px] text-required h-[36px] bg-[#F9F9F9]" >サイズ計数量</div></td>';
    for (let i = 0; i < 10; i++) {
        tableHtml += `<td class="text-center text-sm border border-tableBorder text-required w-[86px] h-[36px]">0.00</td>`;
    }
    tableHtml += `<td></td>`;
    tableHtml += '</tr>';
    tableHtml += '</tfoot>';
    return tableHtml;
}

function createTable(data) {
    let tableHtml = '<table class="table-fixed">';
    let index = 0;
    tableHtml += createTableHeader(data);
    tableHtml += createTableBody(data);
    tableHtml += createTableFooter(data);
    tableHtml += '</table>';
    return tableHtml
}

window.getSkuData = function (event, element) {

    clickedRow = element.closest('tr')
    clickedNextRow = clickedRow.nextElementSibling

    let itemId = element.dataset.itemId;
    let itemCd = element.dataset.itemCd;
    let detailId = element.dataset.detailId;
    let detailName = element.dataset.detailName;
    let alertArea = document.getElementById('modal-alert-danger-ul');
    let nameArea = document.getElementById('quantity-modal-item-name');
    let codeArea = document.getElementById('quantity-modal-item-code');

    nameArea.innerHTML = detailName;
    codeArea.value = itemCd;
    // let nameArea = document.getElementById('names_manager');
    if ("" == itemId) {  //列数
        return;
    }
    const params = {
        mt_item_cd: itemId
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const skuUrl = "../../../../code_auto/skus?" + query_params;

    fetch(skuUrl, {
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
                let tableHtml = createTable(data);
                quantityModalText = tableHtml;
                // Replace the placeholder with the generated table HTML
                document.getElementById('quantity-modal').innerHTML = tableHtml;
                if (detailId) {
                    const params = {
                        trn_in_out_detail_id: detailId
                    };
                    let query_params = new URLSearchParams(params);
                    const breakdownsUrl = "../breakdown?" + query_params;
                    fetch(breakdownsUrl, {
                        method: 'GET', // HTTPメソッドを指定
                        headers: {
                            'Content-Type': 'application/json',
                        }
                    })
                        .then(response => {
                            return response.json();
                        })
                        .then(data => {
                            if (data) {
                                let rows = document.querySelectorAll('tbody tr');
                                rows.forEach(row => {
                                    let tds = row.querySelectorAll('td .available-quantity');
                                    tds.forEach(td => {
                                        let sku = data.find(sku => sku.mt_stock_keeping_unit.mt_color_id == td.dataset.colorId && sku.mt_stock_keeping_unit.mt_size_id == td.dataset.sizeId);
                                        if (sku) {
                                            td.value = sku.order_in_out_quantity;
                                            td.dataset.id = sku.id;
                                        }
                                    });
                                });
                                updateModalQuantitiesTable();
                            }
                        }).catch(error => {
                            console.log(error); // エラー表示
                        });
                }

            } else {

            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}

window.clearQuantityModal = function () {
    document.getElementById('quantity-modal').innerHTML = quantityModalText;
}

window.changeQuantity = function (event, element) {
    let alertArea = document.getElementById('modal-alert-danger-ul');
    let quantity = element.value;
    if ("" == quantity) {  //列数
        return;
    }
    if (isNaN(quantity)) {
        let msgHTML = '<li>数値を入力してください</li>';
        alertArea.innerHTML = msgHTML;
        return;
    }
    if (parseFloat(quantity) < 0) {
        let msgHTML = '<li>0以上の数値を入力してください</li>';
        alertArea.innerHTML = msgHTML;
        return;
    }
    alertArea.innerHTML = '';

    updateModalQuantitiesTable();
}

function updateModalQuantitiesTable() {

    // テーブルフーターのサイズ別の合計数量を変更する
    let table = document.getElementById('quantity-modal');
    let rows = table.querySelectorAll('tbody tr');
    let totalRow = table.querySelector('tfoot tr');
    let totalTds = totalRow.querySelectorAll('td');
    // テーブルフーターのカラー別の合計数量を変更する
    let total = 0;
    rows.forEach(row => {
        total = 0;
        let tds = row.querySelectorAll('td input');
        tds.forEach(td => {
            if (td.value !== '') {
                total += parseFloat(td.value);
            }
        });
        row.querySelector('td:last-child').innerText = total.toFixed(2);
    })
    // let row = element.closest('tr');

    let totalArray = Array.from(totalTds);
    totalArray.shift();
    totalArray.pop();
    totalArray.forEach((td, index) => {
        let total = 0;
        rows.forEach(row => {
            let tds = row.querySelectorAll('td');
            if (tds[index + 2].querySelector('input') && tds[index + 2].querySelector('input').value !== '') {
                total += parseFloat(tds[index + 2].querySelector('input').value);
            }
        });
        td.innerText = total.toFixed(2);
    });

    // 合計数量を変更する
    let modalTotalQuantity = document.getElementById('modal-total-quantity');
    let totalQuantity = 0;
    rows.forEach(row => {
        let lastCell = row.querySelector('td:last-child');
        let quantity = parseFloat(lastCell.innerText);
        if (!isNaN(quantity)) {
            totalQuantity += quantity;
        }
    });
    modalTotalQuantity.innerText = totalQuantity.toFixed(2);
}

function updateTotalQuantity() {
    // Update the total quantity element
    let totalTable = document.getElementById('headers_table');
    let rows = totalTable.querySelectorAll('tbody tr');
    let totalQuantityElement = document.getElementById('inoutput-total-quantity')
    let total = 0
    rows.forEach(row => {
        let quantityField = row.querySelector('.quantity_td .link')
        if (quantityField) {
            let quantity = parseFloat(quantityField.innerHTML);
            if (!isNaN(quantity)) {
                total += quantity;
            }
        }
    })
    totalQuantityElement.value = total.toFixed(2);
}

window.blurUpdatePrice = function (event, element) {
    updateTotalQuantity()
}

// 数量選択モーダルをクローズする
window.closeQuantityModal = function () {
    document.getElementById('modal-total-quantity').innerHTML = '0.00';
}

window.updateQuantity = function () {
    let modalTotalQuantity = document.getElementById('modal-total-quantity');
    let quantityField = clickedRow.querySelector('.quantity_td .link')
    quantityField.innerHTML = modalTotalQuantity.innerText;

    // Get the parent table of the clicked row
    let parentTable = clickedRow.closest('table');

    // Get all rows in the parent table
    let rows = parentTable.querySelectorAll('tbody tr');
    // Calculate the sum of .link values
    let sum = 0;
    rows.forEach(row => {
        let quantityField = row.querySelector('.quantity_td .link');
        if (quantityField) {
            let quantity = parseFloat(quantityField.innerHTML);
            if (!isNaN(quantity)) {
                sum += quantity;
            }
        }
    });

    // Save all From Data of modal_quantity
    let breakdowns = [];
    rows = document.getElementById('quantity-modal').querySelectorAll('tbody tr');
    rows.forEach(row => {
        let tds = row.querySelectorAll('td input');
        tds.forEach(td => {
            if (td.dataset.stockKeepingUnitId) {
                let breakdown = {
                    id: td.dataset.id,
                    mt_stock_keeping_unit_id: td.dataset.stockKeepingUnitId,
                    order_in_out_quantity: td.value
                }
                breakdowns.push(breakdown);
            }
        });
    });

    clickedRow.querySelector('.item-breakdowns').value = JSON.stringify(breakdowns);

    updateTotalQuantity()
}

function getStockKeepingUnitId(colorId, sizeId, data) {
    let sku
    sku = data.mtStockKeepingUnit.find(item => {
        return item.mt_color_id == colorId && item.mt_size_id == sizeId
    });
    return sku.id
}

window.repeatInOut = function (event, element) {
    document.getElementById('inout-id').value = ''
    document.getElementById('inout-number').value = ''
    document.getElementsByClassName('detail-id').value = ''
    const elements = document.querySelectorAll('[data-detail-id]');
    elements.forEach(el => el.dataset.detailId = '');
    document.getElementById('deleted_table').innerHTML = '';
}


