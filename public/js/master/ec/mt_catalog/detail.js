import { addNewOpenEvent } from '../../../modules/search_master_modal/src/modal.js';

const NEW_CATALOG_CODE = '<li>新規のデータです</li>'

const tableRecord = (index) => {
  return [
    `<tr>`,
    `  <input type="hidden" name="mt_catalog_items[${index}][id]" value="">`,
    `  <input type="hidden" name="mt_catalog_items[${index}][mt_member_site_items_id]" value="">`,
    `  <td class="grid_wrapper_left">`,
    `    <input type="text" name="mt_catalog_items[${index}][ec_item_cd]" class="grid_textbox grid_textbox_70p" `,
    `      minlength="0" maxlength="20" data-ac="msitem" value="">`,
    `      <img class="vector" src="/img/icon/vector.svg" data-smm-open="search_member_site_item_class" />`,
    `  </td>`,
    `  <td class="grid_wrapper_left col_rec">`,
    `    <input type="text" name="mt_catalog_items[${index}][ec_item_name]" class="grid_textbox" readonly value="">`,
    `  </td>`,
    `  <td class="grid_wrapper_left col_rec">`,
    `    <img src="" class="img_preview_small">`,
    `    <input type="hidden" name="mt_catalog_items[${index}][item_image_file_1]" value="">`,
    `  </td>`,
    `  <td class="grid_wrapper_left col_rec">`,
    `    <input type="number" name="mt_catalog_items[${index}][display_sort_order]" class="grid_textbox"`,
    `      data-limit-len="3" data-limit-minus value="">`,
    `  </td>`,
    `  <td class="grid_wrapper_center col_rec">`,
    `    <button type="button" data-toggle="modal" data-target="#modal_sub_delete" class="display_none" data-value="${index}">`,
    `      <img class="grid_img_center" src="/img/icon/trash.svg" />`,
    `    </button>`,
    `  </td>`,
    `</tr>`,
  ].join('\n');
}

const clearInputMemberSiteItem = (elements) => {
  elements.id.value = '';
  elements.name.value = '';
  elements.image.src = '';
  elements.hiddenImage.value = '';
  elements.order.value = '';
}

const setInputMemberSiteItem = (elements, data) => {
  elements.id.value = data.id;
  elements.name.value = data.ec_item_name;
  elements.image.src = Util.s3Url(data.item_image_file_1);
  elements.hiddenImage.value = data.item_image_file_1;
  elements.order.value = data.mtCatalogItem?.display_sort_order || '';
}

const setMemberSiteItem = (e, data) => {
  const tr = e.target.closest('tr');
  const elements = {
    id: tr.querySelector('[name*="mt_member_site_items_id"]'),
    name: tr.querySelector('[name*="ec_item_name"]'),
    image: tr.querySelector('[name*="item_image_file_1"]').previousElementSibling,
    hiddenImage: tr.querySelector('[name*="item_image_file_1"]'),
    order: tr.querySelector('[name*="display_sort_order"]'),
  };
  if (!data) return clearInputMemberSiteItem(elements);
  setInputMemberSiteItem(elements, data);
}

const autoCompleteMemberSiteItem = async (e) => {
  if (!e.target.value) return clearInputMemberSiteItem();
  try {
    const { data } = await axios.get('../../../../code_auto/member_site_item_with_catalog_order', {
      params: {
        ec_item_cd: e.target.value,
        catalog_id: document.getElementById('catalog-id').innerText,
      },
    });
    setMemberSiteItem(e, data);
  } catch (e) {
    console.log(e);
  }
}

const redirect = (data) => {
  document.getElementById('redirect').value = data.id;
  document.getElementById('redirect').click();
}

const setCatalog = (data) => {
  if (data) return redirect(data);
  AlertMsg.clear();
  AlertMsg.insert(NEW_CATALOG_CODE);
}

// redirect
const autoCompleteCatalog = async (e) => {
  if (!e.target.value) return;
  try {
    e.target.value = Util.padZero(e.target.value, 4);
    const { data } = await axios.get('../../../../code_auto/catalog', {
      params: { catalog_cd: e.target.value },
    });
    setCatalog(data);
  } catch (e) {
    console.log(e);
  }
}

const autoCompleteListener = (e) => {
  if (e.target.dataset.ac === 'msitem') autoCompleteMemberSiteItem(e);
  if (e.target.dataset.ac === 'catalog') autoCompleteCatalog(e);
  return false;
}

const newItemListener = (e) => {
  const table = document.getElementById(e.target.dataset.newItem);
  const [tbody] = table.tBodies;
  const tr = tbody.insertRow();
  const index = table.rows.length - 2;
  tr.innerHTML = tableRecord(index);
  addNewOpenEvent(tr.querySelector('img'));
  addNewAutoCompleteEvent(tr.querySelector('input[type=text]'));
}

const addAutoCompleteEvent = () => {
  const elements = [...document.querySelectorAll('[data-ac]')];
  elements.map(el => el.addEventListener('blur', autoCompleteListener));
}

const addNewAutoCompleteEvent = (element) => {
  element.addEventListener('blur', autoCompleteListener);
}

const addNewItemEvent = () => {
  const elements = [...document.querySelectorAll('[data-new-item]')];
  elements.map(el => el.addEventListener('click', newItemListener));
}

const start = () => {
  addAutoCompleteEvent();
  addNewItemEvent();
}

start();