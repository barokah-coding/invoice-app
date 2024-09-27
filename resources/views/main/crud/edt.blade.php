@extends('app')

@section('title', 'Edit Invoice')
@section('link')
   <link rel="stylesheet" href="{{ asset('css/style.css')}}">
   <link rel="stylesheet" href="{{ asset('css/login.css')}}">
   <link rel="stylesheet" href="{{ asset('css/nav.css')}}">
   <link rel="stylesheet" href="{{ asset('css/invoice.css')}}">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
   integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endsection
@section('nav')
   @include('template.nav')   
@endsection
@section('content')
    @include('template.sidebar')
   <div class="invoice-content">
      <form action="{{ route('invoice.update', $invoice->id) }}" method="POST" id="paymentForm">
         @csrf
         @method('PUT')
         <div class="title">
            <h1 class="hijo">Invoice</h1>
         </div>
         <div class="keterangan-inv">
            <div class="text-inv">
               <h4 class="hijo">PT BINA BAROKAH SEJAHTERA</h4>
               <p class="graha">
                  <span class="graha-text">Graha Barokah</span><br>
                  Telephone: 0266230408 - 085731222878 <br>
                  Jl. Raya Cisaat-Sukabumi No. 01 Sukama nah, Cisaat, Kab. Sukabumi <br>
                  Email : barokah.organizer@gmail.com
               </p>               
            </div>
            <div class="logo-inv">
            </div>
         </div>
         <div class="hr"></div>
         <div class="bill-form">
               <div class="bill-title">
                  <h3 class="hijo">Bill To</h3>
                  <textarea name="bill_to" id="bill" cols="30" rows="1">{{ $invoice->bill_to }}</textarea>
               </div>
               <div class="invocess">
                       <div class="invoice-ket">
                  <h3>Invoice No:</h3>
                  <p>Invoice date:</p>
               </div>
               <div class="data-invoice">
                  <h3>
                     <input type="text" name="no_invoice" id="invoice_rand" readonly value="{{ $invoice->no_invoice }}">
                  </h3>
                  <p>
                     <input type="text" name="" id="invoice_date" readonly>
                  </p>
               </div>
               </div>
         </div>
         <div class="table-invoice">
            <table id="table" class="table">
        <thead class="thead-dark bg-success">
            <tr>
                <th>Description</th>
                <th>QTY</th>
                <th>Rate</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tableBody">
           @foreach ($invoice->invoice_detail as $index => $item)
<tr>
   <td>
       <textarea name="detail_invoice[{{ $index }}][deskripsi_item]" cols="30" rows="1" placeholder="Description">{{ $item->deskripsi_item }}</textarea>
   </td>
   <td>
       <input type="number" name="detail_invoice[{{ $index }}][qty]" min="1" placeholder="Qty" value="{{ $item->qty }}">
   </td>
   <td>
       <input type="text" name="detail_invoice[{{ $index }}][harga_item]" placeholder="Rate" value="{{ $item->harga_item }}">
   </td>
   <td>
       <input type="text" name="detail_invoice[{{ $index }}][amount]" readonly placeholder="Amount" value="{{ $item->amount }}">
   </td>
   <td>
       <button type="button" class="removeRowBtn">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                 <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
              </svg>
       </button>
   </td>
