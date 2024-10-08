<div class="modal-box  modal-box-w500px" id="search_customer_class_thing1_modal">
    <div class="modal-content">
        <header class="header">
            <div class="text-wrapper">販売パターン1検索</div>
            <div>
                <img class="modal-close" src="{{ asset('/img/icon/modal_close.svg') }}" data-smm-close />
            </div>
        </header>
        <livewire:master_search.customer_class_thing1 :option="$option ?? null" :target="$target ?? null" :oValue="$oValue ?? null" />
    </div>
</div>
