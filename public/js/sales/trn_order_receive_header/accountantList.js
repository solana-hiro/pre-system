var isShowConstrictedExtractionCondition = false;
var selected_kbn = 0;

function toggleSearchPanel() {
  if (isShowConstrictedExtractionCondition) {
    document.getElementById('constrictedExtractionConditionBlock').classList.add('hidden');
  } else {
    document.getElementById('constrictedExtractionConditionBlock').classList.remove('hidden');
  }
  isShowConstrictedExtractionCondition = !isShowConstrictedExtractionCondition;
}

// ページ読み込み時に実行
window.onload = function () {
  selectKbn(selected_kbn);
}

function selectKbn(kbn) {
  setTimeout(() => {
    selected_kbn = kbn;

    const deadline_year = document.getElementById('deadline-year');
    const deadline_month = document.getElementById('deadline-month');
    const deadline_day = document.getElementById('deadline-date');
    const deadline_calendar_btn = document.getElementById('deadline-calendar-btn');
    const kbn_2 = document.getElementsByClassName('kbn_2');
    const kbn_1 = document.getElementsByClassName('kbn_1');
    const kbn_0 = document.getElementsByClassName('kbn_0');

    if (selected_kbn == 0 || selected_kbn == 2) {
      deadline_year.disabled = true;
      deadline_month.disabled = true;
      deadline_day.disabled = true;
      deadline_calendar_btn.style.visibility = 'hidden';
    } else {
      deadline_year.disabled = false;
      deadline_month.disabled = false;
      deadline_day.disabled = false;
      deadline_calendar_btn.style.visibility = 'visible';
    }

    const grid_header = document.getElementsByClassName('grid_header')[0];
    const grid_header_th = grid_header.getElementsByTagName('td');
    const grid_body = document.getElementsByClassName('grid_body')[0];
    const grid_body_td = grid_body.getElementsByTagName('td');

    // grid_header_thの要素を表示
    for (var i = 0; i < grid_header_th.length; i++) {
      grid_header_th[i].style.display = 'table-cell';
    }
    // grid_body_tdの要素を表示
    for (var i = 0; i < grid_body_td.length; i++) {
      grid_body_td[i].style.display = 'table-cell';
    }

    if (selected_kbn == 0) {
      // kbn_0の要素を非表示
      for (var i = 0; i < kbn_0.length; i++) {
        kbn_0[i].style.display = 'none';
      }
    }
    if (selected_kbn == 1) {
      // kbn_1の要素を非表示
      for (var i = 0; i < kbn_1.length; i++) {
        kbn_1[i].style.display = 'none';
      }
    }
    if (selected_kbn == 2) {
      // kbn_2の要素を非表示
      for (var i = 0; i < kbn_2.length; i++) {
        kbn_2[i].style.display = 'none';
      }
    }
  }, 500)
}

function clickAllCheckbox() {
    if (selected_kbn == 0) {
        var allEcCheckFlg = document.getElementsByClassName('ec_check_flg');
        // 全てのallEcCheckFlgのチェックを入れる
        for (var i = 0; i < allEcCheckFlg.length; i++) {
            allEcCheckFlg[i].checked = true;
        }
    } else if (selected_kbn == 1) {
        var allShippingCheckFlg = document.getElementsByClassName('shipping_check_flg');
        // 全てのallShippingCheckFlgのチェックを入れる
        for (var i = 0; i < allShippingCheckFlg.length; i++) {
            allShippingCheckFlg[i].checked = true;
        }
    } else {
        var allDestinationCheckFlg = document.getElementsByClassName('destination_check_flg');
        // 全てのallDestinationCheckFlgのチェックを入れる
        for (var i = 0; i < allDestinationCheckFlg.length; i++) {
            allDestinationCheckFlg[i].checked = true;
        }
    }
}

function clearAllCheckbox() {
    if (selected_kbn == 0) {
        var allEcCheckFlg = document.getElementsByClassName('ec_check_flg');
        // 全てのallEcCheckFlgのチェックを外す
        for (var i = 0; i < allEcCheckFlg.length; i++) {
            allEcCheckFlg[i].checked = false;
        }
    } else if (selected_kbn == 1) {
        var allShippingCheckFlg = document.getElementsByClassName('shipping_check_flg');
        // 全てのallShippingCheckFlgのチェックを外す
        for (var i = 0; i < allShippingCheckFlg.length; i++) {
            allShippingCheckFlg[i].checked = false;
        }
    } else {
        var allDestinationCheckFlg = document.getElementsByClassName('destination_check_flg');
        // 全てのallDestinationCheckFlgのチェックを外す
        for (var i = 0; i < allDestinationCheckFlg.length; i++) {
            allDestinationCheckFlg[i].checked = false;
        }
    }
}

function initialize() {
    // 現在のURLを取得し、パラメーターを取り除く
    const url = window.location.origin + window.location.pathname;

    // URLをパラメーターなしに更新し、画面をリロード
    window.history.replaceState({}, document.title, url);
    window.location.reload();
}
