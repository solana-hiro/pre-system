<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtColorService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Color extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $colorCd;
    public $colorName;

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
        $service = new MtColorService();
        return view('livewire.master_search.color', [
            'colorData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'color_cd' => $this->colorCd,
            'color_name' => $this->colorName,
        ];
    }
}
