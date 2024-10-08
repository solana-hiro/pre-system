<?php

namespace App\Livewire\MasterSearch;

use App\Services\DefPioneerYearService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Pioneer extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $pioneerYearCd;
    public $pioneerYearName;

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
        $service = new DefPioneerYearService();
        return view('livewire.master_search.pioneer', [
            'pioneerData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'pioneer_year_cd' => $this->pioneerYearCd,
            'pioneer_year_name' => $this->pioneerYearName,
        ];
    }
}
