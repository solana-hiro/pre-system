<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtSizePatternService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class SizePattern extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $sizePatternCd;

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
        $service = new MtSizePatternService();
        return view('livewire.master_search.size_pattern', [
            'sizePatternData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'size_pattern_cd' => $this->sizePatternCd,
        ];
    }
}
