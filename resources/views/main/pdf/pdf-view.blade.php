@extends('app')

@section('title', 'PDf Download')
@section('link')
     <link rel="stylesheet" href="{{ asset('css/invoice-download.css') }}">
        <link rel="stylesheet" href="{{ asset('css/nav.css')}}">
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
   integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endsection

@section('nav')
   @include('template.nav')   
  
@endsection

@section('pdf')
   

       <div class="invoice-download pdf-view" id="invoice-content">
         @csrf
         <div class="title">
            <h1 class="hijo">Invoice</h1>
         </div>
         <div class="keterangan-inv">
            <div class="text-inv">
               <h4 class="hijo">PT BINA BAROKAH SEJAHTERA</h4>
               <p class="graha">
                  <span class="graha-text">graha barokah</span><br>
                  Telephone: 0266230408 - 085731222878 <br>
                  Jl. Raya Cisaat-Sukabumi No. 01 Sukamanah, Cisaat, Kab. Sukabumi <br>
                  Email : barokah.organizer@gmail.com
               </p>               
            </div>
            <div class="logo-inv">
               <img src="{{ asset('images/logo-log.png') }}" alt="">
            </div>
         </div>
         <div class="hr"></div>
         <div class="bill-form">
               <div class="bill-title">
                  <h4 class="hijo">Bill To</h4>
                  <p>{{ $invoice->bill_to }}</p>
               </div>
               <div class="invoice-x">
                  <div class="invoice-ket">
                     <h3>Invoice No:</h3>
                     <p>Invoice date:</p>
                  </div>
                  <div class="data-invoice">
                     <h3>
                        {{ $invoice->no_invoice }}
                     </h3>
                     <p>
                        {{ $invoice->created_at->format('j F Y') }}
                     </p>
                  </div>
               </div>
         </div>
         <div class="table-invoice">
            <table id="table" class="table">
        <thead class="theadd" id="thead-table">
            <tr>
                <th>Description</th>
                <th>QTY</th>
                <th>Rate</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody id="tableBody">
           @foreach ($invoice->invoice_detail as $item)
           <tr>
            <td>
               {{ $item->deskripsi_item }}
            </td>
            <td>
               {{ $item->qty }}
            </td>
            <td>
               Rp. {{ number_format($item->harga_item, 0, ',', '.') }}
            </td>
            <td>
               Rp. {{ number_format($item->amount, 0, ',', '.') }}
            </td>
        </tr>
           @endforeach
        </tbody>
         </table>
         </div>
         <div class="payment">
            <div class="payment-instruction">
               <h4 class="hijo">Payment Instruction</h4>
               <p class="hijo">Send to bank</p>
               <p class="send-to">
                  {!! $invoice->payment_intructions !!}
               </p>
            </div>
            <div class="payment-count">
               <div class="subtotal">
                  <h4 class="disable">
                     <p>
                        Subtotal
                     </p>
                     <p>Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}</p>
                  </h4>
                  <div class="hr"></div>
               </div>
               <div class="total">
                  <h4 class="disable">
                     <p>Total</p> 
                     <p>Rp. {{ number_format($invoice->subtotal, 0, ',', '.') }}</p>
                  </h4>
                  <h4 class="paid"> 
                     <span>
                        Paid
                     </span>
                     <span>
                        Rp. {{ number_format($invoice->total_payment, 0, ',', '.') }}
                     </span>
                  </h4>
               </div>
               <div class="balance-due">
                  <h4 class="balance">
                     <p>Balance Due</p>
                     <p>Rp. {{ number_format($invoice->remaining_payment, 0, ',', '.') }}</p>
                  </h4>
                  <div class="hr"></div>
               </div>
            </div>
   
         </div>
         <div class="terms">
            <div class="terms-text">
               <h4 class="hijo">Terms</h4>
                 {!! $invoice->terms !!}
            </div>
            <div class="ttd">
               <h4>{{  $tanda ? $tanda->penanda_tangan : 'Lorem' }}</h4>
            </div>
         </div>
   </div>  
    
@endsection






