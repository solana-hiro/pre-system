<?php

namespace App\Livewire\MasterSearch;

use App\Services\DefArrivalDateService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ArrivalDate extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $arrivalDateCd;
    public $arrivalDateName;

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
        $service = new DefArrivalDateService();
        return view('livewire.master_search.arrival_date', [
            'arrivalDateData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'arrival_date_cd' => $this->arrivalDateCd,
            'arrival_date_name' => $this->arrivalDateName,
        ];
    }
}
