<?php

namespace App\Livewire\MasterList;

use App\Services\MtDeliveryDestinationService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class DeliveryDestination extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $deliveryDestinationId;
    public $test;

    public function blur()
    {
        $this->resetPage();
    }

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

    public function render(MtDeliveryDestinationService $service)
    {
        return view('livewire.master_list.delivery_destination', [
            'initData' => $service->getInitData($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'delivery_destination_id' => $this->deliveryDestinationId,
            'test' => $this->test,
        ];
    }
}
