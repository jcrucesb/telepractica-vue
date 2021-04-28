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
        <h1 class="ml-5">Felicidades</h1>
        <h4 class="ml-5">Empresa: {{ $details['nombre_ficticio'] }} </h4>
        <br>
        <p>Fuiste seleccionado para formar parte de nuestro equipo de trabajo, cumpliste 
        con todos los parámetros para quedarte con el puesto de Desarrollador Web
        en la OFERTA llamada, {{ $details['nombreOferta'] }}</p>
    </div>
</body>
</html> 