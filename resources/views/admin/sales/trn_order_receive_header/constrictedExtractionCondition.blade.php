<div class="pl-5 pr-[76px]">
    <div class="shadow rounded-md relative">
        <div id="constrictedExtractionConditionToggle" onclick="toggleSearchPanel()" class="w-full h-10 bg-[#EBEFF3] flex items-center px-6 cursor-pointer">
            <span class="mr-auto text-baseText">絞込抽出条件</span>
            <i class="fa-solid fa-caret-down"></i>
        </div>
        <div class="bg-white absolute t-10 l-0 w-full z-50 p-5 hidden" id="constrictedExtractionConditionBlock">
            <div class="flex items-center">
                <div class="flex items-center mr-auto">
                    <label class="mr-1 text-sm">抽出条件</label>
                    <div class="relative w-[96px] mr-[6px]">
                        <input type="text" class="w-full h-7 border border-border rounded-sm px-2" />
                        <i class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                    </div>
                    <input type="text" class="h-7 border border-border rounded-sm px-2 w-[336px]" />
                </div>
                <div class="flex items-center">
                    <button class="h-7 px-4 rounded bg-white text-active border border-active text-sm mr-5">登録する</button>
                    <button class="h-7 px-4 rounded bg-white text-[#646464] border border-border text-sm mr-5">キャンセル</button>
                    <button class="h-7 px-4 rounded bg-white text-[#646464] border border-border text-sm">削除する</button>
                </div>
            </div>

            <form method="GET" id="accountantListSearchForm" action="{{ route('sales_management.order_receive.accountant.list') }}">
            <div class="bg-active h-9 w-full flex items-center justify-center mt-5 text-white font-semibold">対象伝票　絞込条件</div>

            <div class="flex mt-5">
                <div class="w-fit mr-auto">
                    <div class="flex items-center mb-3">
                        <label class="text-sm mr-1">受注No.</label>
                        <div class="flex items-center">
                            <div class="relative w-[112px]">
                                <input type="text" name="order_receive_number_from" maxlength="8" class="w-full h-7 border border-border rounded-sm px-2" />
                                <i data-smm-open="search_order_receive_header" class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                            </div>
                            <div class="px-2">〜</div>
                            <div class="relative w-[112px]">
                                <input type="text" name="order_receive_number_to" maxlength="8" class="w-full h-7 border border-border rounded-sm px-2" />
                                <i data-smm-open="search_order_receive_header" class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center mb-3">
                        <label class="text-sm mr-1">EC注文番号</label>
                        <div class="flex items-center">
                            <div class="relative w-[120px]">
                                <input name="ec_order_receive_number_from" type="text" maxlength="9" class="w-full h-7 border border-border rounded-sm px-2" />
                            </div>
                            <div class="px-2">〜</div>
                            <div class="relative w-[120px]">
                                <input name="ec_order_receive_number_to" type="text" maxlength="9" class="w-full h-7 border border-border rounded-sm px-2" />
                            </div>
                            <label class="flex items-center ml-5 text-sm">
                                <input name="ec_order_receive_number_all_flg" type="checkbox" class="mr-2" />
                                すべて
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center mb-3 element-form">
                        <label class="text-sm w-[60px] text-right">受注日</label>
                        <div class="flex items-center">
                            <div class="textbox">
                                <input type="text" id="order_date_from-year" name="order_date_year_from" class="element textbox_40px" minlength="0" maxlength="4" value="">年
                                <input type="text" id="order_date_from-month" name="order_date_month_from" class="element textbox_24px" minlength="0" maxlength="2" value="">月
                                <input type="text" id="order_date_from-date" name="order_date_day_from" class="element textbox_24px" minlength="0" maxlength="2" value="">日
                                <img src="/img/icon/calender.svg" onclick="onOpenCalendar('order_date_from')">
                            </div>
                            <div class="px-2">〜</div>
                            <div class="textbox">
                                <input type="text" id="order_date_to-year" name="order_date_year_to" class="element textbox_40px" minlength="0" maxlength="4" value="">年
                                <input type="text" id="order_date_to-month" name="order_date_month_to" class="element textbox_24px" minlength="0" maxlength="2" value="">月
                                <input type="text" id="order_date_to-date" name="order_date_day_to" class="element textbox_24px" minlength="0" maxlength="2" value="">日
                                <img src="/img/icon/calender.svg" onclick="onOpenCalendar('order_date_to')">
                            </div>
                            <label class="flex items-center ml-5 text-sm">
                                <input type="checkbox" name="order_receive_date_all_flg" class="mr-2" />
                                すべて
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center mb-3 element-form">
                        <label class="text-sm w-[60px] text-right">指定納期</label>
                        <div class="flex items-center">
                            <div class="textbox">
                                <input type="text" id="deadline_from-year" name="release_start_datetime_year_from" class="element textbox_40px" minlength="0" maxlength="4" value="">年
                                <input type="text" id="deadline_from-month" name="release_start_datetime_month_from" class="element textbox_24px" minlength="0" maxlength="2" value="">月
                                <input type="text" id="deadline_from-date" name="release_start_datetime_day_from" class="element textbox_24px" minlength="0" maxlength="2" value="">日
                                <img src="/img/icon/calender.svg" onclick="onOpenCalendar('deadline_from')">
                            </div>
                            <div class="px-2">〜</div>
                            <div class="textbox">
                                <input type="text" id="deadline_to-year" name="release_start_datetime_year_to" class="element textbox_40px" minlength="0" maxlength="4" value="">年
                                <input type="text" id="deadline_to-month" name="release_start_datetime_month_to" class="element textbox_24px" minlength="0" maxlength="2" value="">月
                                <input type="text" id="deadline_to-date" name="release_start_datetime_day_to" class="element textbox_24px" minlength="0" maxlength="2" value="">日
                                <img src="/img/icon/calender.svg" onclick="onOpenCalendar('deadline_to')">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center mb-3">
                        <label class="text-sm mr-1">入力担当者</label>
                        <div class="flex items-center">
                            <div class="relative w-[76px]">
                                <input type="text" name="mt_user_input_cd_from" class="w-full h-7 border border-border rounded-sm px-2" />
                                <i data-smm-open="search_manager_modal" class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                            </div>
                            <div class="px-2">〜</div>
                            <div class="relative w-[76px]">
                                <input type="text" name="mt_user_input_cd_to" class="w-full h-7 border border-border rounded-sm px-2" />
                                <i data-smm-open="search_manager_modal" class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center mb-3">
                        <label class="text-sm mr-1">出荷区分：</label>
                        <div class="flex items-center">
                            <label class="flex items-center mr-5"><input type="radio" name="shipping_kbn" value="0" class="mr-[6px]" />通常</label>
                            <label class="flex items-center mr-5"><input type="radio" name="shipping_kbn" value="1" class="mr-[6px]" />未確定</label>
                            <label class="flex items-center mr-5"><input type="radio" name="shipping_kbn" value="2" class="mr-[6px]" />揃出</label>
                            <label class="flex items-center mr-5"><input type="radio" name="shipping_kbn" value="3" class="mr-[6px]" />有出無銭</label>
                            <label class="flex items-center mr-5"><input type="radio" name="shipping_kbn" value="4" class="mr-[6px]" />他</label>
                            <label class="flex items-center"><input type="radio" name="shipping_kbn" value="5" class="mr-[6px]" />すべて</label>
                        </div>
                    </div>

                    <div class="flex items-center mb-3">
                        <label class="text-sm mr-1">得意先</label>
                        <div class="flex items-center">
                            <div class="relative w-[96px]">
                                <input type="text" name="customer_from" class="w-full h-7 border border-border rounded-sm px-2" />
                                <i data-smm-open="search_customer_modal" class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                            </div>
                            <div class="px-2">〜</div>
                            <div class="relative w-[96px]">
                                <input type="text" name="customer_to" class="w-full h-7 border border-border rounded-sm px-2" />
                                <i data-smm-open="search_customer_modal" class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center mb-3">
                        <label class="text-sm mr-1">納品先</label>
                        <div class="flex items-center">
                            <div class="relative w-[96px]">
                                <input name="delivery_destination_from" type="text" class="w-full h-7 border border-border rounded-sm px-2" />
                                <i data-smm-open="search_delivery_destination_modal" class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                            </div>
                            <div class="px-2">〜</div>
                            <div class="relative w-[96px]">
                                <input name="delivery_destination_to" type="text" class="w-full h-7 border border-border rounded-sm px-2" />
                                <i data-smm-open="search_delivery_destination_modal" class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center mb-3">
                        <label class="text-sm mr-1">ルート</label>
                        <div class="flex items-center">
                            <div class="relative w-[80px] mr-1">
                                <input type="text" name="root_cd" class="w-full h-7 border border-border rounded-sm px-2" />
                                <i data-smm-open="search_root_modal" class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                            </div>
                            <div class="relative w-[128px]">
                                <input type="text" readonly="true" name="root_name" class="w-full h-7 border border-border rounded-sm px-2" />
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center mb-3">
                        <label class="text-sm mr-1 w-[120px] text-right">EC受注チェック：</label>
                        <div class="flex items-center">
                            <label class="flex items-center mr-5"><input type="radio" name="ec_order_receive_check" value="0" class="mr-[6px]" />未チェック</label>
                            <label class="flex items-center mr-5"><input type="radio" name="ec_order_receive_check" value="1" class="mr-[6px]" />チェック済</label>
                            <label class="flex items-center"><input type="radio" name="ec_order_receive_check" value="2" class="mr-[6px]" />すべて</label>
                        </div>
                    </div>

                    <div class="flex items-center mb-3">
                        <label class="text-sm mr-1 w-[120px] text-right">入金区分：</label>
                        <div class="flex items-center">
                            <label class="flex items-center mr-5"><input type="radio" name="payment_kbn" value="0" class="mr-[6px]" />掛売</label>
                            <label class="flex items-center mr-5"><input type="radio" name="payment_kbn" value="1" class="mr-[6px]" />入金後</label>
                            <label class="flex items-center"><input type="radio" name="payment_kbn" value="2" class="mr-[6px]" />すべて</label>
                        </div>
                    </div>

                    <div class="flex items-center mb-3">
                        <label class="text-sm mr-1 w-[120px] text-right">欠品：</label>
                        <div class="flex items-center">
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="shortage" value="0" />チェック無</label>
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="shortage" value="1" />チェック有</label>
                            <label class="flex items-center"><input type="radio" class="mr-[6px]" name="shortage" value="2" />すべて</label>
                        </div>
                    </div>

                    <div class="flex items-center mb-3">
                        <label class="text-sm mr-1 w-[120px] text-right">受注残：</label>
                        <div class="flex items-center">
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="order_receive_remaining" value="0" />チェック無</label>
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="order_receive_remaining" value="1" />チェック有</label>
                            <label class="flex items-center"><input type="radio" class="mr-[6px]" name="order_receive_remaining" value="2" />すべて</label>
                        </div>
                    </div>

                    <div class="flex items-center mb-3">
                        <label class="text-sm mr-1 w-[120px] text-right">入金済：</label>
                        <div class="flex items-center">
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="payment_finish" value="0" />チェック無</label>
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="payment_finish" value="1" />チェック有</label>
                            <label class="flex items-center"><input type="radio" class="mr-[6px]" name="payment_finish" value="2" />すべて</label>
                        </div>
                    </div>

                    <div class="flex items-center mb-3">
                        <label class="text-sm mr-1 w-[120px] text-right">日本郵政連携：</label>
                        <div class="flex items-center">
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="japan_post_office_alignment" value="0" />未連携</label>
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="japan_post_office_alignment" value="1" />連携済</label>
                            <label class="flex items-center"><input type="radio" class="mr-[6px]" name="japan_post_office_alignment" value="2" />すべて</label>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <label class="text-sm mr-1 w-[120px] text-right">クレジット：</label>
                        <div class="flex items-center">
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="credit_settlement" value="0" />クレジット決済</label>
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="credit_settlement" value="2" />クレジット決済以外</label>
                            <label class="flex items-center"><input type="radio" class="mr-[6px]" name="credit_settlement" value="3" />すべて</label>
                        </div>
                    </div>
                </div>

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
            </div>

            <div class="bg-active h-9 w-full flex items-center justify-center mt-5 text-white font-semibold">案内　絞込条件</div>

            <div class="mt-5">
                <div class="flex items-center mb-3">
                    <div class="flex items-center mr-10">
                        <label class="text-sm mr-1 w-[130px] text-right">入金案内：</label>
                        <div class="flex items-center">
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="payment_guidance_slip" value="0" />未指定</label>
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="payment_guidance_slip" value="1" />一部</label>
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="payment_guidance_slip" value="2" />全部</label>
                            <label class="flex items-center"><input type="radio" class="mr-[6px]" name="payment_guidance_slip" value="3" />すべて</label>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <label class="text-sm mr-1 text-right">発行状況：</label>
                        <div class="flex items-center">
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="payment_guidance_issue" value="0" />未発行</label>
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="payment_guidance_issue" value="1" />発行済</label>
                            <label class="flex items-center"><input type="radio" class="mr-[6px]" name="payment_guidance_issue" value="2" />すべて</label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center mb-3">
                    <div class="flex items-center mr-10">
                        <label class="text-sm mr-1 w-[130px] text-right">KEEP案内：</label>
                        <div class="flex items-center">
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="keep_guidance_slip" value="0" />未指定</label>
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="keep_guidance_slip" value="1" />対象</label>
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="keep_guidance_slip" value="2" />期限切</label>
                            <label class="flex items-center"><input type="radio" class="mr-[6px]" name="keep_guidance_slip" value="3" />すべて</label>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <label class="text-sm mr-1 text-right">発行状況：</label>
                        <div class="flex items-center">
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="keep_guidance_issue" value="0" />未発行</label>
                            <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="keep_guidance_issue" value="1" />発行済</label>
                            <label class="flex items-center"><input type="radio" class="mr-[6px]" name="keep_guidance_issue" value="2" />すべて</label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center mb-3">
                    <label class="text-sm mr-1 w-[130px] text-right">欠品案内：</label>
                    <div class="flex items-center">
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="shortage_guidance_issue" value="0" />未発行</label>
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="shortage_guidance_issue" value="1" />発行済</label>
                        <label class="flex items-center"><input type="radio" class="mr-[6px]" name="shortage_guidance_issue" value="2" />すべて</label>
                    </div>
                </div>

                <div class="flex items-center mb-3">
                    <label class="text-sm mr-1 w-[130px] text-right">出荷案内（受注）：</label>
                    <div class="flex items-center">
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="shipping_guidance_order_receive_issue" value="0" />未発行</label>
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="shipping_guidance_order_receive_issue" value="1" />発行済</label>
                        <label class="flex items-center"><input type="radio" class="mr-[6px]" name="shipping_guidance_order_receive_issue" value="2" />すべて</label>
                    </div>
                </div>

                <div class="flex items-center">
                    <label class="text-sm mr-1 w-[130px] text-right">出荷案内（売上）：</label>
                    <div class="flex items-center">
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="shipping_guidance_sale_issue" value="0" />未発行</label>
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="shipping_guidance_sale_issue" value="1" />発行済</label>
                        <label class="flex items-center"><input type="radio" class="mr-[6px]" name="shipping_guidance_sale_issue" value="2" />すべて</label>
                    </div>
                </div>
            </div>

            <div class="bg-active h-9 w-full flex items-center justify-center mt-5 text-white font-semibold">出荷ステータス　絞込条件</div>

            <div class="mt-5">
                <div class="flex items-center mb-3">
                    <label class="text-sm mr-1 w-[154px] text-right">出荷区分：</label>
                    <div class="flex items-center">
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="shipping_preparation" value="0" />未準備</label>
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="shipping_preparation" value="1" />一部準備済</label>
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="shipping_preparation" value="2" />一部／全部準備済</label>
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="shipping_preparation" value="3" />全部準備済</label>
                        <label class="flex items-center"><input type="radio" class="mr-[6px]" name="shipping_preparation" value="4" />すべて</label>
                    </div>
                </div>

                <div class="flex items-center mb-3">
                    <label class="text-sm mr-1 w-[154px] text-right">ピッキングリスト発行：</label>
                    <div class="flex items-center">
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="picking_list_issue" value="0" />未発行</label>
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="picking_list_issue" value="1" />一部発行済</label>
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="picking_list_issue" value="2" />一部／全部発行済</label>
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="picking_list_issue" value="3" />全部発行済</label>
                        <label class="flex items-center"><input type="radio" class="mr-[6px]" name="picking_list_issue" value="4" />すべて</label>
                    </div>
                </div>

                <div class="flex items-center mb-3">
                    <label class="text-sm mr-1 w-[154px] text-right">検品：</label>
                    <div class="flex items-center">
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="inspection" value="0" />未検品</label>
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="inspection" value="1" />一部検品済</label>
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="inspection" value="2" />一部／全部検品済</label>
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="inspection" value="3" />全部検品済</label>
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="inspection" value="4" />保留あり</label>
                        <label class="flex items-center"><input type="radio" class="mr-[6px]" name="inspection" value="5" />すべて</label>
                    </div>
                </div>

                <div class="flex items-center">
                    <label class="text-sm mr-1 w-[154px] text-right">売伝発行：</label>
                    <div class="flex items-center">
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="sale_slip_issue" value="0" />未発行</label>
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="sale_slip_issue" value="1" />一部発行済</label>
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="sale_slip_issue" value="2" />一部／全部発行済</label>
                        <label class="flex items-center mr-5"><input type="radio" class="mr-[6px]" name="sale_slip_issue" value="3" />全部発行済</label>
                        <label class="flex items-center"><input type="radio" class="mr-[6px]" name="sale_slip_issue" value="4" />すべて</label>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
