<div class="modal w-[1160px] top-1/2" tabindex="-1" role="dialog" id="modal_quantity" style="z-index: 99999">
    <div class="modal-dialog" role="document">
        <div class="modal-content transform-none">
            <header class="header">
                <div class="text-wrapper">入出庫内訳入力</div>
                <div>
                    <button type="" class="button_close" data-dismiss="modal" id="modal_close_button_manager"
                        onclick="closeQuantityModal()">
                        <img class="" src="{{ asset('/img/icon/modal_close.svg') }}"></button>
                    </button>
                </div>
            </header>
            <div class="button_area top-0">
                <div class="flex justify-end w-full">
                    <button type="button" class="modal_button" onclick="clearQuantityModal();">
                        <div class="text_wrapper">クリアする</div>
                    </button>
                    <button type="button" class="modal_button text_wrapper bg-active text-white" data-dismiss="modal"
                        onclick="updateQuantity();">確定する</button>
                </div>
            </div>
            <div class="modal-body" style="margin-top: 10px;">
                <div class="flex">
                    <label class="text-required text-sm mr-5">商品</label>
                    <div class="flex items-stretch">
                        <div class="relative w-[96px] mr-2">
                            <input data-target="warehouse_name" readonly id="quantity-modal-item-code" type="text"
                                class="w-full h-7 border border-border rounded-sm px-2"
                                onblur="blurCodeautoOutWarehouse(arguments[0], this)" />
                        </div>
                        <div class="relative w-[336px] mr-2">
                            <span class="inline-block w-full h-7 border border-border rounded-sm px-2"
                                id="quantity-modal-item-name"></span>
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger mt-3">
                    <ul id="modal-alert-danger-ul">
                </div>

                <div class="flex mt-3 max-h-[600px] overflow-y-scroll quantity-modal" id="quantity-modal">
                </div>

                <div class="text-right">
                    <div class="inline-flex ml-auto p-[6px] mt-2">
                        <div class="flex items-center">
                            <label class="text-sm px-5 py-2 bg-[#F9F9F9] border border-tableBorder">商品計数量</label>
                            <div class="text-sm bg-white px-5 py-2 border border-tableBorder" id="modal-total-quantity">
                                0.00</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
