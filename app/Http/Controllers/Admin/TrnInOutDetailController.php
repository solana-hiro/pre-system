<?php

namespace App\Http\Controllers\Admin;

use App\Services\TrnInOutBreakdownService;
use Illuminate\Http\Request;

class TrnInOutDetailController extends Controller
{
    //
    function getDetailBreakdowns(Request $request, TrnInOutBreakdownService $trnInOutBreakdownService)
    {
        $params = $request->all();
        $datas = $trnInOutBreakdownService->getDetailBreakdowns($params);
        return response()->json($datas);
    }
}
