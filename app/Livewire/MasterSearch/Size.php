<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtSizeService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Size extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $sizeCd;
    public $sizeName;

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
        $service = new MtSizeService();
        return view('livewire.master_search.size', [
            'sizeData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'size_cd' => $this->sizeCd,
            'size_name' => $this->sizeName,
        ];
    }
}
