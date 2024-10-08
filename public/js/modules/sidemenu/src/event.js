
const getAccordionId = (e) => {
  return e.currentTarget.parentNode.dataset.content;
}

const getDefs = (e) => {
  const accordionId = e.currentTarget.parentNode.dataset.content;
  const menuIds = accordionId.replace('#box', '');
  return menuIds.split('_', 2);
}

const createInputElement = (e, unSelectedFlag = false) => {
  const [def1, def2] = getDefs(e);
  const el = document.createElement('input');
  el.type = 'hidden';
  el.name = def2 ? `selected_def2[]` : `selected_def1[]`;
  el.value = unSelectedFlag ? 0 : def2 || def1;
  return el;
}

const append = (e, selectedDiv, newEl) => {
  const unSelectedElement = createInputElement(e, true);
  const existEl = [...selectedDiv.querySelectorAll('input')].find(el => el.isEqualNode(unSelectedElement));
  if (existEl) existEl.remove();
  selectedDiv.appendChild(newEl);
}

const remove = (e, selectedDiv, existEl) => {
  const unSelectedElement = createInputElement(e, true);
  existEl.remove();
  const selected = [...selectedDiv.querySelectorAll(`input[name="${unSelectedElement.name}"]`)];
  if (selected.length === 0) selectedDiv.appendChild(unSelectedElement);
}

const toggleElement = (e, selectedDiv) => {
  if (!selectedDiv) return;

  const newEl = createInputElement(e); // toggleInput内で定義し引数で渡すとおかしくなる
  const existEl = selectedDiv ? [...selectedDiv.querySelectorAll('input')].find(el => el.isEqualNode(newEl)) : undefined;
  // existEl ? existEl.remove() : selectedDiv.appendChild(newEl);
  existEl ? remove(e, selectedDiv, existEl) : append(e, selectedDiv, newEl);
}

const toggleDisplay = (e) => {
  const accordionId = getAccordionId(e);
  const accordionTarget = document.querySelector(accordionId);
  e.currentTarget.classList.toggle('selected');
  accordionTarget.classList.toggle('hidden');
}

const toggleInput = (e) => {
  const divForSidemenu = document.getElementById('selected-menu-for-sidemenu');
  const divForMain = document.getElementById('selected-menu-for-main');
  toggleElement(e, divForSidemenu);
  toggleElement(e, divForMain);
}

const hideContextMenu = () => {
  const contextMenu = document.getElementById('sidemenu-context');
  contextMenu.classList.remove('block');
  contextMenu.classList.add('hidden');
}

const layer1MenuListener = (e) => {
  toggleDisplay(e);
  toggleInput(e);
}

const layer2MenuListener = (e) => {
  toggleDisplay(e);
  toggleInput(e);
}

const layer3MenuListener = (e) => {
  e.preventDefault();
  const contextMenu = document.getElementById('sidemenu-context');
  const button = contextMenu.querySelector('button');
  const posX = e.pageX;
  const posY = e.pageY;
  contextMenu.style.left = posX + 'px';
  contextMenu.style.top = posY + 'px';
  contextMenu.classList.remove('hidden');
  contextMenu.classList.add('block');
  button.value = e.currentTarget.dataset.route;
}

const hideContextMenuListener = (e) => {
  const contextMenu = document.getElementById('sidemenu-context');
  if (contextMenu.classList.contains('block')) {
    hideContextMenu();
  }
}

const clickNewTabListener = (e) => {
  window.open(e.currentTarget.value);
  hideContextMenu();
}

const addLayer1MenuEvent = () => {
  const elements = [...document.querySelectorAll('[data-sidemenu="1"]')];
  elements.map(el => el.addEventListener('click', layer1MenuListener));
}

const addLayer2MenuEvent = () => {
  const elements = [...document.querySelectorAll('[data-sidemenu="2"]')];
  elements.map(el => el.addEventListener('click', layer2MenuListener));
}

const addLayer3MenuEvent = () => {
  const elements = [...document.querySelectorAll('[data-sidemenu="3"]')];
  elements.map(el => el.addEventListener('contextmenu', layer3MenuListener));
}

const addHideContextMenuEvent = () => {
  document.body.addEventListener('click', hideContextMenuListener);
}

const addClickNewTabEvent = () => {
  const element = document.getElementById('open-new-tab');
  element.addEventListener('click', clickNewTabListener);
}

export const start = () => {
  addLayer1MenuEvent();
  addLayer2MenuEvent();
  addLayer3MenuEvent();
  addHideContextMenuEvent();
  addClickNewTabEvent();
}