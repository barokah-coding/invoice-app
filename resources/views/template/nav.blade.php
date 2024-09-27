<nav class="navigation-admin">
   <div class="user">
      <a href="{{ route('dashboard') }}" class="text-decoration-none text-white">Home</a> 
      <a href="#" class="text-decoration-none text-white">{{ auth()->user()->name }}</a>
      <img src="{{ asset('images/man.png') }}" alt="">
   </div>
</nav>