<!DOCTYPE html>

<html lang="en">

<head>
    <meta viewport="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name') }}</title>

    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="m-0">
    <header>
        <x-navigation />
    </header>

    <main>
        {{ $slot }}
    </main>

</body>

</html>
