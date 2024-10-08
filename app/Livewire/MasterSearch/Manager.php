<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtUserService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Manager extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $managerCd;
    public $managerNameKana;

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
        $service = new MtUserService();
        return view('livewire.master_search.manager', [
            'managerData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'user_cd' => $this->managerCd,
            'user_name_kana' => $this->managerNameKana,
            'exclude_disabled' => true,
        ];
    }
}
