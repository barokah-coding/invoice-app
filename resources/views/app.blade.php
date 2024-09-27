<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
   <title>@yield('title')</title>
   @yield('link')
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link rel="shortcut icon" href="{{ asset('images/ivcs.png') }}" type="image/x-icon">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css">

   <script src="{{ asset('js/jquery.js') }}"></script>
     <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
   <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.1.3/datatables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.1.3/datatables.min.js"></script>
   
</head>
<body>
   <div class="container-dasboard">
      @auth    
      @yield('nav')
      @endauth
      @yield('content')
   </div>

   @yield('pdf')

   <script>
       $(document).ready(function() {
        $('#myTable').DataTable();
    });
   </script>
 

  @yield('script')
</body>
</html>