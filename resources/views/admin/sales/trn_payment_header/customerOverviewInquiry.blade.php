@extends('layouts.admin.app')
@section('page_title', '得意先概況問合せ')
@section('title', '得意先概況問合せ')
@section('description', '')
@section('keywords', '')
@section('canonical', '')
@section('blade_script')
<script src="{{ asset('/js/calendar.js') }}"></script>
@endsection

@section('content')
@include('admin.common.calendar', ['calendarId' => 'target_period'])
<div class="main-area">
    <div class="button_area">
        <div class="div">
            <button class="button"><div class="text_wrapper">キャンセル</div></button>
            <button class="div-wrapper"><div class="text_wrapper_2">前の月</div></button>
            <button class="div-wrapper"><div class="text_wrapper_2">次の月</div></button>
            <button class="button-2"><div class="text_wrapper_3">実行する</div></button>
        </div>
    </div>

    <div>
        <div class="element-form">
            <label class="text-required text-sm">対象年月</label>
            <div class="frame">
                <div class="textbox">
                    <input type="text" id="target_period-year" name="order_date_year"
                           class="element textbox_40px" minlength="0" maxlength="4">年
                    <input type="text" id="target_period-month" name="order_date_month"
                           class="element textbox_24px" minlength="0" maxlength="2">月
                    <img src="/img/icon/calender.svg" onclick="onOpenCalendar('target_period')">
                </div>
            </div>
        </div>

        <div class="mt-3 flex items-center">
            <label class="text-required text-sm mr-3">得意先</label>
            <div class="flex items-center">
                <div class="relative w-[96px] mr-[6px]">
                    <input type="text" class="w-full h-7 border border-border rounded-sm px-2" />
                    <i class="absolute top-[5px] right-2 fa-solid fa-magnifying-glass text-[#B6B6B6]"></i>
                </div>
                <div class="relative w-[496px]">
                    <input type="text" class="w-full h-7 border border-border rounded-sm px-2" />
                </div>
            </div>
        </div>
    </div>

    <div>
        <table class="mt-5" style="border-collapse: collapse;">
            <tbody>
                <tr>
                    <th rowspan="2" class="bg-tableHeaderBg w-[120px] text-white font-bold border border-tableBorder text-sm">売掛情報</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">前月残高</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（総売上額）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（返品額）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（値引額）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">純売上額</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">消費税</th>
                </tr>
                <tr>
                    <th class="w-[150px] text-white font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                </tr>
                <tr>
                    <th class="bg-tableHeaderBg w-[120px] text-white font-bold border border-tableBorder h-8 text-sm">売掛締日</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（現金・振込）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（手形）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（相殺値引）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（手数料・他）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">入金額</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">当月残高</th>
                </tr>
                <tr>
                    <th class="w-[120px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                </tr>
            </tbody>
        </table>

        <table class="mt-5" style="border-collapse: collapse;">
            <tbody>
                <tr>
                    <th rowspan="2" class="bg-tableHeaderBg w-[120px] text-white font-bold border border-tableBorder text-sm">請求情報<br/>1</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">前回請求額</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（総売上額）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（返品値引額）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">総売上額</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">消費税</th>
                    <th></th>
                </tr>
                <tr>
                    <th class="w-[150px] text-white font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th></th>
                </tr>
                <tr>
                    <th class="bg-tableHeaderBg w-[120px] text-white font-bold border border-tableBorder h-8 text-sm">請求締日</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（現金・振込）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（手形）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（相殺値引）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（手数料・他）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">入金額</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">今回請求額</th>
                </tr>
                <tr>
                    <th class="w-[120px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                </tr>
            </tbody>
        </table>

        <table class="mt-5" style="border-collapse: collapse;">
            <tbody>
                <tr>
                    <th rowspan="2" class="bg-tableHeaderBg w-[120px] text-white font-bold border border-tableBorder text-sm">請求情報<br/>2</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">前回請求額</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（総売上額）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（返品値引額）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">総売上額</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">消費税</th>
                    <th></th>
                </tr>
                <tr>
                    <th class="w-[150px] text-white font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th></th>
                </tr>
                <tr>
                    <th class="bg-tableHeaderBg w-[120px] text-white font-bold border border-tableBorder h-8 text-sm">請求締日</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（現金・振込）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（手形）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（相殺値引）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">（手数料・他）</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">入金額</th>
                    <th class="bg-tableHeaderBg w-[150px] text-white font-bold border border-tableBorder h-8 text-sm">今回請求額</th>
                </tr>
                <tr>
                    <th class="w-[120px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                    <th class="w-[150px] font-bold border border-tableBorder h-8 text-sm"></th>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
