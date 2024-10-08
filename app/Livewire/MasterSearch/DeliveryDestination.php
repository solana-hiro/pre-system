<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtDeliveryDestinationService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class DeliveryDestination extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $customerCd;
    public $deliveryDestinationCd;
    public $deliveryDestinationName;
    public $deliveryDestinationNameKana;
    public $tel;

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
        $service = new MtDeliveryDestinationService();
        return view('livewire.master_search.delivery_destination', [
            'deliveryDestinationData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'customer_cd' => $this->customerCd,
            'delivery_destination_cd' => $this->deliveryDestinationCd,
            'delivery_destination_name' => $this->deliveryDestinationName,
            'delivery_destination_name_kana' => $this->deliveryDestinationNameKana,
            'tel' => $this->tel,
        ];
    }
}
