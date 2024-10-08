<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtSupplierService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Supplier extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $supplierCd;
    public $supplierName;
    public $supplierNameKana;
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
        $service = new MtSupplierService();
        return view('livewire.master_search.supplier', [
            'supplierData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'supplier_cd' => $this->supplierCd,
            'supplier_name' => $this->supplierName,
            'supplier_name_kana' => $this->supplierNameKana,
            'tel' => $this->tel,
        ];
    }
}
