<!DOCTYPE html>
<html lang="pt-br">

    <head>

        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<!-- Swiper JS -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <title>Wigo & Bella</title>

    </head>
<style>
    html, body {
            height: 100%;
            margin: 0;
            
            background-image: url({{ asset('storage/images/fundo-page.jpg') }});
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }
</style>
    <body>
        <div class="container">
            @include('layout.header')
        </div>

        <div class="container">
            @yield('content')
        </div>
        
    </body>

</html>