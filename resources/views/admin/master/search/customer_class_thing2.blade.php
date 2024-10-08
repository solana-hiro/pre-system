<div class="modal-box  modal-box-w450px" id="search_customer_class_thing2_modal">
    <div class="modal-content">
        <header class="header">
            <div class="text-wrapper">業種・特徴2検索</div>
            <div>
                <img class="modal-close" src="{{ asset('/img/icon/modal_close.svg') }}" data-smm-close />
            </div>
        </header>
        <livewire:master_search.customer_class_thing2 :option="$option ?? null" :target="$target ?? null" :oValue="$oValue ?? null" />
    </div>
</div>
