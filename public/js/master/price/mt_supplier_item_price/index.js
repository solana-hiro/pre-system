const NOT_EXIST = '<li>マスタに存在しません</li>';
const DELETED = '<li>削除区分が有効になっているコードです</li>';

const clearSupplier = () => {
  const element = document.getElementById('supplier_name');
  element.value = '';
  element.nextElementSibling.value = '';
}

const clearTaxKbn = () => {
  const element = document.getElementById('tax_kbn_name');
  element.value = '';
}

const setSupplierAlert = () => {
  AlertMsg.clear();
  AlertMsg.insert(NOT_EXIST);
}

const setDeletedAlert = () => {
  clearSupplierInfo();
  AlertMsg.clear();
  AlertMsg.insert(DELETED);
}

const clearSupplierInfo = () => {
  clearSupplier();
  clearTaxKbn();
}

const redirect = (data) => {
  document.getElementById('redirect').value = data.id;
  document.getElementById('redirect').click();
}

const setItem = (tr, data) => {
  tr.querySelector('input[name*="[mt_item_id]"]').value = data.item.id;
  tr.querySelector('input[name*="[item_name]"]').value = data.item.item_name;
}

const setDate = (tr, data) => {
  if (data.supplierItemPrice) {
    const [year, month, date] = data.supplierItemPrice.set_date.split('-');
    tr.querySelector('input[name*="[year]"]').value = year;
    tr.querySelector('input[name*="[month]"]').value = month;
    tr.querySelector('input[name*="[day]"]').value = date;
  } else {
    tr.querySelector('input[name*="[year]"]').value = document.getElementsByName('year')[0].value;
    tr.querySelector('input[name*="[month]"]').value = document.getElementsByName('month')[0].value;
    tr.querySelector('input[name*="[day]"]').value = document.getElementsByName('day')[0].value;
  }
}

const setPrice = (tr, data) => {
  tr.querySelector('input[name*="[price]"]').value = data.supplierItemPrice?.price || '';
}

const setItemInfo = (e, data) => {
  const tr = e.target.closest('tr');
  setItem(tr, data);
  setDate(tr, data);
  setPrice(tr, data);
}

const clearItem = (tr) => {
  tr.querySelector('input[name*="[mt_item_id]"]').value = '';
  tr.querySelector('input[name*="[item_name]"]').value = '';
}

const clearDate = (tr) => {
  tr.querySelector('input[name*="[year]"]').value = '';
  tr.querySelector('input[name*="[month]"]').value = '';
  tr.querySelector('input[name*="[day]"]').value = '';
}

const clearPrice = (tr) => {
  tr.querySelector('input[name*="[price]"]').value = '';
}

const clearItemInfo = (e) => {
  const tr = e.target.closest('tr');
  clearItem(tr);
  clearDate(tr);
  clearPrice(tr);
}

const clearItemCode = (e) => {
  const tr = e.target.closest('tr');
  tr.querySelector('input[name*="[item_cd]"]').value = '';
}

const autoCompleteSupplier = async (e) => {
  if (!e.currentTarget.value) return clearSupplierInfo();

  try {
    e.currentTarget.value = Util.padZero(e.currentTarget.value, 6);
    const { data } = await axios.get('../../../../code_auto/supplier', {
      params: { supplier_cd: e.currentTarget.value },
    });
    if (data) {
      data.del_kbn === 0 ? redirect(data) : setDeletedAlert();
    } else {
      setSupplierAlert();
    }
  } catch (e) {
    console.log(e);
  }
}

const autoCompleteItem = async (e) => {
  if (!e.currentTarget.value) return clearItemInfo(e);

  try {
    const { data } = await axios.get('../../../../code_auto/supplier_item_price', {
      params: {
        supplier_cd: document.getElementsByName('supplier_code')[0].value,
        item_cd: e.currentTarget.value,
      }
    });
    data.item ? setItemInfo(e, data) : clearItemInfo(e);
  } catch (e) {
    console.log(e);
  }
}

const clearListener = (e) => {
  clearItemCode(e);
  clearItemInfo(e);
}

const autoCompleteListener = (e) => {
  if (e.currentTarget.dataset.ac === 'supplier') autoCompleteSupplier(e);
  if (e.currentTarget.dataset.ac === 'item') autoCompleteItem(e);
  return false;
}

const addAutoCompleteEvent = () => {
  const elements = [...document.querySelectorAll('[data-ac]')];
  elements.map(el => el.addEventListener('blur', autoCompleteListener));
}

const addClearEvent = () => {
  const elements = [...document.querySelectorAll('[data-clear]')];
  elements.map(el => el.addEventListener('click', clearListener));
}

const start = () => {
  addAutoCompleteEvent();
  addClearEvent();
}

start();
