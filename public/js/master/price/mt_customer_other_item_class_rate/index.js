const NOT_EXIST = '<li>マスタに存在しません</li>';
const DATE_STRING_OPTION = {
  year: 'numeric',
  month: '2-digit',
  day: '2-digit',
};

const clearCustomer = () => {
  const element = document.getElementById('customer_name');
  element.value = '';
  element.nextElementSibling.value = '';
}

const setCustomerAlert = () => {
  AlertMsg.clear();
  AlertMsg.insert(NOT_EXIST);
}

const setDeletedAlert = () => {
  clearCustomerInfo();
  AlertMsg.clear();
  AlertMsg.insert(DELETED);
}

const clearCustomerInfo = () => {
  clearCustomer();
}

const redirect = (data) => {
  document.getElementById('redirect').value = data.id;
  document.getElementById('redirect').click();
}

const setItemClass = (tr, data) => {
  tr.querySelector('input[name*="[mt_customer_other_item_class_rate_id]"]').value = data.customerItemClassRate?.id || '';
  tr.querySelector('input[name*="[mt_item_class_id]"]').value = data.itemClass.id;
  tr.querySelector('input[name*="[item_class_name]"]').value = data.itemClass.item_class_name;
}

const setRate = (tr, data) => {
  const kbn = [...document.getElementsByName('kbn')].find(el => el.checked);
  const element = kbn.value == 0 ? tr.querySelector('input[name*="[now_rate]"]') : tr.querySelector('input[name*="[rate]"]');
  element.value = data.customerItemClassRate?.rate || '';
}

const setDateForNew = (tr, data) => {
  const [startYear, startMonth, startDay] = (data.customerItemClassRate?.start_date || '--').split('-');
  const [endYear, endMonth, endDay] = (data.customerItemClassRate?.end_date || '--').split('-');
  const [nowYear, nowMonth, nowDay] = (new Date()).toLocaleDateString('ja-JP', DATE_STRING_OPTION).split('/');
  tr.querySelector('input[name*="[now_start][year]"]').value = startYear;
  tr.querySelector('input[name*="[now_start][month]"]').value = startMonth;
  tr.querySelector('input[name*="[now_start][day]"]').value = startDay;
  tr.querySelector('input[name*="[now_end][year]"]').value = endYear;
  tr.querySelector('input[name*="[now_end][month]"]').value = endMonth;
  tr.querySelector('input[name*="[now_end][day]"]').value = endDay;
  tr.querySelector('input[name*="[start][year]"]').value = nowYear;
  tr.querySelector('input[name*="[start][month]"]').value = nowMonth;
  tr.querySelector('input[name*="[start][day]"]').value = nowDay;
}

const setDateForFix = (tr, data) => {
  const [startYear, startMonth, startDay] = (data.customerItemClassRate?.start_date || '--').split('-');
  const [endYear, endMonth, endDay] = (data.customerItemClassRate?.end_date || '--').split('-');
  const [oldStartYear, oldStartMonth, oldStartDay] = (data.customerItemClassRate?.old_start_date || '--').split('-');
  const [oldEndYear, oldEndMonth, oldEndDay] = (data.customerItemClassRate?.old_end_date || '--').split('-');
  tr.querySelector('input[name*="[start][year]"]').value = startYear;
  tr.querySelector('input[name*="[start][month]"]').value = startMonth;
  tr.querySelector('input[name*="[start][day]"]').value = startDay;
  tr.querySelector('input[name*="[end][year]"]').value = endYear;
  tr.querySelector('input[name*="[end][month]"]').value = endMonth;
  tr.querySelector('input[name*="[end][day]"]').value = endDay;
  tr.querySelector('input[name*="[old_start][year]"]').value = oldStartYear;
  tr.querySelector('input[name*="[old_start][month]"]').value = oldStartMonth;
  tr.querySelector('input[name*="[old_start][day]"]').value = oldStartDay;
  tr.querySelector('input[name*="[old_end][year]"]').value = oldEndYear;
  tr.querySelector('input[name*="[old_end][month]"]').value = oldEndMonth;
  tr.querySelector('input[name*="[old_end][day]"]').value = oldEndDay;
}

