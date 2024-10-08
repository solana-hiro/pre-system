<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\MtHolidayService as MtHolidayService;
use App\Consts\CommonConsts;
use Yasumi\Yasumi;
use Carbon\Carbon;

class MtHolidayController extends Controller
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
     * 環境設定休日マスタ 初期表示
     * @param $request
     * @return Object
     */
    public function setHoliday(MtHolidayService $service)
    {
        $initData = $service->getInitData();
        $currentYear = Carbon::now()->year;
        $holidays = Yasumi::create('Japan', $currentYear, 'ja_JP');
        foreach ($holidays as $h) {
            $days[(string)$h] = 0;
        }
        $holidays = Yasumi::create('Japan', $currentYear + 1, 'ja_JP');
        foreach ($holidays as $h) {
            $days[(string)$h] = 0;
        }
        $holidays = Yasumi::create('Japan', $currentYear + 2, 'ja_JP');
        foreach ($holidays as $h) {
            $days[(string)$h] = 0;
        }
        $holidays = Yasumi::create('Japan', $currentYear + 3, 'ja_JP');
        foreach ($holidays as $h) {
            $days[(string)$h] = 0;
        }
        $holidays = Yasumi::create('Japan', $currentYear + 4, 'ja_JP');
        foreach ($holidays as $h) {
            $days[(string)$h] = 0;
        }
        $keys = array_keys($days);
        $datas = $initData->pluck('set_date');
        return view('admin.system.environment.holiday', ['commonParams' => $this->commonParams, 'initData' => $datas, 'holidays' => $keys]);
    }

    /**
     * 環境設定休日マスタ 更新
     * @param $request
     * @return Object
     */
    public function updateHoliday(Request $request, MtHolidayService $service)
    {
        if ($request->has('cancel')) {
            return redirect()->route('system.environment.holiday.index');
        } elseif ($request->has('update')) {
            $result = $service->update($request->input());
            if ($result['status'] === CommonConsts::STATUS_ERROR) {
                $errormessage = __("validation.error_messages.update_error");
                return back()->withInput()->with('errormessage', $errormessage);
            } elseif ($result['status'] === CommonConsts::STATUS_SUCCESS) {
                $flashmessage = __("validation.complete_message.update_complete");
                return redirect()->route('system.environment.holiday.index')->with('flashmessage', $flashmessage);
            }
        }
        return redirect()->route('system.environment.holiday.index');
    }
}
