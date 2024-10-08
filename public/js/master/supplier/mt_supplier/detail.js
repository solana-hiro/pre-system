const DELETED_SUPPLIER_LI_MESSAGE = "<li>削除区分が有効になっているコードです。</li>";
const NEW_SUPPLIER_LI_MESSAGE = "<li>新規データです。</li>";
const NOT_FOUND_PAY_DESTINATION_LI_MESSAGE = "<li>新規データです</li>";
const NOT_FOUND_SLIP_KIND_LI_MESSAGE = "<li>伝票種別ファイルの登録を行ってください。</li>";
const NOT_FOUND_SUPPLIER_CLASS_LI_MESSAGE = [
  "",
  "<li>仕入先分類1マスタの登録を行ってください。</li>",
  "<li>仕入先分類2マスタの登録を行ってください。</li>",
  "<li>仕入先分類3マスタの登録を行ってください。</li>",
];
const NOT_FOUND_USER_LI_MESSAGE = "<li>ユーザマスタの登録を行ってください。</li>";
const INVALID_SEQUENTIALLY_KBN_LI_MESSAGE = "<li>随時締の仕入先を指定することはできません。</li>";
const INVALID_CLOSING_DATA_LI_MESSAGE = "<li>締日の異なる仕入先を指定することはできません。</li>";

const clearUpdateId = () => {
  document.getElementById("update_id").value = "";
}

const invalidClosingData = (data) => {
  const bkClosingDate = document.getElementById("bk_closing_date").dataset.bk_closing_date;
  const bkClosingMonth = document.getElementById("bk_closing_month").dataset.bk_closing_month;
  if (data.closing_date != (bkClosingDate || null)) return true;
  if (data.closing_month != bkClosingMonth) return true;
  return false;
}

const deletedSupplier = (data) => {
  return data.del_kbn == 1 ? true : false;
}

const diffrentCode = () => {
  const supplierCd = document.getElementById("input_supplier").value;
  const payDestinationCd = document.getElementById("input_pay_destination").value;
  return supplierCd !== payDestinationCd;
}

const clearNameOfCode = (elementId) => {
  document.getElementById(elementId).value = "";
}

const setNameOfCode = (elementId, text) => {
  document.getElementById(elementId).value = text;
}

const setPayDestinationData = (data) => {
  setSequentiallyKbn(data);
  setClosingDate(data);
  setClosingMonth(data);
  setPayDate(data);
  setPriceFractionProcess(data);
  setAllAmountFractionProcess(data);
  setTaxKbn(data);
  setTaxCalculationStandard(data);
  setTaxFractionProcess1(data);
  setTaxFractionProcess2(data);
  // selectedの状態を見てdisableを判定するため同期処理としたい
  updateFormStateForChangePayDestinationCode();
}

const setSequentiallyKbn = (data) => {
  document.getElementsByName("sequentially_kbn")[data.sequentially_kbn].checked = true;
}

const setClosingDate = (data) => {
  document.getElementsByName("closing_date")[0].value = data.closing_date;
}

const setClosingMonth = (data) => {
  document.getElementsByName("closing_month")[data.closing_month].checked = true;
}

const setPayDate = (data) => {
  document.getElementsByName("pay_date")[0].value = data.pay_date;
}

const setPriceFractionProcess = (data) => {
  document.getElementsByName("price_fraction_process")[0].checked = data.price_fraction_process == 0;
  document.getElementsByName("price_fraction_process")[1].checked = data.price_fraction_process == 5;
  document.getElementsByName("price_fraction_process")[2].checked = data.price_fraction_process == 9;
}

const setAllAmountFractionProcess = (data) => {
  document.getElementsByName("all_amount_fraction_process")[0].checked = data.all_amount_fraction_process == 0;
  document.getElementsByName("all_amount_fraction_process")[1].checked = data.all_amount_fraction_process == 5;
  document.getElementsByName("all_amount_fraction_process")[2].checked = data.all_amount_fraction_process == 9;
}

const setTaxKbn = (data) => {
  document.getElementsByName("tax_kbn")[0].checked = data.tax_kbn == 1;
  document.getElementsByName("tax_kbn")[1].checked = data.tax_kbn == 2;
}

const setTaxCalculationStandard = (data) => {
  document.getElementsByName("tax_calculation_standard")[0].checked = data.tax_calculation_standard == 1;
  document.getElementsByName("tax_calculation_standard")[1].checked = data.tax_calculation_standard == 2;
  document.getElementsByName("tax_calculation_standard")[2].checked = data.tax_calculation_standard == 3;
  document.getElementsByName("tax_calculation_standard")[3].checked = data.tax_calculation_standard == 9;
}

