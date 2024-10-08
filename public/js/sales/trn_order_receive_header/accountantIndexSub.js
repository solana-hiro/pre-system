import { start } from '../../modules/search_master_modal/src/modal.js'

const showItemCdModal = (element) => {
    const item_cd_search_row = element.closest('.item_cd_search_row');
    // item_cd_search_row配下のinput要素を取得
    const item_kbn = item_cd_search_row.querySelector('.item_kbn');
    const item_kbn_value = item_kbn.value;
    const item_kbn_with_search = document.getElementById('item_kbn_with_search');
    item_kbn_with_search.value = item_kbn_value;
    const livewireRoot = item_kbn_with_search.closest('[data-lw]');
    const [component] = livewireRoot ? Livewire.getByName('master-search.item-cd') : [];
    if (component) {
        component.set('itemKbn', item_kbn_value, false);
    }
    const livewire_search_btn = document.getElementById('livewire_search_btn');
    livewire_search_btn.click();
}

const item_cd_search_btns = document.getElementsByClassName('item_cd_search_btn')
for (let i = 0; i < item_cd_search_btns.length; i++) {
    item_cd_search_btns[i].addEventListener('click', (event) => {
        showItemCdModal(event.target);
    })
}

document.getElementById('table_row_append_btn').addEventListener('click', () => {
    appendTableRow();
})
const appendTableRow = () => {
    let table_body = document.getElementById('table_body');
    let table_row_1 = document.getElementById('table_row_1');
    let table_row_2 = document.getElementById('table_row_2');

    let clone_row_1 = table_row_1.cloneNode(true);
    let clone_row_2 = table_row_2.cloneNode(true);

    // table_bodyのtrで(n-1)番目のtrを取得する
    let last_row = table_body.children[table_body.children.length - 2];
    // last_rowのtdの中でclassが"detail_id"の要素を取得する
    let last_row_detail_id = last_row.getElementsByClassName('detail_id')[0];
    // last_rowのtdの中でclassが"detail_id"の要素のvalueを取得する
    let last_row_detail_id_value = last_row_detail_id.textContent;
    // 値を更新する
    let new_detail_id = parseInt(last_row_detail_id_value) + 1;
    let clone_row_1_order_line_no = clone_row_1.getElementsByClassName('order_line_no')[0];
    clone_row_1_order_line_no.value = new_detail_id
    // new_detail_idをformatterする（３桁にして0を埋める）
    new_detail_id = new_detail_id.toString().padStart(3, '0');
    // clone_row_1の中でclassが"detail_id"の要素を取得する
    let clone_row_1_detail_id = clone_row_1.getElementsByClassName('detail_id')[0];
    // clone_row_1_detail_idの値を更新する
    clone_row_1_detail_id.textContent = new_detail_id;
    clone_row_1.getElementsByClassName('order_receive_detail_cd')[0].value = new_detail_id;

    // table_body配下のtrの数を取得する
    let row_count = table_body.children.length;

    // clone_row_1, clone_row_2の全てのtdに"bg-[#FFFFCC]"のクラスを追加する
    if ((row_count / 2) % 2 === 1) {
        for (let i = 0; i < clone_row_1.children.length; i++) {
            clone_row_1.children[i].classList.add('bg-[#FFFFCC]');
            clone_row_1.children[i].classList.remove('bg-[#FFFFFF]');
        }
        for (let i = 0; i < clone_row_2.children.length; i++) {
            clone_row_2.children[i].classList.add('bg-[#FFFFCC]');
            clone_row_2.children[i].classList.remove('bg-[#FFFFFF]');
        }
    }

    // clone_row_1のIDを更新する
    let row_1_id = table_body.children.length + 1;
    clone_row_1.id = 'table_row_' + row_1_id;

    // clone_row_2のIDを更新する
    let row_2_id = table_body.children.length + 2;
    clone_row_2.id = 'table_row_' + row_2_id;

    clone_row_1.getElementsByClassName('item_kbn')[0].value = 0;
    clone_row_1.getElementsByClassName('item_kbn')[0].name = 'details[' + (row_count / 2) + '][item_kbn]';
    clone_row_1.getElementsByClassName('item_cd')[0].value = '';
    clone_row_1.getElementsByClassName('item_cd')[0].name = 'details[' + (row_count / 2) + '][item_cd]';
    clone_row_1.getElementsByClassName('price_rate_input')[0].value = '';
    clone_row_1.getElementsByClassName('price_rate_input')[0].name = 'details[' + (row_count / 2) + '][price_rate]';
    clone_row_1.getElementsByClassName('retail_price_tax')[0].value = '';
    clone_row_1.getElementsByClassName('retail_price_tax')[0].name = 'details[' + (row_count / 2) + '][retail_price]';
    clone_row_1.getElementsByClassName('non_tax_kbn')[0].textContent = '';
    clone_row_1.getElementsByClassName('order_receive_price')[0].value = '';
    clone_row_1.getElementsByClassName('order_receive_price')[0].name = 'details[' + (row_count / 2) + '][order_receive_price]';
    clone_row_1.getElementsByClassName('order_receive_amount')[0].value = '';
    clone_row_1.getElementsByClassName('order_receive_amount')[0].name = 'details[' + (row_count / 2) + '][order_receive_amount]';
    clone_row_1.getElementsByClassName('release_start_datetime_year_with_td')[0].value = new Date().getFullYear();
    clone_row_1.getElementsByClassName('release_start_datetime_year_with_td')[0].name = 'details[' + (row_count / 2) + '][release_start_datetime_year]';
    clone_row_1.getElementsByClassName('release_start_datetime_month_with_td')[0].value = new Date().getMonth() + 1;
    clone_row_1.getElementsByClassName('release_start_datetime_month_with_td')[0].name = 'details[' + (row_count / 2) + '][release_start_datetime_month]';
    clone_row_1.getElementsByClassName('release_start_datetime_day_with_td')[0].value = new Date().getDate();
    clone_row_1.getElementsByClassName('release_start_datetime_day_with_td')[0].name = 'details[' + (row_count / 2) + '][release_start_datetime_day]';
    clone_row_1.getElementsByClassName('specify_deadline_none_flg')[0].checked = false;
    clone_row_1.getElementsByClassName('specify_deadline_none_flg')[0].name = 'details[' + (row_count / 2) + '][specify_deadline_none_flg]';
    clone_row_1.getElementsByClassName('order_receive_finish_flg')[0].value = 0;
    clone_row_1.getElementsByClassName('order_receive_finish_flg')[0].name = 'details[' + (row_count / 2) + '][order_receive_finish_flg]';
    clone_row_1.getElementsByClassName('shortage_flg')[0].checked = false;
    clone_row_1.getElementsByClassName('shortage_flg')[0].name = 'details[' + (row_count / 2) + '][shortage_flg]';
    clone_row_1.getElementsByClassName('remaining_flg')[0].checked = false;
    clone_row_1.getElementsByClassName('remaining_flg')[0].name = 'details[' + (row_count / 2) + '][remaining_flg]';
    clone_row_1.getElementsByClassName('payment_finish_flg')[0].checked = false;
    clone_row_1.getElementsByClassName('payment_finish_flg')[0].name = 'details[' + (row_count / 2) + '][payment_finish_flg]';
    clone_row_1.getElementsByClassName('memo_1')[0].value = '';
    clone_row_1.getElementsByClassName('memo_1')[0].name = 'details[' + (row_count / 2) + '][memo_1]';

    clone_row_2.getElementsByClassName('item_name')[0].value = '';
    clone_row_2.getElementsByClassName('item_name')[0].name = 'details[' + (row_count / 2) + '][item_name]';
    clone_row_2.getElementsByClassName('unit')[0].textContent = '';
    clone_row_2.getElementsByClassName('order_receive_quantity')[0].value = '';
    clone_row_2.getElementsByClassName('order_receive_quantity')[0].name = 'details[' + (row_count / 2) + '][order_receive_quantity]';
    clone_row_2.getElementsByClassName('profit_calculation_cost_price')[0].value = '';
    clone_row_2.getElementsByClassName('profit_calculation_cost_price')[0].name = 'details[' + (row_count / 2) + '][cost_price]';
    clone_row_2.getElementsByClassName('cost_amount')[0].value = '';
    clone_row_2.getElementsByClassName('memo_2')[0].value = '';
    clone_row_2.getElementsByClassName('memo_2')[0].name = 'details[' + (row_count / 2) + '][memo_2]';

    // table_bodyに追加する
    table_body.appendChild(clone_row_1);
    table_body.appendChild(clone_row_2);

    start();
}
