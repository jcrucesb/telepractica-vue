<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Document</title>
</head>
<body>
    <h1>Bienvenido a la gran Comunidad de Creatiox</h1>
    <h3>Termina de llenar tu formulario de registro y elige la oferta más conveniente para ti</h3>
    <h5>Ingresa al link</h5>
    <h2></h2>
    <!--Funcionando correctamente.-->
    <a href="{{ route('registro')}}">Termina de Registrarte</a>
    <p>Gracacias por ser parte de esta gran comunidad</p>
</body>
</html>