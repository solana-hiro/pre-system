/* 補完関連 共通処理 商品分類 */
export const eventBlurCodeautoItemClass = (element) => {
    if (null === element.value || "" === element.value) {
        return false;
    }
    // const alertId = element.id.replace('input', 'alert');
    const elementId = element.id.replace('input', 'names');
    const nameArea = document.getElementById(elementId);
    const itemClassThingId = element.id.replace('input_code', '');

    const livewireRoot = element.closest('[data-lw]');
    const [component] = livewireRoot ? Livewire.getByName(livewireRoot.dataset.lw) : [];
    if (component) component.set(element.dataset.lwo, element.value, false);

    const params = {
        item_class_cd: element.value,
        def_item_class_thing_id: itemClassThingId,
    };
    let query_params = new URLSearchParams(params);
    // 管理用urlの上書き
    const manageUrl = "../../../../code_auto/item_class?" + query_params;

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
            if (null !== data) {
                nameArea.value = data['item_class_name'];
            } else {
                nameArea.value = "";
            }
        })
        .catch(error => {
            console.log(error); // エラー表示
        });
}