<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class PageController extends Controller
{
    //

    public function login(){
        return view('auth.login');
    }
  public function dashboard(Request $request)
{
    // Ambil input tanggal dari request
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Validasi input
    $request->validate([
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
    ]);

    // Ambil data invoice sesuai rentang tanggal jika ada, jika tidak ambil semua
    if ($startDate && $endDate) {
        $invoice = Invoice::whereBetween('created_at', [$startDate, $endDate])->latest()->get();
    } else {
        $invoice = Invoice::latest()->get();
    }

    return view('main.dasboard', compact('invoice'));
}


    public function cetakInvoice(Invoice $invoice) {
        // $invoice = Invoice::with('invoice_detail');
        $invoice->load('invoice_detail');
          $tanda = $invoice->signature;
        return view('main.pdf.pdf', compact('invoice', 'tanda'));
    }

     public function view(Invoice $invoice) {
        // $invoice = Invoice::with('invoice_detail');
        $invoice->load('invoice_detail');
        $tanda = $invoice->signature;
        return view('main.pdf.pdf-view', compact('invoice', 'tanda'));
    }

    

}
