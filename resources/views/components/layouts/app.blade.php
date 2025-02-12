<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>

        @filamentStyles
        @vite('resources/css/app.css')
    </head>

    <body class="gradient-background text-white dark">
        {{ $slot }}
        @livewire('notifications')
        @filamentScripts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </body>

</html>
