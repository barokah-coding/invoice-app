@extends('app')

@section('title', 'PDf Download')
@section('link')
   
     <link rel="stylesheet" href="{{ asset('css/invoice-download.css') }}">
@endsection
@section('pdf')
   

       <div class="invoice-download" id="invoice-content">
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
                     <p>{{ $invoice->no_invoice }}</p>
                  </h3>
                  <p>
                     <p>{{ $invoice->created_at->format('j F Y') }}</p>
                  </p>
               </div>
               </div>
            
         </div>
         <div class="table-invoice">
            <table id="table" class="table">
        <thead class="thead-dark" id="thead-table">
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

@section('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    
<script>
   //  window.onload = function() {
   //      const { jsPDF } = window.jspdf;
   //      const doc = new jsPDF('p', 'mm', 'a4');
   //      const invoiceContent = document.getElementById('invoice-content');

   //      html2canvas(invoiceContent, {
   //          scale: 2, // Keep scale for sharpness
   //          useCORS: true // Ensure cross-origin images are handled
   //      }).then((canvas) => {
   //          const imgData = canvas.toDataURL('image/jpeg', 0.7); // Set image quality to 70%
   //          const imgWidth = 190; // Width of the image in mm
   //          const pageHeight = doc.internal.pageSize.height;
   //          const imgHeight = (canvas.height * imgWidth) / canvas.width;

   //          // Calculate how many pages the image takes
   //          let heightLeft = imgHeight;
   //          let position = 0;

   //          // If the height is more than the page height, add a new page
   //          doc.addImage(imgData, 'JPEG', 10, 10, imgWidth, Math.min(heightLeft, pageHeight - 20));
   //          heightLeft -= pageHeight;

   //          while (heightLeft > 0) {
   //              position = heightLeft - imgHeight; // Update position
   //              doc.addPage();
   //              doc.addImage(imgData, 'JPEG', 10, position, imgWidth, Math.min(heightLeft, pageHeight - 20));
   //              heightLeft -= pageHeight;
   //          }

   //          // Save the PDF
   //          doc.save('invoice.pdf', { returnPromise: true }).then(() => {
   //              window.location.href = "{{ route('dashboard') }}";
   //          });
   //      });
   //  };


   
</script>

<script>   
    window.onload = function() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('p', 'mm', 'a4'); // A4 size in mm (portrait)
        const invoiceContent = document.getElementById('invoice-content');

        html2canvas(invoiceContent, {
            scale: 5, // Significantly increase the scale to enlarge content
            useCORS: true // Allow cross-origin images
        }).then((canvas) => {
            const imgData = canvas.toDataURL('image/jpeg', 1.0); // Set image quality to 100%
            const imgWidth = 210; // Set to the exact width of an A4 page
            const pageHeight = 297; // A4 page height in mm
            const imgHeight = (canvas.height * imgWidth) / canvas.width; // Maintain aspect ratio

            let heightLeft = imgHeight;
            let position = 0; // Start at the very top

            // Add the first page
            doc.addImage(imgData, 'JPEG', 0, position, imgWidth, Math.min(imgHeight, pageHeight));
            heightLeft -= pageHeight;

            // Add additional pages if necessary
            while (heightLeft > 0) {
                position = 0; // Reset position for new page
                doc.addPage();
                doc.addImage(imgData, 'JPEG', 0, position, imgWidth, Math.min(heightLeft, pageHeight));
                heightLeft -= pageHeight;
            }

            // Save the PDF and redirect
            doc.save('invoice.pdf', { returnPromise: true }).then(() => {
                window.location.href = "{{ route('dashboard') }}";
            });
        });
    };
</script>





@endsection





