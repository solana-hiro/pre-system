<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtPayDestinationService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PayDestination extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $code;
    public $name;
    public $kana;
    public $tel;

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
        $service = new MtPayDestinationService();
        return view('livewire.master_search.pay_destination', [
            'payDestinationData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'kana' => $this->kana,
            'tel' => $this->tel,
        ];
    }
}
