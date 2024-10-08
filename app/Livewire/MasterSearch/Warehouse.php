<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtWarehouseService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Warehouse extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $warehouseCd;
    public $warehouseName;

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
        $service = new MtWarehouseService();
        return view('livewire.master_search.warehouse', [
            'warehouseData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'warehouse_cd' => $this->warehouseCd,
            'warehouse_name_kana' => $this->warehouseName,
        ];
    }
}
