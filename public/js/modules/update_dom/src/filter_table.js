import { padZero } from "./util.js";

const decideDisplay = (tr, filter) => {
  tr.dataset.trv < filter ? tr.style.display = "none" : tr.style.display = "table-row";
}

const filterTable = (tableId, filter) => {
  const table = document.getElementById(tableId);
  const trs = [...table.querySelectorAll('tr')];
  trs.map(tr => decideDisplay(tr, filter));
}

const filterTableLinstener = (e) => {
  const tableId = e.target.dataset.ft;
  const padLength = e.target.dataset.padLen;
  e.target.value = padZero(e.target.value, padLength);
  filterTable(tableId, e.target.value);
}

const addFilterTableEvent = () => {
  const filterElements = [...document.querySelectorAll('[data-ft]')];
  filterElements.map(el => el.addEventListener('blur', filterTableLinstener));
}

export const start = () => {
  addFilterTableEvent();
}