import {
  addClassList,
  addTargetList,
  appendOverlay,
  removeClassList,
  removeOverlay,
  setInputValue
} from "./dom/element.js";

let targetElemnts = [];

const open = (modalId, prevElement) => {
  appendOverlay();
  addClassList(modalId);
  targetElemnts.push(prevElement);
}

const close = (modalInnerElement) => {
  removeClassList(modalInnerElement);
  removeOverlay();
  targetElemnts.pop();
}

// optionを付けることで処理を分けられるように
const dbclick = (value, option, e) => {
  if (!option) setInputValue(value, targetElemnts.at(-1));
  if (option === 'list') addTargetList(e);
}

// blurイベントが仕掛けられている場合は、この部分でイベント発生（主にオートコンプリート用）
const generateBlur = () => {
  const element = targetElemnts.at(-1);
  element.focus();
  element.blur();
}

const openListener = (e) => {
  const modalId = e.target.dataset.smmOpen;
  const prevElement = e.target.previousElementSibling;
  open(modalId, prevElement);
}

const closeListener = (e) => {
  const modalInnerElement = e.target;
  close(modalInnerElement);
}

const dbclickListener = (e) => {
  const value = e.target.closest('tr').dataset.smmDbclick;
  const option = e.target.closest('tr').dataset.smmOption;
  const modalInnerElement = e.target;
  dbclick(value, option, e);
  if (!option) generateBlur();
  close(modalInnerElement);
}

const addOpenEvent = () => {
  const openElements = document.querySelectorAll('[data-smm-open]');
  [...openElements].map(el => el.addEventListener('click', openListener));
}

const addCloseEvent = () => {
  const closeElements = document.querySelectorAll('[data-smm-close]');
  [...closeElements].map(el => el.addEventListener('click', closeListener));
}

const addDbclickEvent = () => {
  const dbclickElements = document.querySelectorAll('[data-smm-dbclick]');
  [...dbclickElements].map(el => el.addEventListener('dblclick', dbclickListener));
}

export const start = () => {
  addOpenEvent();
  addCloseEvent();
  addDbclickEvent();
  addDbclickEventStickyNote();
}

// 可変リストなど個別に追加する用
export const addNewOpenEvent = (element) => {
  element.addEventListener('click', openListener);
}

// 付箋のための個別実装 ここから--------------------
// ----------------------------------------------

const dbclickStickyNote = (name, color, id) => {
  const prevElement = targetElemnts.at(-1).previousElementSibling;
  const rePrevElement = prevElement.previousElementSibling;
  setInputValue(name, targetElemnts.at(-1));
  setInputValue(color, prevElement);
  setInputValue(id, rePrevElement);
}

// blurイベントが仕掛けられている場合は、この部分でイベント発生（主にオートコンプリート用）
const generateBlurStickyNote = () => {
  const element1 = targetElemnts.at(-1);
  element1.focus();
  element1.blur();
}

const dbclickStickyNoteListener = (e) => {
  const name = e.target.closest('tr').dataset.smmDbclickName;
  const color = e.target.closest('tr').dataset.smmDbclickColor;
  const id = e.target.closest('tr').dataset.smmDbclickId;
  const modalInnerElement = e.target;
  dbclickStickyNote(name, color, id);
  generateBlurStickyNote();
  close(modalInnerElement);
}

const addDbclickEventStickyNote = () => {
  const dbclickElements = document.querySelectorAll('[data-smm-dbclick-color]');
  [...dbclickElements].map(el => el.addEventListener('dblclick', dbclickStickyNoteListener));
}

// ----------------------------------------------
// 付箋のための個別実装 ここまで--------------------

