@extends('layouts.admin.app')
@section('page_title', '支払計上入力')
@section('title', '支払計上入力')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
<div class="main-area">
    <div class="button_area">
        <div class="div">
            <button class="button" onclick="initialize()"><div class="text_wrapper">キャンセル</div></button>
            <button class="button" onclick="clearAllCheckbox()"><div class="text_wrapper">削除する</div></button>
            <button class="div-wrapper" onclick="clickAllCheckbox()"><div class="text_wrapper_2">参照する</div></button>
            <button class="div-wrapper" onclick="clickAllCheckbox()"><div class="text_wrapper_2">前伝票</div></button>
            <button class="div-wrapper" onclick="clickAllCheckbox()"><div class="text_wrapper_2">次伝票</div></button>
            <button class="div-wrapper" form="accountantListSearchForm" type="submit" name="search"><div class="text_wrapper_2">登録する</div></button>
        </div>
    </div>
    <div>
        <div class="w-[200px]">
            <label for="input_order_number" class="text-[#165C9D] font-medium text-sm">支払No.</label>
            <div class="flex justify-start items-center gap-2">
                <div id="input_order_number" class="relative w-[112px]">
                    <input type="text" class="text-sm w-full py-1 pl-2 pr-[26px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" name="order_number">
                    <svg onclick="onClickOpenModalSearchOrderNumber()" class="cursor-pointer transition-opacity duration-300 hover:opacity-75 absolute top-1/2 -translate-y-1/2 right-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.7323 10.3185H10.9909L10.7281 10.0653C11.3146 9.38432 11.7433 8.58221 11.9834 7.71636C12.2235 6.8505 12.2691 5.94231 12.1171 5.05676C11.676 2.44933 9.49872 0.367141 6.87099 0.0482465C5.94717 -0.0685572 5.00885 0.027398 4.12785 0.328769C3.24684 0.630141 2.44649 1.12894 1.78805 1.787C1.1296 2.44506 0.630511 3.24494 0.328962 4.12543C0.027414 5.00592 -0.0685974 5.94368 0.0482748 6.86696C0.367356 9.49315 2.45077 11.6691 5.05973 12.11C5.94579 12.2619 6.85452 12.2163 7.72088 11.9764C8.58724 11.7364 9.38982 11.308 10.0712 10.7218L10.3246 10.9844V11.7254L14.3131 15.7116C14.6979 16.0961 15.3266 16.0961 15.7114 15.7116C16.0962 15.327 16.0962 14.6986 15.7114 14.3141L11.7323 10.3185ZM6.10144 10.3185C3.76463 10.3185 1.8783 8.43329 1.8783 6.09786C1.8783 3.76243 3.76463 1.8772 6.10144 1.8772C8.43824 1.8772 10.3246 3.76243 10.3246 6.09786C10.3246 8.43329 8.43824 10.3185 6.10144 10.3185Z" fill="#B6B6B6"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-start items-baseline gap-5">
        <div class="w-[360px]">
            <label for="input_mt_user_code" class="text-[#165C9D] font-medium text-sm">仕入先</label>
            <div class="flex justify-start items-center gap-[6px]">
                <div id="input_mt_user_code" class="relative w-[76px]">
                    <input type="text" class="text-sm w-full py-1 pl-2 pr-[26px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" 
                        name="mt_user_code">
                    <svg onclick="onClickOpenModalSearchSupplier()" class="cursor-pointer transition-opacity duration-300 hover:opacity-75 absolute top-1/2 -translate-y-1/2 right-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.7323 10.3185H10.9909L10.7281 10.0653C11.3146 9.38432 11.7433 8.58221 11.9834 7.71636C12.2235 6.8505 12.2691 5.94231 12.1171 5.05676C11.676 2.44933 9.49872 0.367141 6.87099 0.0482465C5.94717 -0.0685572 5.00885 0.027398 4.12785 0.328769C3.24684 0.630141 2.44649 1.12894 1.78805 1.787C1.1296 2.44506 0.630511 3.24494 0.328962 4.12543C0.027414 5.00592 -0.0685974 5.94368 0.0482748 6.86696C0.367356 9.49315 2.45077 11.6691 5.05973 12.11C5.94579 12.2619 6.85452 12.2163 7.72088 11.9764C8.58724 11.7364 9.38982 11.308 10.0712 10.7218L10.3246 10.9844V11.7254L14.3131 15.7116C14.6979 16.0961 15.3266 16.0961 15.7114 15.7116C16.0962 15.327 16.0962 14.6986 15.7114 14.3141L11.7323 10.3185ZM6.10144 10.3185C3.76463 10.3185 1.8783 8.43329 1.8783 6.09786C1.8783 3.76243 3.76463 1.8772 6.10144 1.8772C8.43824 1.8772 10.3246 3.76243 10.3246 6.09786C10.3246 8.43329 8.43824 10.3185 6.10144 10.3185Z" fill="#B6B6B6"/>
                    </svg>
                </div>
                <input name="mt_user_name" class="rounded-[4px] text-[#165C9D] border-[1px] border-[#D4DDE1] w-[240px] py-1 px-2 text-sm outline-none" readonly />
            </div>
        </div>
        <div class="w-[200px]">
            <label for="input_mt_user_code" class="text-[#165C9D] font-medium text-sm">担当者</label>
            <div class="flex justify-start items-center gap-[6px]">
                <div id="input_mt_user_code" class="relative w-[76px]">
                    <input type="text" class="text-sm w-full py-1 pl-2 pr-[26px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" 
                        name="mt_user_code">
                    <svg onclick="" class="cursor-pointer transition-opacity duration-300 hover:opacity-75 absolute top-1/2 -translate-y-1/2 right-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.7323 10.3185H10.9909L10.7281 10.0653C11.3146 9.38432 11.7433 8.58221 11.9834 7.71636C12.2235 6.8505 12.2691 5.94231 12.1171 5.05676C11.676 2.44933 9.49872 0.367141 6.87099 0.0482465C5.94717 -0.0685572 5.00885 0.027398 4.12785 0.328769C3.24684 0.630141 2.44649 1.12894 1.78805 1.787C1.1296 2.44506 0.630511 3.24494 0.328962 4.12543C0.027414 5.00592 -0.0685974 5.94368 0.0482748 6.86696C0.367356 9.49315 2.45077 11.6691 5.05973 12.11C5.94579 12.2619 6.85452 12.2163 7.72088 11.9764C8.58724 11.7364 9.38982 11.308 10.0712 10.7218L10.3246 10.9844V11.7254L14.3131 15.7116C14.6979 16.0961 15.3266 16.0961 15.7114 15.7116C16.0962 15.327 16.0962 14.6986 15.7114 14.3141L11.7323 10.3185ZM6.10144 10.3185C3.76463 10.3185 1.8783 8.43329 1.8783 6.09786C1.8783 3.76243 3.76463 1.8772 6.10144 1.8772C8.43824 1.8772 10.3246 3.76243 10.3246 6.09786C10.3246 8.43329 8.43824 10.3185 6.10144 10.3185Z" fill="#B6B6B6"/>
                    </svg>
                </div>
                <input name="mt_user_name" class="rounded-[4px] text-[#165C9D] border-[1px] border-[#D4DDE1] w-[128px] py-1 px-2 text-sm outline-none" readonly />
            </div>
        </div>
        <div class="">
            <label for="input_order_date" class="text-[#165C9D] font-medium text-sm">発注日：</label>
            <div id="input_order_date" class="flex justify-start items-center gap-1 w-full py-[2px] px-2 border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300">
                <input type="text" name="order_year" class="text-sm outline-none w-[40px]" minlength="0" maxlength="4" value="">年
                <input type="text" name="order_month" class="text-sm outline-none w-[20px]" minlength="0" maxlength="2" value="">月
                <input type="text" name="order_day" class="text-sm outline-none w-[20px]" minlength="0" maxlength="2" value="">日
                <img src="/img/icon/calender.svg">
            </div>
        </div>
    </div>

    <div class="mt-5">
        <div class="text-lg">支払情報（参考）</div>
        <div class="w-fit py-3 px-5 rounded-md bg-[#DDF2FF] mt-3">
            <div class="flex items-center">
                    <div class="flex items-end mr-7">
                        <div class="w-10 h-7 flex items-center justify-center bg-[#EEEEEE] rounded border border-[#C9C9C9] mr-[6px]"><img src="/img/icon/double_arrow_left.svg"></div>
                        <div class="element-form flex flex-col items-start mr-[6px]">
                            <label class="text-sm">今回決済日</label>
                            <div class="frame" style="margin-left: 0">
                                <div class="textbox">
                                    <input type="text" id="income_date-year" name="order_date_year"
                                           class="element textbox_40px" minlength="0" maxlength="4">年
                                    <input type="text" id="income_date-month" name="order_date_month"
                                           class="element textbox_24px" minlength="0" maxlength="2">月
                                    <input type="text" id="income_date-date" name="order_date_day"
                                           class="element textbox_24px" minlength="0" maxlength="2">日
                                </div>
                            </div>
                        </div>
                        <div class="w-10 h-7 flex items-center justify-center bg-[#EEEEEE] rounded border border-[#C9C9C9] mr-[6px]"><img src="/img/icon/double_arrow_right.svg"></div>
                    </div>

                    <div class="flex items-end">
                        <div class="element-form flex flex-col items-start">
                            <label class="text-sm">請求締日</label>
                            <div class="frame" style="margin-left: 0">
                                <div class="textbox">
                                    <input type="text" id="income_date-year" name="order_date_year"
                                           class="element textbox_40px" minlength="0" maxlength="4">年
                                    <input type="text" id="income_date-month" name="order_date_month"
                                           class="element textbox_24px" minlength="0" maxlength="2">月
                                    <input type="text" id="income_date-date" name="order_date_day"
                                           class="element textbox_24px" minlength="0" maxlength="2">日
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <table style="border-collapse: collapse">
                        <thead>
                            <tr>
                                <th class="w-[140px] h-8 text-sm bg-[#F9F9F9] border border-tableBorder">前回支払額</th>
                                <th class="w-[140px] h-8 text-sm bg-[#F9F9F9] border border-tableBorder">今回入金額</th>
                                <th class="w-[140px] h-8 text-sm bg-[#F9F9F9] border border-tableBorder">今回繰越額</th>
                                <th class="w-[140px] h-8 text-sm bg-[#F9F9F9] border border-tableBorder">税込仕入額</th>
                                <th class="w-[140px] h-8 text-sm bg-[#F9F9F9] border border-tableBorder">今回残高</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="h-8 bg-white border border-tableBorder"></td>
                                <td class="h-8 bg-white border border-tableBorder"></td>
                                <td class="h-8 bg-white border border-tableBorder"></td>
                                <td class="h-8 bg-white border border-tableBorder"></td>
                                <td class="h-8 bg-white border border-tableBorder"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="mt-5">
            <div>
                <table>
                    <thead>
                        <tr>
                            <th rowspan="2" class="w-8 text-sm border border-tableBorder bg-[#3A5A9B] text-white">No.</th>
                            <th rowspan="2" class="w-[60px] text-sm border border-tableBorder bg-[#3A5A9B] text-white">区分</th>
                            <th rowspan="2" class="w-[100px] text-sm border border-tableBorder bg-[#3A5A9B] text-white">金額</th>
                            <th class="h-8 w-44 text-sm border border-tableBorder bg-[#3A5A9B] text-white">銀行コード</th>
                            <th class="h-8 w-44 text-sm border border-tableBorder bg-[#3A5A9B] text-white">手形期日</th>
                            <th rowspan="2" class="w-44 text-sm border border-tableBorder bg-[#3A5A9B] text-white">備考</th>
                            <th class="w-8"></th>
                        </tr>
                        <tr>
                            <th class="h-8 w-44 text-sm border border-tableBorder bg-[#3A5A9B] text-white">銀行名</th>
                            <th class="h-8 w-44 text-sm border border-tableBorder bg-[#3A5A9B] text-white">手形No.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payData as $index => $pay)
                        <tr>
                            <td rowspan="2" class="border border-tableBorder text-center">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td class="h-8 px-[6px] border border-tableBorder">
                                <select class="w-12 h-7 border border-border rounded">
                                    <option value="{{ $pay->process_kbn }}">{{ $pay->process_kbn }}</option>
                                </select>
                            </td>
                            <td class="w-[100px] text-right pr-2 text-base border border-tableBorder">{{ number_format($pay->slip_total) }}</td>
                            <td class="border border-tableBorder">
                                <div class="px-[6px] relative">
                                    <input type="text" value="{{ $pay->mt_customer_id }}"/>
                                    <i class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                                </div>
                            </td>
                            <td class="border border-tableBorder">
                                <div class="frame" style="margin-left: 0">
                                    <div class="element-form">
                                        <div class="textbox" style="padding-left: 4px; padding-right: 4px; border: 0;">
                                            <input type="text" id="income_date-year" name="order_date_year"
                                                   class="element textbox_40px" minlength="0" maxlength="4" value="{{ substr($pay->payment_date, 0, 4) }}">年
                                            <input type="text" id="income_date-month" name="order_date_month"
                                                   class="element textbox_24px" minlength="0" maxlength="2" value="{{ substr($pay->payment_date, 5, 2) }}">月
                                            <input type="text" id="income_date-date" name="order_date_day"
                                                   class="element textbox_24px" minlength="0" maxlength="2" value="{{ substr($pay->payment_date, 8, 2) }}">日
                                            <img src="/img/icon/calender.svg" onclick="onOpenCalendar('income_date')">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="border border-tableBorder" rowspan="2"></td>
                            <td class="border border-tableBorder p-2 text-sm" rowspan="2">
                                <button class="border border-border bg-[#F9F9F9] text-[10px] w-[20px] rounded-sm" style="text-orientation: upright;">行削除</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-sm text-active border border-tableBorder h-8 px-[6px]">振込</td>
                            <td class="w-[100px] px-[6px] border border-tableBorder h-8">
                                <input type="text" class="w-full" value="{{ $pay->payment_number }}" />
                            </td>
                            <td class="px-[6px] border border-tableBorder h-8">
                                <input type="text" value="{{ $pay->mt_billing_address_id }}" />
                            </td>
                            <td class="px-[6px] border border-tableBorder h-8">
                                <input type="text" value="{{ $pay->collect_pay_date }}" />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex items-center pt-2 px-8 w-[760px]">
                <div class="text-sm h-7 px-2 mt-2 border-b border-[#DDDDDD] bg-[#F9F9F9] w-[160px] mr-auto flex items-center">
                    <span class="mr-auto">伝票計</span>
                    <span>{{ number_format($payData->sum('slip_total')) }}</span>
                </div>
                <a class="flex items-center text-sm text-active"><i class="fa-solid fa-plus mr-1"></i>明細の行を追加する</a>
            </div>
        </div>
    </div>
    
    <div class="mt-5">
        {{ $payData->links() }}
    </div>
</div>

@include("admin.purchase.trn_order_header.modals.searchOrderNumber")
@include("admin.purchase.trn_order_header.modals.searchUserInputId")
@include("admin.purchase.trn_order_header.modals.searchSupplier")
@include("admin.purchase.trn_order_header.modals.searchSupplierClassOne")
@include("admin.purchase.trn_order_header.modals.searchDepartment")

@endsection
