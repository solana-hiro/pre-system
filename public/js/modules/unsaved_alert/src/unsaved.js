// 画面ロード時のフォーム格納用
let initializedFormData = [];

const exclude = (formData, form) => {
  const elements = [...form.querySelectorAll('input[type="hidden"],[data-monitoring-exclude]')];
  elements.map(el => formData.delete(el.name));
  return formData;
}

const getFormData = () => {
  const forms = [...document.querySelectorAll('form[data-monitoring]')];
  const formData = forms.map(el => new FormData(el));
  const excludedFormData = formData.map((el, index) => { return exclude(el, forms[index]) });
  return excludedFormData;
}

const getIitializedFormData = () => {
  initializedFormData = getFormData();
}

const isFileObject = (value) => {
  return value?.constructor?.name === 'File';
}

const isSameFile = (latestFile, initializedFile) => {
  return latestFile.name === initializedFile.name;
  // && latestFile.size === initializedFile.size
  // && latestFile.lastModified === initializedFile.lastModified
  // イメージはエラー時に情報が保持できない、既存画像をInputに格納していない（できない？）
  // そのため現状initialize時点では100%空になるので名前の比較のみ行う
}

const isEqual = (latestValue, initializedValue) => {
  if (isFileObject(latestValue)) return isSameFile(latestValue, initializedValue);
  console.log(_.isEqual(latestValue, initializedValue))
  return _.isEqual(latestValue, initializedValue);
}

const isEqualFormData = (latestFormData) => {
  const isEqualResults = latestFormData.map((_el, index) => {
    const latest = [...latestFormData[index].entries()];
    const initialized = [...initializedFormData[index].entries()];
    console.log('latest')
    latest.map(el => console.log(el));
    console.log('initialized')
    initialized.map(el => console.log(el));
    if (latest.length !== initialized.length) return false;

    const result = latest.map((_el, index) => {
      console.log(isEqual(latest[index][1], initialized[index][1]));
      return isEqual(latest[index][1], initialized[index][1]);
    });
    return result.every(el => el);
  });
  return isEqualResults.every(el => el === true);
}

const alertUnsaved = (e) => {
  const latestFormData = getFormData();
  if (isEqualFormData(latestFormData)) return;

  e.preventDefault();
}

const addBeforeunloadEvent = () => {
  window.addEventListener('beforeunload', alertUnsaved);
}

export const start = () => {
  getIitializedFormData();
  addBeforeunloadEvent();
}

export const disable = () => {
  window.removeEventListener('beforeunload', alertUnsaved);
}