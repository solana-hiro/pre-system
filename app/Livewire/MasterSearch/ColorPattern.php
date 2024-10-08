<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtColorPatternService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ColorPattern extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $colorPatternCd;

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
        $service = new MtColorPatternService();
        return view('livewire.master_search.color_pattern', [
            'colorPatternData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'color_pattern_cd' => $this->colorPatternCd,
        ];
    }
}
