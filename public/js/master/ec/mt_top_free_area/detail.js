const NEW_TOP_FREE_AREA_CODE = '<li>新規のデータです</li>'

const redirect = (data) => {
  document.getElementById('redirect').value = data.id;
  document.getElementById('redirect').click();
}

const setTopFreeArea = (data) => {
  if (data) return redirect(data);
  AlertMsg.clear();
  AlertMsg.insert(NEW_TOP_FREE_AREA_CODE);
}

// redirect
const autoCompleteTopFreeArea = async (e) => {
  if (!e.target.value) return;
  try {
    e.target.value = Util.padZero(e.target.value, 4);
    const { data } = await axios.get('../../../../code_auto/top_free_area', {
      params: { area_cd: e.target.value },
    });
    setTopFreeArea(data);
  } catch (e) {
    console.log(e);
  }
}

const autoCompleteListener = (e) => {
  if (e.target.dataset.ac === 'topFreeArea') autoCompleteTopFreeArea(e);
  return false;
}

const addAutoCompleteEvent = () => {
  const elements = [...document.querySelectorAll('[data-ac]')];
  elements.map(el => el.addEventListener('blur', autoCompleteListener));
}

const start = () => {
  addAutoCompleteEvent();
}

start();




// 以下main.jsからの引っ越し分は一旦windowに追加するが要修正
window.publicationDestinationFlgClick = function publicationDestinationFlgClick() {
  let check0 = document.mtTopFreeAreaIndexForm.publication_destination_flg_0.checked;
  let check1 = document.mtTopFreeAreaIndexForm.publication_destination_flg_1.checked;
  let check2 = document.mtTopFreeAreaIndexForm.publication_destination_flg_2.checked;
  let customerClass1 = document.getElementById('customer_classes');
  let customerClass2 = document.getElementById('customers');
  if (check1 == true) {
    customerClass1.style.display = "block";
    customerClass2.style.display = "none";
  } else if (check2 == true) {
    customerClass1.style.display = "none";
    customerClass2.style.display = "block";
  } else {
    customerClass1.style.display = "none";
    customerClass2.style.display = "none";
  }
}

window.clickCustomerPublicType = function clickCustomerPublicType(elm) {
  //elm 第1引数:name属性/第2引数:value属性
  let customerSearchDetail = document.getElementById('customer_search_detail');
  let customerClass1SearchDetail = document.getElementById('customer_class1_search_detail');
  let customerClass2SearchDetail = document.getElementById('customer_class2_search_detail');
  let customerClass3SearchDetail = document.getElementById('customer_class3_search_detail');
  if (elm[0] === 'customer_type') {
    if (elm[1] === '1') {
      customerSearchDetail.style.display = "block";
    } else {
      customerSearchDetail.style.display = "none";
    }
  } else if (elm[0] === 'class1_type') {
    if (elm[1] === '1') {
      customerClass1SearchDetail.style.display = "block";
    } else {
      customerClass1SearchDetail.style.display = "none";
    }
  } else if (elm[0] === 'class2_type') {
    if (elm[1] === '1') {
      customerClass2SearchDetail.style.display = "block";
    } else {
      customerClass2SearchDetail.style.display = "none";
    }
  } else if (elm[0] === 'class3_type') {
    if (elm[1] === '1') {
      customerClass3SearchDetail.style.display = "block";
    } else {
      customerClass3SearchDetail.style.display = "none";
    }
  }
}

/* TOP自由領域　選択式検索 */
// クリア処理
window.resetCustomerClass1 = function resetCustomerClass1() {
  let searchList1 = document.getElementById("searchCustomerClass1List");
  searchList1.innerHTML = "";
}

window.resetCustomerClass2 = function resetCustomerClass2() {
  let searchList2 = document.getElementById("searchCustomerClass2List");
  searchList2.innerHTML = "";
}

window.resetCustomerClass3 = function resetCustomerClass3() {
  let searchList3 = document.getElementById("searchCustomerClass3List");
  searchList3.innerHTML = "";
}

window.resetCustomer = function resetCustomer() {
  let searchCustomerList = document.getElementById("searchCustomerList");
  searchCustomerList.innerHTML = "";
}