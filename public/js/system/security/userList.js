function blurCodeAutoDepartments(event, element) {
    //書き込み先の設定
    let alertArea = document.getElementById('alert-danger-ul');
    let nameArea = document.getElementById('names_department');
    //部門
    let data = [];
    if("" == element.value) {  //列数
        nameArea.innerHTML = "";
        return;
    }
    element.value = element.value.toString().padStart(4, '0');
    const params = {
        department_cd: element.value,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../code_auto/department?" + query_params;
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
            alertArea.innerHTML = "";
            if (null !== data) {
                nameArea.innerHTML = data['department_name'];
            } else {
                let msgHTML = '<li>未登録の部門定義です</li>';
                alertArea.insertAdjacentHTML('beforeend', msgHTML);
                nameArea.innerHTML = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}