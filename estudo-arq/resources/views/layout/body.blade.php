<!DOCTYPE html>
<html lang="pt-br">

    <head>

        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <title>Arquitetura e Vida</title>

    </head>

    <body>
        <div class="container">
            @include('layout.header')
        </div>

        <div class="container">
            @yield('content')
        </div>
        
    </body>

</html>