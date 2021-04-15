<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="background-color: #585858">
    <div class="container mx-auto" style="background-color: #E6E6E6">
        <h1 class="ml-5">En hora buena</h1>
        <h3 class="ml-5">Querídisimo Telepracticante: </h3><p style="color: #0080FF">{{ $details['nombrePracticante'] }}</p>
        <h4 class="ml-5">Haz sido seleccionado para una entrevista de práctica por la Empresa: </h4><p style="color: #0080FF">{{ $details['nombreEmpresa'] }}</p>
        <h4 class="ml-5">por la Oferta llamada: </h4><p style="color: #0080FF">{{ $details['nombreOferta'] }}</p>
        <h4 class="ml-5">Fecha de la citación: </h4><p style="color: #0080FF">{{  $details['fecha_citacion'] }}</p>
        <h4 class="ml-5">Hora de la citación: </h4><p style="color: #0080FF">{{  $details['hora_citacion'] }}</p>
        <h5 class="ml-5">Ingresa al link para confirmar la Fecha de citación</h5>
        <a href="{{ route('confirmacionFechaCitacion')}}">Citación</a>
    </div>
</body>
</html>