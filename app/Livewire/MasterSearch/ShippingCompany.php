<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtShippingCompanyService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ShippingCompany extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $shippingCompanyCd;
    public $shippingCompanyName;

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
        $service = new MtShippingCompanyService();
        return view('livewire.master_search.shipping_company', [
            'shippingCompanyData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'shipping_company_cd' => $this->shippingCompanyCd,
            'shipping_company_name' => $this->shippingCompanyName,
        ];
    }
}
