<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtSupplierClassService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class SupplierClass3 extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $supplierClassCd;
    public $supplierClassName;

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
        $service = new MtSupplierClassService();
        return view('livewire.master_search.supplier_class3', [
            'supplierClass3Data' => $service->getClass3($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'supplier_class_cd' => $this->supplierClassCd,
            'supplier_class_name' => $this->supplierClassName,
        ];
    }
}
