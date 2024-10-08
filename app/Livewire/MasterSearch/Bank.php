<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtBankService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Bank extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $bankCd;
    public $bankName;

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
        $service = new MtBankService();
        return view('livewire.master_search.bank', [
            'bankData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'bank_cd' => $this->bankCd,
            'bank_name' => $this->bankName,
        ];
    }
}