const setDate = (tr, data) => {
  const kbn = [...document.getElementsByName('kbn')].find(el => el.checked);
  kbn.value == 0 ? setDateForNew(tr, data) : setDateForFix(tr, data);
}

const setItemClassInfo = (e, data) => {
  const tr = e.target.closest('tr');
  setItemClass(tr, data);
  setRate(tr, data);
  setDate(tr, data);
}

const clearItemClass = (tr) => {
  tr.querySelector('input[name*="[mt_item_class_id]"]').value = '';
  tr.querySelector('input[name*="[item_class_name]"]').value = '';
}

const clearRate = (tr) => {
  [...tr.querySelectorAll('input[name*="[rate]"]')].map(el => el.value = '');
  [...tr.querySelectorAll('input[name*="[now_rate]"]')].map(el => el.value = '');
  [...tr.querySelectorAll('input[name*="[old_rate]"]')].map(el => el.value = '');
}

const clearDate = (tr) => {
  [...tr.querySelectorAll('input[name*="[year]"]')].map(el => el.value = '');
  [...tr.querySelectorAll('input[name*="[month]"]')].map(el => el.value = '');
  [...tr.querySelectorAll('input[name*="[day]"]')].map(el => el.value = '');
}

const clearItemClassInfo = (e) => {
  const tr = e.target.closest('tr');
  clearItemClass(tr);
  clearRate(tr);
  clearDate(tr);
}

const clearItemClassCode = (e) => {
  const tr = e.target.closest('tr');
  tr.querySelector('input[name*="[item_class_cd]"]').value = '';
}

const autoCompleteCustomer = async (e) => {
  if (!e.currentTarget.value) return redirect({ id: 0 });

  try {
    e.currentTarget.value = Util.padZero(e.currentTarget.value, 6);
    const { data } = await axios.get('../../../../code_auto/customer', {
      params: { customer_cd: e.currentTarget.value },
    });
    if (data) {
      data.del_kbn === 0 ? redirect(data) : setDeletedAlert();
    } else {
      setCustomerAlert();
    }
  } catch (e) {
    console.log(e);
  }
}

const autoCompleteItemClass = async (e) => {
  if (!e.currentTarget.value) return clearItemClassInfo(e);

  try {
    const { data } = await axios.get('../../../../code_auto/customer_other_item_class_rate', {
      params: {
        customer_cd: document.getElementsByName('customer_code')[0].value,
        item_class_cd: e.currentTarget.value,
      }
    });
    data.itemClass ? setItemClassInfo(e, data) : clearItemClassInfo(e);
  } catch (e) {
    console.log(e);
  }
}

const clearListener = (e) => {
  clearItemClassCode(e);
  clearItemClassInfo(e);
}

const autoCompleteListener = (e) => {
  if (e.currentTarget.dataset.ac === 'customer') autoCompleteCustomer(e);
  if (e.currentTarget.dataset.ac === 'item_class') autoCompleteItemClass(e);
  return false;
}

// redirect
const modeChageListener = (e) => {
  const customerId = document.querySelector('input[name="customer_id"]').value;
  document.getElementById('mode').value = customerId;
  document.getElementById('mode').click();
}

const addAutoCompleteEvent = () => {
  const elements = [...document.querySelectorAll('[data-ac]')];
  elements.map(el => el.addEventListener('blur', autoCompleteListener));
}

const addClearEvent = () => {
  const elements = [...document.querySelectorAll('[data-clear]')];
  elements.map(el => el.addEventListener('click', clearListener));
}

const addModeChageEvent = () => {
  const elements = [...document.querySelectorAll('[data-mode]')];
  elements.map(el => el.addEventListener('change', modeChageListener));
}

const start = () => {
  addAutoCompleteEvent();
  addClearEvent();
  addModeChageEvent();
}

start();
