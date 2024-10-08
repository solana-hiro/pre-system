<div class="modal-box  modal-box-w1000px" id="search_item_cd_modal">
    <div class="modal-content">
        <header class="header">
            <div class="text-wrapper">商品コード検索</div>
            <div>
                <img class="modal-close" src="{{ asset('/img/icon/modal_close.svg') }}" data-smm-close />
            </div>
        </header>
        <livewire:master_search.item_cd :includeDeleted="$includeDeleted ?? false" />
    </div>
</div>
