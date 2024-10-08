const NEW_NOTICE_CODE = '<li>新規のデータです</li>'

const redirect = (data) => {
  document.getElementById('redirect').value = data.id;
  document.getElementById('redirect').click();
}

const setNotice = (data) => {
  if (data) return redirect(data);
  AlertMsg.clear();
  AlertMsg.insert(NEW_NOTICE_CODE);
}

// redirect
const autoCompleteNotice = async (e) => {
  if (!e.target.value) return;
  try {
    e.target.value = Util.padZero(e.target.value, 4);
    const { data } = await axios.get('../../../../code_auto/notice', {
      params: { notice_cd: e.target.value },
    });
    setNotice(data);
  } catch (e) {
    console.log(e);
  }
}

const autoCompleteListener = (e) => {
  if (e.target.dataset.ac === 'notice') autoCompleteNotice(e);
  return false;
}

const addAutoCompleteEvent = () => {
  const elements = [...document.querySelectorAll('[data-ac]')];
  elements.map(el => el.addEventListener('blur', autoCompleteListener));
}

const start = () => {
  addAutoCompleteEvent();
}

start();