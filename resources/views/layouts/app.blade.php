<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!--
El archivo app.blade.php es la plantilla principal de la aplicación.
Aquí se define la estructura básica de la página, y se incluyen los
archivos CSS y JS necesarios para el funcionamiento de la aplicación.
-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,600">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="content text-center">
            <div class="title m-b-md display-4">
                {{ config('app.name', 'Laravel') }}
            </div>

            <div class="links">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
