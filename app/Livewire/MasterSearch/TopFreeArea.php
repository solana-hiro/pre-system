<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtTopFreeAreaService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class TopFreeArea extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $areaCd;
    public $areaTitle;

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
        $service = new MtTopFreeAreaService();
        return view('livewire.master_search.top_free_area', [
            'topFreeAreaData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'area_cd' => $this->areaCd,
            'area_title' => $this->areaTitle,
        ];
    }
}
