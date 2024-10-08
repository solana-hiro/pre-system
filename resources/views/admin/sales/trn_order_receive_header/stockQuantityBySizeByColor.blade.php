<div class="modal-box  modal-box-w1000px" id="stock_quantity_by_size_by_color">
    <div class="modal-content">
        <header class="header">
            <div class="text-wrapper">カラー別サイズ別在庫数量参照</div>
            <div>
                <img class="modal-close" src="{{ asset('/img/icon/modal_close.svg') }}" data-smm-close onclick="closeStockQuantityBySizeByColorModal()" />
            </div>
        </header>

        <div>
            <div class="flex items-center mt-3">
                <label class="text-sm mr-3">商品</label>
                <input type="text" id="stock_quantity_item_cd" readonly="true" class="pl-1 text-active text-base w-24 h-7 mr-1 border border-border" />
                <input type="text" id="stock_quantity_item_name" readonly="true" class="pl-1 text-active text-base w-[336px] h-7 mr-1 border border-border" />
            </div>
            <div class="flex items-center mt-3">
                <div class="flex items-center mr-2">
                    <label class="text-sm mr-3">カラー</label>
                    <input type="text" id="stock_quantity_color_cd" class="pl-1 text-active text-base w-[64px] h-7 mr-1 border border-border" onblur="onChangeStockQuantityColorCd(event, this)" />
                    <input type="text" id="stock_quantity_color_name" readonly="true" class="pl-1 text-active text-base w-[128px] h-7 mr-1 border border-border" />
                </div>
                <div class="flex items-center">
                    <label class="text-sm mr-3">サイズ</label>
                    <input type="text" id="stock_quantity_size_cd" class="pl-1 text-active text-base w-[64px] h-7 mr-1 border border-border" onblur="onChangeStockQuantitySizeCd(event, this)" />
                    <input type="text" id="stock_quantity_size_name" readonly="true" class="pl-1 text-active text-base w-[128px] h-7 mr-1 border border-border" />
                </div>
            </div>

            <div class="mt-5">
                <table class="ml-auto" style="border-collapse: collapse;">
                    <tbody>
                        <tr>
                            <td class="w-[120px] h-[36px] text-center text-sm"></td>
                            <td class="border border-[#D0DFE4] w-[120px] h-[36px] bg-[#F9F9F9] text-center text-sm">現在庫数</td>
                            <td class="border border-[#D0DFE4] w-[120px] h-[36px] bg-[#F9F9F9] text-center text-sm">受注残数</td>
                            <td class="border border-[#D0DFE4] w-[120px] h-[36px] bg-[#F9F9F9] text-center text-sm">発注残数</td>
                            <td class="border border-[#D0DFE4] w-[120px] h-[36px] bg-[#F9F9F9] text-center text-sm">有効在庫数</td>
                        </tr>
                        <tr>
                            <td class="border border-[#D0DFE4] w-[120px] h-[36px] bg-[#F9F9F9] text-center text-sm">全社計</td>
                            <td class="border border-[#D0DFE4] w-[120px] h-[36px] text-right pr-3 text-sm text-[#2D3842]" id="stock_quantity_total_now_stock_quantity"></td>
                            <td class="border border-[#D0DFE4] w-[120px] h-[36px] text-right pr-3 text-sm text-[#2D3842]" id="stock_quantity_total_remaining_order_receive_quantity"></td>
                            <td class="border border-[#D0DFE4] w-[120px] h-[36px] text-right pr-3 text-sm text-[#2D3842]" id="stock_quantity_total_remaining_order_warehousing_quantity"></td>
                            <td class="border border-[#D0DFE4] w-[120px] h-[36px] text-right pr-3 text-sm text-[#2D3842]" id="stock_quantity_total_available_quantity"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                <div class="grid">
                    <table class="table_sticky">
                        <thead class="grid_header">
                            <tr>
                                <td class="grid_wrapper_center td_5p">倉庫コード</td>
                                <td class="grid_wrapper_center td_15p">倉庫名</td>
                                <td class="grid_wrapper_center td_10p">現在庫数</td>
                                <td class="grid_wrapper_center td_10p">受注残数</td>
                                <td class="grid_wrapper_center td_10p">発注残数</td>
                                <td class="grid_wrapper_center td_10p">有効在庫数</td>
                            </tr>
                        </thead>
                        <tbody class="tbody_scroll" id="stock_quantity_table_body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
