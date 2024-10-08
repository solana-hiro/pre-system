<div class="modal-box  modal-box-w1000px" id="extended_item_input">
    <div class="modal-content">
        <header class="header">
            <div class="text-wrapper">拡張項目入力</div>
            <div>
                <img class="modal-close" src="{{ asset('/img/icon/modal_close.svg') }}" data-smm-close onclick="closeExtendedItemInputModal()" />
            </div>
        </header>

        <div class="py-3 px-5">
            <div class="flex items-center">
                <label class="mr-3 text-sm text-[#2D3842]">出荷区分</label>
                <input type="text" readonly="true" class="text-base border border-[#D4DDE1] w-8 h-7 rounded mr-2 text-[#1170C7]" />
                <input type="text" readonly="true" class="text-base border border-[#D4DDE1] w-[96px] h-7 rounded mr-2 text-[#1170C7]" />
            </div>
            <div class="flex items-center mt-3">
                <label class="mr-3 text-sm text-[#2D3842]">入金区分</label>
                <input type="text" readonly="true" class="text-base border border-[#D4DDE1] w-8 h-7 rounded mr-2 text-[#1170C7]" />
                <input type="text" readonly="true" class="text-base border border-[#D4DDE1] w-[64px] h-7 rounded mr-2 text-[#1170C7]" />
            </div>
            <div class="flex items-center mt-3">
                <label class="mr-3 text-sm text-[#2D3842]">直送区分</label>
                <input type="text" readonly="true" class="text-base border border-[#D4DDE1] w-8 h-7 rounded mr-2 text-[#1170C7]" />
                <input type="text" readonly="true" class="text-base border border-[#D4DDE1] w-[96px] h-7 rounded mr-2 text-[#1170C7]" />
            </div>
            <div class="mt-5">
                <label class="mr-3 text-sm text-[#2D3842]">ピッキングリストメモ</label>
                <textarea class="w-full min-h-[60px] rounded border border-[#D4DDE1]"></textarea>
            </div>
            <div class="mt-3">
                <label class="mr-3 text-sm text-[#2D3842]">物流への連絡</label>
                <textarea class="w-full min-h-[60px] rounded border border-[#D4DDE1]"></textarea>
            </div>
            <div class="flex items-center mt-5">
                <label class="mr-3 text-sm text-[#2D3842]">販売パターン1</label>
                <div class="relative w-[76px] mr-2">
                    <input type="text" class="w-full h-7 border border-border rounded-sm px-2" />
                    <i class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]" data-smm-open="search_ps_kbn_modal"></i>
                </div>
                <input type="text" readonly="true" class="text-base border border-[#D4DDE1] w-[128px] h-7 rounded mr-2 text-[#1170C7]" />
            </div>
            <div class="flex items-center mt-5">
                <label class="mr-3 text-sm text-[#2D3842]">担当者</label>
                <div class="relative w-[76px] mr-2">
                    <input type="text" class="w-full h-7 border border-border rounded-sm px-2" />
                    <i class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]" data-smm-open="search_manager_modal"></i>
                </div>
                <input type="text" readonly="true" class="text-base border border-[#D4DDE1] w-[128px] h-7 rounded mr-2 text-[#1170C7]" />
            </div>
            <div class="flex items-center mt-5">
                <label class="mr-3 text-sm text-[#2D3842]">最終更新者</label>
                <div class="relative w-[76px] mr-2">
                    <input type="text" readonly="true" value="{{ old('user_cd', isset($accountant_default_data['user_cd']) ? $accountant_default_data['user_cd'] : '') }}" class="w-full h-7 border border-border rounded-sm px-2" />
                </div>
                <input type="text" readonly="true" class="text-base border border-[#D4DDE1] w-[128px] h-7 rounded mr-2 text-[#1170C7]" />
            </div>
        </div>
    </div>
</div>
