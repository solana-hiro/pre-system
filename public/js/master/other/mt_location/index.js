const NOT_EXIST_WAREHOUSE = '<li>倉庫マスタの登録を行ってください</li>';
const NOT_EXIST_ITEM = '<li>商品マスタの登録を行ってください</li>';

const isEntered = (el) => !!el.value;

const setWarehouse = (data) => {
  AlertMsg.clear();
  const element = document.getElementById('warehouse_name');
  element.value = data.warehouse_name;
  element.nextElementSibling.value = data.id;
}

const setItem = (data) => {
  AlertMsg.clear();
  const element = document.getElementById('item_name');
  element.value = data.item_name;
  element.nextElementSibling.value = data.id;
}

const clearWarehouse = () => {
  const element = document.getElementById('warehouse_name');
  element.value = '';
  element.nextElementSibling.value = '';
}

const clearItem = () => {
  const element = document.getElementById('item_name');
  element.value = '';
  element.nextElementSibling.value = '';
}

const setWarehouseAlert = () => {
  clearWarehouse();
  AlertMsg.clear();
  AlertMsg.insert(NOT_EXIST_WAREHOUSE);
}

const setItemAlert = () => {
  clearItem();
  AlertMsg.clear();
  AlertMsg.insert(NOT_EXIST_ITEM);
}

const rowHTML = (data) => {
  return data.map((el, index) => {
    return [
      `<tr>`,
      `  <input type="hidden" name="location[${index}][mt_stock_keeping_unit_id]" value="${el.id}">`,
      `  <input type="hidden" name="location[${index}][mt_location_id]" value="${el.location_id || ''}">`,
      `  <td class="grid_wrapper_center col_rec">`,
      `    <button type="button" data-clear>`,
      `      <img class="vector" src="/img/icon/trash.svg">`,
      `    </button>`,
      `  </td>`,
      `  <td class="grid_wrapper_center col_rec">`,
      `    <input name="location[${index}][color_cd]" class="grid_textbox w-20 txt_blue"value="${el.color_cd}" readonly>`,
      `  </td>`,
      `  <td class="grid_wrapper_center col_rec">`,
      `    <input name="location[${index}][color_name]" class="grid_textbox w-20 txt_blue" value="${el.color_name || ''}" readonly>`,
      `  </td>`,
      `  <td class="grid_wrapper_center col_rec">`,
      `    <input name="location[${index}][size_cd]" class="grid_textbox w-20 txt_blue" value="${el.size_cd}" readonly>`,
      `  </td>`,
      `  <td class="grid_wrapper_center col_rec">`,
      `    <input name="location[${index}][size_name]" class="grid_textbox w-20 txt_blue" value="${el.size_name || ''}" readonly>`,
      `  </td>`,
      `  <td class="grid_wrapper_center col_rec">`,
      `    <input name="location[${index}][shelf_number_1]" class="grid_textbox w-24" value="${el.shelf_number_1 || ''}" maxlength="10">`,
      `  </td>`,
      `  <td class="grid_wrapper_center col_rec">`,
      `    <input name="location[${index}][shelf_number_2]" class="grid_textbox w-24" value="${el.shelf_number_2 || ''}" maxlength="10">`,
      `  </td>`,
      `  <td class="grid_wrapper_center col_rec">`,
      `    <input name="location[${index}][rank]" class="grid_textbox w-10" value="${el.rank || ''}" maxlength="2">`,
      `  </td>`,
      `</tr>`,
    ].join('');
  });
}

const tableHTML = (data) => {
  return [
    '<table>',
    '  <thead class="grid_header">',
    '    <tr>',
    '      <th class="grid_wrapper_center">削除</th>',
    '      <th colspan="2" class="grid_wrapper_center">カラー</th>',
    '      <th colspan="2" class="grid_wrapper_center">サイズ</th>',
    '      <th class="grid_wrapper_center">棚番1</th>',
    '      <th class="grid_wrapper_center">棚番2</th>',
    '      <th class="grid_wrapper_center">ランク</th>',
    '    </tr>',
    '  </thead>',
    '  <tbody class="grid_body">',
    ...rowHTML(data),
    '  </tbody>',
    '</table>'
  ].join('');
}

const createTable = (data) => {
  const div = document.getElementById('location-table');
  div.innerHTML = tableHTML(data);
}

const removeTable = () => {
  const div = document.getElementById('location-table');
  div.innerHTML = '';
}

const loadLocation = async () => {
  const elements = [...document.querySelectorAll('[data-load]')];
  if (!elements.every(isEntered)) return;

  try {
    const { data } = await axios.get('../../../../load/item_location', {
      params: {
        warehouse_id: document.getElementById('warehouse_name').nextElementSibling.value,
        item_id: document.getElementById('item_name').nextElementSibling.value,
      },
    });
    data.length !== 0 ? createTable(data) : removeTable();
    addClearEvent();  // テーブル作成されていればゴミ箱イベントが有効化
  } catch (e) {
    console.log(e);
  }
}

const autoCompleteWarehouse = async (e) => {
  if (!e.currentTarget.value) {
    clearItem();
    removeTable();
    return;
  }

  try {
    e.currentTarget.value = Util.padZero(e.currentTarget.value, 6);
    const { data } = await axios.get('../../../../code_auto/warehouse', {
      params: { warehouse_cd: e.currentTarget.value },
    });
    data ? setWarehouse(data) : setWarehouseAlert();
    loadLocation();
  } catch (e) {
    console.log(e);
  }
}

const autoCompleteItem = async (e) => {
  if (!e.currentTarget.value) {
    clearItem();
    removeTable();
    return;
  }

  try {
    const { data } = await axios.get('../../../../code_auto/item', {
      params: { item_cd: e.currentTarget.value },
    });
    data ? setItem(data) : setItemAlert();
    loadLocation();
  } catch (e) {
    console.log(e);
  }
}

const clearListener = (e) => {
  const tr = e.currentTarget.closest('tr');
  tr.querySelector('input[name*="shelf_number_1"]').value = '';
  tr.querySelector('input[name*="shelf_number_2"]').value = '';
  tr.querySelector('input[name*="rank"]').value = '';
}

const autoCompleteListener = (e) => {
  if (e.currentTarget.dataset.ac === 'warehouse') autoCompleteWarehouse(e);
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