<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="fixed inset-0 bg-[#2D3842] bg-opacity-50 hidden justify-center items-center z-[10000]" id="modalSearchDepartmentOverlay">
    <div class="search-department-modal-window transform transition-all duration-300 scale-95 opacity-0 bg-white p-[20px] rounded-lg shadow-lg z-[10001]">
        <div class="flex justify-between items-center">
            <h3 class="text-xl">部門検索</h3>
            <svg id="closeSearchDepartmentClassOneModal" class="text-gray-500 hover:text-gray-700 cursor-pointer" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.3346 12.3337L1.66797 1.66699M12.3346 1.66699L1.66797 12.3337" stroke="#2D3842" stroke-width="2.13333" stroke-linecap="round"/>
            </svg>  
        </div>
        <hr class="my-3">
        <div class="flex justify-end">
            <button 
                class="bg-[#1483F8] text-white text-sm px-[20px] py-[5px] hover:opacity-85 duration-300 transition-all cursor-pointer rounded-md"
                onclick="onSearchDepartmentWithKeyword()"
            >
                実行する
            </button>
        </div>
        <div class="mt-4 flex justify-start items-center gap-5">
            <div class="flex justify-start items-center gap-1">
                <label class="text-sm text-[#2D3842] font-medium">部門コード</label>
                <input type="text" name="department_search_modal_department_code" class="department_search_modal_department_code text-sm py-1 px-2 w-[52px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" >
            </div>
            <div class="flex justify-start items-center gap-1">
                <label class="text-sm text-[#2D3842] font-medium">部門名（部分）</label>
                <input type="text" name="department_search_modal_department_name" class="department_search_modal_department_name text-sm py-1 px-2 w-[96pz] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" >
            </div>
        </div>
        <div class="mt-2 flex justify-end items-center gap-2">
            <span class="departmentSearchCurrentPage">1</span>/ <span class="departmentSearchLastPage">1</span>
            <div class="flex justify-center items-center">
                <div class="departmentSearchPrevButton inline-block" onclick="paginateDepartmentSearchPage('prev')">
                    <img class="img-2" src="{{ asset('/img/icon/page-left-off.svg') }}">
                </div>
                <div class="departmentSearchNextButton inline-block" onclick="paginateDepartmentSearchPage('next')">
                    <img class="img-2" src="{{ asset('/img/icon/page-right-off.svg') }}">
                </div>
            </div>
        </div>
        <div class="mt-10 relative h-[450px] overflow-y-scroll">
            <table class="w-full min-w-[610px]">
                <thead class="sticky top-0 z-10 border-[1px] border-[#D0DFE4] text-center text-white bg-[#3A5A9B] font-medium text-[13px]">
                    <tr class="border-[1px]">
                        <td class="border-[1px] py-2 w-[20%]">部門コード</td>
                        <td class="border-[1px] py-2 w-[25%]">部門名</td>
                    </tr>
                </thead>
                <tbody class="searchDepartmentTableBody border-[1px] border-[#D0DFE4] text-[13px]">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    
    let department_search_current_page = 1;
    let department_search_last_page = 1;
    let department_search_prev_link = "";
    let department_search_next_link = "";


    function onClickOpenModalSearchDepartment() {
        $('#modalSearchDepartmentOverlay').removeClass('hidden').addClass('flex');
        setTimeout(function () {
            $('.search-department-modal-window').removeClass('scale-95 opacity-0').addClass('scale-100 opacity-100');
        }, 10);

        $('input[name="department_search_modal_department_code"]').val("");
        $('input[name="department_search_modal_department_name"]').val("");


        let tableBody = $('.searchDepartmentTableBody');
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
            url: './get_search_department_all',
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            type: 'get',
            success: function(response) {
                tableBody.empty();
                department_search_current_page = response.data.current_page;
                department_search_last_page = response.data.last_page;
                department_search_prev_link = response.data.prev_page_url;
                department_search_next_link = response.data.next_page_url;

                updateDepartmentSearchPaginationStatus();

                response.data.data.forEach(function (departmentDetail) {
                    let row = `
                        <tr class="even:bg-[#FFFFCC] cursor-pointer" >
                            <td ondblclick="selectDepartment('${departmentDetail.department_cd}', '${departmentDetail.department_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${departmentDetail.department_cd}
                            </td> 
                            <td ondblclick="selectDepartment('${departmentDetail.department_cd}', '${departmentDetail.department_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${departmentDetail.department_name}
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

    function updateDepartmentSearchPaginationStatus() {
        let departmentSearchPrevButton = $('.departmentSearchPrevButton');
        let departmentSearchNextButton = $('.departmentSearchNextButton');

        let departmentSearchCurrentPage = $('.departmentSearchCurrentPage');
        let departmentSearchLastPage = $('.departmentSearchLastPage');
        
        departmentSearchCurrentPage.html(`${department_search_current_page}`);
        departmentSearchLastPage.html(`${department_search_last_page}`);


        if(department_search_last_page == 1) {
            departmentSearchPrevButton.html(`
                <img class="img-2" src="{{ asset('/img/icon/page-left-off.svg') }}">
            `);
            departmentSearchNextButton.html(`
                <img class="img-2" src="{{ asset('/img/icon/page-right-off.svg') }}">
            `);
            return;
        }

        if(department_search_current_page == 1 && department_search_last_page > 1) {
            departmentSearchPrevButton.html(`
                <img class="img-2" src="{{ asset('/img/icon/page-left-off.svg') }}">
            `);

            departmentSearchNextButton.html(`
                <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-right-on.svg') }}">
            `);
            return;
        }

        if(department_search_current_page == department_search_last_page) {
            departmentSearchPrevButton.html(`
                <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-left-on.svg') }}">
            `);

            departmentSearchNextButton.html( `
                <img class="img-2" src="{{ asset('/img/icon/page-right-off.svg') }}">
            `);
            return;
        }

        departmentSearchPrevButton.html(`
            <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-left-on.svg') }}">
        `);
        departmentSearchNextButton.html(`
            <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-right-on.svg') }}">
        `);      
    }

    function paginateDepartmentSearchPage(type) {
        let departmentCode = $('input[name="department_search_modal_department_code"]').val();
        let departmentName = $('input[name="department_search_modal_department_name"]').val();

        let calculated_link = "";
        if(type == "next") {
            if (department_search_next_link == null) {
                return;
            } else {
                calculated_link = department_search_next_link;
            }
        } else {
            if (department_search_prev_link == null) {
                return;
            } else {
                calculated_link = department_search_prev_link;
            }
        }

        let tableBody = $('.searchDepartmentTableBody');
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
                department_search_current_page = response.data.current_page;
                department_search_last_page = response.data.last_page;
                department_search_prev_link = response.data.prev_page_url + "&department_cd=" + departmentCode  + "&department_name=" + departmentName;
                department_search_next_link = response.data.next_page_url + "&department_cd=" + departmentCode  + "&department_name=" + departmentName;

                
                updateDepartmentSearchPaginationStatus();

                response.data.data.forEach(function (departmentDetail) {
                    let row = `
                        <tr class="even:bg-[#FFFFCC] cursor-pointer" >
                            <td ondblclick="selectDepartment('${departmentDetail.department_cd}', '${departmentDetail.department_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${departmentDetail.department_cd}
                            </td> 
                            <td ondblclick="selectDepartment('${departmentDetail.department_cd}', '${departmentDetail.department_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${departmentDetail.department_name}
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

    function onSearchDepartmentWithKeyword() {
        let departmentCode = $('input[name="department_search_modal_department_code"]').val();
        let departmentName = $('input[name="department_search_modal_department_name"]').val();


        let tableBody = $('.searchDepartmentTableBody');
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
            url: './get_search_department_with_keyword',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            data: {
                department_cd: departmentCode,
                department_name: departmentName
            },
            success: function(response) {
                tableBody.empty();
                department_search_current_page = response.data.current_page;
                department_search_last_page = response.data.last_page;
                department_search_prev_link = response.data.prev_page_url + "&department_cd=" + departmentCode  + "&department_name=" + departmentName;
                department_search_next_link = response.data.next_page_url + "&department_cd=" + departmentCode  + "&department_name=" + departmentName;
                
                updateDepartmentSearchPaginationStatus();

                response.data.data.forEach(function (departmentDetail) {
                    let row = `
                        <tr class="even:bg-[#FFFFCC] cursor-pointer" >
                            <td ondblclick="selectDepartment('${departmentDetail.department_cd}', '${departmentDetail.department_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${departmentDetail.department_cd}
                            </td> 
                            <td ondblclick="selectDepartment('${departmentDetail.department_cd}', '${departmentDetail.department_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${departmentDetail.department_name}
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

    function selectDepartment(supplierClassCode, supplierClassName) {
        $('input[name="def_department_code"]').val(supplierClassCode);
        $('input[name="def_department_name"]').val(supplierClassName);
        
        $('.search-department-modal-window').removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
        setTimeout(function () {
            $('#modalSearchDepartmentOverlay').removeClass('flex').addClass('hidden');
        }, 300); 
    }

    $(document).ready(function () {
        $('#closeSearchDepartmentClassOneModal, #closeSearchDepartmentClassOneModalBtn').on('click', function () {
            closeSearchDepartmentClassOneModal();
        });

        function closeSearchDepartmentClassOneModal() {
            $('.search-department-modal-window').removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
            setTimeout(function () {
                $('#modalSearchDepartmentOverlay').removeClass('flex').addClass('hidden');
            }, 300); 
        }

        $('.search-department-modal-window').on('click', function (e) {
            e.stopPropagation();
        });
    });
    
</script>