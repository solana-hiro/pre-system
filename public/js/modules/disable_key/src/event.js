import { isEnter, isLImitMinux, isMinus } from './detect.js';

const disableListener = (e) => {
  if (isEnter(e.key)) e.preventDefault();
  if (isMinus(e.key) && isLImitMinux(e.target.dataset)) e.preventDefault();
}

const addKeydownEvent = () => {
  const elements = document.querySelectorAll('input');
  [...elements].map(el => el.addEventListener('keydown', disableListener));
}

export const start = () => {
  addKeydownEvent();
}
