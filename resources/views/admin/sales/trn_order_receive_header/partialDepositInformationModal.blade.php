<div class="modal-box w-[560px]" style="padding: 0;" id="partial_deposit_information">
    <div class="bg-white block">
        <header class="px-6 flex items-center h-10 border-b border-[#DDDDDD]">
            <div class="text-xl text-[#2D3842]">一部入金案内</div>
            <div class="ml-auto">
                <img class="modal-close" src="{{ asset('/img/icon/modal_close.svg') }}" data-smm-close />
            </div>
        </header>
        <div class="py-10 px-5 flex items-center">
            <label class="mr-3 text-sm">指定納期範囲</label>
            <div class="flex items-center">
                <div class="element-form">
                    <div class="textbox">
                        <input type="text" id="specify_deadline_from-year" name="specify_deadline_from_year"
                               class="element textbox_40px" minlength="0" maxlength="4">年
                        <input type="text" id="specify_deadline_from-month" name="specify_deadline_from_month"
                               class="element textbox_24px" minlength="0" maxlength="2">月
                        <input type="text" id="specify_deadline_from-date" name="specify_deadline_from_day"
                               class="element textbox_24px" minlength="0" maxlength="2">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('specify_deadline_from')">
                    </div>
                </div>

                <span class="mx-1">〜</span>

                <div class="element-form">
                    <div class="textbox">
                        <input type="text" id="specify_deadline_to-year" name="specify_deadline_to_year"
                               class="element textbox_40px" minlength="0" maxlength="4">年
                        <input type="text" id="specify_deadline_to-month" name="specify_deadline_to_month"
                               class="element textbox_24px" minlength="0" maxlength="2">月
                        <input type="text" id="specify_deadline_to-date" name="specify_deadline_to_day"
                               class="element textbox_24px" minlength="0" maxlength="2">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('specify_deadline_to')">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center border-t border-[#D0DFE4] h-[64px] justify-end pr-5">
            <button class="w-[112px] h-8 flex items-center justify-center rounded border border-[#D0DFE4] mr-4 text-sm text-[#2D3842]" data-smm-close>キャンセル</button>
            <button class="w-[112px] h-8 rounded flex items-center justify-center bg-active text-white text-sm" onclick="downloadExcel()" data-smm-close>作成する</button>
        </div>
    </div>
</div>
