import {
  displayPreview,
  hidePreview,
  removeInput,
  removeName,
  removeSrc,
  setName,
  setSrc
} from './dom.js';

const selectClickListener = (e) => {
  const [input] = document.getElementsByName(e.target.dataset.selectImage);
  input.click();
}

const fileChangeListener = (e) => {
  const [file] = e.target.files;
  const preview = document.querySelector(`[data-image-preview=${e.target.name}]`);
  const name = document.querySelector(`[data-image-name=${e.target.name}]`);
  const src = document.querySelector(`[data-image-src=${e.target.name}]`);
  if(preview) file ? displayPreview(file, preview) : hidePreview(preview);
  file ? setName(file, name) : removeName(name);
  file ? setSrc(src) : removeSrc(src);
}

const deleteClickListener = (e) => {
  const [input] = document.getElementsByName(e.target.dataset.deleteImage);
  const preview = document.querySelector(`[data-image-preview=${e.target.dataset.deleteImage}]`);
  const name = document.querySelector(`[data-image-name=${e.target.dataset.deleteImage}]`);
  const src = document.querySelector(`[data-image-src=${e.target.dataset.deleteImage}]`);
  removeInput(input);
  if(preview) hidePreview(preview);
  removeName(name);
  removeSrc(src);
}

const addSelectClickEvent = () => {
  const elements = [...document.querySelectorAll('[data-select-image]')];
  elements.map(el => el.addEventListener('click', selectClickListener));
}

const addFileChangeEvent = () => {
  const elements = [...document.querySelectorAll('[data-input-image]')];
  elements.map(el => el.addEventListener('change', fileChangeListener));
}

const addDeleteClickEvent = () => {
  const elements = [...document.querySelectorAll('[data-delete-image]')];
  elements.map(el => el.addEventListener('click', deleteClickListener));
}

export const start = () => {
  addSelectClickEvent();
  addFileChangeEvent();
  addDeleteClickEvent();
}