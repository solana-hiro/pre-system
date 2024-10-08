const limitLengthLinstener = (e) => {
  const limit = e.target.dataset.limitLen;
  e.target.value = e.target.value.slice(0, limit);
}

const addLimitLengthEvent = () => {
  const limitElements = [...document.querySelectorAll('[data-limit-len]')];
  limitElements.map(el => el.addEventListener('input', limitLengthLinstener));
}

export const start = () => {
  addLimitLengthEvent();
}