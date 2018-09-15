<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <meta name="description" content=""> --}}
    <meta name="author" content="Tassos Kolydas, http://www.kolydart.gr">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet"
          href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet"
          href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"/>
    <link rel="stylesheet"
          href="//cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css"/>

    <title>@yield('title',config('app.name'))</title>

    {{-- <link rel="icon" href="/favicon.ico"> --}}
    {{-- <link href="{{ mix('/css/app.css') }}" rel="stylesheet" > --}}
    {{-- <script src="{{ mix('/js/app.js') }}"></script> --}}

    <!-- Bootstrap core CSS -->
    <link href="/css/frontend/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/frontend/custom.css" rel="stylesheet">

    @yield('head','')

  </head>

  <body>

    @include('frontend.nav')


    <main role="main" class="container" id="app">
        @include('layouts.messages')
        @yield('content')
    </main>


    {!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
    <button type="submit">Logout</button>
    {!! Form::close() !!}
    
    {{-- Bootstrap core JavaScript
    ================================================== 
    Placed at the end of the document so the pages load faster  --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
    <script src="{{ url('adminlte/js') }}/select2.full.min.js"></script>
    <script src="{{ url('adminlte/js') }}/main.js"></script>

    {{-- <script src="{{ url('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script> --}}
    <script src="{{ url('adminlte/plugins/fastclick/fastclick.js') }}"></script>
    {{-- <script src="{{ url('adminlte/js/app.min.js') }}"></script> --}}

    @yield('javascript')



  </body>
</html>