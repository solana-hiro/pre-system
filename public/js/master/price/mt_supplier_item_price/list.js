const valueCopyEvent = (e) => {
  const copyTarget = document.getElementById('input_item_code_end');
  copyTarget.value = e.currentTarget.value;
}

const addValueCopyEvent = () => {
  const element = document.getElementById('input_item_code_start');
  element.addEventListener('blur', valueCopyEvent);
}

const start = () => {
  addValueCopyEvent();
}

start();