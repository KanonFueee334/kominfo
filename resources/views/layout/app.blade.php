<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office Dinkominfo</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    @if(Route::is('be.um'))
        <link rel="stylesheet" href="{{ asset('vendors/simple-datatables/style.css') }}">
    @else

    @endif
</head>

<body>
    <div id="app">
        
        @include('layout.sidebar')

        <div id="main" class='layout-navbar'>

            @include('layout.header')

            <div id="main-content">
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>@yield('title')</h3>
                                <p class="text-subtitle text-muted"></p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        @if(!Route::is('be.home'))
                                            <li class="breadcrumb-item"><a href="{{ route('be.home') }}">Beranda</a></li>
                                        @endif

                                        @if(Route::is('be.um'))
                                            <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
                                        @else

                                        @endif

                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                    @yield('content')
                    
                </div>

                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2024 &copy; Dinas Komunikasi dan Informatika Kota Surabaya</p>
                        </div>
                        <div class="float-end">
                            <p>Office V1.0.0</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>

    @if(Route::is('be.um'))
        <script src="{{ asset('vendors/simple-datatables/simple-datatables.js') }}"></script>
        <script>
            // Simple Datatable
            let table1 = document.querySelector('#user-table');
            let dataTable = new simpleDatatables.DataTable(table1);
        </script>
    @else

    @endif
</body>

</html>