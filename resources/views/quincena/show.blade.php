<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{date('d/m/y',strtotime($quincena->fecha_inicial))}}</h1> <br>
    <ul>
        @for ($i = 0; $i < 14; $i++)
            <li>{{date('d/m/y',strtotime($quincena->dias[$i]))}}</li>
        @endfor
    </ul>
</body>
</html>