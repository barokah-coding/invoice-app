<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Signature;
use Illuminate\Support\Str;
use Faker\Factory as Faker;



class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $invoiceCode = 'INV-' . strtoupper(Str::random(8));
        $faker = Faker::create();
        $invoiceCode = 'INV-' . strtoupper($faker->bothify('???-#####'));

        return view('main.crud.tambah', ['invoiceCode' => $invoiceCode]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $invoiceCode = 'INV-' . strtoupper(Str::random(8));

        $request->validate([
            'no_invoice'=>'required',
            'bill_to'=>'required',
            'subtotal'=>'required',
            'total_payment'=>'nullable',
            'remaining_payment'=>'nullable',
            'payment_intructions'=>'nullable',
            'terms'=>'nullable',
            'detail_invoice.*.deskripsi_item'=>'required',
            'detail_invoice.*.qty'=>'required',
            'detail_invoice.*.harga_item'=>'required',
            'detail_invoice.*.amount'=>'required',
            //signature
            'penanda_tangan'=>'required',
            'signature_img'=>'nullable,'
        ]); 

        $invoice = Invoice::create([
            'no_invoice'=>$request->no_invoice,
            'bill_to'=>$request->bill_to,
            'subtotal'=>$request->subtotal,
            'total_payment'=>$request->total_payment,
            'remaining_payment'=>$request->remaining_payment,
            'payment_intructions'=>$request->payment_intructions,
            'terms'=>$request->terms,
        ]);

        $invoiceId = $invoice->id;

        Signature::create([
            'invoice_id'=>$invoiceId,
            'penanda_tangan'=>$request->penanda_tangan
        ]);

        foreach ($request->input('detail_invoice') as $detail){
            InvoiceDetail::create([
                'invoice_id'=>$invoiceId,
                'deskripsi_item'=>$detail['deskripsi_item'],
                'qty'=>$detail['qty'],
                'harga_item'=>$detail['harga_item'],
                'amount'=>$detail['amount'],
            ]);
        }

        return redirect()->route('dashboard')->with('status','berhasil tambah data invoice');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $invoice->load('invoice_detail');
        return view('main.crud.edt', compact('invoice'));
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        // Validasi input data
        $request->validate([
            'no_invoice' => 'required',
            'bill_to' => 'required',
            'subtotal' => 'required',
            'total_payment' => 'required',
            'remaining_payment' => 'nullable',
            'payment_intructions' => 'nullable',
            'terms' => 'nullable',
            'detail_invoice.*.deskripsi_item' => 'required',
            'detail_invoice.*.qty' => 'required',
            'detail_invoice.*.harga_item' => 'required',
            'detail_invoice.*.amount' => 'required',
        ]);
    
        // Update data invoice
        $invoice->update([
            'no_invoice' => $request->no_invoice,
            'bill_to' => $request->bill_to,
            'subtotal' => $request->subtotal,
            'total_payment' => $request->total_payment,
            'remaining_payment' => $request->remaining_payment,
            'payment_intructions' => $request->payment_intructions,
            'terms' => $request->terms,
        ]);
    
        // Hapus detail invoice lama
        InvoiceDetail::where('invoice_id', $invoice->id)->delete();
    
        // Tambahkan kembali detail invoice baru
        foreach ($request->input('detail_invoice') as $detail) {
            InvoiceDetail::create([
                'invoice_id' => $invoice->id,
                'deskripsi_item' => $detail['deskripsi_item'],
                'qty' => $detail['qty'],
                'harga_item' => $detail['harga_item'],
                'amount' => $detail['amount'],
            ]);
        }
    
        return redirect()->route('dashboard')->with('status', 'Invoice berhasil diperbarui');
    }
    

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return back()->with('status', 'berhasil hapus invoice ' . $invoice->no_invoice);
    }
}
