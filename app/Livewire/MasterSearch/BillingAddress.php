<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtBillingAddressService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class BillingAddress extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $billingAddressCd;
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
        $service = new MtBillingAddressService();
        return view('livewire.master_search.billing_address', [
            'billingAddressData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'customer_cd' => $this->billingAddressCd,
            'customer_name' => $this->name,
            'customer_name_kana' => $this->kana,
            'tel' => $this->tel,
        ];
    }
}
