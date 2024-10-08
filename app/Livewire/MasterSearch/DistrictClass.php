<?php

namespace App\Livewire\MasterSearch;

use App\Services\DefDistrictClassService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class DistrictClass extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $code;
    public $name;

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
        $service = new DefDistrictClassService();
        return view('livewire.master_search.district_class', [
            'districtClassData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'district_class_cd' => $this->code,
            'district_class_name' => $this->name,
        ];
    }
}
