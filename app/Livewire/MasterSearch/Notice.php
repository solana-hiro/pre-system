<?php

namespace App\Livewire\MasterSearch;

use App\Services\MtNoticeService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Notice extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $noticeCd;
    public $title;
    public $displayFlg = '';
    public $newsKind = '';

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
        $service = new MtNoticeService();
        return view('livewire.master_search.notice', [
            'noticeData' => $service->get($this->params()),
        ]);
    }

    private function params()
    {
        return [
            'notice_cd' => $this->noticeCd,
            'title' => $this->title,
            'display_flg' => $this->getDisplayFlg(),
            'news_kind' => $this->getNewsKind(),
        ];
    }

    private function getDisplayFlg()
    {
        if ($this->displayFlg === '') return null;
        return $this->displayFlg;
    }

    private function getNewsKind()
    {
        if ($this->newsKind === '') return null;
        return $this->newsKind;
    }
}
