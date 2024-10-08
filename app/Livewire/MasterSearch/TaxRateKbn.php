<?php

namespace App\Livewire\MasterSearch;

use App\Services\DefTaxRateKbnService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class TaxRateKbn extends Component
{
    use WithPagination, WithoutUrlPagination;

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
        $service = new DefTaxRateKbnService();
        return view('livewire.master_search.tax_rate_kbn', [
            'taxRateKbnData' => $service->getAll(),
        ]);
    }
}
