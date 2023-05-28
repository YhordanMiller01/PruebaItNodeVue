<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Prueba</title>
        <link href=" {{ mix('css/app.css') }}" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Fonts -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    </head>
    <body>
        <div id="app">
            <h1 class="mensaje_inicial">Bienvenido</h1><hr><br>
            <button  class="delete-modal btn btn-success" type="button" onclick="window.location='{{ url("/historial") }}'"><span class=""></span> <strong><i class='fa fa-eye'>Ver Historial</i></strong></button>
            <principal></principal>
        </div>
        <script src="{{ mix('js/bootstrap.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
