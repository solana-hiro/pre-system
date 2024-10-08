<?php

namespace App\Livewire\MasterSearch;

use App\Services\DefPsKbnService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PsKbn extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $psKbnCd;

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
        $service = new DefPsKbnService();
        return view('livewire.master_search.ps_kbn', [
            'psKbnData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'ps_kbn_cd' => $this->psKbnCd,
        ];
    }
}
