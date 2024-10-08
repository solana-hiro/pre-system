<div class="modal-box modal-box-w450px" id="search_slip_kind_{{ $slipKindKbnCd ?? 'all' }}_modal">
    <div class="modal-content">
        <header class="header">
            <div class="text-wrapper">伝票種別検索</div>
            <div>
                <img class="modal-close" src="{{ asset('/img/icon/modal_close.svg') }}" data-smm-close />
            </div>
        </header>
        <livewire:master_search.slip_kind :slipKindKbnCd="$slipKindKbnCd ?? null" />
    </div>
</div>
