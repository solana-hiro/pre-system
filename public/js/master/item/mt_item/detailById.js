/* 商品詳細 start */
// 列追加
function itemDetailAddRow() {
    var table1 = document.getElementById("pattern_grid_table");
    var row = table1.insertRow(-1);
    var cell1 = row.insertCell(-1);
    var cell2 = row.insertCell(-1);
    cell1.innerHTML = '<input type="text" placeholder="" class="grid_textbox" name="class_code[]" minlength="0" maxlength="4">';
    cell2.innerHTML = '<input type="text" placeholder="" class="grid_textbox" name="class_name[]" minlength="0" maxlength="20">';
}


// 行追加
function itemDetailAddLine1() {
    var table1 = document.getElementById("pattern_grid_table");
    var row = table1.insertRow(-1);
    var cell1 = row.insertCell(-1);
    var cell2 = row.insertCell(-1);
    cell1.innerHTML = '<input type="text" placeholder="" class="grid_textbox" name="class_code[]" minlength="0" maxlength="4">';
    cell2.innerHTML = '<input type="text" placeholder="" class="grid_textbox" name="class_name[]" minlength="0" maxlength="20">';
}



// 行追加
function itemDetailAddLine2() {
    //var table1 = document.getElementById("member_grids");
    /*
    var row = table1.insertRow(-1);
    var cell1 = row.insertCell(-1);
    var cell2 = row.insertCell(-1);
    var cell3 = row.insertCell(-1);
    var cell4 = row.insertCell(-1);
    cell1.className = "grid_col_1 col_rec";
    cell2.className = "grid_col_2 col_rec";
    cell3.className = "grid_col_2 col_rec";
    cell4.className = "grid_col_2 col_rec";
    cell1.innerHTML = '<input type="text" placeholder="" name="ec_item_cd" class="grid_textbox" value="">';
    cell2.innerHTML = '<input type="text" placeholder="" name="ec_item_name" class="grid_textbox" value="">';
    cell3.innerHTML = '<input type="text" placeholder="" name="display_order" class="grid_textbox" value="">';
    cell4.innerHTML = '';
    */
    // 現在の行数(ヘッダー分とINDEX0スタートに合わせる)
    var table1 = document.getElementById("member_grids");
    var trs = $('#member_grids tbody tr');
    // 最終行のクローン取得
    var lastTr = trs[trs.length - 1];
    var td = $(lastTr).children();
    var row = table1.insertRow(-1);
    var cell1 = row.insertCell(-1);
    var cell2 = row.insertCell(-1);
    var cell3 = row.insertCell(-1);
    var cell4 = row.insertCell(-1);
    cell1.innerHTML = td[0].innerHTML;
    cell2.innerHTML = td[1].innerHTML;
    cell3.innerHTML = td[2].innerHTML;
    cell4.innerHTML = td[3].innerHTML;
    cell4.children[0].value = "";
    cell1.setAttribute("class", "grid_col_1 col_rec");
    cell2.setAttribute("class", "grid_col_2 col_rec");
    cell3.setAttribute("class", "grid_col_2 col_rec");
    cell4.setAttribute("class", "grid_col_2 col_rec");
}
/* 商品詳細 end */
