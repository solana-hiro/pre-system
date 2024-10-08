<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtCustomerClassService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Rank3 extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $customerClassCd;
    public $customerClassName;
    public $option = null;
    public $target = null;
    public $oValue = null;

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
        $service = new MtCustomerClassService();
        return view('livewire.master_search.rank3', [
            'rank3Data' => $service->getRank3($this->params()),
            'option' => $this->option,
            'target' => $this->target,
            'oValue' => $this->oValue,
        ]);
    }

    private function params()
    {
        return [
            'customer_class_cd' => $this->customerClassCd,
            'customer_class_name' => $this->customerClassName,
        ];
    }
}
