<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>:: Admin ::</title>
    
        <!-- Scripts 
        <script src="{{ asset('js/app.js') }}" defer></script>-->
    
        <!-- Styles 
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">-->

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.umd.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <!-- Iconos -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <!-- Sweet Alert-->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- Datapicker -->
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script>
        $( function() {
          $( "#datepicker" ).datepicker();
        } );
        </script>

        <style>
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button{
                -webkit-appearance: none;
                margin: 0;
            }
            input[type=number]{
                -moz-appearance: textfield;
            }

        </style>
    </head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm nav-fill">
            <div class="container">
                
                <div class="collapse navbar-collapse text-middle" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                        <a class="navbar-brand text-secondary nav-item nav-link" href="{{ url('/') }}">
                            <button type="button" class="btn btn-outline-secondary"><i class="bi bi-bar-chart-line-fill"></i> Dashboard </button>
                        </a>
                        <a class="navbar-brand text-primary nav-item nav-link" href="{{ url('/empresas') }}">
                            <button type="button" class="btn btn-outline-primary"><i class="bi bi-buildings-fill"></i> Empresas </button>
                        </a>
                        
                        <a class="navbar-brand text-primary nav-item nav-link" href="{{ url('/sucesos') }}">
                            <button type="button" class="btn btn-outline-primary"><i class="bi bi-boxes"></i> Sucesos </button>
                        </a>

                        <a class="navbar-brand text-primary nav-item nav-link" href="{{ url('/personas') }}">
                            <button type="button" class="btn btn-outline-primary"><i class="bi bi-people-fill"></i> RRHH </button>
                        </a>

                        <a class="navbar-brand text-primary nav-item nav-link" href="{{ url('/vehiculos') }}">
                            <button type="button" class="btn btn-outline-primary"><i class="bi bi-car-front-fill"></i> Vehículos </button>
                        </a>
                </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto nav-item nav-link">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                
            </div>
        </nav>
@if (session('mensajeOk'))
<script>
    swal("Correcto!", "{{session('mensajeOk')}}", "success");
</script>
@endif
@if (session('mensajeErr'))
<script>
    swal("Error", "{{session('mensajeErr')}}", "error");
</script>
@endif
        <main class="py-2">
            @yield('content')
        </main>
    </div>
</body>
</html>
