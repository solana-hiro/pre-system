const updateValue = (e) => {
  e.target.value = Util.padZero(e.target.value, e.target.dataset.padCode);
}

const updateLivewire = (e) => {
  const livewireRoot = e.target.closest('[data-lw]');
  const [component] = livewireRoot ? Livewire.getByName(livewireRoot.dataset.lw) : [];
  if (component) component.set(e.target.dataset.lwo, e.target.value, false);
}

const paddingCodeListener = (e) => {
  updateValue(e);
  updateLivewire(e);
}

const addPaddingCodeEvent = () => {
  const elements = [...document.querySelectorAll('[data-pad-code]')];
  elements.map(el => el.addEventListener('blur', paddingCodeListener));
}

export const start = () => {
  addPaddingCodeEvent();
}
