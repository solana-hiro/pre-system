<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CommonExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\TrnOrderReceiveDetailService;
use Maatwebsite\Excel\Excel as Excels;
use Maatwebsite\Excel\Facades\Excel;

class TrnOrderReceiveDetailController extends Controller
{
    public function paymentGuidanceExcel(Request $request, TrnOrderReceiveDetailService $trnOrderReceiveDetailService)
    {
        $fileName = "入金案内書.xlsx";
        $params = [
            'specify_deadline_from' => $request->specify_deadline_from,
            'specify_deadline_to' => $request->specify_deadline_to,
            'currentDate' => Carbon::now()->format('Y/m/d'),
        ];
        $header = [
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];
        $view = view('export.payment_guidance', compact('params'));
        $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
        return $result;
    }

    public function shortageGuidanceExcel(Request $request, TrnOrderReceiveDetailService $trnOrderReceiveDetailService)
    {
        $fileName = "欠品案内書.xlsx";
        $params = [
            'currentDate' => Carbon::now()->format('Y/m/d'),
        ];
        $header = [
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];
        $view = view('export.shortage_guidance', compact('params'));
        $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
        return $result;
    }

    public function shippingGuidanceExcel(Request $request, TrnOrderReceiveDetailService $trnOrderReceiveDetailService)
    {
        $fileName = "出荷案内書.xlsx";
        $params = [
            'currentDate' => Carbon::now()->format('Y/m/d'),
        ];
        $header = [
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];
        $view = view('export.shipping_guidance', compact('params'));
        $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
        return $result;
    }

    public function keepGuidanceExcel(Request $request, TrnOrderReceiveDetailService $trnOrderReceiveDetailService)
    {
        $fileName = "ＫＥＥＰ案内書.xlsx";
        $params = [
            'currentDate' => Carbon::now()->format('Y/m/d'),
        ];
        $header = [
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];
        $view = view('export.keep_guidance', compact('params'));
        $result = Excel::download(new CommonExport($view), $fileName, Excels::XLSX, $header);
        return $result;
    }
}