const setTaxFractionProcess1 = (data) => {
  document.getElementsByName("tax_fraction_process_1")[data.tax_fraction_process_1].checked = true;
}

const setTaxFractionProcess2 = (data) => {
  document.getElementsByName("tax_fraction_process_2")[0].checked = data.tax_fraction_process_2 == 0;
  document.getElementsByName("tax_fraction_process_2")[1].checked = data.tax_fraction_process_2 == 5;
  document.getElementsByName("tax_fraction_process_2")[2].checked = data.tax_fraction_process_2 == 9;
}

const enableRadioButton = (name) => {
  document.getElementsByName(name).forEach((el) => {
    // el.parentElement.classList.remove("pointer-events-none");
    el.disabled = false;
  });
}

const disableRadioButton = (name) => {
  document.getElementsByName(name).forEach((el) => {
    // el.parentElement.classList.add("pointer-events-none");
    if(!el.checked) el.disabled = true;
  });
}

const enableInputText = (name) => {
  document.getElementsByName(name)[0].readOnly = false;
}

const disableInputText = (name) => {
  document.getElementsByName(name)[0].readOnly = true;
}


const allowRadioButton = (name) => {
  document.getElementsByName(name).forEach((el) => {
    el.disabled = false;
  });
}

const disallowRadioButton = (name) => {
  document.getElementsByName(name).forEach((el) => {
    el.disabled = true;
  });
}

const allowInputText = (name) => {
  document.getElementsByName(name)[0].disabled = false;
}

const disallowInputText = (name) => {
  document.getElementsByName(name)[0].disabled = true;
}

// 支払先変更時
const updateFormStateForChangePayDestinationCode = () => {
  if (diffrentCode()) {
    disableRadioButton('sequentially_kbn');
    disableInputText('closing_date');
    disableRadioButton('closing_month');
    disableInputText('pay_date');
    disableRadioButton('price_fraction_process');
    disableRadioButton('all_amount_fraction_process');
    disableRadioButton('tax_kbn');
    disableRadioButton('tax_calculation_standard');
    disableRadioButton('tax_fraction_process_1');
    disableRadioButton('tax_fraction_process_2');
    return;
  }
  enableRadioButton('sequentially_kbn');
  enableInputText('closing_date');
  enableRadioButton('closing_month');
  enableInputText('pay_date');
  enableRadioButton('price_fraction_process');
  enableRadioButton('all_amount_fraction_process');
  enableRadioButton('tax_kbn');
  enableRadioButton('tax_calculation_standard');
  enableRadioButton('tax_fraction_process_1');
  enableRadioButton('tax_fraction_process_2');
}

// 税区分変更時
const updateFormStateForChangeTaxKbn = (e) => {
  if (e.target.checked) {
    e.target.value == 1 && enableRadioButton('tax_calculation_standard');
    e.target.value == 2 && disableRadioButton('tax_calculation_standard');
  }
}

// 随時区分変更時
const updateFormStateForChangeSequentiallyKbn = (e) => {
  if (e.target.checked) {
    if (e.target.value == 0) {
      allowInputText('closing_date');
      allowRadioButton('closing_month');
      allowInputText('pay_date');
      return;
    }
    disallowInputText('closing_date');
    disallowRadioButton('closing_month');
    disallowInputText('pay_date');
  }
}

// 削除フラグONのモーダルのメッセージ変更のため
// ボタンに付与される削除フラグの値を更新する
const updateButtonValue = () => {
  document.getElementById("updateButton").dataset.delKbn = document.forms.check_target.del_kbn.value;
}

// 仕入先コード保管の改良版
const autoComplementSupplierCode = async (e) => {
  if (!e.target.value) {
    return;
  }
  try {
    e.target.value = e.target.value.padStart(6, '0');
    const { data } = await axios.get("../../../../code_auto/supplier", {
      params: { supplier_cd: e.target.value },
    });
    AlertMsg.clear();
    if (!data) { // 新規データ
      document.getElementById("input_pay_destination").value = e.target.value;
      clearUpdateId();
      return AlertMsg.insert(NEW_SUPPLIER_LI_MESSAGE);
    }

    // 該当データへリダイレクト
    document.getElementById("redirect").value = e.target.value;
    document.getElementById("redirect_hidden").value = data.id;
    document.getElementById("redirect").click();
  } catch (e) {
    console.log(e);
  }
}

