<tr>
    <td class="border border-tableBorder text-center px-2 text-sm number_cell " rowspan="2">001</td>
    <td class="border border-tableBorder px-2 relative">
        <div>
            <input type="hidden" name="trn_in_out_details[][detail_id]" class="detail-id">
            <input type="hidden" name="trn_in_out_details[][item_id]" class="item-id">
            <input type="hidden" name="trn_in_out_details[][trn_in_out_header_id]" class="item-header-id">
            <input type="hidden" name="trn_in_out_details[][order_line_no]" class="item-order_line_no">
            <input type="hidden" name="trn_in_out_details[][item_name]" class="item-item_name">
            <span class="item-cd-1"></span>
            <input type="text" name="trn_in_out_details[][item_cd]"
            class="item-cd h-full w-full text-sm form-control focus:border-none active:border-none focus-visible:none"
            onblur="blurCodeautoItem(arguments[0], this)"
            onclick="clickMagnifyIcon(this)"
            style="outline: none;">
            <i onclick="clickMagnifyIcon(this)" data-smm-open="search_item_cd_modal" class="absolute top-[12px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
        </div>
    </td>
    <td class="border border-tableBorder px-2 text-sm">
        <input type="text" name="trn_in_out_details[][unit]" class="h-full w-full text-sm form-control focus:border-none active:border-none focus-visible:none" style="outline: none;">
    </td>
    <td class="border text-right border-tableBorder px-2 text-sm quantity_td" rowspan="2">
        <button type="button" data-toggle="modal" data-target="#modal_quantity" data-value=""
            class="div-wrapper link underline text-[#165C9D] border-none bg-none" data-url="" name="extend"
            onclick="getSkuData(arguments[0], this)">
        </button>
        <input type="hidden" name="trn_in_out_details[][breakdowns]" class="item-breakdowns">
    </td>
    <td class="border border-tableBorder px-2 text-sm price_td" rowspan="2">
        <input name="trn_in_out_details[][retail_price_tax_out]" onblur="blurUpdatePrice(arguments[0])" class="item-cost-price h-full w-full text-sm form-control resize-none focus:border-none active:border-none focus-visible:none text-right" style="outline: none;" />
    </td>
    <td class="border border-tableBorder px-2 text-sm" rowspan="2">
        <textarea rows="3" name="trn_in_out_details[][memo]" class="h-full w-full text-sm form-control resize-none  focus:border-none active:border-none focus-visible:none" style="outline: none;"></textarea>
    </td>
    <td class="border border-tableBorder p-2 text-sm" rowspan="2">
        <button type="button" class="border border-border bg-[#F9F9F9] text-[10px] w-[20px]"
            onclick="deleteRow(this)"
            style="text-orientation: upright;">行削除</button>
    </td>
</tr>
<tr>
    <td class="border border-tableBorder px-2 text-sm" colspan="2">
        <span class="item-name h-[28px] block"></span>
    </td>
</tr>