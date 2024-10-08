<?php

namespace App\Livewire\MasterSearch;

use App\Services\DefDepartmentService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Department extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $departmentCd;
    public $departmentName;

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
        $service = new DefDepartmentService();
        return view('livewire.master_search.department', [
            'departmentData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'department_cd' => $this->departmentCd,
            'department_name' => $this->departmentName,
        ];
    }
}
