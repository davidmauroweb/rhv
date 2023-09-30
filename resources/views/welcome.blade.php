<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistema de Gestión</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            @if (Route::has('login'))
                                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                    @auth
                                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                                    @else
                                        <a href="{{ route('login') }}" class="text-sm underline">Log in</a>

                                        @if (Route::has('register'))
                                        
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                        <div class="card-body align-center">
                            <div class="col">
                                <img src="{{ asset('img/logo.jpg') }}" alt="Logo" width="20%" height="20%">
                            </div>
                        </div>
                        <div class="card-footer align-center"><h3>Sitema de control de Recursos Humanos y Maquinaria</h3></div>
                    </div>
                </div>
            </div>
        </div>            
    </body>
</html>
