<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtItemService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Services\CommonService;

class ItemCd extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $code;
    public $name;
    public $kana;
    public $otherPartNumber;
    public $jan;
    public $mtMemberSiteItemCd;
    public $mtItemClass1Cd;
    public $mtItemClass2Cd;
    public $mtItemClass3Cd;
    public $mtItemClass4Cd;
    public $mtItemClass5Cd;
    public $mtItemClass6Cd;
    public $mtItemClass7Cd;
    public $itemKbn;
    public $includeDeleted = false;

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
        $service = new MtItemService();
        return view('livewire.master_search.item_cd', [
            'itemData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'item_cd' => $this->code,
            'item_name' => $this->name,
            'item_name_kana' => $this->kana,
            'other_part_number' => $this->otherPartNumber,
            'jan' => $this->jan,
            'member_item_code' => $this->mtMemberSiteItemCd,
            'mt_item_class1_cd' => $this->mtItemClass1Cd,
            'mt_item_class2_cd' => $this->mtItemClass2Cd,
            'mt_item_class3_cd' => $this->mtItemClass3Cd,
            'mt_item_class4_cd' => $this->mtItemClass4Cd,
            'mt_item_class5_cd' => $this->mtItemClass5Cd,
            'mt_item_class6_cd' => $this->mtItemClass6Cd,
            'mt_item_class7_cd' => $this->mtItemClass7Cd,
            'item_kbn' => $this->itemKbn,
            'include_deleted' => $this->includeDeleted,
        ];
    }
}
