<div class="modal-box  modal-box-w800px" id="detail_extension_item">
    <div class="modal-content">
        <header class="header">
            <div class="text-wrapper">明細拡張項目</div>
            <div>
                <img class="modal-close" src="{{ asset('/img/icon/modal_close.svg') }}" data-smm-close onclick="closeDetailExtensionItemModal()" />
            </div>
        </header>

        <div class="py-3 px-5">
            <div class="flex items-end">
                <div class="w-fit mr-10">
                    <div class="text-sm mb-5">明細付箋</div>
                    <div>
                        <label class="flex items-center mb-5">
                            <input type="checkbox" name="detail_sticky_note[]" value="0" class="mr-4" />
                            指定なし
                        </label>
                        @foreach($stickyNotes as $index => $stickyNote)
                        <label class="flex items-center mb-5">
                            <input type="checkbox" name="detail_sticky_note[]" value="{{ $stickyNote['id'] }}" class="mr-4" />
                            <div class="w-8 h-8 bg-[{{ $stickyNote['sticky_note_color'] }}] mr-4"></div>
                            {{ $stickyNote['sticky_note_name'] }}
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="flex flex-col items-start">
                    <div class="mt-5">
                        <label class="mr-3 text-sm text-[#2D3842]">ピッキングリストメモ</label>
                        <textarea class="w-full min-h-[60px] rounded border border-[#D4DDE1]"></textarea>
                    </div>
                    <div class="mt-3">
                        <label class="mr-3 text-sm text-[#2D3842]">物流への連絡</label>
                        <textarea class="w-full min-h-[60px] rounded border border-[#D4DDE1]"></textarea>
                    </div>
                    <div class="mr-5 element-form flex flex-col items-start" style="align-items: start;">
                        <label class="text-required text-sm">案内入荷日</label>
                        <div class="frame" style="margin-left: 0">
                            <div class="textbox">
                                <input type="text" id="information_arrival_date-year" name="information_arrival_date_year"
                                       class="element textbox_40px" minlength="0" maxlength="4">年
                                <input type="text" id="information_arrival_date-month" name="information_arrival_date_month"
                                       class="element textbox_24px" minlength="0" maxlength="2">月
                                <input type="text" id="information_arrival_date-date" name="information_arrival_date_day"
                                       class="element textbox_24px" minlength="0" maxlength="2">日
                                <img src="/img/icon/calender.svg" onclick="onOpenCalendar('information_arrival_date')">
                            </div>
                        </div>
                    </div>
                    <div class="mr-5 element-form flex flex-col items-start" style="align-items: start;">
                        <label class="text-required text-sm">入金日</label>
                        <div class="frame" style="margin-left: 0">
                            <div class="textbox">
                                <input type="text" id="income_date-year" name="income_date_year"
                                       class="element textbox_40px" minlength="0" maxlength="4">年
                                <input type="text" id="income_date-month" name="income_date_month"
                                       class="element textbox_24px" minlength="0" maxlength="2">月
                                <input type="text" id="income_date-date" name="income_date_day"
                                       class="element textbox_24px" minlength="0" maxlength="2">日
                                <img src="/img/icon/calender.svg" onclick="onOpenCalendar('income_date')">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