</tr>
@endforeach

        </tbody>
         </table>
         <button type="button" id="addRowBtn">
         <svg xmlns="http://www.w3.org/2000/svg" fill="black" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
         <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
         </svg>
         </button>
         </div>
         <div class="payment">
            <div class="payment-instruction">
               <h3 class="hijo">Payment Instruction</h3>
               <p class="hijo">Send to bank</p>
               <textarea name="payment_intructions" id="payment_intructions" cols="30" rows="1" val>
               {{$invoice->payment_intructions}}
               </textarea>
            </div>
            <div class="payment-count">
               <div class="subtotal">
                  <h4 class="disable">
                     <span>
                        Subtotal
                     </span>
                     <input type="text" placeholder="Subtotal" name="subtotal" readonly>
                  </h4>
               </div>
               <div class="hr"></div>
               <div class="total">
                  <h4 class="disable">
                     <span>Total</span> 
                     <input type="text" placeholder="total" readonly>
                  </h4>
                  <p> 
                     <span>
                        Paid()
                     </span>
                     <input type="number" name="total_payment" value="{{ $invoice->total_payment }}">
                  </p>
               </div>
               <div class="balance-due">
                  <h4 class="balance">
                     <span>Balance Due</span>
                     <input type="text" name="remaining_payment" readonly id="remaining_payment">
                  </h4>
               </div>
               <div class="hr"></div>
            </div>
   
         </div>
         <div class="terms">
            <div class="terms-text">
               <h4 class="hijo">Terms</h4>
               <textarea name="terms" id="terms" cols="30" rows="10">
                 {{$invoice->terms}}
               </textarea>
            </div>
            <div class="ttd">
               <h4>Lorem, ipsum.</h4>
            </div>
         </div>

         <button class="invoice-button" type="submit">Edit Invoice</button>
      </form>
   </div>  

    {{-- CKEditor script --}}
    
    @endsection
    
    

    @section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
   <script src="{{ asset('js/clasicEditor.js') }}"></script>
    <script src="{{ asset('js/timeInvoice.js') }}"></script>
    <script>
         function removeRow(event) {
      event.target.closest("tr").remove(); // Hapus baris terdekat (parent <tr>)
      calculateInvoice();
   }

   let index = {{ count($invoice->invoice_detail) }};

   document.getElementById("addRowBtn").addEventListener("click", function () {
      const tableBody = document.getElementById("tableBody");
      const newRow = document.createElement("tr");

      newRow.innerHTML = `
            <td>
                  <textarea name="detail_invoice[${index}][deskripsi_item]" cols="30" rows="1" placeholder="Description"></textarea>
            </td>
            <td>
                  <input type="number" name="detail_invoice[${index}][qty]" min="1" placeholder="Qty">
            </td>
            <td>
                  <input type="text" name="detail_invoice[${index}][harga_item]" placeholder="Rate">
            </td>
            <td>
                  <input type="text" name="detail_invoice[${index}][amount]" readonly placeholder="Amount">
            </td>
            <td>
                  <button type="button" class="removeRowBtn">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                     </svg>   
                  </button>
            </td>
         `;

      tableBody.appendChild(newRow);
      index++;

      // Attach event listener to the remove button of the newly added row
      newRow.querySelector(".removeRowBtn").addEventListener("click", removeRow);
   });

   // Tambahkan event listener ke tombol remove pertama
   document.querySelectorAll(".removeRowBtn").forEach(function (button) {
      button.addEventListener("click", removeRow);
   });

   function removeRow(event) {
    event.target.closest("tr").remove(); // Hapus baris terdekat (parent <tr>)
    calculateInvoice();
}

let index = 1;

document.getElementById("addRowBtn").addEventListener("click", function () {
    const tableBody = document.getElementById("tableBody");
    const newRow = document.createElement("tr");

    newRow.innerHTML = `
         <td>
               <textarea name="detail_invoice[${index}][deskripsi_item]" cols="30" rows="1" placeholder="Description"></textarea>
         </td>
         <td>
               <input type="number" name="detail_invoice[${index}][qty]" min="1" placeholder="Qty">
         </td>
         <td>
               <input type="text" name="detail_invoice[${index}][harga_item]" placeholder="Rate">
         </td>
         <td>
               <input type="text" name="detail_invoice[${index}][amount]" readonly placeholder="Amount">
         </td>
         <td>
               <button type="button" class="removeRowBtn">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                     <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                  </svg>   
               </button>
         </td>
      `;

    tableBody.appendChild(newRow);
    index++;

    // Attach event listener to the remove button of the newly added row
    newRow.querySelector(".removeRowBtn").addEventListener("click", removeRow);
});

// Tambahkan event listener ke tombol remove pertama
document.querySelectorAll(".removeRowBtn").forEach(function (button) {
    button.addEventListener("click", removeRow);
});

    </script>
    <script src="{{ asset('js/formatEdit.js') }}"></script>
@endsection

