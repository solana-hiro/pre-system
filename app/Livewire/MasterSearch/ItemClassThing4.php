<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtItemClassService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ItemClassThing4 extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $itemClassCd;
    public $itemClassName;

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
        $service = new MtItemClassService();
        return view('livewire.master_search.item_class_thing4', [
            'itemClassThing4Data' => $service->getItemClassThing4($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'item_class_cd' => $this->itemClassCd,
            'item_class_name' => $this->itemClassName,
        ];
    }
}
