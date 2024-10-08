<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtRootService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Root extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $rootCd;
    public $rootName;

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
        $service = new MtRootService();
        return view('livewire.master_search.root', [
            'rootData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'root_cd' => $this->rootCd,
            'root_name' => $this->rootName,
        ];
    }
}
