<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <meta name="description" content=""> --}}
    <meta name="author" content="Tassos Kolydas, http://www.kolydart.gr">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <meta property="og:title" content="Oι Τέχνες στο ελληνικό σχολείο: παρόν και μέλλον" />
    <meta property="og:description" content="Συνέδριο 11, 12, 13 Οκτωβρίου 2018, Φιλοσοφική Σχολή. Κύριος σκοπός του συνεδρίου είναι η ανάδειξη της κρίσιμης θέσης των τεχνών στον σχεδιασμό της εκπαιδευτικής πολιτικής για το μελλοντικό σχολείο και η παραγωγή εκπαιδευτικού υλικού." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://texnes-ellinikosxoleio.uoa.gr/" />
    {{-- <meta property="og:image" content="http://texnes-ellinikosxoleio.uoa.gr/uploads/1538045453-Poster-Conference-2018-final1.jpg" /> --}}
    <meta property="og:image:secure_url" content="https://texnes-ellinikosxoleio.uoa.gr/uploads/1538045453-Poster-Conference-2018-final1.jpg" />

    <link rel="stylesheet"
          href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet"
          href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"/>
    <link rel="stylesheet"
          href="//cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css"/>

    <title>Oι Τέχνες στο ελληνικό σχολείο: παρόν και μέλλον{{-- @yield('title') --}}</title>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="icon" href="/favicon.ico">
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
{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

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

<script>
    window.deleteButtonTrans = '{{ trans("quickadmin.qa_delete_selected") }}';
    window.copyButtonTrans = '{{ trans("quickadmin.qa_copy") }}';
    window.csvButtonTrans = '{{ trans("quickadmin.qa_csv") }}';
    window.excelButtonTrans = '{{ trans("quickadmin.qa_excel") }}';
    window.pdfButtonTrans = '{{ trans("quickadmin.qa_pdf") }}';
    window.printButtonTrans = '{{ trans("quickadmin.qa_print") }}';
    window.colvisButtonTrans = '{{ trans("quickadmin.qa_colvis") }}';
</script>

<script>
    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Greek.json"
        }
    });
</script>

    @yield('javascript')

  </body>
</html>