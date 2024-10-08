<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtSlipKindService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class SlipKind extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $slipKindKbnCd;
    public $slipKindCd;

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
        $service = new MtSlipKindService();
        return view('livewire.master_search.slip_kind', [
            'slipKindData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'slip_kind_kbn_cd' => $this->slipKindKbnCd,
            'slip_kind_cd' => $this->slipKindCd,
        ];
    }
}
