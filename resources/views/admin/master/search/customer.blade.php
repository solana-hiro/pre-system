<div class="modal-box  modal-box-w800px" id="search_customer_modal">
    <div class="modal-content">
        <header class="header">
            <div class="text-wrapper">得意先コード検索</div>
            <div>
                <img class="modal-close" src="{{ asset('/img/icon/modal_close.svg') }}" data-smm-close />
            </div>
        </header>
        <livewire:master_search.customer :includeDeleted="$includeDeleted ?? false" :option="$option ?? null" :target="$target ?? null" :oValue="$oValue ?? null" />
    </div>
</div>
