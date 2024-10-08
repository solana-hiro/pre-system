const NEW_BANK_LI_MESSAGE = "<li>新規データです</li>";
const EXIST_BANK_CODE_LI_MESSAGE = "<li>登録済みの銀行コードです</li>";

const clearInputBank = (e) => {
  const parent = e.target.parentNode;
  parent.parentNode.cells[parent.cellIndex + 1].childNodes[0].value = "";
}

const setInputBank = (e, data) => {
  const parent = e.target.parentNode;
  parent.parentNode.cells[parent.cellIndex + 1].childNodes[0].value = data.bank_name;
}

// 銀行補完
const autoCompleteBank = async (e) => {
  if (e.target.value) {
    e.target.value = e.target.value.padStart(4, '0');
    try {
      const { data } = await axios.get("../../../../code_auto/bank", {
        params: { bank_cd: e.target.value },
      });
      AlertMsg.clear();
      if (!data) {
        clearInputBank(e);
        return AlertMsg.insert(NEW_BANK_LI_MESSAGE);
      }

      setInputBank(e, data);
      AlertMsg.insert(EXIST_BANK_CODE_LI_MESSAGE);
    } catch (e) {
      console.log(e);
    }
  } else { // 入力が空の場合は表示をクリア
    clearInputBank(e);
  }
}