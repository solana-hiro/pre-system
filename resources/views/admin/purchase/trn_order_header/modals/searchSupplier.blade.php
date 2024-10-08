<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="fixed inset-0 bg-[#2D3842] bg-opacity-50 hidden justify-center items-center z-[10000]" id="modalSearchSupplierOverlay">
    <div class="search-supplier-modal-window transform transition-all duration-300 scale-95 opacity-0 bg-white p-[20px] rounded-lg shadow-lg z-[10001]">
        <div class="flex justify-between items-center">
            <h3 class="text-xl">仕入先検索</h3>
            <svg id="closeSearchSupplierModal" class="text-gray-500 hover:text-gray-700 cursor-pointer" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.3346 12.3337L1.66797 1.66699M12.3346 1.66699L1.66797 12.3337" stroke="#2D3842" stroke-width="2.13333" stroke-linecap="round"/>
            </svg>  
        </div>
        <hr class="my-3">
        <div class="flex justify-end">
            <button 
                class="bg-[#1483F8] text-white text-sm px-[20px] py-[5px] hover:opacity-85 duration-300 transition-all cursor-pointer rounded-md"
                onclick="onSearchSupplierWithKeyword()"
            >
                実行する
            </button>
        </div>
        <div class="mt-4 flex justify-start items-center gap-5">
            <div class="flex justify-start items-center gap-1">
                <label class="text-sm text-[#2D3842] font-medium">仕入先コード</label>
                <input type="text" name="supplier_search_modal_supplier_code" class="supplier_search_modal_supplier_code text-sm py-1 px-2 w-[88px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" >
            </div>
            <div class="flex justify-start items-center gap-1">
                <label class="text-sm text-[#2D3842] font-medium">名称（部分）</label>
                <input type="text" name="supplier_search_modal_supplier_name" class="supplier_search_modal_supplier_name text-sm py-1 px-2 w-[150px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" >
            </div>
        </div>
        <div class="mt-4 flex justify-start items-center gap-5">
            <div class="flex justify-start items-center gap-1">
                <label class="text-sm text-[#2D3842] font-medium">仕入先名ｶﾅ</label>
                <input type="text" name="supplier_search_modal_supplier_name_kana" class="supplier_search_modal_supplier_name_kana text-sm py-1 px-2 w-[88px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" >
            </div>
            <div class="flex justify-start items-center gap-1">
                <label class="text-sm text-[#2D3842] font-medium">TEL（部分）</label>
                <input type="text" name="supplier_search_modal_supplier_tel" class="supplier_search_modal_supplier_tel text-sm py-1 px-2 w-[150px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" >
            </div>
        </div>
        <div class="mt-2 flex justify-end items-center gap-2">
            <span class="supplierSearchCurrentPage">1</span>/ <span class="supplierSearchLastPage">1</span>
            <div class="flex justify-center items-center">
                <div class="supplierSearchPrevButton inline-block" onclick="paginateSupplierSearchPage('prev')">
                    <img class="img-2" src="{{ asset('/img/icon/page-left-off.svg') }}">
                </div>
                <div class="supplierSearchNextButton inline-block" onclick="paginateSupplierSearchPage('next')">
                    <img class="img-2" src="{{ asset('/img/icon/page-right-off.svg') }}">
                </div>
            </div>
        </div>
        <div class="mt-10 relative h-[450px] overflow-y-scroll">
            <table class="w-full min-w-[610px]">
                <thead class="sticky top-0 z-10 border-[1px] border-[#D0DFE4] text-center text-white bg-[#3A5A9B] font-medium text-[13px]">
                    <tr class="border-[1px]">
                        <td class="border-[1px] py-2 w-[20%]">仕入先コード</td>
                        <td class="border-[1px] py-2 w-[25%]">仕入先名</td>
                        <td class="border-[1px] py-2 w-[20%]">カナ</td>
                        <td class="border-[1px] py-2 px-[10px] w-[20%]">電話番号</td>
                        <td class="border-[1px] py-2 w-[15%]">締日</td>
                    </tr>
                </thead>
                <tbody class="searchSupplierTableBody border-[1px] border-[#D0DFE4] text-[13px]">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    
    let supplier_search_current_page = 1;
    let supplier_search_last_page = 1;
    let supplier_search_prev_link = "";
    let supplier_search_next_link = "";


    function onClickOpenModalSearchSupplier() {
        $('#modalSearchSupplierOverlay').removeClass('hidden').addClass('flex');
        setTimeout(function () {
            $('.search-supplier-modal-window').removeClass('scale-95 opacity-0').addClass('scale-100 opacity-100');
        }, 10);

        $('input[name="supplier_search_modal_supplier_code"]').val("");
        $('input[name="supplier_search_modal_supplier_name"]').val("");
        $('input[name="supplier_search_modal_supplier_name_kana"]').val("");
        $('input[name="supplier_search_modal_supplier_tel"]').val("");


        let tableBody = $('.searchSupplierTableBody');
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
            url: './get_search_supplier_all',
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            type: 'get',
            success: function(response) {
                tableBody.empty();
                supplier_search_current_page = response.data.current_page;
                supplier_search_last_page = response.data.last_page;
                supplier_search_prev_link = response.data.prev_page_url;
                supplier_search_next_link = response.data.next_page_url;

                updateSupplierSearchPaginationStatus();

                response.data.data.forEach(function (supplierDetail) {
                    let row = `
                        <tr class="even:bg-[#FFFFCC] cursor-pointer" >
                            <td ondblclick="selectSupplier('${supplierDetail.supplier_cd}', '${supplierDetail.supplier_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierDetail.supplier_cd}
                            </td> 
                            <td ondblclick="selectSupplier('${supplierDetail.supplier_cd}', '${supplierDetail.supplier_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierDetail.supplier_name}
                            </td> 
                            <td ondblclick="selectSupplier('${supplierDetail.supplier_cd}', '${supplierDetail.supplier_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierDetail.supplier_name_kana}
                            </td> 
                            <td ondblclick="selectSupplier('${supplierDetail.supplier_cd}', '${supplierDetail.supplier_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierDetail.tel}
                            </td> 
                            <td ondblclick="selectSupplier('${supplierDetail.supplier_cd}', '${supplierDetail.supplier_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierDetail.data_decision_date}
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

    function updateSupplierSearchPaginationStatus() {
        let supplierSearchPrevButton = $('.supplierSearchPrevButton');
        let supplierSearchNextButton = $('.supplierSearchNextButton');

        let supplierSearchCurrentPage = $('.supplierSearchCurrentPage');
        let supplierSearchLastPage = $('.supplierSearchLastPage');
        
        supplierSearchCurrentPage.html(`${supplier_search_current_page}`);
        supplierSearchLastPage.html(`${supplier_search_last_page}`);


        if(supplier_search_last_page == 1) {
            supplierSearchPrevButton.html(`
                <img class="img-2" src="{{ asset('/img/icon/page-left-off.svg') }}">
            `);
            supplierSearchNextButton.html(`
                <img class="img-2" src="{{ asset('/img/icon/page-right-off.svg') }}">
            `);
            return;
        }

        if(supplier_search_current_page == 1 && supplier_search_last_page > 1) {
            supplierSearchPrevButton.html(`
                <img class="img-2" src="{{ asset('/img/icon/page-left-off.svg') }}">
            `);

            supplierSearchNextButton.html(`
                <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-right-on.svg') }}">
            `);
            return;
        }

        if(supplier_search_current_page == supplier_search_last_page) {
            supplierSearchPrevButton.html(`
                <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-left-on.svg') }}">
            `);

            supplierSearchNextButton.html( `
                <img class="img-2" src="{{ asset('/img/icon/page-right-off.svg') }}">
            `);
            return;
        }

        supplierSearchPrevButton.html(`
            <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-left-on.svg') }}">
        `);
        supplierSearchNextButton.html(`
            <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-right-on.svg') }}">
        `);      
    }

    function paginateSupplierSearchPage(type) {
        let supplierCode = $('input[name="supplier_search_modal_supplier_code"]').val();
        let supplierName = $('input[name="supplier_search_modal_supplier_name"]').val();
        let supplierNameKana = $('input[name="supplier_search_modal_supplier_name_kana"]').val();
        let supplierTel = $('input[name="supplier_search_modal_supplier_tel"]').val();

        let calculated_link = "";
        if(type == "next") {
            if (supplier_search_next_link == null) {
                return;
            } else {
                calculated_link = supplier_search_next_link;
            }
        } else {
            if (supplier_search_prev_link == null) {
                return;
            } else {
                calculated_link = supplier_search_prev_link;
            }
        }

        let tableBody = $('.searchSupplierTableBody');
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
                supplier_search_current_page = response.data.current_page;
                supplier_search_last_page = response.data.last_page;
                supplier_search_prev_link = response.data.prev_page_url + "&supplier_cd=" + supplierCode  + "&supplier_name_kana=" + supplierName + "&supplier_name_kana=" + supplierNameKana + "&tel=" + supplierTel;
                supplier_search_next_link = response.data.next_page_url + "&supplier_cd=" + supplierCode  + "&supplier_name_kana=" + supplierName + "&supplier_name_kana=" + supplierNameKana + "&tel=" + supplierTel;

                
                updateSupplierSearchPaginationStatus();

                response.data.data.forEach(function (supplierDetail) {
                    let row = `
                        <tr class="even:bg-[#FFFFCC] cursor-pointer" >
                            <td ondblclick="selectSupplier('${supplierDetail.supplier_cd}', '${supplierDetail.supplier_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierDetail.supplier_cd}
                            </td> 
                            <td ondblclick="selectSupplier('${supplierDetail.supplier_cd}', '${supplierDetail.supplier_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierDetail.supplier_name}
                            </td> 
                            <td ondblclick="selectSupplier('${supplierDetail.supplier_cd}', '${supplierDetail.supplier_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierDetail.supplier_name_kana}
                            </td> 
                            <td ondblclick="selectSupplier('${supplierDetail.supplier_cd}', '${supplierDetail.supplier_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierDetail.tel}
                            </td> 
                            <td ondblclick="selectSupplier('${supplierDetail.supplier_cd}', '${supplierDetail.supplier_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierDetail.data_decision_date}
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

    function onSearchSupplierWithKeyword() {
        let supplierCode = $('input[name="supplier_search_modal_supplier_code"]').val();
        let supplierName = $('input[name="supplier_search_modal_supplier_name"]').val();
        let supplierNameKana = $('input[name="supplier_search_modal_supplier_name_kana"]').val();
        let supplierTel = $('input[name="supplier_search_modal_supplier_tel"]').val();


        let tableBody = $('.searchSupplierTableBody');
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
            url: './get_search_supplier_with_keyword',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            data: {
                supplier_cd: supplierCode,
                supplier_name: supplierName,
                supplier_name_kana: supplierNameKana,
                tel: supplierTel,
            },
            success: function(response) {
                tableBody.empty();
                supplier_search_current_page = response.data.current_page;
                supplier_search_last_page = response.data.last_page;
                supplier_search_prev_link = response.data.prev_page_url + "&supplier_cd=" + supplierCode  + "&supplier_name=" + supplierName + "&supplier_name_kana=" + supplierNameKana + "&tel=" + supplierTel;
                supplier_search_next_link = response.data.next_page_url + "&supplier_cd=" + supplierCode  + "&supplier_name=" + supplierName + "&supplier_name_kana=" + supplierNameKana + "&tel=" + supplierTel;

                
                updateSupplierSearchPaginationStatus();

                response.data.data.forEach(function (supplierDetail) {
                    let row = `
                        <tr class="even:bg-[#FFFFCC] cursor-pointer" >
                            <td ondblclick="selectSupplier('${supplierDetail.supplier_cd}', '${supplierDetail.supplier_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierDetail.supplier_cd}
                            </td> 
                            <td ondblclick="selectSupplier('${supplierDetail.supplier_cd}', '${supplierDetail.supplier_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierDetail.supplier_name}
                            </td> 
                            <td ondblclick="selectSupplier('${supplierDetail.supplier_cd}', '${supplierDetail.supplier_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierDetail.supplier_name_kana}
                            </td> 
                            <td ondblclick="selectSupplier('${supplierDetail.supplier_cd}', '${supplierDetail.supplier_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierDetail.tel}
                            </td> 
                            <td ondblclick="selectSupplier('${supplierDetail.supplier_cd}', '${supplierDetail.supplier_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierDetail.data_decision_date}
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

    function selectSupplier(supplierCode, supplierName) {
        $('input[name="mt_supplier_code"]').val(supplierCode);
        $('input[name="mt_supplier_name"]').val(supplierName);
        
        $('.search-supplier-modal-window').removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
        setTimeout(function () {
            $('#modalSearchSupplierOverlay').removeClass('flex').addClass('hidden');
        }, 300); 
    }

    $(document).ready(function () {
        $('#closeSearchSupplierModal, #closeSearchSupplierModalBtn').on('click', function () {
            closeSearchSupplierModal();
        });

        function closeSearchSupplierModal() {
            $('.search-supplier-modal-window').removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
            setTimeout(function () {
                $('#modalSearchSupplierOverlay').removeClass('flex').addClass('hidden');
            }, 300); 
        }

        $('.search-supplier-modal-window').on('click', function (e) {
            e.stopPropagation();
        });
    });
    
</script>