@extends('app')

@section('title', 'Dasboard')
@section('link')
       <link rel="stylesheet" href="{{ asset('css/style.css')}}">
   <link rel="stylesheet" href="{{ asset('css/login.css')}}">
   <link rel="stylesheet" href="{{ asset('css/nav.css')}}">
   <link rel="stylesheet" href="{{ asset('css/invoice.css')}}">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
   integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endsection

@section('nav')
   @include('template.nav')   
  
@endsection

@section('content')
    @include('template.sidebar')
   <div class="main-content">
      <div class="title">
         <div class="textt">
            <h1>Invoice app</h1>
            <p>Aplikasi Invoice adalah solusi praktis yang memudahkan pengguna dalam membuat dan mengelola faktur secara efisien.</p>
         </div>
         <div class="img">
            <img src="{{ asset('images/ivcs.png') }}" alt="">
         </div>
      </div>
      <div class="link-add-invoice">
         <div class="filter-date">
    <form action="{{ route('dashboard') }}" method="GET">
        <div class="input-group mb-3">
            <input type="date" name="start_date" class="form-control" required>
            <input type="date" name="end_date" class="form-control" required>
            <button class="btn btn-primary" type="submit">Filter</button>
        </div>
    </form>
</div>

      </div>
      <div class="container-table">
         <table id="myTable" class="table table-striped table-bordered text-center">
            <thead class="theadd">
               <tr>
                  <th>No</th>
                  <th>No Invoice</th>
                  <th>Deskripsi</th>
                  <th>Tanggal</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($invoice as $item)
            <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->no_invoice }}</td>
                  {{-- <td><small>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</small></td> --}}
                  <td><small>{{ $item->bill_to }}</small></td>
                  <td>
                     <small>
                         {{ $item->created_at->format('j F Y') }}
                     </small>
                 </td>
               <td>

                     <a href="{{ route('view', $item->id) }}" title="View">
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
</svg>
                     </a>

                     

                     {{-- cetak --}}
                     <a href="{{ route('cetakInvoice', $item->id) }}" title="Download" id="downloadInvoice">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                     </a>

                                {{-- edit --}}
                     <a href="{{ route('edit', $item->id) }}" title="Edit">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                     </svg>
                     </a>

                     {{-- delete --}}
                        <a href="#" title="Delete" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this item?')) { document.getElementById('delete-form-{{ $item->id }}').submit(); }">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                           </svg>
                       </a>
                     {{-- method delete invoice --}}
                     <form id="delete-form-{{ $item->id }}" action="{{ route('invoice.destroy', $item->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
               </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>


@endsection

@section('script')    
   <script>
      @if (Session::has('status'))
         Swal.fire({
         title: '{{ Session::get('status') }}',
         icon: "success"
         });
      @endif
    </script>  
@endsection
