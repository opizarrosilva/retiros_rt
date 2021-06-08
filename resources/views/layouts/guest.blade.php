<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ROCKTRUCK') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ config('app.url') }}css/app.css">

        <!-- Scripts -->
        <script src="{{ config('app.url') }}js/app.js" defer></script>
    </head>
    <body>
        <div class="font-sans text-black antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
