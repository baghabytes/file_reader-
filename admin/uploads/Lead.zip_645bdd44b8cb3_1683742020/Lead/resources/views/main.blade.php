<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Leads</title>
    <style>
@import url("https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i&amp;display=swap");
body {
  font-family: "Nunito", sans-serif !important;
  color: #686c71 !important;
  font-size: 14px !important;
  background-color: #eeeef8 !important;
}
a {
  transition: .4s;
  -webkit-transition: .4s;
}

a:hover {
  text-decoration: none;
  color: #2962ff;
}

h1, h2, h3, h4, h5, h6 {
  color: #212529;
  font-weight: bold;
}

p,label {
  color: #000000;
  line-height: 24px;
  margin-bottom: 10px;
}

.footer {
  background: #fff;
  padding: 15px 30px;
  bottom: 0 !important;
  text-align: center;  width: 100%;
  -webkit-clip-path: polygon(1% 0, 99% 0, 100% 100%, 0% 100%);
  clip-path: polygon(1% 0, 99% 0, 100% 100%, 0% 100%);
  border-radius: 30px 30px 0 0;
}

.footer p {
  margin: 0;
  color: #5a5151;
  text-transform: capitalize;
}

.footer p a {
  color: #2962ff;
}

.footer p a:hover {
  text-decoration: underline;
}




        </style>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light navbar-right bg-white shadow" style="background-color:#ffffff !important;">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('main') }}" style="color:#007bff;font-weight:bold;text-transform:uppercase;">Leads</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">

    <ul class="navbar-nav  nav  ms-auto"  >

  

    @if(Auth::check() && Auth::user()->Role == 'admin')
    <li  class="nav-item" >
    <a class="nav-link" href="{{ route('main') }}">All Records</a>
    </li>
    

    <li  class="nav-item" >
    <a class="nav-link" href="{{ route('create') }}">Create Record</a>
    </li>

    <li  class="nav-item" >
    <a class="nav-link" href="{{ route('createUser') }}">Create User</a>
    </li>

        @endif


        @if(Auth::check() && Auth::user()->Role == 'viewer')
    <li  class="nav-item" >
    <a class="nav-link" href="{{ route('main') }}">All Records</a>
    </li>
        @endif

        @if(Auth::check() && Auth::user()->Role == 'writer')
        <li  class="nav-item" >
    <a class="nav-link" href="{{ route('create') }}">Create Record</a>
    </li>
        @endif

    </ul>

    <ul class="navbar-nav  nav  ml-auto">
    <li  class="nav-item" >
    <a class="nav-link" href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

  </li>

    </ul>

 

    </div>
  </div>
</nav>


<section class="mt-5 ">

  <main class="container">
            @yield('content')
        </main>

</section>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
  

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
             
             <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
             <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
             
             <script>
              $(document).ready(function () {
             $('#example').DataTable();
             });
             </script>


</body>
</html>
