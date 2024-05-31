<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {

        $startDate = $request->input("startDate");
        $endDate = $request->input("endDate");
        $print = $request->input("print");

        $now = Carbon::now();
        $startDate = $startDate ? $startDate : $now;
        $endDate = $endDate ? $endDate : $now;

        // select * from receipts where role='receipt' order by name
        $receipts = Receipt::with('user')->where('status', 'done')->whereBetween('receipt_date', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->orderby('receipt_date', 'desc')->get();
        $data = [
            "title" => "Report",
            "receipts" => $receipts,
            "startDate" => $startDate,
            "endDate" => $endDate
        ];

        if($print) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadview('report.report', $data);

            return $pdf->download('receipt-report.pdf');
        }
        return view('report.index', $data);

    }

}