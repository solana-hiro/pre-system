<?php

namespace App\Livewire\MasterSearch;

use App\Services\TrnOrderReceiveHeaderService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class OrderReceiveHeader extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $orderReceiveNumber;
    public $customerCd;
    public $orderNumber;

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
        $service = new TrnOrderReceiveHeaderService();
        return view('livewire.master_search.order_receive_header', [
            'orderReceiveHeaderData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'order_receive_number' => $this->orderReceiveNumber,
            'customer_cd' => $this->customerCd,
            'order_number' => $this->orderNumber
        ];
    }
}
