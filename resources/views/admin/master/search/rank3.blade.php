<div class="modal-box modal-box-w400px" id="search_rank3_modal">
    <div class="modal-content">
        <header class="header">
            <div class="text-wrapper">ランク3検索</div>
            <div>
                <img class="modal-close" src="{{ asset('/img/icon/modal_close.svg') }}" data-smm-close />
            </div>
        </header>
        <livewire:master_search.rank3 :option="$option ?? null" :target="$target ?? null" :oValue="$oValue ?? null" />
    </div>
</div>
