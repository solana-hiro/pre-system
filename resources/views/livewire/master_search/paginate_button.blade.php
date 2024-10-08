<div class="modal-paging" id="modal-paging">
    <div class="text-wrapper-5">{{ $list->currentPage() }}/{{ $list->lastPage() }}
    </div>
    <div class="component">
        @if ($list->currentPage() > 1)
            <div class="left-wrapper">
                <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-left-on.svg') }}" wire:click="prev">
            </div>
        @else
            <div class="left-wrapper">
                <img class="img-2" src="{{ asset('/img/icon/page-left-off.svg') }}">
            </div>
        @endif
        @if ($list->currentPage() < $list->lastPage())
            <div class="right-wrapper">
                <img class="img-2 cursor-pointer" src="{{ asset('/img/icon/page-right-on.svg') }}" wire:click="next">
            </div>
        @else
            <div class="right-wrapper">
                <img class="img-2" src="{{ asset('/img/icon/page-right-off.svg') }}">
            </div>
        @endif
    </div>
</div>
