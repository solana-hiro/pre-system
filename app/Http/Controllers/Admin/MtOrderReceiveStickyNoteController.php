<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\MtOrderReceiveStickyNoteService as MtOrderReceiveStickyNoteService;
use Carbon\Carbon;
use App\Consts\CommonConsts;

class MtOrderReceiveStickyNoteController extends Controller
{
    /**
    * commonParams: 共通パラメータ
    */
    private $commonParams;

    public function __construct()
    {
        parent::__construct();
        $menus = $this->getMenu();
        $pageInfo = $this->getPageInfo();
        $this->commonParams = ['menus' => $menus, 'pageInfo' => $pageInfo];
    }

    /**
     * 環境設定 受付付箋マスタ 初期表示
     * @param $request
     * @return Object
     */
    public function setStickyNote(MtOrderReceiveStickyNoteService $service)
    {
        $initData = $service->getInitData();
        return view('admin.system.environment.stickyNote', ['commonParams' => $this->commonParams, 'initData' => $initData]);
    }

    /**
     * 環境設定 受付付箋マスタ 更新
     * @param $request
     * @return Object
     */
    public function updateStickyNote(Request $request, MtOrderReceiveStickyNoteService $service)
    {
        if ($request->has('cancel')) {
            return redirect()->route('system.environment.sticky_note.index');
        } elseif ($request->has('update')) {
            $result = $service->update($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('system.environment.sticky_note.index')->with('flashmessage', $flashmessage);
            }
        }
        return redirect()->route('system.environment.sticky_note.index');
    }

}