// 支払先コード補完の改良版
const autoCompletePayDestinationCode = async (e) => {
  if (!e.target.value) {
    return;
  }
  try {
    e.target.value = e.target.value.padStart(6, '0');
    supplier_id = document.getElementById('update_id').value;

    const { data } = await axios.get("../../../../code_auto/pay_destination", {
      params: { pay_destination_cd: e.target.value },
    });
    AlertMsg.clear();

    if (!data) return AlertMsg.insert(NOT_FOUND_PAY_DESTINATION_LI_MESSAGE);                                  // 支払先なし
    if (deletedSupplier(data)) return AlertMsg.insert(DELETED_SUPPLIER_LI_MESSAGE);                           // 仕入先が削除区分ONのデータ
    if (diffrentCode() && data.sequentially_kbn) return AlertMsg.insert(INVALID_SEQUENTIALLY_KBN_LI_MESSAGE); // 支払先の締日が随時
    if (supplier_id && invalidClosingData(data)) return AlertMsg.insert(INVALID_CLOSING_DATA_LI_MESSAGE);                    // 支払先変更時の締日が一致しない

    setPayDestinationData(data);

  } catch (e) {
    console.log(e);
  }
}

// 仕入先分類<n>コード補完
const autoCompleteSupplierClassCode = async (e) => {
  const supplierClassThingId = e.target.id.slice(-1);   // 入力ID：input_supplier_class<n>が前提
  if (e.target.value) {
    try {
      const { data } = await axios.get("../../../../code_auto/supplier_class", {
        params: {
          def_supplier_class_thing_id: supplierClassThingId,
          supplier_class_cd: e.target.value,
        },
      });
      AlertMsg.clear();
      if (!data) {
        AlertMsg.insert(NOT_FOUND_SUPPLIER_CLASS_LI_MESSAGE[supplierClassThingId]);
        clearNameOfCode(`name_supplier_class${supplierClassThingId}`);
        return;
      }

      setNameOfCode(`name_supplier_class${supplierClassThingId}`, data.supplier_class_name);
    } catch (e) {
      console.log(e);
    }
  } else { // 入力が空の場合は表示をクリア
    clearNameOfCode(`name_supplier_class${supplierClassThingId}`);
  }
}

// 日付補完
const autoCompleteDate = (e) => {
  if (e.target.readOnly) return;
  if (!e.target.value) return;

  const date = Number(e.target.value);
  ((1 <= date && date <= 27) || date === 99)
    ? e.target.value = e.target.value.padStart(2, '0')
    : e.target.value = '99';
}

// ユーザー補完
const autoCompleteUser = async (e) => {
  if (e.target.value) {
    e.target.value = e.target.value.padStart(4, '0');
    try {
      const { data } = await axios.get("../../../../code_auto/user", {
        params: { user_cd: e.target.value },
      });
      AlertMsg.clear();
      if (!data) {
        AlertMsg.insert(NOT_FOUND_USER_LI_MESSAGE);
        clearNameOfCode("user_name");
        return;
      }

      setNameOfCode("user_name", data.user_name);
    } catch (e) {
      console.log(e);
    }
  } else { // 入力が空の場合は表示をクリア
    clearNameOfCode("user_name");
  }
}

// 発注伝票補完
const autoCompleteSlipKind = async (e) => {
  if (e.target.value) {
    try {
      const { data } = await axios.get("../../../../code_auto/slip_kind", {
        params: {
          slip_kind_cd: e.target.value,
          slip_kind_kbn_cd: '04', // 発注伝票
        },
      });
      AlertMsg.clear();
      if (!data) {
        AlertMsg.insert(NOT_FOUND_SLIP_KIND_LI_MESSAGE);
        clearNameOfCode("name_slip_kind");
        return;
      }

      setNameOfCode("name_slip_kind", data.slip_kind_name);
    } catch (e) {
      console.log(e);
    }
  } else { // 入力が空の場合は表示をクリア
    clearNameOfCode("name_slip_kind");
  }
}


// 随時区分変更時（ロード時のチェック用）
const checkFormStateForChangeSequentiallyKbn = () => {
  const target = document.getElementsByName('sequentially_kbn')[1];
  if (target.checked) {
    if (target.value == 0) {
      allowInputText('closing_date');
      allowRadioButton('closing_month');
      allowInputText('pay_date');
      return;
    }
    disallowInputText('closing_date');
    disallowRadioButton('closing_month');
    disallowInputText('pay_date');
  }
}
// 画面ロード時の無効化
window.addEventListener('load', updateFormStateForChangePayDestinationCode);
window.addEventListener('load', checkFormStateForChangeSequentiallyKbn);