<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtItemClassService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Genre extends Component
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
        return view('livewire.master_search.genre', [
            'genreData' => $service->getGenre($this->params()),
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
