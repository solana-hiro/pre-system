@extends('layouts.admin.app')
@section('page_title', '発注計上入力')
@section('title', '発注計上入力')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
    <form role="search" action="{{ route('purchase_management.order.accountant.update') }}" method="post">
        @csrf
        <div class="main-area">
            <div class="button_area">
                <div class="div">
                    <button class="button" type="submit" name="delete">
                        <div class="text_wrapper">削除する</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="refer">
                        <div class="text_wrapper_2">参照する</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="previous">
                        <div class="text_wrapper_2">前伝票</div>
                    </button>
                    <button class="div-wrapper" type="submit" name="next">
                        <div class="text_wrapper_2">次伝票</div>
                    </button>
                    <button class="button-2" type="submit" name="register">
                        <div class="text_wrapper_3">登録する</div>
                    </button>
                </div>
            </div>
            <div class="flex justify-start items-baseline gap-5">
                <div class="w-[200px]">
                    <label for="input_order_number" class="text-[#165C9D] font-medium text-sm">発注No.</label>
                    <div class="flex justify-start items-center gap-2">
                        <div id="input_order_number" class="relative w-[112px]">
                            <input type="text" class="text-sm w-full py-1 pl-2 pr-[26px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" name="order_number">
                            <svg onclick="onClickOpenModalSearchOrderNumber()" class="cursor-pointer transition-opacity duration-300 hover:opacity-75 absolute top-1/2 -translate-y-1/2 right-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.7323 10.3185H10.9909L10.7281 10.0653C11.3146 9.38432 11.7433 8.58221 11.9834 7.71636C12.2235 6.8505 12.2691 5.94231 12.1171 5.05676C11.676 2.44933 9.49872 0.367141 6.87099 0.0482465C5.94717 -0.0685572 5.00885 0.027398 4.12785 0.328769C3.24684 0.630141 2.44649 1.12894 1.78805 1.787C1.1296 2.44506 0.630511 3.24494 0.328962 4.12543C0.027414 5.00592 -0.0685974 5.94368 0.0482748 6.86696C0.367356 9.49315 2.45077 11.6691 5.05973 12.11C5.94579 12.2619 6.85452 12.2163 7.72088 11.9764C8.58724 11.7364 9.38982 11.308 10.0712 10.7218L10.3246 10.9844V11.7254L14.3131 15.7116C14.6979 16.0961 15.3266 16.0961 15.7114 15.7116C16.0962 15.327 16.0962 14.6986 15.7114 14.3141L11.7323 10.3185ZM6.10144 10.3185C3.76463 10.3185 1.8783 8.43329 1.8783 6.09786C1.8783 3.76243 3.76463 1.8772 6.10144 1.8772C8.43824 1.8772 10.3246 3.76243 10.3246 6.09786C10.3246 8.43329 8.43824 10.3185 6.10144 10.3185Z" fill="#B6B6B6"/>
                            </svg>
                        </div>
                        <button class="text-white font-medium text-sm rounded-sm py-[6px] px-2 bg-[#B5D9FF]" name="repeat">
                            リピート
                        </button>
                    </div>
                </div>
                <div class="">
                    <label for="input_order_date" class="text-[#165C9D] font-medium text-sm">発注日：</label>
                    <div id="input_order_date" class="flex justify-start items-center gap-1 w-full py-[2px] px-2 border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300">
                        <input type="text" name="order_year" class="text-sm outline-none w-[40px]" minlength="0" maxlength="4"
                            value="">年
                        <input type="text" name="order_month" class="text-sm outline-none w-[20px]" minlength="0" maxlength="2"
                            value="">月
                        <input type="text" name="order_day" class="text-sm outline-none w-[20px]" minlength="0" maxlength="2"
                            value="">日
                        <img  src="/img/icon/calender.svg">
                    </div>
                </div>
            </div>
            
            <div class="mt-3 flex justify-start items-center gap-5">
                <div class="w-[200px]">
                    <label for="input_mt_user_code" class="text-[#165C9D] font-medium text-sm">入力者</label>
                    <div class="flex justify-start items-center gap-[6px]">
                        <div id="input_mt_user_code" class="relative w-[76px]">
                            <input type="text" class="text-sm w-full py-1 pl-2 pr-[26px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" 
                                name="mt_user_code">
                            <svg onclick="onClickOpenModalSearchUerInputId()" class="cursor-pointer transition-opacity duration-300 hover:opacity-75 absolute top-1/2 -translate-y-1/2 right-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.7323 10.3185H10.9909L10.7281 10.0653C11.3146 9.38432 11.7433 8.58221 11.9834 7.71636C12.2235 6.8505 12.2691 5.94231 12.1171 5.05676C11.676 2.44933 9.49872 0.367141 6.87099 0.0482465C5.94717 -0.0685572 5.00885 0.027398 4.12785 0.328769C3.24684 0.630141 2.44649 1.12894 1.78805 1.787C1.1296 2.44506 0.630511 3.24494 0.328962 4.12543C0.027414 5.00592 -0.0685974 5.94368 0.0482748 6.86696C0.367356 9.49315 2.45077 11.6691 5.05973 12.11C5.94579 12.2619 6.85452 12.2163 7.72088 11.9764C8.58724 11.7364 9.38982 11.308 10.0712 10.7218L10.3246 10.9844V11.7254L14.3131 15.7116C14.6979 16.0961 15.3266 16.0961 15.7114 15.7116C16.0962 15.327 16.0962 14.6986 15.7114 14.3141L11.7323 10.3185ZM6.10144 10.3185C3.76463 10.3185 1.8783 8.43329 1.8783 6.09786C1.8783 3.76243 3.76463 1.8772 6.10144 1.8772C8.43824 1.8772 10.3246 3.76243 10.3246 6.09786C10.3246 8.43329 8.43824 10.3185 6.10144 10.3185Z" fill="#B6B6B6"/>
                            </svg>
                        </div>
                        <input name="mt_user_name" class="rounded-[4px] text-[#165C9D] border-[1px] border-[#D4DDE1] w-[112px]  py-1 px-2 text-sm outline-none" readonly />
                    </div>
                </div>
                <div class="">
                    <label for="input_mt_supplier_code" class="text-[#165C9D] font-medium text-sm">仕入先</label>
                    <div class="flex justify-start items-center gap-[6px]">
                        <div id="input_mt_supplier_code" class="relative w-[96px]">
                            <input type="text" class="text-sm w-full py-1 pl-2 pr-[26px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" 
                                name="mt_supplier_code">
                            <svg onclick="onClickOpenModalSearchSupplier()" class="cursor-pointer transition-opacity duration-300 hover:opacity-75 absolute top-1/2 -translate-y-1/2 right-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.7323 10.3185H10.9909L10.7281 10.0653C11.3146 9.38432 11.7433 8.58221 11.9834 7.71636C12.2235 6.8505 12.2691 5.94231 12.1171 5.05676C11.676 2.44933 9.49872 0.367141 6.87099 0.0482465C5.94717 -0.0685572 5.00885 0.027398 4.12785 0.328769C3.24684 0.630141 2.44649 1.12894 1.78805 1.787C1.1296 2.44506 0.630511 3.24494 0.328962 4.12543C0.027414 5.00592 -0.0685974 5.94368 0.0482748 6.86696C0.367356 9.49315 2.45077 11.6691 5.05973 12.11C5.94579 12.2619 6.85452 12.2163 7.72088 11.9764C8.58724 11.7364 9.38982 11.308 10.0712 10.7218L10.3246 10.9844V11.7254L14.3131 15.7116C14.6979 16.0961 15.3266 16.0961 15.7114 15.7116C16.0962 15.327 16.0962 14.6986 15.7114 14.3141L11.7323 10.3185ZM6.10144 10.3185C3.76463 10.3185 1.8783 8.43329 1.8783 6.09786C1.8783 3.76243 3.76463 1.8772 6.10144 1.8772C8.43824 1.8772 10.3246 3.76243 10.3246 6.09786C10.3246 8.43329 8.43824 10.3185 6.10144 10.3185Z" fill="#B6B6B6"/>
                            </svg>
                        </div>
                        <input name="mt_supplier_name" class="rounded-[4px] text-[#165C9D] border-[1px] border-[#D4DDE1] w-[256px]  py-1 px-2 text-sm outline-none" readonly />
                    </div>
                </div>
                <div class="">
                    <label for="input_mt_supplier_class_one_code" class="text-[#165C9D] font-medium text-sm">仕入先分類1</label>
                    <div class="flex justify-start items-center gap-[6px]">
                        <div id="input_mt_supplier_class_one_code" class="relative w-[96px]">
                            <input type="text" class="text-sm w-full py-1 pl-2 pr-[26px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" 
                                name="mt_supplier_class_one_code">
                            <svg onclick="onClickOpenModalSearchSupplierClassOne()" class="cursor-pointer transition-opacity duration-300 hover:opacity-75 absolute top-1/2 -translate-y-1/2 right-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.7323 10.3185H10.9909L10.7281 10.0653C11.3146 9.38432 11.7433 8.58221 11.9834 7.71636C12.2235 6.8505 12.2691 5.94231 12.1171 5.05676C11.676 2.44933 9.49872 0.367141 6.87099 0.0482465C5.94717 -0.0685572 5.00885 0.027398 4.12785 0.328769C3.24684 0.630141 2.44649 1.12894 1.78805 1.787C1.1296 2.44506 0.630511 3.24494 0.328962 4.12543C0.027414 5.00592 -0.0685974 5.94368 0.0482748 6.86696C0.367356 9.49315 2.45077 11.6691 5.05973 12.11C5.94579 12.2619 6.85452 12.2163 7.72088 11.9764C8.58724 11.7364 9.38982 11.308 10.0712 10.7218L10.3246 10.9844V11.7254L14.3131 15.7116C14.6979 16.0961 15.3266 16.0961 15.7114 15.7116C16.0962 15.327 16.0962 14.6986 15.7114 14.3141L11.7323 10.3185ZM6.10144 10.3185C3.76463 10.3185 1.8783 8.43329 1.8783 6.09786C1.8783 3.76243 3.76463 1.8772 6.10144 1.8772C8.43824 1.8772 10.3246 3.76243 10.3246 6.09786C10.3246 8.43329 8.43824 10.3185 6.10144 10.3185Z" fill="#B6B6B6"/>
                            </svg>
                        </div>
                        <input name="mt_supplier_class_one_name" class="rounded-[4px] text-[#165C9D] border-[1px] border-[#D4DDE1] w-[128px]  py-1 px-2 text-sm outline-none" readonly />
                    </div>
                </div>
                <div class="">
                    <label for="input_def_department_code" class="text-[#165C9D] font-medium text-sm">部門</label>
                    <div class="flex justify-start items-center gap-[6px]">
                        <div id="input_def_department_code" class="relative w-[76px]">
                            <input type="text" class="text-sm w-full py-1 pl-2 pr-[26px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" 
                                name="def_department_code">
                            <svg onclick="onClickOpenModalSearchDepartment()" class="cursor-pointer transition-opacity duration-300 hover:opacity-75 absolute top-1/2 -translate-y-1/2 right-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.7323 10.3185H10.9909L10.7281 10.0653C11.3146 9.38432 11.7433 8.58221 11.9834 7.71636C12.2235 6.8505 12.2691 5.94231 12.1171 5.05676C11.676 2.44933 9.49872 0.367141 6.87099 0.0482465C5.94717 -0.0685572 5.00885 0.027398 4.12785 0.328769C3.24684 0.630141 2.44649 1.12894 1.78805 1.787C1.1296 2.44506 0.630511 3.24494 0.328962 4.12543C0.027414 5.00592 -0.0685974 5.94368 0.0482748 6.86696C0.367356 9.49315 2.45077 11.6691 5.05973 12.11C5.94579 12.2619 6.85452 12.2163 7.72088 11.9764C8.58724 11.7364 9.38982 11.308 10.0712 10.7218L10.3246 10.9844V11.7254L14.3131 15.7116C14.6979 16.0961 15.3266 16.0961 15.7114 15.7116C16.0962 15.327 16.0962 14.6986 15.7114 14.3141L11.7323 10.3185ZM6.10144 10.3185C3.76463 10.3185 1.8783 8.43329 1.8783 6.09786C1.8783 3.76243 3.76463 1.8772 6.10144 1.8772C8.43824 1.8772 10.3246 3.76243 10.3246 6.09786C10.3246 8.43329 8.43824 10.3185 6.10144 10.3185Z" fill="#B6B6B6"/>
                            </svg>
                        </div>
                        <input name="def_department_name" class="rounded-[4px] text-[#165C9D] border-[1px] border-[#D4DDE1] w-[112px]  py-1 px-2 text-sm outline-none" readonly />
                    </div>
                </div>
            </div>

            <div class="mt-3 flex justify-start items-center gap-5">
                <div class="w-[200px]">
                    <label for="input_partner_number" class="text-[#2D3842] font-medium text-sm">契約No.</label>
                    <div class="flex justify-start items-center gap-[6px]">
                        <div id="input_partner_number" class="relative w-[150px]">
                            <input type="text" class="text-sm w-full py-1 pl-2 pr-[26px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" 
                                name="partner_number">
                        </div>
                    </div>
                </div>
                <div class="">
                    <label for="input_mt_user_manager_id" class="text-[#165C9D] font-medium text-sm">担当者</label>
                    <div class="flex justify-start items-center gap-[6px]">
                        <div id="input_mt_user_manager_id" class="relative w-[76px]">
                            <input type="text" class="text-sm w-full py-1 pl-2 pr-[26px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" 
                                name="mt_user_manager_id">
                            <svg onclick="" class="cursor-pointer transition-opacity duration-300 hover:opacity-75 absolute top-1/2 -translate-y-1/2 right-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.7323 10.3185H10.9909L10.7281 10.0653C11.3146 9.38432 11.7433 8.58221 11.9834 7.71636C12.2235 6.8505 12.2691 5.94231 12.1171 5.05676C11.676 2.44933 9.49872 0.367141 6.87099 0.0482465C5.94717 -0.0685572 5.00885 0.027398 4.12785 0.328769C3.24684 0.630141 2.44649 1.12894 1.78805 1.787C1.1296 2.44506 0.630511 3.24494 0.328962 4.12543C0.027414 5.00592 -0.0685974 5.94368 0.0482748 6.86696C0.367356 9.49315 2.45077 11.6691 5.05973 12.11C5.94579 12.2619 6.85452 12.2163 7.72088 11.9764C8.58724 11.7364 9.38982 11.308 10.0712 10.7218L10.3246 10.9844V11.7254L14.3131 15.7116C14.6979 16.0961 15.3266 16.0961 15.7114 15.7116C16.0962 15.327 16.0962 14.6986 15.7114 14.3141L11.7323 10.3185ZM6.10144 10.3185C3.76463 10.3185 1.8783 8.43329 1.8783 6.09786C1.8783 3.76243 3.76463 1.8772 6.10144 1.8772C8.43824 1.8772 10.3246 3.76243 10.3246 6.09786C10.3246 8.43329 8.43824 10.3185 6.10144 10.3185Z" fill="#B6B6B6"/>
                            </svg>
                        </div>
                        <input class="rounded-[4px] text-[#165C9D] border-[1px] border-[#D4DDE1] w-[128px]  py-1 px-2 text-sm outline-none" readonly />
                    </div>
                </div>
                <div class="">
                    <label class="text-[#165C9D] font-medium text-sm invisible">発行区分</label>
                    <div class="flex justify-start items-center gap-3">
                        <span>発行区分 : </span>
                        <input type="radio" name="order_kbn" id="order_kbn_voucher">
                        <label for="order_kbn_voucher">
                            伝票
                        </label>
                        <input type="radio" name="order_kbn" id="order_kbn_email">
                        <label for="order_kbn_email">
                            メール
                        </label>
                    </div>
                </div>
                <div class="">
                    <label for="input_mt_warehouse_id" class="text-[#2D3842] font-medium text-sm">倉庫</label>
                    <div class="flex justify-start items-center gap-[6px]">
                        <div id="input_mt_warehouse_id" class="relative w-[76px]">
                            <input type="text" class="text-sm w-full py-1 pl-2 pr-[26px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" 
                                name="mt_warehouse_id">
                            <svg onclick="" class="cursor-pointer transition-opacity duration-300 hover:opacity-75 absolute top-1/2 -translate-y-1/2 right-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.7323 10.3185H10.9909L10.7281 10.0653C11.3146 9.38432 11.7433 8.58221 11.9834 7.71636C12.2235 6.8505 12.2691 5.94231 12.1171 5.05676C11.676 2.44933 9.49872 0.367141 6.87099 0.0482465C5.94717 -0.0685572 5.00885 0.027398 4.12785 0.328769C3.24684 0.630141 2.44649 1.12894 1.78805 1.787C1.1296 2.44506 0.630511 3.24494 0.328962 4.12543C0.027414 5.00592 -0.0685974 5.94368 0.0482748 6.86696C0.367356 9.49315 2.45077 11.6691 5.05973 12.11C5.94579 12.2619 6.85452 12.2163 7.72088 11.9764C8.58724 11.7364 9.38982 11.308 10.0712 10.7218L10.3246 10.9844V11.7254L14.3131 15.7116C14.6979 16.0961 15.3266 16.0961 15.7114 15.7116C16.0962 15.327 16.0962 14.6986 15.7114 14.3141L11.7323 10.3185ZM6.10144 10.3185C3.76463 10.3185 1.8783 8.43329 1.8783 6.09786C1.8783 3.76243 3.76463 1.8772 6.10144 1.8772C8.43824 1.8772 10.3246 3.76243 10.3246 6.09786C10.3246 8.43329 8.43824 10.3185 6.10144 10.3185Z" fill="#B6B6B6"/>
                            </svg>
                        </div>
                        <input class="rounded-[4px] text-[#165C9D] border-[1px] border-[#D4DDE1] w-[176px]  py-1 px-2 text-sm outline-none" readonly />
                    </div>
                </div>
            </div>

            <div class="mt-3 flex justify-start items-baseline gap-5">
                <div class="w-[200px]">
                    <label for="input_slip_kind" class="text-[#165C9D] font-medium text-sm">伝票種別</label>
                    <div id="input_slip_kind" class="relative w-[70px]">
                        <input type="text" class="text-sm w-full py-1 pl-2 pr-[26px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" 
                        name="slip_kind">
                    </div>
                </div>
                <div class="">
                    <label for="input_order_date" class="text-[#165C9D] font-medium text-sm">指定納期</label>
                    <div id="input_order_date" class="flex justify-start items-center gap-1 w-full py-[2px] px-2 border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300">
                        <input type="text" name="order_year" class="text-sm outline-none w-[40px]" minlength="0" maxlength="4"
                            value="">年
                        <input type="text" name="order_month" class="text-sm outline-none w-[20px]" minlength="0" maxlength="2"
                            value="">月
                        <input type="text" name="order_day" class="text-sm outline-none w-[20px]" minlength="0" maxlength="2"
                            value="">日
                        <img  src="/img/icon/calender.svg">
                    </div>
                </div>
                <div class="">
                    <label for="input_mt_warehouse_id" class="text-[#2D3842] font-medium text-sm">納品先</label>
                    <div class="flex justify-start items-center gap-[6px]">
                        <div id="input_mt_warehouse_id" class="relative w-[96px]">
                            <input type="text" class="text-sm w-full py-1 pl-2 pr-[26px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" 
                                name="mt_warehouse_id">
                            <svg onclick="" class="cursor-pointer transition-opacity duration-300 hover:opacity-75 absolute top-1/2 -translate-y-1/2 right-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.7323 10.3185H10.9909L10.7281 10.0653C11.3146 9.38432 11.7433 8.58221 11.9834 7.71636C12.2235 6.8505 12.2691 5.94231 12.1171 5.05676C11.676 2.44933 9.49872 0.367141 6.87099 0.0482465C5.94717 -0.0685572 5.00885 0.027398 4.12785 0.328769C3.24684 0.630141 2.44649 1.12894 1.78805 1.787C1.1296 2.44506 0.630511 3.24494 0.328962 4.12543C0.027414 5.00592 -0.0685974 5.94368 0.0482748 6.86696C0.367356 9.49315 2.45077 11.6691 5.05973 12.11C5.94579 12.2619 6.85452 12.2163 7.72088 11.9764C8.58724 11.7364 9.38982 11.308 10.0712 10.7218L10.3246 10.9844V11.7254L14.3131 15.7116C14.6979 16.0961 15.3266 16.0961 15.7114 15.7116C16.0962 15.327 16.0962 14.6986 15.7114 14.3141L11.7323 10.3185ZM6.10144 10.3185C3.76463 10.3185 1.8783 8.43329 1.8783 6.09786C1.8783 3.76243 3.76463 1.8772 6.10144 1.8772C8.43824 1.8772 10.3246 3.76243 10.3246 6.09786C10.3246 8.43329 8.43824 10.3185 6.10144 10.3185Z" fill="#B6B6B6"/>
                            </svg>
                        </div>
                        <input class="rounded-[4px] text-[#165C9D] border-[1px] border-[#D4DDE1] w-[256px]  py-1 px-2 text-sm outline-none" readonly />
                    </div>
                </div>
            </div>

            <div class="mt-10">
                <table class="w-full">
                    <thead class="border-[1px] border-[#D0DFE4] text-center text-white bg-[#3A5A9B] font-medium text-[13px]">
                        <tr class="border-[1px]">
                           <td class="border-[1px] border-[#D0DFE4] px-[6px] py-6" rowspan="2">NO.</td> 
                           <td class="border-[1px] py-2 px-6">商品コード</td>
                           <td class="border-[1px] py-2 px-6">単位</td>
                           <td class="border-[1px] py-2 px-6">上代単価</td>
                           <td class="border-[1px] py-2 px-6">発注数</td>
                           <td class="border-[1px] py-2 px-6" rowspan="2">発注単価</td>
                           <td class="border-[1px] py-2 px-6" rowspan="2">発注金額</td>
                           <td class="border-[1px] py-2 px-6" rowspan="2">発注納期</td>
                           <td class="border-[1px] py-2 px-6" >備考</td>
                        </tr>
                        <tr>
                            <td class="border-[1px] py-2 px-6" colspan="3">商品名</td>
                            <td class="border-[1px] py-2 px-6">仕入引当数</td>
                            <td class="border-[1px] py-2 px-6">完了</td>
                        </tr>
                    </thead>
                    <tbody class="h-[320px] overflow-y-scroll border-[1px] border-[#D0DFE4]">
                        {{-- @foreach ($orderData as $order)
                            <tr class="border-[1px] bg-[#FFFFCC]">
                                <td class="border-[1px] border-[#D0DFE4] px-[6px] py-6" rowspan="2">{{$order['id']}}</td> 
                                <td class="border-[1px] py-2 px-6">{{$order['partner_number']}}</td>
                                <td class="border-[1px] py-2 px-6">{{$order['partner_number']}}</td>
                                <td class="border-[1px] py-2 px-6">{{$order['partner_number']}}</td>
                                <td class="border-[1px] py-2 px-6">{{$order['partner_number']}}</td>
                                <td class="border-[1px] py-2 px-6" rowspan="2">{{$order['partner_number']}}</td>
                                <td class="border-[1px] py-2 px-6" rowspan="2">{{$order['partner_number']}}</td>
                                <td class="border-[1px] py-2 px-6" rowspan="2">{{$order['partner_number']}}</td>
                                <td class="border-[1px] py-2 px-6" >{{$order['partner_number']}}</td>
                             </tr>
                             <tr>
                                <td class="border-[1px] py-2 px-6" colspan="3">{{$order['partner_number']}}</td>
                                <td class="border-[1px] py-2 px-6">{{$order['partner_number']}}</td>
                                <td class="border-[1px] py-2 px-6">{{$order['partner_number']}}</td>
                             </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </form>
    @include("admin.purchase.trn_order_header.modals.searchOrderNumber")
    @include("admin.purchase.trn_order_header.modals.searchUserInputId")
    @include("admin.purchase.trn_order_header.modals.searchSupplier")
    @include("admin.purchase.trn_order_header.modals.searchSupplierClassOne")
    @include("admin.purchase.trn_order_header.modals.searchDepartment")

    
@endsection
