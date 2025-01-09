<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
</head>

<body class="bg-black text-white">
    {{ $slot }}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</body>

</html>
