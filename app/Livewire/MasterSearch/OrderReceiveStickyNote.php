<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtOrderReceiveStickyNoteService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class OrderReceiveStickyNote extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $def_sticky_note_kind_id;
    public $sticky_note_name;

    public function search()
    {
        $this->resetPage();
    }

    public function next()
    {
        $this->nextPage();
    }

    public function prev()
    {
        $this->previousPage();
    }

    public function render()
    {
        $service = new MtOrderReceiveStickyNoteService();
        return view('livewire.master_search.order_receive_sticky_note', [
            'orderReceiveStickyNoteData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        //検索なしの為
    }
}
