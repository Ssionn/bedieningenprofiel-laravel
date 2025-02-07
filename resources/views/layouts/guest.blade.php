<!DOCTYPE html>

<html>

<head>
    <meta viewport="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name') }}</title>

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="m-0 font-exo">

    <main>
        {{ $slot }}
    </main>

</body>

</html>
