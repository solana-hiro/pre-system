<div class="modal-box" style="width: 1160px; padding: 0px; border-radius: 12px;" id="order_breakdown_modal">
    <div style="padding: 0px;">
        <header class="header" style="align-items: center; padding-left: 20px; padding-right: 20px;">
            <div class="text-wrapper">受注内訳入力</div>
            <div>
                <img class="modal-close" src="{{ asset('/img/icon/modal_close.svg') }}" data-smm-close onclick="orderBreakdownModalClose()" />
            </div>
        </header>
        <div class="p-5 pb-[80px]">
            <form>
                <div class="flex items-center justify-end">
                    <button type="button" class="border border-[#D4DDE1] rounded w-24 h-[30px] mr-5 text-sm" onclick="clearOrderReceiveQuantity()">クリア</button>
                    <button type="button" class="bg-active text-white rounded w-24 h-[30px] text-sm mr-5" onclick="searchStockQuantity()">検索</button>
                    <button type="button" onclick="validationOrderReceiveQuantity()" class="bg-active text-white rounded w-24 h-[30px] text-sm">確定する</button>
                </div>

                <input type="hidden" name="trn_order_receive_detail_id" id="trn_order_receive_detail_id_for_order_breakdown" />

                <div class="flex items-center mt-3">
                    <label class="text-sm mr-3">商品</label>
                    <input type="text" id="order_breakdown_item_cd" readonly="true" class="text-active text-base w-24 h-7 mr-1 border border-border" />
                    <input type="text" id="order_breakdown_item_name" readonly="true" class="text-active text-base w-[336px] h-7 mr-1 border border-border" />
                </div>

                <div class="w-full relative" style="top: -20px; margin-bottom: -20px;">
                    <table>
                        <tbody>
                        <tr>
                            <td colspan="12" class="p-0"></td>
                            <td class="p-0"><div class="w-[80px] bg-[#F9F9F9] border border-[#D0DFE4] border-b-0 text-sm h-[36px] text-center flex justify-center items-center">計</div></td>
                        </tr>
                        <tr class="size_group_tr">
                            <td colspan="2" class="p-0">
                                <div class="w-[120px] h-[36px] bg-[#F9F9F9] text-center border border-r-0 border-[#D0DFE4] text-[13px] flex justify-end ml-auto items-center p-3">販売可能数</div>
                            </td>
                            <td class="p-0">
                                <div class="w-[86px] text-right pr-3 h-[36px] border border-r-0 border-[#D0DFE4] text-sm text-[#1170C7] flex justify-end items-center p-3 size_group_0"></div>
                            </td>
                            <td class="p-0">
                                <div class="w-[86px] text-right pr-3 h-[36px] border border-r-0 border-[#D0DFE4] text-sm text-[#1170C7] flex justify-end items-center p-3 size_group_1"></div>
                            </td>
                            <td class="p-0">
                                <div class="w-[86px] text-right pr-3 h-[36px] border border-r-0 border-[#D0DFE4] text-sm text-[#1170C7] flex justify-end items-center p-3 size_group_2"></div>
                            </td>
                            <td class="p-0">
                                <div class="w-[86px] text-right h-[36px] border border-r-0 border-[#D0DFE4] text-sm text-[#1170C7] flex justify-end items-center p-3 size_group_3"></div>
                            </td>
                            <td class="p-0">
                                <div class="w-[86px] text-right h-[36px] border border-r-0 border-[#D0DFE4] text-sm text-[#1170C7] flex justify-end items-center p-3 size_group_4"></div>
                            </td>
                            <td class="p-0">
                                <div class="w-[86px] text-right h-[36px] border border-r-0 border-[#D0DFE4] text-sm text-[#1170C7] flex justify-end items-center p-3 size_group_5"></div>
                            </td>
                            <td class="p-0">
                                <div class="w-[86px] text-right h-[36px] border border-r-0 border-[#D0DFE4] text-sm text-[#1170C7] flex justify-end items-center p-3 size_group_6"></div>
                            </td>
                            <td class="p-0">
                                <div class="w-[86px] text-right h-[36px] border border-r-0 border-[#D0DFE4] text-sm text-[#1170C7] flex justify-end items-center p-3 size_group_7"></div>
                            </td>
                            <td class="p-0">
                                <div class="w-[86px] text-right h-[36px] border border-r-0 border-[#D0DFE4] text-sm text-[#1170C7] flex justify-end items-center p-3 size_group_8"></div>
                            </td>
                            <td class="p-0 pr-1">
                                <div class="w-[86px] text-right h-[36px] border border-[#D0DFE4] text-sm text-[#1170C7] flex justify-end items-center p-3 size_group_9 size_group_9"></div>
                            </td>
                            <td class="p-0">
                                <div class="w-[80px] text-right h-[36px] border border-[#D0DFE4] text-sm text-[#1170C7] flex justify-end items-center p-3 size_group_2 size_group_total"></div>
                            </td>
                        </tr>
                        <tr class="size_tr1">
                            <td colspan="2" rowspan="2" class="p-0 pt-1">
                                <div class="relative h-[72px] bg-[#3A5A9B] w-[172px]">
                                    <div class="text-white text-sm absolute right-3 top-2">サイズ</div>
                                    <div class="text-white text-sm absolute left-3 bottom-2">カラー</div>
                                    <span style="position: absolute; width: 108%; height: 1px; border-top: 1px solid white; top: 0; left: 0; transform: rotate(22deg); transform-origin: top left;"></span>
                                </div>
                            </td>
                            <td class="p-0 pt-1 pl-1">
                                <div class="size0 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0 pt-1">
                                <div class="size1 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0 pt-1">
                                <div class="size2 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0 pt-1">
                                <div class="size3 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0 pt-1">
                                <div class="size4 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0 pt-1">
                                <div class="size5 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0 pt-1">
                                <div class="size6 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0 pt-1">
                                <div class="size7 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0 pt-1">
                                <div class="size8 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0 pt-1 pr-1">
                                <div class="size9 text-[#1170C7] pl-1 h-[36px] border border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td rowspan="2" class="p-0 pt-1">
                                <div class="text-sm h-[72px] text-[#2D3842] bg-[#F9F9F9] border border-[#D0DFE4] w-[80px] text-center flex items-center justify-center">カラー計<br/>数量</div>
                            </td>
                        </tr>
                        <tr class="size_tr2">
                            <td class="p-0 pl-1">
                                <div class="size0 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-t-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0">
                                <div class="size1 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-t-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0">
                                <div class="size2 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-t-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0">
                                <div class="size3 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-t-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0">
                                <div class="size4 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-t-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0">
                                <div class="size5 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-t-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0">
                                <div class="size6 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-t-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0">
                                <div class="size7 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-t-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0">
                                <div class="size8 text-[#1170C7] pl-1 h-[36px] border border-r-0 border-t-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                            <td class="p-0 pr-1">
                                <div class="size9 text-[#1170C7] pl-1 h-[36px] border border-t-0 border-[#D0DFE4] text-sm flex justify-start items-center"></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <div class="absolute bottom-0 left-0 right-0 border-t border-[#DDDDDD] h-[60px] flex items-center justify-end bg-[#FDFDFD] pr-[20px]">
            <div class="flex items-center">
                <label class="w-[100px] h-[36px] border border-[#D0DFE4] flex items-center justify-center text-sm text-[#2D3842] bg-[#F9F9F9]">商品計数量</label>
                <div class="border border-l-0 border-[#D0DFE4] h-[36px] flex items-center justify-end pr-1 text-sm text-[#2D3842] w-[80px] total_order_receive_quantity_footer">0</div>
            </div>
        </div>
    </div>
</div>
