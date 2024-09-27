@extends('app')

@section('title', 'Login')


@section('link')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="container-login">
      <div class="form-login">
         <div class="text-login">
            <h1>Login</h1>
         </div>
         <form action="{{ route('postLogin') }}" method="POST">
            @csrf
            <div class="input">
               <label for="">Username</label>
               <input type="text" name="username" id="username">
               <label for="password">Password</label>
               <input type="password" name="password" id="password">
            </div>
            <button type="submit" class="login">Login</button>
         </form>
      </div>
      <div class="gambar-info">
      </div>
    </div>


    <script>
      @if (Session::has('status'))
         Swal.fire({
         title: '{{ Session::get('status') }}',
         icon: "error"
         });
      @endif
    </script>
@endsection