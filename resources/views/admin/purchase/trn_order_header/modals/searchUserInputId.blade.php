<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="fixed inset-0 bg-[#2D3842] bg-opacity-50 hidden justify-center items-center z-[10000]" id="modalSearchUserInputIdOverlay">
    <div class="search-user-input-id-modal-window transform transition-all duration-300 scale-95 opacity-0 bg-white p-[20px] rounded-lg shadow-lg z-[10001]">
        <div class="flex justify-between items-center">
            <h3 class="text-xl">入力者検索</h3>
            <svg id="closeSearchUserInputIdModal" class="text-gray-500 hover:text-gray-700 cursor-pointer" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.3346 12.3337L1.66797 1.66699M12.3346 1.66699L1.66797 12.3337" stroke="#2D3842" stroke-width="2.13333" stroke-linecap="round"/>
            </svg>  
        </div>
        <hr class="my-3">
        <div class="flex justify-end">
            <button 
                class="bg-[#1483F8] text-white text-sm px-[20px] py-[5px] hover:opacity-85 duration-300 transition-all cursor-pointer rounded-md"
                onclick="onSearchUserInputIdWithKeyword()"
            >
                実行する
            </button>
        </div>
        <div class="mt-4 flex justify-start items-center gap-5">
            <div class="flex justify-start items-center gap-1">
                <label class="text-sm text-[#2D3842] font-medium">入力者コード</label>
                <input type="text" name="user_input_id_search_modal_user_input_id" class="user_input_id_search_modal_user_input_id text-sm py-1 px-2 w-[88px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" >
            </div>
            <div class="flex justify-start items-center gap-1">
                <label class="text-sm text-[#2D3842] font-medium">名カナ</label>
                <input type="text" name="user_input_id_search_modal_kana" class="user_input_id_search_modal_kana text-sm py-1 px-2 w-[150px] border-[1px] border-[#D4DDE1] rounded-[4px] outline-none hover:border-[#165C9D] focus:border-[#165C9D] transition-color duration-300" >
            </div>
        </div>
        <div class="mt-2 flex justify-end items-center gap-2">
            <span class="userInputIdSearchCurrentPage">1</span>/ <span class="userInputIdSearchLastPage">1</span>
            <div class="flex justify-center items-center">
                <div class="userInputIdSearchPrevButton inline-block" onclick="paginateUserInputIdSearchPage('prev')">
                    <img class="img-2" src="{{ asset('/img/icon/page-left-off.svg') }}">
                </div>
                <div class="userInputIdSearchNextButton inline-block" onclick="paginateUserInputIdSearchPage('next')">
                    <img class="img-2" src="{{ asset('/img/icon/page-right-off.svg') }}">
                </div>
            </div>
        </div>
        <div class="mt-10 relative h-[450px] overflow-y-scroll">
            <table class="w-full min-w-[360px]">
                <thead class="sticky top-0 z-10 border-[1px] border-[#D0DFE4] text-center text-white bg-[#3A5A9B] font-medium text-[13px]">
                    <tr class="border-[1px]">
                        <td class="border-[1px] py-2  w-[30%]">入力者コード</td>
                        <td class="border-[1px] py-2  w-[40%]">担当者名</td>
                        <td class="border-[1px] py-2  w-[30%]">名カナ</td>
                    </tr>
                </thead>
                <tbody class="searchUserInputIdTableBody border-[1px] border-[#D0DFE4] text-[13px]">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    let user_input_id_search_current_page = 1;
    let user_input_id_search_last_page = 1;
    let user_input_id_search_prev_link = "";
    let user_input_id_search_next_link = "";

    function onClickOpenModalSearchUerInputId() {
        $('#modalSearchUserInputIdOverlay').removeClass('hidden').addClass('flex');
        setTimeout(function () {
            $('.search-user-input-id-modal-window').removeClass('scale-95 opacity-0').addClass('scale-100 opacity-100');
        }, 10);

        $('input[name="user_input_id_search_modal_user_input_id"]').val("");
        $('input[name="user_input_id_search_modal_kana"]').val("");

        let tableBody = $('.searchUserInputIdTableBody');
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
            url: './get_search_user_input_id_all',
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            type: 'get',
            success: function(response) {
                tableBody.empty();
                user_input_id_search_current_page = response.data.current_page;
                user_input_id_search_last_page = response.data.last_page;
                user_input_id_search_prev_link = response.data.prev_page_url;
                user_input_id_search_next_link = response.data.next_page_url;

                updateUserInputIdSearchPaginationStatus();

                response.data.data.forEach(function (inputerDetail) {
                    let row = `
                        <tr class="even:bg-[#FFFFCC] cursor-pointer" >
                            <td ondblclick="selectUserInputId('${inputerDetail.user_cd}', '${inputerDetail.user_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${inputerDetail.user_cd}
                            </td> 
                            <td ondblclick="selectUserInputId('${inputerDetail.user_cd}', '${inputerDetail.user_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${inputerDetail.user_name}
                            </td> 
                            <td ondblclick="selectUserInputId('${inputerDetail.user_cd}', '${inputerDetail.user_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${inputerDetail.user_name_kana}
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

    function updateUserInputIdSearchPaginationStatus() {
        let userInputIdSearchPrevButton = $('.userInputIdSearchPrevButton');
        let userInputIdSearchNextButton = $('.userInputIdSearchNextButton');

        let userInputIdSearchCurrentPage = $('.userInputIdSearchCurrentPage');
        let userInputIdSearchLastPage = $('.userInputIdSearchLastPage');
        
        userInputIdSearchCurrentPage.html(`${user_input_id_search_current_page}`);
        userInputIdSearchLastPage.html(`${user_input_id_search_last_page}`);


        if(user_input_id_search_last_page == 1) {
            userInputIdSearchPrevButton.html(`
                <img class="img-2" src="{{ asset('/img/icon/page-left-off.svg') }}">
            `);
            userInputIdSearchNextButton.html(`
                <img class="img-2" src="{{ asset('/img/icon/page-right-off.svg') }}">
            `);
            return;
        }

        if(user_input_id_search_current_page == 1 && user_input_id_search_last_page > 1) {
            userInputIdSearchPrevButton.html(`
                <img class="img-2" src="{{ asset('/img/icon/page-left-off.svg') }}">
            `);

            userInputIdSearchNextButton.html(`
                <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-right-on.svg') }}">
            `);
            return;
        }

        if(user_input_id_search_current_page == user_input_id_search_last_page) {
            userInputIdSearchPrevButton.html(`
                <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-left-on.svg') }}">
            `);

            userInputIdSearchNextButton.html( `
                <img class="img-2" src="{{ asset('/img/icon/page-right-off.svg') }}">
            `);
            return;
        }

        userInputIdSearchPrevButton.html(`
            <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-left-on.svg') }}">
        `);
        userInputIdSearchNextButton.html(`
            <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-right-on.svg') }}">
        `);      
    }

    function paginateUserInputIdSearchPage(type) {
        let userCode = $('input[name="user_input_id_search_modal_user_input_id"]').val();
        let userNameKana = $('input[name="user_input_id_search_modal_kana"]').val();

        let calculated_link = "";
        if(type == "next") {
            if (user_input_id_search_next_link == null) {
                return;
            } else {
                calculated_link = user_input_id_search_next_link;
            }
        } else {
            if (user_input_id_search_prev_link == null) {
                return;
            } else {
                calculated_link = user_input_id_search_prev_link;
            }
        }

        let tableBody = $('.searchUserInputIdTableBody');
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
                user_input_id_search_current_page = response.data.current_page;
                user_input_id_search_last_page = response.data.last_page;
                user_input_id_search_prev_link = response.data.prev_page_url + "&user_cd=" + userCode + "&user_name_kana=" + userNameKana;
                user_input_id_search_next_link = response.data.next_page_url + "&user_cd=" + userCode + "&user_name_kana=" + userNameKana;

                
                updateUserInputIdSearchPaginationStatus();

                response.data.data.forEach(function (inputerDetail) {
                    let row = `
                        <tr class="even:bg-[#FFFFCC] cursor-pointer" >
                            <td ondblclick="selectUserInputId('${inputerDetail.user_cd}', '${inputerDetail.user_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${inputerDetail.user_cd}
                            </td> 
                            <td ondblclick="selectUserInputId('${inputerDetail.user_cd}', '${inputerDetail.user_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${inputerDetail.user_name}
                            </td> 
                            <td ondblclick="selectUserInputId('${inputerDetail.user_cd}', '${inputerDetail.user_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${inputerDetail.user_name_kana}
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

    function onSearchUserInputIdWithKeyword() {
        let userCode = $('input[name="user_input_id_search_modal_user_input_id"]').val();
        let userNameKana = $('input[name="user_input_id_search_modal_kana"]').val();


        let tableBody = $('.searchUserInputIdTableBody');
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
            url: './get_search_user_input_id_with_keyword',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            data: {
                user_cd: userCode,
                user_name_kana: userNameKana,
            },
            success: function(response) {
                tableBody.empty();
                user_input_id_search_current_page = response.data.current_page;
                user_input_id_search_last_page = response.data.last_page;
                user_input_id_search_prev_link = response.data.prev_page_url + "&user_cd=" + userCode + "&user_name_kana=" + userNameKana;
                user_input_id_search_next_link = response.data.next_page_url + "&user_cd=" + userCode + "&user_name_kana=" + userNameKana;

                updateUserInputIdSearchPaginationStatus();

                response.data.data.forEach(function (inputerDetail) {
                    let row = `
                        <tr class="even:bg-[#FFFFCC] cursor-pointer" >
                            <td ondblclick="selectUserInputId('${inputerDetail.user_cd}', '${inputerDetail.user_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${inputerDetail.user_cd}
                            </td> 
                            <td ondblclick="selectUserInputId('${inputerDetail.user_cd}', '${inputerDetail.user_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${inputerDetail.user_name}
                            </td> 
                            <td ondblclick="selectUserInputId('${inputerDetail.user_cd}', '${inputerDetail.user_name}')" class="border-[1px] border-[#D0DFE4] text-center py-2 cursor-pointer">
                                ${inputerDetail.user_name_kana}
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

    function selectUserInputId(userCode, userName) {
        $('input[name="mt_user_code"]').val(userCode);
        $('input[name="mt_user_name"]').val(userName);
        
        $('.search-user-input-id-modal-window').removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
        setTimeout(function () {
            $('#modalSearchUserInputIdOverlay').removeClass('flex').addClass('hidden');
        }, 300); 
    }

    $(document).ready(function () {
        $('#closeSearchUserInputIdModal, #closeSearchUserInputIdModalBtn').on('click', function () {
            closeSearchUserInputIdModal();
        });

        function closeSearchUserInputIdModal() {
            $('.search-user-input-id-modal-window').removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
            setTimeout(function () {
                $('#modalSearchUserInputIdOverlay').removeClass('flex').addClass('hidden');
            }, 300); 
        }

        $('.search-user-input-id-modal-window').on('click', function (e) {
            e.stopPropagation();
        });
    });
</script>