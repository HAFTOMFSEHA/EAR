<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <link href="{{ asset('assets/site/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/customadmin.css') }}" rel="stylesheet">

    <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
    </script>
</head>

<body>
    <div id="app">
        @yield('container')
    </div>
    <script src="{{ asset('assets/admin/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/jquery-3.3.1.slim.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/script.js') }}"></script>
    <script src="{{ asset('assets/admin/js/app.js') }}"></script>

    @stack('scripts')
    <script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('assets/admin/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/admin/js/dataTables.bootstrap4.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>
    
</body>

</html>