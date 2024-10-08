/* 補完関連　共通処理 商品 JANコード登録マスタ */
function eventBlurCodeautoSku(event, element) {
    const nameArea = document.getElementById('item_name');
    if("" == element.value || null == element.value ){
        nameArea.value = '';
        return;
    }
    const params = {
        mt_item_cd: element.value,
    };
    const query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    manageUrl = "../../../code_auto/sku?" + query_params;
    console.log(manageUrl);

    fetch(manageUrl, {
        method: 'GET', // HTTPメソッドを指定
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(response => {
        return response.json();
    })
    .then(data => { // 取得したデータの処理
        //書き込み先の設定
        const alertArea = document.getElementById('alert-danger-ul');
        alertArea.innerHTML = "";
        if (null !== data) {
            //document.getElementById('names_item_code').innerHTML = data['item_name'];
            document.getElementById('redirect').value = element.value;
            document.getElementById('redirect').click();
        } else {
            const msgHTML = '<li>新規でのJANコード登録マスタへの登録はできません。</li>';
            alertArea.insertAdjacentHTML('beforeend', msgHTML);
            document.getElementById('names_item_code').innerHTML = "";
        }
    })
    .catch(error => {
        console.log(error); // エラー表示
    })
}

/* 補完関連　共通処理 商品 JANコードチェック */
function eventBlurJanCode(event, element) {
    const alertArea = document.getElementById('alert-danger-table');
    alertArea.innerHTML = "";
    if("" == element.value){
        return;
    }
    const item_cd = document.getElementById('input_item_code').value;
    const input_jan_cd = element.value;
    if(13 != element.value.length){
        const msgHTML = '<li>桁数が不正です</li>';
        alertArea.insertAdjacentHTML('beforeend', msgHTML);
        return;
    }

    inputCheckDigit = input_jan_cd.substr(-1);
    checkDigit = calcJanCodeDigit(input_jan_cd.substr(0,12))
    correctCheckDigit = String(input_jan_cd.substr(0,12)) + String(checkDigit) 
    if(checkDigit != inputCheckDigit){
        const msgHTML1 = `<li>チェックディジットが不正です。変更しました。</li>`;
        const msgHTML2 = `<li>（入力値）${input_jan_cd} （正しい値）${correctCheckDigit}</li>`;
        alertArea.insertAdjacentHTML('beforeend', msgHTML1);
        alertArea.insertAdjacentHTML('beforeend', msgHTML2);
        element.value = correctCheckDigit;
    }

    janCodeExistCheck(item_cd, element.value);

    return;
}

// janコードのチェックディジット計算
function calcJanCodeDigit(num){
        var arr = num.split('');
        var odd = 0;
        var mod = 0;
        for (var i = 0; i < arr.length; i++) {
            if ((i + 1) % 2 == 0) {
                //偶数の総和
                mod += parseInt(arr[i]);
            } else {
                //奇数の総和
                odd += parseInt(arr[i]);
            }
        }
        //偶数の和を3倍+奇数の総和を加算して、下1桁の数字を10から引く
        sum = (mod * 3) + odd;
        cd_number = String(sum).substr(-1);
        cd = 10 - parseInt(cd_number);
        //10なら1の位は0なので、0を返す。
        return cd === 10 ? 0 : cd;
}

// janコードの存在チェック
function janCodeExistCheck(item_cd, jan_cd){
    const params = {
        item_cd: item_cd,
        jan_cd: jan_cd,
    };
    const query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    manageUrl = "../../../code_auto/jan_check?" + query_params;
    console.log(manageUrl);

    fetch(manageUrl, {
        method: 'GET', // HTTPメソッドを指定
        headers: {
            'Content-Type': 'application/json',
        }
    })
    .then(response => {
        return response.json();
    })
    .then(data => { // 取得したデータの処理
        if("" != data && null != data){
            const alertArea = document.getElementById('alert-danger-table');
            const msgHTML = `<li>JANコードが重複しています</li>`;
            alertArea.insertAdjacentHTML('beforeend', msgHTML);
        }
    })
    .catch(error => {
        console.log(error); // エラー表示
    })
}