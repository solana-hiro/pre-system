<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtMemberSiteItemService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class MemberSiteItem extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $ecItemCd;
    public $ecItemName;

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
        $service = new MtMemberSiteItemService();
        return view('livewire.master_search.member_site_item', [
            'memberSiteItemData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'ec_item_cd' => $this->ecItemCd,
            'ec_item_name' => $this->ecItemName,
        ];
    }
}
