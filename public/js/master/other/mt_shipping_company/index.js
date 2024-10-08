import { addNewOpenEvent } from "../../../modules/search_master_modal/src/modal.js";

const NEW_SHIPPING_COMPANY_LI_MESSAGE = "<li>新規データです。</li>";
const EXIST_SHIPPING_COMPANY_LI_MESSAGE = "<li>登録済みの運送会社コードです</li>";

const clearInputShippingCompany = (e) => {
  const tr = e.target.closest('tr');
  tr.querySelector('[name*="insert_shipping_company_name"]').value = "";
  tr.querySelector('[name*="insert_slip_kind7"]').value = "";
  tr.querySelector('[name*="insert_slip_kind17"]').value = "";
}

const setInputShippingCompany = (e, data) => {
  const tr = e.target.closest('tr');
  tr.querySelector('[name*="insert_shipping_company_name"]').value = data.shipping_company_name;
  tr.querySelector('[name*="insert_slip_kind7"]').value = data.slip_kind_7_cd;
  tr.querySelector('[name*="insert_slip_kind17"]').value = data.slip_kind_17_cd;
}

// 運送会社補完
window.autoCompleteShippingCompany = async function (e) {
  // const autoCompleteShippingCompany = async (e) => {
  if (e.target.value) {
    e.target.value = e.target.value.padStart(4, '0');
    try {
      const { data } = await axios.get("../../../../code_auto/shipping_company", {
        params: { shipping_company_cd: e.target.value },
      });
      AlertMsg.clear();
      if (!data) {
        clearInputShippingCompany(e);
        return AlertMsg.insert(NEW_SHIPPING_COMPANY_LI_MESSAGE);
      }

      setInputShippingCompany(e, data);
      AlertMsg.insert(EXIST_SHIPPING_COMPANY_LI_MESSAGE);
    } catch (e) {
      console.log(e);
    }
  } else { // 入力が空の場合は表示をクリア
    clearInputShippingCompany(e);
  }
}

/* 運送会社マスタ start */
// 行追加
window.shippingCompanyAddLine = function (event, element) {
  // 現在の行数(ヘッダー分とINDEX0スタートに合わせる)
  var table1 = document.getElementById("shipping_grid_table");
  var trs = $('#shipping_grid_table tbody tr');
  // 最終行のクローン取得
  var lastTr = trs[trs.length - 1];
  var td = $(lastTr).children();
  var row = table1.insertRow(-1);
  var cell1 = row.insertCell(-1);
  var cell2 = row.insertCell(-1);
  var cell3 = row.insertCell(-1);
  var cell4 = row.insertCell(-1);
  cell1.innerHTML = td[0].innerHTML;
  cell2.innerHTML = td[1].innerHTML;
  cell3.innerHTML = td[2].innerHTML;
  cell4.innerHTML = td[3].innerHTML;
  addNewOpenEvent(cell3.getElementsByTagName('img')[0]);
  addNewOpenEvent(cell4.getElementsByTagName('img')[0]);
}
