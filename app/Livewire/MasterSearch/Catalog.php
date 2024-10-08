<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtCatalogService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Catalog extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $catalogCd;
    public $catalogName;

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
        $service = new MtCatalogService();
        return view('livewire.master_search.catalog', [
            'catalogData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'catalog_cd' => $this->catalogCd,
            'catalog_name' => $this->catalogName,
        ];
    }
}
