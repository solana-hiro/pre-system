<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtItemClassService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ItemClassThing5 extends Component
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
        return view('livewire.master_search.item_class_thing5', [
            'itemClassThing5Data' => $service->getItemClassThing5($this->params()),
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
