export const displayPreview = (file, preview) => {
  preview.src = URL.createObjectURL(file);
  preview.style.display = 'initial';
}

export const hidePreview = (preview) => {
  preview.src = '';
  preview.style.display = 'none';
}

export const removeInput = (input) => {
  input.value = '';
}

export const removeName = (name) => {
  name.innerText = '';
}

export const removeSrc = (src) => {
  src.value = '';
}

export const setName = (file, name) => {
  name.innerText = file.name;
}

// 実際のURLは不要で何かしらの値が入っていれば良い
export const setSrc = (src) => {
  console.log(src)
  src.value = 'attached';
}
