const NOT_EXIST_WAREHOUSE = '<li>倉庫マスタの登録を行ってください</li>';

const clearInputWarehouse = () => {
  document.getElementById('warehouse_name').innerText = '';
}

const setInputWarehouse = (data) => {
  document.getElementById('warehouse_name').innerText = data.warehouse_name;
}

const setWarehouse = (data) => {
  AlertMsg.clear();
  if (!data) {
    clearInputWarehouse();
    return AlertMsg.insert(NOT_EXIST_WAREHOUSE)
  }
  setInputWarehouse(data);
}

const autoCompleteWarehouse = async (e) => {
  if (!e.target.value) return clearInputWarehouse();
  try {
    e.target.value = Util.padZero(e.target.value, 6);
    const { data } = await axios.get('../../../../code_auto/warehouse', {
      params: { warehouse_cd: e.target.value },
    });
    setWarehouse(data);
  } catch (e) {
    console.log(e);
  }
}

const autoCompleteItemCode = (e) => {
  document.getElementById('input_item_code_end').value = e.target.value;
}

const autoCompleteListener = (e) => {
  if (e.target.dataset.ac === 'warehouse') autoCompleteWarehouse(e);
  if (e.target.dataset.ac === 'item_code') autoCompleteItemCode(e);
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