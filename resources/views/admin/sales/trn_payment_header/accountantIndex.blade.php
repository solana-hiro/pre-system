@extends('layouts.admin.app')
@section('page_title', '入金計上入力')
@section('title', '入金計上入力')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
<script src="{{ asset('/js/calendar.js') }}"></script>
@endsection

@section('content')
@include('admin.common.calendar', ['calendarId' => 'income_date'])
<div class="main-area">
    <div class="button_area">
        <div class="div">
            <button class="button"><div class="text_wrapper">キャンセル</div></button>
            <button class="button"><div class="text_wrapper">削除する</div></button>
            <button class="div-wrapper"><div class="text_wrapper_2">参照する</div></button>
            <button class="div-wrapper"><div class="text_wrapper_2">前伝票</div></button>
            <button class="div-wrapper"><div class="text_wrapper_2">次伝票</div></button>
            <button class="div-wrapper"><div class="text_wrapper_2">伝票拡張</div></button>
            <button class="button-2"><div class="text_wrapper_3">登録する</div></button>
        </div>
    </div>

    <div>
        <div class="mb-3">
            <label class="text-required text-sm mb-1">入金No.</label>
            <div class="relative w-[112px]">
                <input type="text" class="w-full h-7 border border-border rounded-sm px-2" />
                <i class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
            </div>
        </div>
        <div class="flex items-center">
            <div class="mr-5">
                <label class="text-required text-sm mb-1">得意先</label>
                <div class="flex items-center">
                    <div class="relative w-[96px] mr-[6px]">
                        <input type="text" class="w-full h-7 border border-border rounded-sm px-2" />
                        <i class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                    </div>
                    <div class="relative w-[256px]">
                        <input type="text" class="w-full h-7 border border-border rounded-sm px-2" />
                    </div>
                </div>
            </div>
            <div class="mr-5">
                <label class="text-required text-sm mb-1">担当者</label>
                <div class="flex items-center">
                    <div class="relative w-[76px] mr-[6px]">
                        <input type="text" class="w-full h-7 border border-border rounded-sm px-2" />
                        <i class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                    </div>
                    <div class="relative w-[112px]">
                        <input type="text" class="w-full h-7 border border-border rounded-sm px-2" />
                    </div>
                </div>
            </div>
            <div class="element-form flex flex-col items-start">
                <label class="text-required text-sm">入金日</label>
                <div class="frame" style="margin-left: 0">
                    <div class="textbox">
                        <input type="text" id="income_date-year" name="order_date_year"
                               class="element textbox_40px" minlength="0" maxlength="4">年
                        <input type="text" id="income_date-month" name="order_date_month"
                               class="element textbox_24px" minlength="0" maxlength="2">月
                        <input type="text" id="income_date-date" name="order_date_day"
                               class="element textbox_24px" minlength="0" maxlength="2">日
                        <img src="/img/icon/calender.svg" onclick="onOpenCalendar('income_date')">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <div class="text-lg">請求情報（参考）</div>
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
                                <th class="w-[140px] h-8 text-sm bg-[#F9F9F9] border border-tableBorder">前回請求額</th>
                                <th class="w-[140px] h-8 text-sm bg-[#F9F9F9] border border-tableBorder">今回入金額</th>
                                <th class="w-[140px] h-8 text-sm bg-[#F9F9F9] border border-tableBorder">今回繰越額</th>
                                <th class="w-[140px] h-8 text-sm bg-[#F9F9F9] border border-tableBorder">税込売上額</th>
                                <th class="w-[140px] h-8 text-sm bg-[#F9F9F9] border border-tableBorder">今回請求額</th>
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
                        <tr>
                            <td rowspan="2" class="border border-tableBorder text-center">01</td>
                            <td class="h-8 px-[6px] border border-tableBorder">
                                <select class="w-12 h-7 border border-border rounded">
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </td>
                            <td class="w-[100px] text-right pr-2 text-base border border-tableBorder">50,000</td>
                            <td class="border border-tableBorder">
                                <div class="px-[6px] relative">
                                    <input type="text"/>
                                    <i class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                                </div>
                            </td>
                            <td class="border border-tableBorder">
                                <div class="frame" style="margin-left: 0">
                                    <div class="element-form">
                                        <div class="textbox" style="padding-left: 4px; padding-right: 4px; border: 0;">
                                            <input type="text" id="income_date-year" name="order_date_year"
                                                   class="element textbox_40px" minlength="0" maxlength="4">年
                                            <input type="text" id="income_date-month" name="order_date_month"
                                                   class="element textbox_24px" minlength="0" maxlength="2">月
                                            <input type="text" id="income_date-date" name="order_date_day"
                                                   class="element textbox_24px" minlength="0" maxlength="2">日
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
                                <input type="text" class="w-full" />
                            </td>
                            <td class="px-[6px] border border-tableBorder h-8">
                                <input type="text" />
                            </td>
                            <td class="px-[6px] border border-tableBorder h-8">
                                <input type="text" />
                            </td>
                        </tr>

                        <tr>
                            <td rowspan="2" class="border border-tableBorder bg-[#FFFFCC] text-center">02</td>
                            <td class="h-8 px-[6px] border border-tableBorder bg-[#FFFFCC]">
                                <select class="w-12 h-7 border border-border rounded">
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </td>
                            <td class="w-[100px] text-right pr-2 text-base border border-tableBorder bg-[#FFFFCC]">50,000</td>
                            <td class="border border-tableBorder bg-[#FFFFCC]">
                                <div class="px-[6px] relative">
                                    <input type="text" class="bg-transparent"/>
                                    <i class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                                </div>
                            </td>
                            <td class="border border-tableBorder bg-[#FFFFCC]">
                                <div class="frame" style="margin-left: 0">
                                    <div class="element-form">
                                        <div class="textbox" style="padding-left: 4px; padding-right: 4px; border: 0; background: transparent;">
                                            <input type="text" id="income_date-year" name="order_date_year"
                                                   class="element textbox_40px bg-transparent" minlength="0" maxlength="4">年
                                            <input type="text" id="income_date-month" name="order_date_month"
                                                   class="element textbox_24px bg-transparent" minlength="0" maxlength="2">月
                                            <input type="text" id="income_date-date" name="order_date_day"
                                                   class="element textbox_24px bg-transparent" minlength="0" maxlength="2">日
                                            <img src="/img/icon/calender.svg" onclick="onOpenCalendar('income_date')">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="border border-tableBorder bg-[#FFFFCC]" rowspan="2"></td>
                            <td class="border border-tableBorder p-2 text-sm bg-[#FFFFCC]" rowspan="2">
                                <button class="border border-border bg-[#F9F9F9] text-[10px] w-[20px] rounded-sm" style="text-orientation: upright;">行削除</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-sm text-active border border-tableBorder h-8 px-[6px] bg-[#FFFFCC]">振込</td>
                            <td class="w-[100px] px-[6px] border border-tableBorder h-8 bg-[#FFFFCC]">
                                <input type="text" class="bg-transparent w-full" />
                            </td>
                            <td class="px-[6px] border border-tableBorder h-8 bg-[#FFFFCC]">
                                <input type="text" class="bg-transparent" />
                            </td>
                            <td class="px-[6px] border border-tableBorder h-8 bg-[#FFFFCC]">
                                <input type="text" class="bg-transparent" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex items-center pt-2 px-8 w-[760px]">
                <div class="text-sm h-7 px-2 mt-2 border-b border-[#DDDDDD] bg-[#F9F9F9] w-[160px] mr-auto flex items-center">
                    <span class="mr-auto">伝票計</span>
                    <span></span>
                </div>
                <a class="flex items-center text-sm text-active"><i class="fa-solid fa-plus mr-1"></i>明細の行を追加する</a>
            </div>
        </div>
    </div>
</div>
@endsection
