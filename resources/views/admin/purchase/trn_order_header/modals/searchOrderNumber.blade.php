<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="fixed inset-0 bg-[#2D3842] bg-opacity-50 hidden justify-center items-center z-[10000]" id="modalSearchOrderNumberOverlay">
    <div class="modal-window transform transition-all duration-300 scale-95 opacity-0 bg-white p-[20px] rounded-lg shadow-lg z-[10001]">
        <div class="flex justify-between items-center">
            <h3 class="text-xl">発注伝票検索</h3>
            <svg id="closeSearchOrderNumberModal" class="text-gray-500 hover:text-gray-700 cursor-pointer" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.3346 12.3337L1.66797 1.66699M12.3346 1.66699L1.66797 12.3337" stroke="#2D3842" stroke-width="2.13333" stroke-linecap="round"/>
            </svg>  
        </div>
        <hr class="my-3">
        <div class="flex justify-end">
            <button 
                class="bg-[#1483F8] text-white text-sm px-[20px] py-[5px] hover:opacity-85 duration-300 transition-all cursor-pointer rounded-md"
                onclick="onSearchOrderNumberWithKeyword()"
            >
                実行する
            </button>
        </div>
        <div class="mt-4 flex justify-start items-center gap-5">
            <div class="flex justify-start items-center gap-1">
                <label class="text-sm text-[#2D3842] font-medium">発注伝票No.</label>
                <input type="text" name="order_number_search_modal_order_number" class="order_number_search_modal_order_number text-sm py-1 px-2 w-[88px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" >
            </div>
            <div class="flex justify-start items-center gap-1">
                <label class="text-sm text-[#2D3842] font-medium">契約No.</label>
                <input type="text" name="order_number_search_modal_contract_number" class="order_number_search_modal_contract_number text-sm py-1 px-2 w-[150px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" >
            </div>
            <div class="flex justify-start items-center gap-1">
                <label class="text-sm text-[#2D3842] font-medium">指定納期</label>
                <div id="search_modal_deliverty_date_start" class="flex justify-start items-center gap-1 w-full py-[2px] px-2 border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300">
                    <input type="text" name="order_number_search_modal_order_year_start" class="order_number_search_modal_order_year_start text-sm outline-none w-[40px]" minlength="0" maxlength="4"
                        value="">年
                    <input type="text" name="order_number_search_modal_order_month_start" class="order_number_search_modal_order_month_start text-sm outline-none w-[20px]" minlength="0" maxlength="2"
                        value="">月
                    <input type="text" name="order_number_search_modal_order_day_start" class="order_number_search_modal_order_day_start text-sm outline-none w-[20px]" minlength="0" maxlength="2"
                        value="">日
                    <img  src="/img/icon/calender.svg">
                </div>
                ~
                <div id="search_modal_deliverty_date_end" class="flex justify-start items-center gap-1 w-full py-[2px] px-2 border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300">
                    <input type="text" name="order_number_search_modal_order_year_end" class="order_number_search_modal_order_year_end text-sm outline-none w-[40px]" minlength="0" maxlength="4"
                        value="">年
                    <input type="text" name="order_number_search_modal_order_month_end" class="order_number_search_modal_order_month_end text-sm outline-none w-[20px]" minlength="0" maxlength="2"
                        value="">月
                    <input type="text" name="order_number_search_modal_order_day_end" class="order_number_search_modal_order_day_end text-sm outline-none w-[20px]" minlength="0" maxlength="2"
                        value="">日
                    <img  src="/img/icon/calender.svg">
                </div>
            </div>
        </div>
        <div class="mt-2 flex justify-end items-center gap-2">
            <span class="orderNumberSearchCurrentPage">1</span>/ <span class="orderNumberSearchLastPage">1</span>
            <div class="flex justify-center items-center">
                <div class="orderNumberSearchPrevButton inline-block" onclick="orderNumberSearchPage('prev')">
                    <img class="img-2" src="{{ asset('/img/icon/page-left-off.svg') }}">
                </div>
                <div class="orderNumberSearchNextButton inline-block" onclick="orderNumberSearchPage('next')">
                    <img class="img-2" src="{{ asset('/img/icon/page-right-off.svg') }}">
                </div>
            </div>
            {{-- @include('livewire.master_search.paginate_button', ['list' => $arrivalDateData]); --}}
        </div>
        <div class="mt-10 relative h-[450px] overflow-y-scroll">
            <table class="w-full min-w-[1024px]">
                <thead class="sticky top-0 z-10 border-[1px] border-[#D0DFE4] text-center text-white bg-[#3A5A9B] font-medium text-[13px]">
                    <tr class="border-[1px]">
                        <td class="border-[1px] py-2 px-[20px] w-[10%]">伝票No.</td>
                        <td class="border-[1px] py-2 px-[20px] w-[10%]">行No.</td>
                        <td class="border-[1px] py-2 px-[20px] w-[10%]">指定納期</td>
                        <td class="border-[1px] py-2 px-[10px] w-[10%]">商品コード</td>
                        <td class="border-[1px] py-2 px-[20px] w-[30%]">商品名</td>
                        <td class="border-[1px] py-2 px-[10px] w-[10%]">発注残数量</td>
                        <td class="border-[1px] py-2 px-[20px] w-[10%]">契約No.</td>
                    </tr>
                </thead>
                <tbody class="searchPurhcaseOrderTableBody border-[1px] border-[#D0DFE4] text-[13px]">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    let order_number_search_current_page = 1;
    let order_number_search_last_page = 1;
    let order_number_search_prev_link = "";
    let order_number_search_next_link = "";

    function onClickOpenModalSearchOrderNumber() {
        $('#modalSearchOrderNumberOverlay').removeClass('hidden').addClass('flex');
        setTimeout(function () {
            $('.modal-window').removeClass('scale-95 opacity-0').addClass('scale-100 opacity-100');
        }, 10);

        $('input[name="order_number_search_modal_order_number"]').val("");
        $('input[name="order_number_search_modal_contract_number"]').val("");
        $('input[name="order_number_search_modal_order_year_start"]').val("");
        $('input[name="order_number_search_modal_order_month_start"]').val("");
        $('input[name="order_number_search_modal_order_day_start"]').val("");
        $('input[name="order_number_search_modal_order_year_end"]').val("");
        $('input[name="order_number_search_modal_order_month_end"]').val("");
        $('input[name="order_number_search_modal_order_day_end"]').val(""); 

        let tableBody = $('.searchPurhcaseOrderTableBody');
        tableBody.empty();
        const loading = `
            <tr>
                <td colspan="8" class="mt-5 text-center">
                    読み込み中
                </td>
            </tr>
        `;  
        tableBody.append(loading);

        $.ajax({
            url: './get_search_order_number_all',
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            type: 'get',
            success: function(response) {
                tableBody.empty();
                order_number_search_current_page = response.data.current_page;
                order_number_search_last_page = response.data.last_page;
                order_number_search_prev_link = response.data.prev_page_url;
                order_number_search_next_link = response.data.next_page_url;

                updateOrderNumberSearchPaginationStatus();

                response.data.data.forEach(function (orderItemDetail) {
                    let row = `
                        <tr class="even:bg-[#FFFFCC] cursor-pointer" >
                            <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${orderItemDetail.trn_order_header.order_number}
                            </td> 
                            <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${orderItemDetail.order_detail_cd}
                            </td> 
                            <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${orderItemDetail.trn_order_header.specify_deadline}
                            </td> 
                            <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${orderItemDetail.mt_item.item_cd}
                            </td> 
                            <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${orderItemDetail.mt_item.item_name}
                            </td> 
                            <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${orderItemDetail.order_amount}
                            </td> 
                            <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${orderItemDetail.trn_order_header.partner_number}
                            </td> 
                        </tr>
                    `;
                    tableBody.append(row);
                });                
            },
            error: function (err) {
                console.log(err);
            } 
        });
        
    }


    function orderNumberSearchPage(type) {
        let orderNumber = $('input[name="order_number_search_modal_order_number"]').val();
        let contractNumber = $('input[name="order_number_search_modal_contract_number"]').val();
        let orderYearStart = $('input[name="order_number_search_modal_order_year_start"]').val();
        let orderMonthStart = $('input[name="order_number_search_modal_order_month_start"]').val();
        let orderDayStart = $('input[name="order_number_search_modal_order_day_start"]').val();
        let orderYearEnd = $('input[name="order_number_search_modal_order_year_end"]').val();
        let orderMonthEnd = $('input[name="order_number_search_modal_order_month_end"]').val();
        let orderDayEnd = $('input[name="order_number_search_modal_order_day_end"]').val();

        let orderStartDate = orderYearStart + "-" + orderMonthStart + "-" + orderDayStart;
        let orderEndDate = orderYearEnd + "-" + orderMonthEnd + "-" + orderDayEnd;
        
        if(orderYearStart == "" || orderMonthStart == "" || orderDayStart == "") {
            orderStartDate = "";
        }
        if(orderYearEnd == "" || orderMonthEnd == "" || orderDayEnd == "") {
            orderEndDate = "";
        }

        let calculated_link = "";
        if(type == "next") {
            if (order_number_search_next_link == null) {
                return;
            } else {
                calculated_link = order_number_search_next_link;
            }
        } else {
            if (order_number_search_prev_link == null) {
                return;
            } else {
                calculated_link = order_number_search_prev_link;
            }
        }

        let tableBody = $('.searchPurhcaseOrderTableBody');
        tableBody.empty();
        const loading = `
            <tr>
                <td colspan="8" class="mt-5 text-center">
                    読み込み中
                </td>
            </tr>
        `;  
        tableBody.append(loading);

        $.ajax({
            url: calculated_link,
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            type: 'get',
            success: function(response) {
                tableBody.empty();
                order_number_search_current_page = response.data.current_page;
                order_number_search_last_page = response.data.last_page;
                order_number_search_prev_link = response.data.prev_page_url + "&order_number=" + orderNumber + "&contract_number=" + contractNumber + "&order_start_date=" + orderStartDate + "&order_end_date=" + orderEndDate;
                order_number_search_next_link = response.data.next_page_url + "&order_number=" + orderNumber + "&contract_number=" + contractNumber + "&order_start_date=" + orderStartDate + "&order_end_date=" + orderEndDate;

                
                updateOrderNumberSearchPaginationStatus();

                response.data.data.forEach(function (orderItemDetail) {
                    let row = `
                        <tr class="even:bg-[#FFFFCC] cursor-pointer" >
                        <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                            ${orderItemDetail.trn_order_header.order_number}
                        </td> 
                        <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                            ${orderItemDetail.order_detail_cd}
                        </td> 
                        <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                            ${orderItemDetail.trn_order_header.specify_deadline}
                        </td> 
                        <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                            ${orderItemDetail.mt_item.item_cd}
                        </td> 
                        <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                            ${orderItemDetail.mt_item.item_name}
                        </td> 
                        <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                            ${orderItemDetail.order_amount}
                        </td> 
                        <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                            ${orderItemDetail.trn_order_header.partner_number}
                        </td> 
                    </tr>
                    `;
                    tableBody.append(row);
                });                
            },
            error: function (err) {
                console.log(err);
            } 
        });
    }

    function onSearchOrderNumberWithKeyword() {
        let orderNumber = $('input[name="order_number_search_modal_order_number"]').val();
        let contractNumber = $('input[name="order_number_search_modal_contract_number"]').val();
        let orderYearStart = $('input[name="order_number_search_modal_order_year_start"]').val();
        let orderMonthStart = $('input[name="order_number_search_modal_order_month_start"]').val();
        let orderDayStart = $('input[name="order_number_search_modal_order_day_start"]').val();
        let orderYearEnd = $('input[name="order_number_search_modal_order_year_end"]').val();
        let orderMonthEnd = $('input[name="order_number_search_modal_order_month_end"]').val();
        let orderDayEnd = $('input[name="order_number_search_modal_order_day_end"]').val();

        let orderStartDate = orderYearStart + "-" + orderMonthStart + "-" + orderDayStart;
        let orderEndDate = orderYearEnd + "-" + orderMonthEnd + "-" + orderDayEnd;
        
        if(orderYearStart == "" || orderMonthStart == "" || orderDayStart == "") {
            orderStartDate = "";
        }
        if(orderYearEnd == "" || orderMonthEnd == "" || orderDayEnd == "") {
            orderEndDate = "";
        }

        let tableBody = $('.searchPurhcaseOrderTableBody');
        tableBody.empty();
        const loading = `
            <tr>
                <td colspan="8" class="mt-5 text-center">
                    読み込み中
                </td>
            </tr>
        `;  
        tableBody.append(loading);

        $.ajax({
            url: './get_search_order_number_with_keyword',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            data: {
                order_number: orderNumber,
                contract_number: contractNumber,
                order_start_date: orderStartDate,
                order_end_date: orderEndDate,
            },
            success: function(response) {
                tableBody.empty();
                order_number_search_current_page = response.data.current_page;
                order_number_search_last_page = response.data.last_page;
                order_number_search_prev_link = response.data.prev_page_url + "&order_number=" + orderNumber + "&contract_number=" + contractNumber + "&order_start_date=" + orderStartDate + "&order_end_date=" + orderEndDate;
                order_number_search_next_link = response.data.next_page_url + "&order_number=" + orderNumber + "&contract_number=" + contractNumber + "&order_start_date=" + orderStartDate + "&order_end_date=" + orderEndDate;

                updateOrderNumberSearchPaginationStatus();

                response.data.data.forEach(function (orderItemDetail) {
                    let row = `
                        <tr class="even:bg-[#FFFFCC] cursor-pointer" >
                            <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${orderItemDetail.trn_order_header.order_number}
                            </td> 
                            <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${orderItemDetail.order_detail_cd}
                            </td> 
                            <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${orderItemDetail.trn_order_header.specify_deadline}
                            </td> 
                            <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${orderItemDetail.mt_item.item_cd}
                            </td> 
                            <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${orderItemDetail.mt_item.item_name}
                            </td> 
                            <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${orderItemDetail.order_amount}
                            </td> 
                            <td ondblclick="selectOrderNumber('${orderItemDetail.trn_order_header.order_number}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${orderItemDetail.trn_order_header.partner_number}
                            </td> 
                        </tr>
                    `;
                    tableBody.append(row);
                });                
            },
            error: function (err) {
                console.log(err);
            } 
        });

    }

    function selectOrderNumber(orderNumber) {
        $('input[name="order_number"]').val(orderNumber);
        
        $('.modal-window').removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
        setTimeout(function () {
            $('#modalSearchOrderNumberOverlay').removeClass('flex').addClass('hidden');
        }, 300); 
    }

    $(document).ready(function () {
        $('#closeSearchOrderNumberModal, #closeSearchOrderNumberModalBtn').on('click', function () {
            closeSearchOrderNumberModal();
        });

        function closeSearchOrderNumberModal() {
            $('.modal-window').removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
            setTimeout(function () {
                $('#modalSearchOrderNumberOverlay').removeClass('flex').addClass('hidden');
            }, 300); 
        }

        $('.modal-window').on('click', function (e) {
            e.stopPropagation();
        });
    });
    
    function updateOrderNumberSearchPaginationStatus() {
        let orderNumberSearchPrevButton = $('.orderNumberSearchPrevButton');
        let orderNumberSearchNextButton = $('.orderNumberSearchNextButton');

        let orderNumberSearchCurrentPage = $('.orderNumberSearchCurrentPage');
        let orderNumberSearchLastPage = $('.orderNumberSearchLastPage');
        
        orderNumberSearchCurrentPage.html(`${order_number_search_current_page}`);
        orderNumberSearchLastPage.html(`${order_number_search_last_page}`);


        if(order_number_search_last_page == 1) {
            orderNumberSearchPrevButton.html(`
                <img class="img-2" src="{{ asset('/img/icon/page-left-off.svg') }}">
            `);
            orderNumberSearchNextButton.html(`
                <img class="img-2" src="{{ asset('/img/icon/page-right-off.svg') }}">
            `);
            return;
        }

        if(order_number_search_current_page == 1 && order_number_search_last_page > 1) {
            orderNumberSearchPrevButton.html(`
                <img class="img-2" src="{{ asset('/img/icon/page-left-off.svg') }}">
            `);

            orderNumberSearchNextButton.html(`
                <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-right-on.svg') }}">
            `);
            return;
        }

        if(order_number_search_current_page == order_number_search_last_page) {
            orderNumberSearchPrevButton.html(`
                <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-left-on.svg') }}">
            `);

            orderNumberSearchNextButton.html( `
                <img class="img-2" src="{{ asset('/img/icon/page-right-off.svg') }}">
            `);
            return;
        }

        orderNumberSearchPrevButton.html(`
            <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-left-on.svg') }}">
        `);
        orderNumberSearchNextButton.html(`
            <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-right-on.svg') }}">
        `);      
    }
</script>