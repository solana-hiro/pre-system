const activeClass = 'is-active';

let overlayList = [];
let overLayZIndex = 9001;
let modalZIndex = 9002;

export const appendOverlay = () => {
  const overlay = document.createElement('div');
  overlay.classList.add('overlay_gray');
  overlay.style.zIndex = overLayZIndex;
  document.body.appendChild(overlay);
  overlayList.push(overlay);
  overLayZIndex++;
}

const list = (nameAttr, id, code, name) => {
  return [
    `<input type="text" class="search_list" name="${nameAttr}[]"`,
    `  value="${code}:${name}" readonly><br>`,
    `<input type="hidden" name="hidden_${nameAttr}[]" value="${id}">`,
  ].join('\n');
}

export const addTargetList = (e) => {
  const tr = e.target.closest('tr');
  const nameAttr = tr.dataset.smmOptionValue;
  const area = document.getElementById(tr.dataset.smmOptionTarget);
  const id = tr.dataset.recordId;
  const [code, name] = [...tr.cells].map(cell => cell.innerText);
  area.insertAdjacentHTML('beforeend', list(nameAttr, id, code, name));
}

export const removeOverlay = () => {
  const overlay = overlayList.pop();
  document.body.removeChild(overlay);
  overLayZIndex--;
}

export const addClassList = (modalId) => {
  const modal = document.getElementById(modalId);
  modal.classList.add(activeClass);
  modal.style.zIndex = modalZIndex;
  modalZIndex++;
}

export const removeClassList = (el) => {
  const modal = el.closest('.modal-box');
  modal.classList.remove(activeClass);
  modal.style.zIndex = null;
  modalZIndex--;
}

export const setInputValue = (value, el) => {
  el.value = value;
}
