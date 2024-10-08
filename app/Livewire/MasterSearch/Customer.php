<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtCustomerService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Customer extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $customerCd;
    public $customerName;
    public $customerNameKana;
    public $tel;
    public $includeDeleted = false;
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
        $service = new MtCustomerService();
        return view('livewire.master_search.customer', [
            'customerData' => $service->get($this->params()),
            'include_deleted' => $this->includeDeleted,
            'option' => $this->option,
            'target' => $this->target,
            'oValue' => $this->oValue,
        ]);
    }

    private function params()
    {
        return [
            'customer_cd' => $this->customerCd,
            'customer_name' => $this->customerName,
            'customer_name_kana' => $this->customerNameKana,
            'tel' => $this->tel,
            'include_deleted' => $this->includeDeleted,
        ];
    }
}
