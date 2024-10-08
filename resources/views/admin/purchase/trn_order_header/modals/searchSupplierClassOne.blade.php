<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="fixed inset-0 bg-[#2D3842] bg-opacity-50 hidden justify-center items-center z-[10000]" id="modalSearchSupplierClassOneOverlay">
    <div class="search-supplier-class-one-modal-window transform transition-all duration-300 scale-95 opacity-0 bg-white p-[20px] rounded-lg shadow-lg z-[10001]">
        <div class="flex justify-between items-center">
            <h3 class="text-xl">仕入先分類1検索</h3>
            <svg id="closeSearchSupplierClassOneModal" class="text-gray-500 hover:text-gray-700 cursor-pointer" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.3346 12.3337L1.66797 1.66699M12.3346 1.66699L1.66797 12.3337" stroke="#2D3842" stroke-width="2.13333" stroke-linecap="round"/>
            </svg>  
        </div>
        <hr class="my-3">
        <div class="flex justify-end">
            <button 
                class="bg-[#1483F8] text-white text-sm px-[20px] py-[5px] hover:opacity-85 duration-300 transition-all cursor-pointer rounded-md"
                onclick="onSearchSupplierClassOneWithKeyword()"
            >
                実行する
            </button>
        </div>
        <div class="mt-4 flex justify-start items-center gap-5">
            <div class="flex justify-start items-center gap-1">
                <label class="text-sm text-[#2D3842] font-medium">仕入先分類1コード</label>
                <input type="text" name="supplier_class_one_search_modal_supplier_class_one_code" class="supplier_class_one_search_modal_supplier_class_one_code text-sm py-1 px-2 w-[52px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" >
            </div>
            <div class="flex justify-start items-center gap-1">
                <label class="text-sm text-[#2D3842] font-medium">仕入先分類1名（部分）</label>
                <input type="text" name="supplier_class_one_search_modal_supplier_class_one_name" class="supplier_class_one_search_modal_supplier_class_one_name text-sm py-1 px-2 w-[180px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" >
            </div>
        </div>
        <div class="mt-2 flex justify-end items-center gap-2">
            <span class="supplierClassOneSearchCurrentPage">1</span>/ <span class="supplierClassOneSearchLastPage">1</span>
            <div class="flex justify-center items-center">
                <div class="supplierClassOneSearchPrevButton inline-block" onclick="paginateSupplierClassOneSearchPage('prev')">
                    <img class="img-2" src="{{ asset('/img/icon/page-left-off.svg') }}">
                </div>
                <div class="supplierClassOneSearchNextButton inline-block" onclick="paginateSupplierClassOneSearchPage('next')">
                    <img class="img-2" src="{{ asset('/img/icon/page-right-off.svg') }}">
                </div>
            </div>
        </div>
        <div class="mt-10 relative h-[450px] overflow-y-scroll">
            <table class="w-full min-w-[610px]">
                <thead class="sticky top-0 z-10 border-[1px] border-[#D0DFE4] text-center text-white bg-[#3A5A9B] font-medium text-[13px]">
                    <tr class="border-[1px]">
                        <td class="border-[1px] py-2 w-[20%]">仕入先分類1コード</td>
                        <td class="border-[1px] py-2 w-[25%]">仕入先分類1名</td>
                    </tr>
                </thead>
                <tbody class="searchSupplierClassOneTableBody border-[1px] border-[#D0DFE4] text-[13px]">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    
    let supplier_class_one_search_current_page = 1;
    let supplier_class_one_search_last_page = 1;
    let supplier_class_one_search_prev_link = "";
    let supplier_class_one_search_next_link = "";


    function onClickOpenModalSearchSupplierClassOne() {
        $('#modalSearchSupplierClassOneOverlay').removeClass('hidden').addClass('flex');
        setTimeout(function () {
            $('.search-supplier-class-one-modal-window').removeClass('scale-95 opacity-0').addClass('scale-100 opacity-100');
        }, 10);

        $('input[name="supplier_class_one_search_modal_supplier_class_one_code"]').val("");
        $('input[name="supplier_class_one_search_modal_supplier_class_one_name"]').val("");


        let tableBody = $('.searchSupplierClassOneTableBody');
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
            url: './get_search_supplier_class_one_all',
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            type: 'get',
            success: function(response) {
                tableBody.empty();
                supplier_class_one_search_current_page = response.data.current_page;
                supplier_class_one_search_last_page = response.data.last_page;
                supplier_class_one_search_prev_link = response.data.prev_page_url;
                supplier_class_one_search_next_link = response.data.next_page_url;

                updateSupplierClassOneSearchPaginationStatus();

                response.data.data.forEach(function (supplierClassOneDetail) {
                    let row = `
                        <tr class="even:bg-[#FFFFCC] cursor-pointer" >
                            <td ondblclick="selectSupplierClassOne('${supplierClassOneDetail.supplier_class_cd}', '${supplierClassOneDetail.supplier_class_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierClassOneDetail.supplier_class_cd}
                            </td> 
                            <td ondblclick="selectSupplierClassOne('${supplierClassOneDetail.supplier_class_cd}', '${supplierClassOneDetail.supplier_class_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierClassOneDetail.supplier_class_name}
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

    function updateSupplierClassOneSearchPaginationStatus() {
        let supplierClassOneSearchPrevButton = $('.supplierClassOneSearchPrevButton');
        let supplierClassOneSearchNextButton = $('.supplierClassOneSearchNextButton');

        let supplierClassOneSearchCurrentPage = $('.supplierClassOneSearchCurrentPage');
        let supplierClassOneSearchLastPage = $('.supplierClassOneSearchLastPage');
        
        supplierClassOneSearchCurrentPage.html(`${supplier_class_one_search_current_page}`);
        supplierClassOneSearchLastPage.html(`${supplier_class_one_search_last_page}`);


        if(supplier_class_one_search_last_page == 1) {
            supplierClassOneSearchPrevButton.html(`
                <img class="img-2" src="{{ asset('/img/icon/page-left-off.svg') }}">
            `);
            supplierClassOneSearchNextButton.html(`
                <img class="img-2" src="{{ asset('/img/icon/page-right-off.svg') }}">
            `);
            return;
        }

        if(supplier_class_one_search_current_page == 1 && supplier_class_one_search_last_page > 1) {
            supplierClassOneSearchPrevButton.html(`
                <img class="img-2" src="{{ asset('/img/icon/page-left-off.svg') }}">
            `);

            supplierClassOneSearchNextButton.html(`
                <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-right-on.svg') }}">
            `);
            return;
        }

        if(supplier_class_one_search_current_page == supplier_class_one_search_last_page) {
            supplierClassOneSearchPrevButton.html(`
                <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-left-on.svg') }}">
            `);

            supplierClassOneSearchNextButton.html( `
                <img class="img-2" src="{{ asset('/img/icon/page-right-off.svg') }}">
            `);
            return;
        }

        supplierClassOneSearchPrevButton.html(`
            <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-left-on.svg') }}">
        `);
        supplierClassOneSearchNextButton.html(`
            <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-right-on.svg') }}">
        `);      
    }

    function paginateSupplierClassOneSearchPage(type) {
        let supplierClassOneCode = $('input[name="supplier_class_one_search_modal_supplier_class_one_code"]').val();
        let supplierClassOneName = $('input[name="supplier_class_one_search_modal_supplier_class_one_name"]').val();

        let calculated_link = "";
        if(type == "next") {
            if (supplier_class_one_search_next_link == null) {
                return;
            } else {
                calculated_link = supplier_class_one_search_next_link;
            }
        } else {
            if (supplier_class_one_search_prev_link == null) {
                return;
            } else {
                calculated_link = supplier_class_one_search_prev_link;
            }
        }

        let tableBody = $('.searchSupplierClassOneTableBody');
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
                supplier_class_one_search_current_page = response.data.current_page;
                supplier_class_one_search_last_page = response.data.last_page;
                supplier_class_one_search_prev_link = response.data.prev_page_url + "&supplier_class_cd=" + supplierClassOneCode  + "&supplier_class_name=" + supplierClassOneName;
                supplier_class_one_search_next_link = response.data.next_page_url + "&supplier_class_cd=" + supplierClassOneCode  + "&supplier_class_name=" + supplierClassOneName;

                
                updateSupplierClassOneSearchPaginationStatus();

                response.data.data.forEach(function (supplierClassOneDetail) {
                    let row = `
                        <tr class="even:bg-[#FFFFCC] cursor-pointer" >
                            <td ondblclick="selectSupplierClassOne('${supplierClassOneDetail.supplier_class_cd}', '${supplierClassOneDetail.supplier_class_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierClassOneDetail.supplier_class_cd}
                            </td> 
                            <td ondblclick="selectSupplierClassOne('${supplierClassOneDetail.supplier_class_cd}', '${supplierClassOneDetail.supplier_class_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierClassOneDetail.supplier_class_name}
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

    function onSearchSupplierClassOneWithKeyword() {
        let supplierClassOneCode = $('input[name="supplier_class_one_search_modal_supplier_class_one_code"]').val();
        let supplierClassOneName = $('input[name="supplier_class_one_search_modal_supplier_class_one_name"]').val();


        let tableBody = $('.searchSupplierClassOneTableBody');
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
            url: './get_search_supplier_class_one_with_keyword',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            data: {
                supplier_class_cd: supplierClassOneCode,
                supplier_class_name: supplierClassOneName
            },
            success: function(response) {
                tableBody.empty();
                supplier_class_one_search_current_page = response.data.current_page;
                supplier_class_one_search_last_page = response.data.last_page;
                supplier_class_one_search_prev_link = response.data.prev_page_url + "&supplier_class_cd=" + supplierClassOneCode  + "&supplier_class_name=" + supplierClassOneName;
                supplier_class_one_search_next_link = response.data.next_page_url + "&supplier_class_cd=" + supplierClassOneCode  + "&supplier_class_name=" + supplierClassOneName;

                
                updateSupplierClassOneSearchPaginationStatus();

                response.data.data.forEach(function (supplierClassOneDetail) {
                    let row = `
                        <tr class="even:bg-[#FFFFCC] cursor-pointer" >
                            <td ondblclick="selectSupplierClassOne('${supplierClassOneDetail.supplier_class_cd}', '${supplierClassOneDetail.supplier_class_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierClassOneDetail.supplier_class_cd}
                            </td> 
                            <td ondblclick="selectSupplierClassOne('${supplierClassOneDetail.supplier_class_cd}', '${supplierClassOneDetail.supplier_class_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${supplierClassOneDetail.supplier_class_name}
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

    function selectSupplierClassOne(supplierClassCode, supplierClassName) {
        $('input[name="mt_supplier_class_one_code"]').val(supplierClassCode);
        $('input[name="mt_supplier_class_one_name"]').val(supplierClassName);
        
        $('.search-supplier-class-one-modal-window').removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
        setTimeout(function () {
            $('#modalSearchSupplierClassOneOverlay').removeClass('flex').addClass('hidden');
        }, 300); 
    }

    $(document).ready(function () {
        $('#closeSearchSupplierClassOneModal, #closeSearchSupplierClassOneModalBtn').on('click', function () {
            closeSearchSupplierClassOneModal();
        });

        function closeSearchSupplierClassOneModal() {
            $('.search-supplier-class-one-modal-window').removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
            setTimeout(function () {
                $('#modalSearchSupplierClassOneOverlay').removeClass('flex').addClass('hidden');
            }, 300); 
        }

        $('.search-supplier-class-one-modal-window').on('click', function (e) {
            e.stopPropagation();
        });
    });
    
</script>