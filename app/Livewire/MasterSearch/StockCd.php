<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtItemService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Services\CommonService;
use App\Services\TrnInOutHeaderService;

class StockCd extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $inOutCode;
    public $itemCode;


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

    public function render(CommonService $commonService)
    {
        $service = new TrnInOutHeaderService();
        return view('livewire.master_search.stock_cd', [
            'inoutData' => $service->get($this->params())
        ]);
    }

    private function params()
    {
        return [
            'in_out_code' => $this->inOutCode,
            'item_code' => $this->itemCode,
        ];
    }
}
